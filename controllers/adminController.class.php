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

        $listeplateforms = $admin->getListPlateform();
        
        $v->assign("listejoueur",$listejoueurs);

        $v->assign("listeplateform",$listeplateforms);

        $v->setView("/includes/admin/accueil", "template");
    }
}