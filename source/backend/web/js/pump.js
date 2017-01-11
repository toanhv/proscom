var clazz;
jQuery(document).ready(function () {
    var dad1, dad2, dad3, dad4, dad5, dad6, dad7, dad8, dad9, dad10, dad11, dad12, dad13;
    dad1 = $(".item-1");
    dad2 = $(".item-2");
    dad3 = $(".item-3");
    dad4 = $(".item-4");
    dad5 = $(".item-5");
    dad6 = $(".item-6");
    dad7 = $(".item-7");
    dad8 = $(".item-8");
    dad9 = $(".item-9");
    dad10 = $(".item-10");
    dad11 = $(".item-11");
    dad12 = $(".item-12");
    dad13 = $(".item-13");

    var convection_pump_mode = $('#convection_pump_mode').val();
    var cwsp_pump_mode = $('#cwsp_pump_mode').val();
    var return_pump_mode = $('#return_pump_mode').val();
    var pressure_pump_mode = $('#pressure_pump_mode').val();
    var heat_pump_mode = $('#heat_pump_mode').val();
    var heater_resis_mode = $('#heater_resis_mode').val();

    selectMaster(dad1, convection_pump_mode);
    selectMaster(dad2, cwsp_pump_mode);
    selectMaster(dad3, return_pump_mode);
    selectMaster(dad4, pressure_pump_mode);
    selectMaster(dad5, heat_pump_mode);
    selectMaster(dad6, convection_pump_mode);
    selectMaster(dad7, cwsp_pump_mode);
    selectMaster(dad8, return_pump_mode);
    selectMaster(dad9, pressure_pump_mode);
    selectMaster(dad10, heat_pump_mode);
    selectMaster(dad11, heater_resis_mode);
    selectMaster(dad12, '00000000');
    selectMaster(dad13, '00000000');
});

function selectMaster(clazz, mode) {

    var valueSelect, valueSelect1, valueSelect1a, valueSelect2, valueSelect2a, anchorMaster, anchorSub1, anchorSub1a, anchorSub2, anchorSub2a, control01, control02;

    anchorMaster = $(".select-master", clazz);

    control01 = $(".control-01", clazz);
    control02 = $(".control-02", clazz);

    anchorSub1 = $(".select-sub-1", control01);
    anchorSub1a = $(".select-sub-2", control01);

    anchorSub2 = $(".select-sub-1", control02);
    anchorSub2a = $(".select-sub-2", control02);

    valueSelect = anchorMaster.val();
    if (mode == MANUAL_B1 || mode == MANUAL_B2 || mode == MANUAL_B12) {
        valueSelect = 0;
    }

    //Chạy lần đầu cho button master
    if (valueSelect == 1) {
        control01.show();
        control02.hide();
    } else {
        control01.hide();
        control02.show();
    }

    //Chạy lần đầu cho control 01
    valueSelect1 = anchorSub1.val();
    if (valueSelect1 == 11) {
        control01.removeClass("choosen-1");
        control01.addClass("choosen-2");
    } else {
        control01.addClass("choosen-1");
        control01.removeClass("choosen-2");
    }

    valueSelect1a = anchorSub1a.val();
    if (valueSelect1a == 21) {
        control01.removeClass("choosen-2");
        control01.addClass("choosen-1");
    } else {
        control01.addClass("choosen-2");
        control01.removeClass("choosen-1");
    }


    //Chạy lần đầu cho control 02
    valueSelect2 = anchorSub2.val();
    if (valueSelect2 == 12) {
        control02.addClass("choosen-3");
        control02.removeClass("choosen-4");
    } else {
        control02.removeClass("choosen-3");
    }

    valueSelect2a = anchorSub2a.val();
    if (valueSelect2a == 22) {
        control02.addClass("choosen-4");
        control02.removeClass("choosen-3");
    } else {
        control02.removeClass("choosen-4");
    }




    //0.Select 0
    anchorMaster.change(function (e) {
        valueSelect = anchorMaster.val();
        if (valueSelect == 1) {
            control01.show();
            control02.hide();
        } else {
            control01.hide();
            control02.show();
        }
    });

    //1.Select 1
    anchorSub1.change(function (e) {
        valueSelect1 = anchorSub1.val();

        if (valueSelect1 == 11) {
            control01.removeClass("choosen-1");
            control01.addClass("choosen-2");
            $('option[value=21]', control01).removeAttr("selected");
            $('option[value=22]', control01).prop("selected", true);
            anchorSub1a.selectpicker('refresh');
        } else {
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
            control01.removeClass("choosen-2");
            control01.addClass("choosen-1");
            $('option[value=11]', control01).removeAttr("selected");
            $('option[value=12]', control01).prop("selected", true);
            anchorSub1.selectpicker('refresh');
        } else {
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
            control02.addClass("choosen-3");
            control02.removeClass("choosen-4");

            $('option[value=21]', control02).prop("selected", true);
            $('option[value=22]', control02).removeAttr("selected");
            anchorSub2a.selectpicker('refresh');
        } else {
            control02.removeClass("choosen-3");
        }
    });

    //4.Select 2a
    anchorSub2a.change(function (e) {
        valueSelect2a = anchorSub2a.val();

        if (valueSelect2a == 22) {
            control02.addClass("choosen-4");
            control02.removeClass("choosen-3");

            $('option[value=11]', control02).prop("selected", true);
            $('option[value=12]', control02).removeAttr("selected");
            anchorSub2.selectpicker('refresh');
        } else {
            control02.removeClass("choosen-4");
        }
    });
}