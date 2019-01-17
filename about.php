<?php session_start();
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
<?php require("header.php");?>
<div id="contentIndex" class="row">
	<h1>Was ist ManiMano?</h1>
			<div class="paragraph3">
			<p><span>Mani</span><span>Mano</span> ist eine Online-Nachbarschaftshilfe für Gemeinden und Städten.</p></div>
			<div style="float:right; padding:7px"><a href="http://www.manimano.ch/images/arbeitsflussdiagramm_manimano.jpeg" target="_blank"><img class="img-responsive" border="0" width="260" height="300" src="images/arbeitsflussdiagramm_manimano_small.jpeg" alt="Arbeitsflussdiagramm ManiMano"/></a><br /><span style="color:#FFFFFF">&nbsp;&nbsp;&nbsp;(Anklicken zum vergrössern)</span></div>
			<div class="paragraph3"><p><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> verbindet die Bevölkerungsgruppen, die sich sonst kaum treffen. Viele dieser Gruppen sind unter sich mehr oder weniger gut verlinkt (Eltern über einen Elternclub, Senioren, Studenten). Aber es gibt fast kein Netzwerk, das alle diese Gruppen verbindet. </p></div>
			<div class="paragraph3"><p><b>Einfachheit:</b> Weil wir wissen, dass unsere Kleinsten bis zu unseren Erfahrensten mit <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> arbeiten, ist <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> so einfach, dass es unsere strengste Vorgabe erfüllt: Eine Grossmutter kann es im Stress bedienen.
Warum ist das unsere strengste Vorgabe? Weil Grossmütter in der Regel einer anderen Generation angehören, andere Denkstrukturen entwickelt haben. Weil sie Frauen sind, und die meisten Softwareentwickler Männer. Und weil Software, ausser fürs Cockpit, praktisch nie unter Stress getestet wird.
</p></div>
			<div class="paragraph3"><p>&nbsp;</p></div>
			<div class="paragraph3"></div>
			<div class="paragraph3"><p><b>Ausgleich:</b> <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> propagiert nicht Gratisarbeit. Wir glauben, dass ein sofortiger Ausgleich viel wirkungsvoller ist - er „zieht keine Fäden“. Wer seine Arbeit gratis schenken möchte, kann das natürlich trotzdem tun. Wir schlagen jedoch einen Ausgleich von 19.-/Stunde vor. Diesen Ausgleich nehmen die Beteiligten selbst vor. Wir schätzen die Selbstverantwortung als eines der höchsten Güter ein.</p></div>
			<div class="paragraph3"><p><b>Keine Mehrarbeit:</b> Bei unseren vielen Vorgesprächen mit Beteiligten hat sich klar gezeigt, dass es ein wichtiges Anliegen von vielen Städten und Gemeinden ist, dass mit der Einführung von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> keine Mehrarbeit anfällt.<br />
Das haben wir entsprechend gewichtet und ernstgenommen.<br />
Deshalb haben wir entsprechende weitgreifende und effektive Marketingmassnahmen entwickelt, die wir gerne zusätzlich anbieten.<br />
Damit ist sichergestellt, dass der Synergieeffekt schnell zum Tragen kommt. Für alle.</p></div>
	  <div class="paragraph3"><p><b>Rechtliche Sicherheit:</b> Damit <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> bedenkenlos von einer Stadt oder Gemeinde eingesetzt werden kann, ist es wichtig, dass auch die rechtliche Seite zuverlässig geprüft wurde. Wir haben mit mehreren Juristen gearbeitet, um das sicherzustellen. Nicht nur, was den Datenschutz angeht, sondern auch eine saubere Abrechnung der Mehreinnahmen, der Versicherung und der AHV-Abrechnung. Und zwar für alle Schichten leicht verständlich, mit Links ergänzt.<br />
		</p><br /></div><div class="paragraph3"><p><b>Idealfall: Der ManiMano-Gärtner:</b> 
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
                 <h4>Für den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
               </div>
               <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
             </object>
             <br /><br />

			<div class="paragraph3"><p><b>Anleitungen:</b> Um sicherzustellen, dass die einfachen Anfängerfehler vermieden werden können, haben wir Filme gedreht: Im einen geht allerlei schief – und die Beteiligten liefern am Schluss die Ergebnisse, wie <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> für alle Beteiligten erfolgreich funktioniert.  Meist geht es um Kommunikation, Versicherung, Pünktlichkeit und Zuverlässigkeit.<br />
Es sind kleine Dinge, die den Erfolg ausmachen.  Und wir haben tolle Anleitungen dazu geschaffen, <b>dass</b> der Erfolg auch für Ihre Gemeinde oder Stadt Wirklichkeit wird.</p></div>
			<div class="paragraph3"><p><b>Noch Fragen?</b> Kein Problem. Dann rufen Sie uns an. Gerne beantworten wir Ihre Fragen.<br />Die wichtigsten 10 Fragen und Antworten ("Management-Summary"), was ManiMano
ist, und was es nicht ist - finden Sie <a href="downloads/ManiMano-kurz erklärt.pdf" target="_blank"> hier</a> zum Download.</br>
<b>Keine Fragen mehr?</b> Noch besser. Gerne legen wir in mit Ihnen in einer Sitzung den geeigneten Ablauf fest, der eine einfache und zielgerichtete Einführung in Ihrer Gemeinde oder Stadt möglich macht.</p></div>
			<div class="paragraph3"><p><b>Kontakt:</b></p></div>
			<img border="0" width="160"  style="float:left; padding:0px 10px 0 0" src="images/david.jpg" alt="David Schläpfer"/>
			<div class="paragraph3"><p>David Schläpfer<br />
			  Dipl. Informatik-Ing. ETHZ, Psychologe.
			  <br />
			Gründer von ManiMano<br />
		</p></div>
			<div class="paragraph3">
			  <p>Tel: 044 994 73 74<br />
<a href="mailto: Technik@ManiMano.ch"> Email: Technik@ManiMano.ch</a><br />
Programmiert und projektiert durch die <a href="http://www.d-s-c.ch" target="new"><br>
DSC GmbH</a>: <i>Für nachhaltige Technik im Dienste des Menschen</i>			  </p>
			</div>
			<div class="paragraph3"></div>
	  
	<!--<p><input type="button" name="nextbtn" id="nextbtn" value="Weiter zum Angebotsprofil (3 von 5)" onclick=location.href="settings3.html" /></p>-->
	</div>
	</div>
	<!--six_content class end here-->
  </div>
  <!--mainContent class end here-->
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
