<?php
include "include/session.php";

include "include/z_db.php";
if($_POST["nextbtn"] == "Weiter zum Angebotsprofil (3 von 6)" )
{

$Nv=$_POST['Nv'];
if(isset($_POST['flagm1']))
$m=1;
else
$m=0;
if(isset($_POST['flagm2']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm3']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm4']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm5']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm6']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm7']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm8']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm9']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm10']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm11']))
$m.=1;
else
$m.=0;
if(isset($_POST['flagm12']))
$m.=1;
else
$m.=0;



if(isset($_POST['flagt1']))
$t=1;
else
$t=0;
if(isset($_POST['flagt2']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt3']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt4']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt5']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt6']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt7']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt8']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt9']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt10']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt11']))
$t.=1;
else
$t.=0;
if(isset($_POST['flagt12']))
$t.=1;
else
$t.=0;


if(isset($_POST['flagw1']))
$w=1;
else
$w=0;
if(isset($_POST['flagw2']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw3']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw4']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw5']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw6']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw7']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw8']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw9']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw10']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw11']))
$w.=1;
else
$w.=0;
if(isset($_POST['flagw12']))
$w.=1;
else
$w.=0;

if(isset($_POST['flagth1']))
$th=1;
else
$th=0;
if(isset($_POST['flagth2']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth3']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth4']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth5']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth6']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth7']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth8']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth9']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth10']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth11']))
$th.=1;
else
$th.=0;
if(isset($_POST['flagth12']))
$th.=1;
else
$th.=0;

if(isset($_POST['flagf1']))
$f=1;
else
$f=0;
if(isset($_POST['flagf2']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf3']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf4']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf5']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf6']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf7']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf8']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf9']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf10']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf11']))
$f.=1;
else
$f.=0;
if(isset($_POST['flagf12']))
$f.=1;
else
$f.=0;



if(isset($_POST['flagsa1']))
$sa=1;
else
$sa=0;
if(isset($_POST['flagsa2']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa3']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa4']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa5']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa6']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa7']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa8']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa9']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa10']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa11']))
$sa.=1;
else
$sa.=0;
if(isset($_POST['flagsa12']))
$sa.=1;
else
$sa.=0;


if(isset($_POST['flagsu1']))
$su=1;
else
$su=0;
if(isset($_POST['flagsu2']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu3']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu4']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu5']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu6']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu7']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu8']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu9']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu10']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu11']))
$su.=1;
else
$su.=0;
if(isset($_POST['flagsu12']))
$su.=1;
else
$su.=0;

if(isset($_POST['flag_m1']))
$mt=1;
else
$mt=0;
if(isset($_POST['flag_m2']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m3']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m4']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m5']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m6']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m7']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m8']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m9']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m10']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m11']))
$mt.=1;
else
$mt.=0;
if(isset($_POST['flag_m12']))
$mt.=1;
else
$mt.=0;



if(isset($_POST['flag_t1']))
$tt=1;
else
$tt=0;
if(isset($_POST['flag_t2']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t3']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t4']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t5']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t6']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t7']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t8']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t9']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t10']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t11']))
$tt.=1;
else
$tt.=0;
if(isset($_POST['flag_t12']))
$tt.=1;
else
$tt.=0;


if(isset($_POST['flag_w1']))
$wt=1;
else
$wt=0;
if(isset($_POST['flag_w2']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w3']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w4']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w5']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w6']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w7']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w8']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w9']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w10']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w11']))
$wt.=1;
else
$wt.=0;
if(isset($_POST['flag_w12']))
$wt.=1;
else
$wt.=0;

if(isset($_POST['flag_th1']))
$tht=1;
else
$tht.=0;
if(isset($_POST['flag_th2']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th3']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th4']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th5']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th6']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th7']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th8']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th9']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th10']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th11']))
$tht.=1;
else
$tht.=0;
if(isset($_POST['flag_th12']))
$tht.=1;
else
$tht.=0;

if(isset($_POST['flag_f1']))
$ft=1;
else
$ft=0;
if(isset($_POST['flag_f2']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f3']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f4']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f5']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f6']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f7']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f8']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f9']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f10']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f11']))
$ft.=1;
else
$ft.=0;
if(isset($_POST['flag_f12']))
$ft.=1;
else
$ft.=0;



if(isset($_POST['flag_sa1']))
$sat=1;
else
$sat=0;
if(isset($_POST['flag_sa2']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa3']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa4']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa5']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa6']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa7']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa8']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa9']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa10']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa11']))
$sat.=1;
else
$sat.=0;
if(isset($_POST['flag_sa12']))
$sat.=1;
else
$sat.=0;


if(isset($_POST['flag_su1']))
$sut=1;
else
$sut=0;
if(isset($_POST['flag_su2']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su3']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su4']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su5']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su6']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su7']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su8']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su9']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su10']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su11']))
$sut.=1;
else
$sut.=0;
if(isset($_POST['flag_su12']))
$sut.=1;
else
$sut.=0;
$errors = "";
if ($_POST['start'] <>"")
{
$arrDate = explode(".", $_POST['start']); // break up date by slash
$intDay = $arrDate[0];
$intMonth = $arrDate[1];
$intYear = $arrDate[2];
 
$intIsDate = checkdate($intMonth, $intDay, $intYear);    
 if(!$intIsDate)
     {

$errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) / use dd.mm.yyyy";
}
}
if ($_POST['ende'] <>"")
{
$arrDate = explode(".", $_POST['ende']); // break up date by slash
$intDay = $arrDate[0];
$intMonth = $arrDate[1];
$intYear = $arrDate[2];
 
$intIsDate = checkdate($intMonth, $intDay, $intYear);    
 if(!$intIsDate)
     {

$errors .= "Bitte geben Sie Ihr Geburtsdatum ein (z.B. 31.12.1970) / use dd.mm.yyyy";
}
}
$start = $_POST['start'];


$end =$_POST['ende'] ;
if ($errors == "")
{

$sql="UPDATE t_people SET monday  = '$m', tuesday  = '$t', wednesday  = '$w', thursday = '$th', friday  = '$f', saturday = '$sa', sunday = '$su',monday_t  ='$mt', tuesday_t  = '$tt', wednesday_t  = '$wt', thursday_t = '$tht', friday_t  = '$ft', saturday_t = '$sat', sunday_t = '$sut', temp_sched_from = '$start', temp_sched_to = '$end' WHERE people_id ={$_SESSION['people_id']}";

$result = mysql_query($sql);  
//$count=mysql_num_rows($result);
//if($count==1){
//session_start();
//$row=mysql_fetch_array($result);
//$_SESSION['first_name'] = $row[firstname];
//$_SESSION['last_name'] = $row[lastname];
//$_SESSION['longitude'] = $row[longitude];
//$_SESSION['latitude'] = $row[latitude];
//$_SESSION['people_id'] = $row[people_id];
//$_SESSION['auth'] = "yes";
//}
if ($Nv==1)
header("location:settings1.php");
if ($Nv==3)
header("location:settings3.php");
if ($Nv==4)
header("location:settings4.php");
if ($Nv==5)
header("location:settings5.php");
if ($Nv==6)
header("location:settings6.php");
$j="";
}
//}
else
{
$j = $errors ;
//header("location:settings2.php");
}





}

