"use strict";

var platformModule = {
	init : function(){

		platformModule.setInsertBtn();
		platformModule.setPlatformAdd();

		platformModule.createPlatformsIhm();
		//platformModule.postDataInsert();
	},

	//Setter
	setPlatformAdd : function(){
		this._setPlatformAdd = jQuery('.platform-add');
	},
	setInsertBtn : function(){
		this._setInsertBtn = jQuery('#platform-add-btn');
	},

	//Getter
	getPlatformAdd : function(){
		return this._setPlatformAdd;
	},

	getSubmitBtn : function(i){
		return jQuery('.platform-submit-form-btn' + i);
	},

	getDeleteBtn : function(i){
		return jQuery('.platform-btn-delete' + i);
	},

	getInsertBtn : function(){
		return this._setInsertBtn;	
	},

	//Function
	ihmElemHover : function(){
		jQuery('.admin-data-ihm').hover(
		  function() {
		    jQuery(this).find('.admin-data-ihm-btn').removeClass( "hidden" );
		  }, function(e) {
		    jQuery(this).find('.admin-data-ihm-btn').addClass( "hidden" );
		  }
		);
	},
	createPlatformsIhm : function(){		
		ajaxRequest("admin/getPlatformsData", "GET", function(result){	
		console.log(result);					
			jQuery.each(result, function(i, field){
				jQuery(".admin-wrapper.platforms").append(				

					"<div class='admin-data-ihm align'>" +

						"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize platform-nom-g'>" + field.name + "</span></div></div>" +
						"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='platform-description-g'>" + field.description + "</span></div></div>" +
						"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper'><img class='img-cover' src='" + field.img + "'></div></div></div>" +

						"<div class='admin-data-ihm-btn hidden relative'>" +
							"<button class='admin-btn-default admin-btn-modify open-form' type='button'><span>Modifier</span></button>" +  
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
				jQuery(".platform-btn-delete" + i).click(function(){
					platformModule.postDataDelete(i);
				});
				jQuery(".platform-submit-form-btn" + i).click(function(){
					platformModule.postDataUpdate(i);					
					navbar.form.smoothClosing();	
				});
			});	
			platformModule.ihmElemHover();		
			navbar.setOpenFormAll();		
			navbar.form.closeFormKey();
	        navbar.form.closeFormClick();
			navbar.form.admin();			
		});
	},
	postDataInsert : function(){
		platformModule.getInsertBtn().click(function(){
		platformModule.getPlatformAdd().append(
			"<div class='index-modal platforms hidden-fade hidden'>" +

				"<div class='index-modal-this index-modal-login align'>" +
				
					"<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>" +
						"<form id='platform-form'>" +		
							"<input type='text' name='id' class='hidden platform-id-p' value=''>" + 	    
						    "<label for='email'>Nom :</label>" +
						    "<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value=''>" +
						     "<label for='email'>Description :</label>" +
						    "<textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'></textarea>" +							    							  
						    "<div class='admin-avatar-wrapper m-a'>" +																	
								"<img class='admin-avatar img-cover platform-img' src='' title='Image de profil' alt='Image de profil'>" +										
							"</div>" +	
							"<div class='text-center admin-input-file'>" +								 
							"<input type='file' name='profilpic'>" +
							"</div>" +
						    "<button type='button' class='platform-submit-form-btn btn btn-pink'><a>Valider</a></button>" +
				  		"</form>" +
				  	"</div>" + 	 
				"</div>" +
			"</div>" 
		);
		navbar.setOpenFormAll();		
		navbar.form.closeFormKey();
        navbar.form.closeFormClick();	
		/*jQuery.ajax({
			url: "admin/deletePlatformData", 
			type: "POST",
			data: allData,
			success: function(result){						
				console.log("Plateforme supprimée");			
				btn.parent().parent().remove();
			},
		 	error: function(result){
		 		throw new Error("Couldn't delete this platform", result);
		 	}
		});*/
		});
	},
	postDataUpdate : function(i){
		var btn = platformModule.getSubmitBtn(i);						

			var id = btn.parent().find(jQuery('.platform-id-p')).val();
			var name = btn.parent().find(jQuery('.platform-nom-p')).val();
			var description = btn.parent().find(jQuery('.platform-description-p')).val();		

			//Plus rapide de créer l'objet en une fois si il y'a peu de data
			var allData = {id : id, name : name, description : description};					

			jQuery.ajax({
			 	url: "admin/updatePlatformsData",
			 	type: "POST",
			 	data: allData,
			 	success: function(result){			 		 						 					 
					console.log("Plateforme mise à jour");
					var ihm = btn.parent().parent().parent().parent().parent();			
					console.log("platform", ihm.find('.grid-md-4 > .admin-data-ihm-elem > .platform-nom-g'));

					//Plus rapide que refaire une demande coté serv pour les données
					ihm.find('.grid-md-4 > .admin-data-ihm-elem > .platform-nom-g').html(name);			
					ihm.find('.grid-md-4 > .admin-data-ihm-elem > .platform-description-g').html(description);			
			 	},
			 	error: function(result){
			 		throw new Error("Couldn't update this platform", result)
		 		}
		});		
	},
	postDataDelete : function(i){
		var btn = platformModule.getDeleteBtn(i);
		
		var allData = {id : btn.parent().parent().find(jQuery('.platform-id-p')).val()};		

		jQuery.ajax({
			url: "admin/deletePlatformData", 
			type: "POST",
			data: allData,
			success: function(result){						
				console.log("Plateforme supprimée");			
				btn.parent().parent().remove();
			},
		 	error: function(result){
		 		throw new Error("Couldn't delete this platform", result);
		 	}
		});
	}
};



