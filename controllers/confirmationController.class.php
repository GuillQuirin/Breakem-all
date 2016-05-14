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
                $v = new view();
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

        // Si la validation ne marche pas, le mec sera redirigé automatiquement vers l'index
        if($userBDD->checkMailToken($user)){
            $v = new view();
            $v->assign("css", "confirmation");
            $v->assign("title", "confirmation");
            $v->assign("inscription",1);
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
            //var_dump($curtime - $startingSessionTime);exit;
            /*Sert à définir un timeout de cette session à 12h*/
            if ($curtime - $startingSessionTime > 43200){
                unset($_SESSION['visiteur_semi_inscrit']);
            }else{
                $v = new view();
                $v->assign("css", "confirmation");
                $v->assign("title", "confirmation");
                $v->setView("confirmation");
                return;
            }            
        }
        //header('Location: '.WEBPATH);
    }

    public function lostAction(){
        $v = new view();
        $v->assign("css", "confirmation");
        $v->assign("title", "confirmation");

        //Email saisi
        if(isset($_POST['email'])){
            $args = array(
                    'email' => FILTER_VALIDATE_EMAIL
                );
            $filteredinputs = filter_input_array(INPUT_POST, $args);

            $userBDD = new userManager();
            $user = $userBDD->getUser($filteredinputs);
            
            $token = md5($user->getEmail().$user->getPseudo().SALT.time());
            $data['token']=$token;
            $newuser = new user($data);
            $newuser->setToken($token);
            
            $userBDD->setUser($user,$newuser);

            $contenuMail = "<h1>Ceci est un message de récupération de mot de passe sur le site <a href=\"http://breakem-all.com\">Break-em-all.com</a></h1>";
              $contenuMail.="<div>Vous pouvez le modifier en cliquant sur le lien ci-dessous</div>";
              $contenuMail.="<a href=\"http://localhost".WEBPATH."/confirmation/lost?token=".$user->getToken()."\">Récupérer mon compte</a>";
              $contenuMail.="<h2>Attention: si vous n'avez jamais effectué la demande, ignorez ce message</h2>";

            //Appel de la methode d'envoi du mail
            $this->envoiMail($user->getEmail(),'Récupération de compte',$contenuMail);

            $v->assign("envoi",1);
        }
        //Nouveaux mots de passe
        else if(isset($_POST['new_password']) && isset($_POST['new_password_check']) 
                    && $_POST['new_password']===$_POST['new_password_check']){
            $args = array(
                    'new_password' => FILTER_SANITIZE_STRING,
                    'new_password_check' => FILTER_SANITIZE_STRING
                );
            $filteredinputs = filter_input_array(INPUT_POST, $args);

            $data['email'] = $_SESSION[COOKIE_EMAIL];
            $userBDD = new userManager();
            $user = $userBDD->getUser($data);

            $filteredinputs['password']=ourOwnPassHash($filteredinputs['new_password']);

            $userBDD->recoverAccount($user, $filteredinputs['password']);
        }
        //Token envoyé
        else if(isset($_GET['token'])){
             $args = array(
                    'token' => FILTER_SANITIZE_STRING
                );
            $filteredinputs = filter_input_array(INPUT_GET, $args);
            $userBDD = new userManager();
            $user = $userBDD->getUser($filteredinputs);

            //Initialisation d'une session pour transférer l'adresse e-mail du mec
            $_SESSION[COOKIE_EMAIL] = $user->getEmail();

            $v->assign("recoverpwd",1);    
        }
        //Formulaire par défaut
        else{
            $v->assign("pwdlost",1);
        }

        $v->setView("validationInscription");
        return;
    }
}
