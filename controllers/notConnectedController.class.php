<?php
/*
*
*/
class notConnectedController extends template{

	public function __construct(){
		parent::__construct();
		if(($this->isVisitorConnected())){
			header('Location: ' .WEBPATH.'/index');
		}
	}

	public function notConnectedAction(){
		$v = new view();
		$v->assign("css", "notConnected");
		$v->setView("notConnected");
	}
}