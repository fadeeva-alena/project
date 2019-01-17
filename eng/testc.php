<?php
$to = 'Amgad.Makar@gmail.com';

$subject = 'Willkommen bei ManiMano';

$headers = "From: " . "Technik@ManiMano.ch". "\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

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

font-family: verdana;

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


$message .='<p><strong>Hallo &lt;firstname&gt; &lt;lastname&gt;</strong></p>

<p><strong>Willkommen</strong>, Sie sind jetzt auch ein <span style=';
$message .='color:red ;';


$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><strong>! <br> </strong>&nbsp;</p>

<p>Bitte klicken Sie <a href=';
$message .='http://manimano.ch/activate.php?id target=';

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
$message .='> sind nicht Vertragspartei, wir bieten lediglich die Plattform dazu. <br> In diesem Zusammenhang empfehlen wir Ihnen das Studium der rechtlichen Hinweise – <br>';

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
mail($to, $subject, $message, $headers);


?>
