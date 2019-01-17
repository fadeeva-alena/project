<?php
$sqlsessionrights = mysql_query("select * from t_provider p where p.id='".$_SESSION[WEBSITE_ALIAS]['admin_id']
."'");
$rowsessionrights = mysql_fetch_array($sqlsessionrights);
?>

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
	<p style="text-align:right;padding:0px;margin:0px;line-height:100%;">
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
	
     <strong><?php echo $_SESSION[WEBSITE_ALIAS]['admin_name']?></strong>.</p><br />
    <a href="<?php echo INDEX_PAGE; ?>users&mode=edit"  style="color:#FFFD5F;font-weight:bold;">
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
    &nbsp;&nbsp;|&nbsp;&nbsp;<a href="<?php echo INDEX_PAGE; ?>access"  style="color:#FFFD5F;font-weight:bold;"><?php echo translatefields2(819);?></a>&nbsp;&nbsp;|&nbsp;&nbsp;<!--<a href="<?php echo INDEX_PAGE; ?>my-account" style="color:#FFFD5F;font-weight:bold;">My Account</a>&nbsp;&nbsp;|&nbsp;&nbsp;--><a href="<?php echo INDEX_PAGE; ?>logout"  style="color:#FFFD5F;font-weight:bold;">
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
    
    <div id="navigation" style="width:1200;margin:0 auto;float:none;border:border:0px solid red;">
    
    
    <ul class="sf-menu" style="width:1200px;margin:0 auto;float:none;border:0px solid red;">
    
 
	
<?php if ($rowsessionrights['user_r'] == 1 or $rowsessionrights['user_w'] == 1 or $rowsessionrights['admin'] == 1){?>
<li>
<a href="#" style="border-left:#0B7BBF solid 1px;"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=706");
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
	
    <li><a href="<?php echo INDEX_PAGE; ?>events"><?php
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
	
	<li><a href="<?php echo INDEX_PAGE; ?>my-calendar-reservation"><?php echo fixEncoding(translatefields(756));?></a></li>
	<li><a href="<?php echo INDEX_PAGE; ?>calendar-reservation"><?php echo fixEncoding(translatefields(757));?></a></li>
	
</ul>
</li>	
<?php
}
if ($rowsessionrights['admin'] == 1){?>
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
<?php } ?>
	
	
<?php
	if ($rowsessionrights['user_r'] == 1 or $rowsessionrights['user_w'] == 1 or $rowsessionrights['admin'] == 1){?>

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

<?php } ?>




<?php 
	if ($rowsessionrights['user_r'] == 1 or $rowsessionrights['user_w'] == 1 or $rowsessionrights['admin'] == 1){
	?>
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

<?php }
	if ($rowsessionrights['admin'] == 1){
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
<?php } ?>

        </ul>
    </li>










	
<?php 
	if ($rowsessionrights['user_r'] == 1 or $rowsessionrights['user_w'] == 1 or $rowsessionrights['admin'] == 1){
?>	
	<li>
	<a href="#"><?php
			$sqlfield = mysql_query("select * from t_field_names where id=705");
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
	</ul>
	</li>
<?php } ?>	
  
	
	<?php
		if ($rowsessionrights['admin'] == 1){
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
	<?php }
		if ($rowsessionrights['translator'] == 1 or $rowsessionrights['admin'] == 1){
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
    <?php }
		if ($rowsessionrights['admin'] == 1){
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
	<?php }
		if ($rowsessionrights['translator'] != 1){
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
	<?php } ?>
	
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
	
	
	
	
    </ul>
    
    
    </div>
 </td>
</tr>
<tr>
<td style="background:url('images/bodybg.png') fixed;"> 
    
    <div id="content" style="border:1px solid #eeeeee;padding-bottom:20px;margin:0 auto;width:952px;">