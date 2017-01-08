<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Modules */

$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
?>
<div class="info-diagram">
    <div class="check-account">
        <h1 class="title"><?php echo Html::encode($this->title); ?></h1>
        <p align="center">System mode: <?php echo $model->name; ?></p>
        <div class="row-check-account">
            <p align="center">
                <a href="javascript:void(0)" id="mode_<?php echo $model->id ?>" class="chosen">
                    <?php echo $model->getUrlImage(300, 220) ?>
                </a>
            </p>
            <p align="center">
                <a href="/mode/index" class="btn-link">Setting</a>
            </p>
        </div>
    </div>
</div>
<p>&nbsp;</p>
<div class="clearfix"></div>

<style>
    .chosen {
        background-color: #1caf9a !important;
    }
</style>
