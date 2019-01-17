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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>About us</title>
<link href="style2.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
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
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn3">
<input type=button value="Logout" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="My Settings" onclick=location.href="settings1.php" id="maindatbtn">
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
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Register" onclick=location.href="location.php" id="regbtn">
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
		<span id="title">What is <span style="color:#FF0000; font-size:1em;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:1em;	font-weight:700;">Mano</span>?</span>
		
			<!--darkBg class end here-->
			<div class="paragraph3">
                <p>
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
					<!--ist eine Online-Nachbarschaftshilfe, die wir Gemeinden und Städten zum Einsatz lizenzieren.-->
                    is an online system for neighbourly aid, which we license to municipalities.
                    <!-- xxx Remark: i'd rather say 'to foster / fostering neighbourly'... but that's up to your original german... and:: you're most likely licensing it to the 'municipality' rather than 'towns and cities' --so I put that in there-- perhaps you need to check the doc as a whole should you consider the term 'municipality' inappropriate-->
                </p></div>
			<div style="float:right; padding:7px">
                <a href="http://www.manimano.ch/images/arbeitsflussdiagramm_manimano.jpeg"><img border="0" width="260" height="300" src="http://www.manimano.ch/images/arbeitsflussdiagramm_manimano_small.jpeg" alt="Arbeitsflussdiagramm ManiMano"/></a><br /><span style="color:#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Click to enlarge)</span>
            </div>
            
			<div class="paragraph3">
                <p>
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    <!-- xxx verbindet die Bevölkerungsgruppen, die sich sonst kaum treffen. Viele dieser Gruppen sind unter sich mehr oder weniger gut verlinkt (Eltern über einen Elternclub, Senioren, Studenten). Aber es gibt fast kein Netzwerk, das alle diese Gruppen verbindet. -->
                    connects various population groups hardly meeting otherwise. Many of these groups are more or less well linked amongst themselves (i.e., parents through parent club, seniors, students). However, there is almost no network connecting these groups.
                </p>
            </div>
                
			<div class="paragraph3">
                <p>
                    <b>Simplicity:</b> 
                    <!--Weil wir wissen, dass unsere Kleinsten bis zu unseren Erfahrensten mit -->
                    As we know, our youngsters up to the most experienced amongst us work with
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    , therefore making  
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    <!-- so einfach, dass es unsere strengste Vorgabe erfüllt: Eine Grossmutter kann es im Stress bedienen. Warum ist das unsere strengste Vorgabe? Weil Grossmütter in der Regel einer anderen Generation angehören, andere Denkstrukturen entwickelt haben. Weil sie Frauen sind, und die meisten Softwareentwickler Männer. Und weil Software, ausser fürs Cockpit, praktisch nie unter Stress getestet wird.
                    -->
                    so simple that it fulfills our most demanding expectations: Also under stress, grandmother can handle it. Why is that our prerequisite? It is, because grandmothers usually belong to another genertation, have developed other thought patterns. And as they are women, and most software developers men. And because software, if it's not for the cockpit, is virtually never tested.  
                               
            	</p>
			</div>
            
			<div class="paragraph3">
                <p>
                    <b>Charges:</b> 
        
        <!--            „Eigentlich kann sich keine Gemeinde oder Stadt leisten, 
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    nicht anzubieten.“  
        -->            
                    „Actually, not offering
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    can hardly be afforded by any town or city.“ 
                    
                    <!--- Was provativ klingt, lässt sich einfach nachrechnen. Und wir meinen das genau so: Mit harten Fakten in Franken und Rappen. Natürlich kommt es etwas auf die Bevölkerungsverteilung an, Anzahl KMU, aktive Senioren und so weiter. Gerne rechnen wir das mit Ihren Zahlen durch.<br />Am Beispiel von Egg, mit etwa 8000 Einwohnern kann man folgendes rechnen:<br />9% der Bevölkerung sind Selbstständigerwerbende.Wir gehen von einem durchschnittlichen verrechenbaren Stundenlohn von 120.- aus. Jeder dieser Selbstständigerwerbenden beschäftigt pro Tag für eine halbe Stunde einen Senior, Arbeitslosen oder Studenten, z.B. indem ihm dieser das Postfach leert, oder Pakete zur Post oder zu den Kunden bringt.<br />In dieser Zeit kann der Selbstständigerwerbende sich mehr auf seine Arbeit konzentrieren und verdient damit pro Kalenderjahr 14‘625 mehr. (Der Lohn für den Unterstützenden ist schon abgezogen, hier wurden 15.- eingesetzt).<br />Damit verbessert sic
 h das Ergebnis fürs Gemeindesteueramt um einen Ertrag von 1100.- bis 1396.-. Wir nehmen den Mittelwert von 1250.-. Das macht pro Einwohner/in einen Mehrbetrag von 112.50 / Jahr .-->
                    
                    It may sound provocative, however, it can be easily recalculated. And we do think it precisely that way: with hard facts, in Swiss Francs. Of course there is some dependency on the population distribution, number of SMEs, active seniors and so on. However, we would be looking forward to calculate it with your particular numnbers. <br /> With the example of Egg, having about 8000 inhabitants, one can calculate the following: <br /> 9% of the population are self-employed. We assume an average hourly rate of 120 - here. Each of these self-employed persons may engage for half an hour per day either a senior, an unemployed or a student, e.g. by emptying the mailbox, or by bringing packages to the post office or to customers. <br /> 
                    In this time, those being self-employed are more focused on their jobs, and in a single calendar year may earn an additional 12'120. (The income of the person giving the support has already been subtracted, here we used 19.-). <br />
  Thereby, the local tax increases between 880.- to 1116.-. When taking the average of 998.- that implies a premium of 90.- per year per capita.
                
                
                </p>
            </div>

			<div class="paragraph3">
                <p>
