<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_needs_variables.php");

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

$all=postvalue("all");

include('libs/Smarty.class.php');
$smarty = new Smarty();

$conn=db_connect();

//	Before Process event
if(function_exists("BeforeProcessPrint"))
	BeforeProcessPrint($conn);

$strWhereClause="";

if (@$_REQUEST["a"]!="") 
{
	
	$sWhere = "1=0";	
	
//	process selection
	$selected_recs=array();
	if (@$_REQUEST["mdelete"])
	{
		foreach(@$_REQUEST["mdelete"] as $ind)
		{
			$keys=array();
			$keys["need_id"]=refine($_REQUEST["mdelete1"][$ind-1]);
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
			$keys["need_id"]=urldecode($arr[0]);
			$selected_recs[]=$keys;
		}
	}

	foreach($selected_recs as $keys)
	{
		$sWhere = $sWhere . " or ";
		$sWhere.=KeyWhere($keys);
	}
//	$strSQL = AddWhere($gstrSQL,$sWhere);
	$strSQL = gSQLWhere($sWhere);
	$strWhereClause=$sWhere;
}
else
{
	$strWhereClause=@$_SESSION[$strTableName."_where"];
	$strSQL = gSQLWhere($strWhereClause);
}



$strOrderBy=$_SESSION[$strTableName."_order"];
if(!$strOrderBy)
	$strOrderBy=$gstrOrderBy;
$strSQL.=" ".trim($strOrderBy);

$strSQLbak = $strSQL;
if(function_exists("BeforeQueryPrint"))
	BeforeQueryPrint($strSQL,$strWhereClause,$strOrderBy);

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

$mypage=(integer)$_SESSION[$strTableName."_pagenumber"];
if(!$mypage)
	$mypage=1;

//	page size
$PageSize=(integer)$_SESSION[$strTableName."_pagesize"];
if(!$PageSize)
	$PageSize=$gPageSize;

$recno=1;
$records=0;	
$pageindex=1;

