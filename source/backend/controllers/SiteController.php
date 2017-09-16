<?php

namespace backend\controllers;

use Yii;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends AppController {

    public $layout = 'default';

    /**
     * @inheritdoc
     */
    public function actions() {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'transparent' => true,
                'minLength' => 6,
                'maxLength' => 8,
            ],
        ];
    }

    public function actionIndex() {
        $this->layout = 'main';
        if (!Yii::$app->user->isGuest) {
            $searchModel = new \backend\models\ModulesSearch();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
        $this->redirect('login');
    }

    public function actionLogin() {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                        'model' => $model,
            ]);
        }
    }

    public function actionLanguage() {
        if (\Yii::$app->language == 'vi') {
            $lang = 'en';
        } else {
            $lang = 'vi';
        }
        \Yii::$app->language = $lang;
        \Yii::$app->session->set('lang', $lang);

        return $this->redirect(Yii::$app->request->queryParams['ref']);
    }

    public function actionLogout() {
        Yii::$app->user->logout();

        return $this->goHome();
    }

}
