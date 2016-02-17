function tournoiFunctionsManager(){tfm = this;};
tournoiFunctionsManager.prototype.getTickingChangePeriod = function(){return 12000};
tournoiFunctionsManager.prototype.repertorierJeuxCaroussel = function() {
	var caroussel = $('.tournoi-moving-container');
	var jeux = caroussel.children('.tournoi-jeu');	
	tfm._arr = new Object();
	tfm._gameNumber = 0;
	jeux.each(function(index, el) {
		var dataToMatch = $(this).data('gamename');
		var assoc_link = $(this).closest("div.max-container").find('li[data-gamename='+dataToMatch+']');
		tfm._gameNumber += 1;
		var tmp = [];
		tmp.push($(this));
		tmp.push(assoc_link);
		tfm._arr[index] = tmp;

		tfm._clickedArray = 'not-clicked';
		tfm._activeArr = 0;
	});
};
tournoiFunctionsManager.prototype.getNextFadeIn = function(currIndex){
	if(currIndex === tfm._gameNumber-1 ){return 0};
	return currIndex+1;
};
tournoiFunctionsManager.prototype.lancerChgtsAutoCaroussel = function(tick, clickedArray) {
	if(clickedArray >=0 && clickedArray < tfm._gameNumber){	
		tfm._clickedArray = clickedArray;
		var toActiv = tfm._arr[clickedArray];
		var activ = tfm._arr[tfm._activeArr];		
		setTimeout(function(){
			activ[0].removeClass('jeux-actif');
			activ[1].removeClass('choix-actif');
		}, 100);
		toActiv[1].addClass('choix-actif');
		toActiv[0].addClass('jeux-actif');


		tfm._activeArr = tfm.getNextFadeIn(clickedArray-1);
		clearInterval(tfm._intervalReturnID);
		tfm.lancerChgtsAutoCaroussel(tfm.getTickingChangePeriod());
		return true;
	};
	tfm._intervalReturnID = setInterval(function(){		
		activeArr= tfm._activeArr;

		var activ = tfm._arr[activeArr];
		var toActiv = tfm._arr[tfm.getNextFadeIn(activeArr)];

		
		setTimeout(function(){
			activ[0].removeClass('jeux-actif');
			activ[1].removeClass('choix-actif');
		}, 100);
		toActiv[1].addClass('choix-actif');
		toActiv[0].addClass('jeux-actif');		
			
		tfm._activeArr = tfm.getNextFadeIn(activeArr);
	
	}, tick);
};
tournoiFunctionsManager.prototype.lancerChgtsClickCaroussel = function()
{
	$('.tournoi-choix-jeu .changer-choix-container li').each(function(index, el) {
		if($(el).hasClass('tournoi-caroussel-li-clicked') && !($(el).hasClass('choix-actif'))){
			$(el).removeClass('tournoi-caroussel-li-clicked');
			tfm.lancerChgtsAutoCaroussel(false, index);
		};
	});
};
tournoiFunctionsManager.prototype.activateSmoothScroll = function() 
{	
    console.log('scroll detected');
};
var funcMan_tournoi = new tournoiFunctionsManager();



function tournoiEventManager(){tem = this; tem._oldScrollPos = 0;tem._scrolledOnce = false;};
tournoiEventManager.prototype.associerClickEventsToLiMenuCaroussel = function() {

	$('.tournoi-choix-jeu .changer-choix-container li').each(function() 
	{
		$(this).click(function(){
			$(this).addClass('tournoi-caroussel-li-clicked');
			funcMan_tournoi.lancerChgtsClickCaroussel();
		});
	});
};
tournoiEventManager.prototype.launchScrollListener = function() {
	$( window ).scroll(function(){
		console.log("test");
		// var position = $('.tournoi-choix-mode').scrollTop();
		// console.log(position);
		var posScroll; 
		if(tem._scrolledOnce){
			console.log('deja scroll une fois');
			posScroll = parseInt($('body > .max-container').css('top')); 
		} 
		else{
			console.log('jamais scroll');
			posScroll = $(window).scrollTop();
		}
		// var posBody = parseInt($('body > .max-container').css('top'));
		// $(window).scrollTop(tem._oldScrollPos);
		// $(window).scrollTo(400);
		// $('html, body').animate({
		// 	scrollTop:$('.tournoi-choix-date').offset().top
		// }, 'slow');
		// var oldHeight = parseInt($('.tournoi-first-image-background').css('height'));
		// console.log(oldHeight);
		console.log(posScroll);
		if(posScroll > tem._oldScrollPos){
			// $('body').animate({
			// 	scrollTop:$('.tournoi-choix-date').offset().top
			// }, 'slow');
			$('body > .max-container').css('top', (posScroll-100).toString()+'px');
			
		}else{
			$('body > .max-container').css('top', (posScroll+100).toString()+'px');
		}
		tem._oldScrollPos = posScroll;
		tem._scrolledOnce = true;
		$(window).scrollTop(0);
	});
};
var eventMan_tournoi = new tournoiEventManager();



window.onload = function(){
	eventMan_tournoi.associerClickEventsToLiMenuCaroussel();
	// eventMan_tournoi.launchScrollListener();

	funcMan_tournoi.repertorierJeuxCaroussel();	
	funcMan_tournoi.lancerChgtsAutoCaroussel(funcMan_tournoi.getTickingChangePeriod());
}
