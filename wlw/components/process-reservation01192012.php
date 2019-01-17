<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$dateid = $_GET['date_id'];
$provider_id = $_GET['provider_id'];
$note = $_GET['note'];

$getemailofuser = mysql_query("select * from t_provider where id='$provider_id'");
$rowemailofuser = mysql_fetch_array($getemailofuser);
$to = $rowemailofuser['email'];
$username = $rowemailofuser['firstname'];
$language = $rowemailofuser['language'];
$gender = $rowemailofuser['gender'];
$sqlfield = mysql_query("select * from t_field_names where id=412");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$waitinghover = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$waitinghover = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$waitinghover = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$waitinghover = $rowfield['fieldname_it'];
						}

$sqlfield = mysql_query("select * from t_field_names where id=431");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$male = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$male = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$male = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$male = $rowfield['fieldname_it'];
		}
$sqlfield = mysql_query("select * from t_field_names where id=432");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$female = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$female = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$female = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$female = $rowfield['fieldname_it'];
		}
$sqlfield = mysql_query("select * from t_field_names where id=436");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$makereservation = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$makereservation =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$makereservation =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$makereservation =$rowfield['fieldname_it'];
	}

if ($_GET['cancel'] == ""){
	
	
	$getnum = mysql_query("select c.currency as ccurrency,e.*,d.id as did,d.* from t_dates d inner join t_event e on e.id=d.events_id
			inner join t_currency c on c.id=e.currency
	where d.id='$dateid'");
	
	
	
	$size_row = mysql_fetch_array($getnum);
	
	$count = 0;
	$up = 0;
	
	$checkupordown = mysql_query("select * from t_reservations where date_id='".$dateid."' and (reservation_status=1)");
	$num_rows_check = mysql_num_rows($checkupordown);
	//while ($result= mysql_fetch_array($checkupordown)){
		$count++;
		if (($num_rows_check < $size_row['max_number'])){
			$up++;
		}
	//}
	
	
		if ($up > 0){
			mysql_query("insert into t_reservations values ('0','$dateid','$provider_id','$note',NOW(),'','1','1')");
		
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
						//$to = $rowtoup['email'];
						//$username = $rowtoup['firstname'];
						//$language = $rowtoup['language'];
						//$gender = $rowtoup['gender'];

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
									
							if ($gender == 1){
								$gendername = $male;
							}else{
								$gendername = $female;
							}
							
							$subject = $emailtitle;
							$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
							".$gendername." ".$username."<br /><br />";
							
							$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							
							$currencyvalue = $size_row['ccurrency'];
							$bodycontent = str_replace('%currency%',$currencyvalue,$bodycontent);
							
							$bodycontent = str_replace('%cancellation_days1%', $size_row['cancellation_day1'], $bodycontent);
							$bodycontent = str_replace('%cancellation_days2%', $size_row['cancellation_day2'], $bodycontent);
							

							if ($size_row['cancellation_fee1'] > 0){
								$bodycontent = str_replace("%if cancellation_fee1 > 0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}else{
								$bodycontent = str_replace(". %if cancellation_fee1 > 0%Wir machen Sie darauf aufmerksam, dass eine kurzfristige Absage zwischen %cancellation_days1% und %cancellation_days2%  mit %cancellation_fee1% %currency% in Rechnung gestellt wird. %if cancellation_fee2 >0%Eine spätere Absage wird mit %cancellation_fee2% %currency% verrechnet","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}
							
							if ($size_row['cancellation_fee2'] > 0){
								$bodycontent = str_replace("%if cancellation_fee2 >0%"," ",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}else{
								$bodycontent = str_replace("%if cancellation_fee2 >0%Eine spätere Absage wird mit %cancellation_fee2% %currency% verrechnet.","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}
							
							
							$body .= fixEncoding($bodycontent);
							
							$body .="</div>";

						$from = "kontakt@spiritwings.ch";
								
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: $from\r\n";
						//echo $body;
						mail($to,$subject,$body,$headers);
						
						
						
						
			echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-up.png' width='16px' height='16px' border='0' /> ";
			$letterw = 0;
		}else{
			mysql_query("insert into t_reservations values ('0','$dateid','$provider_id','$note',NOW(),'','0','1')");
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
						//$to = $rowtoup['email'];
						//$username = $rowtoup['firstname'];
						//$language = $rowtoup['language'];
						//$gender = $rowtoup['gender'];

							
						
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
							$sqlfield = mysql_query("select * from t_gender where id='$gender'");
									$rowfield = mysql_fetch_array($sqlfield);
									if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
										$gendername = $rowfield['gender_de'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
										$gendername = $rowfield['gender_eng'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
										$gendername = $rowfield['gender_fr'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
										$gendername = $rowfield['gender_it'];
									}
							if ($gender == 1){
								$gendername = $male;
							}else{
								$gendername = $female;
							}
							$subject = $emailtitle;
							$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
							".$gendername." ".$username."<br /><br />";
							
							$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							
							
							
							$currencyvalue = $size_row['ccurrency'];
							$bodycontent = str_replace('%currency%',$currencyvalue,$bodycontent);
							$body .= fixEncoding($bodycontent);
							$body .="</div>";

						$from = "kontakt@spiritwings.ch";
								
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: $from\r\n";
						//echo $body;
						mail($to,$subject,$body,$headers);
						
			echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
			$letterr = 1;
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
	if ($letterr == 0){	
	echo "<a style=cursor:pointer; onclick='datereserveagain(1,$size_row[did],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a> ";					
	}else{
	
	echo "<a style=cursor:pointer; onclick='datereserveagain(1,$size_row[did],$provider_id)'><img src='images/letter-r.jpg' width='16px' height='16px' border='0' alt='".$waitinghover."' title='".$waitinghover."'/></a> ";					
	}
	if ($size_row['events_start_date'] >=  date('Y-m-d')){					
	echo "<a alt='".$reservationbutton."' title='".$reservationbutton."' style=cursor:pointer; onclick='datecancel(1,$size_row[did],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
	}
	
}else{
	
	$selecttocancel = mysql_query("select * from t_reservations where provider_id='$provider_id' and date_id='$dateid' and reservation_status!=2 order by reservation_id desc limit 1");
	$rowtocancel = mysql_fetch_array($selecttocancel);
	
	mysql_query("update t_reservations set cancellation_date=NOW(),reservation_status=2 where reservation_id='$rowtocancel[reservation_id]'");
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
						
					$getnum = mysql_query("select c.currency as ccurrency,e.*,d.id as did from t_dates d inner join t_event e on e.id=d.events_id
			inner join t_currency c on c.id=e.currency
	where d.id='$dateid'");
	
				
	
					$size_row = mysql_fetch_array($getnum);	
						

					//416 cancel email
						$gettoup = mysql_query("select * from t_reservations r
							inner join t_provider p
						where date_id='$dateid' and provider_id='$provider_id'");
						$rowtoup = mysql_fetch_array($gettoup);
						//sending an email here
						//$to = $rowtoup['email'];
						//$username = $rowtoup['firstname'];
						//$language = $rowtoup['language'];
						//$gender = $rowtoup['gender'];
						
						$sqlfield = mysql_query("select * from t_gender where id='$gender'");
									$rowfield = mysql_fetch_array($sqlfield);
									if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
										$gendername = $rowfield['gender_de'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
										$gendername = $rowfield['gender_eng'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
										$gendername = $rowfield['gender_fr'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
										$gendername = $rowfield['gender_it'];
									}

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
							if ($gender == 1){
								$gendername = $male;
							}else{
								$gendername = $female;
							}
							
							$subject = $emailtitle;
							$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
							".$gendername." ".$username."<br /><br />";
							
							$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							
						
							$startdate = $size_row['events_start_date'];
							$enddate = $size_row['events_end_date'];
							$today = date('Y-m-d');
							
							//subtract
							$subtract1 = strtotime(date("Y-m-d", strtotime($startdate)) . " -".$size_row['cancellation_day1']." day");
							if ($subtract1 > $today){
								$bodycontent = str_replace('%if startdate - cancellation_days1 > today% Gemäss den vom Veranstalter festgelegten Bedingungen ist diese Absage kostenlos.', "", $bodycontent);
							}else{
								$bodycontent = str_replace('%if startdate - cancellation_days1 > today% ', "<br /><br />", $bodycontent);
							}
							
							$subtract2 = strtotime(date("Y-m-d", strtotime($startdate)) . " -".$size_row['cancellation_day1']." day");
							$subtract3 = strtotime(date("Y-m-d", strtotime($startdate)) . " -".$size_row['cancellation_day2']." day");
							
							
							
							
							if (($subtract2 <= $today) and ($substract3 > $today)){
								$bodycontent = str_replace(' %if (startdate - cancellation_days1 <= today) and (startdate - cancellation_days2 > today)%', '', $bodycontent);
								$bodycontent = str_replace('%else% Gemäss den vom Veranstalter festgelegten Bedingungen wird diese Absage mit %cancellation_fee2% verrechnet - die Rechnung erhalten Sie direkt vom Veranstalter.%end if%', '', $bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);
							}else{
								
								$bodycontent = str_replace(' %if (startdate - cancellation_days1 <= today) and (startdate - cancellation_days2 > today)% Gemäss den vom Veranstalter festgelegten Bedingungen wird diese Absage mit %cancellation_fee1% %currency% verrechnet - die Rechnung erhalten Sie direkt vom Veranstalter .%else%', '', $bodycontent);
								$bodycontent = str_replace('%end if%', '', $bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);
							}
							
							
							
							

							$currencyvalue = $size_row['ccurrency'];
							$bodycontent = str_replace('%currency%',$currencyvalue,$bodycontent);
							$body .=$bodycontent;
							$body .="</div>";

							//echo $body;
							
						$from = "kontakt@spiritwings.ch";
						
						$headers  = "MIME-Version: 1.0\r\n";
						$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$headers .= "From: $from\r\n";
						//echo $body;
						mail($to,$subject,$body,$headers);
						
						$headers = "";
						$body = "";
						$subject = "";
	
$getnum = mysql_query("select c.currency as ccurrency,e.*,d.id as did from t_dates d inner join t_event e on e.id=d.events_id
			inner join t_currency c on c.id=e.currency
	where d.id='$dateid'");
	
	
	$size_row = mysql_fetch_array($getnum);
	
	$count = 0;
	$up = 0;
	
	$checkupordown = mysql_query("select * from t_reservations where date_id='".$dateid."' and provider_id='$provider_id' and (reservation_status=0 or reservation_status=1) order by reservation_id desc");
	
	
	
	$num_rows_check = mysql_num_rows($checkupordown);

		$count++;
		if (($num_rows_check <= $size_row['max_number'])){
			$up++;
		}
	
	
	if ($up > 0){	
		/////
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
		
		$getifyes = mysql_query("select * from t_reservations where date_id='$dateid' and provider_id='$provider_id'  and (reservation_status=0 or reservation_status=1)");	
		
		if (mysql_num_rows($getifyes) == 0){
			echo "<a alt='".$reservationbutton."' title='".$reservationbutton."' style=cursor:pointer; onclick='datereserve(1,$dateid,$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a>";
		}else{
			$getmybooked = mysql_query("select * from t_reservations where date_id='$dateid' and provider_id='$provider_id'  and (reservation_status=0)");
			if (mysql_num_rows($getmybooked) == 0){
				echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-up.png' width='16px' height='16px' border='0' /> ";
				echo "<a style=cursor:pointer; onclick='datereserveagain(1,$size_row[did],$provider_id)' alt='".$makereservation."' title='".$makereservation."'><img src='images/reservation.png' width='16px' height='16px' border='0'/></a> ";
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
				echo "<a alt='".$reservationbutton."' title='".$reservationbutton."' style=cursor:pointer; onclick='datecancel(1,$size_row[did],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
				}
			}else{
				echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
				echo "<a style=cursor:pointer; onclick='datereserveagain(1,$size_row[did],$provider_id)' alt='".$waitinghover."' title='".$waitinghover."'><img src='images/letter-r.jpg' width='16px' height='16px' border='0'/></a> ";					
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
					echo "<a alt='".$reservationbutton."' title='".$reservationbutton."' style=cursor:pointer; onclick='datecancel(1,$size_row[did],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
				}
			}
		}
		/////
	}else{
		echo "<a alt='".$makereservation."' title='".$makereservation."' style=cursor:pointer; onclick='datereserve(1,$dateid,$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0'/></a>";
	}
	
	$getnum = mysql_query("select c.currency as ccurrency,e.*,d.id as did from t_dates d inner join t_event e on e.id=d.events_id
			inner join t_currency c on c.id=e.currency
	where d.id='$dateid'");
	$size_row = mysql_fetch_array($getnum);
	
	$countreservation = mysql_query("select * from t_reservations where date_id='$dateid' and reservation_status=1");
	$body = "";
	if (mysql_num_rows($countreservation) < $size_row['max_number']){
	
	//415 For A change in Waiting to Reserved
	
		$gettoup = mysql_query("select * from t_reservations r
			inner join t_provider p
		where date_id='$dateid' and reservation_status=0 order by reservation_id asc");
		$rowtoup = mysql_fetch_array($gettoup);
		
		$reservation_id = $rowtoup['reservation_id'];
		mysql_query("update t_reservations set reservation_status=1 where reservation_id='$reservation_id'");
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
				$sqlfield = mysql_query("select * from t_gender where id='$gender'");
									$rowfield = mysql_fetch_array($sqlfield);
									if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
										$gendername = $rowfield['gender_de'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
										$gendername = $rowfield['gender_eng'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
										$gendername = $rowfield['gender_fr'];
									}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
										$gendername = $rowfield['gender_it'];
									}
				if ($gender == 1){
								$gendername = $male;
							}else{
								$gendername = $female;
							}
				$subject = $emailtitle;
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username."<br /><br />";
				
				$bodycontent = str_replace('%eventtitle%', $size_row['title'], $bodycontent);
							
							$currencyvalue = $size_row['ccurrency'];
							$bodycontent = str_replace('%currency%',$currencyvalue,$bodycontent);
							
							$bodycontent = str_replace('%cancellation_days1%', $size_row['cancellation_day1'], $bodycontent);
							$bodycontent = str_replace('%cancellation_days2%', $size_row['cancellation_day2'], $bodycontent);
							

							if ($size_row['cancellation_fee1'] > 0){
								$bodycontent = str_replace("%if cancellation_fee1 > 0%","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}else{
								$bodycontent = str_replace(". %if cancellation_fee1 > 0%Wir machen Sie darauf aufmerksam, dass eine kurzfristige Absage zwischen %cancellation_days1% und %cancellation_days2%  mit %cancellation_fee1% %currency% in Rechnung gestellt wird. %if cancellation_fee2 >0%Eine spätere Absage wird mit %cancellation_fee2% %currency% verrechnet","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee1%', $size_row['cancellation_fee1'], $bodycontent);	
							}
							
							if ($size_row['cancellation_fee2'] > 0){
								$bodycontent = str_replace("%if cancellation_fee2 >0%"," ",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}else{
								$bodycontent = str_replace("%if cancellation_fee2 >0%Eine spätere Absage wird mit %cancellation_fee2% %currency% verrechnet.","",$bodycontent);
								$bodycontent = str_replace('%cancellation_fee2%', $size_row['cancellation_fee2'], $bodycontent);	
							}
							
							
							$body .= fixEncoding($bodycontent);
				
				$body .="</div>";

			$from = "kontakt@spiritwings.ch";
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			//echo $body;
			mail($to,$subject,$body,$headers);
		
	}
	
}
//echo $to;
//echo $body;
?>