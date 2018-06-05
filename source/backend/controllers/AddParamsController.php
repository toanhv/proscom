<?php

namespace backend\controllers;

use Yii;
use backend\models\AddParams;
use backend\models\AddParamsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AddParamsController implements the CRUD actions for AddParams model.
 */
class AddParamsController extends Controller {

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
     * Lists all AddParams models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new AddParamsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AddParams model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AddParams model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new AddParams();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing AddParams model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        $model = $this->findModel();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect('/modules/all-view');
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AddParams model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AddParams model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AddParams the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel() {
        $moduleId = \Yii::$app->session->get('module_id', 0);
        $model = AddParams::find()->where(['module_id' => $moduleId])->one();
        if (!$model) {
            $model = new AddParams();
            $model->module_id = $moduleId;
            $model->luong_nuoc_da_lam_nong = 0;
            $model->luong_dien_tieu_thu = 0;
            $model->so_tien_tiet_kiem = 0;
            $model->luong_khi_thai_co2_giam = 0;
        }
        return $model;
    }

}
