<?php 

class signalmentsuserManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	// public function create(signalmentsuser $signalmentsuser){
	// 	// Check afin de savoir qui appelle cette méthode
	// 	$e = new Exception();
	// 	$trace = $e->getTrace();

	// 	// get calling class:
	// 	$calling_class = (isset($trace[1]['class'])) ? $trace[1]['class'] : false;
	// 	// get calling method
	// 	$calling_method = (isset($trace[1]['function'])) ? $trace[1]['function'] : false;


	// 	if(!$calling_class || !$calling_method)
	// 		die("Pas de methode appelée pour la plainte !");

	// 	// Si appelée depuis la page profil
	// 	if($calling_class === "profilController" && $calling_method === "reportAction"){
	// 		$this->columns = [];
	// 		$report_methods = get_class_methods($signalmentsuser);

	// 		foreach ($report_methods as $key => $method) {
	// 			if(strpos($method, 'get') !== FALSE){
	// 				$col = lcfirst(str_replace('get', '', $method));
	// 				$this->columns[$col] = $signalmentsuser->$method();
	// 			};
	// 		}
	// 		$this->columns = array_filter($this->columns);
	// 		$this->save();
	// 	}
	// 	else
	// 		die("Tentative d'enregistrement depuis une autre methode que reportAction de la classe profilController!");
	// }

	public function isReport($demandeur, $accuse){
		$sql = "SELECT COUNT(*) as nb 
				FROM signalmentsuser 
				WHERE id_indic_user=:id_indic_user 
						AND id_signaled_user=:id_signaled_user";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':id_indic_user' => $demandeur,
			':id_signaled_user' => $accuse
		]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);

		return $r[0]['nb'];
	}

	public function getReport($id){
		$sql = "SELECT *
				FROM signalmentsuser 
				WHERE id=:id";

		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([ ':id' => $id ]);
		$r = $sth->fetchAll(PDO::FETCH_ASSOC);
		
		return new signalmentsuser($r[0]);
	}

	public function getListReports(){
		$sql="SELECT *
					FROM signalmentsuser 
					ORDER BY id ASC";

		$req = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$req->execute();
		$list = [];
		while ($query = $req->fetch(PDO::FETCH_ASSOC))
			//tableau d'objets user
			$list[] = new signalmentsuser($query);
	
		return $list;
	}

	public function delReport(signalmentsuser $report){
		$sql = "DELETE FROM signalmentsuser WHERE id=:id";
		
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->bindValue(':id', $report->getId());
		$sth->execute();
	}

}