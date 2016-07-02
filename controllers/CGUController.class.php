<?php

class CGUController extends template{

	public function CGUAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "CGU");
		$v->assign("js", "CGU");
		$v->assign("title", "Conditions Générales d'utilisation");
		$v->setView("CGU");
	}
	
}