<!--                    Wir haben intensiv mit vielen KMU-Vertretern gesprochen. Vielen hätten -->
                    We have spoken intensively with many SME representatives. Many would have
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>
                    <!---Aufgaben für deutlich mehr als eine halbe Stunde pro Tag. Und alle würden mitmachen– sagen Sie.<br />Doch auch wenn sich nicht jeder schon am Anfang mitmacht, spricht das Ergebnis eine klare Sprache: Wenn nur jeder <b><i>hundertste</i></b> eine halbe Stunde Arbeit pro Tag vergibt, und sich während dieser Zeit seiner Kernkompetenz widmet, ist der finanzielle Einsatz der Gemeinde oder Stadt bereits wieder ausgeglichen!-->
                    working tasks for well over half an hour per day. And all would join in, they say. <br /> But even if not everyone joined in in the beginning, the results convey a clear message: If only <b><i>one out of a hundred</i></b> required work for half an hour per day, and during this time could dedicate himself towards his core competence, the financial commitment of the municipality is broken even.
                    
                </p>
            </div>
            
            <div class="paragraph3"><p>
<!--            	Und wir möchten anmerken, dass die KMU nur eine der sechs Zielgruppen sind.<br />Und nur mit dieser einen Zielgruppe hat sich der Entscheid für -->
                We would like to note that SMEs are only one out of six target groups.<br />And only with this target group the decision for 
				<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
<!--                für die Gemeinde oder Stadt bereits gelohnt!-->
                has paid of for the municipality.
                
</p><!-- xxx is this p here at all accurate?? -->

            </div>
			
            <div class="paragraph3">
            	<p>
                	<!--Anmerkung: Die Zahlen stammen von der Steuerbehörde.-->
                    Remark: The numbers come from the tax office.
				</p>
            </div>

			<div class="paragraph3"><p><b>Compensation:</b> 
                <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>
                <!--propagiert nicht Gratisarbeit. Wir glauben, dass ein sofortiger Ausgleich viel wirkungsvoller ist - er „zieht keine Fäden“. Wer seine Arbeit gratis schenken möchte, kann das natürlich trotzdem tun. Wir schlagen jedoch einen Ausgleich von 15.-/Stunde vor. Diesen Ausgleich nehmen die Beteiligten selbst vor. Wir schätzen die Selbstverantwortung als eines der höchsten Güter ein.-->
				does not propagate unpaid work. We believe that an immediate compensation is much more effective - it "does not pull threads". Those who want to work without getting paid, however, can of course do so anyway. We however do propose a compensation of 15.-/hour. The undertaking of the compensation is done by the participants themselves. We appreciate the personal responsibility as one of the highest goods.

