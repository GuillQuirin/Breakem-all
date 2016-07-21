"use strict";

function getDateFromInt(timestamp){
	if(typeof timestamp == 'undefined')
		return false;

	var months = ['janvier','février','mars','avril','mai','juin','juillet','août','septembre','obtobre','novembre','décembre'];
	var d1 = new Date(parseInt(timestamp) * 1000);
	var year = d1.getFullYear();
	var month = months[d1.getMonth()];
	var day = d1.getDate();

	return day + ' ' + month + ' ' + year;
}
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
function loadMainElementsChoice(arrayJqDOM){
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
function resetTreeEl(jQelTree){
	jQelTree.find('.creationtournoi-tree-el-choices-container').empty();
}
// Cette fonction ajoute la tous les choix disponibles dans un element du tree et renvoie tous ces choix ds un array contenant chaque objet et sa dom associée
function getCreatedTreeSubEl(jQelTree, obj){
	if(typeof jQelTree == 'undefined' || typeof obj == 'undefined'
		|| !(jQelTree instanceof jQuery)
		|| typeof obj.name == 'undefined'
		)
		return false;
	var curdom = $('<div class="full-width tree-el-choice"><p class="m-a text-center">'+obj.name+'</p></div>');
	jQelTree.find('.creationtournoi-tree-el-choices-container').append(curdom);
	return curdom;
}
// Change le titre d'un élément reçu du tree
function loadTreeElTitle(jQelTree, choiceName){
	if(typeof jQelTree == 'undefined'
		|| !(jQelTree instanceof jQuery)
		)
		return false;
	var title = jQelTree.find('.creationtournoi-tree-el-title');
	if(!(title instanceof jQuery)
		|| title.length == 0
		)
		return false;
	title.text(choiceName);
}
// Ajoute une classe css à l'élément du tree souhaité pour bien repérer à quelle étape de la création le client se trouve
function highlightTreeStep(jQelTree){
	for (var i = dom.getAllTreeEls().length - 1; i >= 0; i--) {
		dom.getAllTreeEls()[i].removeClass('active-step');
	}
	jQelTree.addClass('active-step');
}

var dom = {
	_treeEls: [],
	init: function(){
		dom.setTitleContainer();
		dom.setContainer();
		dom.setBtn();
		dom.setTreeSection();
		dom.setTreeGameType();
		dom.setTreeGame();
		dom.setTreePlatform();
		dom.setTreeRules();
		dom.setTreeConfirm();
		if(!(dom.getTitleContainer() instanceof jQuery)
			|| !(dom.getContainer() instanceof jQuery)
			|| !(dom.getTreeSection() instanceof jQuery)
			|| !(dom.getTreeGameType() instanceof jQuery)
			|| !(dom.getTreeGame() instanceof jQuery)
			|| !(dom.getTreePlatform() instanceof jQuery)
			|| !(dom.getTreeRules() instanceof jQuery)
			|| !(dom.getTreeConfirm() instanceof jQuery)
			|| (dom.getTitleContainer().length > 1 )
			|| (dom.getContainer().length > 1 )
			|| (dom.getTreeSection().length > 1 )
			|| (dom.getTreeGameType().length > 1 )
			|| (dom.getTreeGame().length > 1 )
			|| (dom.getTreePlatform().length > 1 )
			|| (dom.getTreeRules().length > 1 )
			|| (dom.getTreeConfirm().length > 1 )
			|| !(dom.getBtn() instanceof jQuery)){
			popup.init("Titre, container, bouton ou section introuvables !");
			return false;
		}
		//dom.setTitleContainerMargin();
		dom.setBtnMargin();
		dom._treeEls.push(dom.getTreeGameType());
		dom._treeEls.push(dom.getTreeGame());
		dom._treeEls.push(dom.getTreePlatform());
		dom._treeEls.push(dom.getTreeRules());
		dom._treeEls.push(dom.getTreeConfirm());
		// Sert à savoir plus tard dans le JS si l'user a bien une guilde
		dom.setUserHasGuild();
		gameTypesChoice.init();
		return true;
	},
	setTitleContainer: function(){
		dom._title = jQuery(".creationtournoi-title-container");
	},
	setContainer: function(){
		dom._elementsContainer = jQuery(".creationtournoi-element-container");
	},
	setBtn: function(){
		dom._btn = jQuery("#creationtournoi-valider");
	},
	setTreeSection: function(){
		dom._treeSec = $('.creationtournoi-tree-section');
	},
	setTreeGameType: function(){
		dom._treeGt = $('#creationtournoi-tree-gametype');
	},
	setTreeGame: function(){
		dom._treeG = $('#creationtournoi-tree-game');
	},
	setTreePlatform: function(){
		dom._treeP = $('#creationtournoi-tree-platform');
	},
	setTreeRules: function(){
		dom._treeR = $('#creationtournoi-tree-rules');
	},
	setTreeConfirm: function(){
		dom._treeC = $('#creationtournoi-tree-confirm');
	},
	setTitleContainerMargin: function(){
		var navHeight = jQuery("#navbar").height();
		dom.getTitleContainer().css('margin-top', navHeight);
		dom.getTitleContainer().css('margin-bottom', navHeight/2);
	},
	setBtnMargin: function(){
		var navHeight = jQuery("#navbar").height();
		dom.getBtn().css('margin-top', navHeight/2);
		dom.getBtn().css('margin-bottom', navHeight/2);
	},
	setUserHasGuild: function(){
		var hInp = jQuery('#creationtournoi-userHasGuild');
		if(hInp instanceof jQuery && hInp.length == 1)
			dom._uhg = true;
		else
			dom._uhg = false;
	},
	getTitleContainer: function(){return dom._title;},
	getContainer: function(){return dom._elementsContainer;},
	getBtn: function(){return dom._btn;},
	getTreeSection: function(){return dom._treeSec;},
	getTreeGameType: function(){return dom._treeGt;},
	getTreeGame: function(){return dom._treeG;},
	getTreePlatform: function(){return dom._treeP;},
	getTreeRules: function(){return dom._treeR;},
	getTreeConfirm: function(){return dom._treeC;},
	getAllTreeEls: function(){return dom._treeEls;},
	doesUserHaveGuild: function(){return dom._uhg;}
};
var validateChoices = {
	_sumUp: false,
	_btn: false,
	init: function(data){
		var treeContainer = dom.getTreeConfirm();
		resetTreeEl(treeContainer);
		highlightTreeStep(treeContainer);
    	loadTreeElTitle(treeContainer, 'révision');

		$('html, body').animate({
			scrollTop: 0
		}, 500);
		loadMainElementsChoice();
		loadTitle('Valide tes choix', '');
		validateChoices.generateSumUp(data);
		validateChoices.loadValidationEvent();
	},
	cleanDOM: function(){
		if(validateChoices._sumUp instanceof jQuery)
			validateChoices._sumUp.remove();
		validateChoices._sumUp=false;
		validateChoices._btn=false;
		loadTreeElTitle(dom.getTreeConfirm(), 'confirmation');
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

		

		var startingDate = $('<li class="relative title-4 creationtournoi-valid-tournoi-startDate"><span>Date de début :</span><span class="uppercase absolute data">'+getDateFromInt(data.dateDebut)+'</span></li>');
		mainList.append(startingDate);

		var finishDate = $('<li class="relative title-4 creationtournoi-valid-tournoi-endDate"><span>Date de fin :</span><span class="uppercase absolute data">'+getDateFromInt(data.dateFin)+'</span></li>');
		mainList.append(finishDate);

		container.append(mainList);
		var valid = $('<div class="full-width creationtournoi-validation-container display-flex-column "></div>');
		validateChoices._btn = $('<button id="creationtournoi-valider" type="button" class="btn btn-pink"><a class="uppercase">Valider</a></button>');
		valid.append(validateChoices._btn);
		container.append(valid);
		dom.getContainer().after(container);
		validateChoices._sumUp = container;
	},
	btnClickedEventCallback: function(obj){
		if(!!obj){
			if(obj.errors){
	    		popupError.init(obj.errors);
	    		return false;
	    	}
	    	else if(obj.success){
	    		window.location.assign(obj.success);
	    	}
		}
	},
	loadValidationEvent: function(){
		var _btn = validateChoices._btn;
		_btn.off();
		_btn.click(function(event) {
			ajaxWithDataRequest('creationtournoi/finalValidation', 'POST', {}, validateChoices.btnClickedEventCallback);
		});
	}
};
var gameversionChoice = {
	_choice: false,
	_choiceDat: false,
	_currentForm: false,
	_btn: false,
	possibleChoices: [],
	possibleTreeChoices: [],
	treeChild: validateChoices,
	init: function(da){
		gameversionChoice.cleanDOM();
		gameversionChoice.getVersions(da);
	},
	cleanDOM: function(){
		gameversionChoice._choiceDat = false;
		gameversionChoice._choice = false;
		gameversionChoice._btn = false;
		for (var i = gameversionChoice.possibleChoices.length - 1; i >= 0; i--) {
			gameversionChoice.possibleChoices[i].remove();
		}
		for (var i = gameversionChoice.possibleTreeChoices.length - 1; i >= 0; i--) {
			gameversionChoice.possibleTreeChoices[i].remove();
		}
		if(gameversionChoice._currentForm instanceof jQuery)
			gameversionChoice._currentForm.remove();
		gameversionChoice._currentForm = false;
		gameversionChoice.possibleChoices = [];
		gameversionChoice.possibleTreeChoices = [];
		gameversionChoice.treeChild.cleanDOM();
		loadTreeElTitle(dom.getTreeRules(), 'règles');
	},
	getChoice: function(){return gameversionChoice._choice;},
	getChoiceDat: function(){return gameversionChoice._choiceDat;},
	getPossibleChoices: function(){return gameversionChoice.possibleChoices;},
	getVersionsCallback: function(obj){
		gameversionChoice.possibleChoices = [];
	    if(!!obj){
	    	if(obj.errors){
	    		popupError.init(obj.errors);
	    		return false;
	    	}
	    	var treeContainer = dom.getTreeRules();
	    	// On reset les choix possibles du choix de tree correspondant
	    	resetTreeEl(treeContainer);
	    	highlightTreeStep(treeContainer);
	    	loadTreeElTitle(treeContainer, 'règles');
		    for(var prop in obj.versions){
		    	var treeDom = tree.getObjDom(treeContainer, obj.versions[prop]);
		    	var jQDomElem = getGameVersionChoiceDom(obj.versions[prop].name, obj.versions[prop].description, obj.versions[prop].maxPlayer, obj.versions[prop].minPlayer, obj.versions[prop].maxTeam, obj.versions[prop].maxPlayerPerTeam);
		    	gameversionChoice.possibleChoices.push(jQDomElem);
		    	gameversionChoice.possibleTreeChoices.push(treeDom);
		    	gameversionChoice.associateChoiceEvent(jQDomElem, treeDom, obj.versions[prop]);
		    }
		    if(gameversionChoice.getPossibleChoices().length == 0)
		    	return false;
		    loadMainElementsChoice(gameversionChoice.possibleChoices);
		    loadTitle("ton mode de jeu");		    
	    }
	    else
	    	popupError.init("Création du DOM consoles impossible");
	},
	getVersions: function(da){
		ajaxWithDataRequest('creationtournoi/getVersions', 'POST', {'name': da}, gameversionChoice.getVersionsCallback);
	},
	putAccordingForm: function(){
		var selectedJson = gameversionChoice.getChoiceDat();
		var selectedName = selectedJson.name;
		var selectedMinP = selectedJson.minPlayer;
		var selectedMaxP = selectedJson.maxPlayer;
		var selectedMinT = selectedJson.minTeam;
		var selectedMaxT = selectedJson.maxTeam;
		var selectedMaxPPT = selectedJson.maxPlayerPerTeam;
		// différencier les match en équipe de ceux en solo
		//  Si équipe --> choix du random, et choix de guilde imposée ou pas 
		// 	Si solo --> forcément random
		if(gameversionChoice._currentForm instanceof jQuery)
			gameversionChoice._currentForm.remove();
		$('.creationtournoi-gameversion-container-form').each(function(){
			$(this).remove();
		});
		var container = $('<div class="creationtournoi-gameversion-container-form"><h2 class="title title-1 uppercase">'+selectedName+'</h2><h3 class="title title-2 capitalize">'+gameChoice.getChoiceDat()+' - <span style="margin-left: 5px;" class="uppercase">'+ consoleChoice.getChoiceDat()+'</span></h3><div class="creationtournoi-separator"></div><p class="title title-4 capitalize">Joueurs: '+selectedMinP+' - '+selectedMaxP+'</p><p class="title title-4 capitalize">Equipes: '+selectedMinT+' - '+selectedMaxT+'</p><p class="title title-4">'+selectedMaxPPT+' par équipe max</p><div>');
		if(parseInt(selectedMaxPPT) == 1)
			container.append('<p class="creationtournoi-random-match title title-4">Rencontres aléatoires</p>');
		var form = $('<form><h4 class="title title-4 capitalize">ton tournoi</h4><div class="form-input-group"><label for="name">Nomme le (8-49 caractères max)</label><input class="border-full" type="text" name="name" maxlength="50" minlength="8" placeholder="Lettres, chiffres et espaces uniquement !" required></div><div class="form-input-group"><label for="startDate">Donne la date de son lancement (requis)</label><input class="border-full" type="date" class="datepicker" name="startDate" placeholder="Format attendu : AAAA-MM-JJ" required/></div></form>');
		// on est dans le cas équipe
		if (parseInt(selectedJson.maxPlayerPerTeam) > 1){
			var randomAndGuildInputs = $('<div class="form-input-group"><label for="randomPlayerMix">Activer l\'affectation d\'équipe aléatoire</label><input class="border-full" type="checkbox" name="randomPlayerMix"></div>');
			if(dom.doesUserHaveGuild())
				randomAndGuildInputs.append('<div class="form-input-group"><label for="guildOnly">Activer le mode "tournoi inter-guildes"</label><input class="border-full" type="checkbox" name="guildOnly"></div>');
			else
				randomAndGuildInputs.append('<div class="form-input-group"><label for="guildOnly">Vous ne pouvez pas créer de tournoi inter-guilde à moins d\'en avoir une</label><input class="border-full" type="checkbox" disabled name="guildOnly"></div>');
			form.append(randomAndGuildInputs);
			gameversionChoice.randomAndGuildInputEvent(randomAndGuildInputs);
		}
		form.append('<div class="form-input-group"><label for="description">Une petite description ?</label><textarea class="border-full" name="description" maxlength="200" minlength="4"></textarea></div>');
		var valid = $('<div class="creationtournoi-validation-container display-flex-column "></div>');
		gameversionChoice._btn = $('<button id="creationtournoi-valider" type="button" class="btn btn-pink"><a class="uppercase">Valider</a></button>');
		valid.append(gameversionChoice._btn);
		form.append(valid);
		container.append(form);
		dom.getContainer().after(container);
		$('html, body').animate({
			scrollTop: (container.find('form h4').offset().top) - (jQuery("#navbar").height())
		}, 500);
		container.find('input[name="name"]').focus();
		gameversionChoice._currentForm = container;
	},
	associateChoiceEvent: function(jQel, treeSubEl, objDa){
		jQel.click(function(e) {
			if(gameversionChoice.getChoiceDat() === objDa){
				gameversionChoice.resetChoice();
			}else{
				gameversionChoice.setChoice(jQel, objDa, treeSubEl);
				gameversionChoice.putAccordingForm();
				gameversionChoice.loadValidationEvent();
			}			
		});
		treeSubEl.click(function(e) {
			if(gameversionChoice.getChoiceDat() === objDa){
				gameversionChoice.resetChoice();
			}else{
				gameversionChoice.setChoice(jQel, objDa, treeSubEl);
				gameversionChoice.putAccordingForm();
				gameversionChoice.loadValidationEvent();
			}		
		});
	},
	resetChoice: function(){
		var allChoices = gameversionChoice.getPossibleChoices();
		for (var i = 0; i < allChoices.length; i++) {
			allChoices[i].removeClass('box-bg-shadow');
			allChoices[i].removeClass('bg-black');
			allChoices[i].removeClass('creationtournoi-active-choice');
			allChoices[i].removeClass('scale-10-percent');
			allChoices[i].find('h2').addClass('inverse-border-full');
			allChoices[i].find('p').addClass('inverse-border-full');
		};
		gameversionChoice._choice = false;
		gameversionChoice._choiceDat = false;
		gameversionChoice._currentForm.remove();
		gameversionChoice._currentForm = false;
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da, treeSubEl){
		gameversionChoice._choice = jQChoice;
		gameversionChoice._choiceDat = da;
		var allChoices = gameversionChoice.getPossibleChoices();
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
		treeSubEl.parent().children('.tree-el-choice').removeClass('active-tree-choice');
		treeSubEl.addClass('active-tree-choice');
	},
	isNameValid: function(jQel){
		var unauthorizedChars = /[^a-z0-9 \-éàôûîêçùèâ]/i;
		if(jQel.val().match(unauthorizedChars) 
			|| jQel.val().length < 8
			|| jQel.val().length > 50){
			inscription.highlightInput(jQel);
			popupError.init("Le nom du tournoi doit être compris entre 8 et 49 caractères  alphanumériques (accents compris)");
			return false;
		}
		return true;
	},
	isDateFormatValid: function(jQel){
		var unauthorizedChars = /[^\d{2}\-\d{2}\-\d{4}]/;
		if(jQel.val().match(unauthorizedChars)){
			popupError.init("Votre date doit etre de la forme aaaa-mm-jj");
			// jQel[0].value = "";
			jQel.focus();
			return false;
		};
		return true;
	},
	isStringValid: function(jQel){
		if(jQel.val().replace(/ /g, '').length==0){
			jQel[0].value = "";
			return true;
		}
		if(jQel.val().length < 4
			|| jQel.val().length > 200){
			inscription.highlightInput(jQel);
			popupError.init("Votre description, si fournie, doit faire entre 4 et 200 caractères");
			return false;
		}
		return true;
	},
	isGuildAndRandValid: function(randP, guild){
		var randPVal = randP[0].checked;
		var guildVal = guild[0].checked;
		if(guildVal && randPVal){
			popupError.init("Les tournois entre guilde ne peuvent se faire avec des équipes aléatoires");
			return false;
		}
			
		return true;
	},
	checkForm: function(){
		var form = gameversionChoice._currentForm;
		// Checks communs à equipe et solo 
		if(!form)
			return false;

		var _name = form.find('input[name="name"]');
		if(_name.length != 1 || !gameversionChoice.isNameValid(_name))
			return false;

		var _startDate = form.find('input[name="startDate"]');
		if(_startDate.length != 1 || !gameversionChoice.isDateFormatValid(_startDate))
			return false;

		var _description = form.find('textarea[name="description"]');
		if(_description.val().length > 0 && !gameversionChoice.isStringValid(_description))
			return false;


		// Check typiquement equipe
		var joueursParEquipe = gameversionChoice.getChoiceDat().maxPlayerPerTeam;
		if (joueursParEquipe > 1){
			var randomP = form.find('input[name="randomPlayerMix"]');
			var guild = form.find('input[name="guildOnly"]');
			if(randomP.length != 1)
				return false
			if(guild.length != 1 || !gameversionChoice.isGuildAndRandValid(randomP, guild))
				return false
		};
		return true;
	},
	randomAndGuildInputEvent: function(jQelContainer){
		var randomP = jQelContainer.find('input[name="randomPlayerMix"]');
		var guild = jQelContainer.find('input[name="guildOnly"]');
		guild.click(function() {
			if(guild.val() == true)
				randomP[0].checked = false;
		});
	},
	loadValidationEventCallback: function(obj){
		if(!!obj){
			if(obj.errors){
	    		popupError.init(obj.errors);
	    		return false;
	    	}
	    	gameversionChoice.cleanDOM();
			validateChoices.init(obj);
		}
	},
	loadValidationEvent: function(){
		var _btn = gameversionChoice._btn;
		_btn.off();
		_btn.click(function(event) {
			if (!!gameversionChoice.getChoice() && !!gameversionChoice.getChoiceDat() && gameversionChoice.checkForm()){
				var form = gameversionChoice._currentForm;
				var toSend = {};
				toSend.name = form.find('input[name="name"]').val().replace(/(<([^>]+)>)/ig,"");		
				toSend.startDate = form.find('input[name="startDate"]').val();
				toSend.description = form.find('textarea[name="description"]').val().replace(/(<([^>]+)>)/ig,"");
				var joueursParEquipe = gameversionChoice.getChoiceDat().maxPlayerPerTeam;
				if (joueursParEquipe > 1){
					toSend.randomPlayerMix = form.find('input[name="randomPlayerMix"]')[0].checked;
					toSend.guildOnly = form.find('input[name="guildOnly"]')[0].checked;
				}else{
					toSend.randomPlayerMix = true;
					toSend.guildOnly = false;
				}
				toSend.gversionName = gameversionChoice.getChoiceDat().name;
				toSend.gversionDescription = gameversionChoice.getChoiceDat().description;
				toSend.gversionMaxPlayer = gameversionChoice.getChoiceDat().maxPlayer;
				toSend.gversionMinPlayer = gameversionChoice.getChoiceDat().minPlayer;
				toSend.gversionMaxTeam = gameversionChoice.getChoiceDat().maxTeam;
				toSend.gversionMinTeam = gameversionChoice.getChoiceDat().minTeam;
				toSend.gversionMaxPlayerPerTeam = gameversionChoice.getChoiceDat().maxPlayerPerTeam;
				toSend.gversionMinPlayerPerTeam = gameversionChoice.getChoiceDat().minPlayerPerTeam;
				ajaxWithDataRequest('creationtournoi/getFinalStep', 'POST', toSend, gameversionChoice.loadValidationEventCallback);
			}
		});
	}
};
var consoleChoice = {
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	possibleTreeChoices: [],
	treeChild: gameversionChoice,
	init: function(da){
		consoleChoice.cleanDOM();
		consoleChoice.getConsoles(da);
	},
	cleanDOM: function(){
		consoleChoice._choiceDat = false;
		consoleChoice._choice = false;
		for (var i = consoleChoice.possibleChoices.length - 1; i >= 0; i--) {
			consoleChoice.possibleChoices[i].remove();
		}
		for (var i = consoleChoice.possibleTreeChoices.length - 1; i >= 0; i--) {
			consoleChoice.possibleTreeChoices[i].remove();
		}
		consoleChoice.possibleChoices = [];
		consoleChoice.possibleTreeChoices = [];
		consoleChoice.treeChild.cleanDOM();
		loadTreeElTitle(dom.getTreePlatform(), 'console');
	},
	getChoice: function(){return consoleChoice._choice;},
	getChoiceDat: function(){return consoleChoice._choiceDat;},
	getPossibleChoices: function(){return consoleChoice.possibleChoices;},
	getConsoleCallback: function(obj){
		consoleChoice.possibleChoices = [];
	    if(!!obj){
	    	if(obj.errors){		    		
	    		popupError.init(obj.errors);		    		
	    		return false;
	    	}
	    	var treeContainer = dom.getTreePlatform();
	    	// On reset les choix possibles du choix de tree correspondant
	    	resetTreeEl(treeContainer);
	    	highlightTreeStep(treeContainer);
	    	loadTreeElTitle(treeContainer, 'console');
		    for(var prop in obj.platforms){
		    	var treeDom = tree.getObjDom(treeContainer, obj.platforms[prop]);
		    	var jQDomElem = getElementChoiceDom(obj.platforms[prop].name, obj.platforms[prop].description, obj.platforms[prop].img);
		    	consoleChoice.possibleChoices.push(jQDomElem);
		    	consoleChoice.possibleTreeChoices.push(treeDom);
		    	consoleChoice.associateChoiceEvent(jQDomElem, treeDom, obj.platforms[prop].name);
		    }
		    if(consoleChoice.getPossibleChoices().length == 0)
		    	return false;
		    loadMainElementsChoice(consoleChoice.possibleChoices);
		    loadTitle("ta console");
		    
	    }else{
	    	popupError.init("Création du DOM consoles impossible");
	    }
	},
	getConsoles: function(da){
		ajaxWithDataRequest('creationtournoi/getConsoles', 'POST', {'name': da}, consoleChoice.getConsoleCallback);
	},
	associateChoiceEvent: function(jQel, treeSubEl, da){
		jQel.click(function(e) {
			consoleChoice.setChoice(jQel, da, treeSubEl);
			if (!!consoleChoice.getChoice() && !!da){
				gameversionChoice.init(da);
				var treeContainer = dom.getTreePlatform();
				loadTreeElTitle(treeContainer, da);
			};
		});
		treeSubEl.click(function(e) {
			consoleChoice.setChoice(jQel, da, treeSubEl);
			if (!!consoleChoice.getChoice() && !!da){
				gameversionChoice.init(da);
				var treeContainer = dom.getTreePlatform();
				loadTreeElTitle(treeContainer, da);
			};
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da, treeSubEl){
		consoleChoice._choice = jQChoice;
		consoleChoice._choiceDat = da;
		var allChoices = consoleChoice.getPossibleChoices();
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
		treeSubEl.parent().children('.tree-el-choice').removeClass('active-tree-choice');
		treeSubEl.addClass('active-tree-choice');
	}
};
var gameChoice = {	
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	possibleTreeChoices: [],
	treeChild: consoleChoice,
	init: function(da){
		gameChoice.cleanDOM();
		gameChoice.getGames(da);
	},
	cleanDOM: function(){
		gameChoice._choiceDat = false;
		gameChoice._choice = false;
		for (var i = gameChoice.possibleChoices.length - 1; i >= 0; i--) {
			gameChoice.possibleChoices[i].remove();
		}
		for (var i = gameChoice.possibleTreeChoices.length - 1; i >= 0; i--) {
			gameChoice.possibleTreeChoices[i].remove();
		}
		gameChoice.possibleChoices = [];
		gameChoice.possibleTreeChoices = [];
		gameChoice.treeChild.cleanDOM();
	},
	getChoice: function(){return gameChoice._choice;},
	getChoiceDat: function(){return gameChoice._choiceDat;},
	getPossibleChoices: function(){return gameChoice.possibleChoices;},
	getGamesCallback: function(obj){
		gameChoice.possibleChoices = [];
	    if(!!obj){
	    	if(obj.errors){
	    		popupError.init(obj.errors);
	    		return false;
	    	}
	    	var treeContainer = dom.getTreeGame();
	    	// On reset les choix possibles du choix de tree correspondant
	    	resetTreeEl(treeContainer);
	    	highlightTreeStep(treeContainer);
	    	loadTreeElTitle(treeContainer, 'jeu');
		    for(var prop in obj.games){
		    	var treeDom = tree.getObjDom(treeContainer, obj.games[prop]);
		    	var jQDomElem = getElementChoiceDom(obj.games[prop].name, obj.games[prop].description, obj.games[prop].img);
		    	gameChoice.possibleChoices.push(jQDomElem);
		    	gameChoice.possibleTreeChoices.push(treeDom);
		    	gameChoice.associateChoiceEvent(jQDomElem, treeDom, obj.games[prop].name);
		    }
		    if(gameChoice.getPossibleChoices().length == 0)
		    	return false;
		    loadMainElementsChoice(gameChoice.possibleChoices);
		    loadTitle("ton jeu");
		    
	    }else{
	    	popupError.init("Création du DOM gametype impossible");
	    }
	},
	getGames: function(da){
		ajaxWithDataRequest('creationtournoi/getGames', 'POST', {'name': da}, gameChoice.getGamesCallback);
	},
	associateChoiceEvent: function(jQel, treeSubEl, da){
		jQel.click(function(e) {
			gameChoice.setChoice(jQel, da, treeSubEl);
			if (!!gameChoice.getChoice() && !!da){
				consoleChoice.init(da);
				var treeContainer = dom.getTreeGame();
				loadTreeElTitle(treeContainer, da);
			};
		});
		treeSubEl.click(function(e) {
			gameChoice.setChoice(jQel, da, treeSubEl);
			if (!!gameChoice.getChoice() && !!da){
				consoleChoice.init(da);
				var treeContainer = dom.getTreeGame();
				loadTreeElTitle(treeContainer, da);
			};
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da, treeSubEl){
		gameChoice._choice = jQChoice;
		gameChoice._choiceDat = da;
		var allChoices = gameChoice.getPossibleChoices();
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
		treeSubEl.parent().children('.tree-el-choice').removeClass('active-tree-choice');
		treeSubEl.addClass('active-tree-choice');
	}
};
var gameTypesChoice = {
	_choice: false,
	_choiceDat: false,
	possibleChoices: [],
	possibleTreeChoices: [],
	treeChild: gameChoice,
	init: function(){
		/*Tous les chargements d'event et autres fonctions se feront dans le success callback retour de ajax*/
		gameTypesChoice.cleanDOM();
		gameTypesChoice.getGameTypes();
	},
	cleanDOM: function(){
		gameTypesChoice._choiceDat = false;
		gameTypesChoice._choice = false;
		for (var i = gameTypesChoice.possibleChoices.length - 1; i >= 0; i--) {
			gameTypesChoice.possibleChoices[i].remove();
		}
		for (var i = gameTypesChoice.possibleTreeChoices.length - 1; i >= 0; i--) {
			gameTypesChoice.possibleTreeChoices[i].remove();
		}
		gameTypesChoice.possibleChoices = [];
		gameTypesChoice.possibleTreeChoices = [];
		gameTypesChoice.treeChild.cleanDOM();
	},
	getChoice: function(){return gameTypesChoice._choice;},
	getChoiceDat: function(){return gameTypesChoice._choiceDat;},
	getPossibleChoices: function(){return gameTypesChoice.possibleChoices;},
	getGameTypesCallback: function(obj){
		gameTypesChoice.possibleChoices = [];
	  	gameTypesChoice.possibleTreeChoices = [];
	    if(!!obj){
	    	if(obj.errors){
	    		popupError.init(obj.errors);
	    		return false;
	    	}
	    	// On récupère tous les choix, les transforme en DOM et l'ajoute à l'array
	    	// On associe les events de choix à chaque élément de l'array
	    	var treeContainer = dom.getTreeGameType();
	    	// On reset les choix possibles du choix de tree correspondant
	    	resetTreeEl(treeContainer);
	    	highlightTreeStep(treeContainer);
	    	loadTreeElTitle(treeContainer, 'type de jeu');
		    for(var prop in obj.types){
		    	// On crée le dom ds le tree correspondant à un choix et on le recupere
		    	var treeDom = tree.getObjDom(treeContainer, obj.types[prop]);
		    	var jQDomElem = getElementChoiceDom(obj.types[prop].name, obj.types[prop].description, obj.types[prop].img);
		    	// Ajoute les éléments DOM principaux (pas du tree) en tant que choix possibles
		    	gameTypesChoice.possibleChoices.push(jQDomElem);
		    	gameTypesChoice.possibleTreeChoices.push(treeDom);
		    	gameTypesChoice.associateChoiceEvent(jQDomElem, treeDom, obj.types[prop].name);
		    }
		    if(gameTypesChoice.getPossibleChoices().length == 0)
		    	return false;
		    loadMainElementsChoice(gameTypesChoice.possibleChoices);
		    loadTitle("ton style de jeu");
		}
		else
	    	popupError.init("Création du DOM gametype impossible");
	},
	getGameTypes: function(){
		ajaxWithDataRequest('creationtournoi/getGameTypes', 'POST', {}, gameTypesChoice.getGameTypesCallback);
	},
	associateChoiceEvent: function(jQel, treeSubEl, da){
		jQel.click(function(e) {
			gameTypesChoice.setChoice(jQel, da, treeSubEl);
			gameChoice.init(da);
			var treeContainer = dom.getTreeGameType();
			loadTreeElTitle(treeContainer, da);
		});
		treeSubEl.click(function(e) {
			gameTypesChoice.setChoice(jQel, da, treeSubEl);
			gameChoice.init(da);
			var treeContainer = dom.getTreeGameType();
			loadTreeElTitle(treeContainer, da);
		});
	},
	// Modifie le choix en cours et lui applique le css correspondant
	setChoice: function(jQChoice, da, treeSubEl){
		gameTypesChoice._choice = jQChoice;
		gameTypesChoice._choiceDat = da;
		var allChoices = gameTypesChoice.getPossibleChoices();
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
		
		treeSubEl.parent().children('.tree-el-choice').removeClass('active-tree-choice');
		treeSubEl.addClass('active-tree-choice');
	}
};
var tree = {
	getObjDom: function(jQelTree, obj){
		var treeElDom = getCreatedTreeSubEl(jQelTree, obj);
		return treeElDom;
	},
	getGameTypeChoices: function(){return tree._gtChoices;}
};


initAll.add(dom.init);