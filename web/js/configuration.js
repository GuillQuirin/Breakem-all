$(document).ready(function(){
	//Pop-up de désinscription
	$("#delete-account").click(function(){
		if(confirm("ATTENTION: Souhaitez-vous vraiment vous désinscrire de ce site ?")){
			$.ajax({method: "POST",
						data:{
							pseudo: $("#pseudo-user").text()
						},
						url: webpath.get()+"/configuration/delete", 
						success: function(result){
		            		window.location.href = webpath.get()+"/index";
		        			//console.log(result);
		        		},
		        		fail: function(){
		        			popup.error('La suppression de votre compte n\'a pas pu être effectuée');
		        		}
		        	}
		        );
		}
		return false;
	});
});

