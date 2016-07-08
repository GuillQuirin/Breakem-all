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
});

$(document).mouseup(function(e)
{
    var container = $("#formplainte, #formcontact");

    if(!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut();
    }
});

