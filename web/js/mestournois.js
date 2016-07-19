"use strict";

var tournamentsOrga = {
	_this: this,
	init : function(){
		tournamentsOrga.setUserPseudo();

		tournamentsOrga.requestDOM();
	},
	//Setter
	setUserPseudo : function(){
		this._userPseudo = jQuery('.t-user-g').text();
	},

	//Getter
	getUserPseudo : function(){
		return this._userPseudo;
	},
	//Request
	requestDOM : function(){
		var data = {pseudo : tournamentsOrga.getUserPseudo()};
		jQuery.ajax({
			url: "mestournois/getTournamentsOrganisedByUser", 				
			type: "POST",
			data: data,
			success: function(result){
				console.log(result);
				var myRDiv = jQuery.parseJSON(result);
				console.log(myRDiv);

				//Check si dans le controlleur j'ai renvoyé un json ou un undefined
				if(!(wordInString(result, "undefined"))){
					
				}else{

				}
			},
		 	error: function(result){
				console.log(result);	
		 	}
		});
	}
};

//tournamentsOrga.init();