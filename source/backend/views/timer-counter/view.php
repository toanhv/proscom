<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */
$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="timer-counter-view">

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
            'counter',
            'timer_1',
            'timer_2',
            'timer_3',
        ],
    ])
    ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Setting'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    </p>
</div>
