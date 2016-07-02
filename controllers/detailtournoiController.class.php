<?php

class detailtournoiController extends template{

	public function detailtournoiAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "detailtournoi");
		$v->assign("js", "detailtournoi");
		$v->assign("title", "Tournoi <<name>>");
		$v->assign("content", "Tournoi <<name>>");
		$v->setView("detailtournoiDOM");
	}

	public function createFirstMatchsAction(){
		echo json_encode(['errors' => 'this is a test run']);
	}
	
}
