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

    public function toClient() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->module->country->code . $this->module->privincial->code . $this->module->distric->code . $this->module->customer_code);
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
