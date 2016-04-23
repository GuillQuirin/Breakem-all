<?php

class resultatController extends template{

	public function resultatAction(){
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "resultat");
		$v->assign("js", "resultat");
		$v->assign("title", "Tous les podiums !");
		$v->assign("content", "Les résultats en ligne !");
		$v->setView("resultat");
	}
	
}
