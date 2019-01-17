<? ob_start(); ?>
<?php
include "include/session.php";
include "include/z_db.php";
include "include/class.upload.php";
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
<div id="container">
  <div class="header">
    <h1 onclick=location.href="welcome.php"><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Häufige Fragen" onclick=location.href="faq.php" id="helpbtn5">
<input type=button value="Über uns" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Anmeldung" onclick=location.href="location.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Suche" onclick=location.href="nsearch.php?kinder=1&type=0&gender=2"  id="helpbtn8" >
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn9">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">Bitte wählen Sie Ihre PLZ / Ort aus. </span>
		<p style="margin-top: 0; margin-bottom: 3px">



<?php
$da1 =strtotime(date("m.d.y")) ;
$sql="SELECT * FROM _taccess Where demo='0'  ";
$result=mysql_query($sql);   
$count = 0 ;

while ($row=mysql_fetch_array($result)) {
$da2 = $row[End];
$da2 = strtotime($da2);
if ($da1 < $da2)
{

$lo[$count] = $row[Zip].$row[location];

$zip[$count]=urlencode($row[Zip]);
$location[$count]=urlencode($row[Location]);
$count= $count + 1 ;

}

 
 


			
	
}


?>



<div>


<?PHP

echo"<br>";
echo"<Table  bgcolor='White'  style=width: 600px;'>";
echo"<tr>";


echo"<td>";
echo"<div style='overflow:auto; height: 230px;'>"; 
echo"<table>";
for ($i = 0; $i < $count; $i++)
{
echo"<tr  id=$i  bgcolor='White'   onclick= loadTwo('register1.php?zip=$zip[$i]&location=$location[$i]',$i,$count)>";
echo"<td   valign='top'>";
echo" $zip[$i] $location[$i]";
echo"</td>";

echo"</tr>";
}






//echo "</div>";

echo "<tr>";
echo"    <td  valign='top'>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp         &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>";
//echo"    <td >Auswählen und weiter zur Eingabe der persönlichen Daten</td>";
echo "</tr>";

echo"</table>";
echo "</div>";
echo"</td>";

echo"</tr>";

echo"</table>";
echo"<table>";
echo "<tr>";

echo"    <td >Auswählen und weiter zur Eingabe der persönlichen Daten</td>";
echo "</tr>";
echo "</Table>";
echo"</div>";
 echo"<p>&nbsp &nbsp Sie können sich nur anmelden, wenn Sie in einer Gemeinde oder Stadt wohnen, die ManiMano freigeschaltet <br>&nbsp &nbsp  hat. 
Wenn Ihre Wohn- oder Arbeitsgemeinde ManiMano noch nicht freigeschaltet hat, können Sie sich noch nicht<br>&nbsp &nbsp anmelden – aber Sie können uns Bescheid geben, dass Interesse besteht.
</p>";
echo"</div>";

?>  


</div>

</body>
</html>
<? ob_flush(); ?>
