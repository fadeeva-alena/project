<?php
error_reporting(0);
session_start();
require_once ( 'includes/config.php' );
require_once ( 'libraries/libraries.php' );

$sqllang = mysql_query("select * from t_event e inner join t_provider p on p.id=e.provider where e.id='".$_GET['events_id']."'");
$rowlang = mysql_fetch_array($sqllang);
$_SESSION['art']['language'] = $rowlang['language'];

/* checking the frame settings here */
$iframesettings = mysql_query("select * from t_iframe_settings where frame_id=0 and provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");

	
if (mysql_num_rows($iframesettings) > 0){
	$rowsettings = mysql_fetch_array($iframesettings);
	$iframe_width = $rowsettings['width'];
	$iframe_height = $rowsettings['height'];
	$iframe_titlecolor = $rowsettings['titlecolor'];
	$iframe_bgcolor = $rowsettings['bgcolor'];
	$iframe_tablegrid = $rowsettings['tablegrid'];
	$iframe_titlebgcolor = $rowsettings['titlebgcolor'];
}else{
$iframesettings2 = mysql_query("select * from t_iframe_settings where frame_id=0 and provider_id=''");
	$rowsettings = mysql_fetch_array($iframesettings2);
	$iframe_width = $rowsettings['width'];
	$iframe_height = $rowsettings['height'];
	$iframe_titlecolor = $rowsettings['titlecolor'];
	$iframe_bgcolor = $rowsettings['bgcolor'];
	$iframe_tablegrid = $rowsettings['tablegrid'];
	$iframe_titlebgcolor = $rowsettings['titlebgcolor'];
}
	

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
body{margin:0px;background:none;}
</style>
</head>
<body style="background-color:white;">
<div id="content">
<table class="form-table" style="width:500px;">

<tr>
	<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=445");
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
						
						<td width=70px><div style="float:left;"><input type="text" style="width:60px;"  maxlength="3" id="width"  value="<?php echo $iframe_width;?>" /> </div>
			<?php
		$sqlfield = mysql_query("select * from t_field_names where id=445");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?>
<!--<script>
						$(document).ready(function() {
							$('#width').focus(function () {
								$('#textwidth').show();
								$('#textwidth').html('<?php echo $helptext;?>');
							});
							$('#width').blur(function () {
								$('#textwidth').hide();
								$('#textwidth').html('');
							});
						})
						</script>-->
						<div style="display:none;float:right;width:150px;z-index:10000;position:absolute;margin-left:160px;margin-top:0px;border:0px solid red;" id="textwidth"></div>			
						</td>
						<td rowspan=6 valign="top" align="left" style="border:0px solid red;">
					<?php
		$sqlfield = mysql_query("select * from t_field_names where id=502");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		echo $helptext;
		?>
					</td>
					</tr>
<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=444");
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
						
						<td><div style="float:left;"><input type="text" style="width:60px;"  maxlength="3" id="height"  value="<?php echo $iframe_height;?>" /> </div>
					<?php
		$sqlfield = mysql_query("select * from t_field_names where id=444");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?>
<!--<script>
						$(document).ready(function() {
							$('#height').focus(function () {
								$('#textheight').show();
								$('#textheight').html('<?php echo $helptext;?>');
							});
							$('#height').blur(function () {
								$('#textheight').hide();
								$('#textheight').html('');
							});
						})
						</script>-->
						<div style="display:none;float:right;width:150px;z-index:10000;position:absolute;margin-left:160px;margin-top:0px;border:0px solid red;" id="textheight"></div>			
						</td>

					</tr>


<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=439");
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
						
						<td><div style="float:left;"><input type="text" style="width:60px;"  readonly="readonly" id="text_color" class="color" value="<?php echo $iframe_titlecolor;?>" /> </div>
					<?php
		$sqlfield = mysql_query("select * from t_field_names where id=439");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?>
<!--<script>
						$(document).ready(function() {
							$('#text_color').focus(function () {
								$('#texttext_color').show();
								$('#texttext_color').html('<?php echo $helptext;?>');
							});
							$('#text_color').blur(function () {
								$('#texttext_color').hide();
								$('#texttext_color').html('');
							});
						})
						</script>-->
						<div style="display:none;float:right;width:150px;z-index:10000;position:absolute;margin-left:160px;margin-top:0px;border:0px solid red;" id="texttext_color"></div>		
						</td>

					</tr>
					
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=440");
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
						
						<td><div style="float:left;"><input type="text" style="width:60px;"  readonly="readonly" id="background_color" class="color" value="<?php echo $iframe_bgcolor;?>" /> </div>

<?php
		$sqlfield = mysql_query("select * from t_field_names where id=440");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?>
<!--<script>
						$(document).ready(function() {
							$('#background_color').focus(function () {
								$('#textbackground_color').show();
								$('#textbackground_color').html('<?php echo $helptext;?>');
							});
							$('#background_color').blur(function () {
								$('#textbackground_color').hide();
								$('#textbackground_color').html('');
							});
						})
						</script>-->
						<div style="display:none;float:right;width:150px;z-index:10000;position:absolute;margin-left:160px;margin-top:0px;border:0px solid red;" id="textbackground_color"></div>
						
						</td>

					</tr>
					
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=442");
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
						
						<td><div style="float:left;"><input type="text" style="width:60px;"  readonly="readonly" id="title_bg_color" class="color" value="<?php echo $iframe_titlebgcolor;?>"/> </div>

