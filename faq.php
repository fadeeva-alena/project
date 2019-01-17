<? ob_start(); ?>
<?php
session_start();

include "include/z_db.php";
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
<?php require("header.php");?>
<div id="contentIndex" class="row">
<h1>Häufige Fragen</h1>
<?php
$sql = "SELECT * FROM ts_qa_categories ";
$result=mysql_query($sql);

while ($row=mysql_fetch_array($result)) {
$i = $row['ID'];
echo"<span id='title2'>{$row['Subject']} :</span><ul>";
$sql1= "SELECT * FROM t_qa Where Subject_ID='$i' ";
$result1=mysql_query($sql1);

while ($row1=mysql_fetch_array($result1)) {

$q = a.$row1['ID'];
echo"<li>";
echo"<a href=";
echo"javascript:toggleElement('$q')>{$row1['Q']}</a>";
echo"</li>";
echo"<li id=$q style='display:none; color:#fff;'>";
echo"<div>";
echo"{$row1['A']}";
echo"</li>";
}
echo"</ul>";
}	
?>
  </div>
</div>
</body>
</html>
<? ob_flush(); ?>