if($j<>"")
{
echo "<script language = 'javascript'>";
echo "alert('$j')";
//echo "alert('test')";
echo "</script>" ;
}

$Nv=3;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>ManiMano - Einstellungen 2 von 6</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function Change(id1)
{
if (id1== "Mo")
{
if(document.form1.Mo.checked == true)
{
document.form1.flagm1.checked = true;
document.form1.flagm2.checked = true;
document.form1.flagm3.checked = true;
document.form1.flagm4.checked = true;
document.form1.flagm5.checked = true;
document.form1.flagm6.checked = true;
document.form1.flagm7.checked = true;
document.form1.flagm8.checked = true;
document.form1.flagm9.checked = true;
document.form1.flagm10.checked = true;
document.form1.flagm11.checked = true;
document.form1.flagm12.checked = true;
}else
{
document.form1.flagm1.checked = false;
document.form1.flagm2.checked = false;
document.form1.flagm3.checked = false;
document.form1.flagm4.checked = false;
document.form1.flagm5.checked = false;
document.form1.flagm6.checked = false;
document.form1.flagm7.checked = false;
document.form1.flagm8.checked = false;
document.form1.flagm9.checked = false;
document.form1.flagm10.checked = false;
document.form1.flagm11.checked = false;
document.form1.flagm12.checked = false;
}
}
if (id1== "Di")
{
if(document.form1.Di.checked == true)
{
document.form1.flagt1.checked = true;
document.form1.flagt2.checked = true;
document.form1.flagt3.checked = true;
document.form1.flagt4.checked = true;
document.form1.flagt5.checked = true;
document.form1.flagt6.checked = true;
document.form1.flagt7.checked = true;
document.form1.flagt8.checked = true;
document.form1.flagt9.checked = true;
document.form1.flagt10.checked = true;
document.form1.flagt11.checked = true;
document.form1.flagt12.checked = true;
}else
{
document.form1.flagt1.checked = false;
document.form1.flagt2.checked = false;
document.form1.flagt3.checked = false;
document.form1.flagt4.checked = false;
document.form1.flagt5.checked = false;
document.form1.flagt6.checked = false;
document.form1.flagt7.checked = false;
document.form1.flagt8.checked = false;
document.form1.flagt9.checked = false;
document.form1.flagt10.checked = false;
document.form1.flagt11.checked = false;
document.form1.flagt12.checked = false;
}
}
if (id1== "Mi")
{
if(document.form1.Mi.checked == true)
{
document.form1.flagw1.checked = true;
document.form1.flagw2.checked = true;
document.form1.flagw3.checked = true;
document.form1.flagw4.checked = true;
document.form1.flagw5.checked = true;
document.form1.flagw6.checked = true;
document.form1.flagw7.checked = true;
document.form1.flagw8.checked = true;
document.form1.flagw9.checked = true;
document.form1.flagw10.checked = true;
document.form1.flagw11.checked = true;
document.form1.flagw12.checked = true;
}else
{
document.form1.flagw1.checked = false;
document.form1.flagw2.checked = false;
document.form1.flagw3.checked = false;
document.form1.flagw4.checked = false;
document.form1.flagw5.checked = false;
document.form1.flagw6.checked = false;
document.form1.flagw7.checked = false;
document.form1.flagw8.checked = false;
document.form1.flagw9.checked = false;
document.form1.flagw10.checked = false;
document.form1.flagw11.checked = false;
document.form1.flagw12.checked = false;
}
}

if (id1== "Do")
{
if(document.form1.Do.checked == true)
{
document.form1.flagth1.checked = true;
document.form1.flagth2.checked = true;
document.form1.flagth3.checked = true;
document.form1.flagth4.checked = true;
document.form1.flagth5.checked = true;
document.form1.flagth6.checked = true;
document.form1.flagth7.checked = true;
document.form1.flagth8.checked = true;
document.form1.flagth9.checked = true;
document.form1.flagth10.checked = true;
document.form1.flagth11.checked = true;
document.form1.flagth12.checked = true;
}else
{
document.form1.flagth1.checked = false;
document.form1.flagth2.checked = false;
document.form1.flagth3.checked = false;
document.form1.flagth4.checked = false;
document.form1.flagth5.checked = false;
document.form1.flagth6.checked = false;
document.form1.flagth7.checked = false;
document.form1.flagth8.checked = false;
document.form1.flagth9.checked = false;
document.form1.flagth10.checked = false;
document.form1.flagth11.checked = false;
document.form1.flagth12.checked = false;
}
}


if (id1== "Fr")
{
if(document.form1.Fr.checked == true)
{
document.form1.flagf1.checked = true;
document.form1.flagf2.checked = true;
document.form1.flagf3.checked = true;
document.form1.flagf4.checked = true;
document.form1.flagf5.checked = true;
document.form1.flagf6.checked = true;
document.form1.flagf7.checked = true;
document.form1.flagf8.checked = true;
document.form1.flagf9.checked = true;
document.form1.flagf10.checked = true;
document.form1.flagf11.checked = true;
document.form1.flagf12.checked = true;
}else
{
document.form1.flagf1.checked = false;
document.form1.flagf2.checked = false;
document.form1.flagf3.checked = false;
document.form1.flagf4.checked = false;
document.form1.flagf5.checked = false;
document.form1.flagf6.checked = false;
document.form1.flagf7.checked = false;
document.form1.flagf8.checked = false;
document.form1.flagf9.checked = false;
document.form1.flagf10.checked = false;
document.form1.flagf11.checked = false;
document.form1.flagf12.checked = false;
}
}



if (id1== "Sa")
{
if(document.form1.Sa.checked == true)
{
document.form1.flagsa1.checked = true;
document.form1.flagsa2.checked = true;
document.form1.flagsa3.checked = true;
document.form1.flagsa4.checked = true;
document.form1.flagsa5.checked = true;
document.form1.flagsa6.checked = true;
document.form1.flagsa7.checked = true;
document.form1.flagsa8.checked = true;
document.form1.flagsa9.checked = true;
document.form1.flagsa10.checked = true;
document.form1.flagsa11.checked = true;
document.form1.flagsa12.checked = true;
}else
{
document.form1.flagsa1.checked = false;
document.form1.flagsa2.checked = false;
document.form1.flagsa3.checked = false;
document.form1.flagsa4.checked = false;
document.form1.flagsa5.checked = false;
document.form1.flagsa6.checked = false;
document.form1.flagsa7.checked = false;
document.form1.flagsa8.checked = false;
document.form1.flagsa9.checked = false;
document.form1.flagsa10.checked = false;
document.form1.flagsa11.checked = false;
document.form1.flagsa12.checked = false;
}
}



if (id1== "So")
{
if(document.form1.So.checked == true)
{
document.form1.flagsu1.checked = true;
document.form1.flagsu2.checked = true;
document.form1.flagsu3.checked = true;
document.form1.flagsu4.checked = true;
document.form1.flagsu5.checked = true;
document.form1.flagsu6.checked = true;
document.form1.flagsu7.checked = true;
document.form1.flagsu8.checked = true;
document.form1.flagsu9.checked = true;
document.form1.flagsu10.checked = true;
document.form1.flagsu11.checked = true;
document.form1.flagsu12.checked = true;
}else
{
document.form1.flagsu1.checked = false;
document.form1.flagsu2.checked = false;
document.form1.flagsu3.checked = false;
document.form1.flagsu4.checked = false;
document.form1.flagsu5.checked = false;
document.form1.flagsu6.checked = false;
document.form1.flagsu7.checked = false;
document.form1.flagsu8.checked = false;
document.form1.flagsu9.checked = false;
document.form1.flagsu10.checked = false;
document.form1.flagsu11.checked = false;
document.form1.flagsu12.checked = false;
}
}



if (id1== "row1")
{
if(document.form1.row1.checked == true)
{
document.form1.flagm1.checked = true;
document.form1.flagt1.checked = true;
document.form1.flagw1.checked = true;
document.form1.flagth1.checked = true;
document.form1.flagf1.checked = true;
document.form1.flagsa1.checked = true;
document.form1.flagsu1.checked = true;
}else
{
document.form1.flagm1.checked = false;
document.form1.flagt1.checked = false;
document.form1.flagw1.checked = false;
document.form1.flagth1.checked = false;
document.form1.flagf1.checked = false;
document.form1.flagsa1.checked = false;
document.form1.flagsu1.checked = false;
}
}

if (id1== "row2")
{
if(document.form1.row2.checked == true)
{
document.form1.flagm2.checked = true;
document.form1.flagt2.checked = true;
document.form1.flagw2.checked = true;
document.form1.flagth2.checked = true;
document.form1.flagf2.checked = true;
document.form1.flagsa2.checked = true;
document.form1.flagsu2.checked = true;
}else
{
document.form1.flagm2.checked = false;
document.form1.flagt2.checked = false;
document.form1.flagw2.checked = false;
document.form1.flagth2.checked = false;
document.form1.flagf2.checked = false;
document.form1.flagsa2.checked = false;
document.form1.flagsu2.checked = false;
}
}

if (id1== "row3")
{
if(document.form1.row3.checked == true)
{
document.form1.flagm3.checked = true;
document.form1.flagt3.checked = true;
document.form1.flagw3.checked = true;
document.form1.flagth3.checked = true;
document.form1.flagf3.checked = true;
document.form1.flagsa3.checked = true;
document.form1.flagsu3.checked = true;
}else
{
document.form1.flagm3.checked = false;
document.form1.flagt3.checked = false;
document.form1.flagw3.checked = false;
document.form1.flagth3.checked = false;
document.form1.flagf3.checked = false;
document.form1.flagsa3.checked = false;
document.form1.flagsu3.checked = false;
}
}

if (id1== "row4")
{
if(document.form1.row4.checked == true)
{
document.form1.flagm4.checked = true;
document.form1.flagt4.checked = true;
document.form1.flagw4.checked = true;
document.form1.flagth4.checked = true;
document.form1.flagf4.checked = true;
document.form1.flagsa4.checked = true;
document.form1.flagsu4.checked = true;
}else
{
document.form1.flagm4.checked = false;
document.form1.flagt4.checked = false;
document.form1.flagw4.checked = false;
document.form1.flagth4.checked = false;
document.form1.flagf4.checked = false;
document.form1.flagsa4.checked = false;
document.form1.flagsu4.checked = false;
}
}

if (id1== "row5")
{
if(document.form1.row5.checked == true)
{
document.form1.flagm5.checked = true;
document.form1.flagt5.checked = true;
document.form1.flagw5.checked = true;
document.form1.flagth5.checked = true;
document.form1.flagf5.checked = true;
document.form1.flagsa5.checked = true;
document.form1.flagsu5.checked = true;
}else
{
document.form1.flagm5.checked = false;
document.form1.flagt5.checked = false;
document.form1.flagw5.checked = false;
document.form1.flagth5.checked = false;
document.form1.flagf5.checked = false;
document.form1.flagsa5.checked = false;
document.form1.flagsu5.checked = false;
}
}


if (id1== "row6")
{
if(document.form1.row6.checked == true)
{
document.form1.flagm6.checked = true;
document.form1.flagt6.checked = true;
document.form1.flagw6.checked = true;
document.form1.flagth6.checked = true;
document.form1.flagf6.checked = true;
document.form1.flagsa6.checked = true;
document.form1.flagsu6.checked = true;
}else
{
document.form1.flagm6.checked = false;
document.form1.flagt6.checked = false;
document.form1.flagw6.checked = false;
document.form1.flagth6.checked = false;
document.form1.flagf6.checked = false;
document.form1.flagsa6.checked = false;
document.form1.flagsu6.checked = false;
}
}


if (id1== "row7")
{
if(document.form1.row7.checked == true)
{
document.form1.flagm7.checked = true;
document.form1.flagt7.checked = true;
document.form1.flagw7.checked = true;
document.form1.flagth7.checked = true;
document.form1.flagf7.checked = true;
document.form1.flagsa7.checked = true;
document.form1.flagsu7.checked = true;
}else
{
document.form1.flagm7.checked = false;
document.form1.flagt7.checked = false;
document.form1.flagw7.checked = false;
document.form1.flagth7.checked = false;
document.form1.flagf7.checked = false;
document.form1.flagsa7.checked = false;
document.form1.flagsu7.checked = false;
}
}


if (id1== "row8")
{
if(document.form1.row8.checked == true)
{
document.form1.flagm8.checked = true;
document.form1.flagt8.checked = true;
document.form1.flagw8.checked = true;
document.form1.flagth8.checked = true;
document.form1.flagf8.checked = true;
document.form1.flagsa8.checked = true;
document.form1.flagsu8.checked = true;
}else
{
document.form1.flagm8.checked = false;
document.form1.flagt8.checked = false;
document.form1.flagw8.checked = false;
document.form1.flagth8.checked = false;
document.form1.flagf8.checked = false;
document.form1.flagsa8.checked = false;
document.form1.flagsu8.checked = false;
}
}

if (id1== "row9")
{
if(document.form1.row9.checked == true)
{
document.form1.flagm9.checked = true;
document.form1.flagt9.checked = true;
document.form1.flagw9.checked = true;
document.form1.flagth9.checked = true;
document.form1.flagf9.checked = true;
document.form1.flagsa9.checked = true;
document.form1.flagsu9.checked = true;
}else
{
document.form1.flagm9.checked = false;
document.form1.flagt9.checked = false;
document.form1.flagw9.checked = false;
document.form1.flagth9.checked = false;
document.form1.flagf9.checked = false;
document.form1.flagsa9.checked = false;
document.form1.flagsu9.checked = false;
}
}

if (id1== "row10")
{
if(document.form1.row10.checked == true)
{
document.form1.flagm10.checked = true;
document.form1.flagt10.checked = true;
document.form1.flagw10.checked = true;
document.form1.flagth10.checked = true;
document.form1.flagf10.checked = true;
document.form1.flagsa10.checked = true;
document.form1.flagsu10.checked = true;
}else
{
document.form1.flagm10.checked = false;
document.form1.flagt10.checked = false;
document.form1.flagw10.checked = false;
document.form1.flagth10.checked = false;
document.form1.flagf10.checked = false;
document.form1.flagsa10.checked = false;
document.form1.flagsu10.checked = false;
}
}

if (id1== "row11")
{
if(document.form1.row11.checked == true)
{
document.form1.flagm11.checked = true;
document.form1.flagt11.checked = true;
document.form1.flagw11.checked = true;
document.form1.flagth11.checked = true;
document.form1.flagf11.checked = true;
document.form1.flagsa11.checked = true;
document.form1.flagsu11.checked = true;
}else
{
document.form1.flagm11.checked = false;
document.form1.flagt11.checked = false;
document.form1.flagw11.checked = false;
document.form1.flagth11.checked = false;
document.form1.flagf11.checked = false;
document.form1.flagsa11.checked = false;
document.form1.flagsu11.checked = false;
}
}

if (id1== "row12")
{
if(document.form1.row12.checked == true)
{
document.form1.flagm12.checked = true;
document.form1.flagt12.checked = true;
document.form1.flagw12.checked = true;
document.form1.flagth12.checked = true;
document.form1.flagf12.checked = true;
document.form1.flagsa12.checked = true;
document.form1.flagsu12.checked = true;
}else
{
document.form1.flagm12.checked = false;
document.form1.flagt12.checked = false;
document.form1.flagw12.checked = false;
document.form1.flagth12.checked = false;
document.form1.flagf12.checked = false;
document.form1.flagsa12.checked = false;
document.form1.flagsu12.checked = false;
}
}


if (id1== "tMo")
{
if(document.form1.tMo.checked == true)
{
document.form1.flag_m1.checked = true;
document.form1.flag_m2.checked = true;
document.form1.flag_m3.checked = true;
document.form1.flag_m4.checked = true;
document.form1.flag_m5.checked = true;
document.form1.flag_m6.checked = true;
document.form1.flag_m7.checked = true;
document.form1.flag_m8.checked = true;
document.form1.flag_m9.checked = true;
document.form1.flag_m10.checked = true;
document.form1.flag_m11.checked = true;
document.form1.flag_m12.checked = true;
}else
{
document.form1.flag_m1.checked = false;
document.form1.flag_m2.checked = false;
document.form1.flag_m3.checked = false;
document.form1.flag_m4.checked = false;
document.form1.flag_m5.checked = false;
document.form1.flag_m6.checked = false;
document.form1.flag_m7.checked = false;
document.form1.flag_m8.checked = false;
document.form1.flag_m9.checked = false;
document.form1.flag_m10.checked = false;
document.form1.flag_m11.checked = false;
document.form1.flag_m12.checked = false;
}
}

if (id1== "tDi")
{
if(document.form1.tDi.checked == true)
{
document.form1.flag_t1.checked = true;
document.form1.flag_t2.checked = true;
document.form1.flag_t3.checked = true;
document.form1.flag_t4.checked = true;
document.form1.flag_t5.checked = true;
document.form1.flag_t6.checked = true;
document.form1.flag_t7.checked = true;
document.form1.flag_t8.checked = true;
document.form1.flag_t9.checked = true;
document.form1.flag_t10.checked = true;
document.form1.flag_t11.checked = true;
document.form1.flag_t12.checked = true;
}else
{
document.form1.flag_t1.checked = false;
document.form1.flag_t2.checked = false;
document.form1.flag_t3.checked = false;
document.form1.flag_t4.checked = false;
document.form1.flag_t5.checked = false;
document.form1.flag_t6.checked = false;
document.form1.flag_t7.checked = false;
document.form1.flag_t8.checked = false;
document.form1.flag_t9.checked = false;
document.form1.flag_t10.checked = false;
document.form1.flag_t11.checked = false;
document.form1.flag_t12.checked = false;
}
}
if (id1== "tMi")
{
if(document.form1.tMi.checked == true)
{
document.form1.flag_w1.checked = true;
document.form1.flag_w2.checked = true;
document.form1.flag_w3.checked = true;
document.form1.flag_w4.checked = true;
document.form1.flag_w5.checked = true;
document.form1.flag_w6.checked = true;
document.form1.flag_w7.checked = true;
document.form1.flag_w8.checked = true;
document.form1.flag_w9.checked = true;
document.form1.flag_w10.checked = true;
document.form1.flag_w11.checked = true;
document.form1.flag_w12.checked = true;
}else
{
document.form1.flag_w1.checked = false;
document.form1.flag_w2.checked = false;
document.form1.flag_w3.checked = false;
document.form1.flag_w4.checked = false;
document.form1.flag_w5.checked = false;
document.form1.flag_w6.checked = false;
document.form1.flag_w7.checked = false;
document.form1.flag_w8.checked = false;
document.form1.flag_w9.checked = false;
document.form1.flag_w10.checked = false;
document.form1.flag_w11.checked = false;
document.form1.flag_w12.checked = false;
}
}

if (id1== "tDo")
{
if(document.form1.tDo.checked == true)
{
document.form1.flag_th1.checked = true;
document.form1.flag_th2.checked = true;
document.form1.flag_th3.checked = true;
document.form1.flag_th4.checked = true;
document.form1.flag_th5.checked = true;
document.form1.flag_th6.checked = true;
document.form1.flag_th7.checked = true;
document.form1.flag_th8.checked = true;
document.form1.flag_th9.checked = true;
document.form1.flag_th10.checked = true;
document.form1.flag_th11.checked = true;
document.form1.flag_th12.checked = true;
}else
{
document.form1.flag_th1.checked = false;
document.form1.flag_th2.checked = false;
document.form1.flag_th3.checked = false;
document.form1.flag_th4.checked = false;
document.form1.flag_th5.checked = false;
document.form1.flag_th6.checked = false;
document.form1.flag_th7.checked = false;
document.form1.flag_th8.checked = false;
document.form1.flag_th9.checked = false;
document.form1.flag_th10.checked = false;
document.form1.flag_th11.checked = false;
document.form1.flag_th12.checked = false;
}
}


if (id1== "tFr")
{
if(document.form1.tFr.checked == true)
{
document.form1.flag_f1.checked = true;
document.form1.flag_f2.checked = true;
document.form1.flag_f3.checked = true;
document.form1.flag_f4.checked = true;
document.form1.flag_f5.checked = true;
document.form1.flag_f6.checked = true;
document.form1.flag_f7.checked = true;
document.form1.flag_f8.checked = true;
document.form1.flag_f9.checked = true;
document.form1.flag_f10.checked = true;
document.form1.flag_f11.checked = true;
document.form1.flag_f12.checked = true;
}else
{
document.form1.flag_f1.checked = false;
document.form1.flag_f2.checked = false;
document.form1.flag_f3.checked = false;
document.form1.flag_f4.checked = false;
document.form1.flag_f5.checked = false;
document.form1.flag_f6.checked = false;
document.form1.flag_f7.checked = false;
document.form1.flag_f8.checked = false;
document.form1.flag_f9.checked = false;
document.form1.flag_f10.checked = false;
document.form1.flag_f11.checked = false;
document.form1.flag_f12.checked = false;
}
}



if (id1== "tSa")
{
if(document.form1.tSa.checked == true)
{
document.form1.flag_sa1.checked = true;
document.form1.flag_sa2.checked = true;
document.form1.flag_sa3.checked = true;
document.form1.flag_sa4.checked = true;
document.form1.flag_sa5.checked = true;
document.form1.flag_sa6.checked = true;
document.form1.flag_sa7.checked = true;
document.form1.flag_sa8.checked = true;
document.form1.flag_sa9.checked = true;
document.form1.flag_sa10.checked = true;
document.form1.flag_sa11.checked = true;
document.form1.flag_sa12.checked = true;
}else
{
document.form1.flag_sa1.checked = false;
document.form1.flag_sa2.checked = false;
document.form1.flag_sa3.checked = false;
document.form1.flag_sa4.checked = false;
document.form1.flag_sa5.checked = false;
document.form1.flag_sa6.checked = false;
document.form1.flag_sa7.checked = false;
document.form1.flag_sa8.checked = false;
document.form1.flag_sa9.checked = false;
document.form1.flag_sa10.checked = false;
document.form1.flag_sa11.checked = false;
document.form1.flag_sa12.checked = false;
}
}



if (id1== "tSo")
{
if(document.form1.tSo.checked == true)
{
document.form1.flag_su1.checked = true;
document.form1.flag_su2.checked = true;
document.form1.flag_su3.checked = true;
document.form1.flag_su4.checked = true;
document.form1.flag_su5.checked = true;
document.form1.flag_su6.checked = true;
document.form1.flag_su7.checked = true;
document.form1.flag_su8.checked = true;
document.form1.flag_su9.checked = true;
document.form1.flag_su10.checked = true;
document.form1.flag_su11.checked = true;
document.form1.flag_su12.checked = true;
}else
{
document.form1.flag_su1.checked = false;
document.form1.flag_su2.checked = false;
document.form1.flag_su3.checked = false;
document.form1.flag_su4.checked = false;
document.form1.flag_su5.checked = false;
document.form1.flag_su6.checked = false;
document.form1.flag_su7.checked = false;
document.form1.flag_su8.checked = false;
document.form1.flag_su9.checked = false;
document.form1.flag_su10.checked = false;
document.form1.flag_su11.checked = false;
document.form1.flag_su12.checked = false;
}
}

if (id1== "trow1")
{
if(document.form1.trow1.checked == true)
{
document.form1.flag_m1.checked = true;
document.form1.flag_t1.checked = true;
document.form1.flag_w1.checked = true;
document.form1.flag_th1.checked = true;
document.form1.flag_f1.checked = true;
document.form1.flag_sa1.checked = true;
document.form1.flag_su1.checked = true;
}else
{
document.form1.flag_m1.checked = false;
document.form1.flag_t1.checked = false;
document.form1.flag_w1.checked = false;
document.form1.flag_th1.checked = false;
document.form1.flag_f1.checked = false;
document.form1.flag_sa1.checked = false;
document.form1.flag_su1.checked = false;
}
}

if (id1== "trow2")
{
if(document.form1.trow2.checked == true)
{
document.form1.flag_m2.checked = true;
document.form1.flag_t2.checked = true;
document.form1.flag_w2.checked = true;
document.form1.flag_th2.checked = true;
document.form1.flag_f2.checked = true;
document.form1.flag_sa2.checked = true;
document.form1.flag_su2.checked = true;
}else
{
document.form1.flag_m2.checked = false;
document.form1.flag_t2.checked = false;
document.form1.flag_w2.checked = false;
document.form1.flag_th2.checked = false;
document.form1.flag_f2.checked = false;
document.form1.flag_sa2.checked = false;
document.form1.flag_su2.checked = false;
}
}

if (id1== "trow3")
{
if(document.form1.trow3.checked == true)
{
document.form1.flag_m3.checked = true;
document.form1.flag_t3.checked = true;
document.form1.flag_w3.checked = true;
document.form1.flag_th3.checked = true;
document.form1.flag_f3.checked = true;
document.form1.flag_sa3.checked = true;
document.form1.flag_su3.checked = true;
}else
{
document.form1.flag_m3.checked = false;
document.form1.flag_t3.checked = false;
document.form1.flag_w3.checked = false;
document.form1.flag_th3.checked = false;
document.form1.flag_f3.checked = false;
document.form1.flag_sa3.checked = false;
document.form1.flag_su3.checked = false;
}
}

if (id1== "trow4")
{
if(document.form1.trow4.checked == true)
{
document.form1.flag_m4.checked = true;
document.form1.flag_t4.checked = true;
document.form1.flag_w4.checked = true;
document.form1.flag_th4.checked = true;
document.form1.flag_f4.checked = true;
document.form1.flag_sa4.checked = true;
document.form1.flag_su4.checked = true;
}else
{
document.form1.flag_m4.checked = false;
document.form1.flag_t4.checked = false;
document.form1.flag_w4.checked = false;
document.form1.flag_th4.checked = false;
document.form1.flag_f4.checked = false;
document.form1.flag_sa4.checked = false;
document.form1.flag_su4.checked = false;
}
}

if (id1== "trow5")
{
if(document.form1.trow5.checked == true)
{
document.form1.flag_m5.checked = true;
document.form1.flag_t5.checked = true;
document.form1.flag_w5.checked = true;
document.form1.flag_th5.checked = true;
document.form1.flag_f5.checked = true;
document.form1.flag_sa5.checked = true;
document.form1.flag_su5.checked = true;
}else
{
document.form1.flag_m5.checked = false;
document.form1.flag_t5.checked = false;
document.form1.flag_w5.checked = false;
document.form1.flag_th5.checked = false;
document.form1.flag_f5.checked = false;
document.form1.flag_sa5.checked = false;
document.form1.flag_su5.checked = false;
}
}


if (id1== "trow6")
{
if(document.form1.trow6.checked == true)
{
document.form1.flag_m6.checked = true;
document.form1.flag_t6.checked = true;
document.form1.flag_w6.checked = true;
document.form1.flag_th6.checked = true;
document.form1.flag_f6.checked = true;
document.form1.flag_sa6.checked = true;
document.form1.flag_su6.checked = true;
}else
{
document.form1.flag_m6.checked = false;
document.form1.flag_t6.checked = false;
document.form1.flag_w6.checked = false;
document.form1.flag_th6.checked = false;
document.form1.flag_f6.checked = false;
document.form1.flag_sa6.checked = false;
document.form1.flag_su6.checked = false;
}
}


if (id1== "trow7")
{
if(document.form1.trow7.checked == true)
{
document.form1.flag_m7.checked = true;
document.form1.flag_t7.checked = true;
document.form1.flag_w7.checked = true;
document.form1.flag_th7.checked = true;
document.form1.flag_f7.checked = true;
document.form1.flag_sa7.checked = true;
document.form1.flag_su7.checked = true;
}else
{
document.form1.flag_m7.checked = false;
document.form1.flag_t7.checked = false;
document.form1.flag_w7.checked = false;
document.form1.flag_th7.checked = false;
document.form1.flag_f7.checked = false;
document.form1.flag_sa7.checked = false;
document.form1.flag_su7.checked = false;
}
}


if (id1== "trow8")
{
if(document.form1.trow8.checked == true)
{
document.form1.flag_m8.checked = true;
document.form1.flag_t8.checked = true;
document.form1.flag_w8.checked = true;
document.form1.flag_th8.checked = true;
document.form1.flag_f8.checked = true;
document.form1.flag_sa8.checked = true;
document.form1.flag_su8.checked = true;
}else
{
document.form1.flag_m8.checked = false;
document.form1.flag_t8.checked = false;
document.form1.flag_w8.checked = false;
document.form1.flag_th8.checked = false;
document.form1.flag_f8.checked = false;
document.form1.flag_sa8.checked = false;
document.form1.flag_su8.checked = false;
}
}

if (id1== "trow9")
{
if(document.form1.trow9.checked == true)
{
document.form1.flag_m9.checked = true;
document.form1.flag_t9.checked = true;
document.form1.flag_w9.checked = true;
document.form1.flag_th9.checked = true;
document.form1.flag_f9.checked = true;
document.form1.flag_sa9.checked = true;
document.form1.flag_su9.checked = true;
}else
{
document.form1.flag_m9.checked = false;
document.form1.flag_t9.checked = false;
document.form1.flag_w9.checked = false;
document.form1.flag_th9.checked = false;
document.form1.flag_f9.checked = false;
document.form1.flag_sa9.checked = false;
document.form1.flag_su9.checked = false;
}
}

if (id1== "trow10")
{
if(document.form1.trow10.checked == true)
{
document.form1.flag_m10.checked = true;
document.form1.flag_t10.checked = true;
document.form1.flag_w10.checked = true;
document.form1.flag_th10.checked = true;
document.form1.flag_f10.checked = true;
document.form1.flag_sa10.checked = true;
document.form1.flag_su10.checked = true;
}else
{
document.form1.flag_m10.checked = false;
document.form1.flag_t10.checked = false;
document.form1.flag_w10.checked = false;
document.form1.flag_th10.checked = false;
document.form1.flag_f10.checked = false;
document.form1.flag_sa10.checked = false;
document.form1.flag_su10.checked = false;
}
}

if (id1== "trow11")
{
if(document.form1.trow11.checked == true)
{
document.form1.flag_m11.checked = true;
document.form1.flag_t11.checked = true;
document.form1.flag_w11.checked = true;
document.form1.flag_th11.checked = true;
document.form1.flag_f11.checked = true;
document.form1.flag_sa11.checked = true;
document.form1.flag_su11.checked = true;
}else
{
document.form1.flag_m11.checked = false;
document.form1.flag_t11.checked = false;
document.form1.flag_w11.checked = false;
document.form1.flag_th11.checked = false;
document.form1.flag_f11.checked = false;
document.form1.flag_sa11.checked = false;
document.form1.flag_su11.checked = false;
}
}

if (id1== "trow12")
{
if(document.form1.trow12.checked == true)
{
document.form1.flag_m12.checked = true;
document.form1.flag_t12.checked = true;
document.form1.flag_w12.checked = true;
document.form1.flag_th12.checked = true;
document.form1.flag_f12.checked = true;
document.form1.flag_sa12.checked = true;
document.form1.flag_su12.checked = true;
}else
{
document.form1.flag_m12.checked = false;
document.form1.flag_t12.checked = false;
document.form1.flag_w12.checked = false;
document.form1.flag_th12.checked = false;
document.form1.flag_f12.checked = false;
document.form1.flag_sa12.checked = false;
document.form1.flag_su12.checked = false;
}
}




}



