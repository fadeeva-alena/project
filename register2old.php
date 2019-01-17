<? ob_start(); ?>
<?php
include "include/session.php";
include "include/z_db.php";
include "include/class.upload.php";
$plz=$_GET['zip']; 
$ort=$_GET['location']; 
if($_POST["action"] == "Upload Image")
{
unset($imagename);

if(!isset($_FILES) && isset($HTTP_POST_FILES))
$_FILES = $HTTP_POST_FILES;

if(!isset($_FILES['image_file']))
$error["image_file"] = "An image was not found.";


$imagename = basename($_FILES['image_file']['name']);
//echo $imagename;https://rigi.webhostings.ch:8443/

if(empty($imagename))
$error["imagename"] = "The name of the image was not found.";


if (!($_FILES['image_file']['type'] =="image/jpeg" OR $_FILES['image_file']['type'] =="image/gif" OR $_FILES['image_file']['type'] =="image/pjpeg"))
$error="Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";



if(empty($error))
{

$newimage = "http://www.manimano.ch/images/profile/" . $imagename;




//$size = getimagesize($newimage );
//$size = getimagesize($n1);
//$x=$size[0];
 //$y=$size[1];




//$handle = new upload($_FILES['image_file']);
 //if ($handle->uploaded) {

  //$handle->image_resize         = true;
//$r = $x/$y;
//if ($r > 0.75)
//{
 //$handle->image_x              = 63;
//$handle->image_y             = 63/$r;
//}else
//{
 //$handle->image_y              = 84;
//$handle->image_x             = 84*$r;
//}


// $handle->image_ratio_y        = true;
 // $handle->process('images/profile/');
  //if ($handle->processed) {
    //    echo 'image resized';
     //    $handle->clean();
//$k=$imagename;
//$imgn=$imagename;
  //   } else {
//$k="";
//$imgn="";
 //          echo 'error : ' . $handle->error;
   //  }
  //}
$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
if(empty($result))
{
//$error["result"] = "There was an error moving the uploaded file.";
$k="";
$imgn="";
}
else
$k=$imagename;
$imgn=$imagename;


}



//$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
if(isset($_POST['prov']))
  $prof_prov = 1;
else
$prof_prov = 0;
if($_POST['Gechleht'] == "männlich") 
    $gen = 2;
if($_POST['Gechleht'] == "weiblich") 
    $gen = 1;
$username = trim($_POST['benutzername']);
$password = trim($_POST['passwort']);
$Vorname = trim($_POST['Vorname']);
$Nachname = trim($_POST['Nachname']);

$strasse = trim($_POST['strasse']);
$Nr = trim($_POST['Nr']);

$plz = trim($_POST['plz']);
$ort = trim($_POST['ort']);

$Tel = trim($_POST['Tel']);
//start change for cell phone 
$Tel  = preg_replace('/\D/', '', $Tel );
if(strlen ($Tel) == 10)  
{
$Tel  = $Tel[0].$Tel[1].$Tel[2].' '.$Tel[3].$Tel[4].$Tel[5].' '.$Tel[6].$Tel[7].' '.$Tel[8].$Tel[9];
}


$handy = trim($_POST['handy']);
//start change for cell phone 
$handy  = preg_replace('/\D/', '', $handy );
if(strlen ($handy) == 10)  
{
$handy  = $handy[0].$handy[1].$handy[2].' '.$handy[3].$handy[4].$handy[5].' '.$handy[6].$handy[7].' '.$handy[8].$handy[9];
}



//end
$email = trim($_POST['email']);
$handy = trim($_POST['handy']);
list($day,$mon,$yr) = preg_split('/-/',trim($_POST['Geb-datum'])); 
$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum1 = $_POST['Geb-datum'];
$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = trim($_POST['Firma']);
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
$im = "http://www.manimano.ch/images/profile/" . $imgn ;
}
if($_POST["nextbtn"] == "Speichern und weiter zur zeitlichen Verfügbarkeit (2 von 6)")

