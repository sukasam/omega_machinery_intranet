<?php 
ob_start();
@session_start();
error_reporting(0);
//error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
$cookie_time = time() + (3600 * 24 * 15) ;
date_default_timezone_set("Asia/Bangkok");
$s_title="Omega Intranet";
define("S_TITLE","Omega Intranet");
define("S_DOMAIN","http://server3/");
define("S_PATHS","omega_internet/");
define("S_IMAGES","images/");
?>
