window.addEventListener('load', function load(){
	// Cette ligne permet la 'supression' de l'event de load pour liberer du cache (on devrait faire ça idéalement pour tous les events utilisés une seule fois) 
	window.removeEventListener('load', load, false);
	tournament.init();
	navbar.preventShrink = true;
});



var tournament = {
	init: function(){
		this.getGameTypes();
	},
	getGameTypes: function(){
		jQuery.ajax({
		  url: 'creationtournoi/getGameTypes',
		  type: 'POST',
		  // dataType: 'json',
		  data: {param1: 'value1'},
		  complete: function(xhr, textStatus) {
		    //called when complete
		  },
		  success: function(data, textStatus, xhr) {
		    console.log(data);
		  },
		  error: function(xhr, textStatus, errorThrown) {
		    console.log("request error !! : \t " + errorThrown);
		  }
		});
		
	}
}