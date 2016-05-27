<?php 

class commentsteam{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $idUser = null;
	protected $pseudo = null;
	protected $idTeam = null;
	protected $nomTeam = null;
	protected $date = null;
	protected $message = null;


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
	private function setIdTeam($v){
		$this->idTeam=$v;
	}
	private function setNomTeam($v){
		$this->nomTeam=$v;
	}
	private function setDate($v){
		$this->date=$v;
	}
	private function setMessage($v){
		$this->message=$v;
	}

	public function getId(){return $this->id;}
	public function getIdUser(){return $this->idUser;}
	public function getPseudo(){return $this->pseudo;}
	public function getIdTeam(){return $this->idTeam;}
	public function getNomTeam(){return $this->nomTeam;}
	public function getDate(){return $this->date;}
	public function getMessage(){return $this->message;}
}