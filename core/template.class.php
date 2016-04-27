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

  /* Cette methode fournira à la view reçue en parametre les propriétés nécessaires à l'affichage d'un user si ce dernier est bien connecté */
  protected function assignConnectedProperties(view $v){
    // var_dump("ASSIGNING CONNECTION PROPS");
    if($this->isVisitorConnected()){
      $v->assign("_isConnected", 1);
      $v->assign("_pseudo", $this->connectedUser->getPseudo());
      $v->assign("_email", $this->connectedUser->getEmail());
      $v->assign("_birthday", $this->connectedUser->getBirthday());
      $v->assign("_description", $this->connectedUser->getDescription());
      $v->assign("_kind", $this->connectedUser->getKind());
      $v->assign("_city", $this->connectedUser->getCity());
      $v->assign("_img", $this->connectedUser->getImg());
      $v->assign("_name", $this->connectedUser->getName());
      $v->assign("_firstname", $this->connectedUser->getFirstname());
      $v->assign("_idTeam", $this->connectedUser->getIdTeam());
      $v->assign("_id", $this->connectedUser->getId());
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
        $user->setLastConnection(time());
        // var_dump($user);
        $dbUser = new userManager();
        $this->connectedUser = $dbUser->validTokenConnect($user);
        // var_dump($this->connectedUser);
        unset($dbUser, $user);
      }
      else
        unset($_SESSION[COOKIE_EMAIL], $_SESSION[COOKIE_TOKEN]);
     };
    };

    // exit;
  }

  public function connectionAction(){
    /*if(isset($_SESSION[COOKIE_EMAIL]){
      unset($_SESSION[COOKIE_EMAIL]);
    }
    if(isset($_SESSION[COOKIE_TOKEN]){
      unset($_SESSION[COOKIE_TOKEN]);
    }*/
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
        $data["errors"]["inputs"] = "missing input " . $key;
      }
    }

    if($requiredInputsReceived){
      $userManager = new userManager();
      $user = new user($filteredinputs);
      $dbUser = $userManager->tryConnect($user);
      // unset($_SESSION);
      if(!!$dbUser){
        // définition du token
        $time = time();
        $expiration = $time + (86400 * 7);
        $token = md5($dbUser->getId().$dbUser->getPseudo().$dbUser->getEmail().SALT.$time);
        // var_dump($token);
        // exit;
        $_SESSION[COOKIE_TOKEN] = $token;
        $_SESSION[COOKIE_EMAIL] = $dbUser->getEmail();
        setcookie(COOKIE_TOKEN, $token, $expiration, "/");
        setcookie(COOKIE_EMAIL, $dbUser->getEmail(), $expiration, "/");
        $data["connected"] = true;
        $this->connectedUser = $dbUser;
      }else{
        $data["errors"]["user"] = "password and email don't match";
      }
    }

    echo json_encode($data);
  }
  public function deconnectionAction(){
    $dbUser = new userManager();
    if($this->isVisitorConnected()){
      $this->connectedUser->setIsConnected(0);
      $this->connectedUser->setLastConnection(time());

      $dbUser->disconnecting($this->connectedUser);

      unset($_COOKIE[COOKIE_TOKEN], $_COOKIE[COOKIE_EMAIL]);
      session_destroy();
    }
    header('Location: ' . WEBPATH);
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

  public function registerAction(){
   $args = array(
         'pseudo'     => FILTER_SANITIZE_STRING,
         'email'   => FILTER_VALIDATE_EMAIL,
         'password'   => FILTER_SANITIZE_STRING,
         'password_check'   => FILTER_SANITIZE_STRING,
         'day'   => FILTER_VALIDATE_INT,     
         'month'   => FILTER_VALIDATE_INT,     
         'year'   => FILTER_VALIDATE_INT     
   );
   $filteredinputs = filter_input_array(INPUT_POST, $args);
   // Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
   $finalArr = [];

   foreach ($args as $key => $value) {
     if(!isset($filteredinputs[$key]))
       die("FAUX: ".$filteredinputs[$key]);
   }

   $finalArr['email'] = $filteredinputs['email'];

   if(strlen($filteredinputs['pseudo'])<2 || strlen($filteredinputs['pseudo'])>45)
         die("FAIL pseudo"); 
        else
           $finalArr['pseudo']=trim($filteredinputs['pseudo']);

        if($filteredinputs['password']!==$filteredinputs['password_check'])
         die("FAIL pwd");
        else
         $finalArr['password']=password_hash($filteredinputs['password'], PASSWORD_DEFAULT);

        if(!checkdate($filteredinputs['month'], $filteredinputs['day'], $filteredinputs['year']))
         die("FAIL date crea");
        else{
         $date = DateTime::createFromFormat('j-n-Y',$filteredinputs['day'].'-'.$filteredinputs['month'].'-'.$filteredinputs['year']);
         if(!$date)
           die("FAIL date format");
         $finalArr['birthday'] = date_timestamp_get($date);
        }
        
        // Le user ici servira d'image des user recuperes par la bdd et tout juste créés
        $user = new user($finalArr);
        // var_dump($user);

        // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
        $userBDD = new userManager();
        // On check l'utilisation du pseudo
        $exist_pseudo=$userBDD->pseudoExists($user->getPseudo());
        if($exist_pseudo)
         die("User already used !");

        // On check celle de l'email
        $exist_email=$userBDD->emailExists($user->getEmail());
        if($exist_email)
         die("Email already used");

        // On enregistre !
        $userBDD->create($user);

        header('Location: confirmation');
  }

}
/*
*
*/