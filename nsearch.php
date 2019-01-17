<? ob_start(); ?>
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

?>
<?php require("header.php");?>
<div id="contentIndex" class="row">
	<h1 id="title">Suchen </h1>
	<div class="col-md-7 col-sm-12 nsearch">
    <ol>
		<li>
			<div class="textColor-1">
			<?php
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
					<label>
						<input type="radio" name="RadioGroup1" value="1" id="RadioGroup1_0" /<?PHP print $type0_status; ?>>
	            		Ich suche Unterstützung/bezahle dafür
	            	</label><br />
	            	<label>
	            		<input type="radio" name="RadioGroup1" value="2" id="RadioGroup1_1" /<?PHP print $type1_status; ?>>
	            		Ich biete Unterstützung/möchte etwas verdienen
	            	</label>
				</form>
			</div>
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
			echo "<div class='textColor-1'>";
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
			<div class="textColor-1">
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
<div class="textColor-1">
<p>

Um die genauen Suchergebnisse zu sehen, müssen Sie ein Profil <br>erstellen oder sich anmelden. Sie können aber hier schon mal ein <br>Gefühl entwickeln, wie viele Teilnehmer schon in Ihrer Nähe sind, <br>bitte wählen Sie Ihre Wohngemeinde/-stadt aus:


</p>



<?php
	echo "<form id='formsearch2' name='form4' method='post' action=''>";
 echo "<p><select style='background-color: #b6e8ff name='location' id='location' >";
$da1 =strtotime(date("m.d.y")) ;
$sql="SELECT * FROM _taccess Where demo='0'  ";
  $result=mysql_query($sql);   

$count = 0 ;
while ($row=mysql_fetch_array($result)) {
$da2 = $row[End];
$da2 = strtotime($da2);
if ($da1 < $da2)
{
echo "<option selected value='$row[Location]'>$row[Zip] $row[Location]</option>";


}

 
 


			
	
}
echo"</select></p></form>";

?>
		</div>
	</li>		
	<li>
		<div class="textColor-1">
			<p id="li4">Gesucht wird immer in ihrem<br />näheren Umfeld (ca. 5min/500m).<br />Drücken Sie SUCHEN um zu starten.</p>
			<input type="button" name="button" id="searchbtn" class='form-control btn btn-primary' value="Suchen" onclick=javascript:passv() >
		</div>
	</li>
</ol>
</div>
    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>﻿