<?php
		$sqlfield = mysql_query("select * from t_field_names where id=442");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?>
<!--<script>
						$(document).ready(function() {
							$('#title_bg_color').focus(function () {
								$('#textbgcolor').show();
								$('#textbgcolor').html('<?php echo $helptext;?>');
							});
							$('#title_bg_color').blur(function () {
								$('#textbgcolor').hide();
								$('#textbgcolor').html('');
							});
						})
						</script>-->
						<div style="display:none;float:right;width:150px;z-index:10000;position:absolute;margin-left:160px;margin-top:0px;border:0px solid red;" id="textbgcolor"></div>
						
						</td>

					</tr>
					
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=441");
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
						
						<td><div style="float:left;"><input type="text" style="width:60px;"  readonly="readonly" id="tablegrid" class="color" value="<?php echo $iframe_tablegrid;?>"/> </div>

<?php
		$sqlfield = mysql_query("select * from t_field_names where id=441");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?>
<!--<script>
						$(document).ready(function() {
							$('#tablegrid').focus(function () {
								$('#texttablegrid').show();
								$('#texttablegrid').html('<?php echo $helptext;?>');
							});
							$('#tablegrid').blur(function () {
								$('#texttablegrid').hide();
								$('#texttablegrid').html('');
							});
						})
						</script>-->
						<div style="display:none;float:right;width:150px;z-index:10000;position:absolute;margin-left:160px;margin-top:0px;border:0px solid red;" id="texttablegrid"></div>
						
						</td>

					</tr>
		
		
				<tr>
					<td></td>
					<td colspan="2">
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
		
		function selectElementText(element) {
			document.getElementById(element).focus();
			document.getElementById(element).select();
		}
		
		$(document).ready(function() {
		
	
		$('#updatecolors').click(function () {
			//alert("a");
			selectElementText('iframecontents');
		
			var width = $('#width').val();
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
			
			$('#previewcontent').html('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
			
		});
		
		$('#text_color').blur(function () {
			var width = $('#width').val();
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
		});
		
		$('#background_color').blur(function () {
			var width = $('#width').val();
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
		});
		
		$('#title_bg_color').blur(function () {
			var width = $('#width').val();
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
		});
		
		$('#tablegrid').blur(function () {
			var width = $('#width').val();
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
		});
		
		$('#width').blur(function () {
		
			var width = $('#width').val();
			if (width < 480){
			alert("Die untere Grenze für die Breite ist 480pixel.");
			$('#width').val('480');
		}else{	
			var height = $('#height').val();
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
			}
		});
		
		$('#height').blur(function () {
			var width = $('#width').val();
			var height = $('#height').val();
			if (height < 200){
				alert("Die untere Grenze für die Höhe ist 200pixel.");
				$('#height').val('200');
			}else{	
			var text_color = $('#text_color').val();
			var background_color = $('#background_color').val();
			var title_bg_color = $('#title_bg_color').val();
			var tablegrid = $('#tablegrid').val();
			$.ajax({
				url: "update-iframe-settings.php?frame_id=0&width="+width+"&height="+height+"&titlecolor="+text_color+"&bgcolor="+background_color+"&titlebgcolor="+title_bg_color+"&tablegrid="+tablegrid,
				cache: false,
				success: function(html){
					//alert(html);	
				}
			});
			
			$('#iframecontents').val('<iframe width="'+width+'px" height="'+height+'px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor='+text_color+'&bgcolor='+background_color+'&titlebgcolor='+title_bg_color+'&tablegrid='+tablegrid+'&width='+width+'&height='+height+'" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>');
			}
		});
		
		})
		</script>
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=438");
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
						
						<td  colspan="2">

<textarea cols="60" rows="4" id="iframecontents"><iframe width="<?php echo $iframe_width;?>px" height="<?php echo $iframe_height;?>px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor=<?php echo $iframe_titlecolor;?>&bgcolor=<?php echo $iframe_bgcolor;?>&titlebgcolor=<?php echo $iframe_titlebgcolor;?>&tablegrid=<?php echo $iframe_tablegrid;?>&width=<?php echo $iframe_width;?>&height=<?php echo $iframe_height;?>" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe></textarea>
						</td>
						
					
		</table>
		<table>
			</tr>
			<tr>
				<td colspan="2" id="previewcontent">
					<iframe width="<?php echo $iframe_width;?>px" height="<?php echo $iframe_height;?>px" src="http://manimano.ch/wlw/display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor=<?php echo $iframe_titlecolor;?>&bgcolor=<?php echo $iframe_bgcolor;?>&titlebgcolor=<?php echo $iframe_titlebgcolor;?>&tablegrid=<?php echo $iframe_tablegrid;?>&width=<?php echo $iframe_width;?>&height=<?php echo $iframe_height;?>" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>
				</td>
			</tr>
		</table>
		</div>
	</body>
</html>