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
                return $q->whereNotNull('lower_limit')->whereNotNull('upper_limit');
            })->get();

        $isExhaustFanOnElsewhere = false;

        foreach ($limits as $limit) {
            $value = $greenhouseMetric->{$limit->sensor};

            switch ($limit->sensor) {
                case 'temperature':
                    if ($value > $limit->upper_limit) {
                        $this->updateActuatorState("heater", "OFF", $limit->sensor);
                        $this->updateActuatorState("exhaust_fan", "ON", $limit->sensor);
                        $isExhaustFanOnElsewhere = true;
                    } elseif ($value < $limit->lower_limit) {
                        $this->updateActuatorState("heater", "ON", $limit->sensor);
                    } elseif ($value >= $limit->upper_limit) {
                        if (!$isExhaustFanOnElsewhere)
                            $this->updateActuatorState("exhaust_fan", "OFF", $limit->sensor);
                    }
                    break;
                case 'humidity':
                    if ($value > $limit->upper_limit) {
                        $this->updateActuatorState("exhaust_fan", "ON", $limit->sensor);
                        $isExhaustFanOnElsewhere = true;
                    } else {
                        if (!$isExhaustFanOnElsewhere)
                            $this->updateActuatorState("exhaust_fan", "OFF", $limit->sensor);
                    }
                    break;
                case 'air_quality':
                    if ($value < $limit->lower_limit) {
                        $this->updateActuatorState("exhaust_fan", "ON", $limit->sensor);
                        $isExhaustFanOnElsewhere = true;
                    } else {
                        if (!$isExhaustFanOnElsewhere)
                            $this->updateActuatorState("exhaust_fan", "OFF", $limit->sensor);
                    }
                    break;
            }
        }
    }

    private function updateActuatorState($actuator, $new_state, $sensor)
    {
        return GreenhouseActuator::where("control_level", "<", GreenhouseActuator::OVERRIDE_LEVEL)
            ->where("actuator", $actuator)
            ->update(["state" => strtoupper($new_state), "control_level" => GreenhouseActuator::CONDITION_LEVEL]);
    }

}
