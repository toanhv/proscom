<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "sensor".
 *
 * @property string $id
 * @property string $module_id
 * @property string $cam_bien_dan_thu
 * @property string $cam_bien_bon_solar
 * @property string $cam_bien_muc_nuoc_bon_solar
 * @property string $cam_bien_nhiet_do_bon_gia_nhiet
 * @property string $cam_bien_ap_suat_bon_gia_nhiet
 * @property string $cam_bien_buc_xa_dan_thu
 * @property string $cam_bien_nhiet_dinh_bon_solar
 * @property string $cam_bien_tran
 * @property string $cam_bien_nhiet_do_duong_ong_2
 * @property string $du_phong
 * @property string $created_at
 * @property string $cam_bien_ap_suat_duong_ong
 * @property string $cam_bien_nhiet_do_duong_ong_1
 *
 * @property ModulesDB $module
 */
class SensorDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sensor';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id'], 'required'],
            [['module_id'], 'integer'],
            [['created_at'], 'safe'],
            [['cam_bien_dan_thu', 'cam_bien_bon_solar', 'cam_bien_muc_nuoc_bon_solar', 'cam_bien_nhiet_do_bon_gia_nhiet', 'cam_bien_ap_suat_bon_gia_nhiet', 'cam_bien_buc_xa_dan_thu', 'cam_bien_nhiet_dinh_bon_solar', 'cam_bien_tran', 'cam_bien_nhiet_do_duong_ong_2', 'cam_bien_ap_suat_duong_ong', 'cam_bien_nhiet_do_duong_ong_1'], 'string', 'max' => 50],
            [['du_phong'], 'string', 'max' => 200]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'module_id' => Yii::t('backend', 'Module ID'),
            'cam_bien_dan_thu' => Yii::t('backend', 'Cam Bien Dan Thu'),
            'cam_bien_bon_solar' => Yii::t('backend', 'Cam Bien Bon Solar'),
            'cam_bien_muc_nuoc_bon_solar' => Yii::t('backend', 'Cam Bien Muc Nuoc Bon Solar'),
            'cam_bien_nhiet_do_bon_gia_nhiet' => Yii::t('backend', 'Cam Bien Nhiet Do Bon Gia Nhiet'),
            'cam_bien_ap_suat_bon_gia_nhiet' => Yii::t('backend', 'Cam Bien Ap Suat Bon Gia Nhiet'),
            'cam_bien_buc_xa_dan_thu' => Yii::t('backend', 'Cam Bien Buc Xa Dan Thu'),
            'cam_bien_nhiet_dinh_bon_solar' => Yii::t('backend', 'Cam Bien Nhiet Dinh Bon Solar'),
            'cam_bien_tran' => Yii::t('backend', 'Cam Bien Tran'),
            'cam_bien_nhiet_do_duong_ong_2' => Yii::t('backend', 'Cam Bien Nhiet Do Duong Ong 2'),
            'du_phong' => Yii::t('backend', 'Du Phong'),
            'created_at' => Yii::t('backend', 'Created At'),
            'cam_bien_ap_suat_duong_ong' => Yii::t('backend', 'Cam Bien Ap Suat Duong Ong'),
            'cam_bien_nhiet_do_duong_ong_1' => Yii::t('backend', 'Cam Bien Nhiet Do Duong Ong 1'),
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
