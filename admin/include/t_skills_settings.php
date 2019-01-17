<?php
require_once(getabspath("classes/cipherer.php"));
$tdatat_skills = array();
	$tdatat_skills[".NumberOfChars"] = 80; 
	$tdatat_skills[".ShortName"] = "t_skills";
	$tdatat_skills[".OwnerID"] = "";
	$tdatat_skills[".OriginalTable"] = "t_skills";

//	field labels
$fieldLabelst_skills = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelst_skills["English"] = array();
	$fieldToolTipst_skills["English"] = array();
	$fieldLabelst_skills["English"]["skill_id"] = "Skill Id";
	$fieldToolTipst_skills["English"]["skill_id"] = "";
	$fieldLabelst_skills["English"]["people_id"] = "People Id";
	$fieldToolTipst_skills["English"]["people_id"] = "";
	$fieldLabelst_skills["English"]["skill_type_id"] = "Skill Type Id";
	$fieldToolTipst_skills["English"]["skill_type_id"] = "";
	$fieldLabelst_skills["English"]["skill_subtype_id"] = "Skill Subtype Id";
	$fieldToolTipst_skills["English"]["skill_subtype_id"] = "";
	$fieldLabelst_skills["English"]["skill_note"] = "Skill Note";
	$fieldToolTipst_skills["English"]["skill_note"] = "";
	$fieldLabelst_skills["English"]["skill_hourly"] = "Skill Hourly";
	$fieldToolTipst_skills["English"]["skill_hourly"] = "";
	$fieldLabelst_skills["English"]["prof_provider"] = "Prof Provider";
	$fieldToolTipst_skills["English"]["prof_provider"] = "";
	$fieldLabelst_skills["English"]["firstname"] = "Firstname";
	$fieldToolTipst_skills["English"]["firstname"] = "";
	$fieldLabelst_skills["English"]["lastname"] = "Lastname";
	$fieldToolTipst_skills["English"]["lastname"] = "";
	$fieldLabelst_skills["English"]["image_path"] = "Image Path";
	$fieldToolTipst_skills["English"]["image_path"] = "";
	$fieldLabelst_skills["English"]["street"] = "Street";
	$fieldToolTipst_skills["English"]["street"] = "";
	$fieldLabelst_skills["English"]["house_nr"] = "House Nr";
	$fieldToolTipst_skills["English"]["house_nr"] = "";
	$fieldLabelst_skills["English"]["zip"] = "Zip";
	$fieldToolTipst_skills["English"]["zip"] = "";
	$fieldLabelst_skills["English"]["location"] = "Location";
	$fieldToolTipst_skills["English"]["location"] = "";
	$fieldLabelst_skills["English"]["locationarea"] = "Locationarea";
	$fieldToolTipst_skills["English"]["locationarea"] = "";
	$fieldLabelst_skills["English"]["tel_p"] = "Tel P";
	$fieldToolTipst_skills["English"]["tel_p"] = "";
	$fieldLabelst_skills["English"]["tel_m"] = "Tel M";
	$fieldToolTipst_skills["English"]["tel_m"] = "";
	$fieldLabelst_skills["English"]["email"] = "Email";
	$fieldToolTipst_skills["English"]["email"] = "";
	if (count($fieldToolTipst_skills["English"]))
		$tdatat_skills[".isUseToolTips"] = true;
}
	
	



$tdatat_skills[".shortTableName"] = "t_skills";
$tdatat_skills[".nSecOptions"] = 0;
$tdatat_skills[".recsPerRowList"] = 1;
$tdatat_skills[".mainTableOwnerID"] = "";
$tdatat_skills[".moveNext"] = 1;
$tdatat_skills[".nType"] = 0;

$tdatat_skills[".strOriginalTableName"] = "t_skills";




$tdatat_skills[".showAddInPopup"] = false;

$tdatat_skills[".showEditInPopup"] = false;

$tdatat_skills[".showViewInPopup"] = false;

$tdatat_skills[".fieldsForRegister"] = array();

$tdatat_skills[".listAjax"] = false;

	$tdatat_skills[".audit"] = false;

	$tdatat_skills[".locking"] = false;

$tdatat_skills[".listIcons"] = true;
$tdatat_skills[".view"] = true;

