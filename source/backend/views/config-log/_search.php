<?php

use backend\models\ConfigurationLogSearch;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model ConfigurationLogSearch */
/* @var $form ActiveForm */
?>

<div class="operation-log-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'post']); ?>

    From date 
    <?=
    yii\jui\DatePicker::widget([
        'name' => 'fromDate',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->fromDate)
    ])
    ?>
    To date
    <?=
    yii\jui\DatePicker::widget([
        'name' => 'toDate',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->toDate)
    ])
    ?>

    <button type="submit" class="btn-reprt btn-primary">Report</button>

    <?php ActiveForm::end(); ?>

</div>
