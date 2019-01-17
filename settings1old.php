<? ob_start(); ?>
<?php
include "include/session.php";

include "include/z_db.php";
include "include/class.upload.php";
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

if($imgn <>"")
{
    $im = "images/profile/" . $imgn ;
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
  $handle->process('images/profile/temp/');
 if ($handle->processed) {
   
     $handle->clean();
//rename("/tmp/tmp_file.txt", "/home/user/login/docs/my_file.txt");sory i am confuse today what the total values of the vouchers 

//$im = "images/profile/" . $imgn ;
//$k=$imagename;
//$imgn=$imagename;
   } 

}

rename("images/profile/temp/".$imgn , "images/profile/".$imgn);
// End Change

}
    else
{
 $image_x              = 63;
$image_y             = 84;
    if( $gen== 1)
    $im = "images/profile/no_picture_she.jpg" ;
    else
    $im = "images/profile/no_picture_he.jpg" ;
}



$sql="UPDATE t_people SET image_path ='$imgn' WHERE people_id ={$_SESSION['people_id']}";
  mysql_query($sql)or die(mysql_error());
}
}


if($_POST["submit"] == "Speichern und weiter zur zeitlichen Verfügbarkeit (2 von 6)")
{
 include "include/session.php";
//$tmp = new geocode( $location, $address, $city, $country, $state, $zip );

include "include/z_db.php";
 include("geocode.class.php");
 // Your Google Maps API key
   $key = "ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRRIp1CjqXfrLIFy_CJyJ2waTRMECRS3_IoP2-n5jNjMjL57GCOw2nwCQw ";

   
$Nv = $_POST['Nv'];
  $errors = "";  


// validation new start 




$telats = $_POST['Nachname'];
$telats = preg_replace('/[\s]+/is', ' ', $telats );   
$telats= trim($telats);
if(!preg_match("#^[-A-Za-zâêîôûÂÊÎÔÛàèìòùÀÈÌÒÙáéíóúÁÉÍÓÚäöüÖÜÄãõÃÕ' ]*$#", $telats))
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
$bemerkung = mysql_real_escape_string($_POST['bemerkung']);

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
<?php require('header.php'); ?>
  <div id ="contentIndex">
  <h1 id="title">1) Persönliche Daten <img src="images/page.png" border="0"  usemap="#green" align="right" /></h1>


    
<map name="green">
<area shape="rect"  title="Zeitliche Verfügbarkeit" coords="40,0,56,29" href="javascript:Nav(2);">
<area shape="rect"  title="Angebotsprofil" coords="59,2,78,29" href="javascript:Nav(3);">
<area shape="rect"  title="Bedürfnisprofil"  coords="84,2,98,30" href="javascript:Nav(4);">
<area shape="rect"  title="Über meine Person" coords="101,1,119,30" href="javascript:Nav(5);">
<area shape="rect"  title="Rechtliche Aspekte" coords="125,0,140,30" href="javascript:Nav(6);">
</map>
  
