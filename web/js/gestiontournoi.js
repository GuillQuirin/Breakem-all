$(document).load(function(){
	setTimeout(function(){},1000);
});

$(document).ready(function(){
	$("#btn-shut-down").click(function(e){
		e.preventDefault();
		var nom = $("#nomTournoi").val();
		if(confirm("Souhaitez-vous vraiment verrouiller ce tournoi ?")){
			jQuery.ajax({
			 	url: "gestiontournoi/deleteTour",
			 	type: "POST",
			 	data : "nom="+nom,
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
});