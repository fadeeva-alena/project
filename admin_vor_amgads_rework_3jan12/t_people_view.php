<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_people_variables.php");




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
	$keys["people_id"]=postvalue("editid1");

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



	$smarty->assign("show_key1", htmlspecialchars(GetData($data,"people_id", "")));

$keylink="";
$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["people_id"]));

////////////////////////////////////////////
//	people_id - 
	$value="";
		$value = ProcessLargeText(GetData($data,"people_id", ""),"","",MODE_VIEW);
	$smarty->assign("show_people_id",$value);
////////////////////////////////////////////
//	institution - 
	$value="";
		$value = ProcessLargeText(GetData($data,"institution", ""),"","",MODE_VIEW);
	$smarty->assign("show_institution",$value);
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
////////////////////////////////////////////
//	username - 
	$value="";
		$value = ProcessLargeText(GetData($data,"username", ""),"","",MODE_VIEW);
	$smarty->assign("show_username",$value);
////////////////////////////////////////////
//	password - 
	$value="";
		$value = ProcessLargeText(GetData($data,"password", ""),"","",MODE_VIEW);
	$smarty->assign("show_password",$value);
////////////////////////////////////////////
//	picture - 
	$value="";
		$value = ProcessLargeText(GetData($data,"picture", ""),"","",MODE_VIEW);
	$smarty->assign("show_picture",$value);
////////////////////////////////////////////
//	picture_2 - Database Image
	$value="";
					$value = "<img";
						$value.=" border=0";
		$value.=" src=\"t_people_imager.php?field=picture%5F2".$keylink."\">";
	$smarty->assign("show_picture_2",$value);
////////////////////////////////////////////
//	gender - 
	$value="";
		$value = ProcessLargeText(GetData($data,"gender", ""),"","",MODE_VIEW);
	$smarty->assign("show_gender",$value);
////////////////////////////////////////////
//	adminstatus - 
	$value="";
		$value = ProcessLargeText(GetData($data,"adminstatus", ""),"","",MODE_VIEW);
	$smarty->assign("show_adminstatus",$value);
////////////////////////////////////////////
//	birthdate - Short Date
	$value="";
		$value = ProcessLargeText(GetData($data,"birthdate", "Short Date"),"","",MODE_VIEW);
	$smarty->assign("show_birthdate",$value);
////////////////////////////////////////////
//	enabled - 
	$value="";
		$value = ProcessLargeText(GetData($data,"enabled", ""),"","",MODE_VIEW);
	$smarty->assign("show_enabled",$value);
////////////////////////////////////////////
//	temp_sched_from - 
	$value="";
		$value = ProcessLargeText(GetData($data,"temp_sched_from", ""),"","",MODE_VIEW);
	$smarty->assign("show_temp_sched_from",$value);
////////////////////////////////////////////
//	temp_sched_to - 
	$value="";
		$value = ProcessLargeText(GetData($data,"temp_sched_to", ""),"","",MODE_VIEW);
	$smarty->assign("show_temp_sched_to",$value);
////////////////////////////////////////////
//	joiningdate - Short Date
	$value="";
		$value = ProcessLargeText(GetData($data,"joiningdate", "Short Date"),"","",MODE_VIEW);
	$smarty->assign("show_joiningdate",$value);
////////////////////////////////////////////
//	coord_accuracy - 
	$value="";
		$value = ProcessLargeText(GetData($data,"coord_accuracy", ""),"","",MODE_VIEW);
	$smarty->assign("show_coord_accuracy",$value);
////////////////////////////////////////////
//	monday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"monday", ""),"","",MODE_VIEW);
	$smarty->assign("show_monday",$value);
////////////////////////////////////////////
//	tuesday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"tuesday", ""),"","",MODE_VIEW);
	$smarty->assign("show_tuesday",$value);
////////////////////////////////////////////
//	wednesday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"wednesday", ""),"","",MODE_VIEW);
	$smarty->assign("show_wednesday",$value);
////////////////////////////////////////////
//	thursday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"thursday", ""),"","",MODE_VIEW);
	$smarty->assign("show_thursday",$value);
////////////////////////////////////////////
//	friday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"friday", ""),"","",MODE_VIEW);
	$smarty->assign("show_friday",$value);
////////////////////////////////////////////
//	saturday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"saturday", ""),"","",MODE_VIEW);
	$smarty->assign("show_saturday",$value);
////////////////////////////////////////////
//	sunday - 
	$value="";
		$value = ProcessLargeText(GetData($data,"sunday", ""),"","",MODE_VIEW);
	$smarty->assign("show_sunday",$value);
