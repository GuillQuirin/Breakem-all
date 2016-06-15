<?php
class adminController extends template{

    public function __construct(){        
        parent::__construct();
        if(!($this->isVisitorConnected())){
            header('Location: ' .WEBPATH);
        }

        if((int)$this->getConnectedUser()->getStatus() !== 3){
            header('Location: ' .WEBPATH);
        }
    }
    
    public function adminAction(){
        if($this->isVisitorConnected() && $this->isAdmin()){
            $v = new view();
    		$this->assignConnectedProperties($v);
            $v->assign("css", "admin");
                $js['admin']="admin";
                $js['adminPlatforms']="adminPlatforms";
                $js['gametype']="gametype";
                $js['adminTournois']="adminTournois";
                $js['game']="game";
            $v->assign("js",$js);                                       
            $v->assign("title", "admin");
            $v->assign("content", "Liste des Utilisateurs");

            $admin = new adminManager();
    		$listejoueurs = $admin->getListUser();  
            
            $platform = new platformManager();
            $listeplatforms = $platform->getListPlatform();
            
            $report = new signalmentsuserManager();
            $listesignalement = $report->getListReports();
            
            $team = new teamManager();
            $listeteam = $team->getListTeam(-2);

    $gametypeBDD = new typegameManager();
            $listgametype = $gametypeBDD->getAllTypes();

            $gameBDD = new gameManager();
            $listegames = $gameBDD->getAllGames();

            $commentaireBDD = new commentsteamManager();
            $listcomment = $commentaireBDD->getAllComment();            $v->assign("listejoueur",$listejoueurs);

            $v->assign("listeplatform",$listeplatforms);

            $v->assign("listesignalement",$listesignalement);

            $v->assign("listeteam",$listeteam);

            $v->assign("listetypejeu",$listgametype);

            $v->assign("listejeu",$listegames);

            $v->assign("listecomment",$listcomment);
           
            $v->setView("/includes/admin/accueil", "template");
        }
        else{ //On affiche la 404 pour faire croire que le mec tape n'importe quoi
          header('Location: '.WEBPATH.'/404');
        }
    }

    /* PLATEFORME */

    public function getPlatformsDataAction(){
        $pm = new platformManager();
        $typesObj = $pm->getListPlatform();
        $data['res'] = [];        
        foreach ($typesObj as $key => $obj) {
            $arr = [];
            $arr['id'] = $obj->getId();
            $arr['name'] = $obj->getName();
            $arr['img'] = $obj->getImg();
            $arr['description'] = $obj->getDescription();
            $data['res'][] = $arr;
        }
        echo json_encode($data['res']);
        return;
    }

    public function insertPlatformDataAction(){
        $args = array(            
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,            
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
                        
        $platformBdd = new platformManager();
        $platformBdd->mirrorObject = new platform($filteredinputs);
        if($platformBdd->create())
            echo "CREATION";
    }

    public function updatePlatformsDataAction(){
        $args = array(
            'id' => FILTER_SANITIZE_STRING,
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING
        );        
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);            

        $platformBdd = new platformManager();
        $platform = $platformBdd->getIdPlatform($filteredinputs['id']);
        $platformMaj = new platform($filteredinputs);
        
        if($platformBdd->setPlatform($platform, $platformMaj))
            echo "OK";
    }

    public function deletePlatformDataAction(){
        $args = array(
            'id' => FILTER_SANITIZE_STRING
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $platformBdd = new platformManager();
        $platform = $platformBdd->getIdPlatform($filteredinputs['id']);

        $platformBdd->deletePlatform($platform);
    }

    /* TOURNAMENT */

    public function getTournamentDataAction(){
        $tm = new tournamentManager();    
        $tournamentsArr = $tm->getListTournaments();  
        $data = [];                          
        if(!!$tournamentsArr){
            foreach($tournamentsArr as $key => $tournament){
                $data[] = $tournament->returnAsArr();
            }            
            echo json_encode($data);
        }else{
            $this->echoJSONerror("tournament","no tournament were found");
        }
        return;
    }

    /* TEAM */
    public function updateTeamStatusAction(){
         if(!empty($_POST['checkbox_team'])){
            $filteredinputs = array_filter(filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING));

            foreach($filteredinputs['checkbox_team'] as $key => $name){
                $teamBDD = new teamManager();
                $team = $teamBDD->getTeam(array('name'=>$name));
                
                if($team->getStatus()==1)
                    $team->setStatus(-1);
                else
                    $team->setStatus(1);

                $teamupdate = new teamManager();
                $teamupdate->changeStatusTeam($team);
            }    
            
        }


        // return false;

       header('Location: '.WEBPATH.'/admin');
    }

    /* USER */
    public function updateUserStatusAction(){
        $args = array(
            'pseudo' => FILTER_SANITIZE_STRING,
            'status' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $userBDD = new userManager();
        $user = $userBDD->getUser(array('pseudo'=>$filteredinputs['pseudo']));

        $newuser = new user(array('status'=>$filteredinputs['status']));
        
        //Déconnexion automatique du membre banni
        if($filteredinputs['status']==-1)
            $userBDD->disconnecting($user);

        $userBDD->setUser($user, $newuser);
    }

    /* SIGNALEMENT */
    public function DeleteReportsAction(){
        $args = array(
            'id' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $reportsBDD = new signalmentsuserManager();
        $report = $reportsBDD->getReport($filteredinputs['id']);

        $reportsBDD->delReport($report);

        //$reportsBDD->getListReports());

    }
}
