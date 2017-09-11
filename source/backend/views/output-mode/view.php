<?php

use yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OutputMode */
backend\assets\BootstrapAsset::register($this);
$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
?>
<div class="diagram">
    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
    <div class="container-all input-disable">      
        <?=
        $this->render('_form', [
            'model' => $model,
        ])
        ?>   
        <div class="row100" style="text-align:center">
            <p>
                <?= Html::a(Yii::t('backend', 'SETTING'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            </p>
        </div>
    </div>
</div>
