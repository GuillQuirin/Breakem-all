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

    if($this->isVisitorConnected()){
      $v->assign("_isConnected", 1);
      $v->assign("_id", $this->connectedUser->getId());
      $v->assign("_name", $this->connectedUser->getName());
      $v->assign("_firstname", $this->connectedUser->getFirstname());
      $v->assign("_pseudo", $this->connectedUser->getPseudo());
      $v->assign("_birthday", $this->connectedUser->getBirthday());
      $v->assign("_description", $this->connectedUser->getDescription());     
      $v->assign("_kind", $this->connectedUser->getKind());
      $v->assign("_city", $this->connectedUser->getCity());
      $v->assign("_email", $this->connectedUser->getEmail());
      $v->assign("_img", $this->connectedUser->getImg()); 
      $v->assign("_idTeam", $this->connectedUser->getIdTeam());
      
      // $v->assign("_password", $this->connectedUser->getPassword());
    }
  }
  
  protected function isVisitorConnected(){

    if($this->connectedUser instanceof user)
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
    // var_dump($filteredcookies);
    // exit; 
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

    // exit;
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
      if(!!$dbUser){
        // définition du token
        $time = time();
        $expiration = $time + (86400 * 7);
        $token = md5($dbUser->getId().$dbUser->getPseudo().$dbUser->getEmail().SALT.$time);
        $_SESSION[COOKIE_TOKEN] = $token;
        $_SESSION[COOKIE_EMAIL] = $dbUser->getEmail();
        setcookie(COOKIE_TOKEN, $token, $expiration, "/");
        setcookie(COOKIE_EMAIL, $dbUser->getEmail(), $expiration, "/");
        $data["connected"] = true;
        $this->connectedUser = $dbUser;
      }else{
       $this->echoJSONerror("user", "password and email don't match");
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
    }
    // exit;
  }

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
  }

  protected function echoJSONerror($name, $msg){
    $data['errors'][$name] = $msg;
    echo json_encode($data);
    flush();
    exit;
  }

  private function attenteValid(user $user){
    /* CONFIGURATION DU MAIL*/

    $adrPHPM = "web/lib/PHPMailer/"; 
    include $adrPHPM."PHPMailerAutoload.php";
    try{
      $mail = new PHPmailer(); 
      $mail->IsSMTP();
      $mail->IsHTML(true); 

      //SMTP du FAI
      
      $mail->Host='smtp.free.fr'; // Free
      //$mail->Host='smtp.bouygtel.fr'; // Bouygues
      //$mail->Host='smtp.orange.fr'; //Orange
      //$mail->Host='smtp.sfr.fr'; //SFR
      //$mail->Host='smtp.??????.fr'; //OVH
      
      //Expediteur (le site)
      $mail->From='admin@Bea.fr'; 
      $mail->AddReplyTo('admin@Bea.fr');      
      $mail->set('FromName', 'Admin BEA');      

      //Destinataire (l'utilisateur)
      $mail->AddAddress($user->getEmail());
      
      $mail->CharSet='UTF-8';
      $mail->Subject='Inscription à Break em all'; 

      $contenuMail = "
              <h1>Bienvenue sur <a href=\"http://breakem-all.com\">Break-em-all.com</a></h1>
              <div>Il ne vous reste plus qu'à valider votre adresse mail en cliquant sur le lien ci-dessous</div>
              <a href=\"http://localhost".WEBPATH."/confirmation/check?token=".$user->getToken()."&email=".htmlspecialchars($user->getEmail())."\">Valider mon inscription</a>";

      $mail->Body=$contenuMail;

      if(!$mail->Send()){ //Teste le return code de la fonction 
        echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7) 
      }
      else{      
        echo 'Mail envoyé avec succès'; 
      } 


      $mail->SmtpClose(); 
      unset($mail);
    }catch(Exception $e){

    }

    //Initialisation d'une session autorisant 
    // le visiteur à accèder à la page de confirmation
    // $_SESSION['userToCheck']=1;
    echo json_encode(['success' => true]);
    // header('Location: '.WEBPATH.'/confirmation');
  }

  private function checkRegisterInputs(){
    // Imposer un FILTER_VALIDATE_INT sur les day/month/year suppriment les valeurs numeriques ayant un 0 devant
    // Genre 09 --> part au carton alors que 9 passe trql
    //  --> SOLUTION --> FILTER_SANITIZE_STRING sur les chiffres attendus puis cast des valeurs en int
    $args = array(
      'pseudo'     => FILTER_SANITIZE_STRING,
      'email'   => FILTER_VALIDATE_EMAIL,
      'password'   => FILTER_SANITIZE_STRING,
      'password_check'   => FILTER_SANITIZE_STRING,
      'day'   => FILTER_SANITIZE_STRING,     
      'month'   => FILTER_SANITIZE_STRING,     
      'year'   => FILTER_SANITIZE_STRING     
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
    /*#############################################
                    -----  TODO -----
      VERIFIER UN MINIMUM LA COMPLEXITE DU PASSWORD
    */#############################################
    if($filteredinputs['password']!==$filteredinputs['password_check'])
      $this->echoJSONerror('password', 'votre pseudo doit faire entre 2 et 15 caracteres');
    else
      $finalArr['password']=ourOwnPassHash($filteredinputs['password']);

    //Date de naissance
    $filteredinputs['month'] = (int) $filteredinputs['month'];
    $filteredinputs['day'] = (int) $filteredinputs['day'];
    $filteredinputs['year'] = (int) $filteredinputs['year'];
    
    if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
      $this->echoJSONerror('date', 'La date reçue a fail !');

    else{
      $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
      if(!$date)
        $this->echoJSONerror('date', 'La date reçue a fail !');
      $finalArr['birthday'] = date_timestamp_get($date);
    }
    return $finalArr; 
  }

  public function registerAction(){
    //  checkRegisterInputs valide les champs du formulaire d'inscription et 
    //    mets automatiquement fin aux process serveurs si elle trouve une erreur
    $checkedDatas = $this->checkRegisterInputs();
    

    //Token du visiteur à valider par lien sur le mail envoyant un get de l'email et du token
    $token = md5($checkedDatas['pseudo'].$checkedDatas['email'].SALT.time());
    $checkedDatas['token'] = $token;

    $user = new user($checkedDatas);

    // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
    $userBDD = new userManager();

    // On check l'utilisation du pseudo
    $exist_pseudo=$userBDD->pseudoExists($user->getPseudo());
    if($exist_pseudo)
     $this->echoJSONerror('pseudo', 'ce pseudo est déjà utilisé');

    // On check celle de l'email
    $exist_email=$userBDD->emailExists($user->getEmail());
    if($exist_email)
     $this->echoJSONerror('email', 'cet email est déjà utilisé');

    // On enregistre
    $userBDD->create($user);

    //Appel de la methode d'envoi du mail
    //  Décommentez pour réactiver le mail
    // $this->attenteValid($user);

    echo json_encode(['success' => true]);
    $_SESSION['visiteur_semi_inscrit'] = time();
  }

}
/*
*
*/