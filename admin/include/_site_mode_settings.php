<?php
require_once(getabspath("classes/cipherer.php"));
$tdata_site_mode = array();
	$tdata_site_mode[".NumberOfChars"] = 80; 
	$tdata_site_mode[".ShortName"] = "_site_mode";
	$tdata_site_mode[".OwnerID"] = "";
	$tdata_site_mode[".OriginalTable"] = "_site_mode";

//	field labels
$fieldLabels_site_mode = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabels_site_mode["English"] = array();
	$fieldToolTips_site_mode["English"] = array();
	$fieldLabels_site_mode["English"]["Status"] = "Status";
	$fieldToolTips_site_mode["English"]["Status"] = "";
	$fieldLabels_site_mode["English"]["Message"] = "Message";
	$fieldToolTips_site_mode["English"]["Message"] = "";
	$fieldLabels_site_mode["English"]["Mode"] = "Mode";
	$fieldToolTips_site_mode["English"]["Mode"] = "";
	$fieldLabels_site_mode["English"]["ID"] = "ID";
	$fieldToolTips_site_mode["English"]["ID"] = "";
	if (count($fieldToolTips_site_mode["English"]))
		$tdata_site_mode[".isUseToolTips"] = true;
}
	
	



$tdata_site_mode[".shortTableName"] = "_site_mode";
$tdata_site_mode[".nSecOptions"] = 0;
$tdata_site_mode[".recsPerRowList"] = 1;
$tdata_site_mode[".mainTableOwnerID"] = "";
$tdata_site_mode[".moveNext"] = 1;
$tdata_site_mode[".nType"] = 0;

$tdata_site_mode[".strOriginalTableName"] = "_site_mode";




$tdata_site_mode[".showAddInPopup"] = false;

$tdata_site_mode[".showEditInPopup"] = false;

$tdata_site_mode[".showViewInPopup"] = false;

$tdata_site_mode[".fieldsForRegister"] = array();

$tdata_site_mode[".listAjax"] = false;

	$tdata_site_mode[".audit"] = false;

	$tdata_site_mode[".locking"] = false;

$tdata_site_mode[".listIcons"] = true;
$tdata_site_mode[".edit"] = true;
$tdata_site_mode[".inlineEdit"] = true;
$tdata_site_mode[".inlineAdd"] = true;
$tdata_site_mode[".view"] = true;

$tdata_site_mode[".exportTo"] = true;

$tdata_site_mode[".printFriendly"] = true;


$tdata_site_mode[".showSimpleSearchOptions"] = false;

$tdata_site_mode[".showSearchPanel"] = true;

if (isMobile())
	$tdata_site_mode[".isUseAjaxSuggest"] = false;
else 
	$tdata_site_mode[".isUseAjaxSuggest"] = true;

$tdata_site_mode[".rowHighlite"] = true;

// button handlers file names

$tdata_site_mode[".addPageEvents"] = false;

// use timepicker for search panel
$tdata_site_mode[".isUseTimeForSearch"] = false;




$tdata_site_mode[".allSearchFields"] = array();

$tdata_site_mode[".allSearchFields"][] = "Status";
$tdata_site_mode[".allSearchFields"][] = "Message";
$tdata_site_mode[".allSearchFields"][] = "Mode";
$tdata_site_mode[".allSearchFields"][] = "ID";

$tdata_site_mode[".googleLikeFields"][] = "Status";
$tdata_site_mode[".googleLikeFields"][] = "Message";
$tdata_site_mode[".googleLikeFields"][] = "Mode";
$tdata_site_mode[".googleLikeFields"][] = "ID";

$tdata_site_mode[".panelSearchFields"][] = "Status";
$tdata_site_mode[".panelSearchFields"][] = "Message";
$tdata_site_mode[".panelSearchFields"][] = "Mode";
$tdata_site_mode[".panelSearchFields"][] = "ID";

$tdata_site_mode[".advSearchFields"][] = "Status";
$tdata_site_mode[".advSearchFields"][] = "Message";
$tdata_site_mode[".advSearchFields"][] = "Mode";
$tdata_site_mode[".advSearchFields"][] = "ID";

$tdata_site_mode[".isTableType"] = "list";

	

