<?php

class LoadFailController{
	public function __construct(){
		$v = new view();

		$v->assign("css", "404");
		$v->assign("js", "404");
		$v->assign("title", "Erreur 404");
        $v->assign("content", "Erreur 404, <a href='".WEBPATH."'>Retour à l'accueil</a>.");

        $v->setView("templatefail", "templatefail");
    }
}