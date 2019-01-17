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
<title>Sur nous</title>
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
<input type=button value="Infos Légales" onclick=location.href="Rechtliches.php" id="helpbtn3">
<input type=button value="Sortir" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="Mes données" onclick=location.href="settings1.php" id="maindatbtn">
	<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Rechercher' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Rechercher' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
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
<input type=button value="Infos Légales" onclick=location.href="Rechtliches.php" id="helpbtn4">
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
		<span id="title">Qu'est <span style="color:#FF0000; font-size:1em;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:1em;	font-weight:700;">Mano</span>?</span>
		
			<!--darkBg class end here-->
			<div class="paragraph3"><p><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> est une aide de proximité en ligne, dont nous mettons la licence à disposition aux communes et aux villes.</p></div>
			<div style="float:right; padding:7px"><a href="http://www.manimano.ch/images/arbeitsflussdiagramm_manimano.jpeg"><img border="0" width="260" height="300" src="http://www.manimano.ch/images/arbeitsflussdiagramm_manimano_small.jpeg" alt="Arbeitsflussdiagramm ManiMano"/></a><br /><span style="color:#FFFFFF">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(Cliquez pour agrandir)</span></div>
			<div class="paragraph3"><p><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> met en relation des groupes de population, qui sinon ne se rencontrent presque jamais. Beaucoup de ces groupes sont plus ou moins connectés (les parents avec des associations de parents, les séniors, les étudiants). Mais il n'existe pratiquement pas de réseau qui relie tous ces groupes. </p></div>
			<div class="paragraph3"><p><b>Simplicité:</b> Parce ce que nous savons que tous types de personnes (des moins expérimentés au plus expérimentés) travaillent avec <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;"> Mano</span>,<span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> est si simple, qu'il remplit notre exigence la plus importante : une grand-mère stressée peut l'utiliser.
Pourquoi est-ce notre plus grand avantage? Parce qu'une grand-mère appartient à une autre génération et a développé d'autres structures de pensée. Parce que ce sont des femmes, et la plupart des développeurs de logiciels sont des hommes. Et parce que les logiciels, hormis pour des cockpits, ne sont pratiquement jamais testés sous stress.
</p></div>
			<div class="paragraph3"><p><b>Coûts:</b> „Vraiment aucune commune ou ville ne peut se permettre, de ne pas s'offrir <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> .“  - Ce qui sonne provocateur, se laisse facilement vérifier. Et c'est comme çà que nous l'avons pensé : avec des faits rigoureux évalués en francs et centimes. Naturellement on doit prendre en compte la composition de la population, le nombre de PME, de séniors actifs etc. Nous vous ferons volontiers un calcul avec vos données.<br />
Si on prend l'exemple de Egg, avec environ 8000 habitants comme base de calcul :<br />
9% de la population sont des indépendants.
Nous partons sur la base d'un salaire horaire moyen de 120.-. Chacun de ces indépendants emploie une demi-heure par jour un sénior, un chômeur ou un étudiant, par ex. en vidant la boite aux lettres, ou en amenant un paquet à la poste ou à un client.<br />
Dans ce même temps l'indépendant peut se concentrer sur son travail et gagne par année 12.120.- supplémentaires. (Le salaire pour l'employé a été déjà enlevé, soit 19.- pris en compte).<br />
Par conséquent les impôts de la commune sont augmentés de environ 880.- à 1116.-. Nous prendrons une moyenne de 998.-. 
Cela fait par habitant un surplus de 90.- / an.</p></div>
			<div class="paragraph3"><p>Nous avons discuté intensivement avec beaucoup de représentants de PME. Beaucoup auraient pour <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span>-des tâches de durée manifestement supérieure à une demi-heure. Et toutes sont partantes– d'après ce qu'elles disent.<br />
