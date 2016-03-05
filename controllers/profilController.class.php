<?php

class profilController{

	public function profilAction(){
		$v = new View();
		$v->assign("css", "profil");
		$v->assign("js", "profil");
		$v->assign("title", "Profil");
		$v->assign("content", "Fiche de l'utilisateur");
		$v->setView("profil");
	}
	
}
