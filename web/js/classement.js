"use strict";

window.addEventListener('load', function load(){
	window.removeEventListener('load', load, false);
	tournoiModule.init();
});

var tournoiModule = {	
	_this: this,
	init: function(){
		//Setter
		tournoiModule.setAdminDataRe();
		tournoiModule.setAdminSearchInput();
		tournoiModule.setDataIhm();

		//Search
		tournoiModule.searchRequest();		
	},

	//Setter
	setAdminSearchInput : function(){
		this._adminSearchInput = jQuery('.admin-search-input');
	},
	setDataIhm : function(){
		this._dataIhm = jQuery('.classement-data-ihm');
	},
	setAdminDataRe : function(){
		this._adminDataRe = jQuery('.admin-data-re');
	},

	//Getter
	getDataIhm : function(){
		return this._dataIhm;
	},
	getAdminSearchInput : function(){
		return this._adminSearchInput;
	},
	getAdminDataRe : function(){
		return this._adminDataRe;
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
				var data = {pseudo : value};
				jQuery.ajax({
					url: "admin/getUserByPseudo", 				
					type: "POST",
					data: data,
					success: function(result){
						console.log(result);

						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							//console.log(result);
							var userArr = jQuery.parseJSON(result);	
							//console.log(userArr);
							tournoiModule.getDataIhm().removeClass('hidden');
							//On affiche les elements présents dans le tableau
							if(userArr.length == 1){
								//console.log(userArr[0].name);
						 		var myRDiv = tournoiModule.getAdminDataRe().find(".membre-pseudo-g:not(:contains(" + userArr[0].pseudo + "))").parent().parent().parent();
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
					 			var myRDiv = tournoiModule.getAdminDataRe().find(".membre-pseudo-g:not(" + fullStringContains + ")").parent().parent().parent();
					 			console.log(myRDiv);
					 			myRDiv.addClass('hidden');
					 		}							
						}else{
							tournoiModule.getDataIhm().removeClass('hidden');
						}
					},
				 	error: function(result){
						console.log(result);	
						tournoiModule.getDataIhm().removeClass('hidden');
				 	}
				});
			}else{
				tournoiModule.getDataIhm().removeClass('hidden');
			}
		});
	}	
};

