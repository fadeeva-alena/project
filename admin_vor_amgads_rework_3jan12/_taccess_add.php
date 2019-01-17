<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0); 

include("include/dbcommon.php");
include("include/_taccess_variables.php");


//	check if logged in

if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

$filename="";
$status="";
$message="";
$usermessage="";
$error_happened=false;
$readavalues=false;


$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
if(@$_REQUEST["editType"]=="inline")
	$inlineedit=ADD_INLINE;
elseif(@$_REQUEST["editType"]=="onthefly")
	$inlineedit=ADD_ONTHEFLY;
else
	$inlineedit=ADD_SIMPLE;
$keys=array();
if($inlineedit==ADD_INLINE)
	$templatefile = "_taccess_inline_add.htm";
else
	$templatefile = "_taccess_add.htm";

//connect database
$conn = db_connect();

//	Before Process event
if(function_exists("BeforeProcessAdd"))
	BeforeProcessAdd($conn);

include('libs/Smarty.class.php');
$smarty = new Smarty();

// insert new record if we have to

if(@$_POST["a"]=="added")
{
	$afilename_values=array();
	$avalues=array();
	$files_move=array();
//	processing Country - start
	$value = postvalue("value_Country");
	$type=postvalue("type_Country");
	if (in_assoc_array("type_Country",$_POST) || in_assoc_array("value_Country",$_POST) || in_assoc_array("value_Country",$_FILES))
	{
		$value=prepare_for_db("Country",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$avalues["Country"]=$value;
	}
//	processibng Country - end
//	processing Zip - start
	$value = postvalue("value_Zip");
	$type=postvalue("type_Zip");
	if (in_assoc_array("type_Zip",$_POST) || in_assoc_array("value_Zip",$_POST) || in_assoc_array("value_Zip",$_FILES))
	{
		$value=prepare_for_db("Zip",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$avalues["Zip"]=$value;
	}
//	processibng Zip - end
//	processing Location - start
	$value = postvalue("value_Location");
	$type=postvalue("type_Location");
	if (in_assoc_array("type_Location",$_POST) || in_assoc_array("value_Location",$_POST) || in_assoc_array("value_Location",$_FILES))
	{
		$value=prepare_for_db("Location",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$avalues["Location"]=$value;
	}
//	processibng Location - end
//	processing Start - start
	$value = postvalue("value_Start");
	$type=postvalue("type_Start");
	if (in_assoc_array("type_Start",$_POST) || in_assoc_array("value_Start",$_POST) || in_assoc_array("value_Start",$_FILES))
	{
		$value=prepare_for_db("Start",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$avalues["Start"]=$value;
	}
//	processibng Start - end
//	processing End - start
	$value = postvalue("value_End");
	$type=postvalue("type_End");
	if (in_assoc_array("type_End",$_POST) || in_assoc_array("value_End",$_POST) || in_assoc_array("value_End",$_FILES))
	{
		$value=prepare_for_db("End",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$avalues["End"]=$value;
	}
//	processibng End - end
//	processing Note - start
	$value = postvalue("value_Note");
	$type=postvalue("type_Note");
	if (in_assoc_array("type_Note",$_POST) || in_assoc_array("value_Note",$_POST) || in_assoc_array("value_Note",$_FILES))
	{
		$value=prepare_for_db("Note",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{


		$avalues["Note"]=$value;
	}
//	processibng Note - end





if($inlineedit==ADD_ONTHEFLY)
{
}


//	add filenames to values
	foreach($afilename_values as $akey=>$value)
		$avalues[$akey]=$value;
//	make SQL string
	$strSQL = "insert into ".AddTableWrappers($strOriginalTableName)." ";
	$strFields="(";
	$strValues="(";
	
//	before Add event
	$retval = true;
	if(function_exists("BeforeAdd"))
		$retval=BeforeAdd($avalues,$usermessage,$inlineedit);
	if($retval)
	{
		foreach($avalues as $akey=>$value)
		{
			$strFields.=AddFieldWrappers($akey).", ";
			$strValues.=add_db_quotes($akey,$value).", ";
		}
		if(substr($strFields,-2)==", ")
			$strFields=substr($strFields,0,strlen($strFields)-2);
		if(substr($strValues,-2)==", ")
			$strValues=substr($strValues,0,strlen($strValues)-2);
		$strSQL.=$strFields.") values ".$strValues.")";
		LogInfo($strSQL);
		set_error_handler("add_error_handler");
		db_exec($strSQL,$conn);
		set_error_handler("error_handler");
//	move files
		if(!$error_happened)
		{
			foreach ($files_move as $file)
			{
				move_uploaded_file($file[0],$file[1]);
				if(strtoupper(substr(PHP_OS,0,3))!="WIN")
					@chmod($file[1],0777);
			}
			if ( $inlineedit==ADD_INLINE ) 
			{
				$status="ADDED";
				$message=""."Record was added"."";
				$IsSaved = true;
			} 
			else
				$message="<div class=message><<< "."Record was added"." >>></div>";
			if($usermessage!="")
				$message = $usermessage;
if($inlineedit==ADD_INLINE || $inlineedit==ADD_ONTHEFLY || function_exists("AfterAdd"))
{

	$failed_inline_add = false;
						$keys["ID"]=mysql_insert_id($conn);
}	

//	after edit event
			if(function_exists("AfterAdd"))
			{
				foreach($keys as $idx=>$val)
					$avalues[$idx]=$val;
				AfterAdd($avalues,$keys,$inlineedit);
			}
		}
	}
	else
	{
		$message = $usermessage;
		$status="DECLINED";
		$readavalues=true;
	}
}

$defvalues=array();


//	copy record
if(array_key_exists("copyid1",$_REQUEST) || array_key_exists("editid1",$_REQUEST))
{
	$copykeys=array();
	if(array_key_exists("copyid1",$_REQUEST))
	{
		$copykeys["ID"]=postvalue("copyid1");
	}
	else
	{
		$copykeys["ID"]=postvalue("editid1");
	}
	$strWhere=KeyWhere($copykeys);
	$strSQL = gSQLWhere($strWhere);

	LogInfo($strSQL);
	$rs=db_query($strSQL,$conn);
	$defvalues=db_fetch_array($rs);
//	clear key fields
	$defvalues["ID"]="";
//call CopyOnLoad event
	if(function_exists("CopyOnLoad"))
		CopyOnLoad($defvalues,$strWhere);
}
else if(!count($defvalues))
{
	$defvalues["Country"]="Schweiz";
	$defvalues["Start"]=now();
	$defvalues["End"]=date('Y-m-d', strtotime("+365 days"));;
}
if($inlineedit==ADD_ONTHEFLY)
{
}
if($readavalues)
{
	$defvalues["Country"]=@$avalues["Country"];
	$defvalues["Zip"]=@$avalues["Zip"];
	$defvalues["Location"]=@$avalues["Location"];
	$defvalues["Start"]=@$avalues["Start"];
	$defvalues["End"]=@$avalues["End"];
	$defvalues["Note"]=@$avalues["Note"];
}

foreach($defvalues as $key=>$value)
	$smarty->assign("value_".GoodFieldName($key),$value);

$linkdata="";
$includes="";
$arr_includes=array();
	
if ( $inlineedit!=ADD_INLINE ) {
	//	include files

	//	validation stuff
	$bodyonload="";
	$onsubmit="";
	$needvalidate=false;
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<script language=\"JavaScript\" src=\"include/validate.js\"></script>\r\n";
	
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$includes.="<script language=\"JavaScript\">\r\n";
		$includes.="var TEXT_FIELDS_REQUIRED='".addslashes("The Following fields are Required")."';\r\n";
		$includes.="var TEXT_FIELDS_ZIPCODES='".addslashes("The Following fields must be valid Zipcodes")."';\r\n";
		$includes.="var TEXT_FIELDS_EMAILS='".addslashes("The Following fields must be valid Emails")."';\r\n";
		$includes.="var TEXT_FIELDS_NUMBERS='".addslashes("The Following fields must be Numbers")."';\r\n";
		$includes.="var TEXT_FIELDS_CURRENCY='".addslashes("The Following fields must be currency")."';\r\n";
		$includes.="var TEXT_FIELDS_PHONE='".addslashes("The Following fields must be Phone Numbers")."';\r\n";
		$includes.="var TEXT_FIELDS_PASSWORD1='".addslashes("The Following fields must be valid Passwords")."';\r\n";
		$includes.="var TEXT_FIELDS_PASSWORD2='".addslashes("should be at least 4 characters long")."';\r\n";
		$includes.="var TEXT_FIELDS_PASSWORD3='".addslashes("Cannot be 'password'")."';\r\n";
		$includes.="var TEXT_FIELDS_STATE='".addslashes("The Following fields must be State Names")."';\r\n";
		$includes.="var TEXT_FIELDS_SSN='".addslashes("The Following fields must be Social Security Numbers")."';\r\n";
		$includes.="var TEXT_FIELDS_DATE='".addslashes("The Following fields must be valid dates")."';\r\n";
		$includes.="var TEXT_FIELDS_TIME='".addslashes("The Following fields must be valid time in 24-hours format")."';\r\n";
		$includes.="var TEXT_FIELDS_CC='".addslashes("The Following fields must be valid Credit Card Numbers")."';\r\n";
		$includes.="var TEXT_FIELDS_SSN='".addslashes("The Following fields must be Social Security Numbers")."';\r\n";
		$includes.="</script>\r\n";
	}
	else
	{
		$includes.="var TEXT_INLINE_FIELD_REQUIRED='".jsreplace("Required field")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_ZIPCODE='".jsreplace("Field should be a valid zipcode")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_EMAIL='".jsreplace("Field should be a valid email address")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_NUMBER='".jsreplace("Field should be a valid number")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_CURRENCY='".jsreplace("Field should be a valid currency")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_PHONE='".jsreplace("Field should be a valid phone number")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_PASSWORD1='".jsreplace("Field can not be 'password'")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_PASSWORD2='".jsreplace("Field should be at least 4 characters long")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_STATE='".jsreplace("Field should be a valid US state name")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_SSN='".jsreplace("Field should be a valid Social Security Number")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_DATE='".jsreplace("Field should be a valid date")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_TIME='".jsreplace("Field should be a valid time in 24-hour format")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_CC='".jsreplace("Field should be a valid credit card number")."';\r\n";
		$includes.="var TEXT_INLINE_FIELD_SSN='".jsreplace("Field should be a valid Social Security Number")."';\r\n";
	}
		  		$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
				$linkdata.="define_fly('value_Country_".postvalue("id")."','".$validatetype."');";
			else
				$bodyonload.="define('value_Country','".$validatetype."','Country');";
			
		}
			$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
				$linkdata.="define_fly('value_Zip_".postvalue("id")."','".$validatetype."');";
			else
				$bodyonload.="define('value_Zip','".$validatetype."','Zip');";
			
		}
			$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
				$linkdata.="define_fly('value_Location_".postvalue("id")."','".$validatetype."');";
			else
				$bodyonload.="define('value_Location','".$validatetype."','Location');";
			
		}
			$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
				$linkdata.="define_fly('value_Start_".postvalue("id")."','".$validatetype."');";
			else
				$bodyonload.="define('value_Start','".$validatetype."','Start');";
			
		}
			$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
		{
			$needvalidate=true;
			if($inlineedit==ADD_ONTHEFLY)
				$linkdata.="define_fly('value_End_".postvalue("id")."','".$validatetype."');";
			else
				$bodyonload.="define('value_End','".$validatetype."','End');";
			
		}

	if($needvalidate)
	{
		if($inlineedit==ADD_ONTHEFLY)
			$onsubmit="return validate_fly(this);";
		else
			$onsubmit="return validate();";
		$bodyonload="onload=\"".$bodyonload."\"";
	}

	if($inlineedit!=ADD_ONTHEFLY)
	{
		$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
		$includes.="<script language=\"JavaScript\" src=\"include/onthefly.js\"></script>\r\n";
		if ($useAJAX) 
			$includes.="<script language=\"JavaScript\" src=\"include/ajaxsuggest.js\"></script>\r\n";
		$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	}
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$includes.="<script language=\"JavaScript\">\r\n";
	}
	$includes.="var locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
	"var locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
	"var bLoading=false;\r\n".
	"var TEXT_PLEASE_SELECT='".addslashes("Please select")."';\r\n";
	if ($useAJAX) {
	$includes.="var SUGGEST_TABLE='_taccess_searchsuggest.php';\r\n";
	}
	if($inlineedit!=ADD_ONTHEFLY)
	{
		$includes.="</script>\r\n";
		if ($useAJAX)
			$includes.="<div id=\"search_suggest\"></div>\r\n";
	}
		//	include datepicker files
	if($inlineedit!=ADD_ONTHEFLY)
		$includes.="<script language=\"JavaScript\" src=\"include/calendar.js\"></script>\r\n";
	else
		$arr_includes[]="include/calendar.js";
	



	if($inlineedit!=ADD_ONTHEFLY)
		$smarty->assign("includes",$includes);
	$smarty->assign("bodyonload",$bodyonload);
	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$smarty->assign("onsubmit",$onsubmit);
}

$smarty->assign("message",$message);
$smarty->assign("status",$status);

$readonlyfields=array();

//	show readonly fields


if ($useAJAX) 
{
	$record_id= postvalue("recordID");
	if($inlineedit==ADD_ONTHEFLY)
		$record_id= postvalue("id");
		$output = loadSelectContent("Location",@$defvalues["Zip"],@$defvalues["Location"]);
		$txt = ""; 
		foreach( $output as $value ) 
		{
			$txt .= jsreplace($value)."\\n";
		}
		$linkdata .= "preloadSelectContent('".$txt."', 'value_Location', '".jsreplace(@$defvalues["Location"])."','".$record_id."');\r\n";

	if ( $inlineedit==ADD_INLINE ) 
	{
		if(@$_REQUEST["browser"]=="ie")
			$smarty->assign("browserie",true);
		$smarty->assign("id",$record_id);
		$linkdata=str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$linkdata);

	} 
	else 
	{
		if($inlineedit!=ADD_ONTHEFLY)
		{
			$linkdata = "<script type=\"text/javascript\">\r\n".
			"$(document).ready(function(){ \r\n".
			$linkdata.
			"});</script>";
		}
		else
		{
			$linkdata=$includes."\r\n".$linkdata;
			$includes="var s;";
			foreach($arr_includes as $file)
			{
				$includes.="s = document.createElement('script');s.src = '".$file."';\r\n".
				"document.getElementsByTagName('HEAD')[0].appendChild(s);\r\n";
			}			
			$linkdata=$includes."\r\n".$linkdata;

			if(!@$_POST["a"]=="added")
			{
				$linkdata = str_replace(array("\\","\r","\n"),array("\\\\","\\r","\\n"),$linkdata);
				echo $linkdata;
				echo "\n";
			}
			else if(@$_POST["a"]=="added" && ($error_happened || $status=="DECLINED"))
			{
				echo "<textarea id=\"data\">decli";
				echo htmlspecialchars($linkdata);
				echo "</textarea>";
			}

		}
	}
} 
else 
{
	//	Location - Zip
	$linkdata.="<script language=\"Javascript\">";
	$linkdata.="bLoading = true;";
	$linkdata.="SetSelection('value_Zip', 'value_Location', '".jsreplace(@$defvalues["Zip"])."', '".jsreplace(@$defvalues["Location"])."', arr_Location);";
	$linkdata.="bLoading = false;";
	$linkdata.="</script>";
}

