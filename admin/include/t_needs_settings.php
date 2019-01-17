<?php
require_once(getabspath("classes/cipherer.php"));
$tdatat_needs = array();
	$tdatat_needs[".NumberOfChars"] = 80; 
	$tdatat_needs[".ShortName"] = "t_needs";
	$tdatat_needs[".OwnerID"] = "";
	$tdatat_needs[".OriginalTable"] = "t_needs";

//	field labels
$fieldLabelst_needs = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelst_needs["English"] = array();
	$fieldToolTipst_needs["English"] = array();
	$fieldLabelst_needs["English"]["need_id"] = "Need Id";
	$fieldToolTipst_needs["English"]["need_id"] = "";
	$fieldLabelst_needs["English"]["people_id"] = "People Id";
	$fieldToolTipst_needs["English"]["people_id"] = "";
	$fieldLabelst_needs["English"]["need_type_id"] = "Need Type Id";
	$fieldToolTipst_needs["English"]["need_type_id"] = "";
	$fieldLabelst_needs["English"]["need_subtype_id"] = "Need Subtype Id";
	$fieldToolTipst_needs["English"]["need_subtype_id"] = "";
	$fieldLabelst_needs["English"]["need_note"] = "Need Note";
	$fieldToolTipst_needs["English"]["need_note"] = "";
	$fieldLabelst_needs["English"]["need_hourly"] = "Need Hourly";
	$fieldToolTipst_needs["English"]["need_hourly"] = "";
	$fieldLabelst_needs["English"]["prof_provider"] = "Prof Provider";
	$fieldToolTipst_needs["English"]["prof_provider"] = "";
	$fieldLabelst_needs["English"]["firstname"] = "Firstname";
	$fieldToolTipst_needs["English"]["firstname"] = "";
	$fieldLabelst_needs["English"]["lastname"] = "Lastname";
	$fieldToolTipst_needs["English"]["lastname"] = "";
	$fieldLabelst_needs["English"]["image_path"] = "Image Path";
	$fieldToolTipst_needs["English"]["image_path"] = "";
	$fieldLabelst_needs["English"]["street"] = "Street";
	$fieldToolTipst_needs["English"]["street"] = "";
	$fieldLabelst_needs["English"]["house_nr"] = "House Nr";
	$fieldToolTipst_needs["English"]["house_nr"] = "";
	$fieldLabelst_needs["English"]["zip"] = "Zip";
	$fieldToolTipst_needs["English"]["zip"] = "";
	$fieldLabelst_needs["English"]["location"] = "Location";
	$fieldToolTipst_needs["English"]["location"] = "";
	$fieldLabelst_needs["English"]["locationarea"] = "Locationarea";
	$fieldToolTipst_needs["English"]["locationarea"] = "";
	$fieldLabelst_needs["English"]["tel_p"] = "Tel P";
	$fieldToolTipst_needs["English"]["tel_p"] = "";
	$fieldLabelst_needs["English"]["tel_m"] = "Tel M";
	$fieldToolTipst_needs["English"]["tel_m"] = "";
	$fieldLabelst_needs["English"]["email"] = "Email";
	$fieldToolTipst_needs["English"]["email"] = "";
	if (count($fieldToolTipst_needs["English"]))
		$tdatat_needs[".isUseToolTips"] = true;
}
	
	



$tdatat_needs[".shortTableName"] = "t_needs";
$tdatat_needs[".nSecOptions"] = 0;
$tdatat_needs[".recsPerRowList"] = 1;
$tdatat_needs[".mainTableOwnerID"] = "";
$tdatat_needs[".moveNext"] = 1;
$tdatat_needs[".nType"] = 0;

$tdatat_needs[".strOriginalTableName"] = "t_needs";




$tdatat_needs[".showAddInPopup"] = false;

$tdatat_needs[".showEditInPopup"] = false;

$tdatat_needs[".showViewInPopup"] = false;

$tdatat_needs[".fieldsForRegister"] = array();

