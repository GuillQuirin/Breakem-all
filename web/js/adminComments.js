"use strict";
var commentModule = {	
	_this: this,
	init: function(){
		//Setter
		commentModule.setDeleteBtn();
		commentModule.setUpdateBtn();
		commentModule.setInsertBtn();
		commentModule.setPreviewInput();
		commentModule.setImgWrapper();
		commentModule.setAdminDataRe();

		//Preview
		commentModule.previewImg();

		//CRUD
		//commentModule.postDataDelete();
		//commentModule.postDataUpdate();
		//commentModule.postDataInsert();		
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
		commentModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, commentModule.getImgWrapper());
		});
	},
	//CRUD
	postDataDelete : function(){
		commentModule.getDeleteBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);
			var pseudo = btn.parent().parent().find(jQuery('.membre-pseudo-p')).val();	

			var status = -1;

			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucun commentaire enregistré pour le moment.</span></div>";

			var data = {"pseudo" : pseudo, "status" : status};			

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/updateUserStatus", 				
				type: "POST",
				data: data,
				success: function(result){			
					console.log(result);		
					console.log("Membre supprimée");							
					btn.parent().parent().remove();		

					//Vérification si il n'y a plus de plateforme
					jQuery.ajax({
					 	url: "admin/membresView",			 	
					 	success: function(result1){	
					 		//trim pour enlever les espaces
					 		var isEmpty = jQuery.trim(result1);	
					 		//On compare si il ne reste que la div no-plateforme en comparant les 2 strings				 							 
					 		if(isEmpty.toLowerCase() === myStr.toLowerCase()){
					 			membre.getAdminDataRe().html("<div class='grid-md-12 no-platform align'><span>Aucun commentaire enregistré pour le moment.</span></div>");
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
		commentModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-id-p').val();
				var pseudo = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-pseudo-p').val();
				var team = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-team-p').val();
				var report = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-report-p').val();
				var status = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-status-p').val();
				var email = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .membre-email-p').val();
				var myImg = updateBtn.parent().parent().find('.inscription_rapide > .membre-form > .admin-input-file > .membre-image-p');

				var allData = {"id" : id, "pseudo" : pseudo, "team" : team, "report" : report, "status" : status, "email" : email};

				console.log(allData);

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

			    //Update de la membre
				jQuery.ajax({
					url: "admin/updatePlatformsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Plateforme mise à jour");
						//Reload la mise a jour dans l'html
						//updateBtn.parent().parent().find('.membre-nom-g').html(name);
						//updateBtn.parent().parent().find('.membre-description-g').html(description);
						//Si l'image uploadé existe on l'envoi dans la dom
						if(allData.img){
							updateBtn.parent().parent().find('.membre-img-up').attr('src', allData.img);	
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

	}
};




//Maj commentaire
function deleteComment(id){
	if(confirm("Souhaitez vous modérer ce commentaire ?")){
		jQuery.ajax({
		 	url: "admin/delComment",
		 	type: "POST",
		 	data : "id="+id,
		 	success: function(result){
		 		location.reload(true);
		 		//console.log(result);
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
}