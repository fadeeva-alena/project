<?php
require_once(getabspath("classes/cipherer.php"));
$tdatat_people = array();
	$tdatat_people[".NumberOfChars"] = 80; 
	$tdatat_people[".ShortName"] = "t_people";
	$tdatat_people[".OwnerID"] = "";
	$tdatat_people[".OriginalTable"] = "t_people";

//	field labels
$fieldLabelst_people = array();
if(mlang_getcurrentlang()=="English")
{
	$fieldLabelst_people["English"] = array();
	$fieldToolTipst_people["English"] = array();
	$fieldLabelst_people["English"]["people_id"] = "People Id";
	$fieldToolTipst_people["English"]["people_id"] = "";
	$fieldLabelst_people["English"]["institution"] = "Institution";
	$fieldToolTipst_people["English"]["institution"] = "";
	$fieldLabelst_people["English"]["prof_provider"] = "Prof Provider";
	$fieldToolTipst_people["English"]["prof_provider"] = "";
	$fieldLabelst_people["English"]["firstname"] = "Firstname";
	$fieldToolTipst_people["English"]["firstname"] = "";
	$fieldLabelst_people["English"]["lastname"] = "Lastname";
	$fieldToolTipst_people["English"]["lastname"] = "";
	$fieldLabelst_people["English"]["image_path"] = "Image Path";
	$fieldToolTipst_people["English"]["image_path"] = "";
	$fieldLabelst_people["English"]["street"] = "Street";
	$fieldToolTipst_people["English"]["street"] = "";
	$fieldLabelst_people["English"]["house_nr"] = "House Nr";
	$fieldToolTipst_people["English"]["house_nr"] = "";
	$fieldLabelst_people["English"]["zip"] = "Zip";
	$fieldToolTipst_people["English"]["zip"] = "";
	$fieldLabelst_people["English"]["location"] = "Location";
	$fieldToolTipst_people["English"]["location"] = "";
	$fieldLabelst_people["English"]["locationarea"] = "Locationarea";
	$fieldToolTipst_people["English"]["locationarea"] = "";
	$fieldLabelst_people["English"]["tel_p"] = "Tel P";
	$fieldToolTipst_people["English"]["tel_p"] = "";
	$fieldLabelst_people["English"]["tel_m"] = "Tel M";
	$fieldToolTipst_people["English"]["tel_m"] = "";
	$fieldLabelst_people["English"]["email"] = "Email";
	$fieldToolTipst_people["English"]["email"] = "";
	$fieldLabelst_people["English"]["username"] = "Username";
	$fieldToolTipst_people["English"]["username"] = "";
	$fieldLabelst_people["English"]["password"] = "Password";
	$fieldToolTipst_people["English"]["password"] = "";
	$fieldLabelst_people["English"]["picture"] = "Picture";
	$fieldToolTipst_people["English"]["picture"] = "";
	$fieldLabelst_people["English"]["picture_2"] = "Picture 2";
	$fieldToolTipst_people["English"]["picture_2"] = "";
	$fieldLabelst_people["English"]["gender"] = "Gender";
	$fieldToolTipst_people["English"]["gender"] = "";
	$fieldLabelst_people["English"]["birthdate"] = "Birthdate";
	$fieldToolTipst_people["English"]["birthdate"] = "";
	$fieldLabelst_people["English"]["enabled"] = "Enabled";
	$fieldToolTipst_people["English"]["enabled"] = "";
	$fieldLabelst_people["English"]["temp_sched_from"] = "Temp Sched From";
	$fieldToolTipst_people["English"]["temp_sched_from"] = "";
	$fieldLabelst_people["English"]["temp_sched_to"] = "Temp Sched To";
	$fieldToolTipst_people["English"]["temp_sched_to"] = "";
	$fieldLabelst_people["English"]["joiningdate"] = "Joiningdate";
	$fieldToolTipst_people["English"]["joiningdate"] = "";
	$fieldLabelst_people["English"]["coord_accuracy"] = "Coord Accuracy";
	$fieldToolTipst_people["English"]["coord_accuracy"] = "";
	$fieldLabelst_people["English"]["monday"] = "Monday";
	$fieldToolTipst_people["English"]["monday"] = "";
	$fieldLabelst_people["English"]["tuesday"] = "Tuesday";
	$fieldToolTipst_people["English"]["tuesday"] = "";
	$fieldLabelst_people["English"]["wednesday"] = "Wednesday";
	$fieldToolTipst_people["English"]["wednesday"] = "";
	$fieldLabelst_people["English"]["thursday"] = "Thursday";
	$fieldToolTipst_people["English"]["thursday"] = "";
	$fieldLabelst_people["English"]["friday"] = "Friday";
	$fieldToolTipst_people["English"]["friday"] = "";
	$fieldLabelst_people["English"]["saturday"] = "Saturday";
	$fieldToolTipst_people["English"]["saturday"] = "";
	$fieldLabelst_people["English"]["sunday"] = "Sunday";
	$fieldToolTipst_people["English"]["sunday"] = "";
	$fieldLabelst_people["English"]["monday_t"] = "Monday T";
	$fieldToolTipst_people["English"]["monday_t"] = "";
	$fieldLabelst_people["English"]["tuesday_t"] = "Tuesday T";
	$fieldToolTipst_people["English"]["tuesday_t"] = "";
	$fieldLabelst_people["English"]["wednesday_t"] = "Wednesday T";
	$fieldToolTipst_people["English"]["wednesday_t"] = "";
	$fieldLabelst_people["English"]["thursday_t"] = "Thursday T";
	$fieldToolTipst_people["English"]["thursday_t"] = "";
	$fieldLabelst_people["English"]["friday_t"] = "Friday T";
	$fieldToolTipst_people["English"]["friday_t"] = "";
	$fieldLabelst_people["English"]["saturday_t"] = "Saturday T";
	$fieldToolTipst_people["English"]["saturday_t"] = "";
	$fieldLabelst_people["English"]["sunday_t"] = "Sunday T";
	$fieldToolTipst_people["English"]["sunday_t"] = "";
	$fieldLabelst_people["English"]["preferred_contact_by"] = "Preferred Contact By";
	$fieldToolTipst_people["English"]["preferred_contact_by"] = "";
	$fieldLabelst_people["English"]["date_last_adress_change"] = "Date Last Adress Change";
	$fieldToolTipst_people["English"]["date_last_adress_change"] = "";
	$fieldLabelst_people["English"]["map_in"] = "Map In";
	$fieldToolTipst_people["English"]["map_in"] = "";
	$fieldLabelst_people["English"]["IconPath"] = "Icon Path";
	$fieldToolTipst_people["English"]["IconPath"] = "";
	$fieldLabelst_people["English"]["Icon"] = "Icon";
	$fieldToolTipst_people["English"]["Icon"] = "";
	$fieldLabelst_people["English"]["note"] = "Note";
	$fieldToolTipst_people["English"]["note"] = "";
	$fieldLabelst_people["English"]["price_per_hour"] = "Price Per Hour";
	$fieldToolTipst_people["English"]["price_per_hour"] = "";
	$fieldLabelst_people["English"]["psych_time_loose_tight"] = "Psych Time Loose Tight";
	$fieldToolTipst_people["English"]["psych_time_loose_tight"] = "";
	$fieldLabelst_people["English"]["psych_exact_creativ"] = "Psych Exact Creativ";
	$fieldToolTipst_people["English"]["psych_exact_creativ"] = "";
	$fieldLabelst_people["English"]["psych_heart_thing"] = "Psych Heart Thing";
	$fieldToolTipst_people["English"]["psych_heart_thing"] = "";
	$fieldLabelst_people["English"]["psych_easy_security"] = "Psych Easy Security";
	$fieldToolTipst_people["English"]["psych_easy_security"] = "";
	$fieldLabelst_people["English"]["psych_conflict_take_leave"] = "Psych Conflict Take Leave";
	$fieldToolTipst_people["English"]["psych_conflict_take_leave"] = "";
	$fieldLabelst_people["English"]["longitude"] = "Longitude";
	$fieldToolTipst_people["English"]["longitude"] = "";
	$fieldLabelst_people["English"]["latitude"] = "Latitude";
	$fieldToolTipst_people["English"]["latitude"] = "";
	$fieldLabelst_people["English"]["Agree"] = "Agree";
	$fieldToolTipst_people["English"]["Agree"] = "";
	$fieldLabelst_people["English"]["Sign_date"] = "Sign Date";
	$fieldToolTipst_people["English"]["Sign_date"] = "";
	$fieldLabelst_people["English"]["Active"] = "Active";
	$fieldToolTipst_people["English"]["Active"] = "";
	$fieldLabelst_people["English"]["Acode"] = "Acode";
	$fieldToolTipst_people["English"]["Acode"] = "";
	if (count($fieldToolTipst_people["English"]))
		$tdatat_people[".isUseToolTips"] = true;
}
	
	



$tdatat_people[".shortTableName"] = "t_people";
$tdatat_people[".nSecOptions"] = 0;
$tdatat_people[".recsPerRowList"] = 1;
$tdatat_people[".mainTableOwnerID"] = "";
$tdatat_people[".moveNext"] = 1;
$tdatat_people[".nType"] = 0;

$tdatat_people[".strOriginalTableName"] = "t_people";




$tdatat_people[".showAddInPopup"] = false;

$tdatat_people[".showEditInPopup"] = false;

$tdatat_people[".showViewInPopup"] = false;

$tdatat_people[".fieldsForRegister"] = array();

$tdatat_people[".listAjax"] = false;

	$tdatat_people[".audit"] = false;

	$tdatat_people[".locking"] = false;

$tdatat_people[".listIcons"] = true;
$tdatat_people[".view"] = true;

$tdatat_people[".exportTo"] = true;

$tdatat_people[".printFriendly"] = true;


$tdatat_people[".showSimpleSearchOptions"] = false;

$tdatat_people[".showSearchPanel"] = true;

if (isMobile())
	$tdatat_people[".isUseAjaxSuggest"] = false;
else 
	$tdatat_people[".isUseAjaxSuggest"] = true;

$tdatat_people[".rowHighlite"] = true;

// button handlers file names

$tdatat_people[".addPageEvents"] = false;

// use timepicker for search panel
$tdatat_people[".isUseTimeForSearch"] = false;




$tdatat_people[".allSearchFields"] = array();

