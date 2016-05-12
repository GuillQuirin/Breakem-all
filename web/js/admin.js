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
		platformModule.openForm(".admin-btn-modify");
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
	//Les formulaires sont tous différents
	createPlatformsIhm : function(){
		platformModule.dataShow("admin/getPlatformsData", function(result){
			result = jQuery.parseJSON(result);
			jQuery.each(result, function(i, field){
				jQuery(".admin-wrapper.platforms").append(

					"<div class='admin-data-ihm align'>" +

						"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>" + field.name + "</span></div></div>" +
						"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span>" + field.description + "</span></div></div>" +
						"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper'><img class='img-cover' src='" + field.img + "'></div></div></div>" +

						"<div class='admin-data-ihm-btn hidden'>" +
							"<button class='admin-btn-default admin-btn-modify' type='button'><span>Modifier</span></button>" +  
							"<button class='admin-btn-default admin-btn-delete' type='button'><span>Supprimer</span></button>" + 
						"</div>" + 

					"<div>"
				);
			});
			platformModule.ihmElemHover();
		});
	},
	ihmElemHover : function(){
		$('.admin-data-ihm').hover(
		  function() {
		    $( this ).find('.admin-data-ihm-btn').removeClass( "hidden" );
		  }, function() {
		    $( this ).find('.admin-data-ihm-btn').addClass( "hidden" );
		  }
		);
	},
	openForm : function(selector){
		jQuery(selector).click(function(){
			jQuery(".admin-data-ihm").append(
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
			);
		});
	}
};




