<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_skills_variables.php");

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
	$includes.="var INLINE_EDIT_TABLE='t_skills_edit.php';\r\n";
	$includes.="var INLINE_ADD_TABLE='t_skills_add.php';\r\n";
	$includes.="var INLINE_VIEW_TABLE='t_skills_view.php';\r\n";
	$includes.="var SUGGEST_TABLE='t_skills_searchsuggest.php';\r\n";
	$includes.="var MASTER_PREVIEW_TABLE='t_skills_masterpreview.php';\r\n";
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

$smarty->assign("order_dir_skill_id","a");
$smarty->assign("order_dir_people_id","a");
$smarty->assign("order_dir_skill_type_id","a");
$smarty->assign("order_dir_skill_subtype_id","a");
$smarty->assign("order_dir_skill_note","a");
$smarty->assign("order_dir_skill_hourly","a");
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

$recno=1;
$numrows=0;


if(@$_SESSION[$strTableName."_orderby"])
{
	$order_field=substr($_SESSION[$strTableName."_orderby"],1);
	$order_dir=substr($_SESSION[$strTableName."_orderby"],0,1);
	$order_ind=GetFieldIndex($order_field);

	$smarty->assign("order_dir_skill_id","a");
	if($order_field=="skill_id")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_skill_id","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_skill_id","<img src=\"images/".$img.".gif\" border=0>");
	}
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
	$smarty->assign("order_dir_skill_type_id","a");
	if($order_field=="skill_type_id")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_skill_type_id","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_skill_type_id","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_skill_subtype_id","a");
	if($order_field=="skill_subtype_id")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_skill_subtype_id","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_skill_subtype_id","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_skill_note","a");
	if($order_field=="skill_note")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_skill_note","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_skill_note","<img src=\"images/".$img.".gif\" border=0>");
	}
	$smarty->assign("order_dir_skill_hourly","a");
	if($order_field=="skill_hourly")
	{
		if($order_dir=="a")
		{
			$smarty->assign("order_dir_skill_hourly","d");
			$img="up";
		}
		else
			$img="down";
		$smarty->assign("order_image_skill_hourly","<img src=\"images/".$img.".gif\" border=0>");
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
		$keys["skill_id"]=urldecode(@$arr[0]);
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
		if($where=StrWhere("skill_id", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("people_id", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("skill_type_id", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("skill_subtype_id", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("skill_note", $strSearchFor, $strSearchOption, ""))
			$strWhere .= " or ".$where;
		if($where=StrWhere("skill_hourly", $strSearchFor, $strSearchOption, ""))
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
			window.location='t_skills_list.php?goto='+nPageNumber;
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
			$row[$col."id1"]=htmlspecialchars($data["skill_id"]);
			$keyblock.= rawurlencode($data["skill_id"]);
			$row[$col."keyblock"]=htmlspecialchars($keyblock);
			$row[$col."recno"] = $recno;
//	detail tables
//	edit page link
			$editlink="";
			$editlink.="editid1=".htmlspecialchars(rawurlencode($data["skill_id"]));
			$row[$col."editlink"]=$editlink;

			$copylink="";
			$copylink.="copyid1=".htmlspecialchars(rawurlencode($data["skill_id"]));
			$row[$col."copylink"]=$copylink;
			$keylink="";
			$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["skill_id"]));


//	skill_id - 
			$value="";
				$value = ProcessLargeText(GetData($data,"skill_id", ""),"field=skill%5Fid".$keylink,"",MODE_LIST);
			$row[$col."skill_id_value"]=$value;

//	people_id - 
			$value="";
				$value = ProcessLargeText(GetData($data,"people_id", ""),"field=people%5Fid".$keylink,"",MODE_LIST);
			$row[$col."people_id_value"]=$value;

//	skill_type_id - 
			$value="";
	/*	
			if(strlen($data["skill_type_id"]))
			{
				$strdata = make_db_value("skill_type_id",$data["skill_type_id"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`skilltype`";
				$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["skill_type_id"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
								$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"skill_type_id", ""),"field=skill%5Ftype%5Fid".$keylink,"",MODE_LIST);
			}
			else
				$value="";
*/			
			$value=DisplayLookupWizard("skill_type_id",$data["skill_type_id"],$data,$keylink,MODE_LIST);
			$row[$col."skill_type_id_value"]=$value;

//	skill_subtype_id - 
			$value="";
	/*	
			if(strlen($data["skill_subtype_id"]))
			{
				$strdata = make_db_value("skill_subtype_id",$data["skill_subtype_id"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`skill_subtype`";
				$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["skill_subtype_id"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
								$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"skill_subtype_id", ""),"field=skill%5Fsubtype%5Fid".$keylink,"",MODE_LIST);
			}
			else
				$value="";
*/			
			$value=DisplayLookupWizard("skill_subtype_id",$data["skill_subtype_id"],$data,$keylink,MODE_LIST);
			$row[$col."skill_subtype_id_value"]=$value;

//	skill_note - 
			$value="";
				$value = ProcessLargeText(GetData($data,"skill_note", ""),"field=skill%5Fnote".$keylink,"",MODE_LIST);
			$row[$col."skill_note_value"]=$value;

//	skill_hourly - 
			$value="";
				$value = ProcessLargeText(GetData($data,"skill_hourly", ""),"field=skill%5Fhourly".$keylink,"",MODE_LIST);
			$row[$col."skill_hourly_value"]=$value;

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
		if(@$_SESSION[$strTableName."_searchfield"]=="skill_id")
			$smarty->assign("search_skill_id","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="people_id")
			$smarty->assign("search_people_id","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="skill_type_id")
			$smarty->assign("search_skill_type_id","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="skill_subtype_id")
			$smarty->assign("search_skill_subtype_id","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="skill_note")
			$smarty->assign("search_skill_note","selected");
		if(@$_SESSION[$strTableName."_searchfield"]=="skill_hourly")
			$smarty->assign("search_skill_hourly","selected");
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




$templatefile = "t_skills_list.htm";
if(function_exists("BeforeShowList"))
	BeforeShowList($smarty,$templatefile);

$smarty->display($templatefile);