{

 include "include/session.php";
include "include/z_db.php";
 include("geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ";

 

  $errors = "";  




	
// validation new start 


$telats = $_POST['Vorname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚäöüÖÜÄãõÃÕ' ]*$#", $telats))

$errors .= "error.";  


$telats = $_POST['Nachname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚäöüÖÜÄãõÃÕ' ]*$#", $telats))
$errors .= "error.";  



	


$d=trim($_POST['Geb-datum']); 

    if ((preg_match("/^(\d)\.(\d)\.(\d{4})$/", $d, $matches)) or (preg_match("/^(\d{2})\.(\d{2})\.(\d{4})$/", $d, $matches))or (preg_match("/^(\d)\.(\d{2})\.(\d{4})$/", $d, $matches))or (preg_match("/^(\d{2})\.(\d)\.(\d{4})$/", $d, $matches)))
{
$toc = 1;
}
else
{
$toc = 0;
$errors .= "error.";  
}

$d=trim($_POST['Geb-datum']); 
list($iday,$imonth,$iyear) = explode(".",$d); 
$year_diff = date("Y") - $iyear; 
$month_diff = date("m") - $imonth; 
$day_diff = date("d") - $iday; 
if ($day_diff < 0 or $month_diff < 0) 
$year_diff--; 
if (($year_diff < 0 ) or ($year_diff > 150 ))
{
$errors .= "error.";  

}




$d=trim($_POST['Geb-datum']); 
if ($d <> "")
{
list($intDay,$intMonth,$intYear) = explode(".",$d); 
if ( $toc == 1)
 if (!checkdate($intMonth, $intDay, $intYear)) 
{
$errors .= "error.";  

}
}

$Tel = $_POST['Tel'];
//start change for te;; phone 
$Tel  = preg_replace('/\D/', '', $Tel );
if(strlen ($Tel) == 10)  
{
$Tel  = $Tel[0].$Tel[1].$Tel[2].' '.$Tel[3].$Tel[4].$Tel[5].' '.$Tel[6].$Tel[7].' '.$Tel[8].$Tel[9];
} else 
{
	$errors .= "error.";  

}



	
	


if(($Tel[0] <> "0") or   ($Tel[3] <> " ") or ($Tel[7] <> " ")or ($Tel[10] <> " "))
{
$errors .= "error.";  

}


$handy = $_POST['handy'];
//start change for cell phone 









$hrrate=trim($_POST['stundenlohn']);
if ($hrrate<>"")
if(is_numeric($hrrate)) 
{
if ($hrrate < 0)
{

$errors .= "error.";  

}
} else
{

$errors .= "error.";  

}


 $pattern = "%^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$%"; 
      $email = trim($_POST['email']);
      if (!preg_match($pattern, $email)){ 
$errors .= "error.";  
}




//validation new end 


if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
 $errors .= "Bitte geben Sie den Namen Ihres Vereins, Ihrer Organisation oder öffentlichen Einrichtung ein.";  
$prof_prov = 1;
} else
$prof_prov = 0;
list($f,$a,$imgn) = preg_split("%/%",$_POST['imgn']);
if(($imgn == "no_picture_he.jpg") or ($imgn == "no_picture_she.jpg") )
  {
if($_POST['Gechleht'] == "männlich") 
$imgn="no_picture_he.jpg";
if($_POST['Gechleht'] == "weiblich") 
$imgn="no_picture_she.jpg";
}
$im = "http://www.manimano.ch/images/profile/" . $imgn ;
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

//if($_POST['Geb-datum'] == "")  
//{
   // $errors .= "Bitte geben Sie Ihr Geburtsdatum an. ";  
//$errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) / use dd.mm.yyyy";
//}
//start change
//else
//{
//$d=date('d.m.Y', strtotime($_POST['Geb-datum'])); 
//$arrDate = explode(".", $_POST['Geb-datum']); // break up date by slash
//$intDay = $arrDate[0];
//$intMonth = $arrDate[1];
//$intYear = $arrDate[2];
 
//$intIsDate = checkdate($intMonth, $intDay, $intYear);    
 //if(!$intIsDate)
    // {

//$errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) / use dd.mm.yyyy";
//}
//}
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


if($_POST['email'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Email-Adresse an.";
if($_POST['passwort'] == "")  
    $errors .= "Bitte geben Sie noch ein Passwort für Ihr Anmeldung bei ManiMano.";
if(strlen ($_POST['passwort']) < 5)  
    $errors .= "Das Passwort muss mindestens 5 Buchstaben lang sein.";
if($_POST['benutzername'] == "")  
    $errors .= "Bitte geben Sie noch Ihren gewünschten Benutzernamen an.";
$myusername = trim($_POST['benutzername']);
$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1)
 $errors .= "Der Benutzername existiert schon, bitte wählen Sie einen andern.";
//$tmp = new geocode( " ", "laengistr.", "12" , "switzerland", "Egg", "8132" );
// $coord = $tmp->locate();
//$errors.=$coord["longitude"] ;
// Desired address
   $address = str_replace( " ", "+","http://maps.googleapis.com/maps/api/geocode/xml?sensor=false&address={$_POST['strasse']}+{$_POST['Nr']}+,+{$_POST['plz']}+{$_POST['ort']}");

   $xml = simplexml_load_file($address) or die("url not loading");

$latitude = $xml->result->geometry->location->lat; // v3
$longitude = $xml->result->geometry->location->lng; // v3

// Output the coordinates
//echo "Longitude: $longitude, Latitude: $latitude";
if (($longitude==Null) or ($latitude==Null))
 $errors .=" Bitte geben Sie eine gültige Adresse an.";
 $username = trim($_POST['benutzername']);
$password = trim($_POST['passwort']);
$Vorname = trim($_POST['Vorname']);
$Nachname = trim($_POST['Nachname']);

$strasse = trim($_POST['strasse']);
$Nr = trim($_POST['Nr']);

$plz = trim($_POST['plz']);
$ort = trim($_POST['ort']);

$Tel = trim($_POST['Tel']);
$Tel   = preg_replace('/\D/', '', $Tel );

if(strlen ($Tel) == 10)  
{
$Tel  = $Tel[0].$Tel[1].$Tel[2].' '.$Tel[3].$Tel[4].$Tel[5].' '.$Tel[6].$Tel[7].' '.$Tel[8].$Tel[9];
}

$handy = trim($_POST['handy']);
//start change for cell phone 
$handy  = preg_replace('/\D/', '', $handy );
if(strlen ($handy) == 10)  
{
$handy  = $handy[0].$handy[1].$handy[2].' '.$handy[3].$handy[4].$handy[5].' '.$handy[6].$handy[7].' '.$handy[8].$handy[9];
}



//end

$email = trim($_POST['email']);
//$handy = trim($_POST['handy']);

$Geb_datum = $intYear.".".$intMonth.".".$intDay;

$Geb_datum1 = trim($_POST['Geb-datum']);
$stundenlohn = trim($_POST['stundenlohn']);
$bemerkung = trim($_POST['bemerkung']);

$firma = trim($_POST['Firma']);

if ($errors == "") {   

//start


$sql="SELECT * FROM _taccess  WHERE Zip='$plz' And Location='$ort'";
 $result1=mysql_query($sql);  
$row1=mysql_fetch_array($result1);

$z1=$row1[zip_area];

$sql="SELECT * FROM _taccess  WHERE Zip='$z1'";
 $result2=mysql_query($sql);  
$row2=mysql_fetch_array($result2);
$l1=$row2[Location];
//end


$sql="INSERT INTO t_people (firstname, lastname, street, house_nr, zip, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude, institution, prof_provider , image_path , locationarea) VALUES('$Vorname', '$Nachname',  '$strasse', '$Nr', '$plz', '$ort', '$Tel', '$handy', '$email', '$username', '$password', '$gen', '$Geb_datum', '$pre', '$stundenlohn', '$bemerkung', '$longitude', '$latitude', '$firma', '$prof_prov', '$imgn' , '$l1') ;" ;
  mysql_query($sql)or die(mysql_error());

$myusername1 = trim($_POST['benutzername']);
$sql="SELECT * FROM t_people WHERE username='$myusername1'";
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
$_SESSION['location'] = $row[location];
$active = $row[Active];
$_SESSION['auth'] = "yes";
$_SESSION['user']=$myusername1;
header("location:test.php?myusername=$myusername1");

//header("location:settings2.php");
$j="";
}


      
  } else { 
$j = $errors ;

//$firma =$errors ;


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
//echo "alert('$j')";

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
$username = trim($_POST['benutzername']);
$password = trim($_POST['passwort']);
$Vorname = trim($_POST['Vorname']);
$Nachname = trim($_POST['Nachname']);

$strasse = trim($_POST['strasse']);
$Nr = trim($_POST['Nr']);

$plz = trim($_POST['plz']);
$ort = trim($_POST['ort']);

$Tel = trim($_POST['Tel']);
$Tel  = preg_replace('/\D/', '', $Tel );
if(strlen ($Tel) == 10)  
{
$Tel  = $Tel[0].$Tel[1].$Tel[2].' '.$Tel[3].$Tel[4].$Tel[5].' '.$Tel[6].$Tel[7].' '.$Tel[8].$Tel[9];
}
$handy =trim( $_POST['handy']);
$err1 = trim($_POST['err1']);
$email = trim($_POST['email']);
$handy =trim( $_POST['handy']);
//start change for cell phone 
$handy  = preg_replace('/\D/', '', $handy );
if(strlen ($handy) == 10)  
{
$handy  = $handy[0].$handy[1].$handy[2].' '.$handy[3].$handy[4].$handy[5].' '.$handy[6].$handy[7].' '.$handy[8].$handy[9];
}



//end
list($day,$mon,$yr) = preg_split("/-/",trim($_POST['Geb-datum'])); 
$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum1 = trim($_POST['Geb-datum']);
$stundenlohn = trim($_POST['stundenlohn']);
$bemerkung = trim($_POST['bemerkung']);

$firma = trim($_POST['Firma']);

if($_POST['vorzugs'] == "Handy") 
    $pre = 3;
if($_POST['vorzugs'] == "Festnetz") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;
$da1 =strtotime(date("m.d.y")) ;
if ($plz<>"")
{
$sql="SELECT * FROM _taccess  WHERE Zip='$plz' And Location='$ort'";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);


if ($count==1)
{

$da2 = $row[End];
$da2 = strtotime($da2);
if ($da1 < $da2)
{
$ort=$row[Location];
$q = 10 ;
}
else 
{
echo '<script language="javascript">confirm("Ihre Wohngemeinde/-stadt hat ManiMano leider nicht weiter lizenziert. ManiMano kann nur eingesetzt werden, falls es von Ihrer Wohngemeinde lizenziert wird.")</script>';
echo'<script language="javascript">window.location = "http://www.manimano.ch/index.php"</script>';
//header("location:index.php");

}
}
else
{
echo '<script language="javascript">confirm("Danke für Ihr Interesse an ManiMano. Im Moment hat Ihre Wohngemeinde/-stadt ManiMano noch nicht freigeschaltet. ManiMano kann nur eingesetzt werden, falls es von Ihrer Wohngemeinde/-stadt lizenziert wird")</script>';


echo'<script language="javascript">window.location = "http://www.manimano.ch/index.php"</script>';


//header("location:index.php");
$q = 1;
}
}


$sql="SELECT * FROM t_firstnames  WHERE firstname='$Vorname'";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if ($imgn=="")
list($f,$a,$imgn) = preg_split("%/%",$_POST['imgn']);


if(($imgn == "no_picture_he.jpg ") or ($imgn == "no_picture_she.jpg ") )
//if(($imgn=="") And ($q==1)) 


{
if ($count==1)
{
if ($row[sex]=='M')
{
 $gen = 2;
$imgn="no_picture_he.jpg";
$im = "http://www.manimano.ch/images/profile/" . $imgn ;
}
if ($row[sex]=='W')
{
 $gen = 1;
$imgn="no_picture_she.jpg";
$im = "http://www.manimano.ch/images/profile/" . $imgn ;
}

}

}
if ($plz=='')
{
$plz=$_GET['zip']; 
$ort=$_GET['location']; 
}
//$firma =$errors ;
?>
<?php require('header.php'); ?>
	<div id="contentIndex">
		<h1 id="title">1) Persönliche Daten <img src="images/page.png" align="right" /></h1>
		<p style="margin-top: 0; margin-bottom: 3px">
    <div id="loading" style="display:none ;background-color: #6593cf; top: 100px;   left: 100px;">   <img id="loading-image"  style=" position: absolute;  top:300px;   left: 240px;"   src="../images/ajax-loader.gif" alt="Loading..." /> </div> 
