<? ob_start(); ?>ï»¿
<?php
include "include/session.php";

include "include/z_db.php";
$monthNames = array("Januar", "Februar", "MÃ¤rz", "April", "Mai", "Juni",   
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

//$recipient = $row['email'];

//$subject = "Willkommen bei ManiMano!";
//$content = "Willkommen bei ManiMano!\n"
//."Bitte klicken Sie auf den Link, um Ihren Zugang zu ManiMano zu aktivieren. \n"
//."\n"."http://manimano.ch/activate.php?id=".$_SESSION['people_id']."&code=".$row['Acode']

//."\n";
//$header = "From: ManiMano <Technik@ManiMano.ch>\n";
//mail($recipient,$subject,$content,$header);
//start change

$to = $row['email'];

$subject = 'Willkommen bei ManiMano';

$headers = "From: " . "Technik@ManiMano.ch". "\n";
$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";

$message = '<!DOCTYPE html>
						<html>
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
						</head><body>';




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


$message .='<p><strong>Hallo ';
$message.=$_SESSION['first_name'].' '.$_SESSION['last_name'];
$message.='</strong></p>

<p><strong>Willkommen</strong>, Sie sind jetzt auch ein <span style=';
$message .='color:red ;';


$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><strong>! <br> </strong>&nbsp;</p>

<p>Bitte klicken Sie <a href=';
$message .='http://manimano.ch/activate.php?id=';
$message.=$_SESSION['people_id'];
$message.= '&code=';
$message.=$row['Acode'];
$message.=' target=';

$message .='_blank';
$message .='>hier</a>, um Ihren Zugang zu <span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span> zu aktivieren.</p>';

$message .='<p><span lang=';
$message .='DE';
$message .='>Sie werden damit automatisch auf den Anmeldebildschirm weitergeleitet.<br> <br> 

Bei Fragen sind wir f&uuml;r Sie da, nutzen Sie die Angebote auf der <span style=';
$message .='text-decoration: underline;';
$message .='><a href=';
$message .='http://www.manimano.ch/help.php';
$message .=' target=';
$message .='_blank';
$message .='>Hilfeseite</a></span>. <br> Wir sind per Email (<a href=';
$message .='mailto:Technik@ManiMano.ch';
$message .='>Technik@ManiMano.ch</a>) erreichbar. <br> ';

$message .='In Notf&auml;llen erreichen Sie uns auch unter der </span><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><span lang=';
$message .='DE';
$message .='>-Hotline: 0848 6264 6266 (0848-</span><strong><span lang=';
$message .='DE';
$message .='> </span></strong><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><span lang=';
$message .='DE';
$message .='>).</span></p>';

$message .='<p><span lang=';
$message .='DE';
$message .='>Wir m&ouml;chten auch darauf hinweisen, dass die Haftung gem&auml;ss OR zwischen den beiden Vertragssparteien zu regeln ist -  

wir von </span><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><span lang=';
$message .='DE';
$message .='> sind nicht Vertragspartei, wir bieten lediglich die Plattform dazu. <br> In diesem Zusammenhang empfehlen wir Ihnen das Studium der rechtlichen Hinweise â€“ <br>';

$message .='diese sind praktisch gestaltet und beinhaltet auch Fragen zu Versicherung und AHV.</span></p>

<p><span lang=';
$message .='DE';
$message .='>Und nun viel Spass und Erfolg mit </span><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><strong>.<br>

</strong></p>

<p><strong><span lang=';
$message .='DE';
$message .='>David Schl&auml;pfer  <br> und das </span></strong><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><strong>-Team</strong></p>

<p><strong><br></strong></p>

<div align=';
$message .='left';
$message .='>';

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



mb_internal_encoding("UTF-8");
mb_send_mail($to, $subject, $message, $headers);

//mail($to, $subject, $message, $headers);
//end change

// Mail admin 

$sql = "SELECT * FROM _site_mode  Where ID=2 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row1=mysql_fetch_array($result)) {

if ($row1['Mode']=='On')
{
$todayis =   date('j') . "." .   $monthNames[(date('n')-1)] . " " . date('Y')." ".date("g:i a");  


$to = 'doris.pauletto@pilet-partner.ch, doris.pauletto@bluewin.ch, Technik@ManiMano.ch ,'.$row['email'];
//$to = $row['email'];












$subject = "ManiMano: Neuer Benutzer"; 

$headers = "From: " . "Technik@ManiMano.ch". "\n";

//$headers .= "MIME-Version: 1.0\r\n";
//$headers .= "Content-Type: text/html; charset=UTF-8\r\n";

//$message = '<html>';
//$message .='<meta content=';
//$message .='text/html; charset=UTF-8';
//$message .=' http-equiv=Content-Type>';


//$message .='<style type=';
//$message .='text/css';
//$message .='>';
//$message .='






//html,body{

//font-size: 12px;

//font-family: Arial;

//}



//a:active,

//a:visited,

//a:link {

//	color: rgb(0, 0, 255);
//
//	text-decoration:underline;
//
//	font-weight:bold;
//
//	}



//a:hover {

//	color: #4b719e;

//	text-decoration: underline;

//	}

//</style>

//$message .='<body>';


$message ="Neuer Benutzer \n\n\n
Datum : $todayis \n\n";
$message= $message .$_SESSION['first_name']. ' '. $_SESSION['last_name'];
$message=$message ." \n". $row['street']. ' ' . $row['house_nr']." \n". $row['zip'] .' '.$row['location']."\n";





$recipient = "Technik@ManiMano.ch; Amgad.Makar@gmail.com";


mail($recipient,$subject,$message,$headers);
}
}
// end admin e-mail 

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
<?php require('header.php'); ?>

