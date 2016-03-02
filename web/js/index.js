$(document).ready( function(){

$("#menu_icon").click(function(){
	$("#menu2 > ul").toggle();
	});

$("#content").click(function(){
	$("#menu2 > ul").hide();
	});

$( window ).resize(function() {
	$("#menu2 > ul").hide();
});

});