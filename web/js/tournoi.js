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

		tfm._activeArr = 0;
	});
};
tournoiFunctionsManager.prototype.getNextFadeIn = function(currIndex){
	if(currIndex === tfm._gameNumber-1 ){return 0};
	return currIndex+1;
};
tournoiFunctionsManager.prototype.lancerChgtsAutoCaroussel = function(tick) {
	setInterval(function(){
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
		console.log(tfm._activeArr);
	}, tick);
};
var funcMan_tournoi = new tournoiFunctionsManager();


window.onload = function(){
	funcMan_tournoi.repertorierJeuxCaroussel();
	funcMan_tournoi.lancerChgtsAutoCaroussel(12000);
}