Même si tous ne participent pas au début, le résultat parle de lui-même :
Même si un <b><i>centième</i></b> offre une demi-heure de travail, et pendant ce temps se consacre à son coeur de métier, l'effort financier de la commune ou de la ville est déjà presque compensé!</p></div>
			<div class="paragraph3"><p>Et nous attirons votre attention sur le fait que les PMEs sont uniquement un des six groupes ciblés.<br />
Et uniquement avec un des groupes ciblés la décision de prendre <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> pour la commune ou la ville est déjà payante!</p></div>
			<div class="paragraph3"><p>Remarque: Les chiffres proviennent des autorités fiscales.</p></div>
			<div class="paragraph3"><p><b>Compensation:</b> <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> ne prone pas le travail gratuit. Nous croyons qu'une compensation immédiate est plus efficace  - il „ne tire aucune ficelle“. Celui qui veut offrir gratuitement son travail, peut naturellement le faire. Nous suggérons une compensation de 15.-/heure. Cette compensation, les participants la déterminent eux-même. Nous estimons que l'auto-responsabilité est un bien des plus estimable.</p></div>
			<div class="paragraph3"><p><b>Pas de surcroît de travail :</b> Lors de nos conversations préliminaires avec les intervenants il est apparu clairement, qu'une des demandes importantes de beaucoup de villes et de communes, qu'avec l'introduction de <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> est qu'il n'y aura pas de surcroît de travail.<br />
Cela nous l'avons pesé en conséquence et pris au sérieux.<br />
C'est pourquoi nous avons développé en conséquence des mesures de marketing effectives et de grande envergure, que nous vous proposons avec plaisir.<br />
On garantit ainsi, que l'effet synergie jouera à plein. Pour tous.</p></div>
			<div class="paragraph3"><p><b>Aspects légaux:</b> Avec cela <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> peut être déployé sans soucis par une ville ou une commune, il est important, de vérifier sèrieusement les aspects légaux. Nous avons travaillé avec plusieurs juristes, pour le garantir. Il ne s'agit pas uniquement de protection de données, mais aussi de comptes propres de revenus supplémentaires, des assurances et du calcul de l'AVS. Et cela pour chaque couche, facilement compréhensible, grace à des ajouts de liens.</p></div>
			<img border="0" width="268" height="230" style="float:right; padding:10px 0 10px 10px" src="http://www.manimano.ch/images/about.jpg" alt="Cas idéal: le jardinier ManiMano"/>
			<div class="paragraph3"><p><b>Instructions:</b> Pour nous assurer que soient évitées les fautes simples de débutant, nous avons tourné des films : Dans l'un tout va de travers – et les intervenants arrivent à la fin au résultat, que <span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span> fonctionne avec succès pour tous les participants. La plupart du temps il suffit de communication, d'assurance, de ponctualité et de confiance.<br />
Ce sont les petites choses qui amènent le succès.  Et nous sommes parvenus à faire un guide formidable, <b>qui</b> amènera le succès pour votre commune ou ville.</p></div>
			<div class="paragraph3"><p><b>Encore des questions?</b> Pas de problèmes. Appelez-nous. Nous répondrons avec plaisir à vos questions.<br />
<b>Plus de question?</b> Encore mieux. Nous déciderons volontiers lors d'une réunion d'une échéance, qui rendra possible dans votre commune ou ville une introduction simple et ciblée.</p></div>
			<div class="paragraph3"><p><b>Contact:</b></p></div>
			<img border="0" width="160" height="200" style="float:left; padding:20px 10px 0 0" src="http://www.manimano.ch/images/david.jpg" alt="David Schläpfer"/>
			<div class="paragraph3"><p>David Schläpfer<br />
propriétaire et gérant<br />
DSC GmbH</p></div>
			<div class="paragraph3"><p>Tel: 044 994 73 74<br />
Fax: 044 994 73 71<br />
Email: Technik@ManiMano.ch</p></div>
			<div class="paragraph3"><p>DSC GmbH: <i>pour une technologie durable au service des hommes </i></p></div>
	  
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
