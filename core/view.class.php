<?php
class view{
	protected $data = [];
	protected $view;
	protected $template;

	public function setView($view, $layout="template"){
		//$vieux = indexIndex (grâce au indexController.class.php)
		//Vérification des fichiers de View comme pour l'autoloader
		$path_view = "views/".$view.".php";
		$path_template = "views/".$layout.".php";
		if(file_exists($path_view)){
			//Le $view est remplacé par $this->view car il cherche un argument de la class. Au dessus on a public $view
			$this->view =$path_view;

			if(file_exists($path_template)){
				$this->template =$path_template;
			}else{
				die("Le template n'existe pas");
			}


		}else{
			die("La vue n'existe pas");
		}

	}

	public function assign($key, $value){
		$this->data[$key]=$value;

	}

	public function __destruct(){
		extract($this->data);
		include $this->template;

	}

}