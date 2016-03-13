$(document).ready(function(){
	
	$("#signalement").click(function(){
		$("#popup").fadeIn();
	});

	$("#btn_plainte").click(function(){
		if($("#plainte").val()=="" || $("#liste_plainte").val()==0){
			alert('Veuillez justifier votre signalement.');
		}
		else{
			$.ajax({method: "POST",
					data:{motif: $("#liste_plainte").val(), justif: $("#plainte").val()},
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
    var container = $("#popup");

    if(!container.is(e.target)
        && container.has(e.target).length === 0) 
    {
        container.fadeOut();
    }
});