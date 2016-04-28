<?php
class adminController extends template{
    public function adminAction(){
        $v = new View();
		$this->assignConnectedProperties($v);
        $v->assign("css", "admin");
        $v->assign("js", "admin");
        $v->assign("title", "admin");
        $v->assign("content", "Liste des Commentaire");
        $v->setView("/includes/admin/accueil", "template_back");
    }
}