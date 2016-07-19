<?php
/*
*
*/
class template{
  protected $connectedUser = false;

  public function __construct(){
    /*Tant que chaque controller herite de template, le token sera vérifié à chaque rafraichissement de page*/
    $this->checkToken();
  }
  protected function getConnectedUser(){return $this->connectedUser;}

  /* Cette methode fournira à la view reçue en parametre les propriétés nécessaires à l'affichage d'un user si ce dernier est bien connecté */
  protected function assignConnectedProperties(view $v){
    // var_dump("ASSIGNING CONNECTION PROPS");

    if(!$this->isCookieAccepted()){
      $v->assign("popupCookie", 1);
    }

    if($this->isVisitorConnected()){
      $v->assign("_isConnected", 1);
      $v->assign("_id", $this->connectedUser->getId());
      $v->assign("_name", $this->connectedUser->getName());
      $v->assign("_firstname", $this->connectedUser->getFirstname());
      $v->assign("_pseudo", $this->connectedUser->getPseudo());
      $v->assign("_birthday", $this->connectedUser->getBirthday());
      $v->assign("_lastConnexion", $this->connectedUser->getLastConnexion());
      $v->assign("_description", $this->connectedUser->getDescription());     
      $v->assign("_kind", $this->connectedUser->getKind());
      $v->assign("_city", $this->connectedUser->getCity());
      $v->assign("_email", $this->connectedUser->getEmail());
      $v->assign("_img", $this->connectedUser->getImg()); 
      $v->assign("_idTeam", $this->connectedUser->getIdTeam());
      $v->assign("_NameTeam", $this->connectedUser->getNameTeam());
      $v->assign("_rss", $this->connectedUser->getRss());
      $v->assign("_authorize_mail_contact", $this->connectedUser->getAuthorize_mail_contact());
      $v->assign("_totalPoints", $this->connectedUser->gtTotalPoints());
      // $v->assign("_password", $this->connectedUser->getPassword());

      if(!empty($this->connectedUser->getIdTeam())){
        $teamBBD = new teamManager();
        $arr['id'] = $this->connectedUser->getIdTeam();
        $team = $teamBBD->getTeam($arr);   
        $v->assign("_nameTeam",$team->getName());
      }

      if($this->isAdmin()){
        $v->assign("_isAdmin", 1);
      }
      else
      {
        $v->assign("_isAdmin",0);
      }
    }
  }
  private function isCookieAccepted(){
    if( isset($_COOKIE[AUTORISATION]) && $_COOKIE[AUTORISATION]==1)
      return true;   
    return false;
  }
  public function acceptCookieAction(){
    setcookie(AUTORISATION, 1, time()+(60*60*24*30), "/");
    echo json_encode(["success"=>true]);
    exit;
  }

  protected function isVisitorConnected(){
    return ($this->connectedUser instanceof user);
  }  

  protected function isAdmin(){
    $var = $this->connectedUser->getStatus();
    //var_dump($var);exit;
    if(isset($var) && $var == "3")
      return true;
    return false;
  }  

  protected function checkToken(){
    // var_dump($_SESSION[COOKIE_EMAIL], $_SESSION[COOKIE_TOKEN], $_COOKIE[COOKIE_EMAIL], $_SESSION[COOKIE_TOKEN]);
    
    $args = array(
      COOKIE_EMAIL   => FILTER_VALIDATE_EMAIL,
      COOKIE_TOKEN   => FILTER_SANITIZE_STRING
    );
    $filteredcookies = filter_input_array(INPUT_COOKIE, $args);

    $requiredCookiesReceived = true;
    foreach ($args as $key => $value) {
      if(!isset($filteredcookies[$key])){
        $requiredCookiesReceived = false;
        break;
      };
    };
    if($requiredCookiesReceived){
     if(isset($_SESSION[COOKIE_EMAIL]) && isset($_SESSION[COOKIE_TOKEN])){      
      if(($_SESSION[COOKIE_EMAIL] === $_COOKIE[COOKIE_EMAIL]) && ($_SESSION[COOKIE_TOKEN] === $_COOKIE[COOKIE_TOKEN])){
        // Bien faire attention à bien envoyer un array en parametre constructeur de user
        $user = new user(['email' => $_SESSION[COOKIE_EMAIL]]);

        // on met à jour la derniere heure de connexion
        $user->setLastConnexion(time());
        
        $dbUser = new userManager();
        $this->connectedUser = $dbUser->validTokenConnect($user);
        
        unset($dbUser, $user);
      }
      else{
        setcookie(COOKIE_TOKEN, null, -1, "/");
        setcookie(COOKIE_EMAIL, null, -1, "/");
      }        
     };
    };
  }

