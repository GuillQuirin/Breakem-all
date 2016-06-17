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
		 		alert("non");
		 	}
		});
	}
}