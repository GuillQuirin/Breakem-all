<?php
final class tournamentManager extends basesql{

	public function __construct(){
		parent::__construct();
	}

	public function create(tournament $tournoi){
		// Check afin de savoir qui appelle cette méthode
		$e = new Exception();
		$trace = $e->getTrace();

		// get calling class:
		$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
		// get calling method
		$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


		if(!$calling_class || !$calling_method)
			die("Tentatrbebrvrevtreezzment depuis une autre methode que finalValidationActervreverviezon de la classe TournoiController!");

		// Si appelée depuis la page tournoi
		if ($calling_class === "creationtournoiController" && $calling_method === "finalValidationAction"){
			$this->columns = [];
			$tournoiMeths = get_class_methods($tournoi);

			foreach ($tournoiMeths as $key => $method) {
				if(strpos($method, 'get') !== FALSE){
					$col = lcfirst(str_replace('get', '', $method));
					$this->columns[$col] = $tournoi->$method();
				};
			}
			// Toutes les propriétés à 0 sont remove de l'array à ce moment là
			// Pas impactant ici puisque les default value dans tournoi sont à 0
			$this->columns = array_filter($this->columns);
			// print_r($this->columns);
			$this->save();
		}else{
			die("Tentative d'enregistrement depuis une autre methode que finalValidationAction de la classe TournoiController!");
		}
	}

	public function save(){
		parent::save();	
	}

	public function getCurrentTournament(){
		$sql = "SELECT * FROM Tournament WHERE endDate > NOW()";
		$sth = $this->pdo->query($sql);
		return $sth->fetchAll(PDO::FETCH_ASSOC);
	}


}

