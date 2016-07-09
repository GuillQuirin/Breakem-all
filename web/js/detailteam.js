//Validation avec tous les id qui commence par validate-form-
$("button[id^='action-team-']" ).on('click', function() {
	//Recherche le formulaire le plus proche pour valider
    $(this).closest('form').submit();
});

$(document).ready(function(){	
	//Edition de la team
	$('.btn-modif-team').click(function() {
		$('.popup').fadeIn('100');
		return false;
	});

	$('.popup-fond').click(function() {
		$('.popup').fadeOut(500);
	});

	//Signalement d'un commentaire
	$("img[id^='comment-report-']" ).on('click', function() {
		var commentaire = $(this).prop('id').replace("comment-report-","");
		$.ajax({method: "POST",
				data:{id: commentaire},
				url: "detailteam/reportComment", 
				success: function(result){
					console.log($(this));
            		$(this).html("");
        		}
        	}
        );
	});

	//Edition d'un commentaire
	$("img[id^='comment-edit-']").click(function() {
		var id = $(this).prop('id').replace("comment-edit-","");
		$('.popup-comment-edit input[name="id"]').prop("value", id);

		var message = $(this).parent().find(".message").html();
		$('.popup-comment-edit textarea').text(message);

		$('.popup-comment-edit').fadeIn('100');
	});

	$('.cancel').click(function(){
		clearForm('.popup-comment-edit');
	});

});

$(document).mouseup(function(e)
{
    var container = ".popup-comment-edit";
    if(!$(container).is(e.target) && $(container).has(e.target).length === 0) 
        clearForm(container);

    /*var container = ".popup";
    if(!$(container).is(e.target) && $(container).has(e.target).length === 0) 
        clearForm(container);*/
});



function clearForm(conteneur){
	$(conteneur+" textarea").text("");
	$(conteneur+" input[name='id']").prop("value","");
	$(conteneur).fadeOut(500);
}



