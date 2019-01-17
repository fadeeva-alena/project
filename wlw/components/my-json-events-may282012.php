<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events = array();

$startreservationdate = date('Y-m-d 00:00:00',$_REQUEST['start']+(86400));
$endreservationdate = date('Y-m-d 23:59:59',$_REQUEST['end']);

$sqlreservations = mysql_query("select * from t_provider_events pe left join t_provider_reservation pr on pe.provider_event_id=pr.provider_event_id inner join t_currency c on c.id=pe.provider_event_price_currency where  reservation_status=1 and pe.provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and reservation_start_date>='$startreservationdate' and reservation_end_date<='$endreservationdate'");


	while ($rowreservations = mysql_fetch_array($sqlreservations)){
		$sqlprovider = mysql_query("select * from t_provider where id='".$rowreservations['reservation_provider_id']."'");
		$rowprovider = mysql_fetch_array($sqlprovider);
			
			$weekstodisplay = "&start=".$_REQUEST['start']."&end=".$_REQUEST['end'];

			$eventArray['title'] = fixEncoding($rowreservations["provider_event_title"]) . " - ". fixEncoding($rowprovider["nick"]);
			$eventArray['start'] = $rowreservations["reservation_start_date"];
			$eventArray['end'] = $rowreservations["reservation_end_date"];
			$eventArray['description'] = fixEncoding($rowreservations["provider_event_description"]) . "<br/><b>" . translatefields(8) . "</b>: " . $rowreservations['provider_event_price'] . " " . $rowreservations['currency'];
			$eventArray['alldescriptions'] = '<b>'.$rowreservations["provider_event_title"].'</b><br/>'.date('d.M.Y',strtotime($rowreservations["reservation_start_date"])).' '.date('h:i',strtotime($rowreservations["reservation_start_date"])).' - ' . date('h:i',strtotime($rowreservations["reservation_end_date"])). '<br/>'.fixEncoding($rowreservations["provider_event_description"]).'<br/><b>'. translatefields(8).'</b>: '.$rowreservations['provider_event_price'] . ' ' . $rowreservations['currency'].'<br /><br /><form method=post action=index.php?option=my-calendar-reservation&reservation_id='.$rowreservations["reservation_id"].$weekstodisplay.'><table><tr><td colspan=2><hr style="border:1px solid dashed;"><b><span style=font-size:16px;size;16px;color:#00356E;font-color:#00356E;>Stornieren</span></b></td></tr><tr><td><b>'.translatefields(629).':</b></td><td><textarea name="reason" id="reason" style=width:150px></textarea></td></tr><tr><td colspan=2 align=right><input type=submit name=submit2 value="'.translatefields(410).'"></td></tr></table></form>';
			$eventArray['id'] = fixEncoding($rowreservations["reservation_id"]);
			$eventArray['reservation_status'] = fixEncoding($rowreservations["reservation_status"]);
			$eventArray['allDay'] = false;
			
			$eventArray['color'] = "#".fixEncoding($rowreservations["provider_event_color"]);
			//$textcolor = get_brightness("#".$rowproviderevents['provider_event_color']);
			$eventArray['textColor'] = get_brightness("#".$rowreservations['provider_event_color']);
			$eventArray['editable'] = "true";
			
			$eventArray['disableResizing'] = "false";
			
			$eventArray['backgroundColor'] = "";
			
			$events[] = $eventArray;
		}
		
	/*blocked reservation here*/
	if (isset($_SESSION['ownerproviderid'])){
		$owner_provider_id = $_SESSION['ownerproviderid'];
	}else{
		$owner_provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	}
	$sqlblocked = mysql_query("select * from t_provider_reservation where owner_provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and provider_event_id=0 and (reservation_status=3 or reservation_status=4) and reservation_start_date>='$startreservationdate' and reservation_end_date<='$endreservationdate'");
	while ($rowblocked = mysql_fetch_array($sqlblocked)){
		if ($rowblocked['reservation_status'] == 3){
			$number = "733";
		}else{
			$number = "732";
		}
		//$eventArray['title'] = fixEncoding(translatefields($number));
		$eventArray['title'] = $rowblocked['block_description'];
        $eventArray['start'] = $rowblocked["reservation_start_date"];
		$eventArray['end'] = $rowblocked["reservation_end_date"];
        $eventArray['description'] = $rowblocked['block_description'];
		$deletebutton = fixEncoding(translatefields(273));
		$deletebutton = str_replace('%date_from% - %date_to%','',$deletebutton);
		
		$weekstodisplay = "&start=".$_REQUEST['start']."&end=".$_REQUEST['end'];
		//onclick='deletesession(".$rowblocked["reservation_id"].")'
		//onclick='deleteallsessions(".$rowblocked["reservation_id"].")'
        /*$eventArray['alldescriptions'] = $rowblocked['block_description'] . " <br /><br /><div style=float:left;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id=".$rowblocked["reservation_id"].$weekstodisplay."><input type=button value='". fixEncoding(translatefields(747))."' onclick='deletesession".$rowblocked["reservation_id"]."(".$rowblocked["reservation_id"].")' /></form></div><div style=float:left;margin-left:5px;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id_plus_all=".$rowblocked["reservation_id"].$weekstodisplay."><input type=button value='". fixEncoding(translatefields(748))."' onclick='deleteallsessions".$rowblocked["reservation_id"]."(".$rowblocked["reservation_id"].")' /></form></div><script>$(document).ready(function(){function deletesession".$rowblocked['reservation_id']."(reservationid){Jquery.ajax({url: 'components/delete-provider-reservation.php?delete_reservation_id='+reservationid,cache: false,success: function(html){alert(html);}})}function deleteallsessions".$rowblocked['reservation_id']."(reservationid){Jquery.ajax({url: 'components/delete-provider-reservation.php?delete_reservation_id_plus_all='+reservationid,cache: false,success: function(html){alert(html);}})}})</script>";*/
		$eventArray['alldescriptions'] = $rowblocked['block_description'] . " <br /><br /><div style=float:left;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id=".$rowblocked["reservation_id"].$weekstodisplay."><input type=submit value='". fixEncoding(translatefields(747))."' id='deletesession".$rowblocked["reservation_id"]."' /></form></div><div style=float:left;margin-left:5px;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id_plus_all=".$rowblocked["reservation_id"].$weekstodisplay."><input type=submit value='". fixEncoding(translatefields(748))."' id='deleteallsessions".$rowblocked["reservation_id"]."' /></form></div>";
        $eventArray['id'] = fixEncoding($rowblocked["reservation_id"]);
		$eventArray['reservation_status'] = fixEncoding($rowblocked["reservation_status"]);
        $eventArray['allDay'] = false;
        $eventArray['color'] = "";
        $eventArray['textColor'] = get_brightness("#C2C2C2");
        $eventArray['borderColor'] = "#aaaaaa";
        $eventArray['editable'] = "false";
        $eventArray['disableResizing'] = "false";
        $eventArray['backgroundColor'] = "#C2C2C2";
        $eventArray['droppable'] = "false";
        $events[] = $eventArray;
	}
	
	$sqllunch = mysql_query("select * from t_provider_reservation where owner_provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and provider_event_id=0 and (reservation_status=5) and reservation_start_date>='$startreservationdate' and reservation_end_date<='$endreservationdate'");
	
	while ($rowblocked = mysql_fetch_array($sqllunch)){
		if ($rowblocked['reservation_status'] == 3){
			$number = "733";
		}else{
			$number = "732";
		}
		$weekstodisplay = "&start=".$_REQUEST['start']."&end=".$_REQUEST['end'];
		//$eventArray['title'] = fixEncoding(translatefields($number));
		$eventArray['title'] = fixEncoding(translatefields(731));
        $eventArray['start'] = $rowblocked["reservation_start_date"];
		$eventArray['end'] = $rowblocked["reservation_end_date"];
        $eventArray['description'] = fixEncoding(translatefields(731));
		$deletebutton = fixEncoding(translatefields(273));
		$deletebutton = str_replace('%date_from% - %date_to%','',$deletebutton);
        $eventArray['alldescriptions'] = fixEncoding(translatefields(731)) . " <br /><br /><div style=float:left;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id=".$rowblocked["reservation_id"].$weekstodisplay."><input type=submit value='". fixEncoding(translatefields(747))."'/></form></div><div style=float:left;margin-left:5px;></div>";
        $eventArray['id'] = fixEncoding($rowblocked["reservation_id"]);
		$eventArray['reservation_status'] = fixEncoding($rowblocked["reservation_status"]);
        $eventArray['allDay'] = false;
        $eventArray['color'] = "";
        $eventArray['textColor'] = get_brightness("#C2C2C2");
        $eventArray['borderColor'] = "#aaaaaa";
        $eventArray['editable'] = "false";
        $eventArray['disableResizing'] = "false";
        $eventArray['backgroundColor'] = "#C2C2C2";
        $eventArray['droppable'] = "false";
        $events[] = $eventArray;
	}
	
	$sqlcheckcalendar = mysql_query("select * from t_lunch_break_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$rowcheckcalendar = mysql_fetch_array($sqlcheckcalendar);
	$start_time = $rowcheckcalendar['lunch_start'];
	$end_time = $rowcheckcalendar['lunch_end'];
	$lunch_day_start = $rowcheckcalendar['lunch_day_start'];
	$lunch_day_end = $rowcheckcalendar['lunch_day_end'];
	//lunch_day_start 	lunch_day_end
	$start_date = date('Y-m-d '.substr($start_time,0,-2).':'.substr($start_time,-2).':00',$_REQUEST['start']+(86400));
	$end_date = date('Y-m-d '.substr($end_time,0,-2).':'.substr($end_time,-2).':00',$_REQUEST['end']);
	$startloopdate = $_REQUEST['start']+86400;
	$endloopdate = $_REQUEST['end'];
	$check_date = $startloopdate;
	
    while ($startloopdate <= $endloopdate) { 
		$weekrange = date('N',$startloopdate);
		if ($weekrange >= $lunch_day_start and $weekrange <= $lunch_day_end){
			$checkifnot = date('Y-m-d',$startloopdate);
			$checklunchreservation = mysql_query("select * from t_provider_reservation where reservation_start_date like '%$checkifnot%' and reservation_status=5 and owner_provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
			
			
			if (mysql_num_rows($checklunchreservation) ==0){
				$eventArray['title'] = fixEncoding(translatefields(731));
				$eventArray['start'] = date('Y-m-d ',$startloopdate) .substr($start_time,0,-2).':'.substr($start_time,-2).':00';
				$eventArray['end'] = date('Y-m-d ',$startloopdate) .substr($end_time,0,-2).':'.substr($end_time,-2).':00';
				$eventArray['description'] = fixEncoding(translatefields(731));
				$eventArray['alldescriptions'] = fixEncoding(translatefields(731));
				$eventArray['reservation_status'] = "5";
				$eventArray['id'] = date('Y-m-d',$startloopdate);
				$eventArray['allDay'] = false;
				$eventArray['color'] = "";
				$eventArray['textColor'] = get_brightness("#C2C2C2");
				$eventArray['borderColor'] = "#aaaaaa";
				$eventArray['editable'] = "false";
				$eventArray['disableResizing'] = "false";
				$eventArray['backgroundColor'] = "#C2C2C2";
				$eventArray['droppable'] = "false";
				$events[] = $eventArray;
			}
		}
		$startloopdate = strtotime("+1 day", $startloopdate);
    }
		
header('Content-type: application/json');
echo json_encode($events);
?>