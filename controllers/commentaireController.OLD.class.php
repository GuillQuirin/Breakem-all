<?php
class commentaireController extends template{
    public function commentaireAction(){
        $v = new view();
		$this->assignConnectedProperties($v);
        $v->assign("css", "commentaire");
        $v->assign("js", "commentaire");
        $v->assign("title", "commentaire");
        $v->assign("content", "Liste des Commentaire");
        $v->setView("commentaire");
    }
}