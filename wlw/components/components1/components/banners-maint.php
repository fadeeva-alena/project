<?php
$upload_dir = "../uploads/";

$upload_result = "";
$diag_result = "";
$is_diag_failed = false;

// Upload directory diagnosis
if ( !is_dir($upload_dir) ) {
	$diag_result .= "The directory <b>($upload_dir)</b> doesn't exist.<br />";
	$is_diag_failed = true;
}

if ( (!is_writeable($upload_dir)) && (is_dir($upload_dir)) ) {
	$diag_result .= "The directory <b>($upload_dir)</b> is NOT writable, Please CHMOD (777).<br />";
	$is_diag_failed = true;
}

$mode = "";
if ( isset($_GET['mode']) ) {
	$mode = strtolower(trim($_GET['mode']));	
} elseif ( isset($_POST['mode']) ) {
	$mode = strtolower(trim($_POST['mode']));
}

$banner_id = 0;
if ($_GET['id'] > 0 ) {
	$banner_id = $_GET['id'];
} elseif ( isset($_POST['banner_id']) ) {
	$banner_id = $_POST['banner_id'];
}

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "Banner");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'banners';

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value )
	{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	

	unset($post_data['form_action']);		
	unset($post_data['mode']);
	unset($post_data['Submit']);
	//$helper->pre_print_r($post_data); exit();
	
	$is_file_uploaded = false;
	$new_file = $_FILES['photo'];	  
	$filename = $new_file['name'];
	$filename = str_replace(' ', '_', $filename);
	$file_tmp = $new_file['tmp_name'];	
	$ext = strtolower(strrchr($filename,'.'));

	$new_filename = '';
	$unique_id = $helper->unique_id();
	$upload_result_msg = '';
	
	// Check if the file was selected or not.
	if (!is_uploaded_file($file_tmp)) {
		$upload_result_msg .= $mode=='add' ? "<br>No file selected.<br>" : '';
		$is_file_selected = false;
	}else{
		$is_file_selected = true ;
	}	  				
	
	

	if ($is_file_selected==true) {
		$is_valid_file = true;
	}else{
		$is_valid_file = false;
	}

	if ($is_valid_file==true)
	{
		$upload_result_msg .= "Failed to upload.<br>";
		$is_file_uploaded = false;
		
				   			   			
			//Upload the files
		if ($form_action=='ADD')
		{
			unset($post_data['banner_id']);

			$banner_activated = $post_data['banner_activated'];
			//echo "INSERT INTO tbl_banners values ('0','','$title','$description','$featured')";
			//exit();
			$sql_addprod = mysql_query("INSERT INTO tbl_banners values ('0','','$banner_activated')");
			$banner_id = mysql_insert_id();
			
			//mysql_query("INSERT into tbl_productsizes values ('0','$size','$banner_id','$price','$weight','$unit','','0')");
			
				if ( $banner_id > 0 ) {
				// Upload the file	
				
				
				$filename = $_FILES['photo']['name'];
				$filetmp = $_FILES['photo']['tmp_name'];
				$ext = strtolower(strrchr($filename,'.'));
					
				$filepath = $upload_dir . $filename;
				
					
					//Photo Upload//////////////////////////////
					$new_filename = $banner_id.$ext;
					if (move_uploaded_file($file_tmp,$upload_dir.$new_filename))
					{			   			   			
					
						$info = getimagesize($upload_dir.$new_filename);
						list($width_old, $height_old) = $info;
						$img_width = "620";
						$img_height = "320";
					
						//image
						$image->create_image( $upload_dir, $new_filename, $new_filename, $img_width, $img_height, false, false);
						mysql_query("update tbl_banners set banner_image='$new_filename' where banner_id='$banner_id'");
						$is_file_uploaded = true;	
						$is_updated = 1;
					}	
					else{
						$is_file_uploaded = false;		
						$upload_result_msg .= "Failed to upload.<br>";
					}
					////////////////////////////////
					$result = 'true';
					}
					
					header("Location: ".INDEX_PAGE."banners&a=add&success=".$result);
				}
		$result = 'false';
		

	}

	if ($is_file_uploaded==true) {
		$post_data['photo'] = $new_filename;
	} else {
		unset($post_data['photo']);
	}
}

$result = '';

