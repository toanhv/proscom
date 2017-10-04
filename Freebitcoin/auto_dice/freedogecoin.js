bconfig = {
	maxBet: 100,
	wait: 900
};

var payout = 3.8;
var countLose = 9;
var countWin = 4;
var startStake = 0.04300000;
var	stake = 0.5;
var interest = 20;
var confirmStop = true;
var xConfirm = new Array(17, 25, 30, 35, 40);

var hilo = 'hi';

var winCount = 0;
var loseCount = 0;

var x = 0;

var balance = parseFloat($('#balance')['text']());

rollDice = function() {
	if (parseFloat($('#balance')['text']()) - balance >= interest) {
		alert('Đã đạt lãi như kỳ vọng: ' + interest);
		throw new Error('Đã đạt lãi như kỳ vọng: ' + interest);
	}
	
	if ($('#double_your_doge_bet_lose').html() !== '') {
		if (winCount >= countWin) {
			loseCount = countLose;
		}
		if (loseCount >= countLose) {
			x = (x > 0) ? x * 2 : stake;
			$('#double_your_doge_stake').val(x);			
		}		
		loseCount++;
		winCount = 0;
	} else {
		if (winCount == countWin) {
			if (hilo == 'lo') {
				hilo = 'hi';
			} else {
				hilo = 'lo';
			}
			x = stake;			
			$('#double_your_doge_stake').val(x);			
		} else {
			x = 0;
			$('#double_your_doge_min').click();
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

	//if (parseFloat($('#balance').html()) < (parseFloat($('#double_your_doge_stake').val()) * 2) || parseFloat($('#double_your_doge_stake').val()) > bconfig.maxBet) {
	if (parseFloat($('#double_your_doge_stake').val()) > bconfig.maxBet) {
		$('#double_your_doge_min').click();
	}

	$('#double_your_doge_bet_' + hilo + '_button').click();

	setTimeout(rollDice, (bconfig.wait) + Math.round(Math.random() * 100));
};
$('#double_your_doge_stake').val(startStake);
$('#double_your_doge_payout_multiplier').val(payout);

rollDice();