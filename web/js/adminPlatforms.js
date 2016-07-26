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
		platformModule.setToggleCheck();
		platformModule.setAdminSearchInput();
		platformModule.setDataIhm();


		//Preview
		platformModule.toggleCheck();
		platformModule.previewImg();

		//Search
		platformModule.searchRequest();

		//CRUD
		//platformModule.postDataDelete();
		platformModule.postDataUpdate();
		platformModule.postDataInsert();		
	},

	//Setter
	setDataIhm : function(){
		this._dataIhm = jQuery('.admin-data-ihm');
	},
	setAdminSearchInput : function(){
		this._adminSearchInput = jQuery('.admin-search-input');
	},
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
		this._previewInput = jQuery('.platform-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.platform-img');
	},

	//Getter
	getDataIhm : function(){
		return this._dataIhm;
	},
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
	getAdminSearchInput : function(){
		return this._adminSearchInput;
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
		platformModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.platform-status-p').prop("checked", !jQuery(ev.currentTarget).find('.platform-status-p').prop("checked"));
		});
	},
	//Search Delay
	searchValue : function(callback){
		platformModule.getAdminSearchInput().parent().on("submit", function(ev){
			ev.preventDefault();
			return false;
		});
		if(callback){
			platformModule.getAdminSearchInput().on('keypress', function() {
				setTimeout(function(){
					if(platformModule.getAdminSearchInput().val())
	    			callback(platformModule.getAdminSearchInput().val());
		    		else
		    			callback("undefined");
				}, 2000)
			});
		}
	},
	//Request Search
	searchRequest : function(){
		platformModule.searchValue(function(value){
			//console.log(value);
			if(value && value !== "undefined"){
				var data = {name : value};
				jQuery.ajax({
					url: "admin/getPlatformByName", 				
					type: "POST",
					data: data,
					success: function(result){

						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							var userArr = jQuery.parseJSON(result);
							//console.log(userArr);
							platformModule.getDataIhm().removeClass('hidden');
							//On affiche les elements présents dans le tableau
							if(userArr.length == 1){
								//console.log(userArr[0].name);
						 		var myRDiv = onglet.getAdminDataRe().find(".platform-nom-g:not(:contains(" + userArr[0].name + "))").parent().parent().parent();
						 		myRDiv.addClass('hidden');
						 	}else if(userArr.length > 1){
						 		//Création d'une string
						 		var fullStringContains = "";
						 		//Pour chaque element du tableau on ajoute un contains String
						 		//GAFFE A LA VIRGULE 
						 		jQuery.each(userArr, function(indexArr, fieldArr){
						 			console.log(indexArr);
						 			if(indexArr !== userArr.length-1)
						 				fullStringContains += ":contains(" + fieldArr.name + "),";
						 			else if (indexArr == userArr.length-1)
						 				fullStringContains += ":contains(" + fieldArr.name + ")";
					 			});

					 			console.log(fullStringContains);
					 			//Finnalement on ajout la string au find, puis on ajoute la classe hidden
					 			var myRDiv = onglet.getAdminDataRe().find(".platform-nom-g:not(" + fullStringContains + ")").parent().parent().parent();
					 			console.log(myRDiv);
					 			myRDiv.addClass('hidden');
					 		}							
						}else{
							onglet.getAdminDataIhm().removeClass('hidden');
						}
					},
				 	error: function(result){
						console.log(result);	
						onglet.getAdminDataIhm().removeClass('hidden');
				 	}
				});
			}else{
				onglet.getAdminDataIhm().removeClass('hidden');
			}
		});
	},
	//Preview
	previewImg : function(){
		platformModule.getPreviewInput().on("change", function(e){
			console.log("test");
			console.log("Image changed.");
    		previewUpload(jQuery(e.currentTarget), jQuery(e.currentTarget).parent().parent().find('.platform-img'));
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

			//Submit : Usage de la fonction
			navbar.form.closeFormEnter(submitBtn.parent().parent());

			//Submit : Revérification
			submitBtn.parent().parent().submit(function(enterEvent){
				enterEvent.preventDefault();
				return false;
			});

			submitBtn.on("click", function(updateEvent){
				var id = updateBtn.parent().parent().find('.platform-id-p').val();
				var name = updateBtn.parent().parent().find('.platform-nom-p').val();
				var description = updateBtn.parent().parent().find('.platform-description-p').val();

				var status;
				if(updateBtn.parent().parent().find('.platform-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}

				var myImg = updateBtn.parent().parent().find('.admin-input-file > .platform-image-p');

				var allData = {};

				allData.id = id;
				allData.status = status;

				if(name)
					allData.name = name;
				
				if(description)
					allData.description = description;
				

				//Upload des images
			    if (typeof FormData !== 'undefined') {
			           
			        //Pour l'upload coté serveur
		        	var file = myImg.prop('files')[0];

			        if(myImg && file){

			        	if(file.type == ("image/jpeg")){
				        	//Si une image a été uploadé, on rajoute le src a l'objet allData
				        	allData.img = name + ".jpg";

				        	var imgData = new FormData();                  
						    imgData.append('file', file);			
						    imgData.append('name', name);

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
						}else{
							adminError.popup("Merci d'uploader une image au format jpeg");
						}
			        }			    
			    } else {    	
			       popupError.init("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
			    } 		

			    if(allData.name){
				    //Update de la platform
					jQuery.ajax({
						url: "admin/updatePlatformsData", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log("Plateforme mise à jour");
							console.log(result);
							//Reload la mise a jour dans l'html
							if(allData.name){ updateBtn.parent().parent().find('.platform-nom-g').html(name);}
							if(allData.description){ updateBtn.parent().parent().find('.platform-description-g').html(description);}
							//Si l'image uploadé existe on l'envoi dans la dom
							if(allData.img){
								updateBtn.parent().parent().find('.platform-img-up').attr('src', webpath.get() + "/web/img/upload/platform/" + allData.img + "?lastmod=" + Date.now());	
							}	

							if(allData.status == 1){
								updateBtn.parent().parent().find('.platform-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>"
								); 
							}else{
								updateBtn.parent().parent().find('.platform-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-lock.png'>"
								); 
							}
							navbar.form.smoothClosing();				
						},
						error: function(result){
							throw new Error("Couldn't update platform", result);
						}
					});	
				}
				updateEvent.preventDefault();
				return false;
			});			
		});
	},

	//Ajouter
	postDataInsert : function(){

		//Ajout du formulaire dans la dom
		platformModule.getInsertBtn().click(function(e){
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
				   				"<button type='submit' class='platform-submit-add-this-form-btn btn btn-pink'><a>Valider</a></button>" +
				  			"</div>" +
				  		"</form>" +
				  	"</div>" +
				"</div>"
				//Fin Formulaire
			);

			navbar.setOpenFormAll();	
			navbar.form.admin();
			navbar.form.closeFormKey();
	        navbar.form.closeFormClick();

			//Envoi dans la BDD
			var submitBtn = btn.parent().parent().find('.platform-submit-add-this-form-btn');

			//Submit : Usage de la fonction
			navbar.form.closeFormEnter(submitBtn.parent().parent());

			//Submit : Revérification
			submitBtn.parent().parent().submit(function(enterEvent){
				enterEvent.preventDefault();
				return false;
			});

			submitBtn.click(function(ev){
				var subBtn = jQuery(ev.currentTarget);
				var name = subBtn.parent().parent().find('.platform-nom-p').val();
				var description = subBtn.parent().parent().find('.platform-description-p').val();
				var status = 1;

				var myImg = subBtn.parent().parent().find('.admin-input-file > .platform-image-p');

				var allData = {};

				allData.img = "default-platform.png";
				allData.status = status;

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
			        		if(file.type == ("image/jpeg")){

				        	//Si une image a été uploadé, on rajoute le src a l'objet allData
				        	allData.img = name + ".jpg";

				        	var imgData = new FormData();                  
						    imgData.append('file', file);
						    imgData.append('name', name);				    		                             
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
							}else{
								adminError.popup("Merci d'uploader une image au format jpeg");
							}
						}
			        }   				    
			    } else {    	
			       popupError.init("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
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
							"<div class='grid-md-10 admin-new-data-ihm align relative grid-centered'>" +

								//Affichage
								"<div class='grid-md-4'><div class='admin-data-ihm-elem'><div class='admin-data-ihm-elem-img-wrapper membres-img'><img class='admin-img-cover border-round platform-img-up' src='" + webpath.get() + "/web/img/upload/platform/" + allData.img + "?lastmod=" + Date.now() +"'></div></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-nom-g'>" + allData.name + "</span></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='platform-description-g'>" + allData.description + "</span></div></div>" +
								"<div class='grid-md-4 overflow-hidden'><div class='admin-data-ihm-elem'><span class='capitalize platform-status-g'><div class='align platform-status-g-ht'>" +
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>" +
								"</div></span></div></div>" +
								//Fin Affichage

								//New
								"<div class='new-widg'><span>New</span></div>" +
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
				ev.preventDefault();
				return false;
			});

		});
	}
};