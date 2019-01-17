<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events_id = trim($_REQUEST['eventsid']);
$sqlfield = mysql_query("select * from t_field_names where id=634");
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
//GETTING THE PROVIDER ID
$sqlprovider = mysql_query("select distinct(provider_id) from t_handover_events where id in ($events_id)");

while ($rowprovider = mysql_fetch_array($sqlprovider)){		
$provider_ids = $rowprovider['provider_id'];
$sql = mysql_query("select * from t_handover_events where id in ($events_id) and provider_id='".$rowprovider['provider_id']."'");
  $countxx = 0;
  while ($rowmore = mysql_fetch_array($sql)){
  $countxx++;
	$id = $rowmore['id'];
	$eventsid = $rowmore['events_id'];
	$provider_id = $rowmore['provider_id'];
	
		
	$sqlx = "SELECT *,c.currency as currencyal,loc.loc_name as locationval,e.id as eid,
		provider.company as pcompany,
		provider.firstname as pfirstname,
		provider.lastname as plastname,
		hevents.id as main_record_id,
		l.company as lcompany,
		l.firstname as lfirstname,
		l.lastname as llastname
		FROM t_event 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		inner join t_handover_events hevents on hevents.events_id=e.id
		inner join t_provider provider on provider.id=hevents.provider_id
		where hevents.id='$id'";
	$query = mysql_query($sqlx);
	$row = mysql_fetch_array($query);
	
	
	
	
	$sqlfield = mysql_query("select * from t_field_names where id=633");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$requestor =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$requestor =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$requestor =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$requestor =  $rowfield['fieldname_it'];}
	
	if ($countxx == 1){
		$requestbody .="";
		$requestbody .=$requestor . ": ";
		$requestorname = "";
		if ($row['pcompany'] != ""){
			$requestorname .= fixEncodingx($row['pcompany']) . "";
		}
		if ($row['pfirstname'] != ""){
			$requestorname .= ", " . fixEncodingx($row['pfirstname']) . " " . fixEncodingx($row['plastname']);
		}
		$requestbody .=" " . $requestorname . "<br/><br/>";
	}
	
	$row1 = "";
	$row1 .= fixEncodingx($row['title']) ."<br />";
	if ($row['company'] !=""){
		$row1 .= fixEncodingx($row['lcompany']) . "<br />";
	}
	$row1 .= fixEncodingx($row['lfirstname'] . " " .$row['llastname']) . "<br />";
	
	if ($row['leader2'] != 0){
		$sqlleaders2 = mysql_query("select * from t_leader where id='".$row['leader2']."'");
		$rowleaders = mysql_fetch_array($sqlleaders2);
		
		
		if ($rowleaders['company'] !=""){
			$row1 .= fixEncodingx($rowleaders['company']) . "<br />";
		}
		$row1 .= fixEncodingx($rowleaders['firstname'] . " " .$rowleaders['lastname']  . "<br />");
	}
	
	
	$row1 .= fixEncodingx($row['loc_adress1']) . "<br />";
		if ($row['loc_adress2'] != ""){
			$row1 .=  fixEncodingx($row['loc_adress2']) . "<br />";
		}
		$row1 .= fixEncodingx($row['short']) . " - " . fixEncodingx($row['loc_zip']) . " " . fixEncodingx($row['loc_loc']) . "";
	
	
	

	if ($countxx == mysql_num_rows($sql) or (mysql_num_rows($sql) == 1)){
		$requestbody .= $row1;
	}else{
		$requestbody .= $row1 . "<br />--------------------------------------------<br />";
	}
	
	mysql_query("update t_handover_events set request_status='approved' where id='$id'");
			mysql_query("update t_event set provider='$provider_ids' where id='$eventsid'");
		
		
  }
//sending an email here
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_ids'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$sqlfield = mysql_query("select * from t_field_names where id=637");
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
			
			$sqlfield = mysql_query("select * from t_field_names where id=647");
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
			$requestbody = "";
			$body .="<br /><br />";
			/*$sqlfield = mysql_query("select * from t_field_names where id=650");
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
			$body .="<br /><br />";*/
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

$result = fixEncodingx($successfull);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-type: text/x-json");
?>
{ affected_rows: '<?php echo $total_deleted?>', total_records : '<?php echo $total_ids?>' , result: '<?php echo $result?>' }
