<?php

class tournoiController extends template {

	public function tournoiAction(){
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "tournoi");
		$v->assign("js", "tournoi");
		$v->assign("title", "Tournois");
		$v->assign("content", "Liste principaux tournois jeux vidéos");
		$v->setView("tournoiDOM");
	}
}
