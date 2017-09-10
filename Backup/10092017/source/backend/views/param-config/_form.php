<?php
$mode = $model->module->mode->mode;
?>
<div class="item <?php echo (in_array($mode, Yii::$app->params['module_hide']['Convection_pump'])) ? 'all-disable' : '' ?>" data-toggle="tooltip" class="text-04" data-placement="right" title="Water temperature difference between Solar panels and Solar tank"> 
    <h3 style="margin-bottom:10px">Convection pump</h3>       	
    <p>
        Range to turn on the pump <input type="text" name="convection_pump" value="<?php echo $model->getConvectionTemp(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item <?php echo (in_array($mode, Yii::$app->params['module_hide']['Cold_water_supply_pump'])) ? 'all-disable' : '' ?>" data-toggle="tooltip" class="text-04" data-placement="right" title="Pump ON when water level lower than M2 and OFF when water level upper than M1"> 
    <h3 style="margin-bottom:10px">Cold water supply Pump</h3>       	
    <p>
        Water level M1 <input type="text" name="cold_water_supply_pump_lv1" value="<?php echo $model->getCwsplv1(); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        Water level M2 <input type="text" name="cold_water_supply_pump_lv2" value="<?php echo $model->getCwsplv2(); ?>" class="type-text" style="width:30px">
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="Pump ON when time out of Begin time and End time, and the temperature between Heater tank and pipeline upper than range">        	
    <h3 style="margin-bottom:10px">Return pump</h3>       	
    <p>
        Begin ilde time (hh:mm) 
        <input type="text" name="return_pump_t1_start" value="<?php echo bindec(substr($model->return_pump, 0, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="return_pump_t1_end" value="<?php echo bindec(substr($model->return_pump, 8, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        End ilde time (hh:mm) 
        <input type="text" name="return_pump_t2_start" value="<?php echo bindec(substr($model->return_pump, 16, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="return_pump_t2_end" value="<?php echo bindec(substr($model->return_pump, 24, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p data-toggle="tooltip" class="text-04" data-placement="right" title="Water temperature difference between Solar panels and Solar tank">
        Range to turn on the Pump <input type="text" name="return_pump_delta_t" value="<?php echo $model->getReturnPumpDeltat(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="Pump ON when pressure in pipeline lower than this value"> 
    <h3 style="margin-bottom:10px">Incresed pressure Pump</h3>       	
    <p>
        Pressure value to turn on the Pump <input type="text" name="pressure_pump_p1" value="<?php echo $model->getPressurePumpP1(); ?>" class="type-text" style="width:30px">Bar
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="Pump ON when temperqature in the Heater tank lower than this value"> 
    <h3 style="margin-bottom:10px">Heat Pump</h3>       	
    <p>
        Temperature to turn on the Pump <input type="text" name="heat_pump_t1" value="<?php echo $model->getHeatPumpT1(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item <?php echo (in_array($mode, Yii::$app->params['module_hide']['Heater_Resistor'])) ? 'all-disable' : '' ?>" data-toggle="tooltip" class="text-04" data-placement="right" title="When the Heat Pump turn on a time, if temperature in Heater tank lower than T1, R1 turn on, if R1 turn on a time, temperature in Heater tanl lower than T2, R2 turn on"> 
    <h3 style="margin-bottom:10px">Heat Resistor</h3>       	
    <p>
        Temperature to turn on Resistor <input type="text" name="heater_resis_t1" value="<?php echo $model->getHeaterResisT1(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
    <p>
        Wail for heater pump <input type="text" name="heater_resister_delay_time" value="<?php echo $model->getHeaterResisDelay(); ?>" class="type-text" style="width:30px">min
    </p>
</div>

<div class="item <?php echo (in_array($mode, Yii::$app->params['module_hide']['Three_way_Valve'])) ? 'all-disable' : '' ?>" data-toggle="tooltip" class="text-04" data-placement="right" title="Valve change direction when time out of Begin time and End time, and the temperature between Heater tank and Solar tank upper than range">        	
    <h3 style="margin-bottom:10px">Three way Valve</h3>       	
    <p>
        Begin ilde time (hh:mm) 
        <input type="text" name="3way_t1_h" value="<?php echo bindec(substr($model->three_way_valve, 0, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="3way_t1_m" value="<?php echo bindec(substr($model->three_way_valve, 8, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        End ilde time (hh:mm) 
        <input type="text" name="3way_t2_h" value="<?php echo bindec(substr($model->three_way_valve, 16, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="3way_t2_m" value="<?php echo bindec(substr($model->three_way_valve, 24, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        Range to change direction <input type="text" name="3way_temp" value="<?php echo $model->get3wayTempDelta(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="When temperature in the pipeline lower than this value, Valve open"> 
    <h3 style="margin-bottom:10px">Backflow Valve</h3>       	
    <p>
        Temperature to turn on the Pump <input type="text" name="backflow_temp" value="<?php echo $model->getBackflowTemp(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>