<div id="date" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Ihr Geburtsdatum wird nicht veröffentlicht.<br />Wir können es aber z.B. einsetzen, um<br />sicherzustellen, dass wirklich Sie anrufen<br />(Authentifizierung).</div>
<div id="handy1" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Die Angabe der Handynummer ist<br />notwendig. Falls Sie das Passwort<br />vergessen wir lhnen dieses per SMS zu.</div>
<div id="vorg" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Hier können sie angeben, wie sie am <br />Liebsten erreicht werden können</div>
<div id="student" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Hier können Sie lhren gewünschten <br />Stundenlohn eingeben. Wir schlagen 19.-/<br />Stunde für unqualifizierte Arbeiten vor<br />(ohne entsp. Ausbildung).</div>
<div id="pass" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Sie können einen Benutzernamen wählen. <br />Wir prüfen, ob er noch frei ist. <br />Wir schlagen Vorname. Nachname. Ort vor, <br />z.B. David.Schlaepfer.Egg</div>
<div id="bemerkung1" onKeyDown="" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Die Bemerkung, welche Sie hier eingeben <br />wird bei in der Trefferliste mitangezeigt. <br />Ideal z.B. für Einschränkungen oder <br />zusätzliche Angaben / Qualifizierungen.</div>
<div id="avatar" style="position:absolute; top:500px; left:800px; width:300px; color:#fff; display:none;">Wenn man Sie noch nicht kennt, fasst man viel leicht Vertrauen zu Ihnen, wenn Sie hier ein schönes Bild hinterlegen - und man erkennt Sie wieder, auch wenn man Ihren Namen nicht kennt (Pflicht).</div>
<form method="post"  enctype="multipart/form-data" name="Form1" id="Form1" action="register1.php" onsubmit=document.getElementById("loading").style.display="block";document.getElementById("Form1").style.display="none";document.getElementById("order").value = 3;  >
  <div class="row">
    <div class="col-md-4">Firma:</div>
    <div class="col-md-4"><input type="text" name="Firma" id="Firma" size="30" value="<?php echo"$firma";?>" tabindex="1"></div>
    <div class="col-md-4"><div style="text-align:right; color:#fff;">* Diese Angaben sind notwendig</div></div>
  </div>
  <div class="row">
    <div class="col-md-4">Verein, Organisation oder öffentliche Einrichtung:</div>
    <div class="col-md-3">
      <?php if($prof_prov == 1) echo"<input type='checkbox' name='prov' checked  tabindex='2'>"; else echo"<input type='checkbox' name='prov' tabindex='2' >"; ?>
    </div>

  </div>
  <div class="row">
    <div class="col-md-4">Vorname:</div>
    <div class="col-md-3">
      <input type="text" name="Vorname" id="Vorname" value="<?php echo"$Vorname";?>" onBlur="capitalize(this)"  tabindex="3">
    <span class="star">*</span>    </div>
    <div class="col-md-1">Nachname:</div>
    <div class="col-md-3"><input type="text" name="Nachname" id="Nachname" value="<?php echo"$Nachname";?>" tabindex="4" onBlur="capitalize(this)"> <span class="star" id="star">*</span></div>
  </div>
  <div class="row">
    <div class="col-md-4">Geschlecht:</div>
    <div class="col-md-3"><?php  if( $gen== 1) {
          echo"<select name='Gechleht' id='Gechleht'  tabindex='5' OnChange='javascript:SwitchImage();'>";
          echo"<option id='mannlich'>männlich</option>";
      echo"<option Selected>weiblich</option>";
            echo"</select>";} 
      else{
      echo"<select name='Gechleht' id='Gechleht'  tabindex='5' OnChange='javascript:SwitchImage();'>";
          echo"<option id='mannlich'>männlich</option>";
      echo"<option>weiblich</option>";
            echo"</select>";
      }?>&nbsp;<span class="star">*</span></div>
    <div class="col-md-1" style="padding:0;">Geb.-Datum:</div>
    <div class="col-md-3"><input type="text" name="Geb-datum" id="Geb-datum" value="<?php echo"$Geb_datum1";?>" onFocus="document.getElementById('date').style.display='block'" onBlur="document.getElementById('date').style.display='none'" tabindex="6"> <span class="star">*</span></div>
    <div class=""><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <div class="col-md-4">Bild:</div>
    <div class="col-md-4">

    <?php if($imgn <>"")
{
    $im = "http://www.manimano.ch/images/profile/" . $imgn ;
$size = getimagesize(  $im);

  $x=$size[0];
  $y=$size[1];

$r = $x/$y;
if ($r > 0.75)
{
 $image_x              = 63;
$image_y             = 63/$r;
}else
{
 $image_y              = 84;
$image_x             = 84*$r;
}

///start change

$handle = new upload($im);
list($imgn2,$ext)=preg_split('/./',$imgn);
 if ($handle->uploaded) {
  $handle->file_new_name_body   = $imgn2;

$handle->file_safe_name = false;
$handle->file_overwrite = true;
 $handle->image_resize         = true;


 $handle->image_x              = $image_x ;
$handle->image_y             = $image_y  ;

 

// $handle->image_ratio_y        = true;
  $handle->process('http://www.manimano.ch/images/profile/temp/');
 if ($handle->processed) {
   
     $handle->clean();
//rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");sory i am confuse today what the total values of the vouchers 

//$im = "images/profile/" . $imgn ;
//$k=$imagename;
//$imgn=$imagename;
   } 

}

rename("http://www.manimano.ch/images/profile/temp/".$imgn , "http://www.manimano.ch/images/profile/".$imgn);
// End Change

}
    else
{
 $image_x              = 63;
$image_y             = 84;
    if( $gen== 1)
    $im = "http://www.manimano.ch/images/profile/no_picture_she.jpg" ;
    else
    $im = "http://www.manimano.ch/images/profile/no_picture_he.jpg" ;
}

