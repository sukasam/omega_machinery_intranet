<?php 
ob_start();
@session_start();
error_reporting(0);
$cookie_time = time() + (3600 * 24 * 15) ;
$s_title="Omega Intranet";
define("S_TITLE","Omega Intranet");
define("S_DOMAIN","http://server3/");
define("S_PATHS","omega_internet/");
define("S_IMAGES","images/");
?>
