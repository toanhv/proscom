<?php
/* @var $this yii\web\View */
/* @var $model backend\models\Modules */
/* @var $form yii\widgets\ActiveForm */
$country = backend\models\Country::getAll();
$provincial = backend\models\Provincial::getAll();
$distric = backend\models\Distric::getAll();
?>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['name'] ?></h3>       	
    <p>
        <input type="text" name="<?php echo $model->formName(); ?>[name]" value="<?php echo $model->name; ?>" class="type-text" style="width:96%; text-align: left;">
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('name')) ? $model->getErrors('name')[0] : ''; ?></div>
</div>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['customer_code'] ?></h3>       	
    <p>
        <input type="text" name="<?php echo $model->formName(); ?>[customer_code]" value="<?php echo bindec($model->customer_code); ?>" class="type-text" style="width:96%">
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('customer_code')) ? $model->getErrors('customer_code')[0] : ''; ?></div>
</div>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['msisdn'] ?></h3>       	
    <p>
        <select name="<?php echo $model->formName(); ?>[msisdn]" style="width:96%">
            <?php foreach ($clients as $id => $value) { ?>
                <option value="<?php echo $id; ?>" <?php echo ($id == $model->msisdn) ? 'selected="selected"' : '' ?>>
                    <?php echo $value; ?>
                </option>
            <?php } ?>
        </select>   
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('msisdn')) ? $model->getErrors('msisdn')[0] : ''; ?></div>
</div>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['country_id'] ?></h3>       	
    <p>
        <select name="<?php echo $model->formName(); ?>[country_id]" style="width:96%">
            <?php foreach ($country as $id => $value) { ?>
                <option value="<?php echo $id; ?>" <?php echo ($id == $model->country_id) ? 'selected="selected"' : '' ?>>
                    <?php echo $value; ?>
                </option>
            <?php } ?>
        </select>   
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('country_id')) ? $model->getErrors('country_id')[0] : ''; ?></div>
</div>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['privincial_id'] ?></h3>       	
    <p>
        <select name="<?php echo $model->formName(); ?>[privincial_id]" style="width:96%">
            <?php foreach ($provincial as $id => $value) { ?>
                <option value="<?php echo $id; ?>" <?php echo ($id == $model->privincial_id) ? 'selected="selected"' : '' ?>>
                    <?php echo $value; ?>
                </option>
            <?php } ?>
        </select>   
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('privincial_id')) ? $model->getErrors('privincial_id')[0] : ''; ?></div>
</div>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['distric_id'] ?></h3>       	
    <p>
        <select name="<?php echo $model->formName(); ?>[distric_id]" style="width:96%">
            <?php foreach ($distric as $id => $value) { ?>
                <option value="<?php echo $id; ?>" <?php echo ($id == $model->distric_id) ? 'selected="selected"' : '' ?>>
                    <?php echo $value; ?>
                </option>
            <?php } ?>
        </select>   
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('distric_id')) ? $model->getErrors('distric_id')[0] : ''; ?></div>
</div>

<div class="item">
    <h3 style="margin-bottom:10px"><?php echo $model->attributeLabels()['address'] ?></h3>       	
    <p>
        <input type="text" name="<?php echo $model->formName(); ?>[address]" value="<?php echo $model->address; ?>" class="type-text" style="width:96%; text-align: left;">
    </p>
    <div class="help-block error-hightlight"><?php echo ($model->getErrors('address')) ? $model->getErrors('address')[0] : ''; ?></div>
</div>