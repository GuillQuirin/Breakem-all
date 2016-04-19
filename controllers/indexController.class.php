<?php
class indexController extends template{

	public function indexAction($requiredPosts){
		$v = new view();
		$v->assign("css", "index");
		$v->assign("js", "index");
		$v->setView("Index");

	}

	public function connectionAction(){
		if(isset($_COOKIE['breakemalltoken'])){
			print_r($_COOKIE);
			return;
		}
		echo "cookie was not found ! \n";
		unset($_COOKIE['breakemalltoken']);
		return;
		$args = array(
    	    'email'   => FILTER_VALIDATE_EMAIL,
    	    'password'   => FILTER_SANITIZE_STRING 
		);
		$filteredinputs = filter_input_array(INPUT_POST, $args);

		// Array final à encoder en json
		$data = [];

		$requiredInputsReceived = true;
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key])){
				$requiredInputsReceived = false;				
				$data["errors"]["inputs"] = "missing input " . $key;
			}
		}

		if($requiredInputsReceived){
			$userManager = new userManager();
			$user = new user($filteredinputs);
			if($userManager->userMailExists($user)){
				$dbUser = $userManager->tryConnect($user);
				if(!!$dbUser){
					echo "connection succes ! \n";
					unset($_SESSION);
					$token = md5($dbUser->getId().$dbUser->getName().$dbUser->getEmail().SALT.date('Ymd'));
					$_SESSION['token'] = $token;
					setcookie('breakemalltoken', $token, time()+(86400 * 7));
					unset($token);
					print_r($_SESSION);
					$data["pseudo"] =$dbUser->getPseudo();
					$data["email"] = $dbUser->getEmail();
				}else{
					$data["errors"]["user"] = "invalid password !";
				}
			}else{
				$data["errors"]["user"] = "unknown email !";
			}
		}

		echo json_encode($data);
	}
}

/*5fc88f953172a14a9de09615a5789a1a*/
