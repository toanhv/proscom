<?php

use backend\models\ConfigurationLogSearch;
use yii\web\View;
use kartik\widgets\ActiveForm;

/* @var $this View */
/* @var $model ConfigurationLogSearch */
/* @var $form ActiveForm */
?>

<div class="configuration-log-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    From date: 
    <?=
    yii\jui\DatePicker::widget([
        'name' => 'fromDate',
        'dateFormat' => 'php:d-m-Y',
        'language' => 'vi',
            //'value' => \yii\helpers\Html::encode($fromTime)
    ])
    ?>
    To date: 
    <?=
    yii\jui\DatePicker::widget([
        'name' => 'toDate',
        'dateFormat' => 'php:d-m-Y',
        'language' => 'vi',
            //'value' => \yii\helpers\Html::encode($toTime)
    ])
    ?>
    <input type="submit" name="REPORT" value="Search"/>

    <?php ActiveForm::end(); ?>

</div>
