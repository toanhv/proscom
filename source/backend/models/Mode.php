<?php

namespace backend\models;

use common\models\ModeBase;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;

class Mode extends ModeBase {

    public function behaviors() {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new Expression('NOW()'),
            ],
            [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['name', 'mode'], 'required'],
            [['updated_at', 'created_at'], 'safe'],
            [['updated_by', 'created_by'], 'integer'],
            [['mode'], 'integer', 'min' => 1, 'max' => 33],
            [['name'], 'unique'],
            [['mode'], 'unique'],
            [['image_path'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public static function getAll() {
        $country = \backend\models\Mode::find()->all();
        $data = [];
        foreach ($country as $item) {
            $data[$item->id] = \yii\helpers\Html::encode($item->name);
        }
        return $data;
    }

    public function upload() {
        if ($this->validate()) {
            if (!is_dir(\Yii::getAlias('@webroot') . '/uploads/mode')) {
                mkdir(\Yii::getAlias('@webroot') . '/uploads/mode', 0777, true);
                chmod(\Yii::getAlias('@webroot') . '/uploads/mode/', 0777);
            }
            $filePath = '/uploads/mode/' . md5(time()) . '.' . $this->image_path->extension;
            $this->image_path->saveAs(\Yii::getAlias('@webroot') . $filePath);

            return $filePath;
        }
        return '';
    }

    public function getUrlImage($width = 640, $height = 480) {
        return \yii\helpers\Html::img($this->image_path, ['width' => $width, 'height' => $height]);
    }

}
