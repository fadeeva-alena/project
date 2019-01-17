	<?php
	$mode = "";
	$upload_dir = "uploads/";
	if ( isset($_GET['mode']) ) {
		$mode = strtolower(trim($_GET['mode']));	
	} elseif ( isset($_POST['mode']) ) {
		$mode = strtolower(trim($_POST['mode']));
	}
	//echo "mode goes here : ".$mode;
	$id = 0;
	if (@$_GET['id'] > 0 ) {
		$id = $_GET['id'];
	} elseif ( isset($_POST['id']) ) {
		$id = $_POST['id'];
	}
	if ($_REQUEST['eventsid']!=""){
	  $eventsid = $_REQUEST['eventsid'];
	  mysql_query("delete from t_dates where id='".$eventsid."'");
	  $not_to_delete_msg = 0;
	 }else{
		$not_to_delete_msg = 1;
	}

	$sqlfield = mysql_query("select * from t_field_names where id=361");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$error_file = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$error_file = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$error_file = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$error_file = $rowfield['fieldname_it'];
		}
	$sqlfield = mysql_query("select * from t_field_names where id=337");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$error_url = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$error_url = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$error_url = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$error_url = $rowfield['fieldname_it'];
		}

	$sqlfield = mysql_query("select * from t_field_names where id=292");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$error_email = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$error_email = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$error_email = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$error_email = $rowfield['fieldname_it'];
		}


	$sub_heading = ucfirst($mode);
	if ($mode == "add"){
		$sqlfield = mysql_query("select * from t_field_names where id=262");
	}elseif ($mode == "edit"){
		$sqlfield = mysql_query("select * from t_field_names where id=272");
	}elseif ($mode == "view"){
		$sqlfield = mysql_query("select * from t_field_names where id=284");
	}else{
		$sqlfield = mysql_query("select * from t_field_names where id=273");
	}
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$sub_heading = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$sub_heading = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$sub_heading = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$sub_heading = $rowfield['fieldname_it'];
	}

	$button = $helper->button_val($mode, "");
	$is_editable_field = $helper->is_editable($mode);
	$req_fld = $is_editable_field==true ? REQ_FIELD : "";

	$form_action = strtoupper($_POST['form_action']);

	$tablename = DB_TABLE_PREFIX.'event';

	if ( $form_action != '' ) {
		$post_data = array();
		foreach( $_POST as $varname => $value )
		{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = trim($$varname);
		}	
		unset($post_data['form_action']);
		unset($post_data['reminder']);
		unset($post_data['mode']);	
		unset($post_data['id']);
		unset($post_data['Submit']);
		unset($post_data['providername']);
		unset($post_data['search_keyword']);
		//$helper->pre_print_r($post_data); exit();

		$is_file_uploaded = false;
		$new_file = $_FILES['eve_image_path'];	  
		$filename = $new_file['name'];
		$filename = str_replace(' ', '_', $filename);
		$file_tmp = $new_file['tmp_name'];	
		$ext = strtolower(strrchr($filename,'.'));

		$new_filename = '';
		$unique_id = $helper->unique_id();
		$upload_result_msg = '';
		
		// Check if the file was selected or not.

		$is_valid_file = true;


		if ($is_valid_file==true)
		{
		$upload_result_msg .= "Failed to upload.<br>";
		$is_file_uploaded = false;
		
		// Upload the file	
		$new_filename = $unique_id.$ext;
		if (move_uploaded_file($file_tmp,$upload_dir.$new_filename))
		{	   	   	
		$info = getimagesize($upload_dir.$new_filename);
		list($width_old, $height_old) = $info;
		$img_width = 450;
		$img_height = 350;
		$img_thumb_width = 450;
		$img_thumb_height = 350;
		
		if ( $width_old < $img_width ) {
		$img_width = $width_old;
		$img_height = $img_height;
		}
		
		// Resize to required size
		// Large
		if ( $image->create_image( $upload_dir, $new_filename, $new_filename, $img_width, $img_height, true, false) )
		{
		// Thumbnail
		$new_filename_thumb = $unique_id."_thumb".$ext;
		if ( $image->create_image( $upload_dir, $new_filename, $new_filename_thumb, $img_thumb_width, $img_thumb_height, true, false) )
		{
		$upload_result_msg .= "Uploaded.<br>";
		$is_file_uploaded = true;	   
		} else {
		$upload_result_msg .= "Failed to upload.<br>";
		}
		} else {
		$upload_result_msg .= "Failed to upload.<br>";
		}
		
		}else{
		$upload_result_msg .= "Failed to upload.<br>";
		}
		}

		if ($is_file_uploaded==true) {
		$post_data['eve_image_path'] = $new_filename;
		} else {
		unset($post_data['eve_image_path']);
		}
		
		if ($post_data['eve_contact_url'] != ""){
			if (strpos($post_data['eve_contact_url'],"http") === false){
				$post_data['eve_contact_url'] = "http://" . $post_data['eve_contact_url'];
			}
		}
		
		
		if (!is_numeric($post_data['time_start'])){
		if (strlen($post_data['time_start']) == 1){
		$post_data['time_start'] = "0".$post_data['time_start'] . ":00:00";
		}elseif (strlen($post_data['time_start']) == 2){
		$post_data['time_start'] = $post_data['time_start'] . ":00:00";
		}elseif (strlen($post_data['time_start']) == 4){
		$post_data['time_start'] = "0".$post_data['time_start'] . ":00";
		}elseif (strlen($post_data['time_start']) == 5){
		$post_data['time_start'] = $post_data['time_start'] . ":00";
		}
		$post_data['time_start'] = str_replace(' ',':',$post_data['time_start']);
		$post_data['time_start'] = str_replace('.',':',$post_data['time_start']);
		}else{
		if (strlen($post_data['time_start']) == 1){
		$post_data['time_start'] = "0".$post_data['time_start'] . ":00:00";
		}elseif (strlen($post_data['time_start']) == 2){
		$post_data['time_start'] = $post_data['time_start'] . ":00:00";
		}elseif (strlen($post_data['time_start']) == 3){
		$partone = substr($post_data['time_start'], 0, 1);
		$parttwo = substr($post_data['time_start'], 1, 2);
		$post_data['time_start'] = "0".$partone.":".$parttwo . ":00";
		}elseif (strlen($post_data['time_start']) == 4){
		$partone = substr($post_data['time_start'], 0, 2);
		$parttwo = substr($post_data['time_start'], 2, 2);
		$post_data['time_start'] = "0".$partone.":".$parttwo . ":00";
		}elseif (strlen($post_data['time_start']) == 5){
		$partone = substr($post_data['time_start'], 0, 1);
		$parttwo = substr($post_data['time_start'], 2, 2);
		$partthree = substr($post_data['time_start'], 4, 1);
		$post_data['time_start'] = "0".$partone.":".$parttwo . ":".$partthree;
		}elseif (strlen($post_data['time_start']) == 6){
		$partone = substr($post_data['time_start'], 0, 1);
		$parttwo = substr($post_data['time_start'], 2, 2);
		$partthree = substr($post_data['time_start'], 4, 2);
		$post_data['time_start'] = $partone.":".$parttwo . ":".$partthree;
		}
		$post_data['time_start'] = str_replace(' ',':',$post_data['time_start']);
		$post_data['time_start'] = str_replace('.',':',$post_data['time_start']);
		}
		
		
		if (!is_numeric($post_data['time_end'])){
		if (strlen($post_data['time_end']) == 1){
		$post_data['time_end'] = "0".$post_data['time_end'] . ":00:00";
		}elseif (strlen($post_data['time_end']) == 2){
		$post_data['time_end'] = $post_data['time_end'] . ":00:00";
		}elseif (strlen($post_data['time_end']) == 4){
		$post_data['time_end'] = "0".$post_data['time_end'] . ":00";
		}elseif (strlen($post_data['time_end']) == 5){
		$post_data['time_end'] = $post_data['time_end'] . ":00";
		}
		$post_data['time_end'] = str_replace(' ',':',$post_data['time_end']);
		$post_data['time_end'] = str_replace('.',':',$post_data['time_end']);
		}else{
		if (strlen($post_data['time_end']) == 1){
		$post_data['time_end'] = "0".$post_data['time_end'] . ":00:00";
		}elseif (strlen($post_data['time_end']) == 2){
		$post_data['time_end'] = $post_data['time_end'] . ":00:00";
		}elseif (strlen($post_data['time_end']) == 3){
		$partone = substr($post_data['time_end'], 0, 1);
		$parttwo = substr($post_data['time_end'], 1, 2);
		$post_data['time_end'] = "0".$partone.":".$parttwo . ":00";
		}elseif (strlen($post_data['time_end']) == 4){
		$partone = substr($post_data['time_end'], 0, 2);
		$parttwo = substr($post_data['time_end'], 2, 2);
		$post_data['time_end'] = "0".$partone.":".$parttwo . ":00";
		}elseif (strlen($post_data['time_end']) == 5){
		$partone = substr($post_data['time_end'], 0, 1);
		$parttwo = substr($post_data['time_end'], 2, 2);
		$partthree = substr($post_data['time_end'], 4, 1);
		$post_data['time_end'] = "0".$partone.":".$parttwo . ":".$partthree;
		}elseif (strlen($post_data['time_end']) == 6){
		$partone = substr($post_data['time_end'], 0, 1);
		$parttwo = substr($post_data['time_end'], 2, 2);
		$partthree = substr($post_data['time_end'], 4, 2);
		$post_data['time_end'] = $partone.":".$parttwo . ":".$partthree;
		}
		$post_data['time_end'] = str_replace(' ',':',$post_data['time_end']);
		$post_data['time_end'] = str_replace('.',':',$post_data['time_end']);
		}
		
		if ($_POST['reminder'] != ""){
			$reminder = $_POST['reminder'];
			$reminder = date('Y-m-d',strtotime($reminder));
			mysql_query("update t_provider set reminder='$reminder' where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
			$updatereminder = 1;
		}
	}

	$result = '';

	switch ($form_action)
	{
		case 'ADD':	
		$post_data['timestamp'] = "now";
		$post_data['provider'] = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		
		unset($post_data['product_color_id']);	
		
		for ($count = 1; $count <=20; $count++)	{
		unset($post_data['start_date_' . $count]);
		unset($post_data['end_date_' . $count]);
		unset($post_data['size_num_rows']);
		}
		
		
		
		$id = $sql_helper->insert_all($tablename,$post_data);
		if ($id > 0){
		
		$sqlfield = mysql_query("select * from t_field_names where id=277");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$add = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$add = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$add = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$add = $rowfield['fieldname_it'];
		}
		$post_data_activity_log['activity_log_content_id'] = "0";
		$post_data_activity_log['session_id'] = $_SESSION[WEBSITE_ALIAS]['session_id'];
		$post_data_activity_log['module_name'] = $page_heading;
		$post_data_activity_log['command'] = $add;
		$post_data_activity_log['command_time'] = "now";
		$sql_helper->insert_all("t_activity_log_content",$post_data_activity_log);
		
		for ($count = 1; $count <=20; $count++)	{
		$date_start = $_POST['start_date_' . $count];
		$date_end = $_POST['end_date_' . $count];
		if ($date_start !=""){
		$date_start = date('Y-m-d',strtotime($date_start));
		}
		
		
		if ($date_end == ""){
		$date_end = $date_start;
		}else{
		$date_end = date('Y-m-d',strtotime($date_end));
		}
		if ($date_start != ""){
		mysql_query("insert into t_dates values ('0','$id','$date_start','$date_end')");
		}
		
		unset($post_data['date_start_' . $count]);
		unset($post_data['date_end_' . $count]);
		
		
		}
		}
		
		
		
		$is_added = $id > 0 ? true : false;	
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."events&a=add&success=".$result);
		break;
		
		case 'EDIT':	
		unset($post_data['size_num_rows']);
		$num_rows = $_POST['size_num_rows'];
		for ($count = 1; $count <=20; $count++)	{
		unset($post_data['start_date_' . $count]);
		unset($post_data['end_date_' . $count]);
		unset($post_data['eventsid_' . $count]);
		unset($post_data['size_num_rows']);
		
		}
		for ($count = 1; $count <=20; $count++)	{
		$date_start = $_POST['start_date_' . $count];
		$date_end = $_POST['end_date_' . $count];
		$events_id = $_POST['eventsid_' . $count];
		if ($date_start !=""){
		$date_start = date('Y-m-d',strtotime($date_start));
		}
		
		

		if ($date_end == ""){
		$date_end = $date_start;
		}else{
		$date_end = date('Y-m-d',strtotime($date_end));
		}
		
		
		if ($date_start != ""){
		if ($count <= $num_rows){
		$updatesize = mysql_query("update t_dates set events_start_date='$date_start',events_end_date='$date_end' where id='$events_id'");
		
		if (mysql_affected_rows() == 1){
		$updatesize++;
		}
		//echo "update". $ctr;
		}else{
		$updatesize = mysql_query("insert into t_dates values ('0','$id','$date_start','$date_end')");
		if (mysql_affected_rows() == 1){
		$updatesize++;
		}
		}
		
		}
		
		
		unset($post_data['date_start_' . $count]);
		unset($post_data['date_end_' . $count]);
		
		
		}
		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1  or $updatesize > 0 or $updatereminder == 1) {
		
		
		$sqlfield = mysql_query("select * from t_field_names where id=278");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$add = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$add = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$add = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$add = $rowfield['fieldname_it'];
		}
		$post_data_activity_log['activity_log_content_id'] = "0";
		$post_data_activity_log['session_id'] = $_SESSION[WEBSITE_ALIAS]['session_id'];
		$post_data_activity_log['module_name'] = $page_heading;
		$post_data_activity_log['command'] = $add;
		$post_data_activity_log['command_time'] = "now";
		$sql_helper->insert_all("t_activity_log_content",$post_data_activity_log);
		
		
		$post_data['last_change'] = "now";
		$sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		$result='true';
		} elseif ( $is_updated == 0 ) {
		$result='';
		} else {
		$result='false';
		}
		//header("Location: ".INDEX_PAGE."events&a=edit&success=".$result);
		
		header("Location: ".INDEX_PAGE."events&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&a=edit&success=".$result);
		
		break;
		
		case 'DELETE':
		$sqlfield = mysql_query("select * from t_field_names where id=280");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$yes = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$yes = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$yes = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$yes = $rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=281");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$no = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$no = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$no = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$no = $rowfield['fieldname_it'];
		}
		
		if ( ($_POST["Delete"] == $yes) ) {
		$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
		$sqlfield = mysql_query("select * from t_field_names where id=285");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$add = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$add = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$add = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$add = $rowfield['fieldname_it'];
		}
		$post_data_activity_log['activity_log_content_id'] = "0";
		$post_data_activity_log['session_id'] = $_SESSION[WEBSITE_ALIAS]['session_id'];
		$post_data_activity_log['module_name'] = $page_heading;
		$post_data_activity_log['command'] = $add;
		$post_data_activity_log['command_time'] = "now";
		$sql_helper->insert_all("t_activity_log_content",$post_data_activity_log);
		$result = $count_deleted > 0 ? 'true' : 'false';
		header("Location: ".INDEX_PAGE."events&a=delete&success=".$result);
		} elseif ( $_POST["Delete"] == $no ) {
		header("Location: ".INDEX_PAGE."events");
		} else { 
		header("Location: ".INDEX_PAGE."events-m&id=".$id);
		}	
		break;
		
		case 'VIEW':
		header("Location: ".INDEX_PAGE."events");
		break;

	}

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
	<script src="plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
	<link href="plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> 

	<script src="js/jquery.timepicker.js" type="text/javascript" language="Javascript"></script>

	<script type="text/javascript">
	
	
	$(document).ready(function() {
		var validator = $("#frm_<?php echo $page_name?>").validate({
		
		rules: {
		title: {
		required: true
		},
		kind: {
		required: true
		},type: {
		required: true
		},quality: {
		required: true
		},short_desc: {
		//required: true
		},
		long_desc: {
		//required: true
		},
		location: {
		required: true
		},
		price: {
		required: true
		},
		<?php
		if ($mode=='edit' or $mode == 'add') { 
		for ($i= 1;$i<=20;$i++){
		echo 'start_date_'.$i.': {
		required: true
		},';
		}
		}
		?>
		currency: {
		required: true
		},
		remark_price: {
		//required: true
		},
		remark_prerequisite: {
		//required: true
		},eve_image_path: {
		<?php if ($mode == "add") { ?>
		//required: true,
		<?php } ?>
		accept: "(jpg|gif|png|jpeg)"
		}
		
		

		,date_start: {
		required: true
		},date_end: {
		//required: true
		},date_remark: {
		//required: true
		},time_start: {
		//required: true
		},time_end: {
		//required: true
		},remark_time: {
		//required: true
		},leader: {
		required: true
		},provider: {
		required: true
		}
		,eve_contact_name: {
		//required: true
		},eve_contact_gender: {
		//required: true
		},eve_contact_email: {
		//required: true,
		email:true
		},eve_contact_url: {
		//required: true,
		url: true
		},eve_contact_phone: {
		//required: true
		},quality: {
		//required: true
		}
		},
		messages: {
		
		title: {
		required: "<?php echo $messages['validate']['required']?>"
		},
		kind: {
		required: "<?php echo $messages['validate']['required']?>"
		},type: {
		required: "<?php echo $messages['validate']['required']?>"
		},quality: {
		required: "<?php echo $messages['validate']['required']?>"
		},short_desc: {
		//required: "<?php echo $messages['validate']['required']?>"
		},
		long_desc: {
		//required: "<?php echo $messages['validate']['required']?>"
		},
		location: {
		required: "<?php echo $messages['validate']['required']?>"
		},
		price: {
		required: "<?php echo $messages['validate']['required']?>"
		},
		currency: {
		required: "<?php echo $messages['validate']['required']?>"
		},
		remark_price: {
		//required: "<?php echo $messages['validate']['required']?>"
		},
		remark_prerequisite: {
		//required: "<?php echo $messages['validate']['required']?>"
		},
		
		eve_image_path: {
		//required: "<?php echo $messages['validate']['required']?>",
		accept: "<?php echo $error_file;?>"
		},
		date_start: {
		required: "<?php echo $messages['validate']['required']?>"
		},date_end: {
		required: "<?php echo $messages['validate']['required']?>"
		},date_remark: {
		required: "<?php echo $messages['validate']['required']?>"
		},time_start: {
		required: "<?php echo $messages['validate']['required']?>"
		},time_end: {
		required: "<?php echo $messages['validate']['required']?>"
		},remark_time: {
		//required: "<?php echo $messages['validate']['required']?>"
		},leader: {
		required: "<?php echo $messages['validate']['required']?>"
		},provider: {
		required: "<?php echo $messages['validate']['required']?>"
		},eve_contact_name: {
		//required: "<?php echo $messages['validate']['required']?>"
		},eve_contact_gender: {
		//required: "<?php echo $messages['validate']['required']?>"
		},eve_contact_email: {
		email: "<?php echo $error_email;?>"
		},eve_contact_url: {
		url: "<?php echo $error_url;?>"
		},eve_contact_phone: {
		//required: "<?php echo $messages['validate']['required']?>"
		},
	<?php
		if ($mode=='edit' or $mode == 'add') { 
		for ($i= 1;$i<=20;$i++){
		echo 'start_date_'.$i.': {
		required: ""
		},';
		}
		}
		?>quality: {
		//required: "<?php echo $messages['validate']['required']?>"
		}
		},
		errorPlacement: function(error, element) {
		if ( element.is(":radio") )
		error.appendTo( element.parent().next().next() );
		else if ( element.is(":checkbox") )
		error.appendTo ( element.next() );
		else
		error.appendTo( element.parent().find('span.validation-status') );
		}
		});
		
		$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE."events"?>';
		});
		
		
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
		?>
		$("#quality").change(function() 
		{ 
		
			var quality = $("#quality").val(); 
			
			if (quality !=""){
				if (quality == 1){
					$("#image-icon").html('<img src=images/'+quality+'.png width=30px height=30px alt="<?php echo $quality1;?>" title="<?php echo $quality1;?>">');
				}else if (quality == 2){
					$("#image-icon").html('<img src=images/'+quality+'.png width=30px height=30px alt="<?php echo $quality2;?>" title="<?php echo $quality2;?>">');
				}else if (quality == 3){
					$("#image-icon").html('<img src=images/'+quality+'.png width=30px height=30px alt="<?php echo $quality3;?>" title="<?php echo $quality3;?>">');
				}else if (quality == 4){
					$("#image-icon").html('<img src=images/'+quality+'.png width=30px height=30px alt="<?php echo $quality4;?>" title="<?php echo $quality4;?>">');
				}else if (quality == 5){
					$("#image-icon").html('<img src=images/'+quality+'.png width=30px height=30px alt="<?php echo $quality5;?>" title="<?php echo $quality5;?>">');
				}
		}else{
		$("#image-icon").html('');
		}
		}); 
		
	});

		/*function startdatefunction(dateid){
			var startdate = $("#start_date_" + dateid).val();
			var enddate = $("#end_date_" + dateid).val();
			if (enddate == "" || enddate <=startdate){
				$("#end_date_" + dateid).val(startdate);
			}
		}*/
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
		function startdatefunctionclick(){
			$('.textstart_date').show();
			$('.textstart_date').html('<?php echo $helptext;?>');
		}
		
		function startdatefunctionblur(){
			
			$('.textstart_date').hide();
			$('.textstart_date').html('');
		}
		
		function startdatefunction(dateid){		
			var datestart = $("#start_date_" + dateid).val();
			//alert(datestart);
			var fetch = new String(datestart);
			var startdatelist = fetch.split('.');
			var startdate = startdatelist[2] + "" + startdatelist[1] + "" + startdatelist[0];
			
			var dateend = $("#end_date_" + dateid).val();
			var fetch1 = new String(dateend);
			var enddatelist = fetch1.split('.');
			var enddate = enddatelist[2] + "" + enddatelist[1] + "" + enddatelist[0];
	
			//alert("Start Date: " + startdate + " End Date: " + enddate);
	
			if (startdate == "" || enddate <= startdate || dateend == ""){
				$("#end_date_" + dateid).val(datestart);
			}
		}
		
		
		function enddatefunctionclick(){
			$('.textend_date').show();
			$('.textend_date').html('<?php echo $helptext1;?>');
		}
		
		function enddatefunctionblur(){
			
			$('.textend_date').hide();
			$('.textend_date').html('');
		}
		
		function enddatefunction(dateid){		
			var datestart = $("#start_date_" + dateid).val();
			//alert(datestart);
			var fetch = new String(datestart);
			var startdatelist = fetch.split('.');
			var startdate = startdatelist[2] + "" + startdatelist[1] + "" + startdatelist[0];
			
			var dateend = $("#end_date_" + dateid).val();
			var fetch1 = new String(dateend);
			var enddatelist = fetch1.split('.');
			var enddate = enddatelist[2] + "" + enddatelist[1] + "" + enddatelist[0];
	
			//alert("Start Date: " + startdate + " End Date: " + enddate);
	
			if (startdate == "" || enddate <= startdate){
				$("#start_date_" + dateid).val(dateend);
			}
		}
	//->calendar function
		$(document).ready(function() {
		
		
		
		$('.hasDatePicker').change(function () {
		
		for (xx == 2;xx<=20;xx++){
				//alert(xx);
				var startdate = $("#start_date_" + xx).val();
				//alert(startdate);
				var enddate = $("#end_date_" + xx).val();
				if (enddate == "" || enddate <=startdate){
					$("#end_date_" + xx).val(startdate);
				}
				if (startdate == "" || enddate > startdate){
					$("#start_date_" + xx).val(enddate);
				}	
		}
		});
		
		$(".hasDatePicker").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});
		//$(".dateentry").removeClass('hasDatepicker').datepicker();
		<?php for ($x = 0;$x<=20;$x++){?>
			$("#start_date_<?php echo $x;?>").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			changeMonth: true,
			firstDay:1,
			changeYear: true});	
		
		
		$("#end_date_<?php echo $x;?>").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			changeMonth: true,
			firstDay:1,
			changeYear: true});

		//->start date changed
		$("#start_date_<?php echo $x;?>").change(function () {
			/*var startdate = $("#start_date_<?php echo $x;?>").val();
			var enddate = $("#end_date_<?php echo $x;?>").val();
			if (enddate == "" || enddate <=startdate){
				$("#end_date_<?php echo $x;?>").val(startdate);
			}*/
			
			var datestart = $("#start_date_<?php echo $x;?>").val();
			//alert(datestart);
			var fetch = new String(datestart);
			var startdatelist = fetch.split('.');
			var startdate = startdatelist[2] + "" + startdatelist[1] + "" + startdatelist[0];
			
			var dateend = $("#end_date_<?php echo $x;?>").val();
			var fetch1 = new String(dateend);
			var enddatelist = fetch1.split('.');
			var enddate = enddatelist[2] + "" + enddatelist[1] + "" + enddatelist[0];
	
			//alert("Start Date: " + startdate + " End Date: " + enddate);
	
			if (enddate == "" || enddate <= startdate){
				$("#end_date_<?php echo $x;?>").val(datestart);
			}
			
			
			
			
			
			
		});

		//->end date changed
		
		$("#end_date_<?php echo $x;?>").change(function () {
			/*var startdate = $("#start_date_<?php echo $x;?>").val();
			var enddate = $("#end_date_<?php echo $x;?>").val();
			if (startdate == "" || enddate < startdate){
				$("#start_date_<?php echo $x;?>").val(enddate);
			}*/
			
			
			var datestart = $("#start_date_<?php echo $x;?>").val();
			//alert(datestart);
			var fetch = new String(datestart);
			var startdatelist = fetch.split('.');
			var startdate = startdatelist[2] + "" + startdatelist[1] + "" + startdatelist[0];
			
			var dateend = $("#end_date_<?php echo $x;?>").val();
			var fetch1 = new String(dateend);
			var enddatelist = fetch1.split('.');
			var enddate = enddatelist[2] + "" + enddatelist[1] + "" + enddatelist[0];
	
			//alert("Start Date: " + startdate + " End Date: " + enddate);
	
			if (startdate == "" || enddate < startdate){
				$("#start_date_<?php echo $x;?>").val(dateend);
			}
			
		});
		
		$("#reminder").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});
		
		
		
		<?php } ?>
		
		/*$("input.hasDatepicker").change(function() 
		{ 
			pos = this.id;
			alert(pos);
			var fetch = new String(pos);
			var fetchlist = fetch.split('_');
			alert("ID: " + fetchlist[0] + " #:" + fetchlist[2]);
		});
		
		$("input.dateentry").change(function() 
		{ 
			pos = this.id;
			alert(pos);
			var fetch = new String(pos);
			var fetchlist = fetch.split('_');
			alert("ID: " + fetchlist[0] + " #:" + fetchlist[2]);
		});*/
		
		$('input').filter('.hasDatepicker dateentry').change(function() 
		{ 
			pos = this.id;
			//alert(pos);
			var fetch = new String(pos);
			var fetchlist = fetch.split('_');
			//alert("ID: " + fetchlist[0] + " #:" + fetchlist[2]);
		});
		 

		
		/*$('#time_start,#time_end').timepicker({
		showSecond: true,
		timeFormat: 'hh:mm:ss',
		stepHour: 1,
		stepMinute: 1,
		stepSecond: 1
		});*/
		

		
		
		$("a.#modalpopup1,a.#modalpopup2,,a.#modalpopup3,a.#modalpopup4").fancybox({
		'titlePosition'	: 'inside',
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'
		});
		
		
		})	

	</script>
	<style>
	div.time-picker {
	  position: absolute;
	  height: 191px;
	  overflow: auto;
	  background: #fff;
	  border: 1px solid #aaa;
	  z-index: 99;
	  margin: 0;
	  width:5em;
	}
	div.time-picker-12hours {
	  width:5em; /* needed for IE */
	}

	div.time-picker ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	}
	div.time-picker li {
	  cursor: pointer;
	  height: 10px;
	  font: 12px/1 Helvetica, Arial, sans-serif;
	  padding: 4px 3px;
	}
	div.time-picker li.selected {
	  background: #0063CE;
	  color: #fff;
	}
	</style>
	<script type="text/javascript">
	  $(document).ready(function() {
		// Default.
		//$("#time_start").timePicker();
		//$("#time_end").timePicker();
		// 02.00 AM - 03.30 PM, 15 minutes steps.
		/*$("#time_start,#time_end").timePicker({
		  //startTime: "02.00",  // Using string. Can take string or Date object.
		  endTime: new Date(0, 0, 0, 15, 30, 0),  // Using Date object.
		  show24Hours: false,
		  separator:':',
		  step: 30});*/	
	  });
	  </script>
	<h1><?php echo $page_heading?> <small>[ <?php echo $sub_heading?> ]</small></h1>

	<?php if ( $mode == 'delete' ) { ?>
		<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" name="frm_<?php echo $page_name?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
			<input type="hidden" name="mode" value="<?php echo $mode?>">
		<input type="hidden" name="id" value="<?php echo $id?>">	
		<div class="alert">
		<div class="message">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=279");
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
		?>?&nbsp;&nbsp;
		<input class="button button-short" name="Delete" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=280");
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
		?>" />&nbsp;&nbsp;
				<input class="button button-short" name="Delete" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=281");
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
		?>" />
				</div>
		</div>
		</form>
		</div>
	<?php } ?>

	<div class="content-main wide90">
		<?php if ( $is_editable_field ) { ?>
		<div class="standard-form-instruction"><strong></strong> <?php echo $req_fld?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=229");
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
		?></div>
		<?php } ?>
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
		echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $rowfield['fieldname_it'];
		}
		?></legend>
				<table class="form-table">            	
					<tr>
						<td class="key"><label for="title">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=1");
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
		<script>
		$(document).ready(function() {
		$('#title').focus(function () {
		$('#texttitle').show();
		$('#texttitle').html('<?php echo $helptext;?>');
		});
		$('#title').blur(function () {
		$('#texttitle').hide();
		$('#texttitle').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textlastname"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $title?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<tr>
		 <td class="key"><label for="kind">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=3");
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
		<script>
		$(document).ready(function() {
		$('#kind').focus(function () {
		$('#textkind').show();
		$('#textkind').html('<?php echo $helptext;?>');
		});
		$('#kind').blur(function () {
		$('#textkind').hide();
		$('#textkind').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textkind"></div>
		</td>
		<?php } else { ?>
		<td><?php 
		 if ($kind != ""){
		$sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
		$row1 = mysql_fetch_array($sql1);
		//echo $row1['kind_eng'];
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo $row1['kind_de'];	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $row1['kind_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $row1['kind_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $row1['kind_it'];
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
		echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $rowfield['fieldname_it'];
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
		<span class="validation-status"></span> <script>
		$(document).ready(function() {
		$('#type').focus(function () {
		$('#texttype').show();
		$('#texttype').html('<?php echo $helptext;?>');
		});
		$('#type').blur(function () {
		$('#texttype').hide();
		$('#texttype').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texttype"></div></td>
		<?php } else { ?>
		<td><?php 
		 if ($type != ""){
		$sql1 = mysql_query("select * from t_event_type where id='".$type."'");
		$row1 = mysql_fetch_array($sql1);
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo $row1['eventtype_de'];	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $row1['eventtype_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $row1['eventtype_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $row1['eventtype_it'];
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
		echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $rowfield['fieldname_it'];
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
		<script>
		$(document).ready(function() {
		$('#quality').focus(function () {
		$('#textquality').show();
		$('#textquality').html('<?php echo $helptext;?>');
		});
		$('#quality').blur(function () {
		$('#textquality').hide();
		$('#textquality').html('');
		});
		})
		</script>
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
		
		<tr>
						<td class="key"><label for="short_desc">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=5");
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
		<script>
		$(document).ready(function() {
		$('#short_desc').focus(function () {
		$('#textshort_desc').show();
		$('#textshort_desc').html('<?php echo $helptext;?>');
		});
		$('#short_desc').blur(function () {
		$('#textshort_desc').hide();
		$('#textshort_desc').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="textshort_desc"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $short_desc?></td>
						<?php } ?>                                                                                                    
					</tr>
		<tr>
						<td class="key"><label for="long_desc">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=6");
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
		<script>
		$(document).ready(function() {
		$('#long_desc').focus(function () {
		$('#textlong_desc').show();
		$('#textlong_desc').html('<?php echo $helptext;?>');
		});
		$('#long_desc').blur(function () {
		$('#textlong_desc').hide();
		$('#textlong_desc').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-78px;border:0px solid red;" id="textlong_desc"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $long_desc?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<tr>
		 <td class="key" valign="top"><label for="location">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=7");
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
		?>
		 <?php echo $req_fld?></label></td>
		 <?php if ( $is_editable_field ) { ?>
		<td><?php
		$value_display['value'] = "id";
		$value_display['display'] = "locname";
		
		//$value_display['display'] = fixEncoding($value_display['display']);
		
		if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1 or $_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
		{	
		$userlevelgain ="";
		}else{
		$userlevelgain =" where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
		}
		$rs = $db->get_results("SELECT id,concat(loc_name ,', ',loc_detail,' ',loc_adress1, ' ',loc_adress2,' ',loc_zip,' ', loc_loc) as locname  FROM ".DB_TABLE_PREFIX."location order by loc_name asc");	
		if ($mode == "add"){
								$location = $rowlastentry['location'];
							}
		echo $scaffold->dropdown_rs($rs,$value_display,"location",$location,"","style=width:190px");
		?> 
		<script>
		$(document).ready(function() {
		$('#location').focus(function () {
		$('#textlocation').show();
		$('#textlocation').html('<?php echo $helptext;?>');
		});
		$('#location').blur(function () {
		$('#textlocation').hide();
		$('#textlocation').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textlocation"></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
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
		?> <a href="index2.php?option=locations2-m&mode=add" id="modalpopup1"><?php $sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $rowfield['fieldname_it'];
		}?></a>.
		<span class="validation-status"></span> </td>
		<?php } else { ?>
		<td><?php 
		 if ($location != ""){
		$sql1 = mysql_query("select * from t_location where id='".$location."'");
		$row1 = mysql_fetch_array($sql1);
		echo $row1['loc_name'] . " " .$row1['loc_detail'];
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		
		
		<tr>
						<td class="key"><label for="price">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=8");
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
											
		<script>
		$(document).ready(function() {
		$('#price').focus(function () {
		$('#textprice').show();
		$('#textprice').html('<?php echo $helptext;?>');
		});
		$('#price').blur(function () {
		$('#textprice').hide();
		$('#textprice').html('');
		});
		})
		</script>
		<b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=9");
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
		<script>
		$(document).ready(function() {
		$('#currency').focus(function () {
		$('#textcurrency').show();
		$('#textcurrency').html('<?php echo $helptext;?>');
		});
		$('#currency').blur(function () {
		$('#textcurrency').hide();
		$('#textcurrency').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcurrency"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $price;
						$sql1 = mysql_query("select * from t_currency where id='".$currency."'");
		$row1 = mysql_fetch_array($sql1);
		echo " ". $row1['currency'];
						?>
						
						</td>
						<?php } ?>                                                                                                    
					</tr>
		
		
		
		<tr>
						<td class="key"><label for="remark_price"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=10");
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
		<script>
		$(document).ready(function() {
		$('#remark_price').focus(function () {
		$('#textremark_price').show();
		$('#textremark_price').html('<?php echo $helptext;?>');
		});
		$('#remark_price').blur(function () {
		$('#textremark_price').hide();
		$('#textremark_price').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textremark_price"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $remark_price?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<tr>
						<td class="key"><label for="remark_prerequisite"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=11");
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
		<script>
		$(document).ready(function() {
		$('#remark_prerequisite').focus(function () {
		$('#textremark_prerequisite').show();
		$('#textremark_prerequisite').html('<?php echo $helptext;?>');
		});
		$('#remark_prerequisite').blur(function () {
		$('#textremark_prerequisite').hide();
		$('#textremark_prerequisite').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="textremark_prerequisite"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $remark_prerequisite?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<tr>
						<td class="key"><label for="date_start" id="delete-events">
		<?php
		if ($_REQUEST['eventsid'] != ""){
		$sqlfield = mysql_query("select * from t_field_names where id=285");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$update = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$update = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$update = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$update = $rowfield['fieldname_it'];
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
		$update = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$update = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$update = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$update = $rowfield['fieldname_it'];
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
		$startdatelabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$startdatelabel =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$startdatelabel =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$startdatelabel =$rowfield['fieldname_it'];
		}
		
		
		?> 
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=13");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$enddatelabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$enddatelabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$enddatelabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$enddatelabel = $rowfield['fieldname_it'];
		}
		?>
		</label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
		
		
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
		$delete = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$delete =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$delete =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$delete =$rowfield['fieldname_it'];
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
		echo "<span class='validation-status'></span>&nbsp;&nbsp;";
		echo "<div style='float:left;margin-left:9px;width:75px;border:0px solid red;'><b>".$startdatelabel."</b> ".$req_fld."</div>";
		echo "<div style='float:left;margin-left:1px;width:75px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
		
		echo "&nbsp;&nbsp;&nbsp;<input name='start_date_1' id='start_date_1' onChange=startdatefunction(1) onclick=startdatefunctionclick() onblur=startdatefunctionblur() type='text' style='width:60px;' value='".$size_row['size']."'  />&nbsp;&nbsp;<span class='validation-status'></span>";
		echo "<input name='end_date_1' onChange=enddatefunction(1) onclick=enddatefunctionclick() onblur=enddatefunctionblur() id='end_date_1' type='text' style='width:60px;' value='".$size_row['qty_size']."'  /><a href='#addsizeoption' onClick='addformField1(); return false;' id='addsizeoption'>&nbsp;<img src='images/add.png' border='0' /></a>&nbsp;&nbsp;";
		echo "</div>";
		
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
		  
			<script>
		$(document).ready(function() {
		
		
		
		$(".dateentry").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});	
		
		
		})
		</script>
		<?php
			if ($mode == "add"){
		?>
		<div style="display:none;float:left;width:220px;margin-left:290px;z-index:10000;position:absolute;margin-top:-20px;border:0px solid red;" class="textstart_date"></div>
		<div style="display:none;float:left;width:220px;margin-left:290px;z-index:10000;position:absolute;margin-top:-20px;border:0px solid red;" class="textend_date"></div> 
		<?php
		}
		?>
		 <div id="divTxt1"></div>
		<script type="text/javascript">
		
		var id = <?php echo $num_rows?>;
		function addformField1() {
		
		$("#divTxt1").append("<div id='row1" + id + "' style='display:none;margin-bottom:4px;'><input style='width:60px;margin-left:12px;' type='text' class='hasDatePicker' title='date' onChange=startdatefunction("+id+") onclick=startdatefunctionclick("+id+") onblur=startdatefunctionblur() name='start_date_" + id + "'  id='start_date_" + id + "'> <input type='text' name='end_date_" + id + "' onChange=enddatefunction("+id+") class='hasDatePicker' id='end_date_" + id + "' onChange=enddatefunction("+id+") onclick=enddatefunctionclick("+id+") onblur=enddatefunctionblur() title='date'  style='width:60px;margin-left:11px;'> <a href='#' onClick='removeformField1(\"#row1" + id + "\"); return false;'><img src=images/x.png></a></div>");
		
		$('#row1' + id).animate({height: 'show', opacity: 'show'}, 'slow');
		
		
		$(".hasDatePicker").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});	
		
		$('#start_date_' +id).removeClass('hasDatePicker hasDatepicker').addClass('hasDatePicker');
		$('#end_date_' +id).removeClass('hasDatePicker hasDatepicker').addClass('hasDatePicker');
		
		
		
		
		//id = (id - 1) + 2;
		$(".dateentry1").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});	
		$("#start_date_" + id).datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});	
		$("#end_date_" + id).datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true});
		$("#start_date_" + id).datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true}).datepicker('enable');	
		$("#end_date_" + id).datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
			firstDay:1,
			changeMonth: true,
			changeYear: true}).datepicker('enable');
		
		
			
		/*pos = this.id;
			alert(pos);
			var fetch = new String(pos);
			var fetchlist = fetch.split('_');
			alert("ID: " + fetchlist[0] + " #:" + fetchlist[2]);	*/
			
		
		
		
		
			
		id++;

		//document.getElementById("id").value = id;
		}
		function removeformField1(id) {
		$(id).animate({height: 'hide', opacity: 'hide'}, 'slow');
		$('#start_date_'+id).attr('disabled', true);
		$('#end_date_'+id).attr('disabled', true);
		
		//$('#qty_size_'+id).attr('disabled', true);
		}
		function removeformeditField1(id) {
		$(id).animate({height: 'hide', opacity: 'hide'}, 'slow');
		$('#start_date_'+id).attr('disabled', true);
		$('#end_date_'+id).attr('disabled', true);
		//$('#qty_size_'+id).attr('disabled', true);
		}
		
		
		
		  </script>	
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
			<script>
		$(document).ready(function() {
		$('#start_date_1').focus(function () {
		$('.textstart_date').show();
		$('.textstart_date').html('<?php echo $helptext;?>');
		});
		$('#start_date_1').blur(function () {
		$('.textstart_date').hide();
		$('.textstart_date').html('');
		});
		})
		</script>
		
		
		</td>
						<?php } else { ?>
						<td><?php 
		$sql = mysql_query("select * from t_dates where events_id='".$id."'");
		
		$ctr = 0;
		$num_rows = mysql_num_rows($sql);
		
		$num_rows++;
		echo "<span class='validation-status'></span>&nbsp;&nbsp;";
		echo "<div style='float:left;margin-left:14px;width:75px;border:0px solid red;'><b>".$startdatelabel."&nbsp;</b></div>";
		echo "<div style='float:left;margin-left:4px;width:75px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
		while ($size_row = mysql_fetch_array($sql)){
		$ctr++;
		
		
		echo '<div style="padding:0px;">';
		
		$eventsid = $size_row['id'];
		$size_id = $size_row['size_id'];
		
		$sqlfield = mysql_query("select * from t_field_names where id=273");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$delete = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$delete =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$delete =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$delete =$rowfield['fieldname_it'];
		}
		

		echo "<div style='float:left;margin-left:14px;width:75px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_start_date']))."</div>";
		echo "<div style='float:left;margin-left:4px;width:75px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div><br style=clear:both;>";
		}
		
		?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		
		
		<tr>
						<td class="key"><label for="date_remark"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=16");
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
		<script>
		$(document).ready(function() {
		$('#date_remark').focus(function () {
		$('#textdate_remark').show();
		$('#textdate_remark').html('<?php echo $helptext;?>');
		});
		$('#date_remark').blur(function () {
		$('#textdate_remark').hide();
		$('#textdate_remark').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textdate_remark"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $date_remark?></td>
						<?php } ?>                                                                                                    
					</tr>
		
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
		<script>
		$(document).ready(function() {
		$('#time_start').focus(function () {
		$('#texttime_start').show();
		$('#texttime_start').html('<?php echo $helptext;?>');
		});
		$('#time_start').blur(function () {
		$('#texttime_start').hide();
		$('#texttime_start').html('');
		});
		})
		</script>
		<div style="display:none;float:left;width:220px;margin-left:350px;z-index:10000;position:absolute;margin-top:-10px;border:0px solid red;font-weight:normal;" id="texttime_start"></div>
		</td>
						<?php if ( $is_editable_field ) { ?>
						<td>
						<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
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
							<input type="text" name="time_start" id="time_start" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($time_start)?>" />&nbsp;&nbsp;
							<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
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
						  
		<script>
		$(document).ready(function() {
		$('#time_end').focus(function () {
		$('#texttime_end').show();
		$('#texttime_end').html('<?php echo $helptext;?>');
		});
		$('#time_end').blur(function () {
		$('#texttime_end').hide();
		$('#texttime_end').html('');
		});
		})	
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:270px;margin-top:-18px;border:0px solid red;" id="texttime_end"></div>
							
							<span class="validation-status"></span>
		
		</td>
						<?php } else { ?>
						<td><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
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
		?>:</b> <?php echo $time_start?>&nbsp;&nbsp;
		<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
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
		<?php echo $time_end?>
		</td>
						<?php } ?>                                                                                                    
					</tr>
		
		
		
		<tr>
						<td class="key"><label for="remark_time"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=21");
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
		<script>
		$(document).ready(function() {
		$('#remark_time').focus(function () {
		$('#textremark_time').show();
		$('#textremark_time').html('<?php echo $helptext;?>');
		});
		$('#remark_time').blur(function () {
		$('#textremark_time').hide();
		$('#textremark_time').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textremark_time"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $remark_time?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		
		<tr>
			 <td class="key" valign="top"><label for="leader"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=23");
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
				<td><?php
				
				//$companyname = $row['lastname'] . ", ".$row['firstname'] . " - ".$row['company'] ;
		$value_display['value'] = "id";
		$value_display['display'] = "companyname";
		$rs = $db->get_results("SELECT *,concat(lastname ,', ',firstname, '  ',company) as companyname FROM ".DB_TABLE_PREFIX."leader order by lastname asc");	
		if ($mode == "add"){
								$leader = $rowlastentry['leader'];
							}
		
		echo $scaffold->dropdown_rs($rs,$value_display,"leader",$leader,"","style=width:190px");
		?>
		<script>
		$(document).ready(function() {
		$('#leader').focus(function () {
		$('#textleader').show();
		$('#textleader').html('<?php echo $helptext;?>');
		});
		$('#leader').blur(function () {
		$('#textleader').hide();
		$('#textleader').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textleader"></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
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
		?> <a href="index2.php?option=leaders2-m&mode=add" id="modalpopup2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=294");
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
		?></a>.
				<span class="validation-status"></span> </td>
				<?php } else { ?>
				<td><?php 
								 if ($leader != ""){
		$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
		$row1 = mysql_fetch_array($sql1);
		echo $row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname'];
		}else{
		echo "";
	}
		?></td>
				<?php } ?>
			</tr>
			
		<tr>
			 <td class="key" valign="top"><label for="leader2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=326");
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
				<td><?php
				
				//$companyname = $row['lastname'] . ", ".$row['firstname'] . " - ".$row['company'] ;
		$value_display['value'] = "id";
		$value_display['display'] = "companyname";
		$rs = $db->get_results("SELECT *,concat(lastname ,', ',firstname, '  ',company) as companyname FROM ".DB_TABLE_PREFIX."leader order by lastname asc");	
		if ($mode == "add"){
								$leader2 = $rowlastentry['leader2'];
							}
		echo $scaffold->dropdown_rs($rs,$value_display,"leader2",$leader2,"","style=width:190px");
		?>
		<script>
		$(document).ready(function() {
		$('#leader2').focus(function () {
		$('#textleader2').show();
		$('#textleader2').html('<?php echo $helptext;?>');
		});
		$('#leader2').blur(function () {
		$('#textleader2').hide();
		$('#textleader2').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textleader2"></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
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
		?> <a href="index2.php?option=leaders4-m&mode=add" id="modalpopup3"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=294");
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
		?></a>.
				<span class="validation-status"></span> </td>
				<?php } else { ?>
				<td><?php 
								 if ($leader2 != ""){
		$sql1 = mysql_query("select * from t_leader where id='".$leader2."'");
		$row1 = mysql_fetch_array($sql1);
		echo $row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname'];
		}else{
		echo "";
	}
		?></td>
				<?php } ?>
			</tr>
		
		
		
		
		  
		<tr>
						<td class="key"><label for="eve_contact_name"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=24");
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
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="eve_contact_name" id="eve_contact_name" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_name)?>" />
							<span class="validation-status"></span>
		<script>
		$(document).ready(function() {
		$('#eve_contact_name').focus(function () {
		$('#texteve_contact_name').show();
		$('#texteve_contact_name').html('<?php echo $helptext;?>');
		});
		$('#eve_contact_name').blur(function () {
		$('#texteve_contact_name').hide();
		$('#texteve_contact_name').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_name"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $eve_contact_name?></td>
						<?php } ?>                                                                                                    
					</tr>
		  
		 
				<tr>
						<td class="key"><label for="eve_contact_phone"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=25");
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
		<script>
		$(document).ready(function() {
		$('#eve_contact_phone').focus(function () {
		$('#texteve_contact_phone').show();
		$('#texteve_contact_phone').html('<?php echo $helptext;?>');
		});
		$('#eve_contact_phone').blur(function () {
		$('#texteve_contact_phone').hide();
		$('#texteve_contact_phone').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_phone"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $eve_contact_phone?></td>
						<?php } ?>                                                                                                    
					</tr>
		<tr>
						<td class="key"><label for="eve_contact_email"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=37");
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
		<script>
		$(document).ready(function() {
		$('#eve_contact_email').focus(function () {
		$('#texteve_contact_email').show();
		$('#texteve_contact_email').html('<?php echo $helptext;?>');
		$('.validation-status').attr('style','float:right;margin-left:210px;');
		});
		$('#eve_contact_email').blur(function () {
		$('#texteve_contact_email').hide();
		$('#texteve_contact_email').html('');
		$('.validation-status').attr('style','');
		});
		})
		</script>
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_email"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $eve_contact_email?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=38");
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
		<script>
		$(document).ready(function() {
		$('#eve_contact_url').focus(function () {
		$('#texteve_contact_url').show();
		$('#texteve_contact_url').html('<?php echo $helptext;?>');
		$('.validation-status').attr('style','float:right;margin-left:210px;');
		});
		$('#eve_contact_url').blur(function () {
		$('#texteve_contact_url').hide();
		$('#texteve_contact_url').html('');
		$('.validation-status').attr('style','');
		});
		})
		</script>
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_url"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $eve_contact_url?></td>
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
		
		<tr>
			<td class="key"><label for="design_photo"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=33");
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
		  
		  <script>
		$(document).ready(function() {
		$('#eve_image_path').focus(function () {
		$('#texteve_image_path').show();
		$('#texteve_image_path').html('<?php echo $helptext;?>');
		$('.validation-status').attr('style','float:right;margin-left:210px;');
		});
		$('#eve_image_path').blur(function () {
		$('#texteve_image_path').hide();
		$('#texteve_image_path').html('');
		$('.validation-status').attr('style','');
		});
		})
		</script>
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:210px;margin-top:-18px;border:0px solid red;" id="eve_image_path"></div>
			  <?php if ($mode=='edit') echo "</p>" ?>
			</td>
			<?php } else { ?>
			<td><?php echo $design_photo_img?></td>
			<?php } ?>
		  </tr>
		<tr>
						<td class="key"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=296");
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
		<script>
		$(document).ready(function() {
		$('#reminder').focus(function () {
		$('#textreminder').show();
		$('#textreminder').html('<?php echo $helptext;?>');
		});
		$('#reminder').blur(function () {
		$('#textreminder').hide();
		$('#textreminder').html('');
		});
		})
		</script>
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
		echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $rowfield['fieldname_it'];
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
		  
		
		<!--
		<tr>
						<td class="key"><label for="contact_div">Contact Div <?php echo $req_fld?></label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="contact_div" id="contact_div" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($contact_div)?>" />
							<span class="validation-status"></span></td>
						<?php } else { ?>
						<td><?php echo $contact_div?></td>
						<?php } ?>                                                                                                    
					</tr>-->
					
				</table>        	
		  </fieldset>    
			
			<?php if ( $mode != 'delete' ) { ?>       
			<div class="standard-form-buttons">
		<input class="button" name="Submit" id="Submit" type="submit" value="<?php
		if ($mode == "add"){
		$sqlfield = mysql_query("select * from t_field_names where id=262");
		}elseif ($mode == "edit"){
		$sqlfield = mysql_query("select * from t_field_names where id=272");
		}else{
		$sqlfield = mysql_query("select * from t_field_names where id=271");
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
		?>">
				<?php if ( $is_editable_field ) { ?>
				&nbsp;&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=271");
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
		?>">
				<?php } ?>
			</div>
			<?php } ?>

		</form>
	</div>