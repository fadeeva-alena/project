<?php
error_reporting(0);
session_start();

				$iframesettings = mysql_query("select * from t_iframe_settings where frame_id=1 and provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	
if (mysql_num_rows($iframesettings) > 0){
	$rowsettings = mysql_fetch_array($iframesettings);
	$iframe_width = $rowsettings['width'];
	$iframe_height = $rowsettings['height'];
	$iframe_titlecolor = $rowsettings['titlecolor'];
	$iframe_bgcolor = $rowsettings['bgcolor'];
	$iframe_tablegrid = $rowsettings['tablegrid'];
	$iframe_titlebgcolor = $rowsettings['titlebgcolor'];
}else{
$iframesettings2 = mysql_query("select * from t_iframe_settings where frame_id=1 and provider_id=''");
	$rowsettings = mysql_fetch_array($iframesettings2);
	$iframe_width = $rowsettings['width'];
	$iframe_height = $rowsettings['height'];
	$iframe_titlecolor = $rowsettings['titlecolor'];
	$iframe_bgcolor = $rowsettings['bgcolor'];
	$iframe_tablegrid = $rowsettings['tablegrid'];
	$iframe_titlebgcolor = $rowsettings['titlebgcolor'];
}
if ($_SESSION[WEBSITE_ALIAS]['language'] !=""){
include ("transparent_bg.php");
}else{
include ("transparent_bg.php");
}
$upload_dir = "uploads/";
if ($_SESSION[WEBSITE_ALIAS]['admin_id'] == ""){
	$mode = "add";
}else{
	if ( isset($_GET['mode']) ) {
		$mode = strtolower(trim($_GET['mode']));	
	} elseif ( isset($_POST['mode']) ) {
		$mode = strtolower(trim($_POST['mode']));
	}
}

$id = 0;
if ($_GET['id'] > 0 ) {
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

$tablename = DB_TABLE_PREFIX.'provider';

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value )
	{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	
	unset($post_data['form_action']);
	unset($post_data['mode']);	
	unset($post_data['id']);
	unset($post_data['c_nick']);
	unset($post_data['c_email']);
	unset($post_data['pw2']);
	unset($post_data['Submit']);
	
	$is_file_uploaded = false;
	$new_file = $_FILES['image_path'];	  
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
		$post_data['image_path'] = $new_filename;
	} else {
		unset($post_data['image_path']);
	}
	//exit();
	if ($post_data['pw']=="") {
		unset($post_data['pw']);
	}
	//$helper->pre_print_r($post_data); exit();
	
	$post_data['birthday'] = date('Y-m-d',strtotime($post_data['birthday']));
	
	
	//$post_data['timestamp'] = date('Y-m-d H:i:s');
	if ($_POST['reminder'] != ""){
		$reminder = $_POST['reminder'];
		$reminder = date('Y-m-d',strtotime($reminder));
		mysql_query("update t_provider set reminder='$reminder' where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
		$updatereminder = 1;
	}else{
		unset($post_data['reminder']);
	}
	unset($post_data['checked']);
	//exit();
	
}

$result = '';

switch ($form_action)
{
	case 'ADD':	
		$post_data['user_level'] = 2;
		$post_data['translator'] = 0;
		$post_data['user_r'] = 0;
		$post_data['user_w'] = 0;
		$post_data['admin'] = 0;
		$post_data['events_reservations'] = 0;
		$post_data['events_bookholding'] = 0;
		$post_data['session_reservation'] = 1;
		$post_data['session_bookholding'] = 0;
		
		$post_data['timestamp'] = "now";
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		
		mysql_query("insert into t_lunch_break_settings values ('0','$id','1200','1300','1','5')");
		
		$check_date = date("Y-m-d");
		$start_time = "1200";
		$end_time = "1300";
		$start_day = 1;
		$end_day = 5;
		
		for ($a = 0;$a<=365;$a++){
			$check_date1 = date ("Y-m-d", strtotime ("+$a day", strtotime($check_date))); 
			$start_date = $check_date1 . " ".substr($start_time,0,-2).":".substr($start_time,-2).":00";
			$end_date = $check_date1 . " ".substr($end_time,0,-2).":".substr($end_time,-2).":00";
			$reservation_status = 5;
			
			$n = date("N",strtotime($check_date1));
			
			if ($n >=$start_day and $n <=$end_day){
				$sqlcheckdate = mysql_query("select * from t_provider_reservation where reservation_status=5 and owner_provider_id='$id'");
				$standarddatetime = 0;
				while ($rowcheckdate = mysql_fetch_array($sqlcheckdate)){
					if ($check_date1 == date("Y-m-d",strtotime($rowcheckdate['reservation_start_date']))){
						$standarddatetime++;
					}
				}
				
				if ($standarddatetime == 0){
					echo $sqladd = "insert into t_provider_reservation values ('0','$id','$provider_event_id','$id','$start_date','$end_date',NOW(),'$reservation_status','','$block_type','','','60')";
					mysql_query($sqladd);
				}
			}
		}
		
		//////////////////////////////////////////start email
		
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$id'") ;	
			
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$subject = fixEncodingx(translatefields(761));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			

			$bodyemail = fixEncodingx(translatefields1(762));
			echo genderfields($gender);
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>",$bodyemail);
			
			if ($row->nick != ""){
				$bodyemail = str_replace("<username>",$row->nick,$bodyemail);
			}
			if ($row->pw != ""){
				$bodyemail = str_replace("<password>",$row->pw,$bodyemail);
			}
			
			$bodyemail = str_replace("Ihr Spiritwings-Team<br>","<b>Ihr Spiritwings-Team<br></b>",$bodyemail);
			
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";
			//echo $body;
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";
			if ($rowevent['reservation_status'] ==1){
				mail($to,$subject,$body,$headers);
			}
			//exit();
		/////////////////////////////////////////end email
		
		$result =  $is_added==true ? $result='true' : $result='false';
		if ($_SESSION[WEBSITE_ALIAS]['admin_id'] !=""){
			header("Location: ".INDEX_PAGE."users&a=add&mode=view&success=".$result."&id=".$id);
		}else{
			header("Location: ".INDEX_PAGE."login&user=added");
		}
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1 ) {
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
			$sqlfield = mysql_query("select * from t_field_names where id=299");
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
		//echo $page_heading;
			$post_data_activity_log['activity_log_content_id'] = "0";
			$post_data_activity_log['session_id'] = $_SESSION[WEBSITE_ALIAS]['session_id'];
			$post_data_activity_log['module_name'] = $page_heading;
			$post_data_activity_log['command'] = $add;
			$post_data_activity_log['command_time'] = "now";
			$sql_helper->insert_all("t_activity_log_content",$post_data_activity_log);
			//exit();
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."events&a=edit&mode=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') && ($id != 1) ) {
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."users&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."provider");
		} else { 
			header("Location: ".INDEX_PAGE."provider-m&id=".$id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."login");
		break;

}

// Retrieve record
$id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
$record = $sql_helper->cget_row(DB_TABLE_PREFIX."provider", "id = '$id'") ;

$lastname = $record->lastname;
$firstname = $record->firstname;
$nick = $record->nick;
$pw = $record->pw;
$email = $record->email;
$company = $record->company;
$adress1 = $record->adress1;
$adress2 = $record->adress2;
$country = $record->country;
$zip = $record->location;
$location = $record->zip;
$fon = $record->fon;
$fax = $record->fax;
$image_path = $record->image_path;
$mobile = $record->mobile;
$birthday = $record->birthday;
$language = $record->language;
$gender = $record->gender;

if ($image_path != ""){
        	$path = "uploads/".$image_path;
	list($widthimage, $heightimage, $types, $attr) = getimagesize($path);
	
	//$image_path = "images/your_image.png";

	//list($width, $height, $type, $attr)= getimagesize($image_path); 
	
	
	
	if ($widthimage >= $detail_max_x){
	$widthimage = $detail_max_x;
	$heightimage = "";
	}else{
	$widthimage = $widthimage;
	}
	
	
        	$design_photo_img = '<img src="uploads/'.$image_path.'" border="0" width='.$widthimage.'>';
        }else{
        	$design_photo_img = '';
        }
?>

<?php if ($_SESSION[WEBSITE_ALIAS]['user_level'] == ""){?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color:white;background:url('none');">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME; ?></title>
<link href="<?php echo CSS; ?>core.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGINS; ?>jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.validate.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.form.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>

<?php
}
?>

<!--<script src="<?php //echo PLUGINS; ?>jquery/ui-lightness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>-->
<script src="<?php echo PLUGINS; ?>jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>
<!--<script src="<?php echo PLUGINS; ?>tiny_mce/tiny_mce.js" type="text/javascript" language="Javascript"></script>-->

<script src="<?php echo JS?>popup.js" type="text/javascript" language="Javascript"></script>

<script type="text/javascript"> 
	$(document).ready(function(){ 
		$(function(){
			$('ul.sf-menu').superfish();
		});
		
	}); 
</script>
<script type="text/javascript">
$(document).ready(function() {
	
	var validator = $("#frm_<?php echo $page_name; ?>").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			adress1: "required",
			location: "required",
			zip: "required",
			birthday: "required",
			nick: {
				required: true,
				remote: "<?php echo PATH_COMPONENTS; ?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt('provider'))?>&fn=<?php echo urlencode($crypt->encrypt('nick'))?>&current=<?php echo urlencode($nick)?>&m=<?php echo $mode; ?>"
			},
			
			pw: {
				required: true,
				minlength: <?php echo PWD_MIN_LEN?>
			},
			
			pw2: {
				required: true,
				equalTo: '#pw'
			},
			email: {
				required: true,
				email: true,
				remote: "<?php echo PATH_COMPONENTS; ?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt('provider'))?>&fn=<?php echo urlencode($crypt->encrypt('email'))?>&current=<?php echo urlencode($email)?>&m=<?php echo $mode; ?>"
			},image_path: {
			<?php if ($mode == "add") { ?>
			//required: true,
			<?php } ?>
			accept: "(jpg|gif|png)"
			},
			language: "required",
			country: "required"
		},
		messages: {
	
			firstname: "<?php echo fixEncoding(translatefields(769)); ?>",
			lastname: "<?php echo fixEncoding(translatefields(769)); ?>",
			adress1: "<?php echo fixEncoding(translatefields(769)); ?>",
			location: "<?php echo fixEncoding(translatefields(769)); ?>",
			zip: "<?php echo fixEncoding(translatefields(769)); ?>",
			
			birthday: "<?php echo fixEncoding(translatefields(769)); ?>",
			image_path: {
				//required: "<?php echo fixEncoding(translatefields(769))?>",
				accept: "Invalid file type! Must be an image."
			},
			nick: {
				required: "<?php echo fixEncoding(translatefields(769)); ?>",
				remote: $.format("<strong>{0}</strong> <?php echo $messages['validate']['unavailable']?>")				
			},
			email: {
				required: "<?php echo fixEncoding(translatefields(769)); ?>",
				email: "<?php echo fixEncoding(translatefields(767)); ?>",
				remote: $.format("<?php echo fixEncoding(translatefields(768)); ?>")				
			},
			pw: {
				required: "<?php echo fixEncoding(translatefields(769)); ?>",
				minlength: "<?php echo translatefields(763) . PWD_MIN_LEN ?>"
			},
			pw2: {
				required: "<?php echo fixEncoding(translatefields(769)); ?>",
				equalTo: "<?php echo translatefields(765);?>"
			},
			language: "<?php echo fixEncoding(translatefields(769)); ?>",
			country: "<?php echo fixEncoding(translatefields(769)); ?>"
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
		location.href = '<?php echo INDEX_PAGE."login"?>';
	});
	$("#reminder").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
		changeMonth: true,
        changeYear: true});
	
		
});



