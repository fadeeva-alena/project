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
<title>Rechtliches</title>
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
	echo"<h4>Bienvenue, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

?>
<input type=button value="Sur nous" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Infos légales" onclick=location.href="Rechtliches.php" id="helpbtn3">
<input type=button value="Sortir" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="Mes données" onclick=location.href="settings1.php" id="maindatbtn">
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

  <!--mainContent class start here-->
  <div class="mainContent">
  	<!--six_content class start here-->
	<div class="six_content">
	<div class="six_content_in">
		<span id="title">1). Protection de l'enfance </span>
		
			<!--darkBg class end here-->
			<div class="paragraph"><p><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> est très attaché à la protection de l'enfance. Vous avez 15 ans et souhaitez faire les courses de votre voisine de 81<img src="images/Manimano1.gif" width="180" height="100" border="0" style="float:right"/> ans? Vous cherchez un enfant pour promener votre teckel? Inscrit à <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>, pour ne pas chercher longtemps, vous trouverez ici vos obligations légales les plus importantes:</p></div>
			<div class="paragraph2"><p>En Suisse il n'y a pas d'interdiction absolue ou d'âge minimum. 
Le temps de travail pour les jeunes en dessous de 13 ans est limité à 3 heures par jour et 9 heures par semaine. Entre 13 et 16 ans cette limite n'est valable que pendant les périodes scolaires.Durant la moitié des vacances scolaires ou durant un stage pratique les jeunes peuvent être employés 40 heures par semaine soit 8 heures par jour entre 6 et 18 heures pour des travaux faciles.
Evidemment ils ne peuvent pas être employés à des travaux dangereux. Il est absolument interdit de les embaucher pour servir des consommateurs dans des boîtes de nuit, discothèques ou dancings.</p></div>
			<div class="paragraph3"><p>Pour les manifestations culturelles, artistiques ou sportives comme pour la publicité dans la cadre de la radio, télévision, cinéma ou photographie, pour des représentation de théatre, cirque ou musique comme pour des événements sportifs on peut employer des jeunes sauf si cette activité à une influence négative sur la santé, la sécurité, sur le développement physique comme psychique ou si elle impacte sa fréquentation scolaire ou ses résultats scolaires.<br /> 
Si les jeunes n'ont pas encore 15 ans, ces activités doivent être déclarées 14 jours auparavant aux autorités cantonales. Travailler le Dimanche ou la nuit est strictement interdit. 
</p></div>
			<div class="paragraph3"><p>Si vous avez des questions ou des problèmes vous pouvez vous adresser  <a href="#">www.arbeitsinspektorate.ch</a>  à l'inspection du travail cantonale.Pour le canton de Zürich  il s'agit du service pour l'économie et le travail, bureau des conditions de travail, Tel.: 043 259 91 00.</p></div><br /><br />
			<span id="title">2). Protection des données</span>
			<div class="paragraph"><p>Veuillez parcourir complètement les explications sur la protection de vos données: <br /><b>a.&nbsp Les informations stockées par <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> </b><br /><br />

Les informations que vous donnez à <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> dans votre profil, vont être vues, utilisées et stockées par d'autres inscrits.<img src="images/Manimano2.gif" width="219" height="125" border="0" style="float:right"/> <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> accorde de l'importance à créer un environnement protégé. Nous essayons de limiter l'accès à notre base de données aux personnes autorisées mais néanmoins nous ne pouvons garantir qu'un tiers n'y accède pas. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ne peut pas contrôler, comment les personnes autorisées vont sauvegarder et utiliser ces données C'est pourquoi vous devez vous assurer de ne pas mettre d'informations sensibles sur le site de ManiMano. Nous pouvons utiliser vos informations pour vous tenir au courant des nouveautés ManiMano.</p></div>
			<div class="paragraph2"><p><b>b.&nbsp;&nbsp;Publication des informations</b><br />

Nous publions les informations, tant qu'elles restent légales.

</p></div>
			<div class="paragraph2"><p><b>c.&nbsp;&nbsp; Vos choix vis à vis de vos données</b><br/>

