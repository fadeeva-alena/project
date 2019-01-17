<?php

include "include/z_db.php";
require('include/GoogleMapAPI.class.php');
     


include ("geocode.class.php");
global $map;
$map = new GoogleMapAPI('map');

   //$map->setDSN('mysql://4115_root:15072002@manimano_zymichost_manimano/GEOCODES');

    // enter YOUR Google Map Key
    $map->setAPIKey('ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw');
$key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw";
$type=$_GET['type']; 
$gender=$_GET['gender']; 
$cat=$_GET['cat']; 
$subcat=$_GET['subcat']; 
session_start();
$hlong=$_SESSION['longitude'];
$hlat=$_SESSION['latitude'];
$Arr[0] = "A";
$Arr[1] = "B";
$Arr[2] = "C";
$Arr[3] = "D";
$Arr[4] = "E";
$Arr[5] = "F";
$Arr[6] = "G";
$Arr[7] = "H";
$Arr[8] = "I";
$Arr[9] = "J";
$Arr[10] = "K";
$Arr[11] = "L";
$Arr[12] = "M";
$Arr[13] = "N";
$Arr[14] = "O";
$Arr[15] = "P";
$Arr[16] = "Q";
$Arr[17] = "R";
$Arr[18] = "S";
$Arr[19] = "T";
$Arr[20] = "U";
$Arr[21] = "V";
$Arr[22] = "W";
$Arr[23] = "X";
$Arr[24] = "Y";
$Arr[25] = "Z";

$map->addMarkerIcon('http://manimano.comlu.com/images/Markers/greenFlag.png','http://manimano.comlu.com/images/Markers/greenFlag.png',0,0,10,10);
$map->addMarkerByCoords($hlong,$hlat);
function cmpi($a, $b) 
{ 
     global $sort_field;

    if ($a[$sort_field] == $b[$sort_field]) {
        return 0;
    }
    return ($a[$sort_field] < $b[$sort_field]) ? -1 : 1;

 
     //return strcmp($a[$sort_field], $b[$sort_field]); 
} 

