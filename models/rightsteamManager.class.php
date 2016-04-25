<?php 

class rightsteamManager extends basesql{
	public function __construct(){
		parent::__construct();
	}

	
	public function create(rightsteam $rt){	
		$this->columns = [];
		$rt_methods = get_class_methods($rt);
		foreach ($rt_methods as $key => $method) {
			if(strpos($method, 'get') !== FALSE){
				$col = lcfirst(str_replace('get', '', $method));
				$this->columns[$col] = $rt->$method();
			};
		}
		$this->columns = array_filter($this->columns);
		$r = $this->save();
		return $r;

		return false;
	}
}
