<?php

namespace console\controllers;

use Yii;
use yii\console\Controller;

class ModuleController extends Controller {

    public function actionStatus() {
        return \console\models\Modules::status();
    }

}
