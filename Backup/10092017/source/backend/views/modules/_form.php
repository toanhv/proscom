<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Modules */
/* @var $form yii\widgets\ActiveForm */
$country = backend\models\Country::getAll();
$provincial = backend\models\Provincial::getAll();
$distric = backend\models\Distric::getAll();
?>

<div class="modules-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'customer_code')->textInput(['maxlength' => 6]) ?>

    <?= $form->field($model, 'msisdn')->dropDownList($clients)->label('Client request') ?>

    <?= $form->field($model, 'country_id')->dropDownList($country) ?>

    <?= $form->field($model, 'privincial_id')->dropDownList($provincial) ?>

    <?= $form->field($model, 'distric_id')->dropDownList($distric) ?>    

    <?= $form->field($model, 'address')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
