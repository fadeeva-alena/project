<? ob_start(); ?>
<?php
include "../include/session.php";
include "../include/z_db.php";
include "../include/class.upload.php";
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


if(empty($imagename))
$error["imagename"] = "The name of the image was not found.";


if (!($_FILES['image_file']['type'] =="image/jpeg" OR $_FILES['image_file']['type'] =="image/gif" OR $_FILES['image_file']['type'] =="image/pjpeg"))
$error="Your uploaded file must be of JPG or GIF. Other file types are not allowed<BR>";



if(empty($error))
{

$newimage = "../images/profile/" . $imagename;



$result = @move_uploaded_file($_FILES['image_file']['tmp_name'], $newimage);
if(empty($result))
{

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
if($_POST['Gechleht'] == "male") 
    $gen = 2;
if($_POST['Gechleht'] == "female") 
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


$handy = trim($_POST['handy']);

$handy  = preg_replace('/\D/', '', $handy );
if(strlen ($handy) == 10)  
{
$handy  = $handy[0].$handy[1].$handy[2].' '.$handy[3].$handy[4].$handy[5].' '.$handy[6].$handy[7].' '.$handy[8].$handy[9];
}



$email = trim($_POST['email']);
$handy = trim($_POST['handy']);
list($day,$mon,$yr) = split('-',trim($_POST['Geb-datum'])); 
$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum1 = $_POST['Geb-datum'];
$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = trim($_POST['Firma']);
if($_POST['vorzugs'] == "Cellphone") 
    $pre = 3;
if($_POST['vorzugs'] == "Homephone") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;

if($imgn == "")
    {
if($_POST['Gechleht'] == "male") 
$imgn="no_picture_he.jpg";
if($_POST['Gechleht'] == "female") 
$imgn="no_picture_she.jpg";
}
$im = "../images/profile/" . $imgn ;
}
if($_POST["nextbtn"] == " Save and continue to Time avaliability (2 of 6)")

{

 include "../include/session.php";
include "../include/z_db.php";
 include("../geocode.class.php");

   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ";

 

  $errors = "";  




	
// validation new start 


$telats = $_POST['Vorname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûàèìòùáéíóúäöüãõÂÊÎÔÛÀÈÌÒÙÁÉÍÓÚÃÕ' ]*$#", $telats))

$errors .= "error.";  


$telats = $_POST['Nachname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûàèìòùáéíóúäöüãõÂÊÎÔÛÀÈÌÒÙÁÉÍÓÚÃÕ' ]*$#", $telats))
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
$handy  = preg_replace('/\D/', '', $handy );
if(strlen ($handy) == 10)  
{
$handy  = $handy[0].$handy[1].$handy[2].' '.$handy[3].$handy[4].$handy[5].' '.$handy[6].$handy[7].' '.$handy[8].$handy[9];
} else 
{
	$errors .= "error.";  

}




if(($handy[0] <> "0") or   ($handy[3] <> " ") or ($handy[7] <> " ")or ($handy[10] <> " "))
{
	$errors .= "error.";  

}



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


 $pattern = "^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$"; 
      $email = trim($_POST['email']);
      if (!eregi($pattern, $email)){ 
$errors .= "error.";  
}

if((str_replace(" ","",$_POST['imgn']) == "../images/profile/no_picture_she.jpg ") or (str_replace(" ","",$_POST['imgn']) == "../images/profile/no_picture_he.jpg") )
{
$errors .= "error.";  



}



//validation new end 


if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
 $errors .= "Please enter the name of your Club, Organization or Public Facility";  
$prof_prov = 1;
} else
$prof_prov = 0;
list($f,$a,$b,$imgn) = split('/',$_POST['imgn']);
if(($imgn == "no_picture_he.jpg") or ($imgn == "no_picture_she.jpg") )
  {
if($_POST['Gechleht'] == "male") 
$imgn="no_picture_he.jpg";
if($_POST['Gechleht'] == "female") 
$imgn="no_picture_she.jpg";
}
$im = "../images/profile/" . $imgn ;
//$imgn=$_POST['imgn'] ;
if($_POST['Vorname'] == "")
    $errors .= "Please enter Firstname.";  
if($_POST['Nachname'] == "")  
    $errors .= "Please enter Lastname. ";   
if($_POST['Gechleht'] == "")  
    $errors .= "Please select Gender."; 
if($_POST['Gechleht'] == "male") 
    $gen = 2;
if($_POST['Gechleht'] == "female") 
    $gen = 1;

if($_POST['vorzugs'] == "Cellphone") 
    $pre = 3;
if($_POST['vorzugs'] == "Homephone") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;


if($_POST['strasse'] == "")  
    $errors .= "Please enter your Street name, in wich you live. "; 
if($_POST['Nr'] == "")  
    $errors .= "Please enter your house number. "; 
if($_POST['plz'] == "")  
    $errors .= "Please enter your postal code (zip). "; 
if($_POST['ort'] == "")  
    $errors .= "Please enter your town/city.      ";
if($_POST['Tel'] == "")  
    $errors .= "Please enter your Home phone number. ";
if($_POST['handy'] == "")  
    $errors .= "Please enter your cell phone number. ";

if($_POST['email'] == "")  
    $errors .= "Please enter your email address.";
if($_POST['passwort'] == "")  
    $errors .= "Please enter a password for your ManiMano registration.";
if(strlen ($_POST['passwort']) < 5)  
    $errors .= "Password must be at least 5 charcters long.";
if($_POST['benutzername'] == "")  
    $errors .= "Please enter a Username.";
$myusername = trim($_POST['benutzername']);
$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

$count=mysql_num_rows($result);
if($count==1)
 $errors .= "The Username you have choosen already exsits, please choose a different username.";
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
 $errors .=" Please enter a valid Address.";
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

$sql="INSERT INTO t_people (firstname, lastname, street, house_nr, zip, location, tel_p, tel_m, email, username, password, gender, birthdate, preferred_contact_by, price_per_hour, note, longitude, latitude, institution, prof_provider , image_path ) VALUES('$Vorname', '$Nachname',  '$strasse', '$Nr', '$plz', '$ort', '$Tel', '$handy', '$email', '$username', '$password', '$gen', '$Geb_datum', '$pre', '$stundenlohn', '$bemerkung', '$longitude', '$latitude', '$firma', '$prof_prov', '$imgn') ;" ;
  mysql_query($sql)or die(mysql_error());

$myusername = trim($_POST['benutzername']);
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


      
  } else { 
$j = $errors ;

//$firma =$errors ;


 }  




}


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
if($_POST['Gechleht'] == "male") 
    $gen = 2;
