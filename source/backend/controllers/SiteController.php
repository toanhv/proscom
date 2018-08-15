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

    public function actionRefresh($id) {
        $this->layout = false;
        $cache = Yii::$app->cache;
        $key = 'refresh_timer_' . $id;
        if ($id) {
            $module = \backend\models\Modules::find()->where(['id' => intval($id)])->one();
        } else {
            $module = \backend\models\Modules::find()->orderBy(['updated_at' => SORT_DESC])->one();
        }
        if ($module) {
            if ($cache->get($key) && strtotime($cache->get($key)) >= strtotime($module->updated_at)) {
                return 0;
            } else {
                $cache->set($key, $module->updated_at, 86400);
                return 1;
            }
        }
        return 0;
    }

}
