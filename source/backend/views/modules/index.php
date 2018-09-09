<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModulesSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Home';
?>
<div class="module-view">
    <i class="fa fa-th-large" style="font-size:24px; color: #1caf9a; cursor: pointer;"></i>&nbsp;&nbsp;
    <i class="fa fa-align-justify" style="font-size:24px; cursor: pointer;"></i>
</div>
<div class="page-bar">
    <?php
    $form = ActiveForm::begin();
    ?>
    <ul class="page-breadcrumb">
        <li>
            <input id="modulessearch-name" name="ModulesSearch[name]" value="<?php echo Html::encode($searchModel->name); ?>" type="text" placeholder="<?php echo Yii::t('backend', 'Find module'); ?>">
        </li>
    </ul>   
    <?php ActiveForm::end(); ?>
</div>
<?php
yii\widgets\Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
?>
<div id="module-list" class="distric-index">
    <?=
    yii\grid\GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'ID',
                'content' => function ($data) {
                    return '<a href="/modules/view?id=' . $data->id . '">' . $data->getModuleId() . '<br>' . \yii\helpers\Html::encode($data->name) . '</a>';
                }
            ],
            [
                'label' => Yii::t('backend', 'Lingh intensity'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_buc_xa_dan_thu);
                }
            ],
            [
                'label' => Yii::t('backend', 'Environment Temp'),
                'content' => function ($data) {
                    return bindec(substr($data->sensors->du_phong, 0, 8));
                }
            ],
            [
                'label' => Yii::t('backend', 'Solar panels temp'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_dan_thu);
                }
            ],
            [
                'label' => Yii::t('backend', 'Top of Solar tank'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_nhiet_dinh_bon_solar);
                }
            ],
            [
                'label' => Yii::t('backend', 'Bottom of Solar tank'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_bon_solar);
                }
            ],
            [
                'label' => Yii::t('backend', 'Heater tank temp'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_nhiet_do_bon_gia_nhiet);
                }
            ],
            [
                'label' => Yii::t('backend', 'Heater tank pressure'),
                'content' => function ($data) {
                    return bindec($data->sensors->cam_bien_ap_suat_bon_gia_nhiet);
                }
            ],
            [
                'label' => Yii::t('backend', 'Trạng thái'),
                'format' => 'html',
                'content' => function ($data) {
                    return $data->moduleStatus();
                }
            ],
        ],
    ]);
    ?>
</div>
<?php
yii\widgets\Pjax::end();
?>

<?php
$script = <<< JS
    $(document).ready(function () {
        //page_reload(0, '/');
    });
JS;
$this->registerJs($script);
?>
