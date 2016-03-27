<?php

class detailtournoiController extends template{

	public function detailtournoiAction(){
		$v = new View();
		$v->assign("css", "detailtournoi");
		$v->assign("js", "detailtournoi");
		$v->assign("title", "Tournoi <<name>>");
		$v->assign("content", "Tournoi <<name>>");
		$v->setView("detailtournoiDOM");
	}
	
}
