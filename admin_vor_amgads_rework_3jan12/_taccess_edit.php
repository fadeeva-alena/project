<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_taccess_variables.php");


//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Edit"))
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
$readevalues=false;


$showKeys = array();
$showValues = array();
$showRawValues = array();
$showFields = array();
$showDetailKeys = array();
$IsSaved = false;
$HaveData = true;
$inlineedit = (@$_REQUEST["editType"]=="inline") ? true : false;
$templatefile = ( $inlineedit ) ? "_taccess_inline_edit.htm" : "_taccess_edit.htm";

//connect database
$conn = db_connect();

//	Before Process event
if(function_exists("BeforeProcessEdit"))
	BeforeProcessEdit($conn);

$keys=array();
$keys["ID"]=postvalue("editid1");

//	prepare data for saving
if(@$_POST["a"]=="edited")
{
	$strWhereClause=KeyWhere($keys);
	$strSQL = "update ".AddTableWrappers($strOriginalTableName)." set ";
	$evalues=array();
	$efilename_values=array();
	$files_delete=array();
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


		$evalues["Country"]=$value;
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


		$evalues["Zip"]=$value;
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


		$evalues["Location"]=$value;
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


		$evalues["Start"]=$value;
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


		$evalues["End"]=$value;
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


		$evalues["Note"]=$value;
	}


//	processibng Note - end

	foreach($efilename_values as $ekey=>$value)
		$evalues[$ekey]=$value;
//	do event
	$retval=true;
	if(function_exists("BeforeEdit"))
		$retval=BeforeEdit($evalues,$strWhereClause,$dataold,$keys,$usermessage,$inlineedit);
	if($retval)
	{		
//	construct SQL string
		foreach($evalues as $ekey=>$value)
		{
			$strSQL.=AddFieldWrappers($ekey)."=".add_db_quotes($ekey,$value).", ";
		}
		if(substr($strSQL,-2)==", ")
			$strSQL=substr($strSQL,0,strlen($strSQL)-2);
		$strSQL.=" where ".$strWhereClause;
		set_error_handler("edit_error_handler");
		db_exec($strSQL,$conn);
		set_error_handler("error_handler");
		if(!$error_happened)
		{
//	delete & move files
			foreach ($files_delete as $file)
			{
				if(file_exists($file))
					@unlink($file);
			}
			foreach ($files_move as $file)
			{
				move_uploaded_file($file[0],$file[1]);
				if(strtoupper(substr(PHP_OS,0,3))!="WIN")
					@chmod($file[1],0777);
			}
			if ( $inlineedit ) 
			{
				$status="UPDATED";
				$message=""."Record updated"."";
				$IsSaved = true;
			} 
			else 
				$message="<div class=message><<< "."Record updated"." >>></div>";
			if($usermessage!="")
				$message = $usermessage;
//	after edit event
			if(function_exists("AfterEdit"))
			{
				foreach($dataold as $idx=>$val)
				{
					if(!array_key_exists($idx,$evalues))
						$evalues[$idx]=$val;
				}
				AfterEdit($evalues,KeyWhere($keys),$dataold,$keys,$inlineedit);
			}
		}
	}
	else
	{
		$readevalues=true;
		$message = $usermessage;
		$status="DECLINED";
	}
}

//	get current values and show edit controls

//$strSQL = $gstrSQL;

$strWhereClause=KeyWhere($keys);

$strSQL=gSQLWhere($strWhereClause);

$strSQLbak = $strSQL;
//	Before Query event
if(function_exists("BeforeQueryEdit"))
	BeforeQueryEdit($strSQL,$strWhereClause);

if($strSQLbak == $strSQL)
	$strSQL=gSQLWhere($strWhereClause);
LogInfo($strSQL);
$rs=db_query($strSQL,$conn);
$data=db_fetch_array($rs);

