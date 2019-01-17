<?php
	error_reporting(0);
session_start();
     $grid_id = $page_name;
     $target_url = INDEX_PAGE.$page_option.'-m&mode=';
     ?>
     <h1><?php echo $page_heading?></h1>
     
	 <?php
		//check if time is set in the URL
		if(isset($_GET['time'])){
			$time = $_GET['time'];
		}
		else{
			$time = time();
		}

		$today = date("Y/n/j", time());

		$current_month = date("n", $time);

		$current_year = date("Y", $time);

		$current_month_text = date("F Y", $time);

		$total_days_of_current_month = date("t", $time);

		

		//query the database for events between the first date of the month and the last of date of month
		
		
		

		$first_day_of_month = mktime(0,0,0,$current_month,1,$current_year);

		//geting Numeric representation of the day of the week for first day of the month. 0 (for Sunday) through 6 (for Saturday).
		$first_w_of_month = date("w", $first_day_of_month);

		//how many rows will be in the calendar to show the dates
		$total_rows = ceil(($total_days_of_current_month + $first_w_of_month)/7);

		//trick to show empty cell in the first row if the month doesn't start from Sunday
		$day = -$first_w_of_month;


		$next_month = mktime(0,0,0,$current_month+1,1,$current_year);
		$next_month_text = date("F \'y", $next_month);

		$previous_month = mktime(0,0,0,$current_month-1,1,$current_year);
		$previous_month_text = date("F \'y", $previous_month);

		$next_year = mktime(0,0,0,$current_month,1,$current_year+1);
		$next_year_text = date("F \'y", $next_year);

		$previous_year = mktime(0,0,0,$current_month,1,$current_year-1);
		$previous_year_text = date("F \'y", $previous_year);
	?>
	<div style="float:right;border:0px solid red;margin-top:0px;width:550px;margin-right:10px;" id="load-desc">
	
	</div>
	<script type="text/javascript">

        function toggleDiv(divid){

            var div = document.getElementById(divid);
			
            div.style.display = div.style.display == 'block' ? 'none' : 'block';

            }

	function displaydesc(datetocheck) {
		
		$('#load-desc').hide();
		$.ajax({
		  url: "components/display-events.php?datetocheck="+datetocheck,
		  cache: false,
		  success: function(html){
			
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})
	}
	</script>
	<?php
	$currentmonth = date('Y-m');
	if ($_GET['time'] !=""){
		$comparemonth = date('Y-m',$_GET['time']);
	}else{
		$comparemonth = $currentmonth;
	}
	if (($currentmonth == $comparemonth)){
?>	

	<script>
	$(document).ready(function(){
		$('#load-desc').load("components/display-events.php?datetocheck=<?php echo date('Y-m-d');?>");
	});
	</script>
<?php
	}
?>
	<table width="350" height="200px" style="font-size:11px;size:11px;margin-top:-3px;margin-left:0px;">
	<tr>
		<td height="5px;"></td>
	</tr>
	<tr>
		<td>
			
			
			<table cellspacing="0" width="350" height="200px" class="calendar" cellspacing="3" cellpadding="3px" style="background-color:white;font-size:11px;border-collapse:collapse;border:1px solid #010102;" border="1">
				<tr style="background-color:#595A5A;color:white;height:20px;border:0px;">
					
					<td colspan="7">
						<table width="100%">
							<tr>
								<td><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $previous_year?>" title="<?php echo $previous_year_text?>">&laquo;&laquo;</a></td>
					<td><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $previous_month?>" title="<?php echo $previous_month_text?>">&laquo;</a></td>
					<td colspan="3" align="center"><div style="font-size:13px;font-weight:bold;">
						<?php echo $current_month_text?>
					</div></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $next_month?>" title="<?php echo $next_month_text?>">&raquo;</a></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $next_year?>" title="<?php echo $next_year_text?>">&raquo;&raquo;</a></td>
							</tr>
						</table>
					</td>
					
					
												
				</tr>
				
				<tr style="font-weight:bold;font-size:18px;">
					<th width="15%">Sun</th>
					<th width="14%">Mon</th>
					<th width="14%">Tue</th>
					<th width="14%">Wed</th>
					<th width="14%">Thu</th>
					<th width="14%">Fri</th>
					<th width="15%">Sat</th>
				</tr>
				
				<tr>
					<?php
					for($i=0; $i< $total_rows; $i++)
					{
						for($j=0; $j<7;$j++)
						{
							$day++;					
							
							if($day>0 && $day<=$total_days_of_current_month)
							{
								
								echo '<td align="right" style="font-weight:bold;font-size:14px;padding-right:10px;">';
								if ($day <=9){
									$day1 = "0". $day;
								}
								$datetocheck = "$current_year-$current_month-$day1";
								$sqlevent = mysql_query("select * from t_event where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') ");
								if (mysql_num_rows($sqlevent) > 0){
									echo "<a style=cursor:pointer; onclick=displaydesc('".$datetocheck."')>" .$day."</a>";
								}else{
									echo $day;
								}
								
								echo "</td>";
							}
							else 
							{
								//showing empty cells in the first and last row
								echo '<td class="padding">&nbsp;</td>';
							}
						}
						echo "</tr><tr>";
					}
					
					?>
				</tr>
				
			</table>

		</td>
	</tr>
	
	</table>
	