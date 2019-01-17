<?php
$oldstart_date = "2012-12-12 15:20:00";
$start_date = "2012-12-12 14:20:00";

echo $dif_start_date = (strtotime($oldstart_date) - strtotime($start_date))  / 60;
?>