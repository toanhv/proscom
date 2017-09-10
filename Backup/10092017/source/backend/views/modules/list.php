<?php

use backend\models\ModulesSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ModulesSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Module list');
?>
<div class="distric-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'name',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{view} {delete}'],
        ],
    ]);
    ?>
</div>
