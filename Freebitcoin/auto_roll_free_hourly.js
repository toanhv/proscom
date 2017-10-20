// ==UserScript==
// @name Auto roll free 
// @namespace   ...
// @description Claim Free
// ==OpenUserJS==
// @author hoangtoanit
// @collaborator hoangtoanit
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

var timer = undefined;
var counter = 0;
var remain = 60*6;

function try_roll(){
    var x = document.querySelector("#free_play_form_button"),
        myRP = document.getElementsByClassName("user_reward_points"),
        y = document.getElementById("bonus_container_free_points"),
        z = document.getElementById("bonus_container_fp_bonus");   
    if(y == null){
        if(parseInt(myRP[0].innerText.replace(/,/g, '')) >= 1200)
			RedeemRPProduct('free_points_100');
        else if(parseInt(myRP[0].innerText.replace(/,/g, '')) >= 600)
			RedeemRPProduct('free_points_50');
        else if(parseInt(myRP[0].innerText.replace(/,/g, '')) >= 120)
			RedeemRPProduct('free_points_10');
        else if(parseInt(myRP[0].innerText.replace(/,/g, '')) >= 12)
			RedeemRPProduct('free_points_1');
    }
    if(z==null && parseInt(myRP[0].innerText.replace(/,/g, '')) >= 4400){
		setTimeout(function(){
            RedeemRPProduct('fp_bonus_1000');
        }, 2000); 
    }
	if(z==null && parseInt(myRP[0].innerText.replace(/,/g, '')) >= 2800){
		setTimeout(function(){
            RedeemRPProduct('fp_bonus_500');
        }, 2000); 
    }
    if(x && x.style["display"] != "none"){
        setTimeout(function(){
            x.click();
        }, 3000);    
		setTimeout(function(){
            GenerateMainDepositAddress();
        }, 5000);  
        remain = 60*6;
        counter = 0;
    }
}

function auto_roll(){
    if(document.location.href.indexOf("freebitco.in") == -1)
        return;
    try_roll();
    timer = setInterval(count_up, 10*1000); /* 1 minutes */
}
auto_roll();
