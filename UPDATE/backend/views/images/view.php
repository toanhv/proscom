<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Images */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Images'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="images-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'module_id',
            'image_path',
            'created_at',
            'created_by',
    ],
    ]) ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>
</div>
