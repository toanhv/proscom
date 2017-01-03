<?php

namespace backend\controllers;

use Yii;
use backend\models\OutputMode;
use backend\models\Modules;
use backend\models\DataClient;
use backend\models\OutputModeSearch;
use yii\web\Controller;
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
    public function actionView($id) {
        $model = $this->findModel($id);
        $module = $model->module;
        if ($module->mode_id && $_GET['reload'] == 'true') {
            $module->checkOutputMode();
            sleep(TIME_OUT_REFRESH);
            return $this->redirect(['view', 'id' => $id]);
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
        if ($module && $module->outputModes) {
            $model = $this->findModel($module->outputModes->id);
        } else {
            return $this->goHome();
        }
        if ($module->mode_id && $_GET['reload'] == 'true') {
            $module->checkOutputMode();
            sleep(TIME_OUT_REFRESH);
            return $this->redirect(['update', 'id' => $id]);
        }

        if (Yii::$app->request->isPost) {
            $values = Yii::$app->request->post();
            //convection_pump - Bơm đối lưu
            $convectionPumptime = Socket::alldec2bin($values['OutputMode']['convection_pump']['time'], 8) . BACKUP;
            if ($values['OutputMode']['convection_pump']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['convection_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['convection_pump']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['convection_pump']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['convection_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['convection_pump']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['convection_pump']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['convection_pump']['mode'] = MANUAL_B12;
                }
            }
            $model->convection_pump = $values['OutputMode']['convection_pump']['mode'] . $convectionPumptime;
            //cwsp_pump - Bơm cấp nước lạnh
            $cwspPumptime = Socket::alldec2bin($values['OutputMode']['cwsp_pump']['time'], 8) . BACKUP;
            if ($values['OutputMode']['cwsp_pump']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['cwsp_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['cwsp_pump']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['cwsp_pump']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['cwsp_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['cwsp_pump']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['cwsp_pump']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['cwsp_pump']['mode'] = MANUAL_B12;
                }
            }
            $model->cold_water_supply_pump = $values['OutputMode']['cwsp_pump']['mode'] . $cwspPumptime;
            //return_pump - Bơm hồi đường ống
            $returnPumptime = Socket::alldec2bin($values['OutputMode']['return_pump']['time'], 8) . BACKUP;
            if ($values['OutputMode']['return_pump']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['return_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['return_pump']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['return_pump']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['return_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['return_pump']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['return_pump']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['return_pump']['mode'] = MANUAL_B12;
                }
            }
            $model->return_pump = $values['OutputMode']['return_pump']['mode'] . $returnPumptime;
            //pressure_pump - Bơm tăng áp
            $pressurePumptime = Socket::alldec2bin($values['OutputMode']['pressure_pump']['time'], 8) . BACKUP;
            if ($values['OutputMode']['pressure_pump']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['pressure_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['pressure_pump']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['pressure_pump']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['pressure_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['pressure_pump']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['pressure_pump']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['pressure_pump']['mode'] = MANUAL_B12;
                }
            }
            $model->incresed_pressure_pump = $values['OutputMode']['pressure_pump']['mode'] . $pressurePumptime;
            //heat_pump - Bơm nhiệt bồn gia nhiệt
            //$heatPumptime = Socket::alldec2bin($values['OutputMode']['heat_pump']['time'], 8) . BACKUP;
            if ($values['OutputMode']['heat_pump']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['heat_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['heat_pump']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['heat_pump']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['heat_pump']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['heat_pump']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['heat_pump']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['heat_pump']['mode'] = MANUAL_B12;
                }
            }
            $model->heat_pump = $values['OutputMode']['heat_pump']['mode'] . BACKUP;
            //heater_resis - Điện trở nhiệt bồn gia nhiệt
            $heaterResisPumptime = Socket::alldec2bin($values['OutputMode']['heater_resis']['time'], 8) . BACKUP;
            if ($values['OutputMode']['heater_resis']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['heater_resis']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['heater_resis']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['heater_resis']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['heater_resis']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['heater_resis']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['heater_resis']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['heater_resis']['mode'] = MANUAL_B12;
                }
            }
            $model->heater_resister = $values['OutputMode']['heater_resis']['mode'] . '00000000' . $heaterResisPumptime;
            //3way - Van ba ngả
            //$twayPumptime = Socket::alldec2bin($values['OutputMode']['3way']['time'], 8) . BACKUP;
            if ($values['OutputMode']['3way']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['3way']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['3way']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['3way']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['3way']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['3way']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['3way']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['3way']['mode'] = MANUAL_B12;
                }
            }
            $model->three_way_valve = $values['OutputMode']['3way']['mode'] . BACKUP;
            //blakflow - Van một chiều
            //$blakflowPumptime = Socket::alldec2bin($values['OutputMode']['blakflow']['time'], 8) . BACKUP;
            if ($values['OutputMode']['blakflow']['mode'] == AUTO_B1) {
                if ($values['OutputMode']['blakflow']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['blakflow']['mode'] = AUTO_B2;
                }
            } elseif ($values['OutputMode']['blakflow']['mode'] == MANUAL_B1) {
                if ($values['OutputMode']['blakflow']['pump'] == PUMP_MASTER) {
                    $values['OutputMode']['blakflow']['mode'] = MANUAL_B2;
                }
                if ($values['OutputMode']['blakflow']['pump'] == PUMP_ALL) {
                    $values['OutputMode']['blakflow']['mode'] = MANUAL_B12;
                }
            }
            $model->backflow_valve = $values['OutputMode']['blakflow']['mode'] . BACKUP;

            if ($model->save(false)) {
                if ($model->toClient()) {
                    $model->OperationLog();
                    $model->configLog();
                    Yii::$app->session->setFlash('success', 'Set Load Mode to module success!');
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