?>

      <input name="Bild" type="image" width="<?php echo"$image_x  "; ?>" Height="<?php echo"$image_y"; ?> " id="Bild" src="<?php echo"$im"; ?>" style="float:left; margin-right:10px;" onMouseOver="document.getElementById('avatar').style.display='block'" onMouseOut="document.getElementById('avatar').style.display='none'" >
      <input type="hidden" name="imgn"  id="imgn" value="<?php  echo"$im"; ?> ">
      <input type="hidden" name="imgn1" id="imgn1" value="<?php  echo"$imgn"; ?>" >
      <div  style="text-align:center; overflow:hidden; width:72px; height:24px; border:none; background:url(images/button_bg.gif) top left no-repeat;">
         <div  tabindex="7"  name="d1" id="d1"   style="color:#000; font-size:12px; padding:5px 0px 0px 0px;">Bild laden</div>
         <input type="file"   name="image_file"  id="image_file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" OnChange="javascript:document.Form1.UploadImage.click();" onMouseOver="document.getElementById('avatar').style.display='block'" onMouseOut="document.getElementById('avatar').style.display='none'" >
      </div>
      <div id="h" class="hidden" style="display:none;"><input type="submit" id="UploadImage" value="Upload Image" name="action" tabindex=0></div>
      </div>
      <div class="col-md-4"><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <div class="col-md-4">Strasse/Nr.</div>
    <div class="col-md-4">
      <input type="text" name="strasse" id="strasse" size="26" value="<?php echo"$strasse";?>" tabindex="8" onBlur="capitalize(this)">
      <input type="text" name="Nr" id="Nr" size="10" value="<?php echo"$Nr";?>" tabindex="9">
      <span class="star">*</span>    </div>
  </div>
  <div class="row">
    <div class="col-md-4">PLZ/Ort:</div>
    <div class="col-md-4">
      <input type="text" name="plz" id="plz" size="11" value="<?php echo"$plz";?>" >
      <input type="text" name="ort" id="ort" size="25" value="<?php echo"$ort";?>"  >
      <span class="star">*</span>    </div>
  </div>
  <div class="row">
    <div class="col-md-4">Tel. P:</div>
    <div class="col-md-3"><input type="text" name="Tel" id="Tel" value="<?php echo"$Tel";?>" tabindex="12"> <span class="star">*</span></div>
    <div class="col-md-1">Handy:</div>
    <div class="col-md-4"><input type="text" name="handy" id="handy" value="<?php echo"$handy";?>" onFocus="document.getElementById('handy1').style.display='block'" onBlur="document.getElementById('handy1').style.display='none'" tabindex="13"> <span class="star"></span></div>
    <div class=""><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <div class="col-md-4">E-mail:</div>
    <div class="col-md-4"><input type="text" name="email" id="email" value="<?php echo"$email";?>" tabindex="14"> <span class="star">*</span></div>
  </div>
  <div class="row">
    <div class="col-md-4">Vorzugs-Kontaktart:</div>
    <div class="col-md-4">
    <select name='vorzugs' id='vorzugs' onFocus="document.getElementById('vorg').style.display='block'" onBlur="document.getElementById('vorg').style.display='none'" tabindex="15">
      <option>Handy</option>
      <option <?php if( $pre==1) echo"selected" ?>>Email</option>
      <option <?php if( $pre==2) echo"selected" ?>>Festnetz</option>
    </select>&nbsp;<span class="star">*</span></div>
    <div class="col-md-4"><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <div class="col-md-4">Benutzername:</div>
    <div class="col-md-3"><input type="text" name="benutzername" id="benutzername" value="<?php  echo"$username ";?>" onFocus="document.getElementById('pass').style.display='block'" onBlur="document.getElementById('pass').style.display='none'" tabindex="16"></div>
    <div class="col-md-1">Passwort:</div>
    <div class="col-md-4 passd"><input type="password" name="passwort" id="passwort" value="<?php echo"$password";?>" tabindex="17" style="display:block;"> <span class="star">*</span></div>
    <div class=""><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <div class="col-md-4">Stundenlohn:</div>
    <div class="col-md-4"><input type="text" name="stundenlohn" id="stundenlohn" size="11" value="<?php echo"$stundenlohn ";?>" onFocus="document.getElementById('student').style.display='block'" onBlur="document.getElementById('student').style.display='none'" tabindex="19"> Fr.</div>
    <div class="col-md-4"><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <div class="col-md-4">Bemerkung:</div>
    <div class="col-md-4"><textarea  tabindex="19" name="bemerkung" cols="45" id="bemerkung" value="<?php echo "$bemerkung";?>" onFocus="document.getElementById('bemerkung1').style.display='block'" onBlur="document.getElementById('bemerkung1').style.display='none'"><?php echo "$bemerkung";?></textarea></div>
    <div class="col-md-4"><div style="position:relative;"></div></div>
  </div>
  <div class="row">
    <input type="hidden" name="order" id="order" size="26" value="<?php echo"$order";?>">
    <div class="col-md-4">
      <input  tabindex="20" type="submit" name="nextbtn" id="nextbtn" value="Speichern und weiter zur zeitlichen Verfügbarkeit (2 von 6)"  />
    </div>
  </div>
