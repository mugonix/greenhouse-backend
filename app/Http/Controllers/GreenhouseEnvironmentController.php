<?php

namespace App\Http\Controllers;

use App\Models\Greenhouse;
use App\Models\GreenhouseEnvironmentLimit;
use Illuminate\Http\Request;

class GreenhouseEnvironmentController extends Controller
{
    public function getEnvironmentalLimits()
    {
        $greenhouse = Greenhouse::whereCode(\request("greenhouse_code"))->first(["id"]);

        $greenhouse_environmental_limits = GreenhouseEnvironmentLimit::whereGreenhouseId($greenhouse->id)
            ->get(['sensor', 'lower_limit', 'upper_limit'])->keyBy('sensor');

        return response()->json($greenhouse_environmental_limits->all());
    }

    public function updateEnvironmentalCondition()
    {
        $validate = \Validator::make(\request()->all(), [
            "greenhouse_code" => "required",
            "sensor" => "required",
            "upper_limit" => "nullable|numeric",
            "lower_limit" => "nullable|numeric",
        ]);

        if ($validate->fails()) {
            return response()->json(["success" => false, "errors" => $validate->errors()->all()]);
        }

        $greenhouse = Greenhouse::whereCode(\request("greenhouse_code"))->first(["id"]);
        $update_greenhouse_environmental_limit = GreenhouseEnvironmentLimit::whereGreenhouseId($greenhouse->id)
            ->whereSensor(\request("sensor"))->update(\request(["upper_limit", "lower_limit"]));

        if ($update_greenhouse_environmental_limit)
            return response()->json(["success" => true]);

        return response()->json(["success" => false, "errors" => ["Failed to update database record"]]);


    }
}
