<?php

use backend\models\ImsiSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ImsiSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Imsis');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imsi-index">
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'imsi',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{delete}'],
        ],
    ]);
    ?>
</div>
