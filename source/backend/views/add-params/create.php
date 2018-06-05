<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\AddParams */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Add Params',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Add Params'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="add-params-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
