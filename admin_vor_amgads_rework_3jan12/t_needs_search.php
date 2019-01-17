<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_needs_variables.php");

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
$includes.="var SUGGEST_TABLE = \"t_needs_searchsuggest.php\";\r\n";
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
	document.getElementById('second_need_id').style.display =  
		document.forms.editform.elements['asearchopt_need_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_people_id').style.display =  
		document.forms.editform.elements['asearchopt_people_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_need_type_id').style.display =  
		document.forms.editform.elements['asearchopt_need_type_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_need_subtype_id').style.display =  
		document.forms.editform.elements['asearchopt_need_subtype_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_need_note').style.display =  
		document.forms.editform.elements['asearchopt_need_note'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_need_hourly').style.display =  
		document.forms.editform.elements['asearchopt_need_hourly'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_need_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_need_id,'advanced')};
	document.forms.editform.value1_need_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_need_id,'advanced1')};
	document.forms.editform.value_need_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_need_id,'advanced')};
	document.forms.editform.value1_need_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_need_id,'advanced1')};
	document.forms.editform.value_people_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_people_id,'advanced')};
	document.forms.editform.value1_people_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_people_id,'advanced1')};
	document.forms.editform.value_people_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_people_id,'advanced')};
	document.forms.editform.value1_people_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_people_id,'advanced1')};
	document.forms.editform.value_need_hourly.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_need_hourly,'advanced')};
	document.forms.editform.value1_need_hourly.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_need_hourly,'advanced1')};
	document.forms.editform.value_need_hourly.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_need_hourly,'advanced')};
	document.forms.editform.value1_need_hourly.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_need_hourly,'advanced1')};
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

// need_id 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["need_id"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["need_id"];
	$smarty->assign("value_need_id",@$_SESSION[$strTableName."_asearchfor"]["need_id"]);
	$smarty->assign("value1_need_id",@$_SESSION[$strTableName."_asearchfor2"]["need_id"]);
}	
if($not)
	$smarty->assign("not_need_id"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_need_id\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_need_id",$searchtype);
//	edit format
$editformats["need_id"]="Text field";
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
// need_type_id 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["need_type_id"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["need_type_id"];
	$smarty->assign("value_need_type_id",@$_SESSION[$strTableName."_asearchfor"]["need_type_id"]);
	$smarty->assign("value1_need_type_id",@$_SESSION[$strTableName."_asearchfor2"]["need_type_id"]);
}	
if($not)
	$smarty->assign("not_need_type_id"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_need_type_id\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_need_type_id",$searchtype);
//	edit format
$editformats["need_type_id"]="Lookup wizard";
// need_subtype_id 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["need_subtype_id"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["need_subtype_id"];
	$smarty->assign("value_need_subtype_id",@$_SESSION[$strTableName."_asearchfor"]["need_subtype_id"]);
	$smarty->assign("value1_need_subtype_id",@$_SESSION[$strTableName."_asearchfor2"]["need_subtype_id"]);
}	
if($not)
	$smarty->assign("not_need_subtype_id"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_need_subtype_id\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_need_subtype_id",$searchtype);
//	edit format
$editformats["need_subtype_id"]="Lookup wizard";
// need_note 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["need_note"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["need_note"];
	$smarty->assign("value_need_note",@$_SESSION[$strTableName."_asearchfor"]["need_note"]);
	$smarty->assign("value1_need_note",@$_SESSION[$strTableName."_asearchfor2"]["need_note"]);
}	
if($not)
	$smarty->assign("not_need_note"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_need_note\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_need_note",$searchtype);
//	edit format
$editformats["need_note"]=EDIT_FORMAT_TEXT_FIELD;
// need_hourly 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["need_hourly"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["need_hourly"];
	$smarty->assign("value_need_hourly",@$_SESSION[$strTableName."_asearchfor"]["need_hourly"]);
	$smarty->assign("value1_need_hourly",@$_SESSION[$strTableName."_asearchfor2"]["need_hourly"]);
}	
if($not)
	$smarty->assign("not_need_hourly"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_need_hourly\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_need_hourly",$searchtype);
//	edit format
$editformats["need_hourly"]="Text field";
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

$linkdata="";

$linkdata .= "<script type=\"text/javascript\">\r\n";

if ($useAJAX) {
}
else
{
}
$linkdata.="</script>\r\n";

$smarty->assign("linkdata",$linkdata);

$templatefile = "t_needs_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($smarty,$templatefile);

$smarty->display($templatefile);

?>