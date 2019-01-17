<h1>
<?php
/*
INSERT INTO `t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES 
(692, 'Feedback by', 'Feedback by', 'Feedback by', 'Feedback by', 'Feedback by', 'Feedback by', 'Feedback by', 'Feedback by', 'Feedback by', 11),
(693, 'Denied', 'Denied', 'Denied', 'Denied', 'Denied', 'Denied', 'Denied', 'Denied', 'Denied', 11);
*/
	if ($_REQUEST['task'] == "events"){
		$sqlfield = mysql_query("select * from t_field_names where id=677");

		if ($_REQUEST['mode'] == "accept"){
			mysql_query("update t_feedbacks set feedback_events_accepted='1' where id='".$_REQUEST['feedback_id']."'");
		}else{
			mysql_query("update t_feedbacks set feedback_events_accepted='2' where id='".$_REQUEST['feedback_id']."'");
}


	}elseif ($_REQUEST['task'] == "leaders"){
		$sqlfield = mysql_query("select * from t_field_names where id=679");
		if ($_REQUEST['mode'] == "accept"){
			mysql_query("update t_feedbacks set feedback_leaders_accepted='1' where id='".$_REQUEST['feedback_id']."'");
		}else{
			mysql_query("update t_feedbacks set feedback_leaders_accepted ='2' where id='".$_REQUEST['feedback_id']."'");
}

	}elseif ($_REQUEST['task'] == "locations"){
		$sqlfield = mysql_query("select * from t_field_names where id=678");
		if ($_REQUEST['mode'] == "accept"){
			mysql_query("update t_feedbacks set feedback_locations_accepted='1' where id='".$_REQUEST['feedback_id']."'");
		}else{
			mysql_query("update t_feedbacks set feedback_locations_accepted ='2' where id='".$_REQUEST['feedback_id']."'");
}

	}elseif ($_REQUEST['task'] == "spiritwings"){
		$sqlfield = mysql_query("select * from t_field_names where id=680");
if ($_REQUEST['mode'] == "accept"){
			mysql_query("update t_feedbacks set feedback_spiritwings_accepted='1' where id='".$_REQUEST['feedback_id']."'");
		}else{
			mysql_query("update t_feedbacks set feedback_spiritwings_accepted='2' where id='".$_REQUEST['feedback_id']."'");
}

	}
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
	?>
	<?php if ($_GET['notlogin'] == 1){?>
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
	<div style="float:right;"><a href="index.php?option=login" style="font-size:14px;size:14px;">&laquo; <?php echo $back;?></a></div>
	<?php } ?>
	</h1>
<div class="content-main" style="height:auto;">
<p>

<p>
	<?php
		if ($_REQUEST['mode'] == "accept"){
		$sqlfield = mysql_query("select * from t_field_names where id=690");
	}else{
		$sqlfield = mysql_query("select * from t_field_names where id=691");
	}
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		echo ": ";
	?>
	

</p>
<?php
$sql = "SELECT *,f.id as fid,c.currency as currencyal,loc.loc_name as locationval,e.id as eid FROM t_event e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		inner join t_feedbacks f on e.id=f.events_id
		where f.id='".$_REQUEST['feedback_id']."'
		group by f.id order by feedback_datetime";
$sqlstmt = mysql_query($sql);
$row = mysql_fetch_array($sqlstmt);

$row1 = "";
	$row1 .= fixEncodingx($row['title']) ."<br />";
	if ($row['company'] !=""){
		$row1 .= fixEncodingx($row['company']) . "<br />";
	}
	$row1 .= fixEncodingx($row['firstname'] . " " .$row['lastname']) . "<br />";
	
	if ($row['leader2'] != 0){
		$sqlleaders2 = mysql_query("select * from t_leader where id='".$row['leader2']."'");
		$rowleaders = mysql_fetch_array($sqlleaders2);
		
		if ($rowleaders['company'] !=""){
			$row1 .= fixEncodingx($rowleaders['company']) . "<br />";
		}
		$row1 .= fixEncodingx($rowleaders['firstname'] . " " .$rowleaders['lastname']  . "<br />");
	}
	

	$row1 .= fixEncodingx($row['loc_adress1']) . "<br />";
		if ($row['loc_adress2'] != ""){
			$row1 .=  fixEncodingx($row['loc_adress2']) . "<br />";
		}
		$row1 .= fixEncodingx($row['short']) . " - " . fixEncodingx($row['loc_zip']) . " " . fixEncodingx($row['loc_loc']);


echo $row1;

echo "<br><br>";
$sqlfield = mysql_query("select * from t_field_names where id=697");
	
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}
		echo ": <br/>";
if ($_REQUEST['task'] == "events"){
		echo fixEncodingx($row['feedback_events']);
	}elseif ($_REQUEST['task'] == "leaders"){
		echo fixEncodingx($row['feedback_leaders']);

	}elseif ($_REQUEST['task'] == "locations"){
		echo fixEncodingx($row['feedback_locations']);
	}elseif ($_REQUEST['task'] == "spiritwings"){
		echo fixEncodingx($row['feedback_spiritwings']);
	}
?>
</p>

<center>
</center>

</div>   	
    
