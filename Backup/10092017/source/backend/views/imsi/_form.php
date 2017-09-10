<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Imsi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="imsi-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'imsi')->textInput(['maxlength' => 20]) ?>

    <?= $form->field($model, 'module_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'module_id_assignment')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'created_by')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
