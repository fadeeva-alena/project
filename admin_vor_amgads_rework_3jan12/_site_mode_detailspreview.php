<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/_site_mode_variables.php");

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
	echo "<td><strong>Status</strong></td>";
	echo "<td><strong>Message</strong></td>";
	echo "<td><strong>Mode</strong></td>";
	echo "<td><strong>ID</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 10 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["ID"]));

	//	Status - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Status", ""),"field=Status".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Message - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Message", ""),"field=Message".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Mode - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Mode", ""),"field=Mode".$keylink,"",MODE_PRINT);
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