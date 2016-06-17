"use strict";

var platformModule = {	
	_this: this,
	init : function(){
		platformModule.setDeleteBtn();
		platformModule.setUpdateBtn();
		platformModule.setAdminDataRe();
		platformModule.postDataDelete();
		platformModule.postDataUpdate();			
	},

	//Setter
	setDeleteBtn : function(){
		this._deleteBtn = jQuery('.admin-btn-delete');
	},
	setUpdateBtn : function(){
		this._updateBtn = jQuery('.admin-btn-modify');
	},
	setAdminDataRe : function(){
		this._adminDataRe = jQuery('.admin-data-re');
	},

	//Getter
	getUpdateBtn : function(){
		return this._updateBtn;
	},
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
				//var img = updateBtn.parent().parent().find('.inscription_rapide > .platform-form > .admin-input-file > .platform-image-p').prop('src');

				var allData = {id : id, name : name, description : description};


				jQuery.ajax({
					url: "admin/updatePlatformsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Plateforme mise à jour");
						//Reload la mise a jour dans l'html
						updateBtn.parent().parent().find('.platform-nom-g').html(name);
						updateBtn.parent().parent().find('.platform-description-g').html(description);	
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update platform", result);
					}
				});
			});			
		});
	}	
};