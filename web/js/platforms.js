platformModule.createPlatformsIhm = function(){
	ajaxRequest("admin/getPlatformsData", "GET", function(result){				
		jQuery.each(result, function(i, field){
			jQuery(".admin-wrapper.platforms").append(				

				"<div class='admin-data-ihm align'>" +

					"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span class='capitalize'>" + field.name + "</span></div></div>" +
					"<div class='grid-md-4'><div class='admin-data-ihm-elem'><span>" + field.description + "</span></div></div>" +
					"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper'><img class='img-cover' src='" + field.img + "'></div></div></div>" +

					"<div class='admin-data-ihm-btn hidden relative'>" +
						"<button class='admin-btn-default admin-btn-modify open-form' type='button'><span>Modifier</span></button>" +  
						"<button class='admin-btn-default admin-btn-delete' type='button'><span>Supprimer</span></button>" + 						
					"</div>" +

					"<div class='index-modal platforms hidden-fade hidden'>" +

						"<div class='index-modal-this index-modal-login align'>" +
						
							"<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>" +
								"<form id='platform-form'>" +			    
								    "<label for='email'>Nom :</label>" +
								    "<input class='input-default admin-form-input-w platform-nom' name='nom' type='text' value='" + field.name + "'>" +
								     "<label for='email'>Description :</label>" +
								    "<textarea class='input-default admin-form-input-w platform-description' name='description' type='text'>" + field.description + "</textarea>" +							    							  
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
			jQuery(".platform-submit-form-btn" + i).click(platformModule.postData(i));						
		});	
		platformModule.ihmElemHover();		
		navbar.setOpenFormAll();		
		navbar.form.closeFormKey();
        navbar.form.closeFormClick();
		navbar.form.admin();			
	});
};

platformModule.getSubmitBtn = function(i){
	return jQuery('.platform-submit-form-btn' + i);
};

platformModule.postData = function(i){	
	return function(){
		platformModule.getSubmitBtn(i).click(function(e){					

			var nom = jQuery(e.currentTarget).parent().find(jQuery('.platform-nom')).val();
			var description = jQuery(e.currentTarget).parent().find(jQuery('.platform-description')).val();			

			//Plus rapide de créer l'objet en une fois si il y'a peu de data
			var allData = {nom : nom, description : description};			

			console.log(allData);			

			jQuery.ajax({
			 	url: "admin/updatePlatformsData",
			 	type: "POST",
			 	data: allData,
			 	success: function(result){			 					 					 	
					console.log("Platform mis à jour");
			 	}
			});
		});		
	}
};


