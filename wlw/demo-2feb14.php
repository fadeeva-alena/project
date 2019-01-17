<?php
error_reporting(0);
session_start();
require_once ( 'includes/config.php' );
require_once ( 'libraries/libraries.php' );

$sqllang = mysql_query("select * from t_provider where id='".$_GET['provider_id']."'");
$rowlang = mysql_fetch_array($sqllang);
$_SESSION['art']['language'] = $rowlang['language'];
?>
<script type="text/javascript" src="jscolor.js"></script>
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color:white;background:url('none');">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<meta http-equiv="content-type" content="text/html; charset=UTF-8">-->
<title>Admin Panel</title>
<link rel="icon" href="images/favicon.ico" />
<link href="css/core.css" rel="stylesheet" type="text/css" />
<script src="plugins/jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<style>
table,body,tr,td{
	font-family:arial;
	font-size:11px;
	size:11px;
}
table.form-table td {
    padding: 3px;
}
table.form-table td.key {
    background: none repeat scroll 0 0 #EFEFEF;
    border-bottom: 1px solid #E9E9E9;
    border-right: 1px solid #E9E9E9;
    color: #333333;
    font-weight: bold;
    text-align: right;
    width: 140px;
}
table.form-table td.key-r {
    border-right: 1px solid #E9E9E9;
    color: #333333;
    font-weight: bold;
    text-align: right;
    width: 140px;
}
table.form-table .key-vtop {
    vertical-align: top;
}
table.form-table td.key.vtop {
    vertical-align: top;
}
table.form-table td.td-spaces {
    width: 30px;
}
body{margin:0px;}
</style>
</head>
<body>
<div id="content">
<table class="form-table" style="width:700px;">
<script>
$().ready(function() {
	$('#width').blur(function ()	{
		var width = $('#width').val();
		if (width < 480){
			alert("Die untere Grenze für die Breite ist 480pixel.");
			$('#width').val('480');
		}	
	});
	$('#height').blur(function ()	{
		var height = $('#height').val();
		if (height < 200){
			alert("Die untere Grenze für die Höhe ist 200pixel.");
			$('#height').val('1000');
		}	
	});
})
</script>
<tr>
	<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=465");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><div style="float:left;"><input type="text" maxlength="3" id="width"  value="520" /> </div>
						
						</td>

					</tr>
<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=464");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><div style="float:left;"><input type="text" maxlength="4" id="height"  value="1000" /> </div>
						
						</td>

					</tr>


<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=459");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><div style="float:left;"><input type="text" readonly="readonly" id="text_color" class="color" value="000000" /> </div>
						
						</td>

					</tr>
					
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=460");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><div style="float:left;"><input type="text" readonly="readonly" id="background_color" class="color" value="FFFFFF" /> </div>
						
						</td>

					</tr>
					
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=462");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><div style="float:left;"><input type="text" readonly="readonly" id="title_bg_color" class="color" value="CCCCCC"/> </div>
						
						</td>

					</tr>
					
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=461");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><div style="float:left;"><input type="text" readonly="readonly" id="tablegrid" class="color" value="CCCCCC"/> </div>
						
						</td>

					</tr>
		
		
				<tr>
					<td></td>
					<td>
					<?php
		$sqlfield = mysql_query("select * from t_field_names where id=463");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		$update = $rowfield['fieldname_de'];
		}elseif ($_SESSION['art']['language'] ==2){
		$update = $rowfield['fieldname_eng'];
		}elseif ($_SESSION['art']['language'] ==3){
		$update = $rowfield['fieldname_fr'];
		}elseif ($_SESSION['art']['language'] ==4){
		$update = $rowfield['fieldname_it'];
		}
		?>
						<input type="button" id="updatecolors" value="<?php echo $update;?>" />
					</td>
				</tr>
		<script>
		$(document).ready(function() {
		$('#updatecolors').click(function () {
			var width = $('#width').val();
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event-from-provider.php?provider_id=<?php echo $_GET['provider_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
		});
		})
		</script>
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=458");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION['art']['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION['art']['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION['art']['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION['art']['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> </label></td>
						
						<td><textarea cols="60" rows="4" id="iframecontents"><iframe width="520px" height="1000px" src="http://manimano.ch/wlw/display-event-from-provider.php?provider_id=<?php echo $_GET['provider_id'];?>&titlecolor=000000&bgcolor=FFFFFF&titlebgcolor=CCCCCC&tablegrid=CCCCCC&width=520&height=1000" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe></textarea>
						</td>
						
					</tr>
		</table>
		</div>
	</body>
</html>