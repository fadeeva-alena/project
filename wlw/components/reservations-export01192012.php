<?php
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
error_reporting(0);
session_start();

$dateid = $_GET['date_id'];
	 $getnum = mysql_query("select *,d.id as did from t_dates d inner join t_event e on e.id=d.events_id where d.id='$dateid'");
	$size_row = mysql_fetch_array($getnum);
	 $sqlfield = mysql_query("select * from t_field_names where id=394");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$page_heading = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$page_heading = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$page_heading = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$page_heading = $rowfield['fieldname_it'];
		}
		$sqlx = mysql_query("select * from t_currency where id='".$size_row['currency']."'");
					$rowx = mysql_fetch_array($sqlx);
		$sqlfield = mysql_query("select * from t_field_names where id=425");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$eventsname = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$eventsname = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$eventsname = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$eventsname = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=426");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$excelfooter = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$excelfooter = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$excelfooter = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$excelfooter = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=420");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$reservationdatelabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$reservationdatelabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$reservationdatelabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$reservationdatelabel = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=421");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$cancellationdatelabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$cancellationdatelabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$cancellationdatelabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$cancellationdatelabel = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=422");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$bookername = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$bookername = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$bookername = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$bookername = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=423");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$bookeremail = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$bookeremail = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$bookeremail = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$bookeremail = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=424");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$status = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$status = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$status = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$status = $rowfield['fieldname_it'];
		}
		
		
		$sqlfield = mysql_query("select * from t_field_names where id=427");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$cancelled = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$cancelled = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$cancelled = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$cancelled = $rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=428");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$bookedx = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$bookedx = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$bookedx = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$bookedx = $rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=429");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$waiting = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$waiting = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$waiting = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$waiting = $rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=430");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$note = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$note = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$note = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$note = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=437");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$fee = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$fee = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$fee = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$fee = $rowfield['fieldname_it'];
		}
		
	 $report_title = "" . $eventsname . ": " .$size_row['title'];
	 //$report_title = $size_row['title'] . " " .$page_heading;
	 $report_title .= "<br />[".date('d.m.Y',strtotime($size_row['events_start_date']))." - " . date('d.m.Y',strtotime($size_row['events_end_date'])) ."] ";

	 //order by FIND_IN_SET(reservation_id, '$keys');
	 
	 $one = "";
	 $booked = mysql_query("select *,r.note as rnote from t_reservations r inner join t_provider p on r.provider_id=p.id where date_id='$dateid'  and reservation_status=1 order by reservation_id asc");
	 while ($rowbooked = mysql_fetch_array($booked)){
		$one .= $rowbooked['reservation_id'] . ",";
	 }
	 
	 $two = "";
	 $waiters = mysql_query("select *,r.note as rnote from t_reservations r inner join t_provider p on r.provider_id=p.id where date_id='$dateid'  and reservation_status=0 order by reservation_date asc");
	 while ($rowwaiters = mysql_fetch_array($waiters)){
		$two .= $rowwaiters['reservation_id'] . ",";
	 }
	 
	 $three = "";
	 $cancellers = mysql_query("select *,r.note as rnote from t_reservations r inner join t_provider p on r.provider_id=p.id where date_id='$dateid'  and reservation_status=2 order by cancellation_date asc");
	 while ($rowcancellers = mysql_fetch_array($cancellers)){
		$three .= $rowcancellers['reservation_id'] . ",";
	 }
	 
	 $keys = $one . "" . $two . "" . $three . "0";
	 
	$sqlfields = mysql_query("select *,r.note as rnote from t_reservations r inner join t_provider p on r.provider_id=p.id where date_id='$dateid' order by FIND_IN_SET(reservation_id, '$keys')");
	$testtoexport ='<h3>'.$report_title.'</h3>';
	$testtoexport .='<table class="record-list" width="100%" style="height:27px;border-bottom:0px;padding:2px;" height="40px">
            <thead>	
                <tr>
				<th width="80px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$reservationdatelabel.'</th>
				<th width="80px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$cancellationdatelabel.'</th>
				<th width="100px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$bookername.'</th><th width="120px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$bookeremail.'</th><th width="120px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$status.'</th><th width="120px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$note.'</th><th width="120px" class="date-align" style="background-color:#0C6ECF;color:white;border:1px solid #0C6ECF;border-right:2px solid #0C6ECF;">'.$fee.' ' . '('.$rowx['currency'].')</th>
				</tr>
			</thead>';
			
			$testtoexport .='<tbody>';
				while ($rowfields = mysql_fetch_array($sqlfields)){
				$responsefee = "";
				$testtoexport .='<tr>
					<td align=center style="border:1px solid #eeeeee;">'.$rowfields['reservation_date'].'</td>';
					if ($rowfields['cancellation_date'] != "0000-00-00 00:00:00"){
						$testtoexport .='<td align=center style="border:1px solid #eeeeee;">'.$rowfields['cancellation_date'].'</td>';
					}else{
						$testtoexport .='<td>&nbsp;</td>';
					}
					$testtoexport .='<td align=center  style="border:1px solid #eeeeee;">'.$rowfields['firstname'] . '  ' . $rowfields['lastname'].'</td>
					<td align=center style="border:1px solid #eeeeee;">'.$rowfields['email'].'</td>';
					if ($rowfields['reservation_status'] == 0){
						$testtoexport .='<td align=center  style="border:1px solid #eeeeee;">'.$waiting.'</td>';
					}elseif ($rowfields['reservation_status'] == 1){
						$testtoexport .='<td align=center  style="border:1px solid #eeeeee;">'.$bookedx.'</td>';
						$feeamount = $size_row['price'];
						$responsefee = $feeamount;
					}elseif ($rowfields['reservation_status'] == 2){
						$testtoexport .='<td align=center  style="border:1px solid #eeeeee;">'.$cancelled.'</td>';
						$feeamount = $size_row['cancellation_fee1'];
						$responsefee = $feeamount;
					}
					$testtoexport .='<td align=center style="border:1px solid #eeeeee;">'.$rowfields['rnote'].'&nbsp;</td>';
					
					$testtoexport .='<td align=center style="border:1px solid #eeeeee;">'.$responsefee.'</td>';
				$testtoexport .='</tr>';
				}	
            $testtoexport .='</tbody>
      </table>';
	$testtoexport .= '<br />'.$excelfooter .'</div>';

$export = str_replace(",","",$report_title);
$export = str_replace("<br />","",$export);
$export = str_replace("<br/>","",$export);
$export = str_replace("<br>","",$export);
$export = str_replace(" ","",$export);
$export = str_replace("[","",$export);
$export = str_replace("]","",$export);

$file=$export.".xls";
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=$file");
echo $testtoexport;
?>