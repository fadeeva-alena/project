<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_taccess_variables.php");

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
	echo "<td><strong>Country</strong></td>";
	echo "<td><strong>Zip</strong></td>";
	echo "<td><strong>Location</strong></td>";
	echo "<td><strong>Start</strong></td>";
	echo "<td><strong>End</strong></td>";
	echo "<td><strong>Note</strong></td>";
	echo "<td><strong>ID</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 10 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["ID"]));

	//	Country - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Country", ""),"field=Country".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Zip - 
		    $value="";
	/*	
			if(strlen($data["Zip"]))
			{
				$strdata = make_db_value("Zip",$data["Zip"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`ZIP`";
				$LookupSQL.=" FROM `t_zipch` WHERE `ZIP` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["Zip"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
				$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"Zip", ""),"field=Zip".$keylink,"",MODE_PRINT);
			}
			else
				$value="";
*/				
			$value=DisplayLookupWizard("Zip",$data["Zip"],$data,$keylink,MODE_PRINT);
			
			echo "<td>".$value."</td>";
	//	Location - 
		    $value="";
	/*	
			if(strlen($data["Location"]))
			{
				$strdata = make_db_value("Location",$data["Location"]);
				$LookupSQL="SELECT ";
							$LookupSQL.="`Location`";
				$LookupSQL.=" FROM `t_zipch` WHERE `Location` = " . $strdata;
							LogInfo($LookupSQL);
				$rsLookup = db_query($LookupSQL,$conn);
				$lookupvalue=$data["Location"];
				if($lookuprow=db_fetch_numarray($rsLookup))
					$lookupvalue=$lookuprow[0];
				$value=ProcessLargeText(GetDataInt($lookupvalue,$data,"Location", ""),"field=Location".$keylink,"",MODE_PRINT);
			}
			else
				$value="";
*/				
			$value=DisplayLookupWizard("Location",$data["Location"],$data,$keylink,MODE_PRINT);
			
			echo "<td>".$value."</td>";
	//	Start - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"Start", "Short Date"),"field=Start".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	End - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"End", "Short Date"),"field=End".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Note - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Note", ""),"field=Note".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	ID - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"ID", ""),"field=ID".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Details found".": <strong>".$rowcount."</strong>";
}

echo "counterSeparator".postvalue("counter");
?>