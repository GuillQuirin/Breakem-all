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

		// //Si un paramètre GET portant le nom d'une team dans l'URL
  //       if(isset($_GET['team'])){

  //           /*
  //               Initialisation du manager qui va faire office d'intermediaire entre 
  //               le controlleur et la BDD
  //           */
  //           $teamBDD = new teamManager();


  //           /*
  //               Tout élèment (créé par l'utilisateur ou récupéré de la BDD) 
  //               sera stocké dans un objet de type Team (décrit dans team.class.php)    
  //           */

  //           //on définit la liste des $_GET autorisés dans ce tableau (ici uniquement $_GET['team'])
  //           $args = array('team' => FILTER_SANITIZE_STRING );

  //           //Array_filter se débarasse de toute valeur vide ou NULL
  //           $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));
            
  //           //On remplace la clé "team" par "name" pour retrouver la colonne en BDD
  //           if(isset($filteredinputs['team'])){
  //               $filteredinputs['name']=$filteredinputs['team'];
  //               unset($filteredinputs['team']);
  //           }
            
  //           /*
  //               Appel de la méthode getTeam() dans TeamManager pour récupérer 
  //               les données d'une team en BDD ayant les même infos en commun

  //               La méthode getTeam() va retourner les infos dans un objet de type Team

  //               PS: une méthode du manager peut se trouver soit dans ce manager,
  //                   soit sa classe-mère basesql
  //           */

  //           $team = $teamBDD->getTeam($filteredinputs);

  //           // Si $team === FALSE : soit pas de team trouvée, soit pbm de requete            
  //           if($team!==FALSE){
                
  //               //On enregistre dans un tableau le nom de toutes les méthodes
  //               $team_methods = get_class_methods($team);

  //               foreach ($team_methods as $key => $method) {

  //                   //Ce qui nous interesse ici sont les getters
  //                   if(strpos($method, 'get') !== FALSE){

  //                       //On récupère le nom de l'attribut ciblé (ex: 'getName' devient 'name')
  //                       $col = lcfirst(str_replace('get', '', $method));
                        
  //                       //TODO : DYLAN
  //                      // $this->columns[$col] = $team->$method();
                        
  //                       /*
  //                           On crée une variable au nom de l'attribut 
  //                           avec la valeur que lui a renvoyé la BDD
  //                       */
  //                       $v->assign($col, $team->$method());
                                
  //                   }; // Le ; ne gêne pas, ça évite un else{} éventuel

  //               }

  //               //TODO : Apparition du bouton de configuration pour le président de la team
  //               // if(isset($_SESSION[COOKIE_EMAIL]) && $_SESSION[COOKIE_EMAIL]===$team->getEmail())
  //               //     $v->assign('myAccount', 1);
  //           }
  //           else{
  //               $v->assign("err", "1");
  //           }
  //       }
  //       else{
  //           $v->assign("err", "1");
  //       }
  //       $v->setView("team");
    

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
