<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\AddParamsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="add-params-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'luong_nuoc_da_lam_nong') ?>

    <?= $form->field($model, 'luong_dien_tieu_thu') ?>

    <?= $form->field($model, 'so_tien_tiet_kiem') ?>

    <?php // echo $form->field($model, 'luong_khi_thai_co2_giam') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