$tdatat_needs[".listAjax"] = false;

	$tdatat_needs[".audit"] = false;

	$tdatat_needs[".locking"] = false;

$tdatat_needs[".listIcons"] = true;
$tdatat_needs[".view"] = true;

$tdatat_needs[".exportTo"] = true;

$tdatat_needs[".printFriendly"] = true;


$tdatat_needs[".showSimpleSearchOptions"] = false;

$tdatat_needs[".showSearchPanel"] = true;

if (isMobile())
	$tdatat_needs[".isUseAjaxSuggest"] = false;
else 
	$tdatat_needs[".isUseAjaxSuggest"] = true;

$tdatat_needs[".rowHighlite"] = true;

// button handlers file names

$tdatat_needs[".addPageEvents"] = false;

// use timepicker for search panel
$tdatat_needs[".isUseTimeForSearch"] = false;




$tdatat_needs[".allSearchFields"] = array();

$tdatat_needs[".allSearchFields"][] = "need_id";
$tdatat_needs[".allSearchFields"][] = "people_id";
$tdatat_needs[".allSearchFields"][] = "need_type_id";
$tdatat_needs[".allSearchFields"][] = "need_subtype_id";
$tdatat_needs[".allSearchFields"][] = "need_note";
$tdatat_needs[".allSearchFields"][] = "need_hourly";
$tdatat_needs[".allSearchFields"][] = "prof_provider";
$tdatat_needs[".allSearchFields"][] = "firstname";
$tdatat_needs[".allSearchFields"][] = "lastname";
$tdatat_needs[".allSearchFields"][] = "image_path";
$tdatat_needs[".allSearchFields"][] = "street";
$tdatat_needs[".allSearchFields"][] = "house_nr";
$tdatat_needs[".allSearchFields"][] = "zip";
$tdatat_needs[".allSearchFields"][] = "location";
$tdatat_needs[".allSearchFields"][] = "locationarea";
$tdatat_needs[".allSearchFields"][] = "tel_p";
$tdatat_needs[".allSearchFields"][] = "tel_m";
$tdatat_needs[".allSearchFields"][] = "email";

$tdatat_needs[".googleLikeFields"][] = "need_id";
$tdatat_needs[".googleLikeFields"][] = "people_id";
$tdatat_needs[".googleLikeFields"][] = "need_type_id";
$tdatat_needs[".googleLikeFields"][] = "need_subtype_id";
$tdatat_needs[".googleLikeFields"][] = "need_note";
$tdatat_needs[".googleLikeFields"][] = "need_hourly";
$tdatat_needs[".googleLikeFields"][] = "prof_provider";
$tdatat_needs[".googleLikeFields"][] = "firstname";
$tdatat_needs[".googleLikeFields"][] = "lastname";
$tdatat_needs[".googleLikeFields"][] = "image_path";
$tdatat_needs[".googleLikeFields"][] = "street";
$tdatat_needs[".googleLikeFields"][] = "house_nr";
$tdatat_needs[".googleLikeFields"][] = "zip";
$tdatat_needs[".googleLikeFields"][] = "location";
$tdatat_needs[".googleLikeFields"][] = "locationarea";
$tdatat_needs[".googleLikeFields"][] = "tel_p";
$tdatat_needs[".googleLikeFields"][] = "tel_m";
$tdatat_needs[".googleLikeFields"][] = "email";

$tdatat_needs[".panelSearchFields"][] = "need_id";
$tdatat_needs[".panelSearchFields"][] = "people_id";
$tdatat_needs[".panelSearchFields"][] = "need_type_id";
$tdatat_needs[".panelSearchFields"][] = "need_subtype_id";
$tdatat_needs[".panelSearchFields"][] = "need_note";
$tdatat_needs[".panelSearchFields"][] = "need_hourly";
$tdatat_needs[".panelSearchFields"][] = "prof_provider";
$tdatat_needs[".panelSearchFields"][] = "firstname";
$tdatat_needs[".panelSearchFields"][] = "lastname";
$tdatat_needs[".panelSearchFields"][] = "image_path";
$tdatat_needs[".panelSearchFields"][] = "street";
$tdatat_needs[".panelSearchFields"][] = "house_nr";
$tdatat_needs[".panelSearchFields"][] = "zip";
$tdatat_needs[".panelSearchFields"][] = "location";
$tdatat_needs[".panelSearchFields"][] = "locationarea";
$tdatat_needs[".panelSearchFields"][] = "tel_p";
$tdatat_needs[".panelSearchFields"][] = "tel_m";
$tdatat_needs[".panelSearchFields"][] = "email";

