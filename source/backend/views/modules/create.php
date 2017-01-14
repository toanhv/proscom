<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Modules */

$this->title = Yii::t('backend', 'Create {modelClass}', [
            'modelClass' => 'Modules',
        ]);
?>
<h3 class="text-center"><?php echo Html::encode($this->title); ?></h3>
<div class="diagram">
    <div class="container-all">  
        <p><br></p>  
        <div class="control-main control-main-center">
            <form method="post" action="/modules/create">
                <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
                <?=
                $this->render('_create', [
                    'model' => $model,
                    'clients' => $clients,
                ])
                ?>
                <div class="row100" style="text-align:center">
                    <input type="submit" class="btn btn-primary" value="Send" />
                </div>
            </form>
        </div>         
    </div>
</div>
