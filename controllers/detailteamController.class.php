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
            //Liste des membres
            $listemember = $teamBDD->getListMember($name);
            $v->assign("listemember", $listemember);

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

            //Récupération de l'id de la team du user connecté
            if($this->getConnectedUser()){
               $getIdTeam = $this->getConnectedUser()->getIdTeam();
            }

            //Verification si l'user possède une Team
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
                $commentBDD = new commentManager();
                $listecomment = $commentBDD->getCommentsByTeam($team);
                $v->assign("listecomment", $listecomment);
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
            header("Location: ".WEBPATH."/detailteam?name=".$team->getName());
        }
        
        if(isset($_POST['action-team-exit'])){
            $teamBDD = new teamManager();

            $args = array('nameTeam' => FILTER_SANITIZE_STRING,
                        'action-team-exit' => FILTER_SANITIZE_STRING);

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
            // $team = un objet -> La team de la page
            $team = $teamBDD->getTeam(array('name'=>$filteredinputs['nameTeam']));
            $userBDD = new userManager();

            $userBDD->setNewTeam($this->getConnectedUser());
            header("Location: ".WEBPATH."/detailteam?name=".$team->getName());
        }

        if(isset($_POST['action-team-dissoudre'])){
            $teamBDD = new teamManager();

            $args = array('nameTeam' => FILTER_SANITIZE_STRING,
                        'action-team-dissoudre' => FILTER_SANITIZE_STRING);

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
            // $team = un objet -> La team de la page
            $team = $teamBDD->getTeam(array('name'=>$filteredinputs['nameTeam']));
            $userBDD = new userManager();

            $userBDD->setAllUser($team);
            $teamBDD->changeStatusTeam($team);
            header("Location: ".WEBPATH."/team");
        }
    }
    
    public function updateTeamAction(){
        $teamBDD = new teamManager();

        $args = array('nameTeam' => FILTER_SANITIZE_STRING,
                      'slogan' => FILTER_SANITIZE_STRING,
                      'description' => FILTER_SANITIZE_STRING);
        $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

        if (isset($_FILES['img']) && $_FILES['img']['error'] != 4) {
            $uploaddir = '/web/img/upload/team/';
            
            $name = $filteredinputs['nameTeam'].'.jpg';

            
            $uploadfile = getcwd().$uploaddir.$name;
   
            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);

            if ($_FILES['img']['size'] < 1 * MB) {
                if ($_FILES['img']['error'] == 0) {

                    if (!move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile))
                        die("Erreur d'upload");
                }
            }
            $filteredinputs['img'] = $name;
        }

        $team = $teamBDD->getTeam(array('id'=>$this->getConnectedUser()->getIdTeam()));
        
        $team->setSlogan($filteredinputs['slogan']);
        $team->setDescription($filteredinputs['description']);
        if(isset($_FILES['img']) && $_FILES['img']['error'] != 4){
            $team->setImg($filteredinputs['img']);
        }

        $teamBDD->updateTeam($team);    

        header("Location: ".WEBPATH."/detailteam?name=".$team->getName());
    }   

    public function createCommentAction(){
        $args = array(
            'comment' => FILTER_SANITIZE_STRING
        );
        $args['comment']=trim($args['comment']);
        $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

        foreach ($args as $key => $value) {
            if(!isset($filteredinputs[$key])){      
                die("Manque information : ".$key);
            }
        }

        //Infos du joueur
        $filteredinputs['idUser']=intval($this->getConnectedUser()->getId());
        //Infos de la team
        $filteredinputs['idEntite']=intval($this->getConnectedUser()->getIdTeam());
        $filteredinputs['entite']=1; // type de contenu -> team
        
        $commentBDD = new commentManager();
        $commentBDD->mirrorObject = new comment($filteredinputs);
        $commentBDD->create();

        $teamBDD = new teamManager();
        $team = $teamBDD->getTeam(array('id'=>$this->getConnectedUser()->getIdTeam()));
        
        header("Location: ".WEBPATH."/detailteam?name=".$team->getName());
    }

    public function editCommentAction(){
        $args = array(
            'id' => FILTER_SANITIZE_STRING,
            'comment' => FILTER_SANITIZE_STRING
        );

        $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
        
        foreach ($args as $key => $value) {
            if(!isset($filteredinputs[$key])){      
                die("Manque information : ".$key);
            }
        }

        $commentBDD = new commentManager();
        $commentaire = $commentBDD->getComment($filteredinputs['id']);

        if($commentaire->getIdUser()==$this->getConnectedUser()->getId()
            && time()-strtotime($commentaire->getDate())<1800){ // Limite de 30min pour éditer le commentaire
            $commentBDD->editComment($commentaire, trim($filteredinputs['comment']));
        }

        $teamBDD = new teamManager();
        $team = $teamBDD->getTeam(array('id'=>$this->getConnectedUser()->getIdTeam()));

        header("Location: ".WEBPATH."/detailteam?name=".$team->getName());
    }

    public function reportCommentAction(){
        $args = array(
            'id' => FILTER_SANITIZE_STRING
        );
        $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

        foreach ($args as $key => $value) {
            if(!isset($filteredinputs[$key])){      
                die("Manque information : ".$key);
            }
        }

        $commentBDD = new commentManager();
        $commentBDD->reportComment($commentBDD->getComment($filteredinputs['id']));
    }

}