</script>
</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
session_start();
if ($_SESSION['auth'] == "yes")
{

echo"<h4>Willkommen, {$_SESSION['first_name']} {$_SESSION['last_name']}</h4>";
$sql="SELECT * FROM t_people WHERE people_id ={$_SESSION['people_id']}";
$result=mysql_query($sql);
$row=mysql_fetch_array($result);
}else
{
header("location:index.php");	
}
?>
<input type=button value="Rechtliches" onclick=location.href="Rechtliches.php" id="helpbtn3">
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" onclick=location.href="settings1.php?al=''" id="maindatbtn">
<?php
if (($row['Agree'] == 1) And ($row['Active'] == 1)){      
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn'>";
}else{
	echo"<input type='button' value='Suche' onclick=location.href='search.php?kinder=1&type=0&gender=2' id='maindatbtn' Disabled>";
}
?>
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">2) Zeitliche Verfügbarkeit:  <img src="images/page2.png" border="0"  usemap="#green" align="right" /></span>
<map name="green">
<area shape="rect" alt="" coords="5,2,35,30" href="javascript:Nav(1);">
<area shape="rect" alt="" coords="59,2,78,29" href="javascript:Nav(3);">
<area shape="rect" alt="" coords="84,2,98,30" href="javascript:Nav(4);">
<area shape="rect" alt="" coords="101,1,119,30"href="javascript:Nav(5);">
<area shape="rect" alt="" coords="125,0,140,30"href="javascript:Nav(6);">
</map>
                <form method="post" name="form1" action="settings2.php">
