<? ob_start(); ?>
<?php


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
  alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte berprfe Deine Eingaben.');
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
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
	<input type=button value="Register" onclick=location.href="location.php" id="regbtn">
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
      <?php $j=$_GET['al']; if ($j == 1) echo "Das Passwort oder der Benutzername sind nicht korrekt, bitte berprfe Deine Eingaben."; ?>
      <?php $j=$_GET['al']; if ($j == 3) echo "user name doesnot exists."; ?>
      <?php $j=$_GET['al']; if ($j == 4) echo "cell not registred."; ?>
      <?php $j=$_GET['al']; if ($j == 10) echo "Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)"; ?>
 <?php $j=$_GET['al']; if ($j == 11) echo "Sie knnen sich jetzt anmelden. Danke frs Authentifizieren."; ?>
 <?php $j=$_GET['al']; if ($j == 12) echo "Sie knnen sich erst anmelden, wenn Sie Ihren Zugang ber Ihr Email freigeschaltet haben.<br> Bitte prfen Sie Ihre Emails und ggf. Ihren Spamordner."; ?>
      </div></div>
      </td>
    </tr>
    <?php }; ?>
 <tr >
  <td width="150" class="left" >
   <label >Username</label>  </td>
  <td class="right" width="200" >
   <input class="lpi" type="text" name="userid" tabindex=1 maxlength="100" maxsize="100"/>  </td>
  <td class="right" >
   <input type="button" id="lostlog" value="Forgot Username" tabindex=4 onClick=lostl()></td>
 </tr>
 <tr >
  <td width="150" class="left" >
   <label >Password</label>  </td>
  <td class="right" width="200" >
   <input class="lpi" type="password" name="password" tabindex=2  maxlength="100" maxsize="100" />  </td>
  <td class="right" >
   <input type="button" id="lostpas" value="Forgot Password" tabindex=5 onClick=lostp()></td>
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
		<p>&nbsp; <b>Forgot Username</b></p>
  <p>&nbsp Please enter your registered cellphone number.<br>&nbsp;  We will send you your Username by <br>&nbsp  SMS (text message) to your cell:</p>
		<p>&nbsp;&nbsp;<input type="text" name="cell1">&nbsp;&nbsp;<input type="submit" name="Submit" value="Send" ></p>
</form>	
</div>
	<div id="lostpassword">
<form action='loginck.php' method=post>
		<p>&nbsp; <b>Forgot Password</b></p>
		<p>&nbsp Please enter your Username <br>&nbsp We will send you <br>&nbsp  your Password by SMS (text message) to your cell:</p>
<br>
		<p>&nbsp;&nbsp;<input type="text" name="user1">&nbsp;&nbsp;<input type="submit" name="Submit" value="Send"></p>
</form>	
<script type="text/javascript">

var formachka = document.getElementById('Form1');

function verifyformachka() {
	if (formachka["userid"].value == "") {
		formachka["userid"].focus();
		alert("Please enter your Username.");
		return false;
	}
	
	if (formachka["password"].value == "") {
		formachka["password"].focus();
		alert("Please enter your Password.");
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