$tdata_site_mode[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdata_site_mode[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdata_site_mode[".strOrderBy"] = $tstrOrderBy;

$tdata_site_mode[".orderindexes"] = array();

$tdata_site_mode[".sqlHead"] = "SELECT Status,  Message,  `Mode`,  ID";
$tdata_site_mode[".sqlFrom"] = "FROM `_site_mode`";
$tdata_site_mode[".sqlWhereExpr"] = "";
$tdata_site_mode[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdata_site_mode[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdata_site_mode[".arrGroupsPerPage"] = $arrGPP;

$tableKeys_site_mode = array();
$tableKeys_site_mode[] = "ID";
$tdata_site_mode[".Keys"] = $tableKeys_site_mode;

$tdata_site_mode[".listFields"] = array();
$tdata_site_mode[".listFields"][] = "Status";
$tdata_site_mode[".listFields"][] = "Message";
$tdata_site_mode[".listFields"][] = "Mode";
$tdata_site_mode[".listFields"][] = "ID";

$tdata_site_mode[".viewFields"] = array();
$tdata_site_mode[".viewFields"][] = "Status";
$tdata_site_mode[".viewFields"][] = "Message";
$tdata_site_mode[".viewFields"][] = "Mode";
$tdata_site_mode[".viewFields"][] = "ID";

$tdata_site_mode[".addFields"] = array();

$tdata_site_mode[".inlineAddFields"] = array();
$tdata_site_mode[".inlineAddFields"][] = "Status";
$tdata_site_mode[".inlineAddFields"][] = "Message";
$tdata_site_mode[".inlineAddFields"][] = "Mode";

$tdata_site_mode[".editFields"] = array();
$tdata_site_mode[".editFields"][] = "Status";
$tdata_site_mode[".editFields"][] = "Message";
$tdata_site_mode[".editFields"][] = "Mode";

$tdata_site_mode[".inlineEditFields"] = array();
$tdata_site_mode[".inlineEditFields"][] = "Status";
$tdata_site_mode[".inlineEditFields"][] = "Message";
$tdata_site_mode[".inlineEditFields"][] = "Mode";

$tdata_site_mode[".exportFields"] = array();
$tdata_site_mode[".exportFields"][] = "Status";
$tdata_site_mode[".exportFields"][] = "Message";
$tdata_site_mode[".exportFields"][] = "Mode";
$tdata_site_mode[".exportFields"][] = "ID";

$tdata_site_mode[".printFields"] = array();
$tdata_site_mode[".printFields"][] = "Status";
$tdata_site_mode[".printFields"][] = "Message";
$tdata_site_mode[".printFields"][] = "Mode";
$tdata_site_mode[".printFields"][] = "ID";

//	Status
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "Status";
	$fdata["GoodName"] = "Status";
	$fdata["ownerTable"] = "_site_mode";
	$fdata["Label"] = "Status"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Status"; 
		$fdata["FullName"] = "Status";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_site_mode["Status"] = $fdata;
//	Message
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Message";
	$fdata["GoodName"] = "Message";
	$fdata["ownerTable"] = "_site_mode";
	$fdata["Label"] = "Message"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Message"; 
		$fdata["FullName"] = "Message";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=600";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_site_mode["Message"] = $fdata;
//	Mode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Mode";
	$fdata["GoodName"] = "Mode";
	$fdata["ownerTable"] = "_site_mode";
	$fdata["Label"] = "Mode"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Mode"; 
		$fdata["FullName"] = "`Mode`";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_site_mode["Mode"] = $fdata;
//	ID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "ID";
	$fdata["GoodName"] = "ID";
	$fdata["ownerTable"] = "_site_mode";
	$fdata["Label"] = "ID"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "ID"; 
		$fdata["FullName"] = "ID";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_site_mode["ID"] = $fdata;

	
$tables_data["_site_mode"]=&$tdata_site_mode;
$field_labels["_site_mode"] = &$fieldLabels_site_mode;
$fieldToolTips["_site_mode"] = &$fieldToolTips_site_mode;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["_site_mode"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["_site_mode"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery__site_mode()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "Status,  Message,  `Mode`,  ID";
$proto0["m_strFrom"] = "FROM `_site_mode`";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = null;
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "Status",
	"m_strTable" => "_site_mode"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Message",
	"m_strTable" => "_site_mode"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Mode",
	"m_strTable" => "_site_mode"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "ID",
	"m_strTable" => "_site_mode"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto13=array();
$proto13["m_link"] = "SQLL_MAIN";
			$proto14=array();
$proto14["m_strName"] = "_site_mode";
$proto14["m_columns"] = array();
$proto14["m_columns"][] = "Status";
$proto14["m_columns"][] = "Message";
$proto14["m_columns"][] = "Mode";
$proto14["m_columns"][] = "ID";
$proto14["m_columns"][] = "CreatedByPHPRunner";
$obj = new SQLTable($proto14);

$proto13["m_table"] = $obj;
$proto13["m_alias"] = "";
$proto15=array();
$proto15["m_sql"] = "";
$proto15["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto15["m_column"]=$obj;
$proto15["m_contained"] = array();
$proto15["m_strCase"] = "";
$proto15["m_havingmode"] = "0";
$proto15["m_inBrackets"] = "0";
$proto15["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto15);

$proto13["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto13);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData__site_mode = createSqlQuery__site_mode();
				$tdata_site_mode[".sqlquery"] = $queryData__site_mode;
	
if(isset($tdata_site_mode["field2"])){
	$tdata_site_mode["field2"]["LookupTable"] = "carscars_view";
	$tdata_site_mode["field2"]["LookupOrderBy"] = "name";
	$tdata_site_mode["field2"]["LookupType"] = 4;
	$tdata_site_mode["field2"]["LinkField"] = "email";
	$tdata_site_mode["field2"]["DisplayField"] = "name";
	$tdata_site_mode[".hasCustomViewField"] = true;
}

$tableEvents["_site_mode"] = new eventsBase;
$tdata_site_mode[".hasEvents"] = false;

$cipherer = new RunnerCipherer("_site_mode");

?>