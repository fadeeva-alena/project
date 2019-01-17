<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_people_variables.php");

//	check if logged in
if(!@$_SESSION["UserID"] || !CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}

//connect database
$conn = db_connect();

include('libs/Smarty.class.php');
$smarty = new Smarty();

//	Before Process event
if(function_exists("BeforeProcessSearch"))
	BeforeProcessSearch($conn);


$includes=
"<STYLE>
	.vis1	{ visibility:\"visible\" }
	.vis2	{ visibility:\"hidden\" }
</STYLE>
<script language=\"JavaScript\" src=\"include/calendar.js\"></script>
<script language=\"JavaScript\" src=\"include/jsfunctions.js\"></script>\r\n";
$includes.="<script language=\"JavaScript\" src=\"include/jquery.js\"></script>";
if ($useAJAX) {
$includes.="<script language=\"JavaScript\" src=\"include/ajaxsuggest.js\"></script>\r\n";
}
$includes.="<script language=\"JavaScript\" type=\"text/javascript\">\r\n".
"var locale_dateformat = ".$locale_info["LOCALE_IDATE"].";\r\n".
"var locale_datedelimiter = \"".$locale_info["LOCALE_SDATE"]."\";\r\n".
"var bLoading=false;\r\n".
"var TEXT_PLEASE_SELECT='".addslashes("Please select")."';\r\n";
if ($useAJAX) {
$includes.="var SUGGEST_TABLE = \"t_people_searchsuggest.php\";\r\n";
}
$includes.="var detect = navigator.userAgent.toLowerCase();

function checkIt(string)
{
	place = detect.indexOf(string) + 1;
	thestring = string;
	return place;
}


function ShowHideControls()
{
	document.getElementById('second_people_id').style.display =  
		document.forms.editform.elements['asearchopt_people_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_institution').style.display =  
		document.forms.editform.elements['asearchopt_institution'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_prof_provider').style.display =  
		document.forms.editform.elements['asearchopt_prof_provider'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_firstname').style.display =  
		document.forms.editform.elements['asearchopt_firstname'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_lastname').style.display =  
		document.forms.editform.elements['asearchopt_lastname'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_image_path').style.display =  
		document.forms.editform.elements['asearchopt_image_path'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_street').style.display =  
		document.forms.editform.elements['asearchopt_street'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_house_nr').style.display =  
		document.forms.editform.elements['asearchopt_house_nr'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_zip').style.display =  
		document.forms.editform.elements['asearchopt_zip'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_location').style.display =  
		document.forms.editform.elements['asearchopt_location'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_locationarea').style.display =  
		document.forms.editform.elements['asearchopt_locationarea'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_tel_p').style.display =  
		document.forms.editform.elements['asearchopt_tel_p'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_tel_m').style.display =  
		document.forms.editform.elements['asearchopt_tel_m'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_email').style.display =  
		document.forms.editform.elements['asearchopt_email'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_username').style.display =  
		document.forms.editform.elements['asearchopt_username'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_password').style.display =  
		document.forms.editform.elements['asearchopt_password'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_picture').style.display =  
		document.forms.editform.elements['asearchopt_picture'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_gender').style.display =  
		document.forms.editform.elements['asearchopt_gender'].value==\"Between\" ? '' : 'none'; 
		document.getElementById('second_birthdate').style.display =  
		document.forms.editform.elements['asearchopt_birthdate'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_enabled').style.display =  
		document.forms.editform.elements['asearchopt_enabled'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_temp_sched_from').style.display =  
		document.forms.editform.elements['asearchopt_temp_sched_from'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_temp_sched_to').style.display =  
		document.forms.editform.elements['asearchopt_temp_sched_to'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_joiningdate').style.display =  
		document.forms.editform.elements['asearchopt_joiningdate'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_coord_accuracy').style.display =  
		document.forms.editform.elements['asearchopt_coord_accuracy'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_monday').style.display =  
		document.forms.editform.elements['asearchopt_monday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_tuesday').style.display =  
		document.forms.editform.elements['asearchopt_tuesday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_wednesday').style.display =  
		document.forms.editform.elements['asearchopt_wednesday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_thursday').style.display =  
		document.forms.editform.elements['asearchopt_thursday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_friday').style.display =  
		document.forms.editform.elements['asearchopt_friday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_saturday').style.display =  
		document.forms.editform.elements['asearchopt_saturday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_sunday').style.display =  
		document.forms.editform.elements['asearchopt_sunday'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_monday_t').style.display =  
		document.forms.editform.elements['asearchopt_monday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_tuesday_t').style.display =  
		document.forms.editform.elements['asearchopt_tuesday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_wednesday_t').style.display =  
		document.forms.editform.elements['asearchopt_wednesday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_thursday_t').style.display =  
		document.forms.editform.elements['asearchopt_thursday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_friday_t').style.display =  
		document.forms.editform.elements['asearchopt_friday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_saturday_t').style.display =  
		document.forms.editform.elements['asearchopt_saturday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_sunday_t').style.display =  
		document.forms.editform.elements['asearchopt_sunday_t'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_preferred_contact_by').style.display =  
		document.forms.editform.elements['asearchopt_preferred_contact_by'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_date_last_adress_change').style.display =  
		document.forms.editform.elements['asearchopt_date_last_adress_change'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_map_in').style.display =  
		document.forms.editform.elements['asearchopt_map_in'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_IconPath').style.display =  
		document.forms.editform.elements['asearchopt_IconPath'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_note').style.display =  
		document.forms.editform.elements['asearchopt_note'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_price_per_hour').style.display =  
		document.forms.editform.elements['asearchopt_price_per_hour'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_psych_time_loose_tight').style.display =  
		document.forms.editform.elements['asearchopt_psych_time_loose_tight'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_psych_exact_creativ').style.display =  
		document.forms.editform.elements['asearchopt_psych_exact_creativ'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_psych_heart_thing').style.display =  
		document.forms.editform.elements['asearchopt_psych_heart_thing'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_psych_easy_security').style.display =  
		document.forms.editform.elements['asearchopt_psych_easy_security'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_psych_conflict_take_leave').style.display =  
		document.forms.editform.elements['asearchopt_psych_conflict_take_leave'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_longitude').style.display =  
		document.forms.editform.elements['asearchopt_longitude'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_latitude').style.display =  
		document.forms.editform.elements['asearchopt_latitude'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Agree').style.display =  
		document.forms.editform.elements['asearchopt_Agree'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Sign_date').style.display =  
		document.forms.editform.elements['asearchopt_Sign_date'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Active').style.display =  
		document.forms.editform.elements['asearchopt_Active'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Acode').style.display =  
		document.forms.editform.elements['asearchopt_Acode'].value==\"Between\" ? '' : 'none'; 
	return false;
}
function ResetControls()
{
	var i;
	e = document.forms[0].elements; 
	for (i=0;i<e.length;i++) 
	{
		if (e[i].name!='type' && e[i].className!='button' && e[i].type!='hidden')
		{
			if(e[i].type=='select-one')
				e[i].selectedIndex=0;
			else if(e[i].type=='select-multiple')
			{
				var j;
				for(j=0;j<e[i].options.length;j++)
					e[i].options[j].selected=false;
			}
			else if(e[i].type=='checkbox' || e[i].type=='radio')
				e[i].checked=false;
			else 
				e[i].value = ''; 
		}
		else if(e[i].name.substr(0,6)=='value_' && e[i].type=='hidden')
			e[i].value = ''; 
	}
	ShowHideControls();	
	return false;
}";

$includes.="
$(document).ready(function() {
	document.forms.editform.value_people_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_people_id,'advanced')};
	document.forms.editform.value1_people_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_people_id,'advanced1')};
	document.forms.editform.value_people_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_people_id,'advanced')};
	document.forms.editform.value1_people_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_people_id,'advanced1')};
	document.forms.editform.value_institution.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_institution,'advanced')};
	document.forms.editform.value1_institution.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_institution,'advanced1')};
	document.forms.editform.value_institution.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_institution,'advanced')};
	document.forms.editform.value1_institution.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_institution,'advanced1')};
	document.forms.editform.value_prof_provider.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_prof_provider,'advanced')};
	document.forms.editform.value1_prof_provider.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_prof_provider,'advanced1')};
	document.forms.editform.value_prof_provider.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_prof_provider,'advanced')};
	document.forms.editform.value1_prof_provider.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_prof_provider,'advanced1')};
	document.forms.editform.value_firstname.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_firstname,'advanced')};
	document.forms.editform.value1_firstname.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_firstname,'advanced1')};
	document.forms.editform.value_firstname.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_firstname,'advanced')};
	document.forms.editform.value1_firstname.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_firstname,'advanced1')};
	document.forms.editform.value_lastname.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_lastname,'advanced')};
	document.forms.editform.value1_lastname.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_lastname,'advanced1')};
	document.forms.editform.value_lastname.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_lastname,'advanced')};
	document.forms.editform.value1_lastname.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_lastname,'advanced1')};
	document.forms.editform.value_image_path.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_image_path,'advanced')};
	document.forms.editform.value1_image_path.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_image_path,'advanced1')};
	document.forms.editform.value_image_path.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_image_path,'advanced')};
	document.forms.editform.value1_image_path.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_image_path,'advanced1')};
	document.forms.editform.value_street.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_street,'advanced')};
	document.forms.editform.value1_street.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_street,'advanced1')};
	document.forms.editform.value_street.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_street,'advanced')};
	document.forms.editform.value1_street.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_street,'advanced1')};
	document.forms.editform.value_house_nr.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_house_nr,'advanced')};
	document.forms.editform.value1_house_nr.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_house_nr,'advanced1')};
	document.forms.editform.value_house_nr.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_house_nr,'advanced')};
	document.forms.editform.value1_house_nr.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_house_nr,'advanced1')};
	document.forms.editform.value_zip.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_zip,'advanced')};
	document.forms.editform.value1_zip.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_zip,'advanced1')};
	document.forms.editform.value_zip.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_zip,'advanced')};
	document.forms.editform.value1_zip.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_zip,'advanced1')};
	document.forms.editform.value_location.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_location,'advanced')};
	document.forms.editform.value1_location.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_location,'advanced1')};
	document.forms.editform.value_location.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_location,'advanced')};
	document.forms.editform.value1_location.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_location,'advanced1')};
	document.forms.editform.value_locationarea.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_locationarea,'advanced')};
	document.forms.editform.value1_locationarea.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_locationarea,'advanced1')};
	document.forms.editform.value_locationarea.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_locationarea,'advanced')};
	document.forms.editform.value1_locationarea.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_locationarea,'advanced1')};
	document.forms.editform.value_tel_p.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_tel_p,'advanced')};
	document.forms.editform.value1_tel_p.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_tel_p,'advanced1')};
	document.forms.editform.value_tel_p.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_tel_p,'advanced')};
	document.forms.editform.value1_tel_p.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_tel_p,'advanced1')};
	document.forms.editform.value_tel_m.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_tel_m,'advanced')};
	document.forms.editform.value1_tel_m.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_tel_m,'advanced1')};
	document.forms.editform.value_tel_m.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_tel_m,'advanced')};
	document.forms.editform.value1_tel_m.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_tel_m,'advanced1')};
	document.forms.editform.value_email.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_email,'advanced')};
	document.forms.editform.value1_email.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_email,'advanced1')};
	document.forms.editform.value_email.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_email,'advanced')};
	document.forms.editform.value1_email.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_email,'advanced1')};
	document.forms.editform.value_username.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_username,'advanced')};
	document.forms.editform.value1_username.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_username,'advanced1')};
	document.forms.editform.value_username.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_username,'advanced')};
	document.forms.editform.value1_username.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_username,'advanced1')};
	document.forms.editform.value_password.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_password,'advanced')};
	document.forms.editform.value1_password.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_password,'advanced1')};
	document.forms.editform.value_password.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_password,'advanced')};
	document.forms.editform.value1_password.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_password,'advanced1')};
	document.forms.editform.value_picture.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_picture,'advanced')};
	document.forms.editform.value1_picture.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_picture,'advanced1')};
	document.forms.editform.value_picture.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_picture,'advanced')};
	document.forms.editform.value1_picture.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_picture,'advanced1')};
	document.forms.editform.value_gender.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_gender,'advanced')};
	document.forms.editform.value1_gender.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_gender,'advanced1')};
	document.forms.editform.value_gender.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_gender,'advanced')};
	document.forms.editform.value1_gender.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_gender,'advanced1')};
	document.forms.editform.value_enabled.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_enabled,'advanced')};
	document.forms.editform.value1_enabled.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_enabled,'advanced1')};
	document.forms.editform.value_enabled.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_enabled,'advanced')};
	document.forms.editform.value1_enabled.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_enabled,'advanced1')};
	document.forms.editform.value_coord_accuracy.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_coord_accuracy,'advanced')};
	document.forms.editform.value1_coord_accuracy.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_coord_accuracy,'advanced1')};
	document.forms.editform.value_coord_accuracy.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_coord_accuracy,'advanced')};
	document.forms.editform.value1_coord_accuracy.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_coord_accuracy,'advanced1')};
	document.forms.editform.value_monday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_monday,'advanced')};
	document.forms.editform.value1_monday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_monday,'advanced1')};
	document.forms.editform.value_monday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_monday,'advanced')};
	document.forms.editform.value1_monday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_monday,'advanced1')};
	document.forms.editform.value_tuesday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_tuesday,'advanced')};
	document.forms.editform.value1_tuesday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_tuesday,'advanced1')};
	document.forms.editform.value_tuesday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_tuesday,'advanced')};
	document.forms.editform.value1_tuesday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_tuesday,'advanced1')};
	document.forms.editform.value_wednesday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_wednesday,'advanced')};
	document.forms.editform.value1_wednesday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_wednesday,'advanced1')};
	document.forms.editform.value_wednesday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_wednesday,'advanced')};
	document.forms.editform.value1_wednesday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_wednesday,'advanced1')};
	document.forms.editform.value_thursday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_thursday,'advanced')};
	document.forms.editform.value1_thursday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_thursday,'advanced1')};
	document.forms.editform.value_thursday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_thursday,'advanced')};
	document.forms.editform.value1_thursday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_thursday,'advanced1')};
	document.forms.editform.value_friday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_friday,'advanced')};
	document.forms.editform.value1_friday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_friday,'advanced1')};
	document.forms.editform.value_friday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_friday,'advanced')};
	document.forms.editform.value1_friday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_friday,'advanced1')};
	document.forms.editform.value_saturday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_saturday,'advanced')};
	document.forms.editform.value1_saturday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_saturday,'advanced1')};
	document.forms.editform.value_saturday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_saturday,'advanced')};
	document.forms.editform.value1_saturday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_saturday,'advanced1')};
	document.forms.editform.value_sunday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_sunday,'advanced')};
	document.forms.editform.value1_sunday.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_sunday,'advanced1')};
	document.forms.editform.value_sunday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_sunday,'advanced')};
	document.forms.editform.value1_sunday.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_sunday,'advanced1')};
	document.forms.editform.value_monday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_monday_t,'advanced')};
	document.forms.editform.value1_monday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_monday_t,'advanced1')};
	document.forms.editform.value_monday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_monday_t,'advanced')};
	document.forms.editform.value1_monday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_monday_t,'advanced1')};
	document.forms.editform.value_tuesday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_tuesday_t,'advanced')};
	document.forms.editform.value1_tuesday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_tuesday_t,'advanced1')};
	document.forms.editform.value_tuesday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_tuesday_t,'advanced')};
	document.forms.editform.value1_tuesday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_tuesday_t,'advanced1')};
	document.forms.editform.value_wednesday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_wednesday_t,'advanced')};
	document.forms.editform.value1_wednesday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_wednesday_t,'advanced1')};
	document.forms.editform.value_wednesday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_wednesday_t,'advanced')};
	document.forms.editform.value1_wednesday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_wednesday_t,'advanced1')};
	document.forms.editform.value_thursday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_thursday_t,'advanced')};
	document.forms.editform.value1_thursday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_thursday_t,'advanced1')};
	document.forms.editform.value_thursday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_thursday_t,'advanced')};
	document.forms.editform.value1_thursday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_thursday_t,'advanced1')};
	document.forms.editform.value_friday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_friday_t,'advanced')};
	document.forms.editform.value1_friday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_friday_t,'advanced1')};
	document.forms.editform.value_friday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_friday_t,'advanced')};
	document.forms.editform.value1_friday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_friday_t,'advanced1')};
	document.forms.editform.value_saturday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_saturday_t,'advanced')};
	document.forms.editform.value1_saturday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_saturday_t,'advanced1')};
	document.forms.editform.value_saturday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_saturday_t,'advanced')};
	document.forms.editform.value1_saturday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_saturday_t,'advanced1')};
	document.forms.editform.value_sunday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_sunday_t,'advanced')};
	document.forms.editform.value1_sunday_t.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_sunday_t,'advanced1')};
	document.forms.editform.value_sunday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_sunday_t,'advanced')};
	document.forms.editform.value1_sunday_t.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_sunday_t,'advanced1')};
	document.forms.editform.value_preferred_contact_by.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_preferred_contact_by,'advanced')};
	document.forms.editform.value1_preferred_contact_by.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_preferred_contact_by,'advanced1')};
	document.forms.editform.value_preferred_contact_by.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_preferred_contact_by,'advanced')};
	document.forms.editform.value1_preferred_contact_by.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_preferred_contact_by,'advanced1')};
	document.forms.editform.value_map_in.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_map_in,'advanced')};
	document.forms.editform.value1_map_in.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_map_in,'advanced1')};
	document.forms.editform.value_map_in.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_map_in,'advanced')};
	document.forms.editform.value1_map_in.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_map_in,'advanced1')};
	document.forms.editform.value_IconPath.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_IconPath,'advanced')};
	document.forms.editform.value1_IconPath.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_IconPath,'advanced1')};
	document.forms.editform.value_IconPath.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_IconPath,'advanced')};
	document.forms.editform.value1_IconPath.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_IconPath,'advanced1')};
	document.forms.editform.value_price_per_hour.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_price_per_hour,'advanced')};
	document.forms.editform.value1_price_per_hour.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_price_per_hour,'advanced1')};
	document.forms.editform.value_price_per_hour.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_price_per_hour,'advanced')};
	document.forms.editform.value1_price_per_hour.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_price_per_hour,'advanced1')};
	document.forms.editform.value_psych_time_loose_tight.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_psych_time_loose_tight,'advanced')};
	document.forms.editform.value1_psych_time_loose_tight.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_psych_time_loose_tight,'advanced1')};
	document.forms.editform.value_psych_time_loose_tight.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_psych_time_loose_tight,'advanced')};
	document.forms.editform.value1_psych_time_loose_tight.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_psych_time_loose_tight,'advanced1')};
	document.forms.editform.value_psych_exact_creativ.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_psych_exact_creativ,'advanced')};
	document.forms.editform.value1_psych_exact_creativ.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_psych_exact_creativ,'advanced1')};
	document.forms.editform.value_psych_exact_creativ.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_psych_exact_creativ,'advanced')};
	document.forms.editform.value1_psych_exact_creativ.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_psych_exact_creativ,'advanced1')};
	document.forms.editform.value_psych_heart_thing.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_psych_heart_thing,'advanced')};
	document.forms.editform.value1_psych_heart_thing.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_psych_heart_thing,'advanced1')};
	document.forms.editform.value_psych_heart_thing.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_psych_heart_thing,'advanced')};
	document.forms.editform.value1_psych_heart_thing.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_psych_heart_thing,'advanced1')};
	document.forms.editform.value_psych_easy_security.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_psych_easy_security,'advanced')};
	document.forms.editform.value1_psych_easy_security.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_psych_easy_security,'advanced1')};
	document.forms.editform.value_psych_easy_security.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_psych_easy_security,'advanced')};
	document.forms.editform.value1_psych_easy_security.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_psych_easy_security,'advanced1')};
	document.forms.editform.value_psych_conflict_take_leave.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_psych_conflict_take_leave,'advanced')};
	document.forms.editform.value1_psych_conflict_take_leave.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_psych_conflict_take_leave,'advanced1')};
	document.forms.editform.value_psych_conflict_take_leave.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_psych_conflict_take_leave,'advanced')};
	document.forms.editform.value1_psych_conflict_take_leave.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_psych_conflict_take_leave,'advanced1')};
	document.forms.editform.value_longitude.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_longitude,'advanced')};
	document.forms.editform.value1_longitude.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_longitude,'advanced1')};
	document.forms.editform.value_longitude.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_longitude,'advanced')};
	document.forms.editform.value1_longitude.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_longitude,'advanced1')};
	document.forms.editform.value_latitude.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_latitude,'advanced')};
	document.forms.editform.value1_latitude.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_latitude,'advanced1')};
	document.forms.editform.value_latitude.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_latitude,'advanced')};
	document.forms.editform.value1_latitude.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_latitude,'advanced1')};
	document.forms.editform.value_Agree.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Agree,'advanced')};
	document.forms.editform.value1_Agree.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Agree,'advanced1')};
	document.forms.editform.value_Agree.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Agree,'advanced')};
	document.forms.editform.value1_Agree.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Agree,'advanced1')};
	document.forms.editform.value_Sign_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Sign_date,'advanced')};
	document.forms.editform.value1_Sign_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Sign_date,'advanced1')};
	document.forms.editform.value_Sign_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Sign_date,'advanced')};
	document.forms.editform.value1_Sign_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Sign_date,'advanced1')};
	document.forms.editform.value_Active.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Active,'advanced')};
	document.forms.editform.value1_Active.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Active,'advanced1')};
	document.forms.editform.value_Active.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Active,'advanced')};
	document.forms.editform.value1_Active.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Active,'advanced1')};
	document.forms.editform.value_Acode.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Acode,'advanced')};
	document.forms.editform.value1_Acode.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Acode,'advanced1')};
	document.forms.editform.value_Acode.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Acode,'advanced')};
	document.forms.editform.value1_Acode.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Acode,'advanced1')};
});
</script>
<div id=\"search_suggest\"></div>
";

