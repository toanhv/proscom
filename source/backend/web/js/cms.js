/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $('.icon-refresh-fix').click(function () {
        var refresh = 1;
        var url = window.location.href;
        var extend = '';
        if (url.indexOf('?') > 0 && url.indexOf('reload') < 0) {
            extend = '&reload=true';
        }
        if (url.indexOf('?') < 0 && url.indexOf('reload') < 0) {
            extend = '?reload=true';
        }
        $(this).addClass('animation-spin');
        if (refresh == 1) {
            refresh = 0;
            window.location.href = url + extend;
        } else {
            window.location.href = url;
        }
    });

    $("ul.mode-select li").click(function () {
        var idLi = $(this).attr('id');
        if ($("li#" + idLi + " span").hasClass("active")) {
            $("li#" + idLi + " span").removeClass("active");
        } else {
            $("li#" + idLi + " span").addClass("active");
        }
    });

    $('#report_from').datetimepicker({
        format: 'Y-m-d H:i:s',
        step: 1,
    });

    $('#report_to').datetimepicker({
        format: 'Y-m-d H:i:s',
        step: 1,
    });
    $("form").on('submit', function () {
        if ($('.btn-primary').attr('data-confirm')) {
            waitingDialog.show('Connecting to client');
        }
    });
    $('a#flag-language').click(function () {
        var ref = window.location.href;
        window.location.href = '/site/language?ref=' + ref;
    });
    $('.fa-th-large').click(function () {
        location.href = '/?list=menu';
    });
    $('.fa-align-justify').click(function () {
        location.href = '/';
    });

    $('#pressure_pump_p1').keypress(function (e) {
        var number = $(this).val();
        if (number.length > 1) {
            e.stopPropagation();
        } else {
            if (number) {
                $(this).val(number + ',' + e.key);
            }
        }
    });

    //$('#module-list .table-striped > tbody > tr:nth-of-type(2n+1)').css('background-color', genColor());
    //$('#module-list .table-striped > tbody > tr:nth-of-type(2n+2)').css('background-color', genColor());

    //disable all select/input
    $("div.all-disable select,div.all-disable input").prop('disabled', 'disabled');
});

jconfirm = function (message, trueCallback, falseCallback) {
    $.confirm({
        title: '',
        content: message,
        buttons: {
            Ok: function () {
                trueCallback();
            },
            cancel: function () {
                falseCallback;
            }
        }
    });
}

function genColor() {
    return 'rgba(' + getRandomInt(100, 255) + "," + getRandomInt(100, 255) + "," + getRandomInt(100, 255) + "," + getRandomInt(100, 255) + ')';
}

/**
 * Returns a random integer between min (inclusive) and max (inclusive)
 * Using Math.round() will give you a non-uniform distribution!
 */
function getRandomInt(min, max) {
    return Math.floor(Math.random() * (max - min + 1)) + min;
}

function setImageUrl(path, url) {
    $('#image_path').val(path);
    $("#img_model_id").attr("src", url);
}

function addVideoToList(listId) {
    $('#video-modal').modal('show').find('#model-content').load('/video-playlist/list?id=' + listId);
}

function setPumpMode(id, val) {
    $('#' + id + '_auto').removeClass('active');
    $('#' + id + '_manual').removeClass('active');
    $('#' + id + '_mode').val(val);
    if (val == '00000000') {
        $('#' + id + '_select').prop('disabled', 'disabled');
        $('#' + id + '_select').val(0);
        $('#' + id + '_time').val('00000000');
    } else {
        $('#' + id + '_select').prop('disabled', false);
    }


}

function setPumpPump(id, val) {
    var all = '00000011';
    var slave = '00000000';
    var master = '00000001';
    var current = $('#' + id + '_pump').val();
    var mode = $('#' + id + '_mode').val();

    if (mode == '00000000') {//manual
        if (val == slave && current == all) {
            $('#' + id + '_pump').val(master);
        } else if (val == master && current == all) {
            $('#' + id + '_pump').val(slave);
        } else if (val == master && current == slave) {
            $('#' + id + '_pump').val(all);
        } else if (val == slave && current == slave) {
            $('#' + id + '_pump').val(slave);
            $('#' + id + '_slave').removeClass("active");
        } else if (val == slave && current == master) {
            $('#' + id + '_pump').val(all);
        } else if (val == master && current == master) {
            $('#' + id + '_pump').val(master);
            $('#' + id + '_master').removeClass("active");
        }
    } else {
        $('#' + id + '_pump').val(val);
        if (val == '00000000') {
            //$('#' + id + '_mode').val(AUTO_B1);
            $("#" + id + "_master").removeClass("active");
        } else {
            //$('#' + id + '_mode').val(AUTO_B2);
            $("#" + id + "_slave").removeClass("active");
        }
    }

}

function changePumpTime(id) {
    $('#' + id + '_time').val($('#' + id + '_select').val());
}

function loadManagerInfo() {
    console.log("reload module data");
    var id = $("#module-id").val();
    $.get("/index.php/modules/loadinfo?id=" + id, {}, function (data) {
        var values = JSON.parse(data);
        $("#money-info").html(values.money);
        $("#data-info").html(values.data);

    });

}

function alert(message) {
    $.alert({
        title: 'Thông báo!',
        content: message
    });
    return false;
}

function page_reload(id, url) {
    console.log("url: " + url);
    $.ajax({
        url: "/site/refresh?id=" + id,
        success: function (sts) {
            console.log("status: " + sts);
            if (sts == 1) {
                window.location.href = url;
            }
        }
    });
    setInterval(function () {
        page_reload(id, url);
    }, 30000);
}



