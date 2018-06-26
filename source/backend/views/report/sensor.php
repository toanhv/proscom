<?php
/* @var $this View */

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Sensor Report';
?>
<div class="site-index">
    <div class="body-content">
        <form method="post" action="/report/index" id="report-sensor-alarm">
            <div class="params">
                <h3 class="title">ID: <?php echo $module->getModuleId() . ' - ' . Html::encode($module->name); ?></h3>
                <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>"/>
                From:
                <input type="text" name="from" id="report_from" value="<?php echo $from ?>" autocomplete="off"/>
                To:
                <input type="text" name="to" id="report_to" value="<?php echo $to ?>" autocomplete="off"/>

                <button type="submit" name="export" value="0" class="btn-reprt btn-primary">Report</button>
                <button type="submit" name="export" value="1" class="btn-reprt btn-primary">Excel</button>
            </div>
        </form>
        <br/>
        <?php
        $sensorChart = [];
        $sensorItem = [
            'cam_bien_buc_xa_dan_thu',
            'moi_truong',
            'cam_bien_dan_thu',
            'cam_bien_nhiet_dinh_bon_solar',
            'cam_bien_bon_solar',
            'cam_bien_muc_nuoc_bon_solar',
            'cam_bien_nhiet_do_bon_gia_nhiet',
            'cam_bien_ap_suat_bon_gia_nhiet',
            'cam_bien_ap_suat_duong_ong',
            'cam_bien_nhiet_do_duong_ong_1',
            'cam_bien_nhiet_do_duong_ong_2'
        ];

        foreach ($sensorItem as $sensorName) {
            foreach ($sensors as $item) {
                $sensorChart[$sensorName]['title'] = $item->attributeLabels()[$sensorName];
                $sensorChart[$sensorName]['color'] = "rgba(" . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . "," . rand(0, 255) . ")";
                $sensorChart[$sensorName]['labels'][] = $item->created_at;
                if ($sensorName == 'sensorName') {
                    $sensorChart[$sensorName]['data'][] = bindec(substr($item->du_phong, 0, 8));
                } else {
                    $sensorChart[$sensorName]['data'][] = bindec($item->$sensorName);
                }
            }
        }

        foreach ($sensorChart as $chart => $value) {
            $borderColor = $value['color'];
            echo '<h4 style="color: ' . $borderColor . ';font-weight: bold;">' . $value['title'] . '</h4>';
            echo '<div class="sensor-report" style="border-color: ' . $borderColor . ';">';
            echo ChartJs::widget([
                'type' => 'line',
                'options' => [
                    'responsive' => true,
                    'maintainAspectRatio' => true,
                ],
                'data' => [
                    'labels' => $value['labels'],
                    'datasets' => [
                        [
                            'label' => $value['title'],
                            'borderWidth' => 1,
                            'tension' => 0,
                            'capBezierPoints' => true,
                            'fill' => false,
                            'stepped' => true,
                            'spanGaps' => true,
                            'data' => $value['data'],
                            'borderColor' => $borderColor,
                        ]
                    ]
                ]
            ]);
            echo '</div>';
        }
        ?>
    </div>
</div>
