<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");

##if @BUILDER.m_bCreateLoginPage##
if(!@$_SESSION["UserID"])
{
	header("Location: login.php");
	return;
}
##endif##

##if @BUILDER.arrLanguages.len>1##
include("include/languages.php");
##endif##

include('libs/Smarty.class.php');
$smarty = new Smarty();

$conn=db_connect();


$strPerm = GetUserPermissions("##@t.strDataSourceTable s##");
if(!$_SESSION["IsAdmin"])
{
	echo "<p>".##message NO_PERMISSIONS##." <a href=\"login.php\">".##message BACK_TO_LOGIN##."</a></p>";
	return;
}

$defaulturl="";
##if CreateMenu##
		$defaulturl="menu.php";
##else##
	##foreach @BUILDER.Tables as @t filter @t.bMenuItem order @t.nMenuOrder##
		##if @first##
		##if @t.bList##
		$defaulturl="##@t.strShortTableName##_list.php";
		##elseif @t.nType==titREPORT##
		$defaulturl="##@t.strShortTableName##_report.php";
		##elseif @t.nType==titCHART##
		$defaulturl="##@t.strShortTableName##_chart.php";
		##else##
		$defaulturl="##@t.strShortTableName##_add.php";
		##endif##
		##endif##
	##endfor##
##endif##			
##if !@BUILDER.Tables[bMenuItem].len##
	##if @BUILDER.Tables.bList##
		$defaulturl="##@BUILDER.Tables.strShortTableName##_list.php";
	##elseif @t.nType==titREPORT##
		$defaulturl="##@BUILDER.Tables.strShortTableName##_report.php";
	##elseif @t.nType==titCHART##
		$defaulturl="##@BUILDER.Tables.strShortTableName##_chart.php";
	##else##
		$defaulturl="##@BUILDER.Tables.strShortTableName##_add.php";
	##endif##
##endif##

$smarty->assign("url",$defaulturl);

$templatefile="admin.htm";

$smarty->display($templatefile);
?>