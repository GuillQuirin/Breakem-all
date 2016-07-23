<?php 

class signalmentsuser{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $subject = null;
	protected $description = null;
	protected $date = null;
	protected $id_indic_user = null;
	protected $pseudo_indic_user = null;
	protected $id_signaled_user = null;
	protected $pseudo_signaled_user = null;

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
	private function setSubject($v){
		$this->subject=$v;
	}
	private function setDescription($v){
		$this->description=$v;
	}
	private function setDate($v){
		$this->date=$v;
	}
	private function setId_indic_user($v){
		$this->id_indic_user=$v;
	}
	private function setPseudo_indic_user($v){
		$this->pseudo_indic_user=$v;
	}
	private function setId_signaled_user($v){
		$this->id_signaled_user=$v;
	}
	private function setPseudo_signaled_user($v){
		$this->pseudo_signaled_user=$v;
	}

	public function getId(){return $this->id;}
	public function getSubject(){return	$this->subject;}
	public function getDescription(){return $this->description;}
	public function getDate(){return $this->date;}
	public function getId_indic_user(){return $this->id_indic_user;}
	public function gtPseudo_indic_user(){return $this->pseudo_indic_user;}
	public function getId_signaled_user(){return $this->id_signaled_user;}
	public function gtPseudo_signaled_user(){return $this->pseudo_signaled_user;}
}