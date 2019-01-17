<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="slider.css" />
<SCRIPT SRC="libdetect.js"></SCRIPT>
<SCRIPT SRC="libslider.js"></SCRIPT>
<link type="text/css" rel="stylesheet" href="css/example.css">
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

 <SCRIPT SRC="slider.js"></SCRIPT>
<title>Search</title>
<style type="text/css"> 
<!-- 
body {
  font-family:Arial, Helvetica, sans-serif;
  margin: 20px 0 0 0;
	}
.medium { 
   height: 12px; 
   width: 12px; 
} 
.big { 
   height: 50px; 
   width: 50px; 
   color: #FFFF00; 
   background-color: #FF0000; 
   border: 1px solid #FF9900; 
} 
table.sub1 
{ 
/* border:1px solid #000000; */
border-collapse:collapse; 
width:400px; 
/* height:250px; */
font-family:Arial, Helvetica, sans-serif;
} 
table.sub2 
{ 
/* border:0px solid #000000;  */
border-collapse:collapse; 
width:400px; 
font-family:Arial, Helvetica, sans-serif;
} 

.rowHeading {
  background-color: #eee;
  color: #23527c;
}

--> 
</style> 

</head>

<body BGCOLOR='#6593cf' height='320'>


<?PHP
include "include/z_db.php";
function mask ( $str, $start = 0, $length = null ) {
	$mask = preg_replace ( "/\S/", "*", $str );
	if( is_null ( $length )) {
		$mask = substr ( $mask, $start );
		$str = substr_replace ( $str, $mask, $start );
	}else{
		$mask = substr ( $mask, $start, $length );
		$str = substr_replace ( $str, $mask, $start, $length );
	}
	return $str;
}

$id=$_GET['id'];
$icon=$_GET['icon'];
$sql="SELECT * FROM t_people WHERE people_id ='$id'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
echo"<table class='sub1' style='float:left; height:300px; '> ";
//echo"<Table  id='myTable'  width='400'  height='300' border='1' cellpadding='0'>";
echo"<tr height='15px' class='rowHeading'>";
echo"<td height='15px'>  </td>";
echo"<td colspan='5' height='15'>Name, Adresse, Kontakt (fett=Vorzugskontakt):</td>";


echo"</tr>";
echo"<tr height='60px'>";
echo"<td rowspan='2' bgcolor='#ffffff' valign='top'>";
echo "<img src=";
echo "'images/Markers/{$icon}.png'";
echo"</td>";
echo"<td  colspan='4' valign='top'  bgcolor='#ffffff' style='border-right:solid 0px black; padding-left: 5px;'>";
if ($row['prof_provider'] == 1)
{
$m0 = mask ($row['institution']);
echo"$m0<br>";

}
$m1=mask($row['firstname']);
$m2 = mask($row['lastname']);
$m3 =mask($row['street']);
$m4 = mask($row['house_nr']);
$m5 = mask($row['zip']);
$m6 = mask($row['location']);

echo "$m1 $m2 <br> $m3 $m4 <br> $m5 $m6  ";
Echo "</td>";
Echo "<td valign='middle' width=10% style='background-color: white;'>";
echo "<img src='images/profile/temp/{$row['image_path']}' />";
echo "</td>";
Echo "</tr>";
/* Echo "<tr height='1px'>"; */
/* Echo "</tr>"; */

Echo"<tr height='45px'>";
/* echo "<td bgcolor='#ffffff' valign='top'> </td>"; */
Echo"<td colspan='5' valign='top' bgcolor='#ffffff' style='border-right: solid 0px black; padding-left: 5px;'>";
if ($row['preferred_contact_by']==1)
{
$m7 = mask($row['email']);
$m8 = mask($row['tel_p']);
$m9 = mask($row['tel_m']);
echo"<strong><a href='mailto:$m7'>$m7</a></strong><br>$m8<br>$m9</td>";
}
if ($row['preferred_contact_by']==2)
{
$m7 = mask($row['email']);
$m8 = mask($row['tel_p']);
$m9 = mask($row['tel_m']);
echo"<strong>$m8</strong><br><a href='mailto:$m7'>$m7</a><br>$m9</td>";
}
if ($row['preferred_contact_by'] ==3)
{
$m7 = mask($row['email']);
$m8 = mask($row['tel_p']);
$m9 = mask($row['tel_m']);
echo"<strong>$m9</strong><br>$m8<br><a href='mailto:$m7'>$m7</a></td>";
}
echo"</tr>";

