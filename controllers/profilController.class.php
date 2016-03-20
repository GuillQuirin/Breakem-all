<?php

class profilController{

	public function profilAction($args){

		$v = new View();
		$user = new user();

		var_dump($args);
		if(isset($args['id'])){
			$v->assign("pseudo", "test");
			$v->assign("online", "1");
			$v->assign("description", "J'aime la vie");
		}

		else{
			$v->assign("err", "1");
		}

		
		$v->assign("css", "profil");
		$v->assign("js", "profil");
		$v->assign("title", "Profil");
		$v->assign("content", "Fiche de l'utilisateur");
		
		$v->setView("profil");
	}
}
