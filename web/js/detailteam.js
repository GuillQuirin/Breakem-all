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
	$("p[id^='comment-report-']" ).on('click', function() {
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

	//Rédaction d'un commentaire
	$("button[name='action-comment-write']").click(function(){
		if($.trim($(this).parent().find('textarea').val())==""){
			console.log("Message non vide obligatoire");
			return false;
		}
	});

	//Edition d'un commentaire
	$("p[id^='comment-edit-']").click(function() {
		var id = $(this).prop('id').replace("comment-edit-","");
		$('.popup-comment-edit input[name="id"]').prop("value", id);

		var message = $.trim($(this).parent().parent().find(".comment").html());
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



