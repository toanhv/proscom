<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModulesSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Home';
?>
<div style="margin-top: -25px; position: relative;">
    <i class="fa fa-th-large" style="font-size:24px; color: #1caf9a;"></i>&nbsp;&nbsp;
    <i class="fa fa-align-justify" style="font-size:24px"></i>
</div>
<div class="page-bar">
    <?php $form = ActiveForm::begin(); ?>
    <ul class="page-breadcrumb">
        <li><i class="fa fa-search"></i><a href="javascript:void(0);"><?php echo Yii::t('backend', 'Find module'); ?>&nbsp;</a></li>
        <li>
            <input id="modulessearch-name" name="ModulesSearch[name]" value="<?php echo Html::encode($searchModel->name); ?>" type="text">
        </li>
    </ul>   
    <?php ActiveForm::end(); ?>
</div>
<div id="module-icon" class="row modules">
    <?php
    $data = $dataProvider->getModels();
    if (!empty($data)) {
        foreach ($data as $val) {
            $url = 'javascript:void(0);';
            $img = $val->getImg();
            $alarm = ($_GET['alarm']) ? intval($_GET['alarm']) : 0;
            if ($alarm) {
                $continue = false;
                $alarmModel = $val->alarms;
                switch ($alarm) {
                    case 1:
                        if ($alarmModel->tran_be != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                    case 3:
                        if ($alarmModel->qua_nhiet != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                    case 4:
                        if ($alarmModel->qua_ap_suat != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                    case 5:
                        if ($alarmModel->mat_dien != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                }
                if ($continue) {
                    continue;
                }
            }
            if ($val->imsis->status == CONFIRM_STATUS) {
                $url = '/modules/view?id=' . $val->id;
                if ($img == MODULE_SETTING) {
                    $url = '/mode/index?module_id=' . $val->id;
                }
            }
            ?>
            <div class="col-md-4">
                <a href="<?php echo $url; ?>" title="<?php echo \yii\helpers\Html::encode($val->name); ?>">
                    <img class="img-responsive" src="<?php echo $img; ?>" alt="<?php echo \yii\helpers\Html::encode($val->name); ?>" />
                    <p>ID: <?php echo \yii\helpers\Html::encode($val->getModuleId()); ?></p>
                    <p><?php echo \yii\helpers\Html::encode($val->name); ?></p>
                </a>
            </div>
            <?php
        }
    }
    ?>
</div>
<div id="module-list" class="distric-index" style="display: none;">
    <?=
    yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'ID',
                'content' => function ($data) {
                    return '<a href="/modules/view?id=' . $data->id . '"><b>' . $data->getModuleId() . '</b><br><b>' . \yii\helpers\Html::encode($data->name) . '</b></a>';
                }
            ],
            [
                'label' => Yii::t('backend', 'Lingh intensity'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_buc_xa_dan_thu);
                }
            ],
            [
                'label' => Yii::t('backend', 'Environment Temp'),
                'content' => function ($data) {
                    return bindec($data->sensors->du_phong);
                }
            ],
            [
                'label' => Yii::t('backend', 'Solar panels temp'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_dan_thu);
                }
            ],
            [
                'label' => Yii::t('backend', 'Top of Solar tank'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_nhiet_dinh_bon_solar);
                }
            ],
            [
                'label' => Yii::t('backend', 'Bottom of Solar tank'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_bon_solar);
                }
            ],
            [
                'label' => Yii::t('backend', 'Heater tank temp'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_nhiet_do_bon_gia_nhiet);
                }
            ],
            [
                'label' => Yii::t('backend', 'Heater tank pressure'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_ap_suat_bon_gia_nhiet);
                }
            ],
        ],
    ]);
    ?>
</div>