if($inlineedit!=ADD_ONTHEFLY)
	$smarty->assign("linkdata",$linkdata);

$formname="name=\"editform\"";
if($inlineedit==ADD_ONTHEFLY)
{
	$formname="name=\"editform".postvalue("id")."\"";
	$smarty->assign("onthefly",true);
	$smarty->assign("flytable",postvalue("table"));
	$smarty->assign("flyfield",postvalue("field"));
	$smarty->assign("flycategory",postvalue("category"));
 	$smarty->assign("cancelonclick","onclick=\"RemoveFlyDiv('".substr(postvalue("id"),3)."');\"");
	$smarty->assign("flyid",postvalue("id"));
}
else
	$smarty->assign("onthefly",false);
$smarty->assign("formname",$formname);


if(@$_POST["a"]=="added" && $inlineedit==ADD_ONTHEFLY && !$error_happened && $status!="DECLINED")
{
	$LookupSQL="";
	if($LookupSQL)
		$LookupSQL.=" from ".AddTableWrappers($strOriginalTableName);

	$data=0;
	if(count($keys) && $LookupSQL)
	{
		$where=KeyWhere($keys);
		$LookupSQL.=" where ".$where;
		$rs=db_query($LookupSQL,$conn);
		$data=db_fetch_numarray($rs);
	}
	if(!$data)
	{
		$data=array(@$avalues[$linkfield],@$avalues[$dispfield]);
	}
	echo "<textarea id=\"data\">";
	echo "added";
	print_inline_array($data);
	echo "</textarea>";
	return;
}


