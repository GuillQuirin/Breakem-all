<?php
/*
*
*/

final class teamtournament{
	protected $_id;
	protected $_rank;
	protected $_idTournament;

	public function __construct(array $data){
		$this->hydrate($data);
	}

	public function hydrate(array $donnees){
		foreach ($donnees as $key => $value) {
			$method = 'set'.ucfirst($key);
			if ( method_exists($this, $method) ){
				$this->$method($value);
			}
		}
	}

	private function setId($v){
		$this->_id = $v;
	}
	private function setRank($v){
		$this->_rank = $v;
	}
	private function setIdTournament($v){
		$this->_idTournament = $v;
	}

	public function getId(){return $this->_id;}
	public function getRank(){return $this->_rank;}
	public function getIdTournament(){return $this->_idTournament;}
}

/*
*
*/
?>