<?php

use kartik\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OperationLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operation-log-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']); ?>

    From date 
    <?=
    yii\jui\DatePicker::widget([
        'model' => $model,
        'name' => 'OperationLogSearch[fromDate]',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->fromDate)
    ])
    ?>
    To date
    <?=
    yii\jui\DatePicker::widget([
        'model' => $model,
        'name' => 'OperationLogSearch[toDate]',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->toDate)
    ])
    ?>

    <button type="submit" class="btn-reprt btn-primary">Report</button>

    <?php ActiveForm::end(); ?>

</div>
