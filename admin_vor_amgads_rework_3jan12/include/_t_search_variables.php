<?php

$strTableName="_t_search";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="_t_search";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT `date`,  searchid,  Search_type,  Username,  Skill_type,  Skill_Subtype,  Gender ";
$gsqlFrom="FROM `_t_search` ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  `date`,  searchid,  Search_type,  Username,  Skill_type,  Skill_Subtype,  Gender  FROM `_t_search`  ";
$gstrSQL = gSQLWhere("");

include("_t_search_settings.php");
include("_t_search_events.php");
?>