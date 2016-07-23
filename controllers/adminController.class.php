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



    private function controleNom($manager, $objet, $oldobjet=NULL){
        $exist_name=1;
        
        //Contôle format
        if(strlen($objet->getName())>=2 && strlen($objet->getName())<=30)
            $exist_name=$manager->nameExists($objet);
        
        //Contrôle existence BDD -> UPDATE
        if($oldobjet!==NULL && $oldobjet->getName()!==$objet->getName() && $exist_name==1)
            $exist_name=1;

        return $exist_name;
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
        $listeplatforms = $platform->getAdminListPlatform();        

        $v = new view();   
        $this->assignConnectedProperties($v); 
          
        $v->assign("listeplatform",$listeplatforms);
        $v->setView("/includes/admin/platforms", "templateEmpty");
    }

    /* Gère la vue de Signalements */
    public function reportsViewAction(){
        $report = new signalmentsuserManager();
        $listesignalement = $report->getAdminListReports();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listesignalement",$listesignalement);
        $v->setView("/includes/admin/reports", "templateEmpty");
    }

    /* Gère la vue de Team */
    public function teamsViewAction(){
        $team = new teamManager();
        $listeteam = $team->getAdminListTeam();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listeteam",$listeteam);
        $v->setView("/includes/admin/teams", "templateEmpty");
    }

    /* Gère la vue de Jeux */
    public function gamesViewAction(){
        $gameBDD = new gameManager();
        $listegames = $gameBDD->getAdminAllGames();

        $gametypeBDD = new typegameManager();
        $listgametype = $gametypeBDD->getAdminAllTypes();

        $v = new view();
        $this->assignConnectedProperties($v);
        
        $v->assign("listejeu",$listegames);
        $v->assign("listetypejeu",$listgametype);
        $v->setView("/includes/admin/games", "templateEmpty");
    }

    /* Gère la vue de Type de Jeu */
    public function typegamesViewAction(){
        $gametypeBDD = new typegameManager();
        $listgametype = $gametypeBDD->getAdminAllTypes();

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
        $listtournament = $tournamentBdd->getAdminListTournaments();

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
        public function getPlatformByNameAction(){
            $args = array(
                'name' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new platformManager();
            $search = new platform($filteredinputs);
            $data = $bdd->platformByName($search);
           
            if($data){
                echo json_encode($data);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

        public function insertPlatformsDataAction(){
            
            $args = array(
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'img' => FILTER_SANITIZE_STRING
            );

            move_uploaded_file($_FILES['file']['tmp_name'], getcwd(). WEBPATH . "/web/img/upload/platform/loadedFile.jpg");

            //Pré-controle car l'upload d'image ne passe pas le filter_input_array
            $platformBdd = new platformManager();
            $platform = new platform(array('name' => trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING))));

            $exist_name = $this->controleNom($platformBdd, $platform);
            if($exist_name)
                unset($args['name']);

            //On check le fichier
            if(file_exists(getcwd(). WEBPATH . "/web/img/upload/platform/loadedFile.jpg")){  
                //Nouveau nom
                if(!$exist_name && $platform->getName()!=NULL){
                    rename( getcwd(). WEBPATH . "/web/img/upload/platform/loadedFile.jpg", 
                            getcwd(). WEBPATH . "/web/img/upload/platform/".$platform->getName().".jpg");
                    $_POST['img']=$platform->getName().".jpg";
                    var_dump("OUUUUUAAAIIIISSS");
                }
                //Suppression du fichier
                else{
                    unlink(getcwd(). WEBPATH . "/web/img/upload/platform/loadedFile.jpg");
                    var_dump("ZAAAAAAAA");
                }
            }

            $filteredinputs = filter_input_array(INPUT_POST, $args);

            $pBdd = new platformManager();
            $platform = new platform(array('name' => trim($filteredinputs['name'])));

            $exist_name = $this->controleNom($pBdd, $platform);

            if($exist_name)
                unset($filteredinputs['name']);


            if(isset($filteredinputs['name'])){
                $pBdd->mirrorObject = new platform($filteredinputs);
                $pBdd->create();
            }
        }

        public function updatePlatformsDataAction(){
            //Upload des images
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                  
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/platform/" . $_POST['name'] . ".jpg");
            }  

            $args = array(
                'id' => FILTER_SANITIZE_STRING,
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'status' => FILTER_VALIDATE_INT,
                'img' => FILTER_SANITIZE_STRING                     
            );               

            //Pré-controle car l'upload d'image ne passe pas le filter_input_array
            $platformBdd = new platformManager();
            $oldplatform = $platformBdd->getIdPlatform(filter_var($_POST['id'], FILTER_SANITIZE_STRING));
            $platform = new platform(array('name' => trim(filter_var($_POST['name'], FILTER_SANITIZE_STRING))));

            $filteredinputs = filter_input_array(INPUT_POST, $args);                                

            $platformMaj = new platform($filteredinputs);
            
            $platformBdd->setPlatform($oldplatform, $platformMaj);
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

        public function getTournamentByNameAction(){
            $args = array(
                'name' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new tournamentManager();
            $search = new tournament($filteredinputs);
            $data = $bdd->tournamentByName($search);
           
            if($data){
                echo json_encode($data);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

        public function updateTournamentsDataAction(){
            $args = array(
                'id' => FILTER_SANITIZE_STRING,
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'status' => FILTER_VALIDATE_INT,
            );                                            

            $filteredinputs = filter_input_array(INPUT_POST, $args);                                

            $platformBdd = new tournamentManager();
            $platform = new tournament(array('name' => trim($filteredinputs['name'])));
            $oldplatform = $platformBdd->getIdTournaments($filteredinputs['id']);
            
            $exist_name = $this->controleNom($platformBdd, $platform, $oldplatform);

            if($exist_name)
                unset($filteredinputs['name']);

            $platformMaj = new tournament($filteredinputs);
            //print_r($platformMaj);
            //print_r($oldplatform);
            $platformBdd->setTournament($oldplatform, $platformMaj);
        }

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
        public function getTeamByNameAction(){
            $args = array(
                'name' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new teamManager();
            $search = new team($filteredinputs);
            $data = $bdd->teamByName($search);
           
            if($data){
                echo json_encode($data);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

        public function updateTeamsDataAction(){
            //Upload des images
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                  
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/team/" . $_POST['name'] . ".jpg");
            }  


            $args = array(
                'id' => FILTER_SANITIZE_STRING,
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'slogan' => FILTER_SANITIZE_STRING,
                'status' => FILTER_VALIDATE_INT,
                'img' => FILTER_SANITIZE_STRING                    
            );                                            

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
            
            $teamBDD = new teamManager();
            $oldteam = $teamBDD->getThisTeam($filteredinputs['id']);
            $team = new team(array('name' => trim($filteredinputs['name'])));

            $exist_name = $this->controleNom($teamBDD, $team, $oldteam);

            if($exist_name)
                unset($filteredinputs['name']);
   
            $teamMaj = new team($filteredinputs);
            
            $teamBDD->setTeam($oldteam, $teamMaj);
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

    /* MEMBRES */
        public function getUserByPseudoAction(){
            $args = array(
                'pseudo' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new userManager();
            $searchUser = new user($filteredinputs);
            $user = $bdd->userByPseudo($searchUser);
           
            if($user){
                echo json_encode($user);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

        public function updateMembresDataAction(){
            //Upload des images
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                  
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/membre/" . $_POST['pseudo'] . ".jpg");
            }  

                       
            $args = array(
               'id' => FILTER_VALIDATE_INT,
               'pseudo' => FILTER_SANITIZE_STRING, 
               'description' => FILTER_SANITIZE_STRING,
               'email' => FILTER_VALIDATE_EMAIL,
               'status' => FILTER_VALIDATE_INT,
               'day'   => FILTER_SANITIZE_STRING,     
               'month'   => FILTER_SANITIZE_STRING,     
               'year'   => FILTER_SANITIZE_STRING,   
               'authorize_mail_contact' => FILTER_VALIDATE_BOOLEAN,
               'img' => FILTER_SANITIZE_STRING
            );

            //On check le fichier (ne marche pas)
      /*      if(isset($_POST['file'])){
                if ( 0 < $_FILES['file']['error'] ) {
                    unset($_POST['img']);
                }
                else {    
                    if(isset($_POST['pseudo']) && (strlen($_POST['pseudo'])<2 || strlen($_POST['pseudo'])>15)){

                    if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>15)
                        unset($filteredinputs['pseudo']);
                    else{
                        $filteredinputs['pseudo']=trim($filteredinputs['pseudo']);
                        $user = new user(array('pseudo' => $filteredinputs['pseudo']));

                        $exist_pseudo=$userBDD->pseudoExists($filteredinputs['pseudo']);
                        if($olduser->getPseudo()!==$filteredinputs['pseudo'] && $exist_pseudo)
                          unset($filteredinputs['pseudo']);
                    }                  
                        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/membre/" . $_POST['pseudo']);
                    }
                    else{
                        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/membre/" . $olduser->getPseudo());
                    }
                }  
            }*/

            $filteredinputs = filter_input_array(INPUT_POST, $args);                                
            
            if(isset($filteredinputs['day']))
                $filteredinputs['day'] = (int) $filteredinputs['day'];
            if(isset($filteredinputs['month']))
                $filteredinputs['month'] = (int) $filteredinputs['month'];
            if(isset($filteredinputs['year']))
                $filteredinputs['year'] = (int) $filteredinputs['year'];

            $userBDD = new userManager();
            $olduser = $userBDD->getIdUser($filteredinputs['id']);

            // On check l'utilisation du pseudo
            if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>15)
                unset($filteredinputs['pseudo']);
            else{
                $filteredinputs['pseudo']=trim($filteredinputs['pseudo']);
                $user = new user(array('pseudo' => $filteredinputs['pseudo']));

                $exist_pseudo=$userBDD->pseudoExists($filteredinputs['pseudo']);
                if($olduser->getPseudo()!==$filteredinputs['pseudo'] && $exist_pseudo)
                  unset($filteredinputs['pseudo']);
            }

            // On check celle de l'email
            $filteredinputs['email']=trim($filteredinputs['email']);
            $user = new user(array('email' => $filteredinputs['email']));
            
            $exist_email=$userBDD->emailExists($filteredinputs['email']);
            if($olduser->getEmail()!==$filteredinputs['email'] && $exist_email)
              unset($filteredinputs['email']);

            //On check la date
            if(checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year'])){
              $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
              $filteredinputs['birthday'] = date_timestamp_get($date);
            }

            unset($filteredinputs['month']);
            unset($filteredinputs['day']);
            unset($filteredinputs['year']);


            $newUser = new user($filteredinputs);
            
            if($userBDD->setUser($olduser, $newUser)){
                //Déconnexion automatique du membre banni
                if($filteredinputs['status']==-1)
                    $userBDD->disconnecting($olduser);
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
       public function getReportByUserAction(){
            $args = array(
                'id' => FILTER_VALIDATE_INT,
                'pseudo' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new signalmentsuserManager();
            $search = new signalmentsuser($filteredinputs);
            $data = $bdd->reportByUser($search);
           
            if($data){
                echo json_encode($data);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

        public function DeleteReportsAction(){
            $args = array(
                'id' => FILTER_VALIDATE_INT
            );
            
            $filteredinputs = filter_input_array(INPUT_POST, $args);
            
            $reportsBDD = new signalmentsuserManager();
            $report = $reportsBDD->getReport($filteredinputs['id']);

            $reportsBDD->delReport($report);
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
        public function getTypeGameByNameAction(){
            $args = array(
                'name' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new typegameManager();
            $search = new typegame($filteredinputs);
            $data = $bdd->typeGameByName($search);
           
            if($data){
                echo json_encode($data);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }


        public function insertTypeGamesDataAction(){
            
            $args = array(
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'img' => FILTER_SANITIZE_STRING,
                'status' => FILTER_VALIDATE_INT
            );

            $filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

            $typegameBdd = new typegameManager();
            $typegame = new typegame(array('name' => trim($filteredinputs['name'])));
            
            $exist_name = $this->controleNom($typegameBdd, $typegame);

            if($exist_name)
                unset($filteredinputs['name']);

            //On check le fichier
            if(isset($_FILES['file'])){
                if ( 0 < $_FILES['file']['error'] ) {
                    unset($filteredinputs['img']);
                }
                else {    
                    if(isset($filteredinputs['name']))                    
                        move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/typejeux/" . $filteredinputs['name']);                }  
            }

            if(isset($filteredinputs['name'])){
                $tym =  new typegame($filteredinputs);
                $typegameBdd->mirrorObject = $tym;
                $typegameBdd->create();
            }
        }


       public function updateTypeGamesDataAction(){
            //Upload des images
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                  
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/typejeux/" . $_POST['name'] . ".jpg");
            }  

            $args = array(
                'id' => FILTER_SANITIZE_STRING,
                'name' => FILTER_SANITIZE_STRING,
                'description' => FILTER_SANITIZE_STRING,
                'status' => FILTER_VALIDATE_INT,
                'img' => FILTER_SANITIZE_STRING                     
            );                                            

            $filteredinputs = filter_input_array(INPUT_POST, $args);                                
            
            $typegameBdd = new typegameManager();
            $typegame = new typegame(array('name' => trim($filteredinputs['name'])));
            $oldtypegame = $typegameBdd->getTypeGame($filteredinputs['id']);
            
            /*$exist_name = $this->controleNom($typegameBdd, $typegame, $oldtypegame);

            if($exist_name)
                unset($filteredinputs['name']);*/

            //On check le fichier
            // if(isset($_FILES['file'])){
            //     if ( 0 < $_FILES['file']['error'] ) {
            //         unset($filteredinputs['img']);
            //     }
            //     else {    
            //         if(isset($filteredinputs['name']))   
            //         {//move_uploaded_file($_FILES['profilpic']['tmp_name'], $uploadfile);
            //             move_uploaded_file($_FILES['file']['tmp_name'], getcwd() . WEBPATH . "/web/img/upload/typejeux/" . $filteredinputs['name']);
            //         }
            //         else{
            //             move_uploaded_file($_FILES['file']['tmp_name'], getcwd() . WEBPATH . "/web/img/upload/typejeux/" . $old->getName());
            //         }
            //     }  
            // }

            $newtg = new typegame($filteredinputs);
            
            $typegameBdd->setTypeGame($oldtypegame, $newtg);
        }


         // TEDDY
         // ON EST OBLIGE

         // D'UTILISER 
         // CES TRUCS 

         // ?

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

        public function getAllTypeGameAction(){
            $tb = new typegameManager();   
            $data = $tb->getAllTypes();  

            $myArr = [];

            foreach($data as $key => $d){
                $myArr['name'][] = $d->getName();
                $myArr['id'][] = $d->getId();
            } 

            //print_r($myArrName);
            echo json_encode($myArr);
        }

    /* GAMES */
        public function getGameByNameAction(){
            $args = array(
                'name' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new gameManager();
            $search = new game($filteredinputs);
            $data = $bdd->gameByName($search);
           
            if($data){
                echo json_encode($data);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

        public function insertGamesDataAction(){
            $args = array(
               'name' => FILTER_SANITIZE_STRING,
               'description' => FILTER_SANITIZE_STRING,
               'status' => FILTER_VALIDATE_INT,
               'day'   => FILTER_SANITIZE_STRING,     
               'month'   => FILTER_SANITIZE_STRING,     
               'thisYear'   => FILTER_SANITIZE_STRING,   
               'idType' => FILTER_VALIDATE_INT,
               'nameType' => FILTER_SANITIZE_STRING,
               'img' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);

            $filteredinputs['day'] = (int) $filteredinputs['day'];
            $filteredinputs['month'] = (int) $filteredinputs['month'];
            $filteredinputs['thisYear'] = (int) $filteredinputs['thisYear'];
            
            $gameBdd = new gameManager();
            $game = new game(array('name'=>trim($filteredinputs['name'])));
            $exist_name = $this->controleNom($gameBdd, $game);

            if($exist_name)
                unset($filteredinputs['name']);

            //On check la date
              if(checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['thisYear'])){
                $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['thisYear']);
                $filteredinputs['year'] = date_timestamp_get($date);
              }

              unset($filteredinputs['month']);
              unset($filteredinputs['day']);
              unset($filteredinputs['nameType']);
              unset($filteredinputs['thisYear']);

              //On check le fichier
                if(isset($_FILES['file'])){
                  if ( 0 < $_FILES['file']['error'] ) {
                      unset($filteredinputs['img']);
                  }
                  else {    
                      if(isset($filteredinputs['name']))                    
                          move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/jeux/" . $filteredinputs['name']);
                  }  
                }

            $pBdd = new gameManager();
            if(isset($filteredinputs['name'])){
                $myNewGame = new game($filteredinputs);
                $pBdd->mirrorObject = $myNewGame;
                $pBdd->create();
            }
        }

        public function updateGamesDataAction(){
           //Upload des images
            if ( 0 < $_FILES['file']['error'] ) {
                echo 'Error: ' . $_FILES['file']['error'];
            }
            else {                  
                move_uploaded_file($_FILES['file']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . WEBPATH . "/web/img/upload/jeux/" . $_POST['name'] . ".jpg");
            }  

            $args = array(
               'id' => FILTER_VALIDATE_INT,
               'name' => FILTER_SANITIZE_STRING,
               'description' => FILTER_SANITIZE_STRING,
               'status' => FILTER_VALIDATE_INT,
               'day'   => FILTER_SANITIZE_STRING,     
               'month'   => FILTER_SANITIZE_STRING,     
               'thisYear'   => FILTER_SANITIZE_STRING,   
               'idType' => FILTER_VALIDATE_INT,
               'nameType' => FILTER_SANITIZE_STRING,
               'img' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);

            $filteredinputs['day'] = (int) $filteredinputs['day'];
            $filteredinputs['month'] = (int) $filteredinputs['month'];
            $filteredinputs['thisYear'] = (int) $filteredinputs['thisYear'];

            $gameBdd = new gameManager();
            $oldgame = $gameBdd->getGameById($filteredinputs['id']);
            $game = new game(array('name' => trim($filteredinputs['name'])));

            $exist_name = $this->controleNom($gameBdd, $game, $oldgame);

            if($exist_name)
                unset($filteredinputs['name']);

            //On check la date
              if(checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['thisYear'])){
                $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['thisYear']);
                $filteredinputs['year'] = date_timestamp_get($date);
              }

              unset($filteredinputs['month']);
              unset($filteredinputs['day']);
              unset($filteredinputs['nameType']);
              unset($filteredinputs['thisYear']);

            $newGame = new game($filteredinputs);
            $gameBdd->setGame($oldgame, $newGame);

        }

        public function getAllGamesNameAction(){
            $tb = new gameManager();   
            $data = $tb->getAllGames();  

            $myArr = [];

            foreach($data as $key => $d){
                $myArr['name'][] = $d->getName();
            } 

            //print_r($myArrName);
            echo json_encode($myArr);
        }

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

                $uploaddir = '/web/img/upload/jeux/';
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
    public function getCommentByPseudoAction(){
            $args = array(
                'pseudo' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new commentManager();
            $searchUser = new comment($filteredinputs);
            $user = $bdd->commentByPseudo($searchUser);
           
            if($user){
                echo json_encode($user);
                die();
            }else{
                echo "undefined";
                die();
            }   
        }

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