<div id="contentIndex" class="row">
	<h1 id="title">6) Rechtliche Aspekte:  <img src="images/page6.png" border="0"  usemap="#green" align="right" /> </h1>
	<map name="green">
		<area shape="rect" title="PersÃ¶nliche Daten" coords="5,0,25,30" href="javascript:Nav(1);">
		<area shape="rect" title="Zeitliche VerfÃ¼gbarkeit"  coords="29,0,45,30" href="javascript:Nav(2);">
		<area shape="rect" title="Angebotsprofil" coords="50,0,68,29" href="javascript:Nav(3);">
		<area shape="rect"  title="BedÃ¼rfnisprofil" coords="71,0,86,30" href="javascript:Nav(4);">
		<area shape="rect"  title="Ãœber meine Person"  coords="92,0,107,30" href="javascript:Nav(5);">
	</map>
	<p>
		<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: 700; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
		<span class="Apple-style-span" style="font-family: Calibri; font-size: 19px; line-height: 25px; font-weight:700"></span></span>
	</p>
 	<form method="post"  name="form1" id="form6" action="settings6.php" >
		<div style='overflow:auto; height: 400px;width:100%; padding:10px;'>
			<!--six_content class start here-->
			<div class="six_content_in">
				<span id="title">1). Jugendschutz </span>
					<!--darkBg class end here-->
					<div class="paragraph">
						<p>Der Jugendschutz liegt <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> sehr am Herzen. Sie sind 15 Jahre alt und m&ouml;chten f&uuml;r die 81<img src="images/Manimano1.gif" width="180" height="100" border="0" style="float:right"/>-j&auml;hrige Nachbarin das Einkaufen &uuml;bernehmen? Sie suchen ein Kind, das mir Ihrem Dackel spazieren geht? Damit Sie, Teilnehmende von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>, nicht lange suchen m&uuml;ssen, finden Sie hier die wichtigsten Vorgaben des Gesetzgebers:</p></div>
					<div class="paragraph2">
						<p>Ein absolutes Arbeitsverbot f&uuml;r Kinder oder ein Mindestalter gibt es in der Schweiz nicht. 
						Die H&ouml;chstarbeitszeit f&uuml;r Jugendliche unter 13 Jahren betr&auml;gt drei Stunden pro Tag und neun Stunden pro Woche. Zwischen 13 bis 16 Jahren gilt diese Einschr&auml;nkung nur w&auml;hrend der Schulzeit. W&auml;hrend der halben Dauer der Schulferien und w&auml;hrend eines Berufspraktikums d&uuml;rfen Jugendliche jedoch an 40 Stunden pro Woche f&uuml;r jeweils acht Stunden am Tag zwischen 6 Uhr und 18 Uhr f&uuml;r leichte Arbeiten eingesetzt werden. 
						Klar ist, dass Jugendliche nicht f&uuml;r gef&auml;hrliche Arbeiten besch&auml;ftigt werden d&uuml;rfen. Absolut verboten ist es, dass Jugendliche f&uuml;r die Bedienung von G&auml;sten in Nachtlokalen, Dancings, Diskotheken oder Bars einzusetzen.</p></div>
					<div class="paragraph3">
						<p>F&uuml;r kulturelle, k&uuml;nstlerische und sportliche Darbietungen sowie zu Werbezwecken im Rahmen von Radio-, Fernseh-, Film- und Fotoaufnahmen, bei kulturellen Anl&auml;ssen wie Theater-, Zirkus- und Musikauff&uuml;hrungen sowie Sportanl&auml;ssen d&uuml;rfen Jugendliche besch&auml;ftigt werden â€“ ausser die T&auml;tigkeit hat einen negativen Einfluss auf die Gesundheit, die Sicherheit sowie die physische oder psychische Entwicklung â€“ oder sie beeintr&auml;chtigt den Schulbesuch und die Schulleistungen.<br /> 
						Sind die Jugendlichen noch nicht 15 Jahre alt, m&uuml;ssen derartigen Aktivit&auml;ten 14 Tage vor Beginn den kantonalen Beh&ouml;rden angezeigt werden. Sonntags- und Nachtarbeit sind grunds&auml;tzlich verboten. 
						</p>
					</div>
					<div class="paragraph3"><p>Bei Fragen oder Problemen k&ouml;nnen Sie sich unter <a href="#">www.arbeitsinspektorate.ch</a>  an die kantonalen Arbeitsinspektorate wenden. Im Kanton Z&uuml;rich ist dies das Amt f&uuml;r Wirtschaft und Arbeit, Bereich Arbeitsbedingungen, Tel.: 043 259 91 00.</p></div><br /><br />
					<span id="title">2). Datenschutzrechte</span>
					<div class="paragraph">
					<p>Bitte lesen Sie diese Erkl&auml;rung zu Ihren Datenschutzrechten sorgf&auml;ltig durch: <br /><b>a.&nbsp Von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> gespeicherte Informationen</b><br /><br />
						nformationen, die Sie bei <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> in Ihr Profil eingeben, werden von anderen Teilnehmenden aufgerufen, genutzt und gespeichert.<img src="images/Manimano2.gif" width="219" height="125" border="0" style="float:right"/> <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> liegt viel daran, ein gesch&uuml;tztes Umfeld zu schaffen. Wir versuchen, den Zugriff auf unsere Datenbank auf berechtigte Nutzer zu begrenzen, k&ouml;nnen jedoch nicht garantieren, dass unberechtigte Dritte keinen Zugang erhalten. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann auch nicht kontrollieren, wie Berechtigte aus der Datenbank herunter geladene Informationen speichern oder weiterleiten. Deshalb sollten Sie sicherstellen, dass Sie keine sensiblen Informationen in ManiMano einstellen. Wir k&ouml;nnen Ihre Informationen verwenden, um Sie von Aktualisierungen von ManiMano in Kenntnis zu setzen.</p></div>
					<div class="paragraph2"><p><b>b.&nbsp;&nbsp;Zug&auml;nglichmachen von Informationen gegen&uuml;ber Dritten</b><br />
						Wir machen Informationen zug&auml;nglich, soweit dies gesetzlich erforderlich ist.