  public function connectionAction(){
    $args = array(
          'email'   => FILTER_VALIDATE_EMAIL,
          'password'   => FILTER_SANITIZE_STRING 
    );
    $filteredinputs = filter_input_array(INPUT_POST, $args);

    // Array final à encoder en json
    $data = [];

    $requiredInputsReceived = true;
    foreach ($args as $key => $value) {
      if(!isset($filteredinputs[$key])){
        $requiredInputsReceived = false;        
        $this->echoJSONerror("inputs","missing input " . $key);
      }
    }

    if($requiredInputsReceived){
      $userManager = new userManager();
      $user = new user($filteredinputs);
      $dbUser = $userManager->tryConnect($user);

      if($dbUser instanceof user){
        // définition du token
        $time = time();
        $expiration = $time + (86400 * 7);
        $token = md5($dbUser->getId().$dbUser->getPseudo().$dbUser->getEmail().SALT.$time);
        $_SESSION[COOKIE_TOKEN] = $token;
        $_SESSION[COOKIE_EMAIL] = $dbUser->getEmail();
        $_SESSION['timeout'] = $expiration;
        setcookie(COOKIE_TOKEN, $token, $expiration, "/");
        setcookie(COOKIE_EMAIL, $dbUser->getEmail(), $expiration, "/");
        $data["connected"] = true;
        $this->connectedUser = $dbUser;
      }
      else if($dbUser == -1){
        $this->echoJSONerror("", "Vous avez été banni du site.");
      }
      else if($dbUser == -2){
        $this->echoJSONerror("", "Identifiants incorrects");
      }
      else{
       $this->echoJSONerror("", "Vos identifiants ne correspondent pas.");
      }

    }

    echo json_encode($data);
  }

  public function deconnectionAction(){
    $dbUser = new userManager();
    if($this->isVisitorConnected()){
      $this->connectedUser->setIsConnected(0);
      $this->connectedUser->setLastConnexion(time());

      $dbUser->disconnecting($this->connectedUser);

      setcookie(COOKIE_TOKEN, null, -1, "/");
      setcookie(COOKIE_EMAIL, null, -1, "/");
      session_destroy();
      echo json_encode(["connected" => false]);
    }
    // exit;
  }

  /*
  Fonction inutilisée
  public function getForm(){
    return [
      "options" =>[ "method"=>"POST", "action" => "", "submit"=>"Enregistrer"],
      "struct" => [
        "title"=>[ "label" => "Votre titre", "type" => "text", "id" => "title", "placeholder" => "Votre titre", "required"=>1],
        "password"=>[ "label" => "Votre Mot de passe", "type" => "password", "id" => "password", "placeholder" => "Votre Mot de passe", "required"=>1],
        "password2"=>[ "label" => "Votre Mot de passe", "type" => "password", "id" => "password2", "placeholder" => "Votre Mot de passe", "required"=>1],
        "title"=>[ "label" => "Votre titre", "type" => "text", "id" => "title", "placeholder" => "Votre titre", "required"=>1],
      ]
    ];
  }*/

  protected function echoJSONerror($name = '', $msg){
    if(strlen(trim($name)) > 0)
      $name = $name .' : ';
    
    $data['errors'] = $name.$msg;
    echo json_encode($data);
    flush();
    exit;
  }

