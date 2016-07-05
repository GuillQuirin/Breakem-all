<?php 

class classement{

	protected $id = null;
	protected $name = null;
	protected $img = null;
	protected $slogan = null;
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

	//Setters 

	private function setId($v){
		$this->id=$v;
	}
	private function setName($v){
		$this->name=$v;
	}
	private function setImg($v){
		$this->img = $v;
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
	public function getImg($upload=false){
		if($upload){
			return $this->img;
		}
		else{
			if(strlen(trim($this->img))!=0 && file_exists(getcwd()."/web/img/".$this->img))
				return WEBPATH."/web/img/".$this->img;

			return WEBPATH."/web/img/default.jpg";	
		}
	}
	public function getSlogan(){return $this->slogan;}
	public function getDescription(){return	$this->description;}
	
}