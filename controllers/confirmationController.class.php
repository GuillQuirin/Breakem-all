<?php

class confirmationController extends template{

    public function __construct(){
        if(!isset($_SESSION['userToCheck'])){
            header('Location: '.WEBPATH);
        }
        else{
            unset($_SESSION['userToCheck']);
        }
    }

	public function confirmationAction(){
		$v = new View();

		$v->assign("css", "confirmation");
		$v->assign("js", "confirmation");
		$v->assign("title", "confirmation");
		$v->assign("content", "Configurer votre profil");
		$v->assign("MAJ","0");

        $v->setView("confirmation");
    }

    public function confirmationMail(){

    }
}