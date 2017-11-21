<div class="info-diagram">
    <div class="check-account">
        <form id="manager-form" method="post" action="/modules/accountmanager?id=<?php echo $model->id ?>">
            <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
            <input type="hidden" name="check" value="1">
            <input type="hidden" id="module-id" value="<?php echo $model->id ?>">
            <h3 class="title">ID: <?php echo $model->getModuleId() . ' - ' . \yii\helpers\Html::encode($model->name); ?></h3>
            <div class="row-check-account">
                <!--<button class="link"  onclick="$('#manager-form').submit()">Check <br>Account</button>-->
                <button class="link" onclick="javascript:void(0);">Balance</button>
                <div class="content">
                    <div class="text-02">&nbsp;<strong id="money-info"/><?php echo trim($model->money, '&&'); ?>
                    </div>
                </div>
                <div class="row-check-account">
                    <!--<button class="link" onclick="$('#manager-form').submit()" class="link">Check <br>Data</button>-->
<!--                    <button class="link" onclick="javascript:void(0);" class="link">Data</button>
                    <div class="content">
                        <div class="text-02">&nbsp;<strong id="data-info"/><?php echo trim($model->data, '&&'); ?>
                        </div>
                    </div>-->
                    </form>
                    <form action="/modules/accountmanager?id=<?php echo $model->id ?>" id="pay_card_form" method="post">
                        <input type="hidden" name="_csrf" value="<?php Yii::$app->request->csrfToken ?>">
                        <input type="hidden" name="pay" value="1">
                        <div class="row-check-account">
                            <button class="link" onclick="return checkCard()">SIM <br>Balance</button>
                            <div class="content">
                                <div class="text-02">
                                    <input type="text" id="card_info" name="card_info" placeholder="Enter your code" class="text-field">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
            <?php if ($alert): ?>
                <script type="text/javascript">
                    alert('<?php echo $alert ?>')
                </script>
            <?php endif; ?>
            <script type="text/javascript">

                function loadInfo() {
                    console.log("reload module data");
                    var id = $("#module-id").val();

                    $.get("/modules/loadinfo?id=" + id, {}, function (values) {
                        console.log(values);
                        // var values = JSON.parse(data);
                        $("#money-info").html(values.money);
                        $("#data-info").html(values.data);
                    });

                }

                setInterval(function () {
                    console.log("auto reload module data");
                    var id = $("#module-id").val();

                    $.get("/modules/loadinfo?id=" + id, {}, function (values) {
                        console.log(values);
                        // var values = JSON.parse(data);
                        $("#money-info").html(values.money);
                        $("#data-info").html(values.data);
                    });

                }, 10000);

                function updateModuleInput() {
                    $('#module-id').val($('#module_id').val());
                    loadInfo();
                }

                function checkCard() {
                    //        var card = $('#card_info').val();
                    //        if (card.length < 12 || card.length > 16) {
                    //            alert("Card code invalid!");
                    //            $('#card_info').focus();
                    //            return false;
                    //        }
                    //
                    //        if (!$.isNumeric(card)) {
                    //            alert("Card code invalid!");
                    //            $('#card_info').focus();
                    //            return false;
                    //        }
                    $('#pay_card_form').submit();
                }
            </script>
