<?php
session_start();
include "../include/z_db.php";
$sql = "SELECT * FROM _site_mode  Where ID=1 LIMIT 0, 30 ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {

if ($row['Mode']=='On')
{
header("location:Maintenance.php");
}
}

$j="";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Legal</title>
<link href="style2.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<style>
<!--
SPAN {
font-family:'Calibri','Calibri',sans-serif;
font-size:10.3pt;
 font-style:normal;
 font-weight:normal
}
-->
</style>
</head>

<body class="all">

<div id="container">
<?php
if ($_SESSION['auth'] == "yes"){
?>
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<?php
	echo"<h4>Wellcome, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);

?>
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn1">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn3">
<input type=button value="Logout" onclick= location.href="index.php" id="logoutbtn">
	<input type=button value="My Settings" onclick=location.href="settings1.php" id="maindatbtn">
	<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Search' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Search' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn2">
<?php
echo" </div>";
}else
{
?>
 <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
<input type=button value="About us" onclick=location.href="about.php" id="aboutbtn2">
<input type=button value="Legal" onclick=location.href="Rechtliches.php" id="helpbtn4">
<input type=button value="Register" onclick=location.href="location.php" id="regbtn">
	<input type=button value="Login" onclick=location.href="login.php?al=2" id="loginbtn">
	<input type=button value="Help" onclick=location.href="help.php" id="helpbtn">
		
<?php
echo" </div>";		
}
?>	

  <!--mainContent class start here-->
  <div class="mainContent">
  	<!--six_content class start here-->
	<div class="six_content">
	<div class="six_content_in">
		<p>1) Protection for minors</p>
			<div class="paragraph"><p><img src="../images/Manimano1.gif" width="180" height="100" border="0" style="float:right"/></p>
				<p><font face="Calibri">At 
				</font> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><font face="Calibri"> minors and young people and very important.
				</font>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 22px; ">
				<span title>If you are 15 years old, and your 81-year old 
				neighbor has trouble with the long walk to go shopping, you could carry his 
				shopping<span class="Apple-converted-space">.&nbsp;</span>Maybe you 
				looking for a child who can walk your dachshund?<span class="Apple-converted-space">&nbsp;</span>For 
				this group of participants at </span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px; "><span title>, we have gathered the 
				main points of the law, please read them thoroughly:</span></span></span></p>
				<p><font face="Calibri">There is no age limit for when a child can start work in 
				Switzerland. </font><span class="Apple-style-span">
				<span style="font-family: Calibri; letter-spacing: normal; ">
				However there are rules about how many hours per week a minor 
				can work. T</span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px">he 
				working hours for young people under 13 years is up to three 
				hours per day and no more then nine hours per week.<span class="Apple-converted-space">&nbsp;</span><span title>Between 
				13-16 years these rules only apply when school term is on.</span> 
				During the school holidays this age group may work up to 40 
				hours per week, eight hours a day between 6 am and 6 pm, but 
				only do light work.<span class="Apple-converted-space">&nbsp;</span>It 
				is clear that young people may not be used for dangerous work.<span class="Apple-converted-space">&nbsp;It 
				is </span>absolutely prohibited that young people work within 
				the vicinity of guests at nightclubs, dance halls, or bars.</span></span></p>
				<p><span class="Apple-style-span">
				<span style="font-family: arial, sans-serif; font-size: 13px; letter-spacing: normal; ">C</span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">ultural, 
				art and sporting events, and for advertising as part of radio, 
				television, film and photography. For cultural event such as 
				theater, circus, music, and sports facilities are all fine 
				activities for young 
				people, unless the activity has a negative</span><span title><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "> impact on 
				the health, safety, physical or mental development or effect 
				school attendance or school performance.<br>If the young people under 15 years old, these activities may 
				only go on for 14 days before the state authorities need to be notified.<span class="Apple-converted-space">&nbsp;</span></span></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">Working 
				Sunday and or at night are both strictly prohibited.</span></span></p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font size="3">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 22px">
				For questions or problems, you should contact www.arbeitsinspektorate.ch under the 
				state labor inspectors.</span></font><span class="Apple-style-span" style="font-family: Calibri; font-size: 13px; line-height: 22px"><span class="Apple-converted-space"><font size="3" face="Calibri">&nbsp;</font></span><span title><font size="3" face="Calibri">In 
				the state of Zurich, please call the Office of Economics and 
				Labour, Work Conditions, Tel: 043 259 91 00</font></span></span></span></p></div><br />
		<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
		<span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px; ">
		<span title>2).<span class="Apple-converted-space">&nbsp;</span>Privacy 
		Rights</span></span></span><font face="Calibri"> </font>
			<div class="paragraph"><p>&nbsp;</p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px; ">
				<span title><br>
				Please read this Declaration Statement carefully about your 
				privacy rights by:<br>
				a. </span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px; "><span title> archives </span></span></span><br /><br />

				<img src="../images/Manimano2.gif" width="219" height="125" border="0" style="float:right"/></p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 22px">
				<span title>The information you enter in your profile </span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title> 
				can be viewed, used and stored by other participants.<span class="Apple-converted-space">&nbsp;</span></span></span></span><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title> 
				is keen to enforce a respectful environment in its&#39; database.<span class="Apple-converted-space">&nbsp;</span>We 
				try our best to limit access to our database to legitimate 
				users, but can not guarantee that unauthorized third parties 
				will not gain access.<span class="Apple-converted-space">&nbsp;</span></span></span></span><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title> 
				can not control how stored information is downloaded or 
				forwarded from the database.<span class="Apple-converted-space">&nbsp;</span>Therefore, 
				you should make sure that you do not input any sensitive 
				information in </span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title>.<span class="Apple-converted-space">&nbsp;</span>We 
				can use the information you give us to notify you of updates 
				from </span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title>.</span></span></span></p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px">b. access to 
				information, via a third party<br><span title>We make 
				information accessible only to the extent required by law.</span></span></span></p></div>
			<div class="paragraph2"><p>&nbsp;</p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 22px">
				<span title>c. You have full access and control over your information<br>
				If you like, you can look over your personal data in </span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title> at 
				any time.<span class="Apple-converted-space">&nbsp;</span></span></span></span><span class="Apple-style-span"><span style="font-family: Calibri; letter-spacing: normal">S</span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><span title>imply 
				sign in to your account, go to your profile, click edit profile 
				and make the changes you would like.</span></span></span></p></div>&nbsp;<p>3) Insurance and Liability</p>
			<div class="paragraph"><p>&nbsp;<img src="../images/Manimano3.gif" width="219" height="125" border="0" style="float:right"/><br />&nbsp;</p>
				<p>
				<b>a.</b><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><font face="Calibri" size="3"> 
