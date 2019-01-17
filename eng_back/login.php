<? ob_start(); ?>﻿
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
$j=$_GET['al'];
if ($j == 1){
//echo "<script language = 'javascript'>";
//echo "alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben.')";
//echo "alert({$j})";
//echo "</script>" ;
}
if ($j == 3){
//echo "<script language = 'javascript'>";
//echo "alert('user name doesnot exists')";
//echo "</script>" ;
}
if ($j == 4){
//echo "<script language = 'javascript'>";
//echo "alert('cell not registred')";
//echo "</script>" ;
}
if ($j == 10){
//echo "<script language = 'javascript'>";
//echo "alert('Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)')";
//echo "</script>" ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">
<title>ManiMano - Login</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script language = "javascript">
function validate(text1,text2,text3,text4)
{
 if (text1==text2 && text3==text4)
 load('welcome.html');
 else 
 {
  alert('The password or username are not correct, please check your informations.');
 }
}
function load(url)
{
 location.href=url;
}
</script>
<script language=JavaScript>
function lostp()
{
document.getElementById('lostlogin').style.display='none';
document.getElementById('lostpassword').style.display='block';
}
function lostl()
{
document.getElementById('lostpassword').style.display='none';
document.getElementById('lostlogin').style.display='block';
}
</script>
</head>
<body class="all">
<div id="container">
<div class="header">
<h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Register" onclick=location.href="register1.php?al=''" id="regbtn">
<input type=button value="Login" id="loginbtn">
<input type=button value="Help" onclick=location.href="help.php" id="helpbtn">
</div>
<div class="mainContent">
<div class="content">
<div id="login">Login</div>
<form action='loginck.php' id="Form1" method="post" onsubmit="return verifyformachka();">
<table width="532" cellpadding="5" cellspacing="0">
<?php $j=$_GET['al']; if ($j !== 0) { ?>
<tr>
<td colspan="3">
<div style="position:relative; height:30px; width:100px;"><div style="position:absolute; top:0px; left:0px; background: #FFF68F; color:#f00; white-space:nowrap;">
<?php $j=$_GET['al']; if ($j == 1) echo "The password or username are not correct, please check your informations."; ?>
<?php $j=$_GET['al']; if ($j == 3) echo "The username doesn't exist."; ?>
<?php $j=$_GET['al']; if ($j == 4) echo "This mobile phone is not registered."; ?>
<?php $j=$_GET['al']; if ($j == 10) echo "Your mobile phone number without countrycode, ex. (079 423 26 60)"; ?>
<?php $j=$_GET['al']; if ($j == 11) echo "You can login now. Thank you for authentification."; ?>
<?php $j=$_GET['al']; if ($j == 12) echo "You can only login, once you validated your e-mail address<br> Please check your e-mail account and also check the spam folder."; ?>
</div></div>
</td>
</tr>
<?php }; ?>
<tr >
<td width="150" class="left" >
<label >Username</label>  </td>
<td class="right" width="200" >
<input class="lpi" type="text" name="userid" tabindex="1" maxlength="100" maxsize="100"/>  </td>
<td class="right" >
<input type="button" id="lostlog" value="Forgot your username?" tabindex="4" onClick="lostl()"></td>
 </tr>
 <tr >
  <td width="150" class="left" >
   <label >Password</label>  </td>
  <td class="right" width="200" >
   <input class="lpi" type="password" name="password" tabindex=2  maxlength="100" maxsize="100" />  </td>
  <td class="right" >
   <input type="button" id="lostpas" value="Forgot your password?" tabindex=5 onClick=lostp()></td>
 </tr>
 <tr >
  <td width="150" class="left" >  </td>
  <td class="right" width="200">
    <input type="submit" id="loginbtn" value="Login" name="Submit" tabindex=3) > </td>
  <td class="right">&nbsp;    </td>
 </tr>
</table>
</form>
	<div id="lostlogin">
<form action='loginck.php' method=post>
		<p>&nbsp; <b>Forgot your username?</b></p>
  <p>&nbsp;&nbsp;Please enter your registered mobile<br />&nbsp;&nbsp;phonenumber.<br />&nbsp;&nbsp;We will send your Username via SMS<br />&nbsp;&nbsp;to your mobile phone:</p>
		<p>&nbsp;&nbsp;<input type="text" name="cell1">&nbsp;&nbsp;<input type="submit" name="Submit" value="Submit"></p>
</form>	
</div>
	<div id="lostpassword">
<form action='loginck.php' method=post>
		<p>&nbsp; <b>Forgot your password?</b></p>
		<p>&nbsp Please enter your Username.<br>&nbsp We will send your Password via SMS<br>&nbsp to your mobile phone:</p>
<br>
		<p>&nbsp;&nbsp;<input type="text" name="user1">&nbsp;&nbsp;<input type="submit" name="Submit" value="Send"></p>
</form>	
<script type="text/javascript">

var formachka = document.getElementById('Form1');

function verifyformachka() {
	if (formachka["userid"].value == "") {
		formachka["userid"].focus();
		alert("Please enter your username.");
		return false;
	}
	
	if (formachka["password"].value == "") {
		formachka["password"].focus();
		alert("Please enter your password.");
		return false;
	}

return true;
}	
	
</script>

</div>
	
</div>
</div>
	</div>
  </div>
</div>
</body>
</html>
