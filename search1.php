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
$ke=$_GET['ke']; 
$ke1 = urlencode ($ke) ;
$ke=ltrim($ke);
$ke=rtrim($ke);
$loc = $_GET['loc']; 




$kt=preg_split('/ /',$ke);//Breaking the string to array of words
// Now let us generate the sql 
while(list($key,$val)=each($kt)){
if($val<>" " and strlen($val) > 0){$q .= " note like '%$val%' or ";}

}// end of while
$q=substr($q,0,(strlen($q)-3));

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
$map->addMarkerIcon('/images/Markers/greenFlag.png','/images/Markers/greenFlag.png',0,0,10,10);
$map->addMarkerByCoords($hlong,$hlat,"{$_SESSION['first_name']} {$_SESSION['last_name']}","{$_SESSION['first_name']} {$_SESSION['last_name']}<br>{$_SESSION['add']}");

function cmpi($a, $b) 
{ 
     global $sort_field;

    if ($a[$sort_field] == $b[$sort_field]) {
        return 0;
    }
    return ($a[$sort_field] < $b[$sort_field]) ? -1 : 1;

 
     //return strcmp($a[$sort_field], $b[$sort_field]); 
} 
$da1 =strtotime(date("d.m.Y")) ;
$tda1= date("D");

switch ($type)
{

case "0":
if ($cat == 14)
{

$sql="SELECT DISTINCT people_id,prof_provider,institution,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people   Where prof_provider = '1'  And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}' And $q   ";


}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.prof_provider,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '1' And skill_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}'  And   t_people.locationarea ='{$_SESSION['locationarea']}' ";
else

$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And   t_people.locationarea ='{$_SESSION['locationarea']}' ";
  $result=mysql_query($sql);   

$count = 0 ; 
while ($row=mysql_fetch_array($result)) {

 	$ils= 1 ;
$da2 = $row[temp_sched_from];
$da2 = strtotime($da2);
$da3 = $row[temp_sched_to];
$da3 = strtotime($da3);
if(($da1 ==$da2) or ($da1 == $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}

}
if (($da1 >= $da2) And ($da1 <= $da3))
{

switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}

}
if ($row[prof_provider] == 0)
$ils = 0;
//if (($da1 > $da3) or ($da1 < $da2))
if ($ils == 1 )
{

 	$latest_array2[$count]=array( $row['institution'] ,$row['street'],$row['house_nr'], $row['zip'], $row['location'], $map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id'],$row['firstname'],$row['lastname'], $rate_bg );
        
 
//$Address[$count] = $row['street']." ".$row['house_nr'].", ".$row['zip']. $row['location']." Switzerland";
//$map->addMarkerIcon('/images/Markers/blue_Marker'.$Arr[23].'.png','/images/Markers/blue_Marker'.$Arr[23].'.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
			
	
$count= $count + 1 ;
}
        
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
$map->addMarkerIcon('/images/Markers/blue_Marker'.$Arr[$i].'.png','/images/Markers/blue_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array2[$i][6],$latest_array2[$i][7],$latest_array2[$i][0],"<b>{$latest_array2[$i][0]}<br>{$latest_array2[$i][10]} {$latest_array2[$i][11]}<br>$Address[$i]</b>");
}			

}
if ($gender=='0'){
$todayis = date("Y-m-d H:i:s") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type,ke) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','f','Seeks','$ke') ;" ;
mysql_query($sql)or die(mysql_error());
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,institution,gender,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people Where   prof_provider = '0' And gender ='1'  And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}' And $q   ";

}else
if ($subcat == 54)

$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.gender,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And skill_type_id ='$cat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.locationarea ='{$_SESSION['locationarea']}'";
else

