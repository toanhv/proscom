<?php

namespace backend\models;

use Yii;

class Alarm extends \common\models\AlarmBase {

    public function getReport($from, $to, $moduleId) {
        $alarms = Alarm::find()->where([
                    '>=', 'created_at', $from
                ])->andWhere([
                    '<=', 'created_at', date('Y-m-d 23:59:59', strtotime($to))
                ])->andWhere([
                    'module_id' => $moduleId
                ])->all();
        return $alarms;
    }

}
