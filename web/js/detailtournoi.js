window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	// preventQuitPageEvent();
	dom.init();
});

var dom = {
	init: function(){
		this.setDetailTournoiInfos();
		if(!!this.getDetailTournoiInfos())
			adaptMarginToNavHeight(this.getDetailTournoiInfos());
	},
	setDetailTournoiInfos: function(){
		this._detailTournoiInfos = $('section.detailtournoi-infos');
	},
	getDetailTournoiInfos: function(){
		return this._detailTournoiInfos;
	}
}
