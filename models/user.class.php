<?php 

class user{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $name = null;
	protected $firstname = null;
	protected $pseudo = null;
	protected $birthday = null;
	protected $description = null;
	protected $kind = null;
	protected $city = null;
	protected $email = null;
	protected $password = null;
	protected $status = null;
	protected $img_user = null;
	protected $idTeam = null;

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
	private function setFirstname($v){
		$this->firstname=$v;
	}
	private function setPseudo($v){
		$this->pseudo=$v;
	}
	private function setBirthday($v){
		$this->birthday=$v;
	}
	private function setDescription($v){
		$this->description=$v;
	}
	private function setKind($v){
		$this->kind=$v;
	}
	private function setCity($v){
		$this->city=$v;
	}
	private function setEmail($v){
		$this->email=$v;
	}
	private function setPassword($v){
		$this->password=$v;
	}
	private function setStatus($v){
		$this->status=$v;
	}
	private function setImg_user($v){
		$this->img_user=$v;
	}
	private function setIdTeam($v){
		$this->idTeam=$v;
	}

	public function getId(){return $this->id;}
	public function getName(){return	$this->name;}
	public function getFirstname(){return $this->firstname;}
	public function getPseudo(){return $this->pseudo;}
	public function getBirthday(){return	$this->birthday;}
	public function getDescription(){return $this->description;}
	public function getKind(){return	$this->kind;}
	public function getCity(){return	$this->city;}
	public function getEmail(){return $this->email;}
	public function getPassword(){return	$this->password;}
	public function getStatus(){return $this->status;}
	public function getImg_user(){return	$this->img_user;}
	public function getIdTeam(){return $this->idTeam;}

	public function getAll(){
		foreach ($this as $key => $value) {
			$tab[$key]=$value;
		}
		return $tab;
	}
	
}