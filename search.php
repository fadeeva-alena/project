<? ob_start(); ?>
<?php
session_start();
include "include/z_db.php";
?>
<!DOCTYPE html">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ManiMano - Suche</title>

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

<SCRIPT language=JavaScript> 
function reload(form)
{
var val=form.kinder.options[form.kinder.options.selectedIndex].value;

var type ;
var gender;
for (i=0;i<document.form1.RadioGroup1.length;i++){
if (document.form1.RadioGroup1[i].checked==true){
type =i ;
break ;//exist for loop, as target acquired.
}
}
for (i=0;i<document.form2.radio.length;i++){
if (document.form2.radio[i].checked==true){
gender =i ;
break ;//exist for loop, as target acquired.
}
}

self.location='search.php?kinder=' + val+'&type=' +type+'&gender=' +gender ;
}

function passv( )

{


var type ;
var gender;
for (i=0;i<document.form1.RadioGroup1.length;i++){
if (document.form1.RadioGroup1[i].checked==true){
type =i ;
break ;//exist for loop, as target acquired.
}
}
for (i=0;i<document.form2.radio.length;i++){
if (document.form2.radio[i].checked==true){
gender =i ;
break ;//exist for loop, as target acquired.
}
}
cat = document.form3.kinder.value ;
subcat = document.form3.kinder2.value ;
ke=document.form3.keys.value ;
location.href= "search1.php?type=" + type + "&gender=" + gender +"&cat=" + cat +"&subcat=" + subcat +"&ke="+ke+"" ;

}
</script>

</head>
<?php

$home 	= "index.php";
$suche 	= "search.php?kinder=3&type=0&gender=2&ke=";
$messageWelcome ="";

if ($_SESSION['auth'] == "yes"){
	$home = "welcome.php";
	$messageWelcome = "<span class='welcome'>Willkommen, ".$_SESSION['first_name']." ".$_SESSION['last_name']."</span>";
}
?>

