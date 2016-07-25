<?php

class confirmationController extends template{

    public function __construct(){
        //Si visiteur lambda
        /*if(!isset($_SESSION['userToCheck'])){
            header('Location: '.WEBPATH);
        }*/
        // $this->confirmation();
        parent::__construct();

        //Si membre déjà authentifié
        if($this->isVisitorConnected() || ($this->connectedUser && $this->connectedUser->getStatus()>0)){
            header('Location: ' .WEBPATH.'/index');
        }
    }

	public function checkAction(){
        // Un utilisateur déjà connecté ne va pas valider un mail de toute façon
        if($this->isVisitorConnected())
            header('Location:' . WEBPATH.'/index');
        $args = array(
            'token'     => FILTER_SANITIZE_STRING,
            'email'     => FILTER_VALIDATE_EMAIL
        );
        $filteredinputs = filter_input_array(INPUT_GET, $args);

        foreach ($args as $key => $value) {
            if(!isset($filteredinputs[$key])){
               header('Location:' . WEBPATH.'/404');
            }
        }

        // Le user ici servira d'image des user recuperes par la bdd et tout juste créés
        $user = new user($filteredinputs);
        // C'est avec cet objet qu'on utilisera les fonctions d'interaction avec la base de donnees
        $userBDD = new userManager();

        // Si la validation du compte a fonctionné, on redirige vers l'index avec une variable de session indiquant que le compte a bien été validé
        // On lui met un timeout pour que l'user ne voit le msg que pendant une courte periode de temps
        if($userBDD->checkMailToken($user))
            $_SESSION['compte_validé'] = $user->getEmail();

        header('Location:' . WEBPATH.'/index');
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
            $contenuMail = "<h1>Ceci est un message de récupération de mot de passe sur le site <a href=\"http://www.breakem-all.com\">Break-em-all.com</a></h1>";
              $contenuMail.="<div>Vous pouvez le modifier en cliquant sur le lien ci-dessous</div>";
              $contenuMail.="<a href=\"".WEBPATH."/confirmation/lost?token=".$newuser->getToken()."\">Récupérer mon compte</a>";
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
            header('Location: '.WEBPATH.'/index');
        }
        //Token envoyé
        else if(isset($_GET['token'])){
            $args = array(
                    'token' => FILTER_SANITIZE_STRING
                );
            $filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));
            
            if(!$filteredinputs)
                header('Location: '.WEBPATH.'/index');

            $userBDD = new userManager();
            $user = $userBDD->getUser($filteredinputs);
            if($user){
                //Initialisation d'une session pour transférer l'adresse e-mail du mec
                $_SESSION[COOKIE_EMAIL] = $user->getEmail();

                $v->assign("recoverpwd",1);
            }
            else 
                header('Location: '.WEBPATH.'/index');    
        }
        //Formulaire par défaut
        else{
            $v->assign("pwdlost",1);
        }

        $v->setView("validationInscription","template");
    }
}
