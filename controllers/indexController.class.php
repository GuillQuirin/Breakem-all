<?php
<<<<<<< HEAD

class indexController{

	public function indexAction(){
		echo "<br> indexAction was called !<br>";
	}
	
}

=======
class indexController{

	public function indexAction($args){

		$article = new articles();
		$article->setTitle("Mon titre");
		$article->setContent("Description de ma page");
		$article->save();

		$v = new view();
		$v->assign("css", "index");
		$v->assign("js", "index");
		$v->setView("index");

	}
	public function testAction($args){
		echo "Petit test";
	}
}
>>>>>>> master