$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.locationarea ='{$_SESSION['locationarea']}'";

}  
if ($gender=='1'){
$todayis = date("Y-m-d H:i:s") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type, ke) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','m','Seeks','$ke') ;" ;
mysql_query($sql)or die(mysql_error());
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,institution,gender,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people  Where  prof_provider = '0' And gender ='2'  And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}'  And $q ";

}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.street,t_people.gender,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And skill_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.locationarea ='{$_SESSION['locationarea']}'";
else
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.locationarea ='{$_SESSION['locationarea']}'";
} 
if ($gender=='2'){
$todayis = date("Y-m-d H:i:s") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type,ke) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','both','Seeks','$ke') ;" ;
mysql_query($sql)or die(mysql_error());
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,institution,gender,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people  Where  prof_provider = '0'  And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}' And $q  ";

}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.gender,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0' And skill_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.locationarea ='{$_SESSION['locationarea']}'";
else
$sql="SELECT * FROM t_people LEFT JOIN t_skills ON t_skills.people_id = t_people.people_id WHERE prof_provider = '0'  And skill_type_id ='$cat' And skill_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And t_people.locationarea='{$_SESSION['locationarea']}'";
}   
$result=mysql_query($sql); 
$count = 0;
while ($row=mysql_fetch_array($result)) {
$ils= 1 ;
$da2 = $row[temp_sched_from];
$da2 = strtotime($da2);
$da3 = $row[temp_sched_to];
$da3 = strtotime($da3);
if(($da1 ==$da2) or ($da1 == $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}


}
if (($da1 >= $da2) And ($da1 <= $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}


}

if ($gender=='0')
{
if ($row[gender] <> 1)
$ils = 0;

}

if ($gender=='1')
{
if ($row[gender] <> 2)
$ils = 0;

}

//if (($da1 > $da3) or ($da1 < $da2))
if ($ils == 1 )
{
 	
$latest_array[$count]=array($row['firstname'],$row['lastname'],$row['street'],$row['house_nr'], $row['zip'], $row['location'],$map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id'],$row['institution'], $rate_bg);
 //$Address[$count] = $row['street']." ".$row['house_nr'].", ".$row['zip']. $row['location']." Switzerland";


//$map->addMarkerIcon('/images/Markers/red_MarkerX.png','/images/Markers/red_MarkerX.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
					
$count= $count + 1 ;	
}			
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
$map->addMarkerIcon('/images/Markers/red_Marker'.$Arr[$j].'.png','/images/Markers/red_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array[$i][7],$latest_array[$i][8],$latest_array[$i][0],"<b>{$latest_array[$i][0]} {$latest_array[$i][1]}<br> {$latest_array[$i][11]}<br>$Address[$i]</b>");
}			

}
break;
case "1":
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,prof_provider,institution,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people Where   prof_provider = '1' And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}'  And $q ";

}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.prof_provider,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '1' And need_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}'  And t_people.locationarea ='{$_SESSION['locationarea']}'";
else

$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '1' And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And t_people.locationarea ='{$_SESSION['locationarea']}'";
  $result=mysql_query($sql);   

$count = 0 ;
while ($row=mysql_fetch_array($result)) {

 	$ils= 1 ;
$da2 = $row[temp_sched_from];
$da2 = strtotime($da2);
$da3 = $row[temp_sched_to];
$da3 = strtotime($da3);
if(($da1 ==$da2) or ($da1 == $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}


}
if (($da1 >= $da2) And ($da1 <= $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}


}
if ($row[prof_provider] == 0)
$ils = 0;
//if (($da1 > $da3) or ($da1 < $da2))
if ($ils == 1 )
{
 

 		$latest_array2[$count]=array( $row['institution'] ,$row['street'],$row['house_nr'], $row['zip'], $row['location'], $map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id'],$row['firstname'],$row['lastname'] , $rate_bg);
//$map->addMarkerIcon('/images/Markers/blue_MarkerX.png','/images/Markers/blue_MarkerX.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
 
$count= $count + 1 ;
}
			
	
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
$map->addMarkerIcon('/images/Markers/blue_Marker'.$Arr[$i].'.png','/images/Markers/blue_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array2[$i][6],$latest_array2[$i][7],$latest_array2[$i][0],"<b>{$latest_array2[$i][0]}<br>{$latest_array2[$i][10]} {$latest_array2[$i][11]}<br>$Address[$i]</b>");
}			

}






if ($gender=='0'){
$todayis = date("Y-m-d H:i:s") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type,ke) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','f','Needs','$ke') ;" ;
mysql_query($sql)or die(mysql_error());
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,institution,gender,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people  Where   prof_provider = '0' And gender ='1' And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}'  And $q ";

}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.gender,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And need_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}'And  t_people.locationarea ='{$_SESSION['locationarea']}'";
else

