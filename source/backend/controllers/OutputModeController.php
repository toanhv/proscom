<?php

namespace backend\controllers;

use Yii;
use backend\models\OutputMode;
use backend\models\OutputModeSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\socket\Socket;

/**
 * OutputModeController implements the CRUD actions for OutputMode model.
 */
class OutputModeController extends AppController {

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
     * Lists all OutputMode models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new OutputModeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single OutputMode model.
     * @param string $id
     * @return mixed
     */
    public function actionView() {
        $moduleId = \Yii::$app->session->get('module_id', 0);
        if (!$moduleId) {
            return $this->goHome();
        }
        $module = \backend\models\Modules::findOne($moduleId);
        if ($module && $module->outputModes) {
            $model = $this->findModel($module->outputModes->id);
        } else {
            return $this->goHome();
        }
        if ($module->mode_id && $_GET['reload'] == 'true') {
            $client = $module->checkOutputMode();
            \backend\models\Modules::checkClientStatus($client->status, $client->id, $moduleId);
            return $this->redirect(['view']);
        }
        return $this->render('view', [
                    'model' => $model,
        ]);
    }

    public function actionHome() {
        $moduleId = \Yii::$app->session->get('module_id', 0);
        if (!$moduleId) {
            return $this->goHome();
        }
        $moduleModel = \backend\models\Modules::findOne($moduleId);
        if ($moduleModel && $moduleModel->outputModes) {
            return $this->redirect(['update', 'id' => $moduleModel->outputModes->id]);
        }
        return $this->redirect(['create']);
    }

    /**
     * Updates an existing OutputMode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate() {
        $moduleId = \Yii::$app->session->get('module_id', 0);
        if (!$moduleId) {
            return $this->goHome();
        }
        $module = \backend\models\Modules::findOne($moduleId);
        if ($module->status == 4 || $module->lost_supply) {
            Yii::$app->session->setFlash('error', 'Connection error!');
            if ($values['url_back']) {
                return $this->redirect($values['url_back']);
            }
            return $this->redirect('/param-config/update');
        }
        if ($module && $module->outputModes) {
            $model = $this->findModel($module->outputModes->id);
        } else {
            return $this->goHome();
        }
        if ($module->mode_id && $_GET['reload'] == 'true') {
            $client = $module->checkOutputMode();
            \backend\models\Modules::checkClientStatus($client->status, $client->id, $moduleId);
            return $this->redirect(['update', 'id' => $id]);
        }

        if (Yii::$app->request->isPost) {
            $values = Yii::$app->request->post();
            //convection_pump - Bơm đối lưu
            $convectionPumptime = Socket::alldec2bin($values['convection_pump']['time'], 8) . BACKUP;
            $model->convection_pump = $values['convection_pump']['mode'] . $convectionPumptime;
            //cwsp_pump - Bơm cấp nước lạnh
            $cwspPumptime = Socket::alldec2bin($values['cwsp_pump']['time'], 8) . BACKUP;
            $model->cold_water_supply_pump = $values['cwsp_pump']['mode'] . $cwspPumptime;
            //return_pump - Bơm hồi đường ống
            $returnPumptime = Socket::alldec2bin($values['return_pump']['time'], 8) . BACKUP;
            $model->return_pump = $values['return_pump']['mode'] . $returnPumptime;
            //pressure_pump - Bơm tăng áp
            $pressurePumptime = Socket::alldec2bin($values['pressure_pump']['time'], 8);
            $model->incresed_pressure_pump = $values['pressure_pump']['mode'] . $pressurePumptime . BACKUP;
            //heat_pump - Bơm nhiệt bồn gia nhiệt
            $model->heat_pump = $values['heat_pump']['mode'] . BACKUP;
            //heater_resis - Điện trở nhiệt bồn gia nhiệt
            $heaterResisPumptime = Socket::alldec2bin($values['heater_resis']['time'], 8);
            $heaterResisPumptem = Socket::alldec2bin($values['heater_resis']['tem'], 8);
            $model->heater_resister = $values['heater_resis']['mode'] . $heaterResisPumptem . $heaterResisPumptime . BACKUP;
            //3way - Van ba ngả
            $model->three_way_valve = $values['three_way']['mode'] . BACKUP;
            //blakflow - Van một chiều
            $model->backflow_valve = $values['backflow']['mode'] . BACKUP;

            if ($model->save(false)) {
                if ($client = $model->toClient()) {
                    $model->OperationLog();
                    $model->configLog();

                    \backend\models\Modules::checkClientStatus($client->status, $client->id, $model->module_id);

                    if ($values['url_back']) {
                        return $this->redirect($values['url_back']);
                    }
                    return $this->redirect('/param-config/update');
                }
            }
        }
        return $this->render('update', [
                    'model' => $model,
        ]);
    }

    /**
     * Deletes an existing OutputMode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the OutputMode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return OutputMode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = OutputMode::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
