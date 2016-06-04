window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	
	if(dom.init())
		gameTypesChoice.init();
	// navbar.preventShrink = true;
});
function preventQuitPageEvent(){
	window.onbeforeunload = function(){
	  return 'Are you sure you want to leave?';
	};
}
function getElementChoiceDom(titre, description, urlImg){
	var elemDOM = $('<div class="relative creationtournoi-element-choice border-full"><img class="border-regular" src="'+urlImg+'" alt="'+urlImg+'" /><h2 class="absolute title title-2 uppercase inverse-border-full">'+titre+'</h2><div class="align absolute creationtournoi-element-choice-description"><p class="inverse-border-full">'+description+'</p></div></div>');
	return elemDOM;
}
function getGameVersionChoiceDom(name, descri, maxP, minP, maxT, maxPt){
	var elDOM = $('<div class="relative creationtournoi-element-choice creationtournoi-gameversion-choice border-full"><img class="absolute border-regular" src="web/img/footer.jpg" alt="default-bgimg" /><h2 class="absolute title title-2 uppercase inverse-border-full">'+name+'</h2><ul><li>joueurs maximum: '+maxP+'</li><li>joueurs minimum: '+minP+'</li><li>équipes maximum: '+maxT+'</li><li>joueurs par équipe maximum: '+maxPt+'</li></ul><div class="align absolute creationtournoi-element-choice-description"><p class="inverse-border-full">'+descri+'</p></div></div>');
	return elDOM;
}
function loadElementsChoice(arrayJqDOM){
	var container = dom.getContainer();
	container.empty();
	if (typeof arrayJqDOM == "undefined")
		return;
	for (var i = 0; i < arrayJqDOM.length; i++) {
		container.append(arrayJqDOM[i]);
	};
}
function loadTitle(titre, entete){
	var ent = (typeof entete == "undefined") ? 'Choisis ' : '';
	var _title = dom.getTitleContainer();
	_title.empty();
	_title.append('<h1 class="title">'+ent+titre+'</span></h1>');
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
		this.setTreeSection();
		if(!(this.getTitleContainer() instanceof jQuery)
			|| !(this.getContainer() instanceof jQuery)
			|| !(this.getTreeSection() instanceof jQuery)
			|| (this.getTitleContainer().length > 1 )
			|| (this.getContainer().length > 1 )
			|| (this.getTreeSection().length > 1 )
			|| !(this.getBtn() instanceof jQuery)){
			console.log("Title || Container || Btn || Tree-section not found ");
			return false;
		}
		//this.setTitleContainerMargin();
		this.setBtnMargin();
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
	setTreeSection: function(){
		this._treeSec = $('.creationtournoi-tree-section');
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
	getBtn: function(){return this._btn;},
	getTreeSection: function(){return this._treeSec;}
};
var gameTypesChoice = {
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	init: function(){
		/*Tous les chargements d'event et autres fonctions se feront dans le success callback retour de ajax*/
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
		    	if(obj.errors){
		    		for(var prop in obj.errors){
		    			alert(obj.errors[prop]);
		    		}
		    		return false;
		    	}
		    	// On récupère tous les choix, les transforme en DOM et l'ajoute à l'array
		    	// On associe les events de choix à chaque élément de l'array
			    for(var prop in obj.types){
			    	var jQDomElem = getElementChoiceDom(obj.types[prop].name, obj.types[prop].description, obj.types[prop].img);
			    	_this.possibleChoices.push(jQDomElem);
			    	_this.associateChoiceEvent(jQDomElem, obj.types[prop].name);
			    	tree.setGameTypeChoices(_this.getPossibleChoices());
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
		    	if(obj.errors){
		    		for(var prop in obj.errors){
		    			alert(obj.errors[prop]);
		    		}
		    		return false;
		    	}
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
		    	if(obj.errors){
		    		for(var prop in obj.errors){
		    			alert(obj.errors[prop]);
		    		}
		    		return false;
		    	}
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
	_currentForm: false,
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
		    	if(obj.errors){
		    		for(var prop in obj.errors){
		    			alert(obj.errors[prop]);
		    		}
		    		return false;
		    	}
			    for(var prop in obj.versions){
			    	var jQDomElem = getGameVersionChoiceDom(obj.versions[prop].name, obj.versions[prop].description, obj.versions[prop].maxPlayer, obj.versions[prop].minPlayer, obj.versions[prop].maxTeam, obj.versions[prop].maxPlayerPerTeam);
			    	_this.possibleChoices.push(jQDomElem);
			    	_this.associateChoiceEvent(jQDomElem, obj.versions[prop]);
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
	putAccordingForm: function(){
		var _this = this;
		var selectedJson = this.getChoiceDat();
		var selectedName = selectedJson.name;
		var selectedMinP = selectedJson.minPlayer;
		var selectedMaxP = selectedJson.maxPlayer;
		var selectedMinT = selectedJson.minTeam;
		var selectedMaxT = selectedJson.maxTeam;
		var selectedMaxPPT = selectedJson.maxPlayerPerTeam;
		// différencier les match en équipe de ceux en solo
		//  Si équipe --> choix du random, et choix de guilde imposée ou pas 
		// 	Si solo --> forcément random
		if(this._currentForm instanceof jQuery)
			this._currentForm.remove();
		var container = $('<div class="creationtournoi-gameversion-container-form"><h2 class="title title-1 uppercase">'+selectedName+'</h2><h3 class="title title-2 capitalize">'+gameChoice.getChoiceDat()+' - <span style="margin-left: 5px;" class="uppercase">'+ consoleChoice.getChoiceDat()+'</span></h3><div class="creationtournoi-separator"></div><p class="title title-4 capitalize">Joueurs: '+selectedMinP+' - '+selectedMaxP+'</p><p class="title title-4 capitalize">Equipes: '+selectedMinT+' - '+selectedMaxT+'</p><p class="title title-4">'+selectedMaxPPT+' par équipe max</p><div>');
		if(parseInt(selectedMaxPPT) == 1)
			container.append('<p class="creationtournoi-random-match title title-4">Rencontres aléatoires</p>');
		var form = $('<form><h4 class="title title-4 capitalize">ton tournoi</h4><div class="form-input-group"><label for="name">Nomme le (Requis)</label><input class="border-full" type="text" name="name" maxlength="50" minlength="8" required><p class="creationtournoi-tip">Lettres, chiffres et espaces only !</p></div><div class="form-input-group"><label for="startDate">Donne la date de son début (Requis)</label><input class="border-full" type="text" pattern="\d{1,2}/\d{1,2}/\d{4}" class="datepicker" name="startDate" required/><p class="creationtournoi-tip">jj/mm/aaaa</p></div><div class="form-input-group"><label for="endDate">Donne la date de sa fin (Requis)</label><input class="border-full" type="text" pattern="\d{1,2}/\d{1,2}/\d{4}" class="datepicker" name="endDate" required/><p class="creationtournoi-tip">jj/mm/aaaa</p></div></form>');
		// on est dans le cas équipe
		if (parseInt(selectedJson.maxPlayerPerTeam) > 1){
			var randomAndGuildInputs = $('<div class="form-input-group"><label for="randomPlayerMix">Activer l\'affectation d\'équipe aléatoire</label><input class="border-full" type="checkbox" name="randomPlayerMix"></div><div class="form-input-group"><label for="guildOnly">Pour guildeux only ?</label><input class="border-full" type="checkbox" name="guildOnly"></div>');
			form.append(randomAndGuildInputs);
			_this.randomAndGuildInputEvent(randomAndGuildInputs);
		}
		form.append('<div class="form-input-group"><label for="description">Une ch\'tite description ?</label><textarea class="border-full" name="description" maxlength="200" minlength="10"></textarea></div>');
		container.append(form);
		dom.getContainer().after(container);
		$('html, body').animate({
			scrollTop: (container.find('h2').offset().top/2) - (jQuery("#navbar").height()/2)
		}, 500);
		container.find('input[name="name"]').focus();
		this._currentForm = container;
	},
	associateChoiceEvent: function(jQel, objDa){
		var _this = this;
		jQel.click(function(e) {
			if(_this.getChoiceDat() === objDa){
				_this.resetChoice();
			}else{
				_this.setChoice(jQel, objDa);
				_this.putAccordingForm();
			}
			
		});
	},
	resetChoice: function(){
		var _this = this;
		var allChoices = this.getPossibleChoices();
		for (var i = 0; i < allChoices.length; i++) {
			allChoices[i].removeClass('box-bg-shadow');
			allChoices[i].removeClass('bg-black');
			allChoices[i].removeClass('creationtournoi-active-choice');
			allChoices[i].removeClass('scale-10-percent');
			allChoices[i].find('h2').addClass('inverse-border-full');
			allChoices[i].find('p').addClass('inverse-border-full');
		};
		_this._choice = false;
		_this._choiceDat = false;
		this._currentForm.remove();
		this._currentForm = false;
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, objDa){
		this._choice = jQChoice;
		this._choiceDat = objDa;
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
	isNameValid: function(jQel){
		var unauthorizedChars = /[^a-z0-9 éàôûîêçùèâ]/i;
		if(jQel.val().match(unauthorizedChars) 
			|| jQel.val().length < 8
			|| jQel.val().length > 50){
			register.highlightInput(jQel);
			alert("name fail");
			return false;
		}
		return true;
	},
	isDateFormatValid: function(jQel){
		var unauthorizedChars = /[^\d{2}\/\d{2}\/\d{4}]/;
		if(jQel.val().match(unauthorizedChars)){
			alert("date fail !");
			jQel[0].value = "";
			jQel.focus();
			return false;
		};
		return true;
		/*var day = parseInt(jQel.val().substring(0, 2));
		var month = parseInt(jQel.val().substring(3, 5)) - 1;
		var year = parseInt(jQel.val().substring(6));
		var d = new Date(year, month, day);
		var receivedTime = d.getTime();
		console.log("1: "+ receivedTime);


		var today = new Date();
		var curD = today.getDate();
		var curM = today.getMonth();
		var curY = today.getFullYear();
		var firstHourToday = new Date(curY, curM, curD);


		var baseTime = firstHourToday.getTime();
		console.log("2: "+ baseTime);
		console.log("3: "+today.getTime());
		// S'il est midi passé ou si le mec essaye de creer un tournoi ds le passé
		if (receivedTime - baseTime < 0){
			alert("Date d'aujourd'hui minimum");
			jQel[0].value = "";
			jQel.focus();
			return false
		};
		if (today.getTime() == baseTime && today.getHours() > 12){
			alert("Il n'est plus possible de créer de tournoi pour le jour même passé 13h!");
			jQel[0].value = "";
			jQel.focus();
			return false
		};
		if (receivedTime - baseTime > 2678400){
			alert("Le tournoi doit débuter avant un mois");
			jQel[0].value = "";
			jQel.focus();
			return false
		}
		return receivedTime;*/
	},
	isStringValid: function(jQel){
		if(jQel.val().replace(/ /g, '').length==0){
			jQel[0].value = "";
			return true;
		}
		var unauthorizedChars = /[^a-zA-Z-0-9 ,\.=\!éàôûîêçùèâ@\(\)\?]/;
		if(jQel.val().match(unauthorizedChars)
			|| jQel.val().length < 10 
			|| jQel.val().length > 200){
			register.highlightInput(jQel);
			alert("description fail");
			return false;
		}
		return true;
	},
	isGuildAndRandValid: function(randP, guild){
		var randPVal = randP[0].checked;
		var guildVal = guild[0].checked;
		if(guildVal && randPVal){
			alert("Les tournois entre guilde ne peuvent se faire avec des equipes aleatoires");
			return false;
		}
			
		return true;
	},
	checkForm: function(){
		var form = this._currentForm;
		// Checks communs à equipe et solo 
		if(!form)
			return false;

		var _name = form.find('input[name="name"]');
		if(_name.length != 1 || !this.isNameValid(_name))
			return false;

		var _startDate = form.find('input[name="startDate"]');
		if(_startDate.length != 1 || !this.isDateFormatValid(_startDate))
			return false;

		var _endDate = form.find('input[name="endDate"]');
		if(_endDate.length != 1 || !this.isDateFormatValid(_endDate))
			return false;

		/*	// S'il y a moins d'un jour entre le debut et la fin du tournoi
		if(_endDate - _startDate < 86400){
			alert("Le tounoi doit se finir après au moins un jour");
			return false;
		};*/

		var _description = form.find('textarea[name="description"]');
		if(_description.val().length > 0 && !this.isStringValid(_description))
			return false;


		// Check typiquement equipe
		var joueursParEquipe = this.getChoiceDat().maxPlayerPerTeam;
		if (joueursParEquipe > 1){
			var randomP = form.find('input[name="randomPlayerMix"]');
			var guild = form.find('input[name="guildOnly"]');
			if(randomP.length != 1)
				return false
			if(guild.length != 1 || !this.isGuildAndRandValid(randomP, guild))
				return false
		};
		return true;
	},
	randomAndGuildInputEvent: function(jQelContainer){
		var _this = this;
		var randomP = jQelContainer.find('input[name="randomPlayerMix"]');
		var guild = jQelContainer.find('input[name="guildOnly"]');
		guild.click(function() {
			if(guild.val() == true)
				randomP[0].checked = false;
		});
	},
	loadValidationEvent: function(){
		var _this = this;
		var _btn = dom.getBtn();
		_btn.off();
		_btn.click(function(event) {
			if (!!_this.getChoice() && !!_this.getChoiceDat() && _this.checkForm()){
				var form = _this._currentForm;
				var toSend = {};
				toSend.name = form.find('input[name="name"]').val();		
				toSend.startDate = form.find('input[name="startDate"]').val();
				toSend.endDate = form.find('input[name="endDate"]').val();
				toSend.description = form.find('textarea[name="description"]').val();
				var joueursParEquipe = _this.getChoiceDat().maxPlayerPerTeam;
				if (joueursParEquipe > 1){
					toSend.randomPlayerMix = form.find('input[name="randomPlayerMix"]')[0].checked;
					toSend.guildOnly = form.find('input[name="guildOnly"]')[0].checked;
				}else{
					toSend.randomPlayerMix = true;
					toSend.guildOnly = false;
				}
				toSend.gversionName = _this.getChoiceDat().name;
				toSend.gversionDescription = _this.getChoiceDat().description;
				toSend.gversionMaxPlayer = _this.getChoiceDat().maxPlayer;
				toSend.gversionMinPlayer = _this.getChoiceDat().minPlayer;
				toSend.gversionMaxTeam = _this.getChoiceDat().maxTeam;
				toSend.gversionMinTeam = _this.getChoiceDat().minTeam;
				toSend.gversionMaxPlayerPerTeam = _this.getChoiceDat().maxPlayerPerTeam;
				toSend.gversionMinPlayerPerTeam = _this.getChoiceDat().minPlayerPerTeam;
				jQuery.ajax({
					url: 'creationtournoi/getFinalStep',
					type: 'POST',
					data: toSend,
					complete: function(xhr, textStatus) {
						//called when complete
					},
					success: function(data, textStatus, xhr) {
						var obj = tryParseData(data);
						if(!!obj){
							if(obj.errors){
					    		for(var prop in obj.errors){
					    			alert(obj.errors[prop]);
					    		}
					    		return false;
					    	}
							validateChoices.init(obj, _this._currentForm);
						}
					},
					error: function(xhr, textStatus, errorThrown) {
						console.log("request error !! : \t " + errorThrown);
					}
				});
				
			};
		});
	}
};
var validateChoices = {
	init: function(data, formToDel){
		formToDel.remove();
		$('html, body').animate({
			scrollTop: 0
		}, 500);
		loadElementsChoice();
		loadTitle('Valide tes choix', '');
		loadBtn('Créer');
		this.generateSumUp(data);
		this.loadValidationEvent();
	},
	generateSumUp: function(data){
		var container = $('<div class="creationtournoi-tournoi-valid-creation display-flex-column"></div>');
		var tournamentName = $('<h3 class="creationtournoi-valid-tournoi-name title-2">Nom du tournoi : <span class="data uppercase">'+data.name+'</span></h3>');
		container.append(tournamentName);
		if(data.description.length > 0){
			var tournamentDesc = $('<p class="creationtournoi-valid-tournoi-descr">'+data.description+'</p>');
			container.append(tournamentDesc);
		};

		var mainList = $('<ul class="relative creationtournoi-valid-tournoi-list"></ul>');
		var gameName = $('<li class="relative title-4 creationtournoi-valid-tournoi-gamename"><span>Jeu :</span><span class="uppercase absolute data">'+data.jeu+'</span></li>');
		mainList.append(gameName);
		// Si c'est un tournoi par équipe.
		if (data.maxPlayerPerTeam > 1){
			// Savoir si l'interGuilde a été choisi
			var gameTypeTitle = '<span>Mode de jeu :</span><span class="uppercase absolute data">'+data.versionName;
			if(data.guildTeams == true){
				gameTypeTitle+=" - Inter-guildes";
			}
			// Si l'option équipes random a été activée
			else if(data.randTeams == true){
				gameTypeTitle+=" - Aléatoires";
			}
			// On est dans le cas jeu ouvert et équipes libres
			else{
				gameTypeTitle+=" - Avec choix d'équipe";
			}
			var gameTypeTitle = $('<li class="relative title-4 creationtournoi-valid-tournoi-gameversion-name">'+gameTypeTitle+'</span></li>');
			mainList.append(gameTypeTitle);
		}else{
			var gameTypeTitle = $('<li class="relative title-4 creationtournoi-valid-tournoi-gameversion-name"><span>Mode de jeu :</span><span class="uppercase absolute data">'+data.versionName+'</span></li>');
			mainList.append(gameTypeTitle);
		};
		var platformName = $('<li class="relative title-4 creationtournoi-valid-tournoi-platformname"><span>Console :</span><span class="uppercase absolute data">'+data.console+'</span></li>');
		mainList.append(platformName);

		var maxPlayers = $('<li class="relative title-4 creationtournoi-valid-tournoi-maxPlayers"><span>Joueurs maximum :</span><span class="uppercase absolute data">'+data.maxPlayer+'</span></li>');
		mainList.append(maxPlayers);

		var minPlayers = $('<li class="relative title-4 creationtournoi-valid-tournoi-minPlayers"><span>Joueurs minimum :</span><span class="uppercase absolute data">'+data.minPlayer+'</span></li>');
		mainList.append(minPlayers);

		if(data.maxPlayerPerTeam > 1){
			var minTeams = $('<li class="relative title-4 creationtournoi-valid-tournoi-minT"><span>Limite minimum d\'équipes :</span><span class="uppercase absolute data">'+data.minTeam+'</span></li>');
			mainList.append(minTeams);

			var maxTeams = $('<li class="relative title-4 creationtournoi-valid-tournoi-maxT"><span>Limite maximum d\'équipes :</span><span class="uppercase absolute data">'+data.maxTeam+'</span></li>');
			mainList.append(maxTeams);

			var maxPlayersPerTeam = $('<li class="relative title-4 creationtournoi-valid-tournoi-maxPPT"><span>Limite minimum de joueurs par équipes :</span><span class="uppercase absolute data">'+data.maxPlayerPerTeam+'</span></li>');
			mainList.append(maxPlayersPerTeam);
		};


		var startingDate = $('<li class="relative title-4 creationtournoi-valid-tournoi-startDate"><span>Date de début :</span><span class="uppercase absolute data">'+data.dateDebut+'</span></li>');
		mainList.append(startingDate);

		var finishDate = $('<li class="relative title-4 creationtournoi-valid-tournoi-endDate"><span>Date de fin :</span><span class="uppercase absolute data">'+data.dateFin+'</span></li>');
		mainList.append(finishDate);

		container.append(mainList);
		dom.getContainer().after(container);
	},
	loadValidationEvent: function(){
		var _this = this;
		var _btn = dom.getBtn();
		_btn.off();
		_btn.click(function(event) {			
			jQuery.ajax({
				url: 'creationtournoi/finalValidation',
				type: 'POST',
				complete: function(xhr, textStatus) {
					//called when complete
				},
				success: function(data, textStatus, xhr) {
					var obj = tryParseData(data);
					if(!!obj){
						if(obj.errors){
				    		for(var prop in obj.errors){
				    			alert(obj.errors[prop]);
				    		}
				    		return false;
				    	}
				    	else if(obj.success){
				    		window.location.assign(obj.success);
				    	}		
					}
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log("request error !! : \t " + errorThrown);
				}
			});				
		});	
	}
};
var tree = {
	init: function(){
		
	},
	changeDom: function(){

	},
	setGameTypeChoices: function(arr){
		this._gtChoices = arr;
		if(this._gtChoices.length > 1){
			// preventQuitPageEvent();
		}
	},
	getGameTypeChoices: function(){return this._gtChoices;}
};