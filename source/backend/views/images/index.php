<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Images');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-index">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Images',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
    ?>
            <?= AwsGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'module_id',
            'image_path',
            'created_at',
            'created_by',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
        <?php 
    Pjax::end();
    ?>
</div>
