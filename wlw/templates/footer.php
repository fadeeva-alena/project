		<div class="clr"></div>
	</div>
</td>
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
			$footer1 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$footer1 = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$footer1 = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$footer1 = $rowfield['fieldname_it'];
		}
			if ($footer1 != 0){
				echo $footer1;
			}
		?>
		</td>
		<td valign="middle" align="center">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=365");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$footer2 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$footer2 = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$footer2 = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$footer2 = $rowfield['fieldname_it'];
		}
		if ($footer2 != 0){
				echo $footer2;
			}
		?>
		</td>
		<td  valign="middle" align="right">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=366");
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