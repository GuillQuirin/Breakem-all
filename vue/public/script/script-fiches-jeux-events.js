function TournoisEventManager(){
	teMan = this;
};
TournoisEventManager.prototype.menuUnroll = function(){
	var menus = document.querySelectorAll('.menu-opener');
	var l = menus.length;

	for (var i = 0; i < l; i++) {
		menus[i].addEventListener('click', function(e){
			var opener = e.target;
			while(opener.classList.toString().indexOf('menu-opener') === -1){
				opener = opener.parentNode;
			}
			console.log(opener);
			opener.classList.toggle('menu-open');
		});
	};
};
TournoisEventManager.prototype.method_name = function(first_argument) {
	// body...
};
var teM = new TournoisEventManager();