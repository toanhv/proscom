<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */

$idModule = $model->module->country->code . $model->module->privincial->code . $model->module->distric->code . $model->module->customer_code;
$this->title = $idModule . ' - ' . $model->module->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Timer Counters'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = Yii::t('backend', 'Update');
?>
<div class="timer-counter-update">

    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>

    <?=
    $this->render('_form', [
        'model' => $model,
    ])
    ?>

</div>
