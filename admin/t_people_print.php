<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

include("include/t_people_variables.php");

if(!isLogged())
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(CheckPermissionsEvent($strTableName, 'P') && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Export"))
{
	echo "<p>"."You don't have permissions to access this table"."<a href=\"login.php\">"."Back to login page"."</a></p>";
	return;
}

$layout = new TLayout("print","BoldAqua","MobileAqua");
$layout->blocks["center"] = array();
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"printgrid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "empty";
$layout->blocks["center"][] = "grid";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";$page_layouts["t_people_print"] = $layout;


include('include/xtempl.php');
include('classes/runnerpage.php');

$cipherer = new RunnerCipherer($strTableName);

$xt = new Xtempl();
$id = postvalue("id") != "" ? postvalue("id") : 1;
$all = postvalue("all");
$pageName = "print.php";

//array of params for classes
$params = array("id" => $id,
				"tName" => $strTableName,
				"pageType" => PAGE_PRINT);
$params["xt"] = &$xt;
			
$pageObject = new RunnerPage($params);

// add button events if exist
$pageObject->addButtonHandlers();

// Modify query: remove blob fields from fieldlist.
// Blob fields on a print page are shown using imager.php (for example).
// They don't need to be selected from DB in print.php itself.
$noBlobReplace = false;
// picture_2
$noBlobReplace = true;
// Icon
$noBlobReplace = true;
if(!postvalue("pdf") && !$noBlobReplace)
	$gQuery->ReplaceFieldsWithDummies($pageObject->pSet->getBinaryFieldsIndices());

//	Before Process event
if($eventObj->exists("BeforeProcessPrint"))
	$eventObj->BeforeProcessPrint($conn, $pageObject);

$strWhereClause="";
$strHavingClause="";
$strSearchCriteria="and";

$selected_recs=array();
if (@$_REQUEST["a"]!="") 
{
	$sWhere = "1=0";	
	
//	process selection
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["people_id"]=refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[]=$keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys=array();
			$keys["people_id"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}
	$strSQL = $gQuery->gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strHavingClause=@$_SESSION[$strTableName."_having"];
	$strSearchCriteria=@$_SESSION[$strTableName."_criteria"];
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
}
if(postvalue("pdf"))
	$strWhereClause = @$_SESSION[$strTableName."_pdfwhere"];

$_SESSION[$strTableName."_pdfwhere"] = $strWhereClause;


$strOrderBy = $_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if($eventObj->exists("BeforeQueryPrint"))
	$eventObj->BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy, $pageObject);

//	Rebuild SQL if needed

if($strSQL!=$strSQLbak)
{
//	changed $strSQL - old style	
	$numrows=GetRowCount($strSQL);
}
else
{
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
	$strSQL.=" ".trim($strOrderBy);
	
	$rowcount=false;
	if($eventObj->exists("ListGetRowCount"))
	{
		$masterKeysReq=array();
		for($i = 0; $i < count($pageObject->detailKeysByM); $i ++)
			$masterKeysReq[]=$_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount=$eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs, $pageObject);
	}
	if($rowcount!==false)
		$numrows=$rowcount;
	else
	{
		$numrows = $gQuery->gSQLRowCount($strWhereClause, $strHavingClause, $strSearchCriteria);
	}
}

LogInfo($strSQL);

$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize = $pageObject->pSet->getInitialPageSize();

if($PageSize<0)
	$all = 1;	
	
$recno = 1;
$records = 0;	
$maxpages = 1;
$pageindex = 1;
$pageno=1;

// build arrays for sort (to support old code in user-defined events)
if($eventObj->exists("ListQuery"))
{
	$arrFieldForSort = array();
	$arrHowFieldSort = array();
	require_once getabspath('classes/orderclause.php');
	$fieldList = unserialize($_SESSION[$strTableName."_orderFieldsList"]);
	for($i = 0; $i < count($fieldList); $i++)
	{
		$arrFieldForSort[] = $fieldList[$i]->fieldIndex; 
		$arrHowFieldSort[] = $fieldList[$i]->orderDirection; 
	}
}

