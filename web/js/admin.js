"use strict";

var onglet = {
	init : function(){
		onglet.onClick("#configuration-onglet-platforms", "#configuration-onglet-platforms-wrapper");
		onglet.onClick("#configuration-onglet-membres", "#configuration-onglet-membres-wrapper");
	},
	onClick : function(btnClick, ongletSelector){
		jQuery(btnClick).click(function(){
			jQuery(".configuration-wrapper").css('display', 'none');
			onglet.show(ongletSelector);
		});
	},
	hide : function(selector){
		jQuery(selector).fadeOut();
	},
	show : function(selector){
		jQuery(selector).fadeIn();
	}
}

onglet.init();