<input type="hidden" Name="Nv"  id="Nv" value="<?php echo"$Nv";?>">
	  <table width="800" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="435"><label id="smal">aktiver Zeitplan:
	          <input name="zitplan" type="text" id="zitplan" value="Grundzeitplan" />
	      </label>
            <div id="TabbedPanels1" class="TabbedPanels">
              <ul class="TabbedPanelsTabGroup">
                <li class="TabbedPanelsTab" tabindex="0">Grundzeitplan</li>
                <li class="TabbedPanelsTab" tabindex="0">temporärer Zeitplan</li>
              </ul>
              <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent">
                  <p>&nbsp;</p>
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td style="background:#56769d; color:#fff;"></td>
                      <td style="background:#56769d; color:#fff;"><input type='checkbox' name='Mo' onclick=javascript:Change("Mo")>Mo</td>

<td style="background:#56769d; color:#fff;"><input type='checkbox' name='Di' onclick=javascript:Change("Di")>Di</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='Mi' onclick=javascript:Change("Mi")>Mi</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='Do' onclick=javascript:Change("Do")>Do</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='Fr' onclick=javascript:Change("Fr")>Fr</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='Sa' onclick=javascript:Change("Sa")>Sa</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='So'onclick=javascript:Change("So")>So</td>
                   
                    </tr>
                    <tr>
                  
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row1' onclick=javascript:Change("row1")>24-02</td>
<?PHP
echo "<td>"; 
                   if ($row['monday'][0] == 1){                        
echo"<input type='checkbox' name='flagm1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][0] == 1){                        
echo"<input type='checkbox' name='flagt1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][0] == 1){                        
echo"<input type='checkbox' name='flagw1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][0] == 1){                        
echo"<input type='checkbox' name='flagth1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][0] == 1){                        
echo"<input type='checkbox' name='flagf1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][0] == 1){                        
echo"<input type='checkbox' name='flagsa1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][0] == 1){                        
echo"<input type='checkbox' name='flagsu1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu1' value='flag'  >";

}
echo "</td>";
?>
</tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row2' onclick=javascript:Change("row2")>02-04</td>
                                                <?php

