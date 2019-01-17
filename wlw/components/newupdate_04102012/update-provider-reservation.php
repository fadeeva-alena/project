<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
// reservation_id reservation_provider_id provider_event_id reservation_start_date reservation_end_date reservation_datetime

$reservation_id = $_REQUEST['reservation_id'];
$provider_event_titlex = explode(" - ",$_REQUEST['provider_event_title']);
$provider_event_title = $provider_event_titlex[0];
$sqleventx = mysql_query("select * from t_provider_events where provider_event_title='$provider_event_title'");
$roweventx = mysql_fetch_array($sqleventx);

$provider_event_id = $rowevent['provider_event_id'];
$start_date = trim($_REQUEST['start_date']);
$start_date = date('Y-m-d h:i:s',strtotime($start_date));

$timestamp = strtotime($start_date . " + ".$roweventx['provider_event_duration']." minute");
//$end_date = date('Y-m-d h:i:s', $timestamp);

$datea = strtotime(trim($_REQUEST['start_date']));
$end_date = date('Y-m-d H:i:s', strtotime('+'.$roweventx['provider_event_duration'].' minutes', $datea));


$sqlevent = mysql_query("select * from t_provider_reservation pr inner join t_provider_events e on e.provider_event_id=pr.provider_event_id inner join t_currency c on c.id=e.provider_event_price_currency where reservation_id='".$_GET['reservation_id']."'");
$rowevent = mysql_fetch_array($sqlevent);

$provider_id = $rowevent['reservation_provider_id'];

$provider_event_id = $rowevent['provider_event_id'];

$bstart_date = date('Y-m-d h:i:s', strtotime($rowevent['reservation_start_date']));
$bend_date = date('Y-m-d h:i:s', strtotime($rowevent['reservation_end_date']));

$sqlupdate = "update t_provider_reservation set reservation_start_date='$start_date',reservation_end_date='$end_date' where reservation_id='$reservation_id'";
mysql_query($sqlupdate);

/*
<firstname> <lastname><p>
<providerfname> <providerlname> hat folgende Buchung verschoben:<br>
<eventtitle><br>
von (bisher) <bdate> von <bstarttime> bis <bendtime>.<br>
nach (neu) <adate> von <astarttime> bis <aendtime>.</p>

bei <provider_company> <provider_firstname> <provider_lastname><br>
<provider adressblock><br><br>

Es enstehen für Sie keine Kosten.<br><br>

Wir wünschen viel Spass und eine gelungene Session.<br>
Ihr Spiritwings-Team<br>

<our_footer><br>
P.S. Bitte beachten Sie, dass Spiritwings.ch die Verwaltung des Terminkalenders im Auftrag des Anbieters anbietet; Ihr Vertragspartner ist der Anbieter.
*/
//sending an email here
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$row1 = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '".$rowevent['provider_id']."'") ;	
			echo $to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$subject = fixEncodingx(translatefields(727));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			

			$bodyemail = fixEncodingx(translatefields1(726));
			echo genderfields($gender);
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
			$bodyemail = str_replace("<eventtitle>","<b>".$rowevent['provider_event_title']."</b>",$bodyemail);
			$bodyemail = str_replace("Ihr Spiritwings-Team<br>","<b>Ihr Spiritwings-Team<br></b>",$bodyemail);
			//verschoben
			
			$bodyemail = str_replace("<adate>",date('d.M.Y',strtotime($start_date)),$bodyemail);
			
			$bodyemail = str_replace("<astarttime>",date('h:i',strtotime($start_date)),$bodyemail);
			$bodyemail = str_replace("<aendtime>",date('h:i',strtotime($end_date)),$bodyemail);
			
			$bodyemail = str_replace("<bdate>",date('d.M.Y',strtotime($bstart_date)),$bodyemail);
			
			$bodyemail = str_replace("<bstarttime>",date('h:i',strtotime($bstart_date)),$bodyemail);
			$bodyemail = str_replace("<bendtime>",date('h:i',strtotime($bend_date)),$bodyemail);
			
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
			$bodyemail = str_replace('<provider adressblock>',$bodyemailaddress,$bodyemail);
			//$bodyemail = $bodyemail . "". $bodyemailaddress;
			
			$bodyemail = str_replace("<currency>",$rowevent['currency'],$bodyemail);
			
			$bodyemail = str_replace("<our_footer>","",$bodyemail);
			
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";
			echo $body;
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
?>