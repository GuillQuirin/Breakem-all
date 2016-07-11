window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	// preventQuitPageEvent();
	if (dom.init()){
		createNextMatchs.init();
		selectMatchWinner.init();
		createFirstMatchs.init();
		tournamentRegister.init();
		tournamentUnregister.init();
	};
});

var dom = {
	init: function(){
		this.setDetailTournoiInfos();
		this.setEquipesLibresSection();
		this.setPremiersMatchsBtn();
		this.setMatchsWinnerBtns();
		this.setCreerProchainsMatchsBtn();
		this.setSjeton();
		this.setTget();
		if(isElSoloJqueryInstance(this.getDetailTournoiInfos()) && 
			isElSoloJqueryInstance(this.getEquipesLibresSection()) && 
			isElSoloJqueryInstance(this.getSjeton()) &&
			this.getTget().length > 10
		)
			adaptMarginToNavHeight(this.getDetailTournoiInfos());
		else {
			console.log("fail");
			return false;
		}
		this.setBtnsTeam();
		return true;
	},
	setCreerProchainsMatchsBtn: function(){
		this._prochMatchsBtn = $('#detailtournoi-btn-create-next-matchs');
	},
	setMatchsWinnerBtns: function(){
		this._mWinBtns = $('.detailtournoi-btn-match-select-winner');
	},
	setPremiersMatchsBtn: function(){
		this._premMatchsBtn = $('#detailtournoi-btn-create-matchs');
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
	setSjeton: function(){
		this._sJeton = $('#sJeton');
	},	
	setTget: function(){
		this._tGet = $_GET('t');
	},
	getDetailTournoiInfos: function(){
		return this._detailTournoiInfos;
	},
	getEquipesLibresSection: function(){
		return this._eqLibSec;
	},
	getBtnsTeam: function(){
		return this._btnsTeamJoin;
	},
	getPremiersMatchsBtn: function(){
		return (isElSoloJqueryInstance(this._premMatchsBtn)) ? this._premMatchsBtn : false;
	},
	getCreerProchainsMatchsBtn: function(){
		return (isElSoloJqueryInstance(this._prochMatchsBtn)) ? this._prochMatchsBtn : false;
	},
	getMatchsWinnerBtns: function(){
		return (this._mWinBtns.length > 1) ? this._mWinBtns : false;
	},
	getSjeton: function(){
		return this._sJeton;
	},	
	getTget: function(){
		return this._tGet;
	}
};
var tournamentRegister = {
	init: function(){
		var _this = this;
		this.setRandBtn();
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
	getChoiceBtn: function(){return this._choiceBtn;},
	getRandBtn: function(){return this._randBtn;},
	loadRandRegisterEvent: function(){
		var _this = this;
		this.getRandBtn().click(function(event){
			jQuery.ajax({
				url: 'tournoi/randRegister',
				type: 'POST',
				data: {
					t: dom.getTget(),
					sJeton: dom.getSjeton().val()
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
						t: dom.getTget(),
						ttid: _teamId,
						sJeton: dom.getSjeton().val()
					},
					complete: function(xhr, textStatus) {
						// console.log("request completed \n");
					},
					success: function(data, textStatus, xhr) {
						var obj = tryParseData(data);
						if(obj != false){
							if(obj.errors){
								popup.init(obj.errors);
								return;
							}
							if(obj.success){
								popup.init(obj.success);
								setTimeout(function(){
									location.reload();
								}, 1000);
								return;
							}
							
						}
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
		if(isElSoloJqueryInstance(this.getBtn()))
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
					t: dom.getTget(),
					sJeton: dom.getSjeton().val()
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
};
var createFirstMatchs = {
	init: function(){
		if(!dom.getPremiersMatchsBtn())
			return false;
		this.launchFirstClickEvent();
	},
	generateValidationDom: function(){
		$('.createFirstMatchContainer').each(function() {
			$(this).remove();
		});
		var container = $('<div class="animation fadeDown full-width full-height display-flex-column fixed absolute-0-0 bg-purple createFirstMatchContainer"></div>');
		var msg = $('<h3 class="titre4  text-center">Une fois les premiers matchs créés, le tournoi sera verrouillé et plus personne ne pourra s\'inscrire à moins que l\'un des participants ne se désiste. <br />Êtes-vous sûr de vouloir lancer la création des rencontres ?</h3>');
		var btnContainer = $('<div class="detailtournoi-creatematchs-btn-event-container full-width display-flex-row"></div>');
		var cancelBtn = $('<button id="detailtournoi-cancel-creationpremiersmatchs" class="relative btn btn-pink "><a>Annuler</a></button>');
		var validationBtn = $('<button id="detailtournoi-validation-creationpremiersmatchs" class="relative btn btn-pink "><a>Oui, lancer !</a></button>');

		container.append(msg);
		btnContainer.append(cancelBtn);
		btnContainer.append(validationBtn);
		container.append(btnContainer);
		$('body').append(container);

		this.launchValidationEvent(container, validationBtn, true);
		this.launchValidationEvent(container, cancelBtn, false);
	},
	launchFirstClickEvent: function(){
		var _this = this;
		dom.getPremiersMatchsBtn().click(function(e) {
			_this.generateValidationDom();
		});
	},
	launchValidationEvent: function(jQContainer, jQBtn, launch){
		var _this = this;
		jQBtn.click(function(e) {
			jQContainer.removeClass('fadeDown');
			jQContainer.addClass('fadeOutUp');
			setTimeout(function(){
				jQContainer.remove();
			}, 1000);
			// C'est donc la validation qui a été choisie
			if(launch){
				_this.sendCreationRequest();
			}
		});
	},
	sendCreationRequest: function(){
		jQuery.ajax({
			url: webpath.get()+'/detailtournoi/createFirstMatchs',
			type: 'POST',
			data: {
				t: dom.getTget(),
				sJeton: dom.getSjeton().val()
			},
			complete: function(xhr, textStatus) {
				// console.log("request completed \n");
			},
			success: function(data, textStatus, xhr) {
				// console.log(data);
				var obj = tryParseData(data);
				if(obj != false){
					if(obj.errors){
						popup.init(obj.errors);
						return;
					}
					if(obj.success){
						popup.init(obj.success);
						setTimeout(function(){
							location.reload();
						}, 1000);
						return;
					}
					
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log("request error !! : \t " + errorThrown);
			}
		});
	}
};
var selectMatchWinner = {
	init: function(){
		if(!!dom.getMatchsWinnerBtns())
			this.associateEventToBtn();
	},
	associateEventToBtn: function(){
		var _this = this;
		dom.getMatchsWinnerBtns().each(function() {
			var mId = $(this).data('m');
			var ttId = $(this).data('tt');
			$(this).removeAttr('data-m');
			$(this).removeAttr('data-tt');
			$(this).click(function(){
				_this.btnClick($(this), mId, ttId);
			});
		});
	},
	btnClick: function(jQbtn, m, tt){
		jQuery.ajax({
			url: webpath.get()+'/detailtournoi/selectWinner',
			type: 'POST',
			data: {
				t: dom.getTget(),
				sJeton: dom.getSjeton().val(),
				mId: m,
				ttId: tt
			},
			complete: function(xhr, textStatus) {
				// console.log("request completed \n");
			},
			success: function(data, textStatus, xhr) {
				var obj = tryParseData(data);
				if(obj != false){
					if(obj.errors){
						popup.init(obj.errors);
						return;
					}
					if(obj.success){
						popup.init(obj.success);
						setTimeout(function(){
							location.reload();
						}, 1000);
						return;
					}
					
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log("request error !! : \t " + errorThrown);
			}
		});
	}
};
var createNextMatchs = {
	init: function(){
		if(!!dom.getCreerProchainsMatchsBtn())
			this.associateEventToBtn();
	},
	associateEventToBtn: function(){
		var _this = this;
		dom.getCreerProchainsMatchsBtn().click(function(e) {
			_this.btnClicked();
		});
	},
	btnClicked: function(){
		jQuery.ajax({
			url: webpath.get()+'/detailtournoi/createNextMatchs',
			type: 'POST',
			data: {
				t: dom.getTget(),
				sJeton: dom.getSjeton().val()
			},
			complete: function(xhr, textStatus) {
				// console.log("request completed \n");
			},
			success: function(data, textStatus, xhr) {
				var obj = tryParseData(data);
				if(obj != false){
					if(obj.errors){
						popup.init(obj.errors);
						return;
					}
					if(obj.success){
						popup.init(obj.success);
						setTimeout(function(){
							location.reload();
						}, 1000);
						return;
					}
					
				}
			},
			error: function(xhr, textStatus, errorThrown) {
				console.log("request error !! : \t " + errorThrown);
			}
		});
	}
};