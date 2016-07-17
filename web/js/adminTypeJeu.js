"use strict";
var typegameModule = {	
	_this: this,
	init: function(){
		//Setter
		typegameModule.setDeleteBtn();
		typegameModule.setUpdateBtn();
		typegameModule.setInsertBtn();
		typegameModule.setPreviewInput();
		typegameModule.setImgWrapper();
		typegameModule.setAdminDataRe();
		typegameModule.setToggleCheck();

		//Preview
		typegameModule.toggleCheck();
		typegameModule.previewImg();

		//CRUD
		typegameModule.postDataUpdate();
		//typegameModule.postDataInsert();		
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
		this._previewInput = jQuery('.typejeu-image-p');
	},
	setImgWrapper : function(){
		this._imgWrapper = jQuery('.typejeu-img');
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
		typegameModule.getToggleCheck().on("click", function(ev){
			jQuery(ev.currentTarget).find('.typejeu-status-p').prop("checked", !jQuery(ev.currentTarget).find('.typejeu-status-p').prop("checked"));
		});
	},
	//Preview
	previewImg : function(){
		typegameModule.getPreviewInput().on('change', function(){
			console.log("Image changed.");
    		previewUpload(this, typegameModule.getImgWrapper());
		});
	},
	postDataUpdate : function(){
		typegameModule.getUpdateBtn().on("click", function(e){
			var updateBtn = jQuery(e.currentTarget);

			var submitBtn = updateBtn.parent().parent().find('.typejeu-submit-form-btn');

			submitBtn.on("click", function(){
				var id = updateBtn.parent().parent().find('.typejeu-id-p').val();
				var name = updateBtn.parent().parent().find('.typejeu-nom-p').val();
				var description = updateBtn.parent().parent().find('.typejeu-description-p').val();

				var status;
				if(updateBtn.parent().parent().find('.typejeu-status-p').is(':checked')){
					status = -1;
				}else{
					status = 1;
				}

				var myImg = updateBtn.parent().parent().find('.admin-input-file > .typejeu-image-p');

				var allData = {};

				allData.id = id;
				allData.status = status;

				if(name)
					allData.name = name;
				
				if(description)
					allData.description = description;
				

				//Upload des images
			    if (typeof FormData !== 'undefined') {
			           
			        //Pour l'upload coté serveur
			        var file = myImg.prop('files')[0];

			        if(file){

			        	//Si une image a été uploadé, on rajoute le src a l'objet allData
			        	allData.img = file.name;

			        	var imgData = new FormData();                  
					    imgData.append('file', file);				    		                             
					    jQuery.ajax({
				            url: "admin/updateTypeGamesData", 
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
					url: "admin/updateTypeGamesData", 
					type: "POST",
					data: allData,
					success: function(result){
						console.log("Plateforme mise à jour");
						console.log("Plateforme mise à jour");
							//Reload la mise a jour dans l'html
							if(allData.name){ updateBtn.parent().parent().find('.typejeu-nom-g').html(name);}
							if(allData.description){ updateBtn.parent().parent().find('.typejeu-description-g').html(description);}
							//Si l'image uploadé existe on l'envoi dans la dom
							if(allData.img){
								updateBtn.parent().parent().find('.typejeu-img-up').attr('src', webpath.get() + "/web/img/upload/typejeux/" + allData.img);	
							}	

							if(allData.status == 1){
								updateBtn.parent().parent().find('.typejeu-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-unlock.png'>"
								); 
							}else{
								updateBtn.parent().parent().find('.typejeu-status-g-ht').html(
									"<img class='icon icon-size-4' src='" + webpath.get() + "/web/img/icon/icon-lock.png'>"
								); 
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

