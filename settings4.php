<? ob_start(); ?>
<?php
include "include/session.php";

include "include/z_db.php";
if($_POST["nextbtn"] == "Speichern und weiter zu lhren persönlichen Eigenschaften (5 von 6)"  )
{
$Nv=$_POST['Nv'];
$sql = "DELETE FROM t_needs  WHERE people_id ={$_SESSION['people_id']}  ";
    $result = mysql_query($sql);
$hummer=$_POST['hummer'];
if ($hummer==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '9', '26')");
}
$haushalt=$_POST['haushalt'];
if ($haushalt==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '5', '22')");
}
$office=$_POST['office'];
if ($office==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '2', '19')");
}

$shopping=$_POST['shopping'];
if ($shopping==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '6', '23')");
}

$garden=$_POST['garden'];
if ($garden==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '3', '20')");
}
$ear=$_POST['ear'];
if ($ear==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '7', '24')");
}

$cleaning=$_POST['cleaning'];
if ($cleaning==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '4', '21')");
}
$dog=$_POST['dog'];
if ($dog==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '8', '25')");
}

$ferien=$_POST['ferien'];
if ($ferien==1)
{
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '10', '27')");
}

$mom=$_POST['mom'];
if ($mom==1)
{
if(isset($_POST['Mom1'])){
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '1', '2')");
}
if(isset($_POST['Mom2'])){
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '1', '3')");
}
if(isset($_POST['Mom3'])){
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '1', '4')");
}



}

$transport=$_POST['transport'];
if ($transport==1)
{
if(isset($_POST['transport1'])){
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '12', '6')");
}
if(isset($_POST['transport2'])){
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '12', '7')");
}
if(isset($_POST['transport3'])){
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '12', '5')");
}
}
$stud=$_POST['stud'];
if ($stud==1)
{
$list=$_POST['list'];
	if ($list){
	 foreach ($list as $t){
if($t=="Rechnen")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '8')");

if($t=="Lesen")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '9')");

if($t=="Geometrie")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '10')");

if($t=="Biologie")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '11')");

if($t=="Naturkunde")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '12')");

if($t=="Mus: Trommel")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '44')");

if($t=="Mus: Geige")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '45')");

if($t=="Mus: Gitarre")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '46')");

if($t=="Mus: Flöte")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '47')");

if($t=="Mus: Klavier")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '48')");

if($t=="Mus: Schlagzeug")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '49')");

if($t=="Mus: Klarinette")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '50')");

if($t=="Mus: Bass")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '51')");


if($t=="Mus: Orgel")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '52')");

if($t=="Mus: Harfe")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '53')");

if($t=="Mus: Cello")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '54')");


if($t=="Mus: Gesang")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '55')");



if($t=="Spr: Portugisisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '13')");


if($t=="Spr: Italienisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '14')");


if($t=="Spr: Deutsch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '15')");

if($t=="Spr: Französisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '16')");

if($t=="Spr: Spanisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '17')");

if($t=="Spr: Englisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '31')");

if($t=="Spr: Russisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '32')");

if($t=="Spr: Polnisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '33')");

if($t=="Spr: Kroatisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '34')");

if($t=="Spr: Griechisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '35')");

if($t=="Spr: Arabisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '36')");

if($t=="Spr: Schwedisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '37')");

if($t=="Spr: Rumänisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '38')");

if($t=="Spr: Dänisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '39')");

if($t=="Spr: Holländisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '40')");

if($t=="Spr: Norwegisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '41')");

if($t=="Spr: Japanisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '42')");

if($t=="Spr: Chinesisch")
mysql_query("INSERT INTO t_needs ( people_id, need_type_id, need_subtype_id)
VALUES ({$_SESSION['people_id']}, '11', '43')");

}
	}



}
if ($Nv==1)
header("location:settings1.php");
if ($Nv==2)
header("location:settings2.php");
if ($Nv==3)
header("location:settings3.php");
if ($Nv==5)
header("location:settings5.php");
if ($Nv==6)
header("location:settings6.php");
}
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=9";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$hummer = 1;
}else{
$hummer = 0;
}
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=5";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$haushalt = 1;
}else{
$haushalt = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=2";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$office = 1;
}else{
$office = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=6";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$shopping = 1;
}else{
$shopping = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=3";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$garden = 1;
}else{
$garden = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=7";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$ear = 1;
}else{
$ear = 0;
}


