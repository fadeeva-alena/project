<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/t_people_variables.php");
include('include/xtempl.php');
include('classes/viewpage.php');
include("classes/searchclause.php");

add_nocache_headers();

//	check if logged in
if(!isLogged() || CheckPermissionsEvent($strTableName, 'S') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$layout = new TLayout("view2","BoldAqua","MobileAqua");
$layout->blocks["top"] = array();
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";
$layout->containers["view"] = array();

$layout->containers["view"][] = array("name"=>"viewheader","block"=>"","substyle"=>2);


$layout->containers["view"][] = array("name"=>"wrapper","block"=>"","substyle"=>1, "container"=>"fields");


$layout->containers["fields"] = array();

$layout->containers["fields"][] = array("name"=>"viewfields","block"=>"","substyle"=>1);


$layout->containers["fields"][] = array("name"=>"viewbuttons","block"=>"","substyle"=>2);


$layout->skins["fields"] = "fields";

$layout->skins["view"] = "1";
$layout->blocks["top"][] = "view";
$layout->skins["details"] = "empty";
$layout->blocks["top"][] = "details";$page_layouts["t_people_view"] = $layout;




//$cipherer = new RunnerCipherer($strTableName);
	
$xt = new Xtempl();

$query = $gQuery->Copy();

$filename = "";	
$message = "";
$key = array();
$next = array();
$prev = array();
$all = postvalue("all");
$pdf = postvalue("pdf");
$mypage = 1;

//Show view page as popUp or not
$inlineview = (postvalue("onFly") ? true : false);

//If show view as popUp, get parent Id
if($inlineview)
	$parId = postvalue("parId");
else
	$parId = 0;

//Set page id	
if(postvalue("id"))
	$id = postvalue("id");
else
	$id = 1;

//$isNeedSettings = true;//($inlineview && postvalue("isNeedSettings") == 'true') || (!$inlineview);	
	
// assign an id
$xt->assign("id",$id);

//array of params for classes
$params = array("pageType" => PAGE_VIEW, "id" => $id, "tName" => $strTableName);
$params["xt"] = &$xt;
$params["all"] = $all;

//Get array of tabs for edit page
$params['useTabsOnView'] = $gSettings->useTabsOnView();
if($params['useTabsOnView'])
	$params['arrViewTabs'] = $gSettings->getViewTabs();
$pageObject = new ViewPage($params);

// SearchClause class stuff
$pageObject->searchClauseObj->parseRequest();
$_SESSION[$strTableName.'_advsearch'] = serialize($pageObject->searchClauseObj);

// proccess big google maps

// add button events if exist
$pageObject->addButtonHandlers();

//For show detail tables on master page view
$dpParams = array();
if($pageObject->isShowDetailTables && !isMobile())
{
	$ids = $id;
	$pageObject->jsSettings['tableSettings'][$strTableName]['dpParams'] = array();
}

//	Before Process event
if($eventObj->exists("BeforeProcessView"))
	$eventObj->BeforeProcessView($conn, $pageObject);
	
//	read current values from the database
$data = $pageObject->getCurrentRecordInternal();

if (!sizeof($data)) {
	header("Location: t_people_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "people_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("people_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "institution";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("institution");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "prof_provider";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("prof_provider");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "firstname";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("firstname");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "lastname";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("lastname");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "image_path";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("image_path");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "street";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("street");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "house_nr";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("house_nr");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "zip";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("zip");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "location";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("location");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "locationarea";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("locationarea");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tel_p";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tel_p");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tel_m";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tel_m");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "email";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("email");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "username";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("username");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "password";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("password");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "picture";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("picture");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "picture_2";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("picture_2");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "gender";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("gender");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "birthdate";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("birthdate");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "enabled";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("enabled");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "temp_sched_from";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("temp_sched_from");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "temp_sched_to";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("temp_sched_to");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "joiningdate";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("joiningdate");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "coord_accuracy";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("coord_accuracy");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "monday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("monday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tuesday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tuesday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "wednesday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("wednesday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "thursday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("thursday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "friday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("friday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "saturday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("saturday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "sunday";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("sunday");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "monday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("monday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "tuesday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("tuesday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "wednesday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("wednesday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "thursday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("thursday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "friday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("friday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "saturday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("saturday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "sunday_t";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("sunday_t");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "preferred_contact_by";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("preferred_contact_by");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "date_last_adress_change";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("date_last_adress_change");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "map_in";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("map_in");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "IconPath";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("IconPath");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Icon";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Icon");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "note";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("note");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "price_per_hour";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("price_per_hour");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "psych_time_loose_tight";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("psych_time_loose_tight");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "psych_exact_creativ";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("psych_exact_creativ");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "psych_heart_thing";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("psych_heart_thing");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "psych_easy_security";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("psych_easy_security");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "psych_conflict_take_leave";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("psych_conflict_take_leave");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "longitude";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("longitude");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "latitude";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("latitude");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Agree";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Agree");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Sign_date";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Sign_date");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Active";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Active");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "Acode";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("Acode");
$fieldsArr[] = $arr;

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("people_id", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["people_id"]));

////////////////////////////////////////////
//people_id - 
	
	$value = $pageObject->showDBValue("people_id", $data, $keylink);
	if($mainTableOwnerID=="people_id")
		$ownerIdValue=$value;
	$xt->assign("people_id_value",$value);
	if(!$pageObject->isAppearOnTabs("people_id"))
		$xt->assign("people_id_fieldblock",true);
	else
		$xt->assign("people_id_tabfieldblock",true);
////////////////////////////////////////////
//institution - 
	
	$value = $pageObject->showDBValue("institution", $data, $keylink);
	if($mainTableOwnerID=="institution")
		$ownerIdValue=$value;
	$xt->assign("institution_value",$value);
	if(!$pageObject->isAppearOnTabs("institution"))
		$xt->assign("institution_fieldblock",true);
	else
		$xt->assign("institution_tabfieldblock",true);
////////////////////////////////////////////
//prof_provider - 
	
	$value = $pageObject->showDBValue("prof_provider", $data, $keylink);
	if($mainTableOwnerID=="prof_provider")
		$ownerIdValue=$value;
	$xt->assign("prof_provider_value",$value);
	if(!$pageObject->isAppearOnTabs("prof_provider"))
		$xt->assign("prof_provider_fieldblock",true);
	else
		$xt->assign("prof_provider_tabfieldblock",true);
////////////////////////////////////////////
//firstname - 
	
	$value = $pageObject->showDBValue("firstname", $data, $keylink);
	if($mainTableOwnerID=="firstname")
		$ownerIdValue=$value;
	$xt->assign("firstname_value",$value);
	if(!$pageObject->isAppearOnTabs("firstname"))
		$xt->assign("firstname_fieldblock",true);
	else
		$xt->assign("firstname_tabfieldblock",true);
////////////////////////////////////////////
//lastname - 
	
	$value = $pageObject->showDBValue("lastname", $data, $keylink);
	if($mainTableOwnerID=="lastname")
		$ownerIdValue=$value;
	$xt->assign("lastname_value",$value);
	if(!$pageObject->isAppearOnTabs("lastname"))
		$xt->assign("lastname_fieldblock",true);
	else
		$xt->assign("lastname_tabfieldblock",true);
////////////////////////////////////////////
//image_path - File-based Image
	
	$value = $pageObject->showDBValue("image_path", $data, $keylink);
	if($mainTableOwnerID=="image_path")
		$ownerIdValue=$value;
	$xt->assign("image_path_value",$value);
	if(!$pageObject->isAppearOnTabs("image_path"))
		$xt->assign("image_path_fieldblock",true);
	else
		$xt->assign("image_path_tabfieldblock",true);
////////////////////////////////////////////
//street - 
	
	$value = $pageObject->showDBValue("street", $data, $keylink);
	if($mainTableOwnerID=="street")
		$ownerIdValue=$value;
	$xt->assign("street_value",$value);
	if(!$pageObject->isAppearOnTabs("street"))
		$xt->assign("street_fieldblock",true);
	else
		$xt->assign("street_tabfieldblock",true);
////////////////////////////////////////////
//house_nr - 
	
	$value = $pageObject->showDBValue("house_nr", $data, $keylink);
	if($mainTableOwnerID=="house_nr")
		$ownerIdValue=$value;
	$xt->assign("house_nr_value",$value);
	if(!$pageObject->isAppearOnTabs("house_nr"))
		$xt->assign("house_nr_fieldblock",true);
	else
		$xt->assign("house_nr_tabfieldblock",true);
////////////////////////////////////////////
//zip - 
	
	$value = $pageObject->showDBValue("zip", $data, $keylink);
	if($mainTableOwnerID=="zip")
		$ownerIdValue=$value;
	$xt->assign("zip_value",$value);
	if(!$pageObject->isAppearOnTabs("zip"))
		$xt->assign("zip_fieldblock",true);
	else
		$xt->assign("zip_tabfieldblock",true);
////////////////////////////////////////////
//location - 
	
	$value = $pageObject->showDBValue("location", $data, $keylink);
	if($mainTableOwnerID=="location")
		$ownerIdValue=$value;
	$xt->assign("location_value",$value);
	if(!$pageObject->isAppearOnTabs("location"))
		$xt->assign("location_fieldblock",true);
	else
		$xt->assign("location_tabfieldblock",true);
////////////////////////////////////////////
//locationarea - 
	
	$value = $pageObject->showDBValue("locationarea", $data, $keylink);
	if($mainTableOwnerID=="locationarea")
		$ownerIdValue=$value;
	$xt->assign("locationarea_value",$value);
	if(!$pageObject->isAppearOnTabs("locationarea"))
		$xt->assign("locationarea_fieldblock",true);
	else
		$xt->assign("locationarea_tabfieldblock",true);
////////////////////////////////////////////
//tel_p - 
	
	$value = $pageObject->showDBValue("tel_p", $data, $keylink);
	if($mainTableOwnerID=="tel_p")
		$ownerIdValue=$value;
	$xt->assign("tel_p_value",$value);
	if(!$pageObject->isAppearOnTabs("tel_p"))
		$xt->assign("tel_p_fieldblock",true);
	else
		$xt->assign("tel_p_tabfieldblock",true);
////////////////////////////////////////////
//tel_m - 
	
	$value = $pageObject->showDBValue("tel_m", $data, $keylink);
	if($mainTableOwnerID=="tel_m")
		$ownerIdValue=$value;
	$xt->assign("tel_m_value",$value);
	if(!$pageObject->isAppearOnTabs("tel_m"))
		$xt->assign("tel_m_fieldblock",true);
	else
		$xt->assign("tel_m_tabfieldblock",true);
////////////////////////////////////////////
//email - 
	
	$value = $pageObject->showDBValue("email", $data, $keylink);
	if($mainTableOwnerID=="email")
		$ownerIdValue=$value;
	$xt->assign("email_value",$value);
	if(!$pageObject->isAppearOnTabs("email"))
		$xt->assign("email_fieldblock",true);
	else
		$xt->assign("email_tabfieldblock",true);
////////////////////////////////////////////
//username - 
	
	$value = $pageObject->showDBValue("username", $data, $keylink);
	if($mainTableOwnerID=="username")
		$ownerIdValue=$value;
	$xt->assign("username_value",$value);
	if(!$pageObject->isAppearOnTabs("username"))
		$xt->assign("username_fieldblock",true);
	else
		$xt->assign("username_tabfieldblock",true);
////////////////////////////////////////////
//password - 
	
	$value = $pageObject->showDBValue("password", $data, $keylink);
	if($mainTableOwnerID=="password")
		$ownerIdValue=$value;
	$xt->assign("password_value",$value);
	if(!$pageObject->isAppearOnTabs("password"))
		$xt->assign("password_fieldblock",true);
	else
		$xt->assign("password_tabfieldblock",true);
////////////////////////////////////////////
//picture - 
	
	$value = $pageObject->showDBValue("picture", $data, $keylink);
	if($mainTableOwnerID=="picture")
		$ownerIdValue=$value;
	$xt->assign("picture_value",$value);
	if(!$pageObject->isAppearOnTabs("picture"))
		$xt->assign("picture_fieldblock",true);
	else
		$xt->assign("picture_tabfieldblock",true);
////////////////////////////////////////////
//picture_2 - Database Image
	
	$value = $pageObject->showDBValue("picture_2", $data, $keylink);
	if($mainTableOwnerID=="picture_2")
		$ownerIdValue=$value;
	$xt->assign("picture_2_value",$value);
	if(!$pageObject->isAppearOnTabs("picture_2"))
		$xt->assign("picture_2_fieldblock",true);
	else
		$xt->assign("picture_2_tabfieldblock",true);
////////////////////////////////////////////
//gender - 
	
	$value = $pageObject->showDBValue("gender", $data, $keylink);
	if($mainTableOwnerID=="gender")
		$ownerIdValue=$value;
	$xt->assign("gender_value",$value);
	if(!$pageObject->isAppearOnTabs("gender"))
		$xt->assign("gender_fieldblock",true);
	else
		$xt->assign("gender_tabfieldblock",true);
////////////////////////////////////////////
//birthdate - Short Date
	
	$value = $pageObject->showDBValue("birthdate", $data, $keylink);
	if($mainTableOwnerID=="birthdate")
		$ownerIdValue=$value;
	$xt->assign("birthdate_value",$value);
	if(!$pageObject->isAppearOnTabs("birthdate"))
		$xt->assign("birthdate_fieldblock",true);
	else
		$xt->assign("birthdate_tabfieldblock",true);
////////////////////////////////////////////
//enabled - 
	
	$value = $pageObject->showDBValue("enabled", $data, $keylink);
	if($mainTableOwnerID=="enabled")
		$ownerIdValue=$value;
	$xt->assign("enabled_value",$value);
	if(!$pageObject->isAppearOnTabs("enabled"))
		$xt->assign("enabled_fieldblock",true);
	else
		$xt->assign("enabled_tabfieldblock",true);
////////////////////////////////////////////
//temp_sched_from - 
	
	$value = $pageObject->showDBValue("temp_sched_from", $data, $keylink);
	if($mainTableOwnerID=="temp_sched_from")
		$ownerIdValue=$value;
	$xt->assign("temp_sched_from_value",$value);
	if(!$pageObject->isAppearOnTabs("temp_sched_from"))
		$xt->assign("temp_sched_from_fieldblock",true);
	else
		$xt->assign("temp_sched_from_tabfieldblock",true);
////////////////////////////////////////////
//temp_sched_to - 
	
	$value = $pageObject->showDBValue("temp_sched_to", $data, $keylink);
	if($mainTableOwnerID=="temp_sched_to")
		$ownerIdValue=$value;
	$xt->assign("temp_sched_to_value",$value);
	if(!$pageObject->isAppearOnTabs("temp_sched_to"))
		$xt->assign("temp_sched_to_fieldblock",true);
	else
		$xt->assign("temp_sched_to_tabfieldblock",true);
////////////////////////////////////////////
//joiningdate - Short Date
	
	$value = $pageObject->showDBValue("joiningdate", $data, $keylink);
	if($mainTableOwnerID=="joiningdate")
		$ownerIdValue=$value;
	$xt->assign("joiningdate_value",$value);
	if(!$pageObject->isAppearOnTabs("joiningdate"))
		$xt->assign("joiningdate_fieldblock",true);
	else
		$xt->assign("joiningdate_tabfieldblock",true);
////////////////////////////////////////////
//coord_accuracy - 
	
	$value = $pageObject->showDBValue("coord_accuracy", $data, $keylink);
	if($mainTableOwnerID=="coord_accuracy")
		$ownerIdValue=$value;
	$xt->assign("coord_accuracy_value",$value);
	if(!$pageObject->isAppearOnTabs("coord_accuracy"))
		$xt->assign("coord_accuracy_fieldblock",true);
	else
		$xt->assign("coord_accuracy_tabfieldblock",true);
////////////////////////////////////////////
//monday - 
	
	$value = $pageObject->showDBValue("monday", $data, $keylink);
	if($mainTableOwnerID=="monday")
		$ownerIdValue=$value;
	$xt->assign("monday_value",$value);
	if(!$pageObject->isAppearOnTabs("monday"))
		$xt->assign("monday_fieldblock",true);
	else
		$xt->assign("monday_tabfieldblock",true);
////////////////////////////////////////////
//tuesday - 
	
	$value = $pageObject->showDBValue("tuesday", $data, $keylink);
	if($mainTableOwnerID=="tuesday")
		$ownerIdValue=$value;
	$xt->assign("tuesday_value",$value);
	if(!$pageObject->isAppearOnTabs("tuesday"))
		$xt->assign("tuesday_fieldblock",true);
	else
		$xt->assign("tuesday_tabfieldblock",true);
////////////////////////////////////////////
//wednesday - 
	
	$value = $pageObject->showDBValue("wednesday", $data, $keylink);
	if($mainTableOwnerID=="wednesday")
		$ownerIdValue=$value;
	$xt->assign("wednesday_value",$value);
	if(!$pageObject->isAppearOnTabs("wednesday"))
		$xt->assign("wednesday_fieldblock",true);
	else
		$xt->assign("wednesday_tabfieldblock",true);
////////////////////////////////////////////
//thursday - 
	
	$value = $pageObject->showDBValue("thursday", $data, $keylink);
	if($mainTableOwnerID=="thursday")
		$ownerIdValue=$value;
	$xt->assign("thursday_value",$value);
	if(!$pageObject->isAppearOnTabs("thursday"))
		$xt->assign("thursday_fieldblock",true);
	else
		$xt->assign("thursday_tabfieldblock",true);
////////////////////////////////////////////
//friday - 
	
	$value = $pageObject->showDBValue("friday", $data, $keylink);
	if($mainTableOwnerID=="friday")
		$ownerIdValue=$value;
	$xt->assign("friday_value",$value);
	if(!$pageObject->isAppearOnTabs("friday"))
		$xt->assign("friday_fieldblock",true);
	else
		$xt->assign("friday_tabfieldblock",true);
////////////////////////////////////////////
//saturday - 
	
	$value = $pageObject->showDBValue("saturday", $data, $keylink);
	if($mainTableOwnerID=="saturday")
		$ownerIdValue=$value;
	$xt->assign("saturday_value",$value);
	if(!$pageObject->isAppearOnTabs("saturday"))
		$xt->assign("saturday_fieldblock",true);
	else
		$xt->assign("saturday_tabfieldblock",true);
////////////////////////////////////////////
//sunday - 
	
	$value = $pageObject->showDBValue("sunday", $data, $keylink);
	if($mainTableOwnerID=="sunday")
		$ownerIdValue=$value;
	$xt->assign("sunday_value",$value);
	if(!$pageObject->isAppearOnTabs("sunday"))
		$xt->assign("sunday_fieldblock",true);
	else
		$xt->assign("sunday_tabfieldblock",true);
////////////////////////////////////////////
//monday_t - 
	
	$value = $pageObject->showDBValue("monday_t", $data, $keylink);
	if($mainTableOwnerID=="monday_t")
		$ownerIdValue=$value;
	$xt->assign("monday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("monday_t"))
		$xt->assign("monday_t_fieldblock",true);
	else
		$xt->assign("monday_t_tabfieldblock",true);
////////////////////////////////////////////
//tuesday_t - 
	
	$value = $pageObject->showDBValue("tuesday_t", $data, $keylink);
	if($mainTableOwnerID=="tuesday_t")
		$ownerIdValue=$value;
	$xt->assign("tuesday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("tuesday_t"))
		$xt->assign("tuesday_t_fieldblock",true);
	else
		$xt->assign("tuesday_t_tabfieldblock",true);
////////////////////////////////////////////
//wednesday_t - 
	
	$value = $pageObject->showDBValue("wednesday_t", $data, $keylink);
	if($mainTableOwnerID=="wednesday_t")
		$ownerIdValue=$value;
	$xt->assign("wednesday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("wednesday_t"))
		$xt->assign("wednesday_t_fieldblock",true);
	else
		$xt->assign("wednesday_t_tabfieldblock",true);
////////////////////////////////////////////
//thursday_t - 
	
	$value = $pageObject->showDBValue("thursday_t", $data, $keylink);
	if($mainTableOwnerID=="thursday_t")
		$ownerIdValue=$value;
	$xt->assign("thursday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("thursday_t"))
		$xt->assign("thursday_t_fieldblock",true);
	else
		$xt->assign("thursday_t_tabfieldblock",true);
////////////////////////////////////////////
//friday_t - 
	
	$value = $pageObject->showDBValue("friday_t", $data, $keylink);
	if($mainTableOwnerID=="friday_t")
		$ownerIdValue=$value;
	$xt->assign("friday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("friday_t"))
		$xt->assign("friday_t_fieldblock",true);
	else
		$xt->assign("friday_t_tabfieldblock",true);
////////////////////////////////////////////
//saturday_t - 
	
	$value = $pageObject->showDBValue("saturday_t", $data, $keylink);
	if($mainTableOwnerID=="saturday_t")
		$ownerIdValue=$value;
	$xt->assign("saturday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("saturday_t"))
		$xt->assign("saturday_t_fieldblock",true);
	else
		$xt->assign("saturday_t_tabfieldblock",true);
////////////////////////////////////////////
//sunday_t - 
	
	$value = $pageObject->showDBValue("sunday_t", $data, $keylink);
	if($mainTableOwnerID=="sunday_t")
		$ownerIdValue=$value;
	$xt->assign("sunday_t_value",$value);
	if(!$pageObject->isAppearOnTabs("sunday_t"))
		$xt->assign("sunday_t_fieldblock",true);
	else
		$xt->assign("sunday_t_tabfieldblock",true);
////////////////////////////////////////////
//preferred_contact_by - 
	
	$value = $pageObject->showDBValue("preferred_contact_by", $data, $keylink);
	if($mainTableOwnerID=="preferred_contact_by")
		$ownerIdValue=$value;
	$xt->assign("preferred_contact_by_value",$value);
	if(!$pageObject->isAppearOnTabs("preferred_contact_by"))
		$xt->assign("preferred_contact_by_fieldblock",true);
	else
		$xt->assign("preferred_contact_by_tabfieldblock",true);
////////////////////////////////////////////
//date_last_adress_change - Short Date
	
	$value = $pageObject->showDBValue("date_last_adress_change", $data, $keylink);
	if($mainTableOwnerID=="date_last_adress_change")
		$ownerIdValue=$value;
	$xt->assign("date_last_adress_change_value",$value);
	if(!$pageObject->isAppearOnTabs("date_last_adress_change"))
		$xt->assign("date_last_adress_change_fieldblock",true);
	else
		$xt->assign("date_last_adress_change_tabfieldblock",true);
////////////////////////////////////////////
//map_in - 
	
	$value = $pageObject->showDBValue("map_in", $data, $keylink);
	if($mainTableOwnerID=="map_in")
		$ownerIdValue=$value;
	$xt->assign("map_in_value",$value);
	if(!$pageObject->isAppearOnTabs("map_in"))
		$xt->assign("map_in_fieldblock",true);
	else
		$xt->assign("map_in_tabfieldblock",true);
////////////////////////////////////////////
//IconPath - 
	
	$value = $pageObject->showDBValue("IconPath", $data, $keylink);
	if($mainTableOwnerID=="IconPath")
		$ownerIdValue=$value;
	$xt->assign("IconPath_value",$value);
	if(!$pageObject->isAppearOnTabs("IconPath"))
		$xt->assign("IconPath_fieldblock",true);
	else
		$xt->assign("IconPath_tabfieldblock",true);
////////////////////////////////////////////
//Icon - Database Image
	
	$value = $pageObject->showDBValue("Icon", $data, $keylink);
	if($mainTableOwnerID=="Icon")
		$ownerIdValue=$value;
	$xt->assign("Icon_value",$value);
	if(!$pageObject->isAppearOnTabs("Icon"))
		$xt->assign("Icon_fieldblock",true);
	else
		$xt->assign("Icon_tabfieldblock",true);
////////////////////////////////////////////
//note - 
	
	$value = $pageObject->showDBValue("note", $data, $keylink);
	if($mainTableOwnerID=="note")
		$ownerIdValue=$value;
	$xt->assign("note_value",$value);
	if(!$pageObject->isAppearOnTabs("note"))
		$xt->assign("note_fieldblock",true);
	else
		$xt->assign("note_tabfieldblock",true);
////////////////////////////////////////////
//price_per_hour - Number
	
	$value = $pageObject->showDBValue("price_per_hour", $data, $keylink);
	if($mainTableOwnerID=="price_per_hour")
		$ownerIdValue=$value;
	$xt->assign("price_per_hour_value",$value);
	if(!$pageObject->isAppearOnTabs("price_per_hour"))
		$xt->assign("price_per_hour_fieldblock",true);
	else
		$xt->assign("price_per_hour_tabfieldblock",true);
////////////////////////////////////////////
//psych_time_loose_tight - 
	
	$value = $pageObject->showDBValue("psych_time_loose_tight", $data, $keylink);
	if($mainTableOwnerID=="psych_time_loose_tight")
		$ownerIdValue=$value;
	$xt->assign("psych_time_loose_tight_value",$value);
	if(!$pageObject->isAppearOnTabs("psych_time_loose_tight"))
		$xt->assign("psych_time_loose_tight_fieldblock",true);
	else
		$xt->assign("psych_time_loose_tight_tabfieldblock",true);
////////////////////////////////////////////
//psych_exact_creativ - 
	
	$value = $pageObject->showDBValue("psych_exact_creativ", $data, $keylink);
	if($mainTableOwnerID=="psych_exact_creativ")
		$ownerIdValue=$value;
	$xt->assign("psych_exact_creativ_value",$value);
	if(!$pageObject->isAppearOnTabs("psych_exact_creativ"))
		$xt->assign("psych_exact_creativ_fieldblock",true);
	else
		$xt->assign("psych_exact_creativ_tabfieldblock",true);
////////////////////////////////////////////
//psych_heart_thing - 
	
	$value = $pageObject->showDBValue("psych_heart_thing", $data, $keylink);
	if($mainTableOwnerID=="psych_heart_thing")
		$ownerIdValue=$value;
	$xt->assign("psych_heart_thing_value",$value);
	if(!$pageObject->isAppearOnTabs("psych_heart_thing"))
		$xt->assign("psych_heart_thing_fieldblock",true);
	else
		$xt->assign("psych_heart_thing_tabfieldblock",true);
////////////////////////////////////////////
//psych_easy_security - 
	
	$value = $pageObject->showDBValue("psych_easy_security", $data, $keylink);
	if($mainTableOwnerID=="psych_easy_security")
		$ownerIdValue=$value;
	$xt->assign("psych_easy_security_value",$value);
	if(!$pageObject->isAppearOnTabs("psych_easy_security"))
		$xt->assign("psych_easy_security_fieldblock",true);
	else
		$xt->assign("psych_easy_security_tabfieldblock",true);
////////////////////////////////////////////
//psych_conflict_take_leave - 
	
	$value = $pageObject->showDBValue("psych_conflict_take_leave", $data, $keylink);
	if($mainTableOwnerID=="psych_conflict_take_leave")
		$ownerIdValue=$value;
	$xt->assign("psych_conflict_take_leave_value",$value);
	if(!$pageObject->isAppearOnTabs("psych_conflict_take_leave"))
		$xt->assign("psych_conflict_take_leave_fieldblock",true);
	else
		$xt->assign("psych_conflict_take_leave_tabfieldblock",true);
////////////////////////////////////////////
//longitude - Number
	
	$value = $pageObject->showDBValue("longitude", $data, $keylink);
	if($mainTableOwnerID=="longitude")
		$ownerIdValue=$value;
	$xt->assign("longitude_value",$value);
	if(!$pageObject->isAppearOnTabs("longitude"))
		$xt->assign("longitude_fieldblock",true);
	else
		$xt->assign("longitude_tabfieldblock",true);
////////////////////////////////////////////
//latitude - Number
	
	$value = $pageObject->showDBValue("latitude", $data, $keylink);
	if($mainTableOwnerID=="latitude")
		$ownerIdValue=$value;
	$xt->assign("latitude_value",$value);
	if(!$pageObject->isAppearOnTabs("latitude"))
		$xt->assign("latitude_fieldblock",true);
	else
		$xt->assign("latitude_tabfieldblock",true);
////////////////////////////////////////////
//Agree - 
	
	$value = $pageObject->showDBValue("Agree", $data, $keylink);
	if($mainTableOwnerID=="Agree")
		$ownerIdValue=$value;
	$xt->assign("Agree_value",$value);
	if(!$pageObject->isAppearOnTabs("Agree"))
		$xt->assign("Agree_fieldblock",true);
	else
		$xt->assign("Agree_tabfieldblock",true);
////////////////////////////////////////////
//Sign_date - 
	
	$value = $pageObject->showDBValue("Sign_date", $data, $keylink);
	if($mainTableOwnerID=="Sign_date")
		$ownerIdValue=$value;
	$xt->assign("Sign_date_value",$value);
	if(!$pageObject->isAppearOnTabs("Sign_date"))
		$xt->assign("Sign_date_fieldblock",true);
	else
		$xt->assign("Sign_date_tabfieldblock",true);
////////////////////////////////////////////
//Active - 
	
	$value = $pageObject->showDBValue("Active", $data, $keylink);
	if($mainTableOwnerID=="Active")
		$ownerIdValue=$value;
	$xt->assign("Active_value",$value);
	if(!$pageObject->isAppearOnTabs("Active"))
		$xt->assign("Active_fieldblock",true);
	else
		$xt->assign("Active_tabfieldblock",true);
////////////////////////////////////////////
//Acode - 
	
	$value = $pageObject->showDBValue("Acode", $data, $keylink);
	if($mainTableOwnerID=="Acode")
		$ownerIdValue=$value;
	$xt->assign("Acode_value",$value);
	if(!$pageObject->isAppearOnTabs("Acode"))
		$xt->assign("Acode_fieldblock",true);
	else
		$xt->assign("Acode_tabfieldblock",true);

/////////////////////////////////////////////////////////////
if($pageObject->isShowDetailTables && !isMobile())
{
	if(count($dpParams['ids']))
	{
		$xt->assign("detail_tables",true);
		include('classes/listpage.php');
		include('classes/listpage_embed.php');
		include('classes/listpage_dpinline.php');
	}
	
	$dControlsMap = array();
	$dViewControlsMap = array();
	
	for($d=0;$d<count($dpParams['ids']);$d++)
	{
		$options = array();
		//array of params for classes
		$options["mode"] = LIST_DETAILS;
		$options["pageType"] = PAGE_LIST;
		$options["masterPageType"] = PAGE_VIEW;
		$options["mainMasterPageType"] = PAGE_VIEW;
		$options['masterTable'] = "t_people";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "t_people";
			continue;
		}
		
		$layout = GetPageLayout(GoodFieldName($strTableName), PAGE_LIST);
		if($layout)
		{
			$rtl = $xt->getReadingOrder() == 'RTL' ? 'RTL' : '';
			$xt->cssFiles[] = array("stylepath" => "styles/".$layout->style.'/style'.$rtl.".css"
				, "pagestylepath" => "pagestyles/".$layout->name.$rtl.".css");
			$xt->IEcssFiles[] = array("stylepathIE" => "styles/".$layout->style.'/styleIE'.".css");
		}
		
		$options['xt'] = new Xtempl();
		$options['id'] = $dpParams['ids'][$d];
		$options['flyId'] = $pageObject->genId()+1;
		$mkr = 1;
		foreach($mKeys[$strTableName] as $mk)
			$options['masterKeysReq'][$mkr++] = $data[$mk];

		$listPageObject = ListPage::createListPage($strTableName, $options);
		
		// prepare code
		$listPageObject->prepareForBuildPage();
		
		// show page
		if($listPageObject->permis[$strTableName]['search'] && $listPageObject->rowsFound)
		{
			//set page events
			foreach($listPageObject->eventsObject->events as $event => $name)
				$listPageObject->xt->assign_event($event, $listPageObject->eventsObject, $event, array());
			
			//add detail settings to master settings
			$listPageObject->addControlsJSAndCSS();
			$listPageObject->fillSetCntrlMaps();
			$pageObject->jsSettings['tableSettings'][$strTableName]	= $listPageObject->jsSettings['tableSettings'][$strTableName];
			$dControlsMap[$strTableName] = $listPageObject->controlsMap;
			$dViewControlsMap[$strTableName] = $listPageObject->viewControlsMap;
			foreach($listPageObject->jsSettings['global']['shortTNames'] as $keySet=>$val)
			{
				if(!array_key_exists($keySet,$pageObject->settingsMap["globalSettings"]['shortTNames']))
					$pageObject->settingsMap["globalSettings"]['shortTNames'][$keySet] = $val;
			}
			
			//Add detail's js files to master's files
			$pageObject->copyAllJSFiles($listPageObject->grabAllJSFiles());
			
			//Add detail's css files to master's files
			$pageObject->copyAllCSSFiles($listPageObject->grabAllCSSFiles());
		
			$xtParams = array("method"=>'showPage', "params"=> false);
			$xtParams['object'] = $listPageObject;
			$xt->assign("displayDetailTable_".GoodFieldName($listPageObject->tName), $xtParams);
		
			$pageObject->controlsMap['dpTablesParams'][] = array('tName'=>$strTableName, 'id'=>$options['id']);
		}
	}
	$pageObject->controlsMap['dControlsMap'] = $dControlsMap;
	$pageObject->viewControlsMap['dViewControlsMap'] = $dViewControlsMap; 
	$strTableName = "t_people";
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin prepare for Next Prev button
if(!@$_SESSION[$strTableName."_noNextPrev"] && !$inlineview && !$pdf)
{
	$pageObject->getNextPrevRecordKeys($data,"Search",$next,$prev);
}
//End prepare for Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


if ($pageObject->googleMapCfg['isUseGoogleMap'])
{
	$pageObject->initGmaps();
}

$pageObject->addCommonJs();

//fill tab groups name and sections name to controls
$pageObject->fillCntrlTabGroups();

if(!$inlineview)
{
	$pageObject->body["begin"].="<script type=\"text/javascript\" src=\"include/loadfirst.js\"></script>\r\n";
		$pageObject->body["begin"].= "<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";		
	
	$pageObject->jsSettings['tableSettings'][$strTableName]["keys"] = $pageObject->jsKeys;
	$pageObject->jsSettings['tableSettings'][$strTableName]['keyFields'] = $pageObject->keyFields;
	$pageObject->jsSettings['tableSettings'][$strTableName]["prevKeys"] = $prev;
	$pageObject->jsSettings['tableSettings'][$strTableName]["nextKeys"] = $next; 
	
	// assign body end
	$pageObject->body['end'] = array();
	$pageObject->body['end']["method"] = "assignBodyEnd";
	$pageObject->body['end']["object"] = &$pageObject;
	
	$xt->assign("body",$pageObject->body);
	$xt->assign("flybody",true);
}
else
{
	$xt->assign("footer",false);
	$xt->assign("header",false);
	$xt->assign("flybody",$pageObject->body);
	$xt->assign("body",true);
	$xt->assign("pdflink_block",false);
	
	$pageObject->fillSetCntrlMaps();
	
	$returnJSON['controlsMap'] = $pageObject->controlsHTMLMap;
	$returnJSON['viewControlsMap'] = $pageObject->viewControlsHTMLMap;
	$returnJSON['settings'] = $pageObject->jsSettings;
}
$xt->assign("style_block",true);
$xt->assign("stylefiles_block",true);

$editlink="";
$editkeys=array();
	$editkeys["editid1"]=postvalue("editid1");
foreach($editkeys as $key=>$val)
{
	if($editlink)
		$editlink.="&";
	$editlink.=$key."=".$val;
}
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='t_people_edit.php?".$editlink."'\"");

$strPerm = GetUserPermissions($strTableName);
if(CheckSecurity($ownerIdValue,"Edit") && !$inlineview && strpos($strPerm, "E")!==false)
	$xt->assign("edit_button",true);
else
	$xt->assign("edit_button",false);

if(!$pdf && !$all && !$inlineview)
{
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//Begin show Next Prev button
	$nextlink=$prevlink="";
	if(count($next))
	{
		$xt->assign("next_button",true);
	 		$nextlink .="editid1=".htmlspecialchars(rawurlencode($next[1-1]));
		$xt->assign("nextbutton_attrs","id=\"nextButton".$id."\"");
	}
	else 
		$xt->assign("next_button",false);
	if(count($prev))
	{
		$xt->assign("prev_button",true);
			$prevlink .="editid1=".htmlspecialchars(rawurlencode($prev[1-1]));
		$xt->assign("prevbutton_attrs","id=\"prevButton".$id."\"");
	}
	else 
		$xt->assign("prev_button",false);
//End show Next Prev button
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$xt->assign("back_button",true);
	$xt->assign("backbutton_attrs","id=\"backButton".$id."\"");
}

$oldtemplatefile = $pageObject->templatefile;

if(!$all)
{
	if($eventObj->exists("BeforeShowView"))
	{
		$templatefile = $pageObject->templatefile;
		$eventObj->BeforeShowView($xt,$templatefile,$data, $pageObject);
		$pageObject->templatefile = $templatefile;
	}
	if(!$pdf)
	{
		if(!$inlineview)
			$xt->display($pageObject->templatefile);
		else{
				$xt->load_template($pageObject->templatefile);
				$returnJSON['html'] = $xt->fetch_loaded('style_block').$xt->fetch_loaded('body');
				if(count($pageObject->includes_css))
					$returnJSON['CSSFiles'] = array_unique($pageObject->includes_css);
				if(count($pageObject->includes_cssIE))
					$returnJSON['CSSFilesIE'] = array_unique($pageObject->includes_cssIE);				
				$returnJSON['idStartFrom'] = $id+1;
				$returnJSON["additionalJS"] = $pageObject->grabAllJsFiles();
				echo (my_json_encode($returnJSON)); 
			}
	}
	break;
}
}


?>
