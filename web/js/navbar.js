"use strict";
/*
	Pour pallier les pb de temps de chargement des scripts causant des erreurs lorsque le webpath n'est pas encore récupéré, ne plus passer par document.ready

	--> ajouter votre fonction à appeler de la sorte:
		--> si c'est une méthode d'objet 
			initAll.add(votre_objet.sa_methode)   
			/!\ oui, oON NE MET PAS la parenthèse c'est normal
		--> si c'est une fonction générale
			initAll.add(votre_fonction)   
			/!\ oui, ON NE MET PAS la parenthèse c'est normal

	/!\ Ajoutez votre fonction à initAll seulement après sa définition dans votre fichier .js
		 #### Donc à la fin de votre fichier #####
			function ma_fonction(){
				console.log("exemple !");	
			}
			// Votre fonction est désormais définie, vous pouvez l'ajouter:
			initAll.add(ma_fonction);
*/
var initAll = {
	funcListToLaunch: [],
	add: function(func){
		this.funcListToLaunch.push(func);
	},
	launch: function(){
		for(var func in this.funcListToLaunch){
			this.funcListToLaunch[func]();
		}
	}
}

function isElSoloJqueryInstance(el){
	if(el.length == 1 && el instanceof jQuery)
		return true;
	return false;
}

/**
*
* Envoi l'image en ajax au controlleur
*
*/ 
function uploadImage(myController, data) {

	var el = {};

	el.selector = data.selector ? data.selector : console.log("uploadImage() : Selector is missing");
	el.id = data.id ? data.id : console.log("uploadImage() : Id is missing");

    if (typeof FormData !== 'undefined') {
           
        var file_data = $(el.selector).prop('files')[0];   
	    var form_data = new FormData();                  
	    form_data.append('file', file_data);
	    form_data.append('id', el.id);		                              
	    jQuery.ajax({
            url: myController, 
            dataType: 'text',  
            cache: false,
            contentType: false,
            processData: false,
            data: form_data,                         
            type: 'post',
            success: function(data){
                //console.log("Image uploadé.");
            },
            error: function(data){
                console.log(data);
            }
	    });

    } else {    	
       alert("Votre navigateur ne supporte pas FormData API! Utiliser IE 10 ou au dessus!");
    }   
}


//Preview de l'image avant upload
function previewUpload(input, targetSrc) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            targetSrc.attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}


function $_GET(param) {
	var vars = {};
	window.location.href.replace( location.hash, '' ).replace( 
		/[?&]+([^=&]+)=?([^&]*)?/gi, // regexp
		function( m, key, value ) { // callback
			vars[key] = value !== undefined ? value : '';
		}
	);

	if ( param ) {
		return vars[param] ? vars[param] : null;	
	}
	return vars;
}
// Cette fonction sera utilisée dans beaucoup d'objets utilisant de l'ajax
//  Voilà pourquoi elle est définie en tant que fct générale
function tryParseData(rawData){
	if(rawData.trim().length!=0){
		try {
			var obj = jQuery.parseJSON(rawData);
			return obj;
		}
		catch(err){
			console.log(rawData);
			popup.init("Problem during server processes");
		}
	}
	return false;
}

// Function ajax de flemmard 
function ajaxRequest(url, type, callback){
	
	/* PAS TOUCHE 
		if(myData){

		var allData = {}, allData.data = {};

		allData.url = myData.url ? myData.url : console.log('ajaxRequest url not found');
		allData.type = myData.type ? myData.type : console.log('ajaxRequest type not found');
		allData.data = myData.data ? myData.data : console.log('ajaxRequest data not found');
		allData.callback = myData.callback ? myData.callback : console.log('ajaxRequest callback not found');

		jQuery.ajax({
		 	url: allData.url,
		 	type: allData.type,
		 	data: allData.data,
		 	success: function(result){
		 		result = tryParseData(result);			 					 		
				return result;
		 	}
		});
		
		}else{
			console.log("myData parameter doesn't exist");
		}
	*/

	if(url && type && callback){
		jQuery.ajax({
		 	url: url,
		 	type: type,
		 	success: function(result){
		 		result = tryParseData(result);			 		
				callback(result);
		 	}
		});
	}else{
		console.log("Params vide sur dataShow()");
	}	
}