is a network that allows its participants to seek, offer or exchange services. 
Also you can offer your own talents and skills to the network or receive help 
and support.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span></span><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3"> 
does not mediate between the individual contacts, but only provides the network 
for participants to find each other.</font></span></span></span></p>
				<p>&nbsp; </p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">No participant from </font></span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span title><font face="Calibri" size="3"> is 
obliged to perform a service or respond to an offer.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font size="3" face="Calibri">Each 
exchange is a voluntary agreement between two participants.</font></span></span><br /><br />&nbsp;</p>
				<p>
				<span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px">
				holds no responsibility or liability for the services that are
				</span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px">agreed upon and executed 
				</span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px">within the network.</span></span><br /><br />
				&nbsp;</p>
				<p>
				<span class="Apple-style-span">
				<span style="letter-spacing: normal"><i>
				<span style="font-family: Calibri"><font size="3">Participants are responsible 
for their own</font></span></i></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: Calibri; line-height: 22px"><font size="3"> 
insurance.</font></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><font face="Calibri" size="3"> 
Make sure that prior to taking on an exchange all necessary insurances are in 
place.</font><span class="Apple-converted-space"><i><font face="Calibri" size="3">&nbsp;</font></i></span></span></span><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3"> 
is not liable for any damages incurred<i>.</i></font><span class="Apple-converted-space"><font size="3" face="arial, sans-serif"><i><font face="Calibri" size="3">&nbsp;</font></i></font></span></span></span></span><span style="font-family: Times New Roman; font-size: medium; line-height: normal; border-collapse: separate; color: rgb(0, 0, 0); font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px" title><i><font size="3" face="arial, sans-serif"><span style="font-family: Calibri; line-height: normal; border-collapse: separate; color: rgb(0, 0, 0); font-variant: normal; font-weight: normal; letter-spacing: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><font size="3">Health
				</font></span></font></i></span>
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font face="Calibri" size="3">insurance is mandatory and regulated under the 
Health Insurance Act.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span></span><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span title><font face="Calibri" size="3"> 
does not accept liability for personal injuries or sickness.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span></span></span><span style="color:#FF0000; font-size:14px;	font-weight:700;">Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><font face="Calibri" size="3"> 
strongly recommends that all participants take out liability<i> </i>insurance.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">You 
may want to think about&nbsp; AHV, the compulsory basic insurance.</font></span></span>
				<br /><br />
				&nbsp;</p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">Are you interested or curious about 