</p><!-- xxx is this p here at all accurate?? -->
            </div>

			<div class="paragraph3">
            	<p>
                    <b>No overtime:</b> 
                    <!--Bei unseren vielen Vorgesprächen mit Beteiligten hat sich klar gezeigt, dass es ein wichtiges Anliegen von vielen Städten und Gemeinden ist, dass mit der Einführung von--> 
                    In many of our preliminary talks it evolved that a main concern of municipalities is that with the introduction of 
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    <!--keine Mehrarbeit anfällt.<br />Das haben wir entsprechend gewichtet und ernstgenommen.<br />Deshalb haben wir entsprechende weitgreifende und effektive Marketingmassnahmen entwickelt, die wir gerne zusätzlich anbieten.<br /> Damit ist sichergestellt, dass der Synergieeffekt schnell zum Tragen kommt. Für alle.-->
                    no overtime is introduced.<br /> This we took seriously and weighted it accordingly.<br />  Therefore, we have developed appropriate far-reaching and effective marketing efforts, which we offer in addition. <br /> This ensures that synergistic effects quickly become tangible. For all.
                </p>
			</div>

			<div class="paragraph3">
                <p>
                    <b>Legal security:</b> 
                    To allow for the use of 
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    <!--bedenkenlos von einer Stadt oder Gemeinde eingesetzt werden kann, ist es wichtig, dass auch die rechtliche Seite zuverlässig geprüft wurde. Wir haben mit mehreren Juristen gearbeitet, um das sicherzustellen. Nicht nur, was den Datenschutz angeht, sondern auch eine saubere Abrechnung der Mehreinnahmen, der Versicherung und der AHV-Abrechnung. Und zwar für alle Schichten leicht verständlich, mit Links ergänzt.-->
                    by a municipality without any hesitation it is important, that also the legal side has been reliably tested. We have worked with several lawyers, to ensure this. Not only in terms of privacy, but also regarding the clean accounting of revenue, insurance and AHV-billing. And for everyone easy to understand, complemented with links.
                </p>
            </div>
            
			<img border="0" width="268" height="230" style="float:right; padding:10px 0 10px 10px" src="http://www.manimano.ch/images/about.jpg" alt="Idealfall: Der ManiMano-Gärtner"/>
			
            <div class="paragraph3">
                <p>
                    <b>Tutorials:</b> 
                    <!--Um sicherzustellen, dass die einfachen Anfängerfehler vermieden werden können, haben wir Filme gedreht: Im einen geht allerlei schief – und die Beteiligten liefern am Schluss die Ergebnisse, wie -->
                    To ensure the avoidance of simple beginners' mistakes, we have made films: in one a whole lot goes wrong - and the participants deliver the results at the end, how
                    
                    <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span>
                    <span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> 
                    <!--für alle Beteiligten erfolgreich funktioniert.  Meist geht es um Kommunikation, Versicherung, Pünktlichkeit und Zuverlässigkeit.<br />Es sind kleine Dinge, die den Erfolg ausmachen.  Und wir haben tolle Anleitungen dazu geschaffen, <b>dass</b> der Erfolg auch für Ihre Gemeinde oder Stadt Wirklichkeit wird.-->
                    for all participants it works out. Most often it is about communication, reinsurance, punctuality and reliability.<br />It's the small things that render success. And we have created great guides to <b> that </ b> the success will become a reality also for your town or city.-->
                    
                </p>
            </div>
            
			<div class="paragraph3">
                <p>
                    <b>Questions?</b> 
                  <!--  Kein Problem. Dann rufen Sie uns an. Gerne beantworten wir Ihre Fragen.<br /><b>Keine Fragen mehr?</b> Noch besser. Gerne legen wir in mit Ihnen in einer Sitzung den geeigneten Ablauf fest, der eine einfache und zielgerichtete Einführung in Ihrer Gemeinde oder Stadt möglich macht.-->
                   No problem. Call us, we are happy to answer your questions. <br /> <b>No more questions? </b> Even better. We are happy to join with you in a meeting to agree on the appropriate procedure that allows a simple and purposeful introduction in your town or city.
                    
                </p>
            </div>
            
			<div class="paragraph3"><p><b>Contact:</b></p></div>
            
			<img border="0" width="160" height="200" style="float:left; padding:20px 10px 0 0" src="http://www.manimano.ch/images/david.jpg" alt="David Schläpfer"/>

			<div class="paragraph3">
                <p>
                    David Schläpfer<br />
                    Owner and CEO<br />
                    DSC GmbH
                    
                </p>
            </div>

			<div class="paragraph3">
            <p>Tel: 044 994 73 74<br />
Fax: 044 994 73 71<br />
Email: Technik@ManiMano.ch</p></div>

			<div class="paragraph3">
            <p>DSC GmbH: <i>for sustainable technology in the service of man</i></p></div>
	  
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
