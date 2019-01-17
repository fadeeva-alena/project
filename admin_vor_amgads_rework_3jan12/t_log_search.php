<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_log_variables.php");

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
$includes.="var SUGGEST_TABLE = \"t_log_searchsuggest.php\";\r\n";
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
	document.getElementById('second_log_id').style.display =  
		document.forms.editform.elements['asearchopt_log_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_person_id').style.display =  
		document.forms.editform.elements['asearchopt_person_id'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_User_Name').style.display =  
		document.forms.editform.elements['asearchopt_User_Name'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_login_date').style.display =  
		document.forms.editform.elements['asearchopt_login_date'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_logout_date').style.display =  
		document.forms.editform.elements['asearchopt_logout_date'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_login_from').style.display =  
		document.forms.editform.elements['asearchopt_login_from'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_log_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_log_id,'advanced')};
	document.forms.editform.value1_log_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_log_id,'advanced1')};
	document.forms.editform.value_log_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_log_id,'advanced')};
	document.forms.editform.value1_log_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_log_id,'advanced1')};
	document.forms.editform.value_person_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_person_id,'advanced')};
	document.forms.editform.value1_person_id.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_person_id,'advanced1')};
	document.forms.editform.value_person_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_person_id,'advanced')};
	document.forms.editform.value1_person_id.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_person_id,'advanced1')};
	document.forms.editform.value_User_Name.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_User_Name,'advanced')};
	document.forms.editform.value1_User_Name.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_User_Name,'advanced1')};
	document.forms.editform.value_User_Name.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_User_Name,'advanced')};
	document.forms.editform.value1_User_Name.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_User_Name,'advanced1')};
	document.forms.editform.value_login_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_login_date,'advanced')};
	document.forms.editform.value1_login_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_login_date,'advanced1')};
	document.forms.editform.value_login_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_login_date,'advanced')};
	document.forms.editform.value1_login_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_login_date,'advanced1')};
	document.forms.editform.value_logout_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_logout_date,'advanced')};
	document.forms.editform.value1_logout_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_logout_date,'advanced1')};
	document.forms.editform.value_logout_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_logout_date,'advanced')};
	document.forms.editform.value1_logout_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_logout_date,'advanced1')};
	document.forms.editform.value_login_from.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_login_from,'advanced')};
	document.forms.editform.value1_login_from.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_login_from,'advanced1')};
	document.forms.editform.value_login_from.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_login_from,'advanced')};
	document.forms.editform.value1_login_from.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_login_from,'advanced1')};
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

// log_id 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["log_id"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["log_id"];
	$smarty->assign("value_log_id",@$_SESSION[$strTableName."_asearchfor"]["log_id"]);
	$smarty->assign("value1_log_id",@$_SESSION[$strTableName."_asearchfor2"]["log_id"]);
}	
if($not)
	$smarty->assign("not_log_id"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_log_id\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_log_id",$searchtype);
//	edit format
$editformats["log_id"]="Text field";
// person_id 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["person_id"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["person_id"];
	$smarty->assign("value_person_id",@$_SESSION[$strTableName."_asearchfor"]["person_id"]);
	$smarty->assign("value1_person_id",@$_SESSION[$strTableName."_asearchfor2"]["person_id"]);
}	
if($not)
	$smarty->assign("not_person_id"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_person_id\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_person_id",$searchtype);
//	edit format
$editformats["person_id"]="Text field";
// User_Name 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["User_Name"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["User_Name"];
	$smarty->assign("value_User_Name",@$_SESSION[$strTableName."_asearchfor"]["User_Name"]);
	$smarty->assign("value1_User_Name",@$_SESSION[$strTableName."_asearchfor2"]["User_Name"]);
}	
if($not)
	$smarty->assign("not_User_Name"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_User_Name\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_User_Name",$searchtype);
//	edit format
$editformats["User_Name"]="Text field";
// login_date 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["login_date"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["login_date"];
	$smarty->assign("value_login_date",@$_SESSION[$strTableName."_asearchfor"]["login_date"]);
	$smarty->assign("value1_login_date",@$_SESSION[$strTableName."_asearchfor2"]["login_date"]);
}	
if($not)
	$smarty->assign("not_login_date"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_login_date\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_login_date",$searchtype);
//	edit format
$editformats["login_date"]="Text field";
// logout_date 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["logout_date"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["logout_date"];
	$smarty->assign("value_logout_date",@$_SESSION[$strTableName."_asearchfor"]["logout_date"]);
	$smarty->assign("value1_logout_date",@$_SESSION[$strTableName."_asearchfor2"]["logout_date"]);
}	
if($not)
	$smarty->assign("not_logout_date"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_logout_date\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_logout_date",$searchtype);
//	edit format
$editformats["logout_date"]="Text field";
// login_from 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["login_from"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["login_from"];
	$smarty->assign("value_login_from",@$_SESSION[$strTableName."_asearchfor"]["login_from"]);
	$smarty->assign("value1_login_from",@$_SESSION[$strTableName."_asearchfor2"]["login_from"]);
}	
if($not)
	$smarty->assign("not_login_from"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_login_from\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_login_from",$searchtype);
//	edit format
$editformats["login_from"]="Text field";

$linkdata="";

$linkdata .= "<script type=\"text/javascript\">\r\n";

if ($useAJAX) {
}
else
{
}
$linkdata.="</script>\r\n";

$smarty->assign("linkdata",$linkdata);

$templatefile = "t_log_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($smarty,$templatefile);

$smarty->display($templatefile);

?>