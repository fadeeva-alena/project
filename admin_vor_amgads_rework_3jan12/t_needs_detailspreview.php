<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_needs_variables.php");

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
			echo ( $rowcount > 5 ) ? ". Displaying first: <strong>5</strong>.<br /><br />" : "<br /><br />";
	echo "<table cellpadding=1 cellspacing=1 border=0 align=left class=\"detailtable\"><tr>";
	echo "<td><strong>need_id</strong></td>";
	echo "<td><strong>people_id</strong></td>";
	echo "<td><strong>need_type_id</strong></td>";
	echo "<td><strong>need_subtype_id</strong></td>";
	echo "<td><strong>need_note</strong></td>";
	echo "<td><strong>need_hourly</strong></td>";
	echo "<td><strong>prof_provider</strong></td>";
	echo "<td><strong>firstname</strong></td>";
	echo "<td><strong>lastname</strong></td>";
	echo "<td><strong>image_path</strong></td>";
	echo "<td><strong>street</strong></td>";
	echo "<td><strong>house_nr</strong></td>";
	echo "<td><strong>zip</strong></td>";
	echo "<td><strong>location</strong></td>";
	echo "<td><strong>locationarea</strong></td>";
	echo "<td><strong>tel_p</strong></td>";
	echo "<td><strong>tel_m</strong></td>";
	echo "<td><strong>email</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 5 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["need_id"]));

	//	need_id - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"need_id", ""),"field=need%5Fid".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	people_id - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"people_id", ""),"field=people%5Fid".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
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
			
			echo "<td>".$value."</td>";
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
			
			echo "<td>".$value."</td>";
	//	need_note - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"need_note", ""),"field=need%5Fnote".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	need_hourly - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"need_hourly", ""),"field=need%5Fhourly".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	prof_provider - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"prof_provider", ""),"field=prof%5Fprovider".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	firstname - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"firstname", ""),"field=firstname".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	lastname - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"lastname", ""),"field=lastname".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	image_path - File-based Image
		    $value="";
			if(CheckImageExtension($data["image_path"])) 
		{
					$value="<img";
									$value.=" border=0";
			$value.=" src=\"".htmlspecialchars(AddLinkPrefix("image_path",$data["image_path"]))."\">";
		}
			echo "<td>".$value."</td>";
	//	street - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"street", ""),"field=street".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	house_nr - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"house_nr", ""),"field=house%5Fnr".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	zip - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"zip", ""),"field=zip".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	location - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"location", ""),"field=location".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	locationarea - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"locationarea", ""),"field=locationarea".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	tel_p - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"tel_p", ""),"field=tel%5Fp".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	tel_m - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"tel_m", ""),"field=tel%5Fm".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	email - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"email", ""),"field=email".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Details found".": <strong>".$rowcount."</strong>";
}

echo "counterSeparator".postvalue("counter");
?>