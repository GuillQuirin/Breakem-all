<?php

class RSSController extends template{

	public function RSSAction(){
		
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("content", "Fiche de l'utilisateur");

		$v->setView("RSS","notemplate");
	}
}
