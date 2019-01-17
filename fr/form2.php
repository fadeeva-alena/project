<?php
$j="";
if ( $_POST ) 

{
$F6=$_post['field6'];

if ($_post['field6']=="")

{
$errors .= "Field 6 is required";  
}



if ($errors=="")
{
header("location:form3.php");
$j="";

}else{
$j=$errors;
echo "<script language = 'javascript'>";
echo "alert('$j')";
echo "</script>" ;
}

}






?>

<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Untitled Document</title> 
</head> 

<body> 
<p>Page 2</p> 
<form method="post"   id="form10" name="Form10" action="form2.php">
<p>Name of Electrical Company:&nbsp;[Required]<br /> 
  <input type="text" name="field6"  id="field_6" size='25' value="<?php echo"$F6";?>">  
</p> 
<p><span class="formFieldQuestion">Average Annual Electrical Bill:&nbsp;<span class="formrequired">[Required]</span></span><br /> 
  <select class="mainForm" name="field_7" id="field_7"> 
    <option value=></option> 
    <option value="$50.00 - $80.00">$50.00 - $80.00</option> 
    <option value="$81.00 - $100.00">$81.00 - $100.00</option> 
    <option value="$100.00 - $120.00">$100.00 - $120.00</option> 
    <option value="$121.00 - $140.00">$121.00 - $140.00</option> 
    <option value="$141.00 - $150.00">$141.00 - $150.00</option> 
    <option value="$151.00 - $170.00">$151.00 - $170.00</option> 
    <option value="$171.00 - $190.00">$171.00 - $190.00</option> 
    <option value="$191.00 - $210.00">$191.00 - $210.00</option> 
    <option value="$211.00 - $230.00">$211.00 - $230.00</option> 
    <option value="$231.00 - $250.00">$231.00 - $250.00</option> 
    <option value="$251.00 - $270.00">$251.00 - $270.00</option> 
    <option value="$271.00 - $290.00">$271.00 - $290.00</option> 
    <option value="$291.00 - $310.00">$291.00 - $310.00</option> 
    <option value="$311.00 - $330.00">$311.00 - $330.00</option> 
    <option value="$331.00 - $350.00">$331.00 - $350.00</option> 
    <option value="$351.00 - $370.00">$351.00 - $370.00</option> 
    <option value="$371.00 - $390.00">$371.00 - $390.00</option> 
    <option value="$391.00 - $410.00">$391.00 - $410.00</option> 
    <option value="$411.00 - $430.00">$411.00 - $430.00</option> 
    <option value="$431.00 - $450.00">$431.00 - $450.00</option> 
    <option value="$451.00 - $470.00">$451.00 - $470.00</option> 
    <option value="$471.00 - $490.00">$471.00 - $490.00</option> 
    <option value="$491.00 - $500.00">$491.00 - $500.00</option> 
    <option value="$501.00 - $1000.00">$501.00 - $1000.00</option> 
    <option value="$1000.00 - $2000.00">$1000.00 - $2000.00</option> 
    <option value="$2000.00 - $3000.00">$2000.00 - $3000.00</option> 
    <option value="$3000.00 - $4000.00">$3000.00 - $4000.00</option> 
    <option value="$4000.00 - $5000.00">$4000.00 - $5000.00</option> 
    <option value="$5000.00 &gt;">$5000.00 &gt;</option> 
  </select> 
</p> 
<p><span class="formFieldQuestion">How Much Energy Would You Like To Replace With Solar?&nbsp;<span class="formrequired">[Required]</span></span><br /> 
  <select class="mainForm" name="field_8" id="field_8"> 
    <option value=></option> 
    <option value="10%">10%</option> 
    <option value="20%">20%</option> 
    <option value="30%">30%</option> 
    <option value="40%">40%</option> 
    <option value="50%">50%</option> 
    <option value="60%">60%</option> 
    <option value="70%">70%</option> 
    <option value="80%">80%</option> 
    <option value="90%">90%</option> 
    <option value="100%">100%</option> 
  </select> 
</p> 
<p> 
  <input type="image" src="img/2of5.png" value="Continue: 1 of 5" alt="Continue 3 of 5"/> 
</p> 
<p>&nbsp;</p> 
</body>
<html>
