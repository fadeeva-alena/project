<?php
require_once(getabspath("classes/cipherer.php"));
$tdata_t_search = array();
	$tdata_t_search[".NumberOfChars"] = 80; 
	$tdata_t_search[".ShortName"] = "_t_search";
	$tdata_t_search[".OwnerID"] = "";
	$tdata_t_search[".OriginalTable"] = "_t_search";

//	field labels
$fieldLabels_t_search = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabels_t_search["English"] = array();
	$fieldToolTips_t_search["English"] = array();
	$fieldLabels_t_search["English"]["date"] = "Date";
	$fieldToolTips_t_search["English"]["date"] = "";
	$fieldLabels_t_search["English"]["searchid"] = "Searchid";
	$fieldToolTips_t_search["English"]["searchid"] = "";
	$fieldLabels_t_search["English"]["Search_type"] = "Search Type";
	$fieldToolTips_t_search["English"]["Search_type"] = "";
	$fieldLabels_t_search["English"]["Username"] = "Username";
	$fieldToolTips_t_search["English"]["Username"] = "";
	$fieldLabels_t_search["English"]["Skill_type"] = "Skill Type";
	$fieldToolTips_t_search["English"]["Skill_type"] = "";
	$fieldLabels_t_search["English"]["Skill_Subtype"] = "Skill Subtype";
	$fieldToolTips_t_search["English"]["Skill_Subtype"] = "";
	$fieldLabels_t_search["English"]["Gender"] = "Gender";
	$fieldToolTips_t_search["English"]["Gender"] = "";
	if (count($fieldToolTips_t_search["English"]))
		$tdata_t_search[".isUseToolTips"] = true;
}
	
	



$tdata_t_search[".shortTableName"] = "_t_search";
$tdata_t_search[".nSecOptions"] = 0;
$tdata_t_search[".recsPerRowList"] = 1;
$tdata_t_search[".mainTableOwnerID"] = "";
$tdata_t_search[".moveNext"] = 1;
$tdata_t_search[".nType"] = 0;

$tdata_t_search[".strOriginalTableName"] = "_t_search";




$tdata_t_search[".showAddInPopup"] = false;

$tdata_t_search[".showEditInPopup"] = false;

$tdata_t_search[".showViewInPopup"] = false;

$tdata_t_search[".fieldsForRegister"] = array();

$tdata_t_search[".listAjax"] = false;

	$tdata_t_search[".audit"] = false;

	$tdata_t_search[".locking"] = false;

$tdata_t_search[".listIcons"] = true;




$tdata_t_search[".showSimpleSearchOptions"] = false;

$tdata_t_search[".showSearchPanel"] = true;

if (isMobile())
	$tdata_t_search[".isUseAjaxSuggest"] = false;
else 
	$tdata_t_search[".isUseAjaxSuggest"] = true;

$tdata_t_search[".rowHighlite"] = true;

// button handlers file names

$tdata_t_search[".addPageEvents"] = false;

// use timepicker for search panel
$tdata_t_search[".isUseTimeForSearch"] = false;




$tdata_t_search[".allSearchFields"] = array();

$tdata_t_search[".allSearchFields"][] = "date";
$tdata_t_search[".allSearchFields"][] = "searchid";
$tdata_t_search[".allSearchFields"][] = "Search_type";
$tdata_t_search[".allSearchFields"][] = "Username";
$tdata_t_search[".allSearchFields"][] = "Skill_type";
$tdata_t_search[".allSearchFields"][] = "Skill_Subtype";
$tdata_t_search[".allSearchFields"][] = "Gender";

$tdata_t_search[".googleLikeFields"][] = "date";
$tdata_t_search[".googleLikeFields"][] = "searchid";
$tdata_t_search[".googleLikeFields"][] = "Search_type";
$tdata_t_search[".googleLikeFields"][] = "Username";
$tdata_t_search[".googleLikeFields"][] = "Skill_type";
$tdata_t_search[".googleLikeFields"][] = "Skill_Subtype";
$tdata_t_search[".googleLikeFields"][] = "Gender";

$tdata_t_search[".panelSearchFields"][] = "date";
$tdata_t_search[".panelSearchFields"][] = "searchid";
$tdata_t_search[".panelSearchFields"][] = "Search_type";
$tdata_t_search[".panelSearchFields"][] = "Username";
$tdata_t_search[".panelSearchFields"][] = "Skill_type";
$tdata_t_search[".panelSearchFields"][] = "Skill_Subtype";
$tdata_t_search[".panelSearchFields"][] = "Gender";

$tdata_t_search[".advSearchFields"][] = "date";
$tdata_t_search[".advSearchFields"][] = "searchid";
$tdata_t_search[".advSearchFields"][] = "Search_type";
$tdata_t_search[".advSearchFields"][] = "Username";
$tdata_t_search[".advSearchFields"][] = "Skill_type";
$tdata_t_search[".advSearchFields"][] = "Skill_Subtype";
$tdata_t_search[".advSearchFields"][] = "Gender";

$tdata_t_search[".isTableType"] = "list";

	

