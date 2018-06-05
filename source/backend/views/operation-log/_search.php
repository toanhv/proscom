<?php

use kartik\widgets\ActiveForm;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OperationLogSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operation-log-search">

    <?php $form = ActiveForm::begin(['action' => ['index'], 'method' => 'post']); ?>

    From date 
    <?=
    yii\jui\DatePicker::widget([
        'model' => $model,
        'name' => $model->formName() . '[fromDate]',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->fromDate)
    ])
    ?>
    To date
    <?=
    yii\jui\DatePicker::widget([
        'model' => $model,
        'name' => $model->formName() . '[toDate]',
        'dateFormat' => 'php:Y-m-d',
        'language' => 'en',
        'value' => \yii\helpers\Html::encode($model->toDate)
    ])
    ?>

    <input name="<?php echo $model->formName(); ?>[message]" value="<?php echo Html::encode($model->message); ?>" type="text" placeholder="message filter">

    <button type="submit" class="btn-reprt btn-primary">Report</button>

    <?php ActiveForm::end(); ?>

</div>
