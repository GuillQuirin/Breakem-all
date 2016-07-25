"use strict";
var teamModule = {	
	_this: this,
	init: function(){
		//Setter
		teamModule.setDeleteBtn();
		teamModule.setUpdateBtn();
		teamModule.setInsertBtn();
		teamModule.setPreviewInput();
		teamModule.setImgWrapper();
		teamModule.setAdminDataRe();
		teamModule.setToggleCheck();
		teamModule.setAdminSearchInput();
		teamModule.setDataIhm();

		//Preview
		teamModule.toggleCheck();
		teamModule.previewImg();

		//Search
		teamModule.searchRequest();

		//CRUD
		teamModule.postDataUpdate();
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
		this._previewInput = jQuery('.team-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.team-img');
	},

	//Getter
	getDataIhm : function(){
		return this._dataIhm;
	},
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
	toggleCheck : function(){
		teamModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.team-status-p').prop("checked", !jQuery(ev.currentTarget).find('.team-status-p').prop("checked"));
		});
	},
	//Search Delay
	searchValue : function(callback){
		teamModule.getAdminSearchInput().parent().on("submit", function(ev){
			ev.preventDefault();
			return false;
		});
		if(callback){
			teamModule.getAdminSearchInput().on('keypress', function() {
				setTimeout(function(){
					if(teamModule.getAdminSearchInput().val())
	    			callback(teamModule.getAdminSearchInput().val());
		    		else
		    			callback("undefined");
				}, 2000)
			});
		}
	},
	//Request Search
	searchRequest : function(){
		teamModule.searchValue(function(value){
			//console.log(value);
			if(value && value !== "undefined"){
				var data = {name : value};
				jQuery.ajax({
					url: "admin/getTeamByName", 				
					type: "POST",
					data: data,
					success: function(result){
						console.log(result);
						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							//console.log(result);
							var userArr = jQuery.parseJSON(result);	
							//console.log(userArr);
							teamModule.getDataIhm().removeClass('hidden');
							//On affiche les elements présents dans le tableau
							if(userArr.length == 1){
								//console.log(userArr[0].name);
						 		var myRDiv = onglet.getAdminDataRe().find(".team-name-g:not(:contains(" + userArr[0].name + "))").parent().parent().parent();
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
					 			var myRDiv = onglet.getAdminDataRe().find(".team-name-g:not(" + fullStringContains + ")").parent().parent().parent();
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
		teamModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, jQuery(this).parent().parent().find('.team-img'));
		});
	},
	postDataUpdate : function(){
		teamModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.team-submit-form-btn');

			//Submit : Usage de la fonction
			navbar.form.closeFormEnter(submitBtn.parent().parent());

			//Submit : Revérification
			submitBtn.parent().parent().submit(function(enterEvent){
				enterEvent.preventDefault();
				return false;
			});

			submitBtn.on("click", function(updateEvent){
				var id = updateBtn.parent().parent().find('.team-id-p').val();
				var status;
				if(updateBtn.parent().parent().find('.team-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}
				var name = updateBtn.parent().parent().find('.team-name-p').val();
				var slogan = updateBtn.parent().parent().find('.team-slogan-p').val();
				var description = updateBtn.parent().parent().find('.team-description-p').val();
				var myImg = updateBtn.parent().parent().find('.admin-input-file > .team-image-p');

				var allData = {};

				allData.id = id;
				allData.status = status;

				//Vérification si ils existent, on modifie, sinon on laisse la valeur initiale.
				//IMPORTANT : Ne pas mettre de ternaire de type allData.id = id ? id : ''; car on laisse la valeur initiale. On ne la change pas.
				if(status)
					allData.status = status;
				
				if(name)
					allData.name = name;
				
				if(slogan)
					allData.slogan = slogan;
				
				if(description)
					allData.description = description;
				
				//Upload des images
			    if (typeof FormData !== 'undefined') {
			           
			        //Pour l'upload coté serveur
			        var file = myImg.prop('files')[0];

			        if(myImg && file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = name + ".jpg";

			        	var imgData = new FormData();                  
					    imgData.append('file', file);	
					    imgData.append('name', name);			    		                             
					    jQuery.ajax({
				            url: "admin/updateTeamsData", 
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
			       popupError.init("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
			    } 		

			    //Update de la team
				jQuery.ajax({
					url: "admin/updateTeamsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Team mise à jour");
						console.log(result);
						console.log(allData);
						
						//Reload la mise a jour dans l'html
						if(allData.name){ updateBtn.parent().parent().find('.team-name-g').html(name); }
						if(allData.description){ updateBtn.parent().parent().find('.team-description-g').html(description); }
						if(allData.slogan){ updateBtn.parent().parent().find('.team-slogan-g').html(slogan); }

						if(allData.status == 1){
							updateBtn.parent().parent().find('.team-status-g-ht').html(
								"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>"
							); 
						}else{
							updateBtn.parent().parent().find('.team-status-g-ht').html(
								"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-lock.png'>"
							); 
						}
						

						//Si l'image uploadé existe on l'envoi dans la dom, le Date.now() sert a ne pas cacher l'image du meme nom!!!! ASTUCE DE DINGUE
						if(allData.img){
							updateBtn.parent().parent().find('.team-img-up').attr('src', webpath.get() + "/web/img/upload/team/" + allData.img + "?lastmod=" + Date.now());	
						}	
						navbar.form.smoothClosing();				
					},
					error: function(result){
						throw new Error("Couldn't update team", result);
					}
				});
				updateEvent.preventDefault();
				return false;
			
			});			
		});
	}
};
