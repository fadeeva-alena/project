<?php
error_reporting(0);
session_start();
require_once ( '../includes/config.php' );
require_once ( '../libraries/libraries.php' );
$mode = "view";
$sqlfield = mysql_query("select * from t_field_names where id=80");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$page_heading = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$page_heading = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$page_heading = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$page_heading = fixEncoding($rowfield['fieldname_it']);
		}
//echo "mode goes here : ".$mode;
$id = 0;
if (@$_GET['id'] > 0 ) {
	$id = $_GET['id'];
} elseif ( isset($_POST['id']) ) {
	$id = $_POST['id'];
}

$sub_heading = ucfirst($mode);
if ($mode == "add"){
	$sqlfield = mysql_query("select * from t_field_names where id=262");
}elseif ($mode == "edit"){
	$sqlfield = mysql_query("select * from t_field_names where id=272");
}else{
	$sqlfield = mysql_query("select * from t_field_names where id=271");
}
$rowfield = mysql_fetch_array($sqlfield);
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$sub_heading = fixEncoding($rowfield['fieldname_de']);
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$sub_heading = fixEncoding($rowfield['fieldname_eng']);
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$sub_heading = fixEncoding($rowfield['fieldname_fr']);
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$sub_heading = fixEncoding($rowfield['fieldname_it']);
}

$button = $helper->button_val($mode, "");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'location';



