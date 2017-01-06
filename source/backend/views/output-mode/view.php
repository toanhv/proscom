<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\OutputMode */
$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="output-mode-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'ID',
                'value' => $idModule,
            ],
            'module.name',
            [
                'label' => 'Convection Pump',
                'value' => $model->getConvectionPumpDetail(),
            ],
            [
                'label' => 'Cold Water Supply Pump',
                'value' => $model->getColdWaterSupplyPumpDetail(),
            ],
            [
                'label' => 'Return Pump',
                'value' => $model->getReturnPumpDetail(),
            ],
            [
                'label' => 'Incresed Pressure Pump',
                'value' => $model->getIncresedPressurePumpDetail(),
            ],
            [
                'label' => 'Heat Pump',
                'value' => $model->getHeatPumpDetail(),
            ],
            [
                'label' => 'Heater Resister',
                'value' => $model->getHeaterResisterDetail(),
            ],
            [
                'label' => 'Three Way',
                'value' => $model->getThreeWayDetail(),
            ],
            [
                'label' => 'Blakflow Valve',
                'value' => $model->getBlakflowValveDetail(),
            ],
        ],
    ])
    ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Setting'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
