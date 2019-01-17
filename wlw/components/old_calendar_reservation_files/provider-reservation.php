<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
// reservation_id reservation_provider_id provider_event_id reservation_start_date reservation_end_date reservation_datetime

$provider_id = $_REQUEST['provider_id'];
$provider_event_title = $_REQUEST['provider_event_title'];
$sqlevent = mysql_query("select * from t_provider_events e inner join t_currency c on c.id=e.provider_event_price_currency where 	provider_event_title='$provider_event_title'");
$rowevent = mysql_fetch_array($sqlevent);

$provider_event_id = $rowevent['provider_event_id'];
$start_date = trim($_REQUEST['start_date']);
$start_date = date('Y-m-d h:i:s',strtotime($start_date));

$timestamp = strtotime($start_date . " + ".$rowevent['provider_event_duration']." minute");
$end_date = date('Y-m-d h:i:s', $timestamp);
/*$xdate = date_create($start_date);
date_add($xdate, date_interval_create_from_date_string('10 minutes'));
$end_date = date_format($xdate, 'Y-m-d h:i:s');*/

$datea = strtotime(trim($_REQUEST['start_date']));
$end_date = date('Y-m-d H:i:s', strtotime('+'.$rowevent['provider_event_duration'].' minutes', $datea));

if ($_REQUEST['block_type'] == 0 or $_REQUEST['block_type'] == ""){
	$block_type = "";
}else{
	$block_type = $_REQUEST['block_type'];
}

$sqladd = "insert into t_provider_reservation values ('0','$provider_id','$provider_event_id','$start_date','$end_date',NOW(),'1','','$block_type','')";
mysql_query($sqladd);

//sending an email here
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$row1 = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '".$rowevent['provider_id']."'") ;	
			echo $to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			
			
			$subject = fixEncodingx(translatefields(723));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			

			$bodyemail = fixEncodingx(translatefields1(722));
			
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
			
			if ($row->company != ""){
				$bodyemail = str_replace("<providercompany>",$row->company,$bodyemail);
			}
			if ($row->firstname != ""){
				$bodyemail = str_replace("<providerfname>",$row->firstname,$bodyemail);
			}
			if ($row->lastname != ""){
				$bodyemail = str_replace("<providerlname>",$row->lastname,$bodyemail);
			}
			$bodyemail = str_replace("<eventtitle>","<b>".$provider_event_title."</b>",$bodyemail);
			
			$bodyemail = str_replace("<date>",date('d.M.Y',strtotime($start_date)),$bodyemail);
			
			$bodyemail = str_replace("gebucht","<b>gebucht</b>",$bodyemail);
			$bodyemail = str_replace("die Buchung","<b>die Buchung</b>",$bodyemail);
			$bodyemail = str_replace("Ihr Spiritwings-Team","<b>Ihr Spiritwings-Team</b>",$bodyemail);
			//gebucht
			//die Buchung
			
			$bodyemail = str_replace("<starttime>",date('h:i',strtotime($start_date)),$bodyemail);
			$bodyemail = str_replace("<endtime>",date('h:i',strtotime($end_date)),$bodyemail);
			
			if ($row1->company != ""){
				$bodyemail = str_replace("<provider_company>",$row1->company,$bodyemail);
			}
			if ($row1->firstname != ""){
				$bodyemail = str_replace("<provider_firstname>",$row1->firstname,$bodyemail);
			}
			if ($row1->lastname != ""){
				$bodyemail = str_replace("<provider_lastname>",$row1->lastname,$bodyemail);
			}
			if ($row1->fon != ""){
				$bodyemail = str_replace("<provider tel>",$fon,$bodyemail);
			}else{
				$bodyemail = str_replace("<provider tel>","",$bodyemail);
			}
			$bodyemailaddress = "";
			if ($row1->adress1 !=""){
				$bodyemailaddress .= $row1->adress1 . " ";
			}if ($row1->adress2 !=""){
				$bodyemailaddress .= $row1->adress2 . " ";
			}if ($row1->location !=""){
				$bodyemailaddress .= $row1->location . " ";
			}if ($row1->zip !=""){
				$bodyemailaddress .= $row1->zip . " ";
			}
			$bodyemail = str_replace('<provider_adressblock>',$bodyemailaddress,$bodyemail);
			//$bodyemail = $bodyemail . "". $bodyemailaddress;
			$bodyemail = str_replace("<amount>",$rowevent['provider_event_price'],$bodyemail);
			$bodyemail = str_replace("<currency>",$rowevent['currency'],$bodyemail);
			$bodyemail = str_replace("<our_footer>","",$bodyemail);
			
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";
			//echo $body;
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
		
?>

     
	