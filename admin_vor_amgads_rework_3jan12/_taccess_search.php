<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_taccess_variables.php");

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
$includes.="var SUGGEST_TABLE = \"_taccess_searchsuggest.php\";\r\n";
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
	document.getElementById('second_Country').style.display =  
		document.forms.editform.elements['asearchopt_Country'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Zip').style.display =  
		document.forms.editform.elements['asearchopt_Zip'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Location').style.display =  
		document.forms.editform.elements['asearchopt_Location'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Start').style.display =  
		document.forms.editform.elements['asearchopt_Start'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_End').style.display =  
		document.forms.editform.elements['asearchopt_End'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_Note').style.display =  
		document.forms.editform.elements['asearchopt_Note'].value==\"Between\" ? '' : 'none'; 
	document.getElementById('second_ID').style.display =  
		document.forms.editform.elements['asearchopt_ID'].value==\"Between\" ? '' : 'none'; 
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
	document.forms.editform.value_Country.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Country,'advanced')};
	document.forms.editform.value1_Country.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Country,'advanced1')};
	document.forms.editform.value_Country.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Country,'advanced')};
	document.forms.editform.value1_Country.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Country,'advanced1')};
	document.forms.editform.value_Note.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_Note,'advanced')};
	document.forms.editform.value1_Note.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_Note,'advanced1')};
	document.forms.editform.value_Note.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_Note,'advanced')};
	document.forms.editform.value1_Note.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_Note,'advanced1')};
	document.forms.editform.value_ID.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value_ID,'advanced')};
	document.forms.editform.value1_ID.onkeyup=function(event) {searchSuggest(event,document.forms.editform.value1_ID,'advanced1')};
	document.forms.editform.value_ID.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value_ID,'advanced')};
	document.forms.editform.value1_ID.onkeydown=function(event) {return listenEvent(event,document.forms.editform.value1_ID,'advanced1')};
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

// Country 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Country"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Country"];
	$smarty->assign("value_Country",@$_SESSION[$strTableName."_asearchfor"]["Country"]);
	$smarty->assign("value1_Country",@$_SESSION[$strTableName."_asearchfor2"]["Country"]);
}	
if($not)
	$smarty->assign("not_Country"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Country\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Country",$searchtype);
//	edit format
$editformats["Country"]="Text field";
// Zip 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Zip"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Zip"];
	$smarty->assign("value_Zip",@$_SESSION[$strTableName."_asearchfor"]["Zip"]);
	$smarty->assign("value1_Zip",@$_SESSION[$strTableName."_asearchfor2"]["Zip"]);
}	
if($not)
	$smarty->assign("not_Zip"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Zip\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Zip",$searchtype);
//	edit format
$editformats["Zip"]="Lookup wizard";
// Location 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Location"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Location"];
	$smarty->assign("value_Location",@$_SESSION[$strTableName."_asearchfor"]["Location"]);
	$smarty->assign("value1_Location",@$_SESSION[$strTableName."_asearchfor2"]["Location"]);
}	
if($not)
	$smarty->assign("not_Location"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Location\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Location",$searchtype);
//	edit format
$editformats["Location"]="Lookup wizard";
// Start 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Start"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Start"];
	$smarty->assign("value_Start",@$_SESSION[$strTableName."_asearchfor"]["Start"]);
	$smarty->assign("value1_Start",@$_SESSION[$strTableName."_asearchfor2"]["Start"]);
}	
if($not)
	$smarty->assign("not_Start"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Start\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Start",$searchtype);
//	edit format
$editformats["Start"]="Date";
// End 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["End"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["End"];
	$smarty->assign("value_End",@$_SESSION[$strTableName."_asearchfor"]["End"]);
	$smarty->assign("value1_End",@$_SESSION[$strTableName."_asearchfor2"]["End"]);
}	
if($not)
	$smarty->assign("not_End"," checked");
//	write search options
$options="";
$options.="<OPTION VALUE=\"Equals\" ".(($opt=="Equals")?"selected":"").">"."Equals"."</option>";
$options.="<OPTION VALUE=\"More than ...\" ".(($opt=="More than ...")?"selected":"").">"."More than ..."."</option>";
$options.="<OPTION VALUE=\"Less than ...\" ".(($opt=="Less than ...")?"selected":"").">"."Less than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or more than ...\" ".(($opt=="Equal or more than ...")?"selected":"").">"."Equal or more than ..."."</option>";
$options.="<OPTION VALUE=\"Equal or less than ...\" ".(($opt=="Equal or less than ...")?"selected":"").">"."Equal or less than ..."."</option>";
$options.="<OPTION VALUE=\"Between\" ".(($opt=="Between")?"selected":"").">"."Between"."</option>";
$options.="<OPTION VALUE=\"Empty\" ".(($opt=="Empty")?"selected":"").">"."Empty"."</option>";
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_End\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_End",$searchtype);
//	edit format
$editformats["End"]="Date";
// Note 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["Note"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["Note"];
	$smarty->assign("value_Note",@$_SESSION[$strTableName."_asearchfor"]["Note"]);
	$smarty->assign("value1_Note",@$_SESSION[$strTableName."_asearchfor2"]["Note"]);
}	
if($not)
	$smarty->assign("not_Note"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_Note\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_Note",$searchtype);
//	edit format
$editformats["Note"]="Text field";
// ID 
$opt="";
$not=false;
if(@$_SESSION[$strTableName."_search"]==2)
{
	$opt=@$_SESSION[$strTableName."_asearchopt"]["ID"];
	$not=@$_SESSION[$strTableName."_asearchnot"]["ID"];
	$smarty->assign("value_ID",@$_SESSION[$strTableName."_asearchfor"]["ID"]);
	$smarty->assign("value1_ID",@$_SESSION[$strTableName."_asearchfor2"]["ID"]);
}	
if($not)
	$smarty->assign("not_ID"," checked");
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
$searchtype = "<SELECT ID=\"SearchOption\" NAME=\"asearchopt_ID\" SIZE=1 onChange=\"return ShowHideControls();\">";
$searchtype .= $options;
$searchtype .= "</SELECT>";
$smarty->assign("searchtype_ID",$searchtype);
//	edit format
$editformats["ID"]="Text field";

$linkdata="";

$linkdata .= "<script type=\"text/javascript\">\r\n";

if ($useAJAX) {
		$output = loadSelectContent("Location",@$_SESSION[$strTableName."_asearchfor"]["Zip"],@$_SESSION[$strTableName."_asearchfor"]["Location"]);
		$txt = ""; 
		foreach( $output as $value ) {
			$txt .= jsreplace($value)."\\n";
		}
		$linkdata .= "preloadSelectContent('".$txt."', 'value_Location', '".jsreplace(@$_SESSION[$strTableName."_asearchfor"]["Location"])."','');\r\n";
}
else
{
	//	Location - Zip
	$linkdata.="bLoading = true;";
	$linkdata.="SetSelection('value_Zip', 'value_Location', '".jsreplace(@@$_SESSION[$strTableName."_asearchfor"]["Zip"])."', '".jsreplace(@$_SESSION[$strTableName."_asearchfor"]["Location"])."', arr_Location);";
	$linkdata.="bLoading = false;";
}
$linkdata.="</script>\r\n";

$smarty->assign("linkdata",$linkdata);

$templatefile = "_taccess_search.htm";
if(function_exists("BeforeShowSearch"))
	BeforeShowSearch($smarty,$templatefile);

$smarty->display($templatefile);

?>