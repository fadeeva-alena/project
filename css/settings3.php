<?php
include "include/session.php";

include "include/z_db.php";
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Settings3</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
<!--
function changecolor(id1,id2)
{
document.getElementById(id1).style.display='none';
document.getElementById(id2).style.display='block';
}
function hidestudent()
{
document.getElementById("student_blue").style.display='none';
document.getElementById("td4").style.display='none';
document.getElementById("student_red").style.display='block';
}
function showstudent()
{
document.getElementById("student_red").style.display='none';
document.getElementById("student_blue").style.display='block';
document.getElementById("td4").style.display='block';
}
function maindaten()
{
document.getElementById("Mom_1").checked='checked';
document.getElementById("Mom_2").checked='checked'; 
document.getElementById("cbx1").checked='checked';
document.getElementById("cbx2").checked='checked'; 
document.getElementById("mus1").selected=true; 
document.getElementById("mus2").selected=true; 
document.getElementById("mus3").selected=true; 
}
function lo()
{
<?php
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=9";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('hummer_red').style.display='none';";
echo"document.getElementById('hummer_blue').style.display='block';";
}
else 
{
echo"document.getElementById('hummer_red').style.display='block';";
echo"document.getElementById('hummer_blue').style.display='none';";
}

$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=5";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('haushalt_red').style.display='none';";
echo"document.getElementById('haushalt_blue').style.display='block';";
}
else 
{
echo"document.getElementById('haushalt_red').style.display='block';";
echo"document.getElementById('haushalt_blue').style.display='none';";
}



$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

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


$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=2";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('office_red').style.display='none';";
echo"document.getElementById('office_blue').style.display='block';";
}
else 
{
echo"document.getElementById('office_red').style.display='block';";
echo"document.getElementById('office_blue').style.display='none';";
}



$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=1";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('mom_red').style.display='none';";
echo"document.getElementById('mom_blue').style.display='block';";
}
else 
{
echo"document.getElementById('mom_red').style.display='block';";
echo"document.getElementById('mom_blue').style.display='none';";
}


$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=6";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('shopping_red').style.display='none';";
echo"document.getElementById('shopping_blue').style.display='block';";
}
else 
{
echo"document.getElementById('shopping_red').style.display='block';";
echo"document.getElementById('shopping_blue').style.display='none';";
}

$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=3";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('garden_red').style.display='none';";
echo"document.getElementById('garden_blue').style.display='block';";
}
else 
{
echo"document.getElementById('garden_red').style.display='block';";
echo"document.getElementById('garden_blue').style.display='none';";
}


$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=12";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('transport_red').style.display='none';";
echo"document.getElementById('transport_blue').style.display='block';";
}
else 
{
echo"document.getElementById('transport_red').style.display='block';";
echo"document.getElementById('transport_blue').style.display='none';";
}


$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=7";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('ear_red').style.display='none';";
echo"document.getElementById('ear_blue').style.display='block';";
}
else 
{
echo"document.getElementById('ear_red').style.display='block';";
echo"document.getElementById('ear_blue').style.display='none';";
}

$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=4";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('cleaning_red').style.display='none';";
echo"document.getElementById('cleaning_blue').style.display='block';";
}
else 
{
echo"document.getElementById('cleaning_red').style.display='block';";
echo"document.getElementById('cleaning_blue').style.display='none';";
}


$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=8";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

echo"document.getElementById('dog_red').style.display='none';";
echo"document.getElementById('dog_blue').style.display='block';";
}
else 
{
echo"document.getElementById('dog_red').style.display='block';";
echo"document.getElementById('dog_blue').style.display='none';";
}


$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=10";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){

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
</head>

