<?php

namespace common\models;

use Yii;

class AddParamsBase extends \common\models\db\AddParamsDB {

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'module_id' => Yii::t('backend', 'Module'),
            'luong_nuoc_da_lam_nong' => Yii::t('backend', 'The water is heated'),
            'luong_dien_tieu_thu' => Yii::t('backend', 'Power Consumption'),
            'so_tien_tiet_kiem' => Yii::t('backend', 'Money of Saveings'),
            'luong_khi_thai_co2_giam' => Yii::t('backend', 'CO2 emissions decrease'),
        ];
    }

}
