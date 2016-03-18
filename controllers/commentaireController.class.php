<?php
class commentaireController{
    public function commentaireAction(){
        $v = new View();
        $v->assign("css", "commentaire");
        $v->assign("js", "commentaire");
        $v->assign("title", "commentaire");
        $v->assign("content", "Liste des Commentaire");
        $v->setView("commentaire");
    }
}