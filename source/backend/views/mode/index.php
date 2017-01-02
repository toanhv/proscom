<?php

use backend\models\ModeSearch;
use yii\data\ActiveDataProvider;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $searchModel ModeSearch */
/* @var $dataProvider ActiveDataProvider */

$idModule = $module->country->code . $module->privincial->code . $module->distric->code . $module->customer_code;
$this->title = $idModule . ' - ' . $module->name;
?>
<div class="info-diagram">
    <form method="post" id="form-choose-mode" action="/modules/mode?id=<?php echo $module->id ?>">
        <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
        <div class="check-account">
            <h1 class="title"><?php echo Html::encode($this->title); ?></h1>
            <p align="center">Choose your system</p>
            <div class="row-check-account">
                <input type="hidden" value="" name="mode_id" id="mode_id">
                <p align="center">
                    <?php foreach ($modes as $mode): ?>
                        <a href="javascript:void(0)" id="mode_<?php echo $mode->id ?>" onclick="chooseMode('<?php echo $mode->id ?>')" class="btn-check <?php if ($module->mode_id == $mode->id) echo 'chosen'; ?>">
                            <?php echo $mode->getUrlImage(300, 220) ?>
                        </a>
                    <?php endforeach; ?>
                </p>
                <p align="center">
                    <a href="/mode/create" class="btn-link">Create</a>
                    <a href="javascript:void(0)" onclick="$('#form-choose-mode').submit()" class="btn-link">Next</a>
                </p>
            </div>
        </div>
    </form>
</div>
<p>&nbsp;</p>
<div class="clearfix"></div>

<script type="text/javascript">
    function chooseMode(id) {
        $('#mode_id').val(id);
        $('a').removeClass("chosen");
        $('#mode_' + id).addClass("chosen");
    }
</script>
<style>
    .chosen {
        background-color: #1caf9a !important;
    }
</style>