switch ($type)
{

case "0":
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat'";
  $result=mysql_query($sql);   

$count = 0 ; 
while ($row=mysql_fetch_array($result)) {

 	$latest_array2[$count]=array($row['institution'],$row['street'],$row['house_nr'], $row['zip'], $row['location'], $map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id']);
        
 
//$Address[$count] = $row['street']." ".$row['house_nr'].", ".$row['zip']. $row['location']." Switzerland";
//$map->addMarkerIcon('images/Markers/blue_Marker'.$Arr[23].'.png','images/Markers/blue_Marker'.$Arr[23].'.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
			
	
$count= $count + 1 ;

        
}
$prov = $count;
$sort_field = 5;
if ( $count > 0){
usort($latest_array2, 'cmpi'); 
}
for ($i = 0; $i < $count; $i++) {
$Address[$i] = $latest_array2[$i][1]." ".$latest_array2[$i][2].", ".$latest_array2[$i][3]." ". $latest_array2[$i][4]." Switzerland";
$map->addMarkerIcon('http://manimano.comlu.com/images/Markers/blue_Marker'.$Arr[$i].'.png','http://manimano.comlu.com/images/Markers/blue_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array2[$i][6],$latest_array2[$i][7],$latest_array2[$i][0],"<b>{$latest_array2[$i][0]}<br>$Address[$i]</b>");
			

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
$count = 0;
while ($row=mysql_fetch_array($result)) {

 	
$latest_array[$count]=array($row['firstname'],$row['lastname'],$row['street'],$row['house_nr'], $row['zip'], $row['location'],$map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id']);
 //$Address[$count] = $row['street']." ".$row['house_nr'].", ".$row['zip']. $row['location']." Switzerland";


//$map->addMarkerIcon('images/Markers/red_MarkerX.png','images/Markers/red_MarkerX.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
					
$count= $count + 1 ;	
			
	
}
$in = $count;
$sort_field = 6;
if ( $count > 0){
usort($latest_array, 'cmpi'); 
}
for ($i = 0; $i < $count; $i++) {
$Address[$i] = $latest_array[$i][2]." ".$latest_array[$i][3].", ".$latest_array[$i][4]." ". $latest_array[$i][5]." Switzerland";
$map->addMarkerIcon('http://manimano.comlu.com/images/Markers/red_Marker'.$Arr[$i].'.png','http://manimano.comlu.com/images/Markers/red_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array[$i][7],$latest_array[$i][8],$latest_array[$i][0],"<b>{$latest_array[$i][0]}<br>$Address[$i]</b>");
			

}
break;
case "1":
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '1' And need_type_id ='$cat' And need_subtype_id ='$subcat'";
  $result=mysql_query($sql);   

$count = 0 ;
while ($row=mysql_fetch_array($result)) {

 	$latest_array2[$count]=array($row['institution'],$row['street'],$row['house_nr'], $row['zip'], $row['location'],$map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id']);
//$map->addMarkerIcon('images/Markers/blue_MarkerX.png','images/Markers/blue_MarkerX.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
 
$count= $count + 1 ;

			
	
}
$prov = $count;
$sort_field = 5;
if ( $count > 0){
usort($latest_array2, 'cmpi'); 
}
for ($i = 0; $i < $count; $i++) {
$Address[$i] = $latest_array2[$i][1]." ".$latest_array2[$i][2].", ".$latest_array2[$i][3]." ". $latest_array2[$i][4]." Switzerland";
$map->addMarkerIcon('http://manimano.comlu.com/images/Markers/blue_Marker'.$Arr[$i].'.png','http://manimano.comlu.com/images/Markers/blue_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array2[$i][6],$latest_array2[$i][7],$latest_array2[$i][0],"<b>{$latest_array2[$i][0]}<br>$Address[$i]</b>");
			

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
$latest_array[$count]=array($row['firstname'],$row['lastname'],$row['street'],$row['house_nr'], $row['zip'], $row['location'],$map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id']);
//$map->addMarkerIcon('images/Markers/red_MarkerX.png','images/Markers/red_MarkerX.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
 
$count= $count + 1 ;	

}
$in = $count ;
$sort_field = 6;
if ( $count > 0){
usort($latest_array, 'cmpi'); 
}
for ($i = 0; $i < $count; $i++) {
$Address[$i] = $latest_array[$i][2]." ".$latest_array[$i][3].", ".$latest_array[$i][4]." ". $latest_array[$i][5]." Switzerland";
$map->addMarkerIcon('http://manimano.comlu.com/images/Markers/red_Marker'.$Arr[$i].'.png','http://manimano.comlu.com/images/Markers/red_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array[$i][7],$latest_array[$i][8],$latest_array[$i][0],"<b>{$latest_array[$i][0]}<br>$Address[$i]</b>");
			

}
break;

}


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">

<title>Search</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
   if ($_SESSION['auth'] != "yes")
{
header("location:index.php");	
}
  $map->printHeaderJS(); ?>
    <?php 
    $map->printMapJS(); ?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
      v\:* {
        behavior:url(#default#VML);
      }
    </style>
<script language="JavaScript"> 
 



function loadTwo(iframe1URL) 
{ 
parent.frame1.location.href=iframe1URL 
 
} 

</script>


</head>
<?PHP



?>
<body class="all" onload="onLoad()">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
    
   if ($_SESSION['auth'] == "yes")
{

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
}else
{
header("location:index.php");	
}
	

       ?>
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=location.href="login.php" id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php?kinder=1&type=0&gender=2" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
<Table style="height: 500px;">	
<span id="title">Süchen </span>

<tr>
<?PHP
 
echo"<td>";
echo"<div style='overflow:auto; height: 500px;'>"; 
echo"<Table>";
for ($i = 0; $i < $prov ; $i++) {
//echo"<a href=";
//echo"javascript:loadTwo(";
//echo "Detail.php?id=1";
//echo")";
//echo">";

echo"<tr onclick=loadTwo('Detail.php?id={$latest_array2[$i][9]}&icon=blue_Marker$Arr[$i]')>";
echo"<td>";


echo "<img src=";
echo "'images/Markers/blue_Marker$Arr[$i].png'";
echo ">" ;
echo"</td>";
echo"<td>";
echo "{$latest_array2[$i][0]}   <br>";
echo "{$latest_array2[$i][1]} {$latest_array2[$i][2]} , {$latest_array2[$i][3]} {$latest_array2[$i][4]} <br>";
echo"</td>";
echo"<td>";
echo "<img src=";
echo "'images/profile/{$latest_array2[$i][8]}'";
echo "width=63 Height=84 >" ;	
echo"</td>";
		
echo"</tr>";
//echo"</a>";

}





for ($i = 0; $i < $in ; $i++) {
echo"<tr onclick=loadTwo('Detail.php?id={$latest_array[$i][10]}&icon=red_Marker$Arr[$i]')>";
echo"<td>";
echo "<img src=";
echo "'images/Markers/red_Marker$Arr[$i].png'";
echo ">" ;
echo"</td>";
echo"<td>";
echo "{$latest_array[$i][0]} {$latest_array[$i][1]}  <br>";
echo "{$latest_array[$i][2]} {$latest_array[$i][3]} , {$latest_array[$i][4]} {$latest_array[$i][5]} <br> ";
	echo"</td>";
echo"<td>";
echo "<img src=";
echo "'images/profile/{$latest_array[$i][9]}'";
echo "width=63 Height=84 >" ;	
echo"</td>";		
echo"</tr>";

}

echo "</Table>";

echo "</div>";

echo "</td>";
echo "<td>";
$map->addMarkerByAddress('621 N 48th St # 6 Lincoln NE 68502','PJ Pizza','<b>PJ Pizza</b>');
$map->printMap(); 
echo "</td>";
echo "</tr>";
echo "</Table>";
echo"</div>";

if ($prov > 0){
echo "<div class='content'>";
echo"<iframe BGCOLOR='#6593cf' Name='frame1' src='Detail.php?id={$latest_array2[0][9]}&icon=blue_Marker$Arr[0]' scrolling='auto' width=75% height=500 frameborder='0' </iframe> ";
echo"</div>";
}else
{
if ($in > 0 )
{
echo "<div class='content'>";
echo"<iframe BGCOLOR='#6593cf' Name='frame1' src='Detail.php?id={$latest_array[0][10]}&icon=red_Marker$Arr[0]' scrolling='auto' width=75% height=500 frameborder='0' </iframe> ";
echo"</div>";
}
}
echo"</div>";

?>  
 

</div>
</body>
</html>