$smarty->assign("includes",$includes);
$smarty->assign("noAJAX",!$useAJAX);

$onload="onLoad=\"javascript: ShowHideControls();\"";
$smarty->assign("onload",$onload);

if(@$_SESSION[$strTableName."_asearchtype"]=="or")
{
	$smarty->assign("any_checked"," checked");
	$smarty->assign("all_checked","");
}
else
{
	$smarty->assign("any_checked","");
	$smarty->assign("all_checked"," checked");
}

$editformats=array();

// people_id 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["people_id"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["people_id"];
	$smarty->assign("value_people_id",@$_SESSION[$strTableName."_asearchfor"]["people_id"]);
	$smarty->assign("value1_people_id",@$_SESSION[$strTableName."_asearchfor2"]["people_id"]);
}	
if($not)
	$smarty->assign("not_people_id"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_people_id\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_people_id",$searchtype);
//	edit format
$editformats["people_id"]="Text field";
// institution 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["institution"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["institution"];
	$smarty->assign("value_institution",@$_SESSION[$strTableName."_asearchfor"]["institution"]);
	$smarty->assign("value1_institution",@$_SESSION[$strTableName."_asearchfor2"]["institution"]);
}	
if($not)
	$smarty->assign("not_institution"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_institution\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_institution",$searchtype);
//	edit format
$editformats["institution"]="Text field";
// prof_provider 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["prof_provider"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["prof_provider"];
	$smarty->assign("value_prof_provider",@$_SESSION[$strTableName."_asearchfor"]["prof_provider"]);
	$smarty->assign("value1_prof_provider",@$_SESSION[$strTableName."_asearchfor2"]["prof_provider"]);
}	
if($not)
	$smarty->assign("not_prof_provider"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_prof_provider\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_prof_provider",$searchtype);
//	edit format
$editformats["prof_provider"]="Text field";
// firstname 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["firstname"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["firstname"];
	$smarty->assign("value_firstname",@$_SESSION[$strTableName."_asearchfor"]["firstname"]);
	$smarty->assign("value1_firstname",@$_SESSION[$strTableName."_asearchfor2"]["firstname"]);
}	
if($not)
	$smarty->assign("not_firstname"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_firstname\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_firstname",$searchtype);
//	edit format
$editformats["firstname"]="Text field";
// lastname 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["lastname"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["lastname"];
	$smarty->assign("value_lastname",@$_SESSION[$strTableName."_asearchfor"]["lastname"]);
	$smarty->assign("value1_lastname",@$_SESSION[$strTableName."_asearchfor2"]["lastname"]);
}	
if($not)
	$smarty->assign("not_lastname"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_lastname\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_lastname",$searchtype);
//	edit format
$editformats["lastname"]="Text field";
// image_path 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["image_path"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["image_path"];
	$smarty->assign("value_image_path",@$_SESSION[$strTableName."_asearchfor"]["image_path"]);
	$smarty->assign("value1_image_path",@$_SESSION[$strTableName."_asearchfor2"]["image_path"]);
}	
if($not)
	$smarty->assign("not_image_path"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_image_path\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_image_path",$searchtype);
//	edit format
$editformats["image_path"]="Text field";
// street 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["street"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["street"];
	$smarty->assign("value_street",@$_SESSION[$strTableName."_asearchfor"]["street"]);
	$smarty->assign("value1_street",@$_SESSION[$strTableName."_asearchfor2"]["street"]);
}	
if($not)
	$smarty->assign("not_street"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_street\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_street",$searchtype);
//	edit format
$editformats["street"]="Text field";
// house_nr 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["house_nr"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["house_nr"];
	$smarty->assign("value_house_nr",@$_SESSION[$strTableName."_asearchfor"]["house_nr"]);
	$smarty->assign("value1_house_nr",@$_SESSION[$strTableName."_asearchfor2"]["house_nr"]);
}	
if($not)
	$smarty->assign("not_house_nr"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_house_nr\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_house_nr",$searchtype);
//	edit format
$editformats["house_nr"]="Text field";
// zip 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["zip"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["zip"];
	$smarty->assign("value_zip",@$_SESSION[$strTableName."_asearchfor"]["zip"]);
	$smarty->assign("value1_zip",@$_SESSION[$strTableName."_asearchfor2"]["zip"]);
}	
if($not)
	$smarty->assign("not_zip"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_zip\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_zip",$searchtype);
//	edit format
$editformats["zip"]="Text field";
// location 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["location"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["location"];
	$smarty->assign("value_location",@$_SESSION[$strTableName."_asearchfor"]["location"]);
	$smarty->assign("value1_location",@$_SESSION[$strTableName."_asearchfor2"]["location"]);
}	
if($not)
	$smarty->assign("not_location"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_location\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_location",$searchtype);
//	edit format
$editformats["location"]="Text field";
// locationarea 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["locationarea"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["locationarea"];
	$smarty->assign("value_locationarea",@$_SESSION[$strTableName."_asearchfor"]["locationarea"]);
	$smarty->assign("value1_locationarea",@$_SESSION[$strTableName."_asearchfor2"]["locationarea"]);
}	
if($not)
	$smarty->assign("not_locationarea"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_locationarea\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_locationarea",$searchtype);
//	edit format
$editformats["locationarea"]="Text field";
// tel_p 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["tel_p"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["tel_p"];
	$smarty->assign("value_tel_p",@$_SESSION[$strTableName."_asearchfor"]["tel_p"]);
	$smarty->assign("value1_tel_p",@$_SESSION[$strTableName."_asearchfor2"]["tel_p"]);
}	
if($not)
	$smarty->assign("not_tel_p"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_tel_p\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_tel_p",$searchtype);
//	edit format
$editformats["tel_p"]="Text field";
// tel_m 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["tel_m"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["tel_m"];
	$smarty->assign("value_tel_m",@$_SESSION[$strTableName."_asearchfor"]["tel_m"]);
	$smarty->assign("value1_tel_m",@$_SESSION[$strTableName."_asearchfor2"]["tel_m"]);
}	
if($not)
	$smarty->assign("not_tel_m"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_tel_m\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_tel_m",$searchtype);
//	edit format
$editformats["tel_m"]="Text field";
// email 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["email"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["email"];
	$smarty->assign("value_email",@$_SESSION[$strTableName."_asearchfor"]["email"]);
	$smarty->assign("value1_email",@$_SESSION[$strTableName."_asearchfor2"]["email"]);
}	
if($not)
	$smarty->assign("not_email"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_email\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_email",$searchtype);
//	edit format
$editformats["email"]="Text field";
// username 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["username"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["username"];
	$smarty->assign("value_username",@$_SESSION[$strTableName."_asearchfor"]["username"]);
	$smarty->assign("value1_username",@$_SESSION[$strTableName."_asearchfor2"]["username"]);
}	
if($not)
	$smarty->assign("not_username"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_username\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_username",$searchtype);
//	edit format
$editformats["username"]="Text field";
// password 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["password"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["password"];
	$smarty->assign("value_password",@$_SESSION[$strTableName."_asearchfor"]["password"]);
	$smarty->assign("value1_password",@$_SESSION[$strTableName."_asearchfor2"]["password"]);
}	
if($not)
	$smarty->assign("not_password"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_password\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_password",$searchtype);
//	edit format
$editformats["password"]="Text field";
// picture 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["picture"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["picture"];
	$smarty->assign("value_picture",@$_SESSION[$strTableName."_asearchfor"]["picture"]);
	$smarty->assign("value1_picture",@$_SESSION[$strTableName."_asearchfor2"]["picture"]);
}	
if($not)
	$smarty->assign("not_picture"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_picture\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_picture",$searchtype);
//	edit format
$editformats["picture"]="Text field";
// gender 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["gender"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["gender"];
	$smarty->assign("value_gender",@$_SESSION[$strTableName."_asearchfor"]["gender"]);
	$smarty->assign("value1_gender",@$_SESSION[$strTableName."_asearchfor2"]["gender"]);
}	
if($not)
	$smarty->assign("not_gender"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_gender\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_gender",$searchtype);
//	edit format
$editformats["gender"]="Text field";
// birthdate 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["birthdate"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["birthdate"];
	$smarty->assign("value_birthdate",@$_SESSION[$strTableName."_asearchfor"]["birthdate"]);
	$smarty->assign("value1_birthdate",@$_SESSION[$strTableName."_asearchfor2"]["birthdate"]);
}	
if($not)
	$smarty->assign("not_birthdate"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_birthdate\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_birthdate",$searchtype);
//	edit format
$editformats["birthdate"]="Date";
// enabled 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["enabled"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["enabled"];
	$smarty->assign("value_enabled",@$_SESSION[$strTableName."_asearchfor"]["enabled"]);
	$smarty->assign("value1_enabled",@$_SESSION[$strTableName."_asearchfor2"]["enabled"]);
}	
if($not)
	$smarty->assign("not_enabled"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_enabled\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_enabled",$searchtype);
//	edit format
$editformats["enabled"]="Text field";
// temp_sched_from 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["temp_sched_from"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["temp_sched_from"];
	$smarty->assign("value_temp_sched_from",@$_SESSION[$strTableName."_asearchfor"]["temp_sched_from"]);
	$smarty->assign("value1_temp_sched_from",@$_SESSION[$strTableName."_asearchfor2"]["temp_sched_from"]);
}	
if($not)
	$smarty->assign("not_temp_sched_from"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_temp_sched_from\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_temp_sched_from",$searchtype);
//	edit format
$editformats["temp_sched_from"]=EDIT_FORMAT_TEXT_FIELD;
// temp_sched_to 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["temp_sched_to"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["temp_sched_to"];
	$smarty->assign("value_temp_sched_to",@$_SESSION[$strTableName."_asearchfor"]["temp_sched_to"]);
	$smarty->assign("value1_temp_sched_to",@$_SESSION[$strTableName."_asearchfor2"]["temp_sched_to"]);
}	
if($not)
	$smarty->assign("not_temp_sched_to"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_temp_sched_to\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_temp_sched_to",$searchtype);
//	edit format
$editformats["temp_sched_to"]=EDIT_FORMAT_TEXT_FIELD;
// joiningdate 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["joiningdate"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["joiningdate"];
	$smarty->assign("value_joiningdate",@$_SESSION[$strTableName."_asearchfor"]["joiningdate"]);
	$smarty->assign("value1_joiningdate",@$_SESSION[$strTableName."_asearchfor2"]["joiningdate"]);
}	
if($not)
	$smarty->assign("not_joiningdate"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_joiningdate\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_joiningdate",$searchtype);
//	edit format
$editformats["joiningdate"]="Date";
// coord_accuracy 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["coord_accuracy"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["coord_accuracy"];
	$smarty->assign("value_coord_accuracy",@$_SESSION[$strTableName."_asearchfor"]["coord_accuracy"]);
	$smarty->assign("value1_coord_accuracy",@$_SESSION[$strTableName."_asearchfor2"]["coord_accuracy"]);
}	
if($not)
	$smarty->assign("not_coord_accuracy"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_coord_accuracy\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_coord_accuracy",$searchtype);
//	edit format
$editformats["coord_accuracy"]="Text field";
// monday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["monday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["monday"];
	$smarty->assign("value_monday",@$_SESSION[$strTableName."_asearchfor"]["monday"]);
	$smarty->assign("value1_monday",@$_SESSION[$strTableName."_asearchfor2"]["monday"]);
}	
if($not)
	$smarty->assign("not_monday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_monday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_monday",$searchtype);
