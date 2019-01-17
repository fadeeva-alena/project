<?php
error_reporting(0);
session_start();
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
$mode = "view";
$sqlfield = mysql_query("select * from t_field_names where id=81");
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

$tablename = DB_TABLE_PREFIX.'location';

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
	$new_file = $_FILES['loc_image_path'];	  
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
		$post_data['loc_image_path'] = $new_filename;
	} else {
		unset($post_data['loc_image_path']);
	}
	
	function getLatLong($address){
         if (!is_string($address))die("All Addresses must be passed as a string");
         $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
         $_result = false;
         if($_result = file_get_contents($_url)) {
         if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
         preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
         $_coords['lat'] = $_match[1];
         $_coords['long'] = $_match[2];
         }
         return $_coords;
         }
       
	
	//$currentaddress = $post_data['loc_loc'] . " " . $post_data['loc_zip'];
	$currentaddress = $post_data['loc_adress1'] . " " . $post_data['loc_adress2'] . " " . $post_data['loc_loc'] . " " . $post_data['loc_zip'] . " " . $post_data['long'];
    $currentlonglat = getLatLong($currentaddress);
    $post_data['longitude'] = $currentlonglat['long'];
    $post_data['latitude'] = $currentlonglat['lat'];
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$post_data['created'] = date('Y-m-d');
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."locations&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1 ) {
			$post_data['last_change'] = date('Y-m-d');
			$sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."locations&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') ) {
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."locations&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."locations");
		} else { 
			header("Location: ".INDEX_PAGE."locations-m&id=".$id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."locations");
		break;

}