<body class="all" onload=javascript:lo()>

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";

}else
{
header("location:index.php");	
}
?>
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=javascript:maindaten() id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">3) Angebotsprofil: </span>
		<p id="maintext">Das Hinterlegen eines Angebotsprofils ist optional. Wenn Sie wollen, dass man sie findet, wenn jemand Unterstutzung braucht, kommen sie naturlich nicht darum herum. Es gibt 12 Diensleistungsarten. Fullen Sie jede aus, die fur sie in Frage kommt, die ihnen Spass macht.</p>
	  <p>&nbsp;</p>
		<table width="900" border="0" cellspacing="10" cellpadding="0">
		  <tr>
		    <td width="200">
			<div id="lbltext2">Reparatur-<br />arbeiten</div>
	<div id="hummer_red" onclick=javascript:changecolor("hummer_red","hummer_blue")><img src="images/hammer_and_screwdriver_red.gif" width="90" height="90" align="middle" /></div>
			<div id="hummer_blue" onclick=javascript:changecolor("hummer_blue","hummer_red")><img src="images/hammer_and_screwdriver_blue.gif" width="90" height="90" align="middle" /></div>
		
			</td>
		    <td width="200">
			<div id="lbltext3">Haushaltsarbeiten<br />(waschen, bügeln,<br /> kochen)</div>
			<div id="haushalt_blue"  onclick=javascript:changecolor("haushalt_blue","haushalt_red")><img src="images/haushalt_blau.gif" width="90" height="90" align="middle" /></div>
			<div id="haushalt_red" onclick=javascript:changecolor("haushalt_red","haushalt_blue")><img src="images/haushalt_rot.gif" width="90" height="90" align="middle" /></div>
			</td>
		    <td width="200">
			<div id="lbltext2">Nachhilfe- und <br />Musikstunden</div>
			<div id="student_blue"><div id="img1" onclick=javascript:hidestudent()><img src="images/student_in_round.gif" width="90" height="90" /></div>
			<div id="whiteback2"></div>
			</div>
			<div id="student_red" onclick=javascript:showstudent()><img src="images/student_in_round_red.gif" width="90" height="90" /></div>
			</td>
		    <td rowspan="4" valign="top"><div id="td4"><div id="list">
		      <select name="list" size="17" multiple="multiple">
             <?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =8";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Rechnen</option>";
              }else
                     {
                     echo"<option>Rechnen</option>";
                    } 

                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =9";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Lesen</option>";
              }else
                     {
                     echo"<option>Lesen</option>";
                    }
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =10";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Geometrie</option>";
              }else
                     {
                     echo"<option>Geometrie</option>";
                    }

                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =11";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Biologie</option>";
              }else
                     {
                     echo"<option>Biologie</option>";
                    }
		       
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =12";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Naturkunde</option>";
              }else
                     {
                     echo"<option>Naturkunde</option>";
                    } 
		     		       
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =44";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Trommel</option>";
              }else
                     {
                     echo"<option>Mus: Trommel</option>";
                    } 

                              $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =45";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Geige</option>";
              }else
                     {
                     echo"<option>Mus: Geige</option>";
                    } 
                           $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =46";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Gitarre</option>";
              }else
                     {
                     echo"<option>Mus: Gitarre</option>";
                    }
 $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =47";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Flöte</option>";
              }else
                     {
                     echo"<option>Mus: Flöte</option>";
                    } 	
		      
 $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =48";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Klavier</option>";
              }else
                     {
                     echo"<option>Mus: Klavier</option>";
                    } 	
 $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =49";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Schlagzeug</option>";
              }else
                     {
                     echo"<option>Mus: Schlagzeug</option>";
                    } 	
 $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =50";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Klarinette</option>";
              }else
                     {
                     echo"<option>Mus: Klarinette</option>";
                    } 
		       
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =51";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Bass</option>";
              }else
                     {
                     echo"<option>Mus: Bass</option>";
                    } 
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =52";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Orgel</option>";
              }else
                     {
                     echo"<option>Mus: Orgel</option>";
                    } 
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =53";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Harfe</option>";
              }else
                     {
                     echo"<option>Mus: Harfe</option>";
                    } 			    
		       
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =54";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Cello</option>";
              }else
                     {
                     echo"<option>Mus: Cello</option>";
                    } 		       
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =55";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Mus: Gesang</option>";
              }else
                     {
                     echo"<option>Mus: Gesang</option>";
                    } 
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =13";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Portugisisch</option>";
              }else
                     {
                     echo"<option>Spr: Portugisisch</option>";
                    } 
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =14";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Italienisch</option>";
              }else
                     {
                     echo"<option>Spr: Italienisch</option>";
                    } 
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =15";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Deutsch</option>";
              }else
                     {
                     echo"<option>Spr: Deutsch</option>";
                    } 		     
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =16";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Französisch</option>";
              }else
                     {
                     echo"<option>Spr: Französisch</option>";
                    } 
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =17";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Spanisch</option>";
              }else
                     {
                     echo"<option>Spr: Spanisch</option>";
                    }
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =31";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Englisch</option>";
              }else
                     {
                     echo"<option>Spr: Englisch</option>";
                    }
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =32";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Russisch</option>";
              }else
                     {
                     echo"<option>Spr: Russisch</option>";
                    }

