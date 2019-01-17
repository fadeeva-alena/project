<? ob_start(); ?>


<?php
include "include/z_db.php";



switch (@$_POST['Submit'])
{
case "Anmelden":
// username and password sent from form 
$myusername=$_POST['userid']; 
$mypassword=$_POST['password']; 
$ip = getenv("REMOTE_ADDR");
// To protect MySQL injection (more detail about MySQL injection)
$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
//$sql="SELECT * FROM $tbl_name WHERE username='$myusername' and password='$mypassword'";
$sql="SELECT * FROM t_people WHERE username='$myusername' and password='$mypassword'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
// Register $myusername, $mypassword and redirect to file "login_success.php"
//session_register("myusername");
//session_register("mypassword"); 
//$sql="SELECT firstname FROM t_people WHERE username='$myusername' and password='$mypassword'";
//$result=mysql_query($sql);
session_start();
$row=mysql_fetch_array($result);
$_SESSION['first_name'] = $row[firstname];
$_SESSION['last_name'] = $row[lastname];
$_SESSION['longitude'] = $row[longitude];
$_SESSION['latitude'] = $row[latitude];
$_SESSION['people_id'] = $row[people_id];
$_SESSION['location'] = $row[location];
$_SESSION['locationarea'] = $row[locationarea];
$_SESSION['zip'] = $row[zip];
$_SESSION['add'] = $row[street]." ".$row[house_nr].", ".$row[zip]." ". $row[location]." Switzerland";
 

$active = $row[Active];
$_SESSION['auth'] = "yes";
$_SESSION['user']=$myusername;
$z1=$row[zip];
$l1=$row[location];
//start change
$da1 =strtotime(date("m.d.y")) ;
$sql="SELECT * FROM _taccess  WHERE Zip='$z1' And Location='$l1'";

$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);


if ($count==1)
{

$da2 = $row[End];
$da2 = strtotime($da2);
if ($da1 < $da2)
{
//start change
//$todayis = date("l, F j, Y, g:i a") ;
$todayis = date("Y-m-j  H:i:s") ;

$sql="INSERT INTO t_log (person_id, User_Name,login_date, login_from ) VALUES('{$_SESSION['people_id']}', '$myusername', '$todayis', '$ip') ;" ;

 mysql_query($sql)or die(mysql_error());
$_SESSION['logid']=mysql_insert_id();
//end change
if ($active == 1)
header("location:welcome.php");
else
header("location:login.php?al= 12");
}
else 
{
echo '<script language="javascript">confirm("Ihre Wohngemeinde/-stadt hat ManiMano leider nicht weiter lizenziert. ManiMano kann nur eingesetzt werden, falls es von Ihrer Wohngemeinde lizenziert wird.")</script>';
echo'<script language="javascript">window.location = "http://www.manimano.ch/index.php"</script>';
//header("location:index.php");

}
}
else
{
header("location:login.php?al= 30");
//echo '<script language="javascript">confirm("Danke für Ihr Interesse an ManiMano. Im Moment hat Ihre Wohngemeinde/-stadt ManiMano noch nicht freigeschaltet. ManiMano kann nur eingesetzt werden, falls es von Ihrer Wohngemeinde/-stadt lizenziert wird")</script>';


//echo'<script language="javascript">window.location = "http://www.manimano.ch/index.php"</script>';


//header("location:index.php");

}





//end change



}
else {
//echo "Wrong Username or Password";

echo "<script language = 'javascript'>";
echo "alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte berprfe Deine Eingaben.')";
echo "</script>" ;
header("location:login.php?al= 1");
}
break;
case "Abschicken ":
$myusername=$_POST['user1'];
$myusername = stripslashes($myusername);

$myusername = mysql_real_escape_string($myusername);

