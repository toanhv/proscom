<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Counter must be an integer and must be no less than 0'); ?>">
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Counter'); ?></h3>       	
    <p>
        <input type="text" name="TimerCounter[counter]" value="<?php echo $model->counter; ?>" class="type-text" style="width:60px">
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('counter')) ? $model->getErrors('counter')[0] : ''; ?></div>
</div>
<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Counter must be an integer and must be no less than 5'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Confirm Timer'); ?></h3>       	
    <p>
        <input type="text" name="TimerCounter[timer_1]" value="<?php echo $model->timer_1; ?>" class="type-text" style="width:60px">(sec)
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('timer_1')) ? $model->getErrors('timer_1')[0] : ''; ?></div>
</div>
<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Counter must be an integer and must be no less than 60'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Resend Timer'); ?></h3>       	
    <p>
        <input type="text" name="TimerCounter[timer_2]" value="<?php echo $model->timer_2; ?>" class="type-text" style="width:60px">(sec)
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('timer_2')) ? $model->getErrors('timer_2')[0] : ''; ?></div>
</div>
<div class="item" data-toggle="tooltip" class="text-04" data-placement="right" title="<?php echo Yii::t('backend', 'Counter must be an integer and must be no less than 180'); ?>"> 
    <h3 style="margin-bottom:10px"><?php echo Yii::t('backend', 'Report Timer'); ?></h3>       	
    <p>
        <input type="text" name="TimerCounter[timer_3]" value="<?php echo $model->timer_3; ?>" class="type-text" style="width:60px">(sec)
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('timer_3')) ? $model->getErrors('timer_3')[0] : ''; ?></div>
</div>