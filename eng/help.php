<? ob_start(); ?>
<?php
session_start();
if (isset($_POST['Submit1'])) {
$te=0;
$selected_radio = $_POST['ty'];

if ($selected_radio == 'Auftraggeber') {
$te=1;
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
			
	//set properties
$pdf->firstname_client = $_SESSION['first_name'];

	$pdf->lastname_client = $_SESSION['last_name'];
	$pdf->zip_client = $_POST['zip_client'];
	$pdf->location_client = $_POST['location_client'];
	$pdf->firstname_service = "";
	$pdf->lastname_service = "";
	$pdf->zip_service = "";
	$pdf->location_service = "";

	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");	
}
else if ($selected_radio == 'Auftragnehmer') {
$te=1;
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
				
	//set properties
	$pdf->firstname_client = "";
	$pdf->lastname_client = "";
	$pdf->zip_client = "";
	$pdf->location_client = "";
                      $pdf->firstname_service =  $_SESSION['first_name'];
	$pdf->lastname_service = $_SESSION['last_name'];
	$pdf->zip_service =$_POST['zip_client'];
	$pdf->location_service = $_POST['location_client'];
	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");	}
 if($te == 0) {
require"classPDF.php";	
	//create the pdf
	$pdf = new PDF();
	$pdf->init();
				
	//set properties
	$pdf->firstname_client = "";
	$pdf->lastname_client = "";
	$pdf->zip_client = "";
	$pdf->location_client = "";
                      $pdf->firstname_service = "";
	$pdf->lastname_service ="";
	$pdf->zip_service ="";
	$pdf->location_service = "";
	$pdf->printAll();	

	//display pdf file
	
	$file = $pdf->Output("Quittung.pdf", "I");


}
}


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
<title>ManiMano - Help</title>
<link href="style.css" rel="stylesheet" type="text/css" />


<script src="../js/swfobject.js" type="text/javascript"></script>
<script type="text/javascript">
	swfobject.registerObject("FLVPlayer", "9.0.0", "flash/expressInstall.swf");
	swfobject.registerObject("FLVPlayer1", "9.0.0", "flash/expressInstall.swf");
</script>
<style type="text/css">
<!--
.all #Layerfilm table tr td {
	color: #04617B;
}
.all #Layerfilm table {
	text-align: left;
}
-->
</style>
</head>

<body class="all">
<?php
include "../include/session.php";

include "../include/z_db.php";




if($_POST["SendMail"] == "Abschicken")
{
$ip = $_POST['ip']; 
$httpref = $_POST['httpref']; 
$httpagent = $_POST['httpagent']; 
$visitor = trim($_POST['visitor']); 
$visitormail = trim($_POST['visitormail']); 
$notes = trim($_POST['notes']);
$attn = trim($_POST['attn']);

if (eregi('http:', $notes)) {
$j="Bitte fllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!" ;
}
if(($visitor=="") || ($visitormail=="") || ($notes=="" )) {
$j="Bitte fllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!" ;
}

if(!$visitormail == "" && (!strstr($visitormail,"@") || !strstr($visitormail,"."))) 
{
$j="Bitte berprfen Sie Ihre Email-Adresse - diese scheint uns fehlerhaft zu sein." ;
}

if ($j=="")
{
$todayis = date("l, F j, Y, g:i a") ;

$attn = $attn ; 
$subject = $attn; 

$notes = stripcslashes($notes); 

$message = " $todayis [EST] \n
Attention: $attn \n
Message: $notes \n 
From: $visitor ($visitormail)\n
Additional Info : IP = $ip \n
Browser Info: $httpagent \n
Referral : $httpref \n
";


$from = "From: $visitormail\r\n";


mail("Technik@ManiMano.ch", $subject, $message, $from);

$j="Danke fr die Nachricht, diese wurde ausgeliefert.";
$visitor = ""; 
$visitormail = ""; 
$notes = "";
$attn = "";
}
}



