<?php
	error_reporting(0);
	session_start();
	
	
?>
<?php
		$locationlist = "";
		$queryloc = mysql_query("SELECT distinct(Location),ZIP from t_zipch
				 group by Location order by Location asc");
			
		$countloc = 0;
		$numrows = mysql_num_rows($queryloc);
		if($queryloc) {
		
		while ($resultloc = mysql_fetch_assoc($queryloc)) {
		$countloc++;	
				
				$key = fixEncoding($resultloc[Location]);
				if ($countloc != $numrows){
					$locationlist .= '"'.utf8_decode($key).'",';
				}else{
					$locationlist .= '"'.utf8_decode($key).'"';
				}
			}
		}
		
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background:none;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME; ?></title>
<link rel="icon" href="images/favicon.ico" />
<link href="<?php echo CSS; ?>core.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGINS; ?>jquery/jquery.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
	
<!--<script src="<?php echo JS; ?>login.js" type="text/javascript" language="Javascript"></script>-->
<?php include ("js/login.php");?>
<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ">/*** EasyGoogleMap Class by: Mitchelle Pascual ***/</script>
<link href="plugins/jquery/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="plugins/jquery/facebox/facebox.js" type="text/javascript"></script> 
<script type="text/javascript">
    jQuery(document).ready(function($) {
		$('a[rel*=facebox]').click(function () {
		
		$('#content').attr('style','width:700px;');
		
	  })
	
      $('a[rel*=facebox]').facebox({
        loadingImage : 'plugins/jquery/facebox/loading.gif',
        closeImage   : 'plugins/jquery/facebox/closelabel.png'
      })
	  
    })
  </script>
</head>
<body style="background:none;">
<table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;">


<tr>
<style>
	a.yellowcolor{color:#FFFD5F;}
	a:hover.yellowcolor{color:#FFFD5F;text-decoration:underline;}
</style>
<td style="background:url('images/headerbg.png');border:0px solid red;height:163px;padding:0px;">
	<center><img src="images/login-for-logo.png" style="height:60px;margin-top:10px;"/></center>
	<form method="post" id="frmLogin" action="" style="padding:0px;margin:0px;">
		<div align="center" style="margin-top:0px;color:white;margin-top:10px;">
				<a href="index.php?option=login&language=1" class="yellowcolor" <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo ' style="font-weight:bold;"';}?>>De.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=login&language=2" class="yellowcolor"  <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo ' style="font-weight:bold;"';}?>>En.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=login&language=3" class="yellowcolor"  <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo ' style="font-weight:bold;"';}?>>Fr.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=login&language=4" class="yellowcolor" <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo ' style="font-weight:bold;"';}?>>It.</a>
             <label><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=198");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></b></label>
                <input class="text-field" id="username" name="username" type="text" maxlength="30" style="width:80px;"/>
				&nbsp;&nbsp;
                <label><?php
		$sqlfield = mysql_query("select * from t_field_names where id=55");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></label>
                <input class="text-field" id="password" name="password" type="password" maxlength="30" style="width:80px;" /> &nbsp;<input class="button" name="Login" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=197");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?>" />&nbsp;
				
				
                <a href="index.php?option=forgotpassword" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=201");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></a> | <a href="index.php?option=users&mode=add" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=202");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></a> | <a href="index.php?option=help" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=363");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></a> | <a href="index.php?option=login" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=325");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		?></a>
		
		</div>
			<table cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;">
				<tr>
				
					<td align="center">
						<div style="text-align:center;width:100%;margin-top:5px;"><center>
						<span id="login-indicator-msg" style="padding-top:10px;float:none;display:none;text-align:center;color:white;margin:0px;"></span></center>
						</div>
					</td>
				</tr>
			</table>
		
		
		
	</form>


</td>	
</tr>
<tr>
	<td style="background:url('images/bodybg.png') fixed;border:0px solid red;"> 
		<table width="990px" style="margin:0 auto;width:995px;background-color:white;">
	<tr>
	<td style="padding-left:10px;padding-top:5px;">
		<h1 style="margin:0px;padding:0px;"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=297");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
	?>
	<?php if ($_GET['notlogin'] == 1){?>
	<?php
$activity_log_qry = mysql_query("select * from t_activity_log where activity_log_id='".$_GET['id']."'");
$row_qry = mysql_fetch_array($activity_log_qry);
$sqlfield = mysql_query("select * from t_field_names where id=319");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$back = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$back =$rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$back =$rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$back =$rowfield['fieldname_it'];
				}
?>
	<div style="float:right;"><a href="index.php?option=login" style="font-size:14px;size:14px;">&laquo; <?php echo $back;?></a></div>
	<?php } ?>
	</h1>
	<br />
<?php
$topvalue = "
Diese Seite wurde entwickelt und wird betrieben von:<br />
DSC GmbH<br />
David Schläpfer<br />
Längistr. 12<br />
CH - 8132 Egg<br /><br />

Kontakt: <a href='mailto:technik@spiritwings.ch&subject=Spiritwings-Anfrage'>technik@spiritwings.ch</a><br/>
Tel: 044 994 73 74";
echo $topvalue = fixEncodingx($topvalue);
?><br /><br /><br />
<center>
<object width="734px" height="304">
	<param name="movie" value="images/Mitarbeiter.swf" />
	<param name="wmode" value="transparent" />
	<embed src="images/Mitarbeiter.swf"  width="734px" height="304">
	</embed>
</object>

</center>

<?php 
$bottomvalue = "<div style=padding:10px;><b><span style=font-size:15px;size:15px;>AGBs der DSC GmbH</span></b><br><br>
<span style=font-size:20px;size:20px;font-weight:bold;>".fixEncodingx(translatefields(829))."</span><br>".fixEncodingx(translatefields(828)) . "<div>";
echo $bottomvalue= fixEncodingx($bottomvalue);
?><br><br/><br/>
	
	</td>
	</tr>
	</table>
	</td>
</tr>
</table>
<table width="100%" cellpadding="0" cellspacing="0"> 
	<tr>
		<td style="background:url('images/footerbg.png');">
   
    <div id="footer" style="padding:0px;margin:0px;background:white;background-color:#3DB3F7;color:white;background-color:transparent;height:100px;margin:0 auto;width:990px;">
   	  <table cellpadding="0" cellspacing="0" width="990px" height="100px">
	<tr>
		<td valign="middle" align="left">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=364");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$leftleft = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$leftleft = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$leftleft = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$leftleft = $rowfield['fieldname_it'];
		}
			if ($leftleft != "0"){
				echo $leftleft;
			}
		?>
		</td>
		<td valign="middle" align="center">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=365");
		$rowfield = mysql_fetch_array($sqlfield);
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$leftleft = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$leftleft = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$leftleft = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$leftleft = $rowfield['fieldname_it'];
		}
			if ($leftleft != "0"){
				echo $leftleft;
			}
		?>
		</td>
		<td  valign="middle" align="right">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=366");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$middlemiddle = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$middlemiddle = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$middlemiddle = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$middlemiddle = $rowfield['fieldname_it'];
		}
		//if ($middlemiddle != "0"){
				echo $middlemiddle;
			//}
		?>
		</td>
	</tr>
	</table>
       
      </div>
	</div>
</div>
</td>
	</tr>
</table>
</body>
</html>