$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=4";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$cleaning = 1;
}else{
$cleaning = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=8";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$dog = 1;
}else{
$dog = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=10";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){
$ferien = 1;
}else{
$ferien = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count>0){
$mom = 1;
}else{
$mom = 0;
}

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=12";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count>0){
$transport = 1;
}else{
$transport = 0;
}


$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count>0){
$stud = 1;
}else{
$stud = 0;
}
$Nv = 5;
?>


<?php require('header.php'); ?>

<!-- JS Page setting4.php -->
<script type="text/javascript">

function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.nextbtn.click(); 

}
function changecolor(id1,id2)
{
if (id1.indexOf("hummer")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("hummer").value = 1;
}
else
{
document.getElementById("hummer").value = 0;

}
}

if (id1.indexOf("haushalt")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("haushalt").value = 1;
}
else
{
document.getElementById("haushalt").value = 0;

}
}

if (id1.indexOf("office")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("office").value = 1;

}
else
{
document.getElementById("office").value = 0;


}
}


if (id1.indexOf("shopping")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("shopping").value = 1;

}
else
{
document.getElementById("shopping").value = 0;


}
}

if (id1.indexOf("garden")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("garden").value = 1;

}
else
{
document.getElementById("garden").value = 0;


}
}

if (id1.indexOf("ear")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("ear").value = 1;

}
else
{
document.getElementById("ear").value = 0;


}
}

if (id1.indexOf("cleaning")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("cleaning").value = 1;

}
else
{
document.getElementById("cleaning").value = 0;


}
}

if (id1.indexOf("dog")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("dog").value = 1;

}
else
{
document.getElementById("dog").value = 0;


}
}

if (id1.indexOf("ferien")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("ferien").value = 1;

}
else
{
document.getElementById("ferien").value = 0;


}
}


if (id1.indexOf("mom")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("mom").value = 1;

}
else
{
document.getElementById("mom").value = 0;


}
}

if (id1.indexOf("transport")>-1) 
{
if (id1.indexOf("red")>-1) 
{
document.getElementById("transport").value = 1;

}
else
{
document.getElementById("transport").value = 0;


}
}


document.getElementById(id1).style.display='none';
document.getElementById(id2).style.display='block';


}
function hidestudent()
{
document.getElementById("student_blue").style.display='none';
document.getElementById("td4").style.display='none';
document.getElementById("student_red").style.display='block';
document.getElementById("stud").value = 0;
}
function showstudent()
{
document.getElementById("student_red").style.display='none';
document.getElementById("student_blue").style.display='block';
document.getElementById("td4").style.display='block';
document.getElementById("stud").value = 1;
}