if(!$all)
{	
	if($numrows)
	{
		$maxRecords = $numrows;
		$maxpages = ceil($maxRecords/$PageSize);
					
		if($mypage > $maxpages)
			$mypage = $maxpages;
		
		if($mypage < 1) 
			$mypage = 1;
		
		$maxrecs = $PageSize;
	}
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort, 
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $PageSize, $mypage, $pageObject);
	if($listarray!==false)
		$rs = $listarray;
	else
	{
			if($numrows)
		{
			$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
		}
		$rs = db_query($strSQL,$conn);
	}
	
	//	hide colunm headers if needed
	$recordsonpage = $numrows-($mypage-1)*$PageSize;
	if($recordsonpage>$PageSize)
		$recordsonpage = $PageSize;
		
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
	$xt->assign("pageno",$mypage);
}
else
{
	$listarray = false;
	if($eventObj->exists("ListQuery"))
		$listarray=$eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort,
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $PageSize, $mypage, $pageObject);
	if($listarray!==false)
		$rs = $listarray;
	else
		$rs = db_query($strSQL,$conn);
	$recordsonpage = $numrows;
	$maxpages = ceil($recordsonpage/30);
	$xt->assign("page_number",true);
	$xt->assign("maxpages",$maxpages);
}


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
$pageObject->setGoogleMapsParams($fieldsArr);

$colsonpage=1;
if($colsonpage>$recordsonpage)
	$colsonpage=$recordsonpage;
if($colsonpage<1)
	$colsonpage=1;


//	fill $rowinfo array
	$pages = array();
	$rowinfo = array();
	$rowinfo["data"] = array();
	if($eventObj->exists("ListFetchArray"))
		$data = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$data = $cipherer->DecryptFetchedArray($rs);

	while($data)
	{
		if($eventObj->exists("BeforeProcessRowPrint"))
		{
			if(!$eventObj->BeforeProcessRowPrint($data, $pageObject))
			{
				if($eventObj->exists("ListFetchArray"))
					$data = $eventObj->ListFetchArray($rs, $pageObject);
				else
					$data = $cipherer->DecryptFetchedArray($rs);
				continue;
			}
		}
		break;
	}
	
	while($data && ($all || $recno<=$PageSize))
	{
		$row = array();
		$row["grid_record"] = array();
		$row["grid_record"]["data"] = array();
		for($col=1;$data && ($all || $recno<=$PageSize) && $col<=1;$col++)
		{
			$record = array();
			$recno++;
			$records++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["people_id"]));

//	people_id - 
			$record["people_id_value"] = $pageObject->showDBValue("people_id", $data, $keylink);
			$record["people_id_class"] = $pageObject->fieldClass("people_id");
//	institution - 
			$record["institution_value"] = $pageObject->showDBValue("institution", $data, $keylink);
			$record["institution_class"] = $pageObject->fieldClass("institution");
//	prof_provider - 
			$record["prof_provider_value"] = $pageObject->showDBValue("prof_provider", $data, $keylink);
			$record["prof_provider_class"] = $pageObject->fieldClass("prof_provider");
//	firstname - 
			$record["firstname_value"] = $pageObject->showDBValue("firstname", $data, $keylink);
			$record["firstname_class"] = $pageObject->fieldClass("firstname");
//	lastname - 
			$record["lastname_value"] = $pageObject->showDBValue("lastname", $data, $keylink);
			$record["lastname_class"] = $pageObject->fieldClass("lastname");
//	image_path - File-based Image
			$record["image_path_value"] = $pageObject->showDBValue("image_path", $data, $keylink);
			$record["image_path_class"] = $pageObject->fieldClass("image_path");
//	street - 
			$record["street_value"] = $pageObject->showDBValue("street", $data, $keylink);
			$record["street_class"] = $pageObject->fieldClass("street");
//	house_nr - 
			$record["house_nr_value"] = $pageObject->showDBValue("house_nr", $data, $keylink);
			$record["house_nr_class"] = $pageObject->fieldClass("house_nr");
//	zip - 
			$record["zip_value"] = $pageObject->showDBValue("zip", $data, $keylink);
			$record["zip_class"] = $pageObject->fieldClass("zip");
//	location - 
			$record["location_value"] = $pageObject->showDBValue("location", $data, $keylink);
			$record["location_class"] = $pageObject->fieldClass("location");
//	locationarea - 
			$record["locationarea_value"] = $pageObject->showDBValue("locationarea", $data, $keylink);
			$record["locationarea_class"] = $pageObject->fieldClass("locationarea");
//	tel_p - 
			$record["tel_p_value"] = $pageObject->showDBValue("tel_p", $data, $keylink);
			$record["tel_p_class"] = $pageObject->fieldClass("tel_p");
//	tel_m - 
			$record["tel_m_value"] = $pageObject->showDBValue("tel_m", $data, $keylink);
			$record["tel_m_class"] = $pageObject->fieldClass("tel_m");
//	email - 
			$record["email_value"] = $pageObject->showDBValue("email", $data, $keylink);
			$record["email_class"] = $pageObject->fieldClass("email");
