"use strict";

var loading = {
	init : function(){
		loading.script(window.location.pathname + "/web/js/less.min.js", loading.fade('.testloading'));
	},
	script : function(url, callback){
	 	var head = document.getElementsByTagName('head')[0];
	    var script = document.createElement('script');
	    script.type = 'text/javascript';
	    script.src = url;
	    script.onreadystatechange = callback;
	    script.onload = callback;
	    head.appendChild(script);
	},
	fade : function(selector){
		jQuery(selector).fadeOut();
	}
}
