<?php

namespace backend\controllers;

use Yii;
use backend\models\Modules;
use backend\models\ModulesSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ModulesController implements the CRUD actions for Modules model.
 */
class ModulesController extends AppController {

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
     * Lists all Distric models.
     * @return mixed
     */
    public function actionList() {
        $searchModel = new ModulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Distric models.
     * @return mixed
     */
    public function actionViewList() {
        $searchModel = new ModulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('view-list', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists all Modules models.
     * @return mixed
     */
    public function actionIndex() {
        $searchModel = new ModulesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->post());

        \Yii::$app->session->set('module_alarm', null);
        \Yii::$app->session->set('module_id', null);

        if ($_GET['list'] && $_GET['list'] == 'menu') {
            return $this->render('index2', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
            ]);
        }
        $param = [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ];
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('index', $param);
        } else {
            return $this->render('index', $param);
        }
    }

    public function actionAllView() {
        $id = \Yii::$app->session->get('module_id', 0);
        if (!$id) {
            return $this->redirect('/');
        }
        $model = $this->findModel($id);

        $sensors = $model->sensors;
        $statuses = $model->moduleStatuses;
        //$alarms = $model->alarms;
        $addParams = $model->addParams;
        $mode = $model->mode;

        //check system status
        if ($model->mode_id && $_GET['reload'] == 'true') {
            $model->resetCache();
            $client = $model->checkSystemStatus();
            \backend\models\Modules::checkClientStatus($client->status, $client->id, $id, $sensors->created_at);
            return $this->redirect(['view', 'id' => $id]);
        }

        $module_alarm = null;
        //Yii::$app->session->set('module_alarm', null);
        $module_alarm['mat_dien']['status'] = $model->lost_supply ? 1 : 0;
        $module_alarm['mat_dien']['count'] = 0;
        $module_alarm['qua_ap_suat']['status'] = $model->over_pressure ? 1 : 0;
        $module_alarm['qua_ap_suat']['count'] = 0;
        $module_alarm['qua_nhiet']['status'] = $model->over_head ? 1 : 0;
        $module_alarm['qua_nhiet']['count'] = 0;
        $module_alarm['tran_be']['status'] = $model->over_tank > 3 ? 1 : 0;
        $module_alarm['tran_be']['count'] = 0;
        $module_alarm['lost_conn']['status'] = ($model->status == 4) ? 1 : 0;
        $module_alarm['lost_conn']['count'] = 0;
        Yii::$app->session->set('module_alarm', $module_alarm);

        $model->setVan_dien_tu_ba_nga_up();



        $param = [
            'model' => $model,
            'sensors' => $sensors,
            'statuses' => $statuses,
            //'alarms' => $alarms,
            'addParams' => $addParams,
            'id' => $id,
            'mode' => $mode->mode,
            'outputMode' => $model->outputModes,
            'module_hide' => \Yii::$app->params['module_hide']
        ];

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('_detail', $param);
        } else {
            return $this->render('view', $param);
        }
    }

    /**
     * Displays a single Modules model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        \Yii::$app->session->set('module_id', $id);
        return $this->redirect(['all-view']);
    }

    public function actionStatus() {
        $form = new \backend\models\ModuleStatusForm();

        $id = \Yii::$app->session->get('module_id', 0);
        $model = $this->findModel($id);

        if ($form->load(Yii::$app->request->post()) && $form->validate()) {
            $model->status = 0;
            if ($client = $model->SoftEmergencyStop()) {
                $status = \backend\models\Modules::checkClientStatus($client->status, $client->id, $id);
                if ($status == 3) {
                    $model->save(false, ['status']);
                }
                return $this->redirect(['all-view']);
            }
        }
        return $this->renderAjax('status', [
                    'model' => $form,
                    'module' => $model
        ]);
    }

    /**
     * Creates a new Modules model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Modules();
        $model->customer_code = $model->getMaxCustomerCode();

        $clients = \backend\models\Imsi::getClientRequest();

        if ($model->load(Yii::$app->request->post())) {
            while (strlen($model->customer_code) < 6) {
                $model->customer_code = '0' . $model->customer_code;
            }
            $imsi = $model->msisdn;
            if ($model->save()) {
                if ($model->toClient()) {
                    //timer counter
                    $timerCounter = new \backend\models\TimerCounter();
                    $timerCounter->module_id = $model->id;
                    $timerCounter->counter = 0;
                    $timerCounter->timer_1 = 0;
                    $timerCounter->timer_2 = 0;
                    $timerCounter->timer_3 = 0;
                    $timerCounter->created_at = new \yii\db\Expression('now()');
                    $timerCounter->save(false);
                    //load mode
                    $loadMode = new \backend\models\OutputMode();
                    $loadMode->module_id = $model->id;
                    $loadMode->save(false);
                    //Param config
                    $paramConfig = new \backend\models\ParamConfig();
                    $paramConfig->module_id = $model->id;
                    $paramConfig->save(false);

                    Yii::$app->session->setFlash('success', 'Set ID to module ' . $imsi . ' success!');
                    return $this->goHome();
                } else {
                    Yii::$app->session->setFlash('error', 'Set ID to module ' . $imsi . ' fail!');
                    $model->delete();
                    $newid = new \backend\models\Imsi();
                    $newid->imsi = $imsi;
                    $newid->save(false);
                }
            }
        }
        return $this->render('create', [
                    'model' => $model,
                    'clients' => $clients,
        ]);
    }

    /**
     * Updates an existing Modules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Modules model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionMode($id) {
        $model = $this->findModel($id);
        if (Yii::$app->request->isPost) {
            if ($model->status == 4 || $model->lost_supply) {
                Yii::$app->session->setFlash('error', 'Connection error!');
                return $this->redirect(['/modules/view', 'id' => $id]);
            }
            $values = Yii::$app->request->post();
            $model->mode_id = intval($values['mode_id']);
            if ($model->mode_id) {
                if ($model->save(false, ['mode_id'])) {
                    if ($client = $model->mode2Client()) {
                        $model->OperationLog();
                        $model->configLog();
                        \Yii::$app->session->set('module_id', $model->id);

                        \backend\models\Modules::checkClientStatus($client->status, $client->id, $model->id);

                        if ($values['url_back']) {
                            return $this->redirect($values['url_back']);
                        }
                        return $this->redirect('/output-mode/update');
                    } else {
                        Yii::$app->session->setFlash('success', 'Set System Mode fail!');
                    }
                }
            } else {
                Yii::$app->session->setFlash('error', 'You must choose one mode!');
            }
        }
        return $this->redirect(['/mode/index', 'module_id' => $model->id]);
    }

    /**
     * Deletes an existing Modules model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $model = $this->findModel($id);
        \backend\models\Imsi::deleteAll(['module_id' => $model->id]);
        $model->delete();
        $cache = \Yii::$app->cache;
        $key = 'findModel_module_' . $id;
        $cache->set($key, null);

        return $this->redirect(['index']);
    }

    /**
     * Finds the Modules model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Modules the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        $cache = \Yii::$app->cache;
        $key = 'findModel_module_' . $id;
        $data = $cache->get($key);

        if (!$data) {
            if (($data = Modules::findOne($id)) !== null) {
                $cache->set($key, $data, CACHE_TIME_OUT);
            } else {
                return $this->redirect('/');
            }
        }
        return $data;
    }

    public function actionAccountmanager() {
        $id = \Yii::$app->session->get('module_id', 0);
        if (!$id) {
            return $this->goHome();
        }
        $model = $this->findModel($id);
        $modules = Modules::getAll();
        if (Yii::$app->request->isPost) {
            $values = Yii::$app->request->post();
            if ($values['check']) {
                try {
                    $model->toClientManager();
                    $alert = "Send to module success!";
                } catch (Exception $e) {
                    $alert = "An error occurred";
                }
            }
            if ($values['pay']) {
                if ($values['card_info']) {
                    try {
                        //$model->toClientPay(trim($values['card_info']));
                        $model->toSim(trim($values['card_info']));
                        $alert = "Send to module success!";
                    } catch (Exception $e) {
                        $alert = "An error occurred";
                    }
                } else {
                    $alert = "You must enter card code!";
                }
            }
        }
        return $this->render('accountManager', [
                    'model' => $model,
                    'alert' => $alert,
                    'modules' => $modules
        ]);
    }

    public function actionLoadinfo($id) {
        $this->layout = false;
        $model = $this->findModel($id);
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        return [
            'money' => trim($model->money, '&&'),
            'data' => trim($model->data, '&&'),
        ];
    }

}
