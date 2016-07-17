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
		gameModule.setToggleCheck();

		//Preview
		gameModule.previewImg();

		//CRUD
		gameModule.postDataInsert();
		//gameModule.postDataDelete();
		gameModule.postDataUpdate();

		//Toggle
		gameModule.toggleCheck();
	},

	//Setter
	setToggleCheck : function(){
		this._toggleCheck = jQuery('.toggleCheck');
	},
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
	getToggleCheck : function(){
		return this._toggleCheck;
	},
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
	toggleCheck : function(){
		gameModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.jeu-status-p').prop("checked", !jQuery(ev.currentTarget).find('.jeu-status-p').prop("checked"));
		});
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
			var status = -1;

			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucun jeu enregistré pour le moment.</span></div>";

			var data = {id : id, status : status};

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/delGame", 				
				type: "POST",
				data: data,
				success: function(result){			
					//console.log(result);		
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
				var subBtn = updateBtn.parent().parent();

				var id = subBtn.find('.jeu-id-p').val();
				var name = subBtn.find('.jeu-name-p').val();
				var description = subBtn.find('.jeu-description-p').val();
				var day = subBtn.find('.jeu-releaseDate-D').val();
				var month = subBtn.find('.jeu-releaseDate-M').val();
				var thisYear = subBtn.find('.jeu-releaseDate-Y').val();
				var idType = subBtn.find('.jeu-idType-p').val();
				var nameType = subBtn.find('.jeu-idType-p option:selected').text();

				var status;
				if(subBtn.find('.jeu-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}

				var myImg = subBtn.parent().parent().find('.admin-input-file > .jeu-image-p');

				var allData = {};

				//Vérification si ils existent, on modifie, sinon on laisse la valeur initiale.
				//IMPORTANT : Ne pas mettre de ternaire de type allData.id = id ? id : ''; car on laisse la valeur initiale. On ne la change pas.
				allData.id = id;
				allData.status = status;

				if(name)
					allData.name = name;

				if(description)
					allData.description = description;

				if(idType && nameType){
					allData.idType = idType;
					allData.nameType = nameType;
				}

				if(day)
					allData.day = day;

				if(thisYear)
					allData.thisYear = thisYear;

				if(month)
					allData.month = month;

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
						console.log(result);
						console.log(allData);
						console.log("Jeu mis à jour");
						//Reload la mise a jour dans l'html

					allData.idType;
						if(name){ updateBtn.parent().parent().find('.jeu-name-g').html(name); }
						if(thisYear){ updateBtn.parent().parent().find('.jeu-releaseDate-g').html(thisYear); }
						if(nameType){ updateBtn.parent().parent().find('.jeu-idType-g').html(nameType); }
						if(thisYear){ updateBtn.parent().parent().find('.jeu-releaseDate-g').html(thisYear); }
						//Si l'image uploadé existe on l'envoi dans la dom
						if(allData.img){
							updateBtn.parent().parent().find('.jeu-img-up').attr('src', webpath.get() + "/web/img/upload/jeux/" + allData.img);	
						}	
						if(allData.status == 1){
								updateBtn.parent().parent().find('.jeu-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>"
								); 
							}else{
								updateBtn.parent().parent().find('.jeu-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-lock.png'>"
								); 
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
	getAllTypeGames : function(callback){
		jQuery.get("admin/getAlltypeGame", function(result){
			var resultArr = jQuery.parseJSON(result);
			callback(resultArr);
		});
	},
	checkIfGameNameExist : function(name, callback){
		jQuery.get("admin/getAllGamesName", function(result){
			var resultArr = jQuery.parseJSON(result);
			var boo = false;
			jQuery.each(resultArr.name, function(igamename, fieldgamename){
				if(fieldgamename == name){
					boo = true;
				}
			});
			callback(boo);
		});
	},
	postDataInsert : function(){
		navbar.setOpenFormAll();	
		navbar.form.admin();	
		navbar.form.closeFormKey();
        navbar.form.closeFormClick();

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
											"<img class='img-cover jeu-img membre-form-img-size' src='" + webpath.get() + "/web/img/upload/jeux/default-jeux.png' title='Image du jeu' alt='Image du jeu'>" +										
										"</div>" +
										"<div class='text-center admin-input-file'>" +								 
											"<input type='file' class='jeu-image-p' name='profilpic'>" +
										"</div>" +
									"</div>" +
									//Label
									"<div class='grid-md-4 text-left'>" +
									    "<label for='nom'>Nom :</label>" +
									    "<label for='description'>Description :</label>" +
									    "<label for='year'>Année :</label>" +
									    "<label for='idType'>Type :</label>" +
									    "<label for='status'>Verrouiller :</label>" +
								    "</div>" +
								    //Input
								    "<div class='grid-md-8'>" +
										"<input type='text' name='id' class='hidden jeu-id-p' value=''>" +
										"<input class='input-default admin-form-input-w jeu-name-p' name='name' type='text' value=''>" +
										"<textarea class='input-default admin-form-input-w jeu-description-p' name='description'></textarea>" +

										"<input class='input-default admin-form-input-w jeu-releaseDate-D' type='number' name='day' placeholder='dd' min='1' max='31' value=''>" +
										
										"<input class='input-default admin-form-input-w jeu-releaseDate-M' type='number' name='month' placeholder='mm' min='1' max='12' value=''>" +

										"<input class='input-default admin-form-input-w jeu-releaseDate-Y' type='number' name='year' placeholder='yyyy' min='1950' max='" + new Date().getFullYear() + "' value=''>" +
										
										"<select class='select-default jeu-idType-p' name='idType'>" +
											
										"</select>" +

										"<div class='relative'><span class='toggleCheck'><input class='checkbox input-default admin-checkbox-ajust jeu-status-p' id='jeu-status-p' name='status' required type='checkbox'>" +
										"<label class='ajusted-checkbox-label' for='status'>.</label></span></div>" +								

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

			/* Fonction qui ajoute les typgames existant */
			gameModule.getAllTypeGames(function(resultFromCb){
				jQuery.each(resultFromCb.name, function(y, yfield){
					btn.parent().parent().find('.admin-add-form-wrapper').find('.index-modal-this').find('.jeu-idType-p').append(
						"<option name='idType' value='" + resultFromCb.id[y] + "'>" + resultFromCb.name[y] + "</option>"
					);
				});
			});
		

			//Envoi dans la BDD
			var subBtn = btn.parent().parent().find('.jeu-submit-add-this-form-btn');

			subBtn.click(function(ev){
				var subEvBtn = jQuery(ev.currentTarget);
				var name = subEvBtn.parent().parent().find('.jeu-name-p').val();
				var description = subEvBtn.parent().parent().find('.jeu-description-p').val();
				var day = subEvBtn.parent().parent().find('.jeu-releaseDate-D').val();
				var month = subEvBtn.parent().parent().find('.jeu-releaseDate-M').val();
				var thisYear = subEvBtn.parent().parent().find('.jeu-releaseDate-Y').val();
				var idType = subEvBtn.parent().parent().find('.jeu-idType-p').val();
				var nameType = subEvBtn.parent().parent().find('.jeu-idType-p option:selected').text();

				var status;
				if(subEvBtn.parent().parent().find('.jeu-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}

				var myImg = subEvBtn.parent().parent().find('.admin-input-file > .jeu-image-p');

				var allData = {};

				allData.img = "default-jeux.png";

				allData.status = status;

				if(name)
					allData.name = name;

				if(description)
					allData.description = description;

				if(thisYear)
					allData.thisYear = thisYear;

				if(idType && nameType){
					allData.idType = idType;
					allData.nameType = nameType;
				}

				if(day)
					allData.day = day;

				if(month)
					allData.month = month;

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
					            url: "admin/insertGamesData", 
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

			    if(allData.name && allData.day && allData.month && allData.thisYear){
			    //Insert du jeu
					jQuery.ajax({
						url: "admin/insertGamesData", 
						type: "POST",
						data: allData,
						success: function(result10){
							console.log("Jeu ajouté.");
							console.log(allData);

							var newD = new Date();

							gameModule.checkIfGameNameExist(allData.name, function(mybool){
								if(mybool){
									console.log("Le nom du jeu est déjà utilisé");
								}else{
									onglet.getAdminDataRe().append(
									"<div class='grid-md-10 admin-data-ihm align relative grid-centered' id='" + allData.name + "'>" +
										//Affichage
										"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round jeu-img-up' src='" + webpath.get() + "/web/img/upload/platform/" + allData.img + "'></div></div></div>" +
										"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-name-g'>" + allData.name + "</span></div></div>" +
										"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-releaseDate-g'>" + allData.thisYear + "</span></div></div>" +
										"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-idType-g'>" + allData.nameType + "</span></div></div>" +
										"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='jeu-status-g'><div class='align jeu-status-g-ht'>" +
									
										"</div></span></div></div>" +					

										//Fin 

										//Bouton
										"<div class='admin-data-ihm-btn hidden align'>" +
											"<button class='admin-btn-default btn btn-yellow full admin-btn-modify open-form' type='button'><a>Modifier</a></button>" +
					/*						"<button class='admin-btn-default btn btn-white full admin-btn-delete' type='button'><a>Supprimer</a></button>" +
					*/					"</div>" + 
										//Fin Bouton

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
																"<img class='img-cover jeu-img membre-form-img-size' src='" + webpath.get() + "/web/img/upload/jeux/" + allData.img +"' title='Image de profil' alt='Image de profil'>" +										
															"</div>" +
															"<div class='text-center admin-input-file'>" +								 
																"<input type='file' class='jeu-image-p' name='profilpic'>" +
															"</div>" +
														"</div>" +
														//Label
														"<div class='grid-md-4 text-left'>" +
														    "<label for='nom'>Nom :</label>" +
														    "<label for='description'>Description :</label>" +
														    "<label for='year'>Année :</label>" +
														    "<label for='idType'>Type :</label>" +
														    "<label for='status'>Verrouiller :</label>" +
													    "</div>" +
													    //Input
													    "<div class='grid-md-8'>" +
															"<input class='input-default admin-form-input-w jeu-name-p' name='name' type='text' value='" + allData.name + "'>" +
															"<textarea class='input-default admin-form-input-w jeu-description-p' name='description'>" + allData.description + "</textarea>" +

															"<input class='input-default admin-form-input-w jeu-releaseDate-D' type='number' name='day' placeholder='dd' min='1' max='31' value='" + allData.day + "'>" +
															
															"<input class='input-default admin-form-input-w jeu-releaseDate-M' type='number' name='month' placeholder='mm' min='1' max='12' value='" + allData.month + "'>" +

															"<input class='input-default admin-form-input-w jeu-releaseDate-Y' type='number' name='year' placeholder='yyyy' min='1950' max='" + newD.getFullYear() + "' value='" + allData.thisYear + "'>" +
															
															"<input type='hidden' class='jeu-nameType-p' value='" + allData.nameType + "'>" +
															"<select class='select-default jeu-idType-p' name='idType'>" +
																
															"</select>" +

															"<div class='relative'><span class='toggleCheck'><input class='checkbox input-default admin-checkbox-ajust jeu-status-p' id='jeu-status-p' name='status' required type='checkbox'>" +
															"<label class='ajusted-checkbox-label' for='status'>.</label></span></div>" +								

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
									
									if(allData.status == 1){
										jQuery.find('#' + allData.name).find('.jeu-status-g-ht').append(
											"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>"
										);
									}else{
										jQuery.find('#' + allData.name).find('.jeu-status-g-ht').append(
											"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-lock.png'>"
										);
									}

									gameModule.getAllTypeGames(function(resultFromCb){
										jQuery.each(resultFromCb.name, function(y, yfield){
											jQuery.find('#' + allData.name).find('.jeu-idType-g-ht').append(
												"<option name='idType' value='" + resultFromCb.id[y] + "'>" + resultFromCb.name[y] + "</option>"
											);
										});
									});

								}
							});
							
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

