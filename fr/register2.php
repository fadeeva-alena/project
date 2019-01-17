<? ob_start(); ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
﻿<?php
include "include/session.php";
include "include/z_db.php";

if($_POST["action"] == "Upload Image")
{
unset($imagename);

if(!isset($_FILES) && isset($HTTP_POST_FILES))
$_FILES = $HTTP_POST_FILES;

if(!isset($_FILES['image_file']))
$error["image_file"] = "An image was not found.";


$imagename = basename($_FILES['image_file']['name']);
//echo $imagename;

if(empty($imagename))
$error["imagename"] = "The name of the image was not found.";


if (!($_FILES['image_file']['type'] =="image/jpeg" OR $_FILES['image_file']['type'] =="image/gif" OR $_FILES['image_file']['type'] =="image/pjpeg"))
$error="Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";



if(empty($error))
{
$newimage = "images/profile/" . $imagename;
//echo $newimage;
$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
if(empty($result))
{
$error["result"] = "There was an error moving the uploaded file.";
$k="";
$imgn="";
}
else
$k=$imagename;
$imgn=$imagename;
}

if(isset($_POST['prov']))
  $prof_prov = 1;
else
$prof_prov = 0;
if($_POST['Gechleht'] == "männlich") 
    $gen = 2;
if($_POST['Gechleht'] == "weiblich") 
    $gen = 1;
$username = $_POST['benutzername'];
$password = $_POST['passwort'];
$Vorname = $_POST['Vorname'];
$Nachname = $_POST['Nachname'];

$strasse = $_POST['strasse'];
$Nr = $_POST['Nr'];

$plz = $_POST['plz'];
$ort = $_POST['ort'];

$Tel = $_POST['Tel'];
$handy = $_POST['handy'];

$email = $_POST['email'];
$handy = $_POST['handy'];
list($day,$mon,$yr) = split('-',$_POST['Geb-datum']); 
$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum1 = $_POST['Geb-datum'];
$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = $_POST['Firma'];
if($_POST['vorzugs'] == "Handy") 
    $pre = 3;
if($_POST['vorzugs'] == "Festnetz") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;

if($imgn == "")
    {
if($_POST['Gechleht'] == "männlich") 
$imgn="no_picture_he.jpg";
if($_POST['Gechleht'] == "weiblich") 
$imgn="no_picture_she.jpg";
}
$im = "images/profile/" . $imgn ;
}
if($_POST["nextbtn"] == "Weiter zur zeitlichen Verfügbarkeit (2 von 5)")

{

 include "include/session.php";
include "include/z_db.php";
 include("geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw";

 

  $errors = "";  
if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
 $errors .= "Bitte geben Sie den Namen Ihres Vereins, Ihrer Organisation oder öffentlichen Einrichtung ein.";  
$prof_prov = 1;
} else
$prof_prov = 0;
list($f,$a,$imgn) = split('/',$_POST['imgn']);
if(($imgn == "no_picture_he.jpg") or ($imgn == "no_picture_she.jpg") )
  {
if($_POST['Gechleht'] == "männlich") 
$imgn="no_picture_he.jpg";
if($_POST['Gechleht'] == "weiblich") 
$imgn="no_picture_she.jpg";
}
$im = "images/profile/" . $imgn ;
//$imgn=$_POST['imgn'] ;
if($_POST['Vorname'] == "")
    $errors .= "Bitte geben sie Ihren Vornamen ein.";  
if($_POST['Nachname'] == "")  
    $errors .= "Bitte geben sie Ihren Nachnamen ein. ";   
if($_POST['Gechleht'] == "")  
    $errors .= "Bitte wählen Sie Ihr Geschlecht. "; 
if($_POST['Gechleht'] == "männlich") 
    $gen = 2;
if($_POST['Gechleht'] == "weiblich") 
    $gen = 1;

if($_POST['vorzugs'] == "Handy") 
    $pre = 3;
if($_POST['vorzugs'] == "Festnetz") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;

if($_POST['Geb-datum'] == "")  
{
    $errors .= "Bitte geben Sie Ihr Geburtsdatum an. ";  
$errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) / use dd.mm.yyyy";
}
//start change
else
{
//$d=date('d.m.Y', strtotime($_POST['Geb-datum'])); 
$arrDate = explode(".", $_POST['Geb-datum']); // break up date by slash
$intDay = $arrDate[0];
$intMonth = $arrDate[1];
$intYear = $arrDate[2];
 
$intIsDate = checkdate($intMonth, $intDay, $intYear);    
 if(!$intIsDate)
     {
//list($day,$mon,$yr) = split('.',$d);
//if (checkdate ( $mon , $day , $yr ))
//{
//}
//else
//{
$errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) / use dd.mm.yyyy";
}
}
//if(($_POST['Geb-datum'][2] <> "-")  or ($_POST['Geb-datum'][5] <> "-"))
//     $errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31-12-1970) / use dd-mm-yyyy";
//end change
if($_POST['strasse'] == "")  
    $errors .= "Bitte geben Sie uns noch die Strasse an, in der Sie wohnen. "; 
