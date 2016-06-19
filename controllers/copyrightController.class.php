<?php

class copyrightController extends template{

	public function copyrightAction(){
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "copyright");
		$v->assign("js", "copyright");
		$v->assign("title", "Règlement");
		$v->setView("copyright");
	}
	
}
