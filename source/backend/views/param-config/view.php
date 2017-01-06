<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\ParamConfig */

$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="param-config-view">

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
                'format' => 'html',
                'value' => $model->getConvectionTemp(),
            ],
            [
                'label' => 'Cold Water Supply Pump',
                'format' => 'html',
                'value' => 'Water level M1: ' . $model->getCwsplv1() . ' - Water level M2: ' . $model->getCwsplv2(),
            ],
            [
                'label' => 'Return Pump',
                'format' => 'html',
                'value' => 'Begin ilde time: ' . $model->getReturnPumpBegin() . '<br>End ilde time: ' . $model->getReturnPumpEnd() . '<br>Rang to turn on the pump: ' . $model->getReturnPumpDeltat(),
            ],
            [
                'label' => 'Incresed Pressure Pump',
                'format' => 'html',
                'value' => 'Pressure to turn on the pump: ' . $model->getPressurePumpP1(),
            ],
            [
                'label' => 'Heat Pump',
                'format' => 'html',
                'value' => 'Temperature to turn on the pump: ' . $model->getHeatPumpT1(),
            ],
            [
                'label' => 'Heat Resistor',
                'format' => 'html',
                'value' => 'Temperature to turn on the Resistor: ' . $model->getHeaterResisT1() . '<br>Delay time to return on Resistor: ' . $model->getHeaterResisDelay(),
            ],
            [
                'label' => 'Three Way Valve',
                'format' => 'html',
                'value' => 'Begin time ilde: ' . $model->get3wayBeginTime() . '<br>End time ilde: ' . $model->get3wayEndTime() . '<br>Rang to change direction: ' . $model->get3wayTempDelta(),
            ],
            [
                'label' => 'Backflow Valve',
                'format' => 'html',
                'value' => 'Temperature value to open Valve: ' . $model->getBackflowTemp(),
            ],
        ],
    ])
    ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Setting'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
