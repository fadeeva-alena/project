<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$sqlfield = mysql_query("select * from t_field_names where id=677");
$rowfield = mysql_fetch_array($sqlfield);
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
    $eventslabel = $rowfield['fieldname_de'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
    $eventslabel = $rowfield['fieldname_eng'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
    $eventslabel = $rowfield['fieldname_fr'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
    $eventslabel = $rowfield['fieldname_it'];
}

$sqlfield = mysql_query("select * from t_field_names where id=678");
$rowfield = mysql_fetch_array($sqlfield);
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
    $leaderslabel = $rowfield['fieldname_de'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
    $leaderslabel = $rowfield['fieldname_eng'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
    $leaderslabel = $rowfield['fieldname_fr'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
    $leaderslabel = $rowfield['fieldname_it'];
}

$sqlfield = mysql_query("select * from t_field_names where id=679");
$rowfield = mysql_fetch_array($sqlfield);
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
    $locationslabel = $rowfield['fieldname_de'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
    $locationslabel = $rowfield['fieldname_eng'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
    $locationslabel = $rowfield['fieldname_fr'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
    $locationslabel = $rowfield['fieldname_it'];
}

$sqlfield = mysql_query("select * from t_field_names where id=680");
$rowfield = mysql_fetch_array($sqlfield);
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
    $spiritwingslabel = $rowfield['fieldname_de'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
    $spiritwingslabel = $rowfield['fieldname_eng'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
    $spiritwingslabel = $rowfield['fieldname_fr'];
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
    $spiritwingslabel = $rowfield['fieldname_it'];
}


$events_id = trim($_REQUEST['events_id']);

$sql = mysql_query("select * from t_feedbacks where events_id='".$events_id."' and (feedback_events_accepted=1 or feedback_leaders_accepted=1 or feedback_locations_accepted=1 or feedback_spiritwings_accepted=1)");



$fevents_contents = "<div style=font-size:12px;font-weight:bold;width:292px;background-color:#eeeeee;padding:3px;>".fixEncodingx($eventslabel)."</div>";
$fleaders_contents = "<div style=font-size:12px;font-weight:bold;width:292px;background-color:#eeeeee;padding:3px;>".fixEncodingx($leaderslabel)."</div>";
$flocations_contents = "<div style=font-size:12px;font-weight:bold;width:292px;background-color:#eeeeee;padding:3px;>".fixEncodingx($locationslabel)."</div>";
$fspiritwings_contents = "<div style=font-size:12px;font-weight:bold;width:292px;background-color:#eeeeee;padding:3px;>".fixEncodingx($spiritwingslabel)."</div>";
$countfevents = 0;
$countfleaders = 0;
$countflocations = 0;
$countfspiritwings = 0;
if (mysql_num_rows($sql) > 0){
    
    while ($row = mysql_fetch_array($sql)){


        //get provider
        $sqlprovider = mysql_query("select * from t_provider where id='".$row['feedback_by']."'");
        $rowprovider = mysql_fetch_array($sqlprovider);
        $providername = $rowprovider['firstname'] . " " . $rowprovider['lastname'];
        //$fevents_contents .= $providername;
        //$fleaders_contents .= $providername;
        //$flocations_contents .= $providername;
        
        //get events
        if ($row['feedback_events_accepted'] == 1){
           $countfevents++;
           $fevents_contents .= "<br>". $row['feedback_events'] ." - <b>".$providername . "</b><br>";
        }
        //get leaders
        if ($row['feedback_leaders_accepted'] == 1){
            $countfleaders++;
            $fleaders_contents .= "<br>". $row['feedback_leaders'] ." - <b>".$providername . "</b><br>";
        }
        //get locations
        if ($row['feedback_locations_accepted'] == 1){
            $countflocations++;
            $flocations_contents .= "<br>". $row['feedback_locations'] ." - <b>".$providername . "</b><br>";
        }
	//get spiritwings
        if ($row['feedback_spiritwings_accepted'] == 1){
            $countfspiritwings++;
            $fspiritwings_contents .= "<br>". $row['feedback_spiritwings'] ." - <b>".$providername . "</b><br>";
        }
    
    }
    
    $displayallfeedback = "";
    if ($countfevents > 0){
       $displayallfeedback .= $fevents_contents . "<br />";
    }
    if ($countfleaders > 0){
        $displayallfeedback .= "<br />" .$fleaders_contents . "<br />";
    }
    if ($countflocations > 0){
        $displayallfeedback .= "<br />" .$flocations_contents;
    }
    if ($countfspiritwings > 0){
        $displayallfeedback .= "<br />" .$fspiritwings_contents;
    }
	echo $displayallfeedback;
}

?>