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
	// console.log(tfm._arr);
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
		console.log(activeArr);
	}, tick);
};
var funcMan_tournoi = new tournoiFunctionsManager();


window.onload = function(){
	funcMan_tournoi.repertorierJeuxCaroussel();
	funcMan_tournoi.lancerChgtsAutoCaroussel(1000);
}
