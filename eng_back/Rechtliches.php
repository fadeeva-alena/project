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
<title>Legal</title>
<link href="../style2.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body class="all">

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
	<input type=button value="Personal Infos" onclick=location.href="settings1.php" id="maindatbtn">
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

  <!--mainContent class start here-->
  <div class="mainContent">
  	<!--six_content class start here-->
	<div class="six_content">
	<div class="six_content_in">
		<span id="title">1). Legal protection for children and young persons </span>
		
			<!--darkBg class end here-->
			<div class="paragraph"><p>Legal protection for children and young persons is very important to<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>. You are 15 years old and want to do the shopping for the 81<img src="images/Manimano1.gif" width="180" height="100" border="0" style="float:right"/>-year-old neighbor? Sie suchen ein Kind, das mir Ihrem Dackel spazieren geht? Damit Sie, Teilnehmende von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>, nicht lange suchen müssen, finden Sie hier die wichtigsten Vorgaben des Gesetzgebers:</p></div>
			<div class="paragraph2"><p>Ein absolutes Arbeitsverbot für Kinder oder ein Mindestalter gibt es in der Schweiz nicht. 
Die Höchstarbeitszeit für Jugendliche unter 13 Jahren beträgt drei Stunden pro Tag und neun Stunden pro Woche. Zwischen 13 bis 16 Jahren gilt diese Einschränkung nur während der Schulzeit. Während der halben Dauer der Schulferien und während eines Berufspraktikums dürfen Jugendliche jedoch an 40 Stunden pro Woche für jeweils acht Stunden am Tag zwischen 6 Uhr und 18 Uhr für leichte Arbeiten eingesetzt werden. 
Klar ist, dass Jugendliche nicht für gefährliche Arbeiten beschäftigt werden dürfen. Absolut verboten ist es, dass Jugendliche für die Bedienung von Gästen in Nachtlokalen, Dancings, Diskotheken oder Bars einzusetzen.</p></div>
			<div class="paragraph3"><p>Für kulturelle, künstlerische und sportliche Darbietungen sowie zu Werbezwecken im Rahmen von Radio-, Fernseh-, Film- und Fotoaufnahmen, bei kulturellen Anlässen wie Theater-, Zirkus- und Musikaufführungen sowie Sportanlässen dürfen Jugendliche beschäftigt werden – ausser die Tätigkeit hat einen negativen Einfluss auf die Gesundheit, die Sicherheit sowie die physische oder psychische Entwicklung – oder sie beeinträchtigt den Schulbesuch und die Schulleistungen.<br /> 
Sind die Jugendlichen noch nicht 15 Jahre alt, müssen derartigen Aktivitäten 14 Tage vor Beginn den kantonalen Behörden angezeigt werden. Sonntags- und Nachtarbeit sind grundsätzlich verboten. 
</p></div>
			<div class="paragraph3"><p>Bei Fragen oder Problemen können Sie sich unter <a href="#">www.arbeitsinspektorate.ch</a>  an die kantonalen Arbeitsinspektorate wenden. Im Kanton Zürich ist dies das Amt für Wirtschaft und Arbeit, Bereich Arbeitsbedingungen, Tel.: 043 259 91 00.</p></div><br /><br />
			<span id="title">2). Datenschutzrechte</span>
			<div class="paragraph"><p>Bitte lesen Sie diese Erklärung zu Ihren Datenschutzrechten sorgfältig durch: <br /><b>a.&nbsp Von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> gespeicherte Informationen</b><br /><br />

Die Informationen, die Sie bei <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> in Ihr Profil eingeben, werden von anderen Teilnehmenden aufgerufen, genutzt und gespeichert.<img src="images/Manimano2.gif" width="219" height="125" border="0" style="float:right"/> <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> liegt viel daran, ein geschütztes Umfeld zu schaffen. Wir versuchen, den Zugriff auf unsere Datenbank auf berechtigte Nutzer zu begrenzen, können jedoch nicht garantieren, dass unberechtigte Dritte keinen Zugang erhalten. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann auch nicht kontrollieren, wie Berechtigte aus der Datenbank herunter geladene Informationen speichern oder weiterleiten. Deshalb sollten Sie sicherstellen, dass Sie keine sensiblen Informationen in ManiMano einstellen. Wir können Ihre Informationen verwenden, um Sie von Aktualisierungen von ManiMano in Kenntnis zu setzen.</p></div>
			<div class="paragraph2"><p><b>b.&nbsp;&nbsp;Zugänglichmachen von Informationen gegenüber Dritten</b><br />