$tdatat_people[".allSearchFields"][] = "people_id";
$tdatat_people[".allSearchFields"][] = "institution";
$tdatat_people[".allSearchFields"][] = "prof_provider";
$tdatat_people[".allSearchFields"][] = "firstname";
$tdatat_people[".allSearchFields"][] = "lastname";
$tdatat_people[".allSearchFields"][] = "image_path";
$tdatat_people[".allSearchFields"][] = "street";
$tdatat_people[".allSearchFields"][] = "house_nr";
$tdatat_people[".allSearchFields"][] = "zip";
$tdatat_people[".allSearchFields"][] = "location";
$tdatat_people[".allSearchFields"][] = "locationarea";
$tdatat_people[".allSearchFields"][] = "tel_p";
$tdatat_people[".allSearchFields"][] = "tel_m";
$tdatat_people[".allSearchFields"][] = "email";
$tdatat_people[".allSearchFields"][] = "username";
$tdatat_people[".allSearchFields"][] = "password";
$tdatat_people[".allSearchFields"][] = "picture";
$tdatat_people[".allSearchFields"][] = "gender";
$tdatat_people[".allSearchFields"][] = "birthdate";
$tdatat_people[".allSearchFields"][] = "enabled";
$tdatat_people[".allSearchFields"][] = "temp_sched_from";
$tdatat_people[".allSearchFields"][] = "temp_sched_to";
$tdatat_people[".allSearchFields"][] = "joiningdate";
$tdatat_people[".allSearchFields"][] = "coord_accuracy";
$tdatat_people[".allSearchFields"][] = "monday";
$tdatat_people[".allSearchFields"][] = "tuesday";
$tdatat_people[".allSearchFields"][] = "wednesday";
$tdatat_people[".allSearchFields"][] = "thursday";
$tdatat_people[".allSearchFields"][] = "friday";
$tdatat_people[".allSearchFields"][] = "saturday";
$tdatat_people[".allSearchFields"][] = "sunday";
$tdatat_people[".allSearchFields"][] = "monday_t";
$tdatat_people[".allSearchFields"][] = "tuesday_t";
$tdatat_people[".allSearchFields"][] = "wednesday_t";
$tdatat_people[".allSearchFields"][] = "thursday_t";
$tdatat_people[".allSearchFields"][] = "friday_t";
$tdatat_people[".allSearchFields"][] = "saturday_t";
$tdatat_people[".allSearchFields"][] = "sunday_t";
$tdatat_people[".allSearchFields"][] = "preferred_contact_by";
$tdatat_people[".allSearchFields"][] = "date_last_adress_change";
$tdatat_people[".allSearchFields"][] = "map_in";
$tdatat_people[".allSearchFields"][] = "IconPath";
$tdatat_people[".allSearchFields"][] = "note";
$tdatat_people[".allSearchFields"][] = "price_per_hour";
$tdatat_people[".allSearchFields"][] = "psych_time_loose_tight";
$tdatat_people[".allSearchFields"][] = "psych_exact_creativ";
$tdatat_people[".allSearchFields"][] = "psych_heart_thing";
$tdatat_people[".allSearchFields"][] = "psych_easy_security";
$tdatat_people[".allSearchFields"][] = "psych_conflict_take_leave";
$tdatat_people[".allSearchFields"][] = "longitude";
$tdatat_people[".allSearchFields"][] = "latitude";
$tdatat_people[".allSearchFields"][] = "Agree";
$tdatat_people[".allSearchFields"][] = "Sign_date";
$tdatat_people[".allSearchFields"][] = "Active";
$tdatat_people[".allSearchFields"][] = "Acode";

$tdatat_people[".googleLikeFields"][] = "people_id";
$tdatat_people[".googleLikeFields"][] = "institution";
$tdatat_people[".googleLikeFields"][] = "prof_provider";
$tdatat_people[".googleLikeFields"][] = "firstname";
$tdatat_people[".googleLikeFields"][] = "lastname";
$tdatat_people[".googleLikeFields"][] = "image_path";
$tdatat_people[".googleLikeFields"][] = "street";
$tdatat_people[".googleLikeFields"][] = "house_nr";
$tdatat_people[".googleLikeFields"][] = "zip";
$tdatat_people[".googleLikeFields"][] = "location";
$tdatat_people[".googleLikeFields"][] = "locationarea";
$tdatat_people[".googleLikeFields"][] = "tel_p";
$tdatat_people[".googleLikeFields"][] = "tel_m";
$tdatat_people[".googleLikeFields"][] = "email";
$tdatat_people[".googleLikeFields"][] = "username";
$tdatat_people[".googleLikeFields"][] = "password";
$tdatat_people[".googleLikeFields"][] = "picture";
$tdatat_people[".googleLikeFields"][] = "gender";
$tdatat_people[".googleLikeFields"][] = "birthdate";
$tdatat_people[".googleLikeFields"][] = "enabled";
$tdatat_people[".googleLikeFields"][] = "temp_sched_from";
$tdatat_people[".googleLikeFields"][] = "temp_sched_to";
$tdatat_people[".googleLikeFields"][] = "joiningdate";
$tdatat_people[".googleLikeFields"][] = "coord_accuracy";
$tdatat_people[".googleLikeFields"][] = "monday";
$tdatat_people[".googleLikeFields"][] = "tuesday";
$tdatat_people[".googleLikeFields"][] = "wednesday";
$tdatat_people[".googleLikeFields"][] = "thursday";
$tdatat_people[".googleLikeFields"][] = "friday";
$tdatat_people[".googleLikeFields"][] = "saturday";
$tdatat_people[".googleLikeFields"][] = "sunday";
$tdatat_people[".googleLikeFields"][] = "monday_t";
$tdatat_people[".googleLikeFields"][] = "tuesday_t";
$tdatat_people[".googleLikeFields"][] = "wednesday_t";
$tdatat_people[".googleLikeFields"][] = "thursday_t";
$tdatat_people[".googleLikeFields"][] = "friday_t";
$tdatat_people[".googleLikeFields"][] = "saturday_t";
$tdatat_people[".googleLikeFields"][] = "sunday_t";
$tdatat_people[".googleLikeFields"][] = "preferred_contact_by";
$tdatat_people[".googleLikeFields"][] = "date_last_adress_change";
$tdatat_people[".googleLikeFields"][] = "map_in";
$tdatat_people[".googleLikeFields"][] = "IconPath";
$tdatat_people[".googleLikeFields"][] = "note";
$tdatat_people[".googleLikeFields"][] = "price_per_hour";
$tdatat_people[".googleLikeFields"][] = "psych_time_loose_tight";
$tdatat_people[".googleLikeFields"][] = "psych_exact_creativ";
$tdatat_people[".googleLikeFields"][] = "psych_heart_thing";
$tdatat_people[".googleLikeFields"][] = "psych_easy_security";
$tdatat_people[".googleLikeFields"][] = "psych_conflict_take_leave";
$tdatat_people[".googleLikeFields"][] = "longitude";
$tdatat_people[".googleLikeFields"][] = "latitude";
$tdatat_people[".googleLikeFields"][] = "Agree";
$tdatat_people[".googleLikeFields"][] = "Sign_date";
$tdatat_people[".googleLikeFields"][] = "Active";
$tdatat_people[".googleLikeFields"][] = "Acode";

$tdatat_people[".panelSearchFields"][] = "people_id";
$tdatat_people[".panelSearchFields"][] = "institution";
$tdatat_people[".panelSearchFields"][] = "prof_provider";
$tdatat_people[".panelSearchFields"][] = "firstname";
$tdatat_people[".panelSearchFields"][] = "lastname";
$tdatat_people[".panelSearchFields"][] = "image_path";
$tdatat_people[".panelSearchFields"][] = "street";
$tdatat_people[".panelSearchFields"][] = "house_nr";
$tdatat_people[".panelSearchFields"][] = "zip";
$tdatat_people[".panelSearchFields"][] = "location";
$tdatat_people[".panelSearchFields"][] = "locationarea";
$tdatat_people[".panelSearchFields"][] = "tel_p";
$tdatat_people[".panelSearchFields"][] = "tel_m";
$tdatat_people[".panelSearchFields"][] = "email";
$tdatat_people[".panelSearchFields"][] = "username";
$tdatat_people[".panelSearchFields"][] = "password";
$tdatat_people[".panelSearchFields"][] = "picture";
$tdatat_people[".panelSearchFields"][] = "gender";
$tdatat_people[".panelSearchFields"][] = "birthdate";
$tdatat_people[".panelSearchFields"][] = "enabled";
$tdatat_people[".panelSearchFields"][] = "temp_sched_from";
$tdatat_people[".panelSearchFields"][] = "temp_sched_to";
$tdatat_people[".panelSearchFields"][] = "joiningdate";
$tdatat_people[".panelSearchFields"][] = "coord_accuracy";
$tdatat_people[".panelSearchFields"][] = "monday";
$tdatat_people[".panelSearchFields"][] = "tuesday";
$tdatat_people[".panelSearchFields"][] = "wednesday";
$tdatat_people[".panelSearchFields"][] = "thursday";
$tdatat_people[".panelSearchFields"][] = "friday";
$tdatat_people[".panelSearchFields"][] = "saturday";
$tdatat_people[".panelSearchFields"][] = "sunday";
$tdatat_people[".panelSearchFields"][] = "monday_t";
$tdatat_people[".panelSearchFields"][] = "tuesday_t";
$tdatat_people[".panelSearchFields"][] = "wednesday_t";
$tdatat_people[".panelSearchFields"][] = "thursday_t";
$tdatat_people[".panelSearchFields"][] = "friday_t";
$tdatat_people[".panelSearchFields"][] = "saturday_t";
$tdatat_people[".panelSearchFields"][] = "sunday_t";
$tdatat_people[".panelSearchFields"][] = "preferred_contact_by";
$tdatat_people[".panelSearchFields"][] = "date_last_adress_change";
$tdatat_people[".panelSearchFields"][] = "map_in";
$tdatat_people[".panelSearchFields"][] = "IconPath";
$tdatat_people[".panelSearchFields"][] = "note";
$tdatat_people[".panelSearchFields"][] = "price_per_hour";
$tdatat_people[".panelSearchFields"][] = "psych_time_loose_tight";
$tdatat_people[".panelSearchFields"][] = "psych_exact_creativ";
$tdatat_people[".panelSearchFields"][] = "psych_heart_thing";
$tdatat_people[".panelSearchFields"][] = "psych_easy_security";
$tdatat_people[".panelSearchFields"][] = "psych_conflict_take_leave";
$tdatat_people[".panelSearchFields"][] = "longitude";
$tdatat_people[".panelSearchFields"][] = "latitude";
$tdatat_people[".panelSearchFields"][] = "Agree";
$tdatat_people[".panelSearchFields"][] = "Sign_date";
$tdatat_people[".panelSearchFields"][] = "Active";
$tdatat_people[".panelSearchFields"][] = "Acode";

