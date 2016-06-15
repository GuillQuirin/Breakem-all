<?php 

class gameversion{
	//Ca doit être un miroir par rapport au nom des colonnes dans la table
	protected $id = null;
	protected $idPlateform = null;
	protected $idGame = null;
	protected $maxPlayer = null;
	protected $maxTeam = null;
	protected $maxPlayerPerTeam = null;
	protected $name = null;
	protected $description = null;

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
	private function setIdPlateform($v){
		$this->idPlateform=$v;
	}
	private function setIdGame($v){
		$this->idGame=$v;
	}
	private function setMaxPlayer($v){
		$this->maxPlayer= (int) $v;
	}
	private function setMaxTeam($v){
		$this->maxTeam= (int) $v;
	}
	private function setMaxPlayerPerTeam($v){
		$this->maxPlayerPerTeam= (int) $v;
	}
	private function setName($v){
		$this->name=$v;
	}
	private function setDescription($v){
		$this->description=$v;
	}

	public function getId(){return $this->id;}
	public function getIdPlateform(){return $this->idPlateform;}
	public function getIdGame(){return $this->idGame;}
	public function getMaxPlayer(){return $this->maxPlayer;}
	public function getMinPlayer(){return ($this->maxPlayer/2);}
	public function getMaxTeam(){return $this->maxTeam;}
	public function getMinTeam(){return ($this->maxTeam/2);}
	public function getMaxPlayerPerTeam(){return $this->maxPlayerPerTeam;}
	public function getMinPlayerPerTeam(){return ($this->maxPlayerPerTeam);}
	public function getName(){return $this->name;}
	public function getDescription(){return $this->description;}

	public function isEqualTo(gameversion $comparedVers){
		if($this->getName() === $comparedVers->getName()
			&& $this->getDescription() === $comparedVers->getDescription()
			&& $this->getMaxPlayer() === $comparedVers->getMaxPlayer()
			&& $this->getMinPlayer() === $comparedVers->getMinPlayer()
			&& $this->getMaxTeam() === $comparedVers->getMaxTeam()
			&& $this->getMinTeam() === $comparedVers->getMinTeam()
			&& $this->getMaxPlayerPerTeam() === $comparedVers->getMaxPlayerPerTeam()
			&& $this->getMinPlayerPerTeam() === $comparedVers->getMinPlayerPerTeam()
			)
			return true;
		return false;
	}
	
}