if($_POST['Nr'] == "")  
    $errors .= "Bitte geben Sie uns noch die Hausnummer an. "; 
if($_POST['plz'] == "")  
    $errors .= "Bitte geben Sie noch die PLZ Ihres Wohnortes ein. "; 
if($_POST['ort'] == "")  
    $errors .= "Bitte geben Sie noch Ihren Wohnort an.      ";
if($_POST['Tel'] == "")  
    $errors .= "Bitte füllen Sie noch Ihre Telefonnummer (Festanschluss) aus. ";
if($_POST['handy'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Handynummer an. ";
if(($_POST['handy'][0] <> "0") or   ($_POST['handy'][3] <> " ") or ($_POST['handy'][7] <> " ")or ($_POST['handy'][10] <> " "))
    $errors.= "Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)"; 
if($_POST['email'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Email-Adresse an.";
if($_POST['passwort'] == "")  
    $errors .= "Bitte geben Sie noch ein Passwort für Ihr Anmeldung bei ManiMano.";
if(strlen ($_POST['passwort']) < 5)  
    $errors .= "Das Passwort muss mindestens 5 Buchstaben lang sein.";
if($_POST['benutzername'] == "")  
    $errors .= "Bitte geben Sie noch Ihren gewünschten Benutzernamen an.";
$myusername = $_POST['benutzername'];
$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1)
 $errors .= "Der Benutzername existiert schon, bitte wählen Sie einen andern.";
//$tmp = new geocode( " ", "laengistr.", "12" , "switzerland", "Egg", "8132" );
// $coord = $tmp->locate();
//$errors.=$coord["longitude"] ;
// Desired address
   $address = str_replace( " ", "+","http://maps.google.com/maps/geo?q={$_POST['strasse']}+{$_POST['Nr']}+,+{$_POST['plz']}+{$_POST['ort']}&output=xml&key=$key");

   // Retrieve the URL contents
   $page = file_get_contents($address);

   // Parse the returned XML file
   $xml = new SimpleXMLElement($page);

  // Parse the coordinate string
list($longitude, $latitude, $altitude) = explode(",", $xml->Response->Placemark->Point->coordinates);
// Output the coordinates
//echo "Longitude: $longitude, Latitude: $latitude";
if (($longitude==Null) or ($latitude==Null))
 $errors .=" Bitte geben Sie eine gültige Adresse an.";
 $username = $_POST['benutzername'];
$password = $_POST['passwort'];
$Vorname = $_POST['Vorname'];
$Nachname = $_POST['Nachname'];

$strasse = $_POST['strasse'];
$Nr = $_POST['Nr'];

$plz = $_POST['plz'];
$ort = $_POST['ort'];

$Tel = $_POST['Tel'];
$handy = $_POST['handy'];

$email = $_POST['email'];
$handy = $_POST['handy'];
//list($day,$mon,$yr) = split('.',$_POST['Geb-datum']); 
//$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum = $intYear.".".$intMonth.".".$intDay;

$Geb_datum1 = $_POST['Geb-datum'];
$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = $_POST['Firma'];


  if ($errors == "") {   
//mysql_query("INSERT INTO t_people (`firstname`, `lastname`, `street`, `house_nr`, `zip`, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude) VALUES({$_POST['Vorname']}, {$_POST['Nachname']},  {$_POST['strasse']}, {$_POST['Nr']}, {$_POST['plz']}, {$_POST['ort']}, {$_POST['Tel']}, {$_POST['handy']}, {$_POST['email']}, {$_POST['benutzername']}, {$_POST['passwort']}, $gen, {$_POST['Geb-datum']}, $pre, {$_POST['stundenlohn']}, {$_POST['bemerkung']}, $longitude, $latitude) ") or die(mysql_error());  
//mysql_query("INSERT INTO t_people (`firstname`, `lastname`, `street`, `house_nr`,`zip`, `location`, `username`, `password`) VALUES({$_POST['Vorname']}, {$_POST['Nachname']},  {$_POST['strasse']}, {$_POST['Nr']}, {$_POST['plz']}, {$_POST['ort']}, {$_POST['benutzername']}, {$_POST['passwort']}) ") or die(mysql_error());  
//mysql_query("INSERT INTO t_people (`firstname`,`lastname`,`username`,`password`) VALUES ('Amgad','Makar','amgad','1111111')")or die(mysql_error());
$sql="INSERT INTO t_people (firstname, lastname, street, house_nr, zip, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude, institution, prof_provider , image_path ) VALUES('$Vorname', '$Nachname',  '$strasse', '$Nr', '$plz', '$ort', '$Tel', '$handy', '$email', '$username', '$password', '$gen', '$Geb_datum', '$pre', '$stundenlohn', '$bemerkung', '$longitude', '$latitude', '$firma', '$prof_prov', '$imgn') ;" ;
  //$sql = "INSERT INTO t_people (firstname,lastname,username,password) VALUES ('$Vorname', '$Nachname', '$username', '$password');";
  mysql_query($sql)or die(mysql_error());

//mysql_query("INSERT INTO t_people (`firstname`,`lastname`,`username`,`password`) VALUES ($Vorname, $Nachname, $username, $password);"or die(mysql_error());
$sql="SELECT * FROM t_people WHERE username='$username'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1){


session_start();
$row=mysql_fetch_array($result);
$_SESSION['first_name'] = $row[firstname];
$_SESSION['last_name'] = $row[lastname];
$_SESSION['longitude'] = $row[longitude];
$_SESSION['latitude'] = $row[latitude];
$_SESSION['people_id'] = $row[people_id];
$_SESSION['auth'] = "yes";
header("location:settings2.php");
$j="";
}

//echo "<script language = 'javascript'>";
//echo "alert('Registration Successful')";
//echo "</script>" ;
//header("location:register1.php?al=$errors"); 
      
  } else { 
$j = $errors ;

//header("location:register2.php");   
   
  //echo $errors."Please go back and try again.";   
 //echo "<PRE>"; print_r( $tmp->locate() ); echo "</PRE>";
 //echo"{$coord["latitude"]} ,{$coord["longitude"]}";

  }  




}


//$m=$_GET['al'];


//$k=$_GET['im'];
//if($k <>"") 
//$im = "images/profile/" . $k ;
//else
//$im = "images/profile/no_picture_he.gif";
if($j<>"")
{
echo "<script language = 'javascript'>";
echo "alert('$j')";
//echo "alert('test')";
echo "</script>" ;
}
//start change
if(isset($_POST['prov']))
  $prof_prov = 1;
else
$prof_prov = 0;
if($_POST['Gechleht'] == "männlich") 
    $gen = 2;
if($_POST['Gechleht'] == "weiblich") 
    $gen = 1;
$username = $_POST['benutzername'];
$password = $_POST['passwort'];
$Vorname = $_POST['Vorname'];
$Nachname = $_POST['Nachname'];

$strasse = $_POST['strasse'];
$Nr = $_POST['Nr'];

$plz = $_POST['plz'];
$ort = $_POST['ort'];

$Tel = $_POST['Tel'];
$handy = $_POST['handy'];

$email = $_POST['email'];
$handy = $_POST['handy'];
list($day,$mon,$yr) = split('-',$_POST['Geb-datum']); 
$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum1 = $_POST['Geb-datum'];
$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = $_POST['Firma'];
if($_POST['vorzugs'] == "Handy") 
    $pre = 3;
if($_POST['vorzugs'] == "Festnetz") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;
$sql="SELECT * FROM t_zipch  WHERE ZIP='$plz'";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);


