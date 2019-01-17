
<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$dateid = $_GET['date_id'];
$provider_id = $_GET['provider_id'];
$note = $_GET['note'];

if ($_GET['cancel'] == ""){
	mysql_query("insert into t_reservations values ('0','$dateid','$provider_id','$note',NOW(),'','1','1')");
	
	$getnum = mysql_query("select *,d.id as did from t_dates d inner join t_event e on e.id=d.events_id where d.id='$dateid'");
	$size_row = mysql_fetch_array($getnum);
	
	$count = 0;
	$up = 0;
	$checkupordown = mysql_query("select * from t_reservations where date_id='".$dateid."' and (status=1)");;
	while ($result= mysql_fetch_array($checkupordown)){
		$count++;
		if (($count <= $size_row['max_number']) and ($result['date_id'] == $dateid) and ($result['provider_id'] == $provider_id)){
			$up++;
		}
	}
	
		if ($up > 0){
			$sqlfield = mysql_query("select * from t_field_names where id=411");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$reservationbutton = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$reservationbutton = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$reservationbutton = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$reservationbutton = $rowfield['fieldname_it'];
						}
						
						//413 for booking email
						$gettoup = mysql_query("select * from t_reservations r
							inner join t_provider p
						where date_id='$dateid' and provider_id='$provider_id'");
						$rowtoup = mysql_fetch_array($gettoup);
						//sending an email here
						$to = $rowtoup['email'];
						$username = $rowtoup['firstname'];
						$language = $rowtoup['language'];
						$gender = $rowtoup['gender'];

						$sqlfield = mysql_query("select * from t_field_names where id=413");
									$rowfield = mysql_fetch_array($sqlfield);
									if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
										$emailtitle = $rowfield['fieldname_de'];
										$bodycontent = $rowfield['helptext_de'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
										$emailtitle = $rowfield['fieldname_eng'];
										$bodycontent = $rowfield['helptext_eng'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
										$emailtitle = $rowfield['fieldname_fr'];
										$bodycontent = $rowfield['helptext_fr'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
										$emailtitle = $rowfield['fieldname_it'];
										$bodycontent = $rowfield['helptext_it'];
									}
							
							
							$subject = $emailtitle;
							$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
							".$gendername." ".$username.",<br /><br />";
							
							$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							$bodycontent = str_replace('%cancellation_days1%', $size_row['cancellation_day1'], $bodycontent);
							$bodycontent = str_replace('%cancellation_days2%', $size_row['cancellation_day2'], $bodycontent);
							

							if ($size_row['cancellation_fee1'] > 0){
								$bodycontent = str_replace("%if cancellation_fee1 > 0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}else{
								$bodycontent = str_replace("%if cancellation_fee1 > 0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}
							
							if ($size_row['cancellation_fee2'] > 0){
								$bodycontent = str_replace("%if cancellation_fee2 >0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}else{
								$bodycontent = str_replace("%if cancellation_fee2 >0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}
							
							$body .= fixEncoding($bodycontent);
							
							$body .="</div>";

						$from = "info@buddhasways.ch";
								
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: $from\r\n";
						//echo $body;
						mail($to,$subject,$body,$headers);
						
						
			echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-up.png' width='16px' height='16px' border='0' /> ";
		}else{
			$sqlfield = mysql_query("select * from t_field_names where id=412");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$reservationbutton = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$reservationbutton = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$reservationbutton = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$reservationbutton = $rowfield['fieldname_it'];
						}
						//414 For Booking but in Waiting List Email
						$gettoup = mysql_query("select * from t_reservations r
							inner join t_provider p
						where date_id='$dateid' and provider_id='$provider_id'");
						$rowtoup = mysql_fetch_array($gettoup);
						//sending an email here
						$to = $rowtoup['email'];
						$username = $rowtoup['firstname'];
						$language = $rowtoup['language'];
						$gender = $rowtoup['gender'];

						$sqlfield = mysql_query("select * from t_field_names where id=414");
									$rowfield = mysql_fetch_array($sqlfield);
									if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
										$emailtitle = $rowfield['fieldname_de'];
										$bodycontent = $rowfield['helptext_de'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
										$emailtitle = $rowfield['fieldname_eng'];
										$bodycontent = $rowfield['helptext_eng'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
										$emailtitle = $rowfield['fieldname_fr'];
										$bodycontent = $rowfield['helptext_fr'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
										$emailtitle = $rowfield['fieldname_it'];
										$bodycontent = $rowfield['helptext_it'];
									}
							
							
							$subject = $emailtitle;
							$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
							".$gendername." ".$username.",<br /><br />";
							
							$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							
							
							$body .= fixEncoding($bodycontent);
							
							$body .="</div>";

						$from = "info@buddhasways.ch";
								
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: $from\r\n";
						//echo $body;
						mail($to,$subject,$body,$headers);
						
			echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
		}
$sqlfield = mysql_query("select * from t_field_names where id=410");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$reservationbutton = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$reservationbutton = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$reservationbutton = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$reservationbutton = $rowfield['fieldname_it'];
						}
	echo "<a alt='".$reservationbutton."' title='".$reservationbutton."' style=cursor:pointer; onclick='datecancel(1,$size_row[did],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
	
}else{
	mysql_query("update t_reservations set cancellation_date=NOW(),status=2 where date_id='$dateid' and provider_id='$provider_id'");
	$sqlfield = mysql_query("select * from t_field_names where id=409");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$reservationbutton = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$reservationbutton = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$reservationbutton = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$reservationbutton = $rowfield['fieldname_it'];
						}
						
					$getnum = mysql_query("select *,d.id as did from t_dates d inner join t_event e on e.id=d.events_id where d.id='$dateid'");
					$size_row = mysql_fetch_array($getnum);	
						

					//416 cancel email
						$gettoup = mysql_query("select * from t_reservations r
							inner join t_provider p
						where date_id='$dateid' and provider_id='$provider_id'");
						$rowtoup = mysql_fetch_array($gettoup);
						//sending an email here
						$to = $rowtoup['email'];
						$username = $rowtoup['firstname'];
						$language = $rowtoup['language'];
						$gender = $rowtoup['gender'];

						$sqlfield = mysql_query("select * from t_field_names where id=416");
									$rowfield = mysql_fetch_array($sqlfield);
									if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
										$emailtitle = $rowfield['fieldname_de'];
										$bodycontent = $rowfield['helptext_de'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
										$emailtitle = $rowfield['fieldname_eng'];
										$bodycontent = $rowfield['helptext_eng'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
										$emailtitle = $rowfield['fieldname_fr'];
										$bodycontent = $rowfield['helptext_fr'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
										$emailtitle = $rowfield['fieldname_it'];
										$bodycontent = $rowfield['helptext_it'];
									}
							
							
							$subject = $emailtitle;
							$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
							".$gendername." ".$username.",<br /><br />";
							
							$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							$bodycontent = str_replace('%cancellation_days1%', $size_row['cancellation_day1'], $bodycontent);
							$bodycontent = str_replace('%cancellation_days2%', $size_row['cancellation_day2'], $bodycontent);
							

							if ($size_row['cancellation_fee1'] > 0){
								$bodycontent = str_replace("%if cancellation_fee1 > 0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}else{
								$bodycontent = str_replace("%if cancellation_fee1 > 0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}
							
							if ($size_row['cancellation_fee2'] > 0){
								$bodycontent = str_replace("%if cancellation_fee2 >0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}else{
								$bodycontent = str_replace("%if cancellation_fee2 >0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}
							
							/*%if startdate - cancellation_days1 > today% Gemäss den vom Veranstalter festgelegten Bedingungen ist diese Absage kostenlos.
%if (startdate - cancellation_days1 <= today) and (startdate - cancellation_days2 > today) Gemäss den vom Veranstalter festgelegten Bedingungen wird diese Absage mit %cancellation_fee1% verrechnet - die Rechnung erhalten Sie direkt vom Veranstalter .
%else% Gemäss den vom Veranstalter festgelegten Bedingungen wird diese Absage mit %cancellation_fee2% verrechnet - die Rechnung erhalten Sie direkt vom Veranstalter.
%end if%*/
							
							$body .= fixEncoding($bodycontent);
							
							$body .="</div>";

						$from = "info@buddhasways.ch";
								
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: $from\r\n";
						//echo $body;
						mail($to,$subject,$body,$headers);
						
						$headers = "";
						$body = "";
						$subject = "";
						
						
	echo "<a alt='".$reservationbutton."' title='".$reservationbutton."' style=cursor:pointer; onclick='datereserve(1,$dateid,$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0'/></a>";
	
	$getnum = mysql_query("select *,d.id as did from t_dates d inner join t_event e on e.id=d.events_id where d.id='$dateid'");
	$size_row = mysql_fetch_array($getnum);
	
	$countreservation = mysql_query("select * from t_reservations where date_id='$dateid' and status=1");
	
	if (mysql_num_rows($countreservation) <= $size_row['max_number']){
	
	//415 For A change in Waiting to Reserved
	
		$gettoup = mysql_query("select * from t_reservations r
			inner join t_provider p
		where date_id='$dateid' and status=0 order by reservation_id asc");
		$rowtoup = mysql_fetch_array($gettoup);
		
		$reservation_id = $rowtoup['reservation_id'];
		mysql_query("update t_reservations set status=1 where reservation_id='$reservation_id'");
		$to = $rowtoup['email'];
		
		$getdateeventdetails = mysql_query("select * from t_dates td inner join t_event te
			on td.events_id=te.id where td.id='$dateid'
		");
		
		$rowdateeventsdetails = mysql_fetch_array($getdateeventdetails);
		
		//sending an email here
			$to = $rowtoup['email'];
			$username = $rowtoup['firstname'];
			$language = $rowtoup['language'];
			$gender = $rowtoup['gender'];

			$sqlfield = mysql_query("select * from t_field_names where id=415");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$emailtitle = $rowfield['fieldname_de'];
							$bodycontent = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$emailtitle = $rowfield['fieldname_eng'];
							$bodycontent = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$emailtitle = $rowfield['fieldname_fr'];
							$bodycontent = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$emailtitle = $rowfield['fieldname_it'];
							$bodycontent = $rowfield['helptext_it'];
						}
				
				if ($gender == 1){ // male
					$gendername = "";
				}else { // female
					$gendername = "";
				}
				
				$subject = $emailtitle;
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />";
				
				$bodycontent = str_replace('%eventtitle%', $rowdateeventsdetails['title'], $bodycontent);
				
				$body .= $bodycontent;
				
				$body .="</div>";

			$from = "info@buddhasways.ch";
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			//echo $body;
			mail($to,$subject,$body,$headers);
		
	}
	
}

?>