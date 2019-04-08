<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class ModuleController extends Controller {

    public function actionStatus() {
        return \console\models\Modules::status();
    }

    public function actionCached() {
        $cache = \Yii::$app->cache;
        $modules = \common\models\ModulesBase::find()->all();
        foreach ($modules as $item) {
            //sensor
            $key = 'getSensors_module_' . $item->id;
            $cache->set($key, null);
            $item->sensors;
            //module id
            $key = 'Module_id_' . $this->id;
            $cache->set($key, null);
            $item->getModuleId();
            //find model
            $key = 'findModel_module_' . $this->id;
            $cache->set($key, null);
            $cache->set($key, $item, CACHE_TIME_OUT);
            //module status
            $key = 'getModuleStatuses_module_' . $this->id;
            $cache->set($key, null);
            $item->moduleStatuses;
            //alarm
            $key = 'getAlarms_module_' . $this->id;
            $cache->set($key, null);
            $item->alarms;
            //add param
            $key = 'getAddParams_module_' . $this->id;
            $cache->set($key, null);
            $item->addParams;
        }
    }

}
