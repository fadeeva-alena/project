<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_people_variables.php");

if(!@$_SESSION["UserID"])
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search") && !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Add"))
{
	echo "<p>"."You don't have permissions to access this table"." <a href=\"login.php\">"."Back to login page"."</a></p>";
	exit();
}


include('libs/Smarty.class.php');
$smarty = new Smarty();



$conn=db_connect();


//	process reqest data, fill session variables

if(!count($_POST) && !count($_GET))
{
	$sess_unset = array();
	foreach($_SESSION as $key=>$value)
		if(substr($key,0,strlen($strTableName)+1)==$strTableName."_" &&
			strpos(substr($key,strlen($strTableName)+1),"_")===false)
			$sess_unset[] = $key;
	foreach($sess_unset as $key)
		unset($_SESSION[$key]);
}

//	Before Process event
if(function_exists("BeforeProcessList"))
	BeforeProcessList($conn);

if(@$_REQUEST["a"]=="showall")
	$_SESSION[$strTableName."_search"]=0;
else if(@$_REQUEST["a"]=="search")
{
	$_SESSION[$strTableName."_searchfield"]=postvalue("SearchField");
	$_SESSION[$strTableName."_searchoption"]=postvalue("SearchOption");
	$_SESSION[$strTableName."_searchfor"]=postvalue("SearchFor");
	if(postvalue("SearchFor")!="" || postvalue("SearchOption")=='Empty')
		$_SESSION[$strTableName."_search"]=1;
	else
		$_SESSION[$strTableName."_search"]=0;
	$_SESSION[$strTableName."_pagenumber"]=1;
}
else if(@$_REQUEST["a"]=="advsearch")
{
	$_SESSION[$strTableName."_asearchnot"]=array();
	$_SESSION[$strTableName."_asearchopt"]=array();
	$_SESSION[$strTableName."_asearchfor"]=array();
	$_SESSION[$strTableName."_asearchfor2"]=array();
	$tosearch=0;
	$asearchfield = postvalue("asearchfield");
	$_SESSION[$strTableName."_asearchtype"] = postvalue("type");
	if(!$_SESSION[$strTableName."_asearchtype"])
		$_SESSION[$strTableName."_asearchtype"]="and";
	foreach($asearchfield as $field)
	{
		$gfield=GoodFieldName($field);
		$asopt=postvalue("asearchopt_".$gfield);
		$value1=postvalue("value_".$gfield);
		$type=postvalue("type_".$gfield);
		$value2=postvalue("value1_".$gfield);
		$not=postvalue("not_".$gfield);
		if($value1 || $asopt=='Empty')
		{
			$tosearch=1;
			$_SESSION[$strTableName."_asearchopt"][$field]=$asopt;
			if(!is_array($value1))
				$_SESSION[$strTableName."_asearchfor"][$field]=$value1;
			else
				$_SESSION[$strTableName."_asearchfor"][$field]=combinevalues($value1);
			$_SESSION[$strTableName."_asearchfortype"][$field]=$type;
			if($value2)
				$_SESSION[$strTableName."_asearchfor2"][$field]=$value2;
			$_SESSION[$strTableName."_asearchnot"][$field]=($not=="on");
		}
	}
	if($tosearch)
		$_SESSION[$strTableName."_search"]=2;
	else
		$_SESSION[$strTableName."_search"]=0;
	$_SESSION[$strTableName."_pagenumber"]=1;
}



if(@$_REQUEST["orderby"])
	$_SESSION[$strTableName."_orderby"]=@$_REQUEST["orderby"];

if(@$_REQUEST["pagesize"])
{
	$_SESSION[$strTableName."_pagesize"]=@$_REQUEST["pagesize"];
	$_SESSION[$strTableName."_pagenumber"]=1;
}

if(@$_REQUEST["goto"])
	$_SESSION[$strTableName."_pagenumber"]=@$_REQUEST["goto"];


//	process reqest data - end

$includes="";



$includes.="<script type=\"text/javascript\" src=\"include/jquery.js\"></script>\r\n";
if ($useAJAX) {
	$includes.="<script type=\"text/javascript\" src=\"include/ajaxsuggest.js\"></script>\r\n";

}
$includes.="<script type=\"text/javascript\" src=\"include/jsfunctions.js\">".
"</script>\n".
"<script type=\"text/javascript\">".
"\nvar bSelected=false;".
"\nvar TEXT_FIRST = \""."First"."\";".
"\nvar TEXT_PREVIOUS = \""."Previous"."\";".
"\nvar TEXT_NEXT = \""."Next"."\";".
"\nvar TEXT_LAST = \""."Last"."\";".
"\nvar TEXT_PLEASE_SELECT='".jsreplace("Please select")."';".
"\nvar TEXT_SAVE='".jsreplace("Save")."';".
"\nvar TEXT_CANCEL='".jsreplace("Cancel")."';".
"\nvar TEXT_INLINE_ERROR='".jsreplace("Error occurred")."';".
"\nvar locale_dateformat = ".$locale_info["LOCALE_IDATE"].";".
"\nvar locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";".
"\nvar bLoading=false;\r\n";

