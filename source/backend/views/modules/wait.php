Hoàng Văn Toàn
<?=
$this->registerJs("
    $(document).ready(function () {  
        var status = getStatus();
        alert(status);
        //while (status != 1) {
            //alert('NOK');
            //status = getStatus();
        //}
        //alert('OK');
        //return;
    });
    
    function getStatus() {
        var ret = 0;
        $.ajax({url: '/modules/get-status', success: function(data){
            alert(data);
            ret = parseInt(data);
        }});
        return ret;
    }
");