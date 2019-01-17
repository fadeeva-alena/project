<?php
//include "include/session.php";

include "include/z_db.php";
$j=$_GET['al'];
if ($j == 1){
echo "<script language = 'javascript'>";
echo "alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben.')";
//echo "alert({$j})";
echo "</script>" ;
}


if ($j == 3){
echo "<script language = 'javascript'>";
echo "alert('user name doesnot exists')";
echo "</script>" ;
}

if ($j == 4){
echo "<script language = 'javascript'>";
echo "alert('cell not registred')";
echo "</script>" ;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">
<title>Login</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script language = "javascript">
function validate(text1,text2,text3,text4)
{
 if (text1==text2 && text3==text4)
 load('welcome.html');
 else 
 {
  alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben.');
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
	<input type=button value="Anmeldung" id="regbtn">
	<input type=button value="Login" id="loginbtn">
	<input type=button value="Hilfe" onclick=location.href="help.html" id="helpbtn">
  </div>
  <div class="mainContent">
	<div class="content">
	<div id="login">Login</div>
	<form action='loginck.php' method=post>
	<table width="532" cellpadding="5" cellspacing="0">
 <tr >
  <td width="150" class="left" >
   <label >Benutzername</label>
  </td>
  <td class="right" width="200" >
   <input class="lpi" type="text" name="userid"  maxlength="100" maxsize="100"/>
  </td>
  <td class="right" >
   <input type="button" id="lostlog" value="Benutzername vergessen" onClick=lostl()></td>
 </tr>
 <tr >
  <td width="150" class="left" >
   <label >Passwort</label>
  </td>
  <td class="right" width="200" >
   <input class="lpi" type="password" name="password" maxlength="100" maxsize="100" />
  </td>
  <td class="right" >
   <input type="button" id="lostpas" value="Passwort vergessen" onClick=lostp()></td>
 </tr>
 <tr >
  <td width="150" class="left" >
  </td>
  <td class="right" width="200">
    <input type="submit" id="loginbtn" value="Anmelden" name="Submit") >
 </td>
  <td class="right">
    &nbsp;</td>
 </tr>
</table>
</form>
	<div id="lostlogin">
<form action='loginck.php' method=post>
		<p><b>Benutzername vergessen</b></p>
		<p>Bitte geben Sie nachfolgend lhre Benutzernamen ein. Wir schicken lhr passwort per SMS auf lhr Handy:</p>
		<p>&nbsp;&nbsp;<input type="text" name="cell1">&nbsp;&nbsp;<input type="submit" name="Submit" value="Abschicken" ></p>
</form>	
</div>
	<div id="lostpassword">
<form action='loginck.php' method=post>
		<p><b>Passwort vergessen</b></p>
		<p>Bitte geben Sie nachfolgend lhre registrierte Hundynummer ein. Wir schicken lhren Benutzernamen per SMS auf lhr Handy:</p>
		<p>&nbsp;&nbsp;<input type="text" name="user1">&nbsp;&nbsp;<input type="submit" name="Submit" value="Abschicken "></p>
</form>	
</div>
	
</div>
</div>
	</div>
  </div>
</div>
</body>
</html>
