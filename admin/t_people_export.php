<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

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

$layout = new TLayout("export","BoldAqua","MobileAqua");
$layout->blocks["top"] = array();
$layout->containers["export"] = array();

$layout->containers["export"][] = array("name"=>"exportheader","block"=>"","substyle"=>2);


$layout->containers["export"][] = array("name"=>"exprange_header","block"=>"rangeheader_block","substyle"=>3);


$layout->containers["export"][] = array("name"=>"exprange","block"=>"range_block","substyle"=>1);


$layout->containers["export"][] = array("name"=>"expoutput_header","block"=>"","substyle"=>3);


$layout->containers["export"][] = array("name"=>"expoutput","block"=>"","substyle"=>1);


$layout->containers["export"][] = array("name"=>"expbuttons","block"=>"","substyle"=>2);


$layout->skins["export"] = "fields";
$layout->blocks["top"][] = "export";$page_layouts["t_people_export"] = $layout;


// Modify query: remove blob fields from fieldlist.
// Blob fields on an export page are shown using imager.php (for example).
// They don't need to be selected from DB in export.php itself.
//$gQuery->ReplaceFieldsWithDummies(GetBinaryFieldsIndices());

$cipherer = new RunnerCipherer($strTableName);

$strWhereClause = "";
$strHavingClause = "";
$strSearchCriteria = "and";
$selected_recs = array();
$options = "1";

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
include('include/xtempl.php');
include('classes/runnerpage.php');
$xt = new Xtempl();
$id = postvalue("id") != "" ? postvalue("id") : 1;

$phpVersion = (int)substr(phpversion(), 0, 1); 
if($phpVersion > 4)
{
	include("include/export_functions.php");
	$xt->assign("groupExcel", true);
}
else
	$xt->assign("excel", true);

//array of params for classes
$params = array("pageType" => PAGE_EXPORT, "id" => $id, "tName" => $strTableName);
$params["xt"] = &$xt;
if(!$eventObj->exists("ListGetRowCount") && !$eventObj->exists("ListQuery"))
	$params["needSearchClauseObj"] = false;
$pageObject = new RunnerPage($params);

//	Before Process event
if($eventObj->exists("BeforeProcessExport"))
	$eventObj->BeforeProcessExport($conn, $pageObject);

if (@$_REQUEST["a"]!="")
{
	$options = "";
	$sWhere = "1=0";	

//	process selection
	$selected_recs = array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["people_id"] = refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
			$selected_recs[] = $keys;
		}
	}
	elseif(@$_REQUEST["selection"])
	{
		foreach(@$_REQUEST["selection"] as $keyblock)
		{
			$arr=explode("&",refine($keyblock));
			if(count($arr)<1)
				continue;
			$keys = array();
			$keys["people_id"] = urldecode($arr[0]);
			$selected_recs[] = $keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}


	$strSQL = $gQuery->gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
	$_SESSION[$strTableName."_SelectedRecords"] = $selected_recs;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause = @$_SESSION[$strTableName."_SelectedWhere"];
	$selected_recs = $_SESSION[$strTableName."_SelectedRecords"];
}
else
{
	$strWhereClause = @$_SESSION[$strTableName."_where"];
	$strHavingClause = @$_SESSION[$strTableName."_having"];
	$strSearchCriteria = @$_SESSION[$strTableName."_criteria"];
	$strSQL = $gQuery->gSQLWhere($strWhereClause, $strHavingClause, $strSearchCriteria);
}

$mypage = 1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy = $_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy = $gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if($eventObj->exists("BeforeQueryExport"))
		$eventObj->BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy, $pageObject);
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
				$masterKeysReq[] = $_SESSION[$strTableName."_masterkey".($i + 1)];
			$rowcount = $eventObj->ListGetRowCount($pageObject->searchClauseObj,$_SESSION[$strTableName."_mastertable"],$masterKeysReq,$selected_recs, $pageObject);
		}
		if($rowcount !== false)
			$numrows = $rowcount;
		else
			$numrows = $gQuery->gSQLRowCount($strWhereClause,$strHavingClause,$strSearchCriteria);
	}
	LogInfo($strSQL);