////////////////////////////////////////////
//	monday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"monday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_monday_t",$value);
////////////////////////////////////////////
//	tuesday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"tuesday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_tuesday_t",$value);
////////////////////////////////////////////
//	wednesday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"wednesday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_wednesday_t",$value);
////////////////////////////////////////////
//	thursday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"thursday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_thursday_t",$value);
////////////////////////////////////////////
//	friday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"friday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_friday_t",$value);
////////////////////////////////////////////
//	saturday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"saturday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_saturday_t",$value);
////////////////////////////////////////////
//	sunday_t - 
	$value="";
		$value = ProcessLargeText(GetData($data,"sunday_t", ""),"","",MODE_VIEW);
	$smarty->assign("show_sunday_t",$value);
////////////////////////////////////////////
//	preferred_contact_by - 
	$value="";
		$value = ProcessLargeText(GetData($data,"preferred_contact_by", ""),"","",MODE_VIEW);
	$smarty->assign("show_preferred_contact_by",$value);
////////////////////////////////////////////
//	date_last_adress_change - Short Date
	$value="";
		$value = ProcessLargeText(GetData($data,"date_last_adress_change", "Short Date"),"","",MODE_VIEW);
	$smarty->assign("show_date_last_adress_change",$value);
////////////////////////////////////////////
//	map_in - 
	$value="";
		$value = ProcessLargeText(GetData($data,"map_in", ""),"","",MODE_VIEW);
	$smarty->assign("show_map_in",$value);
////////////////////////////////////////////
//	IconPath - 
	$value="";
		$value = ProcessLargeText(GetData($data,"IconPath", ""),"","",MODE_VIEW);
	$smarty->assign("show_IconPath",$value);
////////////////////////////////////////////
//	Icon - Database Image
	$value="";
					$value = "<img";
						$value.=" border=0";
		$value.=" src=\"t_people_imager.php?field=Icon".$keylink."\">";
	$smarty->assign("show_Icon",$value);
////////////////////////////////////////////
//	note - 
	$value="";
		$value = ProcessLargeText(GetData($data,"note", ""),"","",MODE_VIEW);
	$smarty->assign("show_note",$value);
////////////////////////////////////////////
//	price_per_hour - Number
	$value="";
		$value = ProcessLargeText(GetData($data,"price_per_hour", "Number"),"","",MODE_VIEW);
	$smarty->assign("show_price_per_hour",$value);
////////////////////////////////////////////
//	psych_time_loose_tight - 
	$value="";
		$value = ProcessLargeText(GetData($data,"psych_time_loose_tight", ""),"","",MODE_VIEW);
	$smarty->assign("show_psych_time_loose_tight",$value);
////////////////////////////////////////////
//	psych_exact_creativ - 
	$value="";
		$value = ProcessLargeText(GetData($data,"psych_exact_creativ", ""),"","",MODE_VIEW);
	$smarty->assign("show_psych_exact_creativ",$value);
////////////////////////////////////////////
//	psych_heart_thing - 
	$value="";
		$value = ProcessLargeText(GetData($data,"psych_heart_thing", ""),"","",MODE_VIEW);
	$smarty->assign("show_psych_heart_thing",$value);
////////////////////////////////////////////
//	psych_easy_security - 
	$value="";
		$value = ProcessLargeText(GetData($data,"psych_easy_security", ""),"","",MODE_VIEW);
	$smarty->assign("show_psych_easy_security",$value);
////////////////////////////////////////////
//	psych_conflict_take_leave - 
	$value="";
		$value = ProcessLargeText(GetData($data,"psych_conflict_take_leave", ""),"","",MODE_VIEW);
	$smarty->assign("show_psych_conflict_take_leave",$value);
////////////////////////////////////////////
//	longitude - Number
	$value="";
		$value = ProcessLargeText(GetData($data,"longitude", "Number"),"","",MODE_VIEW);
	$smarty->assign("show_longitude",$value);
////////////////////////////////////////////
//	latitude - Number
	$value="";
		$value = ProcessLargeText(GetData($data,"latitude", "Number"),"","",MODE_VIEW);
	$smarty->assign("show_latitude",$value);
////////////////////////////////////////////
//	Agree - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Agree", ""),"","",MODE_VIEW);
	$smarty->assign("show_Agree",$value);
////////////////////////////////////////////
//	Sign_date - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Sign_date", ""),"","",MODE_VIEW);
	$smarty->assign("show_Sign_date",$value);
////////////////////////////////////////////
//	Active - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Active", ""),"","",MODE_VIEW);
	$smarty->assign("show_Active",$value);
////////////////////////////////////////////
//	Acode - 
	$value="";
		$value = ProcessLargeText(GetData($data,"Acode", ""),"","",MODE_VIEW);
	$smarty->assign("show_Acode",$value);
$smarty->assign("pdf",postvalue("pdf"));
$pagename = $_SERVER["REQUEST_URI"];
if(strpos($_SERVER["REQUEST_URI"],"?")===false)
	$pagename.="?pdf=1";
else
	$pagename.="&pdf=1";
$smarty->assign("pageurl",$pagename);

$smarty->assign("all",$all);

$templatefile = "t_people_view.htm";
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