function ajaxWithDataRequest(url, type, toSendData, callback, failCallback){
	if(url && type && callback){
		if(Object.keys(toSendData).length > 0){
			jQuery.ajax({
			 	url: webpath.get()+"/"+url,
			 	type: type,
			 	data: toSendData,
			 	success: function(result){
			 		var obj = tryParseData(result);
			 		if(callback)
						callback(obj);
			 	},
			 	error: function(xhr, textStatus, errorThrown) {
			 		if(failCallback)
			 			failCallback();
			 		else
						popup.init("request error !! : \t " + errorThrown);
				}
			});
		}
		else{
			jQuery.ajax({
			 	url: webpath.get()+"/"+url,
			 	type: type,
			 	success: function(result){
			 		var obj = tryParseData(result);
			 		if(callback)
						callback(obj);
			 	},
			 	error: function(xhr, textStatus, errorThrown) {
					if(failCallback)
			 			failCallback();
			 		else
						popup.init("request error !! : \t " + errorThrown);
				}
			});
		}
	}else{
		console.log("Params vide sur ajaxWithDataRequest()");
	}
}

function adaptMarginToNavHeight(jQel){
	if(jQel instanceof jQuery){
		var navHeight = $("#navbar").height();
		jQel.css('margin-top', navHeight);
	}
	else
		console.log("Pas reçu du dom dans adaptMarginToNavHeight");	
}

// index-creation-compte-terminee-divtodelete
function checkForJustCreatedAccount(){
	var div = $('#index-creation-compte-terminee-divtodelete'); 
	if(div.length > 0){
		var data = div.data('compte');
		popup.init("Le compte " + data + " a bien été activé");
	}
}

// Recuperation du webpath du server
var webpath = {
	init: function(){
		webpath.setServerPath();
	},
	get: function(){return webpath._path;},
	setServerPath: function(){
		var hiddenInp = $('#webpath');
		if(isElSoloJqueryInstance(hiddenInp)){
			webpath._path = hiddenInp.val();
			hiddenInp.remove();
			initAll.launch();
		}
		else{
			webpath._path = false;
			console.log("Couldn't find webpath !");
		}
	}
};

var scroll = {
	init : function(clickSelector, sectionSelector){
		if(clickSelector instanceof jQuery && sectionSelector){
			scroll.clickEvent(clickSelector, sectionSelector);
		}else{
			console.log("Pas reçu du dom dans scroll.init()!");
		}
	},
	clickEvent : function(clickSelector, sectionSelector){
		if(clickSelector instanceof jQuery && sectionSelector){
			clickSelector.click(function(){
				scroll.toAnchor(sectionSelector);
			});
		}else{
			console.log("Pas reçu du dom dans scroll.clickEvent");
		}
	},
	toAnchor : function(selector){
		if(selector instanceof jQuery){
	    	jQuery('html,body').animate({scrollTop: selector.offset().top},'slow');
    	}else{
    		console.log("Pas reçu du dom dans scroll.toAnchor()");
    	}
	}
};