Wir machen Informationen zugänglich, soweit dies gesetzlich erforderlich ist.

</p></div>
			<div class="paragraph2"><p><b>c.&nbsp;&nbsp;Ihre Wahlmöglichkeiten hinsichtlich Ihrer Informationen</b><br/>

Wenn Sie wollen, können Sie Ihre personenbezogenen Daten in <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> jederzeit durchsehen, ändern oder löschen. Loggen Sie sich einfach in Ihr Konto ein, gehen Sie in Ihr Profil „Meine Daten“ und nehmen Sie die gewünschten Änderungen vor.  
</p></div><br /><br />
				<span id="title">3). Versicherungen und Haftung</span>
			<div class="paragraph"><p><b>a.</b>&nbsp;&nbsp;<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ist eine Plattform,<img src="images/Manimano3.gif" width="219" height="125" border="0" style="float:right"/> die es den Teilnehmenden ermöglicht, Dienstleistungen zu suchen, anzubieten, auszutauschen und so eigene Talente und Fähigkeiten in die Gesellschaft einzubringen oder Hilfe und Unterstützung zu erhalten. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> vermittelt nicht zwischen den einzelnen Kontakten, sondern stellt lediglich das Netzwerk, eine Anwendungs-Plattform,  zur Verfügung.<br /><br />Keine Teilnehmerin und kein Teilnehmer von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ist verpflichtet, eine Dienstleistung auszuführen oder auf ein Angebot einzugehen. Jede Ausführung ist eine freiwillige Vereinbarung zwischen beiden Teilnehmenden. <br /><br /><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> übernimmt keine Verantwortung oder Haftung für die Dienstleistungen, die innerhalb des Netzwerkes vereinbart und ausgeführt werden.<br /><br />Die Versicherung ist Sache der Teilnehmenden. Sie vergewissern sich, dass allenfalls nötige Versicherungen vorhanden sind. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann im Schadenfalle nicht haftbar gemacht werden. Die Versicherung bei Krankheit ist obligatorisch nach dem Krankenversicherungsgesetz (KVG) geregelt. Die Unfallversicherung ist Sache jeder und jedes Einzelnen. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann die Haftung bei Schäden nicht übernehmen. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> empfiehlt allen Teilnehmenden, eine Haftpflichtversicherung abzuschliessen. Und denken Sie auch an die AHV, die obligatorische Grundversicherung.<br /><br />Neugierig gemacht oder Interesse geweckt? Sie wollen Ihre Verantwortung wahrnehmen, sich schützen und  Genaueres über die Versicherungen und das Vorgehen wissen? <br /><br />Dann lesen Sie jetzt weiter!</p></div><br />
			<div class="paragraph"><p><b>b.&nbsp;&nbsp;Privathaftpflicht </b></p></div><br />
			<div class="paragraph"><p>&nbsp;&nbsp;&nbsp;&nbsp;Stellen Sie sich vor:<br /><img src="images/Manimano4.gif" width="219" height="125" border="0" style="float:right"/>Sie parkieren das ausgeliehene Auto Ihres <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> -Partners. Beim Einparken übersehen Sie einen Pfosten. Es kracht. Was nun? Wer zahlt?<br /><br />Sie giessen die Blumen Ihres <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> -Partners. Dabei fällt ein Blumentopf auf das Parkett der Mietwohnung und hinterlässt ein Loch im Parkett. Was nun? Wer zahlt? <br /><br />Mit dem Kinderwagen ihrer <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> -Partnerin fahren Sie um die Ecke – und direkt in eine Fussgängerin, die einen Arm bricht. Was nun? Wer zahlt?<br /><br />Fügen Sie jemandem Schaden zu, werden Sie dafür in unbegrenzter Höhe haftpflichtig. Und das hat nichts mit ManiMano zu tun. Das heisst, Sie müssen den Schaden bezahlen. Eine Privathaftpflichtversicherung schützt Sie vor den finanziellen Folgen solcher Ansprüche. Und im Fall von unbegründeten Forderungen von anderen setzt sich Ihre Versicherung für Sie zur Wehr. Versicherungen halten verschiedene Angebote für Sie parat:<br /><br />-&nbsp;&nbsp;Sie versichern Schäden bis zu einer gewissen Garantiesumme z. B. 5  Millionen Franken<br />