</form>
<?php
$su = 0;

$order = $_POST['order'];
$order = $_POST['order'];
if ($order==1)
{
echo'<script language="javascript">document.Form1.Nachname.focus()</script>';
}
if ($order==2)
{
echo'<script language="javascript">document.Form1.ort.focus()</script>';
}
//if ($order==3)
if($_POST["nextbtn"] == "Speichern und weiter zur zeitlichen Verfügbarkeit (2 von 6)")
{
$su = 1;
$err = 2;
echo"<script type='text/javascript'>";

echo"var formachka = document.getElementById('Form1');";
echo"Out:";	

echo" {";

if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
echo"alert('Bitte geben Sie den Namen Ihres Vereins, Ihrer Organisation oder öffentlichen Einrichtung ein.');"; 
$err = 1;
	echo"formachka['Firma'].focus();";
$prof_prov = 1;
echo"break  Out;"; 


} else
$prof_prov = 0;

if (empty ($_POST['Vorname']))
{
	//echo"if (formachka['Vorname'].value == '') {";
		echo"formachka['Vorname'].focus();";
		echo"alert('Bitte geben Sie Ihren Vornamen ein.');";

$err = 1;
                                         echo"break  Out;";
		//echo"return false;";
	//echo"}";
	} 
else 
{

$telats = $_POST['Vorname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚäöüÖÜÄãõÃÕ' ]*$#", $telats)){

echo"formachka['Vorname'].focus();";
		echo"alert('Bitte verwenden Sie keine Sonderzeichen im Vornamen.');";
$err = 1;
                                         echo"break  Out;";


}
}

