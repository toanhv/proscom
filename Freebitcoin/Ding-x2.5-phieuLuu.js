// ==UserScript==
// @name        Ding x2.5(>0.03)
// @namespace   ...
// @description Odd x2.5, Profit 2.5
// ==OpenUserJS==
// @author ding2020
// @collaborator DingBiz
// ==/OpenUserJS==
// @include     https://freebitco.in/*
// @run-at      document-end
// @grant       GM_addStyle
// @grant       GM_getResourceURL
// @grant		GM_xmlhttpRequest
// @grant       unsafeWindow
// @version     0.0.1
// @icon        https://freebitco.in/favicon.ico
// @credit      ...
// ==/UserScript==

(function() {
    var _maxProfitPercent = 1.2;
    var _startBalance = $('#balance').text();
    function higherBet() {
        $(".max-bet").text("Cược cao nhất: " + higherbet + " BTC");
    }

    function changeBet(a) {
        startValue = a;
    }

    function realtime(a) {
        var b = parseInt(a, 10),
            c = Math.floor(b / 3600),
            d = Math.floor((b - 3600 * c) / 60),
            e = b - 3600 * c - 60 * d;
        if(0 != c)
            c += " Hours ";
        else
            c = "";
        if(0 != d)
            d += " Minutes ";
        else
            d = "";
        if(10 > e) (e = e);
        var a = "Playing time = " + c + d + e + " Secondes";
        return a;
    }

    function roundnumb() {
        if(round == stopAt)
            stopGame();
        else{
            round += 1;
            $(".so-lan-danh").text("Lần đánh: " + round + " / " + stopAt);
        }
        var a = $("#balance").text(),
            b = (Number(a) - Number(startbalance)).toFixed(8);
        $(".check-start").html('Lợi nhuận: <span style="color:#f00">' + b + "</span> BTC");
    }

    function multiply() {
        var d = $("#double_your_btc_stake").val(),
            e = (1 * d).toFixed(8);
        $(".win-dupbo").val();
        $("#double_your_btc_stake").val(e);
        if(e > higherbet) (higherbet = e);
    }

    function multiply_2() {
        if (($('#balance').text() / _startBalance) >= _maxProfitPercent) stopGame();
        var a = $("#double_your_btc_stake").val(),
            b = $(".xbefore").val(),
            c = 2e-8 * b,
            d = $(".maxloser").val(),
            e = (a * b).toFixed(8);
        if(e > c){
            multi = (2 * a).toFixed(8);
            if(multi > d)(multi = (1e-8 * b).toFixed(8));
            $("#double_your_btc_stake").val(multi);
        }
        else $("#double_your_btc_stake").val(e);
    }

    function getRandomWait() {
        var a = parseInt($(".win-dupbo").val()),
            b = maxWait + 50 * a;
        return console.log("Đang đợi " + b + "ms trước khi đặt cược tiếp theo."), b;
    }

    function startGame(a) {
        starttime = (new Date).getTime();
        startValue = 0.00000002;
        checkch = 7;
        xb = 50;
        ma = _startBalance*0.1['toFixed'](8);
        oldbet = startValue;
        $(".xbefore").val(xb);
        $(".maxloser").val(ma);
        $(".maxheight").val(checkch);
        round = 0; gameLost = 0; gameWin = 0; reset();
        if(1 == x)
            $hiButton.trigger("click");
        else
            $loButton.trigger("click");
        stopAt = null !== a ? a : -1;
    }

    function stopGame() {
        stopped = !0;
        startValue = oldbet;
    }

    function reset() {
        if(round % 100 === 0 && 0 != round)
            (startValue = (1 * startValue).toFixed(8));
        $("#double_your_btc_stake").val(startValue);
    }

    function deexponentize(a) {
        return 1e6 * a;
    }

    function iHaveEnoughMoni() {
        var a = deexponentize(parseFloat($("#balance").text())),
            b = deexponentize($("#double_your_btc_stake").val());
        return 2 * a / 100 * (2 * b) > stopPercentage / 100;
    }

    function stopBeforeRedirect() {
        var a = parseInt($("title").text());
        return stopBefore > a ? (stopGame(), !0) : !1;
    }
    var startbalance = 0,
        stopAt = "?",
        round = 0,
        gameLost = 0,
        gameWin = 0,
        higherbet = 0;
    startbalance = $("#balance").text();
    var startValue = "0.00000002",
        stopPercentage = 0.001,
        maxWait = 500,
        stopped = !1,
        stopBefore = 2,
        oldbet = 1e-8.toFixed(8),
        xbefore = 100,
        maxloser = 64e-5.toFixed(8),
        $loButton = $("#double_your_btc_bet_lo_button"),
        $hiButton = $("#double_your_btc_bet_hi_button"),
        x = Math.floor(2 * Math.random() + 1);
    $("#double_your_btc_bet_lose").unbind();
    $("#double_your_btc_bet_win").unbind();
    $("#double_your_btc_bet_lose").bind("DOMSubtreeModified", function(a) {
        if ($(a.currentTarget).is(':contains("lose")')) {
            var b = parseInt($(".win-dupbo").val()),
                c = parseInt($(".maxheight").val()),
                d = parseInt($(".xbefore").val()),
                e = (parseInt($(".maxloser").val()), parseInt($(".wuynh-hi").val()), parseInt($(".wuynh-lo").val())),
                f = (parseInt($(".an-hi").val()), parseInt($(".thua-hi").val()), parseInt($(".an-lo").val()), parseInt($(".thua-lo").val()));
            if(0 == c)
                alert("Số max cao nhất chưa nhập !");
            if(0 == d)
                alert("Số cược nhân lên đầu chưa nhập !");
            gameLost += 1; roundnumb();
            $(".thang-thua").html('<span style="color:green">Win: ' + gameWin + " - Lost: " + gameLost + "</span>"); endtime = (new Date).getTime();
            var g = (Math.floor((endtime - starttime) / 1e3), parseInt($(".win-next").val()));
            parseInt($(".win-dupbo").val());
            higherBet(); $(".win-dupbo").val(b + 1);
            var h = e + 1,
                i = f + 1,
                b = parseInt($(".check-win").val());
            if ($(".wuynh-lo").val(h), $(".thua-lo").val(i), g >= c){
                $(".check-win").val(b + 1);
                multiply_2();
                setTimeout(function() {
                    var a = Math.floor(2 * Math.random() + 1);
                    if(1 == a)
                        $loButton.trigger("click");
                    else
                        $hiButton.trigger("click");
                },getRandomWait());
            }
            else {
                var j = parseInt($(".check-lose").val());
                if(1 == j)
                    multiply_2();
                else {
                    $(".win-next").val(0);$(".check-lose").val(0); $(".check-win").val(0); multiply(); reset();
                }
                setTimeout(function() {
                    var a = Math.floor(2 * Math.random() + 1);
                    if(1 == a)
                        $loButton.trigger("click");
                    else
                        $hiButton.trigger("click");
                }, getRandomWait());
            }
        }
    });
    $("#double_your_btc_bet_win").bind("DOMSubtreeModified", function(a) {
        if ($(a.currentTarget).is(':contains("win")')) {
            console.clear();
            gameWin += 1; roundnumb(); endtime = (new Date).getTime();
            Math.floor((endtime - starttime) / 1e3);
            if (higherBet(), stopBeforeRedirect()) return;
            if (iHaveEnoughMoni()) {
                var b = (parseInt($(".wuynh-hi").val()), parseInt($(".wuynh-lo").val())),
                    c = (parseInt($(".an-hi").val()), parseInt($(".an-lo").val())),
                    d = b + 1,
                    e = c + 1,
                    f = (parseInt($(".thua-lo").val()), parseInt($(".check-win").val()), parseInt($(".win-next").val())),
                    g = parseInt($(".win-dupbo").val()),
                    h = parseInt($(".check-lose").val()),
                    i = parseInt($(".check-win").val()),
                    j = parseInt($(".maxheight").val());
                if ($(".wuynh-lo").val(d), $(".an-lo").val(e), $(".win-next").val(f + 1), g >= j ? ($(".check-lose").val(h + 1), multiply_2()) : ($(".win-dupbo").val(0), reset()), g >= j && h >= 1 && ($(".win-next").val(0), $(".check-lose").val(0), $(".check-win").val(0), $(".win-dupbo").val(0), multiply(), reset()), f >= j && i >= 1 && ($(".win-next").val(0), $(".check-lose").val(0), $(".check-win").val(0), $(".win-dupbo").val(0), multiply(), reset()), stopped) return stopped = !1, !1;
            }
            setTimeout(function() {
                var a = Math.floor(2 * Math.random() + 1);
                if(1 == a)
                    $loButton.trigger("click");
                else
                    $hiButton.trigger("click");
            }, getRandomWait());
        }
    });
    $(".payout_value_input").val(2.5);
        $("nav").prepend('<input class="check-lose" value="0"><input class="check-win" value="0"><input class="xbefore" value="0"><input class="maxloser" value="0"><input class="maxheight" value="0"><p class="all-th"><span class="so-lan-danh"></span><br/><span class="thang-thua"></span><br/></p><label class="entry-hi">Số lần đánh BET LO<input class="wuynh-hi" value="0" style="width:100%"/><input class="an-hi" value="0" style="width:50%;color:#fff;background:green"><input class="thua-hi" value="0" style="width:50%;color:#fff;background:#f00"></label><label class="entry-lo">Số lần đánh BET<input class="wuynh-lo" value="0" style="width:100%"/><input class="an-lo" value="0" style="width:50%;color:#fff;background:green"><input class="win-next" value="0" style="width:50%;color:#fff;background:green"><input class="thua-lo" value="0" style="width:50%;color:#fff;background:#f00"></label><input class="win-dupbo" value="0" style="width:50%;color:#fff;background:#f00"></label><button class="check-start"></button><button class="max-bet"></button><button class="load-lai">StopNow</button><button class="cuoc-lai">Cược lại</button><button class="check-stop">StopWin</button>');
    $(".check-lose").css({
        position: "fixed",
        top: "45px",
        left: 0,
        width: "82.5px"
    }); $(".check-win").css({
        position: "fixed",
        top: "45px",
        left: "82.5px",
        width: "82.5px"
    }); $(".win-dupbo").css({
        position: "fixed",
        top: "75px",
        left: "0px",
        width: "82.5px",
        height: "30px"
    }); $(".win-next").css({
        position: "fixed",
        top: "75px",
        left: "82.5px",
        width: "82.5px",
        height: "30px"
    }); $(".max-bet").css({
        position: "fixed",
        top: "105px",
        left: 0,
        width: "165px"
    }); $(".check-start").css({
        position: "fixed",
        top: "180px",
        left: 0,
        width: "165px",
        background: "#ddd"
    }); $(".check-stop").css({
        position: "fixed",
        top: "290px",
        left: 0,
        width: "165px",
        background: "#ddd",
        cursor: "pointer"
    }); $(".all-th").css({
        position: "fixed",
        top: "180px",
        display: "none",
        right: 0,
        width: "300px",
        background: "#ddd",
        "border-top": "2px solid #aaa"
    }); $(".entry-hi").css({
        position: "fixed",
        padding: "5px",
        top: "45px",
        right: 0,
        display: "none",
        width: "150px",
        background: "#ddd",
        cursor: "pointer"
    }); $(".entry-lo").css({
        position: "fixed",
        padding: "5px",
        top: "45px",
        right: "0px",
        width: "167px",
        background: "#ddd",
        cursor: "pointer",
        "border-right": "2px solid #aaa"
    }); $(".load-lai").css({
        position: "fixed",
        top: "250px",
        right: 0,
        width: "167px",
        background: "#ddd",
        cursor: "pointer"
    }); $(".cuoc-lai").css({
        position: "fixed",
        top: "200px",
        right: 0,
        width: "167px",
        background: "#ddd",
        cursor: "pointer"
    }); $(".maxheight").css({
        position: "fixed",
        top: "300px",
        right: "100px",
        width: "67px"
    }); $(".xbefore").css({
        position: "fixed",
        top: "300px",
        right: "0px",
        width: "100px"
    }); $(".maxloser").css({
        position: "fixed",
        top: "335px",
        right: "0px",
        width: "167px"
    }); $(".load-lai").click(function() {
        document.location = "/";
    });
    $(".check-stop").click(function(){
        stopGame();
    });
    $(".cuoc-lai").click(function() {
        startGame();
    });
    startGame();
})();