any of this?</font><i><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></i></span></span><font face="Arial"><span class="Apple-style-span" style="line-height: 24px"><font face="Calibri" size="3">Would 
you like to </font></span></font>
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px">
				<font face="Calibri" size="3">exercise your responsibility and protect yourself&nbsp; 
by learning more about the insurance and how to continue?</font></span></span></p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font size="3">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px">Then</span><span class="Apple-style-span" style="font-family: Calibri; line-height: 25px"> read on now!</span></font></span></p></div><br />
			<div class="paragraph"><p><b>b.&nbsp;&nbsp;P<span style="font-weight:700">rivate third 
				party liability insurance</span></b></p></div><br />
			<div class="paragraph"><p>&nbsp;&nbsp;&nbsp;&nbsp;<br /><img src="../images/Manimano4.gif" width="219" height="125" border="0" style="float:right"/><br />&nbsp;</p>
				<p id="maintext"><span style="margin-bottom:43px">
				<span style="font-family: Times New Roman; font-size: medium; line-height: 24px; border-collapse:separate; color:rgb(0, 0, 0); font-style:normal; font-variant:normal; font-weight:normal; orphans:2; text-align:auto; text-indent:0px; text-transform:none; white-space:normal; widows:2; word-spacing:0px; -webkit-border-horizontal-spacing:0px; -webkit-border-vertical-spacing:0px; -webkit-text-decorations-in-effect:none; -webkit-text-size-adjust:auto; -webkit-text-stroke-width:0px">&nbsp;</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><font face="Calibri" size="3">Imagine:</font></span></span></p>
				</span>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<font face="Calibri" size="3">You park the car you loaned from a 
				</font></span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><font face="Calibri" size="3"> 
participant. When parking you see a post.</font></span></span><span class="Apple-converted-space"><i><font size="3" face="Arial"><span style="border-collapse: separate; color: rgb(0, 0, 0); font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><font face="Calibri" size="3"> 
You hit it</font></span></font></i></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span title><font face="Calibri" size="3">.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><font face="Calibri" size="3">What 
now?</font></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><font face="Calibri" size="3">Who 
pays?</font></span></span></span></span></p>
				<p>&nbsp;</p>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">You are watering the flowers for 
another </font></span></span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span title><font face="Calibri" size="3"> participant.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">A 
flower pot falls on hardwood floor of the rented apartment, leaving a hole in 
the floor.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font face="Calibri" size="3">What 
now?</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">Who 
pays?</font></span></span></span><br />&nbsp;</p><span>
				<P style="margin-bottom:43px; margin-right:7px; line-height:18px">
				<span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font face="Calibri" size="3">A </font></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span class="Apple-style-span"><span style="letter-spacing: normal; "><font face="Calibri" size="3"> 