$tdatat_people[".advSearchFields"][] = "people_id";
$tdatat_people[".advSearchFields"][] = "institution";
$tdatat_people[".advSearchFields"][] = "prof_provider";
$tdatat_people[".advSearchFields"][] = "firstname";
$tdatat_people[".advSearchFields"][] = "lastname";
$tdatat_people[".advSearchFields"][] = "image_path";
$tdatat_people[".advSearchFields"][] = "street";
$tdatat_people[".advSearchFields"][] = "house_nr";
$tdatat_people[".advSearchFields"][] = "zip";
$tdatat_people[".advSearchFields"][] = "location";
$tdatat_people[".advSearchFields"][] = "locationarea";
$tdatat_people[".advSearchFields"][] = "tel_p";
$tdatat_people[".advSearchFields"][] = "tel_m";
$tdatat_people[".advSearchFields"][] = "email";
$tdatat_people[".advSearchFields"][] = "username";
$tdatat_people[".advSearchFields"][] = "password";
$tdatat_people[".advSearchFields"][] = "picture";
$tdatat_people[".advSearchFields"][] = "gender";
$tdatat_people[".advSearchFields"][] = "birthdate";
$tdatat_people[".advSearchFields"][] = "enabled";
$tdatat_people[".advSearchFields"][] = "temp_sched_from";
$tdatat_people[".advSearchFields"][] = "temp_sched_to";
$tdatat_people[".advSearchFields"][] = "joiningdate";
$tdatat_people[".advSearchFields"][] = "coord_accuracy";
$tdatat_people[".advSearchFields"][] = "monday";
$tdatat_people[".advSearchFields"][] = "tuesday";
$tdatat_people[".advSearchFields"][] = "wednesday";
$tdatat_people[".advSearchFields"][] = "thursday";
$tdatat_people[".advSearchFields"][] = "friday";
$tdatat_people[".advSearchFields"][] = "saturday";
$tdatat_people[".advSearchFields"][] = "sunday";
$tdatat_people[".advSearchFields"][] = "monday_t";
$tdatat_people[".advSearchFields"][] = "tuesday_t";
$tdatat_people[".advSearchFields"][] = "wednesday_t";
$tdatat_people[".advSearchFields"][] = "thursday_t";
$tdatat_people[".advSearchFields"][] = "friday_t";
$tdatat_people[".advSearchFields"][] = "saturday_t";
$tdatat_people[".advSearchFields"][] = "sunday_t";
$tdatat_people[".advSearchFields"][] = "preferred_contact_by";
$tdatat_people[".advSearchFields"][] = "date_last_adress_change";
$tdatat_people[".advSearchFields"][] = "map_in";
$tdatat_people[".advSearchFields"][] = "IconPath";
$tdatat_people[".advSearchFields"][] = "note";
$tdatat_people[".advSearchFields"][] = "price_per_hour";
$tdatat_people[".advSearchFields"][] = "psych_time_loose_tight";
$tdatat_people[".advSearchFields"][] = "psych_exact_creativ";
$tdatat_people[".advSearchFields"][] = "psych_heart_thing";
$tdatat_people[".advSearchFields"][] = "psych_easy_security";
$tdatat_people[".advSearchFields"][] = "psych_conflict_take_leave";
$tdatat_people[".advSearchFields"][] = "longitude";
$tdatat_people[".advSearchFields"][] = "latitude";
$tdatat_people[".advSearchFields"][] = "Agree";
$tdatat_people[".advSearchFields"][] = "Sign_date";
$tdatat_people[".advSearchFields"][] = "Active";
$tdatat_people[".advSearchFields"][] = "Acode";

$tdatat_people[".isTableType"] = "list";

	

$tdatat_people[".isDisplayLoading"] = true;


// Access doesn't support subqueries from the same table as main



$tdatat_people[".pageSize"] = 20;

$tstrOrderBy = "";
if(strlen($tstrOrderBy) && strtolower(substr($tstrOrderBy,0,8))!="order by")
	$tstrOrderBy = "order by ".$tstrOrderBy;
$tdatat_people[".strOrderBy"] = $tstrOrderBy;

$tdatat_people[".orderindexes"] = array();

$tdatat_people[".sqlHead"] = "SELECT people_id,  institution,  prof_provider,  firstname,  lastname,  image_path,  street,  house_nr,  zip,  location,  locationarea,  tel_p,  tel_m,  email,  username,  password,  picture,  picture_2,  gender,  birthdate,  enabled,  temp_sched_from,  temp_sched_to,  joiningdate,  coord_accuracy,  monday,  tuesday,  wednesday,  thursday,  friday,  saturday,  sunday,  monday_t,  tuesday_t,  wednesday_t,  thursday_t,  friday_t,  saturday_t,  sunday_t,  preferred_contact_by,  date_last_adress_change,  map_in,  IconPath,  Icon,  note,  price_per_hour,  psych_time_loose_tight,  psych_exact_creativ,  psych_heart_thing,  psych_easy_security,  psych_conflict_take_leave,  longitude,  latitude,  Agree,  Sign_date,  Active,  Acode";
$tdatat_people[".sqlFrom"] = "FROM t_people";
$tdatat_people[".sqlWhereExpr"] = "";
$tdatat_people[".sqlTail"] = "";




//fill array of records per page for list and report without group fields
$arrRPP = array();
$arrRPP[] = 10;
$arrRPP[] = 20;
$arrRPP[] = 30;
$arrRPP[] = 50;
$arrRPP[] = 100;
$arrRPP[] = 500;
$arrRPP[] = -1;
$tdatat_people[".arrRecsPerPage"] = $arrRPP;

//fill array of groups per page for report with group fields
$arrGPP = array();
$arrGPP[] = 1;
$arrGPP[] = 3;
$arrGPP[] = 5;
$arrGPP[] = 10;
$arrGPP[] = 50;
$arrGPP[] = 100;
$arrGPP[] = -1;
$tdatat_people[".arrGroupsPerPage"] = $arrGPP;

$tableKeyst_people = array();
$tableKeyst_people[] = "people_id";
$tdatat_people[".Keys"] = $tableKeyst_people;

$tdatat_people[".listFields"] = array();
$tdatat_people[".listFields"][] = "people_id";
$tdatat_people[".listFields"][] = "institution";
$tdatat_people[".listFields"][] = "prof_provider";
$tdatat_people[".listFields"][] = "firstname";
$tdatat_people[".listFields"][] = "lastname";
$tdatat_people[".listFields"][] = "image_path";
$tdatat_people[".listFields"][] = "street";
$tdatat_people[".listFields"][] = "house_nr";
$tdatat_people[".listFields"][] = "zip";
$tdatat_people[".listFields"][] = "location";
$tdatat_people[".listFields"][] = "locationarea";
$tdatat_people[".listFields"][] = "tel_p";
$tdatat_people[".listFields"][] = "tel_m";
$tdatat_people[".listFields"][] = "email";
$tdatat_people[".listFields"][] = "username";
$tdatat_people[".listFields"][] = "password";
$tdatat_people[".listFields"][] = "picture";
$tdatat_people[".listFields"][] = "picture_2";
$tdatat_people[".listFields"][] = "gender";
$tdatat_people[".listFields"][] = "birthdate";
$tdatat_people[".listFields"][] = "enabled";
$tdatat_people[".listFields"][] = "temp_sched_from";
$tdatat_people[".listFields"][] = "temp_sched_to";
$tdatat_people[".listFields"][] = "joiningdate";
$tdatat_people[".listFields"][] = "coord_accuracy";
$tdatat_people[".listFields"][] = "monday";
$tdatat_people[".listFields"][] = "tuesday";
$tdatat_people[".listFields"][] = "wednesday";
$tdatat_people[".listFields"][] = "thursday";
$tdatat_people[".listFields"][] = "friday";
$tdatat_people[".listFields"][] = "saturday";
$tdatat_people[".listFields"][] = "sunday";
$tdatat_people[".listFields"][] = "monday_t";
$tdatat_people[".listFields"][] = "tuesday_t";
$tdatat_people[".listFields"][] = "wednesday_t";
$tdatat_people[".listFields"][] = "thursday_t";
$tdatat_people[".listFields"][] = "friday_t";
$tdatat_people[".listFields"][] = "saturday_t";
$tdatat_people[".listFields"][] = "sunday_t";
$tdatat_people[".listFields"][] = "preferred_contact_by";
$tdatat_people[".listFields"][] = "date_last_adress_change";
$tdatat_people[".listFields"][] = "map_in";
$tdatat_people[".listFields"][] = "IconPath";
$tdatat_people[".listFields"][] = "Icon";
$tdatat_people[".listFields"][] = "note";
$tdatat_people[".listFields"][] = "price_per_hour";
$tdatat_people[".listFields"][] = "psych_time_loose_tight";
$tdatat_people[".listFields"][] = "psych_exact_creativ";
$tdatat_people[".listFields"][] = "psych_heart_thing";
$tdatat_people[".listFields"][] = "psych_easy_security";
$tdatat_people[".listFields"][] = "psych_conflict_take_leave";
$tdatat_people[".listFields"][] = "longitude";
$tdatat_people[".listFields"][] = "latitude";
$tdatat_people[".listFields"][] = "Agree";
$tdatat_people[".listFields"][] = "Sign_date";
$tdatat_people[".listFields"][] = "Active";
$tdatat_people[".listFields"][] = "Acode";