Quand vous le désirez vous pouvez  revoir, modifier ou supprimer vos données personnelles dans <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> . Ouvrez une session avec votre compte, allez à votre profil „Mes Données“ et faites vos modifications.  
</p></div><br /><br />
				<span id="title">3). Assurance et responsabilité</span>
			<div class="paragraph"><p><b>a.</b>&nbsp;&nbsp;<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ist eine Plattform,<img src="images/Manimano3.gif" width="219" height="125" border="0" style="float:right"/> die es den Teilnehmenden ermöglicht, Dienstleistungen zu suchen, anzubieten, auszutauschen und so eigene Talente und Fähigkeiten in die Gesellschaft einzubringen oder Hilfe und Unterstützung zu erhalten. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> vermittelt nicht zwischen den einzelnen Kontakten, sondern stellt lediglich das Netzwerk, eine Anwendungs-Plattform,  zur Verfügung.<br /><br />Keine Teilnehmerin und kein Teilnehmer von <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ist verpflichtet, eine Dienstleistung auszuführen oder auf ein Angebot einzugehen. Jede Ausführung ist eine freiwillige Vereinbarung zwischen beiden Teilnehmenden. <br /><br /><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> übernimmt keine Verantwortung oder Haftung für die Dienstleistungen, die innerhalb des Netzwerkes vereinbart und ausgeführt werden.<br /><br />Die Versicherung ist Sache der Teilnehmenden. Sie vergewissern sich, dass allenfalls nötige Versicherungen vorhanden sind. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann im Schadenfalle nicht haftbar gemacht werden. Die Versicherung bei Krankheit ist obligatorisch nach dem Krankenversicherungsgesetz (KVG) geregelt. Die Unfallversicherung ist Sache jeder und jedes Einzelnen. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> kann die Haftung bei Schäden nicht übernehmen. <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> empfiehlt allen Teilnehmenden, eine Haftpflichtversicherung abzuschliessen. Und denken Sie auch an die AHV, die obligatorische Grundversicherung.<br /><br />Neugierig gemacht oder Interesse geweckt? Sie wollen Ihre Verantwortung wahrnehmen, sich schützen und  Genaueres über die Versicherungen und das Vorgehen wissen? <br /><br />Dann lesen Sie jetzt weiter!</p></div><br />
			<div class="paragraph"><p><b>b.&nbsp;&nbsp;Privathaftpflicht </b></p></div><br />
			<div class="paragraph"><p>&nbsp;&nbsp;&nbsp;&nbsp;Imaginez:<br /><img src="images/Manimano4.gif" width="219" height="125" border="0" style="float:right"/>Vous garez un véhicule prêté par un partenaire <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> . En vous garant vous n'avez pas vu un montant. Un craquement! Que faire? Qui paye?<br /><br />Vous arrosez les plantes de votre partenaire  <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> . Un pot de fleur tombe sur le parquet de l'appartement loué et fait un trou. Que faire? Qui paye? <br /><br />Avec la pousette de votre partenaire <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> au détour d'un croisement, vous foncez dans un pièton qui se casse le bras. Que faire? Qui paye?<br /><br />Si vous causez des dommages à quelqu'un, vous êtes responsable à hauteur d'un montant non limité. Et Manimano n'intervient pas. C'est à dire que vous devez payer pour les dégats.  Une assurance privée civile vous protègera des suites financières de telles exemples. Et dans le cas de réclamations non fondées votre assurance s'en occupera à votre place. Les assurances ont différentes offres à votre disposition:<br /><br />-&nbsp;&nbsp;Vous pouvez assurer des dégats à hauteur d'une certaine somme garantie par ex: 5 millions de Francs Suisses<br />
-&nbsp;&nbsp;Vous êtes assurés par ex. comme propriètaire de votre résidence, Babysitter, locataire, pour vos animaux ou comme sportif<br />
-&nbsp;&nbsp;Contrôlez, si la conduite occasionelle d'un véhicule ne vous appartenant pas et les dégats causés à des affaires que l'on vous a confiées sont également couverts<br />
-&nbsp;&nbsp;Scolaires et étudiants peuvent être couverts par la police de leurs parents.<br />
-&nbsp;&nbsp;Des activités professionnelles indépendantes avec un chiffre d'affaire de 20000 Francs Suisses sont compris dans l'assurance, par ex  Babysitter, esthéticienne, Femme de ménage, Musicien, Professeur de sport ou langues<img src="images/Manimano5.gif" width="219" height="125" border="0" style="float:right"/><br /><br />Une assurance civile ne coûte pas cher et est simple à souscrire. Les entreprises se protègent également grâce à ces assurances civiles. <br /><br />L'employeur a d'autres devoirs vis à vis de son employé. On les trouvent généralement décrits dans les obligations légales:
   </p></div><br /><br />
   			<span id="title">Protection de l'employé (Art. 328 Obligations légales) </span>
			<div class="paragraph"><p>L'employeur doit respecter et protéger l'employé en tant que personne. <img src="images/Manimano6.gif" width="219" height="125" border="0" style="float:right"/>Il doit faire attention à l'état de santé de son employé. Il doit veiller à la défense de la moralité. C'est à dire il doit veiller à ce que ses employés ne soient pas harcelés et que les victimes de harcèlements sexuels ne subissent plus de désagréments.<br /><br />Pour protéger la vie, la santé et l'intégrité physique de ses employés il doit prendre les mesures, nécessaires d'après l'expérience, applicable en fonction de la technique et adapté aux conditions de l'entreprise ou de la maison. Il lui est demandé de le faire de façon économique en prenant en compte les particularités du contrat de travail et la nature de ce travail. <br /><br />L'employeur doit faire tout son possible.

