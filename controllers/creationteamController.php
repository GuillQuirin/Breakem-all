<?php 

class creationteamController extends template {

	public function creationteamAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		/*$v->assign("css", "creationteam");
		$v->assign("js", "creationteam");
		$v->assign("title", "Créer ta Team");
		$v->assign("content", "Création de ta Team");*/
		$v->setView("creationteam");
	
	}
}