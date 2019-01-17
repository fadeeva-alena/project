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
if ($_GET['optionlistfilter'] != ""){
	$_SESSION['optionlistfilter'] = $_GET['optionlistfilter'];
}

if ($_GET['language'] != ""){
	$_SESSION[WEBSITE_ALIAS]['language'] = $_GET['language'];
	if ($_SESSION[WEBSITE_ALIAS]['admin_id']!= ""){
	mysql_query("update t_provider set language='".$_GET['language']."' where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	}
	
}

if ($_SESSION[WEBSITE_ALIAS]['language'] == ""){
	$_SESSION[WEBSITE_ALIAS]['language'] = 1;
}
$page_option = trim($_GET['option']);
if( ($_SESSION[WEBSITE_ALIAS] == "") or ($_SESSION[WEBSITE_ALIAS]['admin_id']== "") ) {
	if ($page_option == "login"){
		
		include PATH_COMPONENTS."login.php";
	}elseif($page_option == "forgotpassword"){
		include PATH_COMPONENTS."forgotpassword.php";
	}elseif($page_option == "feedback-approval"){
		include PATH_TEMPLATES."top1.php";
		include PATH_TEMPLATES."header1.php";
		include PATH_COMPONENTS."feedback-approval.php";
		//include PATH_TEMPLATES."footer.php";
	}elseif($page_option == "passwordsent"){
		include PATH_COMPONENTS."passwordsent.php";
	}elseif($page_option == "users"){
		//include PATH_TEMPLATES."top1.php";
		//include PATH_TEMPLATES."header1.php";
		include PATH_COMPONENTS."administrators-maint.php";
		//include PATH_TEMPLATES."footer.php";
	}elseif($page_option == "about"){
		include PATH_TEMPLATES."top1.php";
		include PATH_TEMPLATES."header1.php";
		include PATH_COMPONENTS."about.php";
		//include PATH_TEMPLATES."footer.php";
	}elseif($page_option == "about-team"){
		
		include PATH_COMPONENTS."about-team.php";
		//include PATH_TEMPLATES."footer.php";
	}elseif($page_option == "help"){
		
		include PATH_COMPONENTS."help.php";
		//include PATH_TEMPLATES."footer.php";
	}elseif($page_option == "leaders3"){
		include PATH_TEMPLATES."top1.php";
		include PATH_TEMPLATES."header1.php";
		include PATH_COMPONENTS."leaders3-maint.php";
		//include PATH_TEMPLATES."footer.php";
	}elseif($page_option == "locations3"){
		include PATH_TEMPLATES."top1.php";
		include PATH_TEMPLATES."header1.php";
		include PATH_COMPONENTS."locations3-maint.php";
		//include PATH_TEMPLATES."footer.php";
	}else{
		include PATH_COMPONENTS."login.php";
	}
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