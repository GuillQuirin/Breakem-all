"use strict";
var membreModule = {	
	_this: this,
	init: function(){
		//Setter
		membreModule.setDeleteBtn();
		membreModule.setUpdateBtn();
		membreModule.setInsertBtn();
		membreModule.setPreviewInput();
		membreModule.setImgWrapper();
		membreModule.setAdminDataRe();

		//Preview
		membreModule.previewImg();

		//CRUD
		membreModule.postDataDelete();
		membreModule.postDataUpdate();
		//membreModule.postDataInsert();		
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
		this._previewInput = jQuery('.membre-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.membre-img');
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
		membreModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, membreModule.getImgWrapper());
		});
	},
	//CRUD
	postDataDelete : function(){
		membreModule.getDeleteBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);
			var pseudo = btn.parent().parent().find(jQuery('.membre-pseudo-p')).val();	

			var status = -1;

			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucun membre enregistré pour le moment.</span></div>";

			var data = {"pseudo" : pseudo, "status" : status};			

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/updateUserStatus", 				
				type: "POST",
				data: data,
				success: function(result){			
					console.log(result);		
					console.log("Membre supprimée");							
					btn.parent().parent().find(jQuery('.membre-status-g')).html("Banni");	

					//Vérification si il n'y a plus de plateforme
					jQuery.ajax({
					 	url: "admin/membresView",			 	
					 	success: function(result1){	
					 		//trim pour enlever les espaces
					 		var isEmpty = jQuery.trim(result1);	
					 		//On compare si il ne reste que la div no-plateforme en comparant les 2 strings				 							 
					 		if(isEmpty.toLowerCase() === myStr.toLowerCase()){
					 			membre.getAdminDataRe().html("<div class='grid-md-12 no-platform align'><span>Aucun membre enregistré pour le moment.</span></div>");
					 		}		     			 		
					 	},
					 	error: function(result1){
					 		console.log("No data found on membre.");
					 	}
					});								
				},
			 	error: function(result){
			 		throw new Error("Couldn't delete this membre", result);
			 	}
			});
		});				
	},
	postDataUpdate : function(){
		membreModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.membre-submit-form-btn');

			submitBtn.on("click", function(){
				var subBtn = updateBtn.parent().parent();

				var id = subBtn.find('.membre-id-p').val();
				var name = subBtn.find('.membre-nom-p').val();
				var firstname = subBtn.find('.membre-prenom-p').val();
				var day = subBtn.find('.membre-birthday-D').val();
				var month = subBtn.find('.membre-birthday-M').val();
				var year = subBtn.find('.membre-birthday-Y').val();
				var kind = subBtn.find('.membre-kind-p').val();
				var description = subBtn.find('.membre-description-p').val();
				var city = subBtn.find('.membre-city-p').val();
				var pseudo = subBtn.find('.membre-pseudo-p').val();
				var status = subBtn.find('.membre-status-p').val();
				var email = subBtn.find('.membre-email-p').val();
				var authorize_mail_contact = subBtn.find('.membre-mailContact-p').val();
				var myImg = subBtn.find('.admin-input-file > .membre-image-p');

				var allData = {};

				//Vérification si ils existent, on modifie, sinon on laisse la valeur initiale.
				//IMPORTANT : Ne pas mettre de ternaire de type allData.id = id ? id : ''; car on laisse la valeur initiale. On ne la change pas.
				allData.id = id;

				if(name){
					allData.name = name;
				}
				if(firstname){
					allData.firstname = firstname;
				}
				if(pseudo){
					allData.pseudo = pseudo;
				}
				if(day){
					allData.day = day;
				}
				if(month){
					allData.month = month;
				}
				if(year){
					allData.year = year;
				}
				if(description){
					allData.description = description;
				}
				if(kind){
					allData.kind = kind;
				}
				if(city){
					allData.city = city;
				}
				if(email){
					allData.email = email;
				}
				if(status){
					allData.status = status;
				}
				if(authorize_mail_contact){
					allData.authorize_mail_contact = authorize_mail_contact;
				}

				allData.img = "default-membre.png";

				//Upload des images
			    if (typeof FormData !== 'undefined') {

			    	//Pour l'upload coté serveur
			        var file = myImg.prop('files')[0];

			        if(myImg && file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = "upload/" + file.name;

			        	var imgData = new FormData();                  
					    imgData.append('file', file);				    		                             
					    jQuery.ajax({
				            url: "admin/updateMembresData", 
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
					url: "admin/updateMembresData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Membre mise à jour");
						console.log(allData);
						//console.log(result);
						var myStatus;
						//Reload la mise a jour dans l'html
						if(allData.pseudo){ subBtn.find('.membre-pseudo-g').html(name);}
						if(allData.email){ subBtn.find('.membre-email-g').html(email);}
						switch(status) {
						    case -1:
						        myStatus = "Banni";
						        break;
						    case 0:
						    	myStatus = "Attente de validation";
						    	break;
						    case 1:
						        myStatus = "Utilisateur";
						        break;
						    case 3:
						    	myStatus = "Admin";
						    	break;
						} 
						if(allData.status){ subBtn.find('.membre-status-g').html(myStatus);}
						//Si l'image uploadé existe on l'envoi dans la dom
						if(allData.img){
							subBtn.find('.membre-img-up').attr('src', webpath.get() + "/web/img/" + allData.img);	
						}
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update membre", result);
					}
				});
			});			
		});
	},
	postDataInsert : function(){
		//Ajout du formulaire dans la dom
		membreModule.getInsertBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);

			btn.parent().parent().find('.admin-add-form-wrapper').html(
			//Formulaire
				"<div class='index-modal-this index-modal-login align'>" +
							
							"<div class='grid-md-6 inscription_rapide animation fade'>" +
								"<form class='membre-form admin-form' enctype='multipart/form-data' accept-charset='utf-8'>" +
									//Title
									"<div class='grid-md-12 form-title-wrapper'>" +
										"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-profil.png'><span class='form-title'>Membre</span>" +
									"</div>" +
									"<div class='grid-md-6' style='height:130px;'>" +
									//Image							    								 
								    	"<div class='membre-form-img-size m-a'>" +																	
											"<img class='img-cover membre-img membre-form-img-size' src='' title='Image de profil' alt='Image de profil'>" +
										"</div>" +
										"<div class='text-center admin-input-file'>" +								 
											"<input type='file' class='membre-image-p' name='profilpic'>" +
										"</div>" +
									"</div>" +
									"<div class='grid-md-6'>" +
										//Label
										"<div class='grid-md-5 text-left'>" +
											"<label for='description'>Description :</label>" +
											"<label for='city'>Ville :</label>" +
										"</div>" +
										//Input
										"<div class='grid-md-7'>" +
									 		"<input class='input-default admin-form-input-w membre-description-p' placeholder='Description' name='description' type='text'>" +			    
											"<input class='input-default admin-form-input-w membre-city-p' placeholder='Ville' name='city' type='text'>" +									    
										"</div>" +
									"</div>" +
									"<div class='grid-md-6'>" +
										//Label
										"<div class='grid-md-5 text-left'>" +
											"<label for='nom'>Nom :</label>" +
											"<label for='prenom'>Prénom :</label>" +
											"<label for='pseudo'>Pseudo :</label>" +
											"<label for='password'>Mot de passe :</label>" +
											"<label for='passwordCheck'>Validation :</label>" +											
										"</div>" +
										//Input
										"<div class='grid-md-7'>" +
										    "<input class='input-default admin-form-input-w membre-nom-p' placeholder='Nom' name='nom' type='text'>" +									    
										    "<input class='input-default admin-form-input-w membre-prenom-p' placeholder='Prénom' name='prenom' type='text'>" +
										    "<input class='input-default admin-form-input-w membre-pseudo-p' placeholder='pseudo' name='pseudo' type='text'>" +
										    "<input class='input-default admin-form-input-w membre-password-p' placeholder='Mot de passe' name='password' type='password'>" +
										    "<input class='input-default admin-form-input-w membre-passwordCheck-p' placeholder='Validation du mot de passe' name='passwordCheck' type='password'>" +
										"</div>" +								   
								    "</div>" +

								    "<div class='grid-md-6'>" +
									   	
									   	"<div class='grid-md-5 text-left'>" +
									   		//Label
									   		"<label for='birthday'>Birthday :</label>" +
										    "<label for='kind'>Genre :</label>" +
											"<label for='email'>Email :</label>" +
											"<label for='mailContact'>Me contacter :</label>" +
											"<label for='status'>Status :</label>" +
										"</div>" +

										"<div class='grid-md-7'>" +
											//Input
											"<select class='select-default membre-kind-p'>" +
												"<option value='1'>Homme</option>" +
												"<option value='0'>Femme</option>" +
											"</select>" +
										    "<input class='input-default admin-form-input-w membre-email-p' placeholder='Email' name='email' type='text'>" +
										 	"<select class='select-default membre-mailContact-p'>" +
												"<option value='1'>Oui</option>" +
												"<option value='0'>Non</option>" +
											"</select>" +
										    "<select class='select-default membre-status-p' placeholder='Status' name='status'>" +
												"<option value='1'>Utilisateur</option>" +
												"<option value='-1'>Banni</option>" +
												"<option value='3'>Admin</option>" +
											"</select>" +		
											"<input class='input-default admin-form-input-w membre-birthday-p' placeholder='Date de naissance' name='birthday' type='text'>" +
										"</div>" +							 
								    "</div>" +
								    //Submit
								    "<div class='grid-md-12'>" +
								    	"<button type='button' class='admin-form-submit membre-submit-add-this-form-btn btn btn-pink'><a>Valider</a></button>" +
								    "</div>" +
						  		"</form>" +
						  	"</div>" +
						"</div>"
			//Fin Formulaire
			);

			//Envoi dans la BDD
			var submitBtn = btn.parent().parent().find('.membre-submit-add-this-form-btn');

			
			submitBtn.click(function(ev){
				var subBtn = jQuery(ev.currentTarget).parent().parent();
				var name = subBtn.find('.membre-nom-p').val();
				var firstname = subBtn.find('.membre-prenom-p').val();
				var day = subBtn.find('.membre-birthday-D').val();
				var month = subBtn.find('.membre-birthday-M').val();
				var year = subBtn.find('.membre-birthday-Y').val();
				var kind = subBtn.find('.membre-kind-p').val();
				var description = subBtn.find('.membre-description-p').val();
				var city = subBtn.find('.membre-city-p').val();
				var pseudo = subBtn.find('.membre-pseudo-p').val();
				var status = subBtn.find('.membre-status-p').val();
				var email = subBtn.find('.membre-email-p').val();
				var password = subBtn.find('.membre-password-p').val();
				var password_check = subBtn.find('.membre-passwordCheck-p').val();
				var authorize_mail_contact = subBtn.find('.membre-mailContact-p').val();
				var myImg = subBtn.find('.membre-image-p');

				var allData = {};


				//Vérification si ils existent, on modifie, sinon on laisse la valeur initiale.
				//IMPORTANT : Ne pas mettre de ternaire de type allData.id = id ? id : ''; car on laisse la valeur initiale. On ne la change pas.
				allData.name = name ? name : null;
				allData.firstname = firstname ? firstname : null;
				allData.pseudo = pseudo ? pseudo : null;
				allData.day = day ? day : null;
				allData.month = month ? month : null;
				allData.year = year ? year : null;
				allData.description = description ? description : null;
				allData.kind = kind ? kind : null;
				allData.city = city ? city : null;
				allData.email = email ? email : null;
				allData.status = status ? status : 1;
				allData.authorize_mail_contact = authorize_mail_contact ? authorize_mail_contact : 1;
				allData.password = password ? password : null;
				allData.password_check = password_check ? password_check : null;

				/*if(name){
					allData.name = name;
				}
				if(firstname){
					allData.firstname = firstname;
				}
				if(pseudo){
					allData.pseudo = pseudo;
				}
				if(birthday){
					allData.birthday = birthday;
				}
				if(description){
					allData.description = description;
				}
				if(kind){
					allData.kind = kind;
				}
				if(city){
					allData.city = city;
				}
				if(email){
					allData.email = email;
				}
				if(status){
					allData.status = status;
				}
				if(authorize_mail_contact){
					allData.authorize_mail_contact = authorize_mail_contact;
				}*/

				//Image par default
				allData.img = "default-membre.png";

				//Image
			 	if (typeof FormData !== 'undefined') {				           

			 		//Pour l'upload coté serveur 
		        	var file = myImg.prop('files')[0];

			        if(myImg && file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = "upload/" + file.name;

			        	var imgData = new FormData();                  
					    imgData.append('file', file);				    		                             
					    jQuery.ajax({
				           // url: "admin/registerAdmin", 
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
			    } else {    	
			       alert("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
			    } 	

			    if(allData.pseudo && allData.email){
			    //Insert de la platform
					jQuery.ajax({
						//url: "admin/registerAdmin", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log(allData);
							console.log("Membre ajoutée.");
							navbar.form.smoothClosing();				
						},
						error: function(result){
							throw new Error("Couldn't add member", result);
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

//Maj user
function setStatut(pseudo, value){
	jQuery.ajax({
	 	url: "admin/updateUserStatus",
	 	type: "POST",
	 	data : "pseudo="+pseudo+"&status="+value,
	 	succes: function(result){
	 		console.log(result);
	 	},
	 	error: function(result){
	 		alert("non");
	 	}
	});
}
