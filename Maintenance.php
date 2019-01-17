<? ob_start(); ?>﻿
<?php
//include "include/session.php";

include "include/z_db.php";
session_start();
session_destroy();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">



<title>Main page</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<LINK REL="SHORTCUT ICON"
       HREF="favicon.ico">
</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<input type=button value="Anmeldung" onclick=location.href="register1.php?al=''&im=''" id="regbtn" DISABLED>
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn"DISABLED>
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn"DISABLED>
  </div>
  <div class="mainContent">
	<div class="content">
		
<?php
//mysql_set_charset('utf8_general_ci', $conn);
$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {

echo"<div align='center'><FONT 
color='#ffffff' size='+1'><MARQUEE bgcolor='#000080' 
direction='left' loop='true' ><STRONG>{$row['Message']}</STRONG></MARQUEE></FONT></DIV>";
if ($row['Mode']=='Off')
{
header("location:index.php");
}

}
?>
		
			</div>
  </div>
</div>
</body>
</html>
