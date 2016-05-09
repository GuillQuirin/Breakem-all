"use strict";

var scroll = {
	init : function(clickSelector, sectionSelector){
		if(clickSelector && sectionSelector){
			var cS = jQuery(clickSelector);
			var sS = jQuery(sectionSelector);

			scroll.clickEvent(cS, sS);
		}else{
			console.log("Function scroll.init() is missing some parameters");
		}
	},
	clickEvent : function(clickSelector, sectionSelector){
		if(clickSelector && sectionSelector){
			clickSelector.click(function(){
				scroll.toAnchor(sectionSelector);
			});
		}else{
			console.log("Function scroll.clickEvent() is missing some parameters");
		}
	},
	toAnchor : function(selector){
		if(selector){
			var anchor = jQuery(selector);
	    	jQuery('html,body').animate({scrollTop: anchor.offset().top},'slow');
    	}else{
    		console.log("Function scroll.toAnchor() is missing some parameters");
    	}
	}	
};

scroll.init("#classement-header-scroll-down", '.classement-content-wrapper');

	