function lo()
{
<?php

//$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=9";
//$result=mysql_query($sql);
//$row=mysql_fetch_array($result);
//$count=mysql_num_rows($result);
//if($count==1){

//echo"document.getElementById('hummer_red').style.display='none';";
//echo"document.getElementById('hummer_blue').style.display='block';";
//}
//else 
//{
//echo"document.getElementById('hummer_red').style.display='block';";
//echo"document.getElementById('hummer_blue').style.display='none';";
//}
if ($hummer == 1)
{
echo"document.getElementById('hummer_red').style.display='none';";
echo"document.getElementById('hummer_blue').style.display='block';";
}
else
{
echo"document.getElementById('hummer_red').style.display='block';";
echo"document.getElementById('hummer_blue').style.display='none';";
}
if ($haushalt == 1)
{
echo"document.getElementById('haushalt_red').style.display='none';";
echo"document.getElementById('haushalt_blue').style.display='block';";
}
else 
{
echo"document.getElementById('haushalt_red').style.display='block';";
echo"document.getElementById('haushalt_blue').style.display='none';";
}

if ($stud == 1)
{
echo"document.getElementById('student_red').style.display='none';";
echo"document.getElementById('student_blue').style.display='block';";
echo"document.getElementById('td4').style.display='block';";
}
else
{
echo"document.getElementById('student_red').style.display='block';";
echo"document.getElementById('student_blue').style.display='none';";
echo"document.getElementById('td4').style.display='none';";
}



if ($office == 1)
{
echo"document.getElementById('office_red').style.display='none';";
echo"document.getElementById('office_blue').style.display='block';";
}
else
{
echo"document.getElementById('office_red').style.display='block';";
echo"document.getElementById('office_blue').style.display='none';";
}


if ($mom == 1)
{
echo"document.getElementById('mom_red').style.display='none';";
echo"document.getElementById('mom_blue').style.display='block';";
}
else
{
echo"document.getElementById('mom_red').style.display='block';";
echo"document.getElementById('mom_blue').style.display='none';";
}



if ($shopping == 1)
{
echo"document.getElementById('shopping_red').style.display='none';";
echo"document.getElementById('shopping_blue').style.display='block';";
}
else
{
echo"document.getElementById('shopping_red').style.display='block';";
echo"document.getElementById('shopping_blue').style.display='none';";
}

if ($garden == 1)
{
echo"document.getElementById('garden_red').style.display='none';";
echo"document.getElementById('garden_blue').style.display='block';";
}
else
{
echo"document.getElementById('garden_red').style.display='block';";
echo"document.getElementById('garden_blue').style.display='none';";
}


if ($transport == 1)
{
echo"document.getElementById('transport_red').style.display='none';";
echo"document.getElementById('transport_blue').style.display='block';";
}
else
{
echo"document.getElementById('transport_red').style.display='block';";
echo"document.getElementById('transport_blue').style.display='none';";
}

if ($ear == 1)
{
echo"document.getElementById('ear_red').style.display='none';";
echo"document.getElementById('ear_blue').style.display='block';";
}
else
{
echo"document.getElementById('ear_red').style.display='block';";
echo"document.getElementById('ear_blue').style.display='none';";
}

if ($cleaning == 1)
{
echo"document.getElementById('cleaning_red').style.display='none';";
echo"document.getElementById('cleaning_blue').style.display='block';";
}
else
{
echo"document.getElementById('cleaning_red').style.display='block';";
echo"document.getElementById('cleaning_blue').style.display='none';";
}


if ($dog == 1)
{
echo"document.getElementById('dog_red').style.display='none';";
echo"document.getElementById('dog_blue').style.display='block';";
}
else
{
echo"document.getElementById('dog_red').style.display='block';";
echo"document.getElementById('dog_blue').style.display='none';";
}


if ($ferien == 1)
{
echo"document.getElementById('ferien_red').style.display='none';";
echo"document.getElementById('ferien_blue').style.display='block';";
}
else
{
echo"document.getElementById('ferien_red').style.display='block';";
echo"document.getElementById('ferien_blue').style.display='none';";
}



?>
}
 //-->
</script>