</p></div>
			<div class="paragraph2"><p><b>c.&nbsp;&nbsp;Ihre Wahlm&ouml;glichkeiten hinsichtlich Ihrer Informationen</b><br/>

Wenn Sie wollen, k&ouml;nnen Sie Ihre personenbezogenen Daten in <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> jederzeit durchsehen, &auml;ndern oder l&ouml;schen. Loggen Sie sich einfach in Ihr Konto ein, gehen Sie in Ihr Profil â€žMeine Datenâ€œ und nehmen Sie die gew&uuml;nschten Ã„nderungen vor.  
</p></div><br /><br />
				<span id="title">3). Versicherungen und Haftung</span>
			<div class="paragraph"><p><b>a.</b>&nbsp;&nbsp;<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ist eine Plattform,<img src="images/Manimano3.gif" width="219" height="125" border="0" style="float:right"/> die es den Teilnehmenden erm&ouml;glicht, Dienstleistungen zu suchen, anzubieten, auszutauschen und so eigene Talente und F&auml;higkeiten in die Gesellschaft einzubringen oder Hilfe und Unterst&uuml;tzung zu erhalten. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> vermittelt nicht zwischen den einzelnen Kontakten, sondern stellt lediglich das Netzwerk, eine Anwendungs-Plattform,  zur Verf&uuml;gung.<br /><br />Keine Teilnehmerin und kein Teilnehmer von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ist verpflichtet, eine Dienstleistung auszuf&uuml;hren oder auf ein Angebot einzugehen. Jede Ausf&uuml;hrung ist eine freiwillige Vereinbarung zwischen beiden Teilnehmenden. <br /><br /><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> &uuml;bernimmt keine Verantwortung oder Haftung f&uuml;r die Dienstleistungen, die innerhalb des Netzwerkes vereinbart und ausgef&uuml;hrt werden.<br /><br />Die Versicherung ist Sache der Teilnehmenden. Sie vergewissern sich, dass allenfalls n&ouml;tige Versicherungen vorhanden sind. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann im Schadenfalle nicht haftbar gemacht werden. Die Versicherung bei Krankheit ist obligatorisch nach dem Krankenversicherungsgesetz (KVG) geregelt. Die Unfallversicherung ist Sache jeder und jedes Einzelnen. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann die Haftung bei Sch&auml;den nicht &uuml;bernehmen. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> empfiehlt allen Teilnehmenden, eine Haftpflichtversicherung abzuschliessen. Und denken Sie auch an die AHV, die obligatorische Grundversicherung.<br /><br />Neugierig gemacht oder Interesse geweckt? Sie wollen Ihre Verantwortung wahrnehmen, sich sch&uuml;tzen und  Genaueres &uuml;ber die Versicherungen und das Vorgehen wissen? <br /><br />Dann lesen Sie jetzt weiter!</p></div><br />
			<div class="paragraph"><p><b>b.&nbsp;&nbsp;Privathaftpflicht </b></p></div><br />
			<div class="paragraph"><p>&nbsp;&nbsp;&nbsp;&nbsp;Stellen Sie sich vor:<br /><img src="images/Manimano4.gif" width="219" height="125" border="0" style="float:right"/>Sie parkieren das ausgeliehene Auto Ihres <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> -Partners. Beim Einparken &uuml;bersehen Sie einen Pfosten. Es kracht. Was nun? Wer zahlt?<br /><br />Sie giessen die Blumen Ihres <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> -Partners. Dabei f&auml;llt ein Blumentopf auf das Parkett der Mietwohnung und hinterl&auml;sst ein Loch im Parkett. Was nun? Wer zahlt? <br /><br />Mit dem Kinderwagen ihrer <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> -Partnerin fahren Sie um die Ecke â€“ und direkt in eine Fussg&auml;ngerin, die einen Arm bricht. Was nun? Wer zahlt?<br /><br />F&uuml;gen Sie jemandem Schaden zu, werden Sie daf&uuml;r in unbegrenzter H&ouml;he haftpflichtig. Und das hat nichts mit ManiMano zu tun. Das heisst, Sie m&uuml;ssen den Schaden bezahlen. Eine Privathaftpflichtversicherung sch&uuml;tzt Sie vor den finanziellen Folgen solcher Anspr&uuml;che. Und im Fall von unbegr&uuml;ndeten Forderungen von anderen setzt sich Ihre Versicherung f&uuml;r Sie zur Wehr. Versicherungen halten verschiedene Angebote f&uuml;r Sie parat:<br /><br />-&nbsp;&nbsp;Sie versichern Sch&auml;den bis zu einer gewissen Garantiesumme z. B. 5  Millionen Franken<br />
