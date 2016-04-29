<?php

class classementController extends template{

	public function classementAction(){
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "classement");
		$v->assign("js", "classement");
		$v->assign("title", "Tous les podiums !");
		$v->assign("content", "Les résultats en ligne !");
		$v->setView("classement");
	}
	
}
