<?php
require_once(getabspath("classes/cipherer.php"));
$tdata_taccess = array();
	$tdata_taccess[".NumberOfChars"] = 80; 
	$tdata_taccess[".ShortName"] = "_taccess";
	$tdata_taccess[".OwnerID"] = "";
	$tdata_taccess[".OriginalTable"] = "_taccess";

//	field labels
$fieldLabels_taccess = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabels_taccess["English"] = array();
	$fieldToolTips_taccess["English"] = array();
	$fieldLabels_taccess["English"]["Country"] = "Country";
	$fieldToolTips_taccess["English"]["Country"] = "";
	$fieldLabels_taccess["English"]["Zip"] = "Zip";
	$fieldToolTips_taccess["English"]["Zip"] = "";
	$fieldLabels_taccess["English"]["Location"] = "Location";
	$fieldToolTips_taccess["English"]["Location"] = "";
	$fieldLabels_taccess["English"]["Start"] = "Start";
	$fieldToolTips_taccess["English"]["Start"] = "";
	$fieldLabels_taccess["English"]["End"] = "End";
	$fieldToolTips_taccess["English"]["End"] = "";
	$fieldLabels_taccess["English"]["Note"] = "Note";
	$fieldToolTips_taccess["English"]["Note"] = "";
	$fieldLabels_taccess["English"]["ID"] = "ID";
	$fieldToolTips_taccess["English"]["ID"] = "";
	if (count($fieldToolTips_taccess["English"]))
		$tdata_taccess[".isUseToolTips"] = true;
}
	
	



$tdata_taccess[".shortTableName"] = "_taccess";
$tdata_taccess[".nSecOptions"] = 0;
$tdata_taccess[".recsPerRowList"] = 1;
$tdata_taccess[".mainTableOwnerID"] = "";
$tdata_taccess[".moveNext"] = 1;
$tdata_taccess[".nType"] = 0;

$tdata_taccess[".strOriginalTableName"] = "_taccess";




$tdata_taccess[".showAddInPopup"] = false;

$tdata_taccess[".showEditInPopup"] = false;

$tdata_taccess[".showViewInPopup"] = false;

$tdata_taccess[".fieldsForRegister"] = array();

$tdata_taccess[".listAjax"] = false;

	$tdata_taccess[".audit"] = false;

	$tdata_taccess[".locking"] = false;

$tdata_taccess[".listIcons"] = true;
$tdata_taccess[".edit"] = true;
$tdata_taccess[".inlineEdit"] = true;
$tdata_taccess[".inlineAdd"] = true;
$tdata_taccess[".view"] = true;



$tdata_taccess[".delete"] = true;

$tdata_taccess[".showSimpleSearchOptions"] = false;

$tdata_taccess[".showSearchPanel"] = true;

if (isMobile())
	$tdata_taccess[".isUseAjaxSuggest"] = false;
else 
	$tdata_taccess[".isUseAjaxSuggest"] = true;

$tdata_taccess[".rowHighlite"] = true;

// button handlers file names

$tdata_taccess[".addPageEvents"] = false;

// use timepicker for search panel
$tdata_taccess[".isUseTimeForSearch"] = false;




$tdata_taccess[".allSearchFields"] = array();

$tdata_taccess[".allSearchFields"][] = "Country";
$tdata_taccess[".allSearchFields"][] = "Zip";
$tdata_taccess[".allSearchFields"][] = "Location";
$tdata_taccess[".allSearchFields"][] = "Start";
$tdata_taccess[".allSearchFields"][] = "End";
$tdata_taccess[".allSearchFields"][] = "Note";
$tdata_taccess[".allSearchFields"][] = "ID";

$tdata_taccess[".googleLikeFields"][] = "Country";
$tdata_taccess[".googleLikeFields"][] = "Zip";
$tdata_taccess[".googleLikeFields"][] = "Location";
$tdata_taccess[".googleLikeFields"][] = "Start";
$tdata_taccess[".googleLikeFields"][] = "End";
$tdata_taccess[".googleLikeFields"][] = "Note";
$tdata_taccess[".googleLikeFields"][] = "ID";

$tdata_taccess[".panelSearchFields"][] = "Country";
$tdata_taccess[".panelSearchFields"][] = "Zip";
$tdata_taccess[".panelSearchFields"][] = "Location";
$tdata_taccess[".panelSearchFields"][] = "Start";
$tdata_taccess[".panelSearchFields"][] = "End";
$tdata_taccess[".panelSearchFields"][] = "Note";
$tdata_taccess[".panelSearchFields"][] = "ID";