participant borrows your stroller</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><font face="Arial"><span class="Apple-style-span" style="line-height: 24px; "><font face="Calibri" size="3">, 
they go around the corner - and bang into a pedestrian, breaking their arm</font></span></font><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><font face="Calibri" size="3">. 
What now?</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">Who 
pays?</font></span></span></span></P>
				<P style="margin-bottom:43px; margin-right:7px; line-height:18px">
				<span><span class="Apple-style-span">
				<span style="font-family: Calibri; letter-spacing: normal; ">
				<font size="3">If you cause </font></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font size="3">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 22px; ">harm to someone, you are liable for unlimited amount</span></font><span class="Apple-style-span" style="line-height: 22px"><font size="3" face="Calibri">s.
				</font></span>
				<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px">
				<font face="Calibri" size="3">And this is not the fault of </font></span></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px"><font face="Calibri" size="3">.</font></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span title><font face="Calibri" size="3">This 
means you must pay the damage.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span></span><span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px"><font face="Calibri" size="3">A 
personal liability insurance protects you against the financial consequences of 
any such claims. In the case of 
unfounded claims against you from others, your insurance will help you.</font></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span title><font face="Calibri" size="3">Insurance 
companies have many different options for dealing with this situation.</font></span></span></span></span><br /><br /><img src="../images/Manimano5.gif" width="219" height="125" border="0" style="float:right"/></P><span>
				<dl style="text-align: left; text-indent: 0px; direction: ltr; margin-right: 0px; margin-top: 0px; margin-bottom: 0px">
					<DT style="text-align: left; text-indent: -43px; direction: ltr; margin-left: 44px; margin-right: 0px; margin-top: 0px; margin-bottom: 13px">
					<SPAN style="font-family:'sans-serif', 'Arial'; color:#000000"
>-	</SPAN
><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
					<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; ">
					<font size="3">You are covered for damages up to a certain guaranteed amount, 
for example, five million francs</font></span></span></DT>
					<dt style="text-align: left; text-indent: -43px; direction: ltr; margin-left: 44px; margin-right: 0px; margin-top: 0px; margin-bottom: 13px">
					<span class="Apple-style-span">
					<span style="letter-spacing: normal; ">
					<font size="3" face="Calibri">- You can be</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 19px; line-height: 25px; "><span title><font size="3" face="Calibri"> 
for example</font></span></span><span class="Apple-style-span" style="font-family: Calibri; line-height: 25px"><font size="3"> 
insured as a home owner, babysitter, tenant farmer or athlete.</font></span></span></dt>
				</dl>
				<P style="margin-right:10px; margin-left:44px; text-indent:-43px; line-height:18px">
				<span style="font-family: Calibri; "><font size="3">- </font>
				</span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; ">
				<font size="3">Make sure that occasionally driving foreign vehicles and damage 
to entrusted property is included</font></span></span></P>
				<P style="margin-left:44px; text-indent:-43px; line-height:18px">
				<font size="3"><span style="font-family: Calibri; ">- </span>
				</font><span class="Apple-style-span">
				<span style="font-family: Calibri; letter-spacing:normal">
				<font size="3">Apprentice</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; "><font size="3"> 
and students can be insured on their parents policy</font></span></span></P>
				<P style="margin-bottom:43px; margin-right:10px; margin-left:44px; text-indent:-43px; line-height:18px">
				<span style="font-family: Calibri; "><font size="3">- </font>
				</span><span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font size="3" face="Calibri">Self employed work</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span title><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><font size="3" face="Calibri">, 
up to an annual revenue of 20,000 francs is also covered, jobs such as</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font face="Arial" size="3"><span class="Apple-style-span" style="font-family: Calibri; font-size: 16px; line-height: 24px; ">Babysitter, 
				beautician, cleaner, musician, sports and language teacher are 
				covered in this way.</span></font></span></span></P></span>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<font face="Calibri" size="3">A third party liability insurance is not expensive and easily obtained.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span title><font face="Calibri" size="3">Even 
big companies protect themselves with liability insurance.</font></span></span></span></span></p>
				<p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span><span title><font face="Calibri" size="3">The employer also has several other 
responsibilities for the employee.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font face="Calibri" size="3">This 
is described in the law:</font></span></span></span></p>
				</div>
		<p><br />&nbsp;</p>
			<p>
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
			<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; ">
			Protection of the employee (Article 328 Swiss Code of Obligations)</span></span></p>
			<div class="paragraph"><p><img src="../images/Manimano6.gif" width="219" height="125" border="0" style="float:right"/></p>
				<p>
				<span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<font face="Calibri" size="3">The employer has to respect and 
