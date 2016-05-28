<?php
class listetournoisController extends template{
    
    public function listetournoisAction(){
        $v = new view();
		$this->assignConnectedProperties($v);
        $v->assign("css", "listetournois");
        $v->assign("js","listetournois");   
        $v->assign("title", "Liste des tournois");
        $v->assign("content", "Liste des tournois");

        $tournoiBDD = new tournamentManager();
        $listtournament = $tournoiBDD->getUnstartedTournaments();

        $v->assign("liste",$listtournament);
       
        $v->setView("listetournois", "template");
    }

}