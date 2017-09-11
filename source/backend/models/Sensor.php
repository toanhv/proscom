<?php

namespace backend\models;

use Yii;

class Sensor extends \common\models\SensorBase {

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'module_id' => Yii::t('backend', 'Module'),
            'cam_bien_dan_thu' => Yii::t('backend', 'Solar panels temp'),
            'cam_bien_bon_solar' => Yii::t('backend', 'Bottom of Solar tank'),
            'cam_bien_muc_nuoc_bon_solar' => Yii::t('backend', 'Solar tank level'),
            'cam_bien_nhiet_do_bon_gia_nhiet' => Yii::t('backend', 'Heater tank temp'),
            'cam_bien_ap_suat_bon_gia_nhiet' => Yii::t('backend', 'Heater tank pressure'),
            'cam_bien_buc_xa_dan_thu' => Yii::t('backend', 'Lingh intensity'),
            'cam_bien_nhiet_dinh_bon_solar' => Yii::t('backend', 'Top of Solar tank temp'),
            'cam_bien_tran' => Yii::t('backend', 'Over tank'),
            'cam_bien_nhiet_do_duong_ong_2' => Yii::t('backend', 'Pipeline temp 2'),
            'du_phong' => Yii::t('backend', 'Environment Temp'),
            'created_at' => Yii::t('backend', 'Created At'),
            'cam_bien_ap_suat_duong_ong' => Yii::t('backend', 'Pipeline pressure'),
            'cam_bien_nhiet_do_duong_ong_1' => Yii::t('backend', 'Pipeline temp 1'),
        ];
    }

    public function getReport($from, $to, $moduleId) {
        $sensors = Sensor::find()->where([
                    '>=', 'created_at', $from
                ])->andWhere([
                    '<=', 'created_at', $to
                        //'<=', 'created_at', date('Y-m-d 23:59:59', strtotime($to))
                ])->andWhere([
                    'module_id' => intval($moduleId)
                ])->all();
        return $sensors;
    }

}
