<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events = array();

$sqlreservations = mysql_query("select * from t_provider_events pe left join t_provider_reservation pr on pe.provider_event_id=pr.provider_event_id inner join t_currency c on c.id=pe.provider_event_price_currency where  reservation_status=1 and pe.provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");

	while ($rowreservations = mysql_fetch_array($sqlreservations)){
		$sqlprovider = mysql_query("select * from t_provider where id='".$rowreservations['reservation_provider_id']."'");
		$rowprovider = mysql_fetch_array($sqlprovider);
		

			$eventArray['title'] = fixEncoding($rowreservations["provider_event_title"]) . " - ". fixEncoding($rowprovider["nick"]);
			$eventArray['start'] = $rowreservations["reservation_start_date"];
			$eventArray['end'] = $rowreservations["reservation_end_date"];
			$eventArray['description'] = fixEncoding($rowreservations["provider_event_description"]) . "<br/><b>" . translatefields(8) . "</b>: " . $rowreservations['provider_event_price'] . " " . $rowreservations['currency'];
			$eventArray['alldescriptions'] = '<b>'.$rowreservations["provider_event_title"].'</b><br/>'.date('d.M.Y',strtotime($rowreservations["reservation_start_date"])).' '.date('h:i',strtotime($rowreservations["reservation_start_date"])).' - ' . date('h:i',strtotime($rowreservations["reservation_end_date"])). '<br/>'.fixEncoding($rowreservations["provider_event_description"]).'<br/><b>'. translatefields(8).'</b>: '.$rowreservations['provider_event_price'] . ' ' . $rowreservations['currency'].'<br /><br /><form method=post action=index.php?option=my-calendar-reservation&reservation_id='.$rowreservations["reservation_id"].'><table><tr><td colspan=2><hr style="border:1px solid dashed;"><b><span style=font-size:16px;size;16px;color:#00356E;font-color:#00356E;>Stornieren</span></b></td></tr><tr><td><b>'.translatefields(629).':</b></td><td><textarea name="reason" id="reason" style=width:250px></textarea></td></tr><tr><td colspan=2 align=right><input type=submit name=submit2 value="'.translatefields(410).'"></td></tr></table></form>';
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
	$sqlblocked = mysql_query("select * from t_provider_reservation where owner_provider_id='".$owner_provider_id."' and provider_event_id=0 and (reservation_status=3 or reservation_status=4)");
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
        $eventArray['alldescriptions'] = $rowblocked['block_description'] . " <br /><br /><div style=float:left;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id=".$rowblocked["reservation_id"]."><input type=submit value='". fixEncoding(translatefields(747))."'/></form></div><div style=float:left;margin-left:5px;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id_plus_all=".$rowblocked["reservation_id"]."><input type=submit value='". fixEncoding(translatefields(748))."'/></form></div>";
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
	
	$sqllunch = mysql_query("select * from t_provider_reservation where owner_provider_id='".$owner_provider_id."' and provider_event_id=0 and (reservation_status=5)");
	while ($rowblocked = mysql_fetch_array($sqllunch)){
		if ($rowblocked['reservation_status'] == 3){
			$number = "733";
		}else{
			$number = "732";
		}
		//$eventArray['title'] = fixEncoding(translatefields($number));
		$eventArray['title'] = fixEncoding(translatefields(731));
        $eventArray['start'] = $rowblocked["reservation_start_date"];
		$eventArray['end'] = $rowblocked["reservation_end_date"];
        $eventArray['description'] = fixEncoding(translatefields(731));
		$deletebutton = fixEncoding(translatefields(273));
		$deletebutton = str_replace('%date_from% - %date_to%','',$deletebutton);
        $eventArray['alldescriptions'] = fixEncoding(translatefields(731)) . " <br /><br /><div style=float:left;><form method=post action=index.php?option=my-calendar-reservation&delete_reservation_id=".$rowblocked["reservation_id"]."><input type=submit value='". fixEncoding(translatefields(747))."'/></form></div><div style=float:left;margin-left:5px;></div>";
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
	
	/*$datetoday = date("Y-m-d");
    $start_date = date ("Y-m-d", strtotime ("-20 day", strtotime($datetoday))); 
    $check_date = $start_date;
    $end_date = date ("Y-m-d", strtotime ("+20 day", strtotime($datetoday)));  
    while ($check_date != $end_date) { 
        $check_date = date ("Y-m-d", strtotime ("+1 day", strtotime($check_date))); 
        $eventArray['title'] = fixEncoding(translatefields(731));
        $eventArray['start'] = $check_date . " 12:00:00";
        $eventArray['end'] = $check_date . " 13:00:00";
        $eventArray['description'] = fixEncoding(translatefields(731));
        $eventArray['alldescriptions'] = fixEncoding(translatefields(731));
		$eventArray['reservation_status'] = "";
        $eventArray['id'] = "lunchbreak";
        $eventArray['allDay'] = false;
        $eventArray['color'] = "";
        $eventArray['textColor'] = "black";
        $eventArray['borderColor'] = "#eeeeee";
        $eventArray['editable'] = "false";
        $eventArray['disableResizing'] = "true";
        $eventArray['backgroundColor'] = "#eeeeee";
        $eventArray['droppable'] = "false";
        $events[] = $eventArray;
    }*/ 
		
header('Content-type: application/json');
echo json_encode($events);
?>