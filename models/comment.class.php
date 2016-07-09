<?php 

class comment{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;

	protected $idUser = null;
	protected $pseudo = null;
	
	protected $idEntite = null;
	protected $nomTeam = null;
	
	protected $date = null;
	protected $comment = null;
	protected $status = null;
	protected $entite = null;

	protected $img = null;


	//Permet d'exécuter le construct du parent c'est-à-dire basesql
	public function __construct(array $data){
		$this->hydrate($data);
	}

	private function hydrate(array $data){
		foreach ($data as $key => $value) {
			$method = 'set'.ucfirst($key);
			if (method_exists($this, $method)) {
				$this->$method($value);
			}
		}
	}

	private function setId($v){
		$this->id=$v;
	}
	private function setIdUser($v){
		$this->idUser=$v;
	}
	private function setPseudo($v){
		$this->pseudo=$v;
	}
	private function setIdEntite($v){
		$this->idEntite=$v;
	}
	private function setNomTeam($v){
		$this->nomTeam=$v;
	}
	private function setDate($v){
		$this->date=$v;
	}
	private function setComment($v){
		$this->comment=$v;
	}
	private function setStatus($v){
		$this->status=$v;
	}
	private function setEntite($v){
		$this->entite=$v;
	}
	private function setImg($v){
		$this->img=$v;
	}

	public function getId(){return $this->id;}
	public function getIdUser(){return $this->idUser;}
	public function getPseudo(){return $this->pseudo;}
	public function getIdEntite(){return $this->idEntite;}
	public function getNomTeam(){return $this->nomTeam;}
	public function getDate(){return $this->date;}
	public function getComment(){return $this->comment;}
	public function getStatus(){return $this->status;}
	public function getEntite(){return $this->entite;}
	public function getImg($upload=false){
		if($upload){
			return $this->img;
		}
		else{
			if(strlen(trim($this->img))!=0 && file_exists(getcwd()."/web/img/upload/".$this->img))
				return WEBPATH."/web/img/upload/".$this->img;

			return WEBPATH."/web/img/upload/default.jpg";	
		}
	}
}