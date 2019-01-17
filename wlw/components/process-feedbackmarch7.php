<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );

$events_id = trim($_REQUEST['events_id']);
$location_id = trim($_REQUEST['location_id']);
$leader_id = trim($_REQUEST['leader_id']);
$feedback_by = trim($_REQUEST['feedback_by']);
$feedback_events = trim($_REQUEST['events_feedback']);
$feedback_leaders = trim($_REQUEST['leader_feedback']);
$feedback_locations = trim($_REQUEST['location_feedback']);
$feedback_spiritwings = trim($_REQUEST['spiritwings_feedback']);
$feedback_events_accepted = 0;
$feedback_leaders_accepted = 0;
$feedback_locations_accepted = 0;
$feedback_spiritwings_accepted = 0;

$sqlfield = mysql_query("select * from t_field_names where id=692");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$feedbackby = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$feedbackby =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$feedbackby =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$feedbackby =$rowfield['fieldname_it'];
		}

echo $sql = "insert into t_feedbacks values ('0','$events_id','$feedback_events','$feedback_events_accepted','$leader_id','$feedback_leaders','$feedback_leaders_accepted','$location_id','$feedback_locations','$feedback_locations_accepted','$feedback_spiritwings','$feedback_spiritwings_accepted','$feedback_by',NOW())";

$sqlfield = mysql_query("select * from t_field_names where id=684");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$acceptlabel = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$acceptlabel = fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$acceptlabel = fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$acceptlabel = fixEncodingx($rowfield['fieldname_it']);
			}

$sqlfield = mysql_query("select * from t_field_names where id=685");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$denylabel = fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$denylabel = fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$denylabel = fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$denylabel = fixEncodingx($rowfield['fieldname_it']);
			}

mysql_query($sql);
$feedback_id = mysql_insert_id();
//sending an email here
	//get admin details
	$sqladmin = mysql_query("select * from t_provider where user_level=1");
	while ($rowadmin = mysql_fetch_array($sqladmin)){
		$headers = "";
		$body = "";
		$providerid = $rowadmin['id'];
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$providerid'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$sqlfield = mysql_query("select * from t_field_names where id=686");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$emailsubject = $rowfield['fieldname_de'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$emailsubject =$rowfield['fieldname_eng'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$emailsubject =$rowfield['fieldname_fr'];
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$emailsubject =$rowfield['fieldname_it'];
			}
			
			$subject = fixEncodingx($emailsubject);
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
			".$username.",<br /><br />";
			
			$sqlfield = mysql_query("select * from t_field_names where id=687");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .="<br /><br /><b>";
			
			$sqlfield = mysql_query("select * from t_field_names where id=687");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .=": </b>".$row->firstname. " " . $row->lastname. "<br /><br />";
			
			///////////
			$body .="<b>";
			$sqlfield = mysql_query("select * from t_field_names where id=677");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .=":</b> <br>" . $feedback_events . "<br />";
			$body .="<a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=events&mode=deny>".$denylabel."</a> | <a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=events&mode=accept>".$acceptlabel."</a><br>";
			///////////
			$body .="<br/><b>";
			$sqlfield = mysql_query("select * from t_field_names where id=679");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .=":</b> <br>" . $feedback_leaders . "<br />";
			$body .="<a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=leaders&mode=deny>".$denylabel."</a> | <a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=leaders&mode=accept>".$acceptlabel."</a><br>";
			///////////
			$body .="<br/><b>";
			$sqlfield = mysql_query("select * from t_field_names where id=678");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .=":</b> <br>" . $feedback_locations . "<br />";
			$body .="<a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=locations&mode=deny>".$denylabel."</a> | <a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=locations&mode=accept>".$acceptlabel."</a><br>";
			///////////
$body .="<br/><b>";
			$sqlfield = mysql_query("select * from t_field_names where id=680");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .=":</b> <br>" . $feedback_spiritwings . "<br />";
			$body .="<a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=spiritwings&mode=deny>".$denylabel."</a> | <a href=http://www.manimano.ch/wlw/index.php?option=feedback-approval&feedback_id=".$feedback_id."&task=spiritwings&mode=accept>".$acceptlabel."</a>";
			///////////
			$body .="<br><br>";
			$sqlfield = mysql_query("select * from t_field_names where id=688");
			$rowfield = mysql_fetch_array($sqlfield);
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$body .= fixEncodingx($rowfield['fieldname_de']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$body .= fixEncodingx($rowfield['fieldname_eng']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$body .= fixEncodingx($rowfield['fieldname_fr']);
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$body .= fixEncodingx($rowfield['fieldname_it']);
			}
			$body .="
			</div>";
			echo $body;
		
			$from = "info@spiritwings.ch";
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
	}

?>
