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

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <?=
    DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Convection Pump',
                'value' => $model->getConvectionPumpDetail() . ' min',
            ],
            [
                'label' => 'Cold Water Supply Pump',
                'value' => $model->getColdWaterSupplyPumpDetail() . ' min',
            ],
            [
                'label' => 'Return Pump',
                'value' => $model->getReturnPumpDetail() . ' min',
            ],
            [
                'label' => 'Incresed Pressure Pump',
                'value' => $model->getIncresedPressurePumpDetail() . ' min',
            ],
            [
                'label' => 'Heat Pump',
                'value' => $model->getHeatPumpDetail() . ' min',
            ],
            [
                'label' => 'Heater Resister',
                'value' => $model->getHeaterResisterDetail() . ' min',
            ],
            [
                'label' => 'Three Way',
                'value' => $model->getThreeWayDetail() . ' min',
            ],
            [
                'label' => 'Blakflow Valve',
                'value' => $model->getBlakflowValveDetail() . ' min',
            ],
        ],
    ])
    ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Setting'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
