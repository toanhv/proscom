<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */
$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<h3 class="text-center"><?php echo $idModule . ' - ' . Html::encode($module->name); ?></h3>
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
                    <?= Html::a(Yii::t('backend', 'Setting'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </p>
            </div>
        </div>         
    </div>
</div>
