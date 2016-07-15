"use strict";

var platformModule = {	
	_this: this,
	init : function(){
		//Setter
		platformModule.setDeleteBtn();
		platformModule.setUpdateBtn();
		platformModule.setInsertBtn();
		platformModule.setPreviewInput();
		platformModule.setImgWrapper();
		platformModule.setAdminDataRe();

		//Preview
		platformModule.previewImg();

		//CRUD
		platformModule.postDataDelete();
		platformModule.postDataUpdate();
		platformModule.postDataInsert();		
	},

	//Setter
	setDeleteBtn : function(){
		this._deleteBtn = jQuery('.admin-btn-delete');
	},
	setInsertBtn : function(){
		this._insertBtn = jQuery('.admin-btn-insert');
	},
	setUpdateBtn : function(){
		this._updateBtn = jQuery('.admin-btn-modify');
	},
	setAdminDataRe : function(){
		this._adminDataRe = jQuery('.admin-data-re');
	},
	setPreviewInput : function(){
		this._previewInput = jQuery('.platform-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.platform-img');
	},

	//Getter
	getUpdateBtn : function(){
		return this._updateBtn;
	},
	getInsertBtn : function(){
		return this._insertBtn;
	},
	getDeleteBtn : function(){
		return  this._deleteBtn;
	},
	getAdminDataRe : function(){
		return this._adminDataRe;
	},
	getPreviewInput : function(){
		return this._previewInput;
	},
	getImgWrapper : function(){
		return this._imgWrapper;
	},
	getInsertValidationBtn : function(){
		return this._insertValidationBtn;
	},
	//Preview
	previewImg : function(){
		platformModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, platformModule.getImgWrapper());
		});
	},

	//Delete sur le Bouton Supprimer
	postDataDelete : function(){		

		platformModule.getDeleteBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);
			var id = btn.parent().parent().find(jQuery('.platform-id-p')).val();	
			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucune plateforme enregistrée pour le moment.</span></div>";

			var data = {id : id};				

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/deletePlatformData", 				
				type: "POST",
				data: data,
				success: function(result){					
					console.log("Plateforme supprimée");							
					btn.parent().parent().remove();		

					//Vérification si il n'y a plus de plateforme
					jQuery.ajax({
					 	url: "admin/platformsView",			 	
					 	success: function(result1){	
					 		//trim pour enlever les espaces
					 		var isEmpty = jQuery.trim(result1);	
					 		//On compare si il ne reste que la div no-plateforme en comparant les 2 strings				 							 
					 		if(isEmpty.toLowerCase() === myStr.toLowerCase()){
					 			platformModule.getAdminDataRe().html("<div class='grid-md-12 no-platform align'><span>Aucune plateforme enregistrée pour le moment.</span></div>");
					 		}		     			 		
					 	},
					 	error: function(result1){
					 		console.log("No data found on platform.");
					 	}
					});								
				},
			 	error: function(result){
			 		throw new Error("Couldn't delete this platform", result);
			 	}
			});		
		});				
	},

	//Modifier
	postDataUpdate : function(){
		platformModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.platform-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.platform-id-p').val();
				var name = updateBtn.parent().parent().find('.platform-nom-p').val();
				var description = updateBtn.parent().parent().find('.platform-description-p').val();
				var myImg = updateBtn.parent().parent().find('.admin-input-file > .platform-image-p');

				var allData = {};

				allData.id = id;

				if(name)
					allData.name = name;
				
				if(description)
					allData.description = description;
				

				//Upload des images
			    if (typeof FormData !== 'undefined') {
			           
			        //Pour l'upload coté serveur
		        	var file = myImg.prop('files')[0];

			        if(myImg && file){
			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = file.name;

			        	var imgData = new FormData();                  
					    imgData.append('file', file);				    		                             
					    jQuery.ajax({
				            url: "admin/updatePlatformsData", 
				            dataType: 'text',  
				            cache: false,
				            contentType: false,
				            processData: false,
				            data: imgData,                         
				            type: 'POST',
				            success: function(result2){
				                console.log("Image uploadé.");
				                console.log(file.name);				       
				            },
				            error: function(result2){
				                console.log(result2);
				            }
					    });
			        }			    
			    } else {    	
			       alert("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
			    } 		

			    if(allData.name){
				    //Update de la platform
					jQuery.ajax({
						url: "admin/updatePlatformsData", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log("Plateforme mise à jour");
							//Reload la mise a jour dans l'html
							if(allData.name){ updateBtn.parent().parent().find('.platform-nom-g').html(name);}
							if(allData.description){ updateBtn.parent().parent().find('.platform-description-g').html(description);}
							//Si l'image uploadé existe on l'envoi dans la dom
							if(allData.img){
								updateBtn.parent().parent().find('.platform-img-up').attr('src', webpath.get() + "/web/img/upload/platform/" + allData.img);	
							}	
							navbar.form.smoothClosing();				
						},
						error: function(result){
							throw new Error("Couldn't update platform", result);
						}
					});	
				}
			});			
		});
	},

	//Ajouter
	postDataInsert : function(){

		//Ajout du formulaire dans la dom
		platformModule.getInsertBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);

			btn.parent().parent().find('.admin-add-form-wrapper').html(
				//Formulaire
				"<div class='index-modal-this index-modal-login align'>" +
					
					"<div class='grid-md-4 inscription_rapide animation fade'>" +
						"<form class='platform-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>" +
							//Title
							"<div class='grid-md-12 form-title-wrapper'>" +
								"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-plateforme.png'><span class='form-title'>Plateforme</span>" +
							"</div>" +
							//Image
							"<div class='grid-md-12'>" +
								"<div class='membre-form-img-size m-a'>" +																	
									"<img class='img-cover platform-img membre-form-img-size' src='" + webpath.get() + "/web/img/upload/platform/default-platform.png' title='Plateforme' alt='Plateforme'>" +										
								"</div>" +
								"<div class='text-center admin-input-file'>" +								 
									"<input type='file' class='platform-image-p' name='profilpic'>" +
								"</div>" +
							"</div>" +
							//Label
							"<div class='grid-md-5 text-left'>" +
							    "<label for='email'>Nom :</label>" +
							    "<label for='email'>Description :</label>" +
						    "</div>" +
						    //Input
						    "<div class='grid-md-7'>" +
								"<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text'>" +
							    "<textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'></textarea>" +							    														   
							"</div>" +
							//Submit
							"<div class='grid-md-12'>" + 
				   				"<button type='button' class='platform-submit-add-this-form-btn btn btn-pink'><a>Valider</a></button>" +
				  			"</div>" +
				  		"</form>" +
				  	"</div>" +
				"</div>"
				//Fin Formulaire
			);

			//Envoi dans la BDD
			var submitBtn = btn.parent().parent().find('.platform-submit-add-this-form-btn');

			submitBtn.click(function(ev){
				var subBtn = jQuery(ev.currentTarget);
				var name = subBtn.parent().parent().find('.platform-nom-p').val();
				var description = subBtn.parent().parent().find('.platform-description-p').val();

				var myImg = subBtn.parent().parent().find('.admin-input-file > .platform-image-p');

				var allData = {};

				allData.img = "default-platform.png";
				if(name){
					allData.name = name;
				}
				if(description){
					allData.description = description;
				}


				//Image
			 	if (typeof FormData !== 'undefined') {				           

			        if(myImg){
			        	//Pour l'upload coté serveur
			        	var file = myImg.prop('files')[0];
			        	if(file){

				        	//Si une image a été uploadé, on rajoute le src a l'objet allData
				        	allData.img = file.name;

				        	var imgData = new FormData();                  
						    imgData.append('file', file);				    		                             
						    jQuery.ajax({
					            url: "admin/insertPlatformsData", 
					            dataType: 'text',  
					            cache: false,
					            contentType: false,
					            processData: false,
					            data: imgData,                         
					            type: 'POST',
					            success: function(result2){
					                console.log("Image '" + file.name + "' uploadé.");			       
					            },
					            error: function(result2){
					                console.log(result2);
					            }
						    });
						}
			        }   				    
			    } else {    	
			       alert("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
			    } 	

			    if(allData.name && allData.description){
			    //Insert de la platform
					jQuery.ajax({
						url: "admin/insertPlatformsData", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log("Platforme ajoutée.");
							console.log(allData);

							onglet.getAdminDataRe().append(
							//Wrapper				
							"<div class='grid-md-10 admin-data-ihm align relative grid-centered'>" +

								//Affichage
								"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round platform-img-up' src='" + webpath.get() + "/web/img/upload/platform/" + allData.img + "'></div></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-nom-g'>" + allData.name + "</span></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='platform-description-g'>" + allData.description + "</span></div></div>" +
								//Fin Affichage

								//Bouton
								"<div class='admin-data-ihm-btn hidden align'>" +
									"<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>" +
									"<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>" +
								"</div>" + 
								//Fin Bouton

								//Formulaire
								"<div class='index-modal platforms hidden-fade hidden'>" +

									"<div class='index-modal-this index-modal-login align'>" +
										
										"<div class='grid-md-4 inscription_rapide animation fade'>" +
											"<form class='platform-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>" +
												//Title
												"<div class='grid-md-12 form-title-wrapper'>" +
													"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-plateforme.png'><span class='form-title'>Plateforme</span>" +
												"</div>" +
												//Image
												"<div class='grid-md-12'>" +
													"<div class='membre-form-img-size m-a'>" +																	
														"<img class='img-cover platform-img membre-form-img-size' src='" + webpath.get() + "/web/img/" + allData.img + "' title='Plateforme' alt='Plateforme'>" +										
													"</div>" +
													"<div class='text-center admin-input-file'>" +								 
														"<input type='file' class='platform-image-p' name='profilpic'>" +
													"</div>" +
												"</div>" +
												//Label
												"<div class='grid-md-5 text-left'>" +
												    "<label for='email'>Nom :</label>" +
												    "<label for='email'>Description :</label>" +
											    "</div>" +
											    //Input
											    "<div class='grid-md-7'>" +
													"<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value='" + allData.name + "'>" +
												    "<textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'>" + allData.description + "</textarea>" +							    														   
												"</div>" +
												//Submit
												"<div class='grid-md-12'>" + 
											    	"<button type='button' class='admin-form-submit platform-submit-form-btn btn btn-pink'><a>Valider</a></button>" +
									  			"</div>" +
									  		"</form>" +
									  	"</div>" +
									"</div>" +
								"</div>" +
								//Fin Formulaire
							"</div>" 
							//Fin Wrapper
							);
							navbar.form.smoothClosing();				
						},
						error: function(result){
							throw new Error("Couldn't add platform", result);
						}
					});
				}
			});

		});
		navbar.setOpenFormAll();	
		navbar.form.admin();	
		navbar.form.closeFormKey();
        navbar.form.closeFormClick();
	}
};