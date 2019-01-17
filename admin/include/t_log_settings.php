<?php
require_once(getabspath("classes/cipherer.php"));
$tdatat_log = array();
	$tdatat_log[".NumberOfChars"] = 80; 
	$tdatat_log[".ShortName"] = "t_log";
	$tdatat_log[".OwnerID"] = "";
	$tdatat_log[".OriginalTable"] = "t_log";

//	field labels
$fieldLabelst_log = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelst_log["English"] = array();
	$fieldToolTipst_log["English"] = array();
	$fieldLabelst_log["English"]["log_id"] = "Log Id";
	$fieldToolTipst_log["English"]["log_id"] = "";
	$fieldLabelst_log["English"]["person_id"] = "Person Id";
	$fieldToolTipst_log["English"]["person_id"] = "";
	$fieldLabelst_log["English"]["User_Name"] = "User Name";
	$fieldToolTipst_log["English"]["User_Name"] = "";
	$fieldLabelst_log["English"]["login_date"] = "Login Date";
	$fieldToolTipst_log["English"]["login_date"] = "";
	$fieldLabelst_log["English"]["logout_date"] = "Logout Date";
	$fieldToolTipst_log["English"]["logout_date"] = "";
	$fieldLabelst_log["English"]["login_from"] = "Login From";
	$fieldToolTipst_log["English"]["login_from"] = "";
	if (count($fieldToolTipst_log["English"]))
		$tdatat_log[".isUseToolTips"] = true;
}
	
	



$tdatat_log[".shortTableName"] = "t_log";
$tdatat_log[".nSecOptions"] = 0;
$tdatat_log[".recsPerRowList"] = 1;
$tdatat_log[".mainTableOwnerID"] = "";
$tdatat_log[".moveNext"] = 1;
$tdatat_log[".nType"] = 0;

$tdatat_log[".strOriginalTableName"] = "t_log";




$tdatat_log[".showAddInPopup"] = false;

$tdatat_log[".showEditInPopup"] = false;

$tdatat_log[".showViewInPopup"] = false;

$tdatat_log[".fieldsForRegister"] = array();

$tdatat_log[".listAjax"] = false;

	$tdatat_log[".audit"] = false;

	$tdatat_log[".locking"] = false;

$tdatat_log[".listIcons"] = true;
$tdatat_log[".view"] = true;




$tdatat_log[".showSimpleSearchOptions"] = false;

$tdatat_log[".showSearchPanel"] = true;

if (isMobile())
	$tdatat_log[".isUseAjaxSuggest"] = false;
else 
	$tdatat_log[".isUseAjaxSuggest"] = true;

$tdatat_log[".rowHighlite"] = true;

// button handlers file names

$tdatat_log[".addPageEvents"] = false;

// use timepicker for search panel
$tdatat_log[".isUseTimeForSearch"] = false;




$tdatat_log[".allSearchFields"] = array();

$tdatat_log[".allSearchFields"][] = "log_id";
$tdatat_log[".allSearchFields"][] = "person_id";
$tdatat_log[".allSearchFields"][] = "User_Name";
$tdatat_log[".allSearchFields"][] = "login_date";
$tdatat_log[".allSearchFields"][] = "logout_date";
$tdatat_log[".allSearchFields"][] = "login_from";

$tdatat_log[".googleLikeFields"][] = "log_id";
$tdatat_log[".googleLikeFields"][] = "person_id";
$tdatat_log[".googleLikeFields"][] = "User_Name";
$tdatat_log[".googleLikeFields"][] = "login_date";
$tdatat_log[".googleLikeFields"][] = "logout_date";
$tdatat_log[".googleLikeFields"][] = "login_from";

$tdatat_log[".panelSearchFields"][] = "log_id";
$tdatat_log[".panelSearchFields"][] = "person_id";
$tdatat_log[".panelSearchFields"][] = "User_Name";
$tdatat_log[".panelSearchFields"][] = "login_date";
$tdatat_log[".panelSearchFields"][] = "logout_date";
$tdatat_log[".panelSearchFields"][] = "login_from";

$tdatat_log[".advSearchFields"][] = "log_id";
$tdatat_log[".advSearchFields"][] = "person_id";
$tdatat_log[".advSearchFields"][] = "User_Name";
$tdatat_log[".advSearchFields"][] = "login_date";
$tdatat_log[".advSearchFields"][] = "logout_date";
$tdatat_log[".advSearchFields"][] = "login_from";

$tdatat_log[".isTableType"] = "list";

	