<div id="contentIndex">
	<map name="green">
		<area shape="rect" title="Persönliche Daten"  coords="8,0,23,30" href="javascript:Nav(1);">
		<area shape="rect" title="Zeitliche Verfügbarkeit"  coords="27,0,45,29" href="javascript:Nav(2);">
		<area shape="rect" title="Angebotsprofil" coords="51,0,67,30" href="javascript:Nav(3);">
		<area shape="rect"  title="Über meine Person"  coords="111,0,125,30" href="javascript:Nav(5);">
		<area shape="rect" title="Rechtliche Aspekte" coords="132,1,148,29" href="javascript:Nav(6);">
	</map>
	<h1 id="title">4) Bedürfnisprofil: <img src="images/page4.png" usemap="#green"  border="0" align="right" /> </h1>
  	<form method="post"  name="form1" id="form4" action="settings4.php">
		<p id="maintext">Das Bedürfnisprofil ist das Zweitletzte, was wir von lhnen wollen. Auch dieses ist optional. Hinterlegen Sie hier, was fur Dienstleistungen Sie benötigen. Auch hier gibt es 12 Dienstleistungsarten (die gleichen wie oben). Nehmen Sie sich einen Moment Zeit - auch das müssen Sie nur einmal tun - können es aber jederzeit ändern. Auch hier gilt: Blau=aktiviert, Rot=inaktiv.</p>
	  	<p>&nbsp;</p>
		<table width="900" border="0" cellspacing="10" cellpadding="0">
		  	<tr>
		    	<td width="200">
					<div id="lbltext2">Reparatur-<br />arbeiten</div>
					<div id="hummer_red" onclick=javascript:changecolor("hummer_red","hummer_blue")><img src="images/hammer_and_screwdriver_red.gif" width="90" height="90" align="middle" /></div>
					<div id="hummer_blue" onclick=javascript:changecolor("hummer_blue","hummer_red")><img src="images/hammer_and_screwdriver_blue.gif" width="90" height="90" align="middle" /></div>
					<input type="hidden" Name="hummer"  id="hummer" value="<?php echo"$hummer ";?>">	
				</td>
		    	<td width="200">
					<div id="lbltext2">Haushaltsarbeiten<br />(waschen, bügeln,<br /> kochen)</div>
					<div id="haushalt_blue"  onclick=javascript:changecolor("haushalt_blue","haushalt_red")><img src="images/haushalt_blau.gif" width="90" height="90" align="middle" /></div>
					<div id="haushalt_red" onclick=javascript:changecolor("haushalt_red","haushalt_blue")><img src="images/haushalt_rot.gif" width="90" height="90" align="middle" /></div>
          			<input type="hidden" Name="haushalt"  id="haushalt" value="<?php echo"$haushalt ";?>">	
				</td>
		    	<td width="200">
					<div id="lbltext2">Nachhilfe- und <br />Musikstunden</div>
					<div id="student_blue"><div id="img1" onclick=javascript:hidestudent()><img src="images/student_in_round.gif" width="90" height="90" /></div>
					<div id="whiteback2"></div>
					</div>
					<div id="student_red" onclick=javascript:showstudent()><img src="images/student_in_round_red.gif" width="90" height="90" /></div>
					<input type="hidden" Name="stud"  id="stud" value="<?php echo"$stud ";?>">
				</td>
		    <td rowspan="4" valign="top"><div id="td4"><div id="list">
		      <select name="list[]" size="17" multiple="multiple">
             <?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =8";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Rechnen</option>";
              }else
                     {
                     echo"<option>Rechnen</option>";
                    } 

                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =9";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Lesen</option>";
              }else
                     {
                     echo"<option>Lesen</option>";
                    }
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =10";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Geometrie</option>";
              }else
                     {
                     echo"<option>Geometrie</option>";
                    }

                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =11";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Biologie</option>";
              }else
                     {
                     echo"<option>Biologie</option>";
                    }
		       
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =12";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Naturkunde</option>";
              }else
                     {
                     echo"<option>Naturkunde</option>";
                    } 
		     		       
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =44";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Trommel</option>";
              }else
                     {
                     echo"<option>Mus: Trommel</option>";
                    } 

                              $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =45";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Geige</option>";
              }else
                     {
                     echo"<option>Mus: Geige</option>";
                    } 
                           $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =46";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Gitarre</option>";
              }else
                     {
                     echo"<option>Mus: Gitarre</option>";
                    }
 $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =47";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Flöte</option>";
              }else
                     {
                     echo"<option>Mus: Flöte</option>";
                    } 	
		      
 $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =48";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Klavier</option>";
              }else
                     {
                     echo"<option>Mus: Klavier</option>";
                    } 	
 $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =49";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Schlagzeug</option>";
              }else
                     {
                     echo"<option>Mus: Schlagzeug</option>";
                    } 	
 $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =50";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Klarinette</option>";
              }else
                     {
                     echo"<option>Mus: Klarinette</option>";
                    } 
		       
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =51";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Bass</option>";
              }else
                     {
                     echo"<option>Mus: Bass</option>";
                    } 
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =52";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Orgel</option>";
              }else
                     {
                     echo"<option>Mus: Orgel</option>";
                    } 
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =53";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Harfe</option>";
              }else
                     {
                     echo"<option>Mus: Harfe</option>";
                    } 			    
		       
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =54";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Cello</option>";
              }else
                     {
                     echo"<option>Mus: Cello</option>";
                    } 		       
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =55";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Gesang</option>";
              }else
                     {
                     echo"<option>Mus: Gesang</option>";
                    } 
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =13";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Portugisisch</option>";
              }else
                     {
                     echo"<option>Spr: Portugisisch</option>";
                    } 
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =14";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Italienisch</option>";
              }else
                     {
                     echo"<option>Spr: Italienisch</option>";
                    } 
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =15";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Deutsch</option>";
              }else
                     {
                     echo"<option>Spr: Deutsch</option>";
                    } 		     
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =16";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Französisch</option>";
              }else
                     {
                     echo"<option>Spr: Französisch</option>";
                    } 
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =17";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Spanisch</option>";
              }else
                     {
                     echo"<option>Spr: Spanisch</option>";
                    }
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =31";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Englisch</option>";
              }else
                     {
                     echo"<option>Spr: Englisch</option>";
                    }
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =32";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Russisch</option>";
              }else
                     {
                     echo"<option>Spr: Russisch</option>";
                    }

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =33";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Polnisch</option>";
              }else
                     {
                     echo"<option>Spr: Polnisch</option>";
                    }

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =34";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Kroatisch</option>";
              }else
                     {
                     echo"<option>Spr: Kroatisch</option>";
                    }

