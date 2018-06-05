<?php

namespace backend\models;

use Yii;
use yii\base\Model;

/**
 * Login form
 */
class ModuleStatusForm extends Model {

    public $captcha;

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            // username and password are both required
            [['captcha'], 'required'],
            [['captcha'], 'trim'],
            ['captcha', 'captcha'],
        ];
    }

}
