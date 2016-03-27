<?php 
class teamController extends template{
	public function teamAction(){
		$v = new View();
		$v->assign("css", "team");
		$v->assign("js", "team");
		$v->assign("title", "Team");
		$v->assign("content", "Liste des Teams");
		$v->setView("team");
	}
}