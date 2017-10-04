bconfig = {
	maxBet: 0.00100000,
	wait: 900
};

var payout = 3.8;
var count = 10;
var step = 0;
var startStake = 0.00000001;
var	stake = 0.00000100;
var interest = 0.00030000;
var confirmStop = true;
var xConfirm = new Array(17, 21, 25, 30, 35, 40);

var hilo = 'hi';

var winCount = 0;
var loseCount = 0;

var x = 0;
var xStep = 0;

var balance = parseFloat($('#balance')['text']());

rollDice = function() {
	if (parseFloat($('#balance')['text']()) - balance >= interest) {
		alert('Đã đạt lãi như kỳ vọng: ' + interest);
		throw new Error('Đã đạt lãi như kỳ vọng: ' + interest);
	}
	
	if ($('#double_your_btc_bet_lose').html() !== '') {
		if (loseCount >= count) {
			if (x > 0) {
				if (xStep >= step) {
					x = x * 2;
					xStep = 0;
				}
				xStep++;
			} else {
				x = stake;
			}
			$('#double_your_btc_stake').val(x);			
		}		
		loseCount++;
		winCount = 0;
	} else {
		if (winCount >= count) {
			if (hilo === 'lo') {
				hilo = 'hi';
			} else {
				hilo = 'lo';
			}
			if (x > 0) {
				if (xStep >= step) {
					x = x * 2;
					xStep = 0;
				}
				xStep++;
			} else {
				x = stake;
			}
			$('#double_your_btc_stake').val(x);			
		} else {
			x = 0;
			$('#double_your_btc_min').click();
		}
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

	if (parseFloat($('#balance').html()) < (parseFloat($('#double_your_btc_stake').val()) * 3) || parseFloat($('#double_your_btc_stake').val()) > bconfig.maxBet) {
		$('#double_your_btc_min').click();
	}

	$('#double_your_btc_bet_' + hilo + '_button').click();

	setTimeout(rollDice, (bconfig.wait) + Math.round(Math.random() * 100));
};
$('.double_your_btc_link').click();
//$('#newer_bet_history').click();
$('#double_your_btc_stake').val(startStake);
$('#double_your_btc_payout_multiplier').val(payout);

rollDice();