<?php
session_start();
include "../include/z_db.php";
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
<title>ManiMano - Help</title>
<link href="../style.css" rel="stylesheet" type="text/css" />


<script src="../js/swfobject.js" type="text/javascript"></script>
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
include "../include/session.php";

include "../include/z_db.php";

if($_POST["SendMail"] == "Send")
{
$ip = $_POST['ip']; 
$httpref = $_POST['httpref']; 
$httpagent = $_POST['httpagent']; 
$visitor = trim($_POST['visitor']); 
$visitormail = trim($_POST['visitormail']); 
$notes = trim($_POST['notes']);
$attn = trim($_POST['attn']);

if (eregi('http:', $notes)) {
$j="Please fill in all fields - so we can provide better support, thank you!" ;
}
if(($visitor=="") || ($visitormail=="") || ($notes=="" )) {
$j="Please fill in all fields - so we can provide better support, thank you!" ;
}

if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,"."))) 
{
$j="Please check your E-mail address - there seems to be an error." ;
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

$j="Your message has been successfully sent, thank you.";
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
	echo"<h4>Welcome, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

?>
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn3">
<input type=button value="Logout" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="My Infos" onclick=location.href="settings1.php" id="maindatbtn">
	<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Search' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Search' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn2">
<?php
echo" </div>";
}else
{
?>
 <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Register" onclick=location.href="register1.php?al='" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn">
		
<?php
echo" </div>";		
}
?>	

 
  <div class="mainContent">
	<div class="content">
		<span id="title">Help and Support:</span>
	  <table class="help_tbl">
		  <tr>
		    <td width="470"><p>If you need technical support, <br />
		      don't understand something, or just want to send us <br />
		      a feedback, then you can use the following features:</p>
		      <ol>
		        <li>
		          <div>
		            <p>Send us a e-mail about your e-mail program by clicking the following link: <a href="mailto:technik@manimano.ch">Technik@ManiMano.ch</a></p>
	              </div>
	            </li>
		        <li>
		          <div> Call us at local fees : <br />
		            <h2>0848 6264 6266 <br />
		              (0848 Mani Mano)</h2>
	              </div>
	            </li>
		        <li>
		          <div>
		            <p>Fill out the following form:</p>
		          
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
		                  <td>Name, Firstname: </td>
		                  <td><input type="text" name="visitor" id="namevor" style="float:right;" Value="<?php echo"$visitor";?>" /></td>
	                    </tr>
		                <tr>
		                  <td>Email:</td>
		                  <td><input type="text" name="visitormail" id="Email2" style="float:right;"  Value="<?php echo"$visitormail";?>" /></td>
	                    </tr>
		                <tr>
		                  <td>Subject:</td>
		                  <td><input type="text" name="attn" id="betreff" style="float:right;"  Value="<?php echo"$attn";?>"   /></td>
	                    </tr>
		                <tr>
		                  <td colspan="2">
                            Your Message:<br />
                            <textarea name="notes" id="ihre"  Value="<?php echo"$notes";?>" style="width:100%;"><?php echo"$notes";?></textarea>
                            <p><input type="submit" name="SendMail" id="abschickenbtn" value="Send" /></p>
                          </td>
	                    </tr>
	                  </table>
		            </form>
                  </li>
	            </ol>
                    <div style="font-size:100%; padding:0px 10px 20px 30px;">
                      <strong>Accident insurance:</strong><br />
                      The employer have to pay for Accident insurance of their employees by law(as soon as a wage is paid). This can be added to your current Accident insurance - The actual fee is 100.- / year.
                      <br /><br />
                      <strong>AHV-Payroll:</strong><br />
                      Für den Arbeitgeber (sobald ein Betrag für eine Leistung bezahlt wird) schreibt der Gesetzgeber die Abrechnung der Beiträge vor - und zwar, falls der Gesamtlohn für den Arbeitnehmer pro Jahr 2200.- übersteigt (entspricht 185.- monatlich).
                      <br /><br />
                      Sind die Beiträge geringer, ist die Abrechnung freiwillig - ausser bei allen Arbeiten in Privathaushalten - dort gibt es keine Mindestgrenze.
                      <br /><br />
                      The required steps are easy: A one time registration and a annual document submission - the Local authority and the SVA are very helpful.
                      <br /><br />
                      The required documents are available here:<br />
                      <a href="http://www.svazurich.ch/pdf/ak3002.pdf" target="_blank">http://www.svazurich.ch/pdf/ak3002.pdf</a>
                      <br /><br />
                      More documents are available at:<br />
                      <a href="http://www.svazurich.ch/index/index.cfm?page=service_formulare_ahv&sprache=de" target="_blank">http://www.svazurich.ch/index/index.cfm?page=service_formulare_ahv&amp;sprache=de</a>
                      <br /><br />
                      For further questions you can reach the SVA in Zürich at <br />
                      044 448 50 00.
                    </div>
	              </div>
	            </td>
		    <td width="400">
             <div id="Layerfilm">
             <p>Die Verabredung hat nicht zu Ihrer Zufriedenheit geklappt.<br />
             Die Person ist zu spät oder gar nicht erschienen.<br />
             Sie ist zwar erschienen, hatte aber eine unhygienische<br />
             Erscheinung oder war einfach nicht kompetent genug.<br />
             Wie können Sie in einer solchen Situation reagieren?<br />
             Natürlich können Sie alle Kommunikationswege auf der linken Seite nutzen - aber es ist noch viel besser, wenn Sie mit der betreffenden Person ins Reine kommen können. <br />
             Dazu haben wir hier ein paar Beispiele verfilmt.<br />
             Wir wünschen Ihnen viel Spass und Inspiration beim Betrachten der Filme.
             <br /><br />
             <strong>Idealfall</strong>: Der ManiMano-Gärtner
             <br /><br />
             <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer">
               <param name="movie" value="FLVPlayer_Progressive.swf" />
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=../images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
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
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=../images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Im Browser wird für Benutzer von Flash Player 6.0 und älteren Versionen der folgende alternative Inhalt angezeigt. -->
               <div>
                 <h4>Für den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
               </div>
               <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
             </object>
             <br /><br />
             <strong>Schwieriger Anfang führt doch <br />noch zum Ziel:<br /></strong>Der ManiMano-Arzttermin
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
                 <h4>Für den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
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
		alert("Please fill in all fields - so we can provide better support, thank you!");
		return false;
	}

	
	reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
	if (!formachka["visitormail"].value.match(reg)) {

		alert("Please check your E-mail address - there seems to be an error.");
		formachka["visitormail"].focus();
		return false;
	}
	
	if (formachka["notes"].value == "") {
		formachka["notes"].focus();

		alert("Please fill in all fields - so we can provide better support, thank you!");
		return false;
	}



alert("Your message has been successfully sent, thank you.");
return true;
}	
	
</script>
</body>
</html>