// start Nachname

$Nach=trim($_POST['Nachname']);
if (empty ($Nach))
{
	//echo"if (formachka['Vorname'].value == '') {";
		echo"formachka['Nachname'].focus();";
		echo"alert('Bitte geben Sie Ihren Nachname ein.');";
$err = 1;
                                         echo"break  Out;";
		//echo"return false;";
	//echo"}";
	} 
else 
{

$telats = $_POST['Nachname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚäöüÖÜÄãõÃÕ' ]*$#", $telats)){

echo"formachka['Nachname'].focus();";
		echo"alert('Bitte verwenden Sie keine Sonderzeichen im Nachnamen.');";
$err = 1;
                                         echo"break  Out;";


}
}

//end

	
	echo"if (formachka['Geb-datum'].value == '') {";
		echo"formachka['Geb-datum'].focus();";
		echo"alert('Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) ');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

$d=trim($_POST['Geb-datum']); 

    if ((preg_match("/^(\d)\.(\d)\.(\d{4})$/", $d, $matches)) or (preg_match("/^(\d{2})\.(\d{2})\.(\d{4})$/", $d, $matches))or (preg_match("/^(\d)\.(\d{2})\.(\d{4})$/", $d, $matches))or (preg_match("/^(\d{2})\.(\d)\.(\d{4})$/", $d, $matches)))
{
$toc = 1;
}
else
{
$toc = 0;
echo"formachka['Geb-datum'].focus();";
		echo"alert('Das Datum, welches Sie eingegeben haben enthält einen Fehler ( z.B. 31.1.1989) ');";
$err = 1;
echo"break  Out;";
}

