<? ob_start(); ?>
<?php
session_start();
include "include/z_db.php";
$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);
while ($row=mysql_fetch_array($result)) {
  if ($row['Mode']=='On'){
    header("location:Maintenance.php");
  }
}
$j="";
?>
<?php require("header.php");?>
<?php
include "include/session.php";
include "include/z_db.php";
if($_POST["f2s"] == 1){
  $sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
  $result=mysql_query($sql);
  $row=mysql_fetch_array($result);
  $to = 'doris.pauletto@pilet-partner.ch, doris.pauletto@bluewin.ch, Technik@ManiMano.ch ,'.$row['email'];
  //$to = $row['email'];
  $subject = 'Offertanfrage fuer Haftpflichtversicherung';

  $headers = "From: " . "Technik@ManiMano.ch". "\r\n";

  $headers .= "MIME-Version: 1.0\r\n";
  $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

  $message = '<html>';
  $message .='<meta content=';
  $message .='text/html; charset=windows-1251';
  $message .=' http-equiv=Content-Type>';
  $message .='<style type=';
  $message .='text/css';
  $message .='>';
  $message .='
    html,body{

    font-size: 12px;

    font-family: Arial;

    }
    a:active,

    a:visited,

    a:link {

    	color: rgb(0, 0, 255);

    	text-decoration:underline;

    	font-weight:bold;

    	}
    a:hover {

    	color: #4b719e;

    	text-decoration: underline;

    	}
    </style>
    <body>';


$message .='Sehr geehrte Frau Pauletto<br><br> ';
$message.='Untenstehender ManiMano-Teilnehmer wГјnscht eine Offerte per Email:<br>';
if($row['prof_provider'] == 1)
{
$message.='<b>Firma:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  ';
$message.=$row[institution];
$message.='<br>';
}
if ($row['gender'] == 1)
{
$message .='<b>Vorname, Nachname:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  Frau ';
$message.=$row[firstname];
$message.=' ';
$message.=$row[lastname];
$message.='<br>';
} else
{
$message .='<b>Vorname, Nachname:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b>  Herr ';
$message.= $row[firstname];
$message.=' ';
$message.= $row[lastname];
$message.='<br>';
}


$message .='<b>Adresse:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
$message.= $row[street];
$message.=' ';
$message.= $row[house_nr];
$message.='<br>';

$message .='<b>Ort:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
$message.= $row[zip];
$message.=' ';
$message.= $row[location];
$message.='<br>';

$message .='<b>Email:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
$message.= $row[email];
$message.='<br>';

$message .='<b>Handy:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
$message.= $row[tel_m];
$message.='<br>';

$message .='<b>Tel. priv.:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
$message.= $row[tel_p];
$message.='<br>';


$message .='<b>Am besten erreichbar:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
if ($row['preferred_contact_by'] == 3)
$message.='Handy <br>';
if ($row['preferred_contact_by'] == 1)
$message.='Email <br>';
if ($row['preferred_contact_by'] == 2)
$message.='Festnetz <br>';
list($yr,$mon,$day) = split('-',$row['birthdate']); 
$b=$day.".".$mon.".".$yr;
$message .='<b>Geburtsdatum:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> ';
$message.= $b;
$message.='<br>';

$message.='<p>Wichtiger Hinweis: Alle VertragsverhГ¤ltnisse werden zwischen den beteiligten
Parteien abgewickelt. ManiMano ist nicht Vertragspartei, sondern stellt
lediglich die Plattform zur VerfГјgung, und ist in keinem Fall haftbar.
(V.3.8.11) </p><br>';

$message .='<map name=';
$message .='map1';
$message .='>

<area title=';
$message .='D-S-C';
$message .=' shape=';
$message .='RECT';
$message .=' coords=';
$message .='500,90,593,99';
$message .=' href=';
$message .='http://www.D-S-C.ch';
$message .=' alt=';
$message .='D-S-C';
$message .='>

<area shape=';
$message .='rect';
$message .=' coords=';
$message .='10,54,134,73';
$message .=' href=';
$message .='www.manimano.ch';
$message .='> 

</map>';

$message .='<img usemap=';
$message .='#map1';
$message .=' src=';
$message .='http://www.manimano.ch/images/email_footer.gif';
$message .=' alt=';
$message .='map of GH site';
$message .=' border=';
$message .='0';
$message .='></div>

</body>

</html>';
mail($to, $subject, $message, $headers);



}

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
$j="Bitte fГјllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!" ;
}

