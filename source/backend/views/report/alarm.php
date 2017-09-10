<?php
/* @var $this View */

use dosamigos\chartjs\ChartJs;
use yii\helpers\Html;
use yii\web\View;

$this->title = 'Alarms Report';
?>
<div class="site-index">
    <div class="body-content">
        <form method="post" action="/report/alarm" id="report-sensor-alarm">
            <div class="params">
                <h3 class="title"><?php echo $module->getModuleId() . ' - ' . Html::encode($module->name); ?></h3>
                <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
                <?php echo Yii::t('backend', 'From date'); ?>:
                <input type="text" name="from" id="report_from" value="<?php echo $from ?>">
                <?php echo Yii::t('backend', 'To date'); ?>:
                <input type="text" name="to" id="report_to" value="<?php echo $to ?>">

                <button type="submit" name="export" value="0" class="btn-reprt btn-primary"><?php echo Yii::t('backend', 'Report'); ?></button>
                <button type="submit" name="export" value="1" class="btn-reprt btn-primary"><?php echo Yii::t('backend', 'Excel'); ?></button>
            </div>
        </form>
        <br/>
        <?php
        $label = array();
        $quanhiet = array();
        $quaapsuat = array();
        $tranbe = array();
        $matdien = array();
        foreach ($alarms as $item) {
            $label[] = $item->created_at;
            $quanhiet[] = $item->qua_nhiet == '00' ? 0 : 1;
            $quaapsuat[] = $item->qua_ap_suat == '00' ? 0 : 1;
            $tranbe[] = $item->tran_be == '00' ? 0 : 1;
            $matdien[] = $item->mat_dien == '00' ? 0 : 1;
        }
        echo '<div class="sensor-report" style="border-color: ' . $borderColor . ';">';
        echo ChartJs::widget([
            'type' => 'line',
            'options' => [
                'responsive' => true,
                'maintainAspectRatio' => true,
            ],
            'data' => [
                'labels' => $label,
                'datasets' => [
                    [
                        'label' => Yii::t('backend', 'Over heat'),
                        'borderWidth' => 2,
                        'tension' => 0,
                        'capBezierPoints' => true,
                        'fill' => false,
                        'stepped' => true,
                        'spanGaps' => true,
                        'data' => $quanhiet,
                        'borderColor' => "rgba(66,110,134,1)",
                    ],
                    [
                        'label' => Yii::t('backend', 'Over pressure'),
                        'tension' => 0,
                        'capBezierPoints' => true,
                        'fill' => false,
                        'stepped' => true,
                        'spanGaps' => true,
                        'borderWidth' => 2,
                        'data' => $quaapsuat,
                        'borderColor' => "rgba(146,25,92,1)",
                    ],
                    [
                        'label' => Yii::t('backend', 'Over tank'),
                        'tension' => 0,
                        'capBezierPoints' => true,
                        'fill' => false,
                        'stepped' => true,
                        'spanGaps' => true,
                        'borderWidth' => 2,
                        'data' => $tranbe,
                        'borderColor' => "rgba(53,161,77,1)",
                    ],
                    [
                        'label' => Yii::t('backend', 'Lost supply'),
                        'tension' => 0,
                        'capBezierPoints' => true,
                        'fill' => false,
                        'stepped' => true,
                        'spanGaps' => true,
                        'borderWidth' => 2,
                        'data' => $matdien,
                        'borderColor' => "rgba(0, 0, 255, 0.3)",
                    ]
                ]
            ]
        ]);
        echo '</div>';
        ?>
    </div>
</div>