$tdata_t_search[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdata_t_search[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdata_t_search[".strOrderBy"] = $tstrOrderBy;

$tdata_t_search[".orderindexes"] = array();

$tdata_t_search[".sqlHead"] = "SELECT `date`,  searchid,  Search_type,  Username,  Skill_type,  Skill_Subtype,  Gender";
$tdata_t_search[".sqlFrom"] = "FROM `_t_search`";
$tdata_t_search[".sqlWhereExpr"] = "";
$tdata_t_search[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdata_t_search[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdata_t_search[".arrGroupsPerPage"] = $arrGPP;

$tableKeys_t_search = array();
$tableKeys_t_search[] = "searchid";
$tdata_t_search[".Keys"] = $tableKeys_t_search;

$tdata_t_search[".listFields"] = array();
$tdata_t_search[".listFields"][] = "searchid";
$tdata_t_search[".listFields"][] = "Username";
$tdata_t_search[".listFields"][] = "date";
$tdata_t_search[".listFields"][] = "Search_type";
$tdata_t_search[".listFields"][] = "Skill_type";
$tdata_t_search[".listFields"][] = "Skill_Subtype";
$tdata_t_search[".listFields"][] = "Gender";

$tdata_t_search[".viewFields"] = array();

$tdata_t_search[".addFields"] = array();

$tdata_t_search[".inlineAddFields"] = array();

$tdata_t_search[".editFields"] = array();

$tdata_t_search[".inlineEditFields"] = array();

$tdata_t_search[".exportFields"] = array();

$tdata_t_search[".printFields"] = array();

//	date
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "date";
	$fdata["GoodName"] = "date";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Date"; 
	$fdata["FieldType"] = 135;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "date"; 
		$fdata["FullName"] = "`date`";
	
		
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
	
		
		
	$tdata_t_search["date"] = $fdata;
//	searchid
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "searchid";
	$fdata["GoodName"] = "searchid";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Searchid"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "searchid"; 
		$fdata["FullName"] = "searchid";
	
		
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
	
		
		
	$tdata_t_search["searchid"] = $fdata;
//	Search_type
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "Search_type";
	$fdata["GoodName"] = "Search_type";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Search Type"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Search_type"; 
		$fdata["FullName"] = "Search_type";
	
		
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
	
		
		
	$tdata_t_search["Search_type"] = $fdata;
//	Username
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "Username";
	$fdata["GoodName"] = "Username";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Username"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Username"; 
		$fdata["FullName"] = "Username";
	
		
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
	
		
		
	$tdata_t_search["Username"] = $fdata;
//	Skill_type
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "Skill_type";
	$fdata["GoodName"] = "Skill_type";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Skill Type"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Skill_type"; 
		$fdata["FullName"] = "Skill_type";
	
		
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
	
		
		
	$tdata_t_search["Skill_type"] = $fdata;
//	Skill_Subtype
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "Skill_Subtype";
	$fdata["GoodName"] = "Skill_Subtype";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Skill Subtype"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Skill_Subtype"; 
		$fdata["FullName"] = "Skill_Subtype";
	
		
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
	
		
		
	$tdata_t_search["Skill_Subtype"] = $fdata;
//	Gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "Gender";
	$fdata["GoodName"] = "Gender";
	$fdata["ownerTable"] = "_t_search";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "Gender"; 
		$fdata["FullName"] = "Gender";
	
		
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
	
		
		
	$tdata_t_search["Gender"] = $fdata;

	
$tables_data["_t_search"]=&$tdata_t_search;
$field_labels["_t_search"] = &$fieldLabels_t_search;
$fieldToolTips["_t_search"] = &$fieldToolTips_t_search;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["_t_search"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["_t_search"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery__t_search()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "`date`,  searchid,  Search_type,  Username,  Skill_type,  Skill_Subtype,  Gender";
$proto0["m_strFrom"] = "FROM `_t_search`";
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
	"m_strName" => "date",
	"m_strTable" => "_t_search"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "searchid",
	"m_strTable" => "_t_search"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "Search_type",
	"m_strTable" => "_t_search"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "Username",
	"m_strTable" => "_t_search"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "Skill_type",
	"m_strTable" => "_t_search"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "Skill_Subtype",
	"m_strTable" => "_t_search"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "Gender",
	"m_strTable" => "_t_search"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto19=array();
$proto19["m_link"] = "SQLL_MAIN";
			$proto20=array();
$proto20["m_strName"] = "_t_search";
$proto20["m_columns"] = array();
$proto20["m_columns"][] = "date";
$proto20["m_columns"][] = "searchid";
$proto20["m_columns"][] = "Search_type";
$proto20["m_columns"][] = "Username";
$proto20["m_columns"][] = "Skill_type";
$proto20["m_columns"][] = "Skill_Subtype";
$proto20["m_columns"][] = "Gender";
$proto20["m_columns"][] = "CreatedByPHPRunner";
$proto20["m_columns"][] = "ke";
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
$queryData__t_search = createSqlQuery__t_search();
							$tdata_t_search[".sqlquery"] = $queryData__t_search;
	
if(isset($tdata_t_search["field2"])){
	$tdata_t_search["field2"]["LookupTable"] = "carscars_view";
	$tdata_t_search["field2"]["LookupOrderBy"] = "name";
	$tdata_t_search["field2"]["LookupType"] = 4;
	$tdata_t_search["field2"]["LinkField"] = "email";
	$tdata_t_search["field2"]["DisplayField"] = "name";
	$tdata_t_search[".hasCustomViewField"] = true;
}

$tableEvents["_t_search"] = new eventsBase;
$tdata_t_search[".hasEvents"] = false;

$cipherer = new RunnerCipherer("_t_search");

?>