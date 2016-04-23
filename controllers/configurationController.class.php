<?php

class configurationController extends template{

	public function configurationAction(){
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "configuration");
		$v->assign("js", "configuration");
		$v->assign("title", "configuration");
		$v->assign("content", "Configurer votre profil");
		$v->assign("MAJ","0");
		//var_dump($_SESSION);
		if(isset($_SESSION['connected'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$args = array('name','firstname','birthday','description','kind','city','email','status','img','idTeam','token');
			$user = $_SESSION['connected'];
			var_dump(get_object_vars($user));
			if($user!==FALSE){
				foreach ($args as $key => $value) {
					$method = 'get'.ucfirst($value);
					if (method_exists($user, $method)) {
						$v->assign($value, $user->$method());
					}
					//var_dump($value);
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
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "configuration");
		$v->assign("js", "configuration");
		$v->assign("title", "configuration");
		$v->assign("content", "Configurer votre profil");
		$v->assign("MAJ","0");
		var_dump($_SESSION);
		if(isset($_SESSION['connected'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$args = array(
				'name' => FILTER_SANITIZE_STRING,
				'firstname' => FILTER_SANITIZE_STRING,
				'birthday' => FILTER_SANITIZE_STRING,
				'description' => FILTER_SANITIZE_STRING,
				'kind' => FILTER_SANITIZE_STRING,
				'city' => FILTER_SANITIZE_STRING,
				'email' => FILTER_VALIDATE_EMAIL,
				'status' => FILTER_SANITIZE_STRING,
				'img' => FILTER_SANITIZE_STRING,
				'idTeam' => FILTER_SANITIZE_STRING,
				'token' => FILTER_SANITIZE_STRING
			);
			$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

			$user = $_SESSION['connected'];

			if($user!==FALSE){
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

}
