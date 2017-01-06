<?php

namespace backend\models;

use common\models\OutputModeBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

class OutputMode extends OutputModeBase {

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

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
        return bindec($bin);
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
        return bindec($bin);
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
        return bindec($bin);
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
        return bindec($bin);
    }

    public function getHeatPumpMode() {
        return substr($this->heat_pump, 0, 8);
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
        return bindec($bin);
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
        $bin = substr($this->heater_resister, 8, 8);
        return bindec($bin);
    }

    public function get3wayMode() {
        return substr($this->three_way_valve, 0, 8);
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
        return substr($this->backflow_valve, 0, 8);
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

    public function toClient() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->module->country->code . $this->module->privincial->code . $this->module->distric->code . $this->module->customer_code);
        echo $id;
        die;
        $data = new \backend\models\DataClient();
        $data->module_id = $this->module_id;
        $data->ie_name = OUTPUT_MODE_CONFIG_HEADER;
        $data->data = OUTPUT_MODE_CONFIG_HEADER
                . $id
                . OUTPUT_MODE_HEADER
                . $this->convection_pump
                . $this->cold_water_supply_pump
                . $this->return_pump
                . $this->incresed_pressure_pump
                . $this->heat_pump
                . $this->heater_resister
                . $this->reserved
                . $this->three_way_valve
                . $this->backflow_valve;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        return $data->save(false);
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
        return $mode . " - " . $this->getHeaterResisTime();
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

    public function OperationLog() {
        $log = new \backend\models\OperationLog();
        $log->module_id = $this->module_id;
        $log->message = 'Output Mode Configuration message, sent by user ' . Yii::$app->user->identity->username;
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

    public function configLog() {
        $log = new \backend\models\ConfigurationLog();
        $log->module_id = $this->module_id;
        $log->created_by = Yii::$app->user->getId();
        $log->message = 'Load mode: ';
        $log->message .= 'Convection Pump (' . $this->getConvectionPumpDetail() . '); ';
        $log->message .= 'ColdWaterSupply Pump (' . $this->getColdWaterSupplyPumpDetail() . '); ';
        $log->message .= 'Return Pump (' . $this->getReturnPumpDetail() . '); ';
        $log->message .= 'IncresedPressure Pump (' . $this->getIncresedPressurePumpDetail() . '); ';
        $log->message .= 'Heat Pump (' . $this->getHeatPumpDetail() . '); ';
        $log->message .= 'HeaterResister Pump (' . $this->getHeaterResisterDetail() . '); ';
        $log->message .= 'ThreeWay (' . $this->getThreeWayDetail() . '); ';
        $log->message .= 'BlakflowValve (' . $this->getBlakflowValveDetail() . ')';
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

}
