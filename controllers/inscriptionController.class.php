<?php

class inscriptionController{

	public function inscriptionAction(){
		$v = new View();
		$v->assign("css", "inscription");
		$v->assign("js", "inscription");
		$v->assign("title", "Rejoignez-nous !");
		$v->assign("content", "S'inscrire à Break-em all !");
		$v->setView("inscription");
	}

	public $name;
	public $surname;
	public $country;
	public $email;
	public $commentaire;
	public $pwd;
	public $kind;
	public $cgu;
	public $birthday;

	public function verify(){
		
		$list_of_country = ["pa"=>"Paris", "ma"=>"Marseille", "ly"=>"Lyon", "li"=>"Lille"];
   		$list_of_kind = [0=>"homme", 1=>"femme"];

		if($this->name &&  $this->surname && $this->birthday && $this->country && $this->email && $this->pwd && $this->kind){

	        $this->name= strtolower(trim($this->name));
	        $this->surname= strtolower(trim($this->surname));
	        $this->email = strtolower(trim($this->email));

	        $msg_error="";
	        if(strlen($this->name)<2){
	            $error = TRUE;
	            $msg_error .= "<li>Le nom doit faire plus d'un caractère";
	        }
	        if(strlen($this->surname)<2){
	            $error = TRUE;
	            $msg_error .= "<li>Le prénom doit faire plus d'un caractère";
	        }
	        if($this->name === $this->surname){
	            $error = TRUE;
	            $msg_error .= "<li>Le prénom doit être différent du nom";
	        }
	        if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
	            $error = TRUE;
	            $msg_error .= "<li>Email invalide";
	        }
	        // if(strlen($this->pwd) <8 || strlen($this->pwd)>12){
		        //     $error = TRUE;
		        //     $msg_error .= "<li>Le mot de passe doit faire entre 8 et 12 caractères";
		        // }
		        // if(!isset($list_of_country[$country]) ){
		        //     $error = TRUE;
		        //     $msg_error .= "<li>Votre ville n'existe pas";
		        // }
		        // if(!in_array($kind, $list_of_kind)){
		        //     $error = TRUE;
		        //     $msg_error .= "<li>Le genre n'existe pas";
		        // }

		        //Erreur
		        // else{
		        //     $error = TRUE;
		        //     $msg_error .= "<li>Date de naissance incorrecte";
		        // }

		        //Vérification de l'unicité de l'email
		        // $users->getUser($bdd, ["email"=>$email] , "id");
		        // if(!empty($users)){
		        //     $error = TRUE;
		        //     $msg_error .= "<li>L'email existe déjà";
		        // }
		      	if($msg_error!=""){
		            return 0;
		        }else{
		        	return 1;
		        }

	    }
	
}