-&nbsp;&nbsp;Sie sind z.B. versichert als Wohneigent&uuml;mer, Babysitter, Mieter, Tierhalter oder Sportler<br />
-&nbsp;&nbsp;Achten Sie darauf, dass gelegentliches Lenken fremder Fahrzeuge und Sch&auml;den an anvertrauten Sachen inbegriffen sind<br />
-&nbsp;&nbsp;Lernende und Studierende k&ouml;nnen &uuml;ber die Elternpolice mitversichert werden<br />
-&nbsp;&nbsp;Selbst&auml;ndige berufliche T&auml;tigkeiten bis zu einem Jahresumsatz von  20'000 Franken sind mitversichert, z.B. Babysitter, Kosmetikerin, Raumpfleger, Musiker, Sport- und Sprachlehrerin<img src="images/Manimano5.gif" width="219" height="125" border="0" style="float:right"/><br /><br />Eine Privathaftpflicht ist nicht teuer und einfach abgeschlossen. Auch Unternehmungen sch&uuml;tzen sich durch Haftpflichtversicherungen. <br /><br />Der Unternehmer hat gegen&uuml;ber dem Arbeitnehmer aber noch andere Pflichten. Diese finden wir generell umschrieben im Obligationenrecht: 
   </p></div><br /><br />
   			<span id="title">Schutz des Arbeitnehmers (Art. 328 Obligationenrecht)</span>
			<div class="paragraph"><p>Der Arbeitgeber hat die Pers&ouml;nlichkeit des Arbeitnehmers zu achten und zu sch&uuml;tzen.<img src="images/Manimano6.gif" width="219" height="125" border="0" style="float:right"/>Er muss auch auf die Gesundheit des Arbeitnehmers R&uuml;cksicht nehmen. Er  sorgt f&uuml;r die Wahrung der Sittlichkeit. Das heisst, er muss insbesondere daf&uuml;r sorgen, dass Arbeitnehmerinnen und Arbeitnehmer nicht sexuell bel&auml;stigt werden und dass den Opfern von sexuellen Bel&auml;stigungen keine weiteren Nachteile entstehen.<br /><br />Er hat zum Schutz von Leben, Gesundheit und pers&ouml;nlicher Integrit&auml;t der Arbeitnehmerinnen und Arbeitnehmer die Massnahmen zu treffen, die nach der Erfahrung notwendig, nach dem Stand der Technik anwendbar und den Verh&auml;ltnissen des Betriebes oder Haushaltes angemessen sind. Dies, soweit es mit R&uuml;cksicht auf das einzelne Arbeitsverh&auml;ltnis und die Natur der Arbeitsleistung ihm billigerweise zugemutet werden kann. <br /><br />Der Arbeitgeber muss also m&ouml;glich machen, was m&ouml;glich ist.

