<? ob_start(); ?>
<?php
include "../include/session.php";

include "../include/z_db.php";
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
$newimage = "../images/profile/" . $imagename;
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


if($_POST["submit"] == "Valider et la suite selon vos dispositions (2 sur 6)")
{
 include "../include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "../include/z_db.php";
 include("../geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw ";

   
$Nv = $_POST['Nv'];
  $errors = "";  


// validation new start 




$telats = $_POST['Nachname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûàèìòùáéíóúäöüãõÂÊÎÔÛÀÈÌÒÙÁÉÍÓÚÃÕ' ]*$#", $telats))
$errors .= "error.";  


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




//validation new end 



if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
 $errors .= "Bitte geben Sie den Namen Ihres Vereins, Ihrer Organisation oder öffentlichen Einrichtung ein.";  
$prof_prov = 1;
} else
$prof_prov = 0;

if($_POST['Nachname'] == "")  
    $errors .= "Bitte geben sie Ihren Nachnamen ein. ";   









if($_POST['Tel'] == "")  
    $errors .= "Bitte füllen Sie noch Ihre Telefonnummer (Festanschluss) aus.";
if($_POST['handy'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Handynummer an. ";
if($_POST['email'] == "")  
    $errors .= "Bitte geben Sie uns noch Ihre Email-Adresse an. ";
if($_POST['passwort'] == "")  
    $errors .= "Bitte geben Sie noch ein Passwort für Ihr Anmeldung bei ManiMano. ";
if(strlen ($_POST['passwort']) < 5)  
    $errors .= "Das Passwort muss mindestens 5 Buchstaben lang sein.";




  if ($errors == "") {   

$password = trim($_POST['passwort']);

$Nachname = trim($_POST['Nachname']);



//$Tel = $_POST['Tel'];
//$handy = $_POST['handy'];

$email = $_POST['email'];
//$handy = $_POST['handy'];

$myusername = trim($_POST['benutzername']);

if($_POST['vorzugs'] == "Handy") 
    $pre = 3;
if($_POST['vorzugs'] == "Festnetz") 
    $pre = 2;
if($_POST['vorzugs'] == "Email") 
    $pre = 1;


$stundenlohn = $_POST['stundenlohn'];
$bemerkung = $_POST['bemerkung'];

$firma = $_POST['Firma'];

$sql="UPDATE t_people SET  lastname = '$Nachname',   tel_p = '$Tel', tel_m = '$handy', email = '$email', password = '$password',   preferred_contact_by = '$pre', price_per_hour = '$stundenlohn', note = '$bemerkung', institution= '$firma',  prof_provider = '$prof_prov'  WHERE people_id ={$_SESSION['people_id']}";




  mysql_query($sql)or die(mysql_error());

//$sql="SELECT * FROM t_people WHERE username='$myusername'";
$sql="SELECT * FROM t_people WHERE  people_id ={$_SESSION['people_id']}";
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
if ($Nv==2)
header("location:settings2.php");
if ($Nv==3)
header("location:settings3.php");
if ($Nv==4)
header("location:settings4.php");
if ($Nv==5)
header("location:settings5.php");
if ($Nv==6)
header("location:settings6.php");
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


$Nv = 2;
if ($j <> "")
{

echo "<script language = 'javascript'>";
////echo "alert('test')";
//echo "alert(' $j ')";

echo "</script>" ;

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ManiMano - Einstellungen 1 von 6</title>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="tooltips.js"></script>

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
<style type="text/css"> 
<!-- 
.medium { 
   height: 12px; 
   width: 12px; 
} 
.hidden{
	display:none;
}
</style>

</head>

<body class="all">
<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Bienvenue, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
}else
{
header("location:index.php");	
}
?>
<input type=button value="Sur nous" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Infos légales" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type=button value="Sortir" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Mes données"  id="maindatbtn">
	<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Chercher' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Chercher' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type=button value="Aide" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
        <img src="images/page.png" border="0"  usemap="#green" align="right" />
		<span id="title">1) Données personnelles </span>
<map name="green">
<area shape="rect"  coords="40,0,56,29" href="javascript:Nav(2);">
<area shape="rect"  coords="59,2,78,29" href="javascript:Nav(3);">
<area shape="rect"  coords="84,2,98,30" href="javascript:Nav(4);">
<area shape="rect"  coords="101,1,119,30" href="javascript:Nav(5);">
<area shape="rect"  coords="125,0,140,30" href="javascript:Nav(6);">
</map>
	
<form method="post"  enctype="multipart/form-data" id="form1" name="Form1" action="settings1.php">
  <table class="settings_tbl">
    <tr>
      <td>Entreprise:</td>
      <td colspan="3"><input type="text" name="Firma" id="Firma" size="30" Value="<?php echo"$row[institution]";?>" ></td>
      <td><div style="position:relative;"><div style="position:absolute; top:-5px; left:0px; width:300px; color:#fff;">* Ces données sont obligatoires</div></div></td>
    </tr>
    <tr>
      <td colspan="5"><label>Association, Organisation ou Institution publique:&nbsp;&nbsp;
	    <?php if($row['prof_provider'] == 1) echo"<input type='checkbox' name='prov' checked >"; else echo"<input type='checkbox' name='prov' >";?></label>      </td>
      </tr>
    <tr>
      <td>Prénom:</td>
      <td><input type="text" name="Vorname" id="Vorname"  Value="<?php echo"$row[firstname]"; ?>"  DISABLED>&nbsp;<span class="star">*</span>       </td>
      <td style="text-align:right;">Nom:</td>
      <td><input type="text" name="Nachname" id="Nachname" Value="<?php echo"$row[lastname]"; ?>"  />&nbsp;<span class="star" id="star">*</span></td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>Sexe:</td>
      <td><?php if ($row['gender'] == 1){
	        echo "<select name='Gechleht' id='Gechleht' DISABLED>";
            echo "<option id='mannlich'>masculin</option>";
			echo "<option  SELECTED>féminin</option>";
			echo "</select>";
			} 
			if ($row['gender'] == 2){
			echo "<select name='Gechleht' id='Gechleht' DISABLED>";
			echo "<option id='mannlich' SELECTED>masculin</option>";
			echo "<option  >féminin</option>";
			echo "</select>";
			}?>      </td>
      <td style="text-align:right;">Date de naissance:</td>
      <td><?php list($yr,$mon,$day) = split('-',$row['birthdate']); $b=$day.".".$mon.".".$yr;?>
        <input type="text" name="Geb-datum" id="Geb-datum" Value="<?php echo"$b"; ?>" onFocus="document.getElementById('date').style.display='block'" onBlur="document.getElementById('date').style.display='none'" DISABLED>&nbsp;<span class="star">*</span></td>
      <td><div style="position:relative;"><div id="date" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Votre date de naissance ne sera pas publiée.<br />Nous pourrons l'utiliser par exemple<br />pour vérifier votre identité si vous nous téléphonez.<br />(Authentification).</div></div></td>
    </tr>
    <tr>
      <td style="vertical-align:top;">Photo:</td>
      <td colspan="3"><input type="image" name="Bild" id="Bild" src=<?php echo"'../images/profile/{$row['image_path']}'";echo "width=63 Height=84" ; ?> style="float:left; margin-right:10px;" onmouseover="document.getElementById('avatar').style.display='block'" onmouseout="document.getElementById('avatar').style.display='none'" />
      
   <div style="text-align:center; overflow:hidden; width:72px; height:24px; border:none; background:url(images/button_bg.gif) top left no-repeat;">
     <div style="color:#000; font-size:12px; padding:5px 0px 0px 0px;">Charger</div>
     <input type="file" name="image_file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" OnChange="javascript:document.Form1.UploadImage.click();" onmouseover="document.getElementById('avatar').style.display='block'" onmouseout="document.getElementById('avatar').style.display='none'">
   </div>
   
      
        <div id="h" class="hidden"><input type="submit" id="UploadImage" value="Upload Image" name="action"></div>      </td>
        <td><div style="position:relative;"><div id="avatar" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Une belle photo permettra de vous faire plus facilement confiance si vous n'êtes pas connu,  et vous serez identifié plus facilement si votre nom n'est pas connu (Obligatoire).</div></div></td>
      </tr>
    <tr>
      <td>Rue/N°</td>
      <td colspan="4"><input type="text" name="strasse" id="strasse" size="26" Value="<?php echo"$row[street]"; ?>" DISABLED   />
        <input type="text" name="Nr" id="Nr" size="10"  Value="<?php echo"$row[house_nr]"; ?>  " DISABLED  />&nbsp;<span class="star">*</span>      </td>
      </tr>
    <tr>
      <td>Code Postal/Ville:</td>
      <td colspan="4"><input type="text" name="plz" id="plz" size="11" Value="<?php echo"$row[zip]"; ?>  " DISABLED  />
        <input type="text" name="ort" id="ort" size="25" Value="<?php echo"$row[location]"; ?> " DISABLED   />&nbsp;<span class="star">*</span>      </td>
      </tr>
    <tr>
      <td>Tél:</td>
      <td><input type="text" name="Tel" id="Tel" Value="<?php echo"$row[tel_p]"; ?>" /></td>
      <td style="text-align:right;">Mobile:</td>
      <td><input type="text" name="handy" id="handy" Value="<?php echo"$row[tel_m]"; ?>" onFocus="document.getElementById('handy1').style.display='block'" onBlur="document.getElementById('handy1').style.display='none'" />&nbsp;<span class="star">*</span></td>
      <td><div style="position:relative;"><div id="handy1" style="position:absolute; top:-25px; left:0px; width:300px; color:#fff; display:none;">Le numéro de mobile est obligatoire.<br />Si vous oubliez votre mot de passe<br />il vous sera renvoyé par SMS.</div></div></td>
    </tr>
    <tr>
      <td>E-mail:</td>
      <td colspan="4"><input type="text" name="email" id="email" Value="<?php echo"$row[email]"; ?>" />&nbsp;<span class="star">*</span></td>
      </tr>
    <tr>
      <td>Moyen de contact préféré:</td>
      <td colspan="3">
	  <select name='vorzugs' id='vorzugs' onFocus="document.getElementById('vorg').style.display='block'" onBlur="document.getElementById('vorg').style.display='none'">
        <option <?php if( $row[preferred_contact_by]==3) echo"selected" ?>>Mobile</option>
        <option <?php if( $row[preferred_contact_by]==1) echo"selected" ?>>E-mail</option>
        <option <?php if( $row[preferred_contact_by]==2) echo"selected" ?>>Fixe</option>
      </select>&nbsp;<span class="star">*</span>
    </td>
		<td><div style="position:relative;"><div id="vorg" style="position:absolute; top:-15px; left:0px; width:300px; color:#fff; display:none;">Ici vous indiquez par quel moyen <br />vous préférez être joint.</div></div></td>
      </tr>
    <tr>
      <td>Identifiant:</td>
      <td><input type="text" name="benutzername" id="benutzername" Value="<?php echo"$row[username]"; ?>"  DISABLED onFocus="document.getElementById('pass').style.display='block'" onBlur="document.getElementById('pass').style.display='none'"></td>
      <td style="text-align:right;">Mot de passe:</td>
      <td><input type="password" name="passwort" id="passwort" Value="<?php echo"$row[password]"; ?>" /> <span class="star">*</span></td>
      <td><div style="position:relative;"><div id="pass" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Choississez un identifiant. <br />Nous vérifions s'il est disponible. <br />Conseil: Prénom. Nom. Ville, <br />ex. david.shchlaepfer.egg</div></div></td>
    </tr>
    <tr>
      <td>Salaire horaire:</td>
      <td colspan="3"><input type="text" name="stundenlohn" id="stundenlohn" size="11" Value="<?php echo"$row[price_per_hour]"; ?>" onFocus="document.getElementById('student').style.display='block'" onBlur="document.getElementById('student').style.display='none'" /> Fr.</td>
      <td><div style="position:relative;"><div id="student" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Indiquez ici le salaire horaire <br />désiré. Nous suggérons 19.-/<br />heure pour du travail non qualifié<br />(pas de formation particulière).</div></div></td>
      </tr>
    <tr>
      <td style="vertical-align:top;">Remarque:</td>
      <td colspan="3"><textarea name="bemerkung" cols="45" id="bemerkung" onFocus="document.getElementById('bemerkung1').style.display='block'" onBlur="document.getElementById('bemerkung1').style.display='none'" ></textarea></td>
      <td><div style="position:relative;"><div id="bemerkung1" onKeyDown="" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Ces remarques données  <br />apparaîtront dans la liste.<br />Idéal pour des restrictions ou<br />pour des qualifications ou services supplémentaires.</div></div></td>
      </tr>
    <tr>
      <td>&nbsp;</td>
      <td colspan="4"><input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">
        <input type="submit" name="submit" id="nextbtn" value="Valider et la suite selon vos dispositions (2 sur 6)" />      </td>
      </tr>
  </table>
</form>
<?php

if($_POST["submit"] == "Valider et la suite selon vos dispositions (2 sur 6)")
{

echo"<script type='text/javascript'>";

echo"var formachka = document.getElementById('form1');";
echo"Out:";	

echo" {";

if(isset($_POST['prov'])){ 
if($_POST['Firma'] == "")
echo"alert('Veuillez préciser le nom de votre Association, Organisation ou Institution publique.');"; 
$err = 1;
	echo"formachka['Firma'].focus();";
$prof_prov = 1;
echo"break  Out;"; 


} else
$prof_prov = 0;





// start Nachname

$Nach=trim($_POST['Nachname']);
if (empty ($Nach))
{
	//echo"if (formachka['Vorname'].value == '') {";
		echo"formachka['Nachname'].focus();";
		echo"alert('Veuillez nous donner votre nom.');";
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
		echo"alert('Veuillez ne pas utiliser de caractères spéciaux pour le nom.');";
$err = 1;
                                         echo"break  Out;";


}
}

//end

	
	


$Tel = $_POST['Tel'];
//start change for te;; phone 
$Tel  = preg_replace('/\D/', '', $Tel );
if(strlen ($Tel) == 10)  
{
$Tel  = $Tel[0].$Tel[1].$Tel[2].' '.$Tel[3].$Tel[4].$Tel[5].' '.$Tel[6].$Tel[7].' '.$Tel[8].$Tel[9];
} else 
{
		echo"formachka['Tel'].focus();";
		echo"alert('Donner votre numéro de téléphone sans l\'indicatif du pays: par ex. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}



//end
	
	echo"if (formachka['Tel'].value == '') {";
		echo"formachka['Tel'].focus();";
		echo"alert('Veuillez remplir votre numéro de téléphone fixe.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";


if(($Tel[0] <> "0") or   ($Tel[3] <> " ") or ($Tel[7] <> " ")or ($Tel[10] <> " "))
{
		echo"formachka['Tel'].focus();";
		echo"alert('Donner votre numéro de téléphone sans l\'indicatif du pays: par ex. (079 423 26 60)');";
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
		echo"alert('Donner votre numéro de téléphone mobile sans l\'indicatif du pays: par ex. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}



//end
	
	echo"if (formachka['handy'].value == '') {";
		echo"formachka['handy'].focus();";
		echo"alert('Veuillez nous donner un numéro de téléphone mobile.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

//if (! preg_match('/^0\d{9}$/', $handy)) 
if(($handy[0] <> "0") or   ($handy[3] <> " ") or ($handy[7] <> " ")or ($handy[10] <> " "))
{
		echo"formachka['handy'].focus();";
		echo"alert('Donner votre numéro de téléphone mobile sans l\'indicatif du pays: par ex. (079 423 26 60)');";
$err = 1;
echo"break  Out;";

}





if(str_replace(" ","",$_POST['email']) == "")  
{
//	echo" {";

		echo"alert('Veuillez nous donner une adresse email.');";
		echo"formachka['email'].focus();";
$err = 1;
echo"break  Out;";		
//echo"return false;";
//	echo"}";
} else
{
	echo"reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;";
	echo"if (!formachka['email'].value.match(reg)) {";

		echo"alert('L\'adresse email est incorrecte, veuillez la vérifier.');";
		echo"formachka['email'].focus();";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

}

	
	echo"if (formachka['passwort'].value == '') {";
		echo"formachka['passwort'].focus();";
		echo"alert('Veuillez donner un mot de passe pour votre identifiant.');";
$err = 1;
echo"break  Out;";		
//echo"return false;";
	echo"}";

if(strlen ($_POST['passwort']) < 5)  
{
		echo"formachka['passwort'].focus();";
		echo"alert('Le mot de passe doit contenir au moins 5 caractères.');";
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
		echo"alert('Le salaire horaire est incorrect, veuillez le vérifier.');";
$err = 1;
echo"break  Out;";

}
} else
{

echo"formachka['stundenlohn'].focus();";
		echo"alert('Le salaire horaire est incorrect, veuillez le vérifier.');";
$err = 1;
echo"break  Out;";

}


//echo"return true;";
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