if ($useAJAX) {
	$includes.="var INLINE_EDIT_TABLE='t_people_edit.php';\r\n";
	$includes.="var INLINE_ADD_TABLE='t_people_add.php';\r\n";
	$includes.="var INLINE_VIEW_TABLE='t_people_view.php';\r\n";
	$includes.="var SUGGEST_TABLE='t_people_searchsuggest.php';\r\n";
	$includes.="var MASTER_PREVIEW_TABLE='t_people_masterpreview.php';\r\n";
}
$includes.="\n</script>\n";
if ($useAJAX) {
$includes.="<div id=\"search_suggest\"></div>";
$includes.="<div id=\"master_details\" onmouseover=\"RollDetailsLink.showPopup();\" onmouseout=\"RollDetailsLink.hidePopup();\"></div>";
}

$smarty->assign("includes",$includes);
$smarty->assign("useAJAX",$useAJAX);


//	process session variables
//	order by
$strOrderBy="";
$order_ind=-1;

$smarty->assign("order_dir_people_id","a");
$smarty->assign("order_dir_institution","a");
$smarty->assign("order_dir_prof_provider","a");
$smarty->assign("order_dir_firstname","a");
$smarty->assign("order_dir_lastname","a");
$smarty->assign("order_dir_image_path","a");
$smarty->assign("order_dir_street","a");
$smarty->assign("order_dir_house_nr","a");
$smarty->assign("order_dir_zip","a");
$smarty->assign("order_dir_location","a");
$smarty->assign("order_dir_locationarea","a");
$smarty->assign("order_dir_tel_p","a");
$smarty->assign("order_dir_tel_m","a");
$smarty->assign("order_dir_email","a");
$smarty->assign("order_dir_username","a");
$smarty->assign("order_dir_password","a");
$smarty->assign("order_dir_picture","a");
$smarty->assign("order_dir_picture_2","a");
$smarty->assign("order_dir_gender","a");
$smarty->assign("order_dir_birthdate","a");
$smarty->assign("order_dir_enabled","a");
$smarty->assign("order_dir_temp_sched_from","a");
$smarty->assign("order_dir_temp_sched_to","a");
$smarty->assign("order_dir_joiningdate","a");
$smarty->assign("order_dir_coord_accuracy","a");
$smarty->assign("order_dir_monday","a");
$smarty->assign("order_dir_tuesday","a");
$smarty->assign("order_dir_wednesday","a");
$smarty->assign("order_dir_thursday","a");
$smarty->assign("order_dir_friday","a");
$smarty->assign("order_dir_saturday","a");
$smarty->assign("order_dir_sunday","a");
$smarty->assign("order_dir_monday_t","a");
$smarty->assign("order_dir_tuesday_t","a");
$smarty->assign("order_dir_wednesday_t","a");
$smarty->assign("order_dir_thursday_t","a");
$smarty->assign("order_dir_friday_t","a");
$smarty->assign("order_dir_saturday_t","a");
$smarty->assign("order_dir_sunday_t","a");
$smarty->assign("order_dir_preferred_contact_by","a");
$smarty->assign("order_dir_date_last_adress_change","a");
$smarty->assign("order_dir_map_in","a");
$smarty->assign("order_dir_IconPath","a");
$smarty->assign("order_dir_Icon","a");
$smarty->assign("order_dir_note","a");
$smarty->assign("order_dir_price_per_hour","a");
$smarty->assign("order_dir_psych_time_loose_tight","a");
$smarty->assign("order_dir_psych_exact_creativ","a");
$smarty->assign("order_dir_psych_heart_thing","a");
$smarty->assign("order_dir_psych_easy_security","a");
$smarty->assign("order_dir_psych_conflict_take_leave","a");
$smarty->assign("order_dir_longitude","a");
$smarty->assign("order_dir_latitude","a");
$smarty->assign("order_dir_Agree","a");
$smarty->assign("order_dir_Sign_date","a");
$smarty->assign("order_dir_Active","a");
$smarty->assign("order_dir_Acode","a");

$recno=1;
$numrows=0;


