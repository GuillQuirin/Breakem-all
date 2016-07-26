"use strict";
var tournoiModule = {	
	_this: this,
	init: function(){
		//Setter
		tournoiModule.setDeleteBtn();
		tournoiModule.setUpdateBtn();
		tournoiModule.setInsertBtn();
		tournoiModule.setPreviewInput();
		tournoiModule.setImgWrapper();
		tournoiModule.setAdminDataRe();
		tournoiModule.setToggleCheck();
		tournoiModule.setAdminSearchInput();

		//Preview
		tournoiModule.toggleCheck();
		tournoiModule.previewImg();

		//Search
		tournoiModule.searchRequest();

		//CRUD
		tournoiModule.postDataUpdate();
		//tournoiModule.postDataInsert();		
	},

	//Setter
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
		this._previewInput = jQuery('.tournament-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.tournament-img');
	},

	//Getter
	getAdminSearchInput : function(){
		return this._adminSearchInput;
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
		tournoiModule.getAdminSearchInput().parent().on("submit", function(ev){
			ev.preventDefault();
			return false;
		});
		if(callback){
			tournoiModule.getAdminSearchInput().on('keypress', function() {
				setTimeout(function(){
					if(tournoiModule.getAdminSearchInput().val())
	    			callback(tournoiModule.getAdminSearchInput().val());
		    		else
		    			callback("undefined");
				}, 2000)
			});
		}
	},
	//Request Search
	searchRequest : function(){
		tournoiModule.searchValue(function(value){
			//console.log(value);
			if(value && value !== "undefined"){
				var data = {name : value};
				jQuery.ajax({
					url: "admin/getTournamentByName", 				
					type: "POST",
					data: data,
					success: function(result){
						//console.log(result);

						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							//console.log(result);
							var userArr = jQuery.parseJSON(result);	
							//console.log(userArr);
							onglet.getAdminDataIhm().removeClass('hidden');
							//On affiche les elements présents dans le tableau
							if(userArr.length == 1){
								//console.log(userArr[0].name);
						 		var myRDiv = onglet.getAdminDataRe().find(".tournament-name-g:not(:contains(" + userArr[0].name + "))").parent().parent().parent();
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
					 			var myRDiv = onglet.getAdminDataRe().find(".tournament-name-g:not(" + fullStringContains + ")").parent().parent().parent();
					 			console.log(myRDiv);
					 			myRDiv.addClass('hidden');
					 		}							
						}else{
							adminError.highlightInput(membreModule.getAdminSearchInput());
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
	toggleCheck : function(){
		tournoiModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.tournament-status-p').prop("checked", !jQuery(ev.currentTarget).find('.tournament-status-p').prop("checked"));
		});
	},
	//Preview
	previewImg : function(){
		tournoiModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, jQuery(this).parent().parent().find('.tournament-img'));
		});
	},
	postDataUpdate : function(){
		tournoiModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.tournament-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.tournament-id-p').val();
				var name = updateBtn.parent().parent().find('.tournament-name-p').val();
				var nameEl = updateBtn.parent().parent().find('.tournament-name-p');
				var description = updateBtn.parent().parent().find('.tournament-description-p').val();
				var status;

				if(updateBtn.parent().parent().find('.tournament-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}

				var allData = {};

				allData.id = id;
				allData.status = status;

				if(name)
					allData.name = name;
				
				if(description)
					allData.description = description;

			    //Update du tournoi
			    if(adminError.isNameValid(nameEl)){
					jQuery.ajax({
						url: "admin/updateTournamentsData", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log(result);
							console.log("Tournoi mise à jour");
							//Reload la mise a jour dans l'html
							if(allData.name){updateBtn.parent().parent().find('.tournament-nom-g').html(allData.name);}
							if(allData.description){updateBtn.parent().parent().find('.tournament-description-g').html(allData.description);}
							
							if(allData.status == 1){
								updateBtn.parent().parent().find('.tournament-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>"
								); 
							}else{
								updateBtn.parent().parent().find('.tournament-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-lock.png'>"
								); 
							}
							navbar.form.smoothClosing();				
						},
						error: function(result){
							throw new Error("Couldn't update tournament", result);
						}
					});
				}
			});			
		});
	},
	postDataInsert : function(){

	}
};