$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='1' And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'And  t_people.locationarea ='{$_SESSION['locationarea']}'";
}  
if ($gender=='1'){
$todayis = date("Y-m-d H:i:s") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type,ke) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','m','Needs','$ke') ;" ;
mysql_query($sql)or die(mysql_error());
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,institution,gender,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname FROM t_people Where  prof_provider = '0' And gender ='2' And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}' And $q  ";

}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.gender,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And need_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}'And  t_people.locationarea ='{$_SESSION['locationarea']}'";
else
$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0' And gender ='2' And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}' And  t_people.locationarea ='{$_SESSION['locationarea']}'";
} 
if ($gender=='2'){
$todayis = date("Y-m-d H:i:s") ;
$sql="INSERT INTO _t_search (date, Username,Skill_type, Skill_Subtype,Gender ,Search_type,ke) VALUES('$todayis', '{$_SESSION['user']}', '$cat', '$subcat','both','Needs','$ke') ;" ;
mysql_query($sql)or die(mysql_error());
if ($cat == 14)
{
$sql="SELECT DISTINCT people_id,gender,institution,street,house_nr,zip,location,latitude,longitude,image_path,firstname,lastname  FROM t_people   Where   prof_provider = '0' And people_id !='{$_SESSION['people_id']}' And   t_people.locationarea ='{$_SESSION['locationarea']}'  And $q ";

}else
if ($subcat == 54)
$sql="SELECT DISTINCT t_people.people_id,t_people.institution,t_people.gender,t_people.street,t_people.house_nr,t_people.zip,t_people.location,t_people.latitude,t_people.longitude,t_people.image_path,t_people.firstname,t_people.lastname FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0'  And need_type_id ='$cat'  And   t_people.people_id !='{$_SESSION['people_id']}'And  t_people.locationarea ='{$_SESSION['locationarea']}'";
else

$sql="SELECT * FROM t_people LEFT JOIN t_needs ON t_needs.people_id = t_people.people_id WHERE prof_provider = '0'  And need_type_id ='$cat' And need_subtype_id ='$subcat' And   t_people.people_id !='{$_SESSION['people_id']}'  And  t_people.locationarea='{$_SESSION['locationarea']}'";
}   
$result=mysql_query($sql);  
$count = 0 ;
while ($row=mysql_fetch_array($result)) {
$ils= 1 ;
$da2 = $row[temp_sched_from];
$da2 = strtotime($da2);
$da3 = $row[temp_sched_to];
$da3 = strtotime($da3);
if(($da1 ==$da2) or ($da1 == $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}


}
if (($da1 >= $da2) And ($da1 <= $da3))
{
switch($tda1)
{
case "Mon":
if ($row[monday_t] == "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] == "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] == "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] == "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] == "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] == "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] == "000000000000")
$ils = 0;
break;
}


}

if ($gender=='0')
{
if ($row[gender] <> 1)
$ils = 0;

}

if ($gender=='1')
{
if ($row[gender] <> 2)
$ils = 0;

}

//if (($da1 > $da3) or ($da1 < $da2))
if ($ils == 1 )
{

 
$latest_array[$count]=array($row['firstname'],$row['lastname'],$row['street'],$row['house_nr'], $row['zip'], $row['location'],$map->geoGetDistance($row['latitude'],$row['longitude'],$hlat,$hlong),$row['longitude'],$row['latitude'],$row['image_path'],$row['people_id'],$row['institution'], $rate_bg);
//$map->addMarkerIcon('/images/Markers/red_MarkerX.png','/images/Markers/red_MarkerX.png',0,0,10,10);
//$map->addMarkerByCoords($row["longitude"],$row["latitude"],$latest_array[$count][0],"<b>{$latest_array[$count][0]}<br>$Address[$count]</b>");
 
$count= $count + 1 ;	
}
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
$map->addMarkerIcon('/images/Markers/red_Marker'.$Arr[$j].'.png','/images/Markers/red_Marker'.$Arr[$i].'.png',0,0,10,10);
$map->addMarkerByCoords($latest_array[$i][7],$latest_array[$i][8],$latest_array[$i][0],"<b>{$latest_array[$i][0]} {$latest_array[$i][1]}<br>{$latest_array[$i][11]}<br>$Address[$i]</b>");
}			

}
break;

}



?>
<!DOCTYPE html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ManiMano - Suche</title>


<!-- Start Stylsheets & Plugins-->
<link href="style.css" rel="stylesheet" type="text/css" />
<link href="style2.css" rel="stylesheet" type="text/css" />
<link type="text/css" rel="stylesheet" href="css/example.css">
<link href="custom/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="custom/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="custom/css/custom.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryMenuBarHorizontal1.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!-- Ends Stylsheets -->

<!-- Start JavaScripts & Plugins -->
<script src="custom/js/jquery.min.js" type="text/javascript"></script>
<script src="custom/js/bootstrap.min.js" type="text/javascript"></script>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="js/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
  swfobject.registerObject("FLVPlayer", "9.0.0", "flash/expressInstall.swf");
  swfobject.registerObject("FLVPlayer1", "9.0.0", "flash/expressInstall.swf");
</script>
<!-- Ends JavaScripts -->

<link rel="SHORTCUT ICON" href="favicon.ico">

<?php require("js.php"); ?>

<?php 
  $map->printHeaderJS(); ?>
    <?php 
    $map->printMapJS(); 
