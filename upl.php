<?php

include "include/z_db.php";

     



$sql="SELECT * FROM t_people  ";
  $result=mysql_query($sql);   

$count = 0 ; 
while ($row=mysql_fetch_array($result)) {

 $i=$row[people_id];	
$z1=$row[zip];
$l1=$row[location];

$sql="SELECT * FROM _taccess  WHERE Zip='$z1' And Location='$l1'";
 $result1=mysql_query($sql);  
$row1=mysql_fetch_array($result1);

$z1=$row1[zip_area];

$sql="SELECT * FROM _taccess  WHERE Zip='$z1'";
 $result2=mysql_query($sql);  
$row2=mysql_fetch_array($result2);
$l1=$row2[Location];

$sql="UPDATE t_people SET locationarea ='$l1' WHERE people_id ='$i'";
  mysql_query($sql)or die(mysql_error());


}
Echo"done";
?>