$tdata_taccess[".advSearchFields"][] = "Country";
$tdata_taccess[".advSearchFields"][] = "Zip";
$tdata_taccess[".advSearchFields"][] = "Location";
$tdata_taccess[".advSearchFields"][] = "Start";
$tdata_taccess[".advSearchFields"][] = "End";
$tdata_taccess[".advSearchFields"][] = "Note";
$tdata_taccess[".advSearchFields"][] = "ID";

$tdata_taccess[".isTableType"] = "list";

	

$tdata_taccess[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdata_taccess[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdata_taccess[".strOrderBy"] = $tstrOrderBy;

$tdata_taccess[".orderindexes"] = array();

$tdata_taccess[".sqlHead"] = "SELECT Country,  Zip,  Location,  `Start`,  `End`,  Note,  ID";
$tdata_taccess[".sqlFrom"] = "FROM `_taccess`";
$tdata_taccess[".sqlWhereExpr"] = "";
$tdata_taccess[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdata_taccess[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdata_taccess[".arrGroupsPerPage"] = $arrGPP;

$tableKeys_taccess = array();
$tableKeys_taccess[] = "ID";
$tdata_taccess[".Keys"] = $tableKeys_taccess;

$tdata_taccess[".listFields"] = array();
$tdata_taccess[".listFields"][] = "Country";
$tdata_taccess[".listFields"][] = "Zip";
$tdata_taccess[".listFields"][] = "Location";
$tdata_taccess[".listFields"][] = "Start";
$tdata_taccess[".listFields"][] = "End";
$tdata_taccess[".listFields"][] = "Note";
$tdata_taccess[".listFields"][] = "ID";

$tdata_taccess[".viewFields"] = array();
$tdata_taccess[".viewFields"][] = "Country";
$tdata_taccess[".viewFields"][] = "Zip";
$tdata_taccess[".viewFields"][] = "Location";
$tdata_taccess[".viewFields"][] = "Start";
$tdata_taccess[".viewFields"][] = "End";
$tdata_taccess[".viewFields"][] = "Note";
$tdata_taccess[".viewFields"][] = "ID";

$tdata_taccess[".addFields"] = array();
$tdata_taccess[".addFields"][] = "Country";
$tdata_taccess[".addFields"][] = "Zip";
$tdata_taccess[".addFields"][] = "Location";
$tdata_taccess[".addFields"][] = "Start";
$tdata_taccess[".addFields"][] = "End";
$tdata_taccess[".addFields"][] = "Note";

$tdata_taccess[".inlineAddFields"] = array();
$tdata_taccess[".inlineAddFields"][] = "Country";
$tdata_taccess[".inlineAddFields"][] = "Zip";
$tdata_taccess[".inlineAddFields"][] = "Location";
$tdata_taccess[".inlineAddFields"][] = "Start";
$tdata_taccess[".inlineAddFields"][] = "End";
$tdata_taccess[".inlineAddFields"][] = "Note";

$tdata_taccess[".editFields"] = array();
$tdata_taccess[".editFields"][] = "Country";
$tdata_taccess[".editFields"][] = "Zip";
$tdata_taccess[".editFields"][] = "Location";
$tdata_taccess[".editFields"][] = "Start";
$tdata_taccess[".editFields"][] = "End";
$tdata_taccess[".editFields"][] = "Note";

$tdata_taccess[".inlineEditFields"] = array();
$tdata_taccess[".inlineEditFields"][] = "Country";
$tdata_taccess[".inlineEditFields"][] = "Zip";
$tdata_taccess[".inlineEditFields"][] = "Location";
$tdata_taccess[".inlineEditFields"][] = "Start";
$tdata_taccess[".inlineEditFields"][] = "End";
$tdata_taccess[".inlineEditFields"][] = "Note";

$tdata_taccess[".exportFields"] = array();

$tdata_taccess[".printFields"] = array();

//	Country
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "Country";
	$fdata["GoodName"] = "Country";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "Country"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Country"; 
		$fdata["FullName"] = "Country";
	
		
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
	
		
		$edata["AutoUpdate"] = true; 
	
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_taccess["Country"] = $fdata;
//	Zip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "Zip";
	$fdata["GoodName"] = "Zip";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "Zip"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Zip"; 
		$fdata["FullName"] = "Zip";
	
		
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
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		$edata["AutoUpdate"] = true; 
	
	
//	Begin Lookup settings
								$edata["LookupType"] = 1;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			$edata["LookupUnique"] = true;
	
	$edata["LinkField"] = "ZIP";
	$edata["LinkFieldType"] = 2;
	$edata["DisplayField"] = "ZIP";
	
		
	$edata["LookupTable"] = "t_zipch";
	$edata["LookupOrderBy"] = "ZIP";
	
		
		
		
		
		
		$edata["SimpleAdd"] = true;
			
			//	dependent dropdowns	
	$edata["DependentLookups"] = array();
	$edata["DependentLookups"][] = "Location";
	
	
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_taccess["Zip"] = $fdata;
//	Location
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Location";
	$fdata["GoodName"] = "Location";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "Location"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Location"; 
		$fdata["FullName"] = "Location";
	
		
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
	
	$edata = array("EditFormat" => "Lookup wizard");
	
		
		$edata["AutoUpdate"] = true; 
	
	
//	Begin Lookup settings
								$edata["LookupType"] = 1;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			
	$edata["LinkField"] = "Location";
	$edata["LinkFieldType"] = 200;
	$edata["DisplayField"] = "Location";
	
		
	$edata["LookupTable"] = "t_zipch";
	$edata["LookupOrderBy"] = "";
	
		
		
		$edata["UseCategory"] = true; 
	$edata["CategoryControl"] = "Zip"; 
	$edata["CategoryFilter"] = "ZIP"; 
	
		
		
		$edata["SimpleAdd"] = true;
			
	
	
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_taccess["Location"] = $fdata;
//	Start
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "Start";
	$fdata["GoodName"] = "Start";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "Start"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Start"; 
		$fdata["FullName"] = "`Start`";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_taccess["Start"] = $fdata;
//	End
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "End";
	$fdata["GoodName"] = "End";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "End"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "End"; 
		$fdata["FullName"] = "`End`";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_taccess["End"] = $fdata;
//	Note
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Note";
	$fdata["GoodName"] = "Note";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "Note"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		$fdata["bAddPage"] = true; 
	
		$fdata["bInlineAdd"] = true; 
	
		$fdata["bEditPage"] = true; 
	
		$fdata["bInlineEdit"] = true; 
	
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Note"; 
		$fdata["FullName"] = "Note";
	
		
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
			$edata["EditParams"].= " maxlength=300";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdata_taccess["Note"] = $fdata;
//	ID
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "ID";
	$fdata["GoodName"] = "ID";
	$fdata["ownerTable"] = "_taccess";
	$fdata["Label"] = "ID"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
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
	
		
		
	$tdata_taccess["ID"] = $fdata;

	
$tables_data["_taccess"]=&$tdata_taccess;
$field_labels["_taccess"] = &$fieldLabels_taccess;
$fieldToolTips["_taccess"] = &$fieldToolTips_taccess;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["_taccess"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["_taccess"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery__taccess()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "Country,  Zip,  Location,  `Start`,  `End`,  Note,  ID";
$proto0["m_strFrom"] = "FROM `_taccess`";
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
	"m_strName" => "Country",
	"m_strTable" => "_taccess"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "Zip",
	"m_strTable" => "_taccess"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Location",
	"m_strTable" => "_taccess"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Start",
	"m_strTable" => "_taccess"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "End",
	"m_strTable" => "_taccess"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Note",
	"m_strTable" => "_taccess"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "ID",
	"m_strTable" => "_taccess"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto19=array();
$proto19["m_link"] = "SQLL_MAIN";
			$proto20=array();
$proto20["m_strName"] = "_taccess";
$proto20["m_columns"] = array();
$proto20["m_columns"][] = "Country";
$proto20["m_columns"][] = "Zip";
$proto20["m_columns"][] = "zip_area";
$proto20["m_columns"][] = "Location";
$proto20["m_columns"][] = "Start";
$proto20["m_columns"][] = "End";
$proto20["m_columns"][] = "demo";
$proto20["m_columns"][] = "Note";
$proto20["m_columns"][] = "ID";
$proto20["m_columns"][] = "CreatedByPHPRunner";
$obj = new SQLTable($proto20);

$proto19["m_table"] = $obj;
$proto19["m_alias"] = "";
$proto21=array();
$proto21["m_sql"] = "";
$proto21["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto21["m_column"]=$obj;
$proto21["m_contained"] = array();
$proto21["m_strCase"] = "";
$proto21["m_havingmode"] = "0";
$proto21["m_inBrackets"] = "0";
$proto21["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto21);

$proto19["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto19);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData__taccess = createSqlQuery__taccess();
							$tdata_taccess[".sqlquery"] = $queryData__taccess;
	
if(isset($tdata_taccess["field2"])){
	$tdata_taccess["field2"]["LookupTable"] = "carscars_view";
	$tdata_taccess["field2"]["LookupOrderBy"] = "name";
	$tdata_taccess["field2"]["LookupType"] = 4;
	$tdata_taccess["field2"]["LinkField"] = "email";
	$tdata_taccess["field2"]["DisplayField"] = "name";
	$tdata_taccess[".hasCustomViewField"] = true;
}

$tableEvents["_taccess"] = new eventsBase;
$tdata_taccess[".hasEvents"] = false;

$cipherer = new RunnerCipherer("_taccess");

?>