//	edit format
$editformats["monday"]="Text field";
// tuesday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["tuesday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["tuesday"];
	$smarty->assign("value_tuesday",@$_SESSION[$strTableName."_asearchfor"]["tuesday"]);
	$smarty->assign("value1_tuesday",@$_SESSION[$strTableName."_asearchfor2"]["tuesday"]);
}	
if($not)
	$smarty->assign("not_tuesday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_tuesday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_tuesday",$searchtype);
//	edit format
$editformats["tuesday"]="Text field";
// wednesday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["wednesday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["wednesday"];
	$smarty->assign("value_wednesday",@$_SESSION[$strTableName."_asearchfor"]["wednesday"]);
	$smarty->assign("value1_wednesday",@$_SESSION[$strTableName."_asearchfor2"]["wednesday"]);
}	
if($not)
	$smarty->assign("not_wednesday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_wednesday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_wednesday",$searchtype);
//	edit format
$editformats["wednesday"]="Text field";
// thursday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["thursday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["thursday"];
	$smarty->assign("value_thursday",@$_SESSION[$strTableName."_asearchfor"]["thursday"]);
	$smarty->assign("value1_thursday",@$_SESSION[$strTableName."_asearchfor2"]["thursday"]);
}	
if($not)
	$smarty->assign("not_thursday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_thursday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_thursday",$searchtype);
