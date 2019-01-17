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

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "Leader");
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
			$img_height = 100;
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
	
	
	
	

	
	
	$design_photo_img = '<img src="uploads/'.$image_path.'" border="0">';
endif;
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").validate({
		rules: {
			company: {
				required: true
			},
			firstname: {
				required: true
			},lastname: {
				required: true
			},
			gender: {
				required: true
			},
			about: {
				required: true
			},image_path: {
				<?php if ($mode == "add") { ?>
				required: true,
				<?php } ?>
				accept: "(jpg|gif|png)"
			},contact_tel: {
				required: true
			},contact_email: {
				required: true,
				email:true
			},contact_url: {
				required: true,
				url: true
			},contact_div: {
				required: true
			}
		},
		messages: {
			company: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			firstname: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			lastname: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			gender: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			about: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			contact_tel: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			image_path: {
				required: "<?php echo $messages['validate']['required']?>",
				accept: "Invalid file type! Must be an image."
			},
			contact_email: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			contact_url: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			contact_div: {
				required: "<?php echo $messages['validate']['required']?>"
			}
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},success: "valid",
		submitHandler: function(form) {
			var dataString = $('#frm_<?php echo $page_name?>').serialize();
			
			$.ajax({  
			  type: "POST",  
			  url: "components/leaders-submit.php",  
			  data: dataString,  
			  success: function(html) {  
				
				$("#leader").html(html);
				document.getElementById('fancybox-wrap').style.display ="none";
				document.getElementById('fancybox-overlay').style.display ="none";		
			  }  
			});  
			return false;
		}
	});
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE."leaders"?>';
	});
		
});

//->calendar function
	$(document).ready(function() {
	 	$("#start_date").datepicker({
			changeMonth: true,
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			onSelect:function(theDate) {
				$("#end_date").datepicker('option','minDate',new Date(theDate))
	  		}
	 	})
	 	$("#end_date").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			onSelect:function(theDate) {
				$("#start_date").datepicker('option','maxDate',new Date(theDate))
		  	}
		})
	})	

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
			<?php echo CONFIRM_DELETE . "Leader" ?>?&nbsp;&nbsp;
			<input class="button button-short" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
            <input class="button button-short" name="Delete" type="submit" value="No" />
            </div>
		</div>
		</form>
	</div>
<?php } ?>

<div class="content-main wide65">
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div>
    <?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">            	
                <tr>
                    <td class="key"><label for="company">Company <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="company" id="company" size="50" maxlength="150" value="<?php echo htmlentities($company)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $company?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="firstname">First Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="firstname" id="firstname" size="50" maxlength="150" value="<?php echo htmlentities($firstname)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $firstname?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="lastname">Last Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="lastname" id="lastname" size="50" maxlength="150" value="<?php echo htmlentities($lastname)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $lastname?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<!--
				<tr>
        <td class="key"><label for="design_photo">Photo
          <?php if ($mode=='add') echo $req_fld; ?>
          </label></td>
        <?php if ( $is_editable_field ) { ?>
        <td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
          <input name="image_path" id="image_path" type="file" size="35" />
          <span class="validation-status"></span>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>-->
	  <tr>
       			 <td class="key"><label for="gender">Gender <?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "gender_eng";
				$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."gender");		
				echo $scaffold->dropdown_rs($rs,$value_display,"gender",$gender,"Select Gender","");
				?>
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             if ($gender != ""){
				$sql1 = mysql_query("select * from t_gender where id='".$gender."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['gender_eng'];
			}else{
				echo "";
}
				?></td>
        		<?php } ?>
      		</tr>
				
				<tr>
                    <td class="key"><label for="about">About <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="about" id="about" style="width:267px;height:auto;min-height:80px;"><?php echo htmlentities($about)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $about?></td>
                    <?php } ?>                                                                                                    
                </tr>
		

		        <tr>
                    <td class="key"><label for="contact_tel">Contact Tel <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="contact_tel" id="contact_tel" size="50" maxlength="150" value="<?php echo htmlentities($contact_tel)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $contact_tel?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="contact_email">Contact Email <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="contact_email" id="contact_email" size="50" maxlength="150" value="<?php echo htmlentities($contact_email)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $contact_email?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="contact_url">Contact URL <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="contact_url" id="contact_url" size="50" maxlength="150" value="<?php echo htmlentities($contact_url)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $contact_url?></td>
                    <?php } ?>                                                                                                    
                </tr>
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
        
        <?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php echo $button?>">
            
        </div>
        <?php } ?>

    </form>
</div>
