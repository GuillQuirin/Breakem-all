"use strict";
window.addEventListener('load', function load(){
	window.removeEventListener('load', load, false);
	onglet.init();
	table.init();
});

var onglet = {
	init : function(){
		onglet.onClick("#configuration-onglet-platforms", "#configuration-onglet-platforms-wrapper");
		onglet.onClick("#configuration-onglet-membres", "#configuration-onglet-membres-wrapper");
		onglet.onClick("#configuration-onglet-reports", "#configuration-onglet-reports-wrapper");
		onglet.onClick("#configuration-onglet-team", "#configuration-onglet-team-wrapper");
	},
	onClick : function(btnClick, ongletSelector){
		jQuery(btnClick).click(function(){
			jQuery(".configuration-onglet-li").removeClass('active');
			jQuery(this).addClass('active');
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
};

var table = {
	init : function(){
		table.openForm(".admin-form-button-modify");		
	},
	openForm : function(btnClick){
		jQuery(btnClick).click(function(){
			jQuery("body").css('overflow', 'hidden');

			//Get
			jQuery.ajax({
			 	url: 'creationtournoi/getGameTypes',
			 	type: 'GET',
			 	success: function(result){			 		
			 		console.log("result", result);
			 		jQuery.each(result, function(i, field){
			 			console.log(field);
			 		});
			 	}
			});
		});
	},
};

			/*
			PAS TOUCHE FDP

			jQuery("#content").append(
				"<div class='index-modal'>" +

					"<div class='index-modal-login align form-bg-active'>" +
					
						"<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>" +
							"<form id='login-form'>" +			    
							    "<label for='email'>Nom :</label>" +
							    "<input class='input-default admin-form-input-w' id='nom' name='nom' type='text' placeholder='Nom'>" +
							     "<label for='email'>Description :</label>" +
							    "<textarea class='input-default admin-form-input-w' id='description' name='description' type='text' placeholder='Description'></textarea>" +							    							  
							    "<div class='configuration-avatar-wrapper m-a'>" +																	
									"<img class='configuration-avatar img-cover' src='http://image.noelshack.com/fichiers/2016/19/1463057819-11218700-10205453100640362-5678590399881432992-n.jpg' title='Image de profil' alt='Image de profil'>" +										
								"</div>" +	
								"<div class='text-center admin-input-file'>" +								 
								"<input type='file' name='profilpic'>" +
								"</div>" +
							    "<button type='button' class='btn btn-pink'><a>Valider</a></button>" +
					  		"</form>" +
					  	"</div>" + 	 
					"</div>" +
				"</div>" 
			);*/





