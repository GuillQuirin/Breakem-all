"use strict";

window.addEventListener('load', function load(){
	window.removeEventListener('load', load, false);
	onglet.init();
	platformModule.init();
});

var onglet = {
	init : function(){
		onglet.onClick("#admin-onglet-platforms", "#admin-onglet-platforms-wrapper");
		onglet.onClick("#admin-onglet-membres", "#admin-onglet-membres-wrapper");
		onglet.onClick("#admin-onglet-reports", "#admin-onglet-reports-wrapper");
		onglet.onClick("#admin-onglet-team", "#admin-onglet-team-wrapper");
	},
	onClick : function(btnClick, ongletSelector){
		jQuery(btnClick).click(function(){
			jQuery(".admin-onglet-li").removeClass('active');
			jQuery(this).addClass('active');
			jQuery(".admin-wrapper").css('display', 'none');
			onglet.show(ongletSelector);
		});
	},
	hide : function(selector){
		jQuery(selector).fadeOut();
	},
	show : function(selector){
		jQuery(selector).fadeIn();
	}
};

var platformModule = {
	init : function(){
		platformModule.createPlatformsIhm();
	},
	dataShow : function(url, callback){
		if(callback){
			jQuery.ajax({
			 	url: url,
			 	type: 'GET',
			 	success: function(result){			 					 		
			 		callback(result);
			 	}
			});
		}else{
			console.log("Aucun élement sur dataShow()");
		}
	},
	ihmElemHover : function(){
		$('.admin-data-ihm').hover(
		  function() {
		    $( this ).find('.admin-data-ihm-btn').removeClass( "hidden" );
		  }, function() {
		    $( this ).find('.admin-data-ihm-btn').addClass( "hidden" );
		  }
		);
	}	
};




