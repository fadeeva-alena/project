<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_t_search_variables.php");

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
$includes.="var SUGGEST_TABLE = \"_t_search_searchsuggest.php\";\r\n";
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
	document.getElementById('second_date').style.display =  
		document.forms.editform.elements['asearchopt_date'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_searchid').style.display =  
		document.forms.editform.elements['asearchopt_searchid'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Search_type').style.display =  
		document.forms.editform.elements['asearchopt_Search_type'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Username').style.display =  
		document.forms.editform.elements['asearchopt_Username'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Skill_type').style.display =  
		document.forms.editform.elements['asearchopt_Skill_type'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Skill_Subtype').style.display =  
		document.forms.editform.elements['asearchopt_Skill_Subtype'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Gender').style.display =  
		document.forms.editform.elements['asearchopt_Gender'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_date,'advanced')};
	document.forms.editform.value1_date.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_date,'advanced1')};
	document.forms.editform.value_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_date,'advanced')};
	document.forms.editform.value1_date.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_date,'advanced1')};
	document.forms.editform.value_searchid.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_searchid,'advanced')};
	document.forms.editform.value1_searchid.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_searchid,'advanced1')};
	document.forms.editform.value_searchid.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_searchid,'advanced')};
	document.forms.editform.value1_searchid.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_searchid,'advanced1')};
	document.forms.editform.value_Search_type.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Search_type,'advanced')};
	document.forms.editform.value1_Search_type.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Search_type,'advanced1')};
	document.forms.editform.value_Search_type.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Search_type,'advanced')};
	document.forms.editform.value1_Search_type.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Search_type,'advanced1')};
	document.forms.editform.value_Username.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Username,'advanced')};
	document.forms.editform.value1_Username.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Username,'advanced1')};
	document.forms.editform.value_Username.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Username,'advanced')};
	document.forms.editform.value1_Username.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Username,'advanced1')};
	document.forms.editform.value_Gender.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Gender,'advanced')};
	document.forms.editform.value1_Gender.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Gender,'advanced1')};
	document.forms.editform.value_Gender.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Gender,'advanced')};
	document.forms.editform.value1_Gender.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Gender,'advanced1')};
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

// date 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["date"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["date"];
	$smarty->assign("value_date",@$_SESSION[$strTableName."_asearchfor"]["date"]);
	$smarty->assign("value1_date",@$_SESSION[$strTableName."_asearchfor2"]["date"]);
}	
if($not)
	$smarty->assign("not_date"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_date\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_date",$searchtype);
//	edit format
$editformats["date"]="Text field";
// searchid 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["searchid"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["searchid"];
	$smarty->assign("value_searchid",@$_SESSION[$strTableName."_asearchfor"]["searchid"]);
	$smarty->assign("value1_searchid",@$_SESSION[$strTableName."_asearchfor2"]["searchid"]);
}	
if($not)
	$smarty->assign("not_searchid"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_searchid\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_searchid",$searchtype);
//	edit format
$editformats["searchid"]="Text field";
// Search_type 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Search_type"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Search_type"];
	$smarty->assign("value_Search_type",@$_SESSION[$strTableName."_asearchfor"]["Search_type"]);
	$smarty->assign("value1_Search_type",@$_SESSION[$strTableName."_asearchfor2"]["Search_type"]);
}	
if($not)
	$smarty->assign("not_Search_type"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Search_type\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Search_type",$searchtype);
//	edit format
$editformats["Search_type"]="Text field";
// Username 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Username"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Username"];
	$smarty->assign("value_Username",@$_SESSION[$strTableName."_asearchfor"]["Username"]);
	$smarty->assign("value1_Username",@$_SESSION[$strTableName."_asearchfor2"]["Username"]);
}	
if($not)
	$smarty->assign("not_Username"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Username\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Username",$searchtype);
//	edit format
$editformats["Username"]="Text field";
// Skill_type 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Skill_type"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Skill_type"];
	$smarty->assign("value_Skill_type",@$_SESSION[$strTableName."_asearchfor"]["Skill_type"]);
	$smarty->assign("value1_Skill_type",@$_SESSION[$strTableName."_asearchfor2"]["Skill_type"]);
}	
if($not)
	$smarty->assign("not_Skill_type"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Skill_type\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Skill_type",$searchtype);
//	edit format
$editformats["Skill_type"]="Lookup wizard";
// Skill_Subtype 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Skill_Subtype"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Skill_Subtype"];
	$smarty->assign("value_Skill_Subtype",@$_SESSION[$strTableName."_asearchfor"]["Skill_Subtype"]);
	$smarty->assign("value1_Skill_Subtype",@$_SESSION[$strTableName."_asearchfor2"]["Skill_Subtype"]);
}	
if($not)
	$smarty->assign("not_Skill_Subtype"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Skill_Subtype\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Skill_Subtype",$searchtype);
//	edit format
$editformats["Skill_Subtype"]="Lookup wizard";
// Gender 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Gender"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Gender"];
	$smarty->assign("value_Gender",@$_SESSION[$strTableName."_asearchfor"]["Gender"]);
	$smarty->assign("value1_Gender",@$_SESSION[$strTableName."_asearchfor2"]["Gender"]);
}	
if($not)
	$smarty->assign("not_Gender"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Gender\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Gender",$searchtype);
//	edit format
$editformats["Gender"]="Text field";

$linkdata="";

$linkdata .= "<script type=\"text/javascript\">\r\n";

if ($useAJAX) {
}
else
{
}
$linkdata.="</script>\r\n";

$smarty->assign("linkdata",$linkdata);

$templatefile = "_t_search_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($smarty,$templatefile);

$smarty->display($templatefile);

?>