//	edit format
$editformats["thursday"]="Text field";
// friday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["friday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["friday"];
	$smarty->assign("value_friday",@$_SESSION[$strTableName."_asearchfor"]["friday"]);
	$smarty->assign("value1_friday",@$_SESSION[$strTableName."_asearchfor2"]["friday"]);
}	
if($not)
	$smarty->assign("not_friday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_friday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_friday",$searchtype);
//	edit format
$editformats["friday"]="Text field";
// saturday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["saturday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["saturday"];
	$smarty->assign("value_saturday",@$_SESSION[$strTableName."_asearchfor"]["saturday"]);
	$smarty->assign("value1_saturday",@$_SESSION[$strTableName."_asearchfor2"]["saturday"]);
}	
if($not)
	$smarty->assign("not_saturday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_saturday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_saturday",$searchtype);
//	edit format
$editformats["saturday"]="Text field";
// sunday 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["sunday"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["sunday"];
	$smarty->assign("value_sunday",@$_SESSION[$strTableName."_asearchfor"]["sunday"]);
	$smarty->assign("value1_sunday",@$_SESSION[$strTableName."_asearchfor2"]["sunday"]);
}	
if($not)
	$smarty->assign("not_sunday"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_sunday\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_sunday",$searchtype);
//	edit format
$editformats["sunday"]="Text field";
// monday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["monday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["monday_t"];
	$smarty->assign("value_monday_t",@$_SESSION[$strTableName."_asearchfor"]["monday_t"]);
	$smarty->assign("value1_monday_t",@$_SESSION[$strTableName."_asearchfor2"]["monday_t"]);
}	
if($not)
	$smarty->assign("not_monday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_monday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_monday_t",$searchtype);
