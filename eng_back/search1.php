<? ob_start(); ?>
<?php

include "include/z_db.php";
require('include/GoogleMapAPI.class.php');
     


include ("geocode.class.php");
global $map;
$map = new GoogleMapAPI('map');

   //$map->setDSN('mysql://4115_root:15072002@manimano_zymichost_manimano/GEOCODES');

    // enter YOUR Google Map Key
    $map->setAPIKey('ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ');
$key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ";
$map->setHeight('300px');
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
$map->disableDirections();
$map->addMarkerIcon('images/Markers/greenFlag.png','images/Markers/greenFlag.png',0,0,10,10);
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
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And   t_people.location ='{$_SESSION['location']}' ";
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
if ($i<26)
{
$map->addMarkerIcon('images/Markers/blue_Marker'.$Arr[$i].'.png','images/Markers/blue_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array2[$i][6],$latest_array2[$i][7],$latest_array2[$i][0],"<b>{$latest_array2[$i][0]}<br>$Address[$i]</b>");
}			

}
if ($gender=='0'){
$todayis = date("l, F j, Y, g:i a") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','f','Seeks') ;" ;
mysql_query($sql)or die(mysql_error());
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.location ='{$_SESSION['location']}'";

}  
if ($gender=='1'){
$todayis = date("l, F j, Y, g:i a") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','m','Seeks') ;" ;
mysql_query($sql)or die(mysql_error());
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.location ='{$_SESSION['location']}'";
} 
if ($gender=='2'){
$todayis = date("l, F j, Y, g:i a") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','both','Seeks') ;" ;
mysql_query($sql)or die(mysql_error());
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0'  And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And t_people.location ='{$_SESSION['location']}'";
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
$j = $i + $prov;
if ($j<26)
{
$map->addMarkerIcon('images/Markers/red_Marker'.$Arr[$j].'.png','images/Markers/red_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array[$i][7],$latest_array[$i][8],$latest_array[$i][0],"<b>{$latest_array[$i][0]}<br>$Address[$i]</b>");
}			

}
break;
case "1":
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '1' And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And t_people.location ='{$_SESSION['location']}'";
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
if($i<26)
{
$map->addMarkerIcon('images/Markers/blue_Marker'.$Arr[$i].'.png','images/Markers/blue_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array2[$i][6],$latest_array2[$i][7],$latest_array2[$i][0],"<b>{$latest_array2[$i][0]}<br>$Address[$i]</b>");
}			

}






if ($gender=='0'){
$todayis = date("l, F j, Y, g:i a") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','f','Needs') ;" ;
mysql_query($sql)or die(mysql_error());
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'And  t_people.location ='{$_SESSION['location']}'";
}  
if ($gender=='1'){
$todayis = date("l, F j, Y, g:i a") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','m','Needs') ;" ;
mysql_query($sql)or die(mysql_error());
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.location ='{$_SESSION['location']}'";
} 
if ($gender=='2'){
$todayis = date("l, F j, Y, g:i a") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','both','Needs') ;" ;
mysql_query($sql)or die(mysql_error());
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0'  And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And  t_people.location ='{$_SESSION['location']}'";
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
$j = $i + $prov;
if($j<26)
{
$map->addMarkerIcon('images/Markers/red_Marker'.$Arr[$j].'.png','images/Markers/red_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array[$i][7],$latest_array[$i][8],$latest_array[$i][0],"<b>{$latest_array[$i][0]}<br>$Address[$i]</b>");
}			

}
break;

}



?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">

<title>ManiMano - Suche</title>
<link href="style.css" rel="stylesheet" type="text/css" />

<?php 
  $map->printHeaderJS(); ?>
    <?php 
    $map->printMapJS(); 
$sidebar = $map->getSidebar();
?>
    <!-- necessary for google maps polyline drawing in IE -->
    <style type="text/css">
	  body {
	  	font-family:Arial, Helvetica, sans-serif;
	  	}
      v\:* {
        behavior:url(#default#VML);
      }
    </style>
<script language="JavaScript"> 
 



function loadTwo(iframe1URL,x,m) 
{ 
click_sidebar(x+1);
document.getElementById(x).bgColor="lightblue";
parent.frame1.location.href=iframe1URL ;
for (k=0;k<=m;k=k+1)
{
if(!(x==k))
{
document.getElementById(k).bgColor="White";
}
}


 
} 

</script>
<?php

if (($prov == 0) And ($in==0))
{
//echo "<script language = 'javascript'>";
////echo "alert('test')";
//echo "alert('Für Ihre Suche gibt es leider keine Treffer. Sie können gegebenenfalls ein besseres Resultat erzielen, wenn Sie die Suche offener gestalten / nach etwas ähnlichem Suchen.' )";
$path="http://www.manimano.ch/search.php?kinder=1&type=0&gender=".$gender ;
//echo "</script>" ;
echo '<script language="javascript">confirm("Für Ihre Suche gibt es leider keine Treffer. Sie können gegebenenfalls ein besseres Resultat erzielen, wenn Sie die Suche offener gestalten / nach etwas ähnlichem Suchen.")</script>';
?>
<script language="javascript">window.location = "http://www.manimano.ch/search.php?kinder=<?php echo"$cat";?>&type=<?php echo"$type";?>&gender=<?php echo"$gender";?>"</script>';

<?php
//echo '<script language="javascript">window.location = "http://www.schlaepfer-consulting.ch/search.php?kinder=1&type=0&gender=$gender"</script>';

$test=1;
//header("location:search.php?kinder=1&type=0&gender=2");
}
?>

</head>

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
<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=location.href="settings1.php" id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php?kinder=<?php echo"$cat";?>&type=<?php echo"$type";?>&gender=<?php echo"$gender";?>" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
	
<span id="title">Trefferliste</span>
<div>
<Table >
<tr>
<?PHP
 echo"<td>";
//new chnage

echo "<div style='padding-left:34px;'><img src='images/logo.jpg'  width='300'></div>";

//end Chnage
echo"<div style='overflow:auto; height: 270px;'>"; 
echo"<Table >";
//echo "<tr><img src='images/logo.jpg' width=100%></tr>";
for ($i = 0; $i < $prov ; $i++) {
if($i<26)
{
//echo"<a href=";
//echo"javascript:loadTwo(";
//echo "Detail.php?id=1";
//echo")";
//echo">";
$m= $prov+$in-1 ; 
echo"<tr  onclick=loadTwo('Detail.php?id={$latest_array2[$i][9]}&icon=blue_Marker$Arr[$i]',$i,$m)>";
echo"<td>";


echo "<img src=";
echo "'images/Markers/blue_Marker$Arr[$i].png'";
echo ">";
echo"</td>";
if ($i == 0)
echo"<td   id=$i  bgcolor='lightblue' FONT SIZE='0'>";
else 
echo"<td   width='225' id=$i  bgcolor='White' FONT SIZE='1'>";
echo "{$latest_array2[$i][0]}   <br>";
 $sidebar = $map->getSidebar();
//echo"$sidebar" ;
echo "{$latest_array2[$i][1]} {$latest_array2[$i][2]} <br> {$latest_array2[$i][3]} {$latest_array2[$i][4]} ";
echo"</td>";
echo"<td>";
echo "<img src=";
echo "'images/profile/{$latest_array2[$i][8]}'";
echo "width=37 Height=50 >" ;	
echo"</td>";
		
echo"</tr>";
//echo"</a>";
}
}





for ($i = 0; $i < $in ; $i++) {
//echo"<tr onclick=loadTwo('Detail.php?id={$latest_array[$i][10]}&icon=red_Marker$Arr[$i]')>";
$m= $prov+$in-1 ; 
$j = $i + $prov;
if($j<26)
{
echo"<tr   onclick=loadTwo('Detail.php?id={$latest_array[$i][10]}&icon=red_Marker$Arr[$j]',$j,$m)>";
echo"<td>";
echo "<img src=";
echo "'images/Markers/red_Marker$Arr[$j].png'";
echo ">" ;
echo"</td>";
if ($j==0)
echo"<td   id=$j  bgcolor='lightblue' FONT SIZE='0'>";
else 
echo"<td   width='225'   id=$j  bgcolor='White' FONT SIZE='0'>";


echo "{$latest_array[$i][0]} {$latest_array[$i][1]}  <br>";
echo "{$latest_array[$i][2]} {$latest_array[$i][3]}<br>  {$latest_array[$i][4]} {$latest_array[$i][5]} ";
	echo"</td>";
echo"<td>";
echo "<img src=";
echo "'images/profile/{$latest_array[$i][9]}'";
echo "width=37 Height=50 >" ;	
echo"</td>";		
echo"</tr>";
}
}

echo "</Table>";

echo "</div>";

echo "</td>";
echo "<td>";
//$map->addMarkerByAddress('621 N 48th St # 6 Lincoln NE 68502','PJ Pizza','<b>PJ Pizza</b>');
echo "<div style='float:right; margin-right:9px; position:relative; top:-2px;'>";
$map->printMap(); 
echo "</div>";
echo "</td>";
echo "</tr>";
//echo "</Table>";
//echo"</div>";
echo "<tr>";
echo "<td colspan='2' valign='top'> ";
if ($prov > 0){
//echo "<div class='content'>";
echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<iframe BGCOLOR='#6593cf' Name='frame1' scrolling='no'  src='Detail.php?id={$latest_array2[0][9]}&icon=blue_Marker$Arr[0]'  height=350 width=850  frameborder='0' </iframe> ";
//echo"</div>";
}else
{
if ($in > 0 )
{
//echo "<div class='content'>";
echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<iframe BGCOLOR='#6593cf' Name='frame1'  scrolling='no' src='Detail.php?id={$latest_array[0][10]}&icon=red_Marker$Arr[0]'  height=350  width=850 frameborder='0' </iframe> ";
//echo"</div>";
}
}
echo "</td>";
echo "</tr>";
echo "</Table>";
echo"</div>";

echo"</div>";

?>  
 

</div>
</body>
<?PHP



?>
</html>
