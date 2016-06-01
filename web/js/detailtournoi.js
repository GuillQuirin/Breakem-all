window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	// preventQuitPageEvent();
	dom.init();
	tournamentRegister.init();
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

var tournamentRegister = {
	init: function(){
		this.setRandBtn();
		if(this.getRandBtn().length == 1 && this.getRandBtn() instanceof jQuery){
			this.setTget();
			if(this.getTget().length > 0){
				this.setSjeton();
				if(this.getSjeton().length == 1 && this.getSjeton() instanceof jQuery)
					this.loadRandRegisterEvent();
			}
		}
	},
	setRandBtn: function(){
		this._randBtn = $('.detailtournoi-btn-inscription');
	},
	setTget: function(){
		this._tGet = $_GET('t');
	},
	setSjeton: function(){
		this._sJeton = $('#sJeton');
	},
	getRandBtn: function(){return this._randBtn;},
	getTget: function(){return this._tGet;},
	getSjeton: function(){return this._sJeton;},
	loadRandRegisterEvent: function(){
		var _this = this;
		this.getRandBtn().click(function(event){
			jQuery.ajax({
				url: 'tournoi/randRegister',
				type: 'POST',
				data: {
					t: _this.getTget(),
					sJeton: _this.getSjeton().val()
				},
				complete: function(xhr, textStatus) {
					// console.log("request completed \n");
				},
				success: function(data, textStatus, xhr) {
					var obj = tryParseData(data);
					if(obj != false){
						if(obj.errors){
							console.log(obj.errors);

							return;
						}
						popup.init('Vous avez été inscrit aléatoirement à une équipe');
						setTimeout(function(){
							location.reload();
						}, 1000);							
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log("request error !! : \t " + errorThrown);
				}
			});
		});
	}
};
var tournamentUnregister = {
	init: function(){
		this.setBtn();
		if(this.getBtn() instanceof jQuery && this.getBtn().length == 1)
			this.loadEvent();
	},
	setBtn: function(){
		this._btn = $('.detailtournoi-btn-desinscription');
	},
	getBtn: function(){
		return this._btn;
	},
	loadEvent: function(){
		
	}
}
