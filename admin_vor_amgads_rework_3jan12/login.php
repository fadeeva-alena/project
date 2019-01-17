<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");

if(@$_POST["a"]=="logout" || @$_GET["a"]=="logout")
{
	session_unset();
	setcookie("username","",time()-365*1440*60);
	setcookie("password","",time()-365*1440*60);
	header("Location: login.php");
	exit();
}

include('libs/Smarty.class.php');
$smarty = new Smarty();


$conn=db_connect();
//	Before Process event
if(function_exists("BeforeProcessLogin"))
	BeforeProcessLogin($conn);


$myurl=@$_SESSION["MyURL"];
unset($_SESSION["MyURL"]);

$defaulturl="";
		$defaulturl="menu.php";


$cUserName = "admin";
$cPassword = "admin";


$message="";

$pUsername=postvalue("username");
$pPassword=postvalue("password");

if(@$_COOKIE["username"] || @$_COOKIE["password"])
	$smarty->assign("checked"," checked");

if (@$_POST["btnSubmit"] == "Login")
{
	if(@$_POST["remember_password"] == 1)
	{
		setcookie("username",$pUsername,time()+365*1440*60);
		setcookie("password",$pPassword,time()+365*1440*60);
		$smarty->assign("checked"," checked");
	}
	else
	{
		setcookie("username","",time()-365*1440*60);
		setcookie("password","",time()-365*1440*60);
		$smarty->assign("checked","");
	}
//		 username and password are hardcoded
	$retval=true;
	if(function_exists("BeforeLogin"))
		$retval=BeforeLogin($pUsername,$pPassword);

	if($retval && !strcmp($cPassword, $pPassword) && !strcmp($cUserName, $pUsername))
	{
		$_SESSION["UserID"] = $pUsername;
		$_SESSION["AccessLevel"] = ACCESS_LEVEL_USER;
		
		if(function_exists("AfterSuccessfulLogin"))
		{
			$dummy=array();
			AfterSuccessfulLogin($pUsername,$pPassword,$dummy);
		}
		
		
		if($myurl)
			header("Location: ".$myurl);
		else
			header("Location: ".$defaulturl);
		return;
	}
	else
	{
		if(function_exists("AfterUnsuccessfulLogin"))
			AfterUnsuccessfulLogin($pUsername,$pPassword);
		$message = "Invalid Login";
	}	
}

$_SESSION["MyURL"]=$myurl;
if($myurl)
	$smarty->assign("url",$myurl);
else
	$smarty->assign("url",$defaulturl);


if(@$_POST["username"] || @$_GET["username"])
	$smarty->assign("value_username","value=\"".htmlspecialchars($pUsername)."\"");
else
	$smarty->assign("value_username","value=\"".htmlspecialchars(refine(@$_COOKIE["username"]))."\"");


if(@$_POST["password"])
	$smarty->assign("value_password","value=\"".htmlspecialchars($pPassword)."\"");
else
	$smarty->assign("value_password","value=\"".htmlspecialchars(refine(@$_COOKIE["password"]))."\"");


if(@$_GET["message"]=="expired")
	$message = "Your session has expired. Please login again.";


$smarty->assign("message",$message);

$templatefile="login.htm";
if(function_exists("BeforeShowLogin"))
	BeforeShowLogin($smarty,$templatefile);

$smarty->display($templatefile);
?>