$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =33";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Polnisch</option>";
              }else
                     {
                     echo"<option>Spr: Polnisch</option>";
                    }

$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =34";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Kroatisch</option>";
              }else
                     {
                     echo"<option>Spr: Kroatisch</option>";
                    }

$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =35";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Griechisch</option>";
              }else
                     {
                     echo"<option>Spr: Griechisch</option>";
                    }	
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =36";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Arabisch</option>";
              }else
                     {
                     echo"<option>Spr: Arabisch</option>";
                    }		    
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =37";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Schwedisch</option>";
              }else
                     {
                     echo"<option>Spr: Schwedisch</option>";
                    }			 
		  
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =38";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Rumänisch</option>";
              }else
                     {
                     echo"<option>Spr: Rumänisch</option>";
                    }		      
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =39";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Dänisch</option>";
              }else
                     {
                     echo"<option>Spr: Dänisch</option>";
                    }			        
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =40";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Holländisch</option>";
              }else
                     {
                     echo"<option>Spr: Holländisch</option>";
                    }		       
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =41";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Norwegisch</option>";
              }else
                     {
                     echo"<option>Spr: Norwegisch</option>";
                    }			       
		      
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =42";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
		        echo"<option selected>Spr: Japanisch</option>";
              }else
                     {
                     echo"<option>Spr: Japanisch</option>";
                    }	
$sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=11 And skill_subtype_id =43";
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
			<p>Sie konnen mehrere Eintrage markieren, indem Sie beim Klicken die Taste CTRL gedruckt halten.</p>
			<p>Sollte ein Eintrag fehlen, geben Sie uns Bescheid.</p></div>
			</div>
			</td>
	      </tr>
		  <tr>
		    <td width="200">
			<div id="lbltext2">Büroarbeit</div>
			<div id="office_blue" onclick=javascript:changecolor("office_blue","office_red")><img src="images/office_work_blue.gif" width="90" height="90" align="middle" /></div>
			<div id="office_red" onclick=javascript:changecolor("office_red","office_blue")><img src="images/office_work_red.gif" width="90" height="90" align="middle" /></div>
			</td>
		    <td width="200">
			<div id="lbltext">Kinderaufsicht</div>
			<div id="mom_blue"><div id="img1" onclick=javascript:changecolor("mom_blue","mom_red")><img src="images/mom and kids_in_round.gif" width="90" height="90"/></div>
			  <div id="whiteback"></div><div id="chckbx1">
<label>
			      <?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=1 And skill_subtype_id =2";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
                              
echo"<input type='checkbox' name='Mom' value='checkbox' id='Mom_0' checked >";
			       echo" 0-3 Jahre</label>";
}
else 
{
echo"<input type='checkbox' name='Mom' value='checkbox' id='Mom_0' >";
			       echo" 0-3 Jahre</label>";

			      
}
?>
<br />
			      <label>
<?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=1 And skill_subtype_id =3";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
                              
echo"<input type='checkbox' name='Mom' value='checkbox' id='Mom_0' checked >";
			       echo"   4-6 Jahre</label>";
}
else 
{
echo"<input type='checkbox' name='Mom' value='checkbox' id='Mom_0' >";
			       echo"   4-6 Jahre</label>";

			      
}
?>
			       
			      <br />
			      <label>
<?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=1 And skill_subtype_id =4";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
                              