if(@$_SESSION[$strTableName."_orderby"])
{
	$order_field=substr($_SESSION[$strTableName."_orderby"],1);
	$order_dir=substr($_SESSION[$strTableName."_orderby"],0,1);
	$order_ind=GetFieldIndex($order_field);

	$smarty->assign("order_dir_people_id","a");
	if($order_field=="people_id")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_people_id","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_people_id","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_institution","a");
	if($order_field=="institution")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_institution","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_institution","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_prof_provider","a");
	if($order_field=="prof_provider")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_prof_provider","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_prof_provider","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_firstname","a");
	if($order_field=="firstname")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_firstname","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_firstname","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_lastname","a");
	if($order_field=="lastname")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_lastname","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_lastname","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_image_path","a");
	if($order_field=="image_path")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_image_path","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_image_path","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_street","a");
	if($order_field=="street")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_street","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_street","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_house_nr","a");
	if($order_field=="house_nr")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_house_nr","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_house_nr","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_zip","a");
	if($order_field=="zip")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_zip","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_zip","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_location","a");
	if($order_field=="location")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_location","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_location","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_locationarea","a");
	if($order_field=="locationarea")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_locationarea","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_locationarea","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_tel_p","a");
	if($order_field=="tel_p")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_tel_p","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_tel_p","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_tel_m","a");
	if($order_field=="tel_m")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_tel_m","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_tel_m","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_email","a");
	if($order_field=="email")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_email","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_email","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_username","a");
	if($order_field=="username")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_username","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_username","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_password","a");
	if($order_field=="password")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_password","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_password","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_picture","a");
	if($order_field=="picture")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_picture","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_picture","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_picture_2","a");
	if($order_field=="picture_2")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_picture_2","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_picture_2","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_gender","a");
	if($order_field=="gender")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_gender","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_gender","<img src=\"images/".$img.".gif\" border=0>");
	}
		$smarty->assign("order_dir_birthdate","a");
	if($order_field=="birthdate")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_birthdate","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_birthdate","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_enabled","a");
	if($order_field=="enabled")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_enabled","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_enabled","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_temp_sched_from","a");
	if($order_field=="temp_sched_from")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_temp_sched_from","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_temp_sched_from","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_temp_sched_to","a");
	if($order_field=="temp_sched_to")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_temp_sched_to","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_temp_sched_to","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_joiningdate","a");
	if($order_field=="joiningdate")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_joiningdate","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_joiningdate","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_coord_accuracy","a");
	if($order_field=="coord_accuracy")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_coord_accuracy","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_coord_accuracy","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_monday","a");
	if($order_field=="monday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_monday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_monday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_tuesday","a");
	if($order_field=="tuesday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_tuesday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_tuesday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_wednesday","a");
	if($order_field=="wednesday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_wednesday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_wednesday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_thursday","a");
	if($order_field=="thursday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_thursday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_thursday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_friday","a");
	if($order_field=="friday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_friday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_friday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_saturday","a");
	if($order_field=="saturday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_saturday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_saturday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_sunday","a");
	if($order_field=="sunday")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_sunday","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_sunday","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_monday_t","a");
	if($order_field=="monday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_monday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_monday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_tuesday_t","a");
	if($order_field=="tuesday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_tuesday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_tuesday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_wednesday_t","a");
	if($order_field=="wednesday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_wednesday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_wednesday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_thursday_t","a");
	if($order_field=="thursday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_thursday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_thursday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_friday_t","a");
	if($order_field=="friday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_friday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_friday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_saturday_t","a");
	if($order_field=="saturday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_saturday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_saturday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_sunday_t","a");
	if($order_field=="sunday_t")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_sunday_t","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_sunday_t","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_preferred_contact_by","a");
	if($order_field=="preferred_contact_by")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_preferred_contact_by","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_preferred_contact_by","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_date_last_adress_change","a");
	if($order_field=="date_last_adress_change")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_date_last_adress_change","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_date_last_adress_change","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_map_in","a");
	if($order_field=="map_in")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_map_in","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_map_in","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_IconPath","a");
	if($order_field=="IconPath")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_IconPath","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_IconPath","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_Icon","a");
	if($order_field=="Icon")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_Icon","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_Icon","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_note","a");
	if($order_field=="note")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_note","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_note","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_price_per_hour","a");
	if($order_field=="price_per_hour")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_price_per_hour","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_price_per_hour","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_psych_time_loose_tight","a");
	if($order_field=="psych_time_loose_tight")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_psych_time_loose_tight","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_psych_time_loose_tight","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_psych_exact_creativ","a");
	if($order_field=="psych_exact_creativ")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_psych_exact_creativ","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_psych_exact_creativ","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_psych_heart_thing","a");
	if($order_field=="psych_heart_thing")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_psych_heart_thing","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_psych_heart_thing","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_psych_easy_security","a");
	if($order_field=="psych_easy_security")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_psych_easy_security","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_psych_easy_security","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_psych_conflict_take_leave","a");
	if($order_field=="psych_conflict_take_leave")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_psych_conflict_take_leave","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_psych_conflict_take_leave","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_longitude","a");
	if($order_field=="longitude")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_longitude","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_longitude","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_latitude","a");
	if($order_field=="latitude")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_latitude","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_latitude","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_Agree","a");
	if($order_field=="Agree")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_Agree","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_Agree","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_Sign_date","a");
	if($order_field=="Sign_date")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_Sign_date","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_Sign_date","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_Active","a");
	if($order_field=="Active")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_Active","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_Active","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_Acode","a");
	if($order_field=="Acode")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_Acode","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_Acode","<img src=\"images/".$img.".gif\" border=0>");
	}

	if($order_ind)
	{
		if($order_dir=="a")
			$strOrderBy="order by ".($order_ind)." asc";
		else 
			$strOrderBy="order by ".($order_ind)." desc";
	}
}
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;

//	page number
$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize=$gPageSize;

	$smarty->assign("rpp10_selected",($PageSize==10)?"selected":"");
	$smarty->assign("rpp20_selected",($PageSize==20)?"selected":"");
	$smarty->assign("rpp30_selected",($PageSize==30)?"selected":"");
	$smarty->assign("rpp50_selected",($PageSize==50)?"selected":"");
	$smarty->assign("rpp100_selected",($PageSize==100)?"selected":"");
	$smarty->assign("rpp500_selected",($PageSize==500)?"selected":"");