?>

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

 
  <div class="mainContent">
	<div class="content">
		<span id="title">Help and Support:</span>
	  <table class="help_tbl">
		  <tr>
		    <td width="470">
			<p>
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
			<span class="Apple-style-span" style="font-size: 16px; line-height: 24px">
			<span title>If you require technical support, </span>do not 
			understand something, or want to give some feedback,<span title> 
			then you can contact us in the following ways:</span></span></span></p>
		      <p><font face="Times New Roman">1. </font>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
				<span class="Apple-style-span" style="font-size: 16px; line-height: 24px">
				Send us an email at: Technik@ManiMano.ch<br>
				<span title>2. or call us at:</span></span></span><br /></p>
			<div>
				<h2>0848 6264 6266 <br />(0848 Mani Mano)</h2></div>
			<p><font face="Times New Roman">3. </font>
			<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
			<span class="Apple-style-span" style="line-height: 25px">Please fill 
			in the following information:</span></span></p>
			<div>
				<form id="form1" name="form1" method="post" action="help.php" onsubmit="return verifyformachka();">

<!-- DO NOT change ANY of the php sections -->
<?php
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>

<input type="hidden" name="ip" value="<?php echo $ipi ?>" />
					<input type="hidden" name="httpref" value="<?php echo $httprefi ?>" />
					<input type="hidden" name="httpagent" value="<?php echo $httpagenti ?>" />
					<table id="tblnm">
						<tr>
							<td>Name, Firstname: </td>
							<td>
							<input type="text" name="visitor" id="namevor" style="float:right;" Value="<?php echo"$visitor";?>" /></td>
						</tr>
						<tr>
							<td>Email:</td>
							<td>
							<input type="text" name="visitormail" id="Email2" style="float:right;"  Value="<?php echo"$visitormail";?>" /></td>
						</tr>
						<tr>
							<td>Subject:</td>
							<td>
							<input type="text" name="attn" id="betreff" style="float:right;"  Value="<?php echo"$attn";?>"   /></td>
						</tr>
						<tr>
							<td colspan="2">Your message:<br />
							<textarea name="notes" id="ihre"  Value="<?php echo"$notes";?>" style="width:100%;"><?php echo"$notes";?></textarea>
							<p>
							<input type="submit" name="SendMail" id="abschickenbtn" value="Send" /></p>
							</td>
						</tr>
					</table>
				</form></div>
                    <div style="font-size:100%; padding:0px 10px 20px 30px;">
                      <font face="Times New Roman">
						<span style="font-weight: 700">Accident Insurance:</span></font><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><span class="Apple-style-span" style="font-size: 16px; line-height: 24px"><span style="color: rgb(0, 0, 0)"><br>
						</span>For the employer (you are one as soon as you have 
						paid some one for a service), the law states that 
						employers must have insurance for their employees.<span class="Apple-converted-space">&nbsp;</span>You 
						can take out insurance for around 100.- per year.</span></span><font face="Times New Roman"><br />&nbsp;</font><p>
						<span class="Apple-style-span">
						<span style="font-family: Times New Roman; letter-spacing: normal; font-weight: 700">
						<font size="3">AHV</font></span></span><span title><span class="Apple-style-span" style="font-family: arial, sans-serif; line-height: 22px"><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-weight: 700"><font size="3"> 
						payroll:</font></span></span><span class="Apple-style-span" style="font-family: arial, sans-serif; font-size: 13px; line-height: 22px"><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><br>
						</span></span></span>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
						<span class="Apple-style-span" style="font-size: 16px; line-height: 24px">
						For the employer (you are one as soon as you have paid 
						some one for a service), </span></span>
						<span class="Apple-style-span">
						<span style="font-family: Times New Roman; font-size: 13px; letter-spacing: normal">
						t</span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium"><span class="Apple-style-span" style="font-size: 13px; line-height: 22px"><span title>he 
						law states the that you must pay a contribution, if the 
						total wages for the employee exceeds 2,200 Swiss franks
						</span></span></span>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
						<span class="Apple-style-span" style="font-size: 13px; line-height: 22px">
						<span title>per year </span></span></span>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
						<span class="Apple-style-span" style="font-size: 13px; line-height: 22px">
						<span title>(185 - per month)</span></span></span><span style="background-color: #FFFF00"><br />&nbsp;</span></p>
						<p>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
						<span class="Apple-style-span" style="font-size: 16px; line-height: 24px">
						If the wage is lower, then the contributions are 
						voluntary. Except for any work in private households, 
						where there is no minimum wage limit for these 
						contributions.</span></span><font face="Times New Roman"><br />
                      &nbsp;</font></p>
						<p>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
						<span class="Apple-style-span" style="font-size: 16px; line-height: 24px">
						The procedure is simple: A single registration and once 
						a year you need to fill out a form, the municipal 
						authorities and the SVA are very helpful if you need 
						assistance.</span></span><font face="Times New Roman"><br /><br />
                      <br /></font>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
						<span class="Apple-style-span" style="line-height: 25px">
						<font size="3">The relevant forms can be downloaded at:<br>
						</font><span title><font size="3">
						<a href="http://www.svazurich.ch/pdf/ak3002.pdf">
						http://www.svazurich.ch/pdf/ak3002.pdf</a></font></span></span></span><br />
                      &nbsp;</p>
						<p>
						<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-size: medium">
						<span class="Apple-style-span" style="font-size: 16px; line-height: 24px">
						<span style="color: rgb(0, 0, 0)">Additional forms are 
						available at:<br>
						</span><span title>http://www.svazurich.ch/index/index.cfm?page=service_formulare_ahv&amp;sprache=de</span></span></span><font face="Times New Roman"><br /><br />
                      	</font><span class="Apple-style-span">
						<span style="font-family: Times New Roman; letter-spacing: normal">
						O<font size="3">r for</font></span></span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"><span class="Apple-style-span" style="line-height: 25px"><span style="color: rgb(0, 0, 0)"><font size="3"> 
						further assistance, please contact the SVA in Zurich at<br>
						</font></span><span title><font size="3">044 448 50 00</font></span></span></span></div>
	              </div>
	            </td>
		    <td width="400">
             <div id="Layerfilm">
             <p>
				<span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px">
				<span class="Apple-style-span" style="line-height: 22px">
				<span style="color: rgb(0, 0, 0)">The meeting did not work to 
				your satisfaction.<br>
				</span><span title>The person was too late or not did not show 
				up.<br>
				Although the person arrived, they had a unhygienic appearance, 
				or the person was simply not competent enough.<br>
				How do you react in these situations?<br>
				Of course, you can </span>communicate badly and <span title>use 
				all sorts of discriminating language, but it is much better if 
				you can come clean with that person and talk to them about it 
				civally.<br>
				</span>We have filmed here a few examples.<br>
				We hope you enjoy them and get some inspiration by viewing the 
				films.</span></span><br /><font face="Times New Roman"><br />
             </font><span class="Apple-style-span">
				<span style="font-family: Times New Roman; letter-spacing: normal; font-weight: 700">
				The perfect way</span></span><span class="Apple-style-span" style="font-family: Calibri; line-height: 25px"><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px; font-weight: 700">:</span><span class="Apple-style-span" style="border-collapse: separate; color: rgb(0, 0, 0); font-family: Times New Roman; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: normal; orphans: 2; text-align: auto; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; -webkit-border-horizontal-spacing: 0px; -webkit-border-vertical-spacing: 0px; -webkit-text-decorations-in-effect: none; -webkit-text-size-adjust: auto; -webkit-text-stroke-width: 0px"> 
				The ManiMano gardener</span></span><br /><br />
             <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer">
               <param name="movie" value="../FLVPlayer_Progressive.swf" />
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <!-- Dieses param-Tag fordert Benutzer von Flash Player 6.0 r65 und hher auf, die aktuelle Version von Flash Player herunterzuladen. Wenn Sie nicht wnschen, dass die Benutzer diese Aufforderung sehen, lschen Sie dieses Tag. -->
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Das nchste Objekt-Tag ist fr Nicht-IE-Browser vorgesehen. Blenden Sie es daher mit IECC in IE aus. -->
               <!--[if !IE]>-->
                 <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="240" height="176">
               <!--<![endif]-->
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/gaertner_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Im Browser wird fr Benutzer von Flash Player 6.0 und lteren Versionen der folgende alternative Inhalt angezeigt. -->
               <div>
                 <h4>Fr den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
               </div>
               <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
             </object>
             <br />&nbsp;</p>
				<p><strong><font face="Times New Roman">Difficult start but gets 
				there in the end:<br /></font></strong>
				<font face="Times New Roman">The ManiMano Doctors appointment</font><br /><br />
             <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="240" height="176" id="FLVPlayer1">
               <param name="movie" value="../FLVPlayer_Progressive.swf" />
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/arzttermin_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <!-- Dieses param-Tag fordert Benutzer von Flash Player 6.0 r65 und hher auf, die aktuelle Version von Flash Player herunterzuladen. Wenn Sie nicht wnschen, dass die Benutzer diese Aufforderung sehen, lschen Sie dieses Tag. -->
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Das nchste Objekt-Tag ist fr Nicht-IE-Browser vorgesehen. Blenden Sie es daher mit IECC in IE aus. -->
               <!--[if !IE]>-->
                 <object type="application/x-shockwave-flash" data="FLVPlayer_Progressive.swf" width="240" height="176">
               <!--<![endif]-->
               <param name="quality" value="high" />
               <param name="wmode" value="opaque" />
               <param name="scale" value="noscale" />
               <param name="salign" value="lt" />
               <param name="FlashVars" value="&amp;MM_ComponentVersion=1&amp;skinName=Clear_Skin_2&amp;streamName=images/arzttermin_flv_web_klein&amp;autoPlay=false&amp;autoRewind=false" />
               <param name="swfversion" value="8,0,0,0" />
               <param name="expressinstall" value="../Scripts/expressInstall.swf" />
               <!-- Im Browser wird fr Benutzer von Flash Player 6.0 und lteren Versionen der folgende alternative Inhalt angezeigt. -->
               <div>
                 <h4>Fr den Inhalt dieser Seite ist eine neuere Version von Adobe Flash Player erforderlich.</h4>
                 <p><a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Adobe Flash Player herunterladen" /></a></p>
               </div>
               <!--[if !IE]>-->
                 </object>
               <!--<![endif]-->
             </object>
             </p>