if ($count==1)
{


$ort=$row[Location];
$q = 10 ;
}else
$q = 1;




$sql="SELECT * FROM t_firstnames  WHERE firstname='$Vorname'";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if ($imgn=="")
list($f,$a,$imgn) = split('/',$_POST['imgn']);


if(($imgn == "no_picture_he.jpg") or ($imgn == "no_picture_she.jpg") )
//if(($imgn=="") And ($q==1)) 


{
if ($count==1)
{
if ($row[sex]=='M')
{
 $gen = 2;
$imgn="no_picture_he.jpg";
$im = "images/profile/" . $imgn ;
}
if ($row[sex]=='W')
{
 $gen = 1;
$imgn="no_picture_she.jpg";
$im = "images/profile/" . $imgn ;
}

}

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Register1</title>
<link href="style.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript"> 
function Change($x)
{
document.Form1.submit();
<?php
//session_start(); 
//$_SESSION['foo'] = $x; 
//include "include/session.php";
//include "include/z_db.php";
//$username="";
//$password="";
//$x=$_SESSION['foo'];


//$sql="SELECT * FROM t_firstnames  WHERE firstname='{$_SESSION['foo']}'";
//$sql="SELECT * FROM t_firstnames  WHERE firstname='$x'";
//$sql = 'SELECT * FROM `t_firstnames`'; 
//$sql = 'SELECT * FROM t_firstnames WHERE firstname=$x'; 

//$result=mysql_query($sql);
//$row=mysql_fetch_array($result);
//$count=mysql_num_rows($result);
//echo"document.getElementById('Nachname').value= $count;";
//echo"document.getElementById('Geb-datum').value= {$_SESSION['foo']};";
//for ( $counter = 0; $counter <= $count; $counter += 1) 
//{
//if ($_SESSION['foo']==$row[firstname][$counter])
//if ($x == "Aaltje")
//{
//echo"document.getElementById('Nachname').value=' {$_SESSION['foo']}';";
//$pos = strpos($x,$row[firstname][$counter]);
//if ($pos > 0)
//{
//echo"document.getElementById('Nachname').value= $x;";
//}
//if ($row[sex][$counter] == 'M')
//{
//echo"document.getElementById('Gechleht').options[0].selected= true;";
//echo"document.getElementById('Nachname').value= $x;";
//}
//if ($row[sex][$counter] == 'W')
//{
//echo"document.getElementById('Gechleht').options[1].selected= true;";
//echo"document.getElementById('Nachname').value= $x;";
//}

//}
//}  




//$w=$x;

?>


}
</script> 



</head>

<body class="all">
<script type="text/javascript" src="tooltips.js"></script>

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<input type=button value="Anmeldung" onclick=location.href="register1.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php" id="loginbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn">
  </div>
  <div class="mainContent">
	<div class="content">


		<span id="title">1) Persönliche Daten <img src="images/page1.png" align="right" /></span>
		<p style="margin-top: 0; margin-bottom: 3px">
