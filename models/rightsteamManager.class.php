<?php 

class rightsteamManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	
	public function create(rightsteam $rt){	
		$sql = "INSERT INTO rightsteam VALUES
			(0, :idUser, :idTeam, :right, :title, :description)";
		$sth = $this->pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		$sth->execute([
			':idUser' => $rt->getIdUser(),
			':idTeam' => $rt->getIdTeam(),
			':right' => $rt->getRight(),
			':title' => $rt->getTitle(),
			':description' => $rt->getDescription()
		]);

		$this->columns = [];
		$rt_methods = get_class_methods($rt);

		foreach ($rt_methods as $key => $method) {
			if(is_numeric(strpos($method, 'get'))){
				$col = lcfirst(str_replace('get', '', $method));
				$this->columns[$col] = $rt->$method();
			};
		}
		$this->columns = array_filter($this->columns);
		$r = $this->save();		
	}
}