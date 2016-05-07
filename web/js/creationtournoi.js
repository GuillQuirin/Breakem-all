/*
	--->
		Il va falloir enregistrer les choix en session pour empecher les carottes
		et envoyer un gofuck aux "hackers"
	<---

	1
		Style de jeu
	2
		Jeu
	3	
		Console
	4
		Version du jeu
	5
		LINE/LAN
	6
		
*/


window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	// preventQuitPageEvent();
	if(dom.init())
		gameTypesChoice.init();
	navbar.preventShrink = true;
});
function preventQuitPageEvent(){
	window.onbeforeunload = function(){
	  return 'Are you sure you want to leave?';
	};
}
function getElementChoiceDom(titre, description, urlImg){
	var elemDOM = $('<div class="relative creationtournoi-element-choice border-full"><img class="border-regular" src="web/img/'+urlImg+'" alt="'+urlImg+'" /><h2 class="absolute title title-2 uppercase inverse-border-full">'+titre+'</h2><div class="align absolute creationtournoi-element-choice-description"><p class="inverse-border-full">'+description+'</p></div></div>');
	return elemDOM;
}
function getGameVersionChoiceDom(name, descri, maxP, maxT, maxPt){
	var elDOM = $('<div class="relative creationtournoi-element-choice creationtournoi-gameversion-choice border-full"><img class="absolute border-regular" src="web/img/footer.jpg" alt="default-bgimg" /><h2 class="absolute title title-2 uppercase inverse-border-full">'+name+'</h2><ul><li>joueurs maximum: '+maxP+'</li><li>équipes maximum: '+maxT+'</li><li>joueurs par équipe maximum: '+maxPt+'</li></ul><div class="align absolute creationtournoi-element-choice-description"><p class="inverse-border-full">'+descri+'</p></div></div>');
	return elDOM;
}
function loadElementsChoice(arrayJqDOM){
	var container = dom.getContainer();
	container.empty();
	for (var i = 0; i < arrayJqDOM.length; i++) {
		container.append(arrayJqDOM[i]);
	};
}
function loadTitle(titre){
	var _title = dom.getTitleContainer();
	_title.empty();
	_title.append('<h1 class="title">Choisis '+titre+'</span></h1>');
}
function loadBtn(string){
	var btn = dom.getBtn();
	btn.empty();
	btn.append('<a class="uppercase">'+string+'</a>');
}