$tdatat_skills[".exportTo"] = true;

$tdatat_skills[".printFriendly"] = true;


$tdatat_skills[".showSimpleSearchOptions"] = false;

$tdatat_skills[".showSearchPanel"] = true;

if (isMobile())
	$tdatat_skills[".isUseAjaxSuggest"] = false;
else 
	$tdatat_skills[".isUseAjaxSuggest"] = true;

$tdatat_skills[".rowHighlite"] = true;

// button handlers file names

$tdatat_skills[".addPageEvents"] = false;

// use timepicker for search panel
$tdatat_skills[".isUseTimeForSearch"] = false;




$tdatat_skills[".allSearchFields"] = array();

$tdatat_skills[".allSearchFields"][] = "skill_id";
$tdatat_skills[".allSearchFields"][] = "people_id";
$tdatat_skills[".allSearchFields"][] = "skill_type_id";
$tdatat_skills[".allSearchFields"][] = "skill_subtype_id";
$tdatat_skills[".allSearchFields"][] = "skill_note";
$tdatat_skills[".allSearchFields"][] = "skill_hourly";
$tdatat_skills[".allSearchFields"][] = "prof_provider";
$tdatat_skills[".allSearchFields"][] = "firstname";
$tdatat_skills[".allSearchFields"][] = "lastname";
$tdatat_skills[".allSearchFields"][] = "image_path";
$tdatat_skills[".allSearchFields"][] = "street";
$tdatat_skills[".allSearchFields"][] = "house_nr";
$tdatat_skills[".allSearchFields"][] = "zip";
$tdatat_skills[".allSearchFields"][] = "location";
$tdatat_skills[".allSearchFields"][] = "locationarea";
$tdatat_skills[".allSearchFields"][] = "tel_p";
$tdatat_skills[".allSearchFields"][] = "tel_m";
$tdatat_skills[".allSearchFields"][] = "email";

$tdatat_skills[".googleLikeFields"][] = "skill_id";
$tdatat_skills[".googleLikeFields"][] = "people_id";
$tdatat_skills[".googleLikeFields"][] = "skill_type_id";
$tdatat_skills[".googleLikeFields"][] = "skill_subtype_id";
$tdatat_skills[".googleLikeFields"][] = "skill_note";
$tdatat_skills[".googleLikeFields"][] = "skill_hourly";
$tdatat_skills[".googleLikeFields"][] = "prof_provider";
$tdatat_skills[".googleLikeFields"][] = "firstname";
$tdatat_skills[".googleLikeFields"][] = "lastname";
$tdatat_skills[".googleLikeFields"][] = "image_path";
$tdatat_skills[".googleLikeFields"][] = "street";
$tdatat_skills[".googleLikeFields"][] = "house_nr";
$tdatat_skills[".googleLikeFields"][] = "zip";
$tdatat_skills[".googleLikeFields"][] = "location";
$tdatat_skills[".googleLikeFields"][] = "locationarea";
$tdatat_skills[".googleLikeFields"][] = "tel_p";
$tdatat_skills[".googleLikeFields"][] = "tel_m";
$tdatat_skills[".googleLikeFields"][] = "email";

$tdatat_skills[".panelSearchFields"][] = "skill_id";
$tdatat_skills[".panelSearchFields"][] = "people_id";
$tdatat_skills[".panelSearchFields"][] = "skill_type_id";
$tdatat_skills[".panelSearchFields"][] = "skill_subtype_id";
$tdatat_skills[".panelSearchFields"][] = "skill_note";
$tdatat_skills[".panelSearchFields"][] = "skill_hourly";
$tdatat_skills[".panelSearchFields"][] = "prof_provider";
$tdatat_skills[".panelSearchFields"][] = "firstname";
$tdatat_skills[".panelSearchFields"][] = "lastname";
$tdatat_skills[".panelSearchFields"][] = "image_path";
$tdatat_skills[".panelSearchFields"][] = "street";
$tdatat_skills[".panelSearchFields"][] = "house_nr";
$tdatat_skills[".panelSearchFields"][] = "zip";
$tdatat_skills[".panelSearchFields"][] = "location";
$tdatat_skills[".panelSearchFields"][] = "locationarea";
$tdatat_skills[".panelSearchFields"][] = "tel_p";
$tdatat_skills[".panelSearchFields"][] = "tel_m";
$tdatat_skills[".panelSearchFields"][] = "email";

