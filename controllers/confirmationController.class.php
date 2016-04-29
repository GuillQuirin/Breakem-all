<?php

class confirmationController extends template{

    public function __construct(){
        //Si visiteur lambda
        /*if(!isset($_SESSION['userToCheck'])){
            header('Location: '.WEBPATH);
        }*/
        // $this->confirmation();
    }

	public function checkAction(){
        $args = array(
            'token'     => FILTER_SANITIZE_STRING,
            'email'     => FILTER_VALIDATE_EMAIL
        );
        $filteredinputs = filter_input_array(INPUT_GET, $args);

        foreach ($args as $key => $value) {
            if(!isset($filteredinputs[$key])){
                $v->assign("css", "404");
                $v->assign("js", "404");
                $v->assign("title", "Erreur 404");
                $v->assign("content", "Erreur 404, <a href='".WEBPATH."'>Retour à l'accueil</a>.");

                $v->setView("templatefail", "templatefail");
                return;
            }
        }

        // Le user ici servira d'image des user recuperes par la bdd et tout juste créés
        $user = new user($filteredinputs);
        // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
        $userBDD = new userManager();

        if($userBDD->checkMailToken($user)){
            $v = new View();
            $v->assign("css", "confirmation");
            $v->assign("title", "confirmation");
            $v->setView("validationInscription");
            return;
        }

        header('Location:' . WEBPATH);
    }
}