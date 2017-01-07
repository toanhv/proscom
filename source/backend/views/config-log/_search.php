<?php

use backend\models\OperationLogSearch;
use kartik\widgets\ActiveForm;
use yii\helpers\Html;
use yii\jui\DatePicker;
use yii\web\View;
use yii\widgets\ActiveForm as ActiveForm2;

/* @var $this View */
/* @var $model OperationLogSearch */
/* @var $form ActiveForm2 */
?>

<div class="operation-log-search">

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?php
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'fromDate',
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    ?>

    <?php
    echo DatePicker::widget([
        'model' => $model,
        'attribute' => 'toDate',
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ]);
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
