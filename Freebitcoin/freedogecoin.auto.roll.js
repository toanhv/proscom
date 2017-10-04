bconfig = {
  maxBet: 3,
  wait: 300,
  toggleHilo:false
};

balance = parseFloat($('#balance').html());
hilo = 'hi';
multiplier = 2;
rollDice = function() {
	if(parseFloat($('#balance').html()) - balance >= 5) {
		window.location.href = '/';
	}
	
	var multiplier_digit = parseFloat($('#multiplier_first_digit').html() + $('#multiplier_second_digit').html() + $('#multiplier_third_digit').html() + $('#multiplier_fourth_digit').html() + $('#multiplier_fifth_digit').html());

  if ($('#double_your_doge_bet_lose').html() !== '' && (multiplier_digit > 5250 || multiplier_digit < 4750)) {
    $('#double_your_doge_2x').click();
    $('#double_your_doge_3x').click();
    $('#double_your_doge_4x').click();
    //$('#double_your_doge_5x').click();

    multiplier++;
    if(bconfig.toggleHilo)
		toggleHiLo();
  } else {
    $('#double_your_doge_min').click();
    multiplier = 3;
  }


  if (parseFloat($('#balance').html()) < (parseFloat($('#double_your_doge_stake').val()) * 3) ||
    parseFloat($('#double_your_doge_stake').val()) > bconfig.maxBet) {
    $('#double_your_doge_min').click();
  }


  $('#double_your_doge_bet_' + hilo + '_button').click();


  setTimeout(rollDice, (multiplier * bconfig.wait) + Math.round(Math.random() * 100));
};


toggleHiLo = function() {
  if (hilo === 'lo') {
    hilo = 'lo';
  } else {
    hilo = 'lo';
  }
};


rollDice();