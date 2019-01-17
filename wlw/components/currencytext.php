<?php
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
error_reporting(0);
session_start();

$currency_id = $_REQUEST['currency_id'];

$sql = mysql_query("select * from t_currency where id='$currency_id'");
$row = mysql_fetch_array($sql);
echo $row['currency'];

?>