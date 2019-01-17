<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
// reservation_id reservation_provider_id provider_event_id reservation_start_date reservation_end_date reservation_datetime

$provider_id = $_REQUEST['provider_id'];
$provider_event_title = $_REQUEST['provider_event_title'];
$sqlevent = mysql_query("select * from t_provider_events where 	provider_event_title='$provider_event_title'");
$rowevent = mysql_fetch_array($sqlevent);

$provider_event_id = $rowevent['provider_event_id'];
$start_date = trim($_REQUEST['start_date']);
$start_date = date('Y-m-d h:i:s',strtotime($start_date));

$timestamp = strtotime($start_date . " + ".$rowevent['provider_event_duration']." minute");
$end_date = date('Y-m-d h:i:s', $timestamp);

$sqladd = "insert into t_provider_reservation values ('0','$provider_id','$provider_event_id','$start_date','$end_date',NOW(),'1','')";
mysql_query($sqladd);
/*
<firstname> <lastname>
<p>
Hiermit bestätigen wir Ihnen im Namen von <providercompany> <providerfname> <providerlname> die Buchung von<br/>
<eventtitle><br>
am <date> von <starttime> bis <endtime>.<br>
bei <provider_company> <provider_firstname> <provider_lastname><br>
<provider_adressblock>
</p>
<p>
Die Kosten betragen: <amount> <currency>.<br>
Falls Sie verhindert sind, können Sie das unter <provider tel> mitteilen – Bei kurzfristigen Verschiebungen oder Stornierungen fallen die festgelegten Stornogebühren an.
</p>
<p>
Wir wünschen viel Spass und eine gelungene Session.<br>
Ihr Spiritwings-Team
</p>
<p>
<our_footer>
<br>
P.S. Bitte beachten Sie, dass Spiritwings.ch die Verwaltung des Terminkalenders im Auftrag des Anbieters anbietet; Ihr Vertragspartner ist der Anbieter.
</p>
*/
?>
     
	