$tdatat_people[".viewFields"] = array();
$tdatat_people[".viewFields"][] = "people_id";
$tdatat_people[".viewFields"][] = "institution";
$tdatat_people[".viewFields"][] = "prof_provider";
$tdatat_people[".viewFields"][] = "firstname";
$tdatat_people[".viewFields"][] = "lastname";
$tdatat_people[".viewFields"][] = "image_path";
$tdatat_people[".viewFields"][] = "street";
$tdatat_people[".viewFields"][] = "house_nr";
$tdatat_people[".viewFields"][] = "zip";
$tdatat_people[".viewFields"][] = "location";
$tdatat_people[".viewFields"][] = "locationarea";
$tdatat_people[".viewFields"][] = "tel_p";
$tdatat_people[".viewFields"][] = "tel_m";
$tdatat_people[".viewFields"][] = "email";
$tdatat_people[".viewFields"][] = "username";
$tdatat_people[".viewFields"][] = "password";
$tdatat_people[".viewFields"][] = "picture";
$tdatat_people[".viewFields"][] = "picture_2";
$tdatat_people[".viewFields"][] = "gender";
$tdatat_people[".viewFields"][] = "birthdate";
$tdatat_people[".viewFields"][] = "enabled";
$tdatat_people[".viewFields"][] = "temp_sched_from";
$tdatat_people[".viewFields"][] = "temp_sched_to";
$tdatat_people[".viewFields"][] = "joiningdate";
$tdatat_people[".viewFields"][] = "coord_accuracy";
$tdatat_people[".viewFields"][] = "monday";
$tdatat_people[".viewFields"][] = "tuesday";
$tdatat_people[".viewFields"][] = "wednesday";
$tdatat_people[".viewFields"][] = "thursday";
$tdatat_people[".viewFields"][] = "friday";
$tdatat_people[".viewFields"][] = "saturday";
$tdatat_people[".viewFields"][] = "sunday";
$tdatat_people[".viewFields"][] = "monday_t";
$tdatat_people[".viewFields"][] = "tuesday_t";
$tdatat_people[".viewFields"][] = "wednesday_t";
$tdatat_people[".viewFields"][] = "thursday_t";
$tdatat_people[".viewFields"][] = "friday_t";
$tdatat_people[".viewFields"][] = "saturday_t";
$tdatat_people[".viewFields"][] = "sunday_t";
$tdatat_people[".viewFields"][] = "preferred_contact_by";
$tdatat_people[".viewFields"][] = "date_last_adress_change";
$tdatat_people[".viewFields"][] = "map_in";
$tdatat_people[".viewFields"][] = "IconPath";
$tdatat_people[".viewFields"][] = "Icon";
$tdatat_people[".viewFields"][] = "note";
$tdatat_people[".viewFields"][] = "price_per_hour";
$tdatat_people[".viewFields"][] = "psych_time_loose_tight";
$tdatat_people[".viewFields"][] = "psych_exact_creativ";
$tdatat_people[".viewFields"][] = "psych_heart_thing";
$tdatat_people[".viewFields"][] = "psych_easy_security";
$tdatat_people[".viewFields"][] = "psych_conflict_take_leave";
$tdatat_people[".viewFields"][] = "longitude";
$tdatat_people[".viewFields"][] = "latitude";
$tdatat_people[".viewFields"][] = "Agree";
$tdatat_people[".viewFields"][] = "Sign_date";
$tdatat_people[".viewFields"][] = "Active";
$tdatat_people[".viewFields"][] = "Acode";

$tdatat_people[".addFields"] = array();

$tdatat_people[".inlineAddFields"] = array();

$tdatat_people[".editFields"] = array();

$tdatat_people[".inlineEditFields"] = array();

$tdatat_people[".exportFields"] = array();
$tdatat_people[".exportFields"][] = "people_id";
$tdatat_people[".exportFields"][] = "institution";
$tdatat_people[".exportFields"][] = "prof_provider";
$tdatat_people[".exportFields"][] = "firstname";
$tdatat_people[".exportFields"][] = "lastname";
$tdatat_people[".exportFields"][] = "image_path";
$tdatat_people[".exportFields"][] = "street";
$tdatat_people[".exportFields"][] = "house_nr";
$tdatat_people[".exportFields"][] = "zip";
$tdatat_people[".exportFields"][] = "location";
$tdatat_people[".exportFields"][] = "locationarea";
$tdatat_people[".exportFields"][] = "tel_p";
$tdatat_people[".exportFields"][] = "tel_m";
$tdatat_people[".exportFields"][] = "email";
$tdatat_people[".exportFields"][] = "username";
$tdatat_people[".exportFields"][] = "password";
$tdatat_people[".exportFields"][] = "picture";
$tdatat_people[".exportFields"][] = "picture_2";
$tdatat_people[".exportFields"][] = "gender";
$tdatat_people[".exportFields"][] = "birthdate";
$tdatat_people[".exportFields"][] = "enabled";
$tdatat_people[".exportFields"][] = "temp_sched_from";
$tdatat_people[".exportFields"][] = "temp_sched_to";
$tdatat_people[".exportFields"][] = "joiningdate";
$tdatat_people[".exportFields"][] = "coord_accuracy";
$tdatat_people[".exportFields"][] = "monday";
$tdatat_people[".exportFields"][] = "tuesday";
$tdatat_people[".exportFields"][] = "wednesday";
$tdatat_people[".exportFields"][] = "thursday";
$tdatat_people[".exportFields"][] = "friday";
$tdatat_people[".exportFields"][] = "saturday";
$tdatat_people[".exportFields"][] = "sunday";
$tdatat_people[".exportFields"][] = "monday_t";
$tdatat_people[".exportFields"][] = "tuesday_t";
$tdatat_people[".exportFields"][] = "wednesday_t";
$tdatat_people[".exportFields"][] = "thursday_t";
$tdatat_people[".exportFields"][] = "friday_t";
$tdatat_people[".exportFields"][] = "saturday_t";
$tdatat_people[".exportFields"][] = "sunday_t";
$tdatat_people[".exportFields"][] = "preferred_contact_by";
$tdatat_people[".exportFields"][] = "date_last_adress_change";
$tdatat_people[".exportFields"][] = "map_in";
$tdatat_people[".exportFields"][] = "IconPath";
$tdatat_people[".exportFields"][] = "Icon";
$tdatat_people[".exportFields"][] = "note";
$tdatat_people[".exportFields"][] = "price_per_hour";
$tdatat_people[".exportFields"][] = "psych_time_loose_tight";
$tdatat_people[".exportFields"][] = "psych_exact_creativ";
$tdatat_people[".exportFields"][] = "psych_heart_thing";
$tdatat_people[".exportFields"][] = "psych_easy_security";
$tdatat_people[".exportFields"][] = "psych_conflict_take_leave";
$tdatat_people[".exportFields"][] = "longitude";
$tdatat_people[".exportFields"][] = "latitude";
$tdatat_people[".exportFields"][] = "Agree";
$tdatat_people[".exportFields"][] = "Sign_date";
$tdatat_people[".exportFields"][] = "Active";
$tdatat_people[".exportFields"][] = "Acode";

$tdatat_people[".printFields"] = array();
$tdatat_people[".printFields"][] = "people_id";
$tdatat_people[".printFields"][] = "institution";
$tdatat_people[".printFields"][] = "prof_provider";
$tdatat_people[".printFields"][] = "firstname";
$tdatat_people[".printFields"][] = "lastname";
$tdatat_people[".printFields"][] = "image_path";
$tdatat_people[".printFields"][] = "street";
$tdatat_people[".printFields"][] = "house_nr";
$tdatat_people[".printFields"][] = "zip";
$tdatat_people[".printFields"][] = "location";
$tdatat_people[".printFields"][] = "locationarea";
$tdatat_people[".printFields"][] = "tel_p";
$tdatat_people[".printFields"][] = "tel_m";
$tdatat_people[".printFields"][] = "email";
$tdatat_people[".printFields"][] = "username";
$tdatat_people[".printFields"][] = "password";
$tdatat_people[".printFields"][] = "picture";
$tdatat_people[".printFields"][] = "picture_2";
$tdatat_people[".printFields"][] = "gender";
$tdatat_people[".printFields"][] = "birthdate";
$tdatat_people[".printFields"][] = "enabled";
$tdatat_people[".printFields"][] = "temp_sched_from";
$tdatat_people[".printFields"][] = "temp_sched_to";
$tdatat_people[".printFields"][] = "joiningdate";
$tdatat_people[".printFields"][] = "coord_accuracy";
$tdatat_people[".printFields"][] = "monday";
$tdatat_people[".printFields"][] = "tuesday";
$tdatat_people[".printFields"][] = "wednesday";
$tdatat_people[".printFields"][] = "thursday";
$tdatat_people[".printFields"][] = "friday";
$tdatat_people[".printFields"][] = "saturday";
$tdatat_people[".printFields"][] = "sunday";
$tdatat_people[".printFields"][] = "monday_t";
$tdatat_people[".printFields"][] = "tuesday_t";
$tdatat_people[".printFields"][] = "wednesday_t";
$tdatat_people[".printFields"][] = "thursday_t";
$tdatat_people[".printFields"][] = "friday_t";
$tdatat_people[".printFields"][] = "saturday_t";
$tdatat_people[".printFields"][] = "sunday_t";
$tdatat_people[".printFields"][] = "preferred_contact_by";
$tdatat_people[".printFields"][] = "date_last_adress_change";
$tdatat_people[".printFields"][] = "map_in";
$tdatat_people[".printFields"][] = "IconPath";
$tdatat_people[".printFields"][] = "Icon";
$tdatat_people[".printFields"][] = "note";
$tdatat_people[".printFields"][] = "price_per_hour";
$tdatat_people[".printFields"][] = "psych_time_loose_tight";
$tdatat_people[".printFields"][] = "psych_exact_creativ";
$tdatat_people[".printFields"][] = "psych_heart_thing";
$tdatat_people[".printFields"][] = "psych_easy_security";
$tdatat_people[".printFields"][] = "psych_conflict_take_leave";
$tdatat_people[".printFields"][] = "longitude";
$tdatat_people[".printFields"][] = "latitude";
$tdatat_people[".printFields"][] = "Agree";
$tdatat_people[".printFields"][] = "Sign_date";
$tdatat_people[".printFields"][] = "Active";
$tdatat_people[".printFields"][] = "Acode";

//	people_id
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 1;
	$fdata["strName"] = "people_id";
	$fdata["GoodName"] = "people_id";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "People Id"; 
	$fdata["FieldType"] = 3;
	
		$fdata["AutoInc"] = true;
	
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "people_id"; 
		$fdata["FullName"] = "people_id";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		$edata["IsRequired"] = true; 
	
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						$edata["validateAs"]["basicValidate"][] = "IsRequired";
	
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["people_id"] = $fdata;
//	institution
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 2;
	$fdata["strName"] = "institution";
	$fdata["GoodName"] = "institution";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Institution"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "institution"; 
		$fdata["FullName"] = "institution";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["institution"] = $fdata;
//	prof_provider
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 3;
	$fdata["strName"] = "prof_provider";
	$fdata["GoodName"] = "prof_provider";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Prof Provider"; 
	$fdata["FieldType"] = 16;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "prof_provider"; 
		$fdata["FullName"] = "prof_provider";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["prof_provider"] = $fdata;
