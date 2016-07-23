"use strict";
var signalementModule = {	
	_this: this,
	init: function(){
		//Setter
		signalementModule.setDeleteBtn();
		signalementModule.setUpdateBtn();
		signalementModule.setInsertBtn();
		signalementModule.setPreviewInput();
		signalementModule.setImgWrapper();
		signalementModule.setAdminDataRe();

		signalementModule.setAdminSearchInput();

		//Preview
		signalementModule.previewImg();

		//Search
		signalementModule.searchRequest();

		//CRUD
		//signalementModule.postDataDelete();
		//signalementModule.postDataUpdate();
	},

	//Setter
	setAdminSearchInput : function(){
		this._adminSearchInput = jQuery('.admin-search-input');
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
		this._previewInput = jQuery('.membre-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.membre-img');
	},

	//Getter
	getAdminSearchInput : function(){
		return this._adminSearchInput;
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
	//Search Delay
	searchValue : function(callback){
		signalementModule.getAdminSearchInput().parent().on("submit", function(ev){
			ev.preventDefault();
			return false;
		});
		if(callback){
			signalementModule.getAdminSearchInput().on('keypress', function() {
				setTimeout(function(){
					if(signalementModule.getAdminSearchInput().val())
	    			callback(signalementModule.getAdminSearchInput().val());
		    		else
		    			callback("undefined");
				}, 1)
			});
		}
	},
	//Request Search
	searchRequest : function(){
		signalementModule.searchValue(function(value){
			//console.log(value);
			if(value && value !== "undefined"){
				var data = {pseudo : value};
				jQuery.ajax({
					url: "admin/getReportByUser", 				
					type: "POST",
					data: data,
					success: function(result){
						console.log(result);

						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							console.log(result);
							var userArr = jQuery.parseJSON(result);	
							var myRDiv = onglet.getAdminDataRe().find(".report-accuse-g:not(:contains(" + userArr.pseudo + "))").parent().parent().parent();
							myRDiv.addClass('hidden');
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
		signalementModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, signalementModule.getImgWrapper());
		});
	},
	//CRUD
	postDataDelete : function(){
		signalementModule.getDeleteBtn().on("click", function(e){
			var btn = jQuery(e.currentTarget);
			var id = btn.parent().parent().find(jQuery('.report-id-p')).val();	

			var myStr = "<div class='grid-md-12 no-platform align'><span>Aucun signalement enregistré pour le moment.</span></div>";

			var data = {"id" : id};			

			//Ajax Delete Controller
			jQuery.ajax({
				url: "admin/DeleteReports", 				
				type: "POST",
				data: data,
				success: function(result){					
					console.log("Signalement supprimée");							
					btn.parent().parent().remove();		

					//Vérification si il n'y a plus de plateforme
					jQuery.ajax({
					 	url: "admin/reportsView",			 	
					 	success: function(result1){	
					 		//trim pour enlever les espaces
					 		var isEmpty = jQuery.trim(result1);	
					 		//On compare si il ne reste que la div no-plateforme en comparant les 2 strings				 							 
					 		if(isEmpty.toLowerCase() === myStr.toLowerCase()){
					 			membre.getAdminDataRe().html("<div class='grid-md-12 no-platform align'><span>Aucun signalement enregistré pour le moment.</span></div>");
					 		}		     			 		
					 	},
					 	error: function(result1){
					 		console.log("No data found on report.");
					 	}
					});								
				},
			 	error: function(result){
			 		throw new Error("Couldn't delete this report", result);
			 	}
			});
		});				
	},
	postDataUpdate : function(){
		signalementModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.report-submit-form-btn');

			//Submit : Usage de la fonction
			navbar.form.closeFormEnter(submitBtn.parent().parent());

			//Submit : Revérification
			submitBtn.parent().parent().submit(function(enterEvent){
				enterEvent.preventDefault();
				return false;
			});

			submitBtn.on("click", function(updateEvent){
				var id = updateBtn.parent().parent().find('.report-id-p').val();
				var subject = updateBtn.parent().parent().find('.report-subject-p').val();
				var description = updateBtn.parent().parent().find('.report-description-p').val();

				var allData = {};

				allData.id = id;
				//Vérification si ils existent, on modifie, sinon on laisse la valeur initiale.
				//IMPORTANT : Ne pas mettre de ternaire de type allData.id = id ? id : ''; car on laisse la valeur initiale. On ne la change pas.
				if(subject)
					allData.subject = subject;
				
				if(description)
					allData.description = description;
				

			    //Update de la report
				jQuery.ajax({
					url: "admin/updateReportsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Signalement mis à jour");
						//Reload la mise a jour dans l'html
						console.log(allData);
						if(allData.subject){ updateBtn.parent().parent().find('.report-subject-g').html(subject); }
						if(allData.description){ updateBtn.parent().parent().find('.report-description-g').html(description); }
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update report", result);
					}
				});
				updateEvent.preventDefault();
				return false;
			});			
		});
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



//Maj signalement
function deleteReport(id){
	if(confirm("Souhaitez vous supprimer cet avertissement ?")){
		jQuery.ajax({
		 	url: "admin/DeleteReports",
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