$tdatat_skills[".advSearchFields"][] = "skill_id";
$tdatat_skills[".advSearchFields"][] = "people_id";
$tdatat_skills[".advSearchFields"][] = "skill_type_id";
$tdatat_skills[".advSearchFields"][] = "skill_subtype_id";
$tdatat_skills[".advSearchFields"][] = "skill_note";
$tdatat_skills[".advSearchFields"][] = "skill_hourly";
$tdatat_skills[".advSearchFields"][] = "prof_provider";
$tdatat_skills[".advSearchFields"][] = "firstname";
$tdatat_skills[".advSearchFields"][] = "lastname";
$tdatat_skills[".advSearchFields"][] = "image_path";
$tdatat_skills[".advSearchFields"][] = "street";
$tdatat_skills[".advSearchFields"][] = "house_nr";
$tdatat_skills[".advSearchFields"][] = "zip";
$tdatat_skills[".advSearchFields"][] = "location";
$tdatat_skills[".advSearchFields"][] = "locationarea";
$tdatat_skills[".advSearchFields"][] = "tel_p";
$tdatat_skills[".advSearchFields"][] = "tel_m";
$tdatat_skills[".advSearchFields"][] = "email";

$tdatat_skills[".isTableType"] = "list";

	

$tdatat_skills[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdatat_skills[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatat_skills[".strOrderBy"] = $tstrOrderBy;

$tdatat_skills[".orderindexes"] = array();

$tdatat_skills[".sqlHead"] = "SELECT t_skills.skill_id,  t_skills.people_id,  t_skills.skill_type_id,  t_skills.skill_subtype_id,  t_skills.skill_note,  t_skills.skill_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email";
$tdatat_skills[".sqlFrom"] = "FROM t_skills  INNER JOIN t_people ON t_skills.people_id = t_people.people_id";
$tdatat_skills[".sqlWhereExpr"] = "";
$tdatat_skills[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatat_skills[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatat_skills[".arrGroupsPerPage"] = $arrGPP;

$tableKeyst_skills = array();
$tableKeyst_skills[] = "skill_id";
$tdatat_skills[".Keys"] = $tableKeyst_skills;

$tdatat_skills[".listFields"] = array();
$tdatat_skills[".listFields"][] = "skill_id";
$tdatat_skills[".listFields"][] = "people_id";
$tdatat_skills[".listFields"][] = "skill_type_id";
$tdatat_skills[".listFields"][] = "skill_subtype_id";
$tdatat_skills[".listFields"][] = "skill_note";
$tdatat_skills[".listFields"][] = "skill_hourly";
$tdatat_skills[".listFields"][] = "prof_provider";
$tdatat_skills[".listFields"][] = "firstname";
$tdatat_skills[".listFields"][] = "lastname";
$tdatat_skills[".listFields"][] = "image_path";
$tdatat_skills[".listFields"][] = "street";
$tdatat_skills[".listFields"][] = "house_nr";
$tdatat_skills[".listFields"][] = "zip";
$tdatat_skills[".listFields"][] = "location";
$tdatat_skills[".listFields"][] = "locationarea";
$tdatat_skills[".listFields"][] = "tel_p";
$tdatat_skills[".listFields"][] = "tel_m";
$tdatat_skills[".listFields"][] = "email";

$tdatat_skills[".viewFields"] = array();
$tdatat_skills[".viewFields"][] = "skill_id";
$tdatat_skills[".viewFields"][] = "people_id";
$tdatat_skills[".viewFields"][] = "skill_type_id";
$tdatat_skills[".viewFields"][] = "skill_subtype_id";
$tdatat_skills[".viewFields"][] = "skill_note";
$tdatat_skills[".viewFields"][] = "skill_hourly";
$tdatat_skills[".viewFields"][] = "prof_provider";
$tdatat_skills[".viewFields"][] = "firstname";
$tdatat_skills[".viewFields"][] = "lastname";
$tdatat_skills[".viewFields"][] = "image_path";
$tdatat_skills[".viewFields"][] = "street";
$tdatat_skills[".viewFields"][] = "house_nr";
$tdatat_skills[".viewFields"][] = "zip";
$tdatat_skills[".viewFields"][] = "location";
$tdatat_skills[".viewFields"][] = "locationarea";
$tdatat_skills[".viewFields"][] = "tel_p";
$tdatat_skills[".viewFields"][] = "tel_m";
$tdatat_skills[".viewFields"][] = "email";

$tdatat_skills[".addFields"] = array();

$tdatat_skills[".inlineAddFields"] = array();

$tdatat_skills[".editFields"] = array();

$tdatat_skills[".inlineEditFields"] = array();

$tdatat_skills[".exportFields"] = array();
$tdatat_skills[".exportFields"][] = "skill_id";
$tdatat_skills[".exportFields"][] = "people_id";
$tdatat_skills[".exportFields"][] = "skill_type_id";
$tdatat_skills[".exportFields"][] = "skill_subtype_id";
$tdatat_skills[".exportFields"][] = "skill_note";
$tdatat_skills[".exportFields"][] = "skill_hourly";
$tdatat_skills[".exportFields"][] = "prof_provider";
$tdatat_skills[".exportFields"][] = "firstname";
$tdatat_skills[".exportFields"][] = "lastname";
$tdatat_skills[".exportFields"][] = "image_path";
$tdatat_skills[".exportFields"][] = "street";
$tdatat_skills[".exportFields"][] = "house_nr";
$tdatat_skills[".exportFields"][] = "zip";
$tdatat_skills[".exportFields"][] = "location";
$tdatat_skills[".exportFields"][] = "locationarea";
$tdatat_skills[".exportFields"][] = "tel_p";
$tdatat_skills[".exportFields"][] = "tel_m";
$tdatat_skills[".exportFields"][] = "email";

$tdatat_skills[".printFields"] = array();
$tdatat_skills[".printFields"][] = "skill_id";
$tdatat_skills[".printFields"][] = "people_id";
$tdatat_skills[".printFields"][] = "skill_type_id";
$tdatat_skills[".printFields"][] = "skill_subtype_id";
$tdatat_skills[".printFields"][] = "skill_note";
$tdatat_skills[".printFields"][] = "skill_hourly";
$tdatat_skills[".printFields"][] = "prof_provider";
$tdatat_skills[".printFields"][] = "firstname";
$tdatat_skills[".printFields"][] = "lastname";
$tdatat_skills[".printFields"][] = "image_path";
$tdatat_skills[".printFields"][] = "street";
$tdatat_skills[".printFields"][] = "house_nr";
$tdatat_skills[".printFields"][] = "zip";
$tdatat_skills[".printFields"][] = "location";
$tdatat_skills[".printFields"][] = "locationarea";
$tdatat_skills[".printFields"][] = "tel_p";
$tdatat_skills[".printFields"][] = "tel_m";
$tdatat_skills[".printFields"][] = "email";

//	skill_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "skill_id";
	$fdata["GoodName"] = "skill_id";
	$fdata["ownerTable"] = "t_skills";
	$fdata["Label"] = "Skill Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "skill_id"; 
		$fdata["FullName"] = "t_skills.skill_id";
	
		
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
	
		
		
	$tdatat_skills["skill_id"] = $fdata;
//	people_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "people_id";
	$fdata["GoodName"] = "people_id";
	$fdata["ownerTable"] = "t_skills";
	$fdata["Label"] = "People Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "people_id"; 
		$fdata["FullName"] = "t_skills.people_id";
	
		
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
	
		
		
	$tdatat_skills["people_id"] = $fdata;
//	skill_type_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "skill_type_id";
	$fdata["GoodName"] = "skill_type_id";
	$fdata["ownerTable"] = "t_skills";
	$fdata["Label"] = "Skill Type Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "skill_type_id"; 
		$fdata["FullName"] = "t_skills.skill_type_id";
	
		
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
	
		
		
	$tdatat_skills["skill_type_id"] = $fdata;
//	skill_subtype_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "skill_subtype_id";
	$fdata["GoodName"] = "skill_subtype_id";
	$fdata["ownerTable"] = "t_skills";
	$fdata["Label"] = "Skill Subtype Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "skill_subtype_id"; 
		$fdata["FullName"] = "t_skills.skill_subtype_id";
	
		
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
	
		
		
	$tdatat_skills["skill_subtype_id"] = $fdata;
//	skill_note
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "skill_note";
	$fdata["GoodName"] = "skill_note";
	$fdata["ownerTable"] = "t_skills";
	$fdata["Label"] = "Skill Note"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "skill_note"; 
		$fdata["FullName"] = "t_skills.skill_note";
	
		
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
	
		
		
	$tdatat_skills["skill_note"] = $fdata;
//	skill_hourly
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "skill_hourly";
	$fdata["GoodName"] = "skill_hourly";
	$fdata["ownerTable"] = "t_skills";
	$fdata["Label"] = "Skill Hourly"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "skill_hourly"; 
		$fdata["FullName"] = "t_skills.skill_hourly";
	
		
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
	
		
		
	$tdatat_skills["skill_hourly"] = $fdata;
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
	
		
		
	$tdatat_skills["prof_provider"] = $fdata;
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
	
		
		
	$tdatat_skills["firstname"] = $fdata;
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
	
		
		
	$tdatat_skills["lastname"] = $fdata;
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
	
		
		
	$tdatat_skills["image_path"] = $fdata;
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
	
		
		
	$tdatat_skills["street"] = $fdata;
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
	
		
		
	$tdatat_skills["house_nr"] = $fdata;
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
	
		
		
	$tdatat_skills["zip"] = $fdata;
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
	
		
		
	$tdatat_skills["location"] = $fdata;
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
	
		
		
	$tdatat_skills["locationarea"] = $fdata;
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
	
		
		
	$tdatat_skills["tel_p"] = $fdata;
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
	
		
		
	$tdatat_skills["tel_m"] = $fdata;
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
	
		
		
	$tdatat_skills["email"] = $fdata;

	
$tables_data["t_skills"]=&$tdatat_skills;
$field_labels["t_skills"] = &$fieldLabelst_skills;
$fieldToolTips["t_skills"] = &$fieldToolTipst_skills;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["t_skills"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["t_skills"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_t_skills()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "t_skills.skill_id,  t_skills.people_id,  t_skills.skill_type_id,  t_skills.skill_subtype_id,  t_skills.skill_note,  t_skills.skill_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email";
$proto0["m_strFrom"] = "FROM t_skills  INNER JOIN t_people ON t_skills.people_id = t_people.people_id";
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
	"m_strName" => "skill_id",
	"m_strTable" => "t_skills"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "people_id",
	"m_strTable" => "t_skills"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "skill_type_id",
	"m_strTable" => "t_skills"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "skill_subtype_id",
	"m_strTable" => "t_skills"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "skill_note",
	"m_strTable" => "t_skills"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "skill_hourly",
	"m_strTable" => "t_skills"
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
$proto42["m_strName"] = "t_skills";
$proto42["m_columns"] = array();
$proto42["m_columns"][] = "skill_id";
$proto42["m_columns"][] = "people_id";
$proto42["m_columns"][] = "skill_type_id";
$proto42["m_columns"][] = "skill_subtype_id";
$proto42["m_columns"][] = "skill_note";
$proto42["m_columns"][] = "skill_hourly";
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
$proto47["m_sql"] = "t_skills.people_id = t_people.people_id";
$proto47["m_uniontype"] = "SQLL_UNKNOWN";
						$obj = new SQLField(array(
	"m_strName" => "people_id",
	"m_strTable" => "t_skills"
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
$queryData_t_skills = createSqlQuery_t_skills();
																		$tdatat_skills[".sqlquery"] = $queryData_t_skills;
	
if(isset($tdatat_skills["field2"])){
	$tdatat_skills["field2"]["LookupTable"] = "carscars_view";
	$tdatat_skills["field2"]["LookupOrderBy"] = "name";
	$tdatat_skills["field2"]["LookupType"] = 4;
	$tdatat_skills["field2"]["LinkField"] = "email";
	$tdatat_skills["field2"]["DisplayField"] = "name";
	$tdatat_skills[".hasCustomViewField"] = true;
}

$tableEvents["t_skills"] = new eventsBase;
$tdatat_skills[".hasEvents"] = false;

$cipherer = new RunnerCipherer("t_skills");

?>