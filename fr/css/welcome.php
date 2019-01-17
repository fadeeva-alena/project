<?php
include "include/session.php";

include "include/z_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">
<title>Welcome</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body class="all">

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
	<input type=button value="Meine Daten" onclick=location.href="settings1.php" id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php?kinder=1&type=0&gender=2" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
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
echo ">$row[news_datum]</div><div id=";
echo "col2";
echo ">$row[news_text]</div>";
}
?>
		<center>
		<object>
			<param name="1" value="images/young_and_old.swf">
			<embed src="images/young_and_old.swf" width="600" height="450">
			</embed>
		</object>
		</center>
	</div>
  </div>
</div>
</body>
</html>
