<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$location_id = trim($_REQUEST['locationsid']);

$sql = mysql_query("select * from t_location where id in ($location_id)");



  $sqlfield = mysql_query("select * from t_field_names where id=632");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$successfull = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$successfull =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$successfull =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$successfull =$rowfield['fieldname_it'];
		}

  $result = fixEncodingx($successfull);
  $countx = 0;
	
  while ($rowmore = mysql_fetch_array($sql)){
  $countx++;
	$id = $rowmore['id'];
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	mysql_query("insert into t_handover_locations values ('0','$id','$provider_id','','for approval',NOW())");
	
	$lastid = mysql_insert_id();
	//get events info
	
	
	$sqlx = "SELECT l.*,c.*,
		provider.company as pcompany,
		provider.firstname as pfirstname,
		provider.lastname as plastname,
		hlocations.id as main_record_id FROM t_location l inner join t_country c
		on l.loc_country=c.id
		inner join t_handover_locations hlocations on hlocations.location_id=l.id
		inner join t_provider provider on provider.id=hlocations.provider_id
		where hlocations.id='$lastid'and request_status='for approval'";
	$query = mysql_query($sqlx);
	$row = mysql_fetch_array($query);
	
	
	$sqlfield = mysql_query("select * from t_field_names where id=633");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$requestor =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$requestor =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$requestor =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$requestor =  $rowfield['fieldname_it'];}
	
	if ($countx == 1){
		$requestbody .=$requestor . ": ";
		$requestorname = "";
		if ($row['pcompany'] != ""){
			$requestorname .= fixEncodingx($row['pcompany']) . "";
		}
		if ($row['pfirstname'] != ""){
			$requestorname .= ", " . fixEncodingx($row['pfirstname']) . " " . fixEncodingx($row['plastname']);
		}
		$requestbody .=" " . $requestorname . "<br /><br />";
	}
	
	$row1 = "";
		$row1 .= fixEncodingx($row['loc_name']);
		if ($row['loc_detail'] != ""){
			$row1 .= "<br />" . fixEncodingx($row['loc_detail']);
		}
	if ($countxx == mysql_num_rows($sql) or (mysql_num_rows($sql) == 1)){
		$requestbody .= $row1;
	}else{
		$requestbody .= $row1 . "<br />--------------------------------------------<br />";
	}

	//"-----------------------------------------------------"
}
//sending an email here
	//get admin details
	$sqladmin = mysql_query("select * from t_provider where user_level=1");
	while ($rowadmin = mysql_fetch_array($sqladmin)){
		$headers = "";
		$body = "";
		$providerid = $rowadmin['id'];
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$providerid'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$sqlfield = mysql_query("select * from t_field_names where id=644");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$emailsubject = $rowfield['fieldname_de'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$emailsubject =$rowfield['fieldname_eng'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$emailsubject =$rowfield['fieldname_fr'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$emailsubject =$rowfield['fieldname_it'];
			}
			
			$subject = fixEncodingx($emailsubject);
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
			".$username.",<br /><br />";
			
			$sqlfield = mysql_query("select * from t_field_names where id=646");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .="<br /><br />";
			$body .= $requestbody;
			//$requestbody = "";
$body .="<br /><br />";
			$sqlfield = mysql_query("select * from t_field_names where id=652");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .="<br /><br />";
			$sqlfield = mysql_query("select * from t_field_names where id=649");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .="
			</div>";
			//echo $body;
		
			$from = "info@spiritwings.ch";
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
	}

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-type: text/x-json");
?>
{ affected_rows: '<?php echo $total_deleted?>', total_records : '<?php echo $total_ids?>' , result: '<?php echo $result?>' }
