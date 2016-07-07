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
});

