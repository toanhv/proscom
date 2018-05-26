<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\AddParamsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Add Params');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-params-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => 'Add Params',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>
    <?=
    GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Module',
                'content' => function($data) {
                    return Html::encode($data->module->name);
                },
                'filter' => backend\models\Modules::getAll()
            ],
            'luong_nuoc_da_lam_nong',
            'luong_dien_tieu_thu',
            'so_tien_tiet_kiem',
            'luong_khi_thai_co2_giam',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
</div>
