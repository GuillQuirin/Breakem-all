<?php

class confirmationController extends template{

	public function confirmationAction(){
		$v = new View();

		$v->assign("css", "confirmation");
		$v->assign("js", "confirmation");
		$v->assign("title", "confirmation");
		$v->assign("content", "Configurer votre profil");
		$v->assign("MAJ","0");




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
        $mail->Body='Voici un exemple d\'e-mail au format Texte'; 
        if(!$mail->Send()){ //Teste le return code de la fonction 
          echo $mail->ErrorInfo; //Affiche le message d'erreur (ATTENTION:voir section 7) 
        } 
        else{      
          echo 'Mail envoyé avec succès'; 
        } 
        $mail->SmtpClose(); 
        unset($mail); 

        /*AFFICHAGE DE LA PAGE */

		$v->setView("confirmation");
	}
}