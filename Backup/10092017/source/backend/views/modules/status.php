<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\ModuleStatusForm */

use yii\captcha\Captcha;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('backend', 'SOFT EMERGENCY STOP');
$this->params['breadcrumbs'][] = $this->title;
?>

<?php $form = ActiveForm::begin(['id' => 'module-status-form']); ?>
<div style="margin: 10px; padding: 10px;">
    <h3 class="title" style="text-align: center;"><?php echo $module->getModuleId() . ' - ' . \yii\helpers\Html::encode($module->name); ?></h3>
    <div class="form-group" style="text-align: center;">
        <?=
        $form->field($model, 'captcha')->widget(Captcha::className(), [
            'template' => '{input} {image}',
            'options' => [
                "class" => 'form-control form-control-solid placeholder-no-fix',
                "autocomplete" => "off",
                "placeholder" => Html::encode(Yii::t('backend', "Captcha")),
                "style" => "text-align: center;"
            ],
        ])->label(false);
        ?>
    </div>
    <div class="form-actions" style="text-align: center">
        <?=
        Html::a(Yii::t('backend', 'SOFT EMERGENCY STOP'), ['status'], [
            'class' => 'btn btn-danger uppercase',
            'data' => [
                'confirm' => Yii::t('backend', 'Are you sure you want to send?'),
                'method' => 'post',
            ],
        ])
        ?>
    </div>
</div>
<?php ActiveForm::end(); ?>