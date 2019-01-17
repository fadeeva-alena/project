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
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["people_id"]));


//	people_id - 
			$value="";
				$value = ProcessLargeText(GetData($data,"people_id", ""),"field=people%5Fid".$keylink,"",MODE_PRINT);
			$row[$col."people_id_value"]=$value;

//	institution - 
			$value="";
				$value = ProcessLargeText(GetData($data,"institution", ""),"field=institution".$keylink,"",MODE_PRINT);
			$row[$col."institution_value"]=$value;

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

//	username - 
			$value="";
				$value = ProcessLargeText(GetData($data,"username", ""),"field=username".$keylink,"",MODE_PRINT);
			$row[$col."username_value"]=$value;

//	password - 
			$value="";
				$value = ProcessLargeText(GetData($data,"password", ""),"field=password".$keylink,"",MODE_PRINT);
			$row[$col."password_value"]=$value;

//	picture - 
			$value="";
				$value = ProcessLargeText(GetData($data,"picture", ""),"field=picture".$keylink,"",MODE_PRINT);
			$row[$col."picture_value"]=$value;

//	picture_2 - Database Image
			$value="";
							$value = "<img";
										$value.=" border=0";
				$value.=" src=\"t_people_imager.php?field=picture%5F2".$keylink."\">";
			$row[$col."picture_2_value"]=$value;

//	gender - 
			$value="";
				$value = ProcessLargeText(GetData($data,"gender", ""),"field=gender".$keylink,"",MODE_PRINT);
			$row[$col."gender_value"]=$value;

//	adminstatus - 
			$value="";
				$value = ProcessLargeText(GetData($data,"adminstatus", ""),"field=adminstatus".$keylink,"",MODE_PRINT);
			$row[$col."adminstatus_value"]=$value;

//	birthdate - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"birthdate", "Short Date"),"field=birthdate".$keylink,"",MODE_PRINT);
			$row[$col."birthdate_value"]=$value;

//	enabled - 
			$value="";
				$value = ProcessLargeText(GetData($data,"enabled", ""),"field=enabled".$keylink,"",MODE_PRINT);
			$row[$col."enabled_value"]=$value;

//	temp_sched_from - 
			$value="";
				$value = ProcessLargeText(GetData($data,"temp_sched_from", ""),"field=temp%5Fsched%5Ffrom".$keylink,"",MODE_PRINT);
			$row[$col."temp_sched_from_value"]=$value;

//	temp_sched_to - 
			$value="";
				$value = ProcessLargeText(GetData($data,"temp_sched_to", ""),"field=temp%5Fsched%5Fto".$keylink,"",MODE_PRINT);
			$row[$col."temp_sched_to_value"]=$value;

//	joiningdate - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"joiningdate", "Short Date"),"field=joiningdate".$keylink,"",MODE_PRINT);
			$row[$col."joiningdate_value"]=$value;

//	coord_accuracy - 
			$value="";
				$value = ProcessLargeText(GetData($data,"coord_accuracy", ""),"field=coord%5Faccuracy".$keylink,"",MODE_PRINT);
			$row[$col."coord_accuracy_value"]=$value;

//	monday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"monday", ""),"field=monday".$keylink,"",MODE_PRINT);
			$row[$col."monday_value"]=$value;

//	tuesday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tuesday", ""),"field=tuesday".$keylink,"",MODE_PRINT);
			$row[$col."tuesday_value"]=$value;

//	wednesday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"wednesday", ""),"field=wednesday".$keylink,"",MODE_PRINT);
			$row[$col."wednesday_value"]=$value;

//	thursday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"thursday", ""),"field=thursday".$keylink,"",MODE_PRINT);
			$row[$col."thursday_value"]=$value;

//	friday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"friday", ""),"field=friday".$keylink,"",MODE_PRINT);
			$row[$col."friday_value"]=$value;

//	saturday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"saturday", ""),"field=saturday".$keylink,"",MODE_PRINT);
			$row[$col."saturday_value"]=$value;

//	sunday - 
			$value="";
				$value = ProcessLargeText(GetData($data,"sunday", ""),"field=sunday".$keylink,"",MODE_PRINT);
			$row[$col."sunday_value"]=$value;

//	monday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"monday_t", ""),"field=monday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."monday_t_value"]=$value;

//	tuesday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"tuesday_t", ""),"field=tuesday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."tuesday_t_value"]=$value;

//	wednesday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"wednesday_t", ""),"field=wednesday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."wednesday_t_value"]=$value;

