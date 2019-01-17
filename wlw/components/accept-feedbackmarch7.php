<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$fid = trim($_REQUEST['fid']);
$typeid = trim($_REQUEST['typeid']);
$modeid = trim($_REQUEST['modeid']);

if ($typeid == 1){
	$toupdate = " feedback_events_accepted='$modeid'";
}elseif ($typeid == 3){
	$toupdate = " feedback_leaders_accepted='$modeid'";
}elseif ($typeid == 2){
	$toupdate = " feedback_locations_accepted='$modeid'";
}elseif ($typeid == 4){
	$toupdate = " feedback_spiritwings_accepted='$modeid'";
}
mysql_query("update t_feedbacks set $toupdate where id='$fid'");

?>
