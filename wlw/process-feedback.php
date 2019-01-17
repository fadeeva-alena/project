<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events_id = trim($_REQUEST['events_id']);
$location_id = trim($_REQUEST['location_id']);
$leader_id = trim($_REQUEST['leader_id']);
$feedback_by = trim($_REQUEST['feedback_by']);
$feedback_events = trim($_REQUEST['events_feedback']);
$feedback_leaders = trim($_REQUEST['leader_feedback']);
$feedback_locations = trim($_REQUEST['location_feedback']);
$feedback_spiritwings = trim($_REQUEST['spiritwings_feedback']);
$feedback_events_accepted = 0;
$feedback_leaders_accepted = 0;
$feedback_locations_accepted = 0;
$feedback_spiritwings_accepted = 0;

echo $sql = "insert into t_feedbacks values ('0','$events_id','$feedback_events','$feedback_events_accepted','$leader_id','$feedback_leaders','$feedback_leaders_accepted','$location_id','$feedback_locations','$feedback_locations_accepted','$feedback_spiritwings','$feedback_spiritwings_accepted','$feedback_by',NOW())";

mysql_query($sql);


?>
