<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$sql = mysql_query("select * from t_email_suggestion where ip_address='".$_GET['ip_address']."'");
$row = mysql_fetch_array($sql);
echo $row['email_address'];

if ($_GET['test']){
	echo date("T");
}

?>