echo "<td>";
if ($row['monday'][1] == 1){                        
echo"<input type='checkbox' name='flagm2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm2' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday'][1] == 1){                        
echo"<input type='checkbox' name='flagt2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][1] == 1){                        
echo"<input type='checkbox' name='flagw2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][1] == 1){                        
echo"<input type='checkbox' name='flagth2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][1] == 1){                        
echo"<input type='checkbox' name='flagf2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][1] == 1){                        
echo"<input type='checkbox' name='flagsa2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][1] == 1){                        
echo"<input type='checkbox' name='flagsu2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu2' value='flag'  >";

}
echo "</td>";
?>
 </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row3' onclick=javascript:Change("row3")>04-06</td>
                                              <?php

echo "<td>";
if ($row['monday'][2] == 1){                        
echo"<input type='checkbox' name='flagm3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm3' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday'][2] == 1){                        
echo"<input type='checkbox' name='flagt3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][2] == 1){                        
echo"<input type='checkbox' name='flagw3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][2] == 1){                        
echo"<input type='checkbox' name='flagth3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][2] == 1){                        
echo"<input type='checkbox' name='flagf3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][2] == 1){                        
echo"<input type='checkbox' name='flagsa3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][2] == 1){                        
echo"<input type='checkbox' name='flagsu3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu3' value='flag'  >";

}
echo "</td>";
?>
</tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row4' onclick=javascript:Change("row4")>06-08</td>
<?php

