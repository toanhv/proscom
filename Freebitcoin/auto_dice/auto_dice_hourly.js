bconfig = {
	maxBet: 0.00300000,
	wait: 900
};

var payout = 4;
var countLose = 10;
var countWin = 4;
var startStake = 0.00000002;
var	stake = 0.00000005;
var interest = 0.00003000; 
var confirmStop = true;
var xConfirm = new Array(20, 25, 30, 35, 40);
var maxRound = 2000;

var hilo = 'hi';

var winCount = 0;
var loseCount = 0;
var anlo = 0;
var thualo = 0;

var x = 0;
var xHight = 0;
var cWin = 0;
var counter = 0;

var balance = parseFloat($('#balance')['text']());

setParam = function() {
	$('.maxheight').val(countLose);
	$('.xbefore').val(stake['toFixed'](8));
	$('.maxloser').val(bconfig.maxBet['toFixed'](8));
}

rollDice = function() {
	if (counter > maxRound && parseFloat($('#balance')['text']()) > balance && loseCount == 0) {
		throw new Error('Stop');
	}		
	
	countLose = $('.maxheight').val();
	stake = $('.xbefore').val();
	maxBet = $('.maxloser').val();
	
	if ($('#double_your_btc_bet_lose').html() !== '') {
		if (loseCount >= countLose) {
			if (x > 0) {
				x = (x > 0.00001) ? x * 1.5 : x * 2;
			} else {
				x = stake;
			}	
			if (x > xHight) {
				xHight = x;
			}
			
			$('#double_your_btc_stake').val(x);			
		}		
		thualo++;
		loseCount++;
		winCount = 0;
	} else {
		$('#double_your_btc_stake').val(startStake);
		x = 0;
		anlo++;
		winCount ++;
		loseCount = 0;
	}
	
	if (confirmStop == true) {
		if (xConfirm.indexOf(loseCount) != -1) {
			if(!confirm('Tài khoản đang đi vào chuỗi '+ loseCount +', bạn có muốn tiếp tục?')) {
				throw new Error('Game over!');
			}
		}
	}

	if (parseFloat($('#double_your_btc_stake').val()) > maxBet) {
		x = 0;
		$('#double_your_btc_min').click();
	}
	
	$('.win-dupbo').val(loseCount);
	$('.win-next').val(winCount);
	$('.wuynh-lo').val(counter);	
	$('.check-start').html('L\u1EE3i nhu\u1EADn: <span style="color:#f00">' + Number(parseFloat($('#balance')['text']()) - balance)['toFixed'](8) + '</span> BTC');
	$('.max-bet').html('C\u01B0\u1EE3c cao nh\u1EA5t: ' + Number(xHight)['toFixed'](8) + ' BTC');
	$('.an-lo').val(anlo);
	$('.thua-lo').val(thualo);
	
	if (parseFloat($('#balance')['text']()) - balance >= interest) {
		if (confirmStop == true) {
			alert('Đã đạt lãi như kỳ vọng: ' + Number(interest)['toFixed'](8));
		}
		throw new Error('Đã đạt lãi như kỳ vọng: ' + Number(interest)['toFixed'](8));
	}

	$('#double_your_btc_bet_' + hilo + '_button').click();
	counter ++;
	setTimeout(rollDice, (bconfig.wait) + Math.round(Math.random() * 100));
};

$('nav')['prepend']('<input class="check-lose" value="0"><input class="check-win" value="0"><input class="xbefore" value="0"><input class="maxloser" value="0"><input class="maxheight" value="0"><p class="all-th"><span class="so-lan-danh"></span><br/><span class="thang-thua"></span><br/></p><label class="entry-hi">S\u1ED1 l\u1EA7n \u0111\xE1nh BET LO<input class="wuynh-hi" value="0" style="width:100%"/><input class="an-hi" value="0" style="width:50%;color:#fff;background:green"><input class="thua-hi" value="0" style="width:50%;color:#fff;background:#f00"></label><label class="entry-lo">S\u1ED1 l\u1EA7n \u0111\xE1nh BET<input class="wuynh-lo" value="0" style="width:100%"/><input class="an-lo" value="0" style="width:50%;color:#fff;background:green"><input class="win-next" value="0" style="width:50%;color:#fff;background:green"><input class="thua-lo" value="0" style="width:50%;color:#fff;background:#f00"></label><input class="win-dupbo" value="0" style="width:50%;color:#fff;background:#f00"></label><button class="check-start"></button><button class="max-bet"></button><button class="load-lai" onclick="stop()">StopNow</button>');

$('.check-lose')['css']({
    position: 'fixed',
    top: '45px',
    left: 0,
    width: '82.5px'
});
$('.check-win')['css']({
    position: 'fixed',
    top: '45px',
    left: '82.5px',
    width: '82.5px'
});
$('.win-dupbo')['css']({
    position: 'fixed',
    top: '75px',
    left: '0px',
    width: '82.5px',
    height: '30px'
});
$('.win-next')['css']({
    position: 'fixed',
    top: '75px',
    left: '82.5px',
    width: '82.5px',
    height: '30px'
});
$('.max-bet')['css']({
    position: 'fixed',
    top: '105px',
    left: 0,
    width: '165px'
});
$('.check-start')['css']({
    position: 'fixed',
    top: '230px',
    left: 0,
    width: '165px',
    background: '#ddd'
});
$('.check-stop')['css']({
    position: 'fixed',
    top: '290px',
    left: 0,
    width: '165px',
    background: '#ddd',
    cursor: 'pointer'
});
$('.all-th')['css']({
    position: 'fixed',
    top: '180px',
    display: 'none',
    right: 0,
    width: '300px',
    background: '#ddd',
    "\x62\x6F\x72\x64\x65\x72\x2D\x74\x6F\x70": '2px solid #aaa'
});
$('.entry-hi')['css']({
    position: 'fixed',
    padding: '5px',
    top: '45px',
    right: 0,
    display: 'none',
    width: '150px',
    background: '#ddd',
    cursor: 'pointer'
});
$('.entry-lo')['css']({
    position: 'fixed',
    padding: '5px',
    top: '45px',
    right: '0px',
    width: '167px',
    background: '#ddd',
    cursor: 'pointer',
    "\x62\x6F\x72\x64\x65\x72\x2D\x72\x69\x67\x68\x74": '2px solid #aaa'
});
$('.load-lai')['css']({
    position: 'fixed',
    top: '250px',
    right: 0,
    width: '167px',
    background: '#ddd',
    cursor: 'pointer'
});
$('.cuoc-lai')['css']({
    position: 'fixed',
    top: '200px',
    right: 0,
    width: '167px',
    background: '#ddd',
    cursor: 'pointer'
});
$('.maxheight')['css']({
    position: 'fixed',
    top: '300px',
    right: '100px',
    width: '67px'
});
$('.xbefore')['css']({
    position: 'fixed',
    top: '300px',
    right: '0px',
    width: '100px'
});
$('.maxloser')['css']({
    position: 'fixed',
    top: '335px',
    right: '0px',
    width: '167px'
});


$('#double_your_btc_stake').val(startStake);
$('#double_your_btc_payout_multiplier').val(payout);

stop = function() {
	document['location'] = '/';
}

setParam();
rollDice();
