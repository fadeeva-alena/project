<?php
session_start();
include "include/z_db.php";
$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {

if ($row['Mode']=='On')
{
header("location:Maintenance.php");
}
}

$j="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ManiMano - Hilfe</title>
<link href="style.css" rel="stylesheet" type="text/css" />


<script src="js/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
	swfobject.registerObject("FLVPlayer", "9.0.0", "flash/expressInstall.swf");
	swfobject.registerObject("FLVPlayer1", "9.0.0", "flash/expressInstall.swf");
</script>
<style type="text/css">
<!--
.all #Layerfilm table tr td {
	color: #04617B;
}
.all #Layerfilm table {
	text-align: left;
}
-->
</style>
</head>

<body class="all">
<?php
include "include/session.php";

include "include/z_db.php";

if($_POST["SendMail"] == "Abschicken")
{
$ip = $_POST['ip']; 
$httpref = $_POST['httpref']; 
$httpagent = $_POST['httpagent']; 
$visitor = trim($_POST['visitor']); 
$visitormail = trim($_POST['visitormail']); 
$notes = trim($_POST['notes']);
$attn = trim($_POST['attn']);


if(($visitor=="") || ($visitormail=="") || ($notes=="" )) {
$j="Bitte füllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!" ;
}

if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,"."))) 
{
$j="Bitte überprüfen Sie Ihre Email-Adresse - diese scheint uns fehlerhaft zu sein." ;
}

if ($j=="")
{
$todayis = date("l, F j, Y, g:i a") ;

$attn = $attn ; 
$subject = $attn; 

$notes = stripcslashes($notes); 

$message = " $todayis [EST] \n
Attention: $attn \n
Message: $notes \n 
From: $visitor ($visitormail)\n
Additional Info : IP = $ip \n
Browser Info: $httpagent \n
Referral : $httpref \n
";


$from = "From: $visitormail\r\n";


mail("Technik@ManiMano.ch", $subject, $message, $from);

$j="Danke für die Nachricht, diese wurde ausgeliefert.";
$visitor = ""; 
$visitormail = ""; 
$notes = "";
$attn = "";
}
}

//if ($j <> "")
//{

//echo "<script language = 'javascript'>";
////echo "alert('test')";
//echo "alert(' $j ')";

//echo "</script>" ;
//}

?>

<div id="container">
	<?php
if ($_SESSION['auth'] == "yes"){
?>
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<?php
	echo"<h4>Bienvenue, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

?>
<input type=button value="Sur nous" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Infos légales" onclick=location.href="Rechtliches.php" id="helpbtn3">
<input type=button value="Sortir" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="Mes Données" onclick=location.href="settings1.php" id="maindatbtn">
	<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Chercher' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Chercher' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type=button value="Aide" onclick=location.href="help.php" id="helpbtn2">
<?php
echo" </div>";
}else
{
?>
 <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Sur nous" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Infos légales" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Inscription" onclick=location.href="location.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Aide" onclick=location.href="help.php" id="helpbtn">
		
<?php
echo" </div>";		
}
?>	

 
  <div class="mainContent">
	<div class="content">
		<span id="title">Aide et Support:</span>
	  <table class="help_tbl">
		  <tr>
		    <td width="470"><p>Si vous avez besoin d'un support technique, <br />
		      d'une réponse à une question, ou si vous voulez nous<br />
		      faire un retour, vous disposez des moyens suivants:</p>
		      <ol>
		        <li>
		          <div>
		            <p>Envoyer-nous un e-mail en cliquant sur le lien suivant: <a href="mailto:Technik@ManiMano.ch">Technik@ManiMano.ch</a></p>
	              </div>
	            </li>
		        <li>
		          <div> Appelez-nous au tarif local: <br />
		            <h2>0848 6264 6266 <br />
		              (0848 Mani Mano)</h2>
	              </div>
	            </li>
		        <li>
		          <div>
		            <p>Remplissez les champs suivants:</p>
		          
<form id="form1" name="form1" method="post" action="help.php" onsubmit="return verifyformachka();">

<!-- DO NOT change ANY of the php sections -->
<?php
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>

