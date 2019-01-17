<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
// reservation_id reservation_provider_id provider_event_id reservation_start_date reservation_end_date reservation_datetime

$reservation_id = $_REQUEST['reservation_id'];
$provider_event_title = $_REQUEST['provider_event_title'];
$sqlevent = mysql_query("select * from t_provider_events where 	provider_event_title='$provider_event_title'");
$rowevent = mysql_fetch_array($sqlevent);

$provider_event_id = $rowevent['provider_event_id'];
$start_date = trim($_REQUEST['start_date']);
$start_date = date('Y-m-d h:i:s',strtotime($start_date));

$timestamp = strtotime($start_date . " + ".$rowevent['provider_event_duration']." minute");
$end_date = date('Y-m-d h:i:s', $timestamp);

echo $sqlupdate = "update t_provider_reservation set reservation_start_date='$start_date',reservation_end_date='$end_date' where reservation_id='$reservation_id'";
mysql_query($sqlupdate);

?>
     