</script>
<link href="plugins/jquery/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="plugins/jquery/facebox/facebox.js" type="text/javascript"></script> 
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'plugins/jquery/facebox/loading.gif',
        closeImage   : 'plugins/jquery/facebox/closelabel.png'
      })
    })
  </script>
</head>
<body>
<?php if ($_SESSION[WEBSITE_ALIAS]['admin_id'] == ""){?>
<table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;size:11px;font-size:11px;">
<tr>
<style>
	a.yellowcolor{color:#FFFD5F;}
	a:hover.yellowcolor{color:#FFFD5F;text-decoration:underline;}
</style>
<td style="background:url('images/headerbg.png');border:0px solid red;height:163px;padding:0px;">
	<center><img src="images/login-for-logo.png" style="height:60px;margin-top:10px;"/></center>
	<form method="post" id="frmLogin" action="" style="padding:0px;margin:0px;">
		<div align="center" style="margin-top:0px;color:white;margin-top:10px;">
		
				<a href="index.php?option=login&language=1" class="yellowcolor" <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo ' style="font-weight:bold;"';}?>>De.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=login&language=2" class="yellowcolor"  <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo ' style="font-weight:bold;"';}?>>En.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=login&language=3" class="yellowcolor"  <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo ' style="font-weight:bold;"';}?>>Fr.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=login&language=4" class="yellowcolor" <?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo ' style="font-weight:bold;"';}?>>It.</a>
             <label><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=198");
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
		?></b></label>
                <input class="text-field" id="username" name="username" type="text" maxlength="30" style="width:80px;"/>
				&nbsp;&nbsp;
                <label><?php
		$sqlfield = mysql_query("select * from t_field_names where id=55");
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
		?></label>
                <input class="text-field" id="password" name="password" type="password" maxlength="30" style="width:80px;" /> &nbsp;<input class="button" name="Login" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=197");
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
		?>" />&nbsp;
				
				
                <a href="index.php?option=forgotpassword" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=201");
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
		?></a> | <a href="index.php?option=users&mode=add" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=202");
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
		?></a> | <a href="index.php?option=help" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=363");
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
		?></a> | <a href="index.php?option=about-team" class="yellowcolor"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=297");
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
		?></a>
		
		</div>
			<table cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;">
				<tr>
				
					<td align="center">
						<div style="text-align:center;width:100%;margin-top:5px;"><center>
						<span id="login-indicator-msg" style="padding-top:10px;float:none;display:none;text-align:center;color:white;margin:0px;"></span></center>
						</div>
					</td>
				</tr>
			</table>
		
		
		
	</form>


</td>	
</tr>
<?php }else{
?>
<table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;size:11px;font-size:11px;border:0px;">
<?php
} ?>

