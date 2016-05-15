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
								    "<input class='input-default admin-form-input-w' id='nom' name='nom' type='text' placeholder='" + field.name + "'>" +
								     "<label for='email'>Description :</label>" +
								    "<textarea class='input-default admin-form-input-w' id='description' name='description' type='text' placeholder='" + field.description + "'></textarea>" +							    							  
								    "<div class='admin-avatar-wrapper m-a'>" +																	
										"<img class='admin-avatar img-cover' src='" + field.img + "' title='Image de profil' alt='Image de profil'>" +										
									"</div>" +	
									"<div class='text-center admin-input-file'>" +								 
									"<input type='file' name='profilpic'>" +
									"</div>" +
								    "<button type='button' class='btn btn-pink'><a>Valider</a></button>" +
						  		"</form>" +
						  	"</div>" + 	 
						"</div>" +
					"</div>" +
				"<div>" 
			);
		});	
		platformModule.ihmElemHover();		
		navbar.setOpenFormAll();		
		navbar.form.closeFormKey();
        navbar.form.closeFormClick();
		navbar.form.admin();		
	});
};
