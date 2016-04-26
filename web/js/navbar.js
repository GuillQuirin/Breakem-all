function ShrinkNavbar(){
	$window = $(window);
	$window.scroll(function(){
		if($window.scrollTop() > 50){
			$("#navbar").removeClass('full');
			$("#navbar").addClass('shrink');
		}else{
			$("#navbar").removeClass('shrink');
			$("#navbar").addClass('full');
		}
	})
}

function ToggleNavbar(){
	$('#navbar-toggle').on('click', function(){
		if($('.navbar-side-menu').hasClass('navbar-collapse')){
			$('.navbar-side-menu').removeClass('navbar-collapse');
		}else{
			$('.navbar-side-menu').addClass('navbar-collapse');
		}
	});
}

$(document).on('click', '.btn-close', function(e){
    $(e.currentTarget).parents('.search-page').addClass('hidden-fade');
    setTimeout(function() {
        $(".search-page").addClass('hidden');
    }, 800);
});   

$(document).on('click', '.search-toggle', function(){
    $('.search-page').removeClass('hidden-fade');
    setTimeout(function() {
        $(".search-page").removeClass('hidden');
    }, 0);
});

window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	ToggleNavbar();
	$(window).scroll(function(){
		ShrinkNavbar();
	});
	connection.init();
	// deconnection.init();
});


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
		this.setFormToWatch();
		if(this.getFormToWatch() instanceof jQuery){
			this.setButtonToWatch();
			if(this.getButtonToWatch() instanceof jQuery){
				this.clickEvent();
			};			
		};		
	},
	setFormToWatch: function(){
		this._form = jQuery("#deconnection-form");
	},
	setButtonToWatch: function(){
		this._btn = _form.find('btn');
	},
	getButtonToWatch: function(){return this._btn;},
	getFormToWatch: function(){return this._btn;},

	clickEvent: function(){
		_this = this;
		var _btn = this.btn;
		_btn.click(function(event) {
			_this._form.submit();
		});
	}
}