<body class="all">
<!-- ******HEADER****** -->
    <div class="toph">
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
                        <li class="nav-item">
                        	<i class="glyphicon glyphicon-home"></i>
                        	<a href="<?php echo $home; ?>">Home</a>
                        </li>
                        <li class="active nav-item">
                            <i class="glyphicon glyphicon-search"></i>
                            <a href="<?php echo $suche; ?>">Suche</a>
                        </li>
                        <li class="nav-item">
                        	<i class="glyphicon glyphicon-info-sign"></i>
                        	<a href="about.php">Über uns</a>
                        </li>
                        <li class="nav-item">
                        	<i class="glyphicon glyphicon-th-list"></i>
                        	<a href="Rechtliches.php">Rechtliches</a>
                        </li>
                        <li class="nav-item">
                        	<i class="glyphicon glyphicon-question-sign"></i>
                        	<a href="faq.php">Häufige Fragen</a>
                        </li>
                        <li class="nav-item">
                        	<i class="glyphicon glyphicon-flag"></i>
                        	<a href="help.php">Hilfe</a>
                        </li>
                        <?php 
                        	if ($_SESSION['auth'] == "yes") { ?>
                        		<li class="nav-item last">
		                        	<i class="glyphicon glyphicon-cog"></i>
		                        	<a href="settings1.php">Meine Daten</a>
		                        </li>
                        		<li class="nav-item last">
		                        	<i class="glyphicon glyphicon-off"></i>
		                        	<a href="index.php">Logout</a>
		                        </li>
							<?php } else { ?>
								<li class="nav-item last">
		                        	<i class="glyphicon glyphicon-user"></i>
		                        	<a href="login.php?al=2">Login</a>
		                        </li>
                                 <li class="nav-item">
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
<div class="row" id ="contentIndex">
		<h1>Suchen </h1>
        <div class="col-md-7 col-sm-12">
      	<ol class="textColor-1">
			<li>
			<div>
<?PHP
$type=$_GET['type']; 
$type0_status = 'unchecked';
$type1_status = 'unchecked';

if ($type == '0') {

$type0_status = 'checked';
}
if ($type == '1') {
$type1_status = 'checked';
}


?>


				Suchen Sie Arbeit oder Unterstützung?<br />
				<form id="formsearch1" name="form1" method="post" action="">
					<label><input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0" /<?PHP print $type0_status; ?>>
                Ich suche Unterstützung/bezahle dafür</label> <br />
                	<label><input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1" /<?PHP print $type1_status; ?>>
                Ich biete Unterstützung/möchte etwas verdienen</label>
				</form></div>
                </li>
			<li>
<?php

/*
If register_global is off in your server then after reloading of the page to get the value of cat from query string we have to take special care.
To read more on register_global visit.
  http://www.plus2net.com/php_tutorial/register-globals.php
*/
$kinder=$_GET['kinder']; //This line is added to take care if your global variable is off
if(!is_numeric($kinder)){
echo "Data Error";
exit;
}


//@$cat=$HTTP_GET_VARS['cat']; // Use this line or above line if register_global is off

///////// Getting the data from Mysql table for first list box//////////
$quer2=mysql_query('SELECT * FROM t_skill_types ORDER BY skilltype_id ') or die (mysql_error()); 
///////////// End of query for first list box////////////

/////// for second drop down list we will check if category is selected else we will display all the subcategory///// 
if(isset($kinder) and strlen($kinder) > 0){
$quer=mysql_query("SELECT * FROM t_skill_subtype where skill_type_id=$kinder order by skill_subtype_id"); 
}
else{$quer=mysql_query("SELECT * FROM t_skill_subtype  order by skill_subtype_id"); } 
////////// end of query for second subcategory drop down list box ///////////////////////////
//$quer3=mysql_query("SELECT image_path FROM t_skill_types where skill_type_id=$kinder") or die (mysql_error()); 
			echo "<div>";

				echo "<p>Hier können Sie die gewünschte Kategorie auswählen:<br />Diese Felder müssen ausgewählt werden</p>";
				echo "<form id='formsearch2' name='form3' method='post' action=''>";
                             //   echo "<p><label><select name='kinder' id='kinder' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
 echo "<p><select name='kinder' id='kinder' onchange=\"reload(this.form)\">";

$image="";
while ($row = mysql_fetch_assoc($quer2)) {
           if($row['skilltype_id']==@$kinder){echo "<option selected value='$row[skilltype_id]'>$row[skilltype]</option>"."<BR>";
$image=$row['image_path'];}
else{echo '<option value="' . $row['skilltype_id'] . '" name="' . $row['skilltype']. '">' . $row['skilltype']. '</option>'; }

			
		}

echo "</select>";
//////////////////  This will end the first drop down list ///////////

//////////        Starting of second drop downlist /////////
//echo "<select name='kinder2' id='kinder2'><option value=''>Select one</option>";


echo "<select name='kinder2' id='kinder2'>";


$co4 = 0;
while ($row = mysql_fetch_assoc($quer)) {

if ($co4 == 0)
{
if (  $row['skill_type_id'] == 1)
{
 echo '<option value="54" name="Alle">Alle</option>';
$co4 = 1;
}           
if (  $row['skill_type_id'] ==11)
{
 echo '<option value="54" name="Alle">Alle</option>';
$co4 = 1;
}       
if (  $row['skill_type_id'] == 12)

 {
 echo '<option value="54" name="Alle">Alle</option>';
$co4 = 1;
}    
}
if (  $row['skill_type_id'] == 14)
$k = 1;
               
			echo '<option value="' . $row['skill_subtype_id'] . '" name="' . $row['skill_subtype']. '">' . $row['skill_subtype']. '</option>';

if ($row['skill_subtype']=='kein Untertyp verf.')
{
echo"<SCRIPT language=JavaScript> ";
echo"document.getElementById('kinder2').style.display='none';";
echo"</script>";
}

		}

echo "</select> ";
//echo"</div>";
//while ($row = mysql_fetch_assoc($quer3)) {				
if($image == ""){
}else
{
echo "<img src=images/$image width='92' height='92' align='middle'></p>";
}
//echo "$image width='50' height='50' align='middle' /></p>"; 
//}		
echo"<br>";
$ke=$_GET['ke']; 


echo "<input style='background-color: #b6e8ff' type='text' name='keys' id='keys'  value='$ke' width='250px' >";
if (  $k == 1)

{
echo"<SCRIPT language=JavaScript> ";
echo"document.getElementById('keys').style.display='block';";
echo"</script>";
} else
{

echo"<SCRIPT language=JavaScript> ";
echo"document.getElementById('keys').style.display='none';";
echo"</script>";


}
		
echo "</form></div></li>";				
				
							
			
?>
			<li>
			<div>
<?PHP
$gender=$_GET['gender']; 
$gender0_status = 'unchecked';
$gender1_status = 'unchecked';
$gender2_status = 'unchecked';
if ($gender == '0') {

$gender0_status = 'checked';
}
if ($gender == '1') {
$gender1_status = 'checked';
}
if ($gender == '2') {
$gender2_status = 'checked';
}
if ($gender == 'undefined') {
$gender2_status = 'checked';
}
?>
				<p>In gewissen Fällen ist die Wahl des Geschlechts von Bedeutung.<br />Hier können Sie festlegen, was wir finden - diese Wahl ist optional.</p>
				<form id="formsearch1" name="form2" method="post" action=""><label>
					<input type="radio" name="radio" id="Frau" value="Frau" /<?PHP print $gender0_status; ?>>
            Frau</label>
					<img src="images/no_picture_she.gif" width="46" height="55" align="middle" />
					<label>
					<input type="radio" name="radio" id="Mann" value="Mann" /<?PHP print $gender1_status; ?>>
            Mann</label>
					<img src="images/no_picture_he.gif" width="46" height="55" align="middle" />
					<label>
					<input type="radio" name="radio" id="nicht" value="nicht" /<?PHP print $gender2_status; ?>>
            nicht wichtig / nicht spezifizert.</label>
					<img src="images/no_picture_he_and_she.gif" width="78" height="53" align="middle" />
				</form></div></li>
			<li>
			<div>
			        <div id="li4">Gesucht wird immer in ihrem			        näheren Umfeld (ca. 5min/500m). <br />
			        Drücken Sie SUCHEN um zu starten.</div><input type="button" name="button" id="searchbtn" class='form-control btn btn-primary' value="Suchen" onclick=javascript:passv() >
			</div></li>
		</ol>
        </div>
    </div>
  </div>
</body>
</html>
<? ob_flush(); ?>﻿
