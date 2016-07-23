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
		commentModule.setToggleCheck();
		commentModule.setAdminSearchInput();

		//Preview
		commentModule.toggleCheck();

		//Search
		commentModule.searchRequest();

		//CRUD
		//commentModule.postDataDelete();
		commentModule.postDataUpdate();
		//commentModule.postDataInsert();		
	},

	//Setter
	setToggleCheck : function(){
		this._toggleCheck = jQuery('.toggleCheck');
	},
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
	getToggleCheck : function(){
		return this._toggleCheck;
	},
	getUpdateBtn : function(){
		return this._updateBtn;
	},
	getAdminSearchInput : function(){
		return this._adminSearchInput;
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
		commentModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.comment-status-p').prop("checked", !jQuery(ev.currentTarget).find('.comment-status-p').prop("checked"));
		});
	},
	searchRequest : function(){
		commentModule.searchValue(function(value){
			//console.log(value);
			if(value && value !== "undefined"){
				var data = {pseudo : value};
				jQuery.ajax({
					url: "admin/getCommentByPseudo", 				
					type: "POST",
					data: data,
					success: function(result){
						console.log(result);
						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							var userArr = jQuery.parseJSON(result);
							console.log(userArr);
							//console.log(userArr);
							onglet.getAdminDataIhm().removeClass('hidden');
							//On affiche les elements présents dans le tableau
							if(userArr.length == 1){
								//console.log(userArr[0].name);
						 		var myRDiv = onglet.getAdminDataRe().find(".comment-pseudo-g:not(:contains(" + userArr[0].pseudo + "))").parent().parent().parent();
						 		myRDiv.addClass('hidden');
						 	}else if(userArr.length > 1){
						 		//Création d'une string
						 		var fullStringContains = "";
						 		//Pour chaque element du tableau on ajoute un contains String
						 		//GAFFE A LA VIRGULE 
						 		jQuery.each(userArr, function(indexArr, fieldArr){
						 			console.log(indexArr);
						 			if(indexArr !== userArr.length-1)
						 				fullStringContains += ":contains(" + fieldArr.pseudo + "),";
						 			else if (indexArr == userArr.length-1)
						 				fullStringContains += ":contains(" + fieldArr.pseudo + ")";
					 			});

					 			console.log(fullStringContains);
					 			//Finnalement on ajout la string au find, puis on ajoute la classe hidden
					 			var myRDiv = onglet.getAdminDataRe().find(".comment-pseudo-g:not(" + fullStringContains + ")").parent().parent().parent();
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
	//CRUD
	//Search Delay
	searchValue : function(callback){
		commentModule.getAdminSearchInput().parent().on("submit", function(ev){
			ev.preventDefault();
			return false;
		});
		if(callback){
			commentModule.getAdminSearchInput().on('keypress', function() {
				setTimeout(function(){
					if(commentModule.getAdminSearchInput().val())
	    			callback(commentModule.getAdminSearchInput().val());
		    		else
		    			callback("undefined");
				}, 2000)
			});
		}
	},
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

			var submitBtn = updateBtn.parent().parent().find('.comment-submit-form-btn');

			navbar.form.closeFormEnter(submitBtn.parent().parent());

			submitBtn.parent().parent().submit(function(enterEvent){
				enterEvent.preventDefault();
				return false;
			});

			submitBtn.on("click", function(updateEvent){
				var id = updateBtn.parent().parent().find('.comment-id-p').val();
				var comment = updateBtn.parent().parent().find('.comment-message-p').val();
				
				var status;
				if(updateBtn.parent().parent().find('.comment-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}

				var allData = {};

				allData.id = id;
				allData.status = status;
				if(comment){
					allData.comment = comment;
				}

			    //Update de la comment
				jQuery.ajax({
					url: "admin/updateCommentsData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Commentaire mise à jour");
						//Reload la mise a jour dans l'html
						if(allData.comment){updateBtn.parent().parent().find('.comment-message-g').html(allData.comment);}
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
						throw new Error("Couldn't update membre", result);
					}
				});
				updateEvent.preventDefault();
				return false;
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
		 		popupError.init("non");
		 	}
		});
	}
}