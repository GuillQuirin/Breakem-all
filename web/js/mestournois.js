"use strict";

var mestournois = {
	_this: this,
	init: function(){
		mestournois.setMesTournoisOngletOrg();
		mestournois.setMesTournoisOngletPart();

		mestournois.requestOrg();
		mestournois.requestPart();
	},
	//Setter
	setMesTournoisOngletOrg : function(){
		this._mesTournoisOngletOrg = jQuery('#mestournois-onglet-organisateur');
	},
	setMesTournoisOngletPart : function(){
		this._mesTournoisOngletPart = jQuery('#mestournois-onglet-participant');
	},
	//Getter
	getMesTournoisOngletOrg : function(){
		return this._mesTournoisOngletOrg;
	},
	getMesTournoisOngletPart : function(){
		return this._mesTournoisOngletPart;
	},
	requestOrg : function(){
		mestournois.getMesTournoisOngletOrg().on("click", function(){
			jQuery.get("mestournois/mestournoisOrg", function(result){
				console.log(result);
			});
		});
	},
	requestPart : function(){
		mestournois.getMesTournoisOngletPart().on("click", function(){
			jQuery.get("mestournois/mestournoisPart", function(result){
				console.log(result);
			});
		});
	}
};

mestournois.init();