<Table>
<tr>
<td>
<form method="post"  enctype="multipart/form-data" name="Form1" action="register1.php">
			
<label>Firma:
		      <input type="text" name="Firma" id="Firma" size="30" value="<?php echo"$firma";?>">
	        </label>
		</p>
<p style="margin-top: 0; margin-bottom: 3px">
<label>Verein, Organisation oder öffentliche Einrichtung:
                                <?php
                                 if($prof_prov == 1)
                        echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='checkbox' name='prov' checked >";
                        else
                         echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='checkbox' name='prov' >";
?>
</label>
		</p>
	    <p style="margin-top: 0; margin-bottom: 3px">
		    <label>Vorname:
		      <input type="text" name="Vorname" id="Vorname" value="<?php echo"$Vorname";?>" onBlur=javascript:Change(document.getElementById('Vorname').value) >
	      <span class="star">*</span> Nachname:
	          <input type="text" name="Nachname" id="Nachname" value="<?php echo"$Nachname";?>">
          	</label>
        <span class="star" id="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Geschlecht:
                         <?php 
             
           if( $gen== 1)
                                     {
	        echo"<select name='Gechleht' id='Gechleht' >";
	          echo"<option id='mannlich'>männlich</option>";
			  echo"<option Selected>weiblich</option>";
            echo"</select>";
                } else
{
        echo"<select name='Gechleht' id='Gechleht' >";
	          echo"<option id='mannlich'>männlich</option>";
			  echo"<option>weiblich</option>";
            echo"</select>";
}
?>
          <span class="star">*</span> Geb-datum:
	        <input type="text" name="Geb-datum"  title="Ihr Geburtsdatum wird nicht veröffentlicht. Wir können es aber z.B. einsetzen, um sicherzustellen, dass wirklich Sie anrufen (Authentifizierung). z.B. 31.05.1970" id="Geb-datum" value="<?php echo"$Geb_datum1";?>">
          </label>

        <span class="star">*</span></p>
	<p style="margin-top: 0; margin-bottom: 3px">

	      <label>Bild:
 
                                 <?php 
