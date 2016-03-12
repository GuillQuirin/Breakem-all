//N'est pas fonctionnel car je n'arrive pas a lié le script a toute les templates : en cours

function ShrinkNavbar(){
	$window = $(window);
	$window.scroll(function(){
		if($window.scrollTop() > 50){
			$("#navbar").removeClass('full');
			$("#navbar").addClass('shrink');
		}else{
			$("#navbar").removeClass('shrink');
			$("#navbar").addClass('full');
		}
	})
}

$(document).ready(function(){
	$(window).scroll(function(){
		ShrinkNavbar();
	})
})