// delete record
$selected_recs=array();
if (@$_REQUEST["mdelete"])
{
	foreach(@$_REQUEST["mdelete"] as $ind)
	{
		$keys=array();
		$keys["people_id"]=refine($_REQUEST["mdelete1"][$ind-1]);
		$selected_recs[]=$keys;
	}
}
elseif(@$_REQUEST["selection"])
{
	foreach(@$_REQUEST["selection"] as $keyblock)
	{
		$arr=split("&",refine($keyblock));
		if(count($arr)<1)
			continue;
		$keys=array();
		$keys["people_id"]=urldecode(@$arr[0]);
		$selected_recs[]=$keys;
	}
}

$records_deleted=0;
foreach($selected_recs as $keys)
{
	$where = KeyWhere($keys);

	$strSQL="delete from ".AddTableWrappers($strOriginalTableName)." where ".$where;
	$retval=true;
	if(function_exists("AfterDelete") || function_exists("BeforeDelete"))
	{
		$deletedrs = db_query(gSQLWhere($where),$conn);
		$deleted_values = db_fetch_array($deletedrs);
	}
	if(function_exists("BeforeDelete"))
		$retval = BeforeDelete($where,$deleted_values);
	if($retval && @$_REQUEST["a"]=="delete")
	{
		$records_deleted++;
				LogInfo($strSQL);
		db_exec($strSQL,$conn);
		if(function_exists("AfterDelete"))
			AfterDelete($where,$deleted_values);
	}
}

if(count($selected_recs))
{
	if(function_exists("AfterMassDelete"))
		AfterMassDelete($records_deleted);
}

//	make sql "select" string

//$strSQL = $gstrSQL;
$strWhereClause="";

//	add search params

