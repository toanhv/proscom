<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Water temperature difference between Solar panels and Solar tank'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Convection pump'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Range to turn on the pump'); ?> <input type="text" name="convection_pump" value="<?php echo $model->getConvectionTemp(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Pump ON when water level lower than M2 and OFF when water level upper than M1'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Cold water supply Pump'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Water level M1'); ?> <input type="text" name="cold_water_supply_pump_lv1" value="<?php echo $model->getCwsplv1(); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        <?php echo Yii::t('backend', 'Water level M2'); ?> <input type="text" name="cold_water_supply_pump_lv2" value="<?php echo $model->getCwsplv2(); ?>" class="type-text" style="width:30px">
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Pump ON when time out of Begin time and End time, and the temperature between Heater tank and pipeline upper than range'); ?>">        	
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Return pump'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Begin ilde time (hh:mm)'); ?> 
        <input type="text" name="return_pump_t1_start" value="<?php echo bindec(substr($model->return_pump, 0, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="return_pump_t1_end" value="<?php echo bindec(substr($model->return_pump, 8, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        <?php echo Yii::t('backend', 'End ilde time (hh:mm)'); ?> 
        <input type="text" name="return_pump_t2_start" value="<?php echo bindec(substr($model->return_pump, 16, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="return_pump_t2_end" value="<?php echo bindec(substr($model->return_pump, 24, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Water temperature difference between Solar panels and Solar tank'); ?>">
        <?php echo Yii::t('backend', 'Range to turn on the Pump'); ?> <input type="text" name="return_pump_delta_t" value="<?php echo $model->getReturnPumpDeltat(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Pump ON when pressure in pipeline lower than this value'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Incresed pressure Pump'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Pressure value to turn on the Pump'); ?> <input type="text" name="pressure_pump_p1" value="<?php echo $model->getPressurePumpP1(); ?>" class="type-text" style="width:30px">Bar
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Pump ON when temperqature in the Heater tank lower than this value'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Heat Pump'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Temperature to turn on the Pump'); ?> <input type="text" name="heat_pump_t1" value="<?php echo $model->getHeatPumpT1(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'When the Heat Pump turn on a time, if temperature in Heater tank lower than T1, R1 turn on, if R1 turn on a time, temperature in Heater tanl lower than T2, R2 turn on'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Heat Resistor'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Temperature to turn on Resistor'); ?> <input type="text" name="heater_resis_t1" value="<?php echo $model->getHeaterResisT1(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
    <p>
        <?php echo Yii::t('backend', 'Wail for heater pump'); ?> <input type="text" name="heater_resister_delay_time" value="<?php echo $model->getHeaterResisDelay(); ?>" class="type-text" style="width:30px">min
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Valve change direction when time out of Begin time and End time, and the temperature between Heater tank and Solar tank upper than range'); ?>">        	
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Three way Valve'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Begin ilde time (hh:mm)'); ?> 
        <input type="text" name="3way_t1_h" value="<?php echo bindec(substr($model->three_way_valve, 0, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="3way_t1_m" value="<?php echo bindec(substr($model->three_way_valve, 8, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        <?php echo Yii::t('backend', 'End ilde time (hh:mm)'); ?> 
        <input type="text" name="3way_t2_h" value="<?php echo bindec(substr($model->three_way_valve, 16, 8)); ?>" class="type-text" style="width:30px"> : 
        <input type="text" name="3way_t2_m" value="<?php echo bindec(substr($model->three_way_valve, 24, 8)); ?>" class="type-text" style="width:30px">
    </p>
    <p>
        <?php echo Yii::t('backend', 'Range to change direction'); ?> <input type="text" name="3way_temp" value="<?php echo $model->get3wayTempDelta(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>

<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'When temperature in the pipeline lower than this value, Valve open'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Backflow Valve'); ?></h3>       	
    <p>
        <?php echo Yii::t('backend', 'Temperature to turn on the Pump'); ?> <input type="text" name="backflow_temp" value="<?php echo $model->getBackflowTemp(); ?>" class="type-text" style="width:30px"><sup>o</sup>C
    </p>
</div>