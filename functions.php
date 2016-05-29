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
function canUserRegisterToTournament(user $u, tournament $t){
	$rm = new registerManager();
	// On vérifie si l'user n'est pas le créateur
	if($u->getPseudo() === $t->getUserPseudo()){
		unset($rm);
		return false;
	}
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
	// On vérifie si le tournoi est en guilde only et que conséquemment l'user est bien dans une guilde
	if( ((bool) $t->getGuildOnly()) && !(is_numeric($u->getIdTeam())) ){
		unset($rm);
		return false;
	}
	return true;
}
function canUserRegisterToTeamTournament(user $u, tournament $t, teamtournament $tt){
	// On vérifie si le tournoi est en guilde only et que la team souhaitée ne contient pas de membres d'une autre equipe conséquemment l'user est bien dans une guilde
	if( ((bool) $t->getGuildOnly()) && !(is_numeric($u->getIdTeam())) ){
		
		return false;
	}
	return true;
}
/*function linkHasher($data){
	// $data has to be string / int / double
	return password_hash($data, CRYPT_BLOWFISH);
}
function linkCheck($received, $model){
	return (password_verify($received, $model));
}*/