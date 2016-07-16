<?php
class adminController extends template{

    public function __construct(){        
        parent::__construct();
        if(!($this->isVisitorConnected())){
            header('Location: ' .WEBPATH.'/index');
        }

        if((int)$this->getConnectedUser()->getStatus() !== 3){
            header('Location: ' .WEBPATH.'/index');
        }
    }






/***************************************VUES********************************/

    /* Gère la vue de Membres */
    public function membresViewAction(){
        $admin = new userManager();
        $listejoueurs = $admin->getAdminListUser();  

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listejoueurs",$listejoueurs);
        $v->setView("/includes/admin/membres", "templateEmpty");
    }

    /* Gère la vue de Plateforme */
    public function platformsViewAction(){
        $platform = new platformManager();
        $listeplatforms = $platform->getListPlatform();        

        $v = new view();   
        $this->assignConnectedProperties($v); 
          
        $v->assign("listeplatform",$listeplatforms);
        $v->setView("/includes/admin/platforms", "templateEmpty");
    }

    /* Gère la vue de Signalements */
    public function reportsViewAction(){
        $report = new signalmentsuserManager();
        $listesignalement = $report->getListReports();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listesignalement",$listesignalement);
        $v->setView("/includes/admin/reports", "templateEmpty");
    }

    /* Gère la vue de Team */
    public function teamsViewAction(){
        $team = new teamManager();
        $listeteam = $team->getListTeam(-2);

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listeteam",$listeteam);
        $v->setView("/includes/admin/teams", "templateEmpty");
    }

    /* Gère la vue de Jeux */
    public function gamesViewAction(){
        $gameBDD = new gameManager();
        $listegames = $gameBDD->getAllGames();

        $gametypeBDD = new typegameManager();
        $listgametype = $gametypeBDD->getAllTypes();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listejeu",$listegames);
        $v->assign("listetypejeu",$listgametype);
        $v->setView("/includes/admin/games", "templateEmpty");
    }

    /* Gère la vue de Type de Jeu */
    public function typegamesViewAction(){
        $gametypeBDD = new typegameManager();
        $listgametype = $gametypeBDD->getAllTypes();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listetypejeu",$listgametype);
        $v->setView("/includes/admin/gametypes", "templateEmpty");
    }

    /* Gère la vue de Commentaires */
    public function commentsViewAction(){
        $commentaireBDD = new commentManager();
        $listcomment = $commentaireBDD->getAllComment();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listecomment",$listcomment);
        $v->setView("/includes/admin/comments", "templateEmpty");
    }

     /* Gère la vue de Tournois */
    public function tournamentsViewAction(){
        $tournamentBdd = new tournamentManager();    
        $listtournament = $tournamentBdd->getListTournaments();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listetournament",$listtournament);
        $v->setView("/includes/admin/tournaments", "templateEmpty");
    }

    






/***********************************************ACTIONS*******************************************/

    public function adminAction(){
        if($this->isVisitorConnected() && $this->isAdmin()){
            $v = new view();
    		$this->assignConnectedProperties($v);
            $v->assign("css", "admin");
                $js['admin']="admin";     
                $js['adminPlatforms']="adminPlatforms";
                $js['adminMembres']="adminMembres";
                $js['adminSignalement']="adminSignalement";
                $js['adminComments']="adminComments";   
                $js['adminTypeJeu']="adminTypeJeu"; 
                $js['adminJeux']="adminJeux"; 
                $js['adminTournoi']="adminTournoi"; 
                $js['adminTeam']="adminTeam";    
                $js['gametype']="gametype";                
                $js['game']="game";
            $v->assign("js",$js);                                       
            $v->assign("title", "admin");
            $v->assign("content", "Liste des Utilisateurs");        
           
            
            $v->setView("/includes/admin/accueil", "template");
        }
        else{ //On affiche la 404 pour faire croire que le mec tape n'importe quoi
          header('Location: '.WEBPATH.'/404');
        }
    }






    /* PLATEFORME */
    public function insertPlatformsDataAction(){
        if(isset($_FILES['file'])){
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                        
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/platform/" . $_FILES['file']['name']);
            }
        }

        $args = array(
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,
            'img' => FILTER_SANITIZE_STRING
        );

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

