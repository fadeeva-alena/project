<? ob_start(); ?>﻿
<?php






$j=$_GET['al'];

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style type="text/css">
body { font-family:Arial, Helvetica, sans-serif; font-size:12px;}
h1, h2, h3, h4, h5, h6 {margin:0; padding:0;}
#regform tr.white{ background-color:#ffffff;}
#regform tr.grey{ background-color:#CCCCCC;}
#regform tr.yellow{ background-color:#FFFF00;}
#regform tr.blue{ background-color:#3399FF;}

input { float:left; vertical-align:bottom;;}

.STYLE1 {font-size: 12px}
</style>

</head>
<body>

<div style=" padding:1em; border:2px solid #666; width:640px; height:inherit; float:left; margin:20px; margin-right:0px; border:2px solid #E5E5E5; -moz-border-radius:20px; -webkit-border-radius:20px; border-radius:20px; background-color:#bdd8f4;" >
<h2 style="font-weight:normal;  font-size:24px; padding:20px;">Login</h2> 
<form action='loginck.php' id="Form1" method="post" >
<br />
<table width="600" border="0" align="center" cellpadding="0" cellspacing="0">

<?php $j=$_GET['al']; if ($j !== 0) { ?>
    <tr>
      <td colspan="3">
      <div style="position:relative; height:30px; width:100px;"><div style="position:absolute; top:0px; left:0px; background: #FFF68F; color:#f00; white-space:nowrap;">
      <?php $j=$_GET['al']; if ($j == 1) echo "Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben."; ?>
      <?php $j=$_GET['al']; if ($j == 3) echo "user name doesnot exists."; ?>
      <?php $j=$_GET['al']; if ($j == 4) echo "cell not registred."; ?>
      <?php $j=$_GET['al']; if ($j == 10) echo "Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)"; ?>
 <?php $j=$_GET['al']; if ($j == 11) echo "Sie können sich jetzt anmelden. Danke fürs Authentifizieren."; ?>
 <?php $j=$_GET['al']; if ($j == 12) echo "Sie können sich erst anmelden, wenn Sie Ihren Zugang über Ihr Email freigeschaltet haben.<br> Bitte prüfen Sie Ihre Emails und ggf. Ihren Spamordner."; ?>
      </div></div>
      </td>
    </tr>
    <?php }; ?>

  <tr>
    <td width="121" height="25">Benutzername</td>
    <td width="184"><input name="userid" type="text"  style="width:150px; "/></td>
    <td width="295"><input type="submit" name="Submit3" value="Benutzername vergessen"  style="width:180px;"/></td>
  </tr>
  <tr>
    <td height="25">Passwort</td>
    <td><input name="password" type="password" style="width:150px; "/></td>
    <td><input type="submit" name="Submit3" value=" Passwort vergessen "  style="width:180px;"/></td>
  </tr>
</table>
<br />
<br />
<table width="300" border="0" align="center" cellpadding="0" cellspacing="0">
  
  <tr>
    <td height="25" align="center"><input type="submit" name="Submit" value="Anmeldung" /></td>
    </tr>
</table>

<p>&nbsp;</p>
</form>
</div>
</body>
</html>
