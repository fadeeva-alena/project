<?php

$strTableName="_taccess";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="_taccess";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT Country,  Zip,  Location,  `Start`,  `End`,  Note,  ID ";
$gsqlFrom="FROM `_taccess` ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  Country,  Zip,  Location,  `Start`,  `End`,  Note,  ID  FROM `_taccess`  ";
$gstrSQL = gSQLWhere("");

include("_taccess_settings.php");
include("_taccess_events.php");
?>