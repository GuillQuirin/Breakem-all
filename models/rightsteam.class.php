<?php 

class rightsteam{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $idUser = null;
	protected $idTeam = null;
	protected $right = null;
	protected $title = null;
	protected $description = null;

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
	private function setIdTeam($v){
		$this->idTeam=$v;
	}
	private function setRight($v){
		$this->right=$v;
	}
	private function setTitle($v){
		$this->title=$v;
	}
	private function setDescription($v){
		$this->description=$v;
	}

	public function getId(){return $this->id;}
	public function getIdUser(){return $this->idUser;}
	public function getIdTeam(){return $this->idTeam;}
	public function getRight(){return $this->right;}
	public function getTitle(){return $this->title;}
	public function getDescription(){return	$this->description;}
	
}