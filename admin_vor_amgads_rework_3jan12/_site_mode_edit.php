<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_site_mode_variables.php");


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
$templatefile = ( $inlineedit ) ? "_site_mode_inline_edit.htm" : "_site_mode_edit.htm";

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
//	processing Status - start
	$value = postvalue("value_Status");
	$type=postvalue("type_Status");
	if (in_assoc_array("type_Status",$_POST) || in_assoc_array("value_Status",$_POST) || in_assoc_array("value_Status",$_FILES))	
	{
		$value=prepare_for_db("Status",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	


		$evalues["Status"]=$value;
	}


//	processibng Status - end
//	processing Message - start
	$value = postvalue("value_Message");
	$type=postvalue("type_Message");
	if (in_assoc_array("type_Message",$_POST) || in_assoc_array("value_Message",$_POST) || in_assoc_array("value_Message",$_FILES))	
	{
		$value=prepare_for_db("Message",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	


		$evalues["Message"]=$value;
	}


//	processibng Message - end
//	processing Mode - start
	$value = postvalue("value_Mode");
	$type=postvalue("type_Mode");
	if (in_assoc_array("type_Mode",$_POST) || in_assoc_array("value_Mode",$_POST) || in_assoc_array("value_Mode",$_FILES))	
	{
		$value=prepare_for_db("Mode",$value,$type);
	}
	else
		$value=false;
	if(!($value===false))
	{	


		$evalues["Mode"]=$value;
	}


//	processibng Mode - end

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
	$data["Status"]=$evalues["Status"];
	$data["Message"]=$evalues["Message"];
	$data["Mode"]=$evalues["Mode"];
}

include('libs/Smarty.class.php');
$smarty = new Smarty();

if ( !$inlineedit ) {
	//	include files
	$includes="";

	//	validation stuff
	$bodyonload="";
	$onsubmit="";

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
	$includes.="var SUGGEST_TABLE='_site_mode_searchsuggest.php';\r\n";
	}
	$includes.="</script>\r\n";

	if ($useAJAX)
		$includes.="<div id=\"search_suggest\"></div>\r\n";





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

$smarty->assign("value_Status",@$data["Status"]);
$smarty->assign("value_Message",@$data["Message"]);
$smarty->assign("value_Mode",@$data["Mode"]);


$linkdata="";

if ($useAJAX) 
{
	$record_id= postvalue("recordID");

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
	//	Status - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Status", ""),"","",MODE_LIST);
		$smarty->assign("show_Status",$value);
		$showValues[] = $value;
		$showFields[] = "Status";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Message - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Message", ""),"","",MODE_LIST);
		$smarty->assign("show_Message",$value);
		$showValues[] = $value;
		$showFields[] = "Message";
				$showRawValues[] = "";
	////////////////////////////////////////////
	//	Mode - 
		$value="";
				$value = ProcessLargeText(GetData($data,"Mode", ""),"","",MODE_LIST);
		$smarty->assign("show_Mode",$value);
		$showValues[] = $value;
		$showFields[] = "Mode";
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