if ( @$_POST["a"]=="added" && $inlineedit==ADD_INLINE ) {
	//Preparation   view values

	//	get current values and show edit controls

	$data=0;
	if(count($keys))
	{

		$where=KeyWhere($keys);
			$strSQL = gSQLWhere($where);

		LogInfo($strSQL);

		$rs=db_query($strSQL,$conn);
		$data=db_fetch_array($rs);
	}
	if(!$data)
	{
		$data=$avalues;
		$HaveData=false;
	}

	//check if correct values added

	
	
	$smarty->assign("key1",htmlspecialchars($keys["ID"]));
	$showKeys[] = htmlspecialchars($keys["ID"]);

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["ID"]));

	////////////////////////////////////////////
	//	Country - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Country", ""),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Country";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Zip - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Zip", ""),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Zip";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Location - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Location", ""),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Location";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Start - Short Date
		$value="";
				$value = ProcessLargeText(GetData($data,"Start", "Short Date"),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Start";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	End - Short Date
		$value="";
				$value = ProcessLargeText(GetData($data,"End", "Short Date"),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "End";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Note - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Note", ""),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "Note";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	ID - 
		$value="";
				$value = ProcessLargeText(GetData($data,"ID", ""),"","",MODE_LIST);
		$showValues[] = $value;
		$showFields[] = "ID";
				$showRawValues[] = "";
}

if ( @$_POST["a"]=="added" && $inlineedit==ADD_INLINE ) 
{
	echo "<textarea id=\"data\">";
	if($IsSaved && count($showValues))
	{
		if($HaveData)
			echo "saved";
		else
			echo "savnd";
		print_inline_array($showKeys);
		echo "\n";
		print_inline_array($showValues);
		echo "\n";
		print_inline_array($showFields);
		echo "\n";
		print_inline_array($showRawValues);
		echo "\n";
		print_inline_array($showDetailKeys,true);
		echo "\n";
		print_inline_array($showDetailKeys);
		echo "\n";
		echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$usermessage);
	}
	else
	{
		if($status=="DECLINED")
			echo "decli";
		else
			echo "error";
		echo str_replace(array("&","<","\\","\r","\n"),array("&amp;","&lt;","\\\\","\\r","\\n"),$message);
	}
	echo "</textarea>";
} 
else 
{
	if(function_exists("BeforeShowAdd"))
		BeforeShowAdd($smarty,$templatefile);

	$smarty->display($templatefile);
}
function add_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readavalues, $message, $status, $inlineedit, $error_happened;
	if ( $inlineedit!=ADD_SIMPLE ) 
		$message=""."Record was NOT added".". ".$errstr;
	else  
		$message="<div class=message><<< "."Record was NOT added"." >>><br><br>".$errstr."</div>";
	$readavalues=true;
	$error_happened=true;
}
?>
