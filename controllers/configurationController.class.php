<?php

class configurationController extends template{

	public function configurationAction(){
		$v = new View();
		$v->assign("css", "configuration");
		$v->assign("js", "configuration");
		$v->assign("title", "configuration");
		$v->assign("content", "Configurer votre profil");
		$v->assign("MAJ","0");

		if(isset($_POST['id'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$userBDD = new userManager();
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
				'img' => FILTER_SANITIZE_STRING,
				'idTeam' => FILTER_SANITIZE_STRING,
				'token' => FILTER_SANITIZE_STRING
			);
			$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));

			$user = $userBDD->getUser($filteredinputs);

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
	
	public function updateAction(){
		// $curl = curl_init(); 
		// curl_setopt($curl, CURLOPT_URL, "http://localhost:8888/esgi/Breakem-all/configuration"); 
		// curl_setopt($curl, CURLOPT_POST, 1); 
		// curl_setopt($curl, CURLOPT_POSTFIELDS, 'id=1'); 
		// curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		// $page = curl_exec($curl);
		// curl_close($curl);
		if(isset($_POST['id'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$userBDD = new userManager();
			//var_dump($_POST);
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
				'img' => FILTER_SANITIZE_STRING,
				'idTeam' => FILTER_SANITIZE_STRING,
				'token' => FILTER_SANITIZE_STRING
			);
			$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
			//var_dump($filteredinputs);
			
			//Recherche de l'utilisateur à modifier selon son id
			$rechUser['id']=$_POST['id'];
			$user = $userBDD->getUser($rechUser);

			

			if($user!==FALSE){
					foreach ($args as $key => $value) {
						if($key!=="id"){
							$method = 'set'.ucfirst($key);
							if (method_exists($user, $method)) {
								var_dump($user->$method());
							}
							var_dump($args);
						}
					}
					$v->assign("MAJ","1");
				}
				else{
					var_dump("erreur pas d'utilisateur trouvé");
				}
		}
		else{
			var_dump("erreur $_POST");
		}
	}

}
