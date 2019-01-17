<? ob_start(); ?>
<?php
include "../include/session.php";

include "../include/z_db.php";

if($_POST["Speichern"] == "Save and continue to the legal conditions (6 of 6)" )
{
$Nv = $_POST['Nv'];
$s1=$_POST['test'];
$s2=$_POST['test1'];
$s3=$_POST['test2'];
$s4=$_POST['test3'];
$s5=$_POST['test4'];

$sql="UPDATE t_people SET psych_time_loose_tight  = '$s1', psych_exact_creativ  = '$s2', psych_heart_thing  = '$s3', psych_easy_security = '$s4', psych_conflict_take_leave  = '$s5'  WHERE people_id ={$_SESSION['people_id']}";

$result = mysql_query($sql); 
header("location:settings6.php");
if ($Nv==2)
header("location:settings2.php");
if ($Nv==3)
header("location:settings3.php");
if ($Nv==4)
header("location:settings4.php");
if ($Nv==1)
header("location:settings1.php");
if ($Nv==6)
header("location:settings6.php");
}
$Nv = 5;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />


<title>ManiMano - Einstellungen 5 von 6</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" media="screen, projection" href="slider.css" />
<SCRIPT SRC="../libdetect.js"></SCRIPT>
<SCRIPT SRC="../libslider.js"></SCRIPT>
 <SCRIPT SRC="../slider.js"></SCRIPT>

<script type="text/javascript">
function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.nextbtn2.click(); 

}
function update( )
{


document.getElementById("test").value=window.frames['frame1'].document.getElementById('slider1').value;
document.getElementById("test1").value=window.frames['frame2'].document.getElementById('slider1').value;
document.getElementById("test2").value=window.frames['frame3'].document.getElementById('slider1').value;
document.getElementById("test3").value=window.frames['frame4'].document.getElementById('slider1').value;
document.getElementById("test4").value=window.frames['frame5'].document.getElementById('slider1').value;
}
</script>
</head>

<body class="all"  onload="update()">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
			<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Welcome, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
}else
{
header("location:index.php");	
}
?>
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type="button" value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type="button" value="My Settings"  onclick=location.href="Settings4.php" id="maindatbtn">
<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Search' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Search' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type="button" value="Help" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">5) About me:  <img src="../images/page5.png" border="0"  usemap="#green" align="right" /> </span>
<map name="green">
<area shape="rect" alt="" coords="7,2,25,30" href="javascript:Nav(1);">
<area shape="rect" alt="" coords="30,2,45,30" href="javascript:Nav(2);">
<area shape="rect" alt="" coords="49,0,65,29" href="javascript:Nav(3);">
<area shape="rect" alt="" coords="70,0,87,30" href="javascript:Nav(4);">
<area shape="rect" alt="" coords="130,0,148,30" href="javascript:Nav(6);">

</map>

 <form method="post"  name="form1" action="settings5.php" onsubmit="update()">

		<p id="maintext">Now you're almost done: The last thing we want from you is some information about your personality. This is perhaps the most important part. Relationships of any kind (work, private) fail mostly because of bad communication. In order to get some things clear before meeting, we have created this profile – fill it out – because no one is the same, but when you are open about your idiosyncrasies and expectations, you are more likely to have a better relationship with the other participants.</p>
	  <p></p>

    <div id="slider"><div id="slidertext1">I am punctual,<br />or I'll call.</div><div id="sliderframe"><IFRAME name="frame1" src="../slider/slider1.php?SCALE=<?php echo"{$row['psych_time_loose_tight']}"; ?>"; " height="70px" width="280px" frameborder=0 onclick="update( )">></IFRAME></div><div id="slidertext2">
		I sometimes arrive a few minutes late.<br /></div></div>
    <div id="slider"><div id="slidertext1">I will complete the job properly,<br />
		like specified.</div><div id="sliderframe"><IFRAME name="frame2" src="../slider/slider1.php?SCALE=<?php echo"{$row['psych_exact_creativ']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">
		I can work on solutions on<br />my own, when it’s needed.</div></div>
    <div id="slider"><div id="slidertext1">
		I can get along with others.</div><div id="sliderframe"><IFRAME name="frame3" src="../slider/slider1.php?SCALE=<?php echo"{$row['psych_heart_thing']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">
		I have an eye for detail and I am<br />Solution oriented.</div></div>
    <div id="slider"><div id="slidertext1">I’m confortable in any<br />
		Situation.</div><div id="sliderframe"><IFRAME  name="frame4" src="../slider/slider1.php?SCALE=<?php echo"{$row['psych_easy_security']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">
		Clear, secure conditions and<br />instructions are important to me.</div></div>
    <div id="slider"><div id="slidertext1">I am comfortable with conflict and always speak my mind.</div><div id="sliderframe"><IFRAME  name="frame5"src="../slider/slider1.php?SCALE=<?php echo"{$row['psych_conflict_take_leave']}"; ?>" height="70px" width="280px" frameborder=0></IFRAME></div><div id="slidertext2">
		I avoid conflict if
Possible.
<br /></div></div>

<input type="hidden" ID="test" name="test">
<input type="hidden" ID="test1"name="test1">
<input type="hidden" ID="test2"name="test2">
<input type="hidden" ID="test3"name="test3">
<input type="hidden" ID="test4"name="test4">
	<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">	
      <input name="Speichern" type="submit" name="nextbtn1" id="nextbtn2" value="Save and continue to the legal conditions (6 of 6)" >
</form>
    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
