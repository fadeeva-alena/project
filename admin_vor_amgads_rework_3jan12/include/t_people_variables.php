<?php

$strTableName="t_people";
$_SESSION["OwnerID"] = $_SESSION["_".$strTableName."_OwnerID"];

$strOriginalTableName="t_people";

$gPageSize=20;
$ColumnsCount		= 1;

$gstrOrderBy="";
if(strlen($gstrOrderBy) && strcasecmp(substr($gstrOrderBy,0,8),"order by"))
	$gstrOrderBy="order by ".$gstrOrderBy;
	
$gsqlHead="SELECT people_id,  institution,  prof_provider,  firstname,  lastname,  image_path,  street,  house_nr,  zip,  location,  locationarea,  tel_p,  tel_m,  email,  username,  password,  picture,  picture_2,  gender,  birthdate,  enabled,  temp_sched_from,  temp_sched_to,  joiningdate,  coord_accuracy,  monday,  tuesday,  wednesday,  thursday,  friday,  saturday,  sunday,  monday_t,  tuesday_t,  wednesday_t,  thursday_t,  friday_t,  saturday_t,  sunday_t,  preferred_contact_by,  date_last_adress_change,  map_in,  IconPath,  Icon,  note,  price_per_hour,  psych_time_loose_tight,  psych_exact_creativ,  psych_heart_thing,  psych_easy_security,  psych_conflict_take_leave,  longitude,  latitude,  Agree,  Sign_date,  Active,  Acode ";
$gsqlFrom="FROM t_people ";
$gsqlWhere="";
$gsqlTail="";
// $gstrSQL = "SELECT  people_id,  institution,  prof_provider,  firstname,  lastname,  image_path,  street,  house_nr,  zip,  location,  locationarea,  tel_p,  tel_m,  email,  username,  password,  picture,  picture_2,  gender,  birthdate,  enabled,  temp_sched_from,  temp_sched_to,  joiningdate,  coord_accuracy,  monday,  tuesday,  wednesday,  thursday,  friday,  saturday,  sunday,  monday_t,  tuesday_t,  wednesday_t,  thursday_t,  friday_t,  saturday_t,  sunday_t,  preferred_contact_by,  date_last_adress_change,  map_in,  IconPath,  Icon,  note,  price_per_hour,  psych_time_loose_tight,  psych_exact_creativ,  psych_heart_thing,  psych_easy_security,  psych_conflict_take_leave,  longitude,  latitude,  Agree,  Sign_date,  Active,  Acode  FROM t_people  ";
$gstrSQL = gSQLWhere("");

include("t_people_settings.php");
include("t_people_events.php");
?>
