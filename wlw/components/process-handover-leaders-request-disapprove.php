<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$leader_id = trim($_REQUEST['leadersid']);
$sqlfield = mysql_query("select * from t_field_names where id=635");
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
		$sqlfield = mysql_query("select * from t_field_names where id=629");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$reasonlabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$reasonlabel =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$reasonlabel =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$reasonlabel =$rowfield['fieldname_it'];
		}
//GETTING THE PROVIDER ID
$sqlprovider = mysql_query("select distinct(provider_id) from t_handover_leaders where id in ($leader_id)");

while ($rowprovider = mysql_fetch_array($sqlprovider)){		
$provider_ids = $rowprovider['provider_id'];
$sql = mysql_query("select * from t_handover_leaders where id in ($leader_id) and provider_id='".$rowprovider['provider_id']."'");
  $countxx = 0;

//$sql = mysql_query("select * from t_handover_locations where id in ($location_id)");
  
  while ($rowmore = mysql_fetch_array($sql)){
$countxx++;
  $id = $rowmore['id'];
	$leadersid = $rowmore['leader_id'];
	$provider_id = $rowmore['provider_id'];
	$reason = $_REQUEST['reason'];
		
		
		mysql_query("update t_handover_leaders set request_status='disapproved',reason='$reason' where id='$id'");
		
		$sqlx = "SELECT l.*,
		provider.company as pcompany,
		provider.firstname as pfirstname,
		provider.lastname as plastname,
		hleaders.id as main_record_id,
		l.company as lcompany,
		l.firstname as lfirstname,
		l.lastname as llastname
		from t_leader l
		inner join t_handover_leaders hleaders on hleaders.leader_id=l.id
		inner join t_provider provider on provider.id=hleaders.provider_id
		where hleaders.id='$id'";
	$query = mysql_query($sqlx);
	$row = mysql_fetch_array($query);
	
	
	$sqlfield = mysql_query("select * from t_field_names where id=633");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){$requestor =  $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){$requestor =  $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){$requestor =  $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){$requestor =  $rowfield['fieldname_it'];}
	
	if ($countxx == 1){
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
		
		if ($row['lcompany'] != ""){
			$row1 .= "<br />" . fixEncodingx($row['lcompany']) . "<br />";
		}
		$row1 .= fixEncodingx($row['lfirstname']) . " " . fixEncodingx($row['llastname']);
		

	if ($countxx == mysql_num_rows($sql) or (mysql_num_rows($sql) == 1)){
	//$row1 .= "<br><br>".fixEncodingx($reasonlabel) . ": " . fixEncodingx($reason);
		$requestbody .= $row1;
	}else{
		$requestbody .= $row1 . "<br>--------------------------------------------<br/>";
	}


	
	
  }
//sending an email here
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_ids'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$sqlfield = mysql_query("select * from t_field_names where id=642");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$emailsubject = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$emailsubject =fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$emailsubject =fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$emailsubject =fixEncodingx($rowfield['fieldname_it']);
			}
			
			$subject = fixEncodingx($emailsubject);
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
			".$username.",<br /><br />";
			
			$sqlfield = mysql_query("select * from t_field_names where id=648");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$bodycon = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$bodycon = fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$bodycon = fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$bodycon = fixEncodingx($rowfield['fieldname_it']);
			}
			$newbodycon = str_replace('%reason%',$reason,$bodycon);
			$body .= $newbodycon . "<br /><br />";
			$body .= $requestbody;
			$requestbody = "";
			/*$body .="<br /><br />";
			$sqlfield = mysql_query("select * from t_field_names where id=650");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}*/
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

$result = fixEncodingx($successfull);
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-type: text/x-json");
?>
{ affected_rows: '<?php echo $total_deleted?>', total_records : '<?php echo $total_ids?>' , result: '<?php echo $result?>' }