// Suffira d'envoyer une string à popup.init et l'ob se chargera du reste 
var popup = {
	openedPopupModal: false,
	openedPopupMsg: false,
	animationOnGoing: false,
	getOpenedPopupModal: function(){
		return popup.openedPopupModal;
	},
	getOpenedPopupMsg: function(){
		return popup.openedPopupMsg;
	},
	setOpenedPopupModal: function(jQel){
		popup.openedPopupModal = jQel;
	},
	setOpenedPopupMsg: function(jQel){
		popup.openedPopupMsg = jQel;
	},
	closeOldPopup: function(jQModal, jQMsg){
		navbar.form.smoothClosing();
		if(popup.getOpenedPopupModal() instanceof jQuery){
			var _popup = popup;
			popup.animationOnGoing = true;
			popup.getOpenedPopupMsg().addClass('fadeOutRight');
			setTimeout(function(){
				_popup.getOpenedPopupModal().empty();
				_popup.getOpenedPopupModal().remove();
				_popup.setOpenedPopupModal(false);
				_popup.setOpenedPopupMsg(false);
				_popup.animationOnGoing = false;
				$('body').css('overflow', 'visible');
				if(jQModal instanceof jQuery && jQMsg instanceof jQuery)
					_popup.openNewPopup(jQModal, jQMsg);
			},1000);
		}
		else
			popup.openNewPopup(jQModal, jQMsg);
	},
	init: function(message){		
		if(message){
			if(popup.animationOnGoing){
				console.log("Animation popup déjà en cours.");
				return;
			}
			var container = $('<div class="index-modal-popup display-flex-column animation fade"></div>');
			var popdivContainer = $('<div class="index-popup-msg display-flex-column animation fadeRight"></div>');
			var subDiv = $('<div class="border-full display-flex-column"></div>')
			var popMsg = $('<p class="title title-4">'+message+'</p>');
			subDiv.append(popMsg);
			popdivContainer.append(subDiv);
			container.append(popdivContainer);
			popup.closeOldPopup(container, popdivContainer);
		}
		else
			console.log("Aucun contenu reçu dans popup init.");
	},
	openNewPopup: function(jQModal, jQMsg){
		$('body').css('overflow', 'hidden');
		$('body').append(jQModal);
		popup.setOpenedPopupModal(jQModal);
		popup.setOpenedPopupMsg(jQMsg);
		popup.associateClosingEvent();
	},
	associateClosingEvent: function(){
		var _popup = popup;
		popup.getOpenedPopupModal().click(function(e){
			if($(e.target).hasClass('index-modal-popup')){
				_popup.closeOldPopup();
			};
		});
	}
}