  protected function envoiMail($destinataire, $objet, $contenu){
    /* CONFIGURATION DU MAIL*/

    $adrPHPM = "web/lib/PHPMailer/"; 
    include $adrPHPM."PHPMailerAutoload.php";
    try{
      $mail = new PHPmailer(true); 
      $mail->IsSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 465;
      $mail->SMTPAuth = true;
      $mail->Username = "breakemall.contact@gmail.com";
      $mail->Password = "EveryAm75";
      $mail->IsHTML(true); 

      $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for GMail
      //$mail->SMTPDebug  = 4; 

      //Expediteur (le site)

      $mail->From='breakemall.contact@gmail.com'; 
      $mail->FromName='Administrateur Breakem All'; 
      $mail->AddReplyTo('breakemall.contact@gmail.com');      
      $mail->AddAddress($destinataire);
      $mail->setFrom('breakemall.contact@gmail.com', 'Admin BEA');         
      
      $mail->CharSet='UTF-8';
      $mail->Subject=$objet; 


      $mail->Body=$contenu;

      //  Décommentez pour réactiver le mail
      $erreur = $mail->Send();

      if(isset($erreur) && $erreur){ 
        echo $mail->ErrorInfo; 
      }

      $mail->SmtpClose(); 
      unset($mail);
    }catch(Exception $e){

    }

  }

  private function checkInscriptionInputs(){
    // Imposer un FILTER_VALIDATE_INT sur les day/month/year afin de conserver le 0 devant, puis cast des valeurs en int
    $args = array(
      'pseudo'     => FILTER_SANITIZE_STRING,
      'email'   => FILTER_VALIDATE_EMAIL,
      'password'   => FILTER_SANITIZE_STRING,
      'password_check'   => FILTER_SANITIZE_STRING,
      'day'   => FILTER_SANITIZE_STRING,     
      'month'   => FILTER_SANITIZE_STRING,     
      'year'   => FILTER_SANITIZE_STRING,
      'cgu' => FILTER_VALIDATE_BOOLEAN   
    );
    $filteredinputs = filter_input_array(INPUT_POST, $args);
    $finalArr = [];

    foreach ($args as $key => $value) {
      if(!isset($filteredinputs[$key]))
      $this->echoJSONerror('inputs', 'manque champ '. $key);
    }

    $finalArr['email'] = $filteredinputs['email'];

    //Pseudo
    if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>15)
      $this->echoJSONerror('pseudo', 'votre pseudo doit faire entre 2 et 15 caracteres');
    else
      $finalArr['pseudo']=trim($filteredinputs['pseudo']);

    //Password
    if($filteredinputs['password']!==$filteredinputs['password_check'])
      $this->echoJSONerror('password', 'Les mots de passe doivent être les mêmes.');
    else if(strlen($filteredinputs['password'])<6)
      $this->echoJSONerror('password', 'Votre mot de passe doit faire 6 caractères minimum.');
    else
      $finalArr['password']=ourOwnPassHash($filteredinputs['password']);

    //Date de naissance
    $filteredinputs['month'] = (int) $filteredinputs['month'];
    $filteredinputs['day'] = (int) $filteredinputs['day'];
    $filteredinputs['year'] = (int) $filteredinputs['year'];
    
    if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
      $this->echoJSONerror('date', 'La date reçue est incorrect.');

    else{
      $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
      
      if(!$date)
        $this->echoJSONerror('date', 'Impossible de récupérer la date.');
      
      $finalArr['birthday'] = date_timestamp_get($date);
    }

    //CGU
    if(!$filteredinputs['cgu'])
      $this->echoJSONerror('cgu', 'Vous devez valider les conditions d\'utilisation du site.');

