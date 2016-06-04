$("#btn-shut-down").click(function(e){
	e.preventDefault();
	if(confirm("Souhaitez-vous vraiment verrouiller ce tournoi ?")){
		jQuery.ajax({
		 	url: "gestiontournoi/deleteTour",
		 	type: "POST",
		 	data : "id="+id,
		 	success: function(result){
		 		//window.location.href = "http://stackoverflow.com";
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
	return false;
});