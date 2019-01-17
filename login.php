<? ob_start(); ?>﻿
<?php


include "include/z_db.php";

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
<?php require("header.php");?>
<div id="contentIndex" class="row">
  <h1>Login</h1>
	<form action='loginck.php' id="Form1" method="post" onsubmit="return verifyformachka();">
    <?php $j=$_GET['al']; if ($j !== 0) { ?>
      <div class="col-md-12">
          <?php $j=$_GET['al']; if ($j == 1) echo "<div class='alert alert-danger' role='alert'>Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben.</div>"; ?>
          <?php $j=$_GET['al']; if ($j == 20) { echo "<div class='alert alert-danger' role='alert'>Wir haben Ihr Passwort an Ihre Emailadresse geschickt, bitte prüfen Sie Ihren Email-Posteingang.</div>";  } ?>
          <?php $j=$_GET['al']; if ($j == 3) { echo "<div class='alert alert-danger' role='alert'>Benutzername existiert nicht, bitte überprüfen Sie den Benutzernamen</div>";  } ?>
          <?php $j=$_GET['al']; if ($j == 4) {echo "<div class='alert alert-danger' role='alert'>Wir haben keinen Benutzer mit dieser Email-Adresse registriert, bitte überprüfen Sie Ihre Eingabe";echo"<br>";echo" (ev. haben Sie mehrere Emailadressen, und bei ManiMano haben Sie eine andere hinterlegt?)</div>";} ?>
          <?php $j=$_GET['al']; if ($j == 10) echo "<div class='alert alert-danger' role='alert'>Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)</div>"; ?>
          <?php $j=$_GET['al']; if ($j == 11) echo "<div class='alert alert-danger' role='alert'>Sie können sich jetzt anmelden. Danke fürs Authentifizieren.</div>"; ?>
          <?php $j=$_GET['al']; if ($j == 12) echo "<div class='alert alert-danger' role='alert'>Sie können sich erst anmelden, wenn Sie Ihren Zugang über Ihr Email freigeschaltet haben.<br> Bitte prüfen Sie Ihre Emails und ggf. Ihren Spamordner.</div>"; ?>
          <?php $j=$_GET['al']; if ($j == 30) echo "<div class='alert alert-danger' role='alert'>Danke für Ihr Interesse an ManiMano. Im Moment hat Ihre Wohngemeinde/-stadt ManiMano noch nicht freigeschaltet. ManiMano kann nur eingesetzt werden, falls es von Ihrer Wohngemeinde/-stadt lizenziert wird</div>";?>
      </div>
    <?php }; ?>
    <div class="col-md-4 col-md-offset-4">
      <div class="form-group">
        <label >Benutzername</label>
        <input class="form-control lpi" type="text" name="userid" tabindex=1 maxlength="100" maxsize="100"/>
      </div>
      <div class="form-group">
        <label >Passwort</label>
        <input class="form-control lpi" type="password" name="password" tabindex=2  maxlength="100" maxsize="100" />
      </div>
      <ul>
        <li><a data-toggle="modal" data-target="#lostlog" tabindex=4 >Benutzername vergessen</a></li>
        <li><a data-toggle="modal" data-target="#lostpas" tabindex=5 >Passwort vergessen</a></li>
      </ul>
      <div class="form-group">
        <input class="form-control btn btn-primary" type="submit" id="loginbtn" value="Anmelden" name="Submit" tabindex=3) >
      </div>
    </div>
  </form>
  <!-- Modal LostLogin -->
  <div class="modal fade" id="lostlog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Abbrechen</span></button>
          <h4 class="modal-title" id="myModalLabel">Lost Login</h4>
        </div>
        <form action="loginck.php" method="post">
        <div class="modal-body">
            <p><b>Benutzername vergessen</b></p>
            <p>Bitte geben Sie nachfolgend lhre registrierte Emailadresse an. <br>Wir schicken lhren Benutzernamen per Email.</p>
            <p><input type="text" name="cell1"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
          <input class="btn btn-primary" type="submit" name="Submit" value="Abschicken" >
        </div>
        </form> 
      </div>
    </div>
  </div>
  <!--
	<div id="lostlogin">
    <form action='loginck.php' method=post>
		  <p><b>Benutzername vergessen</b></p>
      <p>Bitte geben Sie nachfolgend lhre<br> registrierte Emailadresse an. Wir<br> schicken lhren Benutzernamen per <br>s Email.</p>
		  <p><input type="text" name="cell1"><input type="submit" name="Submit" value="Abschicken" ></p>
    </form>	
  </div>
  -->

  <!-- Modal LostPassword -->
  <div class="modal fade" id="lostpas" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Abbrechen</span></button>
          <h4 class="modal-title" id="myModalLabel">Lost Password</h4>
        </div>
        <form action="loginck.php" method="post">
        <div class="modal-body">
            <p><b>Passwort vergessen</b></p>
            <p>Bitte geben Sie nachfolgend lhre Email ein. <br>Wir schicken lhr Passwort per Email.</p>
            <p><input type="text" name="cell1"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Abbrechen</button>
          <input class="btn btn-primary" type="submit" name="Submit" value="Abschicken" >
        </div>
        </form> 
      </div>
    </div>
  </div>
  <!--
	<div id="lostpassword">
    <form action='loginck.php' method=post>
		  <p><b>Passwort vergessen</b></p>
		  <p>Bitte geben Sie nachfolgend lhren<br> Benutzernamen ein. Wir schicken lhr<br> Passwort per Email.</p>
      <br>
		  <p><input type="text" name="user1"><input type="submit" name="Submit" value="Abschicken "></p>
    </form>	
  </div>
  -->
</div>

<script type="text/javascript">

var formachka = document.getElementById('Form1');

function verifyformachka() {
  if (formachka["userid"].value == "") {
    formachka["userid"].focus();
    alert("Bitte geben sie Ihren Benutzername ein.");
    return false;
  }
  
  if (formachka["password"].value == "") {
    formachka["password"].focus();
    alert("Bitte geben sie Ihren Passwort ein.");
    return false;
  }

return true;
} 
  
</script>
    <?php $j=$_GET['al']; if ($j == 3) {  echo"<script language=JavaScript>"; echo"document.getElementById('lostlogin').style.display='none';";
echo"document.getElementById('lostpassword').style.display='block';"; echo"</script>";} ?>
</body>
</html>
