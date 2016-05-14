<?php

class detailteamController extends template{

	public function detailteamAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "detailteam");
		$v->assign("js", "detailteam");
		$v->assign("title", "Team <<name>>");
		$v->assign("content", "Team <<name>>");
		$v->setView("detailteam");

		if(isset($_GET['name'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$teamBDD = new teamManager();

			// $args = array('name' => FILTER_SANITIZE_STRING );
			// $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

			$team = $teamBDD->getTeamTest(array('name'=>'1'));

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

	
}
