/*$("#TGformsubmit").click(function(){
	var name = $("#typegameForm #name").val();
	var description = $("#typegameForm #description").val();
	var id = $("#typegameForm #id").val();
	var src = $("#typegameForm #img").prop('src');

	if(!id){
		popupError.init("Veuillez selectionner un type de jeu ou en créer un.");
		return false;
	}
	
	if(id!=="-1"){ // Update
		jQuery.ajax({
		 	url: "admin/updateTypeGameBy",
		 	type: "POST",
		 	data : "id="+id+"&name="+name+"&description="+description+"&src="+src,
		 	success: function(result){
		 		console.log(result);
		 	},
		 	error: function(result){
		 		popupError.init("non");
		 	}
		});
	}
	else{ // New
		jQuery.ajax({
		 	url: "admin/createTypeGameBy",
		 	type: "POST",
		 	data : "id="+id+"&name="+name+"&description="+description+"&src="+src,
		 	success: function(result){
		 		console.log(result);
		 	},
		 	error: function(result){
		 		popupError.init("non");
		 	}
		});
	}
});

function deleteGame(id){
	if(confirm("Souhaitez vous supprimer ce jeu ?")){
		jQuery.ajax({
		 	url: "admin/delGame",
		 	type: "POST",
		 	data : "id="+id,
		 	success: function(result){
		 		//location.reload(true);
		 		console.log(result);
		 	},
		 	error: function(result){
		 		popupError.init("non");
		 	}
		});
	}
}*/