<?php
ob_start();
header("Expires: Thu, 17 May 2001 10:17:17 GMT");    			// Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  			// HTTP/1.1
header ("Pragma: no-cache");                          			// HTTP/1.0
//header("Content-Type: application/json; charset=UTF-8");
//error_reporting('E_ALL');
session_start();
require_once ( 'includes/config.php' );
require_once ( PATH_LIBRARIES.'libraries.php' );
if ($_GET['optionlist'] != ""){
	$_SESSION['optionlist'] = $_GET['optionlist'];
}
$page_option = trim($_GET['option']);
if( !isset($_SESSION[WEBSITE_ALIAS]) and !$_SESSION[WEBSITE_ALIAS]['admin_id']) {
	include PATH_COMPONENTS."login.php";
} else {
	$sql_sys = mysql_query("select * from t_sys");
	$row_sys = mysql_fetch_array($sql_sys);
	
	$grid_max_x = $row_sys['pics_in_grid_max_x'];
	$grid_max_y = $row_sys['pics_in_grid_max_y'];
	$detail_max_x = $row_sys['pics_in_detail_max_x'];
	$detail_max_y = $row_sys['pics_in_detail_max_y'];
	
	include PATH_TEMPLATES."top.php";
	include PATH_TEMPLATES."header.php";
	include PATH_COMPONENTS."main.php";
	include PATH_TEMPLATES."footer.php";
}
ob_end_flush();
?>