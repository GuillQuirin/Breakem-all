"use strict";

var tournamentModule = {
	init: function(){
		tournamentModule.setAdminWrapper();
		tournamentModule.setTournamentNav();

		tournamentModule.createTournoiIhm();
	},

	//Setter
	setAdminWrapper : function(){
		this._adminWrapper = $(".admin-wrapper.tournament");
	},
	setTournamentNav : function(){
		this._tournamentNav = $(".tournament-navbar");
	},

	//Getter
	getAdminWrapper : function(){
		return this._adminWrapper;
	},
	getTournamentNav : function(){
		return this._tournamentNav;
	},

	//Functions

	createTournoiIhm : function(){
		ajaxRequest("admin/getTournamentData", "GET", function(result){	
			console.log(result);							
				jQuery.each(result, function(i, field){				
					tournamentModule.getAdminWrapper().append(				
						"<div class='admin-data-ihm align'>" +

							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize tournament-nom-g'>" + field.status + "</span></div></div>" +
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-startDate-g'>" + field.startDate + "</span></div></div>" +
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-endDate-g'>" + field.endDate + "</span></div></div>" +
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-name-g'>" + field.name + "</span></div></div>" +
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-description-g'>" + field.description + "</span></div></div>" +
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-gameName-g'>" + field.gameName + "</span></div></div>" +							
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-pName-g'>" + field.pName + "</span></div></div>" +
							"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='tournament-maxPlayer-g'>" + field.maxPlayer + "</span></div></div>" +							

							"<div class='admin-data-ihm-btn hidden relative'>" +								
								"<button class='admin-btn-default admin-btn-delete platform-btn-delete" + i + "' type='button'><span>Supprimer</span></button>" + 						
							"</div>" +

							"<div class='index-modal platforms hidden-fade hidden'>" +

								"<div class='index-modal-this index-modal-login align'>" +
								
									"<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>" +
										"<form id='platform-form'>" +		
											"<input type='text' name='id' class='hidden platform-id-p' value='" + field.id + "'>" + 	    
										    "<label for='email'>Nom :</label>" +
										    "<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value='" + field.name + "'>" +
										     "<label for='email'>Description :</label>" +
										    "<textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'>" + field.description + "</textarea>" +							    							  
										    "<div class='admin-avatar-wrapper m-a'>" +																	
												"<img class='admin-avatar img-cover platform-img' src='" + field.img + "' title='Image de profil' alt='Image de profil'>" +										
											"</div>" +	
											"<div class='text-center admin-input-file'>" +								 
											"<input type='file' name='profilpic'>" +
											"</div>" +
										    "<button type='button' class='platform-submit-form-btn" + i + " btn btn-pink'><a>Valider</a></button>" +
								  		"</form>" +
								  	"</div>" + 	 
								"</div>" +
							"</div>" +
						"<div>" 
					);			
					/*jQuery(".platform-btn-delete" + i).click(function(){
						platformModule.postDataDelete(i);
					});
					jQuery(".platform-submit-form-btn" + i).click(function(){
						platformModule.postDataUpdate(i);					
						navbar.form.smoothClosing();	
					});*/			
				});			
				admin.ihmElemHover();		
				navbar.setOpenFormAll();	
				navbar.form.admin();	
				navbar.form.closeFormKey();
		        navbar.form.closeFormClick();			
			});		
	}
};