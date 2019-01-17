<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_log_variables.php");




//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$filename="";	
$message="";

$all=false;
$mypage=1;

//connect database
$conn = db_connect();

//	Before Process event
if(function_exists("BeforeProcessView"))
	BeforeProcessView($conn);

$strWhereClause="";
if(!$all)
{
	$keys=array();
	$keys["log_id"]=postvalue("editid1");

//	get current values and show edit controls

	$strWhereClause = KeyWhere($keys);


	$strSQL=gSQLWhere($strWhereClause);
}
else
{
	if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
	{
		$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
		$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
	}
	else
	{
		$strWhereClause=@$_SESSION[$strTableName."_where"];
		$strSQL=gSQLWhere($strWhereClause);
	}
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);
		$numrows=gSQLRowCount($strWhereClause,0);

}


$strSQLbak = $strSQL;
if(function_exists("BeforeQueryView"))
	BeforeQueryView($strSQL,$strWhereClause);
if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);

if(!$all)
{
	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
}
else
{
//	 Pagination:

	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;

		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}
	$rs=db_query($strSQL,$conn);
}

$data=db_fetch_array($rs);

include('libs/Smarty.class.php');
$smarty = new Smarty();

$out="";
$first=true;
while($data)
{



	$smarty->assign("show_key1", htmlspecialchars(GetData($data,"log_id", "")));

$keylink="";
$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["log_id"]));

////////////////////////////////////////////
//	log_id - 
	$value="";
		$value = ProcessLargeText(GetData($data,"log_id", ""),"","",MODE_VIEW);
	$smarty->assign("show_log_id",$value);
////////////////////////////////////////////
//	person_id - 
	$value="";
		$value = ProcessLargeText(GetData($data,"person_id", ""),"","",MODE_VIEW);
	$smarty->assign("show_person_id",$value);
////////////////////////////////////////////
//	User_Name - 
	$value="";
		$value = ProcessLargeText(GetData($data,"User_Name", ""),"","",MODE_VIEW);
	$smarty->assign("show_User_Name",$value);
////////////////////////////////////////////
//	login_date - 
	$value="";
		$value = ProcessLargeText(GetData($data,"login_date", ""),"","",MODE_VIEW);
	$smarty->assign("show_login_date",$value);
////////////////////////////////////////////
//	logout_date - 
	$value="";
		$value = ProcessLargeText(GetData($data,"logout_date", ""),"","",MODE_VIEW);
	$smarty->assign("show_logout_date",$value);
////////////////////////////////////////////
//	login_from - 
	$value="";
		$value = ProcessLargeText(GetData($data,"login_from", ""),"","",MODE_VIEW);
	$smarty->assign("show_login_from",$value);
$smarty->assign("pdf",postvalue("pdf"));
$pagename = $_SERVER["REQUEST_URI"];
if(strpos($_SERVER["REQUEST_URI"],"?")===false)
	$pagename.="?pdf=1";
else
	$pagename.="&pdf=1";
$smarty->assign("pageurl",$pagename);

$smarty->assign("all",$all);

$templatefile = "t_log_view.htm";
if(function_exists("BeforeShowView"))
	BeforeShowView($smarty,$templatefile,$data);

if(!$all)
{
		$smarty->display($templatefile);
	break;
}
else
{
}

}

?>
