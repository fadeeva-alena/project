<?php 
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
session_cache_limiter("none");
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_skills_variables.php");

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
			$keys["skill_id"]=refine($_REQUEST["mdelete1"][$ind-1]);
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
			$keys["skill_id"]=urldecode($arr[0]);
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
$smarty->display("t_skills_export.htm");


function ExportToExcel()
{
	global $cCharset;
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment;Filename=t_skills.xls");

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
	header("Content-Disposition: attachment;Filename=t_skills.doc");

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
	header("Content-Disposition: attachment;Filename=t_skills.xml");
	if(!($row=db_fetch_array($rs)))
		return;
	global $cCharset;
	echo "<?xml version=\"1.0\" encoding=\"".$cCharset."\" standalone=\"yes\"?>\r\n";
	echo "<table>\r\n";
	$i=0;
	while((!$nPageSize || $i<$nPageSize) && $row)
	{
		echo "<row>\r\n";
		$field=htmlspecialchars(XMLNameEncode("skill_id"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"skill_id",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("people_id"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"people_id",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("skill_type_id"));
		echo "<".$field.">";
/*		
		if(strlen($row["skill_type_id"]))
		{
			$strdata = make_db_value("skill_type_id",$row["skill_type_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skilltype`";
			$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$row["skill_type_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
			echo htmlspecialchars(GetDataInt($lookupvalue,$row,"skill_type_id", ""));
		}
*/		
		echo htmlspecialchars(DisplayLookupWizard("skill_type_id",$row["skill_type_id"],$row,"",MODE_EXPORT));
		
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("skill_subtype_id"));
		echo "<".$field.">";
/*		
		if(strlen($row["skill_subtype_id"]))
		{
			$strdata = make_db_value("skill_subtype_id",$row["skill_subtype_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skill_subtype`";
			$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$row["skill_subtype_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
			echo htmlspecialchars(GetDataInt($lookupvalue,$row,"skill_subtype_id", ""));
		}
*/		
		echo htmlspecialchars(DisplayLookupWizard("skill_subtype_id",$row["skill_subtype_id"],$row,"",MODE_EXPORT));
		
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("skill_note"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"skill_note",""));
		echo "</".$field.">\r\n";
		$field=htmlspecialchars(XMLNameEncode("skill_hourly"));
		echo "<".$field.">";
		echo htmlspecialchars(GetData($row,"skill_hourly",""));
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
	header("Content-Disposition: attachment;Filename=t_skills.csv");

	if(!($row=db_fetch_array($rs)))
		return;

	$totals=array();

	
// write header
	$outstr="";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"skill_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"people_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"skill_type_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"skill_subtype_id\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"skill_note\"";
	if($outstr!="")
		$outstr.=",";
	$outstr.= "\"skill_hourly\"";
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
		$outstr.='"'.htmlspecialchars(GetData($row,"skill_id",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"people_id",$format)).'"';
		if($outstr!="")
			$outstr.=",";
/*
		if(strlen($row["skill_type_id"]))
		{
			$strdata = make_db_value("skill_type_id",$row["skill_type_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skilltype`";
			$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);

			$lookupvalue=$row["skill_type_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
			$outstr.='"'.htmlspecialchars(GetDataInt($lookupvalue,$row,"skill_type_id", "")).'"';
		}
*/		
		$value = DisplayLookupWizard("skill_type_id",$row["skill_type_id"],$row,"",MODE_EXPORT);
		if(strlen($value))
			$outstr.='"'.htmlspecialchars($value).'"';

		if($outstr!="")
			$outstr.=",";
/*
		if(strlen($row["skill_subtype_id"]))
		{
			$strdata = make_db_value("skill_subtype_id",$row["skill_subtype_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skill_subtype`";
			$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);

			$lookupvalue=$row["skill_subtype_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
			$outstr.='"'.htmlspecialchars(GetDataInt($lookupvalue,$row,"skill_subtype_id", "")).'"';
		}
*/		
		$value = DisplayLookupWizard("skill_subtype_id",$row["skill_subtype_id"],$row,"",MODE_EXPORT);
		if(strlen($value))
			$outstr.='"'.htmlspecialchars($value).'"';

		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"skill_note",$format)).'"';
		if($outstr!="")
			$outstr.=",";
			$format="";
		$outstr.='"'.htmlspecialchars(GetData($row,"skill_hourly",$format)).'"';
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
		echo '<td style="width: 100" x:str>'.PrepareForExcel("skill_id").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("people_id").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("skill_type_id").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("skill_subtype_id").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("skill_note").'</td>';
		echo '<td style="width: 100" x:str>'.PrepareForExcel("skill_hourly").'</td>';
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
	}
	else
	{
		echo "<td>skill_id</td>";
		echo "<td>people_id</td>";
		echo "<td>skill_type_id</td>";
		echo "<td>skill_subtype_id</td>";
		echo "<td>skill_note</td>";
		echo "<td>skill_hourly</td>";
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
			echo htmlspecialchars(GetData($row,"skill_id",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"people_id",$format));
	echo '</td>';
	echo '<td>';
		if(strlen($row["skill_type_id"]))
		{
/*
			$strdata = make_db_value("skill_type_id",$row["skill_type_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skilltype`";
			$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$row["skill_type_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
				
			$strValue=GetDataInt($lookupvalue,$row,"skill_type_id", "");
*/			
			$strValue = DisplayLookupWizard("skill_type_id",$row["skill_type_id"],$row,"",MODE_EXPORT);
						if($_REQUEST["type"]=="excel")
				echo PrepareForExcel($strValue);
			else
				echo htmlspecialchars($strValue);

		}
	echo '</td>';
	echo '<td>';
		if(strlen($row["skill_subtype_id"]))
		{
/*
			$strdata = make_db_value("skill_subtype_id",$row["skill_subtype_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skill_subtype`";
			$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$row["skill_subtype_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
				
			$strValue=GetDataInt($lookupvalue,$row,"skill_subtype_id", "");
*/			
			$strValue = DisplayLookupWizard("skill_subtype_id",$row["skill_subtype_id"],$row,"",MODE_EXPORT);
						if($_REQUEST["type"]=="excel")
				echo PrepareForExcel($strValue);
			else
				echo htmlspecialchars($strValue);

		}
	echo '</td>';
	if($_REQUEST["type"]=="excel")
		echo '<td x:str>';
	else
		echo '<td>';

		$format="";
			if($_REQUEST["type"]=="excel")
			echo PrepareForExcel(GetData($row,"skill_note",$format));
		else
			echo htmlspecialchars(GetData($row,"skill_note",$format));
	echo '</td>';
	echo '<td>';

		$format="";
			echo htmlspecialchars(GetData($row,"skill_hourly",$format));
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
		$this->Rect($x,$this->y0,$colwidth["skill_id"],$this->maxheight);
		$x+=$colwidth["skill_id"];
		$this->Rect($x,$this->y0,$colwidth["people_id"],$this->maxheight);
		$x+=$colwidth["people_id"];
		$this->Rect($x,$this->y0,$colwidth["skill_type_id"],$this->maxheight);
		$x+=$colwidth["skill_type_id"];
		$this->Rect($x,$this->y0,$colwidth["skill_subtype_id"],$this->maxheight);
		$x+=$colwidth["skill_subtype_id"];
		$this->Rect($x,$this->y0,$colwidth["skill_note"],$this->maxheight);
		$x+=$colwidth["skill_note"];
		$this->Rect($x,$this->y0,$colwidth["skill_hourly"],$this->maxheight);
		$x+=$colwidth["skill_hourly"];
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
		$this->Cell($colwidth["skill_id"],$this->rowheight,"skill_id",1,0,'C',1);
		$this->Cell($colwidth["people_id"],$this->rowheight,"people_id",1,0,'C',1);
		$this->Cell($colwidth["skill_type_id"],$this->rowheight,"skill_type_id",1,0,'C',1);
		$this->Cell($colwidth["skill_subtype_id"],$this->rowheight,"skill_subtype_id",1,0,'C',1);
		$this->Cell($colwidth["skill_note"],$this->rowheight,"skill_note",1,0,'C',1);
		$this->Cell($colwidth["skill_hourly"],$this->rowheight,"skill_hourly",1,0,'C',1);
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
		$this->Ln($this->rowheight);
		$this->y0=$this->GetY();
	}

	}

	$pdf=new PDF();

	$leftmargin=5;
	$pagewidth=200;
	$pageheight=290;
	$rowheight=5;


	$defwidth=$pagewidth/18;
	$colwidth=array();
    $colwidth["skill_id"]=$defwidth;
    $colwidth["people_id"]=$defwidth;
    $colwidth["skill_type_id"]=$defwidth;
    $colwidth["skill_subtype_id"]=$defwidth;
    $colwidth["skill_note"]=$defwidth;
    $colwidth["skill_hourly"]=$defwidth;
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
		$pdf->MultiCell($colwidth["skill_id"],$rowheight,GetData($row,"skill_id",""));
		$x+=$colwidth["skill_id"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["people_id"],$rowheight,GetData($row,"people_id",""));
		$x+=$colwidth["people_id"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		if(strlen($row["skill_type_id"]))
		{
/*			$strdata = make_db_value("skill_type_id",$row["skill_type_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skilltype`";
			$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$row["skill_type_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
			$pdf->Cell($colwidth["skill_type_id"],$rowheight,GetDataInt($lookupvalue,$row,"skill_type_id", ""));
*/				
				
			$value = DisplayLookupWizard("skill_type_id",$row["skill_type_id"],$row,"",MODE_EXPORT);
			$pdf->Cell($colwidth["skill_type_id"],$rowheight,$value);
		}
		$x+=$colwidth["skill_type_id"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		if(strlen($row["skill_subtype_id"]))
		{
/*			$strdata = make_db_value("skill_subtype_id",$row["skill_subtype_id"]);
			$LookupSQL="SELECT ";
					$LookupSQL.="`skill_subtype`";
			$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
					LogInfo($LookupSQL);
			$rsLookup = db_query($LookupSQL,$conn);
			$lookupvalue=$row["skill_subtype_id"];
			if($lookuprow=db_fetch_numarray($rsLookup))
				$lookupvalue=$lookuprow[0];
			$pdf->Cell($colwidth["skill_subtype_id"],$rowheight,GetDataInt($lookupvalue,$row,"skill_subtype_id", ""));
*/				
				
			$value = DisplayLookupWizard("skill_subtype_id",$row["skill_subtype_id"],$row,"",MODE_EXPORT);
			$pdf->Cell($colwidth["skill_subtype_id"],$rowheight,$value);
		}
		$x+=$colwidth["skill_subtype_id"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["skill_note"],$rowheight,GetData($row,"skill_note",""));
		$x+=$colwidth["skill_note"];
		if($pdf->GetY()-$pdf->y0>$pdf->maxheight)
			$pdf->maxheight=$pdf->GetY()-$pdf->y0;
		$pdf->SetY($pdf->y0);
		$pdf->SetX($x);
		$pdf->MultiCell($colwidth["skill_hourly"],$rowheight,GetData($row,"skill_hourly",""));
		$x+=$colwidth["skill_hourly"];
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
//	draw fames
		$x=$leftmargin;
		$pdf->Rect($x,$pdf->y0,$colwidth["skill_id"],$pdf->maxheight);
		$x+=$colwidth["skill_id"];
		$pdf->Rect($x,$pdf->y0,$colwidth["people_id"],$pdf->maxheight);
		$x+=$colwidth["people_id"];
		$pdf->Rect($x,$pdf->y0,$colwidth["skill_type_id"],$pdf->maxheight);
		$x+=$colwidth["skill_type_id"];
		$pdf->Rect($x,$pdf->y0,$colwidth["skill_subtype_id"],$pdf->maxheight);
		$x+=$colwidth["skill_subtype_id"];
		$pdf->Rect($x,$pdf->y0,$colwidth["skill_note"],$pdf->maxheight);
		$x+=$colwidth["skill_note"];
		$pdf->Rect($x,$pdf->y0,$colwidth["skill_hourly"],$pdf->maxheight);
		$x+=$colwidth["skill_hourly"];
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
		$pdf->y0+=$pdf->maxheight;
		$i++;
		$row=db_fetch_array($rs);
	}
	$pdf->Output();
}

?>