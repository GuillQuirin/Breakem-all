"use strict";

window.addEventListener('load', function load(){
	window.removeEventListener('load', load, false);
	onglet.init();
	platformModule.init();
});

var onglet = {
	_this: this,
	init : function(){
		onglet.setAdminOngletPlatforms();
		onglet.setAdminOngletMembres();
		onglet.setAdminOngletReports();
		onglet.setAdminOngletTeams();
		onglet.setAdminOngletGames();
		onglet.setAdminOngletGametype();
		onglet.setAdminOngletComment();
		onglet.setAdminOngletTournament();

		onglet.setAdminPlatformsWrapper();
		onglet.setAdminMembresWrapper();
		onglet.setAdminReportsWrapper();
		onglet.setAdminTeamsWrapper();
		onglet.setAdminGameWrapper();
		onglet.setAdminGametypeWrapper();
		onglet.setAdminCommentWrapper();
		onglet.setAdminTournamentWrapper();

		onglet.onClick(onglet.getAdminOngletPlatforms(), onglet.getAdminPlatformsWrapper());
		onglet.onClick(onglet.getAdminOngletMembres(), onglet.getAdminMembresWrapper());
		onglet.onClick(onglet.getAdminOngletReports(), onglet.getAdminReportsWrapper());
		onglet.onClick(onglet.getAdminOngletTeams(), onglet.getAdminTeamsWrapper());
		onglet.onClick(onglet.getAdminOngletGame(), onglet.getAdminGameWrapper());
		onglet.onClick(onglet.getAdminOngletGametype(), onglet.getAdminGametypeWrapper());
		onglet.onClick(onglet.getAdminOngletComment(), onglet.getAdminCommentWrapper());
		onglet.onClick(onglet.getAdminOngletTournament(), onglet.getAdminTournamentWrapper());
	},

	//Setter
	setAdminOngletPlatforms : function(){
		this._adminOngletPlatforms = jQuery('#admin-onglet-platforms');
	},
	setAdminOngletMembres : function(){
		this._adminOngletMembres = jQuery('#admin-onglet-membres');
	},
	setAdminOngletReports : function(){
		this._adminOngletReports = jQuery('#admin-onglet-reports');
	},
	setAdminOngletTeams : function(){
		this._adminOngletTeams = jQuery('#admin-onglet-team');
	},
	setAdminOngletGames : function(){
		this._adminOngletGames = jQuery('#admin-onglet-games');
	},
	setAdminOngletGametype : function(){
		this._adminOngletGametype = jQuery('#admin-onglet-gametype');
	},
	setAdminOngletComment : function(){
		this._adminOngletComment = jQuery('#admin-onglet-comment');
	},
	setAdminOngletTournament : function(){
		this._adminOngletTournament = jQuery('#admin-onglet-tournament');
	},



	setAdminPlatformsWrapper : function(){
		this._adminPlatformsWrapper = jQuery("#admin-onglet-platforms-wrapper");
	},
	setAdminMembresWrapper : function(){
		this._adminMembresWrapper = jQuery("#admin-onglet-membres-wrapper");
	},
	setAdminReportsWrapper : function(){
		this._adminReportsWrapper = jQuery("#admin-onglet-reports-wrapper");
	},
	setAdminTeamsWrapper : function(){
		this._adminTeamsWrapper = jQuery("#admin-onglet-team-wrapper");
	},
	setAdminGameWrapper : function(){
		this._adminGamesWrapper = jQuery("#admin-onglet-games-wrapper");
	},
	setAdminGametypeWrapper : function(){
		this._adminTeamsWrapper = jQuery("#admin-onglet-gametype-wrapper");
	},
	setAdminCommentWrapper : function(){
		this._adminTeamsWrapper = jQuery("#admin-onglet-comment-wrapper");
	},
	setAdminTournamentWrapper : function(){
		this._adminTeamsWrapper = jQuery("#admin-onglet-tournament-wrapper");
	},



	//Getter
	getAdminOngletPlatforms : function(){
		return this._adminOngletPlatforms;
	},
	getAdminOngletMembres : function(){
		return this._adminOngletMembres;
	},
	getAdminOngletReports : function(){
		return this._adminOngletReports;
	},
	getAdminOngletTeams : function(){
		return this._adminOngletTeams;
	},
	getAdminOngletGame : function(){
		return this._adminOngletGames;
	},
	getAdminOngletGametype : function(){
		return this._adminOngletGametype;
	},
	getAdminOngletComment : function(){
		return this._adminOngletComment;
	},
	getAdminOngletTournament : function(){
		return this._adminOngletTournament;
	},




	getAdminPlatformsWrapper : function(){
		return this._adminPlatformsWrapper;
	},
	getAdminMembresWrapper : function(){
		return this._adminMembresWrapper;
	},
	getAdminReportsWrapper : function(){
		return this._adminReportsWrapper;
	},
	getAdminTeamsWrapper : function(){
		return this._adminTeamsWrapper;
	},
	getAdminGameWrapper : function(){
		return this._adminGamesWrapper;
	},
	getAdminGametypeWrapper : function(){
		return this._adminGametypeWrapper;
	},
	getAdminCommentWrapper : function(){
		return this._adminCommentWrapper;
	},
	getAdminTournamentWrapper : function(){
		return this._adminTournamentWrapper;
	},



	onClick : function(btnClick, ongletSelector){
		btnClick.click(function(){
			jQuery(".admin-onglet-li").removeClass('active');
			jQuery(this).addClass('active');
			jQuery(".admin-wrapper").css('display', 'none');
			onglet.show(ongletSelector);
		});
	},
	hide : function(selector){
		selector.fadeOut();
	},
	show : function(selector){
		selector.fadeIn();
	}
};

var platformModule = {
	init : function(){
		platformModule.setAdminDataIhm();	
		platformModule.createPlatformsIhm();
	},

	//Setter
	setAdminDataIhm : function(){
		this._adminDataIhm = jQuery('.admin-data-ihm');
	},	

	//Getter
	getAdminDataIhm : function(){
		return this._adminDataIhm;
	},

	ihmElemHover : function(){
		platformModule.getAdminDataIhm().hover(
		  function() {
		    jQuery(this).find('.admin-data-ihm-btn').removeClass( "hidden" );
		  }, function(e) {
		    jQuery(this).find('.admin-data-ihm-btn').addClass( "hidden" );
		  }
		);
	}	
};

//Validation avec tous les id qui commence par validate-form-
$("button[id^='validate-change-']" ).on('click', function() {
	//Recherche le formulaire le plus proche pour valider
    $(this).closest('form').submit();
});



function setStatut(pseudo, value){
	jQuery.ajax({
	 	url: "admin/updateUserStatus",
	 	type: "POST",
	 	data : "pseudo="+pseudo+"&status="+value,

	 	error: function(result){
	 		alert("non");
	 	}
	});
}


function deleteReport(id){
	if(confirm("Souhaitez vous supprimer cet avertissement ?")){
		jQuery.ajax({
		 	url: "admin/DeleteReports",
		 	type: "POST",
		 	data : "id="+id,
		 	success: function(result){
		 		alert(result);
		 	},
		 	error: function(result){
		 		alert("non");
		 	}
		});
	}
}

