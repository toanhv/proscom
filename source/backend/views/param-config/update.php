<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\ParamConfig */

$module = $model->module;
$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = 'Param config';
?>
<h3 class="text-center">ID: <?php echo $idModule . ' - ' . Html::encode($module->name); ?></h3>
<div class="diagram">
    <div class="container-all">  
        <p><br></p>  
        <div class="control-main control-main-center">
            <form method="post" action="/param-config/update?id=<?php echo $model->id ?>">
                <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
                <?=
                $this->render('_form', [
                    'model' => $model,
                ])
                ?>
                <div class="row100" style="text-align:center">
                    <input type="submit" class="btn btn-primary" value="SEND" data-confirm="Are you sure you want to send?"/>
                    <?php if ($model->getConvectionTemp()) { ?>
                        <input type="hidden" id="url_back" name="url_back" value="/param-config/view">
                    <?php } ?>
                </div>
            </form>
        </div>         
    </div>
</div>
