<?php

namespace App\Http\Controllers;

use App\Domain\EnvironmentConditionManager;
use App\Events\NodeSentMetrics;
use App\Models\Greenhouse;
use App\Models\GreenhouseActuator;
use App\Models\GreenhouseMetric;
use Carbon\Carbon;
use Illuminate\Http\Request;

class GreenhouseNodeController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth", ["except" => ["persist"]]);
        $this->middleware("auth:node_api", ["only" => ["persist"]]);
    }

    public function show(Greenhouse $greenhouse)
    {
        if ($greenhouse->owner_id != auth()->id())
            return back()->withErrors("You are not authorized to view this record");

        return view('greenhouse-node.index', compact('greenhouse'));
    }

    public function manageConditions(Greenhouse $greenhouse)
    {
        return view('greenhouse-node.manage-conditions', compact('greenhouse'));
    }

    public function getStats()
    {
        $greenhouse = Greenhouse::whereCode(\request("greenhouse_code"))->first(["id"]);
        $pastHour = Carbon::now()->subHour();

        $greenhouse_metrics = GreenhouseMetric::selectRaw("ROUND(AVG(`temperature`),1)  as 'avg_temperature', ROUND(AVG(`humidity`),0)  as 'avg_humidity',
        ROUND(AVG(`temperature_outdoor`),1)  as 'avg_temperature_outdoor', ROUND(AVG(`humidity_outdoor`),0)  as 'avg_humidity_outdoor', ROUND(AVG(`air_quality`),0)  as 'avg_air_quality',
        ROUND(AVG(`soil_moisture`),0)  as 'avg_soil_moisture', ROUND(SUM(`water_volume`),0)  as 'total_water_volume',
        ROUND(SUM(`energy_unit`),0)  as 'total_energy_unit', DATE_FORMAT(`created_at`,'%H:%i') as 'post_time',DATE_FORMAT(`created_at`,'%Y-%m-%d %H:%i') as 'post_datetime'")
            ->where("created_at", ">=", $pastHour)->groupBy('post_time', 'post_datetime')->orderBy("post_datetime")
            ->where("greenhouse_id", $greenhouse->id)->get();

        $month_utilisation = GreenhouseMetric::selectRaw("IFNULL(ROUND(SUM(`water_volume`)/1000,3),0)  as 'total_water_volume',
        IFNULL(ROUND(SUM(`energy_unit`)*(COUNT(id)/3600),2),0)  as 'total_energy_unit'")
            ->where("greenhouse_id", $greenhouse->id)
            ->whereRaw("DATE(created_at) >= DATE(DATE_SUB(NOW(), INTERVAL 1 MONTH))")
            ->first();

        return response()->json([
            "temperature" => $greenhouse_metrics->pluck("avg_temperature"),
            "humidity" => $greenhouse_metrics->pluck("avg_humidity"),
            "temperature_outdoor" => $greenhouse_metrics->pluck("avg_temperature_outdoor"),
            "humidity_outdoor" => $greenhouse_metrics->pluck("avg_humidity_outdoor"),
            "air_quality" => $greenhouse_metrics->pluck("avg_air_quality"),
            "soil_moisture" => $greenhouse_metrics->pluck("avg_soil_moisture"),
            "water_volume" => $greenhouse_metrics->pluck("total_water_volume"),
            "energy_unit" => $greenhouse_metrics->pluck("total_energy_unit"),
            "month_water_volume" => $month_utilisation->total_water_volume,
            "month_energy_unit" => $month_utilisation->total_energy_unit,
            "post_time" => $greenhouse_metrics->pluck("post_time"),
//            "" => $greenhouse_metrics->pluck(""),
        ]);

    }

    public function persist()
    {
        $this->validate(\request(), [
            "temperature" => "required|numeric",
            "humidity" => "required|numeric|between:0,100",
            "air_quality" => "required|numeric|between:0,100",
            "soil_moisture" => "required|numeric|between:0,100",
            "power_used" => "required|numeric",
            "water_used" => "required|numeric",
            "send_interval" => "required|numeric",
        ]);

        $data = \request()->only("temperature", "humidity", "air_quality", "soil_moisture", "send_interval");

        $weather_api = $this->weatherApi();
//        $weather_api = ["main" => ["temp" => 45, "humidity" => 12]]; //test purposes only
        $api_main = $weather_api["main"];

        $data["water_volume"] = \request("water_used");
        $data["energy_unit"] = \request("power_used");

        $data["temperature_outdoor"] = $api_main["temp"];
        $data["humidity_outdoor"] = $api_main["humidity"];
        $data["greenhouse_id"] = auth("node_api")->id();

        $greenhouse_metrics = GreenhouseMetric::create($data);

        (new EnvironmentConditionManager)->assessment($greenhouse_metrics);

        $actuators = GreenhouseActuator::whereGreenhouseId($data["greenhouse_id"])
            ->select('actuator', 'state', 'control_level')->get();

        $monthly = GreenhouseMetric::selectRaw("IFNULL(ROUND(SUM(`water_volume`)/1000,3),0)  as 'total_water_volume',
        IFNULL(ROUND(SUM(`energy_unit`)*(COUNT(id)/3600),2),0)  as 'total_energy_unit'")
            ->where("greenhouse_id", $greenhouse_metrics->greenhouse_id)
            ->whereRaw("DATE(created_at) >= DATE(DATE_SUB(NOW(), INTERVAL 1 MONTH))")
            ->first()->toArray();

        broadcast(new NodeSentMetrics($greenhouse_metrics, $actuators->toArray(), $monthly));

        $actuator = $actuators->pluck("state", "actuator");

        return \response()->json(["success" => true, "actuator" => $actuator]);

    }

    public function overrideActuatorState(Greenhouse $greenhouse)
    {
        $greenhouse_id = $greenhouse->id;

        $actuator = \request("actuator", "");
        $suggested_state = strtoupper(\request("state", ""));

        if (in_array($suggested_state, ["OFF", "ON"])) {
            $updated = GreenhouseActuator::where("greenhouse_id", $greenhouse_id)
                ->where("actuator", $actuator)
                ->update(["state" => $suggested_state, "control_level" => GreenhouseActuator::OVERRIDE_LEVEL]);
        } else {
            $updated = GreenhouseActuator::where("greenhouse_id", $greenhouse_id)
                ->where("actuator", $actuator)
                ->update(["state" => "OFF", "control_level" => GreenhouseActuator::CONDITION_LEVEL,
                    "sensor" => ""]);
        }

        if ($updated)
            return response()->json(["status" => "ok"]);
        return response()->json(["status" => "err", "message" => "Failed to update state"]);
    }

    public function clearConditions(Greenhouse $greenhouse)
    {
        $updated = $greenhouse->greenhouse_environment_limits()->update([
            'lower_limit' => null, 'upper_limit' => null]);

        $updated2 = $greenhouse->greenhouse_actuators()
            ->where("control_level", GreenhouseActuator::CONDITION_LEVEL)
            ->update(["state" => "OFF", "control_level" => GreenhouseActuator::DEFAULT_LEVEL,
                "sensor" => ""]);

//        if ($updated && $updated2)
        return response()->json(["status" => "ok"]);
//        return response()->json(["status" => "err", "message" => "Failed to update state"]);
    }

    private function weatherApi()
    {
        $url = "https://api.openweathermap.org/data/2.5/weather";
        $api_token = "068f7c3f7430aaac1d9a0bacdb430885";
        $city = "Gweru";
        $country_code = "ZW";
        $resp = file_get_contents("{$url}?q={$city},{$country_code}&appid={$api_token}&units=metric");

        return json_decode($resp, true);
    }
}
