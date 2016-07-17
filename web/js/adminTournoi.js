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

		//Preview
		tournoiModule.toggleCheck();
		tournoiModule.previewImg();

		//CRUD
		//tournoiModule.postDataUpdate();
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
		platformModule.getToggleCheck().on("click", function(ev){
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
				var pseudo = updateBtn.parent().parent().find('.tournament-pseudo-p').val();
				var team = updateBtn.parent().parent().find('.tournament-team-p').val();
				var report = updateBtn.parent().parent().find('.tournament-report-p').val();
				var status = updateBtn.parent().parent().find('.tournament-status-p').val();
				var email = updateBtn.parent().parent().find('.tournament-email-p').val();
				var myImg = updateBtn.parent().parent().find('.admin-input-file > .tournament-image-p');

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
