<?php

class View{

	protected $data = [];
	protected $view;
	protected $template;

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
		$this->data[$key] = $value;
	}

	public function createForm($form, $errors){
		global $errors_msg;
		include "views/form.php";
	}

	public function __destruct(){
		extract(array_filter($this->data, 'removeNULL'));
		include $this->template;
	}

}