//	thursday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"thursday_t", ""),"field=thursday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."thursday_t_value"]=$value;

//	friday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"friday_t", ""),"field=friday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."friday_t_value"]=$value;

//	saturday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"saturday_t", ""),"field=saturday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."saturday_t_value"]=$value;

//	sunday_t - 
			$value="";
				$value = ProcessLargeText(GetData($data,"sunday_t", ""),"field=sunday%5Ft".$keylink,"",MODE_PRINT);
			$row[$col."sunday_t_value"]=$value;

//	preferred_contact_by - 
			$value="";
				$value = ProcessLargeText(GetData($data,"preferred_contact_by", ""),"field=preferred%5Fcontact%5Fby".$keylink,"",MODE_PRINT);
			$row[$col."preferred_contact_by_value"]=$value;

//	date_last_adress_change - Short Date
			$value="";
				$value = ProcessLargeText(GetData($data,"date_last_adress_change", "Short Date"),"field=date%5Flast%5Fadress%5Fchange".$keylink,"",MODE_PRINT);
			$row[$col."date_last_adress_change_value"]=$value;

//	map_in - 
			$value="";
				$value = ProcessLargeText(GetData($data,"map_in", ""),"field=map%5Fin".$keylink,"",MODE_PRINT);
			$row[$col."map_in_value"]=$value;

//	IconPath - 
			$value="";
				$value = ProcessLargeText(GetData($data,"IconPath", ""),"field=IconPath".$keylink,"",MODE_PRINT);
			$row[$col."IconPath_value"]=$value;

//	Icon - Database Image
			$value="";
							$value = "<img";
										$value.=" border=0";
				$value.=" src=\"t_people_imager.php?field=Icon".$keylink."\">";
			$row[$col."Icon_value"]=$value;

//	note - 
			$value="";
				$value = ProcessLargeText(GetData($data,"note", ""),"field=note".$keylink,"",MODE_PRINT);
			$row[$col."note_value"]=$value;

//	price_per_hour - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"price_per_hour", "Number"),"field=price%5Fper%5Fhour".$keylink,"",MODE_PRINT);
			$row[$col."price_per_hour_value"]=$value;

//	psych_time_loose_tight - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_time_loose_tight", ""),"field=psych%5Ftime%5Floose%5Ftight".$keylink,"",MODE_PRINT);
			$row[$col."psych_time_loose_tight_value"]=$value;

//	psych_exact_creativ - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_exact_creativ", ""),"field=psych%5Fexact%5Fcreativ".$keylink,"",MODE_PRINT);
			$row[$col."psych_exact_creativ_value"]=$value;

//	psych_heart_thing - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_heart_thing", ""),"field=psych%5Fheart%5Fthing".$keylink,"",MODE_PRINT);
			$row[$col."psych_heart_thing_value"]=$value;

//	psych_easy_security - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_easy_security", ""),"field=psych%5Feasy%5Fsecurity".$keylink,"",MODE_PRINT);
			$row[$col."psych_easy_security_value"]=$value;

//	psych_conflict_take_leave - 
			$value="";
				$value = ProcessLargeText(GetData($data,"psych_conflict_take_leave", ""),"field=psych%5Fconflict%5Ftake%5Fleave".$keylink,"",MODE_PRINT);
			$row[$col."psych_conflict_take_leave_value"]=$value;

//	longitude - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"longitude", "Number"),"field=longitude".$keylink,"",MODE_PRINT);
			$row[$col."longitude_value"]=$value;

//	latitude - Number
			$value="";
				$value = ProcessLargeText(GetData($data,"latitude", "Number"),"field=latitude".$keylink,"",MODE_PRINT);
			$row[$col."latitude_value"]=$value;

//	Agree - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Agree", ""),"field=Agree".$keylink,"",MODE_PRINT);
			$row[$col."Agree_value"]=$value;

//	Sign_date - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Sign_date", ""),"field=Sign%5Fdate".$keylink,"",MODE_PRINT);
			$row[$col."Sign_date_value"]=$value;

//	Active - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Active", ""),"field=Active".$keylink,"",MODE_PRINT);
			$row[$col."Active_value"]=$value;

//	Acode - 
			$value="";
				$value = ProcessLargeText(GetData($data,"Acode", ""),"field=Acode".$keylink,"",MODE_PRINT);
			$row[$col."Acode_value"]=$value;
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
	$templatefile = "t_people_print.htm";
else
	$templatefile = "t_people_print_all.htm";
	
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

