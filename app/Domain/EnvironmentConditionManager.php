<?php


namespace App\Domain;


use App\Models\GreenhouseActuator;
use App\Models\GreenhouseEnvironmentLimit;
use App\Models\GreenhouseMetric;

class EnvironmentConditionManager
{
    //what happens in here will finish a project but is not scalable
    //because I know the actuators
    public function assessment(GreenhouseMetric $greenhouseMetric)
    {
        $limits = GreenhouseEnvironmentLimit::whereGreenhouseId($greenhouseMetric->greenhouse_id)
            ->where(function ($q) {
                return $q->whereNotNull('lower_limit')->orWhereNotNull('upper_limit');
            })->get();

        \Log::info($limits);


        $exhaust_sensor = GreenhouseActuator::where("greenhouse_id", $greenhouseMetric->greenhouse_id)->where("actuator", "exhaust_fan")
            ->first();

        \Log::info($exhaust_sensor);


        $isExhaustFanOnElsewhere = (is_null($exhaust_sensor)) ? '' : $exhaust_sensor->sensor;

        foreach ($limits as $limit) {
            $value = $greenhouseMetric->{$limit->sensor};
            \Log::info($value);
            switch ($limit->sensor) {
                case 'temperature':
                    if ($value > $limit->upper_limit) {
                        $this->updateActuatorState($greenhouseMetric->greenhouse_id, "heater", "OFF", $limit->sensor, "");
                        $this->updateActuatorState($greenhouseMetric->greenhouse_id, "exhaust_fan", "ON", $limit->sensor, "temperature");
                        $isExhaustFanOnElsewhere = "temperature";
                    } elseif ($value < $limit->lower_limit) {
                        $this->updateActuatorState($greenhouseMetric->greenhouse_id, "heater", "ON", $limit->sensor, "temperature");
                    } elseif ($value >= $limit->upper_limit) {
                        if (in_array($isExhaustFanOnElsewhere, ["", "temperature"]))
                            $this->updateActuatorState($greenhouseMetric->greenhouse_id, "exhaust_fan", "OFF", $limit->sensor, "");
                    }
                    break;
                case 'humidity':
                    if ($value > $limit->upper_limit) {
                        $this->updateActuatorState($greenhouseMetric->greenhouse_id, "exhaust_fan", "ON", $limit->sensor, "humidity");
                        $isExhaustFanOnElsewhere = "humidity";
                    } else {
                        if (in_array($isExhaustFanOnElsewhere, ["", "humidity"]))
                            $this->updateActuatorState($greenhouseMetric->greenhouse_id, "exhaust_fan", "OFF", $limit->sensor, "");
                    }
                    break;
                case 'air_quality':
                    if ($value < $limit->lower_limit) {
                        $this->updateActuatorState($greenhouseMetric->greenhouse_id, "exhaust_fan", "ON", $limit->sensor,"air_quality");
                        $isExhaustFanOnElsewhere = "air_quality";
                    } else {
                        if (in_array($isExhaustFanOnElsewhere, ["", "air_quality"]))
                            $this->updateActuatorState($greenhouseMetric->greenhouse_id, "exhaust_fan", "OFF", $limit->sensor, "");
                    }
                    break;
            }
        }
    }

    private function updateActuatorState($greenhouse_id, $actuator, $new_state, $sensor)
    {
        return GreenhouseActuator::where("greenhouse_id", $greenhouse_id)
            ->where("control_level", "<", GreenhouseActuator::OVERRIDE_LEVEL)
            ->where("actuator", $actuator)
            ->update(["state" => strtoupper($new_state),
                "control_level" => GreenhouseActuator::CONDITION_LEVEL,
                "sensor" => $sensor]);
    }

}
