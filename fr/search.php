<? ob_start(); ?>
<?php
session_start();
include "include/z_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8 ">
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

location.href= "search1.php?type=" + type + "&gender=" + gender +"&cat=" + cat +"&subcat=" + subcat +"" ;

}
</script>
<title>ManiMano - Suche</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>


<body class="all">
<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
     
    if ($_SESSION['auth'] == "yes")
{

echo"<h4>Bienvenue, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
}else
{
header("location:index.php");	
}
       ?>
<input type=button value="Sur nous" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Infos légales" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type=button value="Sortir" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="Mes données" onclick=location.href="settings1.php" id="maindatbtn">
	<input type=button value="Chercher" id="maindatbtn">
	<input type=button value="Aide" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">Chercher </span>
      	<ol>
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


				Recherchez vous un travail ou un service?<br />Ici vous pouvez choisir - Vous devez faire votre choix.
				<form id="formsearch1" name="form1" method="post" action="">
					<label><input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0" /<?PHP print $type0_status; ?>>
                Je recherche un service/Je paie pour</label> <br />
                	<label><input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1" /<?PHP print $type1_status; ?>>
                Je propose un service/J'aimerais une rétribution</label>
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
}else{$quer=mysql_query("SELECT * FROM t_skill_subtype  order by skill_subtype_id"); } 
////////// end of query for second subcategory drop down list box ///////////////////////////
//$quer3=mysql_query("SELECT image_path FROM t_skill_types where skill_type_id=$kinder") or die (mysql_error()); 
			echo "<div>";

				echo "<p>Veuillez choisir le type de service désiré:<br />Les champs sont obligatoires:</p>";
				echo "<form id='formsearch2' name='form3' method='post' action=''>";
                             //   echo "<p><label><select name='kinder' id='kinder' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
 echo "<p><label><select name='kinder' id='kinder' onchange=\"reload(this.form)\">";

$image="";
while ($row = mysql_fetch_assoc($quer2)) {
           if($row['skilltype_id']==@$kinder){echo "<option selected value='$row[skilltype_id]'>$row[sfr]</option>"."<BR>";
$image=$row['image_path'];}
else{echo '<option value="' . $row['skilltype_id'] . '" name="' . $row['sfr']. '">' . $row['sfr']. '</option>'; }

			
		}

echo "</select>";
//////////////////  This will end the first drop down list ///////////

//////////        Starting of second drop downlist /////////
//echo "<select name='kinder2' id='kinder2'><option value=''>Select one</option>";
echo "<select name='kinder2' id='kinder2'>";
while ($row = mysql_fetch_assoc($quer)) {
			echo '<option value="' . $row['skill_subtype_id'] . '" name="' . $row['stfr']. '">' . $row['stfr']. '</option>';
		}

echo "</select> </label>";
//while ($row = mysql_fetch_assoc($quer3)) {				
if($image == ""){
}else
{
echo "<img src=../images/$image width='92' height='92' align='middle'></p>";
}
//echo "$image width='50' height='50' align='middle' /></p>"; 
//}				
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
				<p>Dans certains cas le choix du sexe n'est pas anodin.<br />Ici vous décidez ce que nous rechercherons - le choix est optionnel.</p>
				<form id="formsearch1" name="form2" method="post" action=""><label>
					<input type="radio" name="radio" id="Frau" value="Frau" /<?PHP print $gender0_status; ?>>
            Femme</label>
					<img src="images/no_picture_she.gif" width="46" height="55" align="middle" />
					<label>
					<input type="radio" name="radio" id="Mann" value="Mann" /<?PHP print $gender1_status; ?>>
            Homme</label>
					<img src="images/no_picture_he.gif" width="46" height="55" align="middle" />
					<label>
					<input type="radio" name="radio" id="nicht" value="nicht" /<?PHP print $gender2_status; ?>>
            sans importance/ non spécifié.</label>
					<img src="images/no_picture_he_and_she.gif" width="78" height="53" align="middle" />
				</form></div></li>
			<li>
			<div><div id="li4">La recherche se fera dans votre<br />
			        environnement proche (5min/500m).<br />
			        Cliquer sur Chercher pour démarrer.</div><input type="button" name="button" id="searchbtn" value="Chercher" onclick=javascript:passv() >
			</div></li>
		</ol>
    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>﻿