</p></div><br /><br />
			<span id="title">Alters- und Hinterlassenenvorsorge (AHV), Invalidenversicherung (IV), Erwerbsausfallversicherung (EO),  Arbeitslosenversicherung (ALV)</span><br /><br /><b><span  style="color:#FFFFFF;">Worum geht es hier?</span></b>
			<div class="paragraph2"><p>Die Alters- und Hinterlassenenversicherung (AHV) soll den<img src="images/Manimano7.gif" width="67" border="0" style="float:right"/>Grundbedarf der Versicherten decken. Die Invalidenversicherung (IV) ist f&uuml;r die finanziellen Folgen von Invalidit&auml;t da. Die Erwerbsersatzordnung (EO) kompensiert teilweise die Einkommensausf&auml;lle durch Milit&auml;r-, Zivilschutz- oder Zivildienst. Finanziert werden diese Versicherungen aus Arbeitnehmer- und Arbeitgeberbeitr&auml;gen sowie durch Bund und Kantone. Die Arbeitslosenversicherung gew&auml;hrt die Lohnfortzahlung bei Arbeitslosigkeit und f&ouml;rdert die Wiedereingliederung von Erwerbslosen in den Arbeitsmarkt.<br /><br />Die 1. S&auml;ule ist f&uuml;r alle Mitarbeitenden obligatorisch: Schweizer, Ausl&auml;nder, Familienmitglieder, im Ausland besch&auml;ftigte Mitarbeitende mit Direktvertrag bei der Muttergesellschaft, wenn der Hauptsitz in der Schweiz ist.<br /><br /><b>Wann und wo muss ich abrechnen?</b><br /><br />Sie finden bei <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> einen G&auml;rtner, der das ganze Jahr Ihren Garten besorgt. Betr&auml;gt der Gesamtlohn mehr als 2'200 Franken pro Jahr, also 184 Franken pro Monat, schreibt der Gesetzgeber die Abrechnung und Bezahlung von Beitr&auml;gen an die Alters- und Hinterlassenenvorsorge vor.<br /> 
