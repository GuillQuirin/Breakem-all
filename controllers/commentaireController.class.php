<?php
<<<<<<< HEAD
class commentaireController{
    public function commentaireAction(){
        $v = new View();
=======
class commentaireController extends template{
    public function commentaireAction(){
        $v = new View();
		$this->assignConnectedProperties($v);
>>>>>>> 5ccafac37c19b5147e6d999a92a1f3bbd55409c0
        $v->assign("css", "commentaire");
        $v->assign("js", "commentaire");
        $v->assign("title", "commentaire");
        $v->assign("content", "Liste des Commentaire");
        $v->setView("commentaire");
    }
}