<?php

namespace backend\models;

use Yii;
use yii\web\UploadedFile;

class Images extends \common\models\ImagesBase {

    /**
     * @var UploadedFile[]
     */
    public $imageFiles;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['module_id', 'created_by'], 'integer'],
            [['created_at'], 'safe'],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 5],
        ];
    }

    public function upload() {
        $moduleId = $this->module_id;
        $images = [];
        if ($this->validate()) {
            foreach ($this->imageFiles as $file) {
                $fileName = "uploads/modules/$moduleId/" . $file->baseName . '.' . $file->extension;
                $file->saveAs($fileName);
                $images[] = $fileName;
            }
        }
        return $images;
    }

}
