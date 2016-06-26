<?php
class listejoueursController extends template{
    
    public function listejoueursAction(){
            $v = new view();
    		$this->assignConnectedProperties($v);
            $v->assign("css", "listejoueurs");
            //$v->assign("js","listejoueurs");   
            $v->assign("title", "Liste des joueurs");
            $v->assign("content", "Liste des Utilisateurs");

            $userBDD = new userManager();
            $listuser = $userBDD->getAllUser();

            $v->assign("liste",$listuser);
           
            $v->setView("listejoueurs", "template");
    }

}