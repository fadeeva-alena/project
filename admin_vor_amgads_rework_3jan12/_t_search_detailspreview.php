<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_t_search_variables.php");

if(!@$_SESSION["UserID"])
{ 
	return;
}
if(!CheckSecurity(@$_SESSION["_".$strTableName."_OwnerID"],"Search"))
{
	return;
}

$conn=db_connect(); 
$recordsCounter = 0;


//$strSQL = $gstrSQL;



$str = SecuritySQL("Search");
if(strlen($str))
	$where.=" and ".$str;
$strSQL = gSQLWhere($where);

$strSQL.=" ".$gstrOrderBy;

$rowcount=gSQLRowCount($where,0);


if ( $rowcount ) {
	$rs=db_query($strSQL,$conn);
	echo "Details found".": <strong>".$rowcount."</strong>";
			echo ( $rowcount > 10 ) ? ". Displaying first: <strong>10</strong>.<br /><br />" : "<br /><br />";
	echo "<table cellpadding=1 cellspacing=1 border=0 align=left class=\"detailtable\"><tr>";
	echo "<td><strong>searchid</strong></td>";
	echo "<td><strong>Username</strong></td>";
	echo "<td><strong>date</strong></td>";
	echo "<td><strong>Search_type</strong></td>";
	echo "<td><strong>Skill_type</strong></td>";
	echo "<td><strong>Skill_Subtype</strong></td>";
	echo "<td><strong>Gender</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 10 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["searchid"]));

	//	searchid - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"searchid", ""),"field=searchid".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Username - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Username", ""),"field=Username".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	date - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"date", ""),"field=date".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Search_type - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Search_type", ""),"field=Search%5Ftype".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Skill_type - 
		    $value="";
	/*	
			if(strlen($data["Skill_type"]))
			{
				$strdata = make_db_value("Skill_type",$data["Skill_type"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`skilltype`";
				$LookupSQL.=" FROM `t_skill_types` WHERE `skilltype_id` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["Skill_type"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
				$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"Skill_type", ""),"field=Skill%5Ftype".$keylink,"",MODE_PRINT);
			}
			else
				$value="";
*/				
			$value=DisplayLookupWizard("Skill_type",$data["Skill_type"],$data,$keylink,MODE_PRINT);
			
			echo "<td>".$value."</td>";
	//	Skill_Subtype - 
		    $value="";
	/*	
			if(strlen($data["Skill_Subtype"]))
			{
				$strdata = make_db_value("Skill_Subtype",$data["Skill_Subtype"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`skill_subtype`";
				$LookupSQL.=" FROM `t_skill_subtype` WHERE `skill_subtype_id` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["Skill_Subtype"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
				$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"Skill_Subtype", ""),"field=Skill%5FSubtype".$keylink,"",MODE_PRINT);
			}
			else
				$value="";
*/				
			$value=DisplayLookupWizard("Skill_Subtype",$data["Skill_Subtype"],$data,$keylink,MODE_PRINT);
			
			echo "<td>".$value."</td>";
	//	Gender - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Gender", ""),"field=Gender".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Details found".": <strong>".$rowcount."</strong>";
}

echo "counterSeparator".postvalue("counter");
?>