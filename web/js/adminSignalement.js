//Maj signalement
function deleteReport(id){
	if(confirm("Souhaitez vous supprimer cet avertissement ?")){
		jQuery.ajax({
		 	url: "admin/DeleteReports",
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