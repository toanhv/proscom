<?php

namespace backend\models;

use Yii;

class TimerCounter extends \common\models\TimerCounterBase {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['module_id'], 'required'],
            [['module_id'], 'integer'],
            [['counter'], 'integer', 'min' => 0],
            [['timer_1'], 'integer', 'min' => 5],
            [['timer_2'], 'integer', 'min' => 60],
            [['timer_3'], 'integer', 'min' => 180],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'module_id' => Yii::t('backend', 'Module'),
            'counter' => Yii::t('backend', 'Counter'),
            'timer_1' => Yii::t('backend', 'Confirm Timer'),
            'timer_2' => Yii::t('backend', 'Resend Timer'),
            'timer_3' => Yii::t('backend', 'Report Timer'),
            'created_at' => Yii::t('backend', 'Created at'),
        ];
    }

    public function toClient() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->module->country->code . $this->module->privincial->code . $this->module->distric->code . $this->module->customer_code);
        $data = new \backend\models\DataClient();
        $data->module_id = $this->module_id;
        $data->ie_name = TIMER_COUNTER_CONFIG_HEADER;
        $data->data = TIMER_COUNTER_CONFIG_HEADER
                . $id
                . TIMER_COUNTER_HEADER
                . \common\socket\Socket::alldec2bin($this->timer_1, 8)
                . \common\socket\Socket::alldec2bin($this->timer_2, 8)
                . \common\socket\Socket::alldec2bin($this->timer_3, 8)
                . \common\socket\Socket::alldec2bin($this->counter, 8);
        $data->status = 0;
        $data->created_at = new \yii\db\Expression('NOW()');
        $data->save(false);
        
        return $data;
    }

    public function OperationLog() {
        $log = new \backend\models\OperationLog();
        $log->module_id = $this->module_id;
        $log->message = 'Timer Counter Configuration message, sent by user ' . Yii::$app->user->identity->username;
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

    public function configLog() {
        $log = new \backend\models\ConfigurationLog();
        $log->module_id = $this->module_id;
        $log->created_by = Yii::$app->user->getId();
        $log->message = 'Timer/counter: ' . 'counter ' . $this->counter
                . '|Confirm Timer ' . $this->timer_1
                . '|Resend Timer ' . $this->timer_2
                . '|Report Timer ' . $this->timer_3;
        $log->created_time = new \yii\db\Expression('NOW()');
        $log->save(false);
    }

}