var navbar = {
    init: function(){
    	navbar.setNavbarEl();
    	navbar.setNavToggle();
    	navbar.setSearchPage();
    	navbar.setSearchToggle();
    	navbar.setNavSideMenu();
    	navbar.setNavLogin();
    	navbar.setNavInscription();
    	navbar.setIndexModal();
    	navbar.setLoginForm();
    	navbar.setSubscribeForm();    	

		navbar.shrink();
        navbar.openNavbarSide();
        navbar.search.toggle();
        navbar.search.close();
        navbar.form.subscribe();
        navbar.form.login();        
        navbar.form.closeFormKey();
        //navbar.form.closeFormEnter();
        navbar.form.closeFormClick();
        navbar.menu();        
    },


    /*##### SETTERS #####*/
    setNavbarEl: function(){
    	navbar._navEl = $("#navbar");
    },
    setNavToggle: function(){
    	navbar._navToggle = $('#navbar-toggle');
    },
    setNavSideMenu: function(){
    	navbar._navSideMenu = $('.navbar-side-menu');
    },
    setNavLogin: function(){
    	navbar._navLogin = $('#navbar-login');
    },
    setOpenFormAll: function(){
    	navbar._openFormAll = $('.open-form');
    },
    setNavInscription: function(){
    	navbar._navInscription = $('#navbar-inscription');
    },
    setSearchPage: function(){
    	navbar._searchPage = $('.search-page');
    },
    setSearchToggle: function(){
    	navbar._searchToggle = $('.search-toggle');
    },
    setIndexModal: function(){
    	navbar._indexModal = $('.index-modal');
    },
    setLoginForm: function(){
    	navbar._loginForm = $('#login-form');
    },
    setSubscribeForm: function(){
    	navbar._subscribeForm = $('#subscribe-form');
    },


    /*##### GETTERS #####*/
    getNavbarEl: function(){
    	return navbar._navEl;
    },
    getNavToggle: function(){
    	return navbar._navToggle;
    },
    getNavSideMenu: function(){
    	return navbar._navSideMenu;
    },
    getSearchPage: function(){
    	return navbar._searchPage;
    },
    getSearchToggle: function(){
    	return navbar._searchToggle;
    },
    getNavLogin: function(){
    	return navbar._navLogin;
    },
    getNavInscription: function(){
    	return navbar._navInscription;
    },
    getIndexModal: function(){
    	return navbar._indexModal;
    },
    getLoginForm: function(){
    	return navbar._loginForm;
    },
    getSubscribeForm: function(){
    	return navbar._subscribeForm;
    },
    getOpenForm: function(){
    	return navbar._openFormAll;
    },

    preventShrink: false,
    shrink: function(force){
    	if(!navbar.preventShrink){   		
	        $(window).scroll(function(){
	            if($(window).scrollTop() > 50){
	                navbar.getNavbarEl().removeClass('full');
	                navbar.getNavbarEl().addClass('shrink');
	            }else{
	                navbar.getNavbarEl().removeClass('shrink');
	                navbar.getNavbarEl().addClass('full');
	            }
	        });
	        return;
	    }
	    navbar.getNavbarEl().removeClass('full');
        navbar.getNavbarEl().addClass('shrink');
    },
    scrollTopDefault : function(){
    	jQuery(window).on('beforeunload', function() {
    		jQuery(window).scrollTop(0);
		});
    },
    openNavbarSide : function(){
        navbar.getNavToggle().on('click', function(){
            if(navbar.getNavSideMenu().hasClass('navbar-collapse')){
                navbar.getNavSideMenu().removeClass('navbar-collapse');
            }else{
                navbar.getNavSideMenu().addClass('navbar-collapse');
            }
        });
    },
    search : {
        toggle: function(){
            $(document).on('click', '.search-toggle', function(){
                navbar.getSearchPage().removeClass('hidden-fade');
                setTimeout(function() {
                    navbar.getSearchPage().removeClass('hidden');
                }, 0);
            });
        },
        close: function(){
            $(document).on('click', '.btn-close', function(e){
                $(e.currentTarget).parents('.search-page').addClass('hidden-fade');
                setTimeout(function() {
                    navbar.getSearchPage().addClass('hidden');
                }, 800);
            });
        }
    },
    //Refacto le code
    form : {
    	admin : function(){    		
    		navbar.getOpenForm().click(function(e){      			
    			jQuery(e.currentTarget).parent().parent().find('.index-modal').find('.index-modal-this').addClass('form-bg-active');
    			jQuery(e.currentTarget).parent().parent().find('.index-modal').removeClass('hidden-fade');
    			setTimeout(function(){
					jQuery('.index-modal').removeClass('hidden');
    			}, 0);
    			jQuery('.inscription_rapide').addClass('fadeDown').removeClass('fadeOutUp');
    			jQuery('body').css('overflow', 'hidden');
    		});
    	},
        subscribe : function(){
            navbar.getNavLogin().on('click', function(){
            	navbar.getIndexModal().closest('.index-modal-login').addClass('form-bg-active');
                navbar.getIndexModal().removeClass('hidden-fade');
                setTimeout(function() {
                    navbar.getIndexModal().removeClass('hidden');
                }, 0);
                navbar.getLoginForm().removeClass('hidden');
                navbar.getSubscribeForm().addClass('hidden');
                $('.inscription_rapide').addClass('fadeDown').removeClass('fadeOutUp');
                $('body').css('overflow', 'hidden');
            });
        },
        login : function(){
        	navbar.getNavbarEl().find('.index-modal-login').addClass('form-bg-active');
            navbar.getNavInscription().on('click', function(){
                navbar.getIndexModal().removeClass('hidden-fade');
                setTimeout(function() {
                    navbar.getIndexModal().removeClass('hidden');
                }, 0);
                navbar.getSubscribeForm().removeClass('hidden');
                navbar.getLoginForm().addClass('hidden');
                $('.inscription_rapide').addClass('fadeDown').removeClass('fadeOutUp');
                $('body').css('overflow', 'hidden');
            });
        },
        closeForm : function(){
            $('.index-modal').addClass('hidden-fade').addClass('fade').addClass('hidden'); 
            $('body').css('overflow', 'visible');       
        },
        closeFormKey: function(){
    	 	$(document).keyup(function(e) {
                if (e.keyCode == 27) {

                	$('.inscription_rapide').addClass('fadeOutUp').removeClass('fadeDown');	
                    
                    setTimeout(function() {
                    	navbar.form.closeForm();			    	
                	}, 700);
                }
            });
        },
        closeFormClick: function(){
        	$('.index-modal-login').on('click', function(e){
			    if(!$(e.target).is('.inscription_rapide') && !$(e.target).is('.relative, .toggleCheck, .inscription_rapide form, [class*="grid-"] , select, option, .admin-input-file, input, button, label,textarea, p, a, img'))
		   			navbar.form.smoothClosing();
			});
        },
        smoothClosing: function(){
        	$('.inscription_rapide').addClass('fadeOutUp').removeClass('fadeDown');
    		setTimeout(function() {
            	navbar.form.closeForm();			    	
        	}, 700);	
        },
        closeFormEnter : function(){
        	$(document).keyup(function(e){
        		if(e.keyCode == 13){
        			$('.inscription_rapide').addClass('fadeOutUp').removeClass('fadeDown');	
                    
                    setTimeout(function() {
                    	navbar.form.closeForm();			    	
                	}, 700);
        		}
        	});
        }
    },
    menu: function(){
		$('.navbar-menu-li').mouseenter(function(){
			$('.navbar-menu-tooltip').css('display', 'none');

			$(this).find('.navbar-menu-tooltip').css('display', 'initial');

			$(this).find('.navbar-menu-tooltip').mouseleave(function(){
				$(this).css('display', 'none');
			});
		});
    }
};

