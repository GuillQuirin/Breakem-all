<?php

class configurationController{

	public function configurationAction(){
		$v = new View();
		$v->assign("css", "configuration");
		$v->assign("js", "configuration");
		$v->assign("title", "configuration");
		$v->assign("content", "Configurer votre profil");
		$v->setView("configuration");
	}
	
}