if($readevalues)
{
	$data["Country"]=$evalues["Country"];
	$data["Zip"]=$evalues["Zip"];
	$data["Location"]=$evalues["Location"];
	$data["Start"]=$evalues["Start"];
	$data["End"]=$evalues["End"];
	$data["Note"]=$evalues["Note"];
}

include('libs/Smarty.class.php');
$smarty = new Smarty();

if ( !$inlineedit ) {
	//	include files
	$includes="";

	//	validation stuff
	$bodyonload="";
	$onsubmit="";
		$includes.="<script language=\"JavaScript\" src=\"include/validate.js\"></script>\r\n";
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
		  		$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
			$bodyonload.="define('value_Country','".$validatetype."','Country');";
				$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
			$bodyonload.="define('value_Zip','".$validatetype."','Zip');";
				$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
			$bodyonload.="define('value_Location','".$validatetype."','Location');";
				$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
			$bodyonload.="define('value_Start','".$validatetype."','Start');";
				$validatetype="";
			$validatetype.="IsRequired";
		if($validatetype)
			$bodyonload.="define('value_End','".$validatetype."','End');";

	if($bodyonload)
	{
		$onsubmit="return validate();";
		$bodyonload="onload=\"".$bodyonload."\"";
	}

	$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>\r\n";
	$includes.="<script language=\"JavaScript\" src=\"include/onthefly.js\"></script>\r\n";
	if ($useAJAX) {
	$includes.="<script language=\"JavaScript\" src=\"include/ajaxsuggest.js\"></script>\r\n";
	}
	$includes.="<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
	$includes.="<script language=\"JavaScript\">\r\n";
	$includes .= "var locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
	"var locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
	"var bLoading=false;\r\n".
	"var TEXT_PLEASE_SELECT='".addslashes("Please select")."';\r\n";
	if ($useAJAX) {
	$includes.="var SUGGEST_TABLE='_taccess_searchsuggest.php';\r\n";
	}
	$includes.="</script>\r\n";

	if ($useAJAX)
		$includes.="<div id=\"search_suggest\"></div>\r\n";

		//	include datepicker files
	$includes.="<script language=\"JavaScript\" src=\"include/calendar.js\"></script>\r\n";
	



	$smarty->assign("includes",$includes);
	$smarty->assign("bodyonload",$bodyonload);
	if(strlen($onsubmit))
		$onsubmit="onSubmit=\"".$onsubmit."\"";
	$smarty->assign("onsubmit",$onsubmit);
}

$smarty->assign("key1",htmlspecialchars($keys["ID"]));
$showKeys[] = rawurlencode($keys["ID"]);
	$smarty->assign("show_key1", htmlspecialchars(GetData($data,"ID", "")));

$smarty->assign("message",$message);

$readonlyfields=array();

$data["Country"] = "Schweiz";
$smarty->assign("value_Country",@$data["Country"]);
$smarty->assign("value_Zip",@$data["Zip"]);
$smarty->assign("value_Location",@$data["Location"]);
$smarty->assign("value_Start",@$data["Start"]);
$smarty->assign("value_End",@$data["End"]);
$smarty->assign("value_Note",@$data["Note"]);


$linkdata="";

if ($useAJAX) 
{
	$record_id= postvalue("recordID");
		$output = loadSelectContent("Location",$data["Zip"],$data["Location"]);
		$txt = ""; 
		foreach( $output as $value ) {
			$txt .= jsreplace($value)."\\n";
		}
			$linkdata .= "preloadSelectContent('".$txt."', 'value_Location', '".jsreplace($data["Location"])."','".$record_id."');\r\n";

	if ( $inlineedit ) 
	{
		if(@$_REQUEST["browser"]=="ie")
			$smarty->assign("browserie",true);
		$smarty->assign("id",$record_id);

		$linkdata=str_replace(array("&","<",">"),array("&amp;","&lt;","&gt;"),$linkdata);


	} 
	else
	{
		$linkdata = "<script type=\"text/javascript\">\r\n".
		"$(document).ready(function(){ \r\n".
		$linkdata.
		"});</script>";
	}
	
} else {
	//	Location - Zip
	$linkdata.="<script language=\"Javascript\">";
	$linkdata.="bLoading = true;";
	$linkdata.="SetSelection('value_Zip', 'value_Location', '".jsreplace(@$data["Zip"])."', '".jsreplace($data["Location"])."', arr_Location);";
	$linkdata.="bLoading = false;";
	$linkdata.="</script>\r\n";
}