protect the 
personal wellbeing of the worker.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">He 
must also take the health of the worker into account.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font face="Arial" size="3"><span class="Apple-style-span" style="line-height: 22px; "><font size="3" face="Calibri">There 
is also a law safeguarding workers against sexual harassment</font></span></font><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3">.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">This 
means that the employer must ensure that workers are not sexually harassed and 
that if harassment has occurred the victims of sexual harassment are treated in 
a respectful manner. </font></span></span></span>
				</span><br />&nbsp;</p>
				<p><span><span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font size="3" face="Calibri">The employer</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><font face="Arial"><span class="Apple-style-span" style="line-height: 22px; "><font size="3" face="Calibri"> 
has agreed to protect the life, health and personal integrity of his workers, he 
will take all the necessary measures to achieve this, </font></span></font>
				</span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<font face="Arial">
				<span class="Apple-style-span" style="line-height: 22px; ">
				<font size="3" face="Calibri">within reason 
depending on the circumstances of the job and the available budget</font></span></font><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3">. 
This is expected, as far as it is reasonable depending on the individual 
employment relationship and the nature of the work.</font></span></span></span></span><br />&nbsp;</p>
				<p>
				<span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; ">
				<font size="3">The employer, to the best of his abilities must make this 
possible.</font></span></span></span></p></div>&nbsp;<p><span><span class="Apple-style-span">
				<span style="font-family: arial, sans-serif; letter-spacing: normal; font-weight:700">
				<font size="3">Old a</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 24px; font-weight:700"><font size="3">ge 
and Survivors&#39; Insurance (AHV), invalidity insurance (IV), disability insurance 
(EO), unemployment insurance (ALV)</font></span></span></span></p>
				<p>
		<br /><br /><b><span  style="color:#FFFFFF;">
		What is all this?</span></b>
			</p>
		<div class="paragraph2">
			<p>
				<span style="font-family: sans-serif, Arial; font-weight: 700; ">What is all this?</span></p>
				<span>
				<P style="margin-bottom:18px; line-height:16px">
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font size="3">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px; ">
				<font face="Calibri" size="3">The 
old-age and survivors insurance (AHV) is there to</font></span><font face="Calibri"><span class="Apple-style-span" style="line-height: 22px; ">
				</span></font>
				<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px; font-style: italic">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px; ">
				<font face="Calibri" size="3">meet the basic needs of the insure</font></span></span><span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px"><font face="Calibri" size="3">d</font></span><font face="Calibri"><span class="Apple-style-span" style="line-height: 22px">.</span></font></font><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><font size="3" face="Calibri"> 
Disability insurance (IV) is to aid the financial consequences of disability.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">The 
income compensation (EO) compensates in part, the income losses caused by 
military, civil protection or civilian service.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">Such 
insurance are financed by the employee as well as </font></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px">
				<font face="Calibri" size="3">contributions from </font></span>
				</span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<font face="Calibri" size="3">the 
employer, the federal and state governments.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span title><font face="Calibri" size="3">Unemployment 
insurance and unemployment services grants and promotes the reintegration of the 
unemployed in the labor market.</font></span></span></span></P></span>
				<p>&nbsp;</p>
			<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">The first Column is mandatory for all 
workers: Swiss, foreigners, family members and any employees employed in a 
foreign country with a direct contract with the parent company, if the head 
office in Switzerland.</font></span></span></span></span> <br /><br />&nbsp;</p>
			<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 25px; font-weight: 700; ">
				<font style="font-size: 11pt">When and where do I pay?</font></span></span></span></p>
			<p><span><span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font size="3" face="Calibri">Lets say</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3"> 
				you find </font></span></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span title><font face="Calibri" size="3">a gardener with </font>
				</span></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span title><font face="Calibri" size="3"><b>ManiMano</b>, and 
				he works a full year in your garden.</font><font face="Arial" size="3"><span class="Apple-converted-space"><font face="Calibri" size="3">
				</font></span></font><font face="Calibri" size="3">If the total 
				salary is more than 2,200 francs per year, in other words 184 
				francs per month, it is required by legislation, that you make a 
				contribution to the Retirement and Survivors fund for your 
				employee.</font></span></span></span></span></p>
			<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<font face="Calibri" size="3">If the 
