<?php 

class articles extends basesql{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id;
	protected $title;
	protected $content;

	//Permet d'exécuter le construct du parent c'est-à-dire basesql
	public function __construct(){
		parent::__construct();
	}
	//Simple fonction qui permet d'alimenter getter et setter pour les récupérer ou les définir dans le controller
	public function setIf($id){
		$this->id=$id;
	}
	public function setTitle($title){
		//Trim permet de nettoyer ce qu'on récupére sans les espaces en debut et fin 
		$this->title=trim($title);
	}
	public function setContent($content){
		$this->content=trim($content);
	}

	public function getId(){
		return $this->id;
	}
	public function getTitle(){
		return $this->title;
	}
	public function getContent(){
		return $this->content;
	}

}