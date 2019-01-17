<?php
error_reporting(0);
session_start();
?>
<script type="text/javascript" language="javascript" src="js/jquery.tablePagination.0.2.min.js"></script>
<script language="javascript">
	$(document).ready(function() {
	$('.record-list2').tablePagination({
				currPage : 1, 
				ignoreRows : $('tbody tr:odd', $('.tbl_news')),
				optionsForRows : [10,50,20,50],
				rowsPerPage : 10,
				firstArrow: (new Image()).src="",
				lastArrow : (new Image()).src="",
				prevArrow : (new Image()).src="images/prev.jpg",
				nextArrow : (new Image()).src="images/next.jpg"
            });
	})
</script>
<style>
	#tablePagination { margin-top: 15px; }
	#tablePagination_paginater { float: right; }
</style>
<?php
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

				$sql = "SELECT *,al.provider_id as providerid from t_activity_log al left join t_provider p on 
al.provider_id=p.id where activity_log_id='".$_GET['activity_log_id']."'";

				$sqlfield = mysql_query("select * from t_field_names where id=306");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$provider = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$provider =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$provider =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$provider =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=307");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$login = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$login =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$login =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$login =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=308");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$logout = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$logout =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$logout =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$logout =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=309");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$sessionid = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$sessionid =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$sessionid =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$sessionid =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=310");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$session_timestamp = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$session_timestamp =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$session_timestamp =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$session_timestamp =$rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=311");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$ipaddress = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$ipaddress =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$ipaddress =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$ipaddress =$rowfield['fieldname_it'];
		}

		$sqlfield = mysql_query("select * from t_field_names where id=312");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$module = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$module =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$module =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$module =$rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=313");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$command = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$command =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$command =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$command =$rowfield['fieldname_it'];
		}


				$result = $db->get_results($sql);
				if ($result)
				{
					foreach ($result as $row)
					{
					?>
						<table class="record-list" width="100%" border="0" cellpadding="3">
						<thead>	
						<tr>
							<th style="background-color:#0B7BBF;color:white;" width="140"><?php echo fixEncoding($provider);?></th>
							<th style="background-color:#0B7BBF;color:white;" width="120px" class="date-align"><?php echo fixEncoding($login);?></th>
							<th style="background-color:#0B7BBF;color:white;" width="120px" class="date-align"><?php echo fixEncoding($logout);?></th>
							<th style="background-color:#0B7BBF;color:white;" width="50px" class="date-align"><?php echo fixEncoding($sessionid);?></th>
							<th style="background-color:#0B7BBF;color:white;" width="120px" class="date-align"><?php echo fixEncoding($session_timestamp);?></th>
							<th style="background-color:#0B7BBF;color:white;" width="70px" class="date-align"><?php echo fixEncoding($ipaddress);?></th>
						</tr>
						</thead>
						<tbody>
						<tr>
						   <td align="left"><?php echo fixEncoding($row->firstname . " " . $row->lastname); ?></td>
							<td align="center"><?php echo fixEncoding($row->log_in);?></td>
							<td align="center"><?php echo fixEncoding($row->log_out);?></td>
							<td align="center"><?php echo fixEncoding($row->session_id);?></td>
							<td align="center"><?php echo fixEncoding($row->session_time);?></td>
							<td align="center"><?php echo fixEncoding($row->ip_location);?></td>
						</tr>
						</tbody>
						</table>
						<?php
						
						$sql_activity_content = mysql_query("select * from t_activity_log_content where session_id='".$row->session_id."'");
						//echo mysql_num_rows($sql_activity_content);
						if (mysql_num_rows($sql_activity_content) > 0){
						?>
						<table class="record-list" style="margin-top:20px;" width="715px" border="0">
						<thead>	
						<tr>
							<th width="140px"><?php echo fixEncoding($module);?></th>
							<th width="400px"><?php echo fixEncoding($command);?></th>
							<th width="140px" class="date-align"><?php echo fixEncoding($session_timestamp);?></th>
							
						</tr>
						</thead>
						<tbody>
						<?php
							
							while ($row_activity_content = mysql_fetch_array($sql_activity_content)){
						?>
						<tr>
							<td width="140px"><?php echo $row_activity_content['module_name']?></th>
							<td width="300px"><?php echo $row_activity_content['command']?></th>
							<td width="140px" class="date-align"><?php echo $row_activity_content['command_time']?></th>
						</tr>
						<?php
							}
						?>
						</tbody>
						</table>
						<?php
						}
					}
				}
			?>