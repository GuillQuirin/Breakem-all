"use strict";
var membreModule = {	
	_this: this,
	init: function(){
		//Setter

		//Preview

		//CRUD

	},
	//Setter

	//Getter


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
