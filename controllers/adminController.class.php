<?php
class adminController extends template{
    public function adminAction(){
        $v = new view();
		$this->assignConnectedProperties($v);
        $v->assign("css", "admin");
        $v->assign("js", "admin");
        $v->assign("title", "admin");
        $v->assign("content", "Liste des Utilisateurs");

        $admin = new adminManager();

		$listejoueurs = $admin->getListUser();  

        $listeplatforms = $admin->getListPlatform();
        
        $v->assign("listejoueur",$listejoueurs);

        $v->assign("listeplatform",$listeplatforms);

        $v->setView("/includes/admin/accueil", "template");
    }
}