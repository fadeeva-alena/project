<?PHP    
  include "include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "include/z_db.php";
 include("geocode.class.php");
switch (@$_POST['Submit'])
{
case "Upload Image":
 include "include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "include/z_db.php";

unset($imagename);

if(!isset($_FILES) && isset($HTTP_POST_FILES))
$_FILES = $HTTP_POST_FILES;

if(!isset($_FILES['image_file']))
$error["image_file"] = "An image was not found.";


$imagename = basename($_FILES['image_file']['name']);
//echo $imagename;

if(empty($imagename))
$error["imagename"] = "The name of the image was not found.";

if(empty($error))
{
$newimage = "images/profile/" . $imagename;
//echo $newimage;
$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
if(empty($result))
{
$error["result"] = "There was an error moving the uploaded file.";
}
else
$k=$imagename;
$imgn=$imagename;
$sql="UPDATE t_people SET image_path ='$imgn' WHERE people_id ={$_SESSION['people_id']}";
}
header("location:register1.php?al=''"); 
breack;




case "Weiter zur zeitlichen Verfügbarkeit (2 von 5)":
  include "include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "include/z_db.php";
 include("geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw ";

   $gen = 2;
   $pre = 3;

  $errors = "";  
if($_POST['Vorname'] == "")
    $errors .= "Please provide a Vorname.";  
if($_POST['Nachname'] == "")  
    $errors .= "Please provide a Nachname. ";   
if($_POST['Gechleht'] == "")  
    $errors .= "Please provide a Gechleht. "; 
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
    $errors .= "Please provide a Geb-datum. ";  
if($_POST['strasse'] == "")  
    $errors .= "Please provide a strasse. "; 
if($_POST['Nr'] == "")  
    $errors .= "Please provide a Nr. "; 
if($_POST['plz'] == "")  
    $errors .= "Please provide a plz. "; 
if($_POST['ort'] == "")  
    $errors .= "Please provide a ort. ";
if($_POST['Tel'] == "")  
    $errors .= "Please provide a Tel. ";
if($_POST['handy'] == "")  
    $errors .= "Please provide a handy. ";
if($_POST['email'] == "")  
    $errors .= "Please provide a email. ";
if($_POST['passwort'] == "")  
    $errors .= "Please provide a password. ";
if(strlen ($_POST['passwort']) < 5)  
    $errors .= "Please provide a password length 5 Char.";
if($_POST['benutzername'] == "")  
    $errors .= "Please provide a benutzername. ";
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
 $errors .= "User Name already exist please chose another user name. ";
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
 $errors .=" Please Type Vaild address";

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
$Geb_datum = $_POST['Geb-datum'];

$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$sql="UPDATE t_people SET firstname ='$Vorname', lastname = '$Nachname', street = '$strasse', house_nr = '$Nr', zip = '$plz', location = '$ort', tel_p = '$Tel', tel_m = '$handy', email = '$email', username = '$username', password = '$password', gender = '$gen', birthdate = '$Geb_datum', preferred_contact_by = '$pre', price_per_hour = '$stundenlohn', note = '$bemerkung', longitude = '$longitude', latitude = '$latitude' WHERE people_id ={$_SESSION['people_id']}";



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
}

//echo "<script language = 'javascript'>";
//echo "alert('Registration Successful')";
//echo "</script>" ;
//header("location:register1.php?al=$errors"); 
      
  } else { 
//echo "<script language = 'javascript'>";
//echo "alert('+$errors+')";
//echo "</script>" ;
header("location:settings1.php?al=$errors");   
   
  //echo $errors."Please go back and try again.";   
 //echo "<PRE>"; print_r( $tmp->locate() ); echo "</PRE>";
 //echo"{$coord["latitude"]} ,{$coord["longitude"]}";

  }   
breack;
}
?> 
