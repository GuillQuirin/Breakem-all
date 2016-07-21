"use strict";

window.addEventListener('load', function load(){
	window.removeEventListener('load', load, false);
	mestournois.init();
});

var mestournois = {
	_this: this,
	init: function(){
		//Setter
		mestournois.setMesTournoisOngletOrg();
		mestournois.setMesTournoisOngletPart();
		mestournois.setMesTournoisIhm();

		//Onglet
		mestournois.onClick(mestournois.getMesTournoisOngletOrg());
		mestournois.onClick(mestournois.getMesTournoisOngletPart());

		//Request
		mestournois.requestOrgDefault();
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
	setMesTournoisIhm : function(){
		this._mesTournoisIhm = jQuery('.mestournois-ihm');
	},
	//Getter
	getMesTournoisIhm : function(){
		return this._mesTournoisIhm;
	},
	getMesTournoisOngletOrg : function(){
		return this._mesTournoisOngletOrg;
	},
	getMesTournoisOngletPart : function(){
		return this._mesTournoisOngletPart;
	},
	requestOrgDefault : function(){
		jQuery.get("mestournois/mestournoisOrg", function(result){
			mestournois.getMesTournoisIhm().html(result);
		});
	},
	requestOrg : function(){
		mestournois.getMesTournoisOngletOrg().on("click", function(){
			jQuery.get("mestournois/mestournoisOrg", function(result){
				mestournois.getMesTournoisIhm().html(result);
			});
		});
	},
	requestPart : function(){
		mestournois.getMesTournoisOngletPart().on("click", function(){
			jQuery.get("mestournois/mestournoisPart", function(result){
				mestournois.getMesTournoisIhm().html(result);
			});
		});
	},
	onClick : function(btnClick){
		btnClick.click(function(){
			jQuery(".admin-onglet-li").removeClass('active');
			jQuery(this).addClass('active');
		});
	},
};

