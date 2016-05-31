/*$("#TGformsubmit").click(function(){
	var name = $("#typegameForm #name").val();
	var description = $("#typegameForm #description").val();
	var id = $("#typegameForm #id").val();
	var src = $("#typegameForm #img").prop('src');

	if(!id){
		alert("Veuillez selectionner un type de jeu ou en créer un.");
		return false;
	}
	
	if(id!=="-1"){ // Update
		console.log("MAJ");
		jQuery.ajax({
		 	url: "admin/updateTypeGameBy",
		 	type: "POST",
		 	data : "id="+id+"&name="+name+"&description="+description+"&src="+src,
		 	success: function(result){
		 		console.log(result);
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
	else{ // New
		console.log("Creation");
		jQuery.ajax({
		 	url: "admin/createTypeGameBy",
		 	type: "POST",
		 	data : "id="+id+"&name="+name+"&description="+description+"&src="+src,
		 	success: function(result){
		 		console.log(result);
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
});*/

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
		 		alert("non");
		 	}
		});
	}
}