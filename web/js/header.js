
$(document).ready(function(){
	$("#btn_connexion").click(function(){
		$("#black").fadeIn();
		$("#compte_exis").slideDown();
	});
	$("#close").click(function(){
		$("#black").fadeOut();
		$("#compte_exis").slideUp();
	});
	$("#black").click(function(){
		$("#black").fadeOut();
		$("#compte_exis").slideUp();
	});
});