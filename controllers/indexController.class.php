<?php
class indexController extends template{
	public function indexAction($requiredPosts){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "index");
		$v->assign("js", "index");

		//Categorie
		$obj = new typegameManager();
		$typeJeu = $obj->getAllTypes();
		if(!empty($typeJeu)){
			$v->assign("categorie", $typeJeu);	
		}

		/*##### ON N'OUVRE PAS DEUX CONNECTIONS POUR UN MM MANAGER*/
		//Pagination
		$pagination = $obj->getAllTypes();
		if(!empty($pagination)){
			$v->assign("pagination", $pagination);
		}

		//Liste Tournois
		$obj = new tournamentManager();
		$listetournois = $obj->getUnstartedTournaments();
		if(!!($listetournois)){
			$v->assign("listeTournois", $listetournois);
		}
		

		

		//Meilleurs Jeux
		$obj = new gameManager();
		$bestGames = $obj->getBestGames();
		if(!empty($bestGames)){
			$v->assign("bestGames", $bestGames);
		}

		$v->setView("index");
	}


}
