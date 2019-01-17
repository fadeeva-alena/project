<? ob_start(); ?>
<?php
include "../include/session.php";
include "../include/z_db.php";
include "../include/class.upload.php";
$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {

if ($row['Mode']=='On')
{
header("location:Maintenance.php");
}


}

?>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Select Location</title>

<link href="../style.css" rel="stylesheet" type="text/css" />
 <script type="text/javascript"> 
function loadTwo(iframe1URL,x,m) 
{ 
document.getElementById(x).bgColor="lightblue";
location.href=iframe1URL;
for (k=0;k<=m;k=k+1)
{
if(!(x==k))
{
document.getElementById(k).bgColor="White";
}
}

}


</script> 



</head>

<body class="all">




<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="Sur nous" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Infos légales" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Inscription" onclick=location.href="location.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Aide" onclick=location.href="help.php" id="helpbtn">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">Bitte wählen Sie Ihre PLZ / Ort / *Status aus. </span>
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
