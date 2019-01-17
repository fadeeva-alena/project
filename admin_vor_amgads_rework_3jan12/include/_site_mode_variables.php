<?php

$strTableName="_site_mode";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="_site_mode";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT Status,  Message,  `Mode`,  ID ";
$gsqlFrom="FROM `_site_mode` ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  Status,  Message,  `Mode`,  ID  FROM `_site_mode`  ";
$gstrSQL = gSQLWhere("");

include("_site_mode_settings.php");
include("_site_mode_events.php");
?>