//	edit format
$editformats["monday_t"]="Text field";
// tuesday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["tuesday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["tuesday_t"];
	$smarty->assign("value_tuesday_t",@$_SESSION[$strTableName."_asearchfor"]["tuesday_t"]);
	$smarty->assign("value1_tuesday_t",@$_SESSION[$strTableName."_asearchfor2"]["tuesday_t"]);
}	
if($not)
	$smarty->assign("not_tuesday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_tuesday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_tuesday_t",$searchtype);
//	edit format
$editformats["tuesday_t"]="Text field";
// wednesday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["wednesday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["wednesday_t"];
	$smarty->assign("value_wednesday_t",@$_SESSION[$strTableName."_asearchfor"]["wednesday_t"]);
	$smarty->assign("value1_wednesday_t",@$_SESSION[$strTableName."_asearchfor2"]["wednesday_t"]);
}	
if($not)
	$smarty->assign("not_wednesday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_wednesday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_wednesday_t",$searchtype);
//	edit format
$editformats["wednesday_t"]="Text field";
// thursday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["thursday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["thursday_t"];
	$smarty->assign("value_thursday_t",@$_SESSION[$strTableName."_asearchfor"]["thursday_t"]);
	$smarty->assign("value1_thursday_t",@$_SESSION[$strTableName."_asearchfor2"]["thursday_t"]);
}	
if($not)
	$smarty->assign("not_thursday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_thursday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_thursday_t",$searchtype);