total amount paid is less than the contribution limit of 2,200 francs per year, 
the notification to the Social Security Institute (SVA) is voluntarily 
when the work is in a private household.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span title><font face="Calibri" size="3">This 
includes cleaning, house work and care taking, such as caring for children or 
elderly people. The notification is simple: You can register once to the SVA and 
fill out</font></span></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3"> 
the statement form </font></span></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span title><font face="Calibri" size="3">once a year.</font></span></span></span></span><br /><br />&nbsp;</p>
			<p>The procedure is simple:<br />&nbsp;</p>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; ">
				<font size="3">These forms can be downloaded at:</font></span></span></span></p>
				<span>
				<P style="margin-bottom:43px">
				<SPAN style="font-family:'sans-serif', 'Arial'; font-weight:bold; color:#000000; "
>http:/www.svazurich.ch/pdf/ak3002.pdf </SPAN
></P>
				<P style="margin-bottom:43px">
				<SPAN style="font-family:'sans-serif', 'Arial'; font-weight:bold; color:#000000; "
>http:/www.svazurich.ch/index/index/cfm?page=service formulareahv&amp;sprache=de
				</SPAN
></P></span>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">If you need assistance, you can find
				</font></span></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">&nbsp;helpful support 
				</font></span></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">in your community with your competent 
SVA agent .</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span></span></span><span class="Apple-style-span"><span style="letter-spacing: normal; "><font face="Calibri" size="3">F</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span title><font face="Calibri" size="3">or 
further questions you can reach </font></span></span></span>
				<span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font face="Calibri" size="3">an</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span title><font face="Calibri" size="3"> 
SVA agent, by phone 044 448 50 00 or visit </font></span></span></span>
				<SPAN style="font-family:'Calibri'; color:#0000FF; text-decoration:underline; "
><a href="http://www.ahv-iv.info/andere/00150/index.html?lang=de">
				<font size="3">http://www.ahv-iv.info/andere/00150/index.html?lang=de</font></a></SPAN
><SPAN style="font-family:'Calibri'; color:#000000; "
><font size="3">. </font></SPAN
></span>
 
 </p></div>&nbsp;<p><span>
				<span class="Apple-style-span">
				<span style="letter-spacing: normal"><font size="3">
				<span style="font-family: arial, sans-serif; font-weight: 700">A</span></font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 25px; font-weight: 700; "><font size="3">ccident insurance (UVG)</font></span></span></span></p>
			<div class="paragraph"><span>
				<P style="margin-bottom:18px; margin-right:15px; line-height:16px">
				<span class="Apple-style-span">
				<span style="letter-spacing: normal">
				<font face="Calibri" size="3">So, through </font></span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: Calibri; line-height: 25px; ">
				<font size="3"><b>ManiMano</b> you have found a home help, maybe a babysitter or other 
domestic workers.</font></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3"> 
What should you do now?</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">The 
insurance companies offer insurance for domestic workers, which you can take out 
online and costs only 100 francs per year.</font></span></span></span></P>
				</span>
				<p><span><span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font face="Calibri" size="3">I</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px"><font face="Calibri" size="3">f 
you employ people in your household, you become an employer and </font></span>
				</span><span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font size="3" face="Calibri">then this</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><font face="Calibri" size="3"> 
insurance is mandatory</font><span title><font face="Calibri" size="3">. 
According to the employers legislature it is&nbsp; required that you insure your 
employees against accidents.</font></span></span></span></span></p></div>
		<p>&nbsp;</p>
		<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 25px; font-weight: 700; ">
				<font size="3">Pension Fund (BVG)</font></span></span></span></p>
		<div class="paragraph"><span>
				<P style="margin-bottom:18px; margin-right:15px; line-height:16px">
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font face="Arial">
				<span class="Apple-style-span" style="font-size: 16px; line-height: 24px; ">The employee pension fund will ensure 
