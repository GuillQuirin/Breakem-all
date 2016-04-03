<?php

class creationtournoiController{

	public function creationtournoiAction(){
		$v = new View();
		$v->assign("css", "creationtournoi");
		$v->assign("js", "creationtournoi");
		$v->assign("title", "Création Tournoi");
		$v->assign("content", "Création Tournoi");
		$v->setView("creationtournoiDOM");
	}
	
}
