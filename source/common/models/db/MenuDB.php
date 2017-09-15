<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $name
 * @property string $name_vi
 * @property integer $parent
 * @property string $route
 * @property integer $order
 * @property string $data
 * @property string $icon
 * @property integer $type
 *
 * @property MenuDB $parent0
 * @property MenuDB[] $menus
 */
class MenuDB extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['parent', 'order', 'type'], 'integer'],
            [['data', 'icon'], 'string'],
            [['name', 'name_vi'], 'string', 'max' => 128],
            [['route'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'name' => Yii::t('backend', 'Name'),
            'name_vi' => Yii::t('backend', 'Name Vi'),
            'parent' => Yii::t('backend', 'Parent'),
            'route' => Yii::t('backend', 'Route'),
            'order' => Yii::t('backend', 'Order'),
            'data' => Yii::t('backend', 'Data'),
            'icon' => Yii::t('backend', 'Icon'),
            'type' => Yii::t('backend', 'Type'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(MenuDB::className(), ['id' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMenus()
    {
        return $this->hasMany(MenuDB::className(), ['parent' => 'id']);
    }
}