//	 Pagination:

	$nPageSize = 0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage = (integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize = (integer)@$_SESSION[$strTableName."_pagesize"];
		
		if(!$nPageSize)
			$nPageSize = $gSettings->getInitialPageSize();
				
		if($nPageSize<0)
			$nPageSize = 0;
			
		if($nPageSize>0)
		{
			if($numrows<=($mypage-1)*$nPageSize)
				$mypage = ceil($numrows/$nPageSize);
		
			if(!$mypage)
				$mypage = 1;
			
					$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
		}
	}
	$listarray = false;
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
		$listarray = $eventObj->ListQuery($pageObject->searchClauseObj, $arrFieldForSort, $arrHowFieldSort,
			$_SESSION[$strTableName."_mastertable"], $masterKeysReq, $selected_recs, $nPageSize, $mypage, $pageObject);
	}
	if($listarray!==false)
		$rs = $listarray;
	elseif($nPageSize>0)
	{
					$rs = db_query($strSQL,$conn);
	}
	else
		$rs = db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(substr(@$_REQUEST["type"],0,5)=="excel")
	{
//	remove grouping
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SMONGROUPING"]="0";
				if($phpVersion > 4)
			ExportToExcel($cipherer, $pageObject);
		else
			ExportToExcel_old($cipherer);
	}
	else if(@$_REQUEST["type"]=="word")
	{
		ExportToWord($cipherer);
	}
	else if(@$_REQUEST["type"]=="xml")
	{
		ExportToXML($cipherer);
	}
	else if(@$_REQUEST["type"]=="csv")
	{
		$locale_info["LOCALE_SGROUPING"]="0";
		$locale_info["LOCALE_SDECIMAL"]=".";
		$locale_info["LOCALE_SMONGROUPING"]="0";
		$locale_info["LOCALE_SMONDECIMALSEP"]=".";
		ExportToCSV($cipherer);
	}
	db_close($conn);
	return;
}

// add button events if exist
$pageObject->addButtonHandlers();

if($options)
{
	$xt->assign("rangeheader_block",true);
	$xt->assign("range_block",true);
}

$xt->assign("exportlink_attrs", 'id="saveButton'.$pageObject->id.'"');

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

$pageObject->body["end"] .= "<script>".$pageObject->PrepareJS()."</script>";
$xt->assignbyref("body",$pageObject->body);

