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

<h1><?php echo $page_heading?> 
<div style="float:right;"><a href="index.php?option=activity-logs" style="font-size:14px;size:14px;">&laquo; <?php echo $back;?></a></div>
</h1>

<div style="width:950px; margin: 0 auto;">
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div>
    <?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" id="frm_<?php echo $page_name; ?>" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <input type="hidden" name="activity_log_id" id="activity_log_id" value="<?php echo $activity_log_id; ?>">
		<input type="hidden" name="provider_id" id="provider_id" value="<?php echo $row_qry['provider_id']; ?>">
        
        
		<div style="float:left;width:210px;border:1px solid #666666;height:auto;margin-right:20px;" id="all_session_ids">
			<div style="height:15px;border-bottom:1px solid #eeeeee;padding-top:5px;padding-bottom:5px;background-color:#F0F0F0;border-bottom:1px solid #666666;color:#666666;">
			<?php
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
				$sqlfield = mysql_query("select * from t_field_names where id=109");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$pagelabel = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$pagelabel =$rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$pagelabel =$rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$pagelabel =$rowfield['fieldname_it'];
				}
				$sqlfield = mysql_query("select * from t_field_names where id=110");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$pageof = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$pageof =$rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$pageof =$rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$pageof =$rowfield['fieldname_it'];
				}
				
				$sqlfield = mysql_query("select * from t_field_names where id=317");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$prevlabel = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$prevlabel =$rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$prevlabel =$rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$prevlabel =$rowfield['fieldname_it'];
				}
				$sqlfield = mysql_query("select * from t_field_names where id=318");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
					$nextlabel = $rowfield['fieldname_de'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
					$nextlabel =$rowfield['fieldname_eng'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
					$nextlabel =$rowfield['fieldname_fr'];
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
					$nextlabel =$rowfield['fieldname_it'];
				}
			?>
				<div style="float:left;margin-left:10px;width:70px;"><b><?php echo $sessionid;?></b></div>
				<div style="float:left;margin-left:0px;"><b><?php echo $session_timestamp;?></b></div>
			</div>
			<?php
			
			if (isset($_POST['page']))
			{
				$page = $_POST['page'];
			}
			elseif (isset($_REQUEST['page']))
			{
				$page = $_REQUEST['page'];
			}else{
				$page = 1;
			}		
									
			$per_page =10;
			$prev_page = $page - 1;
			$next_page = $page + 1;
			$page_start = ($per_page * $page) - $per_page;
			$sql_text = "SELECT * from t_activity_log where provider_id='".$row_qry['provider_id']."' order by activity_log_id desc";
			$query = mysql_query($sql_text);
			$num_rows = mysql_num_rows($query);
			
			if(!$page)
			{
				$page =1;
			}

			if ($num_rows <= $per_page)
			{
				$num_pages = 1;	
			}
			elseif (($num_rows % $per_page) == 0)
			{
				$num_pages = ($num_rows / $per_page);
			}
			else
			{
				$num_pages = ($num_rows / $per_page) + 1;
			}
			$num_pages = (int) $num_pages;
			
			$sql_text = $sql_text . " LIMIT $page_start, $per_page"; 
			$result = mysql_query($sql_text);	
			$num = 0;
			for ($i = 1; $i <=mysql_num_rows($result); $i++)	
			{
				$row = mysql_fetch_array($result);
				$num= $num + 1;								
		?>		
			<div style="height:15px;border-bottom:1px solid #eeeeee;padding-top:5px;padding-bottom:5px;">
				<div style="float:left;margin-left:20px;width:50px;"><a href="#activity-content" style="cursor:pointer;" onclick="updateContent(<?php echo $row['activity_log_id'];?>)"><?php echo $row['session_id']?></a></div>
				<div style="float:left;margin-left:10px;"><a href="#activity-content" style="cursor:pointer;" onclick="updateContent(<?php echo $row['activity_log_id'];?>)"><?php echo $row['session_time']?></a></div>
			</div>
		<?php
			}
			
			echo '<div id="page-section" style="border-top:1px solid #666666;padding-top:3px;padding-bottom:3px;color:#666666;"><div style="float:left;font-weight:bold;margin-left:10px;">'.$pagelabel. ' '.$page.' ' . $pageof . ' '.$num_pages.'</div>
			<div style="float:right;font-size:11px;font-weight:bold;">';
			if ($prev_page)
			
			{echo '<a href="#all_session_ids" onclick="updatepage('.$prev_page.')" class="link" >'.$prevlabel.'</a> ';}
			

				//echo ' <select class="textbox" name=page onChange="document.forms[1].submit()"> ';
			//echo ' <select class="textbox" name=page> ';
			for ($i = 1; $i <= $num_pages; $i++)
			{
			if ($i != $page)
				{//echo ' <option value="'.$i.'">'.$i.'</option> ';
					{echo '';}
				}

			else
				{//echo ' <option value="'.$i.'" selected>'.$i.'</option> ';
					echo '&nbsp;' . $i . '&nbsp;';
				}
			}

			//echo '</select>';
			if ($page != $num_pages)
				{echo ' <a href="#all_session_ids" onclick="updatepage('.$next_page.')" class="link" >'.$nextlabel.'</a>&nbsp;';}
			
			echo '&nbsp;&nbsp;&nbsp;</div></div>';	
		
		?>
		</div>
		<script type="text/javascript">
		function updatepage(page) {
			$('#all_session_ids').html('&nbsp;');
			
			var provider_id = $('#provider_id').val();
			$('#all_session_ids').animate({opacity:0.5},300);
			$('#all_session_ids').animate({opacity:1},300);
			$.ajax({
			  url: "components/activity-log-pagination.php?provider_id="+provider_id+"&page="+page,
			  cache: false,
			  success: function(html){
				$("#all_session_ids").html(html);
			  }
			})
		}
		function updateContent(activity_log_id) {
			$('#activity-content').html('&nbsp;');
			$('#activity-content').animate({opacity:0.5},300);
			$('#activity_log_id').val(activity_log_id);
			$.ajax({
			  url: "components/activity-log-content-selected.php?activity_log_id="+activity_log_id,
			  cache: false,
			  success: function(html){
				$('#activity-content').animate({opacity:1},300);
				$("#activity-content").html(html);
			  }
			})
		}
		</script>
		<!--<link href="css/reports.css" rel="stylesheet" type="text/css" />-->
		<style>
			table.record-list tbody tr td {
			background:none repeat scroll 0 0 #FFFFFF;
			border:1px solid #666666;
			height:20px;
			padding:3px;
			}
			table.record-list td, table.record-list th {
			padding:4px;
			}
			table.record-list tbody tr {
			text-align:left;
			}
			table.record-list {
			border-collapse:collapse;
			color:#666666;
			}
			table.record-list thead th {
			background:none repeat scroll 0 0 #F0F0F0;
			border:1px solid #666666;
			color:#666666;
			text-align:left;
			}
			table.record-list td, table.record-list th {
			padding:4px;
			}
			.date-align { text-align: center !important; }
		</style>
		<div style="float:left;width:715px;border:0px solid red;min-height:100px;height:auto;" id="activity-content">
			<?php
				$sql = "SELECT *,al.provider_id as providerid from t_activity_log al left join t_provider p on 
al.provider_id=p.id where activity_log_id='".$_GET['id']."'";

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
							<td align="center"><?php echo $row->log_in;?></td>
							<td align="center"><?php echo $row->log_out;?></td>
							<td align="center"><?php echo $row->session_id;?></td>
							<td align="center"><?php echo $row->session_time;?></td>
							<td align="center"><?php echo $row->ip_location;?></td>
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
							<td width="140px"><?php echo fixEncoding($row_activity_content['module_name'])?></th>
							<td width="300px"><?php echo fixEncoding($row_activity_content['command'])?></th>
							<td width="140px" class="date-align"><?php echo fixEncoding($row_activity_content['command_time'])?></th>
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
		</div>
		<script src="js/jquery.print.js" type="text/javascript" language="Javascript"></script>
		<script>
			$(document).ready(function() {
				$("#print-selected").click(function(){
					$("#activity-content").printArea();
				});
				$('#export-selected').click(function () {
					var activity_log_id = $('#activity_log_id').val();
					location.href = 'components/log-export-to-excel.php?activity_log_id='+activity_log_id;
				});	
			})
		</script>
		
	<input type="hidden" name="departure" id="departure" value="" />
    </form>
</div>