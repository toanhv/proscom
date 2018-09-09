<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModulesSearch */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Home';
?>
<div class="module-view">
    <i class="fa fa-th-large" style="font-size:24px; color: #1caf9a; cursor: pointer;"></i>&nbsp;&nbsp;
    <i class="fa fa-align-justify" style="font-size:24px; cursor: pointer;"></i>
</div>
<div class="page-bar">
    <?php
    $form = ActiveForm::begin();
    ?>
    <ul class="page-breadcrumb">
        <li>
            <input id="modulessearch-name" name="ModulesSearch[name]" value="<?php echo Html::encode($searchModel->name); ?>" type="text" placeholder="<?php echo Yii::t('backend', 'Find module'); ?>">
        </li>
    </ul>   
    <?php ActiveForm::end(); ?>
</div>
<?php
yii\widgets\Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
?>
<div id="module-icon" class="row modules">
    <?php
    $data = $dataProvider->getModels();
    if (!empty($data)) {
        foreach ($data as $val) {
            $url = 'javascript:void(0);';
            $img = $val->getImg();
            $alarm = ($_GET['alarm']) ? intval($_GET['alarm']) : 0;
            if ($alarm) {
                $continue = false;
                $alarmModel = $val->alarms;
                switch ($alarm) {
                    case 1:
                        if ($alarmModel->tran_be != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                    case 3:
                        if ($alarmModel->qua_nhiet != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                    case 4:
                        if ($alarmModel->qua_ap_suat != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                    case 5:
                        if ($alarmModel->mat_dien != '11') {
                            $continue = true;
                            break;
                        }
                        break;
                }
                if ($continue) {
                    continue;
                }
            }
            if ($val->imsis->status == CONFIRM_STATUS) {
                $url = '/modules/view?id=' . $val->id;
                if ($img == MODULE_SETTING) {
                    $url = '/mode/index?module_id=' . $val->id;
                }
            }
            ?>
            <div class="col-md-4">
                <a href="<?php echo $url; ?>" title="<?php echo \yii\helpers\Html::encode($val->name); ?>">
                    <img class="img-responsive" src="<?php echo $img; ?>" alt="<?php echo \yii\helpers\Html::encode($val->name); ?>" />
                    <p>ID: <?php echo \yii\helpers\Html::encode($val->getModuleId()); ?></p>
                    <p><?php echo \yii\helpers\Html::encode($val->name); ?></p>
                </a>
            </div>
            <?php
        }
    }
    ?>
</div>
<?php
yii\widgets\Pjax::end();
?>

<?php
$script = <<< JS
    $(document).ready(function () {
        //page_reload(0, '/');
    });
JS;
$this->registerJs($script);
?>