echo"<tr height='15px' class='rowHeading'>";
echo "<td valign='top'> </td>";
echo"<td style='vertical-align:top;' colspan='5'> Bemerkung. </td>";

echo"</tr>";
echo"<tr height='75px'>";
echo "<td bgcolor='#ffffff' valign='top'> </td>";
echo"<td colspan='5' bgcolor='#ffffff' style='border-right:solid 0px black;'>{$row['note']}</td>";
echo"</tr>";

/* echo"<tr height='1px'>"; */
/* echo"</tr>"; */

echo"<tr class='rowHeading' height='34px'>";
echo "<td valign='top'> </td>";
Echo"<td width=10% > Stundenlohn:</td>";
Echo"<td colspan='2'><span style='background-color: white;'>{$row['price_per_hour']} Fr.</span></td>";
Echo"<td align='center' colspan='2' width=50% > ";

       
echo"</td>";
echo"</tr>";
echo"</table>";
?>
<table class="sub2" style="float: left; margin-left: 30px;"> 

	    <tr>
	      <td valign="top">
            <div id="TabbedPanels1" class="TabbedPanels" style="position:relative; top:-2px;">
              <ul class="TabbedPanelsTabGroup">
                <li class="TabbedPanelsTab" tabindex="0">Zeitliche Verfügbarkeit</li>
                <li class="TabbedPanelsTab" tabindex="0">Über  die Person</li>
                <li class="TabbedPanelsTab" tabindex="0">Bewertungen</li>
              </ul>
              <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent" style="height:266px;">
                 <table border="0" cellpadding="0" cellspacing="0" vspace="0">
                    <tr style="background:#56769d;" >
                      <td ></td>
                       <td ><font size="2px" Color="White">Mo</font></td>
                        <td ><font size="2px"Color="White">Di</font></td>
<td ><font size="2px" Color="White">Mi</font></td>
<td ><font size="2px"Color="White">Do</font></td>
<td ><font size="2px"Color="White">Fr</font></td>
<td ><font size="2px"Color="White">Sa</font></td>
<td ><font size="2px"Color="White">So</font></td>

                    </tr>
                    <tr Hight="1">
                      <td style="background:#56769d;"><font size="2px" Color='White'>24-02</font></td>
<td>
                         <?php
