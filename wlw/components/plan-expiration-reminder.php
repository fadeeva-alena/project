<?php
	session_start();
	require ( '../includes/config.php' );
	require ( '../'.PATH_LIBRARIES.'libraries.php' );
	
	$sql_reminder_days = mysql_query("select * from t_plan_reminders_config");
	$row_reminder_days = mysql_fetch_array($sql_reminder_days);
	
	//$date = date('Y-m-d 23:59:99') ;
	$format = 'Y-m-d 23:59:59';
	$date = date ( $format );

	// + 7 days from today
	$first_expiration = date ( $format, strtotime ( '+'.$row_reminder_days[1].' day' . $date ) );
	// + 14 days from today
	$second_expiration = date ( $format, strtotime ( '+'.$row_reminder_days[2].' day' . $date ) );	
		$datereminder = date('Y-m-d 23:59:59');
		echo "Plan 1: <br />";
		//1------------------------seminar_with_reservation swr_expiration_date 
		$sql = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider_access WHERE seminar_with_reservation=1 and (swr_expiration_date = '$first_expiration' or swr_expiration_date='$second_expiration')") ;	
		while ($row12 = mysql_fetch_array($sql))
		{
			//// sending email
			$provider_id = $row12['provider_id'];
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			echo $subject = fixEncodingx(translatefields(810));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			$bodyemail = fixEncodingx(translatefields(814));
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
			
			$bodyemail = str_replace("<expiration_date>",date('d.F.Y',strtotime($row12[swr_expiration_date])),$bodyemail);
			
			$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
			$bodyemail = str_replace(",,","",$bodyemail);
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";	
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			mail($to,$subject,$body,$headers);
			echo $body;	
			$body = "";
			$headers = "";
			$from = "";
			$to = "";
			$bodyemail = "";
		}
		echo "<br /><br />Plan 2: <br />";
		//2------------------------seminar_extended 	s_expiration_date  
		$row = "";
		$sql = "";
		$row12 = "";
		$sql = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider_access WHERE seminar_extended=1 and (s_expiration_date = '$first_expiration' or s_expiration_date='$second_expiration')") ;	
		while ($row12 = mysql_fetch_array($sql))
		{
			//// sending email
			$provider_id = $row12['provider_id'];
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			echo $subject = fixEncodingx(translatefields(811));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			$bodyemail = fixEncodingx(translatefields(815));
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
			$bodyemail = str_replace("<expiration_date>",date('d.F.Y',strtotime($row12['s_expiration_date'])),$bodyemail);
			$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
			$bodyemail = str_replace(",,","",$bodyemail);
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";	
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			mail($to,$subject,$body,$headers);
			echo $body;	
			$body = "";
			$headers = "";
			$from = "";
			$to = "";
			$bodyemail = "";
		}
		echo "<br /><br />Plan 3: <br />";
		//3------------------------session_based 	session_expiration_date  
		$row = "";
		$sql = "";
		$row12 = "";
		$sql = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider_access WHERE session_based=1 and (session_expiration_date = '$first_expiration' or session_expiration_date='$second_expiration')") ;	
		while ($row12 = mysql_fetch_array($sql))
		{
			//// sending email
			$provider_id = $row12['provider_id'];
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			echo $subject = fixEncodingx(translatefields(812));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			$bodyemail = fixEncodingx(translatefields(816));
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
			$bodyemail = str_replace("<expiration_date>",date('d.F.Y',strtotime($row12['session_expiration_date'])),$bodyemail);
			$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
			$bodyemail = str_replace(",,","",$bodyemail);
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";	
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			mail($to,$subject,$body,$headers);
			echo $body;	
			$body = "";
			$headers = "";
			$from = "";
			$to = "";
			$bodyemail = "";
		}
		echo "<br /><br />Plan 4: <br />";
		//4------------------------session_enhanced 	session_enhanced_expiration_date   
		$row = "";
		$sql = "";
		$row12 = "";
		$sql = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider_access WHERE session_enhanced=1 and (session_enhanced_expiration_date = '$first_expiration' or session_enhanced_expiration_date='$second_expiration')") ;	
		while ($row12 = mysql_fetch_array($sql))
		{
			//// sending email
			$provider_id = $row12['provider_id'];
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			echo $subject = fixEncodingx(translatefields(813));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			$bodyemail = fixEncodingx(translatefields(817));
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
			$bodyemail = str_replace("<expiration_date>",date('d.F.Y',strtotime($row12['session_enhanced_expiration_date'])),$bodyemail);
			$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
			$bodyemail = str_replace(",,","",$bodyemail);
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";	
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			mail($to,$subject,$body,$headers);
			echo $body;	
			$body = "";
			$headers = "";
			$from = "";
			$to = "";
			$bodyemail = "";
		}
?>