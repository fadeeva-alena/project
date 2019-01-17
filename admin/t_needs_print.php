<?php
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("classes/searchclause.php");

add_nocache_headers();

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

$layout = new TLayout("print","BoldAqua","MobileAqua");
$layout->blocks["center"] = array();
$layout->containers["grid"] = array();

$layout->containers["grid"][] = array("name"=>"printgrid","block"=>"grid_block","substyle"=>1);


$layout->skins["grid"] = "empty";
$layout->blocks["center"][] = "grid";$layout->blocks["top"] = array();
$layout->skins["master"] = "empty";
$layout->blocks["top"][] = "master";
$layout->skins["pdf"] = "empty";
$layout->blocks["top"][] = "pdf";$page_layouts["t_needs_print"] = $layout;


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
			$keys["need_id"]=refine($_REQUEST["mdelete1"][mdeleteIndex($ind)]);
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
			$keys["need_id"]=urldecode($arr[0]);
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
$arr['fName'] = "need_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("need_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "people_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("people_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "need_type_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("need_type_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "need_subtype_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("need_subtype_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "need_note";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("need_note");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "need_hourly";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("need_hourly");
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
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["need_id"]));

//	need_id - 
			$record["need_id_value"] = $pageObject->showDBValue("need_id", $data, $keylink);
			$record["need_id_class"] = $pageObject->fieldClass("need_id");
//	people_id - 
			$record["people_id_value"] = $pageObject->showDBValue("people_id", $data, $keylink);
			$record["people_id_class"] = $pageObject->fieldClass("people_id");
//	need_type_id - 
			$record["need_type_id_value"] = $pageObject->showDBValue("need_type_id", $data, $keylink);
			$record["need_type_id_class"] = $pageObject->fieldClass("need_type_id");
//	need_subtype_id - 
			$record["need_subtype_id_value"] = $pageObject->showDBValue("need_subtype_id", $data, $keylink);
			$record["need_subtype_id_class"] = $pageObject->fieldClass("need_subtype_id");
//	need_note - 
			$record["need_note_value"] = $pageObject->showDBValue("need_note", $data, $keylink);
			$record["need_note_class"] = $pageObject->fieldClass("need_note");
//	need_hourly - 
			$record["need_hourly_value"] = $pageObject->showDBValue("need_hourly", $data, $keylink);
			$record["need_hourly_class"] = $pageObject->fieldClass("need_hourly");
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

$xt->assign("need_id_fieldheadercolumn",true);
$xt->assign("need_id_fieldheader",true);
$xt->assign("need_id_fieldcolumn",true);
$xt->assign("need_id_fieldfootercolumn",true);
$xt->assign("people_id_fieldheadercolumn",true);
$xt->assign("people_id_fieldheader",true);
$xt->assign("people_id_fieldcolumn",true);
$xt->assign("people_id_fieldfootercolumn",true);
$xt->assign("need_type_id_fieldheadercolumn",true);
$xt->assign("need_type_id_fieldheader",true);
$xt->assign("need_type_id_fieldcolumn",true);
$xt->assign("need_type_id_fieldfootercolumn",true);
$xt->assign("need_subtype_id_fieldheadercolumn",true);
$xt->assign("need_subtype_id_fieldheader",true);
$xt->assign("need_subtype_id_fieldcolumn",true);
$xt->assign("need_subtype_id_fieldfootercolumn",true);
$xt->assign("need_note_fieldheadercolumn",true);
$xt->assign("need_note_fieldheader",true);
$xt->assign("need_note_fieldcolumn",true);
$xt->assign("need_note_fieldfootercolumn",true);
$xt->assign("need_hourly_fieldheadercolumn",true);
$xt->assign("need_hourly_fieldheader",true);
$xt->assign("need_hourly_fieldcolumn",true);
$xt->assign("need_hourly_fieldfootercolumn",true);
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
