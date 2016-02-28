<?php
class indexController{

	public function indexAction($args){

		$article = new articles();
		$article->setTitle("Mon titre");
		$article->setContent("Description de ma page");
		$article->save();

		$v = new view();
		//indexIndex : Le premier index c'est le controller et le deuxième c'est l'action
		//Deuxième argument : le template si on met nawak il va mettre l'erreur "le template n'existe pas" par défaut il est sur template.php
		$v->setView("index");
		//Grace a assign je peux faire passer une variable du controller vers la vue
		$v->assign("pseudo","meg");

	}
	public function testAction($args){
		echo "Petit test";
	}
}