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
	protected $img = null;
	protected $idTeam = null;
	protected $isConnected = null;
	protected $lastConnexion = null;
	protected $token = null;
	protected $rss = null;
	protected $authorize_mail_contact = null;
	protected $reportNumber = null;

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
	private function setImg($v){
		if(strlen(trim($v))!=0 && $v!=NULL){
			//var_dump(strstr($v, "lol"));
			if(strstr($v, WEBPATH)) //Image déjà stockée en base
				$this->img=$v; 
			else //Upload d'une image
				$this->img=WEBPATH."/web/img/upload/".$v; //Adresse stockée en base
		}
		else //Pas d'image uploadée
			$this->img=WEBPATH."/web/img/upload/default.jpg";
	}
	private function setIdTeam($v){
		$this->idTeam=$v;
	}
	public function setIsConnected($v){
		$this->isConnected=$v;
	}
	public function setLastConnexion($v){
		$this->lastConnexion=$v;
	}
	public function setToken($v){
		$this->token=$v;
	}
	public function setRss($v){
		if($v!=1)
			$this->rss=-1;
		else	
			$this->rss=$v;
	}
	public function setAuthorize_mail_contact($v){
		if($v!=1)
			$this->authorize_mail_contact=-1;
		else
			$this->authorize_mail_contact=$v;
	}
	public function setReportNumber($v){
		if($v!=NULL)
			$this->reportNumber=$v;
		else
			$this->reportNumber=0;
	}

	public function getId(){return $this->id;}
	public function getName(){return	$this->name;}
	public function getStatusName($status){
		switch($status)
		{
			case '-1' :
				return 'User inactif';
			break;
			case '1':
				return 'User actif';
			break;
			case '2':
				return 'Inconnu';
			break;
			case '3':
				return 'Admin';
			break;
		}
		
	}
	public function getFirstname(){return $this->firstname;}
	public function getPseudo(){return $this->pseudo;}
	public function getBirthday(){return	$this->birthday;}
	public function getDescription(){return $this->description;}
	public function getKind(){return	$this->kind;}
	public function getCity(){return	$this->city;}
	public function getEmail(){return $this->email;}
	public function getPassword(){return	$this->password;}
	public function getStatus(){return $this->status;}
	public function getImg(){ return $this->img;}
	public function getIdTeam(){return $this->idTeam;}
	public function getIsConnected(){return $this->isConnected;}
	public function getLastConnexion(){return $this->lastConnexion;}
	public function getToken(){return $this->token;}
	public function getAuthorize_mail_contact(){return $this->authorize_mail_contact;}
	public function getRss(){return $this->rss;}
	public function getReportNumber(){return $this->reportNumber;}
	
}