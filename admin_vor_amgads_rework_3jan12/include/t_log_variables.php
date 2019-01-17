<?php

$strTableName="t_log";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="t_log";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT log_id,  person_id,  User_Name,  login_date,  logout_date,  login_from ";
$gsqlFrom="FROM t_log ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  log_id,  person_id,  User_Name,  login_date,  logout_date,  login_from  FROM t_log  ";
$gstrSQL = gSQLWhere("");

include("t_log_settings.php");
include("t_log_events.php");
?>