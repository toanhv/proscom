<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<div>
    <input type="button" id="ajax-submit-form" name="ajax-submit-form" value="Submit"/>
</div>
<?=
$this->registerJs(
    "$(document).on('ready pjax:success', function() {  // 'pjax:success' use if you have used pjax
        $('#ajax-submit-form').click(function(e){
            e.preventDefault();      
            $('#pModal').modal('show').find('.modal-content').load('/modules/wait');  
        });
    });
");

yii\bootstrap\Modal::begin([
    'id' => 'pModal',
]);
yii\bootstrap\Modal::end();
