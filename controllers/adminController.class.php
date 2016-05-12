<?php
class adminController extends template{
    public function adminAction(){
        //var_dump($_isAdmin);exit;
        //if(isset($_isAdmin) && $_isAdmin == 1){
            $v = new view();
    		$this->assignConnectedProperties($v);
            $v->assign("css", "admin");
            $v->assign("js", "admin");
            $v->assign("title", "admin");
            $v->assign("content", "Liste des Utilisateurs");

            $admin = new adminManager();

    		$listejoueurs = $admin->getListUser();  

            $listeplatforms = $admin->getListPlatform();
            
            $listesignalement = $admin->getListReports();

            $v->assign("listejoueur",$listejoueurs);

            $v->assign("listeplatform",$listeplatforms);

            $v->assign("listesignalement",$listesignalement);
           
            $v->setView("/includes/admin/accueil", "template");
        /*}
        else //On affiche la 404 pour faire croire que le mec tape n'importe quoi
            header('Location: '.WEBPATH.'/404');*/
    }
}