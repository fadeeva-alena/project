<? ob_start(); ?>﻿
<?php
include "include/session.php";

include "include/z_db.php";

if($_POST["Speichern"] == "Weiter zu den gesetzlichen Rahmenbedingungen (6v6)" )
{
$Nv = $_POST['Nv'];
$s1=$_POST['test'];
$s2=$_POST['test1'];
$s3=$_POST['test2'];
$s4=$_POST['test3'];
$s5=$_POST['test4'];

$sql="UPDATE t_people SET psych_time_loose_tight  = '$s1', psych_exact_creativ  = '$s2', psych_heart_thing  = '$s3', psych_easy_security = '$s4', psych_conflict_take_leave  = '$s5'  WHERE people_id ={$_SESSION['people_id']}";

$result = mysql_query($sql); 
header("location:settings6.php");
if ($Nv==2)
header("location:settings2.php");
if ($Nv==3)
header("location:settings3.php");
if ($Nv==4)
header("location:settings4.php");
if ($Nv==1)
header("location:settings1.php");
if ($Nv==6)
header("location:settings6.php");
}
$Nv = 5;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>ManiMano - Einstellungen 5 von 6</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="slider.css" />
<SCRIPT SRC="libdetect.js"></SCRIPT>
<SCRIPT SRC="libslider.js"></SCRIPT>
 <SCRIPT SRC="slider.js"></SCRIPT>

<script type="text/javascript">
function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.nextbtn2.click(); 

}
function update( )
{


document.getElementById("test").value=window.frames['frame1'].document.getElementById('slider1').value;
document.getElementById("test1").value=window.frames['frame2'].document.getElementById('slider1').value;
document.getElementById("test2").value=window.frames['frame3'].document.getElementById('slider1').value;
document.getElementById("test3").value=window.frames['frame4'].document.getElementById('slider1').value;
document.getElementById("test4").value=window.frames['frame5'].document.getElementById('slider1').value;
}
</script>
</head>

<body class="all"  onload="update()">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
			<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
}else
{
header("location:index.php");	
}
?>
<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type="button" value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type="button" value="Meine Daten"  onclick=location.href="Settings4.php" id="maindatbtn">
<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type="button" value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">5) Über meine Person:  <img src="images/page5.png" border="0"  usemap="#green" align="right" /> </span>
<map name="green">
<area shape="rect" alt="" coords="7,2,25,30" href="javascript:Nav(1);">
<area shape="rect" alt="" coords="30,2,45,30" href="javascript:Nav(2);">
<area shape="rect" alt="" coords="49,0,65,29" href="javascript:Nav(3);">
<area shape="rect" alt="" coords="70,0,87,30" href="javascript:Nav(4);">
<area shape="rect" alt="" coords="130,0,148,30" href="javascript:Nav(6);">

</map>

 <form method="post"  name="form1" action="settings5.php" onsubmit="update()">

		<p id="maintext">Jetzt haben Sie es fast geschafft: Die Angaben über ihre Person ist das Letzte, was wir von lhnen wollen. Und vielleicht das Wichtigste. Beziehungen jeglicher Art (Arbeit, Privat..) scheitern meist an der Kommunikation. Damit ein paar grundlegende Dinge schon vor der Begegnung klar sind, haben wir dieses Profil geschaffen - sprechen Sie darüber - man muss nicht gleich sein, aber wenn man sich über seine Eigenheiten bewusst wird und weiss, wen man vor sich hat, hat man schon halb gewonnen.</p>
	  <p></p>

    <div id="slider"><div id="slidertext1">Ich bin pünktlich,<br />sonst rufe ich an.</div><div id="sliderframe"><IFRAME name="frame1" src="slider/slider1.php?SCALE=<?php echo"{$row['psych_time_loose_tight']}"; ?>"; " height="70px" width="280px" frameborder=0 onclick="update( )">></IFRAME></div><div id="slidertext2">Bei mir kann es auch mal ein paar<br />Minuten später werden.</div></div>
    <div id="slider"><div id="slidertext1">Ich führe meine Aufträge<br />exakt nach Vorgabe aus.</div><div id="sliderframe"><IFRAME name="frame2" src="slider/slider1.php?SCALE=<?php echo"{$row['psych_exact_creativ']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">Ich denke mir Lösungen in Deinem<br />Sinn aus, wenn es nötig ist.</div></div>
    <div id="slider"><div id="slidertext1">Ich habe ein grosses<br />Herz.</div><div id="sliderframe"><IFRAME name="frame3" src="slider/slider1.php?SCALE=<?php echo"{$row['psych_heart_thing']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">Ich bin eher Sach-und<br />Lösungsorientiert.</div></div>
    <div id="slider"><div id="slidertext1">Ich finde mich in jeder<br />Situation zurecht.</div><div id="sliderframe"><IFRAME  name="frame4" src="slider/slider1.php?SCALE=<?php echo"{$row['psych_easy_security']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">Klare, sichere Rahmen-<br />bedingungen sind mir wichtig.</div></div>
    <div id="slider"><div id="slidertext1">Konflikte spreche und<br />trage ich aus.</div><div id="sliderframe"><IFRAME  name="frame5"src="slider/slider1.php?SCALE=<?php echo"{$row['psych_conflict_take_leave']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">Ich vermeide Konflikte nach<br />Möglichkeit.</div></div>

<input type="hidden" ID="test" name="test">
<input type="hidden" ID="test1"name="test1">
<input type="hidden" ID="test2"name="test2">
<input type="hidden" ID="test3"name="test3">
<input type="hidden" ID="test4"name="test4">
	<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">	
      <input name="Speichern" type="submit" name="nextbtn1" id="nextbtn2" value="Weiter zu den gesetzlichen Rahmenbedingungen (6v6)" >
</form>
    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
