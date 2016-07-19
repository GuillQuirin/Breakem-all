<?php

class mestournoisController extends template{

	public function __construct(){
		parent::__construct();
		if(!($this->isVisitorConnected())){
			header('Location: ' .WEBPATH.'/index');
		}
	}

	public function mestournoisAction(){
  		$v = new view();
		$this->assignConnectedProperties($v);
        $v->assign("css", "mestournois");
        $v->assign("js", "mestournois");
        $v->assign("title", "tournois");
        $v->assign("content", "Liste des tournois");
        $v->setView("mestournois", "template");
	}
	
}

