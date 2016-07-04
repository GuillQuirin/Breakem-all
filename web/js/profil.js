$(document).ready(function(){
	//Affichages des popups
	$("#signalement").click(function(){
		$("#formplainte").fadeIn();
		return false;
	});

	$("#contact").click(function(){
		$("#formcontact").fadeIn();
		return false;
	});

	//Controle des messages
	$("#btn_plainte").click(function(){
		if( $.trim($("#mess_plainte").val())=="" || $.trim($("#suj_plainte").val())==""){
			alert('Veuillez justifier votre signalement.');
		}
		else{
	        $.ajax({method: "POST",
						data:{
							message: $("#mess_plainte").val(),
							motif: $("#suj_plainte").val()
						},
						url: "profil/report", 
						success: function(result){
		            		$("#formplainte .sendOK").fadeIn();$
		            		$("#formplainte").fadeOut();
		            		$("#gestionplainte").html('<p id="signalementnope">Vous avez déjà signalé ce joueur</p>');
		        		},
		        		fail: function(){
		        			$("#formplainte .sendError").fadeIn();
		        		}
		        	}
		        );
		}
		return false;
	});

	$("#btn_contact").click(function(){
		if($.trim($("#mess_contact").val())==""){
			alert('Veuillez ne pas envoyer un message vide.');
		}
		else{
	        $.ajax({method: "POST",
						data:{
							message: $("#mess_contact").val()
						},
						url: "profil/contact", 
						success: function(result){
		            		$("#formcontact .sendOk").fadeIn();
		        		},
		        		fail: function(){
		        			$("#formcontact .sendError").fadeIn();
		        		}
		        	}
		        );
		}
		return false;
	});
});

$(document).mouseup(function(e)
{
    var container = $("#formplainte, #formcontact");

    if(!container.is(e.target) && container.has(e.target).length === 0) 
    {
    	$("#mess_contact").val("");
        $("#mess_plainte").val("");
        $("#suj_plainte").val("");
    	$(".sendError, .sendOk").fadeOut();
        container.fadeOut();
    }
});