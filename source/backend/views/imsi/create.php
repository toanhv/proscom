<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Imsi */

$this->title = Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Imsi',
]);
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Imsis'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="imsi-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
