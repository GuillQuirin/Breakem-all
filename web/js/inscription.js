if($(window).width()>=1000){
	/*animation sur écran de bureau*/
	// $("#content").mouseenter(function(){
	// 	$("#left").animate({
	// 	    left: 0,
	// 	  }, 1000, function() {});
	// });			

	// $("#content").mouseleave(function(){
	// 	$("#left").animate({
	// 	    left: '-26%',
	// 	  }, 1000, function() {});
	// });	
}


/*PRE-ANALYSE DU FORMULAIRE*/
$("#inscr_coord input").focusout(function(){
	var res=0;

	//Pseudo
	if($(this).attr("type")=="text"){
		//Ajax de disponibilité du pseudo
		res=1;
	}
	//Email
	if($(this).attr("type")=="email"){
		var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
		res=regex.test($(this).val());
	}
	//Password
	if(($(this).attr("id")=="insc_pwd")){
		res=($(this).val()=="") ? 0 : 1;

		if($(this).val()==$("#conf_insc_pwd").val() && $("#conf_insc_pwd").val()!="")
			bordure($("#conf_insc_pwd"),1);
		else		
			bordure($("#conf_insc_pwd"),0);
	}
	//Conf. Password
	if($(this).attr("id")=="conf_insc_pwd"){
		res = ($(this).val()==$("#insc_pwd").val() && $("#conf_insc_pwd").val()!="") ? 1 : 0;
	}
	//Naissance
	if($(this).attr("type")=="number"){
		return false;
	}
	bordure($(this),res);
});

function bordure(that,res){//Message d'avertissement affiché
	if(res){
		$(that).css({"border":"2px solid green"});
		$("#"+$(that).attr("id")+"+.bullecontent").animate({opacity: '0'}, 500, function(){});
	}
	else{
		$(that).css({"border":"2px solid red"});
		$("#"+$(that).attr("id")+"+.bullecontent").animate({opacity: '1'}, 500, function(){});
	}
};