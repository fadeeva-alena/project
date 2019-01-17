<h1><?php
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
	?>
	</h1>
<div class="content-main" style="min-height:300px;height:auto;">
<?php
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){ /// for de language
	?>
		<br /><br />
	<?php 
	}
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){ /// for eng language
	?>
		<br /><br />
	<?php 
	}
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){ /// for fr language
	?>
		<br /><br />
	<?php 
	}
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){ /// for it language
	?>
		<br /><br />
	<?php }?>

</div>   	
    
