$(document).ready(function(){
	//Redirection vers la configuration utilisateur
	$("#configuration").click(function(){
		window.location.href = "/esgi/Breakem-all/configuration";
	});

	//Affichages des popups
	$("#signalement").click(function(){
		$("#formplainte").fadeIn();
	});

	$("#contact").click(function(){
		$("#formcontact").fadeIn();
	});

	//Controle des messages
	$("#btn_plainte").click(function(){
		if($("#mess_plainte").val()=="" || $("#liste_plainte").val()==0){
			alert('Veuillez justifier votre signalement.');
		}
		else{
			$.ajax({method: "POST",
					data:{motif: $("#liste_plainte").val(), justif: $("#mess_plainte").val()},
					url: "demo_test.txt", 
					success: function(result){
	            		alert(result);
	        		}
	        	}
	        );
		}
	});
	$("#btn_contact").click(function(){
		if($("#mess_contact").val()==""){
			alert('Veuillez ne pas laisser un message vide.');
		}
		else{
			$.ajax({method: "POST",
					data:{message: $("#mess_contact").val()},
					url: "demo_test.txt", 
					success: function(result){
	            		alert(result);
	        		}
	        	}
	        );
		}
	});
});

$(document).mouseup(function(e)
{
    var container = $("#formplainte, #formcontact");

    if(!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut();
    }
});