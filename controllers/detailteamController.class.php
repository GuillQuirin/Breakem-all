<?php

class detailteamController extends template{

	public function detailteamAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "detailteam");
		$v->assign("js", "detailteam");
		$v->assign("title", "Team ");
		$v->assign("content", "Team ");
		$v->setView("detailteam");

		if(isset($_GET['name'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$teamBDD = new teamManager();

            /*
                Tout élèment (créé par l'utilisateur ou récupéré de la BDD) 
                sera stocké dans un objet de type Team (décrit dans team.class.php)    
            */

			$team = $teamBDD->getTeamTest(array('name'=>'name'));

			// Si $user === FALSE : soit pas de user trouvé, soit pbm de requete

			if($team!==FALSE){

				$team_methods = get_class_methods($team);
				foreach ($team_methods as $key => $method) {
					if(strpos($method, 'get') !== FALSE){
						$col = lcfirst(str_replace('get', '', $method));
						$this->columns[$col] = $team->$method();
						$v->assign($col, $team->$method());
					};
				}

				
			}
			else{
				$v->assign("err", "1");
			}
		}
		else{
			$v->assign("err", "1");
		}
		$v->setView("detailteam");
	}

  /* public function updateUserTeamAction(){
        if($_idTeam == ){

        }
    }*/
}
