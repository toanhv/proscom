<?php

namespace console\models;

use Yii;

class Modules extends \common\models\ModulesBase {

    public static function status() {
        $modules = \console\models\Modules::find()->where(['status' => [1, 3]])->all();
        foreach ($modules as $item) {
            $id = ID_HEADER . \common\socket\Socket::dec2bin($item->country->code . $item->privincial->code . $item->distric->code . $item->customer_code);
            $data = new \backend\models\DataClient();
            $data->module_id = $item->id;
            $data->ie_name = CHECK_SYSTEM_STATUS_HEADER;
            $data->data = CHECK_SYSTEM_STATUS_HEADER . $id;
            $data->status = 0;
            $data->created_at = new \yii\db\Expression('NOW()');
            $data->save(false);
        }
    }

}