echo"<input type='checkbox' name='Mom' value='checkbox' id='Mom_0' checked >";
			       echo"   7-9 Jahre</label>";
}
else 
{
echo"<input type='checkbox' name='Mom' value='checkbox' id='Mom_0' >";
			       echo" 7-9 Jahre</label>";

			      
}
?>
              </div>
			</div>
            
			<div id="mom_red" onclick=javascript:changecolor("mom_red","mom_blue")><img src="images/mom and kids_in_round_red.gif" width="90" height="90" /></div>
			</td>
		    <td width="200">
			<div id="lbltext2">Unterstützung <br /> von Senioren</div>
			<div id="shopping_blue" onclick=javascript:changecolor("shopping_blue","shopping_red")><img src="images/shopping_bag_blue.gif" width="90" height="90" /></div>
			<div id="shopping_red" onclick=javascript:changecolor("shopping_red","shopping_blue")><img src="images/shopping_bag_red.gif" width="90" height="90" /></div>
			</td>
	      </tr>
		  <tr>
		    <td width="200">
			<div id="lbltext2">Garten - und <br /> einfache Hand-<br />werksarbeiten</div>
			<div id="garden_blue" onclick=javascript:changecolor("garden_blue","garden_red")><img src="images/garden_tools_blue.gif" width="90" height="90" align="middle" /></div>
			<div id="garden_red" onclick=javascript:changecolor("garden_red","garden_blue")><img src="images/garden_tools_red.gif" width="90" height="90" align="middle" /></div>
			</td>
		    <td width="200">
			<div id="lbltext">Transporte</div>
			<div id="transport_blue"><div id="img1" onclick=javascript:changecolor("transport_blue","transport_red")><img src="images/transportation_blau.gif" width="90" height="90" /></div>
			<div id="whiteback"></div><div id="chckbx2">
<label>
<?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=12 And skill_subtype_id =6";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
			       echo" <input type='checkbox' id='cbx1' checked />";
			        echo "Menschen</label>";
}
         else {
 echo" <input type='checkbox' id='cbx1'  />";
			        echo "Menschen</label>";
}
?>

			      <br />
			      <label>
<?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=12 And skill_subtype_id =7";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
			       echo" <input type='checkbox' id='cbx2' checked />";
			        echo "Tiere</label>";}
         else {
 echo" <input type='checkbox' id='cbx2'  />";
			        echo "Tiere</label>";
}
?>
			       
			      <br />
			      <label> 
<?php
                               $sql="SELECT * FROM t_skills WHERE people_id ={$_SESSION['people_id']} And skill_type_id=12 And skill_subtype_id =5";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
$count=mysql_num_rows($result);
if($count==1){  
			       echo" <input type='checkbox'  checked />";
			        echo " Material</label>";}

         else {
 echo" <input type='checkbox'   />";
			        echo " Material</label>";
}
?>
			     
              </div></div>
			<div id="transport_red" onclick=javascript:changecolor("transport_red","transport_blue")><img src="images/transportation_rot.gif" width="90" height="90" /></div>
			</td>
		    <td width="200">
			<div id="lbltext2">Begleiten, <br />Zuhören, <br />Da-sein</div>
			<div id="ear_blue" onclick=javascript:changecolor("ear_blue","ear_red")><img src="images/ear_blue.gif" width="90" height="90" /></div>
			<div id="ear_red" onclick=javascript:changecolor("ear_red","ear_blue")><img src="images/ear_red.gif" width="90" height="90" /></div>
			</td>
	      </tr>
		  <tr>
		    <td width="200">
			<div id="lbltext2">Reinigung</div>
			<div id="cleaning_blue" onclick=javascript:changecolor("cleaning_blue","cleaning_red")><img src="images/cleaning_blau.gif" width="90" height="90" align="middle" /></div>
			<div id="cleaning_red" onclick=javascript:changecolor("cleaning_red","cleaning_blue")><img src="images/cleaning_rot.gif" width="90" height="90" align="middle" /></div>
			</td>
		    <td width="200">
			<div id="lbltext2">Tieraufsicht</div>
			<div id="dog_blue" onclick=javascript:changecolor("dog_blue","dog_red")><img src="images/dog_in_round.gif" width="90" height="90" /></div>
			<div id="dog_red" onclick=javascript:changecolor("dog_red","dog_blue")><img src="images/dog_in_round_red.gif" width="90" height="90" /></div>
			</td>
		    <td width="200">
			<div id="lbltext2">Ferienabwesen<br/>heitsdienst</div>
			<div id="ferien_blue" onclick=javascript:changecolor("ferien_blue","ferien_red")><img src="images/ferien_blau.gif" width="90" height="90" /></div>
			<div id="ferien_red" onclick=javascript:changecolor("ferien_red","ferien_blue")><img src="images/ferien_rot.gif" width="90" height="90" /></div>
			</td>
	      </tr>
	  </table>
      <p><input type="button" name="nextbtn" id="nextbtn" value="Weiter zum Bedurfnisprofil (4 von 5)" onclick=location.href="settings4.php" /></p>
    </div>
  </div>
</div>
</body>
</html>