//	username - 
			$record["username_value"] = $pageObject->showDBValue("username", $data, $keylink);
			$record["username_class"] = $pageObject->fieldClass("username");
//	password - 
			$record["password_value"] = $pageObject->showDBValue("password", $data, $keylink);
			$record["password_class"] = $pageObject->fieldClass("password");
//	picture - 
			$record["picture_value"] = $pageObject->showDBValue("picture", $data, $keylink);
			$record["picture_class"] = $pageObject->fieldClass("picture");
//	picture_2 - Database Image
			$record["picture_2_value"] = $pageObject->showDBValue("picture_2", $data, $keylink);
			$record["picture_2_class"] = $pageObject->fieldClass("picture_2");
//	gender - 
			$record["gender_value"] = $pageObject->showDBValue("gender", $data, $keylink);
			$record["gender_class"] = $pageObject->fieldClass("gender");
//	birthdate - Short Date
			$record["birthdate_value"] = $pageObject->showDBValue("birthdate", $data, $keylink);
			$record["birthdate_class"] = $pageObject->fieldClass("birthdate");
//	enabled - 
			$record["enabled_value"] = $pageObject->showDBValue("enabled", $data, $keylink);
			$record["enabled_class"] = $pageObject->fieldClass("enabled");
//	temp_sched_from - 
			$record["temp_sched_from_value"] = $pageObject->showDBValue("temp_sched_from", $data, $keylink);
			$record["temp_sched_from_class"] = $pageObject->fieldClass("temp_sched_from");
//	temp_sched_to - 
			$record["temp_sched_to_value"] = $pageObject->showDBValue("temp_sched_to", $data, $keylink);
			$record["temp_sched_to_class"] = $pageObject->fieldClass("temp_sched_to");
//	joiningdate - Short Date
			$record["joiningdate_value"] = $pageObject->showDBValue("joiningdate", $data, $keylink);
			$record["joiningdate_class"] = $pageObject->fieldClass("joiningdate");
//	coord_accuracy - 
			$record["coord_accuracy_value"] = $pageObject->showDBValue("coord_accuracy", $data, $keylink);
			$record["coord_accuracy_class"] = $pageObject->fieldClass("coord_accuracy");
//	monday - 
			$record["monday_value"] = $pageObject->showDBValue("monday", $data, $keylink);
			$record["monday_class"] = $pageObject->fieldClass("monday");
//	tuesday - 
			$record["tuesday_value"] = $pageObject->showDBValue("tuesday", $data, $keylink);
			$record["tuesday_class"] = $pageObject->fieldClass("tuesday");
//	wednesday - 
			$record["wednesday_value"] = $pageObject->showDBValue("wednesday", $data, $keylink);
			$record["wednesday_class"] = $pageObject->fieldClass("wednesday");
//	thursday - 
			$record["thursday_value"] = $pageObject->showDBValue("thursday", $data, $keylink);
			$record["thursday_class"] = $pageObject->fieldClass("thursday");
//	friday - 
			$record["friday_value"] = $pageObject->showDBValue("friday", $data, $keylink);
			$record["friday_class"] = $pageObject->fieldClass("friday");
//	saturday - 
			$record["saturday_value"] = $pageObject->showDBValue("saturday", $data, $keylink);
			$record["saturday_class"] = $pageObject->fieldClass("saturday");
//	sunday - 
			$record["sunday_value"] = $pageObject->showDBValue("sunday", $data, $keylink);
			$record["sunday_class"] = $pageObject->fieldClass("sunday");
//	monday_t - 
			$record["monday_t_value"] = $pageObject->showDBValue("monday_t", $data, $keylink);
			$record["monday_t_class"] = $pageObject->fieldClass("monday_t");
//	tuesday_t - 
			$record["tuesday_t_value"] = $pageObject->showDBValue("tuesday_t", $data, $keylink);
			$record["tuesday_t_class"] = $pageObject->fieldClass("tuesday_t");
//	wednesday_t - 
			$record["wednesday_t_value"] = $pageObject->showDBValue("wednesday_t", $data, $keylink);
			$record["wednesday_t_class"] = $pageObject->fieldClass("wednesday_t");
//	thursday_t - 
			$record["thursday_t_value"] = $pageObject->showDBValue("thursday_t", $data, $keylink);
			$record["thursday_t_class"] = $pageObject->fieldClass("thursday_t");
//	friday_t - 
			$record["friday_t_value"] = $pageObject->showDBValue("friday_t", $data, $keylink);
			$record["friday_t_class"] = $pageObject->fieldClass("friday_t");