<form method="post"  enctype="multipart/form-data" id="form1" name="Form1" action="settings1.php">
  	
  	<div class='row'>
      <div class='col-md-3'>Firma:</div>
      <div class='col-md-3'><input type="text" name="Firma" id="Firma" size="30" Value="<?php echo"$row[institution]";?>" ></div>
      <div class='col-md-6'>
      		<div style="text-align:right;color:#fff;">* Diese Angaben sind notwendig</div>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Verein, Organisation oder öffentliche Einrichtung:</div>
      <div class='col-md-3'><?php if($row['prof_provider'] == 1) echo"<input type='checkbox' name='prov' checked >"; else echo"<input type='checkbox' name='prov' >";?></div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Vorname:</div>
      <div class='col-md-3'><input type="text" name="Vorname" id="Vorname"  Value="<?php echo"$row[firstname]"; ?>"  DISABLED>&nbsp;<span class="star">*</span>       </div>
      <div class='col-md-1'>Nachname:</div>
      <div class='col-md-5'><input type="text" name="Nachname" id="Nachname" Value="<?php echo"$row[lastname]"; ?>"  />&nbsp;<span class="star" id="star">*</span></div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Geschlecht:</div>
      <div class='col-md-3'><?php if ($row['gender'] == 1){
          echo "<select name='Gechleht' id='Gechleht' DISABLED>";
            echo "<option id='mannlich'>männlich</option>";
      echo "<option  SELECTED>weiblich</option>";
      echo "</select>";
      } 
      if ($row['gender'] == 2){
      echo "<select name='Gechleht' id='Gechleht' DISABLED>";
      echo "<option id='mannlich' SELECTED>männlich</option>";
      echo "<option  >weiblich</option>";
      echo "</select>";
      }?>      </div>
      <div class='col-md-1' style="padding:0;">Geb.-Datum:</div>
      <div class='col-md-3'><?php list($yr,$mon,$day) = preg_split("/-/",$row['birthdate']); $b=$day.".".$mon.".".$yr;?>
        <input type="text" name="Geb-datum" id="Geb-datum" Value="<?php echo"$b"; ?>" onFocus="document.getElementById('date').style.display='block'" onBlur="document.getElementById('date').style.display='none'" DISABLED>&nbsp;<span class="star">*</span></div>
      <div class='col-md-3'><div style="position:relative;"><div id="date" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Ihr Geburtsdatum wird nicht veröffentlicht.<br />Wir können es aber z.B. einsetzen, um<br />sicherzustellen, dass wirklich Sie anrufen<br />(Authentifizierung).</div></div></div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Bild:</div>
      <div class='col-md-3'>
        <input type="image" name="Bild" id="Bild" src=<?php echo"'images/profile/{$row['image_path']}'";?> style="float:left; margin-right:10px;" onmouseover="document.getElementById('avatar').style.display='block'" onmouseout="document.getElementById('avatar').style.display='none'" />
        <div style="text-align:center; overflow:hidden; width:72px; height:24px; border:none; background:url(images/button_bg.gif) top left no-repeat;">
          <div style="color:#000; font-size:12px; padding:5px 0px 0px 0px;">Bild laden</div>
          <input type="file" name="image_file" size="1" style="margin-top: -50px; margin-left:-410px; -moz-opacity: 0; filter: alpha(opacity=0); opacity: 0; font-size: 150px; height: 100px;" OnChange="javascript:document.Form1.UploadImage.click();" onmouseover="document.getElementById('avatar').style.display='block'" onmouseout="document.getElementById('avatar').style.display='none'">
        </div>
        <div id="h" class="hidden"><input type="submit" id="UploadImage" value="Upload Image" name="action"></div>
      </div>
      <div class='col-md-3'>
        <div style="position:relative;">
          <div id="avatar" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Wenn man Sie noch nicht kennt, fasst man viel leicht Vertrauen zu Ihnen, wenn Sie hier ein schönes Bild hinterlegen - und man erkennt Sie wieder, auch wenn man Ihren Namen nicht kennt (Pflicht).</div>
        </div>
      </div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Strasse/Nr.</div>
      <div class='col-md-3'><input type="text" name="strasse" id="strasse" size="26" Value="<?php echo"$row[street]"; ?>" DISABLED   />
        <input type="text" name="Nr" id="Nr" size="10"  Value="<?php echo"$row[house_nr]"; ?>  " DISABLED  />&nbsp;<span class="star">*</span>      </div>
      </div>
    <div class='row'>
      <div class='col-md-3'>PLZ/Ort:</div>
      <div class='col-md-3'><input type="text" name="plz" id="plz" size="11" Value="<?php echo"$row[zip]"; ?>  " DISABLED  />
        <input type="text" name="ort" id="ort" size="25" Value="<?php echo"$row[location]"; ?> " DISABLED   />&nbsp;<span class="star">*</span>      </div>
      </div>
    <div class='row'>
      <div class='col-md-3'>Tel. P:</div>
      <div class='col-md-3'><input type="text" name="Tel" id="Tel" Value="<?php echo"$row[tel_p]"; ?>" /></div>
      <div class='col-md-1'>Handy:</div>
      <div class='col-md-3'><input type="text" name="handy" id="handy" Value="<?php echo"$row[tel_m]"; ?>" onFocus="document.getElementById('handy1').style.display='block'" onBlur="document.getElementById('handy1').style.display='none'" />&nbsp;<span class="star"></span></div>
      <div class='col-md-3'><div style="position:relative;"><div id="handy1" style="position:absolute; top:-25px; left:0px; width:300px; color:#fff; display:none;">Die Angabe der Handynummer ist<br />notwendig. Falls Sie das Passwort<br />vergessen wir lhnen dieses per SMS zu.</div></div></div>
    </div>
    <div class='row'>
      <div class='col-md-3'>E-mail:</div>
      <div class='col-md-3'><input type="text" name="email" id="email" Value="<?php echo"$row[email]"; ?>" />&nbsp;<span class="star">*</span></div>
      </div>
    <div class='row'>
      <div class='col-md-3'>Vorzugs-Kontaktart:</div>
      <div class='col-md-3'>
        <select name='vorzugs' id='vorzugs' onFocus="document.getElementById('vorg').style.display='block'" onBlur="document.getElementById('vorg').style.display='none'">
          <option <?php if( $row[preferred_contact_by]==3) echo"selected" ?>>Handy</option>
          <option <?php if( $row[preferred_contact_by]==1) echo"selected" ?>>Email</option>
          <option <?php if( $row[preferred_contact_by]==2) echo"selected" ?>>Festnetz</option>
        </select>&nbsp;<span class="star">*</span>
      </div>
      <div class='col-md-3'><div style="position:relative;"><div id="vorg" style="position:absolute; top:-15px; left:0px; width:300px; color:#fff; display:none;">Hier können sie angeben, wie sie am <br />Liebsten erreicht werden können</div></div></div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Benutzername:</div>
      <div class='col-md-3'><input type="text" name="benutzername" id="benutzername" Value="<?php echo"$row[username]"; ?>"  DISABLED onFocus="document.getElementById('pass').style.display='block'" onBlur="document.getElementById('pass').style.display='none'"></div>
      <div class='col-md-1'>Passwort:</div>
      <div class='col-md-5 passd'><input type="password" name="passwort" id="passwort" Value="<?php echo"$row[password]"; ?>" style="display:block;" /> <span class="star">*</span></div>
      <div class='col-md-3'><div style="position:relative;"><div id="pass" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Sie können einen Benutzernamen wählen. <br />Wir prüfen, ob er noch frei ist. <br />Wir schlagen Vorname. Nachname. Ort vor, <br />zb. david.shchlaepfer.egg</div></div></div>
    </div>
    <div class='row'>
      <div class='col-md-3'>Stundenlohn:</div>
      <div class='col-md-3'><input type="text" name="stundenlohn" id="stundenlohn" size="11" Value="<?php echo"$row[price_per_hour]"; ?>" onFocus="document.getElementById('student').style.display='block'" onBlur="document.getElementById('student').style.display='none'" /> Fr.</div>
      <div class='col-md-3'><div style="position:relative;"><div id="student" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Hier können Sie lhren gewünschten <br />Stundenlohn eingeben. Wir schlagen 19.-/<br />Stunde für unqualifizierte Arbeiten vor.<br />(ohne entsp. Ausbildung).</div></div></div>
      </div>
    <div class='row'>
		<div class='col-md-3'>Bemerkung:</div>
		<div class='col-md-3'>
			<textarea name="bemerkung" cols="45" id="bemerkung" onFocus="document.getElementById('bemerkung1').style.display='block'" onBlur="document.getElementById('bemerkung1').style.display='none'" ><?php echo"$row[note]";?></textarea>
		</div>
		<div class='col-md-3'>
			<div style="position:relative;">
				<div id="bemerkung1" onKeyDown="" style="position:absolute; top:-30px; left:0px; width:300px; color:#fff; display:none;">Die Bemerkung, welche Sie hier eingeben <br />wird bei in der Trefferliste mitangezeigt. <br />Ideal z.B. für Einschränkungen oder<br />zusätzliche Angaben / Qualifizierungen.</div>
			</div>
		</div>
    </div>
    <div class='row'>
		<div class='col-md-12'>
			<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">
			<input type="submit" name="submit" id="nextbtn" value="Speichern und weiter zur zeitlichen Verfügbarkeit (2 von 6)" />
		</div>
    </div>

  <table class="settings_tbl">
  </table>

</form>
<script type="text/javascript">


function Nav(i)
{
document.getElementById("Nv").value = i;
document.Form1.submit.click(); 

}

</script>
<?php

if($_POST["submit"] == "Speichern und weiter zur zeitlichen Verfügbarkeit (2 von 6)")
{

echo"<script type='text/javascript'>";

echo"var formachka = document.getElementById('form1');";
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








if(str_replace(" ","",$_POST['email']) == "")  
{
//  echo" {";

    echo"alert('Bitte geben Sie uns noch Ihre Email-Adresse an.');";
    echo"formachka['email'].focus();";
$err = 1;
echo"break  Out;";    
//echo"return false;";
//  echo"}";
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

echo"</script>";
}


?>


  </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
