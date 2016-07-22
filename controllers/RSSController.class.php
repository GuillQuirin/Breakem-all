<?php

class RSSController extends template{

	public function RSSAction(){
		
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("content", "Fiche de l'utilisateur");

		$tournoiBDD = new tournamentManager();
		$listtournoi = $tournoiBDD->getRecentsTournaments(5);

		//Rédaction du fichier

		$xml = '<?xml version="1.0" encoding="utf-8" ?>';
		$xml .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">';
			$xml .= '<channel>'; 
				$xml .= '<title>Break\'em All</title>';
				$xml .= '<link>http://breakem-all.com/</link>';
				$xml .= '<description>Site de tournois communautaires.</description>';
				$xml .= '<language>fr-fr</language>';
				$xml .= '<category>Jeux Video</category>';
				$xml .= '<atom:link href="'.WEBPATH.'/flux.xml" rel="self" type="application/rss+xml" />';
				if($listtournoi){
					if(is_array($listtournoi)){
						foreach ($listtournoi as $tournoi) {
							$xml .= '<item>';
								$xml .= '<title>'.$tournoi->getName().'</title>';
								$xml .= '<link>'.WEBPATH.'/tournoi?t='.$tournoi->getLink().'</link>';
								$xml .= '<category>Tournoi</category>';
								$xml .= '<pubDate>'.date(DATE_RFC2822,strtotime($tournoi->getCreationDate())).'</pubDate>';
								$xml .= '<description>'.$tournoi->getDescription().'</description>';
								$xml .= '<guid>'.WEBPATH.'/tournoi?t='.$tournoi->getLink().'</guid>';
							$xml .= '</item>';
						}
					}
					else{
						$xml .= '<item>';
								$xml .= '<title>'.$listtournoi->getName().'</title>';
								$xml .= '<link>'.WEBPATH.'/tournoi?t='.$listtournoi->getLink().'</link>';
								$xml .= '<category>Tournoi</category>';
								$xml .= '<pubDate>'.date(DATE_RFC2822,strtotime($listtournoi->getCreationDate())).'</pubDate>';
								$xml .= '<description>'.$listtournoi->getDescription().'</description>';
								$xml .= '<guid>'.WEBPATH.'/tournoi?t='.$tournoi->getLink().'</guid>';
							$xml .= '</item>';
					}
				}

			$xml .= '</channel>';
		$xml .= '</rss>';

		//Ecriture dans le fichier
		$fichier = fopen(LOCALPATH."/flux.xml", 'w');
		if(isset($fichier) && $fichier){
			fputs($fichier, $xml);
			fclose($fichier);
		}
		//$v->setView("blank","templateEmpty");
		header('Location: '.WEBPATH.'/flux.xml');
	}
}


