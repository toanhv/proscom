<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SensorSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Sensors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensor-index">
    <?=
    GridView::widget([
        'layout' => "{items}",
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'module.name:html:Module',
            'luong_nuoc_da_lam_nong',
            'luong_dien_tieu_thu',
            'so_tien_tiet_kiem',
            'luong_khi_thai_co2_giam',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
