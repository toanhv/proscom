<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */

$idModule = $model->module->country->code . $model->module->privincial->code . $model->module->distric->code . $model->module->customer_code;
$this->title = $idModule . ' - ' . $model->module->name;
?>
<h3 class="text-center"><?php echo Html::encode($this->title); ?></h3>
<div class="diagram">
    <div class="container-all">  
        <p><br></p>  
        <div class="control-main control-main-center">
            <form method="post" action="/timer-counter/update?id=<?php echo $model->id ?>">
                <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
                <div class="row100" style="text-align:center">
                    <input type="submit" class="btn btn-primary" value="Send" />
                </div>
            </form>
        </div>         
    </div>
</div>
