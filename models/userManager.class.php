<?php 

class userManager extends basesql{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id;
	protected $name;
	protected $firstname;
	protected $pseudo;
	protected $birthday;
	protected $description;
	protected $kind;
	protected $city;
	protected $email;
	protected $password;
	protected $status;
	protected $img_user;
	protected $idTeam;

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

	private setId($v){
		$this->id=$v;
	}
	private setName($v){
		$this->name=$v;
	}
	private setFirstname($v){
		$this->firstname=$v;
	}
	private setPseudo($v){
		$this->pseudo=$v;
	}
	private setBirthday($v){
		$this->birthday=$v;
	}
	private setDescription($v){
		$this->description=$v;
	}
	private setKind($v){
		$this->kind=$v;
	}
	private setCity($v){
		$this->city=$v;
	}
	private setEmail($v){
		$this->email=$v;
	}
	private setPassword($v){
		$this->password=$v;
	}
	private setStatus($v){
		$this->status=$v;
	}
	private setImg_user($v){
		$this->img_user=$v;
	}
	private setIdTeam($v){
		$this->idTeam=$v;
	}

	public getId(){return $this->id;}
	public getName(){return	$this->name;}
	public getFirstname(){return $this->firstname;}
	public getPseudo(){return $this->pseudo;}
	public getBirthday(){return	$this->birthday;}
	public getDescription(){return $this->description;}
	public getKind(){return	$this->kind;}
	public getCity(){return	$this->city;}
	public getEmail(){return $this->email;}
	public getPassword(){return	$this->password;}
	public getStatus(){return $this->status;}
	public getImg_user(){return	$this->img_user;}
	public getIdTeam(){return $this->idTeam;}
}