<input type="hidden" name="ip" value="<?php echo $ipi ?>" />
<input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
<input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />

		              <table id="tblnm">
		                <tr>
		                  <td>Nom, Prénom: </td>
		                  <td><input type="text" name="visitor" id="namevor" style="float:right;" Value="<?php echo"$visitor";?>" /></td>
	                    </tr>
		                <tr>
		                  <td>E-mail:</td>
		                  <td><input type="text" name="visitormail" id="Email2" style="float:right;"  Value="<?php echo"$visitormail";?>" /></td>
	                    </tr>
		                <tr>
		                  <td>Objet:</td>
		                  <td><input type="text" name="attn" id="betreff" style="float:right;"  Value="<?php echo"$attn";?>"   /></td>
	                    </tr>
		                <tr>
		                  <td colspan="2">
                            Vos informations:<br />
                            <textarea name="notes" id="ihre"  Value="<?php echo"$notes";?>" style="width:100%;"><?php echo"$notes";?></textarea>
                            <p><input type="submit" name="SendMail" id="abschickenbtn" value="Envoyer" /></p>
                          </td>
	                    </tr>
	                  </table>
		            </form>
                  </li>
	            </ol>
                    <div style="font-size:100%; padding:0px 10px 20px 30px;">
                      <strong>Assurance accidents:</strong><br />
		   Légalement (dès qu'il y a paiement pour une prestation) l'employeur doit souscrire à une assurance accident pour l'employé. Vous pouvez étendre votre propre assurance accident - le tarif actuel est de 100.-/ an.
                      <br /><br />
                      <strong>AHV-déclaration:</strong><br />
                      Légalement l'employeur (dès qu'il y a paiement pour une prestation) doit déclarer les paiements - dans le cas où le salaire total pour l'employé dépasse 2200.- par an
		      <br /><br />
		  Si les paiements sont moindres, la déclaration est à votre discrétion - excepté pour les travailleurs d'organismes privés- là il n'y a pas de minimum.
                      <br /><br />
                      La procédure est simple: une inscription unique et une fois par an, un formulaire à remplir (les services de la communes et la SVA sont prêts à vous assister si vous avez besoin d'aide).
		      <br /><br />
                     Les formulaires correspondants peuvent être téléchargés au lien suivant:<br />
                      <a href="http://www.svazurich.ch/pdf/ak3002.pdf" target="_blank">http://www.svazurich.ch/pdf/ak3002.pdf</a>
                      <br /><br />
                      Les formulaires sont disponible ici:<br />
                      <a href="http://www.svazurich.ch/index/index.cfm?page=service_formulare_ahv&sprache=de" target="_blank">http://www.svazurich.ch/index/index.cfm?page=service_formulare_ahv&amp;sprache=de</a>
                      <br /><br />
                      Pour de plus amples informations contacter le SVA à Zürich au numéro: <br />
                      044 448 50 00.
                    </div>
	              </div>
	            </td>
		    <td width="400">
             <div id="Layerfilm">
             <p>La prestation ne vous a pas donné entière satisfaction.<br />
             La personne  n'est pas venue ou est arrivée en retard.<br />
             Son hygiène était douteuse ou elle n'avait pas <br />
             les compétences requises.<br />
             Comment réagir dans de telles situations?<br />
             Bien sûr vous pouvez utiliser les moyens de communications proposés sur la page de gauche, mais l'idéal est de régler le problème avec cette personne vous-même. <br />
             Nous vous proposons à cet effet quelques exemples filmés.<br />
             Nous vous souhaitons de trouver l'inspiration de façon agréable, en regardant ces films.
             <br /><br />
             <strong>Cas idéal</strong>: Le jardinier ManiMano
             <br /><br />
             <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer">
               <param name="movie" value="FLVPlayer_Progressive.swf" />
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <!-- Dieses param-Tag fordert Benutzer von Flash Player 6.0 r65 und höher auf, die aktuelle Version von Flash Player herunterzuladen. Wenn Sie nicht wünschen, dass die Benutzer diese Aufforderung sehen, löschen Sie dieses Tag. -->
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Das nächste Objekt-Tag ist für Nicht-IE-Browser vorgesehen. Blenden Sie es daher mit IECC in IE aus. -->
               <!--[if !IE]>-->
                 <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="240" height="176">
               <!--<![endif]-->
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Im Browser wird für Benutzer von Flash Player 6.0 und älteren Versionen der folgende alternative Inhalt angezeigt. -->
               <div>
                 <h4>Pour visionner le contenu de cette page il est nécessaire d'avoir un version plus récente d'Adobe Flash Player.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
               </div>
               <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
             </object>
             <br /><br />
             <strong>Un début difficile <br />mais une mission accomplie:<br /></strong>Le rendez-vous chez le medecin avec ManiMano
             <br /><br />
             <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer1">
               <param name="movie" value="FLVPlayer_Progressive.swf" />
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/arzttermin_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <!-- Dieses param-Tag fordert Benutzer von Flash Player 6.0 r65 und höher auf, die aktuelle Version von Flash Player herunterzuladen. Wenn Sie nicht wünschen, dass die Benutzer diese Aufforderung sehen, löschen Sie dieses Tag. -->
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Das nächste Objekt-Tag ist für Nicht-IE-Browser vorgesehen. Blenden Sie es daher mit IECC in IE aus. -->
               <!--[if !IE]>-->
                 <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="240" height="176">
               <!--<![endif]-->
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/arzttermin_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Im Browser wird für Benutzer von Flash Player 6.0 und älteren Versionen der folgende alternative Inhalt angezeigt. -->
               <div>
                 <h4>Pour visionner le contenu de cette page il est nécessaire d'avoir un version plus récente d'Adobe Flash Player.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
               </div>
               <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
             </object>
             </p>
           </div>
            </td>
	      </tr>
	  </table>

    </div>
  </div>
</div>
<script type="text/javascript">
<!--
swfobject.registerObject("FLVPlayer");
swfobject.registerObject("FLVPlayer1");
//-->
</script>
<script type="text/javascript">

var formachka = document.getElementById('form1');

function verifyformachka() {

	if (formachka["visitor"].value == "") {
                 
		formachka["visitor"].focus();
		alert("Veuillez saisir tous les champs, afin de pouvoir traiter votre demande, Merci!");
		return false;
	}

	
	reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
	if (!formachka["visitormail"].value.match(reg)) {

		alert("Veuillez vérifier votre adresse e-mail, il semble qu'elle soit erronée.");
		formachka["visitormail"].focus();
		return false;
	}
	
	if (formachka["notes"].value == "") {
		formachka["notes"].focus();

		alert("Veuillez saisir tous les champs, afin de pouvoir traiter votre demande, Merci!");
		return false;
	}



alert("Merci pour l'information, elle sera transmise.");
return true;
}	
	
</script>
</body>
</html>
