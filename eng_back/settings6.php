<? ob_start(); ?>﻿
<?php
include "include/session.php";

include "include/z_db.php";
$monthNames = array("Januar", "Februar", "März", "April", "Mai", "Juni",   
                    "Juli", "August", "September", "Oktober", "November", 
                    "Dezember");  
 function random_string($len=5, $str='') 
  { 
    for($i=1; $i<=$len; $i++) 
        { 
        //generates a random number that will be the ASCII code of the character. 
    //We only want numbers (ascii code from 48 to 57) and caps letters. 
     $ord=rand(48, 90); 
     if((($ord >= 48) && ($ord <= 57)) || (($ord >= 65) && ($ord<= 90))) 
    $str.=chr($ord); 
     //If the number is not good we generate another one 
    else 
        $str.=random_string(1); 
    } 
    return $str; 
} 

 


if($_POST["Speichern"] == "Speichern" )
{
$Nv = $_POST['Nv'];
if(isset($_POST['flagm1']))
{

// Little bit other Syntax but better effect
//$todayis = strftime('%A, %d. %B %Y'); 
//$todayis = date("l, F j, Y, g:i a") ;
//$todayis = date("F j, Y, g:i a") ;
$rand_str=random_string(5); 
$todayis =   date('j') . "." .   $monthNames[(date('n')-1)] . " " . date('Y');  
$m=1;
$sql="UPDATE t_people SET Agree  = '$m' , Sign_date='$todayis',  Acode='$rand_str'   WHERE people_id ={$_SESSION['people_id']}";
$result = mysql_query($sql); 
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
if($row['Active']== 0)
{

$recipient = $row['email'];

$subject = "Willkommen bei ManiMano!";
$content = "Willkommen bei ManiMano!\n"
."Bitte klicken Sie auf den Link, um Ihren Zugang zu ManiMano zu aktivieren. \n"
."\n"."http://manimano.ch/activate.php?id=".$_SESSION['people_id']."&code=".$row['Acode']

."\n";
$header = "From: ManiMano <ManiMano@manimano.ch>\n";
mail($recipient,$subject,$content,$header);
$Nv =  7;
}
}
if ($Nv==2)
header("location:settings2.php");
if ($Nv==3)
header("location:settings3.php");
if ($Nv==4)
header("location:settings4.php");
if ($Nv==1)
header("location:settings1.php");

if ($Nv==5)
header("location:settings5.php");

if ($Nv==6) 
header("location:welcome.php");
if ($Nv==7) 
header("location:login.php?al=2");
}
$Nv = 6;


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>ManiMano - Einstellungen 6 von 6</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="slider.css" />
<SCRIPT SRC="libdetect.js"></SCRIPT>
<SCRIPT SRC="libslider.js"></SCRIPT>
 <SCRIPT SRC="slider.js"></SCRIPT>

<script type="text/javascript">



</script>
</head>

<body class="all"  onload="update()">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
			<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
}else
{
header("location:index.php");	
}
?>
<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type="button" value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type="button" value="Meine Daten"  onclick=location.href="Settings5.php" id="maindatbtn">
<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>

	<input type="button" value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">6) Rechtliche Aspekte:  <img src="images/page6.png" border="0"  usemap="#green" align="right" /> </span>
<map name="green">
<area shape="rect" alt="" coords="5,0,25,30" href="javascript:Nav(1);">
<area shape="rect" alt="" coords="29,0,45,30" href="javascript:Nav(2);">
<area shape="rect" alt="" coords="50,0,68,29" href="javascript:Nav(3);">
<area shape="rect" alt="" coords="71,0,86,30" href="javascript:Nav(4);">
<area shape="rect" alt="" coords="92,0,107,30" href="javascript:Nav(5);">
</map>

 <form method="post"  name="form1" action="settings6.php" >
<div style='overflow:auto; height: 400px;'>
		<p id="maintext">

Wir möchten sicher sein, dass Sie viel Spass haben mit ManiMano.<br>
Um Sie vor Schäden finanzieller und rechtlicher Art zu schützen, haben wir für Sie die Schweizer Gesetze genau geprüft und für Sie zusammengestellt.<br>
Bitte klicken Sie das nicht nur ab - es ist wirklich hilfreich!<br> 
Wir empfehlen Ihnen, sich kurz damit auseinanderzusetzen!<br>
Versicherungen und Haftung <br></p>
<p id="maintext">
ManiMano ist eine Plattform, die es den Teilnehmenden ermöglicht, Dienstleistungen zu suchen, anzubieten, auszutauschen und so eigene Talente und Fähigkeiten in die Gesellschaft einzubringen oder Hilfe und Unterstützung zu erhalten. ManiMano vermittelt nicht zwischen den einzelnen Kontakten, sondern stellt lediglich das Netzwerk, eine Anwendungs-Plattform,  zur Verfügung.
</p>
<p id="maintext">