var inscription = {
	init: function(){
		inscription.setFormToWatch();
		if(!(inscription.getFormToWatch() instanceof jQuery)){
			popup.init("Manque le formulaire !");
			return;
		}
		inscription.setPseudoToWatch();
		if(!(inscription.getPseudoToWatch() instanceof jQuery)){
			popup.init("Manque votre pseudo !");
			return;
		}
		inscription.setEmailToWatch();
		if(!(inscription.getEmailToWatch() instanceof jQuery)){
			popup.init("Manque votre email !");
			return;
		}
		inscription.setPassToWatch();
		if(!(inscription.getPassToWatch() instanceof jQuery)){
			popup.init("Manque votre mot de passe !");
			return;
		}
		inscription.setPassCheckToWatch();
		if(!(inscription.getPassCheckToWatch() instanceof jQuery)){
			popup.init("Manque votre confirmation de mot de passe !");
			return;
		}
		inscription.setCguToWatch();
		if(!(inscription.getCguToWatch() instanceof jQuery)){
			popup.init("Manque les CGU !");
			return;
		}
		inscription.setDayToWatch();
		if(!(inscription.getDayToWatch() instanceof jQuery)){
			popup.init("Manque le jour de naissance !");
			return;
		}
		inscription.setMonthToWatch();
		if(!(inscription.getMonthToWatch() instanceof jQuery)){
			popup.init("Manque le mois de naissance !");
			return;
		}
		inscription.setYearToWatch();
		if(!(inscription.getYearToWatch() instanceof jQuery)){
			popup.init("Manque l'année de naissance !");
			return;
		}
		inscription.sendEvent();
	},
	setFormToWatch: function(){
		inscription._form = jQuery("#inscription-form");
	},
	setPseudoToWatch: function(){
		inscription._pseudo = inscription._form.find('input[name="pseudo"]');
	},
	setEmailToWatch: function(){
		inscription._email = inscription._form.find('input[name="email"]');
	},
	setPassToWatch: function(){
		inscription._mdp = inscription._form.find('input[name="password"]');
	},
	setPassCheckToWatch: function(){
		inscription._mdpcheck = inscription._form.find('input[name="password_check"]');
	},
	setCguToWatch: function(){
		inscription._cgu = inscription._form.find('input[name="cgu"]');
	},
	setDayToWatch: function(){
		inscription._day = inscription._form.find('input[name="day"]');
	},
	setMonthToWatch: function(){
		inscription._month = inscription._form.find('input[name="month"]');
	},
	setYearToWatch: function(){
		inscription._year = inscription._form.find('input[name="year"]');
	},
	getFormToWatch: function(){return inscription._form;},
	getPseudoToWatch: function(){return inscription._pseudo;},
	getEmailToWatch: function(){return inscription._email;},
	getPassToWatch: function(){return inscription._mdp;},
	getPassCheckToWatch: function(){return inscription._mdpcheck;},
	getCguToWatch: function(){return inscription._cgu;},
	getDayToWatch: function(){return inscription._day;},
	getMonthToWatch: function(){return inscription._month;},
	getYearToWatch: function(){return inscription._year;},

	isEmailValid: function(){
		var jQEmail = inscription.getEmailToWatch();
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(jQEmail.val().match(mailformat) || jQEmail.val().length == 0){
			return true;
		}
		inscription.highlightInput(jQEmail);
		console.log("Le format de l'email est invalide.");
		return false;
	},
	isPseudoValid: function(){
		var jQPseudo = inscription.getPseudoToWatch();
		var unauthorizedChars = /[^a-zA-Z-0-9]/;
		if(jQPseudo.val().match(unauthorizedChars) || jQPseudo.val().length == 0){
			inscription.highlightInput(jQPseudo);
			console.log("Le pseudo ne doit contenir que des caractères alphanumériques.");
			return false;
		}
		return true;
	},
	isPasswordValid: function(jQPassword){
		//var unauthorizedChars = /[^a-zA-Z-0-9]/;
		//if(jQPassword.val().match(unauthorizedChars)){
		if(jQPassword.val().length < 6){
			inscription.highlightInput(jQPassword);
			console.log("Mot de passe inférieur à 6 caractères.");
			return false;
		}
		return true;
	},
	isBirthValid: function(){
		var d = inscription.getDayToWatch().val();
		var m = inscription.getMonthToWatch().val();
		var y = inscription.getYearToWatch().val();

		if (isNaN(Number(d)))
			return false;
		if (isNaN(Number(m)))
			return false;
		if (isNaN(Number(y)))
			return false;
		
		try {
			// create the date object with the values sent in (month is zero based)
			var dt = new Date(y,m-1,d,0,0,0,0);

			// get the month, day, and year from the object we just created 
			var mon = dt.getMonth() + 1;
			var day = dt.getDate();
			var yr  = dt.getYear() + 1900;

			// if they match then the date is valid
			if ( mon == m && yr == y && day == d )
				return true;
			console.log("La date de naissance n'est pas valide.");
			return false;
		}
		catch(e) {
			console.log("La date de naissance est invalide.");
			return false;
		}
		
		return true;
	},
	isCguAccepted: function(){
		if(inscription.getCguToWatch()[0].checked){
			return true;
		}
		alert("Vous devez accepter les cgu !");
		return false;
	},
	doPasswordsMatch: function(){
		if(inscription.getPassToWatch().val() == inscription.getPassCheckToWatch().val())
			return true;
		console.log("Les mots de passe ne correspondents pas entre eux.");
		return false;
	},
	highlightInput: function(jQinput){
		jQinput.addClass('failed-input');
		// jQinput.val('');
		jQinput.focus();
		inscription.removeFailAnimationEvent(jQinput);
	},
	popSuccessMsg: function(){
		var container = $('<div class="absolute index-modal-login"></div>');
	},
	treatParsedJson: function(obj){
		if(obj.success){
			popup.init('Un email de confirmation a été envoyé à l\'adresse '+inscription.getEmailToWatch().val());
		}
		else{
			if(obj.errors){
				if(obj.errors.pseudo){
					popup.init(obj.errors.pseudo);
				}
				else if(obj.errors.email){
					popup.init(obj.errors.email);
				}
				else{
					popup.init(obj.errors);
					// ("Ton formulaire n'a pu être validé\nCheck la console pour plus de détails");
				}			
			}
		}
	},


	/*### Send Form event ###*/
	sendEventCallback: function(obj){
		if(obj != false){
	    	inscription.treatParsedJson(obj);
	    }
	},
	sendEvent: function(){		
		var _form = inscription.getFormToWatch();
		inscription._pseudo = _form.find("input[name='pseudo']");
		inscription._cgu = _form.find("input[name='cgu']");
		inscription._btn = _form.find("button");
		inscription._birth_day = _form.find("input[name='day']");
		inscription._birth_month = _form.find("input[name='month']");
		inscription._birth_year = _form.find("input[name='year']");

		_form.submit(function(event) {
			event.preventDefault();
			return false;
		});

		inscription._btn.click(function(event) {
			if (
				inscription.isEmailValid() 
				&& inscription.isPseudoValid()
				&& inscription.isPasswordValid(inscription.getPassToWatch())
				&& inscription.isPasswordValid(inscription.getPassCheckToWatch())
				&& inscription.doPasswordsMatch()
				&& inscription.isBirthValid()
				&& inscription.isCguAccepted()
			) {
				ajaxWithDataRequest(
					'index/inscription', 
					'POST', 
					{
						pseudo  		: inscription.getPseudoToWatch().val(),
					    email			: inscription.getEmailToWatch().val(),
					    password		: inscription.getPassToWatch().val(),
					    password_check	: inscription.getPassCheckToWatch().val(),
					    day				: inscription.getDayToWatch().val(),
					    month			: inscription.getMonthToWatch().val(),
					    year			: inscription.getYearToWatch().val(),
					    cgu				: inscription.getCguToWatch().val()
					},
					inscription.sendEventCallback
				);
			};
			event.preventDefault();
			return false;
		});

	},

	/*### Remove Animation on keyup event ###*/
	removeFailAnimationEvent: function(jQInput){
		// Le one() permet de ne declencher l'event (keyup ici) qu'une seule fois puis de le supprimer automatiquement
		jQInput.one('keyup', function() {
			jQInput.removeClass('failed-input');
		});
	}
}

