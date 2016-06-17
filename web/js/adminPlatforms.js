"use strict";

var platformModule = {	
	init : function(){
		platformModule.setDeleteBtn();	
		platformModule.setAdminDataRe();
		platformModule.postDataDelete();			
	},

	//Setter
	setDeleteBtn : function(){
		this._deleteBtn = jQuery('.admin-btn-delete');
	},
	setAdminDataRe : function(){
		this._adminDataRe = jQuery('.admin-data-re');
	},

	//Getter
	getDeleteBtn : function(){
		return  this._deleteBtn;
	},
	getAdminDataRe : function(){
		return this._adminDataRe;
	},

	//Delete sur le boutton Supprimer
	postDataDelete : function(){		

		platformModule.getDeleteBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);
			var id = btn.parent().parent().find(jQuery('.platform-id-p')).val();	
			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucune plateforme enregistrée pour le moment.</span></div>";

			var data = {id : id};				

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
	}

	//Modifier
};