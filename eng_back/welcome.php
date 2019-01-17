<?php ob_start();
include "../include/session.php";
include "../include/z_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">
<title>Welcome</title>
<link href="../style.css" rel="stylesheet" type="text/css" />

</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Welcome, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

}else
{
header("location:index.php");	
}
?>
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type=button value="Logout"   onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="My Infos" onclick=location.href="settings1.php?al=''" id="maindatbtn">
<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<h1>News</h1>
		<?php

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
echo"<param name='1' value='images/young_and_old.swf'>";
echo"<embed src='../images/young_and_old.swf' width='600' height='290'>";
echo"</embed>";
echo"</object>";
}
if ($random==2)
{
echo"<br /><br />";
echo"<object>";
echo"<param name='1' value='manimano_holiday.swf'>";
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
