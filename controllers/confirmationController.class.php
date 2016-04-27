<?php

class confirmationController extends template{

    public function __construct(){
        //Si visiteur lambda
        if(!isset($_SESSION['userToCheck'])){
            header('Location: '.WEBPATH);
        }
    }

	public function confirmationAction(){
		$v = new View();

		$v->assign("css", "confirmation");
		$v->assign("js", "confirmation");
		$v->assign("title", "confirmation");

        //Si l'utilisateur vient de valider le formulaire d'inscription
        if(isset($_POST['email']) && !empty(trim($_POST['email'])))
            $v->assign("content", "Nous vous avons envoyé un email de confirmation afin d'activer votre compte.");

        //Si l'utilisateur a cliqué sur le lien du mail de confirmation
        if(isset($_GET['token']) && !empty(trim($_GET['token']))){

            $args = array(
                'token'     => FILTER_SANITIZE_STRING  
           );
           $filteredinputs = filter_input_array(INPUT_GET, $args);

           foreach ($args as $key => $value) {
             if(!isset($filteredinputs[$key]))
               die("FAUX: ".$filteredinputs[$key]);
           }

            // Le user ici servira d'image des user recuperes par la bdd et tout juste créés
            $user = new user($filteredinputs);
            // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
            $userBDD = new userManager();

            if($userBDD->tokenExists($user)){
                unset($_SESSION['userToCheck']);

                $contenuHTML = "Votre compte a correctement été activé, vous pouvez vous authentifier.";
                $contenuHTML .="<a href='".WEBPATH."'>Retour à la page d'accueil</a>";
                
                $v->assign("content", $contenuHTML);
            }
        }

        $v->setView("confirmation");
    }
}