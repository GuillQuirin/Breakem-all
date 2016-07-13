"use strict";
var gameModule = {	
	_this: this,
	init: function(){
		//Setter
		gameModule.setDeleteBtn();
		gameModule.setUpdateBtn();
		gameModule.setInsertBtn();
		gameModule.setPreviewInput();
		gameModule.setImgWrapper();
		gameModule.setAdminDataRe();

		//Preview
		gameModule.previewImg();

		//CRUD
		//gameModule.postDataInsert();
		gameModule.postDataDelete();
		gameModule.postDataUpdate();
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
		this._previewInput = jQuery('.jeu-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.jeu-img');
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
		gameModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, gameModule.getImgWrapper());
		});
	},
	//CRUD
	postDataDelete : function(){
		gameModule.getDeleteBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);
			var id = btn.parent().parent().find(jQuery('.jeu-id-p')).val();	

			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucun jeu enregistré pour le moment.</span></div>";

			var data = {"id" : id};

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/delGame", 				
				type: "POST",
				data: data,
				success: function(result){			
					console.log(result);		
					console.log("Jeu supprimé");							
					btn.parent().parent().remove();		

					//Vérification si il n'y a plus de plateforme
					jQuery.ajax({
					 	url: "admin/gamesView",			 	
					 	success: function(result1){	
					 		//trim pour enlever les espaces
					 		var isEmpty = jQuery.trim(result1);	
					 		//On compare si il ne reste que la div no-plateforme en comparant les 2 strings				 							 
					 		if(isEmpty.toLowerCase() === myStr.toLowerCase()){
					 			membre.getAdminDataRe().html("<div class='grid-md-12 no-platform align'><span>Aucun jeu enregistré pour le moment.</span></div>");
					 		}		     			 		
					 	},
					 	error: function(result1){
					 		console.log("No data found on game.");
					 	}
					});								
				},
			 	error: function(result){
			 		throw new Error("Couldn't delete this game", result);
			 	}
			});
		});				
	},
	postDataUpdate : function(){
		gameModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.jeu-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.jeu-id-p').val();
				var name = updateBtn.parent().parent().find('.jeu-name-p').val();
				var description = updateBtn.parent().parent().find('.jeu-description-p').val();
				var year = updateBtn.parent().parent().find('.jeu-year-p').val();
				var idType = updateBtn.parent().parent().find('.jeu-idType-p').val();

				var myImg = updateBtn.parent().parent().find('.admin-input-file > .jeu-image-p');

				var allData = {};

				//Vérification si ils existent, on modifie, sinon on laisse la valeur initiale.
				//IMPORTANT : Ne pas mettre de ternaire de type allData.id = id ? id : ''; car on laisse la valeur initiale. On ne la change pas.
				allData.id = id;

				if(name)
					allData.name = name;

				if(description)
					allData.description = description;

				if(year)
					allData.year = year;

				if(idType)
					allData.idType = idType;

				console.log(allData);

				//Upload des images
			    if (typeof FormData !== 'undefined') {
			           
			        //Pour l'upload coté serveur
			        var file = myImg.prop('files')[0];

			        if(file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = file.name;

			        	var imgData = new FormData();                  
					    imgData.append('file', file);				    		                             
					    jQuery.ajax({
				            url: "admin/updateGamesData", 
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

			    //Update de la membre
				jQuery.ajax({
					url: "admin/updateGamesData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Jeu mis à jour");
						//Reload la mise a jour dans l'html

					allData.idType;
						if(name){ updateBtn.parent().parent().find('.jeu-name-g').html(name); }
						if(year){ updateBtn.parent().parent().find('.jeu-year-g').html(year); }
						//Si l'image uploadé existe on l'envoi dans la dom
						if(allData.img){
							updateBtn.parent().parent().find('.jeu-img-up').attr('src', webpath.get() + "/web/img/upload/jeux/" + allData.img);	
						}	
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update game", result);
					}
				});
			});			
		});
	},
	postDataInsert : function(){
	//Ajout du formulaire dans la dom
		gameModule.getInsertBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);

			btn.parent().parent().find('.admin-add-form-wrapper').html(
				//Formulaire
				"<div class='index-modal-this index-modal-login align'>" +
							
					"<div class='grid-md-4 inscription_rapide animation fade'>" +
						"<form class='jeu-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>" +
							//Title
							"<div class='grid-md-12 form-title-wrapper'>" +
								"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-jeu.png'><span class='form-title'>Jeu</span>" +
							"</div>" +
							//Image
							"<div class='grid-md-12'>" +
								"<div class='membre-form-img-size m-a'>" +																	
									"<img class='img-cover jeu-img membre-form-img-size' src='' title='Image du jeu' alt='Image du jeu'>" +										
								"</div>" +
								"<div class='text-center admin-input-file'>" +								 
									"<input type='file' class='jeu-image-p' name='profilpic'>" +
								"</div>" +
							"</div>" +
							//Label
							"<div class='grid-md-4 text-left'>" +
							    "<label for='nom'>Nom :</label>" +
							    "<label for='scription'>Description :</label>" +
							    "<label for='year'>Année :</label>" +
						    "</div>" +
						    //Input
						    "<div class='grid-md-8'>" +
								"<input class='input-default admin-form-input-w jeu-name-p' name='name' type='text'>" +
								"<textarea class='input-default admin-form-input-w jeu-description-p' name='description'></textarea>" +
								"<input class='input-default admin-form-input-w jeu-year-p' name='year' type='text'>" +
							"</div>" +
							//Submit
							"<div class='grid-md-12'>" + 
						    	"<button type='button' class='admin-form-submit jeu-submit-add-this-form-btn btn btn-pink'><a>Valider</a></button>" +
				  			"</div>" +
				  		"</form>" +
				  	"</div>" +
				"</div>"
				//Fin Formulaire
			);

			//Envoi dans la BDD
			var submitBtn = btn.parent().parent().find('.jeu-submit-add-this-form-btn');

			submitBtn.click(function(ev){
				var subBtn = jQuery(ev.currentTarget);
				var name = subBtn.parent().parent().find('.jeu-nom-p').val();
				var description = subBtn.parent().parent().find('.jeu-description-p').val();
				var year = subBtn.parent().parent().find('.jeu-year-p').val();

				var myImg = subBtn.parent().parent().find('.admin-input-file > .jeu-image-p');

				var allData = {};

				allData.img = "default-platform.png";

				if(name)
					allData.name = name;
				
				if(description)
					allData.description = description;
				
				if(year){
					allData.year = year;
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

			    if(allData.name && allData.description && allData.year){
			    //Insert du jeu
					jQuery.ajax({
						url: "admin/insertGamesData", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log("Jeu ajouté.");
							console.log(allData);

							onglet.getAdminDataRe().append(
							//Wrapper				
							"<div class='grid-md-10 admin-data-ihm align relative grid-centered'>" +

								//Affichage
								"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round jeu-img-up' src='" + webpath.get() + "/web/img/upload/jeux/" + allData.img  + "'></div></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize jeu-name-g'>" + allData.name + "</span></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-year-g'>" + allData.year + "</span></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-type-g'>" + allData.type + "</span></div></div>" +
								//Fin 

								//Boutton
								"<div class='admin-data-ihm-btn hidden align'>" +
									"<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>" +
									"<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>" +
								"</div>" + 
								//Fin Boutton

								//Formulaire
								"<div class='index-modal jeus hidden-fade hidden'>" +

									"<div class='index-modal-this index-modal-login align'>" +
										
										"<div class='grid-md-4 inscription_rapide animation fade'>" +
											"<form class='jeu-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>" +
												//Title
												"<div class='grid-md-12 form-title-wrapper'>" +
													"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-jeu.png'><span class='form-title'>Jeu</span>" +
												"</div>" +
												//Image
												"<div class='grid-md-12'>" +
													"<div class='membre-form-img-size m-a'>" +																	
														"<img class='img-cover jeu-img membre-form-img-size' src='" + webpath.get() + "/web/img/upload/jeux/" + allData.img + "' title='Image du jeu' alt='Image du jeu'>" +										
													"</div>" +
													"<div class='text-center admin-input-file'>" +								 
														"<input type='file' class='jeu-image-p' name='profilpic'>" +
													"</div>" +
												"</div>" +
												//Label
												"<div class='grid-md-4 text-left'>" +
												    "<label for='nom'>Nom :</label>" +
												    "<label for='scription'>Description :</label>" +
												    "<label for='year'>Année :</label>" +
											    "</div>" +
											    //Input
											    "<div class='grid-md-8'>" +
													"<input class='input-default admin-form-input-w jeu-name-p' name='name' type='text' value='" + allData.name + "'>" +
													"<textarea class='input-default admin-form-input-w jeu-description-p' name='description'>" + allData.description + "</textarea>" +
													"<input class='input-default admin-form-input-w jeu-year-p' name='year' type='text' value='" + allData.year + "'>" +
												"</div>" +
												//Submit
												"<div class='grid-md-12'>" + 
											    	"<button type='button' class='admin-form-submit jeu-submit-form-btn btn btn-pink'><a>Valider</a></button>" +
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
							throw new Error("Couldn't add game", result);
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

