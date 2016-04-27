
"use strict";

var navbar = {
    init: function(){        
		navbar.shrink();      
        navbar.openNavbarSide();
        navbar.search.toggle();
        navbar.search.close();
        navbar.form.subscribe();
        navbar.form.login();
        navbar.form.closeFormKey();
        navbar.form.closeFormClick();
    },
    shrink: function(){

        $(window).scroll(function(){
            if($(window).scrollTop() > 50){
                $("#navbar").removeClass('full');
                $("#navbar").addClass('shrink');
            }else{
                $("#navbar").removeClass('shrink');
                $("#navbar").addClass('full');
            }
        });
    },
    openNavbarSide : function(){
        $('#navbar-toggle').on('click', function(){
            if($('.navbar-side-menu').hasClass('navbar-collapse')){
                $('.navbar-side-menu').removeClass('navbar-collapse');
            }else{
                $('.navbar-side-menu').addClass('navbar-collapse');
            }
        });
    },
    search : {
        toggle: function(){

            $(document).on('click', '.search-toggle', function(){
                $('.search-page').removeClass('hidden-fade');
                setTimeout(function() {
                    $(".search-page").removeClass('hidden');
                }, 0);
            });
        },
        close: function(){
            $(document).on('click', '.btn-close', function(e){

                $(e.currentTarget).parents('.search-page').addClass('hidden-fade');
                setTimeout(function() {
                    $(".search-page").addClass('hidden');
                }, 800);
            });
        }
    },
    form : {
        subscribe : function(){
            $('#navbar-login').on('click', function(){
            	$('.index-modal-login').addClass('form-bg-active');
                $('.index-modal').removeClass('hidden-fade');
                setTimeout(function() {
                    $(".index-modal").removeClass('hidden');
                }, 0);
                $('#login-form').removeClass('hidden');
                $('#subscribe-form').addClass('hidden');
            });
        },
        login : function(){
        	$('.index-modal-login').addClass('form-bg-active');
            $('#navbar-inscription').on('click', function(){
                $('.index-modal').removeClass('hidden-fade');
                setTimeout(function() {
                    $(".index-modal").removeClass('hidden');
                }, 0);
                $('#subscribe-form').removeClass('hidden');
                $('#login-form').addClass('hidden');
            });
        },
        closeForm : function(){
            $('.index-modal').addClass('hidden-fade').addClass('fade');        
        },
        closeFormKey: function(){
    	 	$(document).keyup(function(e) {
                if (e.keyCode == 27) {
                    navbar.form.closeForm();
                }
            });
        },
        closeFormClick: function(){
        	$('.index-modal-login').on('click', function(e){
			    if(!$(e.target).is('.inscription_rapide') && !$(e.target).is('.inscription_rapide form, input, button, label, p, a')) {
			    	navbar.form.closeForm()
			    }
			});
        }
    }
};

window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	connection.init();
	navbar.init();
	deconnection.init();
});

/*

<form action="Index/register" method="post">
<label for="pseudo">Pseudo :</label>
<input class="input-default" type="text" id="pseudo" name="pseudo">

<label for="email">E-mail :</label>
<input class="input-default" type="text" id="email" name="email">

<label for="pwd1">Mot de passe : </label>
<input class="input-default" type="password" id="pwd1" name="password">
<label for="pwd2">Confirmation mot de passe : </label>
<input class="input-default" type="password" id="pwd2" name="password_check">
<p id="naissance">Date de naissance:
		<span>
			<input class="input-default" type="number" name="day" placeholder="dd" min="1" max="31">
			<input class="input-default" type="number" name="month" placeholder="mm" min="1" max="12">

*/

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
	getFormToWatch: function(){return this._form;},
	getPseudoToWatch: function(){return this._pseudo;},
	getEmailToWatch: function(){return this._email;},
	getPassToWatch: function(){return this._mdp;},
	getPassCheckToWatch: function(){return this._mdpcheck;},

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
	tryParseServerData: function(rawData){
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
				// email and pass don't match
				alert("password and email don't match");
			}
		}
	},


	/*### Send Form event ###*/
	sendEvent: function(){
		var _this = this;
		var _form = this.getFormToWatch();
		var _email = _form.find("input[name='email']");
		var _password = _form.find("input[name='password']");

		this._email = _email;
		this._password = _password;

		_form.submit(function(event) {
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
				    var obj = _this.tryParseServerData(data);
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
var connection = {
	init: function(){
		this.setFormToWatch();
		if(this.getFormToWatch() instanceof jQuery){
			this.sendEvent();
		};		
	},
	setFormToWatch: function(){this._form = jQuery("#connection-form");},
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
	tryParseServerData: function(rawData){
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
				// email and pass don't match
				alert("password and email don't match");
			}
		}
	},


	/*### Send Form event ###*/
	sendEvent: function(){
		var _this = this;
		var _form = this.getFormToWatch();
		var _email = _form.find("input[name='email']");
		var _password = _form.find("input[name='password']");

		this._email = _email;
		this._password = _password;

		_form.submit(function(event) {
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
				    var obj = _this.tryParseServerData(data);
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
		this._btn = jQuery("#deconnection-btn");
	},
	getBtnToWatch: function(){return this._btn;},

	clickEvent: function(){
		_this = this;
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

				}
			});
		});
	}
}
