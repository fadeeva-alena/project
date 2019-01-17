<?php

$strTableName="t_skills";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="t_skills";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT t_skills.skill_id,  t_skills.people_id,  t_skills.skill_type_id,  t_skills.skill_subtype_id,  t_skills.skill_note,  t_skills.skill_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email ";
$gsqlFrom="FROM t_skills  INNER JOIN t_people ON t_skills.people_id = t_people.people_id ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  t_skills.skill_id,  t_skills.people_id,  t_skills.skill_type_id,  t_skills.skill_subtype_id,  t_skills.skill_note,  t_skills.skill_hourly,  t_people.prof_provider,  t_people.firstname,  t_people.lastname,  t_people.image_path,  t_people.street,  t_people.house_nr,  t_people.zip,  t_people.location,  t_people.locationarea,  t_people.tel_p,  t_people.tel_m,  t_people.email  FROM t_skills  INNER JOIN t_people ON t_skills.people_id = t_people.people_id  ";
$gstrSQL = gSQLWhere("");

include("t_skills_settings.php");
include("t_skills_events.php");
?>