<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
// reservation_id reservation_provider_id provider_event_id reservation_start_date reservation_end_date reservation_datetime
$reservation_id = $_REQUEST['reservation_id'];
$provider_event_titlex = explode(" - ",$_REQUEST['provider_event_title']);
$provider_event_title = $provider_event_titlex[0];
$sqlevent = mysql_query("select * from t_provider_events where 	provider_event_title='$provider_event_title'");

$rowevent = mysql_fetch_array($sqlevent);
$provider_event_id = $rowevent['provider_event_id'];
$start_date = trim($_REQUEST['start_date']);
$start_date = date('Y-m-d H:i:s',strtotime($start_date));

$timestamp = strtotime($start_date . " + ".$rowevent['provider_event_duration']." minutes");


//$end_date = date("Y-m-d H:i:s", strtotime('+'.$rowevent['provider_event_duration'].' minutes', date("Y-m-d H:i:s",strtotime($_REQUEST['start_date']))));



$datea = strtotime(trim($_REQUEST['start_date']));

if (isset($rowevent['provider_event_duration'])){
$end_date = date('Y-m-d H:i:s', strtotime('+'.$rowevent['provider_event_duration'].' minutes', $datea));
}else{
$end_date = date('Y-m-d H:i:s', strtotime('+60 minutes', $datea));
}

if ($reservation_id != ""){

$sqlcheck = mysql_query("SELECT * FROM t_provider_reservation WHERE (reservation_start_date BETWEEN '$start_date' and '$end_date' OR '$start_date' BETWEEN reservation_start_date and reservation_end_date) AND reservation_start_date != '$end_date' AND reservation_end_date != '$start_date' and reservation_id!='$reservation_id' AND (reservation_status=1 or reservation_status=3 or reservation_status=4)");

$sqlcheck1 = mysql_query("SELECT * FROM t_provider_reservation WHERE (reservation_end_date BETWEEN '$start_date' and '$end_date' OR '$end_date' BETWEEN reservation_start_date and reservation_end_date) AND reservation_end_date != '$start_date' AND reservation_start_date != '$end_date' AND reservation_id!='$reservation_id' AND (reservation_status=1 or reservation_status=3 or reservation_status=4)");

}else{

$sqlcheck = mysql_query("SELECT * FROM t_provider_reservation WHERE (reservation_start_date BETWEEN '$start_date' and '$end_date' OR '$start_date' BETWEEN reservation_start_date and reservation_end_date) AND reservation_start_date != '$end_date' AND reservation_end_date != '$start_date' AND (reservation_status=1 or reservation_status=3 or reservation_status=4)");

$sqlcheck1 = mysql_query("SELECT * FROM t_provider_reservation WHERE (reservation_end_date BETWEEN '$start_date' and '$end_date' OR '$end_date' BETWEEN reservation_start_date and reservation_end_date) AND reservation_end_date != '$start_date' AND reservation_start_date != '$end_date' AND (reservation_status=1 or reservation_status=3 or reservation_status=4)");

}
$ctrrow = 0;
while ($rowcheck = mysql_fetch_array($sqlcheck)){
	$ctrrow++;
}
$ctrrow1 = 0;
while ($rowcheck1 = mysql_fetch_array($sqlcheck1)){
	$ctrrow1++;
}

$getstart_date = date('Y-m-d',strtotime($start_date));
//echo $getstart_date = $getstart_date . " 12:00:00";
$getend_date = date('Y-m-d',strtotime($end_date));
//echo $getend_date = $getend_date . " 12:00:00";

if ($ctrrow > 0 or $ctrrow1 > 0){
	echo 'overlap';
}else{
	
	echo 'not overlap';
}
?>