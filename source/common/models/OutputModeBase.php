<?php

namespace common\models;

use Yii;

/**
 * @property ModulesBase $module
 */
class OutputModeBase extends \common\models\db\OutputModeDB {

    public function getConvectionMode() {
        return substr($this->convection_pump, 0, 8);
    }

    public function getConvectionPump() {
        $pump = '';
        switch ($this->getConvectionMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getConvectionTime() {
        $bin = substr($this->convection_pump, 8, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getCwspMode() {
        return substr($this->cold_water_supply_pump, 0, 8);
    }

    public function getCwspPump() {
        $pump = '';
        switch ($this->getCwspMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getCwspTime() {
        $bin = substr($this->cold_water_supply_pump, 8, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getReturnPumpMode() {
        return substr($this->return_pump, 0, 8);
    }

    public function getReturnPumpPump() {
        $pump = '';
        switch ($this->getReturnPumpMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getReturnPumpTime() {
        $bin = substr($this->return_pump, 8, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getPressurePumpMode() {
        return substr($this->incresed_pressure_pump, 0, 8);
    }

    public function getPressurePumpPump() {
        $pump = '';
        switch ($this->getPressurePumpMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getPressurePumpTime() {
        $bin = substr($this->incresed_pressure_pump, 8, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getPressurePumpTem() {
        $bin = substr($this->incresed_pressure_pump, 16, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getHeatPumpMode() {
        return ($this->heat_pump && substr($this->heat_pump, 0, 8)) ? substr($this->heat_pump, 0, 8) : BACKUP;
    }

    public function getHeatPumpPump() {
        $pump = '';
        switch ($this->getHeatPumpMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getHeatPumpTime() {
        $bin = substr($this->heat_pump, 8, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getHeaterResisMode() {
        return substr($this->heater_resister, 0, 8);
    }

    public function getHeaterResisPump() {
        $pump = '';
        switch ($this->getHeaterResisMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getHeaterResisTime() {
        $bin = substr($this->heater_resister, 16, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function getHeaterResisTem() {
        $bin = substr($this->heater_resister, 8, 8);
        return ($bin) ? bindec($bin) : 0;
    }

    public function get3wayMode() {
        return ($this->three_way_valve && substr($this->three_way_valve, 0, 8)) ? substr($this->three_way_valve, 0, 8) : BACKUP;
    }

    public function get3wayPump() {
        $pump = '';
        switch ($this->get3wayMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function get3wayTime() {
        $bin = substr($this->three_way_valve, 8, 8);
        return bindec($bin);
    }

    public function getBlakflowMode() {
        return ($this->backflow_valve && substr($this->backflow_valve, 0, 8)) ? substr($this->backflow_valve, 0, 8) : BACKUP;
    }

    public function getBlakflowPump() {
        $pump = '';
        switch ($this->getBlakflowMode()) {
            case AUTO_B1:
            case MANUAL_B1:
                $pump = PUMP_SLAVE;
                break;
            case AUTO_B2:
            case MANUAL_B2:
                $pump = PUMP_MASTER;
                break;
            case MANUAL_B12:
                $pump = PUMP_ALL;
                break;
        }
        return $pump;
    }

    public function getBlakflowTime() {
        $bin = substr($this->backflow_valve, 8, 8);
        return bindec($bin);
    }

    public function getReservedMode() {
        return substr($this->reserved, 0, 8);
    }

    public function getReservedPump() {
        return substr($this->reserved, 8, 8);
    }

    public function getReservedTime() {
        $bin = substr($this->reserved, 16, 8);
        return bindec($bin);
    }

    public function getConvectionPumpDetail() {
        $mode = '';
        switch ($this->getConvectionMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->getConvectionTime();
    }

    public function getColdWaterSupplyPumpDetail() {
        $mode = '';
        switch ($this->getCwspMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->getCwspTime();
    }

    public function getReturnPumpDetail() {
        $mode = '';
        switch ($this->getReturnPumpMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->getReturnPumpTime();
    }

    public function getIncresedPressurePumpDetail() {
        $mode = '';
        switch ($this->getPressurePumpMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->getPressurePumpTime();
    }

    public function getHeatPumpDetail() {
        $mode = '';
        switch ($this->getHeatPumpMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->getHeatPumpTime();
    }

    public function getHeaterResisterDetail() {
        $mode = '';
        switch ($this->getHeaterResisMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . ' - ' . $this->getHeaterResisTem() . " - " . $this->getHeaterResisTime();
    }

    public function getThreeWayDetail() {
        $mode = '';
        switch ($this->get3wayMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->get3wayTime();
    }

    public function getBlakflowValveDetail() {
        $mode = '';
        switch ($this->getBlakflowMode()) {
            case AUTO_B1:
                $mode = 'Auto B1';
                break;
            case AUTO_B2:
                $mode = 'Auto B2';
                break;
            case MANUAL_B1:
                $mode = 'Manual B1';
                break;
            case MANUAL_B2:
                $mode = 'Manual B2';
                break;
            case MANUAL_B12:
                $mode = 'Manual B12';
                break;
        }
        return $mode . " - " . $this->getBlakflowTime();
    }

}