-&nbsp;&nbsp;Sie sind z.B. versichert als Wohneigentümer, Babysitter, Mieter, Tierhalter oder Sportler<br />
-&nbsp;&nbsp;Achten Sie darauf, dass gelegentliches Lenken fremder Fahrzeuge und Schäden an anvertrauten Sachen inbegriffen sind<br />
-&nbsp;&nbsp;Lernende und Studierende können über die Elternpolice mitversichert werden<br />
-&nbsp;&nbsp;Selbständige berufliche Tätigkeiten bis zu einem Jahresumsatz von  20'000 Franken sind mitversichert, z.B. Babysitter, Kosmetikerin, Raumpfleger, Musiker, Sport- und Sprachlehrerin<img src="images/Manimano5.gif" width="219" height="125" border="0" style="float:right"/><br /><br />Eine Privathaftpflicht ist nicht teuer und einfach abgeschlossen. Auch Unternehmungen schützen sich durch Haftpflichtversicherungen. <br /><br />Der Unternehmer hat gegenüber dem Arbeitnehmer aber noch andere Pflichten. Diese finden wir generell umschrieben im Obligationenrecht: 
   </p></div><br /><br />
   			<span id="title">Schutz des Arbeitnehmers (Art. 328 Obligationenrecht)</span>
			<div class="paragraph"><p>Der Arbeitgeber hat die Persönlichkeit des Arbeitnehmers zu achten und zu schützen.<img src="images/Manimano6.gif" width="219" height="125" border="0" style="float:right"/>Er muss auch auf die Gesundheit des Arbeitnehmers Rücksicht nehmen. Er  sorgt für die Wahrung der Sittlichkeit. Das heisst, er muss insbesondere dafür sorgen, dass Arbeitnehmerinnen und Arbeitnehmer nicht sexuell belästigt werden und dass den Opfern von sexuellen Belästigungen keine weiteren Nachteile entstehen.<br /><br />Er hat zum Schutz von Leben, Gesundheit und persönlicher Integrität der Arbeitnehmerinnen und Arbeitnehmer die Massnahmen zu treffen, die nach der Erfahrung notwendig, nach dem Stand der Technik anwendbar und den Verhältnissen des Betriebes oder Haushaltes angemessen sind. Dies, soweit es mit Rücksicht auf das einzelne Arbeitsverhältnis und die Natur der Arbeitsleistung ihm billigerweise zugemutet werden kann. <br /><br />Der Arbeitgeber muss also möglich machen, was möglich ist.

</p></div><br /><br />
			<span id="title">Alters- und Hinterlassenenvorsorge (AHV), Invalidenversicherung (IV), Erwerbsausfallversicherung (EO),  Arbeitslosenversicherung (ALV)</span><br /><br /><b><span  style="color:#FFFFFF;">Worum geht es hier?</span></b>
			<div class="paragraph2"><p>Die Alters- und Hinterlassenenversicherung (AHV) soll den<img src="images/Manimano7.gif" width="67" height="98" border="0" style="float:right"/>Grundbedarf der Versicherten decken. Die Invalidenversicherung (IV) ist für die finanziellen Folgen von Invalidität da. Die Erwerbsersatzordnung (EO) kompensiert teilweise die Einkommensausfälle durch Militär-, Zivilschutz- oder Zivildienst. Finanziert werden diese Versicherungen aus Arbeitnehmer- und Arbeitgeberbeiträgen sowie durch Bund und Kantone. Die Arbeitslosenversicherung gewährt die Lohnfortzahlung bei Arbeitslosigkeit und fördert die Wiedereingliederung von Erwerbslosen in den Arbeitsmarkt.<br /><br />Die 1. Säule ist für alle Mitarbeitenden obligatorisch: Schweizer, Ausländer, Familienmitglieder, im Ausland beschäftigte Mitarbeitende mit Direktvertrag bei der Muttergesellschaft, wenn der Hauptsitz in der Schweiz ist.<br /><br /><b>Wann und wo muss ich abrechnen?</b><br /><br />Sie finden bei <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> einen Gärtner, der das ganze Jahr Ihren Garten besorgt. Beträgt der Gesamtlohn mehr als 2'200 Franken pro Jahr, also 184 Franken pro Monat, schreibt der Gesetzgeber die Abrechnung und Bezahlung von Beiträgen an die Alters- und Hinterlassenenvorsorge vor.<br /> 
