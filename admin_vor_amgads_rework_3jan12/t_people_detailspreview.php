<?php
ini_set("display_errors","1");
ini_set("display_startup_errors","1");
header("Expires: Thu, 01 Jan 1970 00:00:01 GMT"); 
set_magic_quotes_runtime(0);

include("include/dbcommon.php");
include("include/t_people_variables.php");

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
	echo "<td><strong>people_id</strong></td>";
	echo "<td><strong>institution</strong></td>";
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
	echo "<td><strong>username</strong></td>";
	echo "<td><strong>password</strong></td>";
	echo "<td><strong>picture</strong></td>";
	echo "<td><strong>picture_2</strong></td>";
	echo "<td><strong>gender</strong></td>";
	echo "<td><strong>adminstatus</strong></td>";
	echo "<td><strong>birthdate</strong></td>";
	echo "<td><strong>enabled</strong></td>";
	echo "<td><strong>temp_sched_from</strong></td>";
	echo "<td><strong>temp_sched_to</strong></td>";
	echo "<td><strong>joiningdate</strong></td>";
	echo "<td><strong>coord_accuracy</strong></td>";
	echo "<td><strong>monday</strong></td>";
	echo "<td><strong>tuesday</strong></td>";
	echo "<td><strong>wednesday</strong></td>";
	echo "<td><strong>thursday</strong></td>";
	echo "<td><strong>friday</strong></td>";
	echo "<td><strong>saturday</strong></td>";
	echo "<td><strong>sunday</strong></td>";
	echo "<td><strong>monday_t</strong></td>";
	echo "<td><strong>tuesday_t</strong></td>";
	echo "<td><strong>wednesday_t</strong></td>";
	echo "<td><strong>thursday_t</strong></td>";
	echo "<td><strong>friday_t</strong></td>";
	echo "<td><strong>saturday_t</strong></td>";
	echo "<td><strong>sunday_t</strong></td>";
	echo "<td><strong>preferred_contact_by</strong></td>";
	echo "<td><strong>date_last_adress_change</strong></td>";
	echo "<td><strong>map_in</strong></td>";
	echo "<td><strong>IconPath</strong></td>";
	echo "<td><strong>Icon</strong></td>";
	echo "<td><strong>note</strong></td>";
	echo "<td><strong>price_per_hour</strong></td>";
	echo "<td><strong>psych_time_loose_tight</strong></td>";
	echo "<td><strong>psych_exact_creativ</strong></td>";
	echo "<td><strong>psych_heart_thing</strong></td>";
	echo "<td><strong>psych_easy_security</strong></td>";
	echo "<td><strong>psych_conflict_take_leave</strong></td>";
	echo "<td><strong>longitude</strong></td>";
	echo "<td><strong>latitude</strong></td>";
	echo "<td><strong>Agree</strong></td>";
	echo "<td><strong>Sign_date</strong></td>";
	echo "<td><strong>Active</strong></td>";
	echo "<td><strong>Acode</strong></td>";
	echo "</tr>";
	while ($data = db_fetch_array($rs)) {
		$recordsCounter++;
					if ( $recordsCounter > 5 ) { break; }
		echo "<tr>";
		$keylink="";
		$keylink.="&key1=".htmlspecialchars(rawurlencode(@$data["people_id"]));

	//	people_id - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"people_id", ""),"field=people%5Fid".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	institution - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"institution", ""),"field=institution".$keylink,"",MODE_PRINT);
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
	//	username - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"username", ""),"field=username".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	password - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"password", ""),"field=password".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	picture - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"picture", ""),"field=picture".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	picture_2 - Database Image
		    $value="";
						$value = "<img";
							$value.=" border=0";
			$value.=" src=\"t_people_imager.php?field=picture%5F2".$keylink."\">";
			echo "<td>".$value."</td>";
	//	gender - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"gender", ""),"field=gender".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	adminstatus - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"adminstatus", ""),"field=adminstatus".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	birthdate - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"birthdate", "Short Date"),"field=birthdate".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	enabled - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"enabled", ""),"field=enabled".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	temp_sched_from - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"temp_sched_from", ""),"field=temp%5Fsched%5Ffrom".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	temp_sched_to - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"temp_sched_to", ""),"field=temp%5Fsched%5Fto".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	joiningdate - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"joiningdate", "Short Date"),"field=joiningdate".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	coord_accuracy - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"coord_accuracy", ""),"field=coord%5Faccuracy".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	monday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"monday", ""),"field=monday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	tuesday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"tuesday", ""),"field=tuesday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	wednesday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"wednesday", ""),"field=wednesday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	thursday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"thursday", ""),"field=thursday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	friday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"friday", ""),"field=friday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	saturday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"saturday", ""),"field=saturday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	sunday - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"sunday", ""),"field=sunday".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	monday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"monday_t", ""),"field=monday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	tuesday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"tuesday_t", ""),"field=tuesday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	wednesday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"wednesday_t", ""),"field=wednesday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	thursday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"thursday_t", ""),"field=thursday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	friday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"friday_t", ""),"field=friday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	saturday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"saturday_t", ""),"field=saturday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	sunday_t - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"sunday_t", ""),"field=sunday%5Ft".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	preferred_contact_by - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"preferred_contact_by", ""),"field=preferred%5Fcontact%5Fby".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	date_last_adress_change - Short Date
		    $value="";
				$value = ProcessLargeText(GetData($data,"date_last_adress_change", "Short Date"),"field=date%5Flast%5Fadress%5Fchange".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	map_in - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"map_in", ""),"field=map%5Fin".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	IconPath - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"IconPath", ""),"field=IconPath".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Icon - Database Image
		    $value="";
						$value = "<img";
							$value.=" border=0";
			$value.=" src=\"t_people_imager.php?field=Icon".$keylink."\">";
			echo "<td>".$value."</td>";
	//	note - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"note", ""),"field=note".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	price_per_hour - Number
		    $value="";
				$value = ProcessLargeText(GetData($data,"price_per_hour", "Number"),"field=price%5Fper%5Fhour".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	psych_time_loose_tight - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"psych_time_loose_tight", ""),"field=psych%5Ftime%5Floose%5Ftight".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	psych_exact_creativ - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"psych_exact_creativ", ""),"field=psych%5Fexact%5Fcreativ".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	psych_heart_thing - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"psych_heart_thing", ""),"field=psych%5Fheart%5Fthing".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	psych_easy_security - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"psych_easy_security", ""),"field=psych%5Feasy%5Fsecurity".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	psych_conflict_take_leave - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"psych_conflict_take_leave", ""),"field=psych%5Fconflict%5Ftake%5Fleave".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	longitude - Number
		    $value="";
				$value = ProcessLargeText(GetData($data,"longitude", "Number"),"field=longitude".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	latitude - Number
		    $value="";
				$value = ProcessLargeText(GetData($data,"latitude", "Number"),"field=latitude".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Agree - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Agree", ""),"field=Agree".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Sign_date - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Sign_date", ""),"field=Sign%5Fdate".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Active - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Active", ""),"field=Active".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
	//	Acode - 
		    $value="";
				$value = ProcessLargeText(GetData($data,"Acode", ""),"field=Acode".$keylink,"",MODE_PRINT);
			echo "<td>".$value."</td>";
		echo "</tr>";
	}
	echo "</table>";
} else {
	echo "Details found".": <strong>".$rowcount."</strong>";
}

echo "counterSeparator".postvalue("counter");
?>