$xt->display("t_people_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=t_people.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData($cipherer);

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=t_people.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData($cipherer);

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML($cipherer)
{
	global $nPageSize,$rs,$strTableName,$conn,$eventObj, $pageObject;
	header("Content-Type: text/xml");
	header("Content-Disposition: attachment;Filename=t_people.xml");
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);	
	//if(!$row)
	//	return;
		
	global $cCharset;
	
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i = 0;
	$pageObject->viewControls->forExport = "xml";
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		$values = array();
			$values["people_id"] = $pageObject->showDBValue("people_id", $row);
			$values["institution"] = $pageObject->showDBValue("institution", $row);
			$values["prof_provider"] = $pageObject->showDBValue("prof_provider", $row);
			$values["firstname"] = $pageObject->showDBValue("firstname", $row);
			$values["lastname"] = $pageObject->showDBValue("lastname", $row);
			$values["image_path"] = $pageObject->showDBValue("image_path", $row);
			$values["street"] = $pageObject->showDBValue("street", $row);
			$values["house_nr"] = $pageObject->showDBValue("house_nr", $row);
			$values["zip"] = $pageObject->showDBValue("zip", $row);
			$values["location"] = $pageObject->showDBValue("location", $row);
			$values["locationarea"] = $pageObject->showDBValue("locationarea", $row);
			$values["tel_p"] = $pageObject->showDBValue("tel_p", $row);
			$values["tel_m"] = $pageObject->showDBValue("tel_m", $row);
			$values["email"] = $pageObject->showDBValue("email", $row);
			$values["username"] = $pageObject->showDBValue("username", $row);
			$values["password"] = $pageObject->showDBValue("password", $row);
			$values["picture"] = $pageObject->showDBValue("picture", $row);
			$values["picture_2"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["gender"] = $pageObject->showDBValue("gender", $row);
			$values["birthdate"] = $pageObject->showDBValue("birthdate", $row);
			$values["enabled"] = $pageObject->showDBValue("enabled", $row);
			$values["temp_sched_from"] = $pageObject->showDBValue("temp_sched_from", $row);
			$values["temp_sched_to"] = $pageObject->showDBValue("temp_sched_to", $row);
			$values["joiningdate"] = $pageObject->showDBValue("joiningdate", $row);
			$values["coord_accuracy"] = $pageObject->showDBValue("coord_accuracy", $row);
			$values["monday"] = $pageObject->showDBValue("monday", $row);
			$values["tuesday"] = $pageObject->showDBValue("tuesday", $row);
			$values["wednesday"] = $pageObject->showDBValue("wednesday", $row);
			$values["thursday"] = $pageObject->showDBValue("thursday", $row);
			$values["friday"] = $pageObject->showDBValue("friday", $row);
			$values["saturday"] = $pageObject->showDBValue("saturday", $row);
			$values["sunday"] = $pageObject->showDBValue("sunday", $row);
			$values["monday_t"] = $pageObject->showDBValue("monday_t", $row);
			$values["tuesday_t"] = $pageObject->showDBValue("tuesday_t", $row);
			$values["wednesday_t"] = $pageObject->showDBValue("wednesday_t", $row);
			$values["thursday_t"] = $pageObject->showDBValue("thursday_t", $row);
			$values["friday_t"] = $pageObject->showDBValue("friday_t", $row);
			$values["saturday_t"] = $pageObject->showDBValue("saturday_t", $row);
			$values["sunday_t"] = $pageObject->showDBValue("sunday_t", $row);
			$values["preferred_contact_by"] = $pageObject->showDBValue("preferred_contact_by", $row);
			$values["date_last_adress_change"] = $pageObject->showDBValue("date_last_adress_change", $row);
			$values["map_in"] = $pageObject->showDBValue("map_in", $row);
			$values["IconPath"] = $pageObject->showDBValue("IconPath", $row);
			$values["Icon"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["note"] = $pageObject->showDBValue("note", $row);
			$values["price_per_hour"] = $pageObject->showDBValue("price_per_hour", $row);
			$values["psych_time_loose_tight"] = $pageObject->showDBValue("psych_time_loose_tight", $row);
			$values["psych_exact_creativ"] = $pageObject->showDBValue("psych_exact_creativ", $row);
			$values["psych_heart_thing"] = $pageObject->showDBValue("psych_heart_thing", $row);
			$values["psych_easy_security"] = $pageObject->showDBValue("psych_easy_security", $row);
			$values["psych_conflict_take_leave"] = $pageObject->showDBValue("psych_conflict_take_leave", $row);
			$values["longitude"] = $pageObject->showDBValue("longitude", $row);
			$values["latitude"] = $pageObject->showDBValue("latitude", $row);
			$values["Agree"] = $pageObject->showDBValue("Agree", $row);
			$values["Sign_date"] = $pageObject->showDBValue("Sign_date", $row);
			$values["Active"] = $pageObject->showDBValue("Active", $row);
			$values["Acode"] = $pageObject->showDBValue("Acode", $row);
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		
		if ($eventRes)
		{
			$i++;
			echo "<row>\r\n";
			foreach ($values as $fName => $val)
			{
				$field = htmlspecialchars(XMLNameEncode($fName));
				echo "<".$field.">";
				echo $values[$fName];
				echo "</".$field.">\r\n";
			}
			echo "</row>\r\n";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	echo "</table>\r\n";
}

function ExportToCSV($cipherer)
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj, $pageObject;
	header("Content-Type: application/csv");
	header("Content-Disposition: attachment;Filename=t_people.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"people_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"institution\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"prof_provider\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"firstname\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"lastname\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"image_path\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"street\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"house_nr\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"zip\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"location\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"locationarea\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tel_p\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tel_m\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"email\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"username\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"password\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"picture\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"picture_2\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"gender\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"birthdate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"enabled\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"temp_sched_from\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"temp_sched_to\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"joiningdate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"coord_accuracy\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"monday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tuesday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"wednesday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"thursday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"friday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"saturday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"sunday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"monday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tuesday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"wednesday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"thursday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"friday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"saturday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"sunday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"preferred_contact_by\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"date_last_adress_change\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"map_in\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"IconPath\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Icon\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"note\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"price_per_hour\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_time_loose_tight\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_exact_creativ\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_heart_thing\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_easy_security\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_conflict_take_leave\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"longitude\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"latitude\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Agree\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Sign_date\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Active\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Acode\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["people_id"] = $pageObject->getViewControl("people_id")->showDBValue($row, "");
			$values["institution"] = $pageObject->getViewControl("institution")->showDBValue($row, "");
			$values["prof_provider"] = $pageObject->getViewControl("prof_provider")->showDBValue($row, "");
			$values["firstname"] = $pageObject->getViewControl("firstname")->showDBValue($row, "");
			$values["lastname"] = $pageObject->getViewControl("lastname")->showDBValue($row, "");
			$values["image_path"] = $pageObject->getViewControl("image_path")->showDBValue($row, "");
			$values["street"] = $pageObject->getViewControl("street")->showDBValue($row, "");
			$values["house_nr"] = $pageObject->getViewControl("house_nr")->showDBValue($row, "");
			$values["zip"] = $pageObject->getViewControl("zip")->showDBValue($row, "");
			$values["location"] = $pageObject->getViewControl("location")->showDBValue($row, "");
			$values["locationarea"] = $pageObject->getViewControl("locationarea")->showDBValue($row, "");
			$values["tel_p"] = $pageObject->getViewControl("tel_p")->showDBValue($row, "");
			$values["tel_m"] = $pageObject->getViewControl("tel_m")->showDBValue($row, "");
			$values["email"] = $pageObject->getViewControl("email")->showDBValue($row, "");
			$values["username"] = $pageObject->getViewControl("username")->showDBValue($row, "");
			$values["password"] = $pageObject->getViewControl("password")->showDBValue($row, "");
			$values["picture"] = $pageObject->getViewControl("picture")->showDBValue($row, "");
		$values["picture_2"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["gender"] = $pageObject->getViewControl("gender")->showDBValue($row, "");
			$values["birthdate"] = $pageObject->getViewControl("birthdate")->showDBValue($row, "");
			$values["enabled"] = $pageObject->getViewControl("enabled")->showDBValue($row, "");
			$values["temp_sched_from"] = $pageObject->getViewControl("temp_sched_from")->showDBValue($row, "");
			$values["temp_sched_to"] = $pageObject->getViewControl("temp_sched_to")->showDBValue($row, "");
			$values["joiningdate"] = $pageObject->getViewControl("joiningdate")->showDBValue($row, "");
			$values["coord_accuracy"] = $pageObject->getViewControl("coord_accuracy")->showDBValue($row, "");
			$values["monday"] = $pageObject->getViewControl("monday")->showDBValue($row, "");
			$values["tuesday"] = $pageObject->getViewControl("tuesday")->showDBValue($row, "");
			$values["wednesday"] = $pageObject->getViewControl("wednesday")->showDBValue($row, "");
			$values["thursday"] = $pageObject->getViewControl("thursday")->showDBValue($row, "");
			$values["friday"] = $pageObject->getViewControl("friday")->showDBValue($row, "");
			$values["saturday"] = $pageObject->getViewControl("saturday")->showDBValue($row, "");
			$values["sunday"] = $pageObject->getViewControl("sunday")->showDBValue($row, "");
			$values["monday_t"] = $pageObject->getViewControl("monday_t")->showDBValue($row, "");
			$values["tuesday_t"] = $pageObject->getViewControl("tuesday_t")->showDBValue($row, "");
			$values["wednesday_t"] = $pageObject->getViewControl("wednesday_t")->showDBValue($row, "");
			$values["thursday_t"] = $pageObject->getViewControl("thursday_t")->showDBValue($row, "");
			$values["friday_t"] = $pageObject->getViewControl("friday_t")->showDBValue($row, "");
			$values["saturday_t"] = $pageObject->getViewControl("saturday_t")->showDBValue($row, "");
			$values["sunday_t"] = $pageObject->getViewControl("sunday_t")->showDBValue($row, "");
			$values["preferred_contact_by"] = $pageObject->getViewControl("preferred_contact_by")->showDBValue($row, "");
			$values["date_last_adress_change"] = $pageObject->getViewControl("date_last_adress_change")->showDBValue($row, "");
			$values["map_in"] = $pageObject->getViewControl("map_in")->showDBValue($row, "");
			$values["IconPath"] = $pageObject->getViewControl("IconPath")->showDBValue($row, "");
		$values["Icon"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
			$values["note"] = $pageObject->getViewControl("note")->showDBValue($row, "");
			$values["price_per_hour"] = $row["price_per_hour"];
			$values["psych_time_loose_tight"] = $pageObject->getViewControl("psych_time_loose_tight")->showDBValue($row, "");
			$values["psych_exact_creativ"] = $pageObject->getViewControl("psych_exact_creativ")->showDBValue($row, "");
			$values["psych_heart_thing"] = $pageObject->getViewControl("psych_heart_thing")->showDBValue($row, "");
			$values["psych_easy_security"] = $pageObject->getViewControl("psych_easy_security")->showDBValue($row, "");
			$values["psych_conflict_take_leave"] = $pageObject->getViewControl("psych_conflict_take_leave")->showDBValue($row, "");
			$values["longitude"] = $row["longitude"];
			$values["latitude"] = $row["latitude"];
			$values["Agree"] = $pageObject->getViewControl("Agree")->showDBValue($row, "");
			$values["Sign_date"] = $pageObject->getViewControl("Sign_date")->showDBValue($row, "");
			$values["Active"] = $pageObject->getViewControl("Active")->showDBValue($row, "");
			$values["Acode"] = $pageObject->getViewControl("Acode")->showDBValue($row, "");

		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row,$values, $pageObject);
		}
		if ($eventRes)
		{
			$outstr="";
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["people_id"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["institution"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["prof_provider"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["firstname"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["lastname"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["image_path"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["street"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["house_nr"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["zip"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["location"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["locationarea"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tel_p"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tel_m"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["email"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["username"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["password"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["picture"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["picture_2"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["gender"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["birthdate"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["enabled"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["temp_sched_from"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["temp_sched_to"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["joiningdate"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["coord_accuracy"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["monday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tuesday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["wednesday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["thursday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["friday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["saturday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["sunday"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["monday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["tuesday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["wednesday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["thursday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["friday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["saturday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["sunday_t"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["preferred_contact_by"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["date_last_adress_change"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["map_in"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["IconPath"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Icon"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["note"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["price_per_hour"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["psych_time_loose_tight"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["psych_exact_creativ"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["psych_heart_thing"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["psych_easy_security"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["psych_conflict_take_leave"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["longitude"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["latitude"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Agree"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Sign_date"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Active"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["Acode"]).'"';
			echo $outstr;
		}
		
		$iNumberOfRows++;
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
			
		if(((!$nPageSize || $iNumberOfRows<$nPageSize) && $row) && $eventRes)
			echo "\r\n";
	}
}

function WriteTableData($cipherer)
{
	global $rs,$nPageSize,$strTableName,$conn,$eventObj, $pageObject;
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);
//	if(!$row)
//		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("People Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Institution").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Prof Provider").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Firstname").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Lastname").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Image Path").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Street").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("House Nr").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Zip").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Location").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Locationarea").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tel P").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tel M").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Email").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Username").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Password").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Picture").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Picture 2").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Gender").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Birthdate").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Enabled").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Temp Sched From").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Temp Sched To").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Joiningdate").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Coord Accuracy").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Monday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tuesday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Wednesday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Thursday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Friday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Saturday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Sunday").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Monday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Tuesday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Wednesday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Thursday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Friday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Saturday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Sunday T").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Preferred Contact By").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Date Last Adress Change").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Map In").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Icon Path").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Icon").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Note").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Price Per Hour").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Psych Time Loose Tight").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Psych Exact Creativ").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Psych Heart Thing").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Psych Easy Security").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Psych Conflict Take Leave").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Longitude").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Latitude").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Agree").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Sign Date").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Active").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Acode").'</td>';	
	}
	else
	{
		echo "<td>"."People Id"."</td>";
		echo "<td>"."Institution"."</td>";
		echo "<td>"."Prof Provider"."</td>";
		echo "<td>"."Firstname"."</td>";
		echo "<td>"."Lastname"."</td>";
		echo "<td>"."Image Path"."</td>";
		echo "<td>"."Street"."</td>";
		echo "<td>"."House Nr"."</td>";
		echo "<td>"."Zip"."</td>";
		echo "<td>"."Location"."</td>";
		echo "<td>"."Locationarea"."</td>";
		echo "<td>"."Tel P"."</td>";
		echo "<td>"."Tel M"."</td>";
		echo "<td>"."Email"."</td>";
		echo "<td>"."Username"."</td>";
		echo "<td>"."Password"."</td>";
		echo "<td>"."Picture"."</td>";
		echo "<td>"."Picture 2"."</td>";
		echo "<td>"."Gender"."</td>";
		echo "<td>"."Birthdate"."</td>";
		echo "<td>"."Enabled"."</td>";
		echo "<td>"."Temp Sched From"."</td>";
		echo "<td>"."Temp Sched To"."</td>";
		echo "<td>"."Joiningdate"."</td>";
		echo "<td>"."Coord Accuracy"."</td>";
		echo "<td>"."Monday"."</td>";
		echo "<td>"."Tuesday"."</td>";
		echo "<td>"."Wednesday"."</td>";
		echo "<td>"."Thursday"."</td>";
		echo "<td>"."Friday"."</td>";
		echo "<td>"."Saturday"."</td>";
		echo "<td>"."Sunday"."</td>";
		echo "<td>"."Monday T"."</td>";
		echo "<td>"."Tuesday T"."</td>";
		echo "<td>"."Wednesday T"."</td>";
		echo "<td>"."Thursday T"."</td>";
		echo "<td>"."Friday T"."</td>";
		echo "<td>"."Saturday T"."</td>";
		echo "<td>"."Sunday T"."</td>";
		echo "<td>"."Preferred Contact By"."</td>";
		echo "<td>"."Date Last Adress Change"."</td>";
		echo "<td>"."Map In"."</td>";
		echo "<td>"."Icon Path"."</td>";
		echo "<td>"."Icon"."</td>";
		echo "<td>"."Note"."</td>";
		echo "<td>"."Price Per Hour"."</td>";
		echo "<td>"."Psych Time Loose Tight"."</td>";
		echo "<td>"."Psych Exact Creativ"."</td>";
		echo "<td>"."Psych Heart Thing"."</td>";
		echo "<td>"."Psych Easy Security"."</td>";
		echo "<td>"."Psych Conflict Take Leave"."</td>";
		echo "<td>"."Longitude"."</td>";
		echo "<td>"."Latitude"."</td>";
		echo "<td>"."Agree"."</td>";
		echo "<td>"."Sign Date"."</td>";
		echo "<td>"."Active"."</td>";
		echo "<td>"."Acode"."</td>";
	}
	echo "</tr>";
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["people_id"] = $pageObject->getViewControl("people_id")->showDBValue($row, "");
					$values["institution"] = $pageObject->getViewControl("institution")->showDBValue($row, "");
					$values["prof_provider"] = $pageObject->getViewControl("prof_provider")->showDBValue($row, "");
					$values["firstname"] = $pageObject->getViewControl("firstname")->showDBValue($row, "");
					$values["lastname"] = $pageObject->getViewControl("lastname")->showDBValue($row, "");
					$values["image_path"] = $pageObject->getViewControl("image_path")->showDBValue($row, "");
					$values["street"] = $pageObject->getViewControl("street")->showDBValue($row, "");
					$values["house_nr"] = $pageObject->getViewControl("house_nr")->showDBValue($row, "");
					$values["zip"] = $pageObject->getViewControl("zip")->showDBValue($row, "");
					$values["location"] = $pageObject->getViewControl("location")->showDBValue($row, "");
					$values["locationarea"] = $pageObject->getViewControl("locationarea")->showDBValue($row, "");
					$values["tel_p"] = $pageObject->getViewControl("tel_p")->showDBValue($row, "");
					$values["tel_m"] = $pageObject->getViewControl("tel_m")->showDBValue($row, "");
					$values["email"] = $pageObject->getViewControl("email")->showDBValue($row, "");
					$values["username"] = $pageObject->getViewControl("username")->showDBValue($row, "");
					$values["password"] = $pageObject->getViewControl("password")->showDBValue($row, "");
					$values["picture"] = $pageObject->getViewControl("picture")->showDBValue($row, "");
					$values["picture_2"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
					$values["gender"] = $pageObject->getViewControl("gender")->showDBValue($row, "");
					$values["birthdate"] = $pageObject->getViewControl("birthdate")->showDBValue($row, "");
					$values["enabled"] = $pageObject->getViewControl("enabled")->showDBValue($row, "");
					$values["temp_sched_from"] = $pageObject->getViewControl("temp_sched_from")->showDBValue($row, "");
					$values["temp_sched_to"] = $pageObject->getViewControl("temp_sched_to")->showDBValue($row, "");
					$values["joiningdate"] = $pageObject->getViewControl("joiningdate")->showDBValue($row, "");
					$values["coord_accuracy"] = $pageObject->getViewControl("coord_accuracy")->showDBValue($row, "");
					$values["monday"] = $pageObject->getViewControl("monday")->showDBValue($row, "");
					$values["tuesday"] = $pageObject->getViewControl("tuesday")->showDBValue($row, "");
					$values["wednesday"] = $pageObject->getViewControl("wednesday")->showDBValue($row, "");
					$values["thursday"] = $pageObject->getViewControl("thursday")->showDBValue($row, "");
					$values["friday"] = $pageObject->getViewControl("friday")->showDBValue($row, "");
					$values["saturday"] = $pageObject->getViewControl("saturday")->showDBValue($row, "");
					$values["sunday"] = $pageObject->getViewControl("sunday")->showDBValue($row, "");
					$values["monday_t"] = $pageObject->getViewControl("monday_t")->showDBValue($row, "");
					$values["tuesday_t"] = $pageObject->getViewControl("tuesday_t")->showDBValue($row, "");
					$values["wednesday_t"] = $pageObject->getViewControl("wednesday_t")->showDBValue($row, "");
					$values["thursday_t"] = $pageObject->getViewControl("thursday_t")->showDBValue($row, "");
					$values["friday_t"] = $pageObject->getViewControl("friday_t")->showDBValue($row, "");
					$values["saturday_t"] = $pageObject->getViewControl("saturday_t")->showDBValue($row, "");
					$values["sunday_t"] = $pageObject->getViewControl("sunday_t")->showDBValue($row, "");
					$values["preferred_contact_by"] = $pageObject->getViewControl("preferred_contact_by")->showDBValue($row, "");
					$values["date_last_adress_change"] = $pageObject->getViewControl("date_last_adress_change")->showDBValue($row, "");
					$values["map_in"] = $pageObject->getViewControl("map_in")->showDBValue($row, "");
					$values["IconPath"] = $pageObject->getViewControl("IconPath")->showDBValue($row, "");
					$values["Icon"] = "LONG BINARY DATA - CANNOT BE DISPLAYED";
					$values["note"] = $pageObject->getViewControl("note")->showDBValue($row, "");
					$values["price_per_hour"] = $pageObject->getViewControl("price_per_hour")->showDBValue($row, "");
					$values["psych_time_loose_tight"] = $pageObject->getViewControl("psych_time_loose_tight")->showDBValue($row, "");
					$values["psych_exact_creativ"] = $pageObject->getViewControl("psych_exact_creativ")->showDBValue($row, "");
					$values["psych_heart_thing"] = $pageObject->getViewControl("psych_heart_thing")->showDBValue($row, "");
					$values["psych_easy_security"] = $pageObject->getViewControl("psych_easy_security")->showDBValue($row, "");
					$values["psych_conflict_take_leave"] = $pageObject->getViewControl("psych_conflict_take_leave")->showDBValue($row, "");
					$values["longitude"] = $pageObject->getViewControl("longitude")->showDBValue($row, "");
					$values["latitude"] = $pageObject->getViewControl("latitude")->showDBValue($row, "");
					$values["Agree"] = $pageObject->getViewControl("Agree")->showDBValue($row, "");
					$values["Sign_date"] = $pageObject->getViewControl("Sign_date")->showDBValue($row, "");
					$values["Active"] = $pageObject->getViewControl("Active")->showDBValue($row, "");
					$values["Acode"] = $pageObject->getViewControl("Acode")->showDBValue($row, "");
		
		$eventRes = true;
		if ($eventObj->exists('BeforeOut'))
		{
			$eventRes = $eventObj->BeforeOut($row, $values, $pageObject);
		}
		if ($eventRes)
		{
			$iNumberOfRows++;
			echo "<tr>";
		
							echo '<td>';
			
									echo $values["people_id"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["institution"]);
					else
						echo $values["institution"];
			echo '</td>';
							echo '<td>';
			
									echo $values["prof_provider"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["firstname"]);
					else
						echo $values["firstname"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["lastname"]);
					else
						echo $values["lastname"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["image_path"]);
					else
						echo $values["image_path"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["street"]);
					else
						echo $values["street"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["house_nr"]);
					else
						echo $values["house_nr"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["zip"]);
					else
						echo $values["zip"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["location"]);
					else
						echo $values["location"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["locationarea"]);
					else
						echo $values["locationarea"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tel_p"]);
					else
						echo $values["tel_p"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tel_m"]);
					else
						echo $values["tel_m"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["email"]);
					else
						echo $values["email"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["username"]);
					else
						echo $values["username"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["password"]);
					else
						echo $values["password"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["picture"]);
					else
						echo $values["picture"];
			echo '</td>';
							echo '<td>';
			
				echo $values["picture_2"];
			echo '</td>';
							echo '<td>';
			
									echo $values["gender"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["birthdate"]);
					else
						echo $values["birthdate"];
			echo '</td>';
							echo '<td>';
			
									echo $values["enabled"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["temp_sched_from"]);
					else
						echo $values["temp_sched_from"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["temp_sched_to"]);
					else
						echo $values["temp_sched_to"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["joiningdate"]);
					else
						echo $values["joiningdate"];
			echo '</td>';
							echo '<td>';
			
									echo $values["coord_accuracy"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["monday"]);
					else
						echo $values["monday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tuesday"]);
					else
						echo $values["tuesday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["wednesday"]);
					else
						echo $values["wednesday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["thursday"]);
					else
						echo $values["thursday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["friday"]);
					else
						echo $values["friday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["saturday"]);
					else
						echo $values["saturday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["sunday"]);
					else
						echo $values["sunday"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["monday_t"]);
					else
						echo $values["monday_t"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["tuesday_t"]);
					else
						echo $values["tuesday_t"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["wednesday_t"]);
					else
						echo $values["wednesday_t"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["thursday_t"]);
					else
						echo $values["thursday_t"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["friday_t"]);
					else
						echo $values["friday_t"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["saturday_t"]);
					else
						echo $values["saturday_t"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["sunday_t"]);
					else
						echo $values["sunday_t"];
			echo '</td>';
							echo '<td>';
			
									echo $values["preferred_contact_by"];
			echo '</td>';
							echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["date_last_adress_change"]);
					else
						echo $values["date_last_adress_change"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["map_in"]);
					else
						echo $values["map_in"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["IconPath"]);
					else
						echo $values["IconPath"];
			echo '</td>';
							echo '<td>';
			
				echo $values["Icon"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["note"]);
					else
						echo $values["note"];
			echo '</td>';
							echo '<td>';
			
									echo $values["price_per_hour"];
			echo '</td>';
							echo '<td>';
			
									echo $values["psych_time_loose_tight"];
			echo '</td>';
							echo '<td>';
			
									echo $values["psych_exact_creativ"];
			echo '</td>';
							echo '<td>';
			
									echo $values["psych_heart_thing"];
			echo '</td>';
							echo '<td>';
			
									echo $values["psych_easy_security"];
			echo '</td>';
							echo '<td>';
			
									echo $values["psych_conflict_take_leave"];
			echo '</td>';
							echo '<td>';
			
									echo $values["longitude"];
			echo '</td>';
							echo '<td>';
			
									echo $values["latitude"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Agree"]);
					else
						echo $values["Agree"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Sign_date"]);
					else
						echo $values["Sign_date"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Active"]);
					else
						echo $values["Active"];
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["Acode"]);
					else
						echo $values["Acode"];
			echo '</td>';
			echo "</tr>";
		}
		
		
		if($eventObj->exists("ListFetchArray"))
			$row = $eventObj->ListFetchArray($rs, $pageObject);
		else
			$row = $cipherer->DecryptFetchedArray($rs);
	}
	
}

function XMLNameEncode($strValue)
{
	$search = array(" ","#","'","/","\\","(",")",",","[");
	$ret = str_replace($search,"",$strValue);
	$search = array("]","+","\"","-","_","|","}","{","=");
	$ret = str_replace($search,"",$ret);
	return $ret;
}

function PrepareForExcel($ret)
{
	//$ret = htmlspecialchars($str); commented for bug #6823
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}

function countTotals(&$totals, $totalsFields, $data)
{
	for($i = 0; $i < count($totalsFields); $i ++) 
	{
		if($totalsFields[$i]['totalsType'] == 'COUNT') 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]!= "");
		else if($totalsFields[$i]['viewFormat'] == "Time") 
		{
			$time = GetTotalsForTime($data[$totalsFields[$i]['fName']]);
			$totals[$totalsFields[$i]['fName']]["value"] += $time[2]+$time[1]*60 + $time[0]*3600;
		} 
		else 
			$totals[$totalsFields[$i]['fName']]["value"] += ($data[$totalsFields[$i]['fName']]+ 0);
		
		if($totalsFields[$i]['totalsType'] == 'AVERAGE')
		{
			if(!is_null($data[$totalsFields[$i]['fName']]) && $data[$totalsFields[$i]['fName']]!=="")
				$totals[$totalsFields[$i]['fName']]['numRows']++;
		}
	}
}
?>