$sidebar = $map->getSidebar();
?>
    <!-- necessary for google maps polyline drawing in IE -->
    
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


echo '<script language="javascript">confirm("Content: Für Ihre Suche gibt es leider keine Treffer. In ganz seltenen Fällen hilft ein erneutes Suchen mit  den gleichen Einstellungen.Falls Sie nach einem bestimmten Geschlecht gesucht haben, probieren Sie das andere Geschlecht.Alternativ empfehlen wir eine Suche nach einer ähnlichen Kategorie")</script>';
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

<!-- ******HEADER****** -->
<?php
$home   = "index.php";
$messageWelcome ="";

if ($_SESSION['auth'] == "yes"){
  $home = "welcome.php";
  $messageWelcome = "<span class='welcome'>Willkommen, ".$_SESSION['first_name']." ".$_SESSION['last_name']."</span>";
}
?>
    <div class="toph">
        <div class="topImage">
            <h1 class="logo">
                <a class="scrollto" href="index.php">
                    <span class="logo-title">Mani</span>Mano
                </a> 
            </h1><!--//logo-->
        </div>
    </div>
    <header id="header" class="header">  
        <div class="container">            
            <?php echo $messageWelcome; ?> 
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="nav-item">
                          <i class="glyphicon glyphicon-home"></i>
                          <a href="<?php echo $home; ?>">Home</a>
                        </li>
                        <li class="active nav-item">
                          <i class="glyphicon glyphicon-search"></i>
                          <a href="search.php?kinder=3&type=0&gender=2&ke=">Suche</a>
                        </li>
                        <li class="nav-item">
                          <i class="glyphicon glyphicon-info-sign"></i>
                          <a href="about.php">Über uns</a>
                        </li>
                        <li class="nav-item">
                          <i class="glyphicon glyphicon-th-list"></i>
                          <a href="Rechtliches.php">Rechtliches</a>
                        </li>
                        
                        

                        <li class="nav-item">
                          <i class="glyphicon glyphicon-question-sign"></i>
                          <a href="faq.php">Häufige Fragen</a>
                        </li>
                        <li class="nav-item">
                          <i class="glyphicon glyphicon-flag"></i>
                          <a href="help.php">Hilfe</a>
                        </li>
                        <?php 
                      if ($_SESSION['auth'] == "yes") { ?>
                        <li class="nav-item last">
                            <i class="glyphicon glyphicon-cog"></i>
                            <a href="settings1.php">Meine Daten</a>
                          </li>
                        <li class="nav-item last">
                            <i class="glyphicon glyphicon-off"></i>
                            <a href="index.php">Logout</a>
                          </li>
                      <?php } else { ?>
                        <li class="nav-item last">
                          <i class="glyphicon glyphicon-user"></i>
                          <a href="login.php?al=2">Login</a>
                        </li>
                        <li class="nav-item">
                          <i class="glyphicon glyphicon-map-marker"></i>
                          <a href="location.php">Anmeldung</a>
                        </li>
                      <?php } ?>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
<div class="container">
<div class="row" id ="contentIndex">
	
<h1>Trefferliste für  <?php if($cat==14){
echo"'$ke'";


}
else
{
   $sql="SELECT * FROM t_skill_types WHERE skilltype_id ='$cat'";
$result=mysql_query($sql);  
$row=mysql_fetch_array($result)  ;
echo " {$row['skilltype']}";
  

$sql="SELECT * FROM t_skill_subtype WHERE skill_subtype_id ='$subcat'";
$result=mysql_query($sql);  
$row=mysql_fetch_array($result)  ;
  $count=mysql_num_rows($result);
if($count==1)   
{
if ($row['skill_subtype']<>'kein Untertyp verf.')
echo ": {$row['skill_subtype']}";

}   
}
  ?></h1>
<div class="col-md-12" >
  <style>

    .localRow {

    }

    #row1 {
      height: 265px;
    }

    #resultsList {
      width: 300px;
      float: left;
      margin-right: 30px;
    }
    #resultsMap {
      width: 500px;
      float: left;
    }

    #row2 {

    }

    #row1, #row2 {
      /* width: 830px; */
      padding-left: calc(50% - 415px);
    }

  </style>
  <div id="row1">
    <div id="resultsList">
      <div style='padding-left:0px;'><img src='images/logo.JPG'  width='300'></div>
      <div style='overflow:auto; height: 265px;'>
      <table>
<?PHP

