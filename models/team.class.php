<?php 

class team{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $id_user_creator = null;
	protected $status = null;
	protected $name = null;
	protected $img = null;
	protected $slogan = null;
	protected $description = null;
	// public $tabStatus = array();

	// self::$tabStatus['-1'] = 'Dévérouillée';
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
	public function setId($v){
		$this->id=$v;
	}
	public function setId_user_creator($v){
		$this->id_user_creator=$v;
	}
	public function setStatus($v){
		$this->status=$v;
	}
	private function setName($v){
		$this->name=$v;
	}
	private function setImg($v){
		$this->img=$v;
	}
	public function setSlogan($v){
		$this->slogan=$v;
	}
	public function setDescription($v){
		$this->description=$v;
	}

	//Getters
	public function getId(){return $this->id;}
	
	public function getId_user_creator(){return $this->id_user_creator;}
	public function getStatus(){return $this->status;}
	public function getStatusName($status=null){
		switch($status)
		{
			case '-1' :
				return 'Verrouillée';
			break;
			case '1':
				return 'Déverrouillée';
			break;
			default:
				return '';
			break;
		}
		
	}
	public function getName(){return $this->name;}
	public function getImg($upload=false){
		if($upload){
			if(strlen(trim($this->img))!=0 && file_exists(getcwd()."/web/img/upload/".$this->img))
			return "default.jpg";
		}
		else{
			return $this->img;
		}
		/*

			if($upload){
				return $this->img;
			}
			else{
				if(strlen(trim($this->img))!=0 && file_exists(getcwd()."/web/img/upload/".$this->img))
					return "/web/img/upload/".$this->img;

				return "/web/img/upload/default.jpg";	
			}
	
		*/
	}
	public function getSlogan(){return $this->slogan;}
	public function getDescription(){return	$this->description;}
	
}