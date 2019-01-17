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


// **********************************
// SECTION edited by Konstantin Balashov, 12/09/2012

$dates = array(
    array($start_date, $end_date),
    array(date('Y-m-d H:i:s', strtotime($start_date) - 300), date('Y-m-d H:i:s', strtotime($end_date) - 300)),
    array(date('Y-m-d H:i:s', strtotime($start_date) + 300), date('Y-m-d H:i:s', strtotime($end_date) + 300)),
    array(date('Y-m-d H:i:s', strtotime($start_date) - 600), date('Y-m-d H:i:s', strtotime($end_date) - 600)),
    array(date('Y-m-d H:i:s', strtotime($start_date) + 600), date('Y-m-d H:i:s', strtotime($end_date) + 600))
);

$cntrows = array();
$cntrows1 = array();

foreach ($dates as $cDate) {
    $cStartDate = $cDate[0];
    $cEndDate = $cDate[1];
    $query = "
        SELECT * FROM t_provider_reservation 
        WHERE 
        (reservation_start_date BETWEEN '$cStartDate' and '$cEndDate' 
            OR '$cStartDate' BETWEEN reservation_start_date and reservation_end_date) 
        AND reservation_start_date != '$cEndDate' 
        AND reservation_end_date != '$cStartDate' 
        AND (reservation_status = 1 or reservation_status = 3 
            or reservation_status = 4 or reservation_status = 5)
    ";

    $query1 = "
        SELECT * FROM t_provider_reservation 
        WHERE 
        (reservation_end_date BETWEEN '$cStartDate' and '$cEndDate' 
            OR '$cEndDate' BETWEEN reservation_start_date and reservation_end_date) 
        AND reservation_end_date != '$cStartDate' 
        AND reservation_start_date != '$cEndDate' 
        AND (reservation_status = 1 or reservation_status = 3 
            or reservation_status = 4 or reservation_status = 5)
    ";

    $extraCondition = " and reservation_id != '$reservation_id'";

    if ($reservation_id != "") {
        $query .= $extraCondition;
        $query1 .= $extraCondition;
    }

    $sqlcheck = mysql_query($query);
    $sqlcheck1 = mysql_query($query1);
    
    $cnt = mysql_num_rows($sqlcheck);
    $cnt1 = mysql_num_rows($sqlcheck1);
    $cntrows[] = $cnt;
    $cntrows1[] = $cnt1;
    
    if (($cnt == 0) && ($cnt1 ==0)) {
        $goodTimeM = date('Y-n-j',strtotime($cStartDate));
        $goodTimeT = date('G:i',strtotime($cStartDate));
        $goodTime = $goodTimeM . " T" . $goodTimeT;
        break;
    }
    
    
//    $ctrrow = 0;
//    while ($rowcheck = mysql_fetch_array($sqlcheck)){
//            $ctrrow++;
//    }
//    $ctrrow1 = 0;
//    while ($rowcheck1 = mysql_fetch_array($sqlcheck1)){
//            $ctrrow1++;
//    }

}

if (in_array(0, $cntrows, true)) $ctrrow = 0; else $ctrrow = 1;
if (in_array(0, $cntrows1, true)) $ctrrow1 = 0; else $ctrrow1 = 1;


// END SECTION
// **********************************


//////


if (isset($_SESSION['ownerproviderid'])){
    $owner_provider_id = $_SESSION['ownerproviderid'];
}else{
    $owner_provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
}
//$owner_provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
$sqlcheckcalendar = mysql_query("select * from t_lunch_break_settings where provider_id='".$owner_provider_id."'");
//echo "select * from t_lunch_break_settings where provider_id='".$owner_provider_id."'";
$rowcheckcalendar = mysql_fetch_array($sqlcheckcalendar);
$start_time = $rowcheckcalendar['lunch_start'];
$end_time = $rowcheckcalendar['lunch_end'];
$lunch_day_start = $rowcheckcalendar['lunch_day_start'];
$lunch_day_end = $rowcheckcalendar['lunch_day_end'];
$weekrange = date('N',$start_date);
		
		
		
//if ($weekrange >= $lunch_day_start and $weekrange <= $lunch_day_end){
$newtocheck = date('Y-m-d',strtotime($start_date));
$checklunchreservation = mysql_query(
    "select * from t_provider_reservation 
    where 
    reservation_start_date like '%$newtocheck%' 
    and reservation_status=5 
    and owner_provider_id='$owner_provider_id'"
);


