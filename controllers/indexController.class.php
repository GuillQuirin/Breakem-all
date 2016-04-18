<?php
class indexController extends template{

	public function indexAction($requiredPosts){
		$v = new view();
		$v->assign("css", "index");
		$v->assign("js", "index");
		$v->setView("Index");

	}

	public function connectionAction(){
		$args = array(
    	    'email'   => FILTER_VALIDATE_EMAIL,
    	    'password'   => FILTER_SANITIZE_STRING 
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);

		$requiredInputsReceived = true;
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key])){
				$requiredInputsReceived = false;
				break;
			}
		}

		if($requiredInputsReceived){
			print_r($filteredinputs);
		}
		else{
			echo "missing an input ! \n";
		}
	}
}
