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

	previewImg : function(){
		platformModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, platformModule.getImgWrapper());
		});
	},

	//Delete sur le boutton Supprimer
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

			var submitBtn = updateBtn.parent().parent().find('.inscription_rapide > .platform-form > .platform-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.inscription_rapide > .platform-form > .platform-id-p').val();
				var name = updateBtn.parent().parent().find('.inscription_rapide > .platform-form > .platform-nom-p').val();
				var description = updateBtn.parent().parent().find('.inscription_rapide > .platform-form > .platform-description-p').val();
				var myImg = updateBtn.parent().parent().find('.inscription_rapide > .platform-form > .admin-input-file > .platform-image-p');

				var allData = {id : id, name : name, description : description};

				//Upload des images
			    if (typeof FormData !== 'undefined') {
			           
			        //Pour l'upload coté serveur
			        var file = myImg.prop('files')[0];

			        if(file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = "upload/" + file.name;

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

			    //Update de la platform
				jQuery.ajax({
					url: "admin/updatePlatformsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Plateforme mise à jour");
						//Reload la mise a jour dans l'html
						updateBtn.parent().parent().find('.platform-nom-g').html(name);
						updateBtn.parent().parent().find('.platform-description-g').html(description);
						//Si l'image uploadé existe on l'envoi dans la dom
						if(allData.img){
							updateBtn.parent().parent().find('.platform-img-up').attr('src', allData.img);	
						}	
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update platform", result);
					}
				});
			});			
		});
	},

	//Ajouter
	postDataInsert : function(){

		//Ajout du formulaire dans la dom
		platformModule.getInsertBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);

			btn.parent().parent().find('.admin-add-form-wrapper').html(
				"<div class='index-modal-this index-modal-login align'>"+
							
					"<div id='login-form' class='grid-md-3 inscription_rapide animation fade'>"+
						"<form class='platform-form' enctype='multipart/form-data' accept-charset='utf-8'>"+
						   	"<label for='email'>Nom :</label>"+
						   	"<input class='input-default admin-form-input-w platform-nom-p' name='nom' type='text' value=''>"+
						   	"<label for='email'>Description :</label>"+
						   	"<textarea class='input-default admin-form-input-w platform-description-p' name='description' type='text'></textarea>"+							    						
						   	"<div class='admin-avatar-wrapper m-a'>"+																	
								"<img class='admin-avatar img-cover platform-img' src='' title='Image de profil' alt='Image de profil'>"+										
							"</div>"+
							"<div class='text-center admin-input-file'>"+								 
							"<input type='file' class='platform-image-p' name='profilpic'>"+
							"</div>"+
						   	"<button type='button' class='platform-submit-add-this-form-btn btn btn-pink'><a>Valider</a></button>"+
				  		"</form>"+
				  	"</div>"+
				"</div>"
			);

			//Envoi dans la BDD
			var submitBtn = btn.parent().parent().find('.platform-submit-add-this-form-btn');

			submitBtn.click(function(ev){
				console.log("lol");
				var subBtn = jQuery(ev.currentTarget);
				var name = subBtn.parent().find('.platform-nom-p').val();
				var description = subBtn.parent().find('.platform-description-p').val();

				var myImg = subBtn.parent().parent().find('.admin-input-file > .platform-image-p');

				var allData = {name : name, description : description};

				//Image
			 	if (typeof FormData !== 'undefined') {
				           
			        //Pour l'upload coté serveur
			        var file = myImg.prop('files')[0];

			        if(file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = "upload/" + file.name;

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
			    } else {    	
			       alert("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
			    } 	

			    //Insert de la platform
				jQuery.ajax({
					url: "admin/insertPlatformsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Platforme ajoutée.");
						console.log(allData);
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update platform", result);
					}
				});
			});

		});
		navbar.setOpenFormAll();	
		navbar.form.admin();	
		navbar.form.closeFormKey();
        navbar.form.closeFormClick();
	}
};