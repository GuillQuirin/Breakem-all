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

function ToggleNavbar(){
	$('#navbar-toggle').on('click', function(){
		if($('.navbar-side-menu').hasClass('navbar-collapse')){
			$('.navbar-side-menu').removeClass('navbar-collapse');
		}else{
			$('.navbar-side-menu').addClass('navbar-collapse');
		}
	});
}

$(document).ready(function(){
	ToggleNavbar();
	$(window).scroll(function(){
		ShrinkNavbar();
	})
})