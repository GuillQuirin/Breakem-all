//Validation avec tous les id qui commence par validate-form-
$("button[id^='action-user-']" ).on('click', function() {
	//Recherche le formulaire le plus proche pour valider
    $(this).closest('form').submit();
});
