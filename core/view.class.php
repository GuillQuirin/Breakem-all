<?php

class view{

	protected $data = [];
	protected $view;
	protected $template;


	public function __construct(){
		// var_dump("view construct : " .$_SESSION['sJeton']);
	}

	public function setView($view, $layout="template"){
		$path_view = "views/".$view.".php";
		$path_template = "views/".$layout.".php";

		if( file_exists($path_view) ){
			$this->view=$path_view;
			if ( file_exists($path_template) ) {
				$this->template=$path_template;
			}else{
				die("Le template n'existe pas");
			}
		}else{
			die("La vue n'existe pas");
		}
	}

	public function assign($key, $value){
		/*if(isset($this->data[$key])){
			$arrValue = [];
			if(is_array($this->data[$key])){
				$arrValue[] = $value;
				$this->data[$key] = $arrValue;		
			}else{
				$arrValue[] = $value;
				$this->data[$key] = $arrValue;
			}	
		}else{
			$this->data[$key] = $value;					
		}*/
		if(is_array($key)){
			foreach ($key as $cle => $nom)
				$this->data[$key] = $nom;	
		}
		else
			$this->data[$key] = $value;					
	}

	public function createForm($form, $errors){
		global $errors_msg;
		include "views/form.php";
	}

	public function __destruct(){
		// JETON ANTI FAILLE CSRF RAFRAICHIT A CHAQUE RELOAD
		$sJeton = sha1(uniqid(rand(), true)) . date('YmdHis');
	    $_SESSION['sJeton'] = $sJeton;
		extract(array_filter($this->data, 'removeNULL'));
		include $this->template;
	}

}
