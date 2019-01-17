<?php
$datetoday = date("Y-m-d");
    
    $start_date = date ("Y-m-d", strtotime ("-20 day", strtotime($datetoday))); 
    $check_date = $start_date;
    $end_date = date ("Y-m-d", strtotime ("+20 day", strtotime($datetoday)));  
    
    while ($check_date != $end_date) { 
        $check_date = date ("Y-m-d", strtotime ("+1 day", strtotime($check_date))); 
        echo $check_date . '<br>'; 
    }  
?>