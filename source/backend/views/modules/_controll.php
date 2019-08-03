<div class="control-main item-small-view">
    <form id="update-output-mode" method="post" action="/output-mode/update?id=<?php echo $model->id ?>">
        <input type="hidden" name="_csrf" value="<?php echo Yii::$app->request->csrfToken ?>">
        <div class="item">
            <h3><?php echo Yii::t('backend', 'Convection pump'); ?></h3>
            <input type="hidden" id="convection_pump_mode" name="convection_pump[mode]" value="<?php echo $outputMode->getConvectionMode() ?>">
            <input type="hidden" id="convection_pump_time" name="convection_pump[time]" value="<?php echo $outputMode->getConvectionTime() ?>">
            <div class="row-control item-6 <?php echo (in_array($mode, $module_hide['Convection_pump'])) ? 'all-disable' : '' ?>">
                <select class="selectpicker select-master" data-width="70">
                    <option value="1"><?php echo Yii::t('backend', 'Auto'); ?></option>
                    <option value="2"><?php echo Yii::t('backend', 'Manual'); ?></option>
                </select>

                <div class="control-01"> 
                    <!--SELECT 01-->
                    <select  class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'Master'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'Slave'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select  class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'Slave'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'Master'); ?></option>
                    </select>
                </div>

                <div class="control-02"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'ON'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'OFF'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'OFF'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'ON'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="item">
            <h3><?php echo Yii::t('backend', 'Cold water supply pump'); ?></h3>
            <input type="hidden" id="cwsp_pump_mode" name="cwsp_pump[mode]" value="<?php echo $outputMode->getCwspMode() ?>">
            <input type="hidden" id="cwsp_pump_time" name="cwsp_pump[time]" value="<?php echo $outputMode->getCwspTime() ?>">
            <div class="row-control item-7 <?php echo (in_array($mode, $module_hide['Cold_water_supply_pump'])) ? 'all-disable' : '' ?>">
                <select class="selectpicker select-master" data-width="70">
                    <option value="1"><?php echo Yii::t('backend', 'Auto'); ?></option>
                    <option value="2"><?php echo Yii::t('backend', 'Manual'); ?></option>
                </select>

                <div class="control-01"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'Master'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'Slave'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'Slave'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'Master'); ?></option>
                    </select>
                </div>

                <div class="control-02"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'ON'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'OFF'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'OFF'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'ON'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="item">
            <h3><?php echo Yii::t('backend', 'Return pump'); ?></h3>
            <input type="hidden" id="return_pump_mode" name="return_pump[mode]" value="<?php echo $outputMode->getReturnPumpMode() ?>">
            <input type="hidden" id="return_pump_time" name="return_pump[time]" value="<?php echo $outputMode->getReturnPumpTime() ?>">
            <div class="row-control item-8">
                <select class="selectpicker select-master" data-width="70">
                    <option value="1"><?php echo Yii::t('backend', 'Auto'); ?></option>
                    <option value="2"><?php echo Yii::t('backend', 'Manual'); ?></option>
                </select>

                <div class="control-01"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'Master'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'Slave'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'Slave'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'Master'); ?></option>
                    </select>
                </div>

                <div class="control-02"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'ON'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'OFF'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'OFF'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'ON'); ?></option>
                    </select>
                </div>
            </div>
        </div>

        <div class="item">
            <h3><?php echo Yii::t('backend', 'Increase pressure pump'); ?></h3>
            <input type="hidden" id="pressure_pump_mode" name="pressure_pump[mode]" value="<?php echo $outputMode->getPressurePumpMode() ?>">
            <input type="hidden" id="pressure_pump_time" name="pressure_pump[time]" value="<?php echo $outputMode->getPressurePumpTime() ?>">
            <input type="hidden" id="pressure_pump_tem" name="pressure_pump[tem]" value="<?php echo $outputMode->getPressurePumpTem() ?>">
            <div class="row-control item-9">
                <select class="selectpicker select-master" data-width="70">
                    <option value="1"><?php echo Yii::t('backend', 'Auto'); ?></option>
                    <option value="2"><?php echo Yii::t('backend', 'Manual'); ?></option>
                </select>

                <div class="control-01"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'Master'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'Slave'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'Slave'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'Master'); ?></option>
                    </select>
                </div>

                <div class="control-02"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'ON'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'OFF'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'OFF'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'ON'); ?></option>
                    </select>
                </div>
            </div>
        </div>                    

        <div class="item">
            <h3><?php echo Yii::t('backend', 'Heater Resistor'); ?></h3>
            <input type="hidden" id="heater_resis_mode" name="heater_resis[mode]" value="<?php echo $outputMode->getHeaterResisMode() ?>">
            <input type="hidden" id="heater_resis_time" name="heater_resis[time]" value="<?php echo $outputMode->getHeaterResisTime() ?>">
            <div class="row-control item-11 <?php echo (in_array($mode, $module_hide['Heater_Resistor'])) ? 'all-disable' : '' ?>">
                <select class="selectpicker select-master" data-width="70">
                    <option value="1"><?php echo Yii::t('backend', 'Auto'); ?></option>
                    <option value="2"><?php echo Yii::t('backend', 'Manual'); ?></option>
                </select>

                <div class="control-01"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'Master'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'Slave'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'Slave'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'Master'); ?></option>
                    </select>
                </div>

                <div class="control-02"> 
                    <!--SELECT 01-->
                    <select class="selectpicker select-sub-1" data-width="80">
                        <option value="11"><?php echo Yii::t('backend', 'ON'); ?></option>
                        <option value="12"><?php echo Yii::t('backend', 'OFF'); ?></option>
                    </select>

                    <!--SELECT 02-->
                    <select class="selectpicker select-sub-2" data-width="80">
                        <option value="22"><?php echo Yii::t('backend', 'OFF'); ?></option>                
                        <option value="21"><?php echo Yii::t('backend', 'ON'); ?></option>
                    </select>
                </div>                            
            </div>
        </div>

        <!--Heat pump-->
        <div class="item">
            <h5 style="font-weight: bold;"><?php echo Yii::t('backend', 'Heat pump|Three value|Back flow'); ?></h5>
            <input type="hidden" id="heat_pump_mode" name="heat_pump[mode]" value="<?php echo $outputMode->getHeatPumpMode() ?>"/>
            <input type="hidden" id="three_way_mode" name="three_way[mode]" value="<?php echo $outputMode->get3wayMode() ?>"/>
            <input type="hidden" id="backflow_mode" name="backflow[mode]" value="<?php echo $outputMode->getBlakflowMode() ?>"/>
            <div class="row-control item-10">
                <select class="selectpicker" data-width="70" disabled="disabled">
                    <option><?php echo Yii::t('backend', 'Auto'); ?></option>
                    <option><?php echo Yii::t('backend', 'Manual'); ?></option>
                </select>

                <button class="btn btn-success" style="width:170px" disabled="disabled"><?php echo Yii::t('backend', 'Under operation coditions'); ?></button>
            </div>
        </div>

        <div class="row100" style="text-align:center">
            <input type="hidden" id="url_back" name="url_back" value="/modules/all-view">
            <input type="submit" value="<?php echo Yii::t('backend', 'SEND'); ?>" class="btn btn-primary" data-confirm="<?php echo Yii::t('backend', 'Are you sure you want to send?'); ?>"/>
        </div>
    </form>
</div>