// start chane to show temp schedule when it is temp date 
$da1 =strtotime(date("d.m.Y")) ;
$tda1= date("D");
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
if ($row[monday_t] <> "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] <> "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] <> "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] <> "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] <>"000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] <> "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] <> "000000000000")
$ils = 0;
break;
}

}
if (($da1 >= $da2) And ($da1 <= $da3))
{

switch($tda1)
{
case "Mon":
if ($row[monday_t] <> "000000000000")
$ils = 0;
break;
case "Tue":
if ($row[tuesday_t] <> "000000000000")
$ils = 0;
break;

case "Wed":
if ($row[wednesday_t] <> "000000000000")
$ils = 0;
break;

case "Thu":
if ($row[thursday_t] <> "000000000000")
$ils = 0;
break;

case "Fri":
if ($row[friday_t] <> "000000000000")
$ils = 0;
break;

case "Sat":
if ($row[saturday_t] <> "000000000000")
$ils = 0;
break;

case "Sun":
if ($row[sunday_t] <> "000000000000")
$ils = 0;
break;
}

}
if ($ils == 1 )
{
$l1 = "monday";
$l2 = "tuesday";
$l3 = "wednesday";
$l4 = "thursday";
$l5 = "friday";
$l6 = "saturday";
$l7 = "sunday";

} else {
$l1 = "monday_t";
$l2 = "tuesday_t";
$l3 = "wednesday_t";
$l4 = "thursday_t";
$l5 = "friday_t";
$l6 = "saturday_t";
$l7 = "sunday_t";


}
// end change 
if ($row[$l1][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row[$l2][0] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][0] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                        
                                                <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>02-04</font></td>";
echo"<td>";
if ($row[$l1][1] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row[$l2][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                    
                                              <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>04-06</font></td>";
echo"<td>";
if ($row[$l1][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row[$l2][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                       
<?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px'Color='White'>06-08</font></td>";
echo"<td>";
if ($row[$l1][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row[$l2][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][3] == 1){                        
echo"<input type='checkbox' class='medium'  name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                       
                                               <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px'Color='White'>08-10</font></td>";
echo"<td>";
if ($row[$l1][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row[$l2][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                        
                                               <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px'Color='White'>10-12</font></td>";
echo"<td>";
if ($row[$l1][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row[$l2][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                        
                                                <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>12-14</font></td>";
echo"<td>";
if ($row[$l1][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row[$l2][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";

echo"<td>";
                                                if ($row[$l3][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['$l7'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                        
                                                <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>14-16</font></td>";
echo"<td>";
if ($row[$l1][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row[$l2][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                        
                                               <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>16-18</font></td>";
echo"<td>";
if ($row[$l1][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row[$l2][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                        
                                           <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>18-20</font></td>";
echo"<td>";
if ($row[$l1][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row[$l2][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                       
                                                <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px' Color='White'>20-22</font></td>";
echo"<td>";
if ($row[$l1][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row[$l2][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                  
                                               <?php
echo"<tr>";
echo"<td style='background:#56769d;'><font size='2px'Color='White'>22-24</font></td>";
echo"<td>";
if ($row[$l1][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row[$l2][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l3][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l4][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l5][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row[$l6][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row[$l7][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                     
                     
             
                  </table> 
                </div>
                <div class="TabbedPanelsContent" style="height:266px;">
                  <Table style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">
                   <tr><td><div id="slider"><div id="slidertext1">Ich bin pünktlich,<br />sonst rufe ich an.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_time_loose_tight']}"; ?> " height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Bei mir kann es auch mal ein paar<br />Minuten später werden.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich führe meine Auftrage<br />exakt nach Vorgabe aus.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_exact_creativ']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich denke mir Lösungen in Deinem<br />Sinn aus, wenn es nötig ist.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich habe ein grosses<br />Herz.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_heart_thing']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich bin eher Sach-und<br />Lösungsorientiert.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich finde mich in jeder<br />Situation zurecht.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_easy_security']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Klare, sichere Rahmen-<br />bedingungen sind mir wichtig.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Konflikte spreche und<br />trage ich aus.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_conflict_take_leave']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich vermeide Konflikte nach<br />Möglichkeit.</div></div></td></tr>
</Table>


                </div>

<div class="TabbedPanelsContent" style="height:266px;">


        <div class="box-result-cnt">
            <?php
                $query = mysql_query("SELECT * FROM `t_feedback` WHERE `p_id_to` = '$id'Order by `ID` DESC "); 
            echo "<Table>";

                while($data = mysql_fetch_assoc($query)){
                    $rate_db[] = $data;
                     $rate_bg = (($data['feedback_value'])/5)*100;
                   
               echo "<tr><td>";
?>
  <div class="rate-result-cnt">
                <div class="rate-bg" style="width:<?php echo $rate_bg; ?>%"></div>
                <div class="rate-stars"></div>
            </div>

               <?php
echo "</td> <td>";
echo $data['feedback_text'];
echo"</td></tr>";    





                }
              
    
            ?>
           
           


</div>
              </div>
          </div></td>
	      
        </tr>
      </table>
      
	</div>



		
	  
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
