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

		//Liste Tournois
		$obj = new tournoiManager();
		$listetournois = $obj->getCurrentTournament();
		if(!empty($listetournois)){
			$v->assign("listeTournois", $listetournois);
		}
		
		//Pagination
		$obj = new typegameManager();
		$pagination = $obj->getAllTypes();
		if(!empty($pagination)){
			$v->assign("pagination", $pagination);
		}

		//Meilleurs Jeux
		$obj = new gameManager();
		$bestGames = $obj->bestGames();
		if(!empty($bestGames)){
			$v->assign("bestGames", $bestGames);
		}

		$v->setView("Index");
	}


}
