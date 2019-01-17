<?php

$strTableName="t_needs";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="t_needs";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT t_needs.need_id,  t_needs.people_id,  t_needs.need_type_id,  t_needs.need_subtype_id,  t_needs.need_note,  t_needs.need_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email ";
$gsqlFrom="FROM t_needs  INNER JOIN t_people ON t_needs.people_id = t_people.people_id ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  t_needs.need_id,  t_needs.people_id,  t_needs.need_type_id,  t_needs.need_subtype_id,  t_needs.need_note,  t_needs.need_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email  FROM t_needs  INNER JOIN t_people ON t_needs.people_id = t_people.people_id  ";
$gstrSQL = gSQLWhere("");

include("t_needs_settings.php");
include("t_needs_events.php");
?>