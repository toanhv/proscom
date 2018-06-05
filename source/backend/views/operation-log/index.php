<?php

use kartik\export\ExportMenu;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OperationLogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Operation Logs');
$this->params['breadcrumbs'][] = $this->title;
$module = $searchModel->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
?>
<h3 class="text-center">ID: <?php echo \yii\helpers\Html::encode($idModule . ' - ' . $module->name) ?></h3>
<div class="configuration-log-index">
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php
    $gridColumns = [
        ['class' => 'yii\grid\SerialColumn'],
        'module.name:raw:Module',
        'message',
        'created_time',
    ];

    echo ExportMenu::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
        'fontAwesome' => true,
        'asDropdown' => false,
        'target' => '_self',
        'showConfirmAlert' => false,
    ]) . "<hr>\n" .
    GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => $gridColumns,
    ]);
    ?>   
</div>