$tdatat_needs[".advSearchFields"][] = "need_id";
$tdatat_needs[".advSearchFields"][] = "people_id";
$tdatat_needs[".advSearchFields"][] = "need_type_id";
$tdatat_needs[".advSearchFields"][] = "need_subtype_id";
$tdatat_needs[".advSearchFields"][] = "need_note";
$tdatat_needs[".advSearchFields"][] = "need_hourly";
$tdatat_needs[".advSearchFields"][] = "prof_provider";
$tdatat_needs[".advSearchFields"][] = "firstname";
$tdatat_needs[".advSearchFields"][] = "lastname";
$tdatat_needs[".advSearchFields"][] = "image_path";
$tdatat_needs[".advSearchFields"][] = "street";
$tdatat_needs[".advSearchFields"][] = "house_nr";
$tdatat_needs[".advSearchFields"][] = "zip";
$tdatat_needs[".advSearchFields"][] = "location";
$tdatat_needs[".advSearchFields"][] = "locationarea";
$tdatat_needs[".advSearchFields"][] = "tel_p";
$tdatat_needs[".advSearchFields"][] = "tel_m";
$tdatat_needs[".advSearchFields"][] = "email";

$tdatat_needs[".isTableType"] = "list";

	

$tdatat_needs[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdatat_needs[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatat_needs[".strOrderBy"] = $tstrOrderBy;

$tdatat_needs[".orderindexes"] = array();

$tdatat_needs[".sqlHead"] = "SELECT t_needs.need_id,  t_needs.people_id,  t_needs.need_type_id,  t_needs.need_subtype_id,  t_needs.need_note,  t_needs.need_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email";
$tdatat_needs[".sqlFrom"] = "FROM t_needs  INNER JOIN t_people ON t_needs.people_id = t_people.people_id";
$tdatat_needs[".sqlWhereExpr"] = "";
$tdatat_needs[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatat_needs[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatat_needs[".arrGroupsPerPage"] = $arrGPP;

$tableKeyst_needs = array();
$tableKeyst_needs[] = "need_id";
$tdatat_needs[".Keys"] = $tableKeyst_needs;

$tdatat_needs[".listFields"] = array();
$tdatat_needs[".listFields"][] = "need_id";
$tdatat_needs[".listFields"][] = "people_id";
$tdatat_needs[".listFields"][] = "need_type_id";
$tdatat_needs[".listFields"][] = "need_subtype_id";
$tdatat_needs[".listFields"][] = "need_note";
$tdatat_needs[".listFields"][] = "need_hourly";
$tdatat_needs[".listFields"][] = "prof_provider";
$tdatat_needs[".listFields"][] = "firstname";
$tdatat_needs[".listFields"][] = "lastname";
$tdatat_needs[".listFields"][] = "image_path";
$tdatat_needs[".listFields"][] = "street";
$tdatat_needs[".listFields"][] = "house_nr";
$tdatat_needs[".listFields"][] = "zip";
$tdatat_needs[".listFields"][] = "location";
$tdatat_needs[".listFields"][] = "locationarea";
$tdatat_needs[".listFields"][] = "tel_p";
$tdatat_needs[".listFields"][] = "tel_m";
$tdatat_needs[".listFields"][] = "email";

$tdatat_needs[".viewFields"] = array();
$tdatat_needs[".viewFields"][] = "need_id";
$tdatat_needs[".viewFields"][] = "people_id";
$tdatat_needs[".viewFields"][] = "need_type_id";
$tdatat_needs[".viewFields"][] = "need_subtype_id";
$tdatat_needs[".viewFields"][] = "need_note";
$tdatat_needs[".viewFields"][] = "need_hourly";
$tdatat_needs[".viewFields"][] = "prof_provider";
$tdatat_needs[".viewFields"][] = "firstname";
$tdatat_needs[".viewFields"][] = "lastname";
$tdatat_needs[".viewFields"][] = "image_path";
$tdatat_needs[".viewFields"][] = "street";
$tdatat_needs[".viewFields"][] = "house_nr";
$tdatat_needs[".viewFields"][] = "zip";
$tdatat_needs[".viewFields"][] = "location";
$tdatat_needs[".viewFields"][] = "locationarea";
$tdatat_needs[".viewFields"][] = "tel_p";
$tdatat_needs[".viewFields"][] = "tel_m";
$tdatat_needs[".viewFields"][] = "email";

$tdatat_needs[".addFields"] = array();

$tdatat_needs[".inlineAddFields"] = array();

$tdatat_needs[".editFields"] = array();

$tdatat_needs[".inlineEditFields"] = array();

$tdatat_needs[".exportFields"] = array();
$tdatat_needs[".exportFields"][] = "need_id";
$tdatat_needs[".exportFields"][] = "people_id";
$tdatat_needs[".exportFields"][] = "need_type_id";
$tdatat_needs[".exportFields"][] = "need_subtype_id";
$tdatat_needs[".exportFields"][] = "need_note";
$tdatat_needs[".exportFields"][] = "need_hourly";
$tdatat_needs[".exportFields"][] = "prof_provider";
$tdatat_needs[".exportFields"][] = "firstname";
$tdatat_needs[".exportFields"][] = "lastname";
$tdatat_needs[".exportFields"][] = "image_path";
$tdatat_needs[".exportFields"][] = "street";
$tdatat_needs[".exportFields"][] = "house_nr";
$tdatat_needs[".exportFields"][] = "zip";
$tdatat_needs[".exportFields"][] = "location";
$tdatat_needs[".exportFields"][] = "locationarea";
$tdatat_needs[".exportFields"][] = "tel_p";
$tdatat_needs[".exportFields"][] = "tel_m";
$tdatat_needs[".exportFields"][] = "email";

$tdatat_needs[".printFields"] = array();
$tdatat_needs[".printFields"][] = "need_id";
$tdatat_needs[".printFields"][] = "people_id";
$tdatat_needs[".printFields"][] = "need_type_id";
$tdatat_needs[".printFields"][] = "need_subtype_id";
$tdatat_needs[".printFields"][] = "need_note";
$tdatat_needs[".printFields"][] = "need_hourly";
$tdatat_needs[".printFields"][] = "prof_provider";
$tdatat_needs[".printFields"][] = "firstname";
$tdatat_needs[".printFields"][] = "lastname";
$tdatat_needs[".printFields"][] = "image_path";
$tdatat_needs[".printFields"][] = "street";
$tdatat_needs[".printFields"][] = "house_nr";
$tdatat_needs[".printFields"][] = "zip";
$tdatat_needs[".printFields"][] = "location";
$tdatat_needs[".printFields"][] = "locationarea";
$tdatat_needs[".printFields"][] = "tel_p";
$tdatat_needs[".printFields"][] = "tel_m";
$tdatat_needs[".printFields"][] = "email";

//	need_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "need_id";
	$fdata["GoodName"] = "need_id";
	$fdata["ownerTable"] = "t_needs";
	$fdata["Label"] = "Need Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "need_id"; 
		$fdata["FullName"] = "t_needs.need_id";
	
		
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
	
		
		
	$tdatat_needs["need_id"] = $fdata;
//	people_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "people_id";
	$fdata["GoodName"] = "people_id";
	$fdata["ownerTable"] = "t_needs";
	$fdata["Label"] = "People Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "people_id"; 
		$fdata["FullName"] = "t_needs.people_id";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["people_id"] = $fdata;
//	need_type_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "need_type_id";
	$fdata["GoodName"] = "need_type_id";
	$fdata["ownerTable"] = "t_needs";
	$fdata["Label"] = "Need Type Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "need_type_id"; 
		$fdata["FullName"] = "t_needs.need_type_id";
	
		
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
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 1;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			
	$edata["LinkField"] = "skilltype_id";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "skilltype";
	
		
	$edata["LookupTable"] = "t_skill_types";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
		$edata["SimpleAdd"] = true;
			
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["need_type_id"] = $fdata;
//	need_subtype_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "need_subtype_id";
	$fdata["GoodName"] = "need_subtype_id";
	$fdata["ownerTable"] = "t_needs";
	$fdata["Label"] = "Need Subtype Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "need_subtype_id"; 
		$fdata["FullName"] = "t_needs.need_subtype_id";
	
		
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
	
		
		
	
//	Begin Lookup settings
								$edata["LookupType"] = 1;
	$edata["freeInput"] = 0;
	$edata["autoCompleteFieldsOnEdit"] = 0;
	$edata["autoCompleteFields"] = array();
				
		
			
	$edata["LinkField"] = "skill_subtype_id";
	$edata["LinkFieldType"] = 3;
	$edata["DisplayField"] = "skill_subtype";
	
		
	$edata["LookupTable"] = "t_skill_subtype";
	$edata["LookupOrderBy"] = "";
	
		
		
		
		
		
		$edata["SimpleAdd"] = true;
			
	
	
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["need_subtype_id"] = $fdata;
//	need_note
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "need_note";
	$fdata["GoodName"] = "need_note";
	$fdata["ownerTable"] = "t_needs";
	$fdata["Label"] = "Need Note"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "need_note"; 
		$fdata["FullName"] = "t_needs.need_note";
	
		
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
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 250;
			$edata["nCols"] = 500;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["need_note"] = $fdata;
//	need_hourly
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "need_hourly";
	$fdata["GoodName"] = "need_hourly";
	$fdata["ownerTable"] = "t_needs";
	$fdata["Label"] = "Need Hourly"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "need_hourly"; 
		$fdata["FullName"] = "t_needs.need_hourly";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["need_hourly"] = $fdata;
//	prof_provider
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "prof_provider";
	$fdata["GoodName"] = "prof_provider";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Prof Provider"; 
	$fdata["FieldType"] = 16;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "prof_provider"; 
		$fdata["FullName"] = "t_people.prof_provider";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["prof_provider"] = $fdata;
//	firstname
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "firstname";
	$fdata["GoodName"] = "firstname";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Firstname"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "firstname"; 
		$fdata["FullName"] = "t_people.firstname";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["firstname"] = $fdata;
//	lastname
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "lastname";
	$fdata["GoodName"] = "lastname";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Lastname"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "lastname"; 
		$fdata["FullName"] = "t_people.lastname";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["lastname"] = $fdata;
//	image_path
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "image_path";
	$fdata["GoodName"] = "image_path";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Image Path"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "image_path"; 
		$fdata["FullName"] = "t_people.image_path";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "../images/profile/";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "File-based Image");
	
		
		$vdata["LinkPrefix"] ="../images/profile/"; 
	
				$vdata["ImageWidth"] = 0;
	$vdata["ImageHeight"] = 0;
	
			
		
		
		
		
		
		
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["image_path"] = $fdata;
//	street
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "street";
	$fdata["GoodName"] = "street";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Street"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "street"; 
		$fdata["FullName"] = "t_people.street";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["street"] = $fdata;
//	house_nr
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "house_nr";
	$fdata["GoodName"] = "house_nr";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "House Nr"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "house_nr"; 
		$fdata["FullName"] = "t_people.house_nr";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["house_nr"] = $fdata;
//	zip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "zip";
	$fdata["GoodName"] = "zip";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Zip"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "zip"; 
		$fdata["FullName"] = "t_people.zip";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["zip"] = $fdata;
//	location
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "location";
	$fdata["GoodName"] = "location";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Location"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "location"; 
		$fdata["FullName"] = "t_people.location";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["location"] = $fdata;
//	locationarea
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "locationarea";
	$fdata["GoodName"] = "locationarea";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Locationarea"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "locationarea"; 
		$fdata["FullName"] = "t_people.locationarea";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["locationarea"] = $fdata;
//	tel_p
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "tel_p";
	$fdata["GoodName"] = "tel_p";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Tel P"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tel_p"; 
		$fdata["FullName"] = "t_people.tel_p";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["tel_p"] = $fdata;
//	tel_m
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "tel_m";
	$fdata["GoodName"] = "tel_m";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Tel M"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tel_m"; 
		$fdata["FullName"] = "t_people.tel_m";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["tel_m"] = $fdata;
//	email
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "email";
	$fdata["GoodName"] = "email";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Email"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "email"; 
		$fdata["FullName"] = "t_people.email";
	
		
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
			
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_needs["email"] = $fdata;

	
$tables_data["t_needs"]=&$tdatat_needs;
$field_labels["t_needs"] = &$fieldLabelst_needs;
$fieldToolTips["t_needs"] = &$fieldToolTipst_needs;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["t_needs"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["t_needs"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_t_needs()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "t_needs.need_id,  t_needs.people_id,  t_needs.need_type_id,  t_needs.need_subtype_id,  t_needs.need_note,  t_needs.need_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email";
$proto0["m_strFrom"] = "FROM t_needs  INNER JOIN t_people ON t_needs.people_id = t_people.people_id";
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
	"m_strName" => "need_id",
	"m_strTable" => "t_needs"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "people_id",
	"m_strTable" => "t_needs"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "need_type_id",
	"m_strTable" => "t_needs"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "need_subtype_id",
	"m_strTable" => "t_needs"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "need_note",
	"m_strTable" => "t_needs"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "need_hourly",
	"m_strTable" => "t_needs"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "prof_provider",
	"m_strTable" => "t_people"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "firstname",
	"m_strTable" => "t_people"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "lastname",
	"m_strTable" => "t_people"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "image_path",
	"m_strTable" => "t_people"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "street",
	"m_strTable" => "t_people"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "house_nr",
	"m_strTable" => "t_people"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "zip",
	"m_strTable" => "t_people"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "location",
	"m_strTable" => "t_people"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "locationarea",
	"m_strTable" => "t_people"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "tel_p",
	"m_strTable" => "t_people"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "tel_m",
	"m_strTable" => "t_people"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
			$obj = new SQLField(array(
	"m_strName" => "email",
	"m_strTable" => "t_people"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto41=array();
$proto41["m_link"] = "SQLL_MAIN";
			$proto42=array();
$proto42["m_strName"] = "t_needs";
$proto42["m_columns"] = array();
$proto42["m_columns"][] = "need_id";
$proto42["m_columns"][] = "people_id";
$proto42["m_columns"][] = "need_type_id";
$proto42["m_columns"][] = "need_subtype_id";
$proto42["m_columns"][] = "need_note";
$proto42["m_columns"][] = "need_hourly";
$obj = new SQLTable($proto42);

$proto41["m_table"] = $obj;
$proto41["m_alias"] = "";
$proto43=array();
$proto43["m_sql"] = "";
$proto43["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto43["m_column"]=$obj;
$proto43["m_contained"] = array();
$proto43["m_strCase"] = "";
$proto43["m_havingmode"] = "0";
$proto43["m_inBrackets"] = "0";
$proto43["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto43);

$proto41["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto41);

$proto0["m_fromlist"][]=$obj;
												$proto45=array();
$proto45["m_link"] = "SQLL_INNERJOIN";
			$proto46=array();
$proto46["m_strName"] = "t_people";
$proto46["m_columns"] = array();
$proto46["m_columns"][] = "people_id";
$proto46["m_columns"][] = "institution";
$proto46["m_columns"][] = "prof_provider";
$proto46["m_columns"][] = "firstname";
$proto46["m_columns"][] = "lastname";
$proto46["m_columns"][] = "image_path";
$proto46["m_columns"][] = "street";
$proto46["m_columns"][] = "house_nr";
$proto46["m_columns"][] = "zip";
$proto46["m_columns"][] = "location";
$proto46["m_columns"][] = "locationarea";
$proto46["m_columns"][] = "tel_p";
$proto46["m_columns"][] = "tel_m";
$proto46["m_columns"][] = "email";
$proto46["m_columns"][] = "username";
$proto46["m_columns"][] = "password";
$proto46["m_columns"][] = "picture";
$proto46["m_columns"][] = "picture_2";
$proto46["m_columns"][] = "gender";
$proto46["m_columns"][] = "adminstatus_to_delete";
$proto46["m_columns"][] = "birthdate";
$proto46["m_columns"][] = "enabled";
$proto46["m_columns"][] = "temp_sched_from";
$proto46["m_columns"][] = "temp_sched_to";
$proto46["m_columns"][] = "joiningdate";
$proto46["m_columns"][] = "coord_accuracy";
$proto46["m_columns"][] = "monday";
$proto46["m_columns"][] = "tuesday";
$proto46["m_columns"][] = "wednesday";
$proto46["m_columns"][] = "thursday";
$proto46["m_columns"][] = "friday";
$proto46["m_columns"][] = "saturday";
$proto46["m_columns"][] = "sunday";
$proto46["m_columns"][] = "monday_t";
$proto46["m_columns"][] = "tuesday_t";
$proto46["m_columns"][] = "wednesday_t";
$proto46["m_columns"][] = "thursday_t";
$proto46["m_columns"][] = "friday_t";
$proto46["m_columns"][] = "saturday_t";
$proto46["m_columns"][] = "sunday_t";
$proto46["m_columns"][] = "preferred_contact_by";
$proto46["m_columns"][] = "date_last_adress_change";
$proto46["m_columns"][] = "map_in";
$proto46["m_columns"][] = "IconPath";
$proto46["m_columns"][] = "Icon";
$proto46["m_columns"][] = "note";
$proto46["m_columns"][] = "price_per_hour";
$proto46["m_columns"][] = "psych_time_loose_tight";
$proto46["m_columns"][] = "psych_exact_creativ";
$proto46["m_columns"][] = "psych_heart_thing";
$proto46["m_columns"][] = "psych_easy_security";
$proto46["m_columns"][] = "psych_conflict_take_leave";
$proto46["m_columns"][] = "longitude";
$proto46["m_columns"][] = "latitude";
$proto46["m_columns"][] = "Agree";
$proto46["m_columns"][] = "Sign_date";
$proto46["m_columns"][] = "Active";
$proto46["m_columns"][] = "Acode";
$obj = new SQLTable($proto46);

$proto45["m_table"] = $obj;
$proto45["m_alias"] = "";
$proto47=array();
$proto47["m_sql"] = "t_needs.people_id = t_people.people_id";
$proto47["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "people_id",
	"m_strTable" => "t_needs"
));

$proto47["m_column"]=$obj;
$proto47["m_contained"] = array();
$proto47["m_strCase"] = "= t_people.people_id";
$proto47["m_havingmode"] = "0";
$proto47["m_inBrackets"] = "0";
$proto47["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto47);

$proto45["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto45);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_t_needs = createSqlQuery_t_needs();
																		$tdatat_needs[".sqlquery"] = $queryData_t_needs;
	
if(isset($tdatat_needs["field2"])){
	$tdatat_needs["field2"]["LookupTable"] = "carscars_view";
	$tdatat_needs["field2"]["LookupOrderBy"] = "name";
	$tdatat_needs["field2"]["LookupType"] = 4;
	$tdatat_needs["field2"]["LinkField"] = "email";
	$tdatat_needs["field2"]["DisplayField"] = "name";
	$tdatat_needs[".hasCustomViewField"] = true;
}

$tableEvents["t_needs"] = new eventsBase;
$tdatat_needs[".hasEvents"] = false;

$cipherer = new RunnerCipherer("t_needs");

?>