var dom = {
	init: function(){
		this.setTitleContainer();
		this.setContainer();
		this.setBtn();
		if(!(this.getTitleContainer() instanceof jQuery)
			|| !(this.getContainer() instanceof jQuery)
			|| !(this.getBtn() instanceof jQuery)){
			console.log("Title || Container || Btn not found ");
			return false;
		}
		// this.setTitleContainerMargin();
		// this.setBtnMargin();
		return true;
	},
	setTitleContainer: function(){
		this._title = jQuery(".creationtournoi-title-container");
	},
	setContainer: function(){
		this._elementsContainer = jQuery(".creationtournoi-element-container");
	},
	setBtn: function(){
		this._btn = jQuery("#creationtournoi-valider");
	},
	setTitleContainerMargin: function(){
		var navHeight = jQuery("#navbar").height();
		this.getTitleContainer().css('margin-top', navHeight);
		this.getTitleContainer().css('margin-bottom', navHeight/2);
	},
	setBtnMargin: function(){
		var navHeight = jQuery("#navbar").height();
		this.getBtn().css('margin-top', navHeight/2);
		this.getBtn().css('margin-bottom', navHeight/2);
	},
	getTitleContainer: function(){return this._title;},
	getContainer: function(){return this._elementsContainer;},
	getBtn: function(){return this._btn;}
};
var gameTypesChoice = {
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	init: function(){
		/*Tous les chargements d'event et autres fonctions de feront dans le success callback retour de ajax*/
		this.getGameTypes();
	},
	getChoice: function(){return this._choice;},
	getChoiceDat: function(){return this._choiceDat;},
	getPossibleChoices: function(){return this.possibleChoices;},
	getGameTypes: function(){
		var _this = this;
		jQuery.ajax({
		  url: 'creationtournoi/getGameTypes',
		  type: 'POST',
		  // data: {param1: 'value1'},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    var obj = tryParseData(data);
		    if(!!obj){
		    	// On récupère tous les choix, les transforme en DOM et l'ajoute à l'array
		    	// On associe les events de choix à chaque élément de l'array
			    for(var prop in obj.types){
			    	var jQDomElem = getElementChoiceDom(obj.types[prop].name, obj.types[prop].description, obj.types[prop].img);
			    	_this.possibleChoices.push(jQDomElem);
			    	_this.associateChoiceEvent(jQDomElem, obj.types[prop].name);
			    }
			    if(_this.getPossibleChoices().length == 0)
			    	return false;
			    loadElementsChoice(_this.possibleChoices);
			    _this.loadValidationEvent();
			    loadTitle("ton style de jeu");
			    loadBtn("suivant");
		    }else{
		    	console.log("Création du DOM gametype impossible");
		    }		    
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
	},
	associateChoiceEvent: function(jQel, da){
		var _this = this;
		jQel.click(function(e) {
			_this.setChoice(jQel, da);
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da){
		this._choice = jQChoice;
		this._choiceDat = da;
		var allChoices = this.getPossibleChoices();
		for (var i = 0; i < allChoices.length; i++) {
			allChoices[i].removeClass('box-bg-shadow');
			allChoices[i].removeClass('bg-black');
			allChoices[i].removeClass('creationtournoi-active-choice');
			allChoices[i].removeClass('scale-10-percent');
			allChoices[i].find('h2').addClass('inverse-border-full');
			allChoices[i].find('p').addClass('inverse-border-full');
		};
		jQChoice.addClass('box-bg-shadow');
		jQChoice.addClass('scale-10-percent');
		jQChoice.addClass('bg-black');
		jQChoice.addClass('creationtournoi-active-choice');
		jQChoice.find('h2').removeClass('inverse-border-full');
		jQChoice.find('p').removeClass('inverse-border-full');
	},
	loadValidationEvent: function(){
		var _this = this;
		var _btn = dom.getBtn();
		_btn.off();
		_btn.click(function(event) {
			if (!!_this.getChoice() && !!_this.getChoiceDat()){
				gameChoice.init(_this.getChoiceDat());
			};
		});
	}
};
var gameChoice = {
	init: function(da){
		this.getGames(da);
	},
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	getChoice: function(){return this._choice;},
	getChoiceDat: function(){return this._choiceDat;},
	getPossibleChoices: function(){return this.possibleChoices;},
	getGames: function(da){
		var _this = this;
		jQuery.ajax({
		  url: 'creationtournoi/getGames',
		  type: 'POST',
		  data: {'name': da},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    var obj = tryParseData(data);
		    if(!!obj){
			    for(var prop in obj.games){
			    	var jQDomElem = getElementChoiceDom(obj.games[prop].name, obj.games[prop].description, obj.games[prop].img);
			    	_this.possibleChoices.push(jQDomElem);
			    	_this.associateChoiceEvent(jQDomElem, obj.games[prop].name);
			    }
			    if(_this.getPossibleChoices().length == 0)
			    	return false;
			    loadElementsChoice(_this.possibleChoices);
			    _this.loadValidationEvent();
			    loadTitle("ton jeu");
			    loadBtn("suivant");
		    }else{
		    	console.log("Création du DOM gametype impossible");
		    }		    
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
	},
	associateChoiceEvent: function(jQel, da){
		var _this = this;
		jQel.click(function(e) {
			_this.setChoice(jQel, da);
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da){
		this._choice = jQChoice;
		this._choiceDat = da;
		var allChoices = this.getPossibleChoices();
		for (var i = 0; i < allChoices.length; i++) {
			allChoices[i].removeClass('box-bg-shadow');
			allChoices[i].removeClass('bg-black');
			allChoices[i].removeClass('creationtournoi-active-choice');
			allChoices[i].removeClass('scale-10-percent');
			allChoices[i].find('h2').addClass('inverse-border-full');
			allChoices[i].find('p').addClass('inverse-border-full');
		};
		jQChoice.addClass('box-bg-shadow');
		jQChoice.addClass('scale-10-percent');
		jQChoice.addClass('bg-black');
		jQChoice.addClass('creationtournoi-active-choice');
		jQChoice.find('h2').removeClass('inverse-border-full');
		jQChoice.find('p').removeClass('inverse-border-full');
	},
	loadValidationEvent: function(){
		var _this = this;
		var _btn = dom.getBtn();
		_btn.off();
		_btn.click(function(event) {
			if (!!_this.getChoice() && !!_this.getChoiceDat()){
				consoleChoice.init(_this.getChoiceDat());
			};
		});
	}
};
var consoleChoice = {
	init: function(da){
		this.getConsoles(da);
	},
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	getChoice: function(){return this._choice;},
	getChoiceDat: function(){return this._choiceDat;},
	getPossibleChoices: function(){return this.possibleChoices;},
	getConsoles: function(da){
		var _this = this;
		jQuery.ajax({
		  url: 'creationtournoi/getConsoles',
		  type: 'POST',
		  data: {'name': da},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    var obj = tryParseData(data);
		    if(!!obj){
		    	// console.log(obj);
			    for(var prop in obj.platforms){
			    	var jQDomElem = getElementChoiceDom(obj.platforms[prop].name, obj.platforms[prop].description, obj.platforms[prop].img);
			    	_this.possibleChoices.push(jQDomElem);
			    	_this.associateChoiceEvent(jQDomElem, obj.platforms[prop].name);
			    	// console.log(obj.platforms[prop]);
			    }
			    if(_this.getPossibleChoices().length == 0)
			    	return false;
			    loadElementsChoice(_this.possibleChoices);
			    _this.loadValidationEvent();
			    loadTitle("ta console");
			    loadBtn("suivant");
		    }else{
		    	console.log("Création du DOM consoles impossible");
		    }		    
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
	},
	associateChoiceEvent: function(jQel, da){
		var _this = this;
		jQel.click(function(e) {
			_this.setChoice(jQel, da);
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da){
		this._choice = jQChoice;
		this._choiceDat = da;
		var allChoices = this.getPossibleChoices();
		for (var i = 0; i < allChoices.length; i++) {
			allChoices[i].removeClass('box-bg-shadow');
			allChoices[i].removeClass('bg-black');
			allChoices[i].removeClass('creationtournoi-active-choice');
			allChoices[i].removeClass('scale-10-percent');
			allChoices[i].find('h2').addClass('inverse-border-full');
			allChoices[i].find('p').addClass('inverse-border-full');
		};
		jQChoice.addClass('box-bg-shadow');
		jQChoice.addClass('scale-10-percent');
		jQChoice.addClass('bg-black');
		jQChoice.addClass('creationtournoi-active-choice');
		jQChoice.find('h2').removeClass('inverse-border-full');
		jQChoice.find('p').removeClass('inverse-border-full');
	},
	loadValidationEvent: function(){
		var _this = this;
		var _btn = dom.getBtn();
		_btn.off();
		_btn.click(function(event) {
			if (!!_this.getChoice() && !!_this.getChoiceDat()){
				gameversionChoice.init(_this.getChoiceDat());
			};
		});
	}
};
var gameversionChoice = {
	init: function(da){
		this.getVersions(da);
	},
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	getChoice: function(){return this._choice;},
	getChoiceDat: function(){return this._choiceDat;},
	getPossibleChoices: function(){return this.possibleChoices;},
	getVersions: function(da){
		var _this = this;
		jQuery.ajax({
		  url: 'creationtournoi/getVersions',
		  type: 'POST',
		  data: {'name': da},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    var obj = tryParseData(data);
		    if(!!obj){
			    for(var prop in obj.versions){
			    	var jQDomElem = getGameVersionChoiceDom(obj.versions[prop].name, obj.versions[prop].description, obj.versions[prop].maxPlayer, obj.versions[prop].maxTeam, obj.versions[prop].maxPlayerPerTeam);
			    	_this.possibleChoices.push(jQDomElem);
			    	_this.associateChoiceEvent(jQDomElem, obj.versions[prop].name);
			    }
			    if(_this.getPossibleChoices().length == 0)
			    	return false;
			    loadElementsChoice(_this.possibleChoices);
			    _this.loadValidationEvent();
			    loadTitle("ton mode de jeu");
			    loadBtn("suivant");
		    }else{
		    	console.log("Création du DOM consoles impossible");
		    }		    
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
	},
	associateChoiceEvent: function(jQel, da){
		var _this = this;
		jQel.click(function(e) {
			_this.setChoice(jQel, da);
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da){
		this._choice = jQChoice;
		this._choiceDat = da;
		var allChoices = this.getPossibleChoices();
		for (var i = 0; i < allChoices.length; i++) {
			allChoices[i].removeClass('box-bg-shadow');
			allChoices[i].removeClass('bg-black');
			allChoices[i].removeClass('creationtournoi-active-choice');
			allChoices[i].removeClass('scale-10-percent');
			allChoices[i].find('h2').addClass('inverse-border-full');
			allChoices[i].find('p').addClass('inverse-border-full');
		};
		jQChoice.addClass('box-bg-shadow');
		jQChoice.addClass('scale-10-percent');
		jQChoice.addClass('bg-black');
		jQChoice.addClass('creationtournoi-active-choice');
		jQChoice.find('h2').removeClass('inverse-border-full');
		jQChoice.find('p').removeClass('inverse-border-full');
	},
	loadValidationEvent: function(){
		var _this = this;
		var _btn = dom.getBtn();
		_btn.off();
		_btn.click(function(event) {
			if (!!_this.getChoice() && !!_this.getChoiceDat()){
				// gameversionChoice.init(_this.getChoiceDat());
			};
		});
	}
};