Wenn der Gesamtlohn unter der Beitragsgrenze von 2'200  Franken pro Jahr liegt, ist die Anmeldung bei der zust&auml;ndigen Sozialversicherungsanstalt (SVA) freiwillig, wenn es sich  nicht um Arbeiten in Privathaushalten handelt. Darunter fallen Reinigungsarbeiten, Haushaltst&auml;tigkeiten und Betreuungst&auml;tigkeiten, wie zum Beispiel Kinder-, Betagten-  oder Tierbetreuung. F&uuml;r diese T&auml;tigkeiten gibt es keine Mindestgrenze. Diese sind immer abrechnungspflichtig.<br /><br />Das Vorgehen ist einfach:<img src="images/Manimano8.gif" width="219" border="0" style="float:right"/><br /><br/>Sie melden sich einmalig bei der SVA an und f&uuml;llen einmal j&auml;hrlich f&uuml;r das vergangene Jahr das Abrechnungsformular aus. 
Die betreffenden Formulare k&ouml;nnen unter folgendem Link heruntergeladen werden:<a href="#">Fragebogen f&uuml;r Arbeitgebende von Mitarbeitenden in Hausdienst und Hauswartung</a><br /><br />Falls Sie Unterst&uuml;tzung ben&ouml;tigen, finden Sie bei der SVA oder Ihrer Gemeinde kompetente und hilfsbereite Unterst&uuml;tzung. Die SVA erreichen Sie f&uuml;r weitere Fragen unter Tel 044 448 50 00 und im&nbsp;&nbsp;<a href="#">Internet.</a>
 
 </p></div><br /><br />
 <span id="title">Unfallversicherung (UVG)</span>
			<div class="paragraph"><p>Sie finden durch ManiMano eine <img src="images/Manimano9.gif" width="271" border="0" style="float:right"/>Haushaltshilfe, einen Babysitter oder andere Hausangestellte. Was m&uuml;ssen Sie jetzt tun?  Die Versicherungen bieten eine Versicherung f&uuml;r Hausangestellte, welche Sie zum Teil online abschliessen k&ouml;nnen und Sie nur 100 Franken im Jahr kostet.
