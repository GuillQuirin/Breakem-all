<?php

class profilController extends template{

	public function profilAction(){
		
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("css", "profil");
		$v->assign("js", "profil");
		$v->assign("title", "Profil");
		$v->assign("content", "Fiche de l'utilisateur");

		if(isset($_GET['pseudo'])){
			// Ce finalArr doit etre envoyé au parametre du constructeur de usermanager
			$userBDD = new userManager();

			$args = array('pseudo' => FILTER_SANITIZE_STRING );
			$filteredinputs = array_filter(filter_input_array(INPUT_GET, $args));

			$user = $userBDD->getUser($filteredinputs);

			// Si $user === FALSE : soit pas de user trouvé, soit pbm de requete
			
			if(!!$user){

				$user_methods = get_class_methods($user);
				foreach ($user_methods as $key => $method) {
					if(strpos($method, 'get') !== FALSE){
						$col = lcfirst(str_replace('get', '', $method));
						$this->columns[$col] = $user->$method();
						$v->assign($col, $user->$method());
								
					};
				}
				
				//Page publique du joueur connecté
				if($this->isVisitorConnected() && $this->getConnectedUser()->getEmail()===$user->getEmail())
					$v->assign('myAccount', 1);
				else if($this->getConnectedUser()) //Apparition des boutons de configuration et signalement
				{
					//Si non signalé auparavant
					$signalement = new signalmentsuserManager();
					$plainte = $signalement->isReport($this->connectedUser->getId(),$user->getId());

					if($plainte != "0")
						$v->assign('already_signaled',1);
				}
			}
			else{
				$v->assign("err", "1");
			}
		}
		else{
			$v->assign("err", "1");
		}
		$v->setView("profil");
	}

	public function contactAction(){
	
		$args = array('msg' => FILTER_SANITIZE_STRING );
		$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));


		/*
			###########################################################################
			###########################################################################
		*/
			// ARRAY FILTER SUPPRIME LES MSG VIDES, 0, FALSE ou NULL
			// IL FAUT OBLIGATOIREMENT UTILISER CETTE METHODE DE FOREACH APRES UN array_filter(filter_input_array)
		/*
			###########################################################################
			###########################################################################
		*/
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key])){      
				die("Manque information : ".$key);
			}
		}

		$data = array('email' => $_SESSION[COOKIE_EMAIL]);

		$userBDD = new userManager();
		/*
			###########################################################################
			###########################################################################
		 */
			// Pourquoi recuperer les infos de l'utilisateur DEJA CONNECTE ?????
			// CES INFOS SE TROUVENT DEJA DANS $this->getConnectedUser()
			// A CHAQUE RAFRAICHISSEMENT DE PAGE LE TOKEN DE CONNEXION EST VERIFIE
			// SI LE MEC A LE BON TOKEN ON RECUPERE SES INFOS A CHAQUE FOIS
		/*
			###########################################################################
			###########################################################################
			PS: J'suis pas énervé, j'mets juste en maj pour etre sur qu'on voit le msg :p
		*/
		
		// $expediteur = $userBDD->getUser($data);
		$expediteur = $this->getConnectedUser();

		$pseudoProfil = substr($_SERVER['HTTP_REFERER'],strpos($_SERVER['HTTP_REFERER'],"=")+1);
			//$pseudoProfil = explode("&",$pseudoProfil);
			$data = array('pseudo' => $pseudoProfil);
		$destinataire = $userBDD->getUser($data);	

		$contenuMail = "<h3>Vous avez reçu un message de <a href=\"http://breakem-all.com/profil?pseudo=".$expediteur->getPseudo()."\">".$expediteur->getPseudo()."</a></h3>";
	      $contenuMail.="<div>".$filteredinputs['msg']."</div>";
	      $contenuMail.="<div>Si vous ne souhaitez plus recevoir de mails de la part des autres joueurs, vous pouvez décocher l'option dans 'Mon Compte'</div>";

		$this->envoiMail($destinataire->getEmail(), 'Un joueur vous a contacté.', $contenuMail);

		header('Location: '.$_SERVER['HTTP_REFERER']);
		
	}

	public function reportAction(){
		$args = array(
			'subject' => FILTER_SANITIZE_STRING,
			'description' => FILTER_SANITIZE_STRING
		);
		$filteredinputs = array_filter(filter_input_array(INPUT_POST, $args));
		/*
			###########################################################################
			###########################################################################
		*/
			// ARRAY FILTER SUPPRIME LES MSG VIDES, 0, FALSE ou NULL
			// IL FAUT OBLIGATOIREMENT UTILISER CETTE METHODE DE FOREACH APRES UN filter__input_array
		/*
			###########################################################################
			###########################################################################
		*/
		foreach ($args as $key => $value) {
			if(!isset($filteredinputs[$key])){      
				die("Manque information : ".$key);
			}
		}

		$data = array('email' => $_SESSION[COOKIE_EMAIL]);

		$userBDD = new userManager();
		$victime = $userBDD->getUser($data);
		$filteredinputs['id_indic_user'] = $victime->getId();

		$pseudoProfil = substr($_SERVER['HTTP_REFERER'],strpos($_SERVER['HTTP_REFERER'],"=")+1);
		$data = array('pseudo' => $pseudoProfil);
		$accuse = $userBDD->getUser($data);
		$filteredinputs['id_signaled_user'] = $accuse->getId();

		$plainteBDD = new signalmentsuserManager();
		$plainteBDD->mirrorObject = new signalmentsuser($filteredinputs);
		$plainteBDD->create();
		header('Location: '.$_SERVER['HTTP_REFERER']);
		
	}
}