Keine Teilnehmerin und kein Teilnehmer von ManiMano ist verpflichtet, eine Dienstleistung auszuführen oder auf ein Angebot einzugehen. Jede Ausführung ist eine freiwillige Vereinbarung zwischen beiden Teilnehmenden. </p>
<p id="maintext">

ManiMano übernimmt keine Verantwortung oder Haftung für die Dienstleistungen, die innerhalb des Netzwerkes vereinbart und ausgeführt werden.
</p>
<p id="maintext">

Die Versicherung ist Sache der Teilnehmenden. Sie vergewissern sich, dass allenfalls nötige Versicherungen vorhanden sind. ManiMano kann im Schadenfalle nicht haftbar gemacht werden. Die Versicherung bei Krankheit ist obligatorisch nach dem Krankenversicherungsgesetz (KVG) geregelt. Die Unfallversicherung ist Sache jeder und jedes Einzelnen. ManiMano kann die Haftung bei Schäden nicht übernehmen. ManiMano empfiehlt allen Teilnehmenden, eine Haftpflichtversicherung abzuschliessen. Und denken Sie auch an die AHV, die obligatorische Grundversicherung.
</p>
<p id="maintext">

Neugierig gemacht oder Interesse geweckt? Sie wollen Ihre Verantwortung wahrnehmen, sich schützen und  Genaueres über die Versicherungen und das Vorgehen wissen? </p>
<p id="maintext">

Dann lesen Sie jetzt weiter!
</p>
<p id="maintext">

Privathaftpflicht </p>
<p id="maintext">

Stellen Sie sich vor:
</p>
<p id="maintext">

Sie parkieren das ausgeliehene Auto Ihres ManiMano-Partners. Beim Einparken übersehen Sie einen Pfosten. Es kracht. Was nun? Wer zahlt?</p>
<p id="maintext">

Sie giessen die Blumen Ihres ManiMano-Partners. Dabei fällt ein Blumentopf auf das Parkett der Mietwohnung und hinterlässt ein Loch im Parkett. Was nun? Wer zahlt?
</p>
<p id="maintext">

Mit dem Kinderwagen ihrer ManiMano-Partnerin fahren Sie um die Ecke – und direkt in eine Fussgängerin, die einen Arm bricht. Was nun? Wer zahlt?</p>
<p id="maintext">

Fügen Sie jemandem Schaden zu, werden Sie dafür in unbegrenzter Höhe haftpflichtig. Und das hat nichts mit ManiMano zu tun. Das heisst, Sie müssen den Schaden bezahlen. Eine Privathaftpflichtversicherung schützt Sie vor den finanziellen Folgen solcher Ansprüche. Und im Fall von unbegründeten Forderungen von anderen setzt sich Ihre Versicherung für Sie zur Wehr. Versicherungen halten verschiedene Angebote für Sie parat:
</p>
<p id="maintext">

-	Sie versichern Schäden bis zu einer gewissen Garantiesumme z. B. 5  Millionen Franken<br>
-	Sie sind z.B. versichert als Wohneigentümer, Babysitter, Mieter, Tierhalter oder Sportler<br>
-	Achten Sie darauf, dass gelegentliches Lenken fremder Fahrzeuge und Schäden an anvertrauten Sachen inbegriffen sind<br>
- 	Lernende und Studierende können über die Elternpolice mitversichert werden<br>
-	Selbständige berufliche Tätigkeiten bis zu einem Jahresumsatz von  20'000 Franken sind mitversichert, z.B. Babysitter, Kosmetikerin, Raumpfleger, Musiker, Sport- und Sprachlehrerin<br>
</p>
<p id="maintext">

Eine Privathaftpflicht ist nicht teuer und einfach abgeschlossen. Auch Unternehmungen schützen sich durch Haftpflichtversicherungen. </p>
<p id="maintext">

Der Unternehmer hat gegenüber dem Arbeitnehmer aber noch andere Pflichten. Diese finden wir generell umschrieben im Obligationenrecht:</p> 
<p id="maintext">

Schutz des Arbeitnehmers (Art. 328 Obligationenrecht) 
</p>

<p id="maintext">

