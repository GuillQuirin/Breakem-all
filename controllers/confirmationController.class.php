<?php

class confirmationController extends template{

	public function confirmationAction(){
		$v = new View();

		$v->assign("css", "confirmation");
		$v->assign("js", "confirmation");
		$v->assign("title", "confirmation");
		$v->assign("content", "Configurer votre profil");
		$v->assign("MAJ","0");

        $v->setView("confirmation");
    }

    public function creationMail(){

        /* CONFIGURATION DU MAIL*/

		$adrPHPM = "web/lib/PHPMailer/"; 
		include $adrPHPM."PHPMailerAutoload.php";
		$mail = new PHPmailer(); 
        $mail->IsSMTP(); 
        //SMTP du FAI
        $mail->Host='smtp.free.fr'; 
        //Expediteur (le site)
        $mail->From='admin@bea.fr'; 
        $mail->CharSet='UTF-8';
        //Destinataire (l'utilisateur)
        $mail->AddAddress('spartandu54@hotmail.fr');

        $mail->AddReplyTo('admin@bea.fr');      
        $mail->Subject='Exemple trouvé sur DVP'; 

        $contenuMail = "

            <html>
            <head>
            </head>
            <body>
                <h1>Bienvenue sur Break-em-all.com</h1>
                <div>Il ne vous reste plus qu'à valider votre adresse mail en cliquant sur le lien ci-dessous</div>
                <a href=localhost/".WEBPATH."?token="..">Valider mon inscription</a>
            </body>

        ";

        $mail->Body='Voici un exemple d\'e-mail au format Texte'; 
        if(!$mail->Send()){ //Teste le return code de la fonction 
          echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7) 
        } 
        else{      
          echo 'Mail envoyé avec succès'; 
        } 
        $mail->SmtpClose(); 
        unset($mail); 
	}

    public function confirmationMail(){
        
    }
}