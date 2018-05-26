<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "add_params".
 *
 * @property string $id
 * @property string $module_id
 * @property string $luong_nuoc_da_lam_nong
 * @property string $luong_dien_tieu_thu
 * @property string $so_tien_tiet_kiem
 * @property string $luong_khi_thai_co2_giam
 *
 * @property ModulesDB $module
 */
class AddParamsDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'add_params';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id'], 'integer'],
            [['luong_nuoc_da_lam_nong', 'luong_dien_tieu_thu', 'so_tien_tiet_kiem', 'luong_khi_thai_co2_giam'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'module_id' => Yii::t('backend', 'Module'),
            'luong_nuoc_da_lam_nong' => Yii::t('backend', 'Lượng nước đã làm nóng'),
            'luong_dien_tieu_thu' => Yii::t('backend', 'Lượng điện tiêu thụ'),
            'so_tien_tiet_kiem' => Yii::t('backend', 'Số tiền tiết kiệm'),
            'luong_khi_thai_co2_giam' => Yii::t('backend', 'Lượng khí thải CO2 giảm'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(ModulesDB::className(), ['id' => 'module_id']);
    }
}
