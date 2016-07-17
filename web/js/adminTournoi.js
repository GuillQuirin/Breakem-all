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

		//Preview
		tournoiModule.toggleCheck();
		tournoiModule.previewImg();

		//CRUD
		tournoiModule.postDataUpdate();
		//tournoiModule.postDataInsert();		
	},

	//Setter
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
		tournoiModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.tournament-status-p').prop("checked", !jQuery(ev.currentTarget).find('.tournament-status-p').prop("checked"));
		});
	},
	//Preview
	previewImg : function(){
		tournoiModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, tournoiModule.getImgWrapper());
		});
	},
	postDataUpdate : function(){
		tournoiModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.tournament-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.tournament-id-p').val();
				var name = updateBtn.parent().parent().find('.tournament-name-p').val();
				var description = updateBtn.parent().parent().find('.tournament-description-p').val();
				var status;

				if(updateBtn.parent().parent().find('.platform-status-p').is(':checked')){
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
			    if(allData.name || allData.description || allData.status ){
					jQuery.ajax({
						url: "admin/updateTournamentsData", 
						type: "POST",
						data: allData,
						success: function(result){
							console.log(result);
							console.log("Plateforme mise à jour");
							//Reload la mise a jour dans l'html
							if(allData.name){updateBtn.parent().parent().find('.tournament-nom-g').html(allData.name);}
							if(allData.description){updateBtn.parent().parent().find('.tournament-description-g').html(allData.description);}
							//Si l'image uploadé existe on l'envoi dans la dom
							if(allData.img){
								updateBtn.parent().parent().find('.tournament-img-up').attr('src', allData.img);	
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
