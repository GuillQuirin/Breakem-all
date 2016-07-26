<?php

function removeNULL($var)
{
    // retourne lorsque l'entrée est différente de NULL
    if($var !== NULL)
    	return $var;
}

function getActionPage($view, $action){
	$path = explode('.', $view); 
	return '"'.trim(str_replace('views', '', $path[0]), '/').'/'.$action.'"';
}

function ourOwnPassHash($pass){
	return password_hash($pass, PASSWORD_DEFAULT);
}

function ourOwnPassVerify($received, $model){
	return (password_verify($received, $model));
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
function canUserRegisterToTournament(user $u, tournament $t, $isFullyAlimented = false){
	if( (int) $t->getStatus() < 0 )
		return false;
	$rm = new registerManager();
	// On vérifie si l'user n'est pas le créateur (décommenter pour empêcher le créateur de s'inscrire)
	// if($u->getPseudo() === $t->getUserPseudo()){
	// 	unset($rm);
	// 	return false;
	// }
	// On vérifie s'il reste de la place ds le tournoi pr un joueur
	if($t->getNumberRegistered() >= (int) $t->getMaxPlayer()){
		unset($rm);
		return false;
	}
	// On vérifie si l'user n'est pas déjà inscrit à ce tournoi
	if($rm->isUserRegisteredForTournament($t, $u)){
		unset($rm);
		return false;
	}
	// On vérifie si le tournoi est en guilde only et que conséquemment l'user a bien une guilde
	if( ((bool) $t->getGuildOnly()) && !(is_numeric($u->getIdTeam())) ){
		unset($rm);
		return false;
	}
	// On vérifie la date de début du tournoi
	if($t->getStartDate()+$t->_gtMaxIntervalBetweenDates() <= strtotime(date('Y-m-d') . ' 00:00:00')){
		return false;
	}
	if($isFullyAlimented == false)
		return true;

	// On vérifie que les matchs n'ont pas débuté
	if(is_array($t->gtAllMatchs()) && count($t->gtAllMatchs()) > 0 && $t->isUserRegistered($u)){
		return false;
	}

	// On vérifie que l'user peut bien s'inscrire dans une team si le tournoi est en guilde only
	$userCanRegisterToOneTeam = false;
	foreach ($t->gtAllTeams() as $key => $teamT) {
		if(canUserRegisterToTeamTournament($u, $t, $teamT)){
			$userCanRegisterToOneTeam = true;
			break;
		}
	}
	if(!$userCanRegisterToOneTeam){	
		return false;
	}

	return true;
}

// Cette fonction a besoin d'un teamtournament.class alimenté en users dedans
function canUserRegisterToTeamTournament(user $u, tournament $t, teamtournament $tt){
	if( (int) $t->getStatus() < 0 )
		return false;
	// On vérifie si le tournoi est en guilde only et que la team souhaitée ne contient pas de membres d'une autre equipe conséquemment l'user est bien dans une guilde
	if( ((bool) $t->getGuildOnly()) && !(is_numeric($u->getIdTeam())) )
		return false;

	// Vérifie la limite de joueurs maxi du tournoi
	if($t->getNumberRegistered() >= (int) $t->getMaxPlayer())
		return false;

	// Vérifie les places restantes ds l'equipe
	if( $tt->getTakenPlaces() >= (int) $t->getMaxPlayerPerTeam() )
		return false;

	// On vérifie la présence de membres d'autres guildes dans la team
	if( (bool) $t->getGuildOnly() ){
		foreach ($tt->getUsers() as $key => $ttUser) {
			if($ttUser->getIdTeam() !== $u->getIdTeam())
				return false;
		}
	};
	return true;
}


/*function linkHasher($data){
	// $data has to be string / int / double
	return password_hash($data, CRYPT_BLOWFISH);
}
function linkCheck($received, $model){
	return (password_verify($received, $model));
}*/


function cleanTimedOutSession(){
	if(isset($_SESSION['timeout']) && $_SESSION['timeout'] < time()){
		session_destroy();		
	}
	session_start();
	session_regenerate_id();
}


function getIntInLetters($n){
	if(!is_int($n))
		return false;
	switch ($n) {
		case 1:
			return "premier";
		case 2:
			return "deuxième";
		case 3:
			return "troisième";
		case 4:
			return "quatrième";
		case 5:
			return "cinquième";
		case 6:
			return "sixième";
		case 7:
			return "septième";
		case 8:
			return "huitième";
		case 9:
			return "neuvième";
		case 10:
			return "dixième";		
		default:
			return false;
	}
}
function getRoundNameFromMatchesInRank($matchNumber){
	if(!is_int($matchNumber))
		return false;
	switch ($matchNumber) {
		case 1:
			return "finale";
		case 2:
			return "demi finale";
		case 4:
			return "quarts de finale";
		case 8:
			return "huitièmes de finale";
		case 16:
			return "seixièmes de finale";	
		default:
			return false;
	}
}

function getVictoryRatio($won, $all){
	if(!is_numeric($won) || !is_numeric($all))
		return false;
	$won = (int) $won;
	$all = (int) $all;
	if ($won > $all){
		$temp = $won;
		$won = $all;
		$all = $temp;
	}
	return round((($won/$all)*100), 1);
}