//	edit format
$editformats["thursday_t"]="Text field";
// friday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["friday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["friday_t"];
	$smarty->assign("value_friday_t",@$_SESSION[$strTableName."_asearchfor"]["friday_t"]);
	$smarty->assign("value1_friday_t",@$_SESSION[$strTableName."_asearchfor2"]["friday_t"]);
}	
if($not)
	$smarty->assign("not_friday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_friday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_friday_t",$searchtype);
//	edit format
$editformats["friday_t"]="Text field";
// saturday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["saturday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["saturday_t"];
	$smarty->assign("value_saturday_t",@$_SESSION[$strTableName."_asearchfor"]["saturday_t"]);
	$smarty->assign("value1_saturday_t",@$_SESSION[$strTableName."_asearchfor2"]["saturday_t"]);
}	
if($not)
	$smarty->assign("not_saturday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_saturday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_saturday_t",$searchtype);
//	edit format
$editformats["saturday_t"]="Text field";
// sunday_t 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["sunday_t"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["sunday_t"];
	$smarty->assign("value_sunday_t",@$_SESSION[$strTableName."_asearchfor"]["sunday_t"]);
	$smarty->assign("value1_sunday_t",@$_SESSION[$strTableName."_asearchfor2"]["sunday_t"]);
}	
if($not)
	$smarty->assign("not_sunday_t"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_sunday_t\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_sunday_t",$searchtype);
//	edit format
$editformats["sunday_t"]="Text field";
// preferred_contact_by 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["preferred_contact_by"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["preferred_contact_by"];
	$smarty->assign("value_preferred_contact_by",@$_SESSION[$strTableName."_asearchfor"]["preferred_contact_by"]);
	$smarty->assign("value1_preferred_contact_by",@$_SESSION[$strTableName."_asearchfor2"]["preferred_contact_by"]);
}	
if($not)
	$smarty->assign("not_preferred_contact_by"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_preferred_contact_by\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_preferred_contact_by",$searchtype);
//	edit format
$editformats["preferred_contact_by"]="Text field";
// date_last_adress_change 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["date_last_adress_change"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["date_last_adress_change"];
	$smarty->assign("value_date_last_adress_change",@$_SESSION[$strTableName."_asearchfor"]["date_last_adress_change"]);
	$smarty->assign("value1_date_last_adress_change",@$_SESSION[$strTableName."_asearchfor2"]["date_last_adress_change"]);
}	
if($not)
	$smarty->assign("not_date_last_adress_change"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_date_last_adress_change\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_date_last_adress_change",$searchtype);
//	edit format
$editformats["date_last_adress_change"]="Date";
// map_in 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["map_in"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["map_in"];
	$smarty->assign("value_map_in",@$_SESSION[$strTableName."_asearchfor"]["map_in"]);
	$smarty->assign("value1_map_in",@$_SESSION[$strTableName."_asearchfor2"]["map_in"]);
}	
if($not)
	$smarty->assign("not_map_in"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_map_in\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_map_in",$searchtype);
//	edit format
$editformats["map_in"]="Text field";
// IconPath 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["IconPath"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["IconPath"];
	$smarty->assign("value_IconPath",@$_SESSION[$strTableName."_asearchfor"]["IconPath"]);
	$smarty->assign("value1_IconPath",@$_SESSION[$strTableName."_asearchfor2"]["IconPath"]);
}	
if($not)
	$smarty->assign("not_IconPath"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_IconPath\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_IconPath",$searchtype);
//	edit format
$editformats["IconPath"]="Text field";
// note 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["note"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["note"];
	$smarty->assign("value_note",@$_SESSION[$strTableName."_asearchfor"]["note"]);
	$smarty->assign("value1_note",@$_SESSION[$strTableName."_asearchfor2"]["note"]);
}	
if($not)
	$smarty->assign("not_note"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_note\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_note",$searchtype);
//	edit format
$editformats["note"]=EDIT_FORMAT_TEXT_FIELD;
// price_per_hour 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["price_per_hour"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["price_per_hour"];
	$smarty->assign("value_price_per_hour",@$_SESSION[$strTableName."_asearchfor"]["price_per_hour"]);
	$smarty->assign("value1_price_per_hour",@$_SESSION[$strTableName."_asearchfor2"]["price_per_hour"]);
}	
if($not)
	$smarty->assign("not_price_per_hour"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_price_per_hour\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_price_per_hour",$searchtype);
//	edit format
$editformats["price_per_hour"]="Text field";
// psych_time_loose_tight 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["psych_time_loose_tight"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["psych_time_loose_tight"];
	$smarty->assign("value_psych_time_loose_tight",@$_SESSION[$strTableName."_asearchfor"]["psych_time_loose_tight"]);
	$smarty->assign("value1_psych_time_loose_tight",@$_SESSION[$strTableName."_asearchfor2"]["psych_time_loose_tight"]);
}	
if($not)
	$smarty->assign("not_psych_time_loose_tight"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_psych_time_loose_tight\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_psych_time_loose_tight",$searchtype);
//	edit format
$editformats["psych_time_loose_tight"]="Text field";
// psych_exact_creativ 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["psych_exact_creativ"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["psych_exact_creativ"];
	$smarty->assign("value_psych_exact_creativ",@$_SESSION[$strTableName."_asearchfor"]["psych_exact_creativ"]);
	$smarty->assign("value1_psych_exact_creativ",@$_SESSION[$strTableName."_asearchfor2"]["psych_exact_creativ"]);
}	
if($not)
	$smarty->assign("not_psych_exact_creativ"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_psych_exact_creativ\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_psych_exact_creativ",$searchtype);
//	edit format
$editformats["psych_exact_creativ"]="Text field";
// psych_heart_thing 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["psych_heart_thing"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["psych_heart_thing"];
	$smarty->assign("value_psych_heart_thing",@$_SESSION[$strTableName."_asearchfor"]["psych_heart_thing"]);
	$smarty->assign("value1_psych_heart_thing",@$_SESSION[$strTableName."_asearchfor2"]["psych_heart_thing"]);
}	
if($not)
	$smarty->assign("not_psych_heart_thing"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_psych_heart_thing\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_psych_heart_thing",$searchtype);
//	edit format
$editformats["psych_heart_thing"]="Text field";
// psych_easy_security 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["psych_easy_security"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["psych_easy_security"];
	$smarty->assign("value_psych_easy_security",@$_SESSION[$strTableName."_asearchfor"]["psych_easy_security"]);
	$smarty->assign("value1_psych_easy_security",@$_SESSION[$strTableName."_asearchfor2"]["psych_easy_security"]);
}	
if($not)
	$smarty->assign("not_psych_easy_security"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_psych_easy_security\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_psych_easy_security",$searchtype);
//	edit format
$editformats["psych_easy_security"]="Text field";
// psych_conflict_take_leave 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["psych_conflict_take_leave"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["psych_conflict_take_leave"];
	$smarty->assign("value_psych_conflict_take_leave",@$_SESSION[$strTableName."_asearchfor"]["psych_conflict_take_leave"]);
	$smarty->assign("value1_psych_conflict_take_leave",@$_SESSION[$strTableName."_asearchfor2"]["psych_conflict_take_leave"]);
}	
if($not)
	$smarty->assign("not_psych_conflict_take_leave"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_psych_conflict_take_leave\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_psych_conflict_take_leave",$searchtype);
//	edit format
$editformats["psych_conflict_take_leave"]="Text field";
// longitude 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["longitude"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["longitude"];
	$smarty->assign("value_longitude",@$_SESSION[$strTableName."_asearchfor"]["longitude"]);
	$smarty->assign("value1_longitude",@$_SESSION[$strTableName."_asearchfor2"]["longitude"]);
}	
if($not)
	$smarty->assign("not_longitude"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_longitude\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_longitude",$searchtype);
//	edit format
$editformats["longitude"]="Text field";
// latitude 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["latitude"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["latitude"];
	$smarty->assign("value_latitude",@$_SESSION[$strTableName."_asearchfor"]["latitude"]);
	$smarty->assign("value1_latitude",@$_SESSION[$strTableName."_asearchfor2"]["latitude"]);
}	
if($not)
	$smarty->assign("not_latitude"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_latitude\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_latitude",$searchtype);
//	edit format
$editformats["latitude"]="Text field";
// Agree 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Agree"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Agree"];
	$smarty->assign("value_Agree",@$_SESSION[$strTableName."_asearchfor"]["Agree"]);
	$smarty->assign("value1_Agree",@$_SESSION[$strTableName."_asearchfor2"]["Agree"]);
}	
if($not)
	$smarty->assign("not_Agree"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Agree\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Agree",$searchtype);
//	edit format
$editformats["Agree"]="Text field";
// Sign_date 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Sign_date"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Sign_date"];
	$smarty->assign("value_Sign_date",@$_SESSION[$strTableName."_asearchfor"]["Sign_date"]);
	$smarty->assign("value1_Sign_date",@$_SESSION[$strTableName."_asearchfor2"]["Sign_date"]);
}	
if($not)
	$smarty->assign("not_Sign_date"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Sign_date\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Sign_date",$searchtype);
//	edit format
$editformats["Sign_date"]="Text field";
// Active 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Active"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Active"];
	$smarty->assign("value_Active",@$_SESSION[$strTableName."_asearchfor"]["Active"]);
	$smarty->assign("value1_Active",@$_SESSION[$strTableName."_asearchfor2"]["Active"]);
}	
if($not)
	$smarty->assign("not_Active"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Active\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Active",$searchtype);
//	edit format
$editformats["Active"]="Text field";
// Acode 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Acode"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Acode"];
	$smarty->assign("value_Acode",@$_SESSION[$strTableName."_asearchfor"]["Acode"]);
	$smarty->assign("value1_Acode",@$_SESSION[$strTableName."_asearchfor2"]["Acode"]);
}	
if($not)
	$smarty->assign("not_Acode"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Contains\" ".(($opt=="Contains")?"selected":"").">"."Contains"."</option>";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"Starts with ...\" ".(($opt=="Starts with ...")?"selected":"").">"."Starts with ..."."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Acode\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Acode",$searchtype);
//	edit format
$editformats["Acode"]="Text field";

$linkdata="";

$linkdata .= "<script type=\"text/javascript\">\r\n";

if ($useAJAX) {
}
else
{
}
$linkdata.="</script>\r\n";

$smarty->assign("linkdata",$linkdata);

$templatefile = "t_people_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($smarty,$templatefile);

$smarty->display($templatefile);

?>
