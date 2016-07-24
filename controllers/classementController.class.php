<?php

class classementController extends template{

	public function classementAction(){
		$v = new view();

		$bdd = new userManager();
		$userData = $bdd->getAllUser();
		$v->assign("userData", $userData);

		$this->assignConnectedProperties($v);
        $v->assign("css", "admin");
		//$v->assign("css", "classement");
		$v->assign("js", "classement");
		$v->assign("title", "Tous les podiums !");
		$v->assign("content", "Les résultats en ligne !");
		$v->setView("classement");
	}

	  public function getUserByPseudoAction(){
            $args = array(
                'pseudo' => FILTER_SANITIZE_STRING
            );

            $filteredinputs = filter_input_array(INPUT_POST, $args);  
            $bdd = new userManager();
            $searchUser = new user($filteredinputs);
            $user = $bdd->userByPseudo($searchUser);
           
            if($user){
                echo json_encode($user);
                die;
            }else{
                echo "undefined";
                die;
            }   
        }

	
}