$d=trim($_POST['Geb-datum']); 
list($iday,$imonth,$iyear) = explode(".",$d); 
$year_diff = date("Y") - $iyear; 
$month_diff = date("m") - $imonth; 
$day_diff = date("d") - $iday; 
if ($day_diff < 0 or $month_diff < 0) 
$year_diff--; 
if (($year_diff < 0 ) or ($year_diff > 150 ))
{
echo"formachka['Geb-datum'].focus();";
		echo"alert('Das Datum, welches Sie eingegeben haben enthält einen Fehler ( z.B. 31.1.1989) ');";
$err = 1;
echo"break  Out;";

}




$d=trim($_POST['Geb-datum']); 
if ($d <> "")
{
list($iday,$imonth,$iyear) = explode(".",$d); 
if ( $toc == 1)
 if (!checkdate($imonth, $iday, $iyear)) 
{
echo"formachka['Geb-datum'].focus();";
		echo"alert('Das Datum, welches Sie eingegeben haben enthält einen Fehler ( z.B. 31.1.1989) ');";
$err = 1;
echo"break  Out;";

}
}




	
	echo"if (formachka['strasse'].value == '') {";
		echo"formachka['strasse'].focus();";
		echo"alert('Bitte geben Sie uns noch die Strasse an, in der Sie wohnen.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
	
	echo"if (formachka['Nr'].value == '') {";
		echo"formachka['Nr'].focus();";
		echo"alert('Bitte geben Sie uns noch die Hausnummer an.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
	
	echo"if (formachka['plz'].value == '') {";
		echo"formachka['plz'].focus();";
		echo"alert('Bitte geben Sie noch die PLZ Ihres Wohnortes ein.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
	
	echo"if (formachka['ort'].value == '') {";
		echo"formachka['ort'].focus();";
		echo"alert('Bitte geben Sie noch Ihren Wohnort an.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

$address = str_replace( " ", "+","http://maps.googleapis.com/maps/api/geocode/xml?sensor=false&address={$_POST['strasse']}+{$_POST['Nr']}+,+{$_POST['plz']}+{$_POST['ort']}");

   $xml = simplexml_load_file($address) or die("url not loading");

$latitude = $xml->result->geometry->location->lat; // v3
$longitude = $xml->result->geometry->location->lng; // v3
//$hlat=floatval($hlat);

