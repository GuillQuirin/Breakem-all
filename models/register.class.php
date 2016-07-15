<?php
/*
*
*/

final class register{
	protected $_id;
	protected $_status;
	protected $_idTeamTournament;
	protected $_idUser;
	protected $_idTournament;
	protected $_link;

	// Données du jeu
	protected $_nomJeu;
	protected $_imgJeu;

	// Données de user
	protected $_pseudo;
	protected $_description;
	protected $_email;
	protected $_img;
	protected $_isConnected;
	protected $_lastConnexion;
	protected $_authorize_mail_contact;
	protected $_idTeam;

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
	private function setStatus($v){
		$this->_status = $v;
	}
	private function setIdTeamTournament($v){
		$this->_idTeamTournament = $v;
	}
	private function setIdUser($v){
		$this->_idUser = $v;
	}
	private function setIdTournament($v){
		$this->_idTournament = $v;
	}
	private function setLink($v){
		$this->_link = $v;
	}

	// Setters du jeu
	public function setNomJeu($v){
		$this->_nomJeu=$v;
	}

	public function setImgJeu($v){
		$this->_imgJeu=$v;
	}

	// Setters de user
	public function setPseudo($v){
		$this->_pseudo=$v;
	}
	public function setDescription($v){
		$this->_description=$v;
	}
	public function setEmail($v){
		$this->_email=$v;
	}
	public function setImg($v){
		$this->_img=$v; 	
	}
	public function setIsConnected($v){
		$this->_isConnected=$v;
	}
	public function setLastConnexion($v){
		$this->_lastConnexion=$v;
	}
	public function setAuthorize_mail_contact($v){
		if($v!=1)
			$this->_authorize_mail_contact=-1;
		else
			$this->_authorize_mail_contact=$v;
	}
	public function setIdTeam($v){
		$this->_idTeam=$v;
	}


	public function getId(){return $this->_id;}
	public function getStatus(){return $this->_status;}
	public function getIdTeamTournament(){return $this->_idTeamTournament;}
	public function getIdUser(){return $this->_idUser;}
	public function getIdTournament(){return $this->_idTournament;}
	public function getLink(){return $this->_link;}
	
	// Getters du jeu
	public function _getNomJeu(){return $this->_nomJeu;}
	public function _getImgJeu($upload=false){
		if($upload){
			return $this->_imgJeu;
		}
		else{
			if(strlen(trim($this->_imgJeu))>0 && file_exists(getcwd()."/web/img/".$this->_imgJeu))
				return WEBPATH."/web/img/".$this->_imgJeu;

			return WEBPATH."/web/img/default.jpg";	
		}
	}

	// Getters de user
	public function getPseudo(){return $this->_pseudo;}
	public function getDescription(){return $this->_description;}
	public function getEmail(){return $this->_email;}
	public function getImg($upload=false){
		if($upload){
			return $this->_img;
		}
		else{
			if(strlen(trim($this->_img))>0 && file_exists(getcwd()."/web/img/".$this->_img))
				return WEBPATH."/web/img/".$this->_img;

			return WEBPATH."/web/img/default-membre.jpg";	
		}
	}
	public function getIdTeam(){return $this->_idTeam;}
	public function getIsConnected(){return $this->_isConnected;}
	public function getLastConnexion(){return $this->_lastConnexion;}
	public function getAuthorize_mail_contact(){return $this->_authorize_mail_contact;}

}

/*
*
*/
?>