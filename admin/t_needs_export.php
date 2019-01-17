<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");
include("include/dbcommon.php");
include("classes/searchclause.php");
session_cache_limiter("none");

include("include/t_needs_variables.php");

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
$layout->blocks["top"][] = "export";$page_layouts["t_needs_export"] = $layout;


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
			$keys["need_id"] = refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
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
			$keys["need_id"] = urldecode($arr[0]);
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

$xt->display("t_needs_export.htm");

function ExportToExcel_old($cipherer)
{
	global $cCharset;
	header("Content-Type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=t_needs.xls");

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
	header("Content-Disposition: attachment;Filename=t_needs.doc");

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
	header("Content-Disposition: attachment;Filename=t_needs.xml");
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
			$values["need_id"] = $pageObject->showDBValue("need_id", $row);
			$values["people_id"] = $pageObject->showDBValue("people_id", $row);
			$values["need_type_id"] = $pageObject->showDBValue("need_type_id", $row);
			$values["need_subtype_id"] = $pageObject->showDBValue("need_subtype_id", $row);
			$values["need_note"] = $pageObject->showDBValue("need_note", $row);
			$values["need_hourly"] = $pageObject->showDBValue("need_hourly", $row);
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
	header("Content-Disposition: attachment;Filename=t_needs.csv");
	
	if($eventObj->exists("ListFetchArray"))
		$row = $eventObj->ListFetchArray($rs, $pageObject);
	else
		$row = $cipherer->DecryptFetchedArray($rs);

// write header
	$outstr = "";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"need_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"people_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"need_type_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"need_subtype_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"need_note\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"need_hourly\"";
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
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "csv";
	while((!$nPageSize || $iNumberOfRows < $nPageSize) && $row)
	{
		$values = array();
			$values["need_id"] = $pageObject->getViewControl("need_id")->showDBValue($row, "");
			$values["people_id"] = $pageObject->getViewControl("people_id")->showDBValue($row, "");
			$values["need_type_id"] = $pageObject->getViewControl("need_type_id")->showDBValue($row, "");
			$values["need_subtype_id"] = $pageObject->getViewControl("need_subtype_id")->showDBValue($row, "");
			$values["need_note"] = $pageObject->getViewControl("need_note")->showDBValue($row, "");
			$values["need_hourly"] = $pageObject->getViewControl("need_hourly")->showDBValue($row, "");
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
			$outstr.='"'.str_replace('"', '""', $values["need_id"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["people_id"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["need_type_id"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["need_subtype_id"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["need_note"]).'"';
			if($outstr!="")
				$outstr.=",";
			$outstr.='"'.str_replace('"', '""', $values["need_hourly"]).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Need Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("People Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Need Type Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Need Subtype Id").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Need Note").'</td>';	
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Need Hourly").'</td>';	
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
	}
	else
	{
		echo "<td>"."Need Id"."</td>";
		echo "<td>"."People Id"."</td>";
		echo "<td>"."Need Type Id"."</td>";
		echo "<td>"."Need Subtype Id"."</td>";
		echo "<td>"."Need Note"."</td>";
		echo "<td>"."Need Hourly"."</td>";
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
	}
	echo "</tr>";
	
// write data rows
	$iNumberOfRows = 0;
	$pageObject->viewControls->forExport = "export";
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		countTotals($totals, $totalsFields, $row);
		
		$values = array();
	
					$values["need_id"] = $pageObject->getViewControl("need_id")->showDBValue($row, "");
					$values["people_id"] = $pageObject->getViewControl("people_id")->showDBValue($row, "");
					$values["need_type_id"] = $pageObject->getViewControl("need_type_id")->showDBValue($row, "");
					$values["need_subtype_id"] = $pageObject->getViewControl("need_subtype_id")->showDBValue($row, "");
					$values["need_note"] = $pageObject->getViewControl("need_note")->showDBValue($row, "");
					$values["need_hourly"] = $pageObject->getViewControl("need_hourly")->showDBValue($row, "");
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
			
									echo $values["need_id"];
			echo '</td>';
							echo '<td>';
			
									echo $values["people_id"];
			echo '</td>';
							echo '<td>';
			
				
								if($_REQUEST["type"]=="excel")
					echo PrepareForExcel($values["need_type_id"]);
				else
					echo $values["need_type_id"];//echo htmlspecialchars($values["need_type_id"]); commented for bug #6823
					
			echo '</td>';
							echo '<td>';
			
				
								if($_REQUEST["type"]=="excel")
					echo PrepareForExcel($values["need_subtype_id"]);
				else
					echo $values["need_subtype_id"];//echo htmlspecialchars($values["need_subtype_id"]); commented for bug #6823
					
			echo '</td>';
							if($_REQUEST["type"]=="excel")
					echo '<td x:str>';
				else
					echo '<td>';
			
									if($_REQUEST["type"]=="excel")
						echo PrepareForExcel($values["need_note"]);
					else
						echo $values["need_note"];
			echo '</td>';
							echo '<td>';
			
									echo $values["need_hourly"];
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