$tdatat_log[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdatat_log[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatat_log[".strOrderBy"] = $tstrOrderBy;

$tdatat_log[".orderindexes"] = array();

$tdatat_log[".sqlHead"] = "SELECT log_id,  person_id,  User_Name,  login_date,  logout_date,  login_from";
$tdatat_log[".sqlFrom"] = "FROM t_log";
$tdatat_log[".sqlWhereExpr"] = "";
$tdatat_log[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatat_log[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatat_log[".arrGroupsPerPage"] = $arrGPP;

$tableKeyst_log = array();
$tableKeyst_log[] = "log_id";
$tdatat_log[".Keys"] = $tableKeyst_log;

$tdatat_log[".listFields"] = array();
$tdatat_log[".listFields"][] = "log_id";
$tdatat_log[".listFields"][] = "person_id";
$tdatat_log[".listFields"][] = "User_Name";
$tdatat_log[".listFields"][] = "login_date";
$tdatat_log[".listFields"][] = "logout_date";
$tdatat_log[".listFields"][] = "login_from";

$tdatat_log[".viewFields"] = array();
$tdatat_log[".viewFields"][] = "log_id";
$tdatat_log[".viewFields"][] = "person_id";
$tdatat_log[".viewFields"][] = "User_Name";
$tdatat_log[".viewFields"][] = "login_date";
$tdatat_log[".viewFields"][] = "logout_date";
$tdatat_log[".viewFields"][] = "login_from";

$tdatat_log[".addFields"] = array();

$tdatat_log[".inlineAddFields"] = array();

$tdatat_log[".editFields"] = array();

$tdatat_log[".inlineEditFields"] = array();

$tdatat_log[".exportFields"] = array();

$tdatat_log[".printFields"] = array();

//	log_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "log_id";
	$fdata["GoodName"] = "log_id";
	$fdata["ownerTable"] = "t_log";
	$fdata["Label"] = "Log Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "log_id"; 
		$fdata["FullName"] = "log_id";
	
		
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
	
		
		
	$tdatat_log["log_id"] = $fdata;
//	person_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "person_id";
	$fdata["GoodName"] = "person_id";
	$fdata["ownerTable"] = "t_log";
	$fdata["Label"] = "Person Id"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "person_id"; 
		$fdata["FullName"] = "person_id";
	
		
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
	
		
		
	$tdatat_log["person_id"] = $fdata;
//	User_Name
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "User_Name";
	$fdata["GoodName"] = "User_Name";
	$fdata["ownerTable"] = "t_log";
	$fdata["Label"] = "User Name"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "User_Name"; 
		$fdata["FullName"] = "User_Name";
	
		
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
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_log["User_Name"] = $fdata;
//	login_date
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "login_date";
	$fdata["GoodName"] = "login_date";
	$fdata["ownerTable"] = "t_log";
	$fdata["Label"] = "Login Date"; 
	$fdata["FieldType"] = 135;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "login_date"; 
		$fdata["FullName"] = "login_date";
	
		
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
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_log["login_date"] = $fdata;
//	logout_date
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "logout_date";
	$fdata["GoodName"] = "logout_date";
	$fdata["ownerTable"] = "t_log";
	$fdata["Label"] = "Logout Date"; 
	$fdata["FieldType"] = 135;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "logout_date"; 
		$fdata["FullName"] = "logout_date";
	
		
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
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_log["logout_date"] = $fdata;
//	login_from
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "login_from";
	$fdata["GoodName"] = "login_from";
	$fdata["ownerTable"] = "t_log";
	$fdata["Label"] = "Login From"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		
		
		$fdata["strField"] = "login_from"; 
		$fdata["FullName"] = "login_from";
	
		
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
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_log["login_from"] = $fdata;

	
$tables_data["t_log"]=&$tdatat_log;
$field_labels["t_log"] = &$fieldLabelst_log;
$fieldToolTips["t_log"] = &$fieldToolTipst_log;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["t_log"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["t_log"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_t_log()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "log_id,  person_id,  User_Name,  login_date,  logout_date,  login_from";
$proto0["m_strFrom"] = "FROM t_log";
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
	"m_strName" => "log_id",
	"m_strTable" => "t_log"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "person_id",
	"m_strTable" => "t_log"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "User_Name",
	"m_strTable" => "t_log"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "login_date",
	"m_strTable" => "t_log"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "logout_date",
	"m_strTable" => "t_log"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "login_from",
	"m_strTable" => "t_log"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto17=array();
$proto17["m_link"] = "SQLL_MAIN";
			$proto18=array();
$proto18["m_strName"] = "t_log";
$proto18["m_columns"] = array();
$proto18["m_columns"][] = "log_id";
$proto18["m_columns"][] = "person_id";
$proto18["m_columns"][] = "User_Name";
$proto18["m_columns"][] = "login_date";
$proto18["m_columns"][] = "logout_date";
$proto18["m_columns"][] = "login_from";
$obj = new SQLTable($proto18);

$proto17["m_table"] = $obj;
$proto17["m_alias"] = "";
$proto19=array();
$proto19["m_sql"] = "";
$proto19["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto19["m_column"]=$obj;
$proto19["m_contained"] = array();
$proto19["m_strCase"] = "";
$proto19["m_havingmode"] = "0";
$proto19["m_inBrackets"] = "0";
$proto19["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto19);

$proto17["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto17);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_t_log = createSqlQuery_t_log();
						$tdatat_log[".sqlquery"] = $queryData_t_log;
	
if(isset($tdatat_log["field2"])){
	$tdatat_log["field2"]["LookupTable"] = "carscars_view";
	$tdatat_log["field2"]["LookupOrderBy"] = "name";
	$tdatat_log["field2"]["LookupType"] = 4;
	$tdatat_log["field2"]["LinkField"] = "email";
	$tdatat_log["field2"]["DisplayField"] = "name";
	$tdatat_log[".hasCustomViewField"] = true;
}

$tableEvents["t_log"] = new eventsBase;
$tdatat_log[".hasEvents"] = false;

$cipherer = new RunnerCipherer("t_log");

?>