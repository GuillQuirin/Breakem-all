window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	teamcreation.init();
});


var teamcreation = {
	init: function(){
		this.setFormToWatch();
		if(this.getFormToWatch() instanceof jQuery){
			this.loadSendEvent();
		};		
	},
	setFormToWatch: function(){this._form = jQuery("#teamcreation-form");},
	getFormToWatch: function(){return this._form;},
	isContentValid: function(jQel, minLen, maxLen, additionalBannedChars){
		var unauthorizedChars = "[^a-zA-Z-0-9_\-"+additionalBannedChars+"]";

		var curVal = jQel.val();
		curVal = curVal.trim();
		curVal = curVal.replace(/  /g, " ");
		jQel.val(curVal);
		if(curVal.length < minLen || curVal.length > maxLen || curVal.match(unauthorizedChars)){
			this.highlightInput(jQel);
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
		console.log("json successfully parsed !");
		console.log(obj);
		/*if(obj.connected){
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
		}*/
	},


	/*### Send Form event ###*/
	loadSendEvent: function(){
		var _this = this;
		var _form = this.getFormToWatch();
		var _name = _form.find("input[name='name']");
		var _slogan = _form.find("input[name='slogan']");
		var _submitBtn = _form.find("button");
		var _description = _form.find("textarea[name='description']");

		this._name = _name;
		this._slogan = _slogan;
		this._description = _description;

		_submitBtn.click(function(event) {
			if (_this.isContentValid(_name, 4, 25, "") && _this.isContentValid(_slogan, 10, 50, " ") && _this.isContentValid(_description, 10, 250, " ")) {
				jQuery.ajax({
				  url: 'team/verify',
				  type: 'POST',
				  data: {
				  	name: _name.val(),
				  	slogan: _slogan.val(),
				  	description: _description.val()
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
				    event.preventDefault();
				    return false;
				  }
				});
				event.preventDefault();
				return false;
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
