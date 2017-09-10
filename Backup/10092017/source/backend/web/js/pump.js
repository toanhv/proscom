var clazz;
jQuery(document).ready(function () {
    var dad6 = $(".item-6");
    var dad7 = $(".item-7");
    var dad8 = $(".item-8");
    var dad9 = $(".item-9");
    var dad10 = $(".item-10");
    var dad11 = $(".item-11");
    var dad12 = $(".item-12");
    var dad13 = $(".item-13");

    selectMaster(dad6, 'convection_pump_mode');
    selectMaster(dad7, 'cwsp_pump_mode');
    selectMaster(dad8, 'return_pump_mode');
    selectMaster(dad9, 'pressure_pump_mode');
    selectMaster(dad10, 'heat_pump_mode');
    selectMaster(dad11, 'heater_resis_mode');
    selectMaster(dad12, 'three_way_mode');
    selectMaster(dad13, 'backflow_mode');

    //$(".input-disable select").prop('disabled', 'disabled');
    $(".input-disable input").prop('disabled', 'disabled');
});

function selectMaster(clazz, item) {
    var mode = $('#' + item).val();
    var anchorMaster = $(".select-master", clazz);

    var control01 = $(".control-01", clazz);
    var control02 = $(".control-02", clazz);

    var anchorSub1 = $(".select-sub-1", control01);
    var anchorSub1a = $(".select-sub-2", control01);

    var anchorSub2 = $(".select-sub-1", control02);
    var anchorSub2a = $(".select-sub-2", control02);

    var valueSelect = anchorMaster.val();
    var valueSelect1 = anchorSub1.val();
    var valueSelect1a = anchorSub1a.val();
    var valueSelect2 = anchorSub2.val();
    var valueSelect2a = anchorSub2a.val();

    switch (mode) {
        case AUTO_B1:
            valueSelect1 = 11;
            valueSelect1a = 22;
            break;
        case AUTO_B2:
            valueSelect1 = 12;
            valueSelect1a = 21;
            break;
        case MANUAL_B1:
            valueSelect2 = 11;
            valueSelect2a = 22;
            valueSelect = 0;
            break;
        case MANUAL_B2:
            valueSelect2 = 12;
            valueSelect2a = 21;
            valueSelect = 0;
            break;
        case MANUAL_B12:
            valueSelect2 = 11;
            valueSelect2a = 21;
            valueSelect = 0;
            break;
    }
    //Chạy lần đầu cho button master
    if (valueSelect == 1) {
        anchorMaster.val(1);
        control01.show();
        control02.hide();
    } else {
        anchorMaster.val(2);
        control01.hide();
        control02.show();
    }

    //Chạy lần đầu cho control 01   
    if (valueSelect1 == 11) {
        anchorSub1.val(11);
        control01.removeClass("choosen-1");
        control01.addClass("choosen-2");
    } else {
        anchorSub1.val(12);
        control01.addClass("choosen-1");
        control01.removeClass("choosen-2");
    }

    if (valueSelect1a == 21) {
        anchorSub1a.val(21);
        control01.removeClass("choosen-2");
        control01.addClass("choosen-1");
    } else {
        anchorSub1a.val(22);
        control01.addClass("choosen-2");
        control01.removeClass("choosen-1");
    }

    //Chạy lần đầu cho control 02    
    if (valueSelect2 == 12) {
        anchorSub2.val(12);
        control02.addClass("choosen-3");
        control02.removeClass("choosen-4");
    } else {
        anchorSub2.val(11);
        control02.removeClass("choosen-3");
    }

    if (valueSelect2a == 22) {
        anchorSub2a.val(22);
        control02.addClass("choosen-4");
        control02.removeClass("choosen-3");
    } else {
        anchorSub2a.val(21);
        control02.removeClass("choosen-4");
    }

    //0.Select 0
    anchorMaster.change(function (e) {
        valueSelect = anchorMaster.val();
        if (valueSelect == 1) {
            $('#' + item).val(AUTO_B1);
            control01.show();
            control02.hide();
        } else {
            $('#' + item).val(MANUAL_B1);
            control01.hide();
            control02.show();
        }
    });

    //1.Select 1
    anchorSub1.change(function (e) {
        valueSelect1 = anchorSub1.val();

        if (valueSelect1 == 11) {
            $('#' + item).val(AUTO_B1);
            control01.removeClass("choosen-1");
            control01.addClass("choosen-2");
            $('option[value=21]', control01).removeAttr("selected");
            $('option[value=22]', control01).prop("selected", true);
            anchorSub1a.selectpicker('refresh');
        } else {
            $('#' + item).val(AUTO_B2);
            control01.addClass("choosen-1");
            control01.removeClass("choosen-2");
            $('option[value=22]', control01).removeAttr("selected");
            $('option[value=21]', control01).prop("selected", true);
            anchorSub1a.selectpicker('refresh');
        }
    });

    //2.Select 1a
    anchorSub1a.change(function (e) {
        valueSelect1a = anchorSub1a.val();

        if (valueSelect1a == 21) {
            $('#' + item).val(AUTO_B2);
            control01.removeClass("choosen-2");
            control01.addClass("choosen-1");
            $('option[value=11]', control01).removeAttr("selected");
            $('option[value=12]', control01).prop("selected", true);
            anchorSub1.selectpicker('refresh');
        } else {
            $('#' + item).val(AUTO_B1);
            control01.addClass("choosen-2");
            control01.removeClass("choosen-1");
            $('option[value=12]', control01).removeAttr("selected");
            $('option[value=11]', control01).prop("selected", true);
            anchorSub1.selectpicker('refresh');
        }
    });

    //3.Select 2
    anchorSub2.change(function (e) {
        valueSelect2 = anchorSub2.val();

        if (valueSelect2 == 12) {
            $('#' + item).val(MANUAL_B2);
            control02.addClass("choosen-3");
            control02.removeClass("choosen-4");

            $('option[value=21]', control02).prop("selected", true);
            $('option[value=22]', control02).removeAttr("selected");
            anchorSub2a.selectpicker('refresh');
        } else {
            $('#' + item).val(MANUAL_B1);
            if (anchorSub2a.val() == 21) {
                $('#' + item).val(MANUAL_B12);
            }
            control02.removeClass("choosen-3");
        }
    });

    //4.Select 2a
    anchorSub2a.change(function (e) {
        valueSelect2a = anchorSub2a.val();

        if (valueSelect2a == 22) {
            $('#' + item).val(MANUAL_B1);
            control02.addClass("choosen-4");
            control02.removeClass("choosen-3");

            $('option[value=11]', control02).prop("selected", true);
            $('option[value=12]', control02).removeAttr("selected");
            anchorSub2.selectpicker('refresh');
        } else {
            $('#' + item).val(MANUAL_B2);
            if (anchorSub2.val() == 11) {
                $('#' + item).val(MANUAL_B12);
            }
            control02.removeClass("choosen-4");
        }
    });
}