// Retrieve record
	if(!empty($id) || $id != '') :
		$record = $sql_helper->cget_row(DB_TABLE_PREFIX."event", "id = '$id'");
		$title = $record->title;
		$kind = $record->kind;
		$type = $record->type;
		$short_desc = $record->short_desc;
		$long_desc = $record->long_desc;
		$location = $record->location;
		$price = $record->price;
		$currency = $record->currency;
		$remark_price = $record->remark_price;
		$remark_prerequisite = $record->remark_prerequisite;
		

		$min_number = $record->min_number;
		$max_number = $record->max_number;
		$active_for_reservation = $record->active_for_reservation;
		$cancellation_day1 = $record->cancellation_day1;
		$cancellation_day2 = $record->cancellation_day2;
		$cancellation_fee1 = $record->cancellation_fee1;
		$cancellation_fee2 = $record->cancellation_fee2;
		
		
		if ($min_number == 0){ $min_number = "";}
		if ($max_number == 0){ $max_number = "";}
		if ($cancellation_day1 == 0){ $cancellation_day1 = "";}
		if ($cancellation_fee1 == 0){ $cancellation_fee1 = "";}
		if ($cancellation_day2 == 0){ $cancellation_day2 = "";}
		if ($cancellation_fee2 == 0){ $cancellation_fee2 = "";}
		
		$eve_contact_name = $record->eve_contact_name;
		$eve_contact_phone = $record->eve_contact_phone;
		$eve_contact_email = $record->eve_contact_email;
		$eve_contact_url = $record->eve_contact_url;
		$eve_loc = $record->eve_loc;
		$eve_image_path = $record->eve_image_path;
		$provider = $record->provider;
		$timestamp = $record->timestamp;
		$last_change = $record->last_change;
		
		$date_start = $record->date_start;
		$date_end = $record->date_end;
		
		$date_start = date('d.m.Y',strtotime($record->date_start));
		$date_end = date('d.m.Y',strtotime($record->date_end));
		
		$date_remark = $record->date_remark;
		
		$time_start = $record->time_start;
		if ($time_start == "00:00:00"){
			$time_start = "";
		}
		$time_end = $record->time_end;
		if ($time_end == "00:00:00"){
			$time_end = "";
		}
		
		/*$time_start = $record->time_start;
		$time_end = $record->time_end;*/
		
		$remark_time = $record->remark_time;
		$leader = $record->leader;
		$leader2 = $record->leader2;
		
		$quality = $record->quality;

		
		if ($eve_image_path != ""){
				$path = "uploads/".$eve_image_path;
		list($widthimage, $heightimage, $types, $attr) = getimagesize($path);
		
		//$image_path = "images/your_image.png";

		//list($width, $height, $type, $attr)= getimagesize($image_path); 
		
		
		
		if ($widthimage >= $detail_max_x){
		$widthimage = $detail_max_x;
		$heightimage = "";
		}else{
		$widthimage = $widthimage;
		}
		
		
				$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0" width='.$widthimage.'>';
			}else{
				$design_photo_img = '';
			}
		
		
		//$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0">';
	endif;
	
	$sqllastentry = mysql_query("select * from t_event where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'
					order by id desc");
	$rowlastentry = mysql_fetch_array($sqllastentry);
	?>
	
	

	
		
		<?php 
			// quality 1
						$sqlfield = mysql_query("select * from t_field_names where id=320");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality1 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality1 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality1 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality1 = $rowfield['helptext_it'];
						}
						// quality 2
						$sqlfield = mysql_query("select * from t_field_names where id=321");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality2 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality2 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality2 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality2 = $rowfield['helptext_it'];
						}
						// quality 3
						$sqlfield = mysql_query("select * from t_field_names where id=322");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality3 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality3 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality3 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality3 = $rowfield['helptext_it'];
						}
						// quality 4
						$sqlfield = mysql_query("select * from t_field_names where id=323");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality4 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality4 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality4 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality4 = $rowfield['helptext_it'];
						}
						// quality 5
						$sqlfield = mysql_query("select * from t_field_names where id=324");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality5 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality5 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality5 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality5 = $rowfield['helptext_it'];
						}
		
		$sqlfield = mysql_query("select * from t_field_names where id=100");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		$sqlfield = mysql_query("select * from t_field_names where id=13");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext1 = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext1 = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext1 = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext1 = $rowfield['helptext_it'];
		}
		if ($helptext1 == "0" or $helptext1 ==""){
		$helptext1 = "";
		}else{
		$helptext1 = $helptext1;
		}
		?>
		
		
		
	<h1><?php echo $page_heading?> <small>[ <?php echo $sub_heading?> ]</small></h1>

	

	<div class="content-main" style="width:650px;">
		
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
			<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
			<input type="hidden" name="mode" value="<?php echo $mode?>">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="hidden" name="providername" id="providername" value="<?php echo $_GET['providername'];?>" />
			<input type="hidden" name="search_keyword" id="search_keyword" value="<?php echo $_GET['search_keyword'];?>" />
			<fieldset class="standard-form">
				<legend><?php
		$sqlfield = mysql_query("select * from t_field_names where id=230");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></legend>
				<table class="form-table">            	
					<tr>
						<td class="key"><label for="title">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=1");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=1");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="title" id="title" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($title)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textlastname"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($title)?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<tr>
		 <td class="key"><label for="kind">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=3");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=3");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		 <?php echo $req_fld?></label></td>
		 <?php if ( $is_editable_field ) { ?>
		<td><?php
		$value_display['value'] = "id";
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$value_display['display'] = "kind_de";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_de asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$value_display['display'] = "kind_eng";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_eng asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$value_display['display'] = "kind_fr";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_fr asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$value_display['display'] = "kind_it";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_it asc");	
		}
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"kind",$kind,"","style=width:190px;");
		?>
		<span class="validation-status"></span> 
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textkind"></div>
		</td>
		<?php } else { ?>
		<td><?php 
		 if ($kind != ""){
		$sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
		$row1 = mysql_fetch_array($sql1);
		//echo $row1['kind_eng'];
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($row1['kind_de']);	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($row1['kind_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($row1['kind_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($row1['kind_it']);
		}
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		
		<tr>
		 <td class="key"><label for="type">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=4");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=4");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		 <?php echo $req_fld?></label></td>
		 <?php if ( $is_editable_field ) { ?>
		<td><?php
		$value_display['value'] = "id";
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$value_display['display'] = "eventtype_de";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_de asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$value_display['display'] = "eventtype_eng";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_eng asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$value_display['display'] = "eventtype_fr";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_fr asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$value_display['display'] = "eventtype_it";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_it asc");	
		}
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"type",$type,"","style=width:190px");
		?>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texttype"></div></td>
		<?php } else { ?>
		<td><?php 
		 if ($type != ""){
		$sql1 = mysql_query("select * from t_event_type where id='".$type."'");
		$row1 = mysql_fetch_array($sql1);
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($row1['eventtype_de']);	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($row1['eventtype_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($row1['eventtype_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($row1['eventtype_it']);
		}
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		
		<tr>
		 <td class="key"><label for="type"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=75");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=75");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?> <?php echo $req_fld?></label></td>
		 <?php if ( $is_editable_field ) { ?>
		<td valign="middle"><?php
		$value_display['value'] = "id";
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$value_display['display'] = "quality_de";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_de asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$value_display['display'] = "quality_eng";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_eng asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$value_display['display'] = "quality_fr";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_fr asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$value_display['display'] = "quality_it";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_it asc");	
		}
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"quality",$quality,"","style=width:190px;float:left;margin-top:6px;");
		?><div id="image-icon" style="float:left;margin-left:5px;">
		<?php
		if ($mode != "add"){
			if ($quality ==1){
				echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality1.'"  title="'.$quality1.'">';
			}elseif ($quality ==2){
				echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality2.'"  title="'.$quality2.'">';
			}elseif ($quality ==3){
				echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality3.'"  title="'.$quality3.'">';
			}elseif ($quality ==4){
				echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality4.'"  title="'.$quality4.'">';
			}elseif ($quality ==5){
				echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality5.'"  title="'.$quality5.'">';
			}
		}
		?>
		</div>
		<span class="validation-status"></span> 
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:230px;margin-top:-18px;border:0px solid red;" id="textquality"></div>
		</td>
		<?php } else { ?>
		<td><?php 
		 if ($quality != ""){
		$sql1 = mysql_query("select * from t_quality where id='".$quality."'");
		$row1 = mysql_fetch_array($sql1);
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo $row1['quality_de'];	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $row1['quality_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $row1['quality_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $row1['quality_it'];
		}
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		<?php if ($short_desc !="") {?>
		<tr>
						<td class="key"><label for="short_desc">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=5");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=5");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		</label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<textarea name="short_desc" id="short_desc" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($short_desc)?></textarea>
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="textshort_desc"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($short_desc);?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($long_desc !="") {
		?>
		<tr>
						<td class="key"><label for="long_desc">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=6");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=6");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		</label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<textarea name="long_desc" id="long_desc" style="width:190px;height:auto;min-height:80px;"><?php echo fixEncoding($long_desc)?></textarea>
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-78px;border:0px solid red;" id="textlong_desc"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($long_desc)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} 		?>
		
		<!--start location auto complete/suggestion--->
	<tr>
        <td class="key" valign="top"><label for="location"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=45");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo fixEncoding($rowfield['fieldname_it']);
		}
		?>
		 / <?php
		$sqlfield = mysql_query("select * from t_field_names where id=7");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo fixEncoding($rowfield['fieldname_it']);
		}
		?>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=7");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	
		
				<?php
				
				if ($mode == "add"){
					$location = $rowlastentry['location'];
				}
				
				$rs = mysql_query("SELECT id,concat(loc_name ,', ',loc_detail,' ',loc_adress1, ' ',loc_adress2,' ',loc_zip,' ', loc_loc) as locname  FROM ".DB_TABLE_PREFIX."location where id='$location'");	
					
						$rowlocation = mysql_fetch_array($rs);
						$location = $rowlocation['locname'];
					
				?>
				<input type="text" id="location" name="location" style="width:190px;" maxlength="150" value="<?php echo trim(fixEncoding($location))?>"/>
				
				
				
				<input type="hidden" id="locid" name="locationid" value="<?php if ($mode == "add") { echo $rowlastentry['location'];} else {echo $record->location;}?>" /><br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <a href="index2.php?option=locations2-m&mode=add" id="modalpopup1"><?php $sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}?></a>.
				<div id="clone_location" style="display:none;"/></div>
		
                       
						</td>
                    <?php } else { ?>
                    <td><?php
                    $rs = mysql_query("SELECT id,concat(loc_name ,', ',loc_detail,' ',loc_adress1, ' ',loc_adress2,' ',loc_zip,' ', loc_loc) as locname  FROM ".DB_TABLE_PREFIX."location where id='$location'");
                    
                    $rowlocation = mysql_fetch_array($rs);
						$location = $rowlocation['locname'];
						echo fixEncoding($location);
                    ?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                <!--end location auto complete/suggestion--->
		
		
		<tr>
						<td class="key"><label for="price">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=8");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=8");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { 
						
							if ($mode == "add"){
								$price = $rowlastentry['price'];
							}
						?>
						<td>
							<input type="text" name="price" id="price" style="width:40px;" maxlength="150" value="<?php echo fixEncoding($price)?>" />
											
		
		<b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=9");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=9");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></b> <?php echo $req_fld?>
		
		<div style="display:none;float:right;width:340px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textprice"></div>
		<?php
		$value_display['value'] = "id";
		$value_display['display'] = "currency";
		if ($mode == "add"){$currency= 1;}
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."currency  order by currency asc");	
		echo $scaffold->dropdown_rs2($rs,$value_display,"currency",$currency,"Select Currency","style=width:90px");
		?> 
		<span class="validation-status"></span> 
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcurrency"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $price;
						$sql1 = mysql_query("select * from t_currency where id='".$currency."'");
		$row1 = mysql_fetch_array($sql1);
		echo " ". $row1['currency'];
		$currencyvalue = $row1['currency'];
						?>
						
						</td>
						<?php } ?>                                                                                                    
					</tr>
		
		<?php
		if ($remark_price !="") {
		?>
		
		<tr>
						<td class="key"><label for="remark_price"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=10");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=10");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?> </label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="remark_price" id="remark_price" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($remark_price)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textremark_price"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($remark_price)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($remark_prerequisite !="") {
		?>
		<tr>
						<td class="key"><label for="remark_prerequisite"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=11");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=11");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<textarea name="remark_prerequisite" id="remark_prerequisite" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($remark_prerequisite)?></textarea>
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="textremark_prerequisite"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($remark_prerequisite);?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		}
		?>
		<tr>
						<td class="key"><label for="active_for_reservation">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=404");
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
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=404");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="checkbox" name="active_for_reservation" id="active_for_reservation" value="1" <?php if ($active_for_reservation == 1){ echo ' checked="checked"';}?> />
							
							
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:30px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textactive_for_reservation"></div>
		</td>
						<?php } else { ?>
						<td><?php 
						if ($active_for_reservation == 1){
							$sqlfield = mysql_query("select * from t_field_names where id=281");
						}else{
							$sqlfield = mysql_query("select * from t_field_names where id=280");
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
						?></td>
						<?php } ?>                                                                                                    
					</tr>
	<?php
		if ($active_for_reservation == 1){
	?>	
		<tr>
						<td class="key"><label for="time_start"> <?php
						$sqlfield = mysql_query("select * from t_field_names where id=401");
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
						
		$sqlfield = mysql_query("select * from t_field_names where id=395");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label>
		
		<div style="display:none;float:left;width:220px;margin-left:350px;z-index:10000;position:absolute;margin-top:-10px;border:0px solid red;font-weight:normal;" id="textmin_number"></div>
		</td>
						<?php if ( $is_editable_field ) { ?>
						<td>
						<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=395");
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
		?>: </b>
							<input type="text" name="min_number" id="min_number" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($min_number)?>" />&nbsp;&nbsp;
							<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=396");
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
		?>:</b> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=396");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?> 
		<input type="text" name="max_number" id="max_number" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($max_number)?>" />
						  
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:270px;margin-top:-18px;border:0px solid red;" id="textmax_number"></div>
							
							<span class="validation-status"></span>
		
		</td>
						<?php } else { ?>
						<td><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=395");
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
		?>:</b> <?php echo $min_number?> -
		<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=396");
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
		?>:</b>
		<?php echo $max_number?>
		</td>
						<?php } ?>                                                                                                    
					</tr>			
					
		<tr>
						<td class="key"><label for="cancellation_day1">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=405");
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
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=405");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="cancellation_day1" id="cancellation_day1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_day1)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_day1"></div>
		</td>
						<?php } else { ?>
						<td><div style="float:left;margin-top:4px;"><?php echo $cancellation_day1?></div>
						<?php if ($cancellation_fee1 > 0){?>
						<table style="padding:0px;margin:0px;float:left;margin-left:10px;">
							<tr>
						<td><label for="cancellation_fee1"><b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=407");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=407");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="cancellation_fee1" id="cancellation_fee1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_fee1) . " " . $currencyvalue;?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_fee1"></div>
		</td>
						<?php } else { ?>
						<td>: <?php echo $cancellation_fee1 . " " . $currencyvalue;?></td>
						<?php } ?>                                                                                                    
					</tr>
						</table>
						<?php } ?>
						</td>
						<?php } ?>                                                                                                    
					</tr>
		<?php if ($cancellation_day2 > 0 or $cancellation_day2 != ""){?>			
		<tr>
						<td class="key"><label for="cancellation_day2">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=406");
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
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=406");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="cancellation_day2" id="cancellation_day2" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_day2)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_day2"></div>
		</td>
						<?php } else { ?>
						<td><div style="float:left;margin-top:4px;"><?php echo $cancellation_day2?></div>
						<?php if ($cancellation_fee2 > 0){?>
						<table style="padding:0px;margin:0px;float:left;margin-left:10px;">
							<tr>
						<td><label for="cancellation_fee2"><b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=408");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=408");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		<?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="cancellation_fee1" id="cancellation_fee1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_fee1) . " " . $currencyvalue;?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_fee1"></div>
		</td>
						<?php } else { ?>
						<td>: <?php echo $cancellation_fee2 . " " . $currencyvalue;?></td>
						<?php } ?>                                                                                                    
					</tr>
						</table>
						<?php } ?>
						</td>
						<?php } ?>                                                                                                    
					</tr>			
					
					
		<?php } ?>

		
					
		
		<?php } ?>
					
		
		
		<tr>
						<td class="key"><label for="date_start" id="delete-events">
		<?php
		if ($_REQUEST['eventsid'] != ""){
		$sqlfield = mysql_query("select * from t_field_names where id=285");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$update = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$update = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$update = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$update = fixEncoding($rowfield['fieldname_it']);
		}
		
		?> 
		<span id="delete-photo"></span>
		<div id="system-message" class="system-message" style="display: block;">
		<div class="info">
		<div id="del-result" class="message">
		
		<?php
		if ($not_to_delete_msg == 0){
		echo $update;
		}else{
		$sqlfield = mysql_query("select * from t_field_names where id=287");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$update = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$update = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$update = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$update = fixEncoding($rowfield['fieldname_it']);
		}
		echo $update;
		}
		?>
		</div>
		</div>
		</div>
		
		<?php
		}
		$sqlfield = mysql_query("select * from t_field_names where id=12");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$startdatelabel = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$startdatelabel =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$startdatelabel =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$startdatelabel =fixEncoding($rowfield['fieldname_it']);
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=401");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$numparticipantslabel = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$numparticipantslabel =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$numparticipantslabel =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$numparticipantslabel =fixEncoding($rowfield['fieldname_it']);
		}
		$sqlfield = mysql_query("select * from t_field_names where id=429");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$onwaitinglist = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$onwaitinglist =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$onwaitinglist =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$onwaitinglist =fixEncoding($rowfield['fieldname_it']);
		}
		$sqlfield = mysql_query("select * from t_field_names where id=401");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$participants = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$participants =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$participants =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$participants =fixEncoding($rowfield['fieldname_it']);
		}
		
		?> 
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=13");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$enddatelabel = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$enddatelabel = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$enddatelabel = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$enddatelabel = fixEncoding($rowfield['fieldname_it']);
		}
		?>
		</label></td>
						<?php if ( $is_editable_field ) { ?>
						<td width="600px;">
		
		
		<?php
		if ($mode == "edit"){
		$sql = mysql_query("select * from t_dates where events_id='".$id."'");
		
		$ctr = 0;
		$num_rows = mysql_num_rows($sql);
		
		if ($num_rows == 0){ ?>
			<a href='#addsizeoption' onClick='addformField1(); return false;' id='addsizeoption'>&nbsp;<img src='images/add.png' border='0' /></a>
		<?php	
		}
		
		$num_rows++;
		echo "<span class='validation-status'></span>&nbsp;&nbsp;";
		echo "<div style='float:left;margin-left:14px;width:75px;border:0px solid red;'><b>".$startdatelabel."</b>". $req_fld."</div>";
		echo "<div style='float:left;margin-left:4px;width:75px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
		while ($size_row = mysql_fetch_array($sql)){
		$ctr++;
		
		
		echo '<div style="padding:0px;">';
		
		$eventsid = $size_row['id'];
		$size_id = $size_row['size_id'];
		
		$sqlfield = mysql_query("select * from t_field_names where id=273");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$delete = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$delete =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$delete =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$delete =fixEncoding($rowfield['fieldname_it']);
		}
		
		
		
		if ($ctr == 1){
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<input name='start_date_".$ctr."' id='start_date_".$ctr."' type='text' style='width:60px;' value='".date('d.m.Y',strtotime($size_row['events_start_date']))."' onChange=startdatefunction() onclick=startdatefunctionclick() onblur=startdatefunctionblur() />&nbsp;&nbsp;<span class='validation-status'></span>";
		echo "<input name='end_date_".$ctr."' id='end_date_".$ctr."' type='text' style='width:60px;' value='".date('d.m.Y',strtotime($size_row['events_end_date']))."' onChange=enddatefunction() onclick=enddatefunctionclick() onblur=enddatefunctionblur() /><a href='#addsizeoption' onClick='addformField1(); return false;' id='addsizeoption'>&nbsp;<img src='images/add.png' border='0' /></a>&nbsp;&nbsp;<span class='validation-status'></span>";
		?>
		
		  <input type="hidden" value="<?php echo $num_rows=$num_rows;?>" name="size_num_rows">
			
		<div style="display:none;float:left;width:250px;margin-left:290px;z-index:10000;position:absolute;margin-top:-20px;border:0px solid red;" class="textstart_date"></div>
		<div style="display:none;float:left;width:250px;margin-left:290px;z-index:10000;position:absolute;margin-top:-20px;border:0px solid red;" class="textend_date"></div>
		<?php
		echo "<input type=hidden name='eventsid_".$ctr."' value='".$eventsid."' />";
		}else{
		echo "&nbsp;&nbsp;&nbsp;&nbsp;<input name='start_date_".$ctr."' onChange=startdatefunction() onclick=startdatefunctionclick() onblur=startdatefunctionblur() id='start_date_".$ctr."' class='start_datebox' type='text' style='width:60px;' value='".date('d.m.Y',strtotime($size_row['events_start_date']))."'  />&nbsp;&nbsp;<span class='validation-status'></span>";
		echo "<input name='end_date_".$ctr."' id='end_date_".$ctr."' class='end_datebox' type='text' style='width:60px;' onChange=enddatefunction() onclick=enddatefunctionclick() onblur=enddatefunctionblur() value='".date('d.m.Y',strtotime($size_row['events_end_date']))."'  />";
		?>
		<a href="index.php?option=events-m&mode=edit&id=<?php echo $id?>&eventsid=<?php echo $eventsid;?>#delete-events" onclick="if(!confirm('<?php echo $delete;?> #<?php echo $ctr;?>?')){return false;}"><img src="images/x.png" border="0" alt="Remove" title="Remove"></a>
		<?php
		
		echo "<input type=hidden name='eventsid_".$ctr."' value='".$eventsid."' />";
		}
		}
		}elseif ($mode =="add"){
		?>
		
	
		
		<?php
		$num_rows = 0;
		$sql2 = mysql_query("select * from t_dates where events_id='".$id."'");
		$ctr = 0;
		$num_rows = mysql_num_rows($sql2);
		$num_rows++;
		if ($mode == "edit"){
		$num_rows = $num_rows;
		}else{
		$num_rows = 2;
		}	
		?>
		<div style="padding:3px;">
		
		<div style="position:relative;width:0px;height:0px;z-index:20;">
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		</div>
		<?php
		$id = $size_row['id'];
		
				$sqlfield = mysql_query("select * from t_field_names where id=367");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$optiondates = fixEncoding($rowfield['fieldname_de']);
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$optiondates = fixEncoding($rowfield['fieldname_eng']);
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$optiondates = fixEncoding($rowfield['fieldname_fr']);
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$optiondates = fixEncoding($rowfield['fieldname_it']);
				}
				
				$sqlfield = mysql_query("select * from t_field_names where id=371");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				$duration = fixEncoding($rowfield['fieldname_de']);
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				$duration = fixEncoding($rowfield['fieldname_eng']);
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				$duration = fixEncoding($rowfield['fieldname_fr']);
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				$duration = fixEncoding($rowfield['fieldname_it']);
				}
		
		
		echo "<span class='validation-status'></span>&nbsp;&nbsp;";
		echo "<div style='float:left;margin-left:9px;width:75px;border:0px solid red;'><b>".$startdatelabel."</b> ".$req_fld."</div><div style='float:left;margin-left:5px;width:470px;border:0px solid red;'><b>".$enddatelabel."</b> </div>";
		echo "<br style=clear:both;>";
		
		echo "<div style=float:left;>&nbsp;&nbsp;&nbsp;<input name='start_date_1' id='start_date_1' onChange=startdatefunction(1) onclick=startdatefunctionclick() onblur=startdatefunctionblur() type='text' style='width:60px;' value='".$size_row['size']."'  />&nbsp;&nbsp;<span class='validation-status'></span> <input name='end_date_1' onChange=enddatefunction(1) onclick=enddatefunctionclick() onblur=enddatefunctionblur() id='end_date_1' type='text' style='width:60px;' value='' /> <a href='#addsizeoption' onClick='addformField2(); return false;' id='addsizeoption'>&nbsp;<img src='images/add.png' border='0' /></a> <a href='#addsizeoption' onClick='addrepitition(1); return false;' id='addrepitition_1'>&nbsp;<img src='images/next.jpg' style=margin-top:2px;height:20px;width:25px  border='0' /></a> <a href='#addsizeoption' onClick='deleterepitition(1); return false;' id='deleterepitition_1' style=display:none;>&nbsp;<img src='images/prev.jpg' style=margin-top:3px;height:16px; border='0' /></a></div>";
		
		?>
		
		
		<table id="repititiondiv_1" style="display:none;margin:0px;padding:0px;float:left;">
		<tr>
		<td>
		<select name="dateoption_1" id="dateoption_1" style="margin-left:1px;">
				<?php
				$sqlfield = mysql_query("select * from t_field_names where id=368");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				echo '<option value=daily>'. fixEncoding($rowfield['fieldname_de']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				echo '<option value=daily>'. fixEncoding($rowfield['fieldname_eng']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				echo '<option value=daily>'. fixEncoding($rowfield['fieldname_fr']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				echo '<option value=daily>'. fixEncoding($rowfield['fieldname_it']) . '</option>';
				}
				$sqlfield = mysql_query("select * from t_field_names where id=369");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				echo '<option value=weekly>'. fixEncoding($rowfield['fieldname_de']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				echo '<option value=weekly>'. fixEncoding($rowfield['fieldname_eng']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				echo '<option value=weekly>'. fixEncoding($rowfield['fieldname_fr']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				echo '<option value=weekly>'. fixEncoding($rowfield['fieldname_it']) . '</option>';
				}
				$sqlfield = mysql_query("select * from t_field_names where id=370");
				$rowfield = mysql_fetch_array($sqlfield);
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
				echo '<option value=monthly>'. fixEncoding($rowfield['fieldname_de']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
				echo '<option value=monthly>'. fixEncoding($rowfield['fieldname_eng']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
				echo '<option value=monthly>'. fixEncoding($rowfield['fieldname_fr']) . '</option>';
				}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
				echo '<option value=monthly>'. fixEncoding($rowfield['fieldname_it']) . '</option>';
				}
			?>
			</select>
			
		<?php
		echo "&nbsp;&nbsp;&nbsp;<select id=fixorduration_1 name=fixorduration_1 onchange=fixorduration(1) disabled=disabled><option value=duration>".$durationtimes."</option><option value=fix>".$planningenddatefield."</option></select></select>&nbsp;<input name='duration_1' id='duration_1' onkeyup='anumber(this)' onblur='anumber(this)' type='text' style='width:30px;text-align:center;' maxlength=3 value='1' /> &nbsp;<input name='planning_end_date_1' id='planning_end_date_1' type='text' style='width:60px;display:none;' value='' /> ";
		echo "</div></div></td></tr></table><br style=clear:both;>";
		
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=13");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext1 = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext1 = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext1 = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext1 = $rowfield['helptext_it'];
		}
		if ($helptext1 == "0" or $helptext1 ==""){
		$helptext1 = "";
		}else{
		$helptext1 = $helptext1;
		}
		?>
		  
			
		<?php
			if ($mode == "add"){
		?>
		<div style="display:none;float:left;width:220px;margin-left:450px;z-index:10000;position:absolute;margin-top:-20px;border:0px solid red;" class="textstart_date"></div>
		<div style="display:none;float:left;width:220px;margin-left:450px;z-index:10000;position:absolute;margin-top:-20px;border:0px solid red;" class="textend_date"></div> 
		<?php
		}
		?>
		 <div id="divTxt1"></div>
	
		  <?php
		$sqlfield = mysql_query("select * from t_field_names where id=100");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
		  <input type="hidden" value="<?php echo $num_rows=$num_rows-1;?>" name="size_num_rows">
			
		</td>
						<?php } else { ?>
						<td><?php 
						
						$sqlfield = mysql_query("select * from t_field_names where id=401");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$numparticipants = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$numparticipants = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$numparticipants = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$numparticipants = $rowfield['fieldname_it'];
		}
						
		$sql = mysql_query("select * from t_dates where events_id='".$id."'");
		
		$ctr = 0;
		$num_rows = mysql_num_rows($sql);
		$sqlfield = mysql_query("select * from t_field_names where id=394");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$reservationlink = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$reservationlink =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$reservationlink =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$reservationlink =fixEncoding($rowfield['fieldname_it']);
		}
		$num_rows++;
		
		$sqlfield = mysql_query("select * from t_field_names where id=401");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$numparticipantslabel = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$numparticipantslabel =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$numparticipantslabel =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$numparticipantslabel =fixEncoding($rowfield['fieldname_it']);
		}
		$sqlfield = mysql_query("select * from t_field_names where id=429");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$onwaitinglist = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$onwaitinglist =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$onwaitinglist =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$onwaitinglist =fixEncoding($rowfield['fieldname_it']);
		}
		$sqlfield = mysql_query("select * from t_field_names where id=435");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$participants = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$participants =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$participants =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$participants =fixEncoding($rowfield['fieldname_it']);
		}
		
		
		echo "<span class='validation-status'></span>&nbsp;&nbsp;";
		echo "<div style='float:left;margin-left:14px;width:75px;border:0px solid red;'><b>".$startdatelabel."&nbsp;</b></div>";
		echo "<div style='float:left;margin-left:4px;width:70px;border:0px solid red;'><b>".$enddatelabel."</b></div><div style='float:left;margin-left:4px;width:250px;border:0px solid red;'><b>".$numparticipantslabel."</b></div><br style=clear:both;>";
		while ($size_row = mysql_fetch_array($sql)){
		$ctr++;
		
		
		echo '<div style="padding:0px;">';
		
		$eventsid = $size_row['id'];
		$size_id = $size_row['size_id'];
		
		$sqlfield = mysql_query("select * from t_field_names where id=273");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$delete = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$delete =fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$delete =fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$delete =fixEncoding($rowfield['fieldname_it']);
		}
		
		$getinforeservation = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and reservation_status=1");
		$rowinfo = mysql_fetch_array($getinforeservation);
		
		$getinfowaiting = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and reservation_status=0");
		$rowinfo1 = mysql_fetch_array($getinfowaiting);
		
		
		echo "<div style='float:left;margin-left:14px;width:75px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_start_date']))."</div>";
		echo "<div style='float:left;margin-left:4px;width:70px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div><div style='float:left;width:250px;'><a alt='".$reservationlink."' title='".$reservationlink."' href='components/reservations-export.php?date_id=".$size_row['id']."'><img src=images/icon-downloads.png border=0 style=width:16px;height:16px;/></a>";
		if (mysql_num_rows($getinforeservation) > 0){
			echo " " . mysql_num_rows($getinforeservation) . " " . $participants; 
			if (mysql_num_rows($getinfowaiting) > 0){
				echo " + " . mysql_num_rows($getinfowaiting) . " " . $onwaitinglist;
			}
		}
		echo "</div><br style=clear:both;>";
		}
		
		?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		
		<?php
		 if ($date_remark !="") {
		?>
		<tr>
						<td class="key"><label for="date_remark"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=16");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=16");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="date_remark" id="date_remark" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($date_remark)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textdate_remark"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($date_remark)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($time_start !="" or $time_end != "") {
		?>
		<tr>
						<td class="key"><label for="time_start"> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label>
		
		<div style="display:none;float:left;width:220px;margin-left:350px;z-index:10000;position:absolute;margin-top:-10px;border:0px solid red;font-weight:normal;" id="texttime_start"></div>
		</td>
						<?php if ( $is_editable_field ) { ?>
						<td>
						<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>: </b>
							<input type="text" name="time_start" id="time_start" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($time_start)?>" />&nbsp;&nbsp;
							<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>:</b> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?> 
		<input type="text" name="time_end" id="time_end" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($time_end)?>" />
						  
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:270px;margin-top:-18px;border:0px solid red;" id="texttime_end"></div>
							
							<span class="validation-status"></span>
		
		</td>
						<?php } else { ?>
						<td><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>:</b> <?php echo fixEncoding($time_start);?>&nbsp;&nbsp;
		<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>:</b>
		<?php echo fixEncoding($time_end)?>
		</td>
						<?php } ?>                                                                                                    
					</tr>
		
		<?php
		} if ($remark_time !="") {
		?>
		
		<tr>
						<td class="key"><label for="remark_time"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=21");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=21");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="remark_time" id="remark_time" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($remark_time)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textremark_time"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($remark_time);?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($leader !="") {
		?>
		
		<tr>
			 <td class="key" valign="top"><label for="leader"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=23");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=23");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?><?php echo $req_fld?></label></td>
			 <?php if ( $is_editable_field ) { ?>
				<td>
				<?php
				
				if ($mode == "add"){
								$leader = $rowlastentry['leader'];
							}
				$rs = mysql_query("SELECT *,concat(lastname ,', ',firstname, '  ',company) as companyname FROM ".DB_TABLE_PREFIX."leader where id='$leader'");	
					
								$rowleader = mysql_fetch_array($rs);
								$leader = $rowleader['companyname'];
					
				?>
				<input type="text" id="leader" name="leader" style="width:190px;" maxlength="150" value="<?php echo trim(fixEncoding($leader))?>"/>
				<input type="hidden" id="leader1id" name="leader1id" value="<?php if ($mode == "add") { echo $rowlastentry['leader'];} else {echo $record->leader;}?>" />
				
				
				<div id="clone_leader" style="display:none;"/></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <a href="index2.php?option=leaders2-m&mode=add" id="modalpopup2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></a>.
				<span class="validation-status"></span> </td>
				<?php } else { ?>
				<td><?php 
								 if ($leader != ""){
		$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
		$row1 = mysql_fetch_array($sql1);
		echo fixEncoding($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
		}else{
		echo "";
	}
		?></td>
				<?php } ?>
			</tr>
		<?php
		} if ($leader2 !="") {
		?>	
		<tr>
			 <td class="key" valign="top"><label for="leader2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=326");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=326");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
			 <?php if ( $is_editable_field ) { ?>
				<td>
				<?php
				if ($mode == "add"){
					$leader2 = $rowlastentry['leader2'];
				}
				
				
				$rs = mysql_query("SELECT *,concat(lastname ,', ',firstname, '  ',company) as companyname FROM ".DB_TABLE_PREFIX."leader where id='$leader2'");	
					
								$rowleader = mysql_fetch_array($rs);
								$leader2 = $rowleader['companyname'];
					
				?>
				<input type="text" id="leader2" name="leader2" style="width:190px;" maxlength="150" value="<?php echo trim(fixEncoding($leader2))?>"/>
				<input type="hidden" id="leader2id" name="leader2id" value="<?php if ($mode == "add") { echo $rowlastentry['leader2'];} else {echo $record->leader2;}?>" />
				<div id="clone_leader2" style="display:none;"/></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <a href="index2.php?option=leaders4-m&mode=add" id="modalpopup3"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></a>.
				<span class="validation-status"></span> </td>
				<?php } else { ?>
				<td><?php 
								 if ($leader2 != ""){
		$sql1 = mysql_query("select * from t_leader where id='".$leader2."'");
		$row1 = mysql_fetch_array($sql1);
		echo ($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
		}else{
		echo "";
	}
		?></td>
				<?php } ?>
			</tr>
		
		  <?php
		} if ($event_contact_name !="") {
		?>
		<tr>
						<td class="key"><label for="eve_contact_name"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=24");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=24");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) {
						if ($mode == "add"){
							$eve_contact_name = $rowlastentry['eve_contact_name'];
							$eve_contact_phone = $rowlastentry['eve_contact_phone'];
							$eve_contact_email = $rowlastentry['eve_contact_email'];
							$eve_contact_url = $rowlastentry['eve_contact_url'];
						}
						?>
						<td>
							<input type="text" name="eve_contact_name" id="eve_contact_name" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_name)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_name"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_name)?></td>
						<?php } ?>                                                                                                    
					</tr>
		  <?php
		} if ($event_contact_phone !="") {
		?>
		 
				<tr>
						<td class="key"><label for="eve_contact_phone"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=25");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=25");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="eve_contact_phone" id="eve_contact_phone" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_phone)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_phone"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_phone)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($event_contact_email !="") {
		?>
		<tr>
						<td class="key"><label for="eve_contact_email"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=37");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=37");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="eve_contact_email" id="eve_contact_email" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_email)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_email"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_email)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($event_contact_url !="") {
		?>
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=38");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=38");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="eve_contact_url" onkeyup="nospaces(this)" id="eve_contact_url" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_url)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_url"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_url)?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<!--<tr>
						<td class="key"><label for="quality">Quality </label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="quality" id="quality" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($quality)?>" />
							<span class="validation-status"></span></td>
						<?php } else { ?>
						<td><?php echo $quality?></td>
						<?php } ?>                                                                                                    
					</tr>-->
		<?php
		} if ($eve_image_path !="") {
		?>
		<tr>
			<td class="key"><label for="design_photo"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=33");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>
			  <?php
		$sqlfield = mysql_query("select * from t_field_names where id=33");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?>
			  </label></td>
			<?php if ( $is_editable_field ) { ?>
			<td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
			  <input name="eve_image_path" id="eve_image_path" type="file" size="22" />
			  <span class="validation-status"></span>
		  
		  
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:210px;margin-top:-18px;border:0px solid red;" id="eve_image_path"></div>
			  <?php if ($mode=='edit') echo "</p>" ?>
			</td>
			<?php } else { ?>
			<td><?php echo $design_photo_img?></td>
			<?php } ?>
		  </tr>
<?php
		}
		?>
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=296");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=296");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="reminder" id="reminder" readonly="readonly" style="width:70px;background-color:pink;" maxlength="150"  />
							<?php
								$sqlpro = mysql_query("select * from t_provider where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
								$rowpro = mysql_fetch_array($sqlpro);
								//echo $rowpro['reminder'];
								echo date('d.m.Y',strtotime($rowpro['reminder']));
							?>
							
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:400px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textreminder"></div>
		</td>
						<?php } else { ?>
						<td><?php
								$sqlpro = mysql_query("select * from t_provider where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
								$rowpro = mysql_fetch_array($sqlpro);
								echo date('d.m.Y',strtotime($rowpro['reminder']));
							?></td>
						<?php } ?>                                                                                                    
					</tr>
					<?php if ($mode != "add"){ ?>
		
		<tr>
						<td class="key"><label for="timestamp"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=29");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=29");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
		$helptext = "";
		}else{
		$helptext = $helptext;
		}
		?></label></td>

						<td><?php 
		$sqlp = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE `id` = '{$provider}'") ;
		$rowp = mysql_fetch_array($sqlp);
		echo $rowp['firstname'] . " " . $rowp['lastname'];
		?></td>
					</tr>
		
		<tr>
						<td class="key"><label for="timestamp">Record Created </label></td>

						<td><?php echo $timestamp;?></td>
					</tr>
		<?php if ($last_change != "0000-00-00 00:00:00"){?>
		<tr>
						<td class="key"><label for="last_change">Record Last Updated </label></td>

						<td><?php echo $last_change;?></td>                   
					</tr>
		<?php 
		}
		} ?>
				<tr>
				<td class="key">
				<?php
		$sqlfield = mysql_query("select * from t_field_names where id=443");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>
				</td>
				<td><input type="checkbox" name="checked" id="checked" /></td>
		</table>
		<script>
		$(document).ready(function() {
		$('#checked').click(function () {
			if ($(this).is(":checked")){
				$('#color-divs').show();
			}else{
				$('#color-divs').hide();
			}
		});
			
		
		})
		



		</script>
		
			
			
			
	
		<table class="form-table" id="color-divs" style="display:none;">
		
		<tr>
			<td>
			<iframe width="600px" height="300px" src="http://manimano.ch/wlw/demo.php?events_id=<?php echo $id;?>" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>
			</td>
		</tr>
		
		
		</table>
		
		  </fieldset>    
			
		</form>
	</div>