$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =35";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Griechisch</option>";
              }else
                     {
                     echo"<option>Spr: Griechisch</option>";
                    }	
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =36";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Arabisch</option>";
              }else
                     {
                     echo"<option>Spr: Arabisch</option>";
                    }		    
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =37";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Schwedisch</option>";
              }else
                     {
                     echo"<option>Spr: Schwedisch</option>";
                    }			 
		  
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =38";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Rumänisch</option>";
              }else
                     {
                     echo"<option>Spr: Rumänisch</option>";
                    }		      
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =39";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Dänisch</option>";
              }else
                     {
                     echo"<option>Spr: Dänisch</option>";
                    }			        
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =40";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Holländisch</option>";
              }else
                     {
                     echo"<option>Spr: Holländisch</option>";
                    }		       
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =41";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Norwegisch</option>";
              }else
                     {
                     echo"<option>Spr: Norwegisch</option>";
                    }			       
		      
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =42";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Japanisch</option>";
              }else
                     {
                     echo"<option>Spr: Japanisch</option>";
                    }	
$sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=11 And need_subtype_id =43";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Chinesisch</option>";
              }else
                     {
                     echo"<option>Spr: Chinesisch</option>";
                    }	
		     ?>   
              </select>
		    </div>
			<div id="td4text">
			<b>Hinweise: </b>
			<p>Sie können mehrere Eintrage markieren, indem Sie beim Klicken die Taste CTRL gedrückt halten.</p>
			<p>Sollte ein Eintrag fehlen, geben Sie uns Bescheid.</p></div>
			</div>
			</td>
	      </tr>
		  <tr>
		    <td width="200">
			<div id="lbltext2">Büroarbeit</div>
			<div id="office_blue" onclick=javascript:changecolor("office_blue","office_red")><img src="images/office_work_blue.gif" width="90" height="90" align="middle" /></div>
			<div id="office_red" onclick=javascript:changecolor("office_red","office_blue")><img src="images/office_work_red.gif" width="90" height="90" align="middle" /></div>
<input type="hidden" Name="office"  id="office" value="<?php echo"$office ";?>">	
			</td>
		    <td width="200">
			<div id="lbltext">Kinderaufsicht</div>
			<div id="mom_blue"><div id="img1" onclick=javascript:changecolor("mom_blue","mom_red")><img src="images/mom and kids_in_round.gif" width="90" height="90"/></div>
			  <div id="whiteback"></div>
<div id="chckbx1">
<label>
			      <?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=1 And need_subtype_id =2";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
                              
echo"<input type='checkbox' name='Mom1'  id='Mom1'  Value='mom1' checked > ";
			       echo" 0-3 Jahre</label>";
}
else 
{
echo"<input type='checkbox' name='Mom1'  id='Mom1'  Value='mom1'>";
			       echo" 0-3 Jahre</label>";

			      
}
?>
<br />
			      <label>
<?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=1 And need_subtype_id =3";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
                              
echo"<input type='checkbox' name='Mom2'  id='Mom2' checked >";
			       echo"   4-6 Jahre</label>";
}
else 
{
echo"<input type='checkbox' name='Mom2'  id='Mom2' >";
			       echo"   4-6 Jahre</label>";

			      
}
?>
			       
			      <br />
			      <label>
<?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=1 And need_subtype_id =4";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
                              
echo"<input type='checkbox' name='Mom3' id='Mom3' checked > ";
			       echo"   7-9 Jahre</label>";
}
else 
{
echo"<input type='checkbox' name='Mom3'  id='Mom3' >";
			       echo" 7-9 Jahre</label>";

			      
}
?>
              </div>
			</div>
            
			<div id="mom_red" onclick=javascript:changecolor("mom_red","mom_blue")><img src="images/mom and kids_in_round_red.gif" width="90" height="90" /></div> <input type="hidden" Name="mom"  id="mom" value="<?php echo"$mom ";?>">
			</td>
		    <td width="200">
			<div id="lbltext2">Unterstützung <br /> von Senioren</div>
			<div id="shopping_blue" onclick=javascript:changecolor("shopping_blue","shopping_red")><img src="images/shopping_bag_blue.gif" width="90" height="90" /></div>
			<div id="shopping_red" onclick=javascript:changecolor("shopping_red","shopping_blue")><img src="images/shopping_bag_red.gif" width="90" height="90" /></div>
<input type="hidden" Name="shopping"  id="shopping" value="<?php echo"$shopping ";?>">
			</td>
	      </tr>
		  <tr>
		    <td width="200">
			<div id="lbltext2">Garten - und <br /> einfache Hand-<br />werksarbeiten</div>
			<div id="garden_blue" onclick=javascript:changecolor("garden_blue","garden_red")><img src="images/garden_tools_blue.gif" width="90" height="90" align="middle" /></div>
			<div id="garden_red" onclick=javascript:changecolor("garden_red","garden_blue")><img src="images/garden_tools_red.gif" width="90" height="90" align="middle" /></div>
