<?php
ob_start();
header("Expires: Thu, 17 May 2001 10:17:17 GMT");    			// Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  			// HTTP/1.1
header ("Pragma: no-cache");                          			// HTTP/1.0

//error_reporting('E_ALL');
session_start();
require_once ( 'includes/config.php' );
require_once ( PATH_LIBRARIES.'libraries.php' );

$page_option = trim($_GET['option']);
if( !isset($_SESSION[WEBSITE_ALIAS]) ) {
	include PATH_COMPONENTS."login.php";
} else {
	include PATH_TEMPLATES."top2.php";
	include PATH_TEMPLATES."header2.php";
	include PATH_COMPONENTS."main.php";
	include PATH_TEMPLATES."footer2.php";
}
ob_end_flush();
?>