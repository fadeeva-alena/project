<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="slider.css" />
<SCRIPT SRC="libdetect.js"></SCRIPT>
<SCRIPT SRC="libslider.js"></SCRIPT>
 <SCRIPT SRC="slider.js"></SCRIPT>
<title>Search</title>
<style type="text/css"> 
<!-- 
body {
	font-family:Arial, Helvetica, sans-serif;
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
border:1px solid #000000;
border-collapse:collapse; 
width:400px; 
height:250px;
font-family:Arial, Helvetica, sans-serif;
} 
table.sub2 
{ 
border:0px solid #000000; 
border-collapse:collapse; 
width:400px; 
font-family:Arial, Helvetica, sans-serif;
} 

--> 
</style> 

</head>

<body BGCOLOR='#6593cf' height='320'>


<?PHP
include "include/z_db.php";
$id=$_GET['id'];
$icon=$_GET['icon'];
$sql="SELECT * FROM t_people WHERE people_id ='$id'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
echo"<table class='sub1' style='float:left; height:280px;'> ";
//echo"<Table  id='myTable'  width='400'  height='300' border='1' cellpadding='0'>";
echo"<tr height='15px'>";
echo"<td height='15px'>  </td>";
echo"<td width='30%' height='15'> Name, Adresse: </td>";
echo"<td colspan='4' height='15'> Kontakt (fett=Vorzugskontakt):</td>";


echo"</tr>";
echo"<tr>";
echo"<td rowspan='2'  valign='top'>";
echo "<img src=";
echo "'images/Markers/{$icon}.png'";
echo"</td>";
echo"<td height='60px' rowspan='2' valign='top'  bgcolor='#ffffff' style='border-right:solid 1px #6593cf;'>{$row['firstname']} {$row['lastname']} <br> {$row['street']} {$row['house_nr']} <br> {$row['zip']} {$row['location']}  ";
Echo"</td>";
Echo"<td colspan='4' height='45px' valign='top' bgcolor='#ffffff' style='border-bottom:solid 1px #6593cf;'>";
if ($row['preferred_contact_by']==1)
echo"<strong><a href='mailto:{$row['email']}'>{$row['email']}</a></strong><br>{$row['tel_p']}<br>{$row['tel_m']}</td>";
if ($row['preferred_contact_by']==2)
echo"<strong>{$row['tel_p']}</strong><br><a href='mailto:{$row['email']}'>{$row['email']}</a><br>{$row['tel_m']}</td>";
if ($row['preferred_contact_by'] ==3)
echo"<strong>{$row['tel_m']}</strong><br>{$row['tel_p']}<br><a href='mailto:{$row['email']}'>{$row['email']}</a></td>";
Echo"</tr>";

Echo"<tr>";
Echo"<td height='15px'> Stundenlohn:</td>";
Echo"<td height='15px' bgcolor='#ffffff'>{$row['price_per_hour']}</td>";
Echo"<td height='15px' bgcolor='#ffffff'> Fr.</td>";
Echo"<td height='84px' rowspan='2' style='vertical-align:top;'>";
echo "<img src=";
echo"'images/profile/{$row['image_path']}'";
echo "width=63 Height=84 style='margin-top:21px;'>" ;
echo"</td>";

echo"</tr>";

echo"<tr>";
//echo"<td width='10%'> Bem. </td>";
echo"<td style='vertical-align:top;'> Bem. </td>";
echo"<td colspan='4' bgcolor='#ffffff' style='border-top:solid 1px #6593cf;'>{$row['note']}</td>";
echo"</tr>";
echo"</table>";
?>
<table class="sub2" style="float:right;"> 

	    <tr>
	      <td valign="top">
            <div id="TabbedPanels1" class="TabbedPanels" style="position:relative; top:-2px;">
              <ul class="TabbedPanelsTabGroup">
                <li class="TabbedPanelsTab" tabindex="0">Zeitliche Verfügbarkeit</li>
                <li class="TabbedPanelsTab" tabindex="0">Über  die Person</li>
              </ul>
              <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent" style="height:247px;">
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
if ($row['monday'][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row['tuesday'][0] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][0] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][0] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][0] == 1){                        
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
if ($row['monday'][1] == 1){                        
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row['tuesday'][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][1] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][1] == 1){                        
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
if ($row['monday'][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row['tuesday'][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][2] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][2] == 1){                        
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
if ($row['monday'][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row['tuesday'][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][3] == 1){                        
echo"<input type='checkbox' class='medium'  name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox'  class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][3] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][3] == 1){                        
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
if ($row['monday'][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row['tuesday'][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][4] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][4] == 1){                        
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
if ($row['monday'][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row['tuesday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][5] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][5] == 1){                        
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
if ($row['monday'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row['tuesday'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";

echo"<td>";
                                                if ($row['wednesday'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][6] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][6] == 1){                        
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
if ($row['monday'][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                        if ($row['tuesday'][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][7] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][7] == 1){                        
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
if ($row['monday'][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row['tuesday'][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][8] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][8] == 1){                        
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
if ($row['monday'][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row['tuesday'][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][9] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][9] == 1){                        
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
if ($row['monday'][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row['tuesday'][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][10] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][10] == 1){                        
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
if ($row['monday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";

                        if ($row['tuesday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['wednesday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['thursday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['friday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                               if ($row['saturday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"<td>";
                                                if ($row['sunday'][11] == 1){                        
echo"<input type='checkbox' class='medium' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' class='medium' name='flag1' value='flag' DISABLED>";

}
echo"</td>";
echo"</tr>";
?>
                     
             
                  </table> 
                </div>
                <div class="TabbedPanelsContent" style="height:247px;">
                  <Table style="font-size:12px; font-family:Arial, Helvetica, sans-serif;">
                   <tr><td><div id="slider"><div id="slidertext1">Ich bin pünktlich,<br />sonst rufe ich an.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_time_loose_tight']}"; ?> " height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Bei mir kann es auch mal ein paar<br />Minuten später werden.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich führe meine Auftrage<br />exakt nach Vorgabe aus.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_exact_creativ']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich denke mir Lösungen in Deinem<br />Sinn aus, wenn es nötig ist.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich habe ein grosses<br />Herz.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_heart_thing']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich bin eher Sach-und<br />Lösungsorientiert.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich finde mich in jeder<br />Situation zurecht.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_easy_security']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Klare, sichere Rahmen-<br />bedingungen sind mir wichtig.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Konflikte spreche und<br />trage ich aus.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_conflict_take_leave']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich vermeide Konflikte nach<br />Möglichkeit.</div></div></td></tr>
</Table>
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
