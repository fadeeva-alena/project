<?php
//include "include/session.php";

include "../include/z_db.php";

$id=$_GET['id'];
$code=$_GET['code'];
$sql="SELECT * FROM t_people WHERE people_id ='$id' and Acode='$code'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
$sql="UPDATE t_people SET Active   = '1'   WHERE people_id =$id";
$result = mysql_query($sql); 
header("location:login.php?al=11");
} else
echo"error contact manimano help";


?>
