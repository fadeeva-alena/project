<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_log_variables.php");

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
	echo "<td><strong>log_id</strong></td>";
	echo "<td><strong>person_id</strong></td>";
	echo "<td><strong>User_Name</strong></td>";
	echo "<td><strong>login_date</strong></td>";
	echo "<td><strong>logout_date</strong></td>";
	echo "<td><strong>login_from</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 10 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["log_id"]));

	//	log_id - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"log_id", ""),"field=log%5Fid".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	person_id - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"person_id", ""),"field=person%5Fid".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	User_Name - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"User_Name", ""),"field=User%5FName".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	login_date - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"login_date", ""),"field=login%5Fdate".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	logout_date - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"logout_date", ""),"field=logout%5Fdate".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	login_from - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"login_from", ""),"field=login%5Ffrom".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Details found".": <strong>".$rowcount."</strong>";
}

echo "counterSeparator".postvalue("counter");
?>