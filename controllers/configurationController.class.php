<?php

class configurationController extends template{

	public function configurationAction(){
		$v = new View();
		$v->assign("css", "configuration");
		$v->assign("js", "configuration");
		$v->assign("title", "configuration");
		$v->assign("content", "Configurer votre profil");

		if(isset($_POST['id'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$userBDD = new userManager();
			var_dump($_POST);
			$args = array(
				'id' => FILTER_SANITIZE_STRING,
				'pseudo' => FILTER_SANITIZE_STRING,
				'name' => FILTER_SANITIZE_STRING,
				'firstname' => FILTER_SANITIZE_STRING,
				'birthday' => FILTER_SANITIZE_STRING,
				'description' => FILTER_SANITIZE_STRING,
				'kind' => FILTER_SANITIZE_STRING,
				'city' => FILTER_SANITIZE_STRING,
				'email' => FILTER_VALIDATE_EMAIL,
				'status' => FILTER_SANITIZE_STRING,
				'img_user' => FILTER_SANITIZE_STRING,
				'idTeam' => FILTER_SANITIZE_STRING,
				'token' => FILTER_SANITIZE_STRING
			);
			$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

			$user = $userBDD->getUser($filteredinputs);

			

			if(1){//$user!==FALSE){
					foreach ($args as $key => $value) {
						$method = 'get'.ucfirst($key);
						if (method_exists($user, $method)) {
							$v->assign($key, $user->$method());
						}
					}
				}
				else{
					$v->assign("err", "1");
				}
		}
		else{
			$v->assign("err", "1");
		}
		$v->setView("configuration");
	}
	
	public function updateAction(){
		var_dump('TEST');
	}

}
