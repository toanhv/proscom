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

    <button type="submit" class="btn-reprt btn-primary">Report</button>

    <?php ActiveForm::end(); ?>

</div>
