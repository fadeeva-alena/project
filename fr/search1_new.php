<?php header("Content-type: text/html; charset=utf-8");

include "include/z_db.php";
require('include/phoogle.php');
$type=$_GET['type']; 
$gender=$_GET['gender']; 
$cat=$_GET['cat']; 
$subcat=$_GET['subcat']; 
global $map;
$map = new PhoogleMap();

   //$map->setDSN('mysql://USER:root@localhost/GEOCODES');

    // enter YOUR Google Map Key
    $map->setAPIKey('ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT2yXp_ZAY8_ufC3CFXhHIE1NvwkxRzcYfqap3UDTiWCqr_D_Uob0MhFQ ');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">

<title>Search</title>
<link href="style.css" rel="stylesheet" type="text/css" />


  <?php $map->printGoogleJS(); ?>
<script language="JavaScript"> 
function loadTwo(iframe1URL) 
{ 
parent.frame1.location.href=iframe1URL 
 
} 

</script>


</head>
<?PHP



?>
<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
     session_start();
     echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
	

       ?>
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=location.href="login.php" id="maindatbtn">
	<input type=button value="Suche" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">Süchen </span>
<tr>
<?PHP
 
echo"<td>";
switch ($type)
{

case "0":
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat'";
  $result=mysql_query($sql);   
echo"<ol>";
$count = 0 ; 
while ($row=mysql_fetch_array($result)) {

 	$latest_array2[$count]=array($row['institution'],$row['street'],$row['house_nr'], $row['zip'], $row['location']);
 $count= $count + 1 ;
			
	
}
$sort_field = 0;

//usort($latest_array2, 'cmpi'); 
for ($i = 0; $i < $count; $i++) {
echo"<li>";
echo "{$latest_array2[$i][0]}   <br>";
echo "{$latest_array2[$i][1]} {$latest_array2[$i][2]} , {$latest_array2[$i][3]} {$latest_array2[$i][4]} <br>";
			

echo"<div></li>";
$Address[i] = $latest_array2[$i][1]." ".$latest_array2[$i][2].", ".$latest_array2[$i][3]. $latest_array2[$i][4];
$map->addAddress($Address[i]);

}




if ($gender=='0'){
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat'";
}  
if ($gender=='1'){
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And skill_type_id ='$cat' And skill_subtype_id ='$subcat'";
} 
if ($gender=='2'){
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0'  And skill_type_id ='$cat' And skill_subtype_id ='$subcat'";
}   
$result=mysql_query($sql); 
$count = 0 ; 
while ($row=mysql_fetch_array($result)) {

 	
$latest_array[$count]=array($row['firstname'],$row['lastname'],$row['street'],$row['house_nr'], $row['zip'], $row['location']);
 $count= $count + 1 ;	
			
	
}
$sort_field = 0;

//usort($latest_array, 'cmpi'); 
for ($i = 0; $i < $count; $i++) {
echo"<li>";
echo "{$latest_array[$i][0]} {$latest_array[$i][1]}  <br>";
echo "{$latest_array[$i][2]} {$latest_array[$i][3]} , {$latest_array[$i][4]} {$latest_array[$i][5]} <br>";
			

echo"<div></li>";
$Address[i] = $latest_array[$i][2]." ".$latest_array[$i][3].", ".$latest_array[$i][4]. $latest_array[$i][5];
$map->addAddress($Address[i]);
}

echo"</ol>";

break;
case "1":
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '1' And need_type_id ='$cat' And need_subtype_id ='$subcat'";
  $result=mysql_query($sql);   
echo"<ol>";
$count = 0 ;
while ($row=mysql_fetch_array($result)) {

 	$latest_array2[$count]=array($row['institution'],$row['street'],$row['house_nr'], $row['zip'], $row['location']);
 $count= $count + 1 ;

			
	
}
$sort_field = 0;

usort($latest_array2, 'cmpi'); 
for ($i = 0; $i < $count; $i++) {
echo"<li>";
echo "{$latest_array2[$i][0]}   <br>";
echo "{$latest_array2[$i][1]} {$latest_array2[$i][2]} , {$latest_array2[$i][3]} {$latest_array2[$i][4]} <br>";
			

echo"<div></li>";
$Address[i] = $latest_array2[$i][1]." ".$latest_array2[$i][2].", ".$latest_array2[$i][3]. $latest_array2[$i][4];
$map->addAddress($Address[i]);
}
if ($gender=='0'){
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And need_type_id ='$cat' And need_subtype_id ='$subcat'";
}  
if ($gender=='1'){
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And need_type_id ='$cat' And need_subtype_id ='$subcat'";
} 
if ($gender=='2'){
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0'  And need_type_id ='$cat' And need_subtype_id ='$subcat'";
}   
$result=mysql_query($sql);  
$count = 0 ;
while ($row=mysql_fetch_array($result)) {
$latest_array[$count]=array($row['firstname'],$row['lastname'],$row['street'],$row['house_nr'], $row['zip'], $row['location']);
 $count= $count + 1 ;	

}

$sort_field = 0;

usort($latest_array, 'cmpi'); 
for ($i = 0; $i < $count; $i++) {
echo"<li>";
echo "{$latest_array[$i][0]} {$latest_array[$i][1]}  <br>";
echo "{$latest_array[$i][2]} {$latest_array[$i][3]} , {$latest_array[$i][4]} {$latest_array[$i][5]} <br>";
			

echo"<div></li>";
$Address[i] = $latest_array[$i][2]." ".$latest_array[$i][3].", ".$latest_array[$i][4]. $latest_array[$i][5];
$map->addAddress($Address[i]);

   
}
echo"</ol>";


		
}
echo "</td>";
echo "<td>";

 $map->showMap();

echo "</td>";
echo "</tr>";
?>  
 <iframe Name="frame1" src="Detail.php?id=9" scrolling="auto" width=100% height=100% frameborder="0" </iframe> 
</div>
  </div>
</div>
</body>
</html>