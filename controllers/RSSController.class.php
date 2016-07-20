<?php

class RSSController extends template{

	public function RSSAction(){
		
		$v = new view();
		$this->assignConnectedProperties($v);
		$v->assign("content", "Fiche de l'utilisateur");

		$tournoiBDD = new tournamentManager();
		$listtournoi = $tournoiBDD->getRecentsTournaments(5);

		//Rédaction du fichier

		$xml = '<?xml version="1.0" encoding="UTF-8"?>';
		$xml .= '<rss version="2.0">';
			$xml .= '<channel>'; 
				$xml .= '<title>Break\'em All</title>';
				$xml .= '<link>http://breakem-all.com/</link>';
				$xml .= '<description>Site de tournois communautaires.</description>';
				if($listtournoi){
					if(is_array($listtournoi)){
						foreach ($listtournoi as $tournoi) {
							$xml .= '<item>';
								$xml .= '<title>'.$tournoi->getName().'</title>';
								$xml .= '<link>'.WEBPATH.'/tournoi?t='.$tournoi->getLink().'</link>';
								$xml .= '<debDate>le '.date('d/m/Y \à H:i',$tournoi->getStartDate()).'</debDate>';
								$xml .= '<finDate>le '.date('d/m/Y \à H:i',$tournoi->getEndDate()).'</finDate>';
								$xml .= '<creator>'.$tournoi->getUserPseudo().'</creator>';
								$xml .= '<game>'.$tournoi->getGameName().'</game>';
								$xml .= '<description>'.$tournoi->getDescription().'</description>';
							$xml .= '</item>';
						}
					}
					else{
						$xml .= '<item>';
							$xml .= '<title>'.$listtournoi->getName().'</title>';
							$xml .= '<link>'.WEBPATH.'/tournoi?t='.$listtournoi->getLink().'</link>';
							$xml .= '<debDate>le '.date('d/m/Y \à H:i',$listtournoi->getStartDate()).'</debDate>';
							$xml .= '<finDate>le '.date('d/m/Y \à H:i',$listtournoi->getEndDate()).'</finDate>';
							$xml .= '<creator>'.$listtournoi->getUserPseudo().'</creator>';
							$xml .= '<game>'.$listtournoi->getGameName().'</game>';
							$xml .= '<description>'.$listtournoi->getDescription().'</description>';
						$xml .= '</item>';
					}
				}

			$xml .= '</channel>';
		$xml .= '</rss>';

		//Ecriture dans le fichier
		$fichier = fopen("flux.xml", 'w+');
		if($fichier){
			fputs($fichier, $xml);
			fclose($fichier);
		}

		if(file_exists('flux.xml')){
			$rss = file_get_contents('flux.xml');
			if(trim($rss)!==""){
				$rss = simplexml_load_file('flux.xml'); 
				if($rss && !empty($rss)){
					//Affichage du contenu sur la page
					if($rss->channel->item!=NULL){
						foreach ($rss->channel->item as $item) { 
						  echo '<div>
						           <div>'.$item->title.' sur '.$item->game.' commençant '.$item->debDate.'</div>
						           <div>organisé par '.$item->creator.'</div>
						           <div>'.$item->description.'</div>
						           <a href="'.$item->link.'">Voir le tournoi</a>
						        </div>';
						} 
					}
				}
			}
		}

		$v->setView("blank","notemplate");
	}
}


