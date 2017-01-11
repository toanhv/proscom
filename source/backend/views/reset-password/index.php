<?php

use yii\helpers\Html;

$this->title = "Reset default password";
?>
<h3 class="text-center"><?= Html::encode($this->title) ?></h3>
<form method="post" action="/reset-password/index">
    <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
    <div class="params">
        <div class="row100 text-center">
            <h3 class="text-center"><?php echo $module->getModuleId() . ' - ' . \yii\helpers\Html::encode($module->name); ?></h3>
            <input type="submit" value="Reset" class="btn btn-primary"/>
        </div>
    </div>
</form>