<strong><font face="Times New Roman">Unterstützende Dokumente zum Herunterladen:
</font></strong><br>
<?php 
if ($_SESSION['auth'] == "yes"){
echo"<form name='pdf_generator' method='POST' action='help.php'>";

echo"<Table>";
echo"<tr>";
echo"<td>";
echo"<Input type = 'Radio' Name ='ty' value= 'Auftraggeber' >Auftraggeber <br>";
echo"<Input type = 'Radio' Name ='ty' value= 'Auftragnehmer'>Auftragnehmer <br>";
echo"</td>";
echo"<td>";
echo"<Input type = 'Submit' Name = 'Submit1' VALUE = 'Quittung'>";
echo"</td>";
echo"</tr>";
echo"</table>";
?>
<input type='hidden' name='firstname_client'  value="<?php echo"{$_SESSION['first_name']}";?>">
<input type='hidden' name='lastname_client' value="<?php echo"{$_SESSION['last_name']}";?>">
<input type='hidden' name='zip_client'  value="<?php echo"{$_SESSION['zip']}";?>">
<input type='hidden' name='location_client' value="<?php echo"{$_SESSION['location']}";?>">
<?php
echo"<P>";
echo"</FORM>";





}
?>
<font size="1">

<ul>						<li><a href="../downloads/Kurzfragebogen für Kurzzeitarbeitgeber.pdf">
						Kurzfragebogen für Kurzzeitarbeitgeber/Auftraggeber</a></li>
						<li><a href="../downloads/Kurzfragebogen für Kurzzeitarbeitnehmer.pdf">
						Kurzfragebogen für Kurzzeitarbeitnehmer/Auftragnehmer</a></li>


</u>
</font>
           </div>
            </td>
	      </tr>
	  </table>

    </div>
  </div>
</div>
<script type="text/javascript">
<!--
swfobject.registerObject("FLVPlayer");
swfobject.registerObject("FLVPlayer1");
//-->
</script>
<script type="text/javascript">

var formachka = document.getElementById('form1');

function verifyformachka() {

	if (formachka["visitor"].value == "") {
                 
		formachka["visitor"].focus();
		alert("Bitte fllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!");
		return false;
	}

	
	reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
	if (!formachka["visitormail"].value.match(reg)) {

		alert("Bitte berprfen Sie Ihre Email-Adresse - diese scheint uns fehlerhaft zu sein.");
		formachka["visitormail"].focus();
		return false;
	}
	
	if (formachka["notes"].value == "") {
		formachka["notes"].focus();

		alert("Bitte fllen Sie alle Felder aus - das hilft uns bei der Bearbeitung Ihrer Nachricht, Danke!");
		return false;
	}



alert("Danke fr die Nachricht, diese wurde ausgeliefert.");
return true;
}	
	
</script>
</body>
</html>

<? ob_flush(); ?>