// Output the coordinates
//echo "Longitude: $longitude, Latitude: $latitude";
if (($longitude==Null) or ($latitude==Null))
{
echo"formachka['strasse'].focus();";
		echo"alert('Bitte geben Sie eine gültige Adresse an.');";
$err = 1;
echo"break  Out;";		

}
$Tel = $_POST['Tel'];
//start change for te;; phone 
$Tel  = preg_replace('/\D/', '', $Tel );
if(strlen ($Tel) == 10)  
{
$Tel  = $Tel[0].$Tel[1].$Tel[2].' '.$Tel[3].$Tel[4].$Tel[5].' '.$Tel[6].$Tel[7].' '.$Tel[8].$Tel[9];
} else 
{
		echo"formachka['Tel'].focus();";
		echo"alert('Geben Sie Ihre  Tel ohne Landesvorwahl an, z.B. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}



//end
	
	echo"if (formachka['Tel'].value == '') {";
		echo"formachka['Tel'].focus();";
		echo"alert('Bitte füllen Sie noch Ihre Telefonnummer (Festanschluss) aus.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";


if(($Tel[0] <> "0") or   ($Tel[3] <> " ") or ($Tel[7] <> " ")or ($Tel[10] <> " "))
{
		echo"formachka['Tel'].focus();";
		echo"alert('Geben Sie Ihre  Telnummer ohne Landesvorwahl an, z.B. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}


$handy = $_POST['handy'];
//start change for cell phone 
$handy  = preg_replace('/\D/', '', $handy );




//end
	






if(str_replace(" ","",$_POST['email']) == "")  
{
//	echo" {";

		echo"alert('Bitte geben Sie uns noch Ihre Email-Adresse an.');";
		echo"formachka['email'].focus();";
$err = 1;
echo"break  Out;";		
//echo"return false;";
//	echo"}";
} else
{
	echo"reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;";
	echo"if (!formachka['email'].value.match(reg)) {";

		echo"alert('Die eingegebene E-Mail Adresse enthält einen Fehler, bitte überprüfen Sie Ihre Eingabe.');";
		echo"formachka['email'].focus();";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

}
// start user name

$benutzername=trim($_POST['benutzername']);
if (empty ($benutzername))
{
	//echo"if (formachka['benutzername'].value == '') {";
		echo"formachka['benutzername'].focus();";
		echo"alert('Bitte geben Sie noch Ihren gewünschten Benutzernamen an.');";
$err = 1;
                                         echo"break  Out;";
		//echo"return false;";
	//echo"}";
	} 
else 
{

$myusername = trim($_POST['benutzername']);
$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1)
{
echo"formachka['benutzername'].focus();";
		echo"alert('Der Benutzername existiert schon, bitte wählen Sie einen andern.');";
$err = 1;
echo"break  Out;";		
}

}

//end





	
	echo"if (formachka['passwort'].value == '') {";
		echo"formachka['passwort'].focus();";
		echo"alert('Bitte geben Sie noch ein Passwort für Ihren Benutzernamen an.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

if(strlen ($_POST['passwort']) < 5)  
{
		echo"formachka['passwort'].focus();";
		echo"alert('Das Passwort muss mindestens 5 Buchstaben lang sein.');";
$err = 1;
echo"break  Out;";
   
}
$hrrate=trim($_POST['stundenlohn']);
if ($hrrate<>"")
if(is_numeric($hrrate)) 
{
if ($hrrate < 0)
{

echo"formachka['stundenlohn'].focus();";
		echo"alert('Der eingegebene Stundenlohn enthält einen Fehler, bitte überprüfen Sie Ihre Eingabe.');";
$err = 1;
echo"break  Out;";

}
} else
{

echo"formachka['stundenlohn'].focus();";
		echo"alert('Der eingegebene Stundenlohn enthält einen Fehler, bitte überprüfen Sie Ihre Eingabe.');";
$err = 1;
echo"break  Out;";

}

//echo"return true;";
echo"}";	
//echo"alert('$err');";
echo"</script>";
}




?>

<?php


if($_POST["action"] == "Upload Image")
{
echo"<script type='text/javascript'>";

echo"var formachka = document.getElementById('Form1');";
echo"Out:";	
echo" {";

unset($imagename);

if(!isset($_FILES) && isset($HTTP_POST_FILES))
$_FILES = $HTTP_POST_FILES;

if(!isset($_FILES['image_file']))
{
echo"alert('Bild nicht gefunden. Bitte versuchen Sie es nochmals, ansonsten wählen Sie ein anderes Bild');"; 
	echo"formachka['d1'].focus();";
echo"break  Out;"; 

}

$imagename = basename($_FILES['image_file']['name']);
//echo $imagename;

if(empty($imagename))
{
echo"alert('Bild nicht gefunden. Bitte versuchen Sie es nochmals, ansonsten wählen Sie ein anderes Bild.');"; 
	echo"formachka['d1'].focus();";
echo"break  Out;"; 

}

if (!($_FILES['image_file']['type'] =="image/jpeg" OR $_FILES['image_file']['type'] =="image/gif" OR $_FILES['image_file']['type'] =="image/pjpeg"))
{
echo"alert('Bitte laden Sie ein Bild mit der Endung JPG oder GIF - diese werden von ManiMano unterstützt.');"; 
	echo"formachka['d1'].focus();";
echo"break  Out;"; 
}


echo"}";	


echo"</script>";
}

?>
	</div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
