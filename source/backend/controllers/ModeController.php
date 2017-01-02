<?php

namespace backend\controllers;

use backend\models\Mode;
use backend\models\Modules;
use backend\models\ModeSearch;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;

/**
 * ModeController implements the CRUD actions for Mode model.
 */
class ModeController extends AppController {

    public function behaviors() {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Mode models.
     * @return mixed
     */
    public function actionIndex() {
        $moduleId = \Yii::$app->session->get('module_id', 0);
        if (!$moduleId) {
            $moduleId = ($_GET['module_id']) ? intval($_GET['module_id']) : 0;
        }

        if (!$moduleId) {
            return $this->goHome();
        }

        $module = Modules::findOne(['id' => $moduleId]);

        if ($module && $module->mode_id && $_GET['reload'] == 'true') {
            $module->checkSystemMode();
            sleep(TIME_OUT_REFRESH);
            return $this->redirect(['index']);
        }

        $modes = Mode::find()->all();

        return $this->render('index', [
                    'module' => $module,
                    'modes' => $modes,
        ]);
    }

    /**
     * Displays a single Mode model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Mode();

        if ($model->load(Yii::$app->request->post())) {
            $model->image_path = UploadedFile::getInstance($model, 'image_path');
            $model->image_path = $model->upload();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('create', [
                    'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->image_path = UploadedFile::getInstance($model, 'image_path');
            $model->image_path = $model->upload();
            if ($model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Mode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Mode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    /**
     *   Author      :   quyet@webviet.vn
     *   Description : Giao diện hiển thị demo theo file ảnh thiết kế
     *   Date        : 28/08/2016
     */
    public function actionDesign() {
        return $this->render('design', [
        ]);
    }

}
