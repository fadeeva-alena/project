<? ob_start(); ?>


<?php
include "include/z_db.php";



switch (@$_POST['Submit'])
{
case "S'identifier":
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
$_SESSION['zip'] = $row[zip];

$active = $row[Active];
$_SESSION['auth'] = "yes";
$_SESSION['user']=$myusername;
$z1=$row[zip];

//start change
$da1 =strtotime(date("m.d.y")) ;
$sql="SELECT * FROM _taccess  WHERE Zip='$z1' ";

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
$todayis = date("l, F j, Y, g:i a") ;
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
echo '<script language="javascript">confirm("Nous ne sommes pas autorisé à intervenir sur votre lieu de résidence. Vous ne pouvez faire appel à Manimano, que si notre intervention est autorisée par votre ville.")</script>';
echo'<script language="javascript">window.location = "http://www.manimano.ch/index.php"</script>';
//header("location:index.php");

}
}
else
{
echo '<script language="javascript">confirm("Merci pour votre intérêt. Pour l\instant votre lieu de résidence n\'est pas couvert par Manimano. Vous ne pouvez faire appel à Manimano, que si notre intervention est autorisée par votre ville")</script>';


echo'<script language="javascript">window.location = "http://www.manimano.ch/index.php"</script>';


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
case "Envoyer":
$myusername=$_POST['user1'];
$myusername = stripslashes($myusername);

$myusername = mysql_real_escape_string($myusername);

$sql="SELECT * FROM t_people WHERE username='$myusername'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
$row=mysql_fetch_array($result);
// start change
//$first = str_replace (" ", "", $row[tel_m]);
list($first, $middle, $last,$last1) = split(' ', $row[tel_m]);
list($fir,$sec)=split('0', $first);
$num="+41";
//$num="+1";
$num.=$sec;
$num.=$middle;
$num.=$last;
$num.=$last1;

// end change
require("include/SMS.inc");
      $sms = new SMS("YU5XZU75PWV9", "41731");
      $sms->setOriginator("ManiMano");
     // $sms->addRecipient("$row[tel_m]","555555");
     $sms->addRecipient("$num","555555");
      $sms->setContent("Ihr ManiMano-Passwort lautet: $row[password]. Viel Spass mit ManiMano wuenscht Ihr ManiMano-Team.");
      $result = $sms->sendSMS();
      if ($result != 1) {
        $error = $sms->getErrorDescription();
      }
//$sms->setBufferedNotificationURL("http://localhost/FakeApplication/sms.php?buf=");
//	  $sms->setDeliveryNotificationURL("http://localhost/FakeApplication/sms.php?ok=");
//	  $sms->setNonDeliveryNotificationURL("http://localhost/FakeApplication/sms.php?no=");

header("location:login.php?al= 2");
}
else {
//echo "Wrong Username or Password";

echo "<script language = 'javascript'>";
echo "alert('user name doesnot exists')";
echo "</script>" ;
header("location:login.php?al= 3");
}
break;

case "Envoyer":
$myusername=$_POST['cell1'];
//start change
if(($myusername[0] <> "0") or   ($myusername[3] <> " ") or ($myusername[7] <> " ")or ($myusername[10] <> " "))
{
echo "<script language = 'javascript'>";
echo "alert('Ihre Handynummer ohne Landesvorwahl an, z.B. (079 423 26 60)')";
echo "</script>" ;
header("location:login.php?al= 10");
break;
}
 


// end change
$myusername = stripslashes($myusername);

$myusername = mysql_real_escape_string($myusername);

$sql="SELECT * FROM t_people WHERE tel_m='$myusername'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
$row=mysql_fetch_array($result);

// start change
//$first = str_replace (" ", "", $row[tel_m]);
list($first, $middle, $last,$last1) = split(' ', $row[tel_m]);
list($fir,$sec)=split('0', $first);
$num="+41";
$num.=$sec;
$num.=$middle;
$num.=$last;
$num.=$last1;

// end change

require("include/SMS.inc");
      $sms = new SMS("YU5XZU75PWV9", "41731");
      $sms->setOriginator("ManiMano");
      //$sms->addRecipient("$row[tel_m]","555555");
   $sms->addRecipient("$num","555555");
      $sms->setContent("Ihr ManiMano-Benutzername ist:$row[username] ; Ihr ManiMano-Passwort lautet: $row[password] . Viel Spass mit ManiMano wuenscht Ihr ManiMano-Team.");
      $result = $sms->sendSMS();
      if ($result != 1) {
        $error = $sms->getErrorDescription();
      }
//$sms->setBufferedNotificationURL("http://localhost/FakeApplication/sms.php?buf=");
//	  $sms->setDeliveryNotificationURL("http://localhost/FakeApplication/sms.php?ok=");
//	  $sms->setNonDeliveryNotificationURL("http://localhost/FakeApplication/sms.php?no=");

header("location:login.php?al= 2");
}
else {
//echo "Wrong Username or Password";

echo "<script language = 'javascript'>";
echo "alert('cell not registred')";
echo "</script>" ;
header("location:login.php?al= 4");
}
break;
}?>
<? ob_flush(); ?>
