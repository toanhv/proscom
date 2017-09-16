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
        //'filterModel' => $searchModel,
        'columns' => [
            [
                'label' => 'ID',
                'content' => function ($data) {
                    return '<a href=""><b>' . $data->getModuleId() . '</b><br><b>' . \yii\helpers\Html::encode($data->name) . '</b></a>';
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
                    return bindec($data->sensors->du_phong);
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
        ],
    ]);
    ?>
</div>
