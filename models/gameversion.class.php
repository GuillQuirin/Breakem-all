<?php 

class gameversion{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $name = null;
	protected $description = null;
	protected $year = null;
	protected $img = null;
	protected $idType = null;

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
	private function setName($v){
		$this->name=$v;
	}
	private function setDescription($v){
		$this->description=$v;
	}
	private function setYear($v){
		$this->year=$v;
	}
	public function setIdType($v){
		$this->idType=$v;
	}
	public function setImg($v){
		if(strlen(trim($v)) > 0)
			$this->img = "web/img/".$v;
	}

	public function getId(){return $this->id;}
	public function getName(){return $this->name;}
	public function getDescription(){return $this->description;}
	public function getYear(){return $this->year;}
	public function getImg(){return $this->img;}
	public function getIdType(){return $this->idType;}
	
}