if($_POST['Gechleht'] == "female") 
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
list($day,$mon,$yr) = split('-',trim($_POST['Geb-datum'])); 
$Geb_datum = $yr."-".$mon."-".$day;
$Geb_datum1 = trim($_POST['Geb-datum']);
$stundenlohn = trim($_POST['stundenlohn']);
$bemerkung = trim($_POST['bemerkung']);

$firma = trim($_POST['Firma']);
if($_POST['vorzugs'] == "Cellphone") 
    $pre = 3;
if($_POST['vorzugs'] == "Homephone") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;
$da1 =strtotime(date("m.d.y")) ;
if ($plz<>"")
{
$sql="SELECT * FROM _taccess  WHERE Zip='$plz' ";

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
echo '<script language="javascript">confirm("Danke fÃ¼r Ihr Interesse an ManiMano. Im Moment hat Ihre Wohngemeinde/-stadt ManiMano noch nicht freigeschaltet. ManiMano kann nur eingesetzt werden, falls es von Ihrer Wohngemeinde/-stadt lizenziert wird")</script>';


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
list($f,$a,$b,$imgn) = split('/',$_POST['imgn']);


if(($imgn == "no_picture_he.jpg ") or ($imgn == "no_picture_she.jpg ") )
//if(($imgn=="") And ($q==1)) 


{
if ($count==1)
{
if ($row[sex]=='M')
{
 $gen = 2;
$imgn="no_picture_he.jpg";
$im = "../images/profile/" . $imgn ;
}
if ($row[sex]=='W')
{
 $gen = 1;
$imgn="no_picture_she.jpg";
$im = "../images/profile/" . $imgn ;
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

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ManiMano - Registrierung 1 von 6</title>
<link href="style.css" rel="stylesheet" type="text/css" />

 <script type="text/javascript"> 
function capitalize(form) {
value = form.value.toLowerCase();
newValue = '';
value = value.split(' ');
for(var i = 0; i < value.length; i++) {
newValue += value[i].substring(0,1).toUpperCase() +
value[i].substring(1,value[i].length) + ' ';
}
form.value = newValue;
}

function Change(x)
{


if (x==1)
{
value = document.getElementById("Vorname").value.toLowerCase();
newValue = '';
value = value.split(' ');
for(var i = 0; i < value.length; i++) {
newValue += value[i].substring(0,1).toUpperCase() +
value[i].substring(1,value[i].length) + ' ';
}
document.getElementById("Vorname").value= newValue;

document.getElementById("order").value = 1;

}


if (x==2)
{
document.getElementById("order").value = 2;

}

document.Form1.submit();


}
 function disable() {
    var limit = document.forms[0].elements.length;
    for (i=0;i<limit;i++) {
      document.forms[0].elements[i].disabled = true;
    }
  }
</script> 


</head>

<body class="all" >

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
	<input type=button value="Register" onclick=location.href="location.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php" id="loginbtn">
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">1) Personal Information <img src="../images/page.png" align="right" /></span>
		<p style="margin-top: 0; margin-bottom: 3px">
<div id="loading" style="display:none ;background-color: #6593cf; top: 100px;   left: 100px;">   <img id="loading-image"  style=" position: absolute;  top:300px;   left: 240px;"   src="../images/ajax-loader.gif" alt="Loading..." /> </div> 
<form method="post"  enctype="multipart/form-data" name="Form1" id="Form1" action="register1.php" onsubmit=document.getElementById("loading").style.display="block"; document.getElementById("order").value = 3; disable();>
<table class="settings_tbl">
  <tr>
    <td>Company:</td>
    <td colspan="3"><input type="text" name="Firma" id="Firma" size="30" value="<?php echo"$firma";?>" tabindex="1"></td>
    <td><div style="position:relative;"><div style="position:absolute; top:-5px; left:0px; width:300px; color:#fff;">
		* Diese Angaben sind notwendig</div></div></td>
  </tr>
  <tr>
    <td colspan="5">Club, Organisation or Public Facility: <?php if($prof_prov == 1) echo"<input type='checkbox' name='prov' checked  tabindex='2'>"; else echo"<input type='checkbox' name='prov' tabindex='2' >"; ?></td>
  </tr>
  <tr>
    <td>Firstname:</td>
    <td>
      <input type="text" name="Vorname" id="Vorname" value="<?php echo"$Vorname";?>" onBlur=javascript:Change(1) ;  tabindex="3">
	  <span class="star">*</span>    </td>
    <td style="text-align:right;">Lastname:</td>
    <td><input type="text" name="Nachname" id="Nachname" value="<?php echo"$Nachname";?>" tabindex="4" onBlur="capitalize(this)"> <span class="star" id="star">
	*</span></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>Gender:</td>
    <td><?php  if( $gen== 1) {
	        echo"<select name='Gechleht' id='Gechleht'  tabindex='5'>";
	        echo"<option id='mannlich'>male</option>";
			echo"<option Selected>female</option>";
            echo"</select>";} 
			else{
			echo"<select name='Gechleht' id='Gechleht'  tabindex='5'>";
	        echo"<option id='mannlich'>male</option>";
			echo"<option>female</option>";
            echo"</select>";
			}?>&nbsp;<span class="star">*</span></td>
    <td style="text-align:right;">Date of birth:</td>
    <td><input type="text" name="Geb-datum" id="Geb-datum" value="<?php echo"$Geb_datum1";?>" onFocus="document.getElementById('date').style.display='block'" onBlur="document.getElementById('date').style.display='none'" tabindex="6"> <span class="star">
	*</span></td>
    <td><div style="position:relative;"><div id="date" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">
		Your Birthdate will not be published.<br />But we can use it to Authenticate your data.</div></div></td>
  </tr>
  <tr>
    <td style="vertical-align:top;">Picture:</td>
    <td colspan="3">

	  <?php if($imgn <>"")
{
	  $im = "../images/profile/" . $imgn ;
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
list($imgn2,$ext)=split('.',$imgn);
 if ($handle->uploaded) {
  $handle->file_new_name_body   = $imgn2;

$handle->file_safe_name = false;
$handle->file_overwrite = true;
 $handle->image_resize         = true;


 $handle->image_x              = $image_x ;
$handle->image_y             = $image_y  ;

 

// $handle->image_ratio_y        = true;
  $handle->process('../images/profile/temp/');
 if ($handle->processed) {
   
     $handle->clean();



   } 

}

rename("../images/profile/temp/".$imgn , "../images/profile/".$imgn);
// End Change

}
	  else
{
 $image_x              = 63;
$image_y             = 84;
	  if( $gen== 1)
	  $im = "../images/profile/no_picture_she.jpg" ;
	  else
	  $im = "../images/profile/no_picture_he.jpg" ;
}

?>

      <input name="Bild" type="image" width="<?php echo"$image_x  "; ?>" Height="<?php echo"$image_y"; ?> " id="Bild" src="<?php echo"$im"; ?>" style="float:left; margin-right:10px;" onMouseOver="document.getElementById('avatar').style.display='block'" onMouseOut="document.getElementById('avatar').style.display='none'" >
      <input type="hidden" name="imgn" value="<?php  echo"$im"; ?> ">
      <input type="hidden" name="imgn1" value="<?php  echo"$imgn"; ?>" >
      <div  style="text-align:center; overflow:hidden; width:72px; height:24px; border:none; background:url(../images/button_bg.gif) top left no-repeat;">
         <div  tabindex="7"  name="d1" id="d1"   style="color:#000; font-size:12px; padding:5px 0px 0px 0px;">Loading</div>
         <input type="file"   name="image_file"  id="image_file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" OnChange="javascript:document.Form1.UploadImage.click();" onMouseOver="document.getElementById('avatar').style.display='block'" onMouseOut="document.getElementById('avatar').style.display='none'" >
      </div>
      <div id="h" class="hidden" style="display:none;"><input type="submit" id="UploadImage" value="Upload Image" name="action" tabindex=0></div>
      </td>
      <td><div style="position:relative;"><div id="avatar" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">
		If you are not yet known, other will trust you easier, if you add a nice Photo of yourself here. Then even if your name is not known, you can be recognized again.(Required)</div></div></td>
  </tr>
  <tr>
    <td>Street/No.</td>
    <td colspan="4">
      <input type="text" name="strasse" id="strasse" size="26" value="<?php echo"$strasse";?>" tabindex="8" onBlur="capitalize(this)">
      <input type="text" name="Nr" id="Nr" size="10" value="<?php echo"$Nr";?>" tabindex="9">
      <span class="star">*</span>    </td>
  </tr>
  <tr>
    <td>postal code (zip)/City:</td>
    <td colspan="4">
      <input type="text" name="plz" id="plz" size="11" value="<?php echo"$plz";?>" tabindex="10"  onBlur=javascript:Change(2) >
      <input type="text" name="ort" id="ort" size="25" value="<?php echo"$ort";?>" tabindex="11" onBlur="capitalize(this)">
      <span class="star">*</span>    </td>
  </tr>
  <tr>
    <td>Phone No:</td>
    <td><input type="text" name="Tel" id="Tel" value="<?php echo"$Tel";?>" tabindex="12"> <span class="star">
	*</span></td>
    <td style="text-align:right;">Cellphone (mobile):</td>
    <td><input type="text" name="handy" id="handy" value="<?php echo"$handy";?>" onFocus="document.getElementById('handy1').style.display='block'" onBlur="document.getElementById('handy1').style.display='none'" tabindex="13"> <span class="star">
	*</span></td>
    <td><div style="position:relative;"><div id="handy1" style="position:absolute; top:-25px; left:0px; width:300px; color:#fff; display:none;">
		Your Cellphone number is<br />required. In case you forgot your password<br />
		we will send it by SMS (text message) to you.</div></div></td>
  </tr>
  <tr>
    <td>E-mail:</td>
    <td colspan="4"><input type="text" name="email" id="email" value="<?php echo"$email";?>" tabindex="14"> <span class="star">
	*</span></td>
  </tr>
  <tr>
    <td>Preferred method of Contact:</td>
    <td colspan="3">
    <select name='vorzugs' id='vorzugs' onFocus="document.getElementById('vorg').style.display='block'" onBlur="document.getElementById('vorg').style.display='none'" tabindex="15">
      <option>Cellphone</option>
      <option <?php if( $pre==1) echo"selected" ?>>Email</option>
      <option <?php if( $pre==2) echo"selected" ?>>Homephone</option>
    </select>&nbsp;<span class="star">*</span></td>
    <td><div style="position:relative;"><div id="vorg" style="position:absolute; top:-15px; left:0px; width:300px; color:#fff; display:none;">
		Here you can choose your preferred way, <br />of Contact.</div></div></td>
  </tr>
  <tr>
    <td>Username:</td>
    <td><input type="text" name="benutzername" id="benutzername" value="<?php  echo"$username ";?>" onFocus="document.getElementById('pass').style.display='block'" onBlur="document.getElementById('pass').style.display='none'" tabindex="16"></td>
    <td style="text-align:right;">Password:</td>
    <td><input type="password" name="passwort" id="passwort" value="<?php echo"$password";?>" tabindex="17"> <span class="star">
	*</span></td>
    <td><div style="position:relative;"><div id="pass" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">
		You can choose a username. <br />We will check if its available. <br />We suggest Firstname.Lastname.Town, <br />for e.g. 
		david.shchlaepfer.egg</div></div></td>
  </tr>
  <tr>
    <td>Hourly rate:</td>
    <td colspan="3"><input type="text" name="stundenlohn" id="stundenlohn" size="11" value="<?php echo"$stundenlohn ";?>" onFocus="document.getElementById('student').style.display='block'" onBlur="document.getElementById('student').style.display='none'" tabindex="18"> 
	Fr.</td>
    <td><div style="position:relative;"><div id="student" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">
		Here you can enter your desired Hourly Rate. <br />We suggest 15.- per Hour for/<br /> unqualified work.<br />(with out depending Qualification).</div></div></td>
  </tr>
  <tr>
    <td style="vertical-align:top;">Comment:</td>
    <td colspan="3"><textarea  tabindex="19" name="bemerkung" cols="45" id="bemerkung" value="<?php echo "$bemerkung";?>" onFocus="document.getElementById('bemerkung1').style.display='block'" onBlur="document.getElementById('bemerkung1').style.display='none'"><?php echo "$bemerkung";?></textarea></td>
    <td><div style="position:relative;"><div id="bemerkung1" onKeyDown="" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">
		The Comment you enter here <br />will be shown on the Results Lists. <br />Ideal for e.g. limitations or <br />
		additional Information / Qualifications.</div></div></td>
  </tr>
  <tr>
    <td><input type="hidden" name="order" id="order" size="26" value="<?php echo"$order";?>">

</td>
    <td colspan="4"><input  tabindex="20" type="submit" name="nextbtn" id="nextbtn" value=" Save and continue to Time avaliability (2 of 6)"  /></td>
  </tr>
</table>
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
if($_POST["nextbtn"] == " Save and continue to Time avaliability (2 of 6)")
{
$su = 1;
$err = 2;
echo"<script type='text/javascript'>";

echo"var formachka = document.getElementById('Form1');";
echo"Out:";	

echo" {";

if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
echo"alert('Please enter the name of your Club, Organization or Public Facility');"; 
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
		echo"alert('Please enter Firstname.');";

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
if(!preg_match("#^[-A-Za-zâêîôûàèìòùáéíóúäöüãõÂÊÎÔÛÀÈÌÒÙÁÉÍÓÚÃÕ' ]*$#", $telats)){

echo"formachka['Vorname'].focus();";
		echo"alert('Please don't use special characters in Firstname.');";
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
		echo"alert('Please enter Lastname.');";
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
if(!preg_match("#^[-A-Za-zâêîôûàèìòùáéíóúäöüãõÂÊÎÔÛÀÈÌÒÙÁÉÍÓÚÃÕ' ]*$#", $telats)){

echo"formachka['Nachname'].focus();";
		echo"alert('Please don't use special characters in Lastname.');";
$err = 1;
                                         echo"break  Out;";


}
}

//end

	
	echo"if (formachka['Geb-datum'].value == '') {";
		echo"formachka['Geb-datum'].focus();";
		echo"alert('Please enter your Birthdate (e.g. 31.12.1970) ');";
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
		echo"alert('The entered Date contains an error.( e.g. 31.1.1989) ');";
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
		echo"alert('The entered Date contains an error.( e.g. 31.1.1989) ');";
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
		echo"alert('The entered Date contains an error.( e.g. 31.1.1989) ');";
$err = 1;
echo"break  Out;";

}
}


if((str_replace(" ","",$_POST['imgn']) == "../images/profile/no_picture_she.jpg ") or (str_replace(" ","",$_POST['imgn']) == "../images/profile/no_picture_he.jpg") )
{
echo"alert('Please load a picture - no picture was found.');";
echo"break  Out;";	


}


	
	echo"if (formachka['strasse'].value == '') {";
		echo"formachka['strasse'].focus();";
		echo"alert('Please enter your Street name, in wich you live.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
	
	echo"if (formachka['Nr'].value == '') {";
		echo"formachka['Nr'].focus();";
		echo"alert('Please enter your house number.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
	
	echo"if (formachka['plz'].value == '') {";
		echo"formachka['plz'].focus();";
		echo"alert('Please enter your postal code (zip)');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
	
	echo"if (formachka['ort'].value == '') {";
		echo"formachka['ort'].focus();";
		echo"alert('Please enter your town/city.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";
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
{
echo"formachka['strasse'].focus();";
		echo"alert('Please enter a valid Address.');";
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
		echo"alert('Please enter your phone number with out the country code, e.g. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}



//end
	
	echo"if (formachka['Tel'].value == '') {";
		echo"formachka['Tel'].focus();";
		echo"alert('Please enter your Home phone number.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";


if(($Tel[0] <> "0") or   ($Tel[3] <> " ") or ($Tel[7] <> " ")or ($Tel[10] <> " "))
{
		echo"formachka['Tel'].focus();";
		echo"alert('Please enter your phone number with out the country code, e.g. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}


$handy = $_POST['handy'];
//start change for cell phone 
$handy  = preg_replace('/\D/', '', $handy );
if(strlen ($handy) == 10)  
{
$handy  = $handy[0].$handy[1].$handy[2].' '.$handy[3].$handy[4].$handy[5].' '.$handy[6].$handy[7].' '.$handy[8].$handy[9];
} else 
{
		echo"formachka['handy'].focus();";
		echo"alert('Please enter your cellphone number with out the country code, e.g. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}



//end
	
	echo"if (formachka['handy'].value == '') {";
		echo"formachka['handy'].focus();";
		echo"alert('Please enter your cell phone number.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

//if (! preg_match('/^0\d{9}$/', $handy)) 
if(($handy[0] <> "0") or   ($handy[3] <> " ") or ($handy[7] <> " ")or ($handy[10] <> " "))
{
		echo"formachka['handy'].focus();";
		echo"alert('Please enter your cellphone number with out the country code, e.g. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}





if(str_replace(" ","",$_POST['email']) == "")  
{
//	echo" {";

		echo"alert('Please enter your email address.');";
		echo"formachka['email'].focus();";
$err = 1;
echo"break  Out;";		
//echo"return false;";
//	echo"}";
} else
{
	echo"reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;";
	echo"if (!formachka['email'].value.match(reg)) {";

		echo"alert('The entered email address is not correct, please check entered email address.');";
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
		echo"alert('Please enter a Username.');";
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
		echo"alert('The Username you have choosen already exsits, please choose a different username.');";
$err = 1;
echo"break  Out;";		
}

}

//end





	
	echo"if (formachka['passwort'].value == '') {";
		echo"formachka['passwort'].focus();";
		echo"alert('Please enter a password for your username.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

if(strlen ($_POST['passwort']) < 5)  
{
		echo"formachka['passwort'].focus();";
		echo"alert('Password must be at least 5 charcters long.');";
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
		echo"alert('The entered Hourly rate is not correct, please check entered Hourly rate.');";
$err = 1;
echo"break  Out;";

}
} else
{

echo"formachka['stundenlohn'].focus();";
		echo"alert('The entered Hourly rate is not correct, please check entered Hourly rate.');";
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
echo"alert('Picture was not found. Please try agian, or choose a different Picture.');"; 
	echo"formachka['d1'].focus();";
echo"break  Out;"; 

}

$imagename = basename($_FILES['image_file']['name']);
//echo $imagename;

if(empty($imagename))
{
echo"alert('Picture was not found. Please try agian, or choose a different Picture.');"; 
	echo"formachka['d1'].focus();";
echo"break  Out;"; 

}

if (!($_FILES['image_file']['type'] =="image/jpeg" OR $_FILES['image_file']['type'] =="image/gif" OR $_FILES['image_file']['type'] =="image/pjpeg"))
{
echo"alert('Please only load JPG or GIF Picture files - which are supported by ManiMano.');"; 
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
