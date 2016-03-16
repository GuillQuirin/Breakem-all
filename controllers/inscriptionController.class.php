<?php

class inscriptionController{

	public function inscriptionAction(){
		$v = new View();
		$v->assign("css", "inscription");
		$v->assign("js", "inscription");
		$v->assign("title", "Rejoignez-nous !");
		$v->assign("content", "S'inscrire à Break-em all !");
		$v->setView("inscription");
	}

	public function verifyAction(){
		var_dump($_POST);
	}
	
}
