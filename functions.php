<?php

function removeNULL($var)
{
    // retourne lorsque l'entrée est impaire
    if($var !== NULL)
    	return $var;
}

function getActionPage($view, $action){
	$path = explode('.', $view); 
	return '"'.trim(str_replace('views', '', $path[0]), '/').'/'.$action.'"';
}