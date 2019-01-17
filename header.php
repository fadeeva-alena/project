<?php
$filename = basename($_SERVER['SCRIPT_FILENAME'],".php");
$title ="";$about="";$rechtliches="";$location="";$search="";$faq="";$help="";$login="";$settings="";$index="";$register="";
switch ($filename) {
    case 'about':
        $title = "Was ist ManiMano? - ";
        $about ="active";
        break;
    case 'Rechtliches':
        $title = "ManiMano und die rechtlichen Aspekte - ";
        $rechtliches ="active";
        break;
    case 'location':
        $title = "Bitte wählen Sie Ihre PLZ / Ort aus. - ";
        $location ="active";
        break;
    case 'search':
        $title = "Suchen - ";
        $search ="active";
        break;
    case 'nsearch':
        $title ="Suchen - ";
        $search ="active";
        break;
    case 'search1':
        $title ="Suchen - ";
        $search ="active";
        break;
    case 'faq':
        $title = "Häufige Fragen - ";
        $faq ="active";
        break;
    case 'help':
        $title = "Hilfe und Unterstützung - ";
        $help ="active";
        break;
    case 'login':
        $title = "Login - ";
        $login ="active";
        break;
    case 'settings1':
        $title = "Setting 1 Persönliche Daten - ";
        $settings ="active";
        break;
    case 'settings2':
        $title = "Setting 2 Zeitliche Verfügbarkeit - ";
        $settings ="active";
        
        break;
    case 'settings3':
        $title = "Setting 3 Angebotsprofil - ";
        $settings ="active";
        $bs = 1 ;
        break;
    case 'settings4':
        $title = "Setting 4 Bedürfnisprofil - ";
        $settings ="active";
        $bs = 1 ;
        break;
    case 'settings5':
        $title = "Setting 5 Über meine Person - ";
        $settings ="active";
        break;
    case 'settings6':
        $title = "Setting 6 Rechtliche Aspekte - ";
        $settings ="active";
        break;
    case 'register1':
        $title = "Registrierung 1 von 6 - ";
        $register ="active";
        break;
    default:
        $title = "Willkommen - ";
        $index ="active";
        break;
}
$title .="ManiMano";
?>
<?php

$home 	= "index.php";
$suche 	= "nsearch.php?kinder=1&type=0&gender=2";
$messageWelcome ="";

if ($_SESSION['auth'] == "yes"){
	$home = "welcome.php";
	$messageWelcome = "<span class='welcome'>Willkommen, ".$_SESSION['first_name']." ".$_SESSION['last_name']."</span>";
	$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
	$result=mysql_query($sql);
	$row=mysql_fetch_array($result);

	if (($row['Agree'] == 1) And ($row['Active'] == 1)){     
		$sql="SELECT * FROM _t_search WHERE Username='$row[username]' ORDER BY searchid DESC ";
		$result1=mysql_query($sql);

		$count=mysql_num_rows($result1);
		if($count>=1){  
			$row1=mysql_fetch_array($result1);
			if  ($row1['Gender'] =='f')
			$g=0;
			if  ($row1['Gender'] =='m')
			$g=1;
			if  ($row1['Gender'] =='both')
			$g=2;

			if  ($row1['Search_type'] =='Seeks')
			$t=0;

			if  ($row1['Search_type'] =='Needs')
			$t=1;

			$ke= urlencode($row1['ke']);
			$suche = "search.php?kinder=".$row1['Skill_type']."&type=".$t."&gender=".$g."&ke=".$ke;
		}
          Else 

            $suche 	= "search.php?kinder=1&type=0&gender=2";
	}
}
?>
<!DOCTYPE html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo $title; ?></title>

<!-- Start Stylsheets & Plugins-->
<link href="style.css" rel="stylesheet" type="text/css" />
<!-- <link href="style2.css" rel="stylesheet" type="text/css" /> -->
<link type="text/css" rel="stylesheet" href="css/example.css">
<link href="custom/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="custom/css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<link href="custom/css/custom.css" rel="stylesheet" type="text/css" />