    return $finalArr; 
  }

  public function inscriptionAction(){
    //  checkInscriptionInputs valide les champs du formulaire d'inscription et 
    //    mets automatiquement fin aux process serveurs si elle trouve une erreur
    $checkedDatas = $this->checkInscriptionInputs();
    

    //Token du visiteur à valider par lien sur le mail envoyant un get de l'email et du token
    $token = md5($checkedDatas['pseudo'].$checkedDatas['email'].SALT.time());
    $checkedDatas['token'] = $token;

    $user = new user($checkedDatas);
    $userBDD = new userManager();

    // On check l'utilisation du pseudo
    $exist_pseudo=$userBDD->pseudoExists($user->getPseudo());
    if($exist_pseudo)
      $this->echoJSONerror('pseudo', 'Ce pseudo est déjà utilisé.');

    // On check celle de l'email
    $exist_email=$userBDD->emailExists($user->getEmail());
    if($exist_email)
      $this->echoJSONerror('email', 'Cette adresse email est déjà utilisée.');

    // On enregistre
    $userBDD->mirrorObject = $user;
    $userBDD->create();

    $contenuMail = "<h1>Bienvenue sur <a href=\"http://breakem-all.com\">Break-em-all.com</a></h1>";
      $contenuMail.="<div>Il ne vous reste plus qu'à valider votre adresse mail en cliquant sur le lien ci-dessous</div>";
      $contenuMail.="<a href=\"".WEBPATH."/confirmation/check?token=".$user->getToken()."&email=".htmlspecialchars($user->getEmail())."\">Valider mon inscription</a>";

    //Appel de la methode d'envoi du mail
    $this->envoiMail($user->getEmail(),'Inscription à Break-em-all‏',$contenuMail);

    echo json_encode(['success' => true]);
    $_SESSION['visiteur_semi_inscrit'] = time();
  }


  /*
   ** @params: (tournament) $t -> instance de tournament cherché en base 
   ** @return: (tournament) $t -> instance de tournament avec toutes les infos
   ** ##### Va chercher en base toutes les informations complémentaires du tournoi
   **   ### -> participants
      ### -> équipes (instances de teamtournaments)
      ### -> matchs (instances de matchs)
  */
  protected function getFullyAlimentedTournament(tournament $t, $ajaxCall=true){
    // Recuperer tous les participants
    $rm = new registerManager();
    $allRegistered = $rm->getTournamentParticipants($t);

    // Recuperer toutes les équipes avec le nombre de places prises
    $ttm = new teamtournamentManager();
    $allTournTeams = $ttm->getTournamentTeams($t);
    if(is_array($allTournTeams)){
      foreach ($allTournTeams as $key => $teamtournament) {
        $usersInTeam = $rm->getTeamTournamentUsers($teamtournament);
        if(is_array($usersInTeam))
          $teamtournament->addUsers($usersInTeam);
        if($teamtournament->getTakenPlaces() < $t->getMaxPlayerPerTeam())
          $t->addFreeTeam($teamtournament);
        else
          $t->addFullTeam($teamtournament);
      }
    }
    else{
      if($ajaxCall)
        $this->echoJSONerror("erreur: T_GTAT_1", "aucune équipe n'est créée pour ce tournoi !");
      return false;
    }
    // Recuperer tous les matchs du tournoi
    $matchsManager = new matchsManager();
    $allMatchs = $matchsManager->getMatchsOfTournament($t, true);
    // S'il y a des matchs
    if(!!$allMatchs && $allMatchs != "none"){
      $ttm = new teamtournamentManager();
      $rm = new registerManager();
      foreach ($allMatchs as $key => $m) {
        $teamsOfMatch = $ttm->getTeamsOfMatch($t, $m);
        if(!!$teamsOfMatch){
          foreach ($teamsOfMatch as $key => $teamOfMatch) {
            $usersInTeam = $rm->getTeamTournamentUsers($teamOfMatch);
            if(is_array($usersInTeam))
              $teamOfMatch->addUsers($usersInTeam);
            $m->addTeamTournament($teamOfMatch);
          }
        }
        $t->addMatch($m);
      }
      unset($ttm, $rm);
    }
    else{
      if($allMatchs == "none"){
        if($ajaxCall)
          $this->echoJSONerror("erreur: T_GTAT_2", "aucun match n'est créé pour ce tournoi !");
        else
          return $t;
      }
      return false;
    }
    // Arrivé ici on a récupéré les matchs et leurs équipes participantes, ainsi qu'une liste de toutes les équipes. Toutes ces entités sont remplies de leurs datas correspondantes et respectives
    return $t;
  }
}
/*
*
*/