switch ($form_action)
{
	
	
	case 'EDIT':
		$is_updated = $sql_helper->update_all($tablename ,"banner_id" ,$banner_id ,$post_data);

				$filename = $_FILES['photo']['name'];
				
				if ($filename != "")
				{
					$filetmp = $_FILES['photo']['tmp_name'];
					$ext ="jpg";
						
					$filepath = $upload_dir . $filename;
				

					
						
						//Photo Upload//////////////////////////////
						$new_filename = $banner_id.'.'.$ext;
						if (move_uploaded_file($file_tmp,$upload_dir.$new_filename))
						{			   			   			
						
							mysql_query("update tbl_banners set banner_image='$new_filename' where banner_id='$banner_id'");
							
							$info = getimagesize($upload_dir.$new_filename);
							list($width_old, $height_old) = $info;
							$img_width = "620";
							$img_height = "320";
						
							//image
							$image->create_image( $upload_dir, $new_filename, $new_filename, $img_width, $img_height, false, false);
					
							$is_file_uploaded = true;	
							$is_updated = 1;
						}	
						else{
							$is_file_uploaded = false;		
							$upload_result_msg .= "Failed to upload.<br>";
						}
				}
		if ( $is_updated == 1 ) {
			$result='true';
			
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."banners&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') ) {
			$count_deleted = 0;
			// Get photo filename and delete it (record and actual file)
			$record = $sql_helper->cget_row(DB_TABLE_PREFIX."banners", "banner_id = '$banner_id'") ;
		
			$sql_select = mysql_query("select * from tbl_banners where banner_id='$banner_id'");
			$get_row = mysql_fetch_array($sql_select);
			
			$count_deleted = $sql_helper->delete($tablename ,"banner_id" ,$banner_id);
			
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."banners&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."banners");
		} else { 
			header("Location: ".INDEX_PAGE."banners-m&id=".$banner_id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."banners");
		break;

}

// Retrieve record
$record = $sql_helper->cget_row(DB_TABLE_PREFIX."banners", "banner_id = '$banner_id'") ;
$banner_activated = $record->banner_activated;
$photo_img = '<img src="../uploads/'.$record->banner_image .'" border="0" style="padding-bottom:5px;">';
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name; ?>").submit(function() {
		// update underlying textarea before submit validation
		tinyMCE.triggerSave();
	}).validate({
		rules: {
			
				photo: {
					<?php
					if ($mode == "add")
					{
					?>
					required: true,
					<?php
					}
					?>
					accept: "(jpg|jpeg|png|gif)"
				},
			banner_activated: "required"
		},
		messages: {
			photo: {
				required: '<?php echo $messages['validate']['required']?>',
				accept: 'Invalid file!'
			},
			banner_activated: "<?php echo $messages['validate']['required']; ?>"
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else if ( element.is("textarea") )
				error.appendTo ( element.next() );				
				//label.insertAfter(element.next());
			else
				error.appendTo( element.parent().find('span.validation-status') );
		}
	});
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE."banners"?>';
	});
		
});

tinyMCE.init({
	mode : "textareas",
	theme : "simple",
	skin : "default",
	skin_variant : "silver",
	editor_selector : "service_description",

	// update validation status on change
	onchange_callback: function(editor) {
		tinyMCE.triggerSave();
		$("#" + editor.id).valid();
	}
});
</script>

<h1><?php echo $page_heading; ?> <small>[ <?php echo $sub_heading; ?> ]</small></h1>

<?php if ( $mode == 'delete' ) { ?>
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" name="frm_<?php echo $page_name; ?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
		<input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>">						
		<div class="alert">
			<div class="message">
			<?php echo CONFIRM_DELETE . "Banner"; ?>?&nbsp;&nbsp;
			<input class="button button-short" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
            <input class="button button-short" name="Delete" type="submit" value="No" />
            </div>
		</div>
		</form>
	</div>   
<?php } ?>

<div class="content-main wide90">
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div>
    <?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" id="frm_<?php echo $page_name; ?>" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <input type="hidden" name="banner_id" value="<?php echo $banner_id; ?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table"> 
				<tr>
                    <td class="key" valign="top"><label for="photo">Banner Image <?php if ($mode=='add') echo $req_fld; ?></label></td>
                    <?php if ( $is_editable_field == 1 ) { ?>
                    <td>
						<?php if ($mode!='add') { echo $photo_img.'<br />'; } ?>
                    	<input type="file" name="photo" size="30" />
                    	<span class="validation-status"></span>
						<br />*REQUIRED SIZE:*
						<?php
							echo "Height: 320px, Width: 620px";
						?><br />
						*REQUIRED FILE TYPE FOR ALL:* ('.png' , '.jpg' , '.jpeg' ,'.gif')<br />
                    </td>
                    <?php } else { ?>
                    <td><?php echo $photo_img?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
                
                <tr>
                    <td class="key"><label for="status">Publish <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<?php
						$banner_activated = $mode=='add' ? 1 : $banner_activated;
						echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "banner_activated", $banner_activated, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
						?>
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $banner_activated==1 ? 'Yes' : 'No';?></td>
                    <?php } ?>                                                                                                    
                </tr>
            </table>        	
        </fieldset>    
        
        <?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php echo $button; ?>">
            <?php if ( $is_editable_field ) { ?>
            &nbsp;&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="Cancel">
            <?php } ?>
        </div>
        <?php } ?>

    </form>
</div>
