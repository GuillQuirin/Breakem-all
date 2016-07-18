window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	// preventQuitPageEvent();
	tournamentsListDom.init();
});
var tournamentsListDom = {
	init: function(){
		this.setTListContainer();
		if(this.getTListContainer() instanceof jQuery)
			// adaptMarginToNavHeight(this.getTListContainer());
		this.setTitleContainer();
		if(this.getTitleContainer() instanceof jQuery)
			adaptMarginToNavHeight(this.getTitleContainer());
	},
	setTListContainer: function(){
		this._tContainer = $('section.tournamentslist-tournoi');
	},
	setTitleContainer: function(){
		this._titleContainer = $('div.tournamentslist-title-container');
	},
	getTListContainer: function(){return this._tContainer;},
	getTitleContainer: function(){return this._titleContainer;}
};