Der Arbeitgeber hat die Persönlichkeit des Arbeitnehmers zu achten und zu schützen. Er muss auch auf die Gesundheit des Arbeitnehmers Rücksicht nehmen. Er  sorgt für die Wahrung der Sittlichkeit. Das heisst, er muss insbesondere dafür sorgen, dass Arbeitnehmerinnen und Arbeitnehmer nicht sexuell belästigt werden und dass den Opfern von sexuellen Belästigungen keine weiteren Nachteile entstehen. </p>
<p id="maintext">

Er hat zum Schutz von Leben, Gesundheit und persönlicher Integrität der Arbeitnehmerinnen und Arbeitnehmer die Massnahmen zu treffen, die nach der Erfahrung notwendig, nach dem Stand der Technik anwendbar und den Verhältnissen des Betriebes oder Haushaltes angemessen sind. Dies, soweit es mit Rücksicht auf das einzelne Arbeitsverhältnis und die Natur der Arbeitsleistung ihm billigerweise zugemutet werden kann. </p>
<p id="maintext">

Der Arbeitgeber muss also möglich machen, was möglich ist.
</p>
<p id="maintext">

Alters- und Hinterlassenenvorsorge (AHV), Invalidenversicherung (IV), Erwerbsausfallversicherung (EO),  Arbeitslosenversicherung (ALV)
</p>
<p id="maintext">

Worum geht es hier?</p>
<p id="maintext">

Die Alters- und Hinterlassenenversicherung (AHV) soll den Grundbedarf der Versicherten decken. Die Invalidenversicherung (IV) ist für die finanziellen Folgen von Invalidität da. Die Erwerbsersatzordnung (EO) kompensiert teilweise die Einkommensausfälle durch Militär-, Zivilschutz- oder Zivildienst. Finanziert werden diese Versicherungen aus Arbeitnehmer- und Arbeitgeberbeiträgen sowie durch Bund und Kantone. Die Arbeitslosenversicherung gewährt die Lohnfortzahlung bei Arbeitslosigkeit und fördert die Wiedereingliederung von Erwerbslosen in den Arbeitsmarkt.</p>
<p id="maintext">

Die 1. Säule ist für alle Mitarbeitenden obligatorisch: Schweizer, Ausländer, Familienmitglieder, im Ausland beschäftigte Mitarbeitende mit Direktvertrag bei der Muttergesellschaft, wenn der Hauptsitz in der Schweiz ist. 
</p>
<p id="maintext">

Wann und wo muss ich abrechnen?
</p>
<p id="maintext">

Sie finden bei ManiMano einen Gärtner, der das ganze Jahr Ihren Garten besorgt. Beträgt der Gesamtlohn mehr als 2'200 Franken pro Jahr, also 184 Franken pro Monat, schreibt der Gesetzgeber die Abrechnung und Bezahlung von Beiträgen an die Alters- und Hinterlassenenvorsorge vor. </p>
<p id="maintext">

Wenn der Gesamtlohn unter der Beitragsgrenze von 2'200  Franken pro Jahr liegt, ist die Anmeldung bei der zuständigen Sozialversicherungsanstalt (SVA) freiwillig, wenn es sich  nicht um Arbeiten in Privathaushalten handelt. Darunter fallen Reinigungsarbeiten, Haushaltstätigkeiten und Betreuungstätigkeiten, wie zum Beispiel Kinder-, Betagten-  oder Tierbetreuung. Für diese Tätigkeiten gibt es keine Mindestgrenze. Diese sind immer abrechnungspflichtig.
</p>
<p id="maintext">

Das Vorgehen ist einfach: Sie melden sich einmalig bei der SVA an und füllen einmal jährlich für das vergangene Jahr das Abrechnungsformular aus. </p>
<p id="maintext">

Die betreffenden Formulare können unter folgendem Link heruntergeladen werden:
</p>
<p id="maintext">

http:/www.svazurich.ch/pdf/ak3002.pdf
http:/www.svazurich.ch/index/index/cfm?page=service formulare ahv&sprache=de
</p>
<p id="maintext">

Falls Sie Unterstützung benötigen, finden Sie bei der SVA oder Ihrer Gemeinde kompetente und hilfsbereite Unterstützung. Die SVA erreichen Sie für weitere Fragen unter Tel 044 448 50 00 und im Internet unter http://www.ahv-iv.info/andere/00150/index.html?lang=de.</p>

<p id="maintext">

Unfallversicherung (UVG)</p>
<p id="maintext">

Sie finden durch ManiMano eine Haushaltshilfe, einen Babysitter oder andere Hausangestellte. Was müssen Sie jetzt tun?  Die Versicherungen bieten eine Versicherung für Hausangestellte, welche Sie zum Teil online abschliessen können und Sie nur 100 Franken im Jahr kostet.</p>
<p id="maintext">

