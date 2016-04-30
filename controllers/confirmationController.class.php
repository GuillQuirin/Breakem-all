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
            session_destroy();
            return;
        }

        session_destroy();
        header('Location:' . WEBPATH);
    }

    public function warningMailAction(){
        if(isset($_SESSION['visiteur_semi_inscrit'])){
            $startingSessionTime = $_SESSION['visiteur_semi_inscrit'];
            $curtime = time();
            /*Sert à définir un timeout de cette session à 12h*/
            if ($curtime - $startingSessionTime > 43200){
                unset($_SESSION['visiteur_semi_inscrit']);
            }else{
                $v = new View();
                $v->assign("css", "confirmation");
                $v->assign("title", "confirmation");
                $v->setView("confirmation");
                return;
            }            
        }
        header('Location: '.WEBPATH);
    }
}
