$(document).ready( function(){
	//Fonction qui permet de redimensionner les img
	$(window).resize(function () {
        var _width = $(window).width(),
            _height = $(window).height();
    });

	//Affichages des popups
	$("#currentTournament").click(function(){
		$.ajax({
				method: "GET",
				url: "index/currentTournament", 
				success: function(result){
	           		$("#contentCurrentTournament").html(result);
        			$("#wrapperCurrentTournament").fadeIn();
        		}
        	}
        );
		return false;
	});

    /*if($('.li').hasClass('.defaut')){
    	console.log('test');
    	$('.li').removeClass('.border_menu');
    }
  /*  console.log("toto");
	$("#menu_icon").click(function(){
		$("#menu2 > ul").toggle();
		});

	$("#content").click(function(){
		$("#menu2 > ul").hide();
		});

	$( window ).resize(function() {
		$("#menu2 > ul").hide();
	});*/

});


$(document).mouseup(function(e)
{
    var container = $("#wrapperCurrentTournament");

    if(!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut();
    }
});