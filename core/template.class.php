<?php
class template{
  public function __construct(){
    /*Tant que chaque controller herite de template, le token sera vérifié à chaque rafraichissement de page*/
    $this->checkToken();
  }

  protected function checkToken(){
    $args = array(
      'breakemallemail'   => FILTER_VALIDATE_EMAIL,
      'breakemalltoken'   => FILTER_SANITIZE_STRING
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
      $arr['token'] = $filteredcookies['breakemalltoken'];
      $arr['email'] = $filteredcookies['breakemallemail'];
      $user = new user($arr);
      $userManager = new userManager();
      $dbUser = $userManager->tokenConnect($user);

      if(!$dbUser){
        /*REDIRIGER LE MEC VERS LA SORTIE AC UN PTIT SESSION DESTROY OKLM*/
        echo "COOKIE FAIL MAGGLE";
        unset($_SESSION);
        session_destroy();
      }else{
        /* LE MEC EST BIEN IDENTIFIE !!!*/
        $_SESSION['token'] = $dbUser->getToken();
        $_SESSION['email'] = $dbUser->getEmail();
        // var_dump($dbUser);
      }
    };
  }

  public function connexionAction(){
    $requiredPosts = array(
      'email'   => FILTER_VALIDATE_EMAIL,
      'password'   => FILTER_SANITIZE_STRING
    );
    $filteredinputs = filter_input_array(INPUT_POST, $requiredPosts);
    // Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
    $finalArr = [];
    foreach ($requiredPosts as $key => $value) {
      if(!isset($filteredinputs[$key]))
        die("Erreur: ".$key);
      $finalArr[$key] = escapeshellcmd(trim($filteredinputs[$key]));
    }

    $user = new user($finalArr);
    $userManager = new userManager();
    $userDB = $userManager->tryConnect($user->getEmail());
    if($userDB === FALSE){
      unset($userManager, $userDB);
      die("Email inconnu !");
    }
    // var_dump($userDB);

    if(password_verify($user->getPassword(), $userDB->getPassword())){
      //var_dump($user);
      //var_dump("Password et email valides !");
      foreach ($userDB as $key => $value) {
        $method = 'get'.ucfirst($value);
        if (method_exists($userDB, $method))
        $_SESSION['connected'][$key] = $userDB->$method();                            
      }
      var_dump($_SESSION);
    }
    else{
      unset($userManager, $userDB);
      die("Password fail !");
    }
  }

  public function deconnexionAction(){
    if(isset($_SESSION['id'])){

      $userBDD = new userManager();

      $args = array(
        'pseudo' => FILTER_SANITIZE_STRING
      );
      $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

      $user = $userBDD->getUser($filteredinputs);

      $user->setOnline(0);
      $user->setLastTime(time());

      session_destroy($_SESSION);

      $v = new View();
      $v->assign("css", "index");
      $v->assign("js", "index");
      $v->assign("title", "Index");
      $v->assign("content", "Bienvenue sur Breakem-all !");
      $v->assign("login", FALSE);

      $v->setView("index");
    }
  }
}
