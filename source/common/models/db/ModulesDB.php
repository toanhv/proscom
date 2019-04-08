<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "modules".
 *
 * @property string $id
 * @property string $name
 * @property string $msisdn
 * @property string $country_id
 * @property string $privincial_id
 * @property string $distric_id
 * @property string $customer_code
 * @property string $mode_id
 * @property string $money
 * @property string $data
 * @property string $address
 * @property string $alarm
 * @property string $password
 * @property integer $created_by
 * @property string $created_at
 * @property integer $updated_by
 * @property string $updated_at
 * @property integer $status
 * @property integer $over_tank
 * @property integer $lost_connection
 * @property integer $over_head
 * @property integer $over_pressure
 * @property integer $lost_supply
 *
 * @property AddParamsDB[] $addParams
 * @property AlarmDB[] $alarms
 * @property ConfigurationLogDB[] $configurationLogs
 * @property DataClientDB[] $dataClients
 * @property ImagesDB[] $images
 * @property ImsiDB[] $imsis
 * @property ModuleStatusDB[] $moduleStatuses
 * @property CountryDB $country
 * @property ProvincialDB $privincial
 * @property DistricDB $distric
 * @property UserDB $createdBy
 * @property UserDB $updatedBy
 * @property ModeDB $mode
 * @property OperationLogDB[] $operationLogs
 * @property OutputModeDB[] $outputModes
 * @property ParamConfigDB[] $paramConfigs
 * @property RuntimeStatisticsDB[] $runtimeStatistics
 * @property SensorDB[] $sensors
 * @property TimerCounterDB[] $timerCounters
 */
class ModulesDB extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'modules';
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'msisdn', 'country_id', 'privincial_id', 'distric_id', 'customer_code'], 'required'],
            [['country_id', 'privincial_id', 'distric_id', 'mode_id', 'created_by', 'updated_by', 'status', 'over_tank', 'lost_connection', 'over_head', 'over_pressure', 'lost_supply'], 'integer'],
            [['money', 'data'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'address', 'password'], 'string', 'max' => 255],
            [['msisdn'], 'string', 'max' => 15],
            [['customer_code'], 'string', 'max' => 100],
            [['alarm'], 'string', 'max' => 50],
            [['customer_code'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'msisdn' => Yii::t('backend', 'Msisdn'),
            'country_id' => Yii::t('backend', 'Country ID'),
            'privincial_id' => Yii::t('backend', 'Privincial ID'),
            'distric_id' => Yii::t('backend', 'Distric ID'),
            'customer_code' => Yii::t('backend', 'Customer Code'),
            'mode_id' => Yii::t('backend', 'Mode ID'),
            'money' => Yii::t('backend', 'số tiền trong sim'),
            'data' => Yii::t('backend', 'data 3G còn lại trong sim'),
            'address' => Yii::t('backend', 'Address'),
            'alarm' => Yii::t('backend', 'Alarm'),
            'password' => Yii::t('backend', 'Password'),
            'created_by' => Yii::t('backend', 'Created By'),
            'created_at' => Yii::t('backend', 'Created At'),
            'updated_by' => Yii::t('backend', 'Updated By'),
            'updated_at' => Yii::t('backend', 'Updated At'),
            'status' => Yii::t('backend', '0 - not been sent, 1 - sent; 3 - client confirm ok; 4 - connection error'),
            'over_tank' => Yii::t('backend', 'Cảm biến tràn'),
            'lost_connection' => Yii::t('backend', 'Mất kết nối'),
            'over_head' => Yii::t('backend', 'Quá nhiệt'),
            'over_pressure' => Yii::t('backend', 'Quá áp suất'),
            'lost_supply' => Yii::t('backend', 'Mất điện'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAddParams() {
        $cache = \Yii::$app->cache;
        $key = 'getAddParams_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = \common\models\AddParamsDB::find()->where(['module_id' => $this->id])->orderBy(['id' => SORT_DESC])->one();
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAlarms() {
        $cache = \Yii::$app->cache;
        $key = 'getAlarms_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = \common\models\AlarmDB::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getConfigurationLogs() {
        return $this->hasMany(ConfigurationLogDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDataClients() {
        return $this->hasMany(DataClientDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImages() {
        return $this->hasMany(ImagesDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImsis() {
        return $this->hasMany(ImsiDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModuleStatuses() {
        $cache = \Yii::$app->cache;
        $key = 'getModuleStatuses_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = \common\models\ModuleStatusDB::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry() {
        return $this->hasOne(CountryDB::className(), ['id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPrivincial() {
        return $this->hasOne(ProvincialDB::className(), ['id' => 'privincial_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDistric() {
        return $this->hasOne(DistricDB::className(), ['id' => 'distric_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy() {
        return $this->hasOne(UserDB::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy() {
        return $this->hasOne(UserDB::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMode() {
        $cache = \Yii::$app->cache;
        $key = 'getMode_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = $this->hasOne(ModeDB::className(), ['id' => 'mode_id']);
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOperationLogs() {
        return $this->hasMany(OperationLogDB::className(), ['module_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOutputModes() {
        $cache = \Yii::$app->cache;
        $key = 'getOutputModes_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = \common\models\OutputModeDB::find()->where(['module_id' => $this->id])->orderBy(['updated_at' => SORT_DESC])->one();
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParamConfigs() {
        $cache = \Yii::$app->cache;
        $key = 'getParamConfigs_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = \common\models\ParamConfigDB::find()->where(['module_id' => $this->id])->orderBy(['updated_at' => SORT_DESC])->one();
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRuntimeStatistics() {
        $cache = \Yii::$app->cache;
        $key = 'getRuntimeStatistics_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = $this->hasMany(RuntimeStatisticsDB::className(), ['module_id' => 'id']);
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSensors() {
        $cache = \Yii::$app->cache;
        $key = 'getSensors_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = \common\models\SensorDB::find()->where(['module_id' => $this->id])->orderBy(['created_at' => SORT_DESC])->one();
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTimerCounters() {
        $cache = \Yii::$app->cache;
        $key = 'getTimerCounters_module_' . $this->id;
        $data = $cache->get($key);

        if (!$data) {
            $data = $this->hasMany(TimerCounterDB::className(), ['module_id' => 'id']);
            $cache->set($key, $data, CACHE_TIME_OUT);
        }
        return $data;
    }

}
