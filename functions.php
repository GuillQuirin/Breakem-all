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
	if(password_verify($received, $model))
		return true;
	return false;
}

function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
