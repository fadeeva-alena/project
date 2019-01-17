<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_needs_variables.php");




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
	$keys["need_id"]=postvalue("editid1");

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



	$smarty->assign("show_key1", htmlspecialchars(GetData($data,"need_id", "")));

$keylink="";
$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["need_id"]));

////////////////////////////////////////////
//	need_id - 
	$value="";
		$value = ProcessLargeText(GetData($data,"need_id", ""),"","",MODE_VIEW);
	$smarty->assign("show_need_id",$value);
////////////////////////////////////////////
//	people_id - 
	$value="";
		$value = ProcessLargeText(GetData($data,"people_id", ""),"","",MODE_VIEW);
	$smarty->assign("show_people_id",$value);
////////////////////////////////////////////
//	need_type_id - 
	$value="";
		$value=DisplayLookupWizard("need_type_id",$data["need_type_id"],$data,$keylink,MODE_VIEW);
			
	$smarty->assign("show_need_type_id",$value);
////////////////////////////////////////////
//	need_subtype_id - 
	$value="";
		$value=DisplayLookupWizard("need_subtype_id",$data["need_subtype_id"],$data,$keylink,MODE_VIEW);
			
	$smarty->assign("show_need_subtype_id",$value);
////////////////////////////////////////////
//	need_note - 
	$value="";
		$value = ProcessLargeText(GetData($data,"need_note", ""),"","",MODE_VIEW);
	$smarty->assign("show_need_note",$value);
////////////////////////////////////////////
//	need_hourly - 
	$value="";
		$value = ProcessLargeText(GetData($data,"need_hourly", ""),"","",MODE_VIEW);
	$smarty->assign("show_need_hourly",$value);
////////////////////////////////////////////
//	prof_provider - 
	$value="";
		$value = ProcessLargeText(GetData($data,"prof_provider", ""),"","",MODE_VIEW);
	$smarty->assign("show_prof_provider",$value);
////////////////////////////////////////////
//	firstname - 
	$value="";
		$value = ProcessLargeText(GetData($data,"firstname", ""),"","",MODE_VIEW);
	$smarty->assign("show_firstname",$value);
////////////////////////////////////////////
//	lastname - 
	$value="";
		$value = ProcessLargeText(GetData($data,"lastname", ""),"","",MODE_VIEW);
	$smarty->assign("show_lastname",$value);
////////////////////////////////////////////
//	image_path - File-based Image
	$value="";
		if(CheckImageExtension($data["image_path"])) 
	{
			$value="<img";
						$value.=" border=0";
		$value.=" src=\"".htmlspecialchars(AddLinkPrefix("image_path",$data["image_path"]))."\">";
	}
	$smarty->assign("show_image_path",$value);
////////////////////////////////////////////
//	street - 
	$value="";
		$value = ProcessLargeText(GetData($data,"street", ""),"","",MODE_VIEW);
	$smarty->assign("show_street",$value);
////////////////////////////////////////////
//	house_nr - 
	$value="";
		$value = ProcessLargeText(GetData($data,"house_nr", ""),"","",MODE_VIEW);
	$smarty->assign("show_house_nr",$value);
////////////////////////////////////////////
//	zip - 
	$value="";
		$value = ProcessLargeText(GetData($data,"zip", ""),"","",MODE_VIEW);
	$smarty->assign("show_zip",$value);
////////////////////////////////////////////
//	location - 
	$value="";
		$value = ProcessLargeText(GetData($data,"location", ""),"","",MODE_VIEW);
	$smarty->assign("show_location",$value);
////////////////////////////////////////////
//	locationarea - 
	$value="";
		$value = ProcessLargeText(GetData($data,"locationarea", ""),"","",MODE_VIEW);
	$smarty->assign("show_locationarea",$value);
////////////////////////////////////////////
//	tel_p - 
	$value="";
		$value = ProcessLargeText(GetData($data,"tel_p", ""),"","",MODE_VIEW);
	$smarty->assign("show_tel_p",$value);
////////////////////////////////////////////
//	tel_m - 
	$value="";
		$value = ProcessLargeText(GetData($data,"tel_m", ""),"","",MODE_VIEW);
	$smarty->assign("show_tel_m",$value);
////////////////////////////////////////////
//	email - 
	$value="";
		$value = ProcessLargeText(GetData($data,"email", ""),"","",MODE_VIEW);
	$smarty->assign("show_email",$value);
$smarty->assign("pdf",postvalue("pdf"));
$pagename = $_SERVER["REQUEST_URI"];
if(strpos($_SERVER["REQUEST_URI"],"?")===false)
	$pagename.="?pdf=1";
else
	$pagename.="&pdf=1";
$smarty->assign("pageurl",$pagename);

$smarty->assign("all",$all);

$templatefile = "t_needs_view.htm";
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