</p></div><br /><br />
			<span id="title">Assurance vieillesse et survivants (AHV), Assurance invalidité (IV), Allocation pour perte de gains(EO), Assurance chômage (ALV)</span><br /><br /><b><span  style="color:#FFFFFF;">De quoi s'agit-il?</span></b>
			<div class="paragraph2"><p>L'assurance  vieillesse et survivants (AHV) <img src="images/Manimano7.gif" width="67" height="98" border="0" style="float:right"/>doit couvrir les besoins vitaux de l'assuré. L'assurance invalidité (IV) permet de faire face aux conséquences financières. L'allocation pour perte de gains (EO) compense les manques à gagner liés au service militaire, à la protection civile ou au service civil. Ces assurances sont financés par les charges patronales et salariales ainsi que par les régions et les cantons. L'assurance chômage accorde un droit à un salaire en cas de chômage et favorise la ré-intégration des sans-emplois dans le monde du travail.<br /><br />Ce premier pilier est obligatoire pour tous les travailleurs: suisses, étranger, membre de la famille, collaborateur à l'étranger avec un contrat direct de la maison mère, quand le siège social est en suisse.<br /><br /><b>Quand et où dois-je déclarer?</b><br /><br />Vous trouvez grâce à<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> un jardinier, qui s'occupe pendant toute l'année de votre jardin .Si la somme des salaires versée s'élève à plus de 2000 francs suisses par an, soit 184 francs suisse par mois, il faudra d'après la loi, déclarer et verser les contributions à l'assurance vieillesse et survivants. <br /> 
Quand les sommes totales versées sont en dessous de la limite des 2200 francs suisses par an, la déclaration auprès de la sécurité sociale (SVA) est volontaire, sauf s'il s'agit d'un travail dans une maison privée. On y trouve les travaux de nettoyage, l'aide ménagère ou les activités de garde comme les gardes d'enfants, de personnes agées ou d'animaux. Pour ces activités il n'y a pas de limites basses.<br /><br />La procédure est simple:<img src="images/Manimano8.gif" width="219" height="125" border="0" style="float:right"/><br /><br/>Vous vous inscrivez une unique fois à la SVA  et remplissez le formulaire de déclaration une fois par an pour l'année précédente.
Vous pouvez télécharger les formulaires correspondants au lien suivant:<a href="#">Formulaires pour employeur et employé de maison </a><br /><br />Si vous avez besoin d'aide, vous pouvez demander à la SVA ou aux services compétents et devoués de votre commune. Vous pouvez contacter la SVA pour de plus amples informations au numéro de Tél: 044 448 50 00 et sur internet au &nbsp;&nbsp;<a href="#">Internet.</a>
 
 </p></div><br /><br />
 <span id="title">Assurance accident (UVG)</span>
			<div class="paragraph"><p>Vous trouvez via <img src="images/Manimano9.gif" width="271" height="197" border="0" style="float:right"/> une aide ménagère, une babysitter ou une autre employé de maison. Que devez vous faire?  Les assurances proposent une assurance pour les employés de maison. Vous pouvez souscrire en ligne et elle ne coûte que 100 francs suisses par an.
Cette assurance est obligatoire, car vous êtes considéré comme employeur, dès qu'une personne s'occupe de votre maison. La loi demande à l'employeur d'assurer ses employés en cas d'accidents.
</p></div><br />
<span id="title">Caisse de retraite (BVG)</span>
				
			<div class="paragraph"><p>Les caisses de retraite des entreprises<img src="images/Manimano10.gif" width="271" height="197" border="0" style="float:right"/><br />doivent assurer la continuité du niveau de vie habituel. Une condition est un salaire minimum de 20520 francs suisses actuellement par an soit 1720 par mois.<br /><br />Les prestations BVG sont financées par les primes salariales. Chaque année les employés recoivent un récapitulatif des contributions et le montant du capital retraite. <br /><br />Il est conseillé pour les petites entreprises de s'affilier à une organisation collective de gestion. Avant de choisir les entrepreneurs doivent comparer les prix , les services et les dépenses administratives. Les différences sont considérables.</p></div><br /><br />
			<span id="title">Assurance Indemnités journalière - incapacité de travail et assurance perte de salaire</span>
			
			<div class="paragraph"><p>Pour les entrepreneurs il est conseillé de contracter une assurance pour indemnités journalières en cas de maladie. Elle couvre la perte de salaire en cas de maladie. De même il est conseillé d'avoir une assurance contre les incapacités de travail. Elle permet de fournir après les indemnités journalières maladie (après deux ans) une pension. <br /><br />Les employeurs sont tenus, de payer pendant un certain temps un salaire en cas de maladie. La durée de cette période n'est pas clairement définie par la loi, la durée minimum est en pratique de 3 semaines par année de travail. En outre on se tourne vers les échelles nommées Zürcher-, Basler- und Berner-Echelle.<br /><br />Les employeurs peuvent éliminer ce risque avec les caisses maladie ou les assurances. La moitié des primes peuvent être à charge du personnel.<br /><br />Nous vous souhaitons beaucoup de plaisir avec <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>!  </p></div>
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