<tr>
<td style="background:url('images/bodybg.png') fixed;size:11px;font-size:11px;border:0px;background-color:transparent;"> 
    <?php
		if ($_SESSION[WEBSITE_ALIAS]['admin_id'] == ""){
	?>
    <div id="content" style="border:1px solid #eeeeee;padding-bottom:0px;margin:0 auto;width:952px;size:11px;size:11px;font-size:11px;">
	<?php
	}else{
	?>
	<div id="content" style="border:0px solid #eeeeee;padding-bottom:20px;margin:0 auto;width:952px;size:11px;size:11px;font-size:11px;">
	<?php
	}
	?>


	<div align="center">
	<?php
		if ($_SESSION[WEBSITE_ALIAS]['admin_id'] == ""){
	?>
			<!--<a href="index.php?option=users&mode=add&language=1"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo ' style="font-weight:bold;"';}?>>De.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=users&mode=add&language=2"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo ' style="font-weight:bold;"';}?>>En.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=users&mode=add&language=3"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo ' style="font-weight:bold;"';}?>>Fr.</a> <b>&nbsp;|&nbsp;</b>
				<a href="index.php?option=users&mode=add&language=4"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo ' style="font-weight:bold;"';}?>>It.</a>-->
	<?php
	}else{
	?>
		<a href="index.php?option=users&mode=edit&language=1"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo ' style="font-weight:bold;"';}?>>De.</a> |
				<a href="index.php?option=users&mode=edit&language=2"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo ' style="font-weight:bold;"';}?>>En.</a> |
				<a href="index.php?option=users&mode=edit&language=3"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo ' style="font-weight:bold;"';}?>>Fr.</a> |
				<a href="index.php?option=users&mode=edit&language=4"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo ' style="font-weight:bold;"';}?>>It.</a>
	<?php
	}
	?>
	</div>
	
