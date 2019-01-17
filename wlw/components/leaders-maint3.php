<?php
error_reporting(0);
session_start();
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
$mode = "view";
$sqlfield = mysql_query("select * from t_field_names where id=82");
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

$tablename = DB_TABLE_PREFIX.'leader';

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
	unset($post_data['Submit']);
	//$helper->pre_print_r($post_data); exit();

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
			$img_width = 100;
			$img_height = 120;
			$img_thumb_width = 200;
			$img_thumb_height = 200;
			
			if ( $width_old < $height_old ) {
				$img_width = $img_height;
				$img_height = $img_width;
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
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."leaders&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1 ) {
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."leaders&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') ) {
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."leaders&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."leaders");
		} else { 
			header("Location: ".INDEX_PAGE."leaders-m&id=".$id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."leaders");
		break;

}

// Retrieve record
if(!empty($id) || $id != '') :
	$record = $sql_helper->cget_row(DB_TABLE_PREFIX."leader", "id = '$id'");
	$company = $record->company;
	$firstname = $record->firstname;
	$lastname = $record->lastname;
	$image_path = $record->image_path;
	
	$gender = $record->gender;
	$about = $record->about;
	$contact_tel = $record->contact_tel;
	$contact_email = $record->contact_email;
	$contact_div = $record->contact_div;
	$contact_url = $record->contact_url;
	
	
	
	

	
	if ($image_path != ""){
		$design_photo_img = '<img src="uploads/'.$image_path.'" border="0">';
	}
endif;
?>
<div style="width:700px;">
<h1><?php echo $page_heading?> <small>[ <?php echo $sub_heading?> ]</small></h1>

<?php if ( $mode == 'delete' ) { ?>
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" name="frm_<?php echo $page_name?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
		<input type="hidden" name="id" value="<?php echo $id?>">						
		<div class="alert">
			<div class="message">
			<?php echo CONFIRM_DELETE . "Leader" ?>?&nbsp;&nbsp;
			<input class="button button-short" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
            <input class="button button-short" name="Delete" type="submit" value="No" />
            </div>
		</div>
		</form>
	</div>
<?php } ?>

<?php
	if ($_GET['wide'] == "small"){
	echo '<style>.containerclass{width:700px;}</style>';
?>
<div class="content-main">
<?php
	}else{
?>
<div class="content-main">
<?php
	}
?>
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong></strong> <?php echo $req_fld?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=229");
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
		?></div>
    <?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="id" value="<?php echo $id?>">
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
			
            <table class="form-table" style="float:left;">   
			<?php if ($design_photo_img != ""){?>
			<tr>
				<td></td>
				<td></td>
				<td rowspan="10" colspan="2" align="right" valign="top" width="600px">
				
				<?php echo $design_photo_img?>
				
				</td>
			</tr>
			<?php } ?>
			<?php
				if ($company !=""){
			?>
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
                    	<input type="text" name="company" id="company" size="35" maxlength="150" value="<?php echo htmlentities($company)?>" />
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
                    <td><?php echo fixEncoding($company);?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				?>
                
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
		?><?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="firstname" id="firstname" size="35" maxlength="150" value="<?php echo htmlentities($firstname)?>" />
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
                    <td width="300px"> <?php echo fixEncoding($firstname);?> <?php echo fixEncoding($lastname);?></td>
                    <?php } ?>                                                                                                    
                </tr>
		
				<?php if ($about !=""){?>
				<tr>
                    <td class="key"><label for="about"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=35");
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
		$sqlfield = mysql_query("select * from t_field_names where id=35");
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
                    	<textarea name="about" id="about" style="width:190px;height:auto;min-height:80px;"><?php echo htmlentities($about)?></textarea>
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#about').focus(function () {
								$('#textabout').show();
								$('#textabout').html('<?php echo $helptext;?>');
							});
							$('#about').blur(function () {
								$('#textabout').hide();
								$('#textabout').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-78px;border:0px solid red;" id="textabout"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($about)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php } 
				if ($contact_tel != ""){?>

		        <tr>
                    <td class="key"><label for="contact_tel"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=36");
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
		$sqlfield = mysql_query("select * from t_field_names where id=36");
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
                    	<input type="text" name="contact_tel" id="contact_tel" size="35" maxlength="150" value="<?php echo htmlentities($contact_tel)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#contact_tel').focus(function () {
								$('#textcontact_tel').show();
								$('#textcontact_tel').html('<?php echo $helptext;?>');
							});
							$('#contact_tel').blur(function () {
								$('#textcontact_tel').hide();
								$('#textcontact_tel').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcontact_tel"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo $contact_tel?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php } 
				if ($contact_email != ""){?>
				<tr>
                    <td class="key"><label for="contact_email"><?php
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
                    	<input type="text" name="contact_email" id="contact_email" size="35" maxlength="150" value="<?php echo htmlentities($contact_email)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#contact_email').focus(function () {
								$('#textcontact_email').show();
								$('#textcontact_email').html('<?php echo $helptext;?>');
							});
							$('#contact_email').blur(function () {
								$('#textcontact_email').hide();
								$('#textcontact_email').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcontact_email"></div>
						</td>
                    <?php } else { ?>
                    
					<td><?php echo "<a href='mailto:".$contact_email."'>" .$contact_email?></a></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php } 
				if ($contact_url != ""){?>
				<tr>
                    <td class="key"><label for="contact_url"><?php
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
                    	<input type="text" name="contact_url" id="contact_url" size="35" maxlength="150" value="<?php echo htmlentities($contact_url)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#contact_url').focus(function () {
								$('#textcontact_url').show();
								$('#textcontact_url').html('<?php echo $helptext;?>');
							});
							$('#contact_url').blur(function () {
								$('#textcontact_url').hide();
								$('#textcontact_url').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcontact_url"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo "<a href='".$contact_url."' target=_blank>" .$contact_url?></a></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				
				if ($image_path != ""){
			$path = "uploads/".$image_path;
				list($widthimage, $heightimage, $type, $attr) = getimagesize($path);
				
				//$image_path = "images/your_image.png";

				//list($width, $height, $type, $attr)= getimagesize($image_path); 
				
				if ($widthimage >= $detail_max_x){
					$widthimage = $detail_max_x;
					$heightimage = "";
				}else{
					$widthimage = $widthimage;
				}
				
		
				$design_photo_img = '<img src="uploads/'.$image_path.'" border="0" width='.$widthimage.'>';
		
		
				//$design_photo_img = '<img src="uploads/'.$image_path.'" border="0" width=100px height=120>';
			}else{
				$design_photo_img = '';
			}
			
				if ($design_photo_img !=""){
			?>
			
			<?php
				}
				
				?>
				<!--
				<tr>
                    <td class="key"><label for="contact_div">Contact Div <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="contact_div" id="contact_div" size="50" maxlength="150" value="<?php echo htmlentities($contact_div)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $contact_div?></td>
                    <?php } ?>                                                                                                    
                </tr>-->
            </table>        	
      </fieldset>    
   
       

    </form>
</div>
</div>