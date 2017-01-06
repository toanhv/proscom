<?php

namespace backend\models;

use common\models\ParamConfigBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use Yii;

class ParamConfig extends ParamConfigBase {

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

    public function getConvectionTemp() {
        return bindec($this->convection_pump);
    }

    public function getCwsplv1() {
        return bindec(substr($this->cold_water_supply_pump, 0, 8));
    }

    public function getCwsplv2() {
        return bindec(substr($this->cold_water_supply_pump, 8, 8));
    }

    public function getReturnPumpBegin() {
        return bindec(substr($this->return_pump, 0, 8)) . ':' . bindec(substr($this->return_pump, 8, 8));
    }

    public function getReturnPumpEnd() {
        return bindec(substr($this->return_pump, 16, 8)) . ':' . bindec(substr($this->return_pump, 24, 8));
    }

    public function getReturnPumpDeltat() {
        return bindec(substr($this->return_pump, 32, 8));
    }

    public function getPressurePumpP1() {
        return bindec($this->incresed_pressure_pump);
    }

    public function getHeatPumpT1() {
        return bindec($this->heat_pump);
    }

    public function getHeaterResisT1() {
        return bindec(substr($this->heat_resistor, 0, 8));
    }

    public function getHeaterResisDelay() {
        return bindec(substr($this->heat_resistor, 8, 8));
    }

    public function get3wayBeginTime() {
        return bindec(substr($this->three_way_valve, 0, 8)) . ':' . bindec(substr($this->three_way_valve, 8, 8));
    }

    public function get3wayEndTime() {
        return bindec(substr($this->three_way_valve, 16, 8)) . ':' . bindec(substr($this->three_way_valve, 24, 8));
    }

    public function get3wayTempDelta() {
        return bindec(substr($this->three_way_valve, 32, 8));
    }

    public function getBackflowTemp() {
        return bindec($this->backflow_valve);
    }

    public function toClient() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->module->country->code . $this->module->privincial->code . $this->module->distric->code . $this->module->customer_code);
        $data = new \backend\models\DataClient();
        $data->module_id = $this->module_id;
        $data->ie_name = PARAMETER_CONFIG_HEADER;
        $data->data = PARAMETER_CONFIG_HEADER
                . $id
                . PARAMETER_HEADER
                . $this->convection_pump
                . $this->cold_water_supply_pump
                . $this->return_pump
                . $this->incresed_pressure_pump
                . $this->heat_pump
                . $this->heat_resistor
                . $this->three_way_valve
                . $this->backflow_valve;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        return $data->save(false);
    }

    public function OperationLog() {
        $log = new \backend\models\OperationLog();
        $log->module_id = $this->module_id;
        $log->message = 'Parameter Configuration message, sent by user ' . Yii::$app->user->identity->username;
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

    public function configLog() {
        $log = new \backend\models\ConfigurationLog();
        $log->module_id = $this->module_id;
        $log->created_by = Yii::$app->user->getId();
        $log->message = 'Paramater: ';
        $log->message .= 'Convection Pump (' . $this->getConvectionTemp() . ')';
        $log->message .= '; Cold Water Supply Pump (Water level M1: ' . $this->getCwsplv1() . ' - Water level M2: ' . $this->getCwsplv2() . ')';
        $log->message .= '; Return Pump (Begin ilde time: ' . $this->getReturnPumpBegin() . ' - End ilde time: ' . $this->getReturnPumpEnd() . ' - Rang to turn on the pump: ' . $this->getReturnPumpDeltat() . ')';
        $log->message .= '; Increase Pressure Pump (Pressure to turn on the pump: ' . $this->getPressurePumpP1() . ')';
        $log->message .= '; Heat Pump (Temperature to turn on the pump: ' . $this->getHeatPumpT1() . ')';
        $log->message .= '; Heater Resistor (Temperature to turn on the Resistor: ' . $this->getHeaterResisT1() . ' - Delay time to return on Resistor: ' . $this->getHeaterResisDelay() . ')';
        $log->message .= '; Three way Valve (Begin time ilde: ' . $this->get3wayBeginTime() . ' - End time ilde: ' . $this->get3wayEndTime() . ' - Rang to change direction: ' . $this->get3wayTempDelta() . ')';
        $log->message .= '; Backflow Valve (Temperature value to open Valve: ' . $this->getBackflowTemp() . ')';
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

}
