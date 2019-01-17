<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events = array();

$sqlreservations = mysql_query("select * from t_provider_events pe inner join t_provider_reservation pr on pe.provider_event_id=pr.provider_event_id inner join t_currency c on c.id=pe.provider_event_price_currency where reservation_status=1 and pe.provider_id='".$_SESSION['ownerproviderid']."'");
	while ($rowreservations = mysql_fetch_array($sqlreservations)){
		$sqlprovider = mysql_query("select * from t_provider where id='".$rowreservations['reservation_provider_id']."'");
		$rowprovider = mysql_fetch_array($sqlprovider);
		
		if ($_SESSION[WEBSITE_ALIAS]['admin_id']==$rowreservations["reservation_provider_id"]){
			$eventArray['title'] = $rowreservations["provider_event_title"];
		}else{
				$eventArray['title'] = "";
		}
			$eventArray['start'] = $rowreservations["reservation_start_date"];
			$eventArray['end'] = $rowreservations["reservation_end_date"];
			$eventArray['description'] = fixEncoding($rowreservations["provider_event_description"]) . "<br/><b>" . translatefields(8) . "</b>: " . $rowreservations['provider_event_price'] . " " . $rowreservations['currency'];
		if (date('Y-m-d h:i:s') < $rowreservations['reservation_start_date']){
			$eventArray['alldescriptions'] = '<b>'.$rowreservations["provider_event_title"].'</b><br/>'.date('d.M.Y',strtotime($rowreservations["reservation_start_date"])).' '.date('h:i',strtotime($rowreservations["reservation_start_date"])).' - ' . date('h:i',strtotime($rowreservations["reservation_end_date"])). '<br/>'.fixEncoding($rowreservations["provider_event_description"]).'<br/><b>'. translatefields(8).'</b>: '.$rowreservations['provider_event_price'] . ' ' . $rowreservations['currency'].'<br /><br /><form method=post action=index.php?option=calendar-reservation&reservation_id='.$rowreservations["reservation_id"].'><table><tr><td colspan=2><hr style="border:1px solid dashed;"><b><span style=font-size:16px;size;16px;color:#00356E;font-color:#00356E;>Stornieren</span></b></td></tr><tr><td><b>'.translatefields(629).':</b></td><td><textarea name="reason" id="reason" style=width:250px></textarea></td></tr><tr><td colspan=2 align=right><input type=submit name=submit2 value="'.translatefields(410).'"></td></tr></table></form>';
		}else{
			$eventArray['alldescriptions'] = '<b>'.$rowreservations["provider_event_title"].'</b><br/>'.date('d.M.Y',strtotime($rowreservations["reservation_start_date"])).' '.date('h:i',strtotime($rowreservations["reservation_start_date"])).' - ' . date('h:i',strtotime($rowreservations["reservation_end_date"])). '<br/>'.fixEncoding($rowreservations["provider_event_description"]).'<br/><b>'. translatefields(8).'</b>: '.$rowreservations['provider_event_price'] . ' ' . $rowreservations['currency'];
		}
			$eventArray['id'] = fixEncoding($rowreservations["reservation_id"]);
			$eventArray['allDay'] = false;
			if ($_SESSION[WEBSITE_ALIAS]['admin_id']==$rowreservations["reservation_provider_id"]){
				$eventArray['color'] = "#".fixEncoding($rowreservations["provider_event_color"]);
				$eventArray['qtipclickable'] = "1";
			}else{
				$eventArray['color'] = "#aaaaaa";
				$eventArray['qtipclickable'] = "0";
			}
			if ($_SESSION[WEBSITE_ALIAS]['admin_id']==$rowreservations["reservation_provider_id"]){
				$eventArray['editable'] = "true";				
			}else{
				$eventArray['editable'] = "false";
			}
			$eventArray['disableResizing'] = "false";
			
			
			$events[] = $eventArray;
		}
	
$sqlblocked = mysql_query("select * from t_provider_reservation where owner_provider_id='".$_SESSION['ownerproviderid']."' and provider_event_id=0 and (reservation_status=3 or reservation_status=4)");
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
        $eventArray['alldescriptions'] = $rowblocked['block_description'];
        $eventArray['id'] = fixEncoding($rowblocked["reservation_id"]);
		$eventArray['reservation_status'] = fixEncoding($rowblocked["reservation_status"]);
        $eventArray['allDay'] = false;
        $eventArray['color'] = "";
        $eventArray['textColor'] = "black";
        $eventArray['borderColor'] = "#eeeeee";
        $eventArray['editable'] = "false";
        $eventArray['disableResizing'] = "false";
        $eventArray['backgroundColor'] = "#eeeeee";
        $eventArray['droppable'] = "false";
        $events[] = $eventArray;
	}
	
	$sqllunch = mysql_query("select * from t_provider_reservation where owner_provider_id='".$_SESSION['ownerproviderid']."' and provider_event_id=0 and (reservation_status=5)");
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
        $eventArray['alldescriptions'] = fixEncoding(translatefields(731));
        $eventArray['id'] = fixEncoding($rowblocked["reservation_id"]);
		$eventArray['reservation_status'] = fixEncoding($rowblocked["reservation_status"]);
        $eventArray['allDay'] = false;
        $eventArray['color'] = "";
        $eventArray['textColor'] = "black";
        $eventArray['borderColor'] = "#eeeeee";
        $eventArray['editable'] = "false";
        $eventArray['disableResizing'] = "false";
        $eventArray['backgroundColor'] = "#eeeeee";
        $eventArray['droppable'] = "false";
        $events[] = $eventArray;
	}
mysql_set_charset('utf8'); 
header('Content-type: application/json');
echo json_encode($events);
?>