the continuation of the accustomed standard of living</span></font><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span title><font size="3">. 
To be eligible for this pension you need a minimum income of 20,520 CHF per 
year, ie 1,710 francs per month.</font></span></span></span></P></span>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<font face="Calibri">
				<span class="Apple-style-span" style="font-size: 16px; line-height: 24px; ">The BVG benefits are financed primarily by wage premium</span></font><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; "><span title><font face="Calibri" size="3">s. 
Each year, the worker submits a pension statement, listing the contributions 
made so far and the expected retirement capital.</font></span></span></span></span></p>
				<p><span><span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font size="3" face="Calibri">It is recommended that s</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3">mall 
businesses make a connection to a foundation or association facility.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">Before 
selecting a facility entrepreneurs should look into the costs, benefits and 
compare the cost of administration.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">The 
differences are sometimes significant.<br></font><b>
				<font face="Calibri" size="3">Daily health benefits, disability and</font></b><span class="Apple-converted-space"><font face="Calibri" size="3"><b>&nbsp;</b></font></span><b><font face="Calibri" size="3">l</font></b><font face="Calibri" size="3"><b>oss 
of earnings insurance.</b></font></span></span></span></span></p>
				<p>&nbsp;</p></div><br />&nbsp;<div class="paragraph">
			<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span title><font face="Calibri" size="3">For </font></span>
				</span></span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; ">
				<span title><font face="Calibri" size="3">entrepreneurs</font></span></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3"> 
the completion of a daily sickness benefits insurance is recommended.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font face="Calibri" size="3">It 
covers the loss of wages during illness.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><span title><font face="Calibri" size="3">Also 
recommended is a disability insurance.</font><font face="Arial" size="3"><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></font><font size="3"><i><font size="3" face="Calibri">T</font></i></font></span><font face="Calibri" size="3">he 
disability insurance begins to take affect after the two years of care covered 
by the daily sickness insurance.</font></span></span></span><br /><br />&nbsp;</p><span>
				<P style="margin-bottom:18px; margin-right:6px; line-height:16px">
				<span class="Apple-style-span">
				<span style="letter-spacing: normal; ">
				<font size="3" face="Calibri">Employers</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; "><span class="Apple-style-span" style="line-height: 22px"><font face="Calibri" size="3"> 
are obliged to reimburse their employees in the case of sickness</font></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px; "><span title><font face="Calibri" size="3">. 
How long this time is, is not legally be clear, the minimum period is, in 
accordance with judicial practice, in the first year of service at least three 
weeks</font></span><font face="Calibri" size="3">.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span><font face="Calibri" size="3">After 
this it is decided by the so-called Zurich, Basel and Bern-scale.</font></span></span></P>
				</span>
				<p> <br />&nbsp;</p>
				<p><span>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: 'Times New Roman'; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium; ">
				<span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 16px; line-height: 24px; ">
				<span title><font face="Calibri" size="3">Employers can cover this risk with health insurance or other insurance.</font><span class="Apple-converted-space"><font face="Calibri" size="3">&nbsp;</font></span></span><font face="Calibri" size="3">Half 
of the premium may be charged to the employee.</font></span></span></span></p>
				<p><span><span style="font-family: Calibri; "><font size="3">Have fun with</font></span><span style="font-family: Calibri; font-weight: 700; "><font size="3"> 
</font></span></span> <span style="color:#FF0000; font-size:14px;	font-weight:700;">
				Mani</span><span style="color:#0004F9; font-size:14px;	font-weight:700;">Mano</span><span style="font-family: Calibri; font-weight: 700; "><font size="3">!</font></span></p>
			<p>&nbsp;</p></div>
			<div class="paragraph"><p><hr /></p></div>
			<div class="paragraph"><p><img src="../images/Manimano11.gif" width="154" height="153" border="0" style="margin:0 0 0 300px;"/></p>
			</div>
			<div class="paragraph"><p><hr /></p></div>
			<div class="paragraph2"><p></p></div>
	  
	<!--<p><input type="button" name="nextbtn" id="nextbtn" value="Weiter zum Angebotsprofil (3 von 5)" onclick=location.href="settings3.html" /></p>-->
	</div>
	</div>
	<!--six_content class end here-->
  </div>
  <!--mainContent class end here-->
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
