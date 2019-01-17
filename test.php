<? ob_start(); ?>


<?php
include "include/z_db.php";


// username and password sent from form 
$myusername=$_GET['myusername']; 

$ip = getenv("REMOTE_ADDR");
// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$myusername = mysql_real_escape_string($myusername);
$sql="SELECT * FROM t_people WHERE username='$myusername' ";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
//session_register("mypassword"); 
//$sql="SELECT firstname FROM t_people WHERE username='$myusername' and password='$mypassword'";
//$result=mysql_query($sql);
session_start();
$row=mysql_fetch_array($result);
$_SESSION['first_name'] = $row[firstname];
$_SESSION['last_name'] = $row[lastname];
$_SESSION['longitude'] = $row[longitude];
$_SESSION['latitude'] = $row[latitude];
$_SESSION['people_id'] = $row[people_id];
$_SESSION['location'] = $row[location];
$_SESSION['zip'] = $row[zip];

$_SESSION['auth'] = "yes";
$_SESSION['user']=$myusername;

header("location:settings2.php");
}
?>
<? ob_flush(); ?>
