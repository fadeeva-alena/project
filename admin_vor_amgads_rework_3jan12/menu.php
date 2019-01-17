<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");

if(!@$_SESSION["UserID"])
{
	header("Location: login.php");
	return;
}


include('libs/Smarty.class.php');
$smarty = new Smarty();

$conn=db_connect();
//	Before Process event
if(function_exists("BeforeProcessMenu"))
	BeforeProcessMenu($conn);


$smarty->assign("username",$_SESSION["UserID"]);
$smarty->assign("not_a_guest",$_SESSION["AccessLevel"] != ACCESS_LEVEL_GUEST);

$templatefile="menu.htm";
if(function_exists("BeforeShowMenu"))
	BeforeShowMenu($smarty,$templatefile);

$smarty->display($templatefile);
?>