<?php

use yii\helpers\Html;

$this->title = 'Overal View';
?>
<div class="output-mode-view">    
    <div class="info-diagram">
        <h3 class="title">ID: <?php echo $model->getModuleId() . ' - ' . \yii\helpers\Html::encode($model->name); ?></h3>        
    </div>
    <div class="clearfix"></div>
    <div class="diagram">
        <div class="container-all">
            <div class="control-main">
                <div class="item">
                    <h3>Convection pump</h3>
                    <div class="row-control item-1">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select  class="selectpicker select-sub-1" data-width="80">
                                <option value="11">Master 1</option>
                                <option value="12">Slave 2</option>
                            </select>

                            <!--SELECT 02-->
                            <select  class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave 1</option>                
                                <option value="21">Master 2</option>
                            </select>
                        </div>

                        <div class="control-02"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">1 ON</option>
                                <option value="12">2 OFF</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">2 OFF</option>                
                                <option value="21">1 ON</option>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="item">
                    <h3>Cold water supply pump</h3>
                    <div class="row-control item-2">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">Master 1</option>
                                <option value="12">Slave 2</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave 1</option>                
                                <option value="21">Master 2</option>
                            </select>
                        </div>

                        <div class="control-02"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">1 ON</option>
                                <option value="12">2 OFF</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">2 OFF</option>                
                                <option value="21">1 ON</option>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="item">
                    <h3>Return pump</h3>
                    <div class="row-control item-3">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">Master 1</option>
                                <option value="12">Slave 2</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave 1</option>                
                                <option value="21">Master 2</option>
                            </select>
                        </div>

                        <div class="control-02"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">1 ON</option>
                                <option value="12">2 OFF</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">2 OFF</option>                
                                <option value="21">1 ON</option>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="item">
                    <h3>Increase pressure pump</h3>
                    <div class="row-control item-4">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">Master 1</option>
                                <option value="12">Slave 2</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave 1</option>                
                                <option value="21">Master 2</option>
                            </select>
                        </div>

                        <div class="control-02"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">1 ON</option>
                                <option value="12">2 OFF</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">2 OFF</option>                
                                <option value="21">1 ON</option>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="item">
                    <h3>Heat pump</h3>
                    <div class="row-control item-5">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">Master 1</option>
                                <option value="12">Slave 2</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave 1</option>                
                                <option value="21">Master 2</option>
                            </select>
                        </div>

                        <div class="control-02"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="11">1 ON</option>
                                <option value="12">2 OFF</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">2 OFF</option>                
                                <option value="21">1 ON</option>
                            </select>
                        </div>


                    </div>
                </div>

                <div class="item">
                    <h3>Heater registor</h3>
                    <div class="row-control item-15">
                        <select class="selectpicker" data-width="70">
                            <option>Auto</option>
                            <option>Manual</option>
                        </select>

                        <button class="btn btn-success switch" >R1 master</button>
                        <button class="btn btn-success switch" >R2 slave</button>                
                    </div>
                </div>

                <div class="item">
                    <h3>Three way - value</h3>
                    <div class="row-control item-15">
                        <select class="selectpicker" data-width="70">
                            <option>Auto</option>
                            <option>Manual</option>
                        </select>

                        <button class="btn btn-success" >Under operation coditions</button>
                    </div>
                </div>

                <div class="item">
                    <h3>Backflow value</h3>
                    <div class="row-control item-15">
                        <select class="selectpicker" data-width="70">
                            <option>Auto</option>
                            <option>Manual</option>
                        </select>

                        <button class="btn btn-success" >Under operation coditions</button>
                    </div>
                </div>

            </div>

            <div class="left-content">
                <div class="c-00"><?php echo bindec($sensors->cam_bien_ap_suat_duong_ong); ?></div>
                <div class="c-01">&nbsp;</div>

                <div class="c-02"><p><?php echo bindec($sensors->cam_bien_dan_thu); ?>&deg;C</p></div>    
                <div class="icon-02"><img src="/images/03.png"/></div>

                <div class="c-03">&nbsp;<p><?php echo bindec($sensors->cam_bien_nhiet_dinh_bon_solar); ?>&deg;C</p></div>
                <div class="icon-03"><img src="/images/01.png"/></div>    

                <div class="c-04">&nbsp;</div>
                <div class="bg-04">
                    <div class="ctn">
                    <!--<span class="row-01"></span>-->
                        <span class="row-02"></span>
                        <span class="row-03"></span>
                    </div>
                </div>

                <div class="c-05">&nbsp;<p><?php echo bindec($sensors->cam_bien_bon_solar); ?>&deg;C</p></div>
                <div class="icon-05"><img src="/images/01.png"/></div>    

                <div class="c-06">&nbsp;</div>
                <div class="bg-06-green <?php echo $statuses->bom_doi_luu_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-06-red <?php echo $statuses->bom_doi_luu_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>    

                <div class="c-07">&nbsp;</div>
                <div class="bg-07-green <?php echo $model->van_dien_tu_ba_nga_up == '00' ? 'bg-green' : 'bg-red' ?>" van_dien_tu_ba_nga_up="<?php echo $model->van_dien_tu_ba_nga_up; ?>"></div>
                <div class="bg-07-red <?php echo $model->van_dien_tu_ba_nga_down == '00' ? 'bg-green' : 'bg-red' ?>" van_dien_tu_ba_nga_down="<?php echo $model->van_dien_tu_ba_nga_down; ?>"></div>   

                <div class="c-08">&nbsp;<p><?php echo bindec($sensors->cam_bien_nhiet_do_bon_gia_nhiet); ?>&deg;C</p></div>
                <div class="icon-08"><img src="/images/03.png"/></div>    

                <div class="c-09">&nbsp;<p><?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_1); ?>Bar</p></div>
                <div class="icon-09"><img src="/images/04.png"/></div>    

                <div class="c-10">&nbsp;</div>
                <div class="bg-10-red <?php echo $statuses->dien_tro_nhiet_bon_gia_nhiet_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-10-green <?php echo $statuses->dien_tro_nhiet_bon_gia_nhiet_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>   

                <div class="c-11">&nbsp;</div> 
                <div class="bg-11 <?php echo $statuses->bom_nhiet_bon_gia_nhiet == '00' ? 'bg-green' : 'bg-red' ?>"></div>   

                <div class="c-12">&nbsp;</div>
                <div class="bg-12-green <?php echo $statuses->bom_tang_ap_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-12-red <?php echo $statuses->bom_tang_ap_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div>  

                <div class="c-13">&nbsp;<p><?php echo bindec($sensors->cam_bien_nhiet_do_duong_ong_2); ?>Bar</p></div>
                <div class="icon-13"><img src="/images/04.png"/></div>	

                <div class="c-14">&nbsp;<p><?php echo bindec($sensors->cam_bien_tran); ?>&deg;C</p></div>
                <div class="icon-14"><img src="/images/03.png"/></div>    

                <div class="c-15">&nbsp;</div>
                <div class="bg-15-green <?php echo $statuses->bom_cap_nuoc_lanh_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-15-red <?php echo $statuses->bom_cap_nuoc_lanh_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div> 

                <div class="c-16">&nbsp;</div>
                <div class="bg-16-green <?php echo $statuses->bom_hoi_duong_ong_1 == '00' ? 'bg-green' : 'bg-red' ?>"></div>
                <div class="bg-16-red <?php echo $statuses->bom_hoi_duong_ong_2 == '00' ? 'bg-green' : 'bg-red' ?>"></div> 

                <div class="c-17">&nbsp;<p><?php echo bindec($sensors->du_phong); ?>&deg;C</p></div>
                <div class="icon-17"><img src="/images/03.png"/></div>    

                <div class="c-18">&nbsp;</div>
            </div>        

            <div class="right-content">
                <div class="right-info">
                    <div class="info-block">
                        <div class="info-block-item">
                            <span class="text-02">Solar panels temp</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_dan_thu); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Solar tank temp</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_bon_solar); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Solar tank level</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_muc_nuoc_bon_solar); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Heater tank temp</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_do_bon_gia_nhiet); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Heater tank pressure</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_ap_suat_bon_gia_nhiet); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Lingh intensity</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_buc_xa_dan_thu); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Top of Solar tank</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_nhiet_dinh_bon_solar); ?><sup>o</sup>C</span>
                        </div>
                        <div class="info-block-item">
                            <span class="text-02">Pipeline pressure</span>
                            <span class="text-01"><?php echo bindec($sensors->cam_bien_ap_suat_duong_ong); ?><sup>o</sup>C</span>
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