echo "<td>";
if ($row['monday'][3] == 1){                        
echo"<input type='checkbox' name='flagm4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm4' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday'][3] == 1){                        
echo"<input type='checkbox' name='flagt4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][3] == 1){                        
echo"<input type='checkbox' name='flagw4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][3] == 1){                        
echo"<input type='checkbox' name='flagth4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][3] == 1){                        
echo"<input type='checkbox' name='flagf4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][3] == 1){                        
echo"<input type='checkbox' name='flagsa4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][3] == 1){                        
echo"<input type='checkbox' name='flagsu4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu4' value='flag'  >";

}
echo "</td>";
?>
</tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row5' onclick=javascript:Change("row5")>08-10</td>
                                               <?php


echo "<td>";
if ($row['monday'][4] == 1){                        
echo"<input type='checkbox' name='flagm5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][4] == 1){                        
echo"<input type='checkbox' name='flagt5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][4] == 1){                        
echo"<input type='checkbox' name='flagw5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][4] == 1){                        
echo"<input type='checkbox' name='flagth5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][4] == 1){                        
echo"<input type='checkbox' name='flagf5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][4] == 1){                        
echo"<input type='checkbox' name='flagsa5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][4] == 1){                        
echo"<input type='checkbox' name='flagsu5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu5' value='flag'  >";

}
echo "</td>";
?>
     </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row6' onclick=javascript:Change("row6")>10-12</td>
                                               <?php

