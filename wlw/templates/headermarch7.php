<tr>
<td style="background:url('images/headerbg.png');">
<div id="header1" style="height:163px;padding-right:7px;background-color:transparent;width:1000px;margin:0 auto;color:white;">
	
    <img src="images/header-logo.png" style="padding-top:80px;padding-left:10px;"/>
    
    <div id="logged-user" style="padding-bottom:5px;">
    <div style="float:right;font-weight:bold;font-color:#FFFD5F;color:#FFFD5F;font-size:19px;margin-bottom:10px;"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=267");
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
	?></div><br style="clear:both;">
	<?php
		$sqlfield = mysql_query("select * from t_field_names where id=76");
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
     <strong><?php echo $_SESSION[WEBSITE_ALIAS]['admin_name']?></strong>.
    &nbsp;&nbsp;<a href="<?php echo INDEX_PAGE; ?>users&mode=edit"  style="color:#FFFD5F;font-weight:bold;">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=299");
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
    &nbsp;&nbsp;|&nbsp;&nbsp;<!--<a href="<?php echo INDEX_PAGE; ?>my-account" style="color:#FFFD5F;font-weight:bold;">My Account</a>&nbsp;&nbsp;|&nbsp;&nbsp;--><a href="<?php echo INDEX_PAGE; ?>logout"  style="color:#FFFD5F;font-weight:bold;">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=77");
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
	</a> </div>
    
    
    </div>
 </td>
</tr>
<tr>
<td style="background:url('images/menubar.png');">
    
    <div id="navigation" style="width:1300;margin:0 auto;float:none;border:border:0px solid red;">
    
    
    <ul class="sf-menu" style="width:1300px;margin:0 auto;float:none;border:0px solid red;">
    
    <!--<li class="current"><a href="<?php echo INDEX_PAGE; ?>home"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=79");
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
	?></a></li>-->
	
<?php
	if ($_SESSION[WEBSITE_ALIAS]['user_level'] != 4){
	?>
    <li><a href="<?php echo INDEX_PAGE; ?>events" style="border-left:#0B7BBF solid 1px;"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=80");
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
	?></a></li>
    
    <li><a href="<?php echo INDEX_PAGE; ?>locations"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=81");
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
	?></a></li>
    <li><a href="<?php echo INDEX_PAGE; ?>leaders"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=82");
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
	?></a></li>	
	
	<?php
	if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
	/*
	
     INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('646', 'Receive request', ' Es ist ein Gesuch um Übernahme von Datensätzen eingegangen', 'You receive a request to take over the administration of records', 'You receive a request to take over the administration of records', 'You receive a request to take over the administration of records', 'You receive a request to take over the administration of records', 'You receive a request to take over the administration of records', 'You receive a request to take over the administration of records', 'You receive a request to take over the administration of records', '11');
	 
     INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('647', 'Acceptance content', 'Wir haben Ihnen die folgenden Datensätze übergeben:', 'we passed ownership of the following records to You', 'we passed ownership of the following records to You', 'we passed ownership of the following records to You', 'we passed ownership of the following records to You', 'we passed ownership of the following records to You', 'we passed ownership of the following records to You', 'we passed ownership of the following records to You', '11');
	 
     INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('648', 'Denial content.', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', 'Wir haben Ihnen die folgenden Datensätze aus dem folgendem Grund nicht übergeben: <br> %reason% <br>', '11');
	 
	 INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('649', 'Email handover footer', 'Mit freundlichem Gruss, <br>
Ihr Spiritwings-Team', 'best regards,<br> Spiritwings Team', 'best regards,<br> Spiritwings Team', 'best regards,<br> Spiritwings Team', 'best regards,<br> Spiritwings Team', 'best regards,<br> Spiritwings Team', 'best regards,<br> Spiritwings Team', 'best regards,<br> Spiritwings Team', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('650', 'Email handover/takeover link for website', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', 'Um die Änderungsanträge zu behandeln, klicken Sie bitte <a>http://www.spiritwings.ch</a>.', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('670', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('672', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', 'Calendar Hover', '11');
	*/
	?>
<li><a href="#"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=611");
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
        <ul>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>unified-events"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=605");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>unified-leaders"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=610");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>unified-locations"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=619");
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
</li>
        </ul>
    </li>







<li><a href="#"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=620");
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
        <ul>
<?php if ($_SESSION[WEBSITE_ALIAS]['user_level'] != 1){?>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-events"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=621");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-leaders"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=622");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-locations"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=623");
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
</li>
<?php } else{
?>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-events-request"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=624");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-leaders-request"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=625");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-locations-request"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=626");
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
</li>
<?php
}?>
        </ul>
    </li>










	
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>providers"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=29");
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
	</li>
	
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>events-kind"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=358");
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
	</li>
	
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>events-type"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=359");
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
	</li>
	
    <?php
	  }
	  ?>
<?php if ($_SESSION[WEBSITE_ALIAS]['user_level'] != 1){?>	  
	  
	  
	  <li><a href="#"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=620");
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
        <ul>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-events"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=621");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-leaders"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=622");
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
</li>
<li class="current"><a href="<?php echo INDEX_PAGE; ?>handover-locations"><?php
    $sqlfield = mysql_query("select * from t_field_names where id=623");
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
</li>
        </ul>
    </li>
	<?php
	}
	?>
	  
	  
	  
	  <?php
	 }
	?>
<?php
	if (($_SESSION[WEBSITE_ALIAS]['user_level'] == 1) or ($_SESSION[WEBSITE_ALIAS]['user_level'] == 4)){
	?>
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>translations"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=348");
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
	</li>
    <?php
	  }
	?>
	
	<?php
	if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1){
	?>
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>activity-logs"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=303");
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
	</li>
	<?php
	}
	?>
	
	<li class="current">
	<a href="index.php?option=events-calendar"><img src="images/calendar.gif" width="12px" border="0"/>
						<?php
		$sqlfield = mysql_query("select * from t_field_names where id=266");
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
	</li>
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>help"><?php
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
	?></a>
	</li>
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>about"><?php
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
	?></a>
	</li>
	
	<?php
	if ($_SESSION[WEBSITE_ALIAS]['user_level'] != 1){
	?>
	
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>users&mode=edit"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=299");
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
	</li>
	<?php
	}else{
	?>
	<li class="current"><a href="<?php echo INDEX_PAGE; ?>feedbackapproval"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=689");
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
	</li>
	<?php
	}
	?>
	
    </ul>
    
    
    </div>
 </td>
</tr>
<tr>
<td style="background:url('images/bodybg.png') fixed;"> 
    
    <div id="content" style="border:1px solid #eeeeee;padding-bottom:20px;margin:0 auto;width:952px;">