var connection = {
	init: function(){
		connection.setFormToWatch();
		if(connection.getFormToWatch() instanceof jQuery){
			connection.sendEvent();
		};		
	},
	setFormToWatch: function(){connection._form = jQuery("#login-form");},
	getFormToWatch: function(){return connection._form;},
	isEmailValid: function(jQEmail){
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(jQEmail.val().match(mailformat) || jQEmail.val().length == 0){
			return true;
		}
		connection.highlightInput(jQEmail);
		return false;
	},
	isPasswordValid: function(jQPassword){
		var unauthorizedChars = /[^a-zA-Z-0-9]/;
		if(jQPassword.val().match(unauthorizedChars) || jQPassword.val().length == 0){
			connection.highlightInput(jQPassword);
			return false;
		}
		return true;
	},
	highlightInput: function(jQinput){
		jQinput.addClass('failed-input');
		jQinput.val('');
		jQinput.focus();
		connection.removeFailAnimationEvent(jQinput);
	},
	treatParsedJson: function(obj){
		if(obj != false){
			if(obj.connected){
				location.reload();
			}
			else{
				connection.highlightInput(connection._email);
				connection.highlightInput(connection._password);
				if(obj.errors.inputs){
					// missing input !
					alert("you are missing an input");
				}
				else if(obj.errors.user){
					// email and pass don't match OU BAN
					alert(obj.errors.user);
				}
			}
		}		
	},


	/*### Send Form event ###*/
	sendEvent: function(){
		var _form = connection.getFormToWatch();
		var _email = _form.find("input[name='email']");
		var _password = _form.find("input[name='password']");
		var _btn = _form.find('button');

		connection._email = _email;
		connection._password = _password;
		connection._btn = _btn;

		_form.submit(function(event) {
			event.preventDefault();
			return false;
		});

		_btn.click(function(event) {
			if (connection.isEmailValid(_email) && connection.isPasswordValid(_password)) {
				ajaxWithDataRequest(
					'index/connection', 
					'POST', 
					{
						email: _email.val(),
				  		password: _password.val()
					},
					connection.treatParsedJson
				);
			};
			event.preventDefault();
			return false;
		});

	},

	/*### Remove Animation on keyup event ###*/
	removeFailAnimationEvent: function(jQInput){
		// Le one() permet de ne declencher l'event (keyup ici) qu'une seule fois puis de le supprimer automatiquement
		jQInput.one('keyup', function() {
			jQInput.removeClass('failed-input');
		});
	}
}
var deconnection = {
	init: function(){
		deconnection.setBtnToWatch();
		if(deconnection.getBtnToWatch() instanceof jQuery){
			deconnection.clickEvent();			
		};		
	},
	setBtnToWatch: function(){
		deconnection._btn = jQuery("#nav-deconnection");
	},
	getBtnToWatch: function(){return deconnection._btn;},
	clickEventCallback: function(){
		location.reload();
	},
	clickEvent: function(){
		var _deconnection = deconnection;
		var _btn = deconnection._btn;
		_btn.click(function(event) {
			ajaxWithDataRequest(
				'index/deconnection', 
				'POST', 
				{},
				deconnection.clickEventCallback
			);
		});
	}
}


