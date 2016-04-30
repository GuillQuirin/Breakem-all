window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	style.init();
	gameTypesChoice.init();
	navbar.preventShrink = true;
});



var style = {
	init: function(){
		this.setTitleContainer();
		this.setContainer();
		this.setBtn();
		if(!(this.getTitleContainer() instanceof jQuery)
			|| !(this.getContainer() instanceof jQuery)
			|| !(this.getBtn() instanceof jQuery)){
			console.log("Title || Container || Btn not found ");
			return false;
		}
		this.setTitleContainerMargin();
		this.setBtnMargin();
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
	getBtn: function(){return this._btn;}
}

var gameTypesChoice = {
	init: function(){
		this.getGameTypes();
	},
	getGameTypes: function(){
		jQuery.ajax({
		  url: 'creationtournoi/getGameTypes',
		  type: 'POST',
		  // data: {param1: 'value1'},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    var obj = tryParseData(data);
		    console.log(obj.types);
		    for(var prop in obj.types){
		    	console.log(prop);
		    }
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
		
	}
}