<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
session_cache_limiter("none");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_people_variables.php");

if(!@$_SESSION["UserID"])
{ 
	$_SESSION["MyURL"]=$_SERVER["SCRIPT_NAME"]."?".$_SERVER["QUERY_STRING"];
	header("Location: login.php?message=expired"); 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Export"))
{
	echo "<p>"."You don't have permissions to access this table"."<a href=\"login.php\">"."Back to login page"."</a></p>";
	return;
}

$conn=db_connect();
//	Before Process event
if(function_exists("BeforeProcessExport"))
	BeforeProcessExport($conn);

$strWhereClause="";

$options = "1";
if (@$_REQUEST["a"]!="") 
{
	$options = "";
	
	$sWhere = "1=0";	

//	process selection
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
			$keys["people_id"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}


	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
	
	$_SESSION[$strTableName."_SelectedSQL"] = $strSQL;
	$_SESSION[$strTableName."_SelectedWhere"] = $sWhere;
}

if ($_SESSION[$strTableName."_SelectedSQL"]!="" && @$_REQUEST["records"]=="") 
{
	$strSQL = $_SESSION[$strTableName."_SelectedSQL"];
	$strWhereClause=@$_SESSION[$strTableName."_SelectedWhere"];
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strSQL=gSQLWhere($strWhereClause);
}


$mypage=1;
if(@$_REQUEST["type"])
{
//	order by
	$strOrderBy=$_SESSION[$strTableName."_order"];
	if(!$strOrderBy)
		$strOrderBy=$gstrOrderBy;
	$strSQL.=" ".trim($strOrderBy);

	$strSQLbak = $strSQL;
	if(function_exists("BeforeQueryExport"))
		BeforeQueryExport($strSQL,$strWhereClause,$strOrderBy);
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

	$nPageSize=0;
	if(@$_REQUEST["records"]=="page" && $numrows)
	{
		$mypage=(integer)@$_SESSION[$strTableName."_pagenumber"];
		$nPageSize=(integer)@$_SESSION[$strTableName."_pagesize"];
		if($numrows<=($mypage-1)*$nPageSize)
			$mypage=ceil($numrows/$nPageSize);
		if(!$nPageSize)
			$nPageSize=$gPageSize;
		if(!$mypage)
			$mypage=1;

		$strSQL.=" limit ".(($mypage-1)*$nPageSize).",".$nPageSize;
	}
	$rs=db_query($strSQL,$conn);

	if(!ini_get("safe_mode"))
		set_time_limit(300);
	
	if(@$_REQUEST["type"]=="excel")
		ExportToExcel();
	else if(@$_REQUEST["type"]=="word")
		ExportToWord();
	else if(@$_REQUEST["type"]=="xml")
		ExportToXML();
	else if(@$_REQUEST["type"]=="csv")
		ExportToCSV();
	else if(@$_REQUEST["type"]=="pdf")
		ExportToPDF();

	db_close($conn);
	return;
}

header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 

include('libs/Smarty.class.php');
$smarty = new Smarty();
$smarty->assign("options",$options);
$smarty->display("t_people_export.htm");


function ExportToExcel()
{
	global $cCharset;
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=t_people.xls");

	echo "<html>";
	echo "<html xmlns:o=\"urn:schemas-microsoft-com:office:office\" xmlns:x=\"urn:schemas-microsoft-com:office:excel\" xmlns=\"http://www.w3.org/TR/REC-html40\">";
	
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToWord()
{
	global $cCharset;
	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment;Filename=t_people.doc");

	echo "<html>";
	echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=".$cCharset."\">";
	echo "<body>";
	echo "<table border=1>";

	WriteTableData();

	echo "</table>";
	echo "</body>";
	echo "</html>";
}

function ExportToXML()
{
	global $nPageSize,$rs,$strTableName,$conn;
	header("Content-type: text/xml");
	header("Content-Disposition: attachment;Filename=t_people.xml");
	if(!($row=db_fetch_array($rs)))
		return;
	global $cCharset;
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i=0;
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		echo "<row>\r\n";
		$field=htmlspecialchars(XMLNameEncode("people_id"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"people_id",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("institution"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"institution",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("prof_provider"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"prof_provider",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("firstname"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"firstname",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("lastname"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"lastname",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("image_path"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"image_path",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("street"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"street",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("house_nr"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"house_nr",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("zip"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"zip",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("location"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"location",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("locationarea"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"locationarea",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("tel_p"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"tel_p",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("tel_m"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"tel_m",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("email"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"email",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("username"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"username",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("password"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"password",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("picture"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"picture",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("picture_2"));
		echo "<".$field.">";
		echo "LONG BINARY DATA - CANNOT BE DISPLAYED";
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("gender"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"gender",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("adminstatus"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"adminstatus",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("birthdate"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"birthdate",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("enabled"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"enabled",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("temp_sched_from"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"temp_sched_from",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("temp_sched_to"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"temp_sched_to",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("joiningdate"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"joiningdate",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("coord_accuracy"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"coord_accuracy",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("monday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"monday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("tuesday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"tuesday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("wednesday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"wednesday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("thursday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"thursday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("friday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"friday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("saturday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"saturday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("sunday"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"sunday",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("monday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"monday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("tuesday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"tuesday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("wednesday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"wednesday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("thursday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"thursday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("friday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"friday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("saturday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"saturday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("sunday_t"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"sunday_t",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("preferred_contact_by"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"preferred_contact_by",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("date_last_adress_change"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"date_last_adress_change",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("map_in"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"map_in",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("IconPath"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"IconPath",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("Icon"));
		echo "<".$field.">";
		echo "LONG BINARY DATA - CANNOT BE DISPLAYED";
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("note"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"note",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("price_per_hour"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"price_per_hour",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("psych_time_loose_tight"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"psych_time_loose_tight",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("psych_exact_creativ"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"psych_exact_creativ",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("psych_heart_thing"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"psych_heart_thing",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("psych_easy_security"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"psych_easy_security",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("psych_conflict_take_leave"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"psych_conflict_take_leave",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("longitude"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"longitude",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("latitude"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"latitude",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("Agree"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"Agree",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("Sign_date"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"Sign_date",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("Active"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"Active",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("Acode"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"Acode",""));
		echo "</".$field.">\r\n";
		echo "</row>\r\n";
		$i++;
		$row=db_fetch_array($rs);
	}
	echo "</table>\r\n";
}

function ExportToCSV()
{
	global $rs,$nPageSize,$strTableName,$conn;
	header("Content-type: application/csv");
	header("Content-Disposition: attachment;Filename=t_people.csv");

	if(!($row=db_fetch_array($rs)))
		return;

	$totals=array();

	
// write header
	$outstr="";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"people_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"institution\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"prof_provider\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"firstname\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"lastname\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"image_path\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"street\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"house_nr\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"zip\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"location\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"locationarea\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tel_p\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tel_m\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"email\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"username\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"password\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"picture\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"picture_2\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"gender\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"adminstatus\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"birthdate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"enabled\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"temp_sched_from\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"temp_sched_to\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"joiningdate\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"coord_accuracy\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"monday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tuesday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"wednesday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"thursday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"friday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"saturday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"sunday\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"monday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"tuesday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"wednesday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"thursday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"friday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"saturday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"sunday_t\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"preferred_contact_by\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"date_last_adress_change\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"map_in\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"IconPath\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Icon\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"note\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"price_per_hour\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_time_loose_tight\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_exact_creativ\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_heart_thing\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_easy_security\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"psych_conflict_take_leave\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"longitude\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"latitude\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Agree\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Sign_date\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Active\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"Acode\"";
	echo $outstr;
	echo "\r\n";

// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		$outstr="";
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"people_id",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"institution",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"prof_provider",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"firstname",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"lastname",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format=FORMAT_NONE;
		$outstr.='"'.htmlspecialchars(GetData($row,"image_path",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"street",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"house_nr",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"zip",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"location",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"locationarea",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"tel_p",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"tel_m",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"email",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"username",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"password",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"picture",$format)).'"';
		if($outstr!="")
			$outstr.=",";
		$outstr.='"'.htmlspecialchars("LONG BINARY DATA - CANNOT BE DISPLAYED").'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"gender",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"adminstatus",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Short Date";
		$outstr.='"'.htmlspecialchars(GetData($row,"birthdate",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"enabled",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"temp_sched_from",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"temp_sched_to",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Short Date";
		$outstr.='"'.htmlspecialchars(GetData($row,"joiningdate",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"coord_accuracy",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"monday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"tuesday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"wednesday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"thursday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"friday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"saturday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"sunday",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"monday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"tuesday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"wednesday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"thursday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"friday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"saturday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"sunday_t",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"preferred_contact_by",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Short Date";
		$outstr.='"'.htmlspecialchars(GetData($row,"date_last_adress_change",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"map_in",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"IconPath",$format)).'"';
		if($outstr!="")
			$outstr.=",";
		$outstr.='"'.htmlspecialchars("LONG BINARY DATA - CANNOT BE DISPLAYED").'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"note",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Number";
		$outstr.='"'.htmlspecialchars(GetData($row,"price_per_hour",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"psych_time_loose_tight",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"psych_exact_creativ",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"psych_heart_thing",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"psych_easy_security",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"psych_conflict_take_leave",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Number";
		$outstr.='"'.htmlspecialchars(GetData($row,"longitude",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="Number";
		$outstr.='"'.htmlspecialchars(GetData($row,"latitude",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"Agree",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"Sign_date",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"Active",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"Acode",$format)).'"';
		echo $outstr;
		echo "\r\n";
		$iNumberOfRows++;
		$row=db_fetch_array($rs);
	}

//	display totals
	$first=true;

}


function WriteTableData()
{
	global $rs,$nPageSize,$strTableName,$conn;
	if(!($row=db_fetch_array($rs)))
		return;
// write header
	echo "<tr>";
	if($_REQUEST["type"]=="excel")
	{
		echo '<td style="width: 100" x:str>'.PrepareForExcel("people_id").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("institution").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("prof_provider").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("firstname").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("lastname").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("image_path").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("street").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("house_nr").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("zip").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("location").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("locationarea").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("tel_p").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("tel_m").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("email").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("username").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("password").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("picture").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("picture_2").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("gender").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("adminstatus").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("birthdate").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("enabled").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("temp_sched_from").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("temp_sched_to").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("joiningdate").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("coord_accuracy").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("monday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("tuesday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("wednesday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("thursday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("friday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("saturday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("sunday").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("monday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("tuesday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("wednesday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("thursday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("friday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("saturday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("sunday_t").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("preferred_contact_by").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("date_last_adress_change").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("map_in").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("IconPath").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Icon").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("note").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("price_per_hour").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("psych_time_loose_tight").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("psych_exact_creativ").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("psych_heart_thing").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("psych_easy_security").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("psych_conflict_take_leave").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("longitude").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("latitude").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Agree").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Sign_date").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Active").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("Acode").'</td>';
	}
	else
	{
		echo "<td>people_id</td>";
		echo "<td>institution</td>";
		echo "<td>prof_provider</td>";
		echo "<td>firstname</td>";
		echo "<td>lastname</td>";
		echo "<td>image_path</td>";
		echo "<td>street</td>";
		echo "<td>house_nr</td>";
		echo "<td>zip</td>";
		echo "<td>location</td>";
		echo "<td>locationarea</td>";
		echo "<td>tel_p</td>";
		echo "<td>tel_m</td>";
		echo "<td>email</td>";
		echo "<td>username</td>";
		echo "<td>password</td>";
		echo "<td>picture</td>";
		echo "<td>picture_2</td>";
		echo "<td>gender</td>";
		echo "<td>adminstatus</td>";
		echo "<td>birthdate</td>";
		echo "<td>enabled</td>";
		echo "<td>temp_sched_from</td>";
		echo "<td>temp_sched_to</td>";
		echo "<td>joiningdate</td>";
		echo "<td>coord_accuracy</td>";
		echo "<td>monday</td>";
		echo "<td>tuesday</td>";
		echo "<td>wednesday</td>";
		echo "<td>thursday</td>";
		echo "<td>friday</td>";
		echo "<td>saturday</td>";
		echo "<td>sunday</td>";
		echo "<td>monday_t</td>";
		echo "<td>tuesday_t</td>";
		echo "<td>wednesday_t</td>";
		echo "<td>thursday_t</td>";
		echo "<td>friday_t</td>";
		echo "<td>saturday_t</td>";
		echo "<td>sunday_t</td>";
		echo "<td>preferred_contact_by</td>";
		echo "<td>date_last_adress_change</td>";
		echo "<td>map_in</td>";
		echo "<td>IconPath</td>";
		echo "<td>Icon</td>";
		echo "<td>note</td>";
		echo "<td>price_per_hour</td>";
		echo "<td>psych_time_loose_tight</td>";
		echo "<td>psych_exact_creativ</td>";
		echo "<td>psych_heart_thing</td>";
		echo "<td>psych_easy_security</td>";
		echo "<td>psych_conflict_take_leave</td>";
		echo "<td>longitude</td>";
		echo "<td>latitude</td>";
		echo "<td>Agree</td>";
		echo "<td>Sign_date</td>";
		echo "<td>Active</td>";
		echo "<td>Acode</td>";
	}
	echo "</tr>";

	$totals=array();
// write data rows
	$iNumberOfRows = 0;
	while((!$nPageSize || $iNumberOfRows<$nPageSize) && $row)
	{
		echo "<tr>";
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"people_id",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"institution",$format));
		else
			echo htmlspecialchars(GetData($row,"institution",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"prof_provider",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"firstname",$format));
		else
			echo htmlspecialchars(GetData($row,"firstname",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"lastname",$format));
		else
			echo htmlspecialchars(GetData($row,"lastname",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format=FORMAT_NONE;
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"image_path",$format));
		else
			echo htmlspecialchars(GetData($row,"image_path",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"street",$format));
		else
			echo htmlspecialchars(GetData($row,"street",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"house_nr",$format));
		else
			echo htmlspecialchars(GetData($row,"house_nr",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"zip",$format));
		else
			echo htmlspecialchars(GetData($row,"zip",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"location",$format));
		else
			echo htmlspecialchars(GetData($row,"location",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"locationarea",$format));
		else
			echo htmlspecialchars(GetData($row,"locationarea",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"tel_p",$format));
		else
			echo htmlspecialchars(GetData($row,"tel_p",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"tel_m",$format));
		else
			echo htmlspecialchars(GetData($row,"tel_m",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"email",$format));
		else
			echo htmlspecialchars(GetData($row,"email",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"username",$format));
		else
			echo htmlspecialchars(GetData($row,"username",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"password",$format));
		else
			echo htmlspecialchars(GetData($row,"password",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"picture",$format));
		else
			echo htmlspecialchars(GetData($row,"picture",$format));
	echo '</td>';
	echo '<td>';
		echo "LONG BINARY DATA - CANNOT BE DISPLAYED";
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"gender",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"adminstatus",$format));
	echo '</td>';
	echo '<td>';

		$format="Short Date";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"birthdate",$format));
		else
			echo htmlspecialchars(GetData($row,"birthdate",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"enabled",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"temp_sched_from",$format));
		else
			echo htmlspecialchars(GetData($row,"temp_sched_from",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"temp_sched_to",$format));
		else
			echo htmlspecialchars(GetData($row,"temp_sched_to",$format));
	echo '</td>';
	echo '<td>';

		$format="Short Date";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"joiningdate",$format));
		else
			echo htmlspecialchars(GetData($row,"joiningdate",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"coord_accuracy",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"monday",$format));
		else
			echo htmlspecialchars(GetData($row,"monday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"tuesday",$format));
		else
			echo htmlspecialchars(GetData($row,"tuesday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"wednesday",$format));
		else
			echo htmlspecialchars(GetData($row,"wednesday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"thursday",$format));
		else
			echo htmlspecialchars(GetData($row,"thursday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"friday",$format));
		else
			echo htmlspecialchars(GetData($row,"friday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"saturday",$format));
		else
			echo htmlspecialchars(GetData($row,"saturday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"sunday",$format));
		else
			echo htmlspecialchars(GetData($row,"sunday",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"monday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"monday_t",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"tuesday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"tuesday_t",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"wednesday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"wednesday_t",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"thursday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"thursday_t",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"friday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"friday_t",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"saturday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"saturday_t",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"sunday_t",$format));
		else
			echo htmlspecialchars(GetData($row,"sunday_t",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"preferred_contact_by",$format));
	echo '</td>';
	echo '<td>';

		$format="Short Date";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"date_last_adress_change",$format));
		else
			echo htmlspecialchars(GetData($row,"date_last_adress_change",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"map_in",$format));
		else
			echo htmlspecialchars(GetData($row,"map_in",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"IconPath",$format));
		else
			echo htmlspecialchars(GetData($row,"IconPath",$format));
	echo '</td>';
	echo '<td>';
		echo "LONG BINARY DATA - CANNOT BE DISPLAYED";
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"note",$format));
		else
			echo htmlspecialchars(GetData($row,"note",$format));
	echo '</td>';
	echo '<td>';

		$format="Number";
			echo htmlspecialchars(GetData($row,"price_per_hour",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"psych_time_loose_tight",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"psych_exact_creativ",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"psych_heart_thing",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"psych_easy_security",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"psych_conflict_take_leave",$format));
	echo '</td>';
	echo '<td>';

		$format="Number";
			echo htmlspecialchars(GetData($row,"longitude",$format));
	echo '</td>';
	echo '<td>';

		$format="Number";
			echo htmlspecialchars(GetData($row,"latitude",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"Agree",$format));
		else
			echo htmlspecialchars(GetData($row,"Agree",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"Sign_date",$format));
		else
			echo htmlspecialchars(GetData($row,"Sign_date",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"Active",$format));
		else
			echo htmlspecialchars(GetData($row,"Active",$format));
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"Acode",$format));
		else
			echo htmlspecialchars(GetData($row,"Acode",$format));
	echo '</td>';
		echo "</tr>";
		$iNumberOfRows++;
		$row=db_fetch_array($rs);
	}

}

function XMLNameEncode($strValue)
{	
	$search=array(" ","#","'","/","\\","(",")",",","[","]","+","\"","-","_","|","}","{","=");
	return str_replace($search,"",$strValue);
}

function PrepareForExcel($str)
{
	$ret = htmlspecialchars($str);
	if (substr($ret,0,1)== "=") 
		$ret = "&#61;".substr($ret,1);
	return $ret;

}




function ExportToPDF()
{
	global $nPageSize,$rs,$strTableName,$conn;
		global $colwidth,$leftmargin;
	if(!($row=db_fetch_array($rs)))
		return;


	include("libs/fpdf.php");

	class PDF extends FPDF
	{
	//Current column
		var $col=0;
	//Ordinate of column start
		var $y0;
		var $maxheight;

	function AcceptPageBreak()
	{
		global $colwidth,$leftmargin;
		if($this->y0+$this->rowheight>$this->PageBreakTrigger)
			return true;
		$x=$leftmargin;
		if($this->maxheight<$this->PageBreakTrigger-$this->y0)
			$this->maxheight=$this->PageBreakTrigger-$this->y0;
		$this->Rect($x,$this->y0,$colwidth["people_id"],$this->maxheight);
		$x+=$colwidth["people_id"];
		$this->Rect($x,$this->y0,$colwidth["institution"],$this->maxheight);
		$x+=$colwidth["institution"];
		$this->Rect($x,$this->y0,$colwidth["prof_provider"],$this->maxheight);
		$x+=$colwidth["prof_provider"];
		$this->Rect($x,$this->y0,$colwidth["firstname"],$this->maxheight);
		$x+=$colwidth["firstname"];
		$this->Rect($x,$this->y0,$colwidth["lastname"],$this->maxheight);
		$x+=$colwidth["lastname"];
		$this->Rect($x,$this->y0,$colwidth["image_path"],$this->maxheight);
		$x+=$colwidth["image_path"];
		$this->Rect($x,$this->y0,$colwidth["street"],$this->maxheight);
		$x+=$colwidth["street"];
		$this->Rect($x,$this->y0,$colwidth["house_nr"],$this->maxheight);
		$x+=$colwidth["house_nr"];
		$this->Rect($x,$this->y0,$colwidth["zip"],$this->maxheight);
		$x+=$colwidth["zip"];
		$this->Rect($x,$this->y0,$colwidth["location"],$this->maxheight);
		$x+=$colwidth["location"];
		$this->Rect($x,$this->y0,$colwidth["locationarea"],$this->maxheight);
		$x+=$colwidth["locationarea"];
		$this->Rect($x,$this->y0,$colwidth["tel_p"],$this->maxheight);
		$x+=$colwidth["tel_p"];
		$this->Rect($x,$this->y0,$colwidth["tel_m"],$this->maxheight);
		$x+=$colwidth["tel_m"];
		$this->Rect($x,$this->y0,$colwidth["email"],$this->maxheight);
		$x+=$colwidth["email"];
		$this->Rect($x,$this->y0,$colwidth["username"],$this->maxheight);
		$x+=$colwidth["username"];
		$this->Rect($x,$this->y0,$colwidth["password"],$this->maxheight);
		$x+=$colwidth["password"];
		$this->Rect($x,$this->y0,$colwidth["picture"],$this->maxheight);
		$x+=$colwidth["picture"];
		$this->Rect($x,$this->y0,$colwidth["picture_2"],$this->maxheight);
		$x+=$colwidth["picture_2"];
		$this->Rect($x,$this->y0,$colwidth["gender"],$this->maxheight);
		$x+=$colwidth["gender"];
		$this->Rect($x,$this->y0,$colwidth["adminstatus"],$this->maxheight);
		$x+=$colwidth["adminstatus"];
		$this->Rect($x,$this->y0,$colwidth["birthdate"],$this->maxheight);
		$x+=$colwidth["birthdate"];
		$this->Rect($x,$this->y0,$colwidth["enabled"],$this->maxheight);
		$x+=$colwidth["enabled"];
		$this->Rect($x,$this->y0,$colwidth["temp_sched_from"],$this->maxheight);
		$x+=$colwidth["temp_sched_from"];
		$this->Rect($x,$this->y0,$colwidth["temp_sched_to"],$this->maxheight);
		$x+=$colwidth["temp_sched_to"];
		$this->Rect($x,$this->y0,$colwidth["joiningdate"],$this->maxheight);
		$x+=$colwidth["joiningdate"];
		$this->Rect($x,$this->y0,$colwidth["coord_accuracy"],$this->maxheight);
		$x+=$colwidth["coord_accuracy"];
		$this->Rect($x,$this->y0,$colwidth["monday"],$this->maxheight);
		$x+=$colwidth["monday"];
		$this->Rect($x,$this->y0,$colwidth["tuesday"],$this->maxheight);
		$x+=$colwidth["tuesday"];
		$this->Rect($x,$this->y0,$colwidth["wednesday"],$this->maxheight);
		$x+=$colwidth["wednesday"];
		$this->Rect($x,$this->y0,$colwidth["thursday"],$this->maxheight);
		$x+=$colwidth["thursday"];
		$this->Rect($x,$this->y0,$colwidth["friday"],$this->maxheight);
		$x+=$colwidth["friday"];
		$this->Rect($x,$this->y0,$colwidth["saturday"],$this->maxheight);
		$x+=$colwidth["saturday"];
		$this->Rect($x,$this->y0,$colwidth["sunday"],$this->maxheight);
		$x+=$colwidth["sunday"];
		$this->Rect($x,$this->y0,$colwidth["monday_t"],$this->maxheight);
		$x+=$colwidth["monday_t"];
		$this->Rect($x,$this->y0,$colwidth["tuesday_t"],$this->maxheight);
		$x+=$colwidth["tuesday_t"];
		$this->Rect($x,$this->y0,$colwidth["wednesday_t"],$this->maxheight);
		$x+=$colwidth["wednesday_t"];
		$this->Rect($x,$this->y0,$colwidth["thursday_t"],$this->maxheight);
		$x+=$colwidth["thursday_t"];
		$this->Rect($x,$this->y0,$colwidth["friday_t"],$this->maxheight);
		$x+=$colwidth["friday_t"];
		$this->Rect($x,$this->y0,$colwidth["saturday_t"],$this->maxheight);
		$x+=$colwidth["saturday_t"];
		$this->Rect($x,$this->y0,$colwidth["sunday_t"],$this->maxheight);
		$x+=$colwidth["sunday_t"];
		$this->Rect($x,$this->y0,$colwidth["preferred_contact_by"],$this->maxheight);
		$x+=$colwidth["preferred_contact_by"];
		$this->Rect($x,$this->y0,$colwidth["date_last_adress_change"],$this->maxheight);
		$x+=$colwidth["date_last_adress_change"];
		$this->Rect($x,$this->y0,$colwidth["map_in"],$this->maxheight);
		$x+=$colwidth["map_in"];
		$this->Rect($x,$this->y0,$colwidth["IconPath"],$this->maxheight);
		$x+=$colwidth["IconPath"];
		$this->Rect($x,$this->y0,$colwidth["Icon"],$this->maxheight);
		$x+=$colwidth["Icon"];
		$this->Rect($x,$this->y0,$colwidth["note"],$this->maxheight);
		$x+=$colwidth["note"];
		$this->Rect($x,$this->y0,$colwidth["price_per_hour"],$this->maxheight);
		$x+=$colwidth["price_per_hour"];
		$this->Rect($x,$this->y0,$colwidth["psych_time_loose_tight"],$this->maxheight);
		$x+=$colwidth["psych_time_loose_tight"];
		$this->Rect($x,$this->y0,$colwidth["psych_exact_creativ"],$this->maxheight);
		$x+=$colwidth["psych_exact_creativ"];
		$this->Rect($x,$this->y0,$colwidth["psych_heart_thing"],$this->maxheight);
		$x+=$colwidth["psych_heart_thing"];
		$this->Rect($x,$this->y0,$colwidth["psych_easy_security"],$this->maxheight);
		$x+=$colwidth["psych_easy_security"];
		$this->Rect($x,$this->y0,$colwidth["psych_conflict_take_leave"],$this->maxheight);
		$x+=$colwidth["psych_conflict_take_leave"];
		$this->Rect($x,$this->y0,$colwidth["longitude"],$this->maxheight);
		$x+=$colwidth["longitude"];
		$this->Rect($x,$this->y0,$colwidth["latitude"],$this->maxheight);
		$x+=$colwidth["latitude"];
		$this->Rect($x,$this->y0,$colwidth["Agree"],$this->maxheight);
		$x+=$colwidth["Agree"];
		$this->Rect($x,$this->y0,$colwidth["Sign_date"],$this->maxheight);
		$x+=$colwidth["Sign_date"];
		$this->Rect($x,$this->y0,$colwidth["Active"],$this->maxheight);
		$x+=$colwidth["Active"];
		$this->Rect($x,$this->y0,$colwidth["Acode"],$this->maxheight);
		$x+=$colwidth["Acode"];
		$this->maxheight = $this->rowheight;
//	draw frame	
		return true;
	}

	function Header()
	{
		global $colwidth,$leftmargin;
	    //Page header
		$this->SetFillColor(192);
		$this->SetX($leftmargin);
		$this->Cell($colwidth["people_id"],$this->rowheight,"people_id",1,0,'C',1);
		$this->Cell($colwidth["institution"],$this->rowheight,"institution",1,0,'C',1);
		$this->Cell($colwidth["prof_provider"],$this->rowheight,"prof_provider",1,0,'C',1);
		$this->Cell($colwidth["firstname"],$this->rowheight,"firstname",1,0,'C',1);
		$this->Cell($colwidth["lastname"],$this->rowheight,"lastname",1,0,'C',1);
		$this->Cell($colwidth["image_path"],$this->rowheight,"image_path",1,0,'C',1);
		$this->Cell($colwidth["street"],$this->rowheight,"street",1,0,'C',1);
		$this->Cell($colwidth["house_nr"],$this->rowheight,"house_nr",1,0,'C',1);
		$this->Cell($colwidth["zip"],$this->rowheight,"zip",1,0,'C',1);
		$this->Cell($colwidth["location"],$this->rowheight,"location",1,0,'C',1);
		$this->Cell($colwidth["locationarea"],$this->rowheight,"locationarea",1,0,'C',1);
		$this->Cell($colwidth["tel_p"],$this->rowheight,"tel_p",1,0,'C',1);
		$this->Cell($colwidth["tel_m"],$this->rowheight,"tel_m",1,0,'C',1);
		$this->Cell($colwidth["email"],$this->rowheight,"email",1,0,'C',1);
		$this->Cell($colwidth["username"],$this->rowheight,"username",1,0,'C',1);
		$this->Cell($colwidth["password"],$this->rowheight,"password",1,0,'C',1);
		$this->Cell($colwidth["picture"],$this->rowheight,"picture",1,0,'C',1);
		$this->Cell($colwidth["picture_2"],$this->rowheight,"picture_2",1,0,'C',1);
		$this->Cell($colwidth["gender"],$this->rowheight,"gender",1,0,'C',1);
		$this->Cell($colwidth["adminstatus"],$this->rowheight,"adminstatus",1,0,'C',1);
		$this->Cell($colwidth["birthdate"],$this->rowheight,"birthdate",1,0,'C',1);
		$this->Cell($colwidth["enabled"],$this->rowheight,"enabled",1,0,'C',1);
		$this->Cell($colwidth["temp_sched_from"],$this->rowheight,"temp_sched_from",1,0,'C',1);
		$this->Cell($colwidth["temp_sched_to"],$this->rowheight,"temp_sched_to",1,0,'C',1);
		$this->Cell($colwidth["joiningdate"],$this->rowheight,"joiningdate",1,0,'C',1);
		$this->Cell($colwidth["coord_accuracy"],$this->rowheight,"coord_accuracy",1,0,'C',1);
		$this->Cell($colwidth["monday"],$this->rowheight,"monday",1,0,'C',1);
		$this->Cell($colwidth["tuesday"],$this->rowheight,"tuesday",1,0,'C',1);
		$this->Cell($colwidth["wednesday"],$this->rowheight,"wednesday",1,0,'C',1);
		$this->Cell($colwidth["thursday"],$this->rowheight,"thursday",1,0,'C',1);
		$this->Cell($colwidth["friday"],$this->rowheight,"friday",1,0,'C',1);
		$this->Cell($colwidth["saturday"],$this->rowheight,"saturday",1,0,'C',1);
		$this->Cell($colwidth["sunday"],$this->rowheight,"sunday",1,0,'C',1);
		$this->Cell($colwidth["monday_t"],$this->rowheight,"monday_t",1,0,'C',1);
		$this->Cell($colwidth["tuesday_t"],$this->rowheight,"tuesday_t",1,0,'C',1);
		$this->Cell($colwidth["wednesday_t"],$this->rowheight,"wednesday_t",1,0,'C',1);
		$this->Cell($colwidth["thursday_t"],$this->rowheight,"thursday_t",1,0,'C',1);
		$this->Cell($colwidth["friday_t"],$this->rowheight,"friday_t",1,0,'C',1);
		$this->Cell($colwidth["saturday_t"],$this->rowheight,"saturday_t",1,0,'C',1);
		$this->Cell($colwidth["sunday_t"],$this->rowheight,"sunday_t",1,0,'C',1);
		$this->Cell($colwidth["preferred_contact_by"],$this->rowheight,"preferred_contact_by",1,0,'C',1);
		$this->Cell($colwidth["date_last_adress_change"],$this->rowheight,"date_last_adress_change",1,0,'C',1);
		$this->Cell($colwidth["map_in"],$this->rowheight,"map_in",1,0,'C',1);
		$this->Cell($colwidth["IconPath"],$this->rowheight,"IconPath",1,0,'C',1);
		$this->Cell($colwidth["Icon"],$this->rowheight,"Icon",1,0,'C',1);
		$this->Cell($colwidth["note"],$this->rowheight,"note",1,0,'C',1);
		$this->Cell($colwidth["price_per_hour"],$this->rowheight,"price_per_hour",1,0,'C',1);
		$this->Cell($colwidth["psych_time_loose_tight"],$this->rowheight,"psych_time_loose_tight",1,0,'C',1);
		$this->Cell($colwidth["psych_exact_creativ"],$this->rowheight,"psych_exact_creativ",1,0,'C',1);
		$this->Cell($colwidth["psych_heart_thing"],$this->rowheight,"psych_heart_thing",1,0,'C',1);
		$this->Cell($colwidth["psych_easy_security"],$this->rowheight,"psych_easy_security",1,0,'C',1);
		$this->Cell($colwidth["psych_conflict_take_leave"],$this->rowheight,"psych_conflict_take_leave",1,0,'C',1);
		$this->Cell($colwidth["longitude"],$this->rowheight,"longitude",1,0,'C',1);
		$this->Cell($colwidth["latitude"],$this->rowheight,"latitude",1,0,'C',1);
		$this->Cell($colwidth["Agree"],$this->rowheight,"Agree",1,0,'C',1);
		$this->Cell($colwidth["Sign_date"],$this->rowheight,"Sign_date",1,0,'C',1);
		$this->Cell($colwidth["Active"],$this->rowheight,"Active",1,0,'C',1);
		$this->Cell($colwidth["Acode"],$this->rowheight,"Acode",1,0,'C',1);
		$this->Ln($this->rowheight);
		$this->y0=$this->GetY();
	}

	}

	$pdf=new PDF();

	$leftmargin=5;
	$pagewidth=200;
	$pageheight=290;
	$rowheight=5;


	$defwidth=$pagewidth/58;
	$colwidth=array();
    $colwidth["people_id"]=$defwidth;
    $colwidth["institution"]=$defwidth;
    $colwidth["prof_provider"]=$defwidth;
    $colwidth["firstname"]=$defwidth;
    $colwidth["lastname"]=$defwidth;
    $colwidth["image_path"]=$defwidth;
    $colwidth["street"]=$defwidth;
    $colwidth["house_nr"]=$defwidth;
    $colwidth["zip"]=$defwidth;
    $colwidth["location"]=$defwidth;
    $colwidth["locationarea"]=$defwidth;
    $colwidth["tel_p"]=$defwidth;
    $colwidth["tel_m"]=$defwidth;
    $colwidth["email"]=$defwidth;
    $colwidth["username"]=$defwidth;
    $colwidth["password"]=$defwidth;
    $colwidth["picture"]=$defwidth;
    $colwidth["picture_2"]=$defwidth;
    $colwidth["gender"]=$defwidth;
    $colwidth["adminstatus"]=$defwidth;
    $colwidth["birthdate"]=$defwidth;
    $colwidth["enabled"]=$defwidth;
    $colwidth["temp_sched_from"]=$defwidth;
    $colwidth["temp_sched_to"]=$defwidth;
    $colwidth["joiningdate"]=$defwidth;
    $colwidth["coord_accuracy"]=$defwidth;
    $colwidth["monday"]=$defwidth;
    $colwidth["tuesday"]=$defwidth;
    $colwidth["wednesday"]=$defwidth;
    $colwidth["thursday"]=$defwidth;
    $colwidth["friday"]=$defwidth;
    $colwidth["saturday"]=$defwidth;
    $colwidth["sunday"]=$defwidth;
    $colwidth["monday_t"]=$defwidth;
    $colwidth["tuesday_t"]=$defwidth;
    $colwidth["wednesday_t"]=$defwidth;
    $colwidth["thursday_t"]=$defwidth;
    $colwidth["friday_t"]=$defwidth;
    $colwidth["saturday_t"]=$defwidth;
    $colwidth["sunday_t"]=$defwidth;
    $colwidth["preferred_contact_by"]=$defwidth;
    $colwidth["date_last_adress_change"]=$defwidth;
    $colwidth["map_in"]=$defwidth;
    $colwidth["IconPath"]=$defwidth;
    $colwidth["Icon"]=$defwidth;
    $colwidth["note"]=$defwidth;
    $colwidth["price_per_hour"]=$defwidth;
    $colwidth["psych_time_loose_tight"]=$defwidth;
    $colwidth["psych_exact_creativ"]=$defwidth;
    $colwidth["psych_heart_thing"]=$defwidth;
    $colwidth["psych_easy_security"]=$defwidth;
    $colwidth["psych_conflict_take_leave"]=$defwidth;
    $colwidth["longitude"]=$defwidth;
    $colwidth["latitude"]=$defwidth;
    $colwidth["Agree"]=$defwidth;
    $colwidth["Sign_date"]=$defwidth;
    $colwidth["Active"]=$defwidth;
    $colwidth["Acode"]=$defwidth;
	
	$pdf->AddFont('CourierNewPSMT','','courcp1252.php');
	$pdf->rowheight=$rowheight;
	
	$pdf->SetFont('CourierNewPSMT','',8);
	$pdf->AddPage();
	

	$i=0;
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		$pdf->maxheight=$rowheight;
		$x=$leftmargin;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["people_id"],$rowheight,GetData($row,"people_id",""));
		$x+=$colwidth["people_id"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["institution"],$rowheight,GetData($row,"institution",""));
		$x+=$colwidth["institution"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["prof_provider"],$rowheight,GetData($row,"prof_provider",""));
		$x+=$colwidth["prof_provider"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["firstname"],$rowheight,GetData($row,"firstname",""));
		$x+=$colwidth["firstname"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["lastname"],$rowheight,GetData($row,"lastname",""));
		$x+=$colwidth["lastname"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$height=0;
		$pdf->Image(AddLinkPrefix("image_path",$row["image_path"]),$pdf->GetX()+1,$pdf->GetY()+1,$colwidth["image_path"]-2,$height);
		$pdf->SetX($pdf->GetX()+$colwidth["image_path"]);
		$pdf->SetY($pdf->y0+$height+2);
		$x+=$colwidth["image_path"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["street"],$rowheight,GetData($row,"street",""));
		$x+=$colwidth["street"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["house_nr"],$rowheight,GetData($row,"house_nr",""));
		$x+=$colwidth["house_nr"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["zip"],$rowheight,GetData($row,"zip",""));
		$x+=$colwidth["zip"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["location"],$rowheight,GetData($row,"location",""));
		$x+=$colwidth["location"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["locationarea"],$rowheight,GetData($row,"locationarea",""));
		$x+=$colwidth["locationarea"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["tel_p"],$rowheight,GetData($row,"tel_p",""));
		$x+=$colwidth["tel_p"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["tel_m"],$rowheight,GetData($row,"tel_m",""));
		$x+=$colwidth["tel_m"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["email"],$rowheight,GetData($row,"email",""));
		$x+=$colwidth["email"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["username"],$rowheight,GetData($row,"username",""));
		$x+=$colwidth["username"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["password"],$rowheight,GetData($row,"password",""));
		$x+=$colwidth["password"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["picture"],$rowheight,GetData($row,"picture",""));
		$x+=$colwidth["picture"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$height=0;
		$pdf->Image_mem($row["picture_2"],$pdf->GetX()+1,$pdf->GetY()+1,$colwidth["picture_2"]-2,$height);
		$pdf->SetX($pdf->GetX()+$colwidth["picture_2"]);
		$pdf->SetY($pdf->y0+$height+2);
		$x+=$colwidth["picture_2"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["gender"],$rowheight,GetData($row,"gender",""));
		$x+=$colwidth["gender"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["adminstatus"],$rowheight,GetData($row,"adminstatus",""));
		$x+=$colwidth["adminstatus"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["birthdate"],$rowheight,GetData($row,"birthdate","Short Date"));
		$x+=$colwidth["birthdate"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["enabled"],$rowheight,GetData($row,"enabled",""));
		$x+=$colwidth["enabled"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["temp_sched_from"],$rowheight,GetData($row,"temp_sched_from",""));
		$x+=$colwidth["temp_sched_from"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["temp_sched_to"],$rowheight,GetData($row,"temp_sched_to",""));
		$x+=$colwidth["temp_sched_to"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["joiningdate"],$rowheight,GetData($row,"joiningdate","Short Date"));
		$x+=$colwidth["joiningdate"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["coord_accuracy"],$rowheight,GetData($row,"coord_accuracy",""));
		$x+=$colwidth["coord_accuracy"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["monday"],$rowheight,GetData($row,"monday",""));
		$x+=$colwidth["monday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["tuesday"],$rowheight,GetData($row,"tuesday",""));
		$x+=$colwidth["tuesday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["wednesday"],$rowheight,GetData($row,"wednesday",""));
		$x+=$colwidth["wednesday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["thursday"],$rowheight,GetData($row,"thursday",""));
		$x+=$colwidth["thursday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["friday"],$rowheight,GetData($row,"friday",""));
		$x+=$colwidth["friday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["saturday"],$rowheight,GetData($row,"saturday",""));
		$x+=$colwidth["saturday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["sunday"],$rowheight,GetData($row,"sunday",""));
		$x+=$colwidth["sunday"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["monday_t"],$rowheight,GetData($row,"monday_t",""));
		$x+=$colwidth["monday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["tuesday_t"],$rowheight,GetData($row,"tuesday_t",""));
		$x+=$colwidth["tuesday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["wednesday_t"],$rowheight,GetData($row,"wednesday_t",""));
		$x+=$colwidth["wednesday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["thursday_t"],$rowheight,GetData($row,"thursday_t",""));
		$x+=$colwidth["thursday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["friday_t"],$rowheight,GetData($row,"friday_t",""));
		$x+=$colwidth["friday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["saturday_t"],$rowheight,GetData($row,"saturday_t",""));
		$x+=$colwidth["saturday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["sunday_t"],$rowheight,GetData($row,"sunday_t",""));
		$x+=$colwidth["sunday_t"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["preferred_contact_by"],$rowheight,GetData($row,"preferred_contact_by",""));
		$x+=$colwidth["preferred_contact_by"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["date_last_adress_change"],$rowheight,GetData($row,"date_last_adress_change","Short Date"));
		$x+=$colwidth["date_last_adress_change"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["map_in"],$rowheight,GetData($row,"map_in",""));
		$x+=$colwidth["map_in"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["IconPath"],$rowheight,GetData($row,"IconPath",""));
		$x+=$colwidth["IconPath"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$height=0;
		$pdf->Image_mem($row["Icon"],$pdf->GetX()+1,$pdf->GetY()+1,$colwidth["Icon"]-2,$height);
		$pdf->SetX($pdf->GetX()+$colwidth["Icon"]);
		$pdf->SetY($pdf->y0+$height+2);
		$x+=$colwidth["Icon"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["note"],$rowheight,GetData($row,"note",""));
		$x+=$colwidth["note"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["price_per_hour"],$rowheight,GetData($row,"price_per_hour","Number"));
		$x+=$colwidth["price_per_hour"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["psych_time_loose_tight"],$rowheight,GetData($row,"psych_time_loose_tight",""));
		$x+=$colwidth["psych_time_loose_tight"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["psych_exact_creativ"],$rowheight,GetData($row,"psych_exact_creativ",""));
		$x+=$colwidth["psych_exact_creativ"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["psych_heart_thing"],$rowheight,GetData($row,"psych_heart_thing",""));
		$x+=$colwidth["psych_heart_thing"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["psych_easy_security"],$rowheight,GetData($row,"psych_easy_security",""));
		$x+=$colwidth["psych_easy_security"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["psych_conflict_take_leave"],$rowheight,GetData($row,"psych_conflict_take_leave",""));
		$x+=$colwidth["psych_conflict_take_leave"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["longitude"],$rowheight,GetData($row,"longitude","Number"));
		$x+=$colwidth["longitude"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["latitude"],$rowheight,GetData($row,"latitude","Number"));
		$x+=$colwidth["latitude"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["Agree"],$rowheight,GetData($row,"Agree",""));
		$x+=$colwidth["Agree"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["Sign_date"],$rowheight,GetData($row,"Sign_date",""));
		$x+=$colwidth["Sign_date"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["Active"],$rowheight,GetData($row,"Active",""));
		$x+=$colwidth["Active"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["Acode"],$rowheight,GetData($row,"Acode",""));
		$x+=$colwidth["Acode"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
//	draw fames
		$x=$leftmargin;
		$pdf->Rect($x,$pdf->y0,$colwidth["people_id"],$pdf->maxheight);
		$x+=$colwidth["people_id"];
		$pdf->Rect($x,$pdf->y0,$colwidth["institution"],$pdf->maxheight);
		$x+=$colwidth["institution"];
		$pdf->Rect($x,$pdf->y0,$colwidth["prof_provider"],$pdf->maxheight);
		$x+=$colwidth["prof_provider"];
		$pdf->Rect($x,$pdf->y0,$colwidth["firstname"],$pdf->maxheight);
		$x+=$colwidth["firstname"];
		$pdf->Rect($x,$pdf->y0,$colwidth["lastname"],$pdf->maxheight);
		$x+=$colwidth["lastname"];
		$pdf->Rect($x,$pdf->y0,$colwidth["image_path"],$pdf->maxheight);
		$x+=$colwidth["image_path"];
		$pdf->Rect($x,$pdf->y0,$colwidth["street"],$pdf->maxheight);
		$x+=$colwidth["street"];
		$pdf->Rect($x,$pdf->y0,$colwidth["house_nr"],$pdf->maxheight);
		$x+=$colwidth["house_nr"];
		$pdf->Rect($x,$pdf->y0,$colwidth["zip"],$pdf->maxheight);
		$x+=$colwidth["zip"];
		$pdf->Rect($x,$pdf->y0,$colwidth["location"],$pdf->maxheight);
		$x+=$colwidth["location"];
		$pdf->Rect($x,$pdf->y0,$colwidth["locationarea"],$pdf->maxheight);
		$x+=$colwidth["locationarea"];
		$pdf->Rect($x,$pdf->y0,$colwidth["tel_p"],$pdf->maxheight);
		$x+=$colwidth["tel_p"];
		$pdf->Rect($x,$pdf->y0,$colwidth["tel_m"],$pdf->maxheight);
		$x+=$colwidth["tel_m"];
		$pdf->Rect($x,$pdf->y0,$colwidth["email"],$pdf->maxheight);
		$x+=$colwidth["email"];
		$pdf->Rect($x,$pdf->y0,$colwidth["username"],$pdf->maxheight);
		$x+=$colwidth["username"];
		$pdf->Rect($x,$pdf->y0,$colwidth["password"],$pdf->maxheight);
		$x+=$colwidth["password"];
		$pdf->Rect($x,$pdf->y0,$colwidth["picture"],$pdf->maxheight);
		$x+=$colwidth["picture"];
		$pdf->Rect($x,$pdf->y0,$colwidth["picture_2"],$pdf->maxheight);
		$x+=$colwidth["picture_2"];
		$pdf->Rect($x,$pdf->y0,$colwidth["gender"],$pdf->maxheight);
		$x+=$colwidth["gender"];
		$pdf->Rect($x,$pdf->y0,$colwidth["adminstatus"],$pdf->maxheight);
		$x+=$colwidth["adminstatus"];
		$pdf->Rect($x,$pdf->y0,$colwidth["birthdate"],$pdf->maxheight);
		$x+=$colwidth["birthdate"];
		$pdf->Rect($x,$pdf->y0,$colwidth["enabled"],$pdf->maxheight);
		$x+=$colwidth["enabled"];
		$pdf->Rect($x,$pdf->y0,$colwidth["temp_sched_from"],$pdf->maxheight);
		$x+=$colwidth["temp_sched_from"];
		$pdf->Rect($x,$pdf->y0,$colwidth["temp_sched_to"],$pdf->maxheight);
		$x+=$colwidth["temp_sched_to"];
		$pdf->Rect($x,$pdf->y0,$colwidth["joiningdate"],$pdf->maxheight);
		$x+=$colwidth["joiningdate"];
		$pdf->Rect($x,$pdf->y0,$colwidth["coord_accuracy"],$pdf->maxheight);
		$x+=$colwidth["coord_accuracy"];
		$pdf->Rect($x,$pdf->y0,$colwidth["monday"],$pdf->maxheight);
		$x+=$colwidth["monday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["tuesday"],$pdf->maxheight);
		$x+=$colwidth["tuesday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["wednesday"],$pdf->maxheight);
		$x+=$colwidth["wednesday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["thursday"],$pdf->maxheight);
		$x+=$colwidth["thursday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["friday"],$pdf->maxheight);
		$x+=$colwidth["friday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["saturday"],$pdf->maxheight);
		$x+=$colwidth["saturday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["sunday"],$pdf->maxheight);
		$x+=$colwidth["sunday"];
		$pdf->Rect($x,$pdf->y0,$colwidth["monday_t"],$pdf->maxheight);
		$x+=$colwidth["monday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["tuesday_t"],$pdf->maxheight);
		$x+=$colwidth["tuesday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["wednesday_t"],$pdf->maxheight);
		$x+=$colwidth["wednesday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["thursday_t"],$pdf->maxheight);
		$x+=$colwidth["thursday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["friday_t"],$pdf->maxheight);
		$x+=$colwidth["friday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["saturday_t"],$pdf->maxheight);
		$x+=$colwidth["saturday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["sunday_t"],$pdf->maxheight);
		$x+=$colwidth["sunday_t"];
		$pdf->Rect($x,$pdf->y0,$colwidth["preferred_contact_by"],$pdf->maxheight);
		$x+=$colwidth["preferred_contact_by"];
		$pdf->Rect($x,$pdf->y0,$colwidth["date_last_adress_change"],$pdf->maxheight);
		$x+=$colwidth["date_last_adress_change"];
		$pdf->Rect($x,$pdf->y0,$colwidth["map_in"],$pdf->maxheight);
		$x+=$colwidth["map_in"];
		$pdf->Rect($x,$pdf->y0,$colwidth["IconPath"],$pdf->maxheight);
		$x+=$colwidth["IconPath"];
		$pdf->Rect($x,$pdf->y0,$colwidth["Icon"],$pdf->maxheight);
		$x+=$colwidth["Icon"];
		$pdf->Rect($x,$pdf->y0,$colwidth["note"],$pdf->maxheight);
		$x+=$colwidth["note"];
		$pdf->Rect($x,$pdf->y0,$colwidth["price_per_hour"],$pdf->maxheight);
		$x+=$colwidth["price_per_hour"];
		$pdf->Rect($x,$pdf->y0,$colwidth["psych_time_loose_tight"],$pdf->maxheight);
		$x+=$colwidth["psych_time_loose_tight"];
		$pdf->Rect($x,$pdf->y0,$colwidth["psych_exact_creativ"],$pdf->maxheight);
		$x+=$colwidth["psych_exact_creativ"];
		$pdf->Rect($x,$pdf->y0,$colwidth["psych_heart_thing"],$pdf->maxheight);
		$x+=$colwidth["psych_heart_thing"];
		$pdf->Rect($x,$pdf->y0,$colwidth["psych_easy_security"],$pdf->maxheight);
		$x+=$colwidth["psych_easy_security"];
		$pdf->Rect($x,$pdf->y0,$colwidth["psych_conflict_take_leave"],$pdf->maxheight);
		$x+=$colwidth["psych_conflict_take_leave"];
		$pdf->Rect($x,$pdf->y0,$colwidth["longitude"],$pdf->maxheight);
		$x+=$colwidth["longitude"];
		$pdf->Rect($x,$pdf->y0,$colwidth["latitude"],$pdf->maxheight);
		$x+=$colwidth["latitude"];
		$pdf->Rect($x,$pdf->y0,$colwidth["Agree"],$pdf->maxheight);
		$x+=$colwidth["Agree"];
		$pdf->Rect($x,$pdf->y0,$colwidth["Sign_date"],$pdf->maxheight);
		$x+=$colwidth["Sign_date"];
		$pdf->Rect($x,$pdf->y0,$colwidth["Active"],$pdf->maxheight);
		$x+=$colwidth["Active"];
		$pdf->Rect($x,$pdf->y0,$colwidth["Acode"],$pdf->maxheight);
		$x+=$colwidth["Acode"];
		$pdf->y0+=$pdf->maxheight;
		$i++;
		$row=db_fetch_array($rs);
	}
	$pdf->Output();
}

?>