if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,"."))) 
{
$j="Bitte ГјberprГјfen Sie Ihre Email-Adresse - diese scheint uns fehlerhaft zu sein." ;
}

if ($j=="")
{
$todayis = date("l, F j, Y, g:i a") ;

$attn = $attn ; 
$subject = $attn; 

$notes = $notes;

$notes; 

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

$j="Danke fuer die Nachricht, diese wurde ausgeliefert.";
$visitor = ""; 
$visitormail = ""; 
$notes = "";
$attn = "";
}
}



?>
<div id="contentIndex">
		<h1>Hilfe und UnterstГјtzung:</h1>
	  <div class="row help_tbl">
        <div class="col-md-6">
          <p>Falls Sie technische Unterstützung wГјnschen,<br />
          etwas nicht verstehen, oder uns ein Feedback<br />
          geben wollen, dann stehen ihnen folgende MГ¶glichkeiten zur VerfГјgung:</p>
          <ol>
            <li>
              <div>
                <p>Schicken Sie uns ein Email Гјber lhre Email-Programm, indem Sie folgenden<br />
                 Link anklicken: <a href="mailto:technik@manimano.ch">technik@manimano.ch</a></p>
              </div>
            </li>
            <li>
              <div> Rufen Sie uns an zum Ortstarif: <br />
                <h2>0848 6264 6266 <br />
                  (0848 Mani Mano)</h2>
                </div>
            </li>
            <li>
              <div>
                <p>FГјllen Sie die nachfolgenden Felder aus:</p>
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
                      <td>Name, Vorname: </td>
                      <td><input type="text" name="visitor" id="namevor" style="float:right;" Value="<?php echo"$visitor";?>" /></td>
                      </tr>
                    <tr>
                      <td>Email:</td>
                      <td><input type="text" name="visitormail" id="Email2" style="float:right;"  Value="<?php echo"$visitormail";?>" /></td>
                      </tr>
                    <tr>
                      <td>Betreff:</td>
                      <td><input type="text" name="attn" id="betreff" style="float:right;"  Value="<?php echo"$attn";?>"   /></td>
                      </tr>
                    <tr>
                      <td colspan="2">
                            Ihre Nachricht:<br />
                            <textarea name="notes" id="ihre"  Value="<?php echo"$notes";?>" style="width:100%;"><?php echo"$notes";?></textarea>
                            <p><input type="submit" name="SendMail" id="abschickenbtn" value="Abschicken" /></p>
                          </td>
                      </tr>
                  </table>
                </form>
              </li>
            </ol>
            <div style="font-size:100%; padding:0px 10px 20px 30px;">
              <strong>Unfallversicherung:</strong><br />
                FГјr den Arbeitgeber (sobald ein Betrag fГјr eine Leistung bezahlt wird) schreibt der Gesetzgeber eine Unfallversicherung fГјr die Angestellten vor. Diese kГ¶nnen Sie Гјber zusГ¤tzlich zu Ihrer Unfallversicherung abschliessen - der aktuelle Tarif ist 100.- / Jahr.
              <br /><br />
              <strong>AHV-Abrechnung:</strong><br />
              FГјr den Arbeitgeber (sobald ein Betrag fГјr eine Leistung bezahlt wird) schreibt der Gesetzgeber die Abrechnung der BeitrГ¤ge vor - und zwar, falls der Gesamtlohn fГјr den Arbeitnehmer pro Jahr 2300.- Гјbersteigt (entspricht 192.- monatlich).
              <br /><br />
              Sind die BeitrГ¤ge geringer, ist die Abrechnung freiwillig - ausser bei allen Arbeiten in Privathaushalten - dort gibt es keine Mindestgrenze.
              <br /><br />
              Das Vorgehen ist einfach: Eine einmalige Anmeldung und einmal jГ¤hrlich das AusfГјllen eines Formulars - die GemeindebehГ¶rden und die SVA sind sehr hilfsbereit, falls Sie UnterstГјtzung benГ¶tigen.
              <br /><br />
             Die entsprechenden Formulare kГ¶nnen unter folgendem Link heruntergeladen werden:<br />
              <a href="http://www.svazurich.ch/pdf/ak3002.pdf" target="_blank">http://www.svazurich.ch/pdf/ak3002.pdf</a>
              <br /><br />
              Weitere Formulare sind verfГјgbar unter:<br />
              <a href="http://www.svazurich.ch/internet/de/service/formularbibliothek.html?checklist-rubrik-o3=Private" target="_blank">http://www.svazurich.ch/index/index.cfm?page=service_formulare_ahv&amp;sprache=de</a>
              <br /><br />
              Und fГјr weitere Fragen erreichen Sie die SVA in ZГјrich unter <br />
              044 448 50 00.
            </div>
          </div>
          <div class="col-md-6">
             <div id="Layerfilm">
              <p>Die Verabredung hat nicht zu Ihrer Zufriedenheit geklappt.<br />
              Die Person ist zu spГ¤t oder gar nicht erschienen.<br />
              Sie ist zwar erschienen, hatte aber eine unhygienische<br />
              Erscheinung oder war einfach nicht kompetent genug.<br />
              Wie kГ¶nnen Sie in einer solchen Situation reagieren?<br />
              NatГјrlich kГ¶nnen Sie alle Kommunikationswege auf der linken Seite nutzen - aber es ist noch viel besser, wenn Sie mit der betreffenden Person ins Reine kommen kГ¶nnen. <br />
              Dazu haben wir hier ein paar Beispiele verfilmt.<br />
              Wir wГјnschen Ihnen viel Spass und Inspiration beim Betrachten der Filme.
              <br /><br />
              <strong>Idealfall</strong>: Der ManiMano-GГ¤rtner
              <br /><br />
              <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer">
                <param name="movie" value="FLVPlayer_Progressive.swf" />
                <param name="quality" value="high" />
                <param name="wmode" value="opaque" />
                <param name="scale" value="noscale" />
                <param name="salign" value="lt" />
                <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
                <param name="swfversion" value="8,0,0,0" />
                <!-- Dieses param-Tag fordert Benutzer von Flash Player 6.0 r65 und hГ¶her auf, die aktuelle Version von Flash Player herunterzuladen. Wenn Sie nicht wГјnschen, dass die Benutzer diese Aufforderung sehen, lГ¶schen Sie dieses Tag. -->
                <param name="expressinstall" value="../Scripts/expressInstall.swf" />
                <!-- Das nГ¤chste Objekt-Tag ist fГјr Nicht-IE-Browser vorgesehen. Blenden Sie es daher mit IECC in IE aus. -->
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
                  <!-- Im Browser wird fГјr Benutzer von Flash Player 6.0 und Г¤lteren Versionen der folgende alternative Inhalt angezeigt. -->
                  <div>
                    <h4>FГјr den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
                    <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
                  </div>
                <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
              </object>
              <br /><br />
              <strong>Schwieriger Anfang fГјhrt doch <br />noch zum Ziel:<br /></strong>Der ManiMano-Arzttermin
              <br /><br />
              <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer1">
                <param name="movie" value="FLVPlayer_Progressive.swf" />
                <param name="quality" value="high" />
                <param name="wmode" value="opaque" />
                <param name="scale" value="noscale" />
                <param name="salign" value="lt" />
                <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/arzttermin_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
                <param name="swfversion" value="8,0,0,0" />
                <!-- Dieses param-Tag fordert Benutzer von Flash Player 6.0 r65 und hГ¶her auf, die aktuelle Version von Flash Player herunterzuladen. Wenn Sie nicht wГјnschen, dass die Benutzer diese Aufforderung sehen, lГ¶schen Sie dieses Tag. -->
                <param name="expressinstall" value="../Scripts/expressInstall.swf" />
                <!-- Das nГ¤chste Objekt-Tag ist fГјr Nicht-IE-Browser vorgesehen. Blenden Sie es daher mit IECC in IE aus. -->
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
                  <!-- Im Browser wird fГјr Benutzer von Flash Player 6.0 und Г¤lteren Versionen der folgende alternative Inhalt angezeigt. -->
                  <div>
                    <h4>FГјr den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
                    <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
                  </div>
                  <!--[if !IE]>-->
                </object>
              <!--<![endif]-->
              </object>
            </p>
            <strong>UnterstГјtzende Dokumente zum Herunterladen:</strong><br>
            <?php           
            if ($_SESSION['auth'] == "yes"){
            echo"<li><a href='help2.php?al=1' target='_blank' >Quittung fГјr den Auftraggeber</a><br>";
            echo"<li><a href='help2.php?al=2' target='_blank' >Quittung fГјr den Auftragnehmer</a><br>";
            echo"<li><a href='downloads/Kurzfragebogen fГјr Kurzzeitarbeitgeber.pdf' target='_blank'>Kurzfragebogen fГјr Kurzzeitarbeit-/Auftraggeber</a><br>";
            echo"<li><a href='downloads/Kurzfragebogen fГјr Kurzzeitarbeitnehmer.pdf' target='_blank'>Kurzfragebogen fГјr Kurzzeitarbeit-/Auftragnehmer</a><br>";
            echo"<li><a href='downloads/ManiMano-AHV.pdf' target='_blank'>Merkblatt ManiMano und die AHV</a><br>";
            } else
            {
            echo"<li>Quittung fГјr den Auftraggeber *<br>";
            echo"<li>Quittung fГјr den Auftragnehmer *<br>";
            echo"<li><a href='downloads/Kurzfragebogen fГјr Kurzzeitarbeitgeber.pdf' target='_blank'>Kurzfragebogen fГјr Kurzzeitarbeit-/Auftraggeber</a><br>";
            echo"<li><a href='downloads/Kurzfragebogen fГјr Kurzzeitarbeitnehmer.pdf' target='_blank'>Kurzfragebogen fГјr Kurzzeitarbeit-/Auftragnehmer</a><br>";
            echo"<li><a href='downloads/ManiMano-AHV.pdf' target='_blank'>Merkblatt ManiMano und die AHV</a><br><br><br>";

            echo "* Diese Dokumente erst nach Anmeldung verfГјgbar. <br>";


            }?>
            <br>
            <form id="form2" name="form2" method="post" action="help.php" >
              <input type="hidden" name="f2s" value="1" />
              <?php /*          
              if ($_SESSION['auth'] == "yes"){
              echo"<strong>Privathaftpflicht </strong><br>";
              echo"<p>";
              echo"<a href='javascript: submitform()' >Klicken Sie hier</a>, wird mit Ihren persГ¶nlichen Daten direkt eine Offertanfrage von Frau Pauletto, (Versicherungsmaklerin) eingeholt. Sie erhalten eine Kopie des Emails.</p>";

              } else
              {
              echo"<strong>Privathaftpflicht (erst nach Anmeldung verfГјgbar)
              </strong><br>";
              echo"<p>";
              echo"Klicken Sie hier, wird mit Ihren persГ¶nlichen Daten direkt eine Offertanfrage von Frau Pauletto, (Versicherungsmaklerin) eingeholt. Sie erhalten eine Kopie des Emails.</p>";

              }*/?>
            </form>
            <script type="text/javascript">
              function submitform()
              {
                document.form2.submit();
              }
            </script>
          </div>
        </div>
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
  		alert("Bitte fГјllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!");
  		return false;
  	}
  	reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/';
  	if (!formachka["visitormail"].value.match(reg)) {

  		alert("Bitte ГјberprГјfen Sie Ihre Email-Adresse - diese scheint uns fehlerhaft zu sein.");
  		formachka["visitormail"].focus();
  		return false;
  	}
  	if (formachka["notes"].value == "") {
  		formachka["notes"].focus();

  		alert("Bitte fГјllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!");
  		return false;
  	}
  alert("Danke fГјr die Nachricht, diese wurde ausgeliefert.");
  return true;
  }	
  	
  </script>
</body>
</html>
<? ob_flush(); ?>
