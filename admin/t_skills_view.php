<?php 
@ini_set("display_errors","1");
@ini_set("display_startup_errors","1");

include("include/dbcommon.php");
include("include/t_skills_variables.php");
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
$layout->blocks["top"][] = "details";$page_layouts["t_skills_view"] = $layout;




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
	header("Location: t_skills_list.php?a=return");
	exit();
}

$out = "";
$first = true;
$fieldsArr = array();
$arr = array();
$arr['fName'] = "skill_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("skill_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "people_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("people_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "skill_type_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("skill_type_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "skill_subtype_id";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("skill_subtype_id");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "skill_note";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("skill_note");
$fieldsArr[] = $arr;
$arr = array();
$arr['fName'] = "skill_hourly";
$arr['viewFormat'] = $pageObject->pSet->getViewFormat("skill_hourly");
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

$mainTableOwnerID = $pageObject->pSet->getTableOwnerIdField();
$ownerIdValue="";

$pageObject->setGoogleMapsParams($fieldsArr);

while($data)
{
	$xt->assign("show_key1", htmlspecialchars($pageObject->showDBValue("skill_id", $data)));

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["skill_id"]));

////////////////////////////////////////////
//skill_id - 
	
	$value = $pageObject->showDBValue("skill_id", $data, $keylink);
	if($mainTableOwnerID=="skill_id")
		$ownerIdValue=$value;
	$xt->assign("skill_id_value",$value);
	if(!$pageObject->isAppearOnTabs("skill_id"))
		$xt->assign("skill_id_fieldblock",true);
	else
		$xt->assign("skill_id_tabfieldblock",true);
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
//skill_type_id - 
	
	$value = $pageObject->showDBValue("skill_type_id", $data, $keylink);
	if($mainTableOwnerID=="skill_type_id")
		$ownerIdValue=$value;
	$xt->assign("skill_type_id_value",$value);
	if(!$pageObject->isAppearOnTabs("skill_type_id"))
		$xt->assign("skill_type_id_fieldblock",true);
	else
		$xt->assign("skill_type_id_tabfieldblock",true);
////////////////////////////////////////////
//skill_subtype_id - 
	
	$value = $pageObject->showDBValue("skill_subtype_id", $data, $keylink);
	if($mainTableOwnerID=="skill_subtype_id")
		$ownerIdValue=$value;
	$xt->assign("skill_subtype_id_value",$value);
	if(!$pageObject->isAppearOnTabs("skill_subtype_id"))
		$xt->assign("skill_subtype_id_fieldblock",true);
	else
		$xt->assign("skill_subtype_id_tabfieldblock",true);
////////////////////////////////////////////
//skill_note - 
	
	$value = $pageObject->showDBValue("skill_note", $data, $keylink);
	if($mainTableOwnerID=="skill_note")
		$ownerIdValue=$value;
	$xt->assign("skill_note_value",$value);
	if(!$pageObject->isAppearOnTabs("skill_note"))
		$xt->assign("skill_note_fieldblock",true);
	else
		$xt->assign("skill_note_tabfieldblock",true);
////////////////////////////////////////////
//skill_hourly - 
	
	$value = $pageObject->showDBValue("skill_hourly", $data, $keylink);
	if($mainTableOwnerID=="skill_hourly")
		$ownerIdValue=$value;
	$xt->assign("skill_hourly_value",$value);
	if(!$pageObject->isAppearOnTabs("skill_hourly"))
		$xt->assign("skill_hourly_fieldblock",true);
	else
		$xt->assign("skill_hourly_tabfieldblock",true);
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
		$options['masterTable'] = "t_skills";
		$options['firstTime'] = 1;
		
		$strTableName = $dpParams['strTableNames'][$d];
		include_once("include/".GetTableURL($strTableName)."_settings.php");
		if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
		{
			$strTableName = "t_skills";
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
	$strTableName = "t_skills";
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
$xt->assign("editlink_attrs","id=\"editLink".$id."\" name=\"editLink".$id."\" onclick=\"window.location.href='t_skills_edit.php?".$editlink."'\"");

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
