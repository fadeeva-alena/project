<?php
//include "include/session.php";

include "../include/z_db.php";

$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {

if ($row['Mode']=='On')
{
header("location:Maintenance.php");
}


}


session_start();
$todayis = date("l, F j, Y, g:i a") ;
if ($_SESSION['auth'] == "yes")
{ 
$sql="UPDATE  t_log  Set logout_date= '$todayis'  WHERE log_id ={$_SESSION['logid']}" ;

 mysql_query($sql)or die(mysql_error());
}
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">



<title>Main page</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<LINK REL="SHORTCUT ICON"
       HREF="../favicon.ico">
</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
	<input type=button value="Register" onclick=location.href="register1.php?al=''&im=''" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn">
  </div>
  <div class="mainContent">
	<div class="content">
		<h1>News</h1>
<?php
//mysql_set_charset('utf8_general_ci', $conn);
$sql = "SELECT * FROM t_news LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {


echo "<div id=";
echo "col1";
  
list($yr,$mon,$day) = split('-',$row['news_datum']); 
$b=$day."-".$mon."-".$yr;

echo ">$b</div><div id=";
echo "col2";
echo ">$row[news_text]</div>";
}
?>
		
		<center>
<?php
 $total = "2"; 
 $start = "1";  
$random = mt_rand($start, $total);  
if ($random==1)
{
echo"<br /><br />";
echo"<object>";
echo"<param name='1' value='../images/young_and_old.swf'>";
echo"<embed src='../images/young_and_old.swf' width='600' height='290'>";
echo"</embed>";
echo"</object>";
}
if ($random==2)
{
echo"<br /><br />";
echo"<object>";
echo"<param name='1' value='../manimano_holiday.swf'>";
echo"<embed src='../manimano_holiday.swf' width='600' height='240'>";
echo"</embed>";
echo"</object>";
}
?>
		
		</center>
	</div>
  </div>
</div>
</body>
</html>
