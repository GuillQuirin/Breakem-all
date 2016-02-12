<?php

class tournoiController{

	public function tournoiAction(){
		$v = new View();
		$v->assign("css", "tournoi");
		$v->assign("title", "Tournois");
		$v->assign("content", "Liste principaux tournois jeux vidéos");
		$v->setView("tournoiDOM");
	}
	
}
