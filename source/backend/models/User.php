<?php

namespace backend\models;

use Yii;

class User extends \common\models\User {

    public static function getRoles() {
        $roles = \Yii::$app->authManager->getRoles();
        $data = null;
        foreach ($roles as $role) {
            $data[$role->name] = \yii\helpers\Html::encode($role->name);
        }
        return $data;
    }

    public static function getOneRole($name) {
        $roles = \Yii::$app->authManager->getRoles();
        foreach ($roles as $role) {
            if ($role->name == $name) {
                return $role;
            }
        }
        return null;
    }

}
