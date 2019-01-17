<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );	
?>	
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
			$sql_text = "SELECT * from t_activity_log where provider_id='".$_GET['provider_id']."' order by activity_log_id desc";
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