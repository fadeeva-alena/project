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


</head>

<body BGCOLOR='#6593cf'>


<?PHP
include "include/z_db.php";
$id=$_GET['id'];
$icon=$_GET['icon'];
$sql="SELECT * FROM t_people WHERE people_id ='$id'";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);


echo"<Table id='myTable' border='3'>";
echo"<tr>";
echo"<td width='10%'>  </td>";
echo"<td width='30%'> Name, Adresse: </td>";
echo"<td colspan='4'> Kontakt (fett=Vorzugskontakt):</td>";
?>
<td rowspan='4'>
<table width="300" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="300">
            <div id="TabbedPanels1" class="TabbedPanels">
              <ul class="TabbedPanelsTabGroup">
                <li class="TabbedPanelsTab" tabindex="0">Zeitliche Verfugbarkeit</li>
                <li class="TabbedPanelsTab" tabindex="0">uber die person</li>
              </ul>
              <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent">
                  <p>&nbsp;</p>
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="23%"><img src="images/image00812.png" width="293" height="50" /></td>
                    </tr>
                    <tr>
                      <td><img src="images/image00822.png" width="79" height="232" align="left" />
                        <?php
if ($row['monday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                                <?php
if ($row['monday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                              <?php
if ($row['monday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
<?php
if ($row['monday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                               <?php
if ($row['monday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                               <?php
if ($row['monday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                                <?php
if ($row['monday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                                <?php
if ($row['monday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                               <?php
if ($row['monday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                           <?php
if ($row['monday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                                <?php
if ($row['monday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                        <br />
                                               <?php
if ($row['monday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}

                        if ($row['tuesday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['wednesday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['thursday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['friday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                               if ($row['saturday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
                                                if ($row['sunday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked DISABLED >";
}else{
echo"<input type='checkbox' name='flag1' value='flag' DISABLED>";

}
?>
                     
                    </tr>
                  </table>
                </div>
                <div class="TabbedPanelsContent">
                  <Table>
                   <tr><td><div id="slider"><div id="slidertext1">Ich bin pünktlich,<br />sons rufe ich an.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_time_loose_tight']}"; ?> " height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Bei mir kann es auh mal ein paar<br />Minuten später werden.</div></div></td></tr>
    <tr><td><div id="slider"><div id="slidertext1">Ich führe meine Auftrage<br />exakt nach Vorgabe aus.</div></td><td><div id="sliderframe"><IFRAME src="slider/slider.php?SCALE=<?php echo"{$row['psych_exact_creativ']}"; ?>" height="40px" width="50px" frameborder=0></IFRAME></div></td><td><div id="slidertext2">Ich denke mir Losungen in Deinem<br />Sinn aus, wenn es notig ist.</div></div></td></tr>
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

</td>

<?php
echo"</tr>";
echo"<tr>";
echo"<td rowspan='2' width='10%'>";
echo "<img src=";
echo "'images/Markers/{$icon}.png'";
echo"</td>";
echo"<td rowspan='2' width='30%'>{$row['firstname']} {$row['lastname']} <br> {$row['street']} {$row['house_nr']} {$row['zip']} {$row['location']}  ";
Echo"</td>";
Echo"<td colspan='4'>{$row['tel_p']}<br>{$row['tel_m']}<br>{$row['email']}</td>";
Echo"</tr>";

Echo"<tr>";
Echo"<td width='15%'> Stundeniohn:</td>";
Echo"<td width='5%'>{$row['price_per_hour']}</td>";
Echo"<td width='10%'> Fr.</td>";
Echo"<td rowspan='2'>";
echo "<img src=";
echo"'images/profile/{$row['image_path']}'";
echo "width=63 Height=84 >" ;
echo"</td>";

echo"</tr>";

echo"<tr>";
echo"<td width='10%'> Bem. </td>";
echo"<td colspan='4'>{$row['note']}</td>";
echo"</tr>";
echo"</table>";
?>

  
		
	  
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>