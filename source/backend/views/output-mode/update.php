<?php

use yii;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\OutputMode */

$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
?>
<div class="diagram">
    <h3 class="text-center"><?= Html::encode($this->title) ?></h3>
    <form id="update-output-mode" method="post" action="/output-mode/update?id=<?php echo $model->id ?>">
        <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
        <div class="container-all">      
            <div class="control-main control-main-full">
                <div class="item">
                    <h3>Convection pump</h3>
                    <input type="hidden" id="convection_pump_mode" name="convection_pump[mode]" value="<?php echo $model->getConvectionMode() ?>">
                    <div class="row-control item-6">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select id="style-1" class="selectpicker select-sub-1" data-width="80">
                                <option value="11">Master</option>
                                <option value="12">Slave</option>
                            </select>

                            <!--SELECT 02-->
                            <select id="style-2" class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave</option>                
                                <option value="21">Master</option>
                            </select>

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text" id="convection_pump_time" name="convection_pump[time]" value="<?php echo $model->getConvectionTime() ?>"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Cold water supply pump</h3>
                    <input type="hidden" id="cwsp_pump_mode" name="cwsp_pump[mode]" value="<?php echo $model->getCwspMode() ?>">
                    <div class="row-control item-7">
                        <select class="selectpicker select-master" data-width="70">
                            <option value="1">Auto</option>
                            <option value="2">Manual</option>
                        </select>

                        <div class="control-01"> 
                            <!--SELECT 01-->
                            <select class="selectpicker select-sub-1" data-width="80">
                                <option value="12">Slave</option>
                                <option value="11">Master</option>
                            </select>

                            <!--SELECT 02-->
                            <select class="selectpicker select-sub-2" data-width="80">
                                <option value="22">Slave</option>                
                                <option value="21">Master</option>
                            </select>

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text" id="cwsp_pump_time" name="cwsp_pump[time]" value="<?php echo $model->getCwspTime() ?>"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Return pump</h3>
                    <input type="hidden" id="return_pump_mode" name="return_pump[mode]" value="<?php echo $model->getReturnPumpMode() ?>">
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text" id="return_pump_time" name="return_pump[time]" value="<?php echo $model->getReturnPumpTime() ?>"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Increase pressure pump</h3>
                    <input type="hidden" id="pressure_pump_mode" name="pressure_pump[mode]" value="<?php echo $model->getPressurePumpMode() ?>">
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text" id="pressure_pump_time" name="pressure_pump[time]" value="<?php echo $model->getPressurePumpTime() ?>"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Heat pump</h3>
                    <input type="hidden" id="heat_pump_mode" name="heat_pump[mode]" value="<?php echo $model->getHeatPumpMode() ?>">
                    <div class="row-control item-10">
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text" id="heat_pump_time" name="heat_pump[time]" value="<?php echo $model->getHeatPumpTime() ?>"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Heater registor</h3>
                    <input type="hidden" id="heater_resis_mode" name="heater_resis[mode]" value="<?php echo $model->getHeaterResisMode() ?>">
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text" id="heater_resis_time" name="heater_resis[time]" value="<?php echo $model->getHeaterResisTime() ?>"> min
                            </div>

                            <div class="add-info" style="width:170px">
                                Tem ON Slave <input class="type-text" style="width:30px" type="text" id="heater_resis_tem" name="heater_resis[tem]" value="<?php echo $model->getHeaterResisTem() ?>"> <sup>o</sup> C
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>

                            <div class="add-info" style="width:170px">
                                Tem ON Slave <input class="type-text" style="width:30px" disabled type="text"> <sup>o</sup> C
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Three-way value</h3>
                    <div class="row-control item-12">
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>

                <div class="item">
                    <h3>Backflow value</h3>
                    <div class="row-control item-13">
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" type="text"> min
                            </div>
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

                            <div class="add-info">
                                Wait for Master <input class="type-text" style="width:30px" disabled type="text"> min
                            </div>
                        </div>
                    </div>
                </div>                
            </div>   
            <div class="row100" style="text-align:center">
                <input type="submit" value="Save and Send" class="btn btn-primary"/>
            </div>
        </div>
    </form>
</div>
