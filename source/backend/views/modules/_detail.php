<div class="left-content" style="background:url('<?php echo $model->getImgUrl(); ?>') no-repeat 0 0;">
    <div class="c-00 text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Lingh intensity'); ?>">
        <?php echo bindec($sensors->cam_bien_buc_xa_dan_thu); ?>
    </div>
    <div class="c-01">&nbsp;</div>

    <div class="c-02 text-04 environment" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Environment Temp'); ?>">
        <p><?php echo bindec(substr($sensors->du_phong, 0, 8)); ?>&deg;C</p>
    </div>

    <div class="c-02 text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Solar panels temp'); ?>">
        <p><?php echo bindec($sensors->cam_bien_dan_thu); ?>&deg;C</p>
    </div>    
    <div class="icon-02"><img src="/images/03.png"/></div>

    <div class="c-03 text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Top of Solar tank'); ?>">
        &nbsp;<p><?php echo bindec($sensors->cam_bien_nhiet_dinh_bon_solar); ?>&deg;C</p>
    </div>
    <div class="icon-03"><img src="/images/01.png"/></div>    

    <div class="c-04">&nbsp;</div>
    <div class="bg-04">
        <div class="ctn text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Solar tank level'); ?>">
            <?php $number = bindec($sensors->cam_bien_muc_nuoc_bon_solar); ?>
            <?php if ($number == 3) { ?>
                <span class="row-01"></span>
                <span class="row-02"></span>
                <span class="row-03"></span>
            <?php } elseif ($number == 2) { ?>
                <span class="row-02"></span>
                <span class="row-03"></span>
            <?php } elseif ($number == 1) { ?>
                <span class="row-03"></span>
            <?php } elseif ($number > 3) { ?>
                <span class="row-01" style="background-color: red"></span>
                <span class="row-02" style="background-color: red"></span>
                <span class="row-03" style="background-color: red"></span>
            <?php } ?>
        </div>
    </div>

    <div class="c-05 text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Bottom of Solar tank'); ?>">
        &nbsp;<p><?php echo bindec($sensors->cam_bien_bon_solar); ?>&deg;C</p>
    </div>
    <div class="icon-05"><img src="/images/01.png"/></div>    

    <?php if (!in_array($mode, [2])) { ?>
        <div class="c-06">&nbsp;</div>
        <div class="bg-06-green <?php echo $statuses->bom_doi_luu_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
        <div class="bg-06-red <?php echo $statuses->bom_doi_luu_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>   
    <?php } ?>

    <?php if (!in_array($mode, [3, 7, 8, 9])) { ?>
        <div class="c-07">&nbsp;</div>
        <div class="bg-07-green <?php echo $model->van_dien_tu_ba_nga_up == '00' ? 'bg-green-none' : 'bg-red-none' ?>" van_dien_tu_ba_nga_up="<?php echo $model->van_dien_tu_ba_nga_up; ?>"></div>
        <div class="bg-07-red <?php echo $model->van_dien_tu_ba_nga_down == '00' ? 'bg-green-none' : 'bg-red-none' ?>" van_dien_tu_ba_nga_down="<?php echo $model->van_dien_tu_ba_nga_down; ?>"></div>  
    <?php } ?>

    <?php if (!in_array($mode, [9])) { ?>
        <div class="c-08">&nbsp;
            <p class="text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Heater tank temp'); ?>">
                <?php echo bindec($sensors->cam_bien_nhiet_do_bon_gia_nhiet); ?>&deg;C
            </p>
        </div>
        <div class="icon-08"><img src="/images/03.png"/></div>    

        <div class="c-09">&nbsp;
            <p class="text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Heater tank pressure'); ?>">
                <?php echo common\helpers\Helpers::number2String(bindec($sensors->cam_bien_ap_suat_bon_gia_nhiet)); ?>B
            </p>
        </div>
        <div class="icon-09"><img src="/images/04.png"/></div>   
    <?php } ?>

    <?php if (!in_array($mode, [6, 8, 9])) { ?>
        <div class="c-10">&nbsp;</div>
        <div class="bg-10-red <?php echo $statuses->dien_tro_nhiet_bon_gia_nhiet_1 == '00' ? 'bg-green-none' : 'bg-red-none' ?>"></div>
        <div class="bg-10-green <?php echo $statuses->dien_tro_nhiet_bon_gia_nhiet_2 == '00' ? 'bg-green-none' : 'bg-red-none' ?>"></div>   
    <?php } ?>

    <?php if (!in_array($mode, [5, 7, 9])) { ?>
        <div class="c-11">&nbsp;</div> 
        <div class="bg-11 <?php echo $statuses->bom_nhiet_bon_gia_nhiet == '00' ? 'bg-green' : 'bg-red' ?>"></div>  
    <?php } ?>

    <div class="c-12">&nbsp;</div>
    <div class="bg-12-green <?php echo $statuses->bom_tang_ap_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
    <div class="bg-12-red <?php echo $statuses->bom_tang_ap_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>  

    <div class="c-13">&nbsp;
        <p class="text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Pipeline pressure'); ?>">
            <?php echo common\helpers\Helpers::number2String(bindec($sensors->cam_bien_ap_suat_duong_ong)); ?>B
        </p>
    </div>
    <div class="icon-13"><img src="/images/04.png"/></div>	

    <div class="c-14">&nbsp;
        <p class="text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Pipeline temp 1'); ?>">
            <?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_1); ?>&deg;C
        </p>
    </div>
    <div class="icon-14"><img src="/images/03.png"/></div>    

    <?php if (!in_array($mode, [4])) { ?>
        <div class="c-15">&nbsp;</div>
        <div class="bg-15-green <?php echo $statuses->bom_cap_nuoc_lanh_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
        <div class="bg-15-red <?php echo $statuses->bom_cap_nuoc_lanh_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div> 
    <?php } ?>

    <div class="c-16">&nbsp;</div>
    <div class="bg-16-green <?php echo $statuses->bom_hoi_duong_ong_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
    <div class="bg-16-red <?php echo $statuses->bom_hoi_duong_ong_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div> 

    <div class="c-17">&nbsp;
        <p class="text-04" data-toggle="tooltip" data-placement="right" title="<?php echo Yii::t('backend', 'Pipeline temp 2'); ?>">
            <?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_2); ?>&deg;C
        </p>
    </div>
    <div class="icon-17"><img src="/images/03.png"/></div>    

    <div class="c-18">&nbsp;</div>