if(!$all)
{	
if($numrows)
{
	$maxRecords = $numrows;
	$maxpages=ceil($maxRecords/$PageSize);
	if($mypage > $maxpages)
		$mypage = $maxpages;
	if($mypage<1) 
		$mypage=1;
	$maxrecs=$PageSize;
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

}
else
{
	$rs=db_query($strSQL,$conn);
	$recordsonpage = $numrows;
	if($recordsonpage>=1)
		$smarty->assign("column1show",true);
	else
		$smarty->assign("column1show",false);
}



//	fill $rowinfo array
	$pages = array();
	$rowinfo = array();

	while($data=db_fetch_array($rs))
	{
		if(function_exists("BeforeProcessRowPrint"))
		{
			if(!BeforeProcessRowPrint($data))
				continue;
		}
		break;
	}

	while($data && ($all || $recno<=$PageSize))
	{
		$row=array();
		for($col=1;$data && ($all || $recno<=$PageSize) && $col<=1;$col++)
		{

			$recno++;
			$records++;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["need_id"]));


//	need_id - 
			$value="";
				$value = ProcessLargeText(GetData($data,"need_id", ""),"field=need%5Fid".$keylink,"",MODE_PRINT);
			$row[$col."need_id_value"]=$value;

//	people_id - 
			$value="";
				$value = ProcessLargeText(GetData($data,"people_id", ""),"field=people%5Fid".$keylink,"",MODE_PRINT);
			$row[$col."people_id_value"]=$value;

//	need_type_id - 
			$value="";
	/*	
			if(strlen($data["need_type_id"]))
			{
				$strdata = make_db_value("need_type_id",$data["need_type_id"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`skilltype`";
				$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["need_type_id"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
									$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"need_type_id", ""),"field=need%5Ftype%5Fid".$keylink,"",MODE_PRINT);

			}
			else
				$value="";
*/				
			$value=DisplayLookupWizard("need_type_id",$data["need_type_id"],$data,$keylink,MODE_PRINT);
			$row[$col."need_type_id_value"]=$value;

//	need_subtype_id - 
			$value="";
	/*	
			if(strlen($data["need_subtype_id"]))
			{
				$strdata = make_db_value("need_subtype_id",$data["need_subtype_id"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`skill_subtype`";
				$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["need_subtype_id"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
									$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"need_subtype_id", ""),"field=need%5Fsubtype%5Fid".$keylink,"",MODE_PRINT);

			}
			else
				$value="";
*/				
			$value=DisplayLookupWizard("need_subtype_id",$data["need_subtype_id"],$data,$keylink,MODE_PRINT);
			$row[$col."need_subtype_id_value"]=$value;

//	need_note - 
			$value="";
				$value = ProcessLargeText(GetData($data,"need_note", ""),"field=need%5Fnote".$keylink,"",MODE_PRINT);
			$row[$col."need_note_value"]=$value;

//	need_hourly - 
			$value="";
				$value = ProcessLargeText(GetData($data,"need_hourly", ""),"field=need%5Fhourly".$keylink,"",MODE_PRINT);
			$row[$col."need_hourly_value"]=$value;

//	prof_provider - 
			$value="";
				$value = ProcessLargeText(GetData($data,"prof_provider", ""),"field=prof%5Fprovider".$keylink,"",MODE_PRINT);
			$row[$col."prof_provider_value"]=$value;

//	firstname - 
			$value="";
				$value = ProcessLargeText(GetData($data,"firstname", ""),"field=firstname".$keylink,"",MODE_PRINT);
			$row[$col."firstname_value"]=$value;

//	lastname - 
			$value="";
				$value = ProcessLargeText(GetData($data,"lastname", ""),"field=lastname".$keylink,"",MODE_PRINT);
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
				$value = ProcessLargeText(GetData($data,"street", ""),"field=street".$keylink,"",MODE_PRINT);
			$row[$col."street_value"]=$value;

//	house_nr - 
			$value="";
				$value = ProcessLargeText(GetData($data,"house_nr", ""),"field=house%5Fnr".$keylink,"",MODE_PRINT);
			$row[$col."house_nr_value"]=$value;

//	zip - 
			$value="";
				$value = ProcessLargeText(GetData($data,"zip", ""),"field=zip".$keylink,"",MODE_PRINT);
			$row[$col."zip_value"]=$value;

//	location - 
			$value="";
				$value = ProcessLargeText(GetData($data,"location", ""),"field=location".$keylink,"",MODE_PRINT);
			$row[$col."location_value"]=$value;

//	locationarea - 
			$value="";
				$value = ProcessLargeText(GetData($data,"locationarea", ""),"field=locationarea".$keylink,"",MODE_PRINT);
			$row[$col."locationarea_value"]=$value;

//	tel_p - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tel_p", ""),"field=tel%5Fp".$keylink,"",MODE_PRINT);
			$row[$col."tel_p_value"]=$value;

//	tel_m - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tel_m", ""),"field=tel%5Fm".$keylink,"",MODE_PRINT);
			$row[$col."tel_m_value"]=$value;

//	email - 
			$value="";
				$value = ProcessLargeText(GetData($data,"email", ""),"field=email".$keylink,"",MODE_PRINT);
			$row[$col."email_value"]=$value;
			$row[$col."show"]=true;
			if(function_exists("BeforeMoveNextPrint"))
				BeforeMoveNextPrint($data,$row,$col);
			while($data=db_fetch_array($rs))
			{
				if(function_exists("BeforeProcessRowPrint"))
				{
					if(!BeforeProcessRowPrint($data))
						continue;
				}
				break;
			}
		}
		$rowinfo[]=$row;
		if($all && $records>=30)
		{
			$page=array("rowinfo" =>$rowinfo);
			$page["idx"]=$pageindex;
			$pageindex++;
			$pages[] = $page;
			$records=0;
			$rowinfo=array();
		}
	}
	if($all && count($rowinfo))
	{
		$page=array("rowinfo" =>$rowinfo);
		$page["idx"]=$pageindex;
		$pages[] = $page;
	}
	if(!$all)
		$smarty->assign_by_ref("rowinfo",$rowinfo);
	else
	{
		if(count($pages))
		{
			$pages[count($pages)-1]["showtotals"]=true;
			$pages[count($pages)-1]["last"]=true;
		}
		$smarty->assign_by_ref("pages",$pages);
	}


	

$strSQL=$_SESSION[$strTableName."_sql"];


$pagename = $_SERVER["REQUEST_URI"];
if(strpos($_SERVER["REQUEST_URI"],"?")===false)
	$pagename.="?pdf=1";
else
	$pagename.="&pdf=1";
$smarty->assign("pageurl",$pagename);
if(postvalue("pdf"))
	$smarty->assign("pdf",true);

if(!$all)
	$templatefile = "t_needs_print.htm";
else
	$templatefile = "t_needs_print_all.htm";
	
if(function_exists("BeforeShowPrint"))
	BeforeShowPrint($smarty,$templatefile);

if(!postvalue("pdf"))
	$smarty->display($templatefile);
else
{
	$page = $smarty->fetch($templatefile);
	$pagewidth=postvalue("width")*1.05;
	$pageheight=postvalue("height")*1.05;
	$landscape=false;
	if(postvalue("all"))
	{
		if($pagewidth>$pageheight)
		{
			$landscape=true;
			if($pagewidth/$pageheight<297/210)
				$pagewidth = 297/210*$pageheight;
		}
		else
		{
			if($pagewidth/$pageheight<210/297)
				$pagewidth = 210/297*$pageheight;
		}
	}
	include("plugins/page2pdf.php");
}