//	firstname
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 4;
	$fdata["strName"] = "firstname";
	$fdata["GoodName"] = "firstname";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Firstname"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "firstname"; 
		$fdata["FullName"] = "firstname";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["firstname"] = $fdata;
//	lastname
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 5;
	$fdata["strName"] = "lastname";
	$fdata["GoodName"] = "lastname";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Lastname"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "lastname"; 
		$fdata["FullName"] = "lastname";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["lastname"] = $fdata;
//	image_path
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 6;
	$fdata["strName"] = "image_path";
	$fdata["GoodName"] = "image_path";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Image Path"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "image_path"; 
		$fdata["FullName"] = "image_path";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "../images/profile/";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "File-based Image");
	
		
		$vdata["LinkPrefix"] ="../images/profile/"; 
	
				$vdata["ImageWidth"] = 0;
	$vdata["ImageHeight"] = 0;
	
			
		
		
		
		
		
		
		
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["image_path"] = $fdata;
//	street
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 7;
	$fdata["strName"] = "street";
	$fdata["GoodName"] = "street";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Street"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "street"; 
		$fdata["FullName"] = "street";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["street"] = $fdata;
//	house_nr
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 8;
	$fdata["strName"] = "house_nr";
	$fdata["GoodName"] = "house_nr";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "House Nr"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "house_nr"; 
		$fdata["FullName"] = "house_nr";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["house_nr"] = $fdata;
//	zip
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 9;
	$fdata["strName"] = "zip";
	$fdata["GoodName"] = "zip";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Zip"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "zip"; 
		$fdata["FullName"] = "zip";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["zip"] = $fdata;
//	location
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 10;
	$fdata["strName"] = "location";
	$fdata["GoodName"] = "location";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Location"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "location"; 
		$fdata["FullName"] = "location";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["location"] = $fdata;
//	locationarea
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 11;
	$fdata["strName"] = "locationarea";
	$fdata["GoodName"] = "locationarea";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Locationarea"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "locationarea"; 
		$fdata["FullName"] = "locationarea";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["locationarea"] = $fdata;
//	tel_p
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 12;
	$fdata["strName"] = "tel_p";
	$fdata["GoodName"] = "tel_p";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Tel P"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tel_p"; 
		$fdata["FullName"] = "tel_p";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["tel_p"] = $fdata;
//	tel_m
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 13;
	$fdata["strName"] = "tel_m";
	$fdata["GoodName"] = "tel_m";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Tel M"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tel_m"; 
		$fdata["FullName"] = "tel_m";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["tel_m"] = $fdata;
//	email
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 14;
	$fdata["strName"] = "email";
	$fdata["GoodName"] = "email";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Email"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "email"; 
		$fdata["FullName"] = "email";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["email"] = $fdata;
//	username
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 15;
	$fdata["strName"] = "username";
	$fdata["GoodName"] = "username";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Username"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "username"; 
		$fdata["FullName"] = "username";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["username"] = $fdata;
//	password
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 16;
	$fdata["strName"] = "password";
	$fdata["GoodName"] = "password";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Password"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "password"; 
		$fdata["FullName"] = "password";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["password"] = $fdata;
//	picture
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 17;
	$fdata["strName"] = "picture";
	$fdata["GoodName"] = "picture";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Picture"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "picture"; 
		$fdata["FullName"] = "picture";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["picture"] = $fdata;
//	picture_2
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 18;
	$fdata["strName"] = "picture_2";
	$fdata["GoodName"] = "picture_2";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Picture 2"; 
	$fdata["FieldType"] = 128;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "picture_2"; 
		$fdata["FullName"] = "picture_2";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Database Image");
	
		
		
				$vdata["ImageWidth"] = 0;
	$vdata["ImageHeight"] = 0;
	
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Database image");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["picture_2"] = $fdata;
//	gender
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 19;
	$fdata["strName"] = "gender";
	$fdata["GoodName"] = "gender";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Gender"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "gender"; 
		$fdata["FullName"] = "gender";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["gender"] = $fdata;
//	birthdate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 20;
	$fdata["strName"] = "birthdate";
	$fdata["GoodName"] = "birthdate";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Birthdate"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "birthdate"; 
		$fdata["FullName"] = "birthdate";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["birthdate"] = $fdata;
//	enabled
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 21;
	$fdata["strName"] = "enabled";
	$fdata["GoodName"] = "enabled";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Enabled"; 
	$fdata["FieldType"] = 16;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "enabled"; 
		$fdata["FullName"] = "enabled";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["enabled"] = $fdata;
//	temp_sched_from
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 22;
	$fdata["strName"] = "temp_sched_from";
	$fdata["GoodName"] = "temp_sched_from";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Temp Sched From"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "temp_sched_from"; 
		$fdata["FullName"] = "temp_sched_from";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 250;
			$edata["nCols"] = 500;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["temp_sched_from"] = $fdata;
//	temp_sched_to
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 23;
	$fdata["strName"] = "temp_sched_to";
	$fdata["GoodName"] = "temp_sched_to";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Temp Sched To"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "temp_sched_to"; 
		$fdata["FullName"] = "temp_sched_to";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 250;
			$edata["nCols"] = 500;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["temp_sched_to"] = $fdata;
//	joiningdate
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 24;
	$fdata["strName"] = "joiningdate";
	$fdata["GoodName"] = "joiningdate";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Joiningdate"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "joiningdate"; 
		$fdata["FullName"] = "joiningdate";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["joiningdate"] = $fdata;
//	coord_accuracy
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 25;
	$fdata["strName"] = "coord_accuracy";
	$fdata["GoodName"] = "coord_accuracy";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Coord Accuracy"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "coord_accuracy"; 
		$fdata["FullName"] = "coord_accuracy";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["coord_accuracy"] = $fdata;
//	monday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 26;
	$fdata["strName"] = "monday";
	$fdata["GoodName"] = "monday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Monday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "monday"; 
		$fdata["FullName"] = "monday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["monday"] = $fdata;
//	tuesday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 27;
	$fdata["strName"] = "tuesday";
	$fdata["GoodName"] = "tuesday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Tuesday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tuesday"; 
		$fdata["FullName"] = "tuesday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["tuesday"] = $fdata;
//	wednesday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 28;
	$fdata["strName"] = "wednesday";
	$fdata["GoodName"] = "wednesday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Wednesday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "wednesday"; 
		$fdata["FullName"] = "wednesday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["wednesday"] = $fdata;
//	thursday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 29;
	$fdata["strName"] = "thursday";
	$fdata["GoodName"] = "thursday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Thursday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "thursday"; 
		$fdata["FullName"] = "thursday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["thursday"] = $fdata;
//	friday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 30;
	$fdata["strName"] = "friday";
	$fdata["GoodName"] = "friday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Friday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "friday"; 
		$fdata["FullName"] = "friday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["friday"] = $fdata;
//	saturday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 31;
	$fdata["strName"] = "saturday";
	$fdata["GoodName"] = "saturday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Saturday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "saturday"; 
		$fdata["FullName"] = "saturday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["saturday"] = $fdata;
//	sunday
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 32;
	$fdata["strName"] = "sunday";
	$fdata["GoodName"] = "sunday";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Sunday"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "sunday"; 
		$fdata["FullName"] = "sunday";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["sunday"] = $fdata;
//	monday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 33;
	$fdata["strName"] = "monday_t";
	$fdata["GoodName"] = "monday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Monday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "monday_t"; 
		$fdata["FullName"] = "monday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["monday_t"] = $fdata;
//	tuesday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 34;
	$fdata["strName"] = "tuesday_t";
	$fdata["GoodName"] = "tuesday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Tuesday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "tuesday_t"; 
		$fdata["FullName"] = "tuesday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["tuesday_t"] = $fdata;
//	wednesday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 35;
	$fdata["strName"] = "wednesday_t";
	$fdata["GoodName"] = "wednesday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Wednesday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "wednesday_t"; 
		$fdata["FullName"] = "wednesday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["wednesday_t"] = $fdata;
//	thursday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 36;
	$fdata["strName"] = "thursday_t";
	$fdata["GoodName"] = "thursday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Thursday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "thursday_t"; 
		$fdata["FullName"] = "thursday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["thursday_t"] = $fdata;
//	friday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 37;
	$fdata["strName"] = "friday_t";
	$fdata["GoodName"] = "friday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Friday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "friday_t"; 
		$fdata["FullName"] = "friday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["friday_t"] = $fdata;
//	saturday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 38;
	$fdata["strName"] = "saturday_t";
	$fdata["GoodName"] = "saturday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Saturday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "saturday_t"; 
		$fdata["FullName"] = "saturday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["saturday_t"] = $fdata;
//	sunday_t
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 39;
	$fdata["strName"] = "sunday_t";
	$fdata["GoodName"] = "sunday_t";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Sunday T"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "sunday_t"; 
		$fdata["FullName"] = "sunday_t";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["sunday_t"] = $fdata;
//	preferred_contact_by
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 40;
	$fdata["strName"] = "preferred_contact_by";
	$fdata["GoodName"] = "preferred_contact_by";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Preferred Contact By"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "preferred_contact_by"; 
		$fdata["FullName"] = "preferred_contact_by";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["preferred_contact_by"] = $fdata;
//	date_last_adress_change
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 41;
	$fdata["strName"] = "date_last_adress_change";
	$fdata["GoodName"] = "date_last_adress_change";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Date Last Adress Change"; 
	$fdata["FieldType"] = 7;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "date_last_adress_change"; 
		$fdata["FullName"] = "date_last_adress_change";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Short Date");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Date");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		$edata["DateEditType"] = 13; 
	$edata["InitialYearFactor"] = 100; 
	$edata["LastYearFactor"] = 10; 
	
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["date_last_adress_change"] = $fdata;
//	map_in
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 42;
	$fdata["strName"] = "map_in";
	$fdata["GoodName"] = "map_in";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Map In"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "map_in"; 
		$fdata["FullName"] = "map_in";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["map_in"] = $fdata;
//	IconPath
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 43;
	$fdata["strName"] = "IconPath";
	$fdata["GoodName"] = "IconPath";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Icon Path"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "IconPath"; 
		$fdata["FullName"] = "IconPath";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=255";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["IconPath"] = $fdata;