            $pBdd = new platformManager();
            $pBdd->mirrorObject = new platform($filteredinputs);
            $pBdd->create();
        }

    public function updatePlatformsDataAction(){
        if(isset($_FILES['file'])){
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                        
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/platform/" . $_FILES['file']['name']);
            }  
        }

        $args = array(
            'id' => FILTER_SANITIZE_STRING,
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,
            'status' => FILTER_VALIDATE_INT,
            'img' => FILTER_SANITIZE_STRING                     
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

        public function deleteTeamAction(){
            $args = array(
                'id' => FILTER_VALIDATE_INT
            );
            
            $filteredinputs = filter_input_array(INPUT_POST, $args);
            
            $teamBdd = new teamManager();
            $team = $teamBdd->getThisTeam($filteredinputs['id']);

            $teamBdd->delTeam($team);
        }

    public function updateTeamsDataAction(){
        if(isset($_FILES['file'])){
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                        
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/team/" . $_FILES['file']['name']);
            }  
        }

        $args = array(
            'id' => FILTER_SANITIZE_STRING,
            'name' => FILTER_SANITIZE_STRING,
            'description' => FILTER_SANITIZE_STRING,
            'slogan' => FILTER_SANITIZE_STRING,
            'status' => FILTER_VALIDATE_INT,
            'img' => FILTER_SANITIZE_STRING                    
        );                                        

        $filteredinputs = filter_input_array(INPUT_POST, $args);

        //print_r($filteredinputs);                                

        $teamBdd = new teamManager();
        $team = $teamBdd->getThisTeam($filteredinputs['id']);
        $teamMaj = new team($filteredinputs);

        //print_r($teamMaj);
        
        if($teamBdd->setTeam($team, $teamMaj))
            echo "OK";
        }




    /* MEMBRES */
    public function updateUserAction(){
        if(isset($_FILES['file'])){
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                        
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/membre/" . $_FILES['file']['name']);
            }  
        }
        
        $args = array(
           'id' => FILTER_VALIDATE_INT,
           'pseudo' => FILTER_SANITIZE_STRING, 
           'description' => FILTER_SANITIZE_STRING,
           'email' => FILTER_SANITIZE_STRING,
           'status' => FILTER_VALIDATE_INT,
 	       'day'   => FILTER_SANITIZE_STRING,     
           'month'   => FILTER_SANITIZE_STRING,     
           'year'   => FILTER_SANITIZE_STRING,   
           'authorize_mail_contact' => FILTER_VALIDATE_BOOLEAN,
           'img' => FILTER_SANITIZE_STRING
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

    public function updateMembresDataAction(){
        if(isset($_FILES['file'])){
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                        
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/membre/" . $_FILES['file']['name']);
            }  
        }
        
        $args = array(
           'id' => FILTER_VALIDATE_INT,
           'pseudo' => FILTER_SANITIZE_STRING, 
           'description' => FILTER_SANITIZE_STRING,
           'email' => FILTER_SANITIZE_STRING,
           'status' => FILTER_VALIDATE_INT,
           'day'   => FILTER_VALIDATE_INT,     
           'month'   => FILTER_VALIDATE_INT,     
           'year'   => FILTER_VALIDATE_INT,   
           'authorize_mail_contact' => FILTER_VALIDATE_BOOLEAN,
           'img' => FILTER_SANITIZE_STRING
        );

        $filteredinputs = filter_input_array(INPUT_POST, $args);                                
        //Date de naissance
        
        if(checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year'])){
          $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
          $filteredinputs['birthday'] = date_timestamp_get($date);
        }

        $userBdd = new userManager();
        $user = $userBdd->getIdUser($filteredinputs['id']);
        $newUser = new user($filteredinputs);
        
        if($userBdd->setUser($user, $newUser)){
            //Déconnexion automatique du membre banni
            if($filteredinputs['status']==-1)
                $userBDD->disconnecting($user);
            }
        }

        //Bannissement
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

        public function updateReportsDataAction(){

            $args = array(
                'id' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'subject' => FILTER_SANITIZE_STRING
                );                                        

            $filteredinputs = filter_input_array(INPUT_POST, $args);                                

            $Bdd = new signalmentsuserManager();
            $r = $Bdd->getIdReport($filteredinputs['id']);
            $rMaj = new signalmentsuser($filteredinputs);
            
            if($Bdd->setReport($r, $rMaj))
                echo "OK";
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

                $uploaddir = '/web/img/upload/typejeux/';
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
            //var_dump($filteredinputs);
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

                $uploaddir = '/web/img/upload/typejeux/';
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
            //var_dump($typegame, $typegameMAJ);
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




    /* GAMES */

        public function addGameAction()
        {

            $args = array(
                //'id' => FILTER_VALIDATE_INT,
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'year' => FILTER_SANITIZE_STRING,
                'idType' => FILTER_VALIDATE_INT,
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);

            if (isset($_FILES['img'])) {

                $uploaddir = '/web/img/';
                $name = $_FILES['img']['name'];

                $uploadfile = getcwd().$uploaddir.$name;
                //var_dump($uploadfile);

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

            $gameBDD = new gameManager();
            $gameBDD->mirrorObject = new game($filteredinputs);
            if ($gameBDD->create())
                echo "CREATION";
            //var_dump($filteredinputs);

        }

        public function delGameAction(){

            $args = array(
                'id' => FILTER_SANITIZE_STRING
                //'delname' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);

            $gameBDD = new gameManager();
            $game = $gameBDD->getGameById($filteredinputs['id']);
        
            if($game)
                $gameBDD->deleteGames($game);
            else
                return null;
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
