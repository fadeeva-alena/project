<?PHP    
  include "include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "include/z_db.php";
 include("geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw";

   $gen = 2;
   $pre = 3;

  $errors = "";  
if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
 $errors .= "Please Provide Firma.";  
$prof_prov = 1;
} else
$prof_prov = 0;
if($_POST['imgn'] == " ")
    {
if($_POST['Gechleht'] == "mnnlich") 
$imgn="no_picture_he.jpg";
if($_POST['Gechleht'] == "weiblich") 
$imgn="no_picture_she.jpg";
}else
$imgn=$_POST['imgn'] ;
if($_POST['Vorname'] == "")
    $errors .= "Bitte geben sie Ihren Vornamen ein.";  
if($_POST['Nachname'] == "")  
    $errors .= "Bitte geben sie Ihren Nachnamen ein. ";   
if($_POST['Gechleht'] == "")  
    $errors .= "Bitte wählen Sie Ihr Geschlecht. "; 
if($_POST['Gechleht'] == "mnnlich") 
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
    $errors .= "Bitte geben Sie Ihr Geburtsdatum an. ";  
if(($_POST['Geb-datum'][2] <> "-")  or ($_POST['Geb-datum'][5] <> "-"))
     $errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31-12-1970) / use dd-mm-yyyy";
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
if(($_POST['handy'][0] <> "0") or   ($_POST['handy'][3] <> " ") or ($_POST['handy'][7] <> " "))
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
list($day,$mon,$yr) = split('-',$_POST['Geb-datum']); 
$Geb_datum = $yr."-".$mon."-".$day;
$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = $_POST['Firma'];

$sql="INSERT INTO t_people (firstname, lastname, street, house_nr, zip, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude, institution, prof_provider , image_path ) VALUES('$Vorname', '$Nachname',  '$strasse', '$Nr', '$plz', '$ort', '$Tel', '$handy', '$email', '$username', '$password', '$gen', '$Geb_datum', '$pre', '$stundenlohn', '$bemerkung', '$longitude', '$latitude', '$firma', '$prof_prov', '$imgn') ;" ;
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
}

//echo "<script language = 'javascript'>";
//echo "alert('Registration Successful')";
//echo "</script>" ;
//header("location:register1.php?al=$errors"); 
      
  } else { 
//echo "<script language = 'javascript'>";
//echo "alert('+$errors+')";
//echo "</script>" ;
header("location:register1.php?al=$errors");   
   
  //echo $errors."Please go back and try again.";   
 //echo "<PRE>"; print_r( $tmp->locate() ); echo "</PRE>";
 //echo"{$coord["latitude"]} ,{$coord["longitude"]}";

  }   
?> 
