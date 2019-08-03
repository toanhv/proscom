<?php
$this->title = 'Overal View';
?>
<div class="output-mode-view">    
    <div class="info-diagram">
        <h3 class="title">ID: <?php echo $model->getModuleId() . ' - ' . \yii\helpers\Html::encode($model->name); ?></h3>        
    </div>
    <div class="clearfix"></div>
    <div class="diagram">
        <div class="container-all" id="container-all">
            <?php
            $param = [
                'model' => $model,
                'sensors' => $sensors,
                'statuses' => $statuses,
                'alarms' => $alarms,
                'addParams' => $addParams,
                'id' => $id,
                'mode' => $mode,
                'outputMode' => $outputMode,
                'module_hide' => $module_hide
            ];
            echo $this->render('_controll', $param);
            ?>     
            <span id="output_mode_view_param">
                <?php
                echo $this->render('_detail', $param);
                ?>     
            </span>
        </div>
        <div class="buttom-content">
            <p>
                <span><?php echo Yii::t('backend', 'The water is heated'); ?> <b><?php echo number_format($addParams->luong_nuoc_da_lam_nong); ?></b> m3</span>
            </p>
            <p>
                <span><?php echo Yii::t('backend', 'Power Consumption'); ?> <b><?php echo number_format($addParams->luong_dien_tieu_thu); ?></b> Kwh</span>
            </p>
            <p>
                <span><?php echo Yii::t('backend', 'Money of Saveings'); ?> <b><?php echo number_format($addParams->so_tien_tiet_kiem); ?></b> triệu</span>
            </p>
            <p>
                <span><?php echo Yii::t('backend', 'CO2 emissions decrease'); ?> <b><?php echo number_format($addParams->luong_khi_thai_co2_giam); ?></b> tấn</span>
            </p>      
        </div>
    </div>      
</div>

<?php
$timeout = TIME_REFRESH;
$script = <<< JS
    setTimeout(function(){
        $.ajax({
            url: '/modules/all-view?is_ajax=1',
            success: function (html) {
               $('#output_mode_view_param').html(html);
            }
        });
    }, $timeout);
JS;
$this->registerJs($script);
?>