$startocheck = date("Hi",strtotime($start_date));
$endtocheck = date("Hi",strtotime($end_date));
//echo "---";
//echo $start_time . "--".$end_time;

if (mysql_num_rows($checklunchreservation) < 1){
	if (($startocheck > $start_time and $startocheck < $end_time) or ($endtocheck > $start_time and $endtocheck < $end_time)){
	//if (($startocheck >= $start_time and $startocheck <= $end_time) or ($endtocheck >= $start_time and $endtocheck <= $end_time)){
		//echo "(".$startocheck .">=". $start_time." and ".$startocheck ."<=" .$end_time.") or (".$endtocheck." >= ".$start_time." and ".$endtocheck. "<=" .$end_time.")";
	
		$lunchrow = 1;
	}else{
		$lunchrow = 0;
	}
}else{
	$lunchrow = 1;
}
/////

$getstart_date = date('Y-m-d',strtotime($start_date));
//echo $getstart_date = $getstart_date . " 12:00:00";
$getend_date = date('Y-m-d',strtotime($end_date));
//echo $getend_date = $getend_date . " 12:00:00";
if (isset($_SESSION['ownerproviderid'])){
			$owner_provider_id = $_SESSION['ownerproviderid'];
		}else{
			$owner_provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		}
if ($ctrrow > 0 or $ctrrow1 > 0 or $lunchrow > 0){
	echo "overlap";

}else{
	if (isset($_SESSION['ownerproviderid'])){
			$owner_provider_id = $_SESSION['ownerproviderid'];
		}else{
			$owner_provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		}
		//$owner_provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$sqlcheckcalendar = mysql_query("select * from t_lunch_break_settings where provider_id='".$owner_provider_id."'");
		//echo "select * from t_lunch_break_settings where provider_id='".$owner_provider_id."'";
		$rowcheckcalendar = mysql_fetch_array($sqlcheckcalendar);
		$start_time = $rowcheckcalendar['lunch_start'];
		$end_time = $rowcheckcalendar['lunch_end'];
		$lunch_day_start = $rowcheckcalendar['lunch_day_start'];
		$lunch_day_end = $rowcheckcalendar['lunch_day_end'];
		$weekrange = date('N',$start_date);
		
		
		
		//if ($weekrange >= $lunch_day_start and $weekrange <= $lunch_day_end){
			$newtocheck = date('Y-m-d',strtotime($start_date));
			$checklunchreservation = mysql_query("select * from t_provider_reservation where reservation_start_date like '%$newtocheck%' and reservation_status=5 and owner_provider_id='$owner_provider_id'");
			
			
			
			
			$mystring = $_REQUEST['reservation_id'];
			$findme   = '-';
			$pos = strpos($mystring, $findme);

		if ($_REQUEST['reservation_id'] != ""){
			if ($pos === false) {
				echo "not overlap|" . $goodTime;
				
			} else {
				if (mysql_num_rows($checklunchreservation) < 1){
					$startocheck = date("Hi",strtotime($start_date));
					$endtocheck = date("Hi",strtotime($end_date));
					//echo "---";
					//echo $start_time . "--".$end_time;
					if (($startocheck > $start_time and $startocheck < $end_time) or ($endtocheck > $start_time and $endtocheck < $end_time)){
						echo 'overlap';
					}else{
						$sqladd = "insert into t_provider_reservation values ('0','$owner_provider_id','$provider_event_id','$owner_provider_id','$start_date','$end_date',NOW(),'5','','$block_type','','','60')";
						mysql_query($sqladd);
						echo 'add not overlap';
					}	
				}else{
					echo 'overlap';
				}
			}
		}else{
			$startocheck = date("Hi",strtotime($start_date));
			$endtocheck = date("Hi",strtotime($end_date));
			//echo "---";
			//echo $start_time . "--".$end_time;
			
			
			if (($startocheck >= $start_time and $startocheck <= $end_time) or ($endtocheck >= $start_time and $endtocheck <= $end_time)){
				echo 'overlap';
			}else{
				echo 'not overlap|' . $goodTime;
			}
		}
			
}
?>