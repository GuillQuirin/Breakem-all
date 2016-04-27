<?php

class creationtournoiController extends template{

	public function creationtournoiAction(){
		$v = new View();
		$this->assignConnectedProperties($v);
		$v->assign("css", "creationtournoi");
		$v->assign("js", "creationtournoi");
		$v->assign("title", "Création Tournoi");
		$v->assign("content", "Création Tournoi");
		$v->setView("creationtournoiDOM");
	}

	public function getGameTypesAction(){
		$gm = new typegameManager();
		$types = $gm->getAllTypes();
		// print_r($types);
		$data['types'] = [];
		foreach ($types as $key => $arr) {
			$data['types'][] = $arr;
		}
		echo json_encode($data);
	}
	
}