Diese Versicherung ist obligatorisch, denn Sie gelten als Arbeitgeber, wenn Sie Personen in Ihrem Haushalt beschäftigen. Von den Arbeitgebern verlangt der Gesetzgeber, dass Sie Ihre Angestellten gegen Unfall versichern.
</p>
<p id="maintext">

Pensionskasse (BVG)</p>
<p id="maintext">

Die betrieblichen Pensionskassen sollen die Fortführung des gewohnten Lebensstandards sichern. Voraussetzung ist ein Minimalverdienst von derzeit 20'520 Franken pro Jahr, also 1'710 Franken pro Monat. </p>
<p id="maintext">

Die BVG-Leistungen werden vor allem durch Lohnprämien finanziert. Jedes Jahr erhalten die Arbeitnehmerinnen und Arbeitnehmer einen Vorsorgeausweis mit der Auflistung der bisher geleisteten Beiträge und dem zu erwartenden Alterskapital. </p>
<p id="maintext">

Kleinen Betrieben ist der Anschluss an eine Sammelstiftung oder einer Verbandseinrichtung zu empfehlen. Vor der Auswahl sollten Unternehmensgründer unbedingt die Kosten, die Leistungen und den Aufwand für die Administration vergleichen. Die Unterschiede sind teilweise erheblich.</p>
<p id="maintext">

Krankentaggeld-Versicherung / Erwerbsunfähigkeits-, resp. Lohnausfallversicherung)</p>
<p id="maintext">

Für Unternehmende ist der Abschluss einer Krankentaggeld-Versicherung zu empfehlen. Sie deckt den Lohnausfall bei Krankheit. Ebenfalls ratsam ist eine Erwerbsunfähigkeits-Versicherung. Diese leistet nach Ablauf der Krankentaggeld-Versicherung (nach 2 Jahren) eine entsprechende Rente. </p>
<p id="maintext">

Unternehmer sind verpflichtet, ihre Mitarbeitenden bei Krankheit für eine gewisse Zeit weiter zu entlöhnen. Wie lange diese Zeit dauert, ist gesetzlich nicht eindeutig geregelt, die Mindestdauer ist aber gemäss Gerichtspraxis 3 Wochen im 1. Dienstjahr. Im Übrigen richtet man sich nach der sogenannten Zürcher-, Basler- und Berner-Skala. </p>
<p id="maintext">

Arbeitgeber können dieses Risiko bei Krankenkassen oder Versicherungen abdecken. Die Hälfte der Prämien können dem Personal belastet werden</p>
<p id="maintext">

Viel Spass mit ManiMano!

</p>
</div>
	  <p></p>
<div Align="Center"><a href="http://www.manimano.ch/Agreement.html" target="_blank">Ausdrucken</a> </div><br>
<div Align="Center">
<?php
                   if ($row['Agree'] == 1){                        
echo"<input type='checkbox' name='flagm1' value='flag' checked   Disabled>Gelesen, verstanden und akzeptiert, {$row['zip']} {$row['location']} {$row['firstname']} {$row['lastname']}";
}else{
echo"<input type='checkbox' name='flagm1' value='flag' onclick='javascript:Change( )();  ' >Gelesen, verstanden und akzeptiert, {$row['zip']} {$row['location']} {$row['firstname']} {$row['lastname']}";

}
?>

<?php
 if ($row['Agree'] == 1){                        
echo "  {$row['Sign_date']} ";
} else 
{
$todayis =   date('j') . "." .   $monthNames[(date('n')-1)] . " " . date('Y');  
echo "   $todayis   ";
echo "<br>";
echo"Ihre Daten werden jetzt übermittelt. Sie erhalten eine Email mit einem Link - klicken Sie diesen an - dann können Sie sich anmelden und sofort loslegen. Wir wünschen Ihnen viel Spass mit ManiMano!";
}

?>
</div>
  <br>
	<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">	
<?php
                   if ($row['Agree'] == 1){      
      echo"<input name='Speichern' type='submit' id='finishbtn' value='Speichern' >";
}else
{
echo"<input name='Speichern' type='submit' id='finishbtn' value='Speichern' Disabled >";
}
?>
</form>
<script type="text/javascript">
function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.Speichern.click(); 

}
function Change( )
{

if(document.form1.flagm1.checked== true)
{
 document.form1.Speichern.disabled= false;
}else
{
document.form1.Speichern.disabled= true;
}

}

</script>

    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
