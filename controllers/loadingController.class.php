<?php

class loadingController{
	public function __construct(){
		$v = new View();
		$v->assign("css", "loading");
		$v->assign("js", "loading");
		$v->assign("title", "En chargement");
		$v->assign("content", "Page de Chargement");
        $v->setView("loading");
    }
}