//	saturday_t - 
			$record["saturday_t_value"] = $pageObject->showDBValue("saturday_t", $data, $keylink);
			$record["saturday_t_class"] = $pageObject->fieldClass("saturday_t");
//	sunday_t - 
			$record["sunday_t_value"] = $pageObject->showDBValue("sunday_t", $data, $keylink);
			$record["sunday_t_class"] = $pageObject->fieldClass("sunday_t");
//	preferred_contact_by - 
			$record["preferred_contact_by_value"] = $pageObject->showDBValue("preferred_contact_by", $data, $keylink);
			$record["preferred_contact_by_class"] = $pageObject->fieldClass("preferred_contact_by");
//	date_last_adress_change - Short Date
			$record["date_last_adress_change_value"] = $pageObject->showDBValue("date_last_adress_change", $data, $keylink);
			$record["date_last_adress_change_class"] = $pageObject->fieldClass("date_last_adress_change");
//	map_in - 
			$record["map_in_value"] = $pageObject->showDBValue("map_in", $data, $keylink);
			$record["map_in_class"] = $pageObject->fieldClass("map_in");
//	IconPath - 
			$record["IconPath_value"] = $pageObject->showDBValue("IconPath", $data, $keylink);
			$record["IconPath_class"] = $pageObject->fieldClass("IconPath");
//	Icon - Database Image
			$record["Icon_value"] = $pageObject->showDBValue("Icon", $data, $keylink);
			$record["Icon_class"] = $pageObject->fieldClass("Icon");
//	note - 
			$record["note_value"] = $pageObject->showDBValue("note", $data, $keylink);
			$record["note_class"] = $pageObject->fieldClass("note");
//	price_per_hour - Number
			$record["price_per_hour_value"] = $pageObject->showDBValue("price_per_hour", $data, $keylink);
			$record["price_per_hour_class"] = $pageObject->fieldClass("price_per_hour");
//	psych_time_loose_tight - 
			$record["psych_time_loose_tight_value"] = $pageObject->showDBValue("psych_time_loose_tight", $data, $keylink);
			$record["psych_time_loose_tight_class"] = $pageObject->fieldClass("psych_time_loose_tight");
//	psych_exact_creativ - 
			$record["psych_exact_creativ_value"] = $pageObject->showDBValue("psych_exact_creativ", $data, $keylink);
			$record["psych_exact_creativ_class"] = $pageObject->fieldClass("psych_exact_creativ");
//	psych_heart_thing - 
			$record["psych_heart_thing_value"] = $pageObject->showDBValue("psych_heart_thing", $data, $keylink);
			$record["psych_heart_thing_class"] = $pageObject->fieldClass("psych_heart_thing");
//	psych_easy_security - 
			$record["psych_easy_security_value"] = $pageObject->showDBValue("psych_easy_security", $data, $keylink);
			$record["psych_easy_security_class"] = $pageObject->fieldClass("psych_easy_security");
//	psych_conflict_take_leave - 
			$record["psych_conflict_take_leave_value"] = $pageObject->showDBValue("psych_conflict_take_leave", $data, $keylink);
			$record["psych_conflict_take_leave_class"] = $pageObject->fieldClass("psych_conflict_take_leave");
//	longitude - Number
			$record["longitude_value"] = $pageObject->showDBValue("longitude", $data, $keylink);
			$record["longitude_class"] = $pageObject->fieldClass("longitude");
//	latitude - Number
			$record["latitude_value"] = $pageObject->showDBValue("latitude", $data, $keylink);
			$record["latitude_class"] = $pageObject->fieldClass("latitude");
//	Agree - 
			$record["Agree_value"] = $pageObject->showDBValue("Agree", $data, $keylink);
			$record["Agree_class"] = $pageObject->fieldClass("Agree");
//	Sign_date - 
			$record["Sign_date_value"] = $pageObject->showDBValue("Sign_date", $data, $keylink);
			$record["Sign_date_class"] = $pageObject->fieldClass("Sign_date");
//	Active - 
			$record["Active_value"] = $pageObject->showDBValue("Active", $data, $keylink);
			$record["Active_class"] = $pageObject->fieldClass("Active");
