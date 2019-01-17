<?php
include "include/session.php";

include "include/z_db.php";
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Settings2</title>
<link href="style.css" rel="stylesheet" type="text/css" />
<script src="SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>
<link href="SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
</head>

<body class="all">

<div id="container">
  <div class="header">
    <h1><font color="#FF0000">Mani</font><font color="#0000FF">Mano</font></h1>
	<?php
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
	<input type=button value="Logout" onclick=location.href="index.php" id="logoutbtn">
	<input type=button value="Meine Daten" id="maindatbtn">
	<input type=button value="Suche" onclick=location.href="search.php" id="maindatbtn">
	<input type=button value="Hilfe" onclick=location.href="help.php" id="helpbtn2">
  </div>
  <div class="mainContent">
	<div class="content">
		<span id="title">2) Zeitliche Verfügbarkeit: </span>
	  <table width="800" border="0" cellspacing="0" cellpadding="0">
	    <tr>
	      <td width="435"><label id="smal">aktiver Zeitplan:
	          <input name="zitplan" type="text" id="zitplan" value="Grundzeitplan" />
	      </label>
            <div id="TabbedPanels1" class="TabbedPanels">
              <ul class="TabbedPanelsTabGroup">
                <li class="TabbedPanelsTab" tabindex="0">Grundzeitplan</li>
                <li class="TabbedPanelsTab" tabindex="0">temporarer Zeitplan</li>
              </ul>
              <div class="TabbedPanelsContentGroup">
                <div class="TabbedPanelsContent">
                  <p>&nbsp;</p>
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="23%"><img src="images/image00812.png" width="293" height="50" /></td>
                    </tr>
                    <tr>
                  
   <td><img src="images/image00822.png" width="79" height="232" align="left" />
<?PHP 
                   if ($row['monday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                              <?php
if ($row['monday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
<?php
if ($row['monday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                           <?php
if ($row['monday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>

                    </tr>
                  </table>
                </div>
                <div class="TabbedPanelsContent">
                  <p>
                    <label>Start:
                      <input type="text" name="start" id="start" Value=<?php echo"$row[temp_sched_from]"; ?> />
                    </label>
                    <label>Ende:
                      <input type="text" name="ende" id="ende" Value=<?php echo"$row[temp_sched_to]"; ?> />
                    </label>
                  </p>
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td width="23%"><img src="images/image00812.png" alt="1" width="293" height="50" /></td>
                    </tr>
                    <tr>
                      <td><img src="images/image00822.png" alt="2" width="79" height="232" align="left" />
                        <?PHP 
                   if ($row['monday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][0] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][1] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                              <?php
if ($row['monday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][2] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
<?php
if ($row['monday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][3] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][4] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][5] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][6] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][7] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][8] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                           <?php
if ($row['monday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][9] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                                <?php
if ($row['monday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][10] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>
                        <br />
                                               <?php
if ($row['monday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}

                        if ($row['tuesday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['wednesday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['thursday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['friday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                               if ($row['saturday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
                                                if ($row['sunday_t'][11] == 1){                        
echo"<input type='checkbox' name='flag1' value='flag' checked   >";
}else{
echo"<input type='checkbox' name='flag1' value='flag'  >";

}
?>


                    </tr>
                  </table>
                </div>
              </div>
          </div></td>
	      <td width="365"><br /><img src="images/image0083.png" width="351" height="336" /></td>
        </tr>
      </table>
      <p><input type="button" name="nextbtn" id="nextbtn" value="Weiter zum Angebotsprofil (3 von 5)" onclick=location.href="settings3.php" /></p>
	</div>
  </div>
</div>
<script type="text/javascript">
<!--
var TabbedPanels1 = new Spry.Widget.TabbedPanels("TabbedPanels1");
//-->
</script>
</body>
</html>
