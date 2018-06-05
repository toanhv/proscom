<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "images".
 *
 * @property string $id
 * @property string $module_id
 * @property string $image_path
 * @property string $created_at
 * @property integer $created_by
 *
 * @property ModulesDB $module
 * @property UserDB $createdBy
 */
class ImagesDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'images';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['module_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['image_path'], 'string', 'max' => 255]
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
            'image_path' => Yii::t('backend', 'Image Path'),
            'created_at' => Yii::t('backend', 'Created At'),
            'created_by' => Yii::t('backend', 'Created By'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(ModulesDB::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(UserDB::className(), ['id' => 'created_by']);
    }
}
