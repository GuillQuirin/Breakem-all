<?php

class View{

	protected $data = [];
	protected $view;
	protected $template;

	public function setView($view, $layout="templatenew"){
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

	// Méthode magique appelée seulement lorsque la totalité du code est achevée
	// Juste avant la fin des process du serveur
	public function __destruct(){
		/*
			include : affiche un warning si le fichier n'existe pas
			require : creve le process si le fichier n'existe pas
		*/
		// array_filter se débarasse des variables = NULL, false ou 0
		extract(array_filter($this->data));
		
		// du coup, this->template appelle template.php qui aura accès à toutes les variables définies ici;
		include $this->template;
	}

}
