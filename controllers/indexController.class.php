<?php
class indexController{

	public function indexAction($requiredPosts){

		$article = new articles();
		$article->setTitle("Mon titre");
		$article->setContent("Description de ma page");
		$article->save();

		$v = new view();
		$v->assign("css", "index");
		$v->assign("js", "index");
		$v->setView("index");

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
			$user = $userDB;
			unset($userManager, $userDB);
			var_dump($user);
			die("Password et email valides !");
		}else{
			unset($userManager, $userDB);
			die("Password fail !");
		}
	}
}
