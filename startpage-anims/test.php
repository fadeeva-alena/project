<?php
include "include/z_db.php";
$monthNames = array("Jan", "Feb", "Mär", "Apr", "Mai", "Jun",   
                    "Jul", "Aug", "Sept", "Okt", "Nov", 
                    "Dez"); 

$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {

if ($row['Mode']=='On')
{
header("location:Maintenance.php");
}


}


session_start();
$todayis = date("Y-m-d H:i:s") ;
//$todayis = date( ) ;

if ($_SESSION['auth'] == "yes")
{ 
$sql="UPDATE  t_log  Set logout_date= '$todayis'  WHERE log_id ={$_SESSION['logid']}" ;

 mysql_query($sql)or die(mysql_error());
}
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"lang="nl" xml:lang="nl">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />



<title>Main page</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<LINK REL="SHORTCUT ICON"
       HREF="favicon.ico">
<!--Link the Spry Manu Bar JavaScript library-->
<script src="../SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<!--Link the CSS style sheet that styles the menu bar. You can select between horizontal and vertical-->
<link href="../SpryAssets/SpryMenuBarHorizontal1.css" rel="stylesheet" type="text/css" />
</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1 onclick=location.href="welcome.php"><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Häufige Fragen" onclick=location.href="faq.php" id="helpbtn5">
<input type=button value="Über uns" onclick=location.href="about.php" id="aboutbtn2">

<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn4">

	<input type=button value="Anmeldung" onclick=location.href="location.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Suche" onclick=location.href="nsearch.php?kinder=1&type=0&gender=2" id="helpbtn8" >
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn9">
  </div>

  <div class="mainContent">
<br>
<!--Create a Menu bar widget and assign classes to each element-->

	<div class="content">
		<h1>News</h1>
<?php
echo"<div style='overflow:auto; height: 226px;'>"; 
$sql = "SELECT * FROM t_news ORDER BY news_datum DESC";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {


echo "<div id=";
echo "col1";
  
list($yr,$mon,$day) = split('-',$row['news_datum']); 
if ($day[0] == 0)
$b=$day[1].".".$monthNames[($mon-1)].". ".$yr;
else
$b=$day.".".$monthNames[($mon-1)].". ".$yr;

echo ">$b</div><div id=";
echo "col2";
echo ">$row[news_text]</div>";
}
echo"</div>"; 
?>
		
		<center>
<?php
echo"<br /><br />";
echo"<object>";
echo"<param name='1' value='DavNew.swf'>";
echo"<param name='wmode' value='transparent'> ";
echo"<embed src='davnew1.swf' width='600' height='240' wmode='transparent'>";
echo"</embed>";
echo"</object>";



?>
		
		</center>
	</div>
  </div>
</div>
</body>
</html>