<h1><?php
		$sqlfield = mysql_query("select * from t_field_names where id=299");
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
		?> <small>[ <?php echo $sub_heading; ?> ]</small></h1>
<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
<div id="system-message">
    <div class="info">
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "User")?></div>
    </div>
</div>
<?php } ?>
<?php if ( $mode == 'delete' ) { ?>
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" name="frm_<?php echo $page_name; ?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>">						
        <?php if ( $id != 1 ) { ?>
		<div class="alert">
			<div class="message">
			<?php echo CONFIRM_DELETE . "User"; ?>?&nbsp;&nbsp;
			<input class="button button-short" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
            <input class="button button-short" name="Delete" type="submit" value="No" />
            </div>
		</div>
        <?php } else{ ?>
		<div class="info">
			<div class="message">
            	Cannot delete the default User!&nbsp;&nbsp;
            	<a href="<?php echo INDEX_PAGE."provider"; ?>">Cancel</a>
            </div>
		</div>        
        <?php } ?>
		</form>
	</div>
<?php } ?>

<div class="content-main wide80" style="size:11px;font-size:11px;size:11px;font-size:11px;">
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
    <form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" id="frm_<?php echo $page_name; ?>" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
            <table class="form-table" style="size:11px;font-size:11px;">     
				<tr>
                    <td class="key"><label for="nick"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=231");
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
		$sqlfield = mysql_query("select * from t_field_names where id=231");
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
                    	<input type="text" name="nick" id="nick" style="width:190px;" maxlength="50" value="<?php echo htmlentities($nick)?>" />
                    	<span class="validation-status"></span>
                        <input type="hidden" name="c_nick" id="c_nick" value="<?php echo htmlentities(current_nick)?>"/>
						<script>
						$(document).ready(function() {
							$('#nick').focus(function () {
								$('#textnick').show();
								$('#textnick').html('<?php echo $helptext;?>');
							});
							$('#nick').blur(function () {
								$('#textnick').hide();
								$('#textnick').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textnick"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $nick?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="pw"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=55");
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
		$sqlfield = mysql_query("select * from t_field_names where id=55");
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
		<?php echo $req_fld_tmp = ($mode!='edit') ? $req_fld : ""  ?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="password" name="pw" id="pw" style="width:190px;" maxlength="50" value="<?php echo $pw?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#pw').focus(function () {
								$('#textpw').show();
								$('#textpw').html('<?php echo $helptext;?>');
							});
							$('#pw').blur(function () {
								$('#textpw').hide();
								$('#textpw').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textpw"></div>
                    </td>
                    <?php } else { ?>
                    <td>Not Shown</td>
                    <?php } ?>                                                                                                    
                </tr>                
                <?php if ( $mode == 'add' ) { ?>                                
                <tr>
                    <td class="key"><label for="pw2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=233");
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
		$sqlfield = mysql_query("select * from t_field_names where id=233");
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
                    <td>
                    	<input type="password" name="pw2" id="pw2" style="width:190px;" maxlength="50" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#pw2').focus(function () {
								$('#textpw2').show();
								$('#textpw2').html('<?php echo $helptext;?>');
							});
							$('#pw2').blur(function () {
								$('#textpw2').hide();
								$('#textpw2').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textpw2"></div>
                    </td>
                </tr>
                <?php } ?>
				
				<tr>
                    <td class="key"><label for="email"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=51");
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
		$sqlfield = mysql_query("select * from t_field_names where id=51");
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
                    	<input type="text" name="email" id="email" style="width:190px;" maxlength="50" value="<?php echo htmlentities($email)?>" />
                    	<span class="validation-status"></span>
                        <input type="hidden" name="c_email" id="c_email" value="<?php echo htmlentities(current_email)?>" />
						<script>
						$(document).ready(function() {
							$('#email').focus(function () {
								$('#textemail').show();
								$('#textemail').html('<?php echo $helptext;?>');
							});
							$('#email').blur(function () {
								$('#textemail').hide();
								$('#textemail').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textemail"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $email?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="company"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=30");
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
		$sqlfield = mysql_query("select * from t_field_names where id=30");
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
                    	<input type="text" name="company" id="company" style="width:190px;" maxlength="50" value="<?php echo htmlentities($company)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#company').focus(function () {
								$('#textcompany').show();
								$('#textcompany').html('<?php echo $helptext;?>');
							});
							$('#company').blur(function () {
								$('#textcompany').hide();
								$('#textcompany').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcompany"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $company?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="gender"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=34");
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
		$sqlfield = mysql_query("select * from t_field_names where id=34");
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
		$sqlfield = mysql_query("select * from t_field_names where id=237");
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
		?>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=238");
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
		?>
                    	<?php
						$gender = $mode=='add' ? 1 : $gender;
						echo $scaffold->radio_arr($options=array($male,$female), $values=array(1, 2), "gender", $gender, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
						?>
                                 
<script>
						$(document).ready(function() {
							$('#gender').focus(function () {
								$('#textgender').show();
								$('#textgender').html('<?php echo $helptext;?>');
							});
							$('#gender').blur(function () {
								$('#textgender').hide();
								$('#textgender').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textgender"></div>						</td>
                    <?php } else { ?>
                    <td><?php echo $gender==1 ? 'Yes' : 'No';?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="firstname"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=31");
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
		$sqlfield = mysql_query("select * from t_field_names where id=31");
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
		?></label> <?php echo $req_fld?></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="firstname" id="firstname" style="width:190px;" maxlength="50" value="<?php echo htmlentities($firstname)?>" />
						<span class="validation-status"></span>
                                 
						<script>
						$(document).ready(function() {
							$('#firstname').focus(function () {
								$('#textfirstname').show();
								$('#textfirstname').html('<?php echo $helptext;?>');
							});
							$('#firstname').blur(function () {
								$('#textfirstname').hide();
								$('#textfirstname').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textfirstname"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $firstname?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="lastname"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=32");
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
		$sqlfield = mysql_query("select * from t_field_names where id=32");
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
		?></label> <?php echo $req_fld?></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="lastname" id="lastname" style="width:190px;" maxlength="50" value="<?php echo htmlentities($lastname)?>" />
						<span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#lastname').focus(function () {
								$('#textlastname').show();
								$('#textlastname').html('<?php echo $helptext;?>');
							});
							$('#lastname').blur(function () {
								$('#textlastname').hide();
								$('#textlastname').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textlastname"></div>
                    	
                    </td>
                    <?php } else { ?>
                    <td><?php echo $lastname?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="adress1"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=241");
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
		$sqlfield = mysql_query("select * from t_field_names where id=241");
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
		?></label> <?php echo $req_fld?></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="adress1" id="adress1" style="width:190px;" maxlength="50" value="<?php echo htmlentities($adress1)?>" />
						<span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#adress1').focus(function () {
								$('#textadress1').show();
								$('#textadress1').html('<?php echo $helptext;?>');
							});
							$('#adress1').blur(function () {
								$('#textadress1').hide();
								$('#textadress1').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textadress1"></div>
                        
                    </td>
                    <?php } else { ?>
                    <td><?php echo $adress1?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="adress2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=242");
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
		$sqlfield = mysql_query("select * from t_field_names where id=242");
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
                    	<input type="text" name="adress2" id="adress2" style="width:190px;" maxlength="50" value="<?php echo htmlentities($adress2)?>" />
                    	<span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#adress2').focus(function () {
								$('#textadress2').show();
								$('#textadress2').html('<?php echo $helptext;?>');
							});
							$('#adress2').blur(function () {
								$('#textadress2').hide();
								$('#textadress2').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textadress2"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $adress2?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
				<tr>
       			 <td class="key"><label for="loc_country"> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=44");
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
		?> <?php echo $req_fld;?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=44");
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
				$value_display['value'] = "id";
				$value_display['display'] = "long";
				
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."country");		
				
				echo $scaffold->dropdown_rs($rs,$value_display,"country",$country);
				?><span class="validation-status"></span><script>
						$(document).ready(function() {
							$('#country').focus(function () {
								$('#textcountry').show();
								$('#textcountry').html('<?php echo $helptext;?>');
							});
							$('#country').blur(function () {
								$('#textcountry').hide();
								$('#textcountry').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcountry"></div>
          		 </td>
        		<?php } else { ?>
        		<td><?php 
                             
				$sql1 = mysql_query("select * from t_country where id='".$country."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['long'];
			
				?></td>
        		<?php } ?>
      		</tr>
               
			<tr>
                    <td class="key"  valign="top"><label for="location"><?php
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
		$sqlfield = mysql_query("select * from t_field_names where id=251");
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
		?></label> <?php echo $req_fld?></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text"  autocomplete="off" name="location" id="location" style="width:190px;" maxlength="150" value="<?php echo htmlentities($zip)?>" /> <span class="validation-status"></span>
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
                        </td>
                    <?php } else { ?>
                    <td><?php echo $location?></td>
                    <?php } ?>                                                                                                    
                </tr>	
				
			<tr>
                    <td class="key" valign="top"><label for="zip"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=45");
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
		?></label> <?php echo $req_fld?></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	
		<script type='text/javascript' src='js/autocomplete.js'></script>
					<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	/*$("#zip").autocomplete("search.php", {
		width: 267,
		selectFirst: false
	});*/
	
	var zipsuggest = [
		<?php
		$countlocation = 0;
		$query = mysql_query("SELECT ZIP,Location from t_zipch
				 order by ZIP asc");
		$numlocation = mysql_num_rows($query);
			while ($result = mysql_fetch_assoc($query)) {
			$countlocation++;
				$zipsuggest = fixEncoding($result[ZIP]);
				$locsuggest = fixEncoding($result[Location]);
			if ($numlocation == $countlocation){	
		?>
		{ zip: "<?php echo utf8_encode($zipsuggest);?>", location: "<?php echo utf8_encode($locsuggest);?>" }
		<?php
			}else{
		?>
		{ zip: "<?php echo utf8_encode($zipsuggest);?>", location: "<?php echo utf8_encode($locsuggest);?>" },
		<?php
			}
		}
		?>
	];	
	
	$("#zip").autocomplete(zipsuggest, {
		minChars: 0,
		autoFill: false,
		formatItem: function(row, i, max) {
			return row.zip + " " + row.location;
		},
		formatMatch: function(row, i, max) {
			
			return row.zip + " " + row.location;
			
		},
		formatResult: function(row) {
			return row.zip;
		}
	});
	$("#zip").autocomplete(zipsuggest);
	$("#zip").result(function(event, row, formatted) {
		 $('#clone_location').html(row.location);
		var r = $('#clone_location');
		
		r.text(r.html());
		r.html(r.text());
		$('#location').val($('#clone_location').html());	
		
		
		
		//$('#location').val(row.location);
		
		
		
	});
	
	
	var locsuggest = [
		<?php
		$countlocation = 0;
		$query = mysql_query("SELECT Location,ZIP from t_zipch
				  order by Location asc");
		$numlocation = mysql_num_rows($query);
			while ($result = mysql_fetch_assoc($query)) {
			$countlocation++;
				$zipsuggest = fixEncoding($result[ZIP]);
				$locsuggest = fixEncoding($result[Location]);
			if ($numlocation == $countlocation){	
		?>
		{ zip: "<?php echo utf8_encode($zipsuggest);?>", location: "<?php echo utf8_encode($locsuggest);?>" }
		<?php
			}else{
		?>
		{ zip: "<?php echo utf8_encode($zipsuggest);?>", location: "<?php echo utf8_encode($locsuggest);?>" },
		<?php
			}
		}
		?>
	];	
	
	$("#location").autocomplete(locsuggest, {
		minChars: 0,
		autoFill: false,
		formatItem: function(row, i, max) {
			return row.location + " " + row.zip;
		},
		formatMatch: function(row, i, max) {
			return row.location + " " + row.zip;
		},
		formatResult: function(row) {
			return row.location;
		}
	});
	$("#location").autocomplete(locsuggest);
	$("#location").result(function(event, row, formatted) {
		
		$('#clone_zip').html(row.zip);
		var r = $('#clone_zip');
		
		r.text(r.html());
		r.html(r.text());
		$('#zip').val($('#clone_zip').html());	
		
	});
	
	
	$("#location").blur(function() 
    { 
        var location = $("#location").val(); 
        
        if (location == ""){
            $("#zip").val('');
		}
    }); 
    
    $("#zip").blur(function() 
    { 
        var zip = $("#zip").val(); 
        
        if (zip == ""){
            $("#location").val('');
		}
    }); 

	
	
	
});

</script>
<style>
	.ac_results {
	padding: 0px;
	border: 1px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
}

.ac_results ul {
	
	width: 100%;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
	
	
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	/* 
	if width will be 100% horizontal scrollbar will apear 
	when scroll mode will be used
	*/
	/*width: 100%;*/
	font: menu;
	font-size: 12px;
	/* 
	it is very important, if line-height not setted or setted 
	in relative units scroll will be broken in firefox
	*/
	line-height: 16px;
	overflow: hidden;
}

.ac_loading {
	background: white url('images/loader.gif') right center no-repeat;
}

.ac_odd {
	background-color: #eee;
}

.ac_over {
	background-color: #0A246A;
	color: white;
}

</style>
				<input type="text" id="zip" name="zip" style="width:190px;" maxlength="150" value="<?php echo htmlentities($location)?>"/>
		
		
		<span class="validation-status"></span>
                        
						<script>
						$(document).ready(function() {
							$('#zip').focus(function () {
								$('#textzip').show();
								$('#textzip').html('<?php echo $helptext;?>');
							});
							$('#zip').blur(function () {
								$('#textzip').hide();
								$('#textzip').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textzip"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo $zip?></td>
                    <?php } ?>                                                                                                    
                </tr>	
		
			
		
			
				
				
				<tr>
                    <td class="key"><label for="fon"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=65");
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
		$sqlfield = mysql_query("select * from t_field_names where id=65");
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
                    	<input type="text" name="fon" id="fon" style="width:190px;" maxlength="50" value="<?php echo htmlentities($fon)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#fon').focus(function () {
								$('#textfon').show();
								$('#textfon').html('<?php echo $helptext;?>');
							});
							$('#fon').blur(function () {
								$('#textfon').hide();
								$('#textfon').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textfon"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $fon?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="fax"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=66");
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
		$sqlfield = mysql_query("select * from t_field_names where id=66");
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
                    	<input type="text" name="fax" id="fax" style="width:190px;" maxlength="50" value="<?php echo htmlentities($fax)?>" />
						<span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#fax').focus(function () {
								$('#textfax').show();
								$('#textfax').html('<?php echo $helptext;?>');
							});
							$('#fax').blur(function () {
								$('#textfax').hide();
								$('#textfax').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textfax"></div>
                    	
                    </td>
                    <?php } else { ?>
                    <td><?php echo $fax?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="mobile"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=67");
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
		$sqlfield = mysql_query("select * from t_field_names where id=67");
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
                    	<input type="text" name="mobile" id="mobile" style="width:190px;" maxlength="50" value="<?php echo htmlentities($mobile)?>" /> <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#mobile').focus(function () {
								$('#textmobile').show();
								$('#textmobile').html('<?php echo $helptext;?>');
							});
							$('#mobile').blur(function () {
								$('#textmobile').hide();
								$('#textmobile').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textmobile"></div>
                        
                    </td>
                    <?php } else { ?>
                    <td><?php echo $mobile?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<script>
					$(document).ready(function() {
	 	$("#birthday").datepicker({
			changeMonth: true,
			 yearRange: '-100:0',
			dateFormat: 'dd.mm.yy',
			changeYear: true,
			onSelect:function(theDate) {
				$("#date_end").datepicker('option','minDate',new Date(theDate))
	  		}
	 	})
	 	
	})
				</script>
                <tr>
                    <td class="key"><label for="birthday"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=68");
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
		$sqlfield = mysql_query("select * from t_field_names where id=68");
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
                    	<input type="text" name="birthday" id="birthday" readonly="readonly" style="width:190px;" maxlength="50" value="<?php echo htmlentities($birthday)?>" />
                    	<span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#birthday').focus(function () {
								$('#textbirthday').show();
								$('#textbirthday').html('<?php echo $helptext;?>');
							});
							$('#birthday').blur(function () {
								$('#textbirthday').hide();
								$('#textbirthday').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textbirthday"></div>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $birthday?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
       			 <td class="key"><label for="language"> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=256");
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
		$sqlfield = mysql_query("select * from t_field_names where id=256");
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
		?> <?php echo $req_fld;?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "language";
				
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."languages");		
				
				echo $scaffold->dropdown_rs2($rs,$value_display,"language",$language);
				?>
          		 
				<script>
						$(document).ready(function() {
							$('#language').focus(function () {
								$('#textlanguage').show();
								$('#textlanguage').html('<?php echo $helptext;?>');
							});
							$('#language').blur(function () {
								$('#textlanguage').hide();
								$('#textlanguage').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textlanguage"></div>
				</td>
        		<?php } else { ?>
        		<td><?php 
                             
				$sql1 = mysql_query("select * from t_languages where id='".$language."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['language'];
			
				?></td>
        		<?php } ?>
      		</tr>
			
				
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
          <input name="image_path" id="image_path" type="file" size="22" />
          <span class="validation-status"></span>
	  
	  <script>
	$(document).ready(function() {
	$('#image_path').focus(function () {
	$('#textimage_path').show();
	$('#textimage_path').html('<?php echo $helptext;?>');
	});
	$('#image_path').blur(function () {
	$('#textimage_path').hide();
	$('#textimage_path').html('');
	});
	})
	</script>
	<div id="clone_zip" style="font-size:0px;"></div>
	<div id="clone_location" style="font-size:0px;"></div>
	<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="image_path"></div>
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
                    	<input type="text" name="reminder" id="reminder" readonly="readonly" style="width:70px;background-color:pink;" maxlength="150"  /> <span class="validation-status"></span>
						<?php
							$sqlpro = mysql_query("select * from t_provider where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
							$rowpro = mysql_fetch_array($sqlpro);
							//echo $rowpro['reminder'];
							if ($mode == "edit"){
							echo date('d.m.Y',strtotime($rowpro['reminder']));
							}
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
	<div style="display:none;float:right;width:380px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textreminder"></div>
	</td>
                    <?php } else { ?>
                    <td><?php
							$sqlpro = mysql_query("select * from t_provider where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
							$rowpro = mysql_fetch_array($sqlpro);
							echo date('d.m.Y',strtotime($rowpro['reminder']));
						?></td>
                    <?php } ?>                                                                                                    
                </tr>
	  <?php
		if ($mode != "add"){
	  ?>
		<tr>
                    <td class="key"><label for="birthday"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=300");
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
		?> </label></td>
                   
                    <td>
							<?php 
								$sqlevents = mysql_query("select * from t_event where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
								if (mysql_num_rows($sqlevents) > 0){
									echo "<a id=modalevents href=components/eventsall.php>".mysql_num_rows($sqlevents) . "</a>";
								}else{
									echo mysql_num_rows($sqlevents);
								}
							?>
                    </td>
                   
                </tr>
				
		<tr>
                    <td class="key"><label for="birthday"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=302");
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
		?> </label></td>
                   
                    <td>
							<?php 
							function dateDiff($dformat, $endDate, $beginDate)
							{
								$date_parts1=explode($dformat, $beginDate);
								$date_parts2=explode($dformat, $endDate);
								$start_date=gregoriantojd($date_parts1[0], $date_parts1[1], $date_parts1[2]);
								$end_date=gregoriantojd($date_parts2[0], $date_parts2[1], $date_parts2[2]);
								return $end_date - $start_date;
							}
							
								$countdates = 0;
								$sqlevents = mysql_query("select * from t_event where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
								if (mysql_num_rows($sqlevents) > 0){
									while ($rowevents = mysql_fetch_array($sqlevents)){
										
										$sqldates = mysql_query("select * from t_dates where events_id='".$rowevents['id']."'");
										while ($rowdates = mysql_fetch_array($sqldates)){
											
											$countdates = $countdates + 1;
										}
									}
									echo "<a id=modalevents1 href=components/eventsall.php>".$countdates. "</a>";
								}else{
									echo mysql_num_rows($sqlevents);
								}
							?>
                    </td>
                   
                </tr>
	  <?php
		}
	  ?>
	  
	  <?php if( ($_SESSION[WEBSITE_ALIAS]['admin_id']!= "") ) {?>
	
	  <?php } ?>
	  
	
            </table>        	
			<center>
	<?php if ($_REQUEST['mode'] != "add"){?>
	<table class="form-table">
		
		<tr>
			<td>
			<?php
			$newheight = 360 + $iframe_height;
			?>
			<iframe width="600px" height="<?php echo $newheight;?>px" src="http://manimano.ch/wlw/demo-2.php?provider_id=<?php echo $id;?>" frameborder="0" allowfullscreen style="overflow-x:hidden;"></iframe>
			</td>
		</tr>
	</table>
	<?php } ?>
	</center>
			
        </fieldset>    
        
        <?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=262");
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
	<!--<center>
	<table>
			<tr>
				<td colspan="2">
				<br>
				<span style="font-weight:bold;font-size:14px;size:14px;"><?php
				$iframesettings = mysql_query("select * from t_iframe_settings where frame_id=1 and provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	
if (mysql_num_rows($iframesettings) > 0){
	$rowsettings = mysql_fetch_array($iframesettings);
	$iframe_width = $rowsettings['width'];
	$iframe_height = $rowsettings['height'];
	$iframe_titlecolor = $rowsettings['titlecolor'];
	$iframe_bgcolor = $rowsettings['bgcolor'];
	$iframe_tablegrid = $rowsettings['tablegrid'];
	$iframe_titlebgcolor = $rowsettings['titlebgcolor'];
}else{
$iframesettings2 = mysql_query("select * from t_iframe_settings where frame_id=1 and provider_id=''");
	$rowsettings = mysql_fetch_array($iframesettings2);
	$iframe_width = $rowsettings['width'];
	$iframe_height = $rowsettings['height'];
	$iframe_titlecolor = $rowsettings['titlecolor'];
	$iframe_bgcolor = $rowsettings['bgcolor'];
	$iframe_tablegrid = $rowsettings['tablegrid'];
	$iframe_titlebgcolor = $rowsettings['titlebgcolor'];
}

				
				
		$sqlfield = mysql_query("select * from t_field_names where id=673");
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
		?></span>
		<br/>
				</td>
			</tr>
			<tr>
				<td colspan="2" id="previewcontent">
					<iframe width="<?php echo $iframe_width;?>px" height="<?php echo $iframe_height;?>px" src="http://manimano.ch/wlw/display-event-from-provider.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&titlecolor=<?php echo $iframe_titlecolor;?>&bgcolor=<?php echo $iframe_bgcolor;?>&titlebgcolor=<?php echo $iframe_titlebgcolor;?>&tablegrid=<?php echo $iframe_tablegrid;?>&width=<?php echo $iframe_width;?>&height=<?php echo $iframe_height;?>&searchterm=" frameborder="0" allowfullscreen  style="overflow-x:hidden;"></iframe>
				</td>
			</tr>
		</table></center>-->
</td>
</tr>
<?php if( ($_SESSION[WEBSITE_ALIAS] == "") or ($_SESSION[WEBSITE_ALIAS]['admin_id']== "") ) {?>
<tr>

<td style="background:url('images/footerbg.png');">

   

    <div id="footer" style="padding:0px;margin:0px;background:white;background-color:#3DB3F7;color:white;background-color:transparent;height:100px;margin:0 auto;width:990px;">

   	  <table cellpadding="0" cellspacing="0" width="990px" height="100px">

	<tr>

		<td valign="middle" align="left">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=364");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$footer1 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$footer1 = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$footer1 = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$footer1 = $rowfield['fieldname_it'];
		}
			if ($footer1 != 0){
				echo $footer1;
			}
		?>
		</td>
		<td valign="middle" align="center">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=365");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$footer2 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$footer2 = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$footer2 = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$footer2 = $rowfield['fieldname_it'];
		}
		if ($footer2 != 0){
				echo $footer2;
			}
		?>
		</td>
		<td  valign="middle" align="right">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=366");
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
		</td>

	</tr>

	</table>

       

      </div>

	</div>

</div>

</td>

</tr>
<?php } ?>
</table>




<?php
if ($_SESSION[WEBSITE_ALIAS]['language'] ==""){
?>
<table width="100%" cellpadding="0" cellspacing="0"> 
	<tr>
		<td style="background:url('images/footerbg.png');">
   
    <div id="footer" style="padding:0px;margin:0px;background:white;background-color:#3DB3F7;color:white;background-color:transparent;height:100px;margin:0 auto;width:990px;">
	
	<table cellpadding="0" cellspacing="0" width="990px" height="100px">
	<tr>
		<td valign="middle" align="left">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=364");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$footer1 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$footer1 = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$footer1 = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$footer1 = $rowfield['fieldname_it'];
		}
			if ($footer1 != 0){
				echo $footer1;
			}
		?>
		</td>
		<td valign="middle" align="center">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=365");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$footer2 = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$footer2 = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$footer2 = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$footer2 = $rowfield['fieldname_it'];
		}
		if ($footer2 != 0){
				echo $footer2;
			}
		?>
		</td>
		<td  valign="middle" align="right">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=366");
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
		</td>
	</tr>
	</table>
       
      </div>
	</div>
</div>
</td>
	</tr>
</table>
</body>
</html>
<?php
}
?>