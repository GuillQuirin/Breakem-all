<?php

class detailteamController extends template{

	public function detailteamAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "detailteam");
		$v->assign("js", "detailteam");
		$v->assign("title", "Team - Error");
		$v->assign("content", "Team - Error");
		$v->setView("detailteam");

        if(isset($_GET['name'])){
            //Si le paramètre GET['name'] n'exite pas alors tu me renvoi erreur 1   
            $teamName = new teamManager();
            $nameTeam = $teamName->getNameTeam($_GET['name']);
        }

		//Si un paramètre GET portant le nom d'une team dans l'URL
        if(isset($_GET['name']) && $_GET['name'] != '' && $nameTeam == true){
            $name = $_GET['name'];
            $v->assign("title", "Team - ".$name);
            $v->assign("content", "Team - ".$name);

            //La team courante
            $teamBDD = new teamManager();

            $args = array('name' => FILTER_SANITIZE_STRING );

            $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

            // $team = un objet -> La team de la page
            $team = $teamBDD->getTeam($filteredinputs);
            $v->assign("currentTeam",$team);
            $v->assign("idteam",$team->getId());
            $v->assign("idcreator",$team->getId_user_creator());
            $v->assign("nameteam",$team->getName());
            $v->assign("imgteam",$team->getImg());
            $v->assign("sloganteam",$team->getSlogan());
            $v->assign("descripteam",$team->getDescription());

            //$this : objet du user connecté grâce au template
            $v->assign("currentUser",$this);

            //Liste des membres
            $listemember = $teamBDD->getListMember($name);
            $v->assign("listmember", $listemember);


            //Récupération de l'id de la team du user connecté
            if($this->getConnectedUser()){
               $getIdTeam = $this->getConnectedUser()->getIdTeam();
            }

            //Verification si l'user une Team
            if(!empty($getIdTeam)){
                $infos_team = ['id'=>$getIdTeam];
                //$userTeam = un objet -> Ma team (Team du user connecté)
                $userTeam = $teamBDD->getTeam($infos_team);
                $v->assign("userTeam",$userTeam);
                $v->assign("nameUserTeam", $userTeam->getName());
                //$v->assign('idUserTeam',$userTeam->getId());
            }

            // Si $team === FALSE : soit pas de team trouvée, soit pbm de requete            
            if($team!==FALSE){
                
                //On enregistre dans un tableau le nom de toutes les méthodes
                $team_methods = get_class_methods($team);

                foreach ($team_methods as $key => $method) {

                    //Ce qui nous interesse ici sont les getters
                    if(strpos($method, 'get') !== FALSE){

                        //On récupère le nom de l'attribut ciblé (ex: 'getName' devient 'name')
                        $col = lcfirst(str_replace('get', '', $method));

                        $v->assign($col, $team->$method());    
                    }
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

    public function updateUserTeamAction(){
 
        if(isset($_POST['action-team-rejoin'])){
            $teamBDD = new teamManager();

            $args = array('nameTeam' => FILTER_SANITIZE_STRING,
                        'action-team-rejoin' => FILTER_SANITIZE_STRING);

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
            // $team = un objet -> La team de la page
            $team = $teamBDD->getTeam(array('name'=>$filteredinputs['nameTeam']));

            $userBDD = new userManager();

            $userBDD->setNewTeam($this->getConnectedUser(),$team);
            header("Location:../detailteam?name=".$team->getName());
        }
        if(isset($_POST['action-team-exit'])){
            $teamBDD = new teamManager();

            $args = array('nameTeam' => FILTER_SANITIZE_STRING,
                        'action-team-rejoin' => FILTER_SANITIZE_STRING);

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
            // $team = un objet -> La team de la page
            $team = $teamBDD->getTeam(array('name'=>$filteredinputs['nameTeam']));
            $userBDD = new userManager();

            $userBDD->setNewTeam($this->getConnectedUser());
            header("Location:../detailteam?name=".$team->getName());
        }
    }
    
    public function updateTeamAction(){
        $teamBDD = new teamManager();

        $args = array('slogan' => FILTER_SANITIZE_STRING
                     ,'description' => FILTER_SANITIZE_STRING);
        $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

        $team = $teamBDD->getTeam(array('id'=>$this->getConnectedUser()->getIdTeam()));
        
        $team->setSlogan($filteredinputs['slogan']);
        $team->setDescription($filteredinputs['description']);

        $teamBDD->updateTeam($team);
        header("Location:../detailteam?name=".$team->getName());
    }   

}