$smarty->assign("linkdata",$linkdata);

if ($_REQUEST["a"]=="edited" && $inlineedit ) 
{
	if(!$data)
	{
		$data=$evalues;
		$HaveData=false;
	}
	//Preparation   view values

//	detail tables

	$keylink="";
	$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["ID"]));

	////////////////////////////////////////////
	//	Country - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Country", ""),"","",MODE_LIST);
		$smarty->assign("show_Country",$value);
		$showValues[] = $value;
		$showFields[] = "Country";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Zip - 
		$value="";
		/*
		if(strlen($data["Zip"]))
		{
			$strdata = make_db_value("Zip",$data["Zip"]);
			$LookupSQL="SELECT ";
							$LookupSQL.="`ZIP`";
			$LookupSQL.=" FROM `t_zipch` WHERE `ZIP` = " . $strdata;
							LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$data["Zip"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
						$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"Zip", ""),"field=Zip".$keylink,"",MODE_LIST);
		}
		else
			$value="";
*/			
		$value=DisplayLookupWizard("Zip",$data["Zip"],$data,$keylink,MODE_LIST);
		$smarty->assign("show_Zip",$value);
		$showValues[] = $value;
		$showFields[] = "Zip";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Location - 
		$value="";
		/*
		if(strlen($data["Location"]))
		{
			$strdata = make_db_value("Location",$data["Location"]);
			$LookupSQL="SELECT ";
							$LookupSQL.="`Location`";
			$LookupSQL.=" FROM `t_zipch` WHERE `Location` = " . $strdata;
							LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$data["Location"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
						$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"Location", ""),"field=Location".$keylink,"",MODE_LIST);
		}
		else
			$value="";
*/			
		$value=DisplayLookupWizard("Location",$data["Location"],$data,$keylink,MODE_LIST);
		$smarty->assign("show_Location",$value);
		$showValues[] = $value;
		$showFields[] = "Location";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Start - Short Date
		$value="";
				$value = ProcessLargeText(GetData($data,"Start", "Short Date"),"","",MODE_LIST);
		$smarty->assign("show_Start",$value);
		$showValues[] = $value;
		$showFields[] = "Start";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	End - Short Date
		$value="";
				$value = ProcessLargeText(GetData($data,"End", "Short Date"),"","",MODE_LIST);
		$smarty->assign("show_End",$value);
		$showValues[] = $value;
		$showFields[] = "End";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Note - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Note", ""),"","",MODE_LIST);
		$smarty->assign("show_Note",$value);
		$showValues[] = $value;
		$showFields[] = "Note";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	ID - 
		$value="";
				$value = ProcessLargeText(GetData($data,"ID", ""),"","",MODE_LIST);
		$smarty->assign("show_ID",$value);
		$showValues[] = $value;
		$showFields[] = "ID";
				$showRawValues[] = "";
}

if ( $_REQUEST["a"]=="edited" && $inlineedit ) 
{
	echo "<textarea id=\"data\">";
	if($IsSaved)
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
	if(function_exists("BeforeShowEdit"))
		BeforeShowEdit($smarty,$templatefile);
	$smarty->display($templatefile);
}

function edit_error_handler($errno, $errstr, $errfile, $errline)
{
	global $readevalues, $message, $status, $inlineedit, $error_happened;
	if ( $inlineedit ) 
		$message=""."Record was NOT edited".". ".$errstr;
	else  
		$message="<div class=message><<< "."Record was NOT edited"." >>><br><br>".$errstr."</div>";
	$readevalues=true;
	$error_happened=true;
}

?>