echo "<td>";
if ($row['monday'][5] == 1){                        
echo"<input type='checkbox' name='flagm6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][5] == 1){                        
echo"<input type='checkbox' name='flagt6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][5] == 1){                        
echo"<input type='checkbox' name='flagw6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][5] == 1){                        
echo"<input type='checkbox' name='flagth6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][5] == 1){                        
echo"<input type='checkbox' name='flagf6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][5] == 1){                        
echo"<input type='checkbox' name='flagsa6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][5] == 1){                        
echo"<input type='checkbox' name='flagsu6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu6' value='flag'  >";

}
echo "</td>";

?>
  </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row7'onclick=javascript:Change("row7")>12-14</td>
                                                <?php

echo "<td>";
if ($row['monday'][6] == 1){                        
echo"<input type='checkbox' name='flagm7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][6] == 1){                        
echo"<input type='checkbox' name='flagt7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][6] == 1){                        
echo"<input type='checkbox' name='flagw7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][6] == 1){                        
echo"<input type='checkbox' name='flagth7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][6] == 1){                        
echo"<input type='checkbox' name='flagf7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][6] == 1){                        
echo"<input type='checkbox' name='flagsa7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][6] == 1){                        
echo"<input type='checkbox' name='flagsu7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu7' value='flag'  >";

}
echo "</td>";

?>
    </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row8'onclick=javascript:Change("row8")>14-16</td>
                                                <?php
echo "<td>";
if ($row['monday'][7] == 1){                        
echo"<input type='checkbox' name='flagm8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm8' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday'][7] == 1){                        
echo"<input type='checkbox' name='flagt8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][7] == 1){                        
echo"<input type='checkbox' name='flagw8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][7] == 1){                        
echo"<input type='checkbox' name='flagth8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][7] == 1){                        
echo"<input type='checkbox' name='flagf8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][7] == 1){                        
echo"<input type='checkbox' name='flagsa8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][7] == 1){                        
echo"<input type='checkbox' name='flagsu8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu8' value='flag'  >";

}
echo "</td>";
?>
               </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row9'onclick=javascript:Change("row9")>16-18</td>
                                               <?php