Wenn der Gesamtlohn unter der Beitragsgrenze von 2'200  Franken pro Jahr liegt, ist die Anmeldung bei der zuständigen Sozialversicherungsanstalt (SVA) freiwillig, wenn es sich  nicht um Arbeiten in Privathaushalten handelt. Darunter fallen Reinigungsarbeiten, Haushaltstätigkeiten und Betreuungstätigkeiten, wie zum Beispiel Kinder-, Betagten-  oder Tierbetreuung. Für diese Tätigkeiten gibt es keine Mindestgrenze. Diese sind immer abrechnungspflichtig.<br /><br />Das Vorgehen ist einfach:<img src="images/Manimano8.gif" width="219" height="125" border="0" style="float:right"/><br /><br/>Sie melden sich einmalig bei der SVA an und füllen einmal jährlich für das vergangene Jahr das Abrechnungsformular aus. 
Die betreffenden Formulare können unter folgendem Link heruntergeladen werden:<a href="#">Fragebogen für Arbeitgebende von Mitarbeitenden in Hausdienst und Hauswartung</a><br /><br />Falls Sie Unterstützung benötigen, finden Sie bei der SVA oder Ihrer Gemeinde kompetente und hilfsbereite Unterstützung. Die SVA erreichen Sie für weitere Fragen unter Tel 044 448 50 00 und im&nbsp;&nbsp;<a href="#">Internet.</a>
 
 </p></div><br /><br />
 <span id="title">Unfallversicherung (UVG)</span>
			<div class="paragraph"><p>Sie finden durch ManiMano eine <img src="images/Manimano9.gif" width="271" height="197" border="0" style="float:right"/>Haushaltshilfe, einen Babysitter oder andere Hausangestellte. Was müssen Sie jetzt tun?  Die Versicherungen bieten eine Versicherung für Hausangestellte, welche Sie zum Teil online abschliessen können und Sie nur 100 Franken im Jahr kostet.
Diese Versicherung ist obligatorisch, denn Sie gelten als Arbeitgeber, wenn Sie Personen in Ihrem Haushalt beschäftigen. Von den Arbeitgebern verlangt der Gesetzgeber, dass Sie Ihre Angestellten gegen Unfall versichern.
</p></div><br />
<span id="title">Unfallversicherung (UVG)</span>
				
			<div class="paragraph"><p>Die betrieblichen Pensionskassen sollen die <img src="images/Manimano10.gif" width="271" height="197" border="0" style="float:right"/><br />Fortführung des gewohnten Lebensstandards sichern. Voraussetzung ist ein Minimalverdienst von derzeit 20'520 Franken pro Jahr, also 1'710 Franken pro Monat.<br /><br />Die BVG-Leistungen werden vor allem durch Lohnprämien finanziert. Jedes Jahr erhalten die Arbeitnehmerinnen und Arbeitnehmer einen Vorsorgeausweis mit der Auflistung der bisher geleisteten Beiträge und dem zu erwartenden Alterskapital. <br /><br />Kleinen Betrieben ist der Anschluss an eine Sammelstiftung oder einer Verbandseinrichtung zu empfehlen. Vor der Auswahl sollten Unternehmensgründer unbedingt die Kosten, die Leistungen und den Aufwand für die Administration vergleichen. Die Unterschiede sind teilweise erheblich.</p></div><br /><br />
			<span id="title">Krankentaggeld-Versicherung / Erwerbsunfähigkeits-, resp. Lohnausfallversicherung)</span>
			
			<div class="paragraph"><p>Für Unternehmende ist der Abschluss einer Krankentaggeld-Versicherung zu empfehlen. Sie deckt den Lohnausfall bei Krankheit. Ebenfalls ratsam ist eine Erwerbsunfähigkeits-Versicherung. Diese leistet nach Ablauf der Krankentaggeld-Versicherung (nach 2 Jahren) eine entsprechende Rente.<br /><br />Unternehmer sind verpflichtet, ihre Mitarbeitenden bei Krankheit für eine gewisse Zeit weiter zu entlöhnen. Wie lange diese Zeit dauert, ist gesetzlich nicht eindeutig geregelt, die Mindestdauer ist aber gemäss Gerichtspraxis 3 Wochen im 1. Dienstjahr. Im Übrigen richtet man sich nach der sogenannten Zürcher-, Basler- und Berner-Skala. <br /><br />Arbeitgeber können dieses Risiko bei Krankenkassen oder Versicherungen abdecken. Die Hälfte der Prämien können dem Personal belastet werden<br /><br />Viel Spass mit <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>!  </p></div>
			<div class="paragraph"><p><hr /></p></div>
			<div class="paragraph"><p><img src="images/Manimano11.gif" width="154" height="153" border="0" style="margin:0 0 0 300px;"/></p>
			</div>
			<div class="paragraph"><p><hr /></p></div>
			<div class="paragraph2"><p></p></div>
	  
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
