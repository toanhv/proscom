<?php

namespace common\models;

use Yii;
use yii\db\Expression;

class ModulesBase extends \common\models\db\ModulesDB {

    public function getImgUrl() {
        return $this->mode->image_path;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Customer Name'),
            'msisdn' => Yii::t('backend', 'Client request'),
            'country_id' => Yii::t('backend', 'Nation'),
            'privincial_id' => Yii::t('backend', 'Province/City'),
            'distric_id' => Yii::t('backend', 'City/District'),
            'customer_code' => Yii::t('backend', 'Customer Code'),
            'address' => Yii::t('backend', 'Address'),
            'alarm' => Yii::t('backend', 'Alarm'),
            'created_by' => Yii::t('backend', 'Created By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'money' => Yii::t('backend', 'Money'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsis() {
        return \common\models\ImsiBase::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSensors() {
        return \common\models\SensorBase::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimerCounters() {
        return \common\models\TimerCounterBase::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuntimeStatistics() {
        return \common\models\RuntimeStatisticsBase::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleStatuses() {
        return \common\models\ModuleStatusBase::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutputModes() {
        return \common\models\OutputModeBase::find()->where(['module_id' => $this->id])->orderBy(['updated_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamConfigs() {
        return \common\models\ParamConfigBase::find()->where(['module_id' => $this->id])->orderBy(['updated_at' => SORT_DESC])->one();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlarms() {
        return \common\models\AlarmBase::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
    }

    public function getModuleId() {
        return $this->country->code . $this->privincial->code . $this->distric->code . $this->customer_code;
    }

    public function checkSystemMode() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_SYSTEM_MODE_HEADER;
        $data->data = CHECK_SYSTEM_MODE_HEADER . $id;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function checkSystemStatus() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_SYSTEM_STATUS_HEADER;
        $data->data = CHECK_SYSTEM_STATUS_HEADER . $id;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function checkParametter() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_PARAMETER_HEADER;
        $data->data = CHECK_PARAMETER_HEADER . $id;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function checkTimerCounter() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_TIMER_COUNTER_HEADER;
        $data->data = CHECK_TIMER_COUNTER_HEADER . $id;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function checkOutputMode() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = CHECK_OUTPUT_MODE_HEADER;
        $data->data = CHECK_OUTPUT_MODE_HEADER . $id;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function SoftEmergencyStop() {
        $id = ID_HEADER . \common\socket\Socket::dec2bin($this->getModuleId());
        $data = new \backend\models\DataClient();
        $data->module_id = $this->id;
        $data->ie_name = SOFT_EMERGENCY_STOP_NOTIFY_HEADER;
        $data->data = SOFT_EMERGENCY_STOP_NOTIFY_HEADER . $id;
        $data->status = 0;
        $data->created_at = new Expression('NOW()');
        $data->save(false);
        return $data;
    }

    public function checkAlarm() {
        $alarm = $this->alarms;

        $return = 0;

        $module_alarm = Yii::$app->session->get('module_alarm', null);
        if (!is_array($module_alarm)) {
            $module_alarm['mat_dien']['status'] = 0;
            $module_alarm['mat_dien']['count'] = 0;
            $module_alarm['qua_ap_suat']['status'] = 0;
            $module_alarm['qua_ap_suat']['count'] = 0;
            $module_alarm['qua_nhiet']['status'] = 0;
            $module_alarm['qua_nhiet']['count'] = 0;
            $module_alarm['tran_be']['status'] = 0;
            $module_alarm['tran_be']['count'] = 0;
            $module_alarm['lost_conn']['status'] = 0;
            $module_alarm['lost_conn']['count'] = 0;
        }

        if ($this->status == 4) {
            $module_alarm['lost_conn']['status'] = 1;
            $module_alarm['lost_conn']['count'] += 1;
            $return = 1;
        }

        if ($alarm->qua_ap_suat == '11') {
            $module_alarm['qua_ap_suat']['status'] = 1;
            $module_alarm['qua_ap_suat']['count'] += 1;
            $return = 1;
        }
        if ($alarm->tran_be == '11') {
            $module_alarm['tran_be']['status'] = 1;
            $module_alarm['tran_be']['count'] += 1;
            $return = 1;
        }
        if ($alarm->mat_dien == '11') {
            $module_alarm['mat_dien']['status'] = 1;
            $module_alarm['mat_dien']['count'] += 1;
            $return = 1;
        }
        if ($alarm->qua_nhiet == '11') {
            $module_alarm['qua_nhiet']['status'] = 1;
            $module_alarm['qua_nhiet']['count'] += 1;
            $return = 1;
        }
        Yii::$app->session->set('module_alarm', $module_alarm);

        return $return;
    }

    public static function getStatusClient($clientId, $timeConfirm, $counter, $timeStart) {
        set_time_limit(max_execution_time);
        ini_set('max_execution_time', max_execution_time);
        ini_set('request_terminate_timeout', max_execution_time);
        sleep(TIME_OUT_REFRESH);
        $client = DataClientBase::find()->where(['id' => $clientId])->one();
        $status = $client->status;
        $endTime = strtotime(date('Y-m-d H:i:s'));
        if (in_array($status, [1, 0]) && ($endTime - $timeStart) < ($timeConfirm * $counter)) {
            sleep($timeConfirm);
            return self::getStatusClient($clientId);
        }

        return $status;
    }

    public static function checkClientStatus($status, $clientId, $moduleId) {
        ini_set('max_execution_time', max_execution_time);
        ini_set('request_terminate_timeout', max_execution_time);
        $timeStart = strtotime(date('Y-m-d H:i:s'));
        $timeConfirmModel = TimerCounterBase::find()->where(['module_id' => $moduleId])->orderBy('created_at desc')->one();
        $timeConfirm = $timeConfirmModel->timer_1 ? $timeConfirmModel->timer_1 : TIME_OUT_REFRESH;
        $counter = $timeConfirmModel->counter ? $timeConfirmModel->counter : 3;
        $status = self::getStatusClient($clientId, $timeConfirm, $counter, $timeStart);
        switch ($status) {
            case 1:
                Yii::$app->session->setFlash('error', 'The client has not responded!');
                break;
            case 3:
                Yii::$app->session->setFlash('success', 'Successfull!');
                break;
            case 4:
            case 0:
                Yii::$app->session->setFlash('error', 'Connection error!');
                break;
            default :
                Yii::$app->session->setFlash('error', 'An error occurred!');
                break;
        }
        return $status;
    }

}