for ($i = 0; $i < $prov ; $i++) {
if($i<26)
{
//echo"<a href=";
//echo"javascript:loadTwo(";
//echo "Detail.php?id=1";
//echo")";
//echo">";
$m= $prov+$in-1 ; 
echo"<tr id=$j bgcolor='".($i == 0 ? 'lightblue' : 'white')."' onclick=loadTwo('Detail1.php?id={$latest_array2[$i][9]}&icon=blue_Marker$Arr[$i]',$i,$m)>";
echo"<td>";

echo "<img src=";
echo "'/images/Markers/blue_Marker$Arr[$i].png'";
echo ">";
echo"</td>";
if ($i == 0)
echo"<td FONT SIZE='0'>";
else 
echo"<td width='225' FONT SIZE='1'>";
// start change 10-13-2014
echo "<div align='right' class='box-result-cnt'>";
            $ide =  $latest_array2[$i][9];
                $query = mysql_query("SELECT * FROM `t_feedback` WHERE `p_id_to` = '$ide' "); 
                while($data = mysql_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['feedback_value'];
                   
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
    
           unset($rate_db);
             unset($sum_rates);
           
           echo" <div class='rate-result-cnt'>";
?>
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
            </div>
</div>
<?php

//end change 10/13/2014

echo "{$latest_array2[$i][0]}  <br>{$latest_array2[$i][10]} {$latest_array2[$i][11]}<br>";
 $sidebar = $map->getSidebar();
//echo"$sidebar" ;
echo "{$latest_array2[$i][1]} {$latest_array2[$i][2]} <br> {$latest_array2[$i][3]} {$latest_array2[$i][4]} ";
echo"</td>";
echo"<td>";
echo "<img src=";
echo "'images/profile/{$latest_array2[$i][8]}'";
	
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
echo"<tr id=$j bgcolor='".($i == 0 ? 'lightblue' : 'white')."' onclick=loadTwo('Detail1.php?id={$latest_array[$i][10]}&icon=red_Marker$Arr[$j]',$j,$m)>";
echo"<td>";
echo "<img src=";
echo "'/images/Markers/red_Marker$Arr[$j].png'";
echo ">" ;
echo"</td>";
if ($j==0)
echo"<td FONT SIZE='0'>";
else 
echo"<td width='225' FONT SIZE='0'>";
// start change 10-13-2014
echo "<div align='right' class='box-result-cnt'>";
            $ide =  $latest_array[$i][10];
                $query = mysql_query("SELECT * FROM `t_feedback` WHERE `p_id_to` = '$ide' "); 
                while($data = mysql_fetch_assoc($query)){
                    $rate_db[] = $data;
                    $sum_rates[] = $data['feedback_value'];
                   
                }
                if(@count($rate_db)){
                    $rate_times = count($rate_db);
                    $sum_rates = array_sum($sum_rates);
                    $rate_value = $sum_rates/$rate_times;
                    $rate_bg = (($rate_value)/5)*100;
                }else{
                    $rate_times = 0;
                    $rate_value = 0;
                    $rate_bg = 0;
                }
    
           unset($rate_db);
             unset($sum_rates);
           
           echo" <div class='rate-result-cnt'>";
?>
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
            </div>
</div>
<?php

//end change 10/13/2014




echo "{$latest_array[$i][0]} {$latest_array[$i][1]}  <br>";
echo "{$latest_array[$i][2]} {$latest_array[$i][3]}<br>  {$latest_array[$i][4]} {$latest_array[$i][5]} ";
	echo"</td>";
echo"<td>";
echo "<img src=";
echo "'images/profile/{$latest_array[$i][9]}'";
echo"</td>";		
echo"</tr>";
}
}

echo "</table>";
echo "</div>";

echo "</div>";// resultsList

//$map->addMarkerByAddress('621 N 48th St # 6 Lincoln NE 68502','PJ Pizza','<b>PJ Pizza</b>');
echo "<div id='resultsMap'>";
$map->printMap(); 
echo "</div>";

echo "</div>";// row1

echo "<div class='clearfix'></div>";

echo "<div id='row2'>";

if ($prov > 0){
  //echo "<div class='content'>";
  echo "<iframe BGCOLOR='#6593cf' Name='frame1' scrolling='no'  src='Detail1.php?id={$latest_array2[0][9]}&icon=blue_Marker$Arr[0]'  height=350 width=850  frameborder='0' </iframe> ";
  //echo"</div>";
}else
{
if ($in > 0 )
{
  //echo "<div class='content'>";
  echo "<iframe BGCOLOR='#6593cf' Name='frame1'  scrolling='no' src='Detail1.php?id={$latest_array[0][10]}&icon=red_Marker$Arr[0]'  height=350  width=850 frameborder='0' </iframe> ";
  //echo"</div>";
}
}

echo "</div>";// row2

?>  
 
</div>
</body>
</html>