<input type="hidden" Name="garden"  id="garden" value="<?php echo"$garden ";?>">	
			</td>
		    <td width="200">
			<div id="lbltext">Transporte</div>
			<div id="transport_blue"><div id="img1" onclick=javascript:changecolor("transport_blue","transport_red")><img src="images/transportation_blau.gif" width="90" height="90" /></div>
			<div id="whiteback"></div><div id="chckbx2">
<label>
<?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=12 And need_subtype_id =6";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
			       echo" <input type='checkbox' Name='transport1' checked />";
			        echo "Menschen</label>";
}
         else {
 echo" <input type='checkbox' Name='transport1'  />";
			        echo "Menschen</label>";
}
?>

			      <br />
			      <label>
<?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=12 And need_subtype_id =7";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
			       echo" <input type='checkbox' Name='transport2' checked />";
			        echo "Tiere</label>";}
         else {
 echo" <input type='checkbox' Name='transport2'  />";
			        echo "Tiere</label>";
}
?>
			       
			      <br />
			      <label> 
<?php
                               $sql="SELECT * FROM t_needs WHERE people_id ={$_SESSION['people_id']} And need_type_id=12 And need_subtype_id =5";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
			       echo" <input type='checkbox' Name='transport3'  checked />";
			        echo " Material</label>";}

         else {
 echo" <input type='checkbox'  Name='transport3' />";
			        echo " Material</label>";
}
?>
			     
              </div></div>
			<div id="transport_red" onclick=javascript:changecolor("transport_red","transport_blue")><img src="images/transportation_rot.gif" width="90" height="90" /></div>
<input type="hidden" Name="transport"  id="transport" value="<?php echo"$transport ";?>">	
			</td>
		    <td width="200">
			<div id="lbltext2">Begleiten, <br />Zuhören, <br />Da-sein</div>
			<div id="ear_blue" onclick=javascript:changecolor("ear_blue","ear_red")><img src="images/ear_blue.gif" width="90" height="90" /></div>
			<div id="ear_red" onclick=javascript:changecolor("ear_red","ear_blue")><img src="images/ear_red.gif" width="90" height="90" /></div>

<input type="hidden" Name="ear"  id="ear" value="<?php echo"$ear ";?>">	
			</td>
	      </tr>
		  <tr>
		    <td width="200">
			<div id="lbltext2">Reinigung</div>
			<div id="cleaning_blue" onclick=javascript:changecolor("cleaning_blue","cleaning_red")><img src="images/cleaning_blau.gif" width="90" height="90" align="middle" /></div>
			<div id="cleaning_red" onclick=javascript:changecolor("cleaning_red","cleaning_blue")><img src="images/cleaning_rot.gif" width="90" height="90" align="middle" /></div>
<input type="hidden" Name="cleaning"  id="cleaning" value="<?php echo"$cleaning ";?>">	
			</td>
		    <td width="200">
			<div id="lbltext2">Tieraufsicht</div>
			<div id="dog_blue" onclick=javascript:changecolor("dog_blue","dog_red")><img src="images/dog_in_round.gif" width="90" height="90" /></div>
			<div id="dog_red" onclick=javascript:changecolor("dog_red","dog_blue")><img src="images/dog_in_round_red.gif" width="90" height="90" /></div>
<input type="hidden" Name="dog"  id="dog" value="<?php echo"$dog ";?>">	
			</td>
		    <td width="200">
			<div id="lbltext2">Ferienabwesenheits-<br>dienst</div>
			<div id="ferien_blue" onclick=javascript:changecolor("ferien_blue","ferien_red")><img src="images/ferien_blau.gif" width="90" height="90" /></div>
			<div id="ferien_red" onclick=javascript:changecolor("ferien_red","ferien_blue")><img src="images/ferien_rot.gif" width="90" height="90" /></div>
<input type="hidden" Name="ferien"  id="ferien" value="<?php echo"$ferien ";?>">				
</td>
	      </tr>
	  </table>

<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">
      <p><input type="submit" name="nextbtn" id="nextbtn1" class="form-control btn btn-primary" value="Speichern und weiter zu lhren persönlichen Eigenschaften (5 von 6)" onclick=location.href="settings5.php" /></p>
</form>
    </div>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>﻿