//	Acode - 
			$record["Acode_value"] = $pageObject->showDBValue("Acode", $data, $keylink);
			$record["Acode_class"] = $pageObject->fieldClass("Acode");
			if($col<$colsonpage)
				$record["endrecord_block"] = true;
			$record["grid_recordheader"] = true;
			$record["grid_vrecord"] = true;
			
			if($eventObj->exists("BeforeMoveNextPrint"))
				$eventObj->BeforeMoveNextPrint($data,$row,$record, $pageObject);
				
			$row["grid_record"]["data"][] = $record;
			
			if($eventObj->exists("ListFetchArray"))
				$data = $eventObj->ListFetchArray($rs, $pageObject);
			else
				$data = $cipherer->DecryptFetchedArray($rs);
				
			while($data)
			{
				if($eventObj->exists("BeforeProcessRowPrint"))
				{
					if(!$eventObj->BeforeProcessRowPrint($data, $pageObject))
					{
						if($eventObj->exists("ListFetchArray"))
							$data = $eventObj->ListFetchArray($rs, $pageObject);
						else
							$data = $cipherer->DecryptFetchedArray($rs);
						continue;
					}
				}
				break;
			}
		}
		if($col <= $colsonpage)
		{
			$row["grid_record"]["data"][count($row["grid_record"]["data"])-1]["endrecord_block"] = false;
		}
		$row["grid_rowspace"]=true;
		$row["grid_recordspace"] = array("data"=>array());
		for($i=0;$i<$colsonpage*2-1;$i++)
			$row["grid_recordspace"]["data"][]=true;
		
		$rowinfo["data"][]=$row;
		
		if($all && $records>=30)
		{
			$page=array("grid_row" =>$rowinfo);
			$page["pageno"]=$pageindex;
			$pageindex++;
			$pages[] = $page;
			$records=0;
			$rowinfo=array();
		}
		
	}
	if(count($rowinfo))
	{
		$page=array("grid_row" =>$rowinfo);
		if($all)
			$page["pageno"]=$pageindex;
		$pages[] = $page;
	}
	
	for($i=0;$i<count($pages);$i++)
	{
	 	if($i<count($pages)-1)
			$pages[$i]["begin"]="<div name=page class=printpage>";
		else
		    $pages[$i]["begin"]="<div name=page>";
			
		$pages[$i]["end"]="</div>";
	}

	$page = array();
	$page["data"] = &$pages;
	$xt->assignbyref("page",$page);

	

$strSQL = $_SESSION[$strTableName."_sql"];

$isPdfView = false;
$hasEvents = false;
if ($pageObject->pSet->isUsebuttonHandlers() || $isPdfView || $hasEvents)
{
	$pageObject->body["begin"] .="<script type=\"text/javascript\" src=\"include/loadfirst.js\"></script>\r\n";
		$pageObject->body["begin"] .= "<script type=\"text/javascript\" src=\"include/lang/".getLangFileName(mlang_getcurrentlang()).".js\"></script>";
	
	$pageObject->fillSetCntrlMaps();
	$pageObject->body['end'] .= '<script>';
	$pageObject->body['end'] .= "window.controlsMap = ".my_json_encode($pageObject->controlsHTMLMap).";";
	$pageObject->body['end'] .= "window.viewControlsMap = ".my_json_encode($pageObject->viewControlsHTMLMap).";";
	$pageObject->body['end'] .= "window.settings = ".my_json_encode($pageObject->jsSettings).";";
	$pageObject->body['end'] .= '</script>';
		$pageObject->body["end"] .= "<script language=\"JavaScript\" src=\"include/runnerJS/RunnerAll.js\"></script>\r\n";
	$pageObject->addCommonJs();
}


if ($pageObject->pSet->isUsebuttonHandlers() || $isPdfView || $hasEvents)
	$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";

$xt->assignbyref("body",$pageObject->body);
$xt->assign("grid_block",true);