</div>        

<div class="right-content">
    <div class="right-info">
        <div class="info-block">
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Lingh intensity'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_buc_xa_dan_thu); ?>Lux</span>
            </div>  
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Environment Temp'); ?></span>
                <span class="text-01"><?php echo bindec(substr($sensors->du_phong, 0, 8)); ?><sup>o</sup>C</span>
            </div>  
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Solar panels temp'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_dan_thu); ?><sup>o</sup>C</span>
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Top of Solar tank'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_dinh_bon_solar); ?><sup>o</sup>C</span>
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Bottom of Solar tank'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_bon_solar); ?><sup>o</sup>C</span>
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Solar tank level'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_muc_nuoc_bon_solar); ?>
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Heater tank temp'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_bon_gia_nhiet); ?><sup>o</sup>C</span>
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Heater tank pressure'); ?></span>
                <span class="text-01"><?php echo common\helpers\Helpers::number2String(bindec($sensors->cam_bien_ap_suat_bon_gia_nhiet)); ?>B
            </div>  
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Pipeline pressure'); ?></span>
                <span class="text-01"><?php echo common\helpers\Helpers::number2String(bindec($sensors->cam_bien_ap_suat_duong_ong)); ?>B
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Pipeline temp 1'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_1); ?><sup>o</sup>C</span>
            </div>
            <div class="info-block-item">
                <span class="text-02"><?php echo Yii::t('backend', 'Pipeline temp 2'); ?></span>
                <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_2); ?><sup>o</sup>C</span>
            </div>
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