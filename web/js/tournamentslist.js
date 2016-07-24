var tournamentsListDom = {
	init: function(){
		tournamentsListDom.setTListContainer();
		if(tournamentsListDom.getTListContainer() instanceof jQuery){
			// adaptMarginToNavHeight(tournamentsListDom.getTListContainer());
		}
		tournamentsListDom.setTitleContainer();
		if(tournamentsListDom.getTitleContainer() instanceof jQuery)
			adaptMarginToNavHeight(tournamentsListDom.getTitleContainer());
	},
	setTListContainer: function(){
		tournamentsListDom._tContainer = $('section.tournamentslist-tournoi');
	},
	setTitleContainer: function(){
		tournamentsListDom._titleContainer = $('div.tournamentslist-title-container');
	},
	getTListContainer: function(){return tournamentsListDom._tContainer;},
	getTitleContainer: function(){return tournamentsListDom._titleContainer;}
};
initAll.add(tournamentsListDom.init);