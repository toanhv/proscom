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

    <?php
    $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
    ]);
    ?>

    <?=
    $form->field($model, 'fromDate')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label('From date');
    ?>

    <?=
    $form->field($model, 'toDate')->widget(\yii\jui\DatePicker::classname(), [
        'language' => 'en',
        'dateFormat' => 'yyyy-MM-dd',
    ])->label('To date');
    ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
