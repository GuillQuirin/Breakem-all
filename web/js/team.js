
$(document).ready(function () {
	$(".formteam1").submit(function () {

		if ($.trim($(".nameteam").val()) == "" || $.trim($(".nameteam").val()).length < 2 || $.trim($(".nameteam").val()).length > 10) {
			alert("Veuillez entrer un nom de team compris entre 2 et 20 caractères.");
			return false;
		}

		if ($.trim($(".desc-default").val()) == "" || $.trim($(".desc-default").val()).length < 3 || $.trim($(".desc-default").val()).length > 200) {
			alert("Veuillez entrer une description comprise entre 3 et 200 caractères.");
			return false;
		}

	});

});

	//Affichages des popups
	$("#creationTeam").click(function () {
		$(".formteam").fadeIn();

	});

$(document).mouseup(function(e){
	var container = $(".formteam");
	if(!container.is(e.target) && container.has(e.target).length === 0) {
		container.fadeOut();
	}
});

window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	teamcreation.init();
});


var teamcreation = {

	init: function () {

		this.setFormToWatch();
		if (this.getFormToWatch() instanceof jQuery) {
			this.loadSendEvent();
		}
		;
	},
	setFormToWatch: function () {
		this._form = jQuery("#teamcreation-form");
	},
	getFormToWatch: function () {
		return this._form;
	},
	highlightInput: function (jQinput) {
		jQinput.addClass('failed-input');
		jQinput.val('');
		jQinput.focus();
		this.removeFailAnimationEvent(jQinput);
	},
	tryParseServerData: function (rawData) {
		try {
			var obj = jQuery.parseJSON(rawData);
			return obj;
		}
		catch (err) {
			console.log(rawData);
			alert("Problem during server processes \n Check console for details");
		}
		return false;
	},
	treatParsedJson: function (obj) {
		console.log("json successfully parsed !");
		console.log(obj);
		if (obj.success) {
			// rediriger vers la page de la team tout juste créée
		}
		else {
			this.highlightInput(this._password);
			if (obj.errors.nameused) {
				// Le nom est déjà pris en base
				this.highlightInput(this._name);
				alert("Nom de team déjà pris");
			}
			else if (obj.errors.userhasteam) {
				// L'utilisateur a déjà une team!
				alert("Vous êtes déjà dans une équipe");
			}
			else if (obj.errors.creation) {
				// La création de la team a échoué
				alert("La création de la team a échoué, contactez un admin");
			}
		}
	},


	/*### Send Form event ###*/
	loadSendEvent: function () {
		var _this = this;
		var _form = this.getFormToWatch();
		var _name = _form.find("input[name='name']");
		var _slogan = _form.find("input[name='slogan']");
		var _submitBtn = _form.find("button");
		var _description = _form.find("textarea[name='description']");

		this._name = _name;
		this._slogan = _slogan;
		this._description = _description;

		_submitBtn.click(function (event) {
			event.preventDefault();
			jQuery.ajax({
				url: 'team/verify',
				type: 'POST',
				data: {
					name: _name.val(),
					slogan: _slogan.val(),
					description: _description.val()
				},
				complete: function (xhr, textStatus) {
					// console.log("request complted \n");
				},
				success: function (data, textStatus, xhr) {
					var obj = _this.tryParseServerData(data);
					if (obj != false) {
						_this.treatParsedJson(obj);
					}
				},
				error: function (xhr, textStatus, errorThrown) {
					console.log("request error !! : \t " + errorThrown);
					return false;
				}
			});
		});

	},

	/*### Remove Animation on keyup event ###*/
	removeFailAnimationEvent: function (jQInput) {
		// Le one() permet de ne declencher l'event (keyup ici) qu'une seule fois puis de le supprimer automatiquement
		jQInput.one('keyup', function () {
			jQInput.removeClass('failed-input');
		});
	},
	clickFadeInEvent: function () {
		//Affichages des popups
		$("#creationTeam").click(function () {
			$(".formteam").show();

		});

	},

}