//	Icon
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 44;
	$fdata["strName"] = "Icon";
	$fdata["GoodName"] = "Icon";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Icon"; 
	$fdata["FieldType"] = 128;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Icon"; 
		$fdata["FullName"] = "Icon";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Database Image");
	
		
		
				$vdata["ImageWidth"] = 0;
	$vdata["ImageHeight"] = 0;
	
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Database image");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["Icon"] = $fdata;
//	note
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 45;
	$fdata["strName"] = "note";
	$fdata["GoodName"] = "note";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Note"; 
	$fdata["FieldType"] = 201;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "note"; 
		$fdata["FullName"] = "note";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text area");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
				$edata["nRows"] = 250;
			$edata["nCols"] = 500;
	
		
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["note"] = $fdata;
//	price_per_hour
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 46;
	$fdata["strName"] = "price_per_hour";
	$fdata["GoodName"] = "price_per_hour";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Price Per Hour"; 
	$fdata["FieldType"] = 5;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "price_per_hour"; 
		$fdata["FullName"] = "price_per_hour";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Number");
	
		
		
		
			
		
		$vdata["DecimalDigits"] = 2;
	
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["price_per_hour"] = $fdata;
//	psych_time_loose_tight
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 47;
	$fdata["strName"] = "psych_time_loose_tight";
	$fdata["GoodName"] = "psych_time_loose_tight";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Psych Time Loose Tight"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "psych_time_loose_tight"; 
		$fdata["FullName"] = "psych_time_loose_tight";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["psych_time_loose_tight"] = $fdata;
//	psych_exact_creativ
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 48;
	$fdata["strName"] = "psych_exact_creativ";
	$fdata["GoodName"] = "psych_exact_creativ";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Psych Exact Creativ"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "psych_exact_creativ"; 
		$fdata["FullName"] = "psych_exact_creativ";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["psych_exact_creativ"] = $fdata;
//	psych_heart_thing
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 49;
	$fdata["strName"] = "psych_heart_thing";
	$fdata["GoodName"] = "psych_heart_thing";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Psych Heart Thing"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "psych_heart_thing"; 
		$fdata["FullName"] = "psych_heart_thing";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["psych_heart_thing"] = $fdata;
//	psych_easy_security
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 50;
	$fdata["strName"] = "psych_easy_security";
	$fdata["GoodName"] = "psych_easy_security";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Psych Easy Security"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "psych_easy_security"; 
		$fdata["FullName"] = "psych_easy_security";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["psych_easy_security"] = $fdata;
//	psych_conflict_take_leave
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 51;
	$fdata["strName"] = "psych_conflict_take_leave";
	$fdata["GoodName"] = "psych_conflict_take_leave";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Psych Conflict Take Leave"; 
	$fdata["FieldType"] = 3;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "psych_conflict_take_leave"; 
		$fdata["FullName"] = "psych_conflict_take_leave";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["psych_conflict_take_leave"] = $fdata;
//	longitude
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 52;
	$fdata["strName"] = "longitude";
	$fdata["GoodName"] = "longitude";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Longitude"; 
	$fdata["FieldType"] = 5;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "longitude"; 
		$fdata["FullName"] = "longitude";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Number");
	
		
		
		
			
		
		$vdata["DecimalDigits"] = 2;
	
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["longitude"] = $fdata;
//	latitude
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 53;
	$fdata["strName"] = "latitude";
	$fdata["GoodName"] = "latitude";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Latitude"; 
	$fdata["FieldType"] = 5;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "latitude"; 
		$fdata["FullName"] = "latitude";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "Number");
	
		
		
		
			
		
		$vdata["DecimalDigits"] = 2;
	
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			
		
//	Begin validation
	$edata["validateAs"] = array();
				$edata["validateAs"]["basicValidate"][] = getJsValidatorName("Number");	
						
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["latitude"] = $fdata;
//	Agree
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 54;
	$fdata["strName"] = "Agree";
	$fdata["GoodName"] = "Agree";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Agree"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Agree"; 
		$fdata["FullName"] = "Agree";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=1";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["Agree"] = $fdata;
//	Sign_date
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 55;
	$fdata["strName"] = "Sign_date";
	$fdata["GoodName"] = "Sign_date";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Sign Date"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Sign_date"; 
		$fdata["FullName"] = "Sign_date";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=50";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["Sign_date"] = $fdata;
//	Active
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 56;
	$fdata["strName"] = "Active";
	$fdata["GoodName"] = "Active";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Active"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Active"; 
		$fdata["FullName"] = "Active";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=1";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["Active"] = $fdata;
//	Acode
//	Custom field settings
	$fdata = array();
	$fdata["Index"] = 57;
	$fdata["strName"] = "Acode";
	$fdata["GoodName"] = "Acode";
	$fdata["ownerTable"] = "t_people";
	$fdata["Label"] = "Acode"; 
	$fdata["FieldType"] = 200;
	
		
		
		$fdata["bListPage"] = true; 
	
		
		
		
		
		$fdata["bViewPage"] = true; 
	
		$fdata["bAdvancedSearch"] = true; 
	
		$fdata["bPrinterPage"] = true; 
	
		$fdata["bExportPage"] = true; 
	
		$fdata["strField"] = "Acode"; 
		$fdata["FullName"] = "Acode";
	
		
		$fdata["CompatibilityMode"] = true; 
	
				$fdata["FieldPermissions"] = true;
	
				$fdata["UploadFolder"] = "files";
		
//  Begin View Formats
	$fdata["ViewFormats"] = array();
	
	$vdata = array("ViewFormat" => "");
	
		
		
		
			
		
		
		
		
		
		
		$vdata["NeedEncode"] = true;
	
	$fdata["ViewFormats"]["view"] = $vdata;
//  End View Formats

//	Begin Edit Formats 	
	$fdata["EditFormats"] = array();
	
	$edata = array("EditFormat" => "Text field");
	
		
		
	
//	Begin Lookup settings
	//	End Lookup Settings

		
		
		
		
			$edata["acceptFileTypes"] = ".+$";
	
		$edata["maxNumberOfFiles"] = 1;
	
		
		
		
		
		$edata["EditParams"] = "";
			$edata["EditParams"].= " maxlength=5";
	
		
//	Begin validation
	$edata["validateAs"] = array();
		
	//	End validation
	
		
				
		$fdata["EditFormats"]["edit"] = $edata;
//	End Edit Formats
	
		$fdata["isSeparate"] = false;
	
		
		
	$tdatat_people["Acode"] = $fdata;

	
$tables_data["t_people"]=&$tdatat_people;
$field_labels["t_people"] = &$fieldLabelst_people;
$fieldToolTips["t_people"] = &$fieldToolTipst_people;

// -----------------start  prepare master-details data arrays ------------------------------//
// tables which are detail tables for current table (master)
$detailsTablesData["t_people"] = array();
	
// tables which are master tables for current table (detail)
$masterTablesData["t_people"] = array();

// -----------------end  prepare master-details data arrays ------------------------------//

require_once(getabspath("classes/sql.php"));










function createSqlQuery_t_people()
{
$proto0=array();
$proto0["m_strHead"] = "SELECT";
$proto0["m_strFieldList"] = "people_id,  institution,  prof_provider,  firstname,  lastname,  image_path,  street,  house_nr,  zip,  location,  locationarea,  tel_p,  tel_m,  email,  username,  password,  picture,  picture_2,  gender,  birthdate,  enabled,  temp_sched_from,  temp_sched_to,  joiningdate,  coord_accuracy,  monday,  tuesday,  wednesday,  thursday,  friday,  saturday,  sunday,  monday_t,  tuesday_t,  wednesday_t,  thursday_t,  friday_t,  saturday_t,  sunday_t,  preferred_contact_by,  date_last_adress_change,  map_in,  IconPath,  Icon,  note,  price_per_hour,  psych_time_loose_tight,  psych_exact_creativ,  psych_heart_thing,  psych_easy_security,  psych_conflict_take_leave,  longitude,  latitude,  Agree,  Sign_date,  Active,  Acode";
$proto0["m_strFrom"] = "FROM t_people";
$proto0["m_strWhere"] = "";
$proto0["m_strOrderBy"] = "";
$proto0["m_strTail"] = "";
$proto0["cipherer"] = null;
$proto1=array();
$proto1["m_sql"] = "";
$proto1["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto1["m_column"]=$obj;
$proto1["m_contained"] = array();
$proto1["m_strCase"] = "";
$proto1["m_havingmode"] = "0";
$proto1["m_inBrackets"] = "0";
$proto1["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto1);

$proto0["m_where"] = $obj;
$proto3=array();
$proto3["m_sql"] = "";
$proto3["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto3["m_column"]=$obj;
$proto3["m_contained"] = array();
$proto3["m_strCase"] = "";
$proto3["m_havingmode"] = "0";
$proto3["m_inBrackets"] = "0";
$proto3["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto3);

$proto0["m_having"] = $obj;
$proto0["m_fieldlist"] = array();
						$proto5=array();
			$obj = new SQLField(array(
	"m_strName" => "people_id",
	"m_strTable" => "t_people"
));

$proto5["m_expr"]=$obj;
$proto5["m_alias"] = "";
$obj = new SQLFieldListItem($proto5);

$proto0["m_fieldlist"][]=$obj;
						$proto7=array();
			$obj = new SQLField(array(
	"m_strName" => "institution",
	"m_strTable" => "t_people"
));

$proto7["m_expr"]=$obj;
$proto7["m_alias"] = "";
$obj = new SQLFieldListItem($proto7);

$proto0["m_fieldlist"][]=$obj;
						$proto9=array();
			$obj = new SQLField(array(
	"m_strName" => "prof_provider",
	"m_strTable" => "t_people"
));

$proto9["m_expr"]=$obj;
$proto9["m_alias"] = "";
$obj = new SQLFieldListItem($proto9);

$proto0["m_fieldlist"][]=$obj;
						$proto11=array();
			$obj = new SQLField(array(
	"m_strName" => "firstname",
	"m_strTable" => "t_people"
));

$proto11["m_expr"]=$obj;
$proto11["m_alias"] = "";
$obj = new SQLFieldListItem($proto11);

$proto0["m_fieldlist"][]=$obj;
						$proto13=array();
			$obj = new SQLField(array(
	"m_strName" => "lastname",
	"m_strTable" => "t_people"
));

$proto13["m_expr"]=$obj;
$proto13["m_alias"] = "";
$obj = new SQLFieldListItem($proto13);

$proto0["m_fieldlist"][]=$obj;
						$proto15=array();
			$obj = new SQLField(array(
	"m_strName" => "image_path",
	"m_strTable" => "t_people"
));

$proto15["m_expr"]=$obj;
$proto15["m_alias"] = "";
$obj = new SQLFieldListItem($proto15);

$proto0["m_fieldlist"][]=$obj;
						$proto17=array();
			$obj = new SQLField(array(
	"m_strName" => "street",
	"m_strTable" => "t_people"
));

$proto17["m_expr"]=$obj;
$proto17["m_alias"] = "";
$obj = new SQLFieldListItem($proto17);

$proto0["m_fieldlist"][]=$obj;
						$proto19=array();
			$obj = new SQLField(array(
	"m_strName" => "house_nr",
	"m_strTable" => "t_people"
));

$proto19["m_expr"]=$obj;
$proto19["m_alias"] = "";
$obj = new SQLFieldListItem($proto19);

$proto0["m_fieldlist"][]=$obj;
						$proto21=array();
			$obj = new SQLField(array(
	"m_strName" => "zip",
	"m_strTable" => "t_people"
));

$proto21["m_expr"]=$obj;
$proto21["m_alias"] = "";
$obj = new SQLFieldListItem($proto21);

$proto0["m_fieldlist"][]=$obj;
						$proto23=array();
			$obj = new SQLField(array(
	"m_strName" => "location",
	"m_strTable" => "t_people"
));

$proto23["m_expr"]=$obj;
$proto23["m_alias"] = "";
$obj = new SQLFieldListItem($proto23);

$proto0["m_fieldlist"][]=$obj;
						$proto25=array();
			$obj = new SQLField(array(
	"m_strName" => "locationarea",
	"m_strTable" => "t_people"
));

$proto25["m_expr"]=$obj;
$proto25["m_alias"] = "";
$obj = new SQLFieldListItem($proto25);

$proto0["m_fieldlist"][]=$obj;
						$proto27=array();
			$obj = new SQLField(array(
	"m_strName" => "tel_p",
	"m_strTable" => "t_people"
));

$proto27["m_expr"]=$obj;
$proto27["m_alias"] = "";
$obj = new SQLFieldListItem($proto27);

$proto0["m_fieldlist"][]=$obj;
						$proto29=array();
			$obj = new SQLField(array(
	"m_strName" => "tel_m",
	"m_strTable" => "t_people"
));

$proto29["m_expr"]=$obj;
$proto29["m_alias"] = "";
$obj = new SQLFieldListItem($proto29);

$proto0["m_fieldlist"][]=$obj;
						$proto31=array();
			$obj = new SQLField(array(
	"m_strName" => "email",
	"m_strTable" => "t_people"
));

$proto31["m_expr"]=$obj;
$proto31["m_alias"] = "";
$obj = new SQLFieldListItem($proto31);

$proto0["m_fieldlist"][]=$obj;
						$proto33=array();
			$obj = new SQLField(array(
	"m_strName" => "username",
	"m_strTable" => "t_people"
));

$proto33["m_expr"]=$obj;
$proto33["m_alias"] = "";
$obj = new SQLFieldListItem($proto33);

$proto0["m_fieldlist"][]=$obj;
						$proto35=array();
			$obj = new SQLField(array(
	"m_strName" => "password",
	"m_strTable" => "t_people"
));

$proto35["m_expr"]=$obj;
$proto35["m_alias"] = "";
$obj = new SQLFieldListItem($proto35);

$proto0["m_fieldlist"][]=$obj;
						$proto37=array();
			$obj = new SQLField(array(
	"m_strName" => "picture",
	"m_strTable" => "t_people"
));

$proto37["m_expr"]=$obj;
$proto37["m_alias"] = "";
$obj = new SQLFieldListItem($proto37);

$proto0["m_fieldlist"][]=$obj;
						$proto39=array();
			$obj = new SQLField(array(
	"m_strName" => "picture_2",
	"m_strTable" => "t_people"
));

$proto39["m_expr"]=$obj;
$proto39["m_alias"] = "";
$obj = new SQLFieldListItem($proto39);

$proto0["m_fieldlist"][]=$obj;
						$proto41=array();
			$obj = new SQLField(array(
	"m_strName" => "gender",
	"m_strTable" => "t_people"
));

$proto41["m_expr"]=$obj;
$proto41["m_alias"] = "";
$obj = new SQLFieldListItem($proto41);

$proto0["m_fieldlist"][]=$obj;
						$proto43=array();
			$obj = new SQLField(array(
	"m_strName" => "birthdate",
	"m_strTable" => "t_people"
));

$proto43["m_expr"]=$obj;
$proto43["m_alias"] = "";
$obj = new SQLFieldListItem($proto43);

$proto0["m_fieldlist"][]=$obj;
						$proto45=array();
			$obj = new SQLField(array(
	"m_strName" => "enabled",
	"m_strTable" => "t_people"
));

$proto45["m_expr"]=$obj;
$proto45["m_alias"] = "";
$obj = new SQLFieldListItem($proto45);

$proto0["m_fieldlist"][]=$obj;
						$proto47=array();
			$obj = new SQLField(array(
	"m_strName" => "temp_sched_from",
	"m_strTable" => "t_people"
));

$proto47["m_expr"]=$obj;
$proto47["m_alias"] = "";
$obj = new SQLFieldListItem($proto47);

$proto0["m_fieldlist"][]=$obj;
						$proto49=array();
			$obj = new SQLField(array(
	"m_strName" => "temp_sched_to",
	"m_strTable" => "t_people"
));

$proto49["m_expr"]=$obj;
$proto49["m_alias"] = "";
$obj = new SQLFieldListItem($proto49);

$proto0["m_fieldlist"][]=$obj;
						$proto51=array();
			$obj = new SQLField(array(
	"m_strName" => "joiningdate",
	"m_strTable" => "t_people"
));

$proto51["m_expr"]=$obj;
$proto51["m_alias"] = "";
$obj = new SQLFieldListItem($proto51);

$proto0["m_fieldlist"][]=$obj;
						$proto53=array();
			$obj = new SQLField(array(
	"m_strName" => "coord_accuracy",
	"m_strTable" => "t_people"
));

$proto53["m_expr"]=$obj;
$proto53["m_alias"] = "";
$obj = new SQLFieldListItem($proto53);

$proto0["m_fieldlist"][]=$obj;
						$proto55=array();
			$obj = new SQLField(array(
	"m_strName" => "monday",
	"m_strTable" => "t_people"
));

$proto55["m_expr"]=$obj;
$proto55["m_alias"] = "";
$obj = new SQLFieldListItem($proto55);

$proto0["m_fieldlist"][]=$obj;
						$proto57=array();
			$obj = new SQLField(array(
	"m_strName" => "tuesday",
	"m_strTable" => "t_people"
));

$proto57["m_expr"]=$obj;
$proto57["m_alias"] = "";
$obj = new SQLFieldListItem($proto57);

$proto0["m_fieldlist"][]=$obj;
						$proto59=array();
			$obj = new SQLField(array(
	"m_strName" => "wednesday",
	"m_strTable" => "t_people"
));

$proto59["m_expr"]=$obj;
$proto59["m_alias"] = "";
$obj = new SQLFieldListItem($proto59);

$proto0["m_fieldlist"][]=$obj;
						$proto61=array();
			$obj = new SQLField(array(
	"m_strName" => "thursday",
	"m_strTable" => "t_people"
));

$proto61["m_expr"]=$obj;
$proto61["m_alias"] = "";
$obj = new SQLFieldListItem($proto61);

$proto0["m_fieldlist"][]=$obj;
						$proto63=array();
			$obj = new SQLField(array(
	"m_strName" => "friday",
	"m_strTable" => "t_people"
));

$proto63["m_expr"]=$obj;
$proto63["m_alias"] = "";
$obj = new SQLFieldListItem($proto63);

$proto0["m_fieldlist"][]=$obj;
						$proto65=array();
			$obj = new SQLField(array(
	"m_strName" => "saturday",
	"m_strTable" => "t_people"
));

$proto65["m_expr"]=$obj;
$proto65["m_alias"] = "";
$obj = new SQLFieldListItem($proto65);

$proto0["m_fieldlist"][]=$obj;
						$proto67=array();
			$obj = new SQLField(array(
	"m_strName" => "sunday",
	"m_strTable" => "t_people"
));

$proto67["m_expr"]=$obj;
$proto67["m_alias"] = "";
$obj = new SQLFieldListItem($proto67);

$proto0["m_fieldlist"][]=$obj;
						$proto69=array();
			$obj = new SQLField(array(
	"m_strName" => "monday_t",
	"m_strTable" => "t_people"
));

$proto69["m_expr"]=$obj;
$proto69["m_alias"] = "";
$obj = new SQLFieldListItem($proto69);

$proto0["m_fieldlist"][]=$obj;
						$proto71=array();
			$obj = new SQLField(array(
	"m_strName" => "tuesday_t",
	"m_strTable" => "t_people"
));

$proto71["m_expr"]=$obj;
$proto71["m_alias"] = "";
$obj = new SQLFieldListItem($proto71);

$proto0["m_fieldlist"][]=$obj;
						$proto73=array();
			$obj = new SQLField(array(
	"m_strName" => "wednesday_t",
	"m_strTable" => "t_people"
));

$proto73["m_expr"]=$obj;
$proto73["m_alias"] = "";
$obj = new SQLFieldListItem($proto73);

$proto0["m_fieldlist"][]=$obj;
						$proto75=array();
			$obj = new SQLField(array(
	"m_strName" => "thursday_t",
	"m_strTable" => "t_people"
));

$proto75["m_expr"]=$obj;
$proto75["m_alias"] = "";
$obj = new SQLFieldListItem($proto75);

$proto0["m_fieldlist"][]=$obj;
						$proto77=array();
			$obj = new SQLField(array(
	"m_strName" => "friday_t",
	"m_strTable" => "t_people"
));

$proto77["m_expr"]=$obj;
$proto77["m_alias"] = "";
$obj = new SQLFieldListItem($proto77);

$proto0["m_fieldlist"][]=$obj;
						$proto79=array();
			$obj = new SQLField(array(
	"m_strName" => "saturday_t",
	"m_strTable" => "t_people"
));

$proto79["m_expr"]=$obj;
$proto79["m_alias"] = "";
$obj = new SQLFieldListItem($proto79);

$proto0["m_fieldlist"][]=$obj;
						$proto81=array();
			$obj = new SQLField(array(
	"m_strName" => "sunday_t",
	"m_strTable" => "t_people"
));

$proto81["m_expr"]=$obj;
$proto81["m_alias"] = "";
$obj = new SQLFieldListItem($proto81);

$proto0["m_fieldlist"][]=$obj;
						$proto83=array();
			$obj = new SQLField(array(
	"m_strName" => "preferred_contact_by",
	"m_strTable" => "t_people"
));

$proto83["m_expr"]=$obj;
$proto83["m_alias"] = "";
$obj = new SQLFieldListItem($proto83);

$proto0["m_fieldlist"][]=$obj;
						$proto85=array();
			$obj = new SQLField(array(
	"m_strName" => "date_last_adress_change",
	"m_strTable" => "t_people"
));

$proto85["m_expr"]=$obj;
$proto85["m_alias"] = "";
$obj = new SQLFieldListItem($proto85);

$proto0["m_fieldlist"][]=$obj;
						$proto87=array();
			$obj = new SQLField(array(
	"m_strName" => "map_in",
	"m_strTable" => "t_people"
));

$proto87["m_expr"]=$obj;
$proto87["m_alias"] = "";
$obj = new SQLFieldListItem($proto87);

$proto0["m_fieldlist"][]=$obj;
						$proto89=array();
			$obj = new SQLField(array(
	"m_strName" => "IconPath",
	"m_strTable" => "t_people"
));

$proto89["m_expr"]=$obj;
$proto89["m_alias"] = "";
$obj = new SQLFieldListItem($proto89);

$proto0["m_fieldlist"][]=$obj;
						$proto91=array();
			$obj = new SQLField(array(
	"m_strName" => "Icon",
	"m_strTable" => "t_people"
));

$proto91["m_expr"]=$obj;
$proto91["m_alias"] = "";
$obj = new SQLFieldListItem($proto91);

$proto0["m_fieldlist"][]=$obj;
						$proto93=array();
			$obj = new SQLField(array(
	"m_strName" => "note",
	"m_strTable" => "t_people"
));

$proto93["m_expr"]=$obj;
$proto93["m_alias"] = "";
$obj = new SQLFieldListItem($proto93);

$proto0["m_fieldlist"][]=$obj;
						$proto95=array();
			$obj = new SQLField(array(
	"m_strName" => "price_per_hour",
	"m_strTable" => "t_people"
));

$proto95["m_expr"]=$obj;
$proto95["m_alias"] = "";
$obj = new SQLFieldListItem($proto95);

$proto0["m_fieldlist"][]=$obj;
						$proto97=array();
			$obj = new SQLField(array(
	"m_strName" => "psych_time_loose_tight",
	"m_strTable" => "t_people"
));

$proto97["m_expr"]=$obj;
$proto97["m_alias"] = "";
$obj = new SQLFieldListItem($proto97);

$proto0["m_fieldlist"][]=$obj;
						$proto99=array();
			$obj = new SQLField(array(
	"m_strName" => "psych_exact_creativ",
	"m_strTable" => "t_people"
));

$proto99["m_expr"]=$obj;
$proto99["m_alias"] = "";
$obj = new SQLFieldListItem($proto99);

$proto0["m_fieldlist"][]=$obj;
						$proto101=array();
			$obj = new SQLField(array(
	"m_strName" => "psych_heart_thing",
	"m_strTable" => "t_people"
));

$proto101["m_expr"]=$obj;
$proto101["m_alias"] = "";
$obj = new SQLFieldListItem($proto101);

$proto0["m_fieldlist"][]=$obj;
						$proto103=array();
			$obj = new SQLField(array(
	"m_strName" => "psych_easy_security",
	"m_strTable" => "t_people"
));

$proto103["m_expr"]=$obj;
$proto103["m_alias"] = "";
$obj = new SQLFieldListItem($proto103);

$proto0["m_fieldlist"][]=$obj;
						$proto105=array();
			$obj = new SQLField(array(
	"m_strName" => "psych_conflict_take_leave",
	"m_strTable" => "t_people"
));

$proto105["m_expr"]=$obj;
$proto105["m_alias"] = "";
$obj = new SQLFieldListItem($proto105);

$proto0["m_fieldlist"][]=$obj;
						$proto107=array();
			$obj = new SQLField(array(
	"m_strName" => "longitude",
	"m_strTable" => "t_people"
));

$proto107["m_expr"]=$obj;
$proto107["m_alias"] = "";
$obj = new SQLFieldListItem($proto107);

$proto0["m_fieldlist"][]=$obj;
						$proto109=array();
			$obj = new SQLField(array(
	"m_strName" => "latitude",
	"m_strTable" => "t_people"
));

$proto109["m_expr"]=$obj;
$proto109["m_alias"] = "";
$obj = new SQLFieldListItem($proto109);

$proto0["m_fieldlist"][]=$obj;
						$proto111=array();
			$obj = new SQLField(array(
	"m_strName" => "Agree",
	"m_strTable" => "t_people"
));

$proto111["m_expr"]=$obj;
$proto111["m_alias"] = "";
$obj = new SQLFieldListItem($proto111);

$proto0["m_fieldlist"][]=$obj;
						$proto113=array();
			$obj = new SQLField(array(
	"m_strName" => "Sign_date",
	"m_strTable" => "t_people"
));

$proto113["m_expr"]=$obj;
$proto113["m_alias"] = "";
$obj = new SQLFieldListItem($proto113);

$proto0["m_fieldlist"][]=$obj;
						$proto115=array();
			$obj = new SQLField(array(
	"m_strName" => "Active",
	"m_strTable" => "t_people"
));

$proto115["m_expr"]=$obj;
$proto115["m_alias"] = "";
$obj = new SQLFieldListItem($proto115);

$proto0["m_fieldlist"][]=$obj;
						$proto117=array();
			$obj = new SQLField(array(
	"m_strName" => "Acode",
	"m_strTable" => "t_people"
));

$proto117["m_expr"]=$obj;
$proto117["m_alias"] = "";
$obj = new SQLFieldListItem($proto117);

$proto0["m_fieldlist"][]=$obj;
$proto0["m_fromlist"] = array();
												$proto119=array();
$proto119["m_link"] = "SQLL_MAIN";
			$proto120=array();
$proto120["m_strName"] = "t_people";
$proto120["m_columns"] = array();
$proto120["m_columns"][] = "people_id";
$proto120["m_columns"][] = "institution";
$proto120["m_columns"][] = "prof_provider";
$proto120["m_columns"][] = "firstname";
$proto120["m_columns"][] = "lastname";
$proto120["m_columns"][] = "image_path";
$proto120["m_columns"][] = "street";
$proto120["m_columns"][] = "house_nr";
$proto120["m_columns"][] = "zip";
$proto120["m_columns"][] = "location";
$proto120["m_columns"][] = "locationarea";
$proto120["m_columns"][] = "tel_p";
$proto120["m_columns"][] = "tel_m";
$proto120["m_columns"][] = "email";
$proto120["m_columns"][] = "username";
$proto120["m_columns"][] = "password";
$proto120["m_columns"][] = "picture";
$proto120["m_columns"][] = "picture_2";
$proto120["m_columns"][] = "gender";
$proto120["m_columns"][] = "adminstatus_to_delete";
$proto120["m_columns"][] = "birthdate";
$proto120["m_columns"][] = "enabled";
$proto120["m_columns"][] = "temp_sched_from";
$proto120["m_columns"][] = "temp_sched_to";
$proto120["m_columns"][] = "joiningdate";
$proto120["m_columns"][] = "coord_accuracy";
$proto120["m_columns"][] = "monday";
$proto120["m_columns"][] = "tuesday";
$proto120["m_columns"][] = "wednesday";
$proto120["m_columns"][] = "thursday";
$proto120["m_columns"][] = "friday";
$proto120["m_columns"][] = "saturday";
$proto120["m_columns"][] = "sunday";
$proto120["m_columns"][] = "monday_t";
$proto120["m_columns"][] = "tuesday_t";
$proto120["m_columns"][] = "wednesday_t";
$proto120["m_columns"][] = "thursday_t";
$proto120["m_columns"][] = "friday_t";
$proto120["m_columns"][] = "saturday_t";
$proto120["m_columns"][] = "sunday_t";
$proto120["m_columns"][] = "preferred_contact_by";
$proto120["m_columns"][] = "date_last_adress_change";
$proto120["m_columns"][] = "map_in";
$proto120["m_columns"][] = "IconPath";
$proto120["m_columns"][] = "Icon";
$proto120["m_columns"][] = "note";
$proto120["m_columns"][] = "price_per_hour";
$proto120["m_columns"][] = "psych_time_loose_tight";
$proto120["m_columns"][] = "psych_exact_creativ";
$proto120["m_columns"][] = "psych_heart_thing";
$proto120["m_columns"][] = "psych_easy_security";
$proto120["m_columns"][] = "psych_conflict_take_leave";
$proto120["m_columns"][] = "longitude";
$proto120["m_columns"][] = "latitude";
$proto120["m_columns"][] = "Agree";
$proto120["m_columns"][] = "Sign_date";
$proto120["m_columns"][] = "Active";
$proto120["m_columns"][] = "Acode";
$obj = new SQLTable($proto120);

$proto119["m_table"] = $obj;
$proto119["m_alias"] = "";
$proto121=array();
$proto121["m_sql"] = "";
$proto121["m_uniontype"] = "SQLL_UNKNOWN";
	$obj = new SQLNonParsed(array(
	"m_sql" => ""
));

$proto121["m_column"]=$obj;
$proto121["m_contained"] = array();
$proto121["m_strCase"] = "";
$proto121["m_havingmode"] = "0";
$proto121["m_inBrackets"] = "0";
$proto121["m_useAlias"] = "0";
$obj = new SQLLogicalExpr($proto121);

$proto119["m_joinon"] = $obj;
$obj = new SQLFromListItem($proto119);

$proto0["m_fromlist"][]=$obj;
$proto0["m_groupby"] = array();
$proto0["m_orderby"] = array();
$obj = new SQLQuery($proto0);

	return $obj;
}
$queryData_t_people = createSqlQuery_t_people();
																																																									$tdatat_people[".sqlquery"] = $queryData_t_people;
	
if(isset($tdatat_people["field2"])){
	$tdatat_people["field2"]["LookupTable"] = "carscars_view";
	$tdatat_people["field2"]["LookupOrderBy"] = "name";
	$tdatat_people["field2"]["LookupType"] = 4;
	$tdatat_people["field2"]["LinkField"] = "email";
	$tdatat_people["field2"]["DisplayField"] = "name";
	$tdatat_people[".hasCustomViewField"] = true;
}

$tableEvents["t_people"] = new eventsBase;
$tdatat_people[".hasEvents"] = false;

$cipherer = new RunnerCipherer("t_people");

?>