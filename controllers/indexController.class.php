<?php
class indexController extends template{
	public function indexAction($requiredPosts){
		$v = new view();
		$v->assign("css", "index");
		$v->assign("js", "index");
		$v->setView("Index");

	}

	public function connectionAction(){
		if(!(isset($_SESSION['email']) && !isset($_SESSION['token'])))
		{
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
					unset($_SESSION);
					if(!!$dbUser){
						$_SESSION['token'] = $dbUser->getToken();
						$_SESSION['email'] = $dbUser->getEmail();
						setcookie('breakemalltoken', $dbUser->getToken(), time()+(86400 * 7));
						setcookie('breakemallemail', $dbUser->getEmail(), time()+(86400 * 7));
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
		}else{
			echo "ALRDY CONNECTED !!!";
		}
	}
}
