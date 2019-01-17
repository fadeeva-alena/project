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

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
}else
{
header("location:index.php");	
}
       ?>
<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type=button value="Logout" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=location.href="settings1.php" id="maindatbtn">
	<input type=button value="Suche" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">Suchen </span>
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


				Suchen Sie Arbeit oder Unterstützung?<br />Hier können Sie das auswählen - hier müssen Sie sich festlegen.
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
}else{$quer=mysql_query("SELECT * FROM t_skill_subtype  order by skill_subtype_id"); } 
////////// end of query for second subcategory drop down list box ///////////////////////////
//$quer3=mysql_query("SELECT image_path FROM t_skill_types where skill_type_id=$kinder") or die (mysql_error()); 
			echo "<div>";

				echo "<p>Hier können Sie die gewünschte Kategorie auswählen:<br />Diese Felder müssen ausgewählt werden</p>";
				echo "<form id='formsearch2' name='form3' method='post' action=''>";
                             //   echo "<p><label><select name='kinder' id='kinder' onchange=\"reload(this.form)\"><option value=''>Select one</option>";
 echo "<p><label><select name='kinder' id='kinder' onchange=\"reload(this.form)\">";

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
while ($row = mysql_fetch_assoc($quer)) {
			echo '<option value="' . $row['skill_subtype_id'] . '" name="' . $row['skill_subtype']. '">' . $row['skill_subtype']. '</option>';
		}

echo "</select> </label>";
//while ($row = mysql_fetch_assoc($quer3)) {				
if($image == ""){
}else
{
echo "<img src=images/$image width='92' height='92' align='middle'></p>";
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
			<div><div id="li4">Gesucht wird immer in ihrem<br />
			        näheren Umfeld (ca. 5min/500m).<br />
			        Drücken Sie SUCHEN um zu starten.</div><input type="button" name="button" id="searchbtn" value="Suchen" onclick=javascript:passv() >
			</div></li>
		</ol>
    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>﻿
