<?php
$host="localhost"; // Host name
//$host="schlaepfer-consulting.ch"; // Host name 
$username="Manimano"; // Mysql username 
$password="15072002M"; // Mysql password 
$db_name="schlaepferd_"; // Database name 
$tbl_name="t_people"; // Table name 

// Connect to server and select databse.
mysql_connect("$host", "root", "")or die("cannot connect");
mysql_set_charset('utf8');
 
mysql_select_db("test")or die("cannot select DB");

?>
