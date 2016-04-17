<?php
class indexController extends template{

	public function indexAction($requiredPosts){
		$v = new view();
		$v->assign("css", "index");
		$v->assign("js", "index");
		$v->setView("Index");

	}
}
