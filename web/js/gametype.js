function getTypeGame(id){
	if(id!==-1){
		jQuery.ajax({
		 	url: "admin/getTypeGameBy",
		 	type: "POST",
		 	data : "id="+id,
		 	success: function(result){
		 		var type = tryParseData(result);
		 		//console.log(type);
		 		$("#typegameForm #id").val(type.id);
		 		$("#typegameForm #name").val(type.name);
		 		$("#typegameForm #description").text(type.description);
		 		$("#typegameForm #img").prop('src',type.img);
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
	else{
		$("#typegameForm #id").val(-1);
 		$("#typegameForm #name").val("");
 		$("#typegameForm #description").text("");
 		$("#typegameForm #img").prop('src',"");
	}
}

$("#TGformsubmit").click(function(){
	var name = $("#typegameForm #name").val();
	var description = $("#typegameForm #description").val();
	var id = $("#typegameForm #id").val();
	var src = $("#typegameForm #img").prop('src');
	console.log(id);
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
});

function deleteTypeGame(id){
	if(confirm("Souhaitez vous supprimer cet type de jeu ?")){
		jQuery.ajax({
		 	url: "admin/DeleteTypeGame",
		 	type: "POST",
		 	data : "id="+id,
		 	success: function(result){
		 		location.reload(true);
		 		//console.log(result);
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
}