<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ParamConfig */

$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = 'Param config';
?>
<h3 class="text-center">ID: <?php echo $idModule . ' - ' . Html::encode($module->name); ?></h3>
<div class="diagram">
    <div class="container-all">  
        <p><br></p>  
        <div class="control-main control-main-center input-disable">
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
</div>