var cookie = {
	init : function(){
		cookie.setBtnCookie();
		cookie.setCookieInfo();
		cookie.postCookie();
	},
	setBtnCookie : function(){
		cookie._btnCookie = jQuery('#cookieaccept');
	},
	setCookieInfo : function(){
		cookie._cookieInfo = jQuery('#cookie_info');
	},
	getBtnCookie : function(){
		return cookie._btnCookie;
	},
	getCookieInfo : function(){
		return cookie._cookieInfo;
	},
	postCookieCallback: function(obj){
		cookie.getCookieInfo().slideUp();
	},
	postCookie : function(){
		var allData = {validation : "1"};
		cookie.getBtnCookie().on("click", function(){
			ajaxWithDataRequest(
				'index/acceptCookie', 
				'POST', 
				allData,
				cookie.postCookieCallback
			);
		});
	}	
};


var contactadmin = {
	init : function(){
		contactadmin.clickFadeInEvent();
		contactadmin.loadMouseUpEvent();
		contactadmin.loadBtnClickEvent();
	},
	checkMessage: function(){
		if( $("#expediteurContactAdmin").val()=="" ){
			popup.init('Une adresse email valide est requise afin que nous puissions vous répondre');
			return false;
		}
		if( $.trim($("#mess_contactAdmin").val())=="" ){
			popup.init('Veuillez ne pas envoyer de message vide');
			return false;
		}
		return true;
	},
	loadBtnClickEventCallback: function(){
		popup.init('Le message a correctement été envoyé');
		$("#wrapperAdmin .sendOk").fadeIn();
	},
	loadBtnClickEventFailCallback: function(){
		$("#wrapperAdmin .sendOk").fadeIn();
	},
	loadBtnClickEvent: function(){
		//Controle des messages
		$("#btn_contactAdmin").click(function(){
			if(contactadmin.checkMessage()){
				ajaxWithDataRequest(
					'index/contactAdmin', 
					'POST', 
					{
						message: $("#mess_contactAdmin").val(),
						expediteur: $("#expediteurContactAdmin").val()
					},
					contactadmin.loadBtnClickEventCallback,
					contactadmin.loadBtnClickEventFailCallback
				);
			}
		});
	},
	clickFadeInEvent: function(){
		//Affichages des popups
		$("#contactAdmin").click(function(){
			$("#wrapperAdmin").fadeIn();
			return false;
		});
	},
	loadMouseUpEvent: function(){
		$(document).mouseup(function(e){
		    var container = $("#wrapperAdmin");
		    if(!container.is(e.target) && container.has(e.target).length === 0) 
		    {
		    	$(".sendOk, .sendError").fadeOut();
		        container.fadeOut();
		    	$("#mess_contactAdmin").val("");
           		$("#expediteurContactAdmin").val("");
		    }
		});
	}
}

initAll.add(navbar.scrollTopDefault);
initAll.add(connection.init);
initAll.add(navbar.init);
initAll.add(deconnection.init);
initAll.add(inscription.init);
initAll.add(checkForJustCreatedAccount);
initAll.add(cookie.init);
initAll.add(contactadmin.init);
window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache
	//(on devrait faire ça idéalement pour tous les events utilisés une seule fois)
	window.removeEventListener('load', load, false);
	scroll.init($(".header-scroll-down"), $('.my-content-wrapper'));
	webpath.init();
});