$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count>=1){


// start change


$subject = "ManiMano: Ihr Passwort"; 

$headers = "From: " . "Technik@ManiMano.ch". "\r\n";

$headers .= "MIME-Version: 1.0\r\n";
$headers .= "Content-type: text/html; charset=UTF-8\r\n";

$message = '<html>';
$message .='<meta content=';
$message .='text/html; charset=windows-1251';
$message .=' http-equiv=Content-Type>';
$message .='<style type=';
$message .='text/css';
$message .='>';
$message .='






html,body{

font-size: 12px;

font-family: Arial;

}



a:active,

a:visited,

a:link {

	color: rgb(0, 0, 255);

	text-decoration:underline;

	font-weight:bold;

	}



a:hover {

	color: #4b719e;

	text-decoration: underline;

	}

</style>

<body>';








while ($row=mysql_fetch_array($result)) {
$message .='<strong>Hallo ';

$message .=$row[firstname];

$message .=' ';

$message .=$row[lastname];

$message .='</strong><br><br>';
$message .='Ihr ManiMano-Benutzername lautet: ';
$message .=$row[username];
$message .=' <br>';
$message .='Ihr ManiMano-Passwort lautet: ';
$message .=$row[password];
$message .=' <br>';

$t="Technik@ManiMano.ch, ".$row[email];
}


$message .='<p><span lang=';
$message .='DE';
$message .='>Viel Spass mit </span><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span> wuenscht Ihnen </span><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><strong>.<br>

</strong></p>

<p><strong><span lang=';
$message .='DE';
$message .='>David Schl&auml;pfer  <br> und das </span></strong><span style=';
$message .='color:red;';
$message .='><strong>Mani</strong></span><span style=';
$message .='color:blue;';
$message .='><strong>Mano</strong></span><strong>-Team</strong></p>

<p><strong><br></strong></p>

<div align=';
$message .='left';
$message .='>';

$message .='<map name=';
$message .='map1';
$message .='>

<area title=';
$message .='D-S-C';
$message .=' shape=';
$message .='RECT';
$message .=' coords=';
$message .='500,90,593,99';
$message .=' href=';
$message .='http://www.D-S-C.ch';
$message .=' alt=';
$message .='D-S-C';
$message .='>

<area shape=';
$message .='rect';
$message .=' coords=';
$message .='10,54,134,73';
$message .=' href=';
$message .='www.manimano.ch';
$message .='> 

</map>';

$message .='<img usemap=';
$message .='#map1';
$message .=' src=';
$message .='http://www.manimano.ch/images/email_footer.gif';
$message .=' alt=';
$message .='map of GH site';
$message .=' border=';
$message .='0';
$message .='></div>

</body>

</html>';
//$t="Technik@ManiMano.ch, ".$row[email];
mail($t, $subject, $message, $headers);
//mail($t, $subject, $message, $from);
header("location:login.php?al= 20");
}
else {
//echo "Wrong Username or Password";

echo "<script language = 'javascript'>";
echo "alert('user name doesnot exists')";
echo "</script>" ;
header("location:login.php?al= 3");
}
break;

case "Abschicken":
$myusername=$_POST['cell1'];
//start change

 


// end change
$myusername = stripslashes($myusername);

$myusername = mysql_real_escape_string($myusername);

$sql="SELECT * FROM t_people WHERE email='$myusername'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count>=1){
$subject = "Ihre ManiMano-Anmeldedaten"; 

$message="";

$from = "From: Technik@ManiMano.ch\r\n";


while ($row=mysql_fetch_array($result)) {
$message = " $message \n
Hallo \n
Sie haben Ihre Anmeldedaten bei ManiMano angefordert:

Ihr ManiMano-Benutzername lautet: $row[username] \n 
Ihr ManiMano-Passwort lautet: $row[password]  \n
";
$t=$row[email];
}
$message = " $message \n
Viel Spass mit ManiMano wuenscht Ihr ManiMano-Team. \n";
mail($t, $subject, $message, $from);
header("location:login.php?al= 2");
}
else {
//echo "Passwort oder Benutzername sind nicht korrekt.";

echo "<script language = 'javascript'>";
echo "alert('user name doesnot exists')";
echo "</script>" ;
header("location:login.php?al= 4");
}
break;
}?>

<? ob_flush(); ?>
