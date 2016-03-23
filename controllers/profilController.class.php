<?php

class profilController{

	public function profilAction(){
		if(isset($_GET['pseudo'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$userBDD = new userManager();

			$args = array(
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
				'idTeam' => FILTER_SANITIZE_STRING
			);
			$filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

			$user = $userBDD->getUser($filteredinputs);

			// Si $user === FALSE : soit pas de user trouvé, soit pbm de requete
			// 		Si pbm de requete faire un var_dump de $sql
			var_dump($user);

			// else{
			// 	// $v->assign("err", "1");
			// }

			
			// $v->assign("css", "profil");
			// $v->assign("js", "profil");
			// $v->assign("title", "Profil");
			// $v->assign("content", "Fiche de l'utilisateur");
			
			// $v->setView("profil");
		}
	}
}
