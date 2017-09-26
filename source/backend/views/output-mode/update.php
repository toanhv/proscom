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
    <h3 class="text-center">ID: <?= Html::encode($this->title) ?></h3>
    <form id="update-output-mode" method="post" action="/output-mode/update?id=<?php echo $model->id ?>">
        <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
        <div class="container-all">      
            <?=
            $this->render('_form', [
                'model' => $model,
            ])
            ?>   
            <div class="row100" style="text-align:center">
                <input type="submit" value="SEND" class="btn btn-primary" data-confirm="Are you sure you want to send?"/>
                <?php if ($model->getConvectionMode()) { ?>
                    <input type="hidden" id="url_back" name="url_back" value="/output-mode/view">
                <?php } ?>
            </div>
        </div>
    </form>
</div>
