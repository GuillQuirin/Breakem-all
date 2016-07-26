<?php
	define("DBHOST","localhost");
	define("DBUSER","root");
	define("DBPWD","");
	define("DBNAME","breakemallv2");
	define("WEBPATH", str_replace('/index.php', '', $_SERVER['SCRIPT_NAME']));
    define("SALT", "GRErgtgfgfbgbe45DFE");
    define("COOKIE_TOKEN", "breakemallyplrvh");
    define("COOKIE_EMAIL", "breakemallyrùzom");
    define("AUTORISATION", "validationdescookies");
    if($_SERVER['SERVER_NAME'] == 'localhost')
    	if( is_numeric(strpos(WEBPATH, '/breakemall')) )
    		define("LOCALPATH", str_replace("\\", "/", getcwd().str_replace('/breakemall', '', WEBPATH)) );
    	else
    		define("LOCALPATH", str_replace("\\", "/", getcwd().WEBPATH));
    else
    	define("LOCALPATH", "//home/breakem-all/public_html");

    