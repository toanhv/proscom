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
        $modules = \common\models\ModulesBase::findAll();
        foreach ($modules as $item) {
            //sensor
            $key = 'getSensors_module_' . $item->id;
            $cache->set($key, null);
            $item->sensors;
            //module id
            $key = 'Module_id_' . $this->id;
            $cache->set($key, null);
            $item->getModuleId();
        }
    }

}
