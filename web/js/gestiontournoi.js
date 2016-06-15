$(document).load(function(){
	setTimeout(function(){},1000);
});

$(document).ready(function(){
	$("#btn-shut-down").click(function(e){
		e.preventDefault();
		var link = $_GET("t");
		if(confirm("Souhaitez-vous vraiment verrouiller ce tournoi ?")){
			jQuery.ajax({
			 	url: "gestiontournoi/deleteTour",
			 	type: "POST",
			 	data : "link="+link,
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

	$('#btn_member_tournament').click(function(){
		var link = $_GET("t");
		var message = $('#msg_tournament').val();
		if(message.trim()!==""){
			jQuery.ajax({
			 	url: "gestiontournoi/mailMember",
			 	type: "POST",
			 	data : "message="+message,
			 	success: function(result){
			 		$("#result").html("Le mail a  correctement été envoyé.");
			 	},
			 	error: function(result){
			 		$("#result").html("Problème d'envoi du message.");
			 	}
			});
		}
		else
			$("#result").html("Le message ne peut pas être vide.");

	});
});