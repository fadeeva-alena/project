<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$dateid = $_GET['date_id'];
$provider_id = $_GET['provider_id'];

$getnum = mysql_query("select c.currency as ccurrency,e.*,d.id as did from t_dates d inner join t_event e on e.id=d.events_id
			inner join t_currency c on c.id=e.currency
			where d.id='$dateid'");
	$size_row = mysql_fetch_array($getnum);
	$checkupordown = mysql_query("select * from t_reservations where date_id='".$dateid."' and (reservation_status=1)");
	$num_rows_check = mysql_num_rows($checkupordown);
	if (($num_rows_check < $size_row['max_number'])){
		echo 0;
	}else{
		echo 1;
	}
?>