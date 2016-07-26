"use strict";

window.addEventListener('load', function load(){
	window.removeEventListener('load', load, false);
	tournoiModule.init();
});

var tournoiModule = {	
	_this: this,
	init: function(){
		//Setter
		tournoiModule.setAdminDataRe();
		tournoiModule.setAdminSearchInput();
		tournoiModule.setDataIhm();

		//Search
		tournoiModule.searchRequest();

		//Pagination
		//pagi();		
	},

	//Setter
	setAdminSearchInput : function(){
		this._adminSearchInput = jQuery('.admin-search-input');
	},
	setDataIhm : function(){
		this._dataIhm = jQuery('.classement-data-ihm');
	},
	setAdminDataRe : function(){
		this._adminDataRe = jQuery('.admin-data-re');
	},

	//Getter
	getDataIhm : function(){
		return this._dataIhm;
	},
	getAdminSearchInput : function(){
		return this._adminSearchInput;
	},
	getAdminDataRe : function(){
		return this._adminDataRe;
	},
	//Search Delay
	searchValue : function(callback){
		tournoiModule.getAdminSearchInput().parent().on("submit", function(ev){
			ev.preventDefault();
			return false;
		});
		if(callback){
			tournoiModule.getAdminSearchInput().on('keypress', function() {
				setTimeout(function(){
					if(tournoiModule.getAdminSearchInput().val())
		    			callback(tournoiModule.getAdminSearchInput().val());
		    		else
		    			callback("undefined");
				}, 2000)
			});
		}
	},
	//Request Search
	searchRequest : function(){
		tournoiModule.searchValue(function(value){
			//console.log(value);
			if(value && value !== "undefined"){
				var data = {pseudo : value};
				jQuery.ajax({
					url: "admin/getUserByPseudo", 				
					type: "POST",
					data: data,
					success: function(result){
						console.log(result);

						//Check si dans le controlleur j'ai renvoyé un json ou un undefined
						if(!(wordInString(result, "undefined"))){
							//console.log(result);
							var userArr = jQuery.parseJSON(result);	
							//console.log(userArr);
							tournoiModule.getDataIhm().removeClass('hidden');
							//On affiche les elements présents dans le tableau
							if(userArr.length == 1){
								//console.log(userArr[0].name);
						 		var myRDiv = tournoiModule.getAdminDataRe().find(".membre-pseudo-g:not(:contains(" + userArr[0].pseudo + "))").parent().parent().parent();
						 		myRDiv.addClass('hidden');
						 	}else if(userArr.length > 1){
						 		//Création d'une string
						 		var fullStringContains = "";
						 		//Pour chaque element du tableau on ajoute un contains String
						 		//GAFFE A LA VIRGULE 
						 		jQuery.each(userArr, function(indexArr, fieldArr){
						 			console.log(indexArr);
						 			if(indexArr !== userArr.length-1)
						 				fullStringContains += ":contains(" + fieldArr.pseudo + "),";
						 			else if (indexArr == userArr.length-1)
						 				fullStringContains += ":contains(" + fieldArr.pseudo + ")";
					 			});

					 			console.log(fullStringContains);
					 			//Finnalement on ajout la string au find, puis on ajoute la classe hidden
					 			var myRDiv = tournoiModule.getAdminDataRe().find(".membre-pseudo-g:not(" + fullStringContains + ")").parent().parent().parent();
					 			console.log(myRDiv);
					 			myRDiv.addClass('hidden');
					 		}							
						}else{
							tournoiModule.getDataIhm().removeClass('hidden');
						}
					},
				 	error: function(result){
						console.log(result);	
						tournoiModule.getDataIhm().removeClass('hidden');
				 	}
				});
			}else{
				tournoiModule.getDataIhm().removeClass('hidden');
			}
		});
	}	
};

/*function pagi(){



    var show_per_page = 5;  
    var number_of_items = $('#liste-derniers-classement').children().size();  
    var number_of_pages = Math.ceil(number_of_items/show_per_page);  

    $('#current_page').val(0);  
    $('#show_per_page').val(show_per_page);  
  
    var navigation_html = '<a class="previous_link" href="javascript:previous();">Précèdent</a>';  
    var current_link = 0;  
    while(number_of_pages > current_link){  
        navigation_html += '<a class="page_link" href="javascript:go_to_page(' + current_link +')" longdesc="' + current_link +'">';
        	navigation_html += '<li class="border_menu" numberpage="'+current_link+'">'+ (current_link + 1) +'</li>';
        navigation_html += '</a>';  
        current_link++;  
    }  
    navigation_html += '<a class="next_link" href="javascript:next();">Suivant</a>';  
  

    $('#page_navigation').html(navigation_html);  
  

    $('#page_navigation .page_link:first').addClass('active_page');  
    $('#page_navigation .page_link:first li.border_menu').addClass('active_menu');  
  

    $('#liste-derniers-classement').children().css('display', 'none');  
  
  
    $('#liste-derniers-classement').children().slice(0, show_per_page).css('display', 'flex'); 
}


function previous(){  
  
    var new_page = parseInt($('#current_page').val()) - 1;  

    if($('.active_page').prev('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  
  
function next(){  
    var new_page = parseInt($('#current_page').val()) + 1;  

    if($('.active_page').next('.page_link').length==true){  
        go_to_page(new_page);  
    }  
  
}  

function go_to_page(page_num){  

    var show_per_page = parseInt($('#show_per_page').val());  
    var start_from = page_num * show_per_page;   
    var end_on = start_from + show_per_page;  

  	$("li.border_menu").removeClass('active_menu');
  	$("li.border_menu[numberpage='"+page_num+"']").addClass('active_menu');


    $('#liste-derniers-classement').children().css('display', 'none').slice(start_from, end_on).css('display', 'flex');  
  
 
    $('.page_link[longdesc=' + page_num +']').addClass('active_page').siblings('.active_page').removeClass('active_page');  
  

    $('#current_page').val(page_num);  
}*/


