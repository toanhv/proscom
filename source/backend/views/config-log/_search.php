<?php

use backend\models\ConfigurationLogSearch;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model ConfigurationLogSearch */
/* @var $form ActiveForm */
?>

<div class="operation-log-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'get']); ?>

    From date 
    <?=
    yii\jui\DatePicker::widget([
        'model' => $model,
        'name' => 'ConfigurationLogSearch[fromDate]',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->fromDate)
    ])
    ?>
    To date
    <?=
    yii\jui\DatePicker::widget([
        'model' => $model,
        'name' => 'ConfigurationLogSearch[toDate]',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->toDate)
    ])
    ?>

    <button type="submit" class="btn-reprt btn-primary">Report</button>

    <?php ActiveForm::end(); ?>

</div>
