function tournoiFunctionsManager(){tfm = this;}
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
	});	
	console.log(tfm._arr);
};
tournoiFunctionsManager.prototype.getNextFadeIn = function(currIndex){
	if(currIndex === tfm._gameNumber-1 ){return 0};
	return currIndex+1;
};
tournoiFunctionsManager.prototype.lancerChgtsAutoCaroussel = function(tick) {
	setInterval(function(){
		var activeArr = -1;
		for (var i = 0; i < tfm._gameNumber; i++) {
			if (tfm._arr[i][0].hasClass('jeux-actif')) {
				activeArr = i;
				break;
			};			
		};
		if (activeArr === -1) {return 0};

		var fIn = tfm._arr[activeArr];
		var fOut = tfm._arr[tfm.getNextFadeIn(activeArr)];

		fOut[0].addClass('fadeOut');
		fOut[1].addClass('li-fadeOut');

		fIn[0].addClass('fadeIn');
		fIn[1].addClass('li-fadeIn');
		setTimeout(function(){
			fIn[0].removeClass('fadeIn');
			fIn[1].removeClass('li-fadeIn');
			fIn[0].toggleClass('jeux-actif');
			fIn[1].toggleClass('choix-actif');

			fOut[0].removeClass('fadeOut');
			fOut[1].removeClass('li-fadeOut');
			fOut[0].toggleClass('jeux-actif');
			fOut[1].toggleClass('choix-actif');
		}, 800);
			
		tfm._activeArr = fIn;
	}, tick);
};
var funcMan_tournoi = new tournoiFunctionsManager();


window.onload = function(){
	funcMan_tournoi.repertorierJeuxCaroussel();
	funcMan_tournoi.lancerChgtsAutoCaroussel(12000);
}
