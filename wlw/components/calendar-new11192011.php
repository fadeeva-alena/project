<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
require ( '../'.PATH_INCLUDES.'json-headers.php' );

$quality = "";
if ($_GET['quality1'] ==1){$quality .= "1,";}
if ($_GET['quality2'] ==1){$quality .= "2,";}
if ($_GET['quality3'] ==1){$quality .= "3,";}
if ($_GET['quality4'] ==1){$quality .= "4,";}
if ($_GET['quality5'] ==1){$quality .= "5,";}

if ($quality != ""){
	$val = substr($quality, 0, -1);
	$getquality = " and e.quality in ($val)";
}
else{
	$getquality = " and e.quality in (1111111111111111111)";
}
		//check if time is set in the URL
		if(isset($_GET['time'])){
			$time = $_GET['time'];
		}
		else{
			$time = time();
		}
	
		$keyword = $_GET['keyword'];
		
		$today = date("Y/n/j", time());

		$current_month = date("n", $time);

		$current_year = date("Y", $time);

		$currentmonthtext = date('F',$time);
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
<tr>
		<td height="5px;"></td>
	</tr>
	<tr>
		<td>
			
			
			<table cellspacing="0" width="180" height="100px" class="calendar" cellspacing="3" cellpadding="3px" style="background-color:white;font-size:11px;border-collapse:collapse;border:1px solid #010102;" border="1">
				<tr style="background-color:#595A5A;color:white;height:20px;border:0px;">
					
					<td colspan="7">
						<table width="100%">
							<tr>
								<td><a style="color:white;text-decoration:none;font-size:13px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $previous_year?>" title="<?php echo $previous_year_text?>">&laquo;&laquo;</a></td>
					<td><a style="color:white;text-decoration:none;font-size:13px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $previous_month?>" title="<?php echo $previous_month_text?>">&laquo;</a></td>
					<td colspan="3" align="center"><div style="font-size:13px;font-weight:bold;">
						<?php 
							if ($currentmonthtext == "January"){
								$sqlfield = mysql_query("select * from t_field_names where id=176");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "February"){
								$sqlfield = mysql_query("select * from t_field_names where id=177");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "March"){
								$sqlfield = mysql_query("select * from t_field_names where id=178");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "April"){
								$sqlfield = mysql_query("select * from t_field_names where id=179");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "May"){
								$sqlfield = mysql_query("select * from t_field_names where id=180");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "June"){
								$sqlfield = mysql_query("select * from t_field_names where id=181");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "July"){
								$sqlfield = mysql_query("select * from t_field_names where id=182");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "August"){
								$sqlfield = mysql_query("select * from t_field_names where id=183");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "September"){
								$sqlfield = mysql_query("select * from t_field_names where id=184");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "October"){
								$sqlfield = mysql_query("select * from t_field_names where id=185");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "November"){
								$sqlfield = mysql_query("select * from t_field_names where id=186");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "December"){
								$sqlfield = mysql_query("select * from t_field_names where id=187");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}
							
							echo " " . $current_year;
						?>
					</div></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $next_month?>" title="<?php echo $next_month_text?>">&raquo;</a></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $next_year?>" title="<?php echo $next_year_text?>">&raquo;&raquo;</a></td>
							</tr>
						</table>
					</td>
					
					
												
				</tr>
				
				<tr style="font-weight:bold;font-size:11px;">
					<th width="15%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=194");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=188");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=189");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=190");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=191");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=192");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="15%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=193");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
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
								$datetocheck = "";
								echo '<td align="right" style="font-weight:bold;font-size:14px;padding-right:10px;">';
							
							$datetocheck = "$current_year-$current_month-$day";
							
							if ($_GET['location'] != "locname"){
		$locationx = $_GET['location'];
		 if ($_GET['keyword'] == ""){
			
			$sql = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') and (l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%') $getquality group by e.id";
		 }else{
			 if (isset($_SERVER['HTTP_USER_AGENT']) && 
			(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){
				$keyword = $_GET['keyword'];
			}else{
				$keyword = utf8_decode($_GET['keyword']);
			}
			$locationx = $_GET['location'];
			$sql = "SELECT e.*,e.id as eid,l.*,le.company,le.firstname,le.lastname FROM t_event e 
INNER JOIN t_dates d ON e.id=d.events_id 
inner JOIN t_location l on l.id=e.location 
inner join t_leader le ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND (e.title like '%$keyword%'
								OR e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%'
								OR le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%') 
								and (l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%') $getquality group by e.id";
					
		 }
	}else{
		if ($_GET['keyword'] == ""){
			$sql = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') $getquality group by e.id";
		 }else{
			 if (isset($_SERVER['HTTP_USER_AGENT']) && 
			(strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false)){
				$keyword = $_GET['keyword'];
			}else{
				$keyword = utf8_decode($_GET['keyword']);
			}
			$locationx = $_GET['location'];
			$sql = "SELECT *,e.id as eid FROM t_event e 
								INNER JOIN t_dates d
								ON e.id=d.events_id
								inner JOIN t_leader le
								ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								 AND (e.title like '%$keyword%'
								 OR e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%'
								OR le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%') 
								 $getquality group by e.id";
					
		 }
	}
							
							
							$sqlquery = mysql_query($sql);
							//echo mysql_num_rows($sqlquery);
								if (mysql_num_rows($sqlquery) > 0){
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