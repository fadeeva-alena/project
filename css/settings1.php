<?php
include "include/session.php";

include "include/z_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Settings1</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function maindaten()
{
document.getElementById("Vorname").value="david";
document.getElementById("Nachname").value="schlaepfer";
document.getElementById("Geb-datum").value="31.05.1970";
document.getElementById("strasse").value="laengistr.";
document.getElementById("Nr").value="12";
document.getElementById("plz").value="8132";
document.getElementById("ort").value="Egg";
document.getElementById("Tel").value="044 994 73 74";
document.getElementById("handy").value="079 423 26 60";
document.getElementById("email").value="ds@d-s-c.ch";
document.getElementById("benutzername").value="david";
document.getElementById("passwort").value="david";
document.getElementById("stundenlohn").value="15";
document.getElementById("mannlich").selected=true; 
}
 //-->
</script>
</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
}else
{
header("location:index.php");	
}
?>
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=javascript:maindaten() id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">1) Persönliche Daten </span>
		<p>
			<label>Firma:
		      <input type="text" name="Firma" id="Firma" size="30" Value=<?php echo"$row[institution]";?> >
	        </label>
		</p>
	    <p>
		    <label>Vorname:
		      <input type="text" name="Vorname" id="Vorname"  Value=<?php echo"$row[firstname]"; ?> />
	      </label>
          <label>Nachname:
	          <input type="text" name="Nachname" id="Nachname" Value=<?php echo"$row[lastname]"; ?>  />
          </label>
	    </p>
	    <p>
	      <label>Geschlecht:
<?php if ($row['gender'] == 1)
                 {
	        echo "<select name='Gechleht' id='Gechleht'>";
                echo "<option id='mannlich'>mannlich</option>";
		echo "<option  SELECTED>weiblich</option>";
                echo "</select>";
 } 

if ($row['gender'] == 2)
                 {
	        echo "<select name='Gechleht' id='Gechleht'>";
                echo "<option id='mannlich' SELECTED>mannlich</option>";
		echo "<option  >weiblich</option>";
                echo "</select>";
 } 
?>
          </label>
	      <label>Geb-datum:
	        <input type="text" name="Geb-datum" id="Geb-datum" Value=<?php echo"$row[birthdate]"; ?>/>
          </label>
	    </p>
	    <p>
	      <label>Bild:
	        <input type="image" name="Bild" id="Bild" src=<?php echo"'images/profile/{$row['image_path']}'";echo "width=63 Height=84" ; ?> />
          </label>
	    </p>
	    <p>
	      <label>Strasse/Nr.
	        <input type="text" name="strasse" id="strasse" size="26" Value=<?php echo"$row[street]"; ?> />
          </label>
	      <label>
	        <input type="text" name="Nr" id="Nr" size="10"  Value=<?php echo"$row[house_nr]"; ?> />
	      </label>
	    </p>
	    <p>
	      <label>PLZ/Ort:
	        <input type="text" name="plz" id="plz" size="11" Value=<?php echo"$row[zip]"; ?>  />
          </label>
	      <label>
	        <input type="text" name="ort" id="ort" size="25" Value=<?php echo"$row[location]"; ?> />
          </label>
	    </p>
	    <p>
	      <label>Tel. P:
	        <input type="text" name="Tel" id="Tel" Value=<?php echo"$row[tel_p]"; ?> />
          </label>
	      <label>Handy:
	        <input type="text" name="handy" id="handy"  Value=<?php echo"$row[tel_m]"; ?> />
          </label>
	    </p>
	    <p>
	      <label>E-mail:
	        <input type="text" name="email" id="email" Value=<?php echo"$row[email]"; ?> />
          </label>
	    </p>
	    <p>
	      <label>Vorzugs-<br />Kontaktart:
<?php if ($row['preferred_contact_by'] == 1)
                {
	        echo"<select name='vorzugs' id='vorzugs'>";
                echo"<option>Handy</option>";
                  echo"<option>Festnetz</option>";
                   echo"<option SELECTED>Email</option>";
            echo"</select>";
            }

if ($row['preferred_contact_by'] == 2)
                {
	        echo"<select name='vorzugs' id='vorzugs'>";
                echo"<option>Handy</option>";
                  echo"<option SELECTED>Festnetz</option>";
                   echo"<option >Email</option>";
            echo"</select>";
            }

if ($row['preferred_contact_by'] == 3)
                {
	        echo"<select name='vorzugs' id='vorzugs'>";
                echo"<option SELECTED>Handy</option>";
                  echo"<option>Festnetz</option>";
                   echo"<option >Email</option>";
            echo"</select>";
            }





?>
          </label>
	    </p>
	    <p>
	      <label>Benutzer-<br />name:
	        <input type="text" name="benutzername" id="benutzername" Value=<?php echo"$row[username]"; ?> />
          </label>
	      <label>Passwort:
	        <input type="password" name="passwort" id="passwort" Value=<?php echo"$row[password]"; ?> />
          </label>
	    </p>
	    <p>
	      <label>Stunden-<br />lohn:
	        <input type="text" name="stundenlohn" id="stundenlohn" size="11" Value=<?php echo"$row[price_per_hour]"; ?>  />
          Fr.</label>
        </p>
	    <p>
	      <label>Bemerkung:
	        <textarea name="bemerkung" cols="45" id="bemerkung"></textarea>
	      </label>
	    </p>
	    <p>
	      <label>
	        <input type="button" name="nextbtn" id="nextbtn" value="Weiter zur zeitlichen Verfügbarkeit (2 von 5)" onclick=location.href="settings2.php" />
          </label>
	    </p>
		<p>&nbsp;</p>
	</div>
  </div>
</div>
</body>
</html>