if($imgn <>"")
$im = "images/profile/" . $imgn ;
else
 if( $gen== 1)
$im = "images/profile/no_picture_she.jpg" ;
else
$im = "images/profile/no_picture_he.jpg" ;


?>

	        <input name="Bild" type="image" width="63" Height="84 " id="Bild" src="<?php echo"$im"; ?>" >
                             
<input type="hidden" name="imgn" value="<?php  echo"$im"; ?>">
<input type="hidden" name="imgn1" value="<?php  echo"$imgn"; ?>">
          </label>

      <span class="star">*</span> </p>    
<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="file" name="image_file" size="20"></p>
<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Upload Image" name="action"></p>

	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Strasse/Nr.
	        <input type="text" name="strasse" id="strasse" size="26" value="<?php echo"$strasse";?>">
            <input type="text" name="Nr" id="Nr" size="10" value="<?php echo"$Nr";?>">
	      </label>
        <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>PLZ/Ort:
	        <input type="text" name="plz" id="plz" size="11" value="<?php echo"$plz";?>" onBlur=javascript:Change(document.getElementById('plz').value)>
            <input type="text" name="ort" id="ort" size="25" value="<?php echo"$ort";?>">
          </label>
        <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Tel. P:
	        <input type="text" name="Tel" id="Tel" value="<?php echo"$Tel";?>">
          Handy:
	        <input type="text" title="Die Angabe der Handynummer ist notwendig. Falls Sie das Passwort vergessen stellen wir Ihnen dieses per SMS zu. Wenn Sie keine Handynummer haben, geben Sie hier die Handynummer von einem vertrauenswürdigen Menschen ein, der Ihnen nahesteht." name="handy" id="handy" value="<?php echo"$handy";?>">
          </label>
        <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>E-mail:
	        <input type="text" name="email" id="email" value="<?php echo"$email";?>">
          </label>
      <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Vorzugs-<br />Kontaktart:
<?php
	if((( $pre<>1) and ( $pre<>2))or( $pre==3))
{
       echo" <select name='vorzugs' id='vorzugs'>";
	          echo"<option>Handy</option>";
                  echo"<option>Email</option>";
                  echo"<option>Festnetz</option>";
            echo"</select>";
}
	if( $pre==1) 
{
       echo" <select name='vorzugs' id='vorzugs'>";
	          echo"<option>Handy</option>";
                  echo"<option selected >Email</option>";
                  echo"<option>Festnetz</option>";
            echo"</select>";
}
	if( $pre==2) 
{
       echo" <select name='vorzugs' id='vorzugs'>";
	          echo"<option>Handy</option>";
                  echo"<option >Email</option>";
                  echo"<option selected>Festnetz</option>";
            echo"</select>";
}
 
?>      
   </label>
      <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Benutzer-<br />name:
	        <input type="text" name="benutzername" id="benutzername" value="<?php  echo"$username ";?>">
          Passwort:
	        <input type="password" name="passwort" id="passwort" value="<?php echo"$password";?>">
          </label>
        <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Stunden-<br />lohn:
	        <input type="text" name="stundenlohn" id="stundenlohn" size="11" value="<?php echo"$stundenlohn ";?>">
          Fr.</label>
        </p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Bemerkung:
	        <textarea name="bemerkung" cols="45" id="bemerkung" value="<?php echo "$bemerkung";?>"></textarea>
	      </label>
	    </p>
	    <p>
	        <input type="submit" name="nextbtn" id="nextbtn" value="Weiter zur zeitlichen Verfügbarkeit (2 von 5)" onclick=location.href="register2.html" />
	    </p>
		<p>&nbsp;</p>
            </form>
</td>
<td>

</td>
</tr>
</table>
	</div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
