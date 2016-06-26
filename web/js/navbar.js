
"use strict";
window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache 
	//(on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	webpath.init();
	
});

function initAll(){
	connection.init();
	navbar.init();
	deconnection.init();
	register.init();
	scroll.init($(".header-scroll-down"), $('.my-content-wrapper'));
	checkForJustCreatedAccount();
	cookie.init();
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
//  Voilà pouruqoi elle est définie en tant que fct générale
function tryParseData(rawData){
	try {
		var obj = jQuery.parseJSON(rawData);
		return obj;
	}
	catch(err) {
		console.log(rawData);
		alert("Problem during server processes \n Check console for details");
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
		this.setServerPath();
	},
	get: function(){return this._path;},
	setServerPath: function(){
		jQuery.ajax({
		  url: 'index/getWebpathAjax',
		  type: 'GET',		  
		  complete: function(xhr, textStatus) {
		    // console.log("request complted \n");
		  },
		  success: function(data, textStatus, xhr) {
		  	var obj = tryParseData(data);
		    if(obj != false){
		    	if(obj.webpath)
		    		this._path = obj.webpath;
		    	else
		    		console.log("webpath couldn't be found");
		    	initAll();
		    }
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
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
		return this.openedPopupModal;
	},
	getOpenedPopupMsg: function(){
		return this.openedPopupMsg;
	},
	setOpenedPopupModal: function(jQel){
		this.openedPopupModal = jQel;
	},
	setOpenedPopupMsg: function(jQel){
		this.openedPopupMsg = jQel;
	},
	closeOldPopup: function(jQModal, jQMsg){
		navbar.form.smoothClosing();
		if(this.getOpenedPopupModal() instanceof jQuery){
			var _this = this;
			this.animationOnGoing = true;
			this.getOpenedPopupMsg().addClass('fadeOutRight');
			setTimeout(function(){
				_this.getOpenedPopupModal().empty();
				_this.getOpenedPopupModal().remove();
				_this.setOpenedPopupModal(false);
				_this.setOpenedPopupMsg(false);
				_this.animationOnGoing = false;
				$('body').css('overflow', 'visible');
				if(jQModal instanceof jQuery && jQMsg instanceof jQuery)
					_this.openNewPopup(jQModal, jQMsg);
			},1000);
		}
		else
			this.openNewPopup(jQModal, jQMsg);
	},
	init: function(message){		
		if(message){
			if(this.animationOnGoing){
				console.log("animation popup deja en cours");
				return;
			}
			var container = $('<div class="index-modal-popup display-flex-column animation fade"></div>');
			var popdivContainer = $('<div class="index-popup-msg display-flex-column animation fadeRight"></div>');
			var subDiv = $('<div class="border-full display-flex-column"></div>')
			var popMsg = $('<p class="title title-4">'+message+'</p>');
			subDiv.append(popMsg);
			popdivContainer.append(subDiv);
			container.append(popdivContainer);
			this.closeOldPopup(container, popdivContainer);
		}
		else
			console.log("aucun contenu reçu dans popup init");
	},
	openNewPopup: function(jQModal, jQMsg){
		$('body').css('overflow', 'hidden');
		$('body').append(jQModal);
		this.setOpenedPopupModal(jQModal);
		this.setOpenedPopupMsg(jQMsg);
		this.associateClosingEvent();
	},
	associateClosingEvent: function(){
		var _this = this;
		this.getOpenedPopupModal().click(function(e){
			if($(e.target).hasClass('index-modal-popup')){
				_this.closeOldPopup();
			};
		});
	}
}

var navbar = {
	_this: this,
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
        navbar.form.closeFormClick();
        navbar.menu();        
    },


    /*##### SETTERS #####*/
    setNavbarEl: function(){
    	this._navEl = $("#navbar");
    },
    setNavToggle: function(){
    	this._navToggle = $('#navbar-toggle');
    },
    setNavSideMenu: function(){
    	this._navSideMenu = $('.navbar-side-menu');
    },
    setNavLogin: function(){
    	this._navLogin = $('#navbar-login');
    },
    setOpenFormAll: function(){
    	this._openFormAll = $('.open-form');
    },
    setNavInscription: function(){
    	this._navInscription = $('#navbar-inscription');
    },
    setSearchPage: function(){
    	this._searchPage = $('.search-page');
    },
    setSearchToggle: function(){
    	this._searchToggle = $('.search-toggle');
    },
    setIndexModal: function(){
    	this._indexModal = $('.index-modal');
    },
    setLoginForm: function(){
    	this._loginForm = $('#login-form');
    },
    setSubscribeForm: function(){
    	this._subscribeForm = $('#subscribe-form');
    },


    /*##### GETTERS #####*/
    getNavbarEl: function(){
    	return this._navEl;
    },
    getNavToggle: function(){
    	return this._navToggle;
    },
    getNavSideMenu: function(){
    	return this._navSideMenu;
    },
    getSearchPage: function(){
    	return this._searchPage;
    },
    getSearchToggle: function(){
    	return this._searchToggle;
    },
    getNavLogin: function(){
    	return this._navLogin;
    },
    getNavInscription: function(){
    	return this._navInscription;
    },
    getIndexModal: function(){
    	return this._indexModal;
    },
    getLoginForm: function(){
    	return this._loginForm;
    },
    getSubscribeForm: function(){
    	return this._subscribeForm;
    },
    getOpenForm: function(){
    	return this._openFormAll;
    },

    preventShrink: false,
    shrink: function(force){
    	if(!this.preventShrink){   		
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
    openNavbarSide : function(){
        this.getNavToggle().on('click', function(){
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
			    if(!$(e.target).is('.inscription_rapide') && !$(e.target).is('.inscription_rapide form, input, button, label,textarea, p, a, img'))
		   			navbar.form.smoothClosing();
			});
        },
        smoothClosing: function(){
        	$('.inscription_rapide').addClass('fadeOutUp').removeClass('fadeDown');
    		setTimeout(function() {
            	navbar.form.closeForm();			    	
        	}, 700);	
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

var register = {
	init: function(){
		this.setFormToWatch();
		if(!(this.getFormToWatch() instanceof jQuery)){
			console.log("Missing form");
			return;
		}
		this.setPseudoToWatch();
		if(!(this.getPseudoToWatch() instanceof jQuery)){
			console.log("Missing pseudo");
			return;
		}
		this.setEmailToWatch();
		if(!(this.getEmailToWatch() instanceof jQuery)){
			console.log("Missing email");
			return;
		}
		this.setPassToWatch();
		if(!(this.getPassToWatch() instanceof jQuery)){
			console.log("Missing pass");
			return;
		}
		this.setPassCheckToWatch();
		if(!(this.getPassCheckToWatch() instanceof jQuery)){
			console.log("Missing passcheck");
			return;
		}
		this.setCguToWatch();
		if(!(this.getCguToWatch() instanceof jQuery)){
			console.log("Missing cgu");
			return;
		}
		this.setDayToWatch();
		if(!(this.getDayToWatch() instanceof jQuery)){
			console.log("Missing day");
			return;
		}
		this.setMonthToWatch();
		if(!(this.getMonthToWatch() instanceof jQuery)){
			console.log("Missing month");
			return;
		}
		this.setYearToWatch();
		if(!(this.getYearToWatch() instanceof jQuery)){
			console.log("Missing year");
			return;
		}
		this.sendEvent();
	},
	setFormToWatch: function(){
		this._form = jQuery("#register-form");
	},
	setPseudoToWatch: function(){
		this._pseudo = this._form.find('input[name="pseudo"]');
	},
	setEmailToWatch: function(){
		this._email = this._form.find('input[name="email"]');
	},
	setPassToWatch: function(){
		this._mdp = this._form.find('input[name="password"]');
	},
	setPassCheckToWatch: function(){
		this._mdpcheck = this._form.find('input[name="password_check"]');
	},
	setCguToWatch: function(){
		this._cgu = this._form.find('input[name="cgu"]');
	},
	setDayToWatch: function(){
		this._day = this._form.find('input[name="day"]');
	},
	setMonthToWatch: function(){
		this._month = this._form.find('input[name="month"]');
	},
	setYearToWatch: function(){
		this._year = this._form.find('input[name="year"]');
	},
	getFormToWatch: function(){return this._form;},
	getPseudoToWatch: function(){return this._pseudo;},
	getEmailToWatch: function(){return this._email;},
	getPassToWatch: function(){return this._mdp;},
	getPassCheckToWatch: function(){return this._mdpcheck;},
	getCguToWatch: function(){return this._cgu;},
	getDayToWatch: function(){return this._day;},
	getMonthToWatch: function(){return this._month;},
	getYearToWatch: function(){return this._year;},

	isEmailValid: function(){
		var jQEmail = this.getEmailToWatch();
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(jQEmail.val().match(mailformat) || jQEmail.val().length == 0){
			return true;
		}
		this.highlightInput(jQEmail);
		console.log("email fail");
		return false;
	},
	isPseudoValid: function(){
		var jQPseudo = this.getPseudoToWatch();
		var unauthorizedChars = /[^a-zA-Z-0-9]/;
		if(jQPseudo.val().match(unauthorizedChars) || jQPseudo.val().length == 0){
			this.highlightInput(jQPseudo);
			console.log("peudo fail");
			return false;
		}
		return true;
	},
	isPasswordValid: function(jQPassword){
		var unauthorizedChars = /[^a-zA-Z-0-9]/;
		if(jQPassword.val().match(unauthorizedChars) || jQPassword.val().length == 0){
			this.highlightInput(jQPassword);
			console.log("pass fail");
			return false;
		}
		return true;
	},
	isBirthValid: function(){
		var d = this.getDayToWatch().val();
		var m = this.getMonthToWatch().val();
		var y = this.getYearToWatch().val();

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
			console.log("birth fail");
			return false;
		}
		catch(e) {
			console.log("birth fail");
			return false;
		}
		
		return true;
	},
	isCguAccepted: function(){
		if(this.getCguToWatch()[0].checked){
			return true;
		}
		alert("Vous devez accepter les cgu !");
		return false;
	},
	doPasswordsMatch: function(){
		if(this.getPassToWatch().val() == this.getPassCheckToWatch().val())
			return true;
		console.log("passwords don't match");
		return false;
	},
	highlightInput: function(jQinput){
		jQinput.addClass('failed-input');
		jQinput.val('');
		jQinput.focus();
		this.removeFailAnimationEvent(jQinput);
	},
	popSuccessMsg: function(){
		var container = $('<div class="absolute index-modal-login"></div>');
	},
	treatParsedJson: function(obj){
		if(obj.success){
			popup.init('Un email de confirmation a été envoyé à l\'adresse '+this.getEmailToWatch().val());
		}
		else{
			if(obj.errors){
				if(obj.errors.pseudo){
					alert(obj.errors.pseudo);
				}
				else if(obj.errors.email){
					alert(obj.errors.email);
				}
				else{
					console.log(obj.errors);
					alert("Ton formulaire n'a pu être validé\nCheck la console pour plus de détails");
				}			
			}
		}
	},


	/*### Send Form event ###*/
	sendEvent: function(){
		var _this = this;
		var _form = this.getFormToWatch();
		this._pseudo = _form.find("input[name='pseudo']");
		this._cgu = _form.find("input[name='cgu']");
		this._btn = _form.find("button");
		this._birth_day = _form.find("input[name='day']");
		this._birth_month = _form.find("input[name='month']");
		this._birth_year = _form.find("input[name='year']");

		_form.submit(function(event) {
			event.preventDefault();
			return false;
		});

		this._btn.click(function(event) {
			if (
				_this.isEmailValid() 
				&& _this.isPseudoValid()
				&& _this.isPasswordValid(_this.getPassToWatch())
				&& _this.isPasswordValid(_this.getPassCheckToWatch())
				&& _this.doPasswordsMatch()
				&& _this.isBirthValid()
				&& _this.isCguAccepted()
			) {
				jQuery.ajax({
				  url: 'index/register',
				  type: 'POST',
				  data: {
					  	pseudo  		: _this.getPseudoToWatch().val(),
					    email			: _this.getEmailToWatch().val(),
					    password		: _this.getPassToWatch().val(),
					    password_check	: _this.getPassCheckToWatch().val(),
					    day				: _this.getDayToWatch().val(),
					    month			: _this.getMonthToWatch().val(),
					    year			: _this.getYearToWatch().val()
				  },
				  complete: function(xhr, textStatus) {
				    // console.log("request complted \n");
				  },
				  success: function(data, textStatus, xhr) {
				  	var obj = tryParseData(data);
				    if(obj != false){
				    	_this.treatParsedJson(obj);
				    }
				  },
				  error: function(xhr, textStatus, errorThrown) {
				    console.log("request error !! : \t " + errorThrown);
				  }
				});
				
				// return true;
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
/* TODO : RAJOUTER CONNECTION SUR ENTREE*/
var connection = {
	init: function(){
		this.setFormToWatch();
		if(this.getFormToWatch() instanceof jQuery){
			this.sendEvent();
		};		
	},
	setFormToWatch: function(){this._form = jQuery("#login-form");},
	getFormToWatch: function(){return this._form;},
	isEmailValid: function(jQEmail){
		var mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
		if(jQEmail.val().match(mailformat) || jQEmail.val().length == 0){
			return true;
		}
		this.highlightInput(jQEmail);
		return false;
	},
	isPasswordValid: function(jQPassword){
		var unauthorizedChars = /[^a-zA-Z-0-9]/;
		if(jQPassword.val().match(unauthorizedChars) || jQPassword.val().length == 0){
			this.highlightInput(jQPassword);
			return false;
		}
		return true;
	},
	highlightInput: function(jQinput){
		jQinput.addClass('failed-input');
		jQinput.val('');
		jQinput.focus();
		this.removeFailAnimationEvent(jQinput);
	},
	tryParseData: function(rawData){
		try {
			var obj = jQuery.parseJSON(rawData);
			return obj;
		}
		catch(err) {
			console.log(rawData);
			alert("Problem during server processes \n Check console for details");
		}
		return false;
	},
	treatParsedJson: function(obj){
		if(obj.connected){
			location.reload();
		}
		else{
			this.highlightInput(this._email);
			this.highlightInput(this._password);
			if(obj.errors.inputs){
				// missing input !
				alert("you are missing an input");
			}
			else if(obj.errors.user){
				// email and pass don't match OU BAN
				alert(obj.errors.user);
			}
		}
	},


	/*### Send Form event ###*/
	sendEvent: function(){
		var _this = this;
		var _form = this.getFormToWatch();
		var _email = _form.find("input[name='email']");
		var _password = _form.find("input[name='password']");
		var _btn = _form.find('button');

		this._email = _email;
		this._password = _password;
		this._btn = _btn;

		_btn.click(function(event) {
			if (_this.isEmailValid(_email) && _this.isPasswordValid(_password)) {
				jQuery.ajax({
				  url: 'index/connection',
				  type: 'POST',
				  data: {
				  	email: _email.val(),
				  	password: _password.val()
				  },
				  complete: function(xhr, textStatus) {
				    // console.log("request complted \n");
				  },
				  success: function(data, textStatus, xhr) {
				    var obj = tryParseData(data);
				    if(obj != false){
				    	_this.treatParsedJson(obj);
				    }
				  },
				  error: function(xhr, textStatus, errorThrown) {
				    console.log("request error !! : \t " + errorThrown);
				  }
				});
				
				// return true;
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
		this.setBtnToWatch();
		if(this.getBtnToWatch() instanceof jQuery){
			this.clickEvent();			
		};		
	},
	setBtnToWatch: function(){
		this._btn = jQuery("#nav-deconnection");
	},
	getBtnToWatch: function(){return this._btn;},

	clickEvent: function(){
		var _this = this;
		var _btn = this._btn;
		_btn.click(function(event) {
			jQuery.ajax({
				url: 'index/deconnection',
				type: 'POST',
				data: {},
				complete: function(xhr, textStatus) {
					location.reload();
				},
				success: function(data, textStatus, xhr) {
				},
				error: function(xhr, textStatus, errorThrown) {
					console.log(errorThrown);
					alert("uh oh serv ...");
				}
			});
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
		this._btnCookie = jQuery('#cookieaccept');
	},
	setCookieInfo : function(){
		this._cookieInfo = jQuery('#cookie_info');
	},
	getBtnCookie : function(){
		return this._btnCookie;
	},
	getCookieInfo : function(){
		return this._cookieInfo;
	},

	postCookie : function(){
		var allData = {validation : "1"};
		cookie.getBtnCookie().on("click", function(){
			jQuery.ajax({
				utl: 'index/acceptCookie',
				type: 'POST',
				data: allData,
				success : function(result){
					cookie.getCookieInfo().slideUp();
				},
				error: function(result){
					throw new Error("Erreur de validation cookie", result);
				}
			});
		});
	}	
};



$(document).ready(function(){
	//Affichages des popups
	$("#contactAdmin").click(function(){
		$("#wrapperAdmin").fadeIn();
		return false;
	});

	//Controle des messages
	$("#btn_contactAdmin").click(function(){
		if($("#mess_contactAdmin").val()==""){
			alert('Veuillez ne pas laisser un message vide.');
		}
		else if($("#expediteurContactAdmin").val()==""){
			alert('Une adresse email valide est requise afin que nous puissions vous répondre.');
		}
		else{
			$.ajax({method: "POST",
					data:{
						message: $("#mess_contactAdmin").val(),
						expediteur: $("#expediteurContactAdmin").val()
					},
					url: "index/contactAdmin", 
					success: function(result){
	            		$("#wrapperAdmin").html("OK");
	        		}
	        	}
	        );
		}
	});
	//return false;
});

$(document).mouseup(function(e)
{
    var container = $("#wrapperAdmin");

    if(!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.fadeOut();
    }
});

