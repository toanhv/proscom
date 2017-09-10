<?php

namespace common\models;

use Yii;

class CountryBase extends \common\models\db\CountryDB {

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('backend', 'ID'),
            'code' => Yii::t('backend', 'Mã'),
            'name' => Yii::t('backend', 'Tên'),
            'created_by' => Yii::t('backend', 'Tạo bởi'),
            'created_at' => Yii::t('backend', 'Tạo lúc'),
            'updated_by' => Yii::t('backend', 'Cập nhật bởi'),
            'updated_at' => Yii::t('backend', 'Cập nhật lúc'),
        ];
    }

}