echo "<td>";
if ($row['monday'][8] == 1){                        
echo"<input type='checkbox' name='flagm9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][8] == 1){                        
echo"<input type='checkbox' name='flagt9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][8] == 1){                        
echo"<input type='checkbox' name='flagw9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][8] == 1){                        
echo"<input type='checkbox' name='flagth9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][8] == 1){                        
echo"<input type='checkbox' name='flagf9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][8] == 1){                        
echo"<input type='checkbox' name='flagsa9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][8] == 1){                        
echo"<input type='checkbox' name='flagsu9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu9' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row10' onclick=javascript:Change("row10")>18-20</td>
                                           <?php

echo "<td>";
if ($row['monday'][9] == 1){                        
echo"<input type='checkbox' name='flagm10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][9] == 1){                        
echo"<input type='checkbox' name='flagt10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][9] == 1){                        
echo"<input type='checkbox' name='flagw10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][9] == 1){                        
echo"<input type='checkbox' name='flagth10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][9] == 1){                        
echo"<input type='checkbox' name='flagf10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][9] == 1){                        
echo"<input type='checkbox' name='flagsa10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][9] == 1){                        
echo"<input type='checkbox' name='flagsu10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu10' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row11'onclick=javascript:Change("row11")>20-22</td>
                                                <?php
echo "<td>";
if ($row['monday'][10] == 1){                        
echo"<input type='checkbox' name='flagm11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][10] == 1){                        
echo"<input type='checkbox' name='flagt11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][10] == 1){                        
echo"<input type='checkbox' name='flagw11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][10] == 1){                        
echo"<input type='checkbox' name='flagth11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][10] == 1){                        
echo"<input type='checkbox' name='flagf11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][10] == 1){                        
echo"<input type='checkbox' name='flagsa11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][10] == 1){                        
echo"<input type='checkbox' name='flagsu11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu11' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
<tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='row12' onclick=javascript:Change("row12")>22-24</td>
                                               <?php
echo "<td>";
if ($row['monday'][11] == 1){                        
echo"<input type='checkbox' name='flagm12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagm12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday'][11] == 1){                        
echo"<input type='checkbox' name='flagt10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagt12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday'][11] == 1){                        
echo"<input type='checkbox' name='flagw12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagw12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday'][11] == 1){                        
echo"<input type='checkbox' name='flagth12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagth12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday'][11] == 1){                        
echo"<input type='checkbox' name='flagf12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagf12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday'][11] == 1){                        
echo"<input type='checkbox' name='flagsa12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsa12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday'][11] == 1){                        
echo"<input type='checkbox' name='flagsu12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flagsu12' value='flag'  >";

}
echo "</td>";

?>

                    </tr>
                  </table>
                </div>
                <div class="TabbedPanelsContent">
                  <p>
                    <label>Start:


                      <input type="text" name="start" id="start" Value="<?php echo"$row[temp_sched_from]"; ?>" />
                    </label>
                    <label>Ende:
                      <input type="text" name="ende" id="ende" Value="<?php echo"$row[temp_sched_to]"; ?>" />
         
                    </label>
                  </p>
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                       <td style="background:#56769d; color:#fff;"></td>
                      <td style="background:#56769d; color:#fff;"><input type='checkbox' name='tMo' onclick=javascript:Change("tMo")>Mo</td>

<td style="background:#56769d; color:#fff;"><input type='checkbox' name='tDi' onclick=javascript:Change("tDi")>Di</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='tMi' onclick=javascript:Change("tMi")>Mi</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='tDo' onclick=javascript:Change("tDo")>Do</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='tFr' onclick=javascript:Change("tFr")>Fr</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='tSa' onclick=javascript:Change("tSa")>Sa</td>
<td style="background:#56769d; color:#fff;"><input type='checkbox' name='tSo' onclick=javascript:Change("tSo")>So</td>

                    </tr>
                    
                                          <tr>
                  
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow1' onclick=javascript:Change("trow1")>24-02</td>
                        <?PHP 

echo "<td>";
                   if ($row['monday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_m1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_t1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_w1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_th1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_f1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_sa1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa1' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag_su1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su1' value='flag'  >";

}
echo "</td>";

?>
</tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow2' onclick=javascript:Change("trow2")>02-04</td>

                                                <?php

echo "<td>";
if ($row['monday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_m2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_t2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_w2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_th2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_f2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_sa2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa2' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag_su2' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su2' value='flag'  >";

}
echo "</td>";
?>
</tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow3' onclick=javascript:Change("trow3")>04-06</td>
                                              <?php
echo "<td>";
if ($row['monday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_m3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_t3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_w3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_th3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_f3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_sa3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa3' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag_su3' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su3' value='flag'  >";

}
echo "</td>";
?>
</tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow4' onclick=javascript:Change("trow4")>06-08</td>
<?php
echo "<td>";
if ($row['monday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_m4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m4' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_t4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_w4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_th4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_f4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_sa4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa4' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag_su4' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su4' value='flag'  >";

}
echo "</td>";
?>
</tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow5' onclick=javascript:Change("trow5")>08-10</td>
                        
                                               <?php

echo "<td>";if ($row['monday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_m5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_t5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_w5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_th5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_f5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_sa5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa5' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag_su5' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su5' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow6' onclick=javascript:Change("trow6")>10-12</td>
                                               <?php
echo "<td>";
if ($row['monday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_m6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_t6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_w6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['thursday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_th6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_f6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_sa6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa6' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag_su6' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su6' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow7' onclick=javascript:Change("trow7")>12-14</td>
                                                <?php
echo "<td>";
if ($row['monday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_m7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                        if ($row['tuesday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_t7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_w7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_th7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_f7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_sa7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa7' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag_su7' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su7' value='flag'  >";

}
echo "</td>";
?>
                    </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow8' onclick=javascript:Change("trow8")>14-16</td>
                                                <?php
echo "<td>";
if ($row['monday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_m8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m8' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_t8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_w8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_th8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_f8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_sa8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa8' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag_su8' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su8' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow9' onclick=javascript:Change("trow9")>16-18</td>
                                               <?php
echo "<td>";
if ($row['monday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_m9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m9' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_t9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_w9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_th9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_f9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_sa9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa9' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag_su9' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su9' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow10' onclick=javascript:Change("trow10")>18-20</td>
                                           <?php
echo "<td>";
if ($row['monday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_m10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m10' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_t10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_w10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_th10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_f10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_sa10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa10' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag_su10' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su10' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow11' onclick=javascript:Change("trow11")>20-22</td>
                                                <?php
echo "<td>";
if ($row['monday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_m11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m11' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_t11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_w11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_th11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_f11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_sa11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_sa11' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag_su11' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su11' value='flag'  >";

}
echo "</td>";
?>
                        </tr>
  <tr>
 <td style="background:#56769d; color:#fff;"><input type='checkbox' name='trow12' onclick=javascript:Change("trow12")>22-24</td>
                                               <?php


echo "<td>";
if ($row['monday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_m12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_m12' value='flag'  >";

}
echo "</td>";
echo "<td>";

                        if ($row['tuesday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_t12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_t12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['wednesday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_w12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_w12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['thursday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_th12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_th12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['friday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_f12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_f12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                               if ($row['saturday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_sa12' value='flag'  >";
}else{
echo"<input type='checkbox' name='flag_sa12' value='flag'  >";

}
echo "</td>";
echo "<td>";
                                                if ($row['sunday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag_su12' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag_su12' value='flag'  >";

}
echo "</td>";

?>


                    </tr>
                  </table>
                </div>
              </div>
          </div></td>
	      <td width="365">
          <div style=" width:351px; margin-left:12px; color:#fff; font-size:12px;">
          Sie müssen ein zeitliches Profil hinterlegen - die einen stehen früh auf - und möchten abends nicht gestört werden. Bei den andern ist es umgekehrt. Und bei einigen ist der Sonntag der heilige Tag.<br />
          Hier können Sie einstellen, wann sie erreicht werden wollen.
          <br /><br />
          Den temporäre Zeitplan aktivieren Sie z.B. wenn sie in die Ferien gehen. Wir haben einen zweiten Zeitplan programmiert, damit sie nicht am ersten Veränderungen vornehmen müssen.
          <br /><br />
          Der temporäre Zeitplan hat eine Gültigkeitsdauer. Ist das Enddatum überschritten, wird automatisch der Grundzeitplan aktiviert. <br />
          Den Grundzeitplan müssen Sie ausfüllen.<br />
          Wenn Sie auf die Zeilen- und Spaltenreiter klicken, können Sie eine ganze Spalte / Zeile kippen. So geht's ganz schnell.
          </div>
        </td>
        </tr>
      </table>

      <p><input type="submit" name="nextbtn" id="nextbtn" value="Weiter zum Angebotsprofil (3 von 6)" onclick=location.href="settings3.php" /></p>
</form>
	</div>
  </div>
</div>
<script type="text/javascript">
function Nav(i)
{
document.getElementById("Nv").value = i;
document.form1.nextbtn.click(); 

}
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
