"use strict";

var platformModule = {
	init : function(){		
		platformModule.setAdminDataElTitle();
		platformModule.setAdminWrapper();
		platformModule.setPlatformAdd();
		platformModule.setPlatformNav();		
		platformModule.setPlatformAddBtn();

		platformModule.postDataInsert();
		platformModule.createPlatformsIhm();
	},

	//Setter
	setPlatformAdd : function(){
		this._setPlatformAdd = jQuery('.platform-add-wrapper');
	},
	setPlatformAddBtn : function(){
		this._setPlatformAddBtn = jQuery('#platform-add-btn');
	},

	setAdminWrapper : function(){
		this._adminWrapper = jQuery(".admin-wrapper.platforms");
	},

	setPlatformNav : function(){
		this._setPlatformNav = jQuery('.platform-navbar');
	},

	setAdminDataElTitle : function(){
		this._setAdminDataElTitle = jQuery('.admin-data-ihm-title');
	},

	//Getter
	getAdminDataElTitle : function(){
		return this._setAdminDataElTitle;
	},

	getPlatformNav : function(){
		return this._setPlatformNav;
	},

	getPlatformAddBtn : function(){
		return this._setPlatformAddBtn;
	},

	getAdminWrapper : function(){
		return this._adminWrapper;
	},

	getSubmitBtn : function(i){
		return jQuery('.platform-submit-form-btn' + i);
	},

	getDeleteBtn : function(i){
		return jQuery('.platform-btn-delete' + i);
	},

	getPlatformAddBtn : function(){
		return this._setPlatformAddBtn;
	},

	//Function
	
	//Check si platform est vide
	isEmpty : function(callback){
		var c = 0;
		var ret;
		if(callback){
			ajaxRequest("admin/getPlatformsData", "GET", function(result){						
				c = result.length;								
				if(c == 0){					
					ret = true;
					callback(ret);
				}else{	
					ret = false;
					callback(ret);													
				}
			});			
		}else{
			console.log("Missing isEmpty callback");
		}			
	},	
	//Retire les titles si vide
	toggleIfEmpty : function(){
		platformModule.isEmpty(function(bool){
			if(bool){
				platformModule.getAdminDataElTitle().hide();
			}else{
				platformModule.getAdminDataElTitle().show();
			}
		});
	},
	//Creation de l'ihm
	createPlatformsIhm : function(){	
						
			platformModule.toggleIfEmpty();
		
			platformModule.getAdminDataElTitle().show();
			jQuery.ajax({
		 	url: "admin/getPlatformsData",
		 	success: function(result){
		 		result = tryParseData(result);
		 		onglet.getAdminWrapper().empty();
		 		jQuery.each(result, function(i, field){			
		 			onglet.getAdminWrapper().append(
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
		 		admin.ihmElemHover();		
				navbar.setOpenFormAll();	
				navbar.form.admin();	
				navbar.form.closeFormKey();
		        navbar.form.closeFormClick();		
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	
		return false;	
	},
	//Insert sur le formulaire d'ajout
	postDataInsert : function(){		
		platformModule.getPlatformNav().append(
			'<div class="row align">' +
				'<div class="grid-md-3 platform-search-wrapper">' +
					'<form id="platform-search-form">' +					
						'<input type="text" class="platform-search-input input-default" id="platform-search-input" name="platform-search-input" placeholder="Rechercher une Plateforme">' +
					'</form>' +
				'</div>' +
				'<div class="grid-md-3 platform-add-wrapper">' +
					'<button type="button" class="btn btn-pink full open-form" id="platform-add-btn"><a>Ajouter une plateforme</a></button>' +				
				'</div>' +
				"<div class='index-modal platforms hidden-fade hidden'>" +

					"<div class='index-modal-this index-modal-login align'>" +
					
						"<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>" +
							"<form id='platform-form'>" +		
							    "<label for='email'>Nom :</label>" +
							    "<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' placeholder='Le nom de votre plateforme'>" +
							    "<label for='email'>Description :</label>" +
							    "<textarea class='input-default admin-form-input-w platform-description-p' placeholder='Une petite description' name='description' type='text'></textarea>" +							    							  
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
				"</div>" + 
			'</div>'
		);
		navbar.setOpenFormAll();		
		navbar.form.closeFormKey();
	    navbar.form.closeFormClick();
	    navbar.form.admin();	

	    var btn = platformModule.getPlatformAddBtn();	    

	    var name = btn.parent().find(jQuery('.platform-nom-p')).val();
		var description = btn.parent().find(jQuery('.platform-description-p')).val();	

		/*if(name !== "undefined"){	
			console.log("Enter a value for name and description");
		}else{
		    var allData = {name : name, description : description};	

			jQuery.ajax({
				url: "admin/insertPlatformData", 
				type: "POST",
				data: allData,
				success: function(result){						
					console.log("Plateforme ajoutée");							
				},
			 	error: function(result){
			 		throw new Error("Couldn't add platform", result);
			 	}
			});
		}*/
	},
	//Update sur le formulaire modifier
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
	//Delete sur le boutton Supprimer
	postDataDelete : function(i){
		var btn = platformModule.getDeleteBtn(i);
		
		var allData = {id : btn.parent().parent().find(jQuery('.platform-id-p')).val()};		

		jQuery.ajax({
			url: "admin/deletePlatformData", 
			type: "POST",
			data: allData,
			success: function(result){		
				platformModule.toggleIfEmpty();				
				console.log("Plateforme supprimée");			
				btn.parent().parent().remove();
			},
		 	error: function(result){
		 		throw new Error("Couldn't delete this platform", result);
		 	}
		});
	}
};



