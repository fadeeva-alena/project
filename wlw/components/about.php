<h1><?php
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
<div class="content-main" style="height:auto;">
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
$bottomvalue = "<b><span style=font-size:15px;size:15px;>AGBs der DSC GmbH</span></b><br><br>
<span style=font-size:20px;size:20px;font-weight:bold;>".fixEncodingx(translatefields(829))."</span><br>".fixEncodingx(translatefields(828));
echo $bottomvalue= fixEncodingx($bottomvalue);
?><br><br/>
</div>   	
    
