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
                'method' => 'post',
    ]);
    ?>

    From date
    <input type="text" name="ConfigurationLogSearch[fromDate]" id="fromDate" value="<?php echo $model->fromDate; ?>">

    To date
    <input type="text"  name="ConfigurationLogSearch[toDate]" id="toDate" value="<?php echo $model->toDate; ?>">

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
