<?php
class adminController extends template{
    
    public function adminAction(){
        if($this->isVisitorConnected() && $this->isAdmin()){
            $v = new view();
    		$this->assignConnectedProperties($v);
            $v->assign("css", "admin");
                $js['admin']="admin";
                $js['platforms']="platforms";
                $js['gametype']="gametype";
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

            $commentaireBDD = new commentsteamManager();
            $listcomment = $commentaireBDD->getAllComment();

            $v->assign("listejoueur",$listejoueurs);

            $v->assign("listeplatform",$listeplatforms);

            $v->assign("listesignalement",$listesignalement);

            $v->assign("listeteam",$listeteam);

            $v->assign("listetypejeu",$listgametype);

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

    public function updatePlatformsDataAction(){
         $args = array(
            'id' => FILTER_VALIDATE_INT,
            'nom' => FILTER_VALIDATE_STRING,
            'description' => FILTER_VALIDATE_STRING,           
        );        
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);    

        $platformBdd = new platformManager();
        $platform = $platformBdd->getTypeGame($filteredinputs['id']);
        $platformMaj = new platform($filteredinputs);
        var_dump($platform, $platformMaj);
        if($platformBdd->setPlatform($platform, $platformMaj))
            echo "OK";
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

    /* TYPE GAME */

     public function createTypeGameByAction(){
        $args = array(
            //'id' => FILTER_VALIDATE_INT,
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,
            'profilpic' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        if(isset($_FILES['profilpic'])){

            $uploaddir = '/web/img/';
            $uploadfile = getcwd().$uploaddir.$this->getConnectedUser()->getId().'.jpg';

            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);

            if($_FILES['profilpic']['size'] < 1*MB){
                if($_FILES['profilpic']['error']==0){
                    if(!move_uploaded_file($_FILES['profilpic']['tmp_name'], $uploadfile))
                       die("Erreur d'upload");
                }
            }
            $filteredinputs['img'] = $this->getConnectedUser()->getName().'.jpg';
        }
        var_dump($filteredinputs);
        $typegameBDD = new typegameManager();
        $typegameBDD->mirrorObject = new typegame($filteredinputs);
        if($typegameBDD->create())
            echo "CREATION";
    }


    public function getTypeGameByAction(){
        $args = array(
            'id' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $typegameBDD = new typegameManager();
        $obj = $typegameBDD->getTypeGame($filteredinputs['id']);

        $arr = [];
        $arr['name'] = $obj->getName();
        $arr['id'] = $obj->getId();
        $arr['img'] = $obj->getImg();
        $arr['description'] = $obj->getDescription();

        echo json_encode($arr);
    }

    public function updateTypeGameByAction(){
        $args = array(
            'id' => FILTER_VALIDATE_INT,
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,
            'profilpic' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        if(isset($_FILES['profilpic'])){

            $uploaddir = '/web/img/';
            $uploadfile = getcwd().$uploaddir.$this->getConnectedUser()->getId().'.jpg';

            define('KB', 1024);
            define('MB', 1048576);
            define('GB', 1073741824);
            define('TB', 1099511627776);

            if($_FILES['profilpic']['size'] < 1*MB){
                if($_FILES['profilpic']['error']==0){
                    if(!move_uploaded_file($_FILES['profilpic']['tmp_name'], $uploadfile))
                       die("Erreur d'upload");
                }
            }
            $filteredinputs['img'] = $this->getConnectedUser()->getName().'.jpg';
        }

        $typegameBDD = new typegameManager();
        $typegame = $typegameBDD->getTypeGame($filteredinputs['id']);
        $typegameMAJ = new typegame($filteredinputs);
        var_dump($typegame, $typegameMAJ);
        if($typegameBDD->setTypeGame($typegame, $typegameMAJ))
            echo "OK";
    } 

    public function DeleteTypeGameAction(){
        $args = array(
            'id' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $typegameBDD = new typegameManager();
        $typegame = $typegameBDD->getTypeGame($filteredinputs['id']);

        $typegameBDD->delTypeGame($typegame);

    } 


    /* COMMENTAIRE */
    public function delCommentAction(){
        $args = array(
            'id' => FILTER_VALIDATE_INT
        );
        
        $filteredinputs = filter_input_array(INPUT_POST, $args);
        
        $commentBDD = new commentsteamManager();
        $comment = $commentBDD->getComment($filteredinputs['id']);

        $commentBDD->delComment($comment);
    }


}