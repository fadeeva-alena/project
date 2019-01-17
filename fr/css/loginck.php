<?php
//$host="localhost"; // Host name 
//$username="root"; // Mysql username 
//$password="15072002"; // Mysql password 
//$db_name="manimano"; // Database name 
//$tbl_name="t_people"; // Table name 
include "include/z_db.php";
// Connect to server and select databse.
//mysql_connect("$host", "$username", "$password")or die("cannot connect"); 
//mysql_select_db("$db_name")or die("cannot select DB");
switch (@$_POST['Submit'])
{
case "Anmelden":
// username and password sent from form 
$myusername=$_POST['userid']; 
$mypassword=$_POST['password']; 

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
$_SESSION['auth'] = "yes";
header("location:welcome.php");

}
else {
//echo "Wrong Username or Password";

echo "<script language = 'javascript'>";
echo "alert('Das Passwort oder der Benutzername sind nicht korrekt, bitte überprüfe Deine Eingaben.')";
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

if($count==1){
$row=mysql_fetch_array($result);
require("include/SMS.inc");
      $sms = new SMS("YU5XZU75PWV9", "41731");
      $sms->setOriginator("ManiMano");
      $sms->addRecipient("$row[tel_m]","555555");
      $sms->setContent("here your password $row[password]");
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

case "Abschicken":
$myusername=$_POST['cell1'];
$myusername = stripslashes($myusername);

$myusername = mysql_real_escape_string($myusername);

$sql="SELECT * FROM t_people WHERE tel_m='$myusername'";
$result=mysql_query($sql);

// Mysql_num_row is counting table row
$count=mysql_num_rows($result);
// If result matched $myusername and $mypassword, table row must be 1 row

if($count==1){
$row=mysql_fetch_array($result);
require("include/SMS.inc");
      $sms = new SMS("YU5XZU75PWV9", "41731");
      $sms->setOriginator("ManiMano");
      $sms->addRecipient("$row[tel_m]","555555");
      $sms->setContent("youe user name is $row[username] here and  your password $row[password]");
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
}
?>

