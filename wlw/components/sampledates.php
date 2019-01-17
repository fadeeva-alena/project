<?php

//PHP Example code to add one moth to a date

$todayDate = date("Y-m-d");// current date
echo "Last Day of the Today: ".$todayDate."<br>";
$addmonth = 2;
//Add one day to today
$dateOneMonthAdded = strtotime(date("Y-m-d", strtotime($todayDate)) . "+".$addmonth." month");

echo "After adding one month: ".date('Y-m-t 23:59:59', $dateOneMonthAdded)."<br>";


?>