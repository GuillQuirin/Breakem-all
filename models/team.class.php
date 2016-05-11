<?php 

class team{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $name = null;
	protected $img = null;
	protected $slogan = null;
	protected $description = null;

	/*
		A chaque création d'objet, les données en paramètres seront appliquées
		dans les setters respectifs: c'est l'hydratation
		Ainsi le nouvel objet possèdera des attributs avec les valeurs communiquées
	*/
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

	//Setters 

	private function setId($v){
		$this->id=$v;
	}
	private function setName($v){
		$this->name=$v;
	}
	private function setImg($v){
		if(!empty(trim($v)))
			$this->img=$v;
	}
	private function setSlogan($v){
		$this->slogan=$v;
	}
	private function setDescription($v){
		$this->description=$v;
	}

	//Getters
	
	public function getId(){return $this->id;}
	public function getName(){return $this->name;}
	public function getImg(){return	$this->img;}
	public function getSlogan(){return $this->slogan;}
	public function getDescription(){return	$this->description;}
	
}