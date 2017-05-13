<?php

use yii\helpers\Html;

$this->title = 'Overal View';

$outputMode = $model->outputModes;
?>
<?php if ($model->status == 1) { ?>
    <a id="module-status" href="/modules/status" data-pjax="0" class="icon-emergency-fix">
        <img src="/images/btn_emergency.jpg" width="50"/>
    </a>
<?php } else { ?>
    <a href="javascript:void(0);" class="icon-emergency-fix select-animation">
        <img src="/images/btn_emergency.jpg" width="50"/>
    </a>
<?php } ?>
<div class="output-mode-view">    
    <div class="info-diagram">
        <h3 class="title">ID: <?php echo $model->getModuleId() . ' - ' . \yii\helpers\Html::encode($model->name); ?></h3>        
    </div>
    <div class="clearfix"></div>
    <div class="diagram">
        <div class="container-all">
            <div class="control-main item-small-view">
                <form id="update-output-mode" method="post" action="/output-mode/update?id=<?php echo $model->id ?>">
                    <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
                    <div class="item">
                        <h3>Convection pump</h3>
                        <input type="hidden" id="convection_pump_mode" name="convection_pump[mode]" value="<?php echo $outputMode->getConvectionMode() ?>">
                        <input type="hidden" id="convection_pump_time" name="convection_pump[time]" value="<?php echo $outputMode->getConvectionTime() ?>">
                        <div class="row-control item-6">
                            <select class="selectpicker select-master" data-width="70">
                                <option value="1">Auto</option>
                                <option value="2">Manual</option>
                            </select>

                            <div class="control-01"> 
                                <!--SELECT 01-->
                                <select  class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">Master</option>
                                    <option value="12">Slave</option>
                                </select>

                                <!--SELECT 02-->
                                <select  class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">Slave</option>                
                                    <option value="21">Master</option>
                                </select>
                            </div>

                            <div class="control-02"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">ON</option>
                                    <option value="12">OFF</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">OFF</option>                
                                    <option value="21">ON</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <h3>Cold water supply pump</h3>
                        <input type="hidden" id="cwsp_pump_mode" name="cwsp_pump[mode]" value="<?php echo $outputMode->getCwspMode() ?>">
                        <input type="hidden" id="cwsp_pump_time" name="cwsp_pump[time]" value="<?php echo $outputMode->getCwspTime() ?>">
                        <div class="row-control item-7">
                            <select class="selectpicker select-master" data-width="70">
                                <option value="1">Auto</option>
                                <option value="2">Manual</option>
                            </select>

                            <div class="control-01"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">Master</option>
                                    <option value="12">Slave</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">Slave</option>                
                                    <option value="21">Master</option>
                                </select>
                            </div>

                            <div class="control-02"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">ON</option>
                                    <option value="12">OFF</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">OFF</option>                
                                    <option value="21">ON</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <h3>Return pump</h3>
                        <input type="hidden" id="return_pump_mode" name="return_pump[mode]" value="<?php echo $outputMode->getReturnPumpMode() ?>">
                        <input type="hidden" id="return_pump_time" name="return_pump[time]" value="<?php echo $outputMode->getReturnPumpTime() ?>">
                        <div class="row-control item-8">
                            <select class="selectpicker select-master" data-width="70">
                                <option value="1">Auto</option>
                                <option value="2">Manual</option>
                            </select>

                            <div class="control-01"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">Master</option>
                                    <option value="12">Slave</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">Slave</option>                
                                    <option value="21">Master</option>
                                </select>
                            </div>

                            <div class="control-02"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">ON</option>
                                    <option value="12">OFF</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">OFF</option>                
                                    <option value="21">ON</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="item">
                        <h3>Increase pressure pump</h3>
                        <input type="hidden" id="pressure_pump_mode" name="pressure_pump[mode]" value="<?php echo $outputMode->getPressurePumpMode() ?>">
                        <input type="hidden" id="pressure_pump_time" name="pressure_pump[time]" value="<?php echo $outputMode->getPressurePumpTime() ?>">
                        <input type="hidden" id="pressure_pump_tem" name="pressure_pump[tem]" value="<?php echo $outputMode->getPressurePumpTem() ?>">
                        <div class="row-control item-9">
                            <select class="selectpicker select-master" data-width="70">
                                <option value="1">Auto</option>
                                <option value="2">Manual</option>
                            </select>

                            <div class="control-01"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">Master</option>
                                    <option value="12">Slave</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">Slave</option>                
                                    <option value="21">Master</option>
                                </select>
                            </div>

                            <div class="control-02"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">ON</option>
                                    <option value="12">OFF</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">OFF</option>                
                                    <option value="21">ON</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--Heat pump-->
                    <div class="item">
                        <h3>Heat pump</h3>
                        <input type="hidden" id="heat_pump_mode" name="heat_pump[mode]" value="<?php echo $outputMode->getHeatPumpMode() ?>">
                        <div class="row-control item-10">
                            <select class="selectpicker" data-width="70" disabled="disabled">
                                <option>Auto</option>
                                <option>Manual</option>
                            </select>

                            <button class="btn btn-success" style="width:170px" disabled="disabled">Under operation coditions</button>
                        </div>
                    </div>

                    <div class="item">
                        <h3>Heater Resistor</h3>
                        <input type="hidden" id="heater_resis_mode" name="heater_resis[mode]" value="<?php echo $outputMode->getHeaterResisMode() ?>">
                        <input type="hidden" id="heater_resis_time" name="heater_resis[time]" value="<?php echo $outputMode->getHeaterResisTime() ?>">
                        <div class="row-control item-11">
                            <select class="selectpicker select-master" data-width="70">
                                <option value="1">Auto</option>
                                <option value="2">Manual</option>
                            </select>

                            <div class="control-01"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">Master</option>
                                    <option value="12">Slave</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">Slave</option>                
                                    <option value="21">Master</option>
                                </select>
                            </div>

                            <div class="control-02"> 
                                <!--SELECT 01-->
                                <select class="selectpicker select-sub-1" data-width="80">
                                    <option value="11">ON</option>
                                    <option value="12">OFF</option>
                                </select>

                                <!--SELECT 02-->
                                <select class="selectpicker select-sub-2" data-width="80">
                                    <option value="22">OFF</option>                
                                    <option value="21">ON</option>
                                </select>
                            </div>                            
                        </div>
                    </div>
                    <input type="hidden" id="three_way_mode" name="three_way[mode]" value="<?php echo $outputMode->get3wayMode() ?>">
                    <input type="hidden" id="backflow_mode" name="backflow[mode]" value="<?php echo $outputMode->getBlakflowMode() ?>">
                    <div class="row100" style="text-align:center">
                        <input type="hidden" id="url_back" name="url_back" value="/modules/all-view">
                        <input type="submit" value="SEND" class="btn btn-primary" data-confirm="Are you sure you want to send?"/>
                    </div>
                </form>
            </div>

            <div class="left-content" style="background:url('<?php echo $model->getImgUrl(); ?>') no-repeat 0 0;">
                <div class="c-00 text-04" data-toggle="tooltip" data-placement="right" title="Lingh intensity">
                    <?php echo bindec($sensors->cam_bien_buc_xa_dan_thu); ?>
                </div>
                <div class="c-01">&nbsp;</div>

                <div class="c-02 text-04" data-toggle="tooltip" data-placement="right" title="Solar panels temp">
                    <p><?php echo bindec($sensors->cam_bien_dan_thu); ?>&deg;C</p>
                </div>    
                <div class="icon-02"><img src="/images/03.png"/></div>

                <div class="c-03 text-04" data-toggle="tooltip" data-placement="right" title="Top of Solar tank">
                    &nbsp;<p><?php echo bindec($sensors->cam_bien_nhiet_dinh_bon_solar); ?>&deg;C</p>
                </div>
                <div class="icon-03"><img src="/images/01.png"/></div>    

                <div class="c-04">&nbsp;</div>
                <div class="bg-04">
                    <div class="ctn text-04" data-toggle="tooltip" data-placement="right" title="Solar tank level">
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
                        <?php } ?>
                    </div>
                </div>

                <div class="c-05 text-04" data-toggle="tooltip" data-placement="right" title="Bottom of Solar tank">
                    &nbsp;<p><?php echo bindec($sensors->cam_bien_bon_solar); ?>&deg;C</p>
                </div>
                <div class="icon-05"><img src="/images/01.png"/></div>    

                <div class="c-06">&nbsp;</div>
                <div class="bg-06-green <?php echo $statuses->bom_doi_luu_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-06-red <?php echo $statuses->bom_doi_luu_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>    

                <div class="c-07">&nbsp;</div>
                <div class="bg-07-green <?php echo $model->van_dien_tu_ba_nga_up == '00' ? 'bg-green' : 'bg-red' ?>" van_dien_tu_ba_nga_up="<?php echo $model->van_dien_tu_ba_nga_up; ?>"></div>
                <div class="bg-07-red <?php echo $model->van_dien_tu_ba_nga_down == '00' ? 'bg-green' : 'bg-red' ?>" van_dien_tu_ba_nga_down="<?php echo $model->van_dien_tu_ba_nga_down; ?>"></div>   

                <div class="c-08">&nbsp;
                    <p class="text-04" data-toggle="tooltip" data-placement="right" title="Heater tank temp">
                        <?php echo bindec($sensors->cam_bien_nhiet_do_bon_gia_nhiet); ?>&deg;C
                    </p>
                </div>
                <div class="icon-08"><img src="/images/03.png"/></div>    

                <div class="c-09">&nbsp;
                    <p class="text-04" data-toggle="tooltip" data-placement="right" title="Heater tank pressure">
                        <?php echo bindec($sensors->cam_bien_ap_suat_bon_gia_nhiet); ?>Bar
                    </p>
                </div>
                <div class="icon-09"><img src="/images/04.png"/></div>    

                <div class="c-10">&nbsp;</div>
                <div class="bg-10-red <?php echo $statuses->dien_tro_nhiet_bon_gia_nhiet_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-10-green <?php echo $statuses->dien_tro_nhiet_bon_gia_nhiet_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>   

                <div class="c-11">&nbsp;</div> 
                <div class="bg-11 <?php echo $statuses->bom_nhiet_bon_gia_nhiet == '00' ? 'bg-green' : 'bg-red' ?>"></div>   

                <div class="c-12">&nbsp;</div>
                <div class="bg-12-green <?php echo $statuses->bom_tang_ap_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-12-red <?php echo $statuses->bom_tang_ap_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>  

                <div class="c-13">&nbsp;
                    <p class="text-04" data-toggle="tooltip" data-placement="right" title="Pipeline pressure">
                        <?php echo bindec($sensors->cam_bien_ap_suat_duong_ong); ?>Bar
                    </p>
                </div>
                <div class="icon-13"><img src="/images/04.png"/></div>	

                <div class="c-14">&nbsp;
                    <p class="text-04" data-toggle="tooltip" data-placement="right" title="Pipeline temp 1">
                        <?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_1); ?>&deg;C
                    </p>
                </div>
                <div class="icon-14"><img src="/images/03.png"/></div>    

                <div class="c-15">&nbsp;</div>
                <div class="bg-15-green <?php echo $statuses->bom_cap_nuoc_lanh_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-15-red <?php echo $statuses->bom_cap_nuoc_lanh_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div> 

                <div class="c-16">&nbsp;</div>
                <div class="bg-16-green <?php echo $statuses->bom_hoi_duong_ong_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-16-red <?php echo $statuses->bom_hoi_duong_ong_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div> 

                <div class="c-17">&nbsp;
                    <p class="text-04" data-toggle="tooltip" data-placement="right" title="Pipeline temp 2">
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
                            <span class="text-02">Lingh intensity</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_buc_xa_dan_thu); ?>Lux</span>
                        </div>  
                        <div class="info-block-item">
                            <span class="text-02">Solar panels temp</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_dan_thu); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Top of Solar tank</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_dinh_bon_solar); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Bottom of Solar tank</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_bon_solar); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Solar tank level</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_muc_nuoc_bon_solar); ?>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Heater tank temp</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_bon_gia_nhiet); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Heater tank pressure</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_ap_suat_bon_gia_nhiet); ?>B
                        </div>                                              
                        <div class="info-block-item">
                            <span class="text-02">Pipeline pressure</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_ap_suat_duong_ong); ?>B
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Pipeline temp 1</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_1); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Pipeline temp 2</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_2); ?><sup>o</sup>C</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>	
    </div>
</div>
<?php if ($model->status == 1) { ?>
    <?=
    $this->registerJs(
            "$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
    $('#module-status').click(function(e){
       e.preventDefault();      
       $('#pModal').modal('show').find('.modal-content').load($(this).attr('href'));  
   });
});
");

    yii\bootstrap\Modal::begin([
        'id' => 'pModal',
    ]);
    yii\bootstrap\Modal::end();
}
?>
