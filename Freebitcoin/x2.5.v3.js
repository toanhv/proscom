function getData(a) {
    for (var b, c = document.cookie.split("; "), d = c.length; d--; )
        if (b = c[d].split("="), b[0] === a)
            return b[1];
    return!1;
}
function higherBet() {
    $(".max-bet").text("Cược cao nhất: " + higherbet + " BTC");
}
function changeBet(a) {
    startValue = a;
}
function realtime(a) {
    var b = parseInt(a, 10), c = Math.floor(b / 3600), d = Math.floor((b - 3600 * c) / 60), e = b - 3600 * c - 60 * d;
    0 != c ? c += " Hours " : c = "", 0 != d ? d += " Minutes " : d = "", 10 > e && (e = e);
    var a = "Playing time = " + c + d + e + " Secondes";
    return a;
}
function roundnumb() {
    round == stopAt ? stopGame() : (round += 1, $(".so-lan-danh").text("Lần đánh: " + round + " / " + stopAt));
    var a = $("#balance").text(), b = (Number(a) - Number(startbalance)).toFixed(8);
    $(".check-start").html('Profit: <span style="color:#f00">' + b + "</span> BTC");
    var c = 1e8 * parseFloat(b);
    $(".max_lai").val(c), c > 100 && reset();
}
function _roundnumb() {
    round == stopAt ? stopGame() : (round += 1, $(".so-lan-danh").text("Lần đánh: " + round + " / " + stopAt));
    var a = $("#balance").text(), b = (Number(a) - Number(_startbalance)).toFixed(8);
    $(".in-check-start").html('Profit: <span style="color:#f00">' + b + "</span> BTC");
}
function multiply() {
    var a = $("#double_your_btc_stake").val(), b = (1.5 * a).toFixed(8), c = $(".in-check-lose").val();
    15 == c && (confirm("Tài khoản của bạn đang đi vào chuỗi của freebitco.in với mức chuỗi 15, tools sẽ tự dừng, chơi tiếp bấm vào OK. Dừng lại bấm HỦY !!!") || (document.location = "/")), 18 == c && (confirm("Tài khoản của bạn đang đi vào chuỗi của freebitco.in với mức chuỗi 18, tools sẽ tự dừng, chơi tiếp bấm vào OK. Dừng lại bấm HỦY !!!") || (document.location = "/")), 21 == c && (confirm("Tài khoản của bạn đang đi vào chuỗi của freebitco.in với mức chuỗi 21, tools sẽ tự dừng, chơi tiếp bấm vào OK. Dừng lại bấm HỦY!!!") || (document.location = "/")), $("#double_your_btc_stake").val(b), b > higherbet && (higherbet = b);
}
function getRandomWait() {
    var a = parseInt($(".in-check-lose").val()), b = maxWait + 50 * a;
    return console.log("Waiting for " + b + "ms before next bet."), b;
}
function startGame(a) {
    starttime = (new Date).getTime(), startValue = prompt("Bạn cược bao nhiêu :", "0.00000001"), oldbet = startValue, round = 0, gameLost = 0, gameWin = 0, reset(), 1 == x ? (console.log("Ðánh Hi random 1"), $hiButton.trigger("click")) : (console.log("Ðánh Lo random 2"), $loButton.trigger("click")), stopAt = null !== a ? a : -1
}
function stopGame() {
    stopped = !0, startValue = oldbet;
}
function reset() {
    round % 100 === 0 && 0 != round && (startValue = (1 * startValue).toFixed(8)), $(".in-check-lose").val(0), $("#double_your_btc_stake").val(startValue)
}
function deexponentize(a) {
    return 1e6 * a
}
function iHaveEnoughMoni() {
    var a = deexponentize(parseFloat($("#balance").text())), b = deexponentize($("#double_your_btc_stake").val());
    return 2 * a / 100 * (2 * b) > stopPercentage / 100
}
function stopBeforeRedirect() {
    var a = parseInt($("title").text());
    return stopBefore > a ? (stopGame(), !0) : !1
}
var startbalance = 0, _startbalance = 0, stopAt = "?", round = 0, gameLost = 0, gameWin = 0, higherbet = 0;
startbalance = $("#balance").text(), _startbalance = $("#balance").text();
var startValue = "0.00000001", stopPercentage = .001, maxWait = 800, stopped = !1, stopBefore = 2, oldbet = 1e-8, $loButton = $("#double_your_btc_bet_lo_button"), $hiButton = $("#double_your_btc_bet_hi_button"), x = Math.floor(1.2 * Math.random() + 1);
1 == x ? console.log("Random" + x, "color: #00CC00") : console.log("Random " + x, "color: #FF0000"), $(".payout_value_input").val(2), $("#double_your_btc_bet_lose").unbind(), $("#double_your_btc_bet_win").unbind();
var $min = 5, $max = 8, $max_lan_danh = 999;
$("#double_your_btc_bet_lose").bind("DOMSubtreeModified", function (a) {
    if ($(a.currentTarget).is(':contains("lose")')) {
        var b = parseInt($(".in-check-lose").val()), c = parseInt($(".wuynh-hi").val()), d = parseInt($(".wuynh-lo").val()), e = (parseInt($(".an-hi").val()), parseInt($(".thua-hi").val())), f = (parseInt($(".an-lo").val()), parseInt($(".thua-lo").val())), g = c + d;
        gameLost += 1, roundnumb(), _roundnumb(), $(".thang-thua").html('<span style="color:green">Win: ' + gameWin + " - Lost: " + gameLost + "</span>"), endtime = (new Date).getTime();
        Math.floor((endtime - starttime) / 1e3);
        if (higherBet(), g > $max_lan_danh)
            if ($(".in-check-lose").val(b + 1), b > $min && $max > b) {
                var h = d + 1, i = f + 1;
                $(".wuynh-lo").val(h), $(".thua-lo").val(i), multiply(), setTimeout(function () {
                    var a = Math.floor(2 * Math.random() + 1);
                    1 == a ? (console.log("Thua Hi random 1"), $loButton.trigger("click")) : $hiButton.trigger("click")
                }, getRandomWait())
            } else {
                var h = c + 1, j = e + 1;
                $(".wuynh-hi").val(h), $(".thua-hi").val(j), multiply(), setTimeout(function () {
                    var a = Math.floor(2 * Math.random() + 1);
                    1 == a ? (console.log("Thua Hi random 1"), $hiButton.trigger("click")) : (console.log("Thua Lo random 2"), $loButton.trigger("click"))
                }, getRandomWait())
            }
        else if ($(".in-check-lose").val(b + 1), b > $min && $max > b) {
            var h = c + 1, j = e + 1;
            $(".wuynh-hi").val(h), $(".thua-hi").val(j), multiply(), setTimeout(function () {
                var a = Math.floor(2 * Math.random() + 1);
                1 == a ? (console.log("Thua Hi random 1"), $hiButton.trigger("click")) : (console.log("Thua Lo random 2"), $loButton.trigger("click"))
            }, getRandomWait())
        } else {
            var h = d + 1, i = f + 1;
            $(".wuynh-lo").val(h), $(".thua-lo").val(i), multiply(), setTimeout(function () {
                var a = Math.floor(2 * Math.random() + 1);
                1 == a ? (console.log("Thua Lo random 1"), $loButton.trigger("click")) : (console.log("Thua Hi random 2"), $hiButton.trigger("click"))
            }, getRandomWait())
        }
    }
}), $("#double_your_btc_bet_win").bind("DOMSubtreeModified", function (a) {
    if ($(a.currentTarget).is(':contains("win")')) {
        gameWin += 1, roundnumb(), _roundnumb(), endtime = (new Date).getTime();
        Math.floor((endtime - starttime) / 1e3);
        if (higherBet(), stopBeforeRedirect())
            return;
        if (iHaveEnoughMoni()) {
            var b = parseInt($(".in-check-lose").val()), c = parseInt($(".wuynh-hi").val()), d = parseInt($(".wuynh-lo").val()), e = parseInt($(".an-hi").val()), f = parseInt($(".an-lo").val()), g = c + 1, h = d + 1, i = e + 1, j = f + 1, k = (parseInt($(".thua-lo").val()), $(".max_lai").val()), l = c + d;
            if (l > $max_lan_danh)
                if (b > $min && $max > b) {
                    if ($(".wuynh-lo").val(h), $(".an-lo").val(j), multiply(), k > 100) {
                        var k = $(".max_lai").val(0);
                        startbalance = $("#balance").text(), reset()
                    }
                    if (stopped)
                        return stopped = !1, !1
                } else {
                    if ($(".wuynh-hi").val(g), $(".an-hi").val(i), multiply(), k > 100) {
                        var k = $(".max_lai").val(0);
                        startbalance = $("#balance").text(), reset()
                    }
                    if (stopped)
                        return stopped = !1, !1
                }
            else if (b > $min && $max > b) {
                if ($(".wuynh-hi").val(g), $(".an-hi").val(i), multiply(), k > 100) {
                    var k = $(".max_lai").val(0);
                    startbalance = $("#balance").text(), reset()
                }
                if (stopped)
                    return stopped = !1, !1
            } else {
                if ($(".wuynh-lo").val(h), $(".an-lo").val(j), multiply(), k > 100) {
                    var k = $(".max_lai").val(0);
                    startbalance = $("#balance").text(), reset()
                }
                if (stopped)
                    return stopped = !1, !1
            }
        }
        setTimeout(function () {
            var a = Math.floor(2 * Math.random() + 1);
            1 == a ? (console.log("Thua Hi random 1"), $hiButton.trigger("click")) : (console.log("Thua Lo random 2"), $loButton.trigger("click"))
        }, getRandomWait())
    }
}), $("nav").prepend('<span class="check-lose" >Fighting:<br/><input value="0" class="in-check-lose"></span><button class="check-start"></button><button class="in-check-start"></button><input class="max_lai"><button class="load-lai">StopNow</button><button class="check-stop">StopWin</button>'), $(".check-lose").css({position: "fixed", top: "45px", left: 0, width: "167px"}), $(".max_lai").css({position: "fixed", top: "45px", right: 0, width: "167px", height: "30px"}), $(".in-check-lose").css({width: "167px"}), $(".in-check-start").css({position: "fixed", top: "150px", left: 0, width: "167px", background: "#ddd"}), $(".check-start").css({display: "none"}), $(".check-stop").css({position: "fixed", top: "250px", left: 0, width: "167px", background: "#ddd", cursor: "pointer"}), $(".load-lai").css({position: "fixed", top: "65px", right: 0, width: "167px", background: "#ddd", cursor: "pointer"}), $(".check-stop").click(function () {
    stopGame()
}), $(".load-lai").click(function () {
    document.location = "/";
}), startGame();
       