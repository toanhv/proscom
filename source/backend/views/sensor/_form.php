<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sensor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sensor-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module_id')->dropDownList(backend\models\Modules::getAll()) ?>

    <?= $form->field($model, 'luong_nuoc_da_lam_nong')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'luong_dien_tieu_thu')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'so_tien_tiet_kiem')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'luong_khi_thai_co2_giam')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
