<?php

namespace App\Http\Controllers;

use App\Models\Greenhouse;
use App\Models\GreenhouseActuator;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class GreenhouseController extends Controller
{

    public function index()
    {
        $greenhouses = Greenhouse::with("owner")->get();
        return view("greenhouses.index", compact("greenhouses"));
    }

    public function create()
    {
        return view("greenhouses.create");
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            "user_id" => "required|exists:users,id",
            "greenhouse_name" => "required|string|max:255"
        ]);

        $code = strtoupper(Str::random(5));
        $api_key = Str::random(64);

        $data = [
            'owner_id' => $request->get("user_id"),
            'code' => $code,
            'name' => $request->get("greenhouse_name"),
            'api_token' => $api_key
        ];

        $greenhouse = Greenhouse::create($data);

        $greenhouse->greenhouse_actuators()->createMany(
            [
                ["actuator" => "exhaust_fan", "state" => "OFF", "control_level" => GreenhouseActuator::DEFAULT_LEVEL],
                ["actuator" => "heater", "state" => "OFF", "control_level" => GreenhouseActuator::DEFAULT_LEVEL],
            ]
        );

        $greenhouse->greenhouse_environment_limits()->createMany(
            [
                ['sensor' => "temperature", 'lower_limit' => null, 'upper_limit' => null, 'new_state' => "ON"],
                ['sensor' => "humidity", 'lower_limit' => null, 'upper_limit' => null, 'new_state' => "ON"],
                ['sensor' => "air_quality", 'lower_limit' => null, 'upper_limit' => null, 'new_state' => "ON"],
            ]
        );

        return redirect()->route("greenhouses.successful-store", ["greenhouse" => $greenhouse->id]);
    }

    public function successfulStore(Greenhouse $greenhouse)
    {
        $greenhouse->load("owner");
        return view("greenhouses.successful-store", compact("greenhouse"));
    }

    public function destroy(Greenhouse $greenhouse)
    {
        $greenhouse->delete();

        return redirect()->route("greenhouses.index")->withStatus("The greenhouse titled {$greenhouse->name} has been deleted");
    }
}
