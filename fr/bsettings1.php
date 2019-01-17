<? ob_start(); ?>
<?php
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
$j=$errors;

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

$sql="UPDATE t_people SET image_path ='$imgn' WHERE people_id ={$_SESSION['people_id']}";
  mysql_query($sql)or die(mysql_error());
}
}


if($_POST["submit"] == "Weiter zur zeitlichen Verfügbarkeit (2 von 5)")
{
 include "include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "include/z_db.php";
 include("geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw ";

   $gen = 2;
   $pre = 3;
$Nv = $_POST['Nv'];
  $errors = "";  
$errors = "";  
if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
 $errors .= "Bitte geben Sie den Namen Ihres Vereins, Ihrer Organisation oder öffentlichen Einrichtung ein.";  
$prof_prov = 1;
} else
$prof_prov = 0;
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

if($_POST['strasse'] == "")  
    $errors .= "Bitte geben Sie uns noch die Strasse an, in der Sie wohnen"; 
if($_POST['Nr'] == "")  
    $errors .= "Bitte geben Sie uns noch die Hausnummer an. "; 
if($_POST['plz'] == "")  
    $errors .= "Bitte geben Sie noch die PLZ Ihres Wohnortes ein. "; 
if($_POST['ort'] == "")  
    $errors .= "Bitte geben Sie noch Ihren Wohnort an.    ";
if($_POST['Tel'] == "")  
    $errors .= "Bitte füllen Sie noch Ihre Telefonnummer (Festanschluss) aus.";
if($_POST['handy'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Handynummer an. ";
if(($_POST['handy'][0] <> "0") or   ($_POST['handy'][3] <> " ") or ($_POST['handy'][7] <> " ")or ($_POST['handy'][10] <> " "))
    $errors.= "Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)"; 
if($_POST['email'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Email-Adresse an. ";
if($_POST['passwort'] == "")  
    $errors .= "Bitte geben Sie noch ein Passwort für Ihr Anmeldung bei ManiMano. ";
if(strlen ($_POST['passwort']) < 5)  
    $errors .= "Das Passwort muss mindestens 5 Buchstaben lang sein.";
if($_POST['benutzername'] == "")  
    $errors .= "Bitte geben Sie noch Ihren gewünschten Benutzernamen an. ";
$myusername = $_POST['benutzername'];
$sql="Select * From t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if ($myusername <> $row['username'])
{
$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1)
 $errors .= "Der Benutzername existiert schon, bitte wählen Sie einen andern.";
}
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

  if ($errors == "") {   
//mysql_query("INSERT INTO t_people (`firstname`, `lastname`, `street`, `house_nr`, `zip`, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude) VALUES({$_POST['Vorname']}, {$_POST['Nachname']},  {$_POST['strasse']}, {$_POST['Nr']}, {$_POST['plz']}, {$_POST['ort']}, {$_POST['Tel']}, {$_POST['handy']}, {$_POST['email']}, {$_POST['benutzername']}, {$_POST['passwort']}, $gen, {$_POST['Geb-datum']}, $pre, {$_POST['stundenlohn']}, {$_POST['bemerkung']}, $longitude, $latitude) ") or die(mysql_error());  
//mysql_query("INSERT INTO t_people (`firstname`, `lastname`, `street`, `house_nr`,`zip`, `location`, `username`, `password`) VALUES({$_POST['Vorname']}, {$_POST['Nachname']},  {$_POST['strasse']}, {$_POST['Nr']}, {$_POST['plz']}, {$_POST['ort']}, {$_POST['benutzername']}, {$_POST['passwort']}) ") or die(mysql_error());  
//mysql_query("INSERT INTO t_people (`firstname`,`lastname`,`username`,`password`) VALUES ('Amgad','Makar','amgad','1111111')")or die(mysql_error());
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

//$Geb_datum = $_POST['Geb-datum'];
//list($day,$mon,$yr) = split('-',$_POST['Geb-datum']); 
$Geb_datum = $intYear.".".$intMonth.".".$intDay;




$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = $_POST['Firma'];

$sql="UPDATE t_people SET firstname ='$Vorname', lastname = '$Nachname', street = '$strasse', house_nr = '$Nr', zip = '$plz', location = '$ort', tel_p = '$Tel', tel_m = '$handy', email = '$email', username = '$username', password = '$password', gender = '$gen', birthdate = '$Geb_datum', preferred_contact_by = '$pre', price_per_hour = '$stundenlohn', note = '$bemerkung', longitude = '$longitude', latitude = '$latitude' , institution= '$firma',  prof_provider = '$prof_prov'  WHERE people_id ={$_SESSION['people_id']}";



//$sql="INSERT INTO t_people (firstname, lastname, street, house_nr, zip, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude) VALUES('$Vorname', '$Nachname',  '$strasse', '$Nr', '$plz', '$ort', '$Tel', '$handy', '$email', '$username', '$password', '$gen', '$Geb_datum', '$pre', '$stundenlohn', '$bemerkung', '$longitude', '$latitude') ;" ;
  //$sql = "INSERT INTO t_people (firstname,lastname,username,password) VALUES ('$Vorname', '$Nachname', '$username', '$password');";
  mysql_query($sql)or die(mysql_error());

//mysql_query("INSERT INTO t_people (`firstname`,`lastname`,`username`,`password`) VALUES ($Vorname, $Nachname, $username, $password);"or die(mysql_error());
$sql="SELECT * FROM t_people WHERE username='$myusername'";
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
//echo "<script language = 'javascript'>";
//echo "alert('+$errors+')";
//echo "</script>" ;
$j=$errors;
   
  //echo $errors."Please go back and try again.";   
 //echo "<PRE>"; print_r( $tmp->locate() ); echo "</PRE>";
 //echo"{$coord["latitude"]} ,{$coord["longitude"]}";

  } 



}

//$j=$_GET['al'];

if ($j <> "")
{

echo "<script language = 'javascript'>";
////echo "alert('test')";
echo "alert(' $j ')";

echo "</script>" ;

}

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
function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.submit.click(); 

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
	<input type=button value="Meine Daten"  id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php?kinder=1&type=0&gender=2" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">1) Persönliche Daten </span><img src="images/page1.png" border="0"  usemap="#green" align="right" />
<map name="green">
<area shape="rect"  coords="43,8,62,32" href="javascript:Nav(2);">
<area shape="rect"  coords="63,8,78,32" href="javascript:Nav(3);">
<area shape="rect"  coords="80,6,94,33" href="javascript:Nav(4);">
<area shape="rect"  coords="95,7,111,33" href="javascript:Nav(5);>

</map>
<p style="margin-top: 0; margin-bottom: 3px">
<Table>
<tr>
<td>
</p>
	
<form method="post"  enctype="multipart/form-data" id="form1" name="Form1" action="bsettings1.php">

			<label>Firma:
		      <input type="text" name="Firma" id="Firma" size="30" Value="<?php echo"$row[institution]";?>" >
	        </label>
<p style="margin-top: 0; margin-bottom: 3px">		
<label>Verein, Organisation oder öffentliche Einrichtung:
                                <?php
                                 if($row['prof_provider'] == 1)
                        echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='checkbox' name='prov' checked >";
                        else
                         echo"&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type='checkbox' name='prov' >";
?>
</label>
</p>
	 <p style="margin-top: 0; margin-bottom: 3px">
		    <label>Vorname:
		      <input type="text" name="Vorname" id="Vorname"  Value="<?php echo"$row[firstname]"; ?>" />
	      
          <span class="star">*</span> Nachname:
	          <input type="text" name="Nachname" id="Nachname" Value="<?php echo"$row[lastname]"; ?>"  />
          </label>
	        <span class="star" id="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Geschlecht:
<?php if ($row['gender'] == 1)
                 {
	        echo "<select name='Gechleht' id='Gechleht'>";
                echo "<option id='mannlich'>männlich</option>";
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
          <span class="star">*</span>Geb-datum:
  <?php
list($yr,$mon,$day) = split('-',$row['birthdate']); 
$b=$day.".".$mon.".".$yr;
?>

	        <input type="text" name="Geb-datum" id="Geb-datum" Value="<?php echo"$b"; ?>"/>
          </label>
	  <span class="star">*</span></p>
	<p style="margin-top: 0; margin-bottom: 3px">
	      <label>Bild:
	        <input type="image" name="Bild" id="Bild" src=<?php echo"'images/profile/{$row['image_path']}'";echo "width=63 Height=84" ; ?> />
          </label>
<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="file" name="image_file" size="20"></p>
<p>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="submit" value="Upload Image" name="action"></p>

	    </p>
	  <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Strasse/Nr.
	        <input type="text" name="strasse" id="strasse" size="26" Value="<?php echo"$row[street]"; ?>" />
        
	        <input type="text" name="Nr" id="Nr" size="10"  Value="<?php echo"$row[house_nr]"; ?> "/>
	      </label>
	  <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>PLZ/Ort:
	        <input type="text" name="plz" id="plz" size="11" Value="<?php echo"$row[zip]"; ?> " />
          
	        <input type="text" name="ort" id="ort" size="25" Value="<?php echo"$row[location]"; ?> "/>
          </label>
	       <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 0px">
	      <label>Tel. P:
	        <input type="text" name="Tel" id="Tel" Value="<?php echo"$row[tel_p]"; ?>" />
         
	      <label>Handy:
	        <input type="text" name="handy" id="handy"  Value="<?php echo"$row[tel_m]"; ?>" />
          </label>
	   <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 0px">
	      <label>E-mail:
	        <input type="text" name="email" id="email" Value="<?php echo"$row[email]"; ?>" />
          </label>
	 <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
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
	    <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Benutzer-<br />name:
	        <input type="text" name="benutzername" id="benutzername" Value="<?php echo"$row[username]"; ?>" />
          Passwort:
	        <input type="password" name="passwort" id="passwort" Value="<?php echo"$row[password]"; ?>" />
          </label>
	    <span class="star">*</span></p>
	    <p style="margin-top: 0; margin-bottom: 3px">
	      <label>Stunden-<br />lohn:
	        <input type="text" name="stundenlohn" id="stundenlohn" size="11" Value="<?php echo"$row[price_per_hour]"; ?>"  />
          Fr.</label>
        </p>
	    <p>
	      <label>Bemerkung:
	        <textarea name="bemerkung" cols="45" id="bemerkung"></textarea>
	      </label>
	    </p>
	    <p>
<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">
	      <label>
	        <input type="submit" name="submit" id="nextbtn" value="Weiter zur zeitlichen Verfügbarkeit (2 von 5)" onclick=location.href="settings2.php" />
          </label>
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