// Retrieve record
if(!empty($id) || $id != '') :
	$record = $sql_helper->cget_row(DB_TABLE_PREFIX."location", "id = '$id'");
	$loc_name = $record->loc_name;
	$loc_detail = $record->loc_detail;
	$loc_adress1 = $record->loc_adress1;
	$loc_adress2 = $record->loc_adress2;
	$loc_country = $record->loc_country;
	$loc_zip = $record->loc_zip;
	$loc_loc = $record->loc_loc;
	$loc_shortdesc = $record->loc_shortdesc;
	$loc_contact_name = $record->loc_contact_name;
	
	$loc_contact_gender = $record->loc_contact_gender;
	$loc_contact_phone = $record->loc_contact_phone;
	$loc_contact_email = $record->loc_contact_email;
	$loc_contact_url = $record->loc_contact_url;
	$loc_loc = $record->loc_loc;
	$loc_image_path = $record->loc_image_path;
	$latitude = $record->latitude;
	$longitude = $record->longitude;
	
	$created = $record->created;
	$last_change = $record->last_change;
	if ($loc_image_path != ""){
		$design_photo_img = '<img src="uploads/'.$loc_image_path.'" width="180px" border="0">';
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
    <form action="#" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
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
            <table class="form-table">   
				<?php if ($design_photo_img != ""){?>
			<tr>
				<td></td>
				<td></td>
				<td rowspan="10" width="600px" colspan="2" align="right" valign="top">
				
				<?php echo $design_photo_img?>
				
				</td>
			</tr>
			<?php } ?>
				<?php
				if ($loc_name !=""){
			?>
                <tr>
                    <td class="key"><label for="loc_name"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=40");
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
		$sqlfield = mysql_query("select * from t_field_names where id=40");
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
                    	<input type="text" name="loc_name" id="loc_name" size="35" maxlength="150" value="<?php echo htmlentities($loc_name)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_name').focus(function () {
								$('#textloc_name').show();
								$('#textloc_name').html('<?php echo $helptext;?>');
							});
							$('#loc_name').blur(function () {
								$('#textloc_name').hide();
								$('#textloc_name').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_name"></div></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_name);?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php }
				if ($loc_detail !=""){
			?>
				<tr>
                    <td class="key"><label for="loc_detail"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=41");
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
		$sqlfield = mysql_query("select * from t_field_names where id=41");
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
                    	<input type="text" name="loc_detail" id="loc_detail" size="35" maxlength="150" value="<?php echo htmlentities($loc_detail)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_detail').focus(function () {
								$('#textloc_detail').show();
								$('#textloc_detail').html('<?php echo $helptext;?>');
							});
							$('#loc_detail').blur(function () {
								$('#textloc_detail').hide();
								$('#textloc_detail').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_detail"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_detail);?></td>
                    <?php } ?>                                                                                                    
                </tr><?php }
				if ($loc_adress1 !=""){
			?>
				<tr>
                    <td class="key"><label for="loc_adress1"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=42");
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
		$sqlfield = mysql_query("select * from t_field_names where id=42");
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
                    	<input type="text" name="loc_adress1" id="loc_adress1" size="35" maxlength="150" value="<?php echo htmlentities($loc_adress1)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_adress1').focus(function () {
								$('#textloc_adress1').show();
								$('#textloc_adress1').html('<?php echo $helptext;?>');
							});
							$('#loc_adress1').blur(function () {
								$('#textloc_adress1').hide();
								$('#textloc_adress1').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_adress1"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_adress1);?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php }
				if ($loc_adress2 !=""){
			?>
				<tr>
                    <td class="key"><label for="loc_adress2"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=43");
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
		$sqlfield = mysql_query("select * from t_field_names where id=43");
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
                    	<input type="text" name="loc_adress2" id="loc_adress2" size="35" maxlength="150" value="<?php echo htmlentities($loc_adress2)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_adress2').focus(function () {
								$('#textloc_adress2').show();
								$('#textloc_adress2').html('<?php echo $helptext;?>');
							});
							$('#loc_adress2').blur(function () {
								$('#textloc_adress2').hide();
								$('#textloc_adress2').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_adress2"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_adress2);?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php }
				if ($loc_loc !=""){
			?>
			<tr>
                    <td class="key" valign="top"><label for="loc_loc"><?php
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
					?> <?php
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
		$sqlfield = mysql_query("select * from t_field_names where id=45");
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
	$("#loc_zip").autocomplete("search.php", {
		width: 267,
		selectFirst: false
	});
	$("#loc_zip").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			var fetch = new String(data[1]);
						var fetchlist = fetch.split('~');
						
						if (fetchlist[0] == "undefined"){
							$('#loc_zip').val('');
						}else{
							$('#loc_zip').val(fetchlist[0]);
						}
						
						if (fetchlist[1] == "undefined"){
							$('#loc_loc').val('');
						}else{
							$('#loc_loc').val(fetchlist[1]);
						}
	});
	$("#loc_loc").autocomplete("search1.php", {
		width: 267,
		selectFirst: false
	});
	$("#loc_loc").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			var fetch = new String(data[1]);
						var fetchlist = fetch.split('~');
						
						if (fetchlist[0] == "undefined"){
							$('#loc_zip').val('');
						}else{
							$('#loc_zip').val(fetchlist[0]);
						}
						
						if (fetchlist[1] == "undefined"){
							$('#loc_loc').val('');
						}else{
							$('#loc_loc').val(fetchlist[1]);
						}
			
			
	});
	
	$("#loc_loc").blur(function() 
    { 
        var loc_loc = $("#loc_loc").val(); 
        
        if (loc_loc == ""){
            $("#loc_zip").val('');
		}
    }); 
    
    $("#loc_zip").blur(function() 
    { 
        var loc_zip = $("#loc_zip").val(); 
        
        if (loc_zip == ""){
            $("#loc_loc").val('');
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
				<input type="text" id="loc_zip" name="loc_zip" size="35" maxlength="150" value="<?php echo htmlentities($loc_zip)?>"/>
		
		
		<script>
						$(document).ready(function() {
							$('#loc_zip').focus(function () {
								$('#textloc_zip').show();
								$('#textloc_zip').html('<?php echo $helptext;?>');
							});
							$('#loc_zip').blur(function () {
								$('#textloc_zip').hide();
								$('#textloc_zip').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_zip"></div>
                        <span class="validation-status"></span>
						
						</td>
                    <?php } else { ?>
                    <td> <?php echo fixEncoding($loc_zip)?> <?php echo fixEncoding($loc_loc)?> </td>
                    <?php } ?>                                                                                                    
                </tr>	
			<?php }
			if ($loc_country !=""){
			?>
				<tr>
       			 <td class="key"><label for="loc_country"><?php
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
					?> <?php
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
		?><?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "long";
				
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."country");		
				
				echo $scaffold->dropdown_rs2($rs,$value_display,"loc_country",$loc_country);
				?>
          		<span class="validation-status"></span> 
				<script>
						$(document).ready(function() {
							$('#loc_country').focus(function () {
								$('#textloc_country').show();
								$('#textloc_country').html('<?php echo $helptext;?>');
							});
							$('#loc_country').blur(function () {
								$('#textloc_country').hide();
								$('#textloc_country').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_country"></div>
				</td>
        		<?php } else { ?>
        		<td><?php 
                             if ($loc_country != ""){
				$sql1 = mysql_query("select * from t_country where id='".$loc_country."'");
				$row1 = mysql_fetch_array($sql1);
				echo fixEncoding($row1['long']);
			}else{
				echo "";
}
				?></td>
        		<?php } ?>
      		</tr>

					
			<?php }
				if ($loc_shortdesc !=""){
			?>	
			<tr>
                    <td class="key"><label for="loc_shortdesc"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=47");
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
		$sqlfield = mysql_query("select * from t_field_names where id=47");
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
                    	<textarea name="loc_shortdesc" id="loc_shortdesc" style="width:190px;height:auto;min-height:80px;"><?php echo htmlentities($loc_shortdesc)?></textarea>
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_shortdesc').focus(function () {
								$('#textloc_shortdesc').show();
								$('#textloc_shortdesc').html('<?php echo $helptext;?>');
							});
							$('#loc_shortdesc').blur(function () {
								$('#textloc_shortdesc').hide();
								$('#textloc_shortdesc').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-78px;border:0px solid red;" id="textloc_shortdesc"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_shortdesc)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php }
				if ($gender !=""){
			?>
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
		?></label></td>
    <?php if ( $is_editable_field ) { ?>
        <td><?php
        $value_display['value'] = "id";
        //$value_display['display'] = "gender_eng";
        //$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."gender order by gender_eng asc");	
        
        if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
            $value_display['display'] = "gender_de";
            $rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."gender order by gender_de asc");		
        }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
            $value_display['display'] = "gender_eng";
            $rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."gender order by gender_eng asc");		
        }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
            $value_display['display'] = "gender_fr";
            $rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."gender order by gender_fr asc");		
        }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
            $value_display['display'] = "gender_it";
            $rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."gender order by gender_it asc");		
        }
        echo $scaffold->dropdown_rs($rs,$value_display,"loc_contact_gender",$loc_contact_gender,"","");
        ?>
        <span class="validation-status"></span> 
		<script>
						$(document).ready(function() {
							$('#loc_contact_gender').focus(function () {
								$('#textloc_contact_gender').show();
								$('#textloc_contact_gender').html('<?php echo $helptext;?>');
							});
							$('#loc_contact_gender').blur(function () {
								$('#textloc_contact_gender').hide();
								$('#textloc_contact_gender').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_gender"></div>
		</td>
        <?php } else { ?>
            <td><?php 
            if ($loc_contact_gender != ""){
				$sql1 = mysql_query("select * from t_gender where id='".$loc_contact_gender."'");
				$row1 = mysql_fetch_array($sql1);
				//echo $row1['gender_eng'];
				
				if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
                    echo fixEncoding($row1['gender_de']);	
                }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
                    echo fixEncoding($row1['gender_eng']);
                }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
                    echo fixEncoding($row1['gender_fr']);
                }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
                    echo fixEncoding($row1['gender_it']);
                }
				
			}else{
				echo "";
            }
            ?></td>
            <?php } ?>
    </tr>
	  <?php }
				if ($loc_contact_name !=""){
			?>
		<tr>
                    <td class="key"><label for="loc_contact_name"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=48");
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
		$sqlfield = mysql_query("select * from t_field_names where id=48");
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
                    	<input type="text" name="loc_contact_name" id="loc_contact_name" size="35" maxlength="150" value="<?php echo htmlentities($loc_contact_name)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_contact_name').focus(function () {
								$('#textloc_contact_name').show();
								$('#textloc_contact_name').html('<?php echo $helptext;?>');
							});
							$('#loc_contact_name').blur(function () {
								$('#textloc_contact_name').hide();
								$('#textloc_contact_name').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_name"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_contact_name)?></td>
                    <?php } ?>                                                                                                    
                </tr>
	  
			
	  

		<?php }
				if ($loc_contact_phone !=""){
			?>

		        <tr>
                    <td class="key"><label for="loc_contact_phone"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=50");
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
		$sqlfield = mysql_query("select * from t_field_names where id=50");
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
                    	<input type="text" name="loc_contact_phone" id="loc_contact_phone" size="35" maxlength="150" value="<?php echo htmlentities($loc_contact_phone)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_contact_phone').focus(function () {
								$('#textloc_contact_phone').show();
								$('#textloc_contact_phone').html('<?php echo $helptext;?>');
							});
							$('#loc_contact_phone').blur(function () {
								$('#textloc_contact_phone').hide();
								$('#textloc_contact_phone').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_phone"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($loc_contact_phone);?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php }
				if ($loc_contact_email !=""){
			?>
				<tr>
                    <td class="key"><label for="loc_contact_email"><?php
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
		?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="loc_contact_email" id="loc_contact_email" size="35" maxlength="150" value="<?php echo htmlentities($loc_contact_email)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_contact_email').focus(function () {
								$('#textloc_contact_email').show();
								$('#textloc_contact_email').html('<?php echo $helptext;?>');
							});
							$('#loc_contact_email').blur(function () {
								$('#textloc_contact_email').hide();
								$('#textloc_contact_email').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_email"></div>
						</td>
                    <?php } else { ?>
					<td><?php echo "<a href='mailto:".$loc_contact_email."'>" .$loc_contact_email?></a></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php }
				if ($loc_contact_url !=""){
			?>
				<tr>
                    <td class="key"><label for="loc_contact_url"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=52");
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
		$sqlfield = mysql_query("select * from t_field_names where id=52");
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
                    	<input type="text" name="loc_contact_url" id="loc_contact_url" size="35" maxlength="150" value="<?php echo htmlentities($loc_contact_url)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_contact_url').focus(function () {
								$('#textloc_contact_url').show();
								$('#textloc_contact_url').html('<?php echo $helptext;?>');
							});
							$('#loc_contact_url').blur(function () {
								$('#textloc_contact_url').hide();
								$('#textloc_contact_url').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_url"></div>
						</td>
                    <?php } else { ?>
					 <td><?php echo "<a href='".$loc_contact_url."' target=_blank>" .$loc_contact_url?></a></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php } 
			?>
				<!--<tr>
        <td class="key"><label for="design_photo">Photo
          
          </label></td>
        <?php if ( $is_editable_field ) { ?>
        <td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
          <input name="loc_image_path" id="loc_image_path" type="file" size="35" />
          <span class="validation-status"></span>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>-->
			
			<!--
			<tr>
                    <td class="key"><label for="latitude">Latitude </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="latitude" id="latitude" size="50" maxlength="150" value="<?php echo htmlentities($latitude)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $latitude?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="longitude">Longitude </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="longitude" id="longitude" size="50" maxlength="150" value="<?php echo htmlentities($longitude)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $longitude?></td>
                    <?php } ?>                                                                                                    
                </tr>-->
				
	  
				
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
