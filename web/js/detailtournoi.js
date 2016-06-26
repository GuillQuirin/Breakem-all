window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	// preventQuitPageEvent();
	dom.init();
	tournamentRegister.init();
	tournamentUnregister.init();
});

var dom = {
	init: function(){
		this.setDetailTournoiInfos();
		this.setEquipesLibresSection();
		if(isElSoloJqueryInstance(this.getDetailTournoiInfos()) && isElSoloJqueryInstance(this.getEquipesLibresSection()))
			adaptMarginToNavHeight(this.getDetailTournoiInfos());
		this.setBtnsTeam();
	},
	setDetailTournoiInfos: function(){
		this._detailTournoiInfos = $('section.detailtournoi-infos');
	},
	setEquipesLibresSection: function(){
		this._eqLibSec = $('.detailtournoi-equipeslibres-section');
	},
	setBtnsTeam: function(){
		this._btnsTeamJoin = $('.equipelibre-btn-inscription');
	},
	getDetailTournoiInfos: function(){
		return this._detailTournoiInfos;
	},
	getEquipesLibresSection: function(){
		return this._eqLibSec;
	},
	getBtnsTeam: function(){
		return this._btnsTeamJoin;
	}
}

var tournamentRegister = {
	init: function(){
		var _this = this;
		this.setRandBtn();
		this.setSjeton();
		this.setTget();
		if(!isElSoloJqueryInstance(this.getSjeton()))
			return;
		if(this.getTget().length < 5)
			return;
		// Event du cas où le tournoi est à l'inscription random
		if(isElSoloJqueryInstance(this.getRandBtn())){
			this.loadRandRegisterEvent();
			return;
		}

		this.setChoiceBtn();
		if(isElSoloJqueryInstance(this.getChoiceBtn())){
			dom.getBtnsTeam().each(function(index, el) {
				_this.loadJoinTeamEvent($(el));
			});
			this.loadChooseTeamBtnEvent();
			return;
		}

	},
	setChoiceBtn: function(){
		this._choiceBtn = $('.detailtournoi-btn-inscription-choisie');
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
	getChoiceBtn: function(){return this._choiceBtn;},
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
	},
	loadChooseTeamBtnEvent: function(){
		var _this = this;
		scroll.init(this.getChoiceBtn(), dom.getEquipesLibresSection());
		this.getChoiceBtn().click(function(event){
			popup.init("Choisissez votre équipe");
			dom.getEquipesLibresSection().addClass('animation fade fadeRight');
			// setTimeout(function(){
			// 	dom.getEquipesLibresSection().removeClass('animation fade fadeRight');
			// }, 550);
			_this.getChoiceBtn().off();
		});
	},
	loadJoinTeamEvent: function(jQBtn){
		var _this = this;
		if(isElSoloJqueryInstance(jQBtn)){
			var _hInput = jQBtn.parent().find('.equipelibre-tt-id');
			var _teamId = parseInt(_hInput.val());
			_hInput.remove();
			jQBtn.click(function(e){
				jQuery.ajax({
					url: 'tournoi/teamRegister',
					type: 'POST',
					data: {
						t: _this.getTget(),
						ttid: _teamId,
						sJeton: _this.getSjeton().val()
					},
					complete: function(xhr, textStatus) {
						// console.log("request completed \n");
					},
					success: function(data, textStatus, xhr) {
						console.log(data);
						// var obj = tryParseData(data);
						// if(obj != false){
						// 	if(obj.errors){
						// 		console.log(obj.errors);

						// 		return;
						// 	}
						// 	popup.init('Vous avez été inscrit aléatoirement à une équipe');
						// 	setTimeout(function(){
						// 		location.reload();
						// 	}, 1000);
						// }
					},
					error: function(xhr, textStatus, errorThrown) {
						console.log("request error !! : \t " + errorThrown);
					}
				});
			});
		}
	}
};
var tournamentUnregister = {
	init: function(){
		this.setBtn();
		if(this.getBtn() instanceof jQuery && this.getBtn().length == 1 && tournamentRegister.getSjeton() instanceof jQuery && tournamentRegister.getSjeton().length == 1)
			this.loadEvent();
	},
	setBtn: function(){
		this._btn = $('.detailtournoi-btn-desinscription');
	},
	getBtn: function(){
		return this._btn;
	},
	loadEvent: function(){
		var _this = this;
		this.getBtn().click(function(event){
			jQuery.ajax({
				url: 'tournoi/unregister',
				type: 'POST',
				data: {
					t: $_GET('t'),
					sJeton: tournamentRegister.getSjeton().val()
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
						}else{
							console.log(obj);
						}
						popup.init('Vous avez été déinscrit de ce tournoi');
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
}
