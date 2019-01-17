<?php
$j="";
if ( $_POST ) 

{
$errors = "";  
if(isset($_POST['field_1_option_']) or isset($_POST['field_1_option_2'])  or isset($_POST['field_1_option_3']) or isset($_POST['field_1_option_4']))
{
}else{
$errors .= "Field 1 is required".$_post['qw']  ;  
}


if ($_post['qw']=='Residential')

{
$errors .= "Field 2 is required";  
}


if ($_post['field_3']=="")

{
}else
{
$errors .= $_post['field_3'];  
}


if ($errors=="")
{
header("location:form2.php");
$j="";

}else{
$j=$errors;
echo "<script language = 'javascript'>";
echo "alert('$j')";
echo "</script>" ;
}

}






?>
<html xmlns="http://www.w3.org/1999/xhtml (this link goes outside odesk.com)"> 
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<title>Untitled Document</title> 
</head> 

<body> 
<p>Page 1</p> 
<form method="post"   id="form1" name="Form1" action="form1.php">
<p><span class="formtext1">1.) Choose The Type(s) of Solar Project You Would Like A Free Estimate On:<br /> 
  <span class="formrequired">[Required] </span></span> </p> 
<p> 
  <input class="mainForm" type="checkbox" name="field_1_option_" id="field_1_option_3" value="Solar PV (Solar Panels)" /> 
  <span class="formtext1">Solar PV (Solar Panels)</span><span class="formFieldOption"> <br /> 
  <input class="mainForm" type="checkbox" name="field_1_option_2" id="field_1_option_2" value="Solar Thermal Hot Water" /> 
  </span><span class="formtext1">Solar Thermal Hot Water<br /> 
  <input class="mainForm" type="checkbox" name="field_1_option_3" id="field_1_option_1" value="Solar Thermal Pool Heating" /> 
  Solar Thermal Pool Heating <br /> 
  <input class="mainForm" type="checkbox" name="field_1_option_4" id="field_1_option_4" value="Wind Turbines" /> 
  Wind Turbine </span></p> 
<p>2.) Type of Project:&nbsp;[Required]<br /> 
  <select name="qw" id="qw"> 
    <option ></option> 
    <option selected>Residential</option> 
    <option>Commercial</option> 
  </select> 
</p> 
<p><span class="formFieldQuestion"><span class="formtext1">3.) City:&nbsp;</span><span class="formrequired">[Required]</span></span><br /> 
  <span class="formFieldQuestion"> 
  <input name="field_3" type="text" class="mainForm" id="field_3" size="30" maxlength="255" /> 
</span></p> 
<p><span class="formFieldQuestion"> 
  <span class="formtext1">4.) State:</span><span class="formrequired">&nbsp;[Required]</span><br /> 
  <select class="mainForm" name="field_4" id="field_4"> 
    <option value= selected="selected"> </option> 
    <option value="Alabama">Alabama</option> 
    <option value="Alaska">Alaska</option> 
    <option value="Arizona">Arizona</option> 
    <option value="Arkansas">Arkansas</option> 
    <option value="California">California</option> 
    <option value="Colorado">Colorado</option> 
    <option value="Connecticut">Connecticut</option> 
    <option value="Delaware">Delaware</option> 
    <option value="Florida">Florida</option> 
    <option value="Georgia">Georgia</option> 
    <option value="Hawaii">Hawaii</option> 
    <option value="Idaho">Idaho</option> 
    <option value="Illinois">Illinois</option> 
    <option value="Indiana">Indiana</option> 
    <option value="Iowa">Iowa</option> 
    <option value="Kansas">Kansas</option> 
    <option value="Kentucky">Kentucky</option> 
    <option value="Louisiana">Louisiana</option> 
    <option value="Maine">Maine</option> 
    <option value="Maryland">Maryland</option> 
    <option value="Massachusetts">Massachusetts</option> 
    <option value="Michigan">Michigan</option> 
    <option value="Minnesota">Minnesota</option> 
    <option value="Mississippi">Mississippi</option> 
    <option value="Missouri">Missouri</option> 
    <option value="Montana">Montana</option> 
    <option value="Nebraska">Nebraska</option> 
    <option value="Nevada">Nevada</option> 
    <option value="New Hampshire">New Hampshire</option> 
    <option value="New Jersey">New Jersey</option> 
    <option value="New Mexico">New Mexico</option> 
    <option value="New York">New York</option> 
    <option value="North Carolina">North Carolina</option> 
    <option value="North Dakota">North Dakota</option> 
    <option value="Ohio">Ohio</option> 
    <option value="Oklahoma">Oklahoma</option> 
    <option value="Oregon">Oregon</option> 
    <option value="Pennsylvania">Pennsylvania</option> 
    <option value="Rhode Island">Rhode Island</option> 
    <option value="South Carolina">South Carolina</option> 
    <option value="South Dakota">South Dakota</option> 
    <option value="Tennessee">Tennessee</option> 
    <option value="Texas">Texas</option> 
    <option value="Utah">Utah</option> 
    <option value="Vermont">Vermont</option> 
    <option value="Virginia">Virginia</option> 
    <option value="Washington">Washington</option> 
    <option value="West Virginia">West Virginia</option> 
    <option value="Wisconsin">Wisconsin</option> 
    <option value="Wyoming">Wyoming</option> 
  </select> 
</span></p> 
<p><span class="formFieldQuestion"> 
  <span class="formtext1">5.) Zip Code:&nbsp;</span><span class="formrequired">[Required]</span><br /> 
  <input name="field_5" type="text" class="mainForm" id="field_5" size='10' maxlength="10" /> 
</span></p> 
<p> 

     
  <input type="image" src="img/1of5.png" name="test" id="test" value="Continue" alt="Continue 1 of 5"/> 
    <input type="submit" >

</p> 
<p>&nbsp;</p> 
</form>
</body>
<html>
