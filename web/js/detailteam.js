//Validation avec tous les id qui commence par validate-form-
$("button[id^='action-team-']" ).on('click', function() {
	//Recherche le formulaire le plus proche pour valider
    $(this).closest('form').submit();
});

$(document).ready(function(){	
	$('.btn-modif-team').click(function() {
		$('.popup').fadeIn('100');
	});

	$('.popup-fond').click(function() {
		$('.popup').fadeOut(500);
	});

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

	$("img[id^='comment-edit-']" ).on({
		click: function(){
			$("#MAJComment").prop("action","detailteam/editComment");
			
			var id = $(this).prop('id').replace("comment-edit-","");
			$(this).parent().append("<input type='hidden' name='id' value='"+id+"'>");
			
			var message = $(this).parent().find(".message").html();
			$(this).parent().find(".message").html("<textarea name='comment'>"+message+"</textarea>");
			
			$(this).parent().append("<input type='submit' value='Mettre à jour'>");		
			}
		});

});