Diese Versicherung ist obligatorisch, denn Sie gelten als Arbeitgeber, wenn Sie Personen in Ihrem Haushalt besch&auml;ftigen. Von den Arbeitgebern verlangt der Gesetzgeber, dass Sie Ihre Angestellten gegen Unfall versichern.
</p></div><br />
<span id="title">Berufliche Vorsorge(BVG)</span>
				
			<div class="paragraph"><p>Die betrieblichen Pensionskassen sollen die <img src="images/Manimano10.gif" width="271" border="0" style="float:right"/><br />Fortf&uuml;hrung des gewohnten Lebensstandards sichern. Voraussetzung ist ein Minimalverdienst von derzeit 20'520 Franken pro Jahr, also 1'710 Franken pro Monat.<br /><br />Die BVG-Leistungen werden vor allem durch Lohnpr&auml;mien finanziert. Jedes Jahr erhalten die Arbeitnehmerinnen und Arbeitnehmer einen Vorsorgeausweis mit der Auflistung der bisher geleisteten Beitr&auml;ge und dem zu erwartenden Alterskapital. <br /><br />Kleinen Betrieben ist der Anschluss an eine Sammelstiftung oder einer Verbandseinrichtung zu empfehlen. Vor der Auswahl sollten Unternehmensgr&uuml;nder unbedingt die Kosten, die Leistungen und den Aufwand f&uuml;r die Administration vergleichen. Die Unterschiede sind teilweise erheblich.</p></div><br /><br />
			<span id="title">Krankentaggeld-Versicherung / Erwerbsunf&auml;higkeits-, resp. Lohnausfallversicherung)</span>
			
			<div class="paragraph"><p>F&uuml;r Unternehmende ist der Abschluss einer Krankentaggeld-Versicherung zu empfehlen. Sie deckt den Lohnausfall bei Krankheit. Ebenfalls ratsam ist eine Erwerbsunf&auml;higkeits-Versicherung. Diese leistet nach Ablauf der Krankentaggeld-Versicherung (nach 2 Jahren) eine entsprechende Rente.<br /><br />Unternehmer sind verpflichtet, ihre Mitarbeitenden bei Krankheit f&uuml;r eine gewisse Zeit weiter zu entl&ouml;hnen. Wie lange diese Zeit dauert, ist gesetzlich nicht eindeutig geregelt, die Mindestdauer ist aber gem&auml;ss Gerichtspraxis 3 Wochen im 1. Dienstjahr. Im Ãœbrigen richtet man sich nach der sogenannten Z&uuml;rcher-, Basler- und Berner-Skala. <br /><br />Arbeitgeber k&ouml;nnen dieses Risiko bei Krankenkassen oder Versicherungen abdecken. Die H&auml;lfte der Pr&auml;mien k&ouml;nnen dem Personal belastet werden<br /><br />Viel Spass mit <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>!  </p></div>
			<div class="paragraph"><p><hr /></p></div>
			<div class="paragraph"><p><img src="images/Manimano11.gif" width="154" height="153" border="0" style="margin:0 0 0 300px;"/></p>
			</div>
			<div class="paragraph"><p><hr /></p></div>
			<div class="paragraph2"><p></p></div>
	  
	<!--<p><input type="button" name="nextbtn" id="nextbtn" value="Weiter zum Angebotsprofil (3 von 5)" onclick=location.href="settings3.html" /></p>-->
	</div>

	<!--six_content class end here-->
		</div>
	  <p></p>
<div Align="Center">
	<!-- <a href="http://www.manimano.ch/Agreement.html" target="_blank">Ausdrucken</a> -->
	<a href="http://www.manimano.ch/Agreement.html" target="_blank">
		<input name='Ausdrucken' type='button' id='ausdruckenbtn' style='width: initial;' class='form-control btn btn-primary' value='Ausdrucken' />
	</a>
</div>
<br>
<div Align="left">
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
echo"Ihre Daten werden jetzt Ã¼bermittelt. Sie erhalten eine Email mit einem Link - klicken Sie diesen an - dann kÃ¶nnen Sie sich anmelden und sofort loslegen. Wir wÃ¼nschen Ihnen viel Spass mit ManiMano!";
}

?>
</div>
  <br>
	<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">	
<?php
                   if ($row['Agree'] == 1){      
      echo"<input name='Speichern' type='submit' id='finishbtn' class='form-control btn btn-primary' value='Speichern' >";
}else
{
echo"<input name='Speichern' type='submit' id='finishbtn' class='form-control btn btn-primary' value='Speichern' Disabled >";
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