<link href="SpryAssets/SpryMenuBarHorizontal1.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<!-- Ends Stylsheets -->

<!-- Start JavaScripts & Plugins -->
<script src="custom/js/jquery.min.js" type="text/javascript"></script>
<script src="custom/js/bootstrap.min.js" type="text/javascript"></script>

<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<script src="SpryAssets/SpryMenuBar.js" type="text/javascript"></script>
<script src="js/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
	swfobject.registerObject("FLVPlayer", "9.0.0", "flash/expressInstall.swf");
	swfobject.registerObject("FLVPlayer1", "9.0.0", "flash/expressInstall.swf");
</script>
<!-- Ends JavaScripts -->

<link rel="SHORTCUT ICON" href="favicon.ico">

<?php require("js.php"); ?>
</head>
<?php 
if ($bs ==1)
Echo "<body onload='lo()';>";
else
Echo "<body>";

?>
<!-- ******HEADER****** -->
<div class="toph">
	<!-- <img class="topImage" src="images/header.jpg"> -->
	    <div class="topImage">
            <h1 class="logo">
                <a class="scrollto" href="index.php">
                    <span class="logo-title">Mani</span>Mano
                </a> 
            </h1><!--//logo-->
        </div>
	</div>
    <header id="header" class="header">  
        <div class="container-fluid">            
            <?php echo $messageWelcome; ?>     
            <nav id="main-nav" class="main-nav navbar-right" role="navigation">
                <div class="navbar-header">
                    <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button><!--//nav-toggle-->
                </div><!--//navbar-header-->            
                <div class="navbar-collapse collapse" id="navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo $index; ?> nav-item">
                        	<i class="glyphicon glyphicon-home"></i>
                        	<a href="<?php echo $home; ?>">Home</a>
                        </li>
                        <li class="<?php echo $search; ?> nav-item">
                            <i class="glyphicon glyphicon-search"></i>
                            <a href="<?php echo $suche; ?>">Suche</a>
                        </li>
                        <li class="<?php echo $about; ?> nav-item">
                        	<i class="glyphicon glyphicon-info-sign"></i>
                        	<a href="about.php">Über uns</a>
                        </li>
                        <li class="<?php echo $rechtliches; ?> nav-item">
                        	<i class="glyphicon glyphicon-th-list"></i>
                        	<a href="Rechtliches.php">Rechtliches</a>
                        </li> 
                        <li class="<?php echo $faq; ?> nav-item">
                        	<i class="glyphicon glyphicon-question-sign"></i>
                        	<a href="faq.php">Häufige Fragen</a>
                        </li>
                        <li class="<?php echo $help; ?> nav-item">
                        	<i class="glyphicon glyphicon-flag"></i>
                        	<a href="help.php">Hilfe</a>
                        </li>
                        <?php 
                        	if ($_SESSION['auth'] == "yes") { ?>
                        		<li class="<?php echo $settings; ?> nav-item last">
		                        	<i class="glyphicon glyphicon-cog"></i>
		                        	<a href="settings1.php">Meine Daten</a>
		                        </li>
                        		<li class="nav-item last">
		                        	<i class="glyphicon glyphicon-off"></i>
		                        	<a href="index.php">Logout</a>
		                        </li>
							<?php } else { ?>
								<li class="<?php echo $login; ?> nav-item last">
		                        	<i class="glyphicon glyphicon-user"></i>
		                        	<a href="login.php?al=2">Login</a>
		                        </li>
                                <li class="<?php echo $location; ?> nav-item">
                                    <i class="glyphicon glyphicon-map-marker"></i>
                                    <a href="location.php">Anmeldung</a>
                                </li>
							<?php } ?>
                    </ul><!--//nav-->
                </div><!--//navabr-collapse-->
            </nav><!--//main-nav-->
        </div>
    </header><!--//header-->
    <div class="container">