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
		membreModule.postDataInsert();		
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
			var id = btn.parent().parent().find(jQuery('.membre-id-p')).val();	
			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucun membre enregistré pour le moment.</span></div>";

			var data = {id : id};				

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/deleteMembreData", 				
				type: "POST",
				data: data,
				success: function(result){					
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

	},
	postDataInsert : function(){

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