$xt->assign("people_id_fieldheadercolumn",true);
$xt->assign("people_id_fieldheader",true);
$xt->assign("people_id_fieldcolumn",true);
$xt->assign("people_id_fieldfootercolumn",true);
$xt->assign("institution_fieldheadercolumn",true);
$xt->assign("institution_fieldheader",true);
$xt->assign("institution_fieldcolumn",true);
$xt->assign("institution_fieldfootercolumn",true);
$xt->assign("prof_provider_fieldheadercolumn",true);
$xt->assign("prof_provider_fieldheader",true);
$xt->assign("prof_provider_fieldcolumn",true);
$xt->assign("prof_provider_fieldfootercolumn",true);
$xt->assign("firstname_fieldheadercolumn",true);
$xt->assign("firstname_fieldheader",true);
$xt->assign("firstname_fieldcolumn",true);
$xt->assign("firstname_fieldfootercolumn",true);
$xt->assign("lastname_fieldheadercolumn",true);
$xt->assign("lastname_fieldheader",true);
$xt->assign("lastname_fieldcolumn",true);
$xt->assign("lastname_fieldfootercolumn",true);
$xt->assign("image_path_fieldheadercolumn",true);
$xt->assign("image_path_fieldheader",true);
$xt->assign("image_path_fieldcolumn",true);
$xt->assign("image_path_fieldfootercolumn",true);
$xt->assign("street_fieldheadercolumn",true);
$xt->assign("street_fieldheader",true);
$xt->assign("street_fieldcolumn",true);
$xt->assign("street_fieldfootercolumn",true);
$xt->assign("house_nr_fieldheadercolumn",true);
$xt->assign("house_nr_fieldheader",true);
$xt->assign("house_nr_fieldcolumn",true);
$xt->assign("house_nr_fieldfootercolumn",true);
$xt->assign("zip_fieldheadercolumn",true);
$xt->assign("zip_fieldheader",true);
$xt->assign("zip_fieldcolumn",true);
$xt->assign("zip_fieldfootercolumn",true);
$xt->assign("location_fieldheadercolumn",true);
$xt->assign("location_fieldheader",true);
$xt->assign("location_fieldcolumn",true);
$xt->assign("location_fieldfootercolumn",true);
$xt->assign("locationarea_fieldheadercolumn",true);
$xt->assign("locationarea_fieldheader",true);
$xt->assign("locationarea_fieldcolumn",true);
$xt->assign("locationarea_fieldfootercolumn",true);
$xt->assign("tel_p_fieldheadercolumn",true);
$xt->assign("tel_p_fieldheader",true);
$xt->assign("tel_p_fieldcolumn",true);
$xt->assign("tel_p_fieldfootercolumn",true);
$xt->assign("tel_m_fieldheadercolumn",true);
$xt->assign("tel_m_fieldheader",true);
$xt->assign("tel_m_fieldcolumn",true);
$xt->assign("tel_m_fieldfootercolumn",true);
$xt->assign("email_fieldheadercolumn",true);
$xt->assign("email_fieldheader",true);
$xt->assign("email_fieldcolumn",true);
$xt->assign("email_fieldfootercolumn",true);
$xt->assign("username_fieldheadercolumn",true);
$xt->assign("username_fieldheader",true);
$xt->assign("username_fieldcolumn",true);
$xt->assign("username_fieldfootercolumn",true);
$xt->assign("password_fieldheadercolumn",true);
$xt->assign("password_fieldheader",true);
$xt->assign("password_fieldcolumn",true);
$xt->assign("password_fieldfootercolumn",true);
$xt->assign("picture_fieldheadercolumn",true);
$xt->assign("picture_fieldheader",true);
$xt->assign("picture_fieldcolumn",true);
$xt->assign("picture_fieldfootercolumn",true);
$xt->assign("picture_2_fieldheadercolumn",true);
$xt->assign("picture_2_fieldheader",true);
$xt->assign("picture_2_fieldcolumn",true);
$xt->assign("picture_2_fieldfootercolumn",true);
$xt->assign("gender_fieldheadercolumn",true);
$xt->assign("gender_fieldheader",true);
$xt->assign("gender_fieldcolumn",true);
$xt->assign("gender_fieldfootercolumn",true);
$xt->assign("birthdate_fieldheadercolumn",true);
$xt->assign("birthdate_fieldheader",true);
$xt->assign("birthdate_fieldcolumn",true);
$xt->assign("birthdate_fieldfootercolumn",true);
$xt->assign("enabled_fieldheadercolumn",true);
$xt->assign("enabled_fieldheader",true);
$xt->assign("enabled_fieldcolumn",true);
$xt->assign("enabled_fieldfootercolumn",true);
$xt->assign("temp_sched_from_fieldheadercolumn",true);
$xt->assign("temp_sched_from_fieldheader",true);
$xt->assign("temp_sched_from_fieldcolumn",true);
$xt->assign("temp_sched_from_fieldfootercolumn",true);
$xt->assign("temp_sched_to_fieldheadercolumn",true);
$xt->assign("temp_sched_to_fieldheader",true);
$xt->assign("temp_sched_to_fieldcolumn",true);
$xt->assign("temp_sched_to_fieldfootercolumn",true);
$xt->assign("joiningdate_fieldheadercolumn",true);
$xt->assign("joiningdate_fieldheader",true);
$xt->assign("joiningdate_fieldcolumn",true);
$xt->assign("joiningdate_fieldfootercolumn",true);
$xt->assign("coord_accuracy_fieldheadercolumn",true);
$xt->assign("coord_accuracy_fieldheader",true);
$xt->assign("coord_accuracy_fieldcolumn",true);
$xt->assign("coord_accuracy_fieldfootercolumn",true);
$xt->assign("monday_fieldheadercolumn",true);
$xt->assign("monday_fieldheader",true);
$xt->assign("monday_fieldcolumn",true);
$xt->assign("monday_fieldfootercolumn",true);
$xt->assign("tuesday_fieldheadercolumn",true);
$xt->assign("tuesday_fieldheader",true);
$xt->assign("tuesday_fieldcolumn",true);
$xt->assign("tuesday_fieldfootercolumn",true);
$xt->assign("wednesday_fieldheadercolumn",true);
$xt->assign("wednesday_fieldheader",true);
$xt->assign("wednesday_fieldcolumn",true);
$xt->assign("wednesday_fieldfootercolumn",true);
$xt->assign("thursday_fieldheadercolumn",true);
$xt->assign("thursday_fieldheader",true);
$xt->assign("thursday_fieldcolumn",true);
$xt->assign("thursday_fieldfootercolumn",true);
$xt->assign("friday_fieldheadercolumn",true);
$xt->assign("friday_fieldheader",true);
$xt->assign("friday_fieldcolumn",true);
$xt->assign("friday_fieldfootercolumn",true);
$xt->assign("saturday_fieldheadercolumn",true);
$xt->assign("saturday_fieldheader",true);
$xt->assign("saturday_fieldcolumn",true);
$xt->assign("saturday_fieldfootercolumn",true);
$xt->assign("sunday_fieldheadercolumn",true);
$xt->assign("sunday_fieldheader",true);
$xt->assign("sunday_fieldcolumn",true);
$xt->assign("sunday_fieldfootercolumn",true);
$xt->assign("monday_t_fieldheadercolumn",true);
$xt->assign("monday_t_fieldheader",true);
$xt->assign("monday_t_fieldcolumn",true);
$xt->assign("monday_t_fieldfootercolumn",true);
$xt->assign("tuesday_t_fieldheadercolumn",true);
$xt->assign("tuesday_t_fieldheader",true);
$xt->assign("tuesday_t_fieldcolumn",true);
$xt->assign("tuesday_t_fieldfootercolumn",true);
$xt->assign("wednesday_t_fieldheadercolumn",true);
$xt->assign("wednesday_t_fieldheader",true);
$xt->assign("wednesday_t_fieldcolumn",true);
$xt->assign("wednesday_t_fieldfootercolumn",true);
$xt->assign("thursday_t_fieldheadercolumn",true);
$xt->assign("thursday_t_fieldheader",true);
$xt->assign("thursday_t_fieldcolumn",true);
$xt->assign("thursday_t_fieldfootercolumn",true);
$xt->assign("friday_t_fieldheadercolumn",true);
$xt->assign("friday_t_fieldheader",true);
$xt->assign("friday_t_fieldcolumn",true);
$xt->assign("friday_t_fieldfootercolumn",true);
$xt->assign("saturday_t_fieldheadercolumn",true);
$xt->assign("saturday_t_fieldheader",true);
$xt->assign("saturday_t_fieldcolumn",true);
$xt->assign("saturday_t_fieldfootercolumn",true);
$xt->assign("sunday_t_fieldheadercolumn",true);
$xt->assign("sunday_t_fieldheader",true);
$xt->assign("sunday_t_fieldcolumn",true);
$xt->assign("sunday_t_fieldfootercolumn",true);
$xt->assign("preferred_contact_by_fieldheadercolumn",true);
$xt->assign("preferred_contact_by_fieldheader",true);
$xt->assign("preferred_contact_by_fieldcolumn",true);
$xt->assign("preferred_contact_by_fieldfootercolumn",true);
$xt->assign("date_last_adress_change_fieldheadercolumn",true);
$xt->assign("date_last_adress_change_fieldheader",true);
$xt->assign("date_last_adress_change_fieldcolumn",true);
$xt->assign("date_last_adress_change_fieldfootercolumn",true);
$xt->assign("map_in_fieldheadercolumn",true);
$xt->assign("map_in_fieldheader",true);
$xt->assign("map_in_fieldcolumn",true);
$xt->assign("map_in_fieldfootercolumn",true);
$xt->assign("IconPath_fieldheadercolumn",true);
$xt->assign("IconPath_fieldheader",true);
$xt->assign("IconPath_fieldcolumn",true);
$xt->assign("IconPath_fieldfootercolumn",true);
$xt->assign("Icon_fieldheadercolumn",true);
$xt->assign("Icon_fieldheader",true);
$xt->assign("Icon_fieldcolumn",true);
$xt->assign("Icon_fieldfootercolumn",true);
$xt->assign("note_fieldheadercolumn",true);
$xt->assign("note_fieldheader",true);
$xt->assign("note_fieldcolumn",true);
$xt->assign("note_fieldfootercolumn",true);
$xt->assign("price_per_hour_fieldheadercolumn",true);
$xt->assign("price_per_hour_fieldheader",true);
$xt->assign("price_per_hour_fieldcolumn",true);
$xt->assign("price_per_hour_fieldfootercolumn",true);
$xt->assign("psych_time_loose_tight_fieldheadercolumn",true);
$xt->assign("psych_time_loose_tight_fieldheader",true);
$xt->assign("psych_time_loose_tight_fieldcolumn",true);
$xt->assign("psych_time_loose_tight_fieldfootercolumn",true);
$xt->assign("psych_exact_creativ_fieldheadercolumn",true);
$xt->assign("psych_exact_creativ_fieldheader",true);
$xt->assign("psych_exact_creativ_fieldcolumn",true);
$xt->assign("psych_exact_creativ_fieldfootercolumn",true);
$xt->assign("psych_heart_thing_fieldheadercolumn",true);
$xt->assign("psych_heart_thing_fieldheader",true);
$xt->assign("psych_heart_thing_fieldcolumn",true);
$xt->assign("psych_heart_thing_fieldfootercolumn",true);
$xt->assign("psych_easy_security_fieldheadercolumn",true);
$xt->assign("psych_easy_security_fieldheader",true);
$xt->assign("psych_easy_security_fieldcolumn",true);
$xt->assign("psych_easy_security_fieldfootercolumn",true);
$xt->assign("psych_conflict_take_leave_fieldheadercolumn",true);
$xt->assign("psych_conflict_take_leave_fieldheader",true);
$xt->assign("psych_conflict_take_leave_fieldcolumn",true);
$xt->assign("psych_conflict_take_leave_fieldfootercolumn",true);
$xt->assign("longitude_fieldheadercolumn",true);
$xt->assign("longitude_fieldheader",true);
$xt->assign("longitude_fieldcolumn",true);
$xt->assign("longitude_fieldfootercolumn",true);
$xt->assign("latitude_fieldheadercolumn",true);
$xt->assign("latitude_fieldheader",true);
$xt->assign("latitude_fieldcolumn",true);
$xt->assign("latitude_fieldfootercolumn",true);
$xt->assign("Agree_fieldheadercolumn",true);
$xt->assign("Agree_fieldheader",true);
$xt->assign("Agree_fieldcolumn",true);
$xt->assign("Agree_fieldfootercolumn",true);
$xt->assign("Sign_date_fieldheadercolumn",true);
$xt->assign("Sign_date_fieldheader",true);
$xt->assign("Sign_date_fieldcolumn",true);
$xt->assign("Sign_date_fieldfootercolumn",true);
$xt->assign("Active_fieldheadercolumn",true);
$xt->assign("Active_fieldheader",true);
$xt->assign("Active_fieldcolumn",true);
$xt->assign("Active_fieldfootercolumn",true);
$xt->assign("Acode_fieldheadercolumn",true);
$xt->assign("Acode_fieldheader",true);
$xt->assign("Acode_fieldcolumn",true);
$xt->assign("Acode_fieldfootercolumn",true);

	$record_header=array("data"=>array());
	$record_footer=array("data"=>array());
	for($i=0;$i<$colsonpage;$i++)
	{
		$rheader=array();
		$rfooter=array();
		if($i<$colsonpage-1)
		{
			$rheader["endrecordheader_block"]=true;
			$rfooter["endrecordheader_block"]=true;
		}
		$record_header["data"][]=$rheader;
		$record_footer["data"][]=$rfooter;
	}
	$xt->assignbyref("record_header",$record_header);
	$xt->assignbyref("record_footer",$record_footer);
	$xt->assign("grid_header",true);
	$xt->assign("grid_footer",true);

if($eventObj->exists("BeforeShowPrint"))
	$eventObj->BeforeShowPrint($xt,$pageObject->templatefile, $pageObject);

if(!postvalue("pdf"))
	$xt->display($pageObject->templatefile);
else
{
	$xt->load_template($pageObject->templatefile);
	$page = $xt->fetch_loaded();
	$pagewidth=postvalue("width")*1.05;
	$pageheight=postvalue("height")*1.05;
	$landscape=false;
		if($pagewidth>$pageheight)
		{
			$landscape=true;
			if($pagewidth/$pageheight<297/210)
				$pagewidth = 297/210*$pageheight;
		}
		else
		{
			if($pagewidth/$pageheight<210/297)
				$pagewidth = 210/297*$pageheight;
		}
}
?>