if(@$_SESSION[$strTableName."_search"]==1)
//	 regular search
{  
	$strSearchFor=trim($_SESSION[$strTableName."_searchfor"]);
	$strSearchOption=trim($_SESSION[$strTableName."_searchoption"]);
	if(@$_SESSION[$strTableName."_searchfield"])
	{
		$strSearchField = $_SESSION[$strTableName."_searchfield"];
		if($where = StrWhere($strSearchField, $strSearchFor, $strSearchOption, ""))
			$strWhereClause = whereAdd($strWhereClause,$where);
//			$strSQL = AddWhere($strSQL,$where);
		else
			$strWhereClause = whereAdd($strWhereClause,"1=0");
//			$strSQL = AddWhere($strSQL,"1=0");
	}
	else
	{
		$strWhere = "1=0";
		if($where=StrWhere("people_id", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("institution", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("prof_provider", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("firstname", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("lastname", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("image_path", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("street", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("house_nr", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("zip", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("location", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("locationarea", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("tel_p", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("tel_m", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("email", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("username", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("password", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("picture", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("gender", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
			if($where=StrWhere("birthdate", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("enabled", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("temp_sched_from", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("temp_sched_to", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("joiningdate", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("coord_accuracy", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("monday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("tuesday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("wednesday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("thursday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("friday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("saturday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("sunday", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("monday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("tuesday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("wednesday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("thursday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("friday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("saturday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("sunday_t", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("preferred_contact_by", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("date_last_adress_change", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("map_in", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("IconPath", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("note", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("price_per_hour", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("psych_time_loose_tight", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("psych_exact_creativ", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("psych_heart_thing", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("psych_easy_security", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("psych_conflict_take_leave", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("longitude", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("latitude", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("Agree", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("Sign_date", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("Active", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("Acode", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		$strWhereClause = whereAdd($strWhereClause,$strWhere);
//		$strSQL = AddWhere($strSQL,$strWhere);
	}
}
else if(@$_SESSION[$strTableName."_search"]==2)
//	 advanced search
{
	$sWhere="";
	foreach(@$_SESSION[$strTableName."_asearchfor"] as $f => $sfor)
		{
			$strSearchFor=trim($sfor);
			$strSearchFor2="";
			$type=@$_SESSION[$strTableName."_asearchfortype"][$f];
			if(array_key_exists($f,@$_SESSION[$strTableName."_asearchfor2"]))
				$strSearchFor2=trim(@$_SESSION[$strTableName."_asearchfor2"][$f]);
			if($strSearchFor!="" || true)
			{
				if (!$sWhere) 
				{
					if($_SESSION[$strTableName."_asearchtype"]=="and")
						$sWhere="1=1";
					else
						$sWhere="1=0";
				}
				$strSearchOption=trim($_SESSION[$strTableName."_asearchopt"][$f]);
				if($where=StrWhereAdv($f, $strSearchFor, $strSearchOption, $strSearchFor2,$type))
				{
					if($_SESSION[$strTableName."_asearchnot"][$f])
						$where="not (".$where.")";
					if($_SESSION[$strTableName."_asearchtype"]=="and")
	   					$sWhere .= " and ".$where;
					else
	   					$sWhere .= " or ".$where;
				}
			}
		}
		$strWhereClause = whereAdd($strWhereClause,$sWhere);
//		$strSQL = AddWhere($strSQL,$sWhere);
	}





$strSQL = gSQLWhere($strWhereClause);

//	order by
$strSQL.=" ".trim($strOrderBy);

//	save SQL for use in "Export" and "Printer-friendly" pages

$_SESSION[$strTableName."_sql"] = $strSQL;
$_SESSION[$strTableName."_where"] = $strWhereClause;
$_SESSION[$strTableName."_order"] = $strOrderBy;

$rowsfound=false;

//	select and display records
if(CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	$strSQLbak = $strSQL;
	if(function_exists("BeforeQueryList"))
		BeforeQueryList($strSQL,$strWhereClause,$strOrderBy);
//	Rebuild SQL if needed
	if($strSQL!=$strSQLbak)
	{
//	changed $strSQL - old style	
		$numrows=GetRowCount($strSQL);
	}
	else
	{
		$strSQL = gSQLWhere($strWhereClause);
		$strSQL.=" ".trim($strOrderBy);
		$numrows=gSQLRowCount($strWhereClause,0);
	}
	LogInfo($strSQL);

//	 Pagination:
	if(!$numrows)
	{
		$smarty->assign("rowsfound",false);
		$rowsfound=false;
		$message="No records found";
				$smarty->assign("message",$message);
	}
	else
	{
		$smarty->assign("rowsfound",true);
		$rowsfound=true;
		$smarty->assign("records_found",$numrows);
		$maxRecords = $numrows;
		$maxpages=ceil($maxRecords/$PageSize);
		if($mypage > $maxpages)
			$mypage = $maxpages;
		if($mypage<1) 
			$mypage=1;
		$maxrecs=$PageSize;
		$smarty->assign("page",$mypage);
		$smarty->assign("maxpages",$maxpages);

//	write pagination
$smarty->assign("pagination","<script language=\"JavaScript\">WritePagination(".$mypage.",".$maxpages.");
		function GotoPage(nPageNumber)
		{
			window.location='t_people_list.php?goto='+nPageNumber;
		}
</script>");
		
		$strSQL.=" limit ".(($mypage-1)*$PageSize).",".$PageSize;
	}
	$rs=db_query($strSQL,$conn);

//	hide colunm headers if needed
	$recordsonpage=$numrows-($mypage-1)*$PageSize;
	if($recordsonpage>$PageSize)
	$recordsonpage=$PageSize;
	if($recordsonpage>=1)
		$smarty->assign("column1show",true);
	else
		$smarty->assign("column1show",false);


//	fill $rowinfo array
	$rowinfo = array();
	$shade=false;
	$editlink="";
	$copylink="";

	while($data=db_fetch_array($rs))
	{
		if(function_exists("BeforeProcessRowList"))
		{
			if(!BeforeProcessRowList($data))
				continue;
		}
		break;
	}

	while($data && $recno<=$PageSize)
	{
		$row=array();
		if(!$shade)
		{
			$row["shadeclass"]='class="shade"';
			$row["shadeclassname"]="shade";
			$shade=true;
		}
		else
		{
			$row["shadeclass"]="";
			$row["shadeclassname"]="";
			$shade=false;
		}
		for($col=1;$data && $recno<=$PageSize && $col<=1;$col++)
		{


//	key fields
			$keyblock="";
			$row[$col."id1"]=htmlspecialchars($data["people_id"]);
			$keyblock.= rawurlencode($data["people_id"]);
			$row[$col."keyblock"]=htmlspecialchars($keyblock);
			$row[$col."recno"] = $recno;
//	detail tables
//	edit page link
			$editlink="";
			$editlink.="editid1=".htmlspecialchars(rawurlencode($data["people_id"]));
			$row[$col."editlink"]=$editlink;

			$copylink="";
			$copylink.="copyid1=".htmlspecialchars(rawurlencode($data["people_id"]));
			$row[$col."copylink"]=$copylink;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["people_id"]));


//	people_id - 
			$value="";
				$value = ProcessLargeText(GetData($data,"people_id", ""),"field=people%5Fid".$keylink,"",MODE_LIST);
			$row[$col."people_id_value"]=$value;

//	institution - 
			$value="";
				$value = ProcessLargeText(GetData($data,"institution", ""),"field=institution".$keylink,"",MODE_LIST);
			$row[$col."institution_value"]=$value;

//	prof_provider - 
			$value="";
				$value = ProcessLargeText(GetData($data,"prof_provider", ""),"field=prof%5Fprovider".$keylink,"",MODE_LIST);
			$row[$col."prof_provider_value"]=$value;

//	firstname - 
			$value="";
				$value = ProcessLargeText(GetData($data,"firstname", ""),"field=firstname".$keylink,"",MODE_LIST);
			$row[$col."firstname_value"]=$value;

//	lastname - 
			$value="";
				$value = ProcessLargeText(GetData($data,"lastname", ""),"field=lastname".$keylink,"",MODE_LIST);
			$row[$col."lastname_value"]=$value;

//	image_path - File-based Image
			$value="";
				if(CheckImageExtension($data["image_path"])) 
			{
						$value="<img";
										$value.=" border=0";
				$value.=" src=\"".htmlspecialchars(AddLinkPrefix("image_path",$data["image_path"]))."\">";
			}
			$row[$col."image_path_value"]=$value;

//	street - 
			$value="";
				$value = ProcessLargeText(GetData($data,"street", ""),"field=street".$keylink,"",MODE_LIST);
			$row[$col."street_value"]=$value;

//	house_nr - 
			$value="";
				$value = ProcessLargeText(GetData($data,"house_nr", ""),"field=house%5Fnr".$keylink,"",MODE_LIST);
			$row[$col."house_nr_value"]=$value;

//	zip - 
			$value="";
				$value = ProcessLargeText(GetData($data,"zip", ""),"field=zip".$keylink,"",MODE_LIST);
			$row[$col."zip_value"]=$value;

//	location - 
			$value="";
				$value = ProcessLargeText(GetData($data,"location", ""),"field=location".$keylink,"",MODE_LIST);
			$row[$col."location_value"]=$value;

//	locationarea - 
			$value="";
				$value = ProcessLargeText(GetData($data,"locationarea", ""),"field=locationarea".$keylink,"",MODE_LIST);
			$row[$col."locationarea_value"]=$value;

//	tel_p - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tel_p", ""),"field=tel%5Fp".$keylink,"",MODE_LIST);
			$row[$col."tel_p_value"]=$value;

//	tel_m - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tel_m", ""),"field=tel%5Fm".$keylink,"",MODE_LIST);
			$row[$col."tel_m_value"]=$value;

//	email - 
			$value="";
				$value = ProcessLargeText(GetData($data,"email", ""),"field=email".$keylink,"",MODE_LIST);
			$row[$col."email_value"]=$value;

//	username - 
			$value="";
				$value = ProcessLargeText(GetData($data,"username", ""),"field=username".$keylink,"",MODE_LIST);
			$row[$col."username_value"]=$value;

//	password - 
			$value="";
				$value = ProcessLargeText(GetData($data,"password", ""),"field=password".$keylink,"",MODE_LIST);
			$row[$col."password_value"]=$value;

//	picture - 
			$value="";
				$value = ProcessLargeText(GetData($data,"picture", ""),"field=picture".$keylink,"",MODE_LIST);
			$row[$col."picture_value"]=$value;

//	picture_2 - Database Image
			$value="";
							$value = "<img";
										$value.=" border=0";
				$value.=" src=\"t_people_imager.php?field=picture%5F2".$keylink."\">";
			$row[$col."picture_2_value"]=$value;

//	gender - 
			$value="";
				$value = ProcessLargeText(GetData($data,"gender", ""),"field=gender".$keylink,"",MODE_LIST);
			$row[$col."gender_value"]=$value;


//	birthdate - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"birthdate", "Short Date"),"field=birthdate".$keylink,"",MODE_LIST);
			$row[$col."birthdate_value"]=$value;

//	enabled - 
			$value="";
				$value = ProcessLargeText(GetData($data,"enabled", ""),"field=enabled".$keylink,"",MODE_LIST);
			$row[$col."enabled_value"]=$value;

//	temp_sched_from - 
			$value="";
				$value = ProcessLargeText(GetData($data,"temp_sched_from", ""),"field=temp%5Fsched%5Ffrom".$keylink,"",MODE_LIST);
			$row[$col."temp_sched_from_value"]=$value;

//	temp_sched_to - 
			$value="";
				$value = ProcessLargeText(GetData($data,"temp_sched_to", ""),"field=temp%5Fsched%5Fto".$keylink,"",MODE_LIST);
			$row[$col."temp_sched_to_value"]=$value;

//	joiningdate - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"joiningdate", "Short Date"),"field=joiningdate".$keylink,"",MODE_LIST);
			$row[$col."joiningdate_value"]=$value;

//	coord_accuracy - 
			$value="";
				$value = ProcessLargeText(GetData($data,"coord_accuracy", ""),"field=coord%5Faccuracy".$keylink,"",MODE_LIST);
			$row[$col."coord_accuracy_value"]=$value;

//	monday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"monday", ""),"field=monday".$keylink,"",MODE_LIST);
			$row[$col."monday_value"]=$value;

//	tuesday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tuesday", ""),"field=tuesday".$keylink,"",MODE_LIST);
			$row[$col."tuesday_value"]=$value;

//	wednesday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"wednesday", ""),"field=wednesday".$keylink,"",MODE_LIST);
			$row[$col."wednesday_value"]=$value;

//	thursday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"thursday", ""),"field=thursday".$keylink,"",MODE_LIST);
			$row[$col."thursday_value"]=$value;

//	friday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"friday", ""),"field=friday".$keylink,"",MODE_LIST);
			$row[$col."friday_value"]=$value;

//	saturday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"saturday", ""),"field=saturday".$keylink,"",MODE_LIST);
			$row[$col."saturday_value"]=$value;

//	sunday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"sunday", ""),"field=sunday".$keylink,"",MODE_LIST);
			$row[$col."sunday_value"]=$value;

//	monday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"monday_t", ""),"field=monday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."monday_t_value"]=$value;

//	tuesday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tuesday_t", ""),"field=tuesday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."tuesday_t_value"]=$value;

//	wednesday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"wednesday_t", ""),"field=wednesday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."wednesday_t_value"]=$value;

//	thursday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"thursday_t", ""),"field=thursday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."thursday_t_value"]=$value;

//	friday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"friday_t", ""),"field=friday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."friday_t_value"]=$value;

//	saturday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"saturday_t", ""),"field=saturday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."saturday_t_value"]=$value;

//	sunday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"sunday_t", ""),"field=sunday%5Ft".$keylink,"",MODE_LIST);
			$row[$col."sunday_t_value"]=$value;

//	preferred_contact_by - 
			$value="";
				$value = ProcessLargeText(GetData($data,"preferred_contact_by", ""),"field=preferred%5Fcontact%5Fby".$keylink,"",MODE_LIST);
			$row[$col."preferred_contact_by_value"]=$value;

//	date_last_adress_change - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"date_last_adress_change", "Short Date"),"field=date%5Flast%5Fadress%5Fchange".$keylink,"",MODE_LIST);
			$row[$col."date_last_adress_change_value"]=$value;

//	map_in - 
			$value="";
				$value = ProcessLargeText(GetData($data,"map_in", ""),"field=map%5Fin".$keylink,"",MODE_LIST);
			$row[$col."map_in_value"]=$value;

//	IconPath - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IconPath", ""),"field=IconPath".$keylink,"",MODE_LIST);
			$row[$col."IconPath_value"]=$value;

//	Icon - Database Image
			$value="";
							$value = "<img";
										$value.=" border=0";
				$value.=" src=\"t_people_imager.php?field=Icon".$keylink."\">";
			$row[$col."Icon_value"]=$value;

//	note - 
			$value="";
				$value = ProcessLargeText(GetData($data,"note", ""),"field=note".$keylink,"",MODE_LIST);
			$row[$col."note_value"]=$value;

//	price_per_hour - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"price_per_hour", "Number"),"field=price%5Fper%5Fhour".$keylink,"",MODE_LIST);
			$row[$col."price_per_hour_value"]=$value;

//	psych_time_loose_tight - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_time_loose_tight", ""),"field=psych%5Ftime%5Floose%5Ftight".$keylink,"",MODE_LIST);
			$row[$col."psych_time_loose_tight_value"]=$value;

//	psych_exact_creativ - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_exact_creativ", ""),"field=psych%5Fexact%5Fcreativ".$keylink,"",MODE_LIST);
			$row[$col."psych_exact_creativ_value"]=$value;

//	psych_heart_thing - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_heart_thing", ""),"field=psych%5Fheart%5Fthing".$keylink,"",MODE_LIST);
			$row[$col."psych_heart_thing_value"]=$value;

//	psych_easy_security - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_easy_security", ""),"field=psych%5Feasy%5Fsecurity".$keylink,"",MODE_LIST);
			$row[$col."psych_easy_security_value"]=$value;

//	psych_conflict_take_leave - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_conflict_take_leave", ""),"field=psych%5Fconflict%5Ftake%5Fleave".$keylink,"",MODE_LIST);
			$row[$col."psych_conflict_take_leave_value"]=$value;

//	longitude - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"longitude", "Number"),"field=longitude".$keylink,"",MODE_LIST);
			$row[$col."longitude_value"]=$value;

//	latitude - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"latitude", "Number"),"field=latitude".$keylink,"",MODE_LIST);
			$row[$col."latitude_value"]=$value;

//	Agree - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Agree", ""),"field=Agree".$keylink,"",MODE_LIST);
			$row[$col."Agree_value"]=$value;

//	Sign_date - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Sign_date", ""),"field=Sign%5Fdate".$keylink,"",MODE_LIST);
			$row[$col."Sign_date_value"]=$value;

//	Active - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Active", ""),"field=Active".$keylink,"",MODE_LIST);
			$row[$col."Active_value"]=$value;

//	Acode - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Acode", ""),"field=Acode".$keylink,"",MODE_LIST);
			$row[$col."Acode_value"]=$value;
			$row[$col."show"]=true;
			if(function_exists("BeforeMoveNextList"))
				BeforeMoveNextList($data,$row,$col);
				
			while($data=db_fetch_array($rs))
			{
				if(function_exists("BeforeProcessRowList"))
				{
					if(!BeforeProcessRowList($data))
						continue;
				}
				break;
			}
			$recno++;
			
		}
		$rowinfo[]=$row;
	}
	$smarty->assign("rowinfo",$rowinfo);

}


if(CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	if($_SESSION[$strTableName."_search"]==1)
	{
		$onload = "onLoad=\"if(document.getElementById('SearchFor')) document.getElementById('ctlSearchFor').focus();\"";
		$smarty->assign("onload",$onload);
//	fill in search variables
	//	field selection
		if(@$_SESSION[$strTableName."_searchfield"]=="people_id")
			$smarty->assign("search_people_id","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="institution")
			$smarty->assign("search_institution","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="prof_provider")
			$smarty->assign("search_prof_provider","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="firstname")
			$smarty->assign("search_firstname","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="lastname")
			$smarty->assign("search_lastname","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="image_path")
			$smarty->assign("search_image_path","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="street")
			$smarty->assign("search_street","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="house_nr")
			$smarty->assign("search_house_nr","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="zip")
			$smarty->assign("search_zip","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="location")
			$smarty->assign("search_location","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="locationarea")
			$smarty->assign("search_locationarea","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="tel_p")
			$smarty->assign("search_tel_p","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="tel_m")
			$smarty->assign("search_tel_m","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="email")
			$smarty->assign("search_email","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="username")
			$smarty->assign("search_username","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="password")
			$smarty->assign("search_password","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="picture")
			$smarty->assign("search_picture","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="gender")
			$smarty->assign("search_gender","selected");
				if(@$_SESSION[$strTableName."_searchfield"]=="birthdate")
			$smarty->assign("search_birthdate","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="enabled")
			$smarty->assign("search_enabled","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="temp_sched_from")
			$smarty->assign("search_temp_sched_from","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="temp_sched_to")
			$smarty->assign("search_temp_sched_to","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="joiningdate")
			$smarty->assign("search_joiningdate","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="coord_accuracy")
			$smarty->assign("search_coord_accuracy","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="monday")
			$smarty->assign("search_monday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="tuesday")
			$smarty->assign("search_tuesday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="wednesday")
			$smarty->assign("search_wednesday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="thursday")
			$smarty->assign("search_thursday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="friday")
			$smarty->assign("search_friday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="saturday")
			$smarty->assign("search_saturday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="sunday")
			$smarty->assign("search_sunday","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="monday_t")
			$smarty->assign("search_monday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="tuesday_t")
			$smarty->assign("search_tuesday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="wednesday_t")
			$smarty->assign("search_wednesday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="thursday_t")
			$smarty->assign("search_thursday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="friday_t")
			$smarty->assign("search_friday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="saturday_t")
			$smarty->assign("search_saturday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="sunday_t")
			$smarty->assign("search_sunday_t","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="preferred_contact_by")
			$smarty->assign("search_preferred_contact_by","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="date_last_adress_change")
			$smarty->assign("search_date_last_adress_change","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="map_in")
			$smarty->assign("search_map_in","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="IconPath")
			$smarty->assign("search_IconPath","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="note")
			$smarty->assign("search_note","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="price_per_hour")
			$smarty->assign("search_price_per_hour","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="psych_time_loose_tight")
			$smarty->assign("search_psych_time_loose_tight","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="psych_exact_creativ")
			$smarty->assign("search_psych_exact_creativ","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="psych_heart_thing")
			$smarty->assign("search_psych_heart_thing","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="psych_easy_security")
			$smarty->assign("search_psych_easy_security","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="psych_conflict_take_leave")
			$smarty->assign("search_psych_conflict_take_leave","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="longitude")
			$smarty->assign("search_longitude","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="latitude")
			$smarty->assign("search_latitude","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="Agree")
			$smarty->assign("search_Agree","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="Sign_date")
			$smarty->assign("search_Sign_date","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="Active")
			$smarty->assign("search_Active","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="Acode")
			$smarty->assign("search_Acode","selected");
	// search type selection
		if(@$_SESSION[$strTableName."_searchoption"]=="Contains")
			$smarty->assign("search_contains_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Equals")
			$smarty->assign("search_equals_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Starts with ...")
			$smarty->assign("search_startswith_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="More than ...")
			$smarty->assign("search_more_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Less than ...")
			$smarty->assign("search_less_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Equal or more than ...")
			$smarty->assign("search_equalormore_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Equal or less than ...")
			$smarty->assign("search_equalorless_option_selected","selected");		
		if(@$_SESSION[$strTableName."_searchoption"]=="Empty")
			$smarty->assign("search_empty_option_selected","selected");		

		$smarty->assign("search_searchfor","value=\"".htmlspecialchars(@$_SESSION[$strTableName."_searchfor"])."\"");
	}
}

$smarty->assign("userid",htmlspecialchars($_SESSION["UserID"]));






$display_grid=true;
$display_grid=$rowsfound;

$display_records=$display_grid;
if(!$display_grid)
	$display_records=false;


$smarty->assign("display_grid",$display_grid);
$smarty->assign("display_records",$display_records);


$linkdata="";

if ($useAJAX) {
	$linkdata .= "<script type=\"text/javascript\">\r\n";

	$linkdata .= "</script>\r\n";
}

if ($useAJAX) {
$linkdata.="<script>
if(!$('[@disptype=control1]').length && $('[@disptype=controltable1]').length)
	$('[@disptype=controltable1]').hide();
</script>";
}
$smarty->assign("linkdata",$linkdata);


$strSQL=$_SESSION[$strTableName."_sql"];
$smarty->assign("guest",$_SESSION["AccessLevel"] == ACCESS_LEVEL_GUEST);




$templatefile = "t_people_list.htm";
if(function_exists("BeforeShowList"))
	BeforeShowList($smarty,$templatefile);

$smarty->display($templatefile);

