<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events = array();

$sqlreservations = mysql_query("select * from t_provider_events pe inner join t_provider_reservation pr on pe.provider_event_id=pr.provider_event_id inner join t_currency c on c.id=pe.provider_event_price_currency where  reservation_status=1 and pe.provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	while ($rowreservations = mysql_fetch_array($sqlreservations)){
		$sqlprovider = mysql_query("select * from t_provider where id='".$rowreservations['reservation_provider_id']."'");
		$rowprovider = mysql_fetch_array($sqlprovider);
		
		//if ($_SESSION[WEBSITE_ALIAS]['admin_id']==$rowreservations["reservation_provider_id"]){
			$eventArray['title'] = fixEncoding($rowreservations["provider_event_title"]) . " - ". fixEncoding($rowprovider["nick"]);
		//}
			$eventArray['start'] = $rowreservations["reservation_start_date"];
			$eventArray['end'] = $rowreservations["reservation_end_date"];
			$eventArray['description'] = fixEncoding($rowreservations["provider_event_description"]) . "<br/><b>" . translatefields(8) . "</b>: " . $rowreservations['provider_event_price'] . " " . $rowreservations['currency'];
		//if (date('Y-m-d h:i:s') < $rowreservations['reservation_start_date']){
			$eventArray['alldescriptions'] = '<b>'.$rowreservations["provider_event_title"].'</b><br/>'.date('d.M.Y',strtotime($rowreservations["reservation_start_date"])).' '.date('h:i',strtotime($rowreservations["reservation_start_date"])).' - ' . date('h:i',strtotime($rowreservations["reservation_end_date"])). '<br/>'.fixEncoding($rowreservations["provider_event_description"]).'<br/><b>'. translatefields(8).'</b>: '.$rowreservations['provider_event_price'] . ' ' . $rowreservations['currency'].'<br /><br /><form method=post action=index.php?option=calendar-reservation&reservation_id='.$rowreservations["reservation_id"].'><table><tr><td colspan=2><hr style="border:1px solid dashed;"><b><span style=font-size:16px;size;16px;color:#00356E;font-color:#00356E;>Stornieren</span></b></td></tr><tr><td><b>'.translatefields(629).':</b></td><td><textarea name="reason" id="reason" style=width:250px></textarea></td></tr><tr><td colspan=2 align=right><input type=submit name=submit2 value="'.translatefields(410).'"></td></tr></table></form>';
		/*}else{
			$eventArray['alldescriptions'] = '<b>'.$rowreservations["provider_event_title"].'</b><br/>'.date('d.M.Y',strtotime($rowreservations["reservation_start_date"])).' '.date('h:i',strtotime($rowreservations["reservation_start_date"])).' - ' . date('h:i',strtotime($rowreservations["reservation_end_date"])). '<br/>'.fixEncoding($rowreservations["provider_event_description"]).'<br/><b>'. translatefields(8).'</b>: '.$rowreservations['provider_event_price'] . ' ' . $rowreservations['currency'];
		}*/
			$eventArray['id'] = fixEncoding($rowreservations["reservation_id"]);
			$eventArray['allDay'] = false;
			
			$eventArray['color'] = "#".fixEncoding($rowreservations["provider_event_color"]);
			
			
			$eventArray['editable'] = "true";
			
			$eventArray['disableResizing'] = "false";
			
			
			$events[] = $eventArray;
		}
		
header('Content-type: application/json');
echo json_encode($events);
?>