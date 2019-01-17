<?php
$mode = "";
$upload_dir = "../uploads/";
if ( isset($_GET['mode']) ) {
	$mode = strtolower(trim($_GET['mode']));	
} elseif ( isset($_POST['mode']) ) {
	$mode = strtolower(trim($_POST['mode']));
}
//echo "mode goes here : ".$mode;
$event_id = 0;
if (@$_GET['id'] > 0 ) {
	$event_id = $_GET['id'];
} elseif ( isset($_POST['event_id']) ) {
	$event_id = $_POST['event_id'];
}

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "Event");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'advertisement_events';

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value )
	{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	
	unset($post_data['form_action']);
	unset($post_data['mode']);	
	unset($post_data['event_id']);
	unset($post_data['Submit']);
	//$helper->pre_print_r($post_data); exit();

	$is_file_uploaded = false;
	$new_file = $_FILES['logo'];	  
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
				$img_height = img_width;
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
		$post_data['logo'] = $new_filename;
	} else {
		unset($post_data['logo']);
	}
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."events&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"event_id" ,$event_id ,$post_data);
		if ( $is_updated == 1 ) {
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."events&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') && ($event_id != 1) ) {
			$count_deleted = $sql_helper->delete($tablename ,"event_id" ,$event_id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."events&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."events");
		} else { 
			header("Location: ".INDEX_PAGE."events-m&id=".$event_id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."events");
		break;

}

// Retrieve record
if(!empty($event_id) || $event_id != '') :
	$record = $sql_helper->cget_row(DB_TABLE_PREFIX."advertisement_events", "event_id = '$event_id'");
	$advertiser = $record->advertiser;
	$event_title = $record->event_title;
	$event_description = $record->event_description;
	$category_id = $record-> category_id;
	$start_date = $record->start_date;
	$end_date = $record->end_date;
	$logo = $record->logo;
	$design_photo_img = '<img src="../uploads/'.$logo.'" border="0">';
endif;
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").validate({
		rules: {
			advertiser: {
				required: true
			},
			event_title: {
				required: true
			},
			start_date: {
				required: true
			},
			end_date: {
				required: true
			},
			event_description: {
				required: true
			},logo: {
				<?php if ($mode == "add") { ?>
				required: true,
				<?php } ?>
				accept: "(jpg|gif|png)"
			},
		},
		messages: {
			advertiser: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			event_title: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			category_id: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			start_date: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			end_date: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			event_description: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			logo: {
				required: "<?php echo $messages['validate']['required']?>",
				accept: "Invalid file type! Must be an image."
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
		<input type="hidden" name="event_id" value="<?php echo $event_id?>">						
		<div class="alert">
			<div class="message">
			<?php echo CONFIRM_DELETE . "Event" ?>?&nbsp;&nbsp;
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
        <input type="hidden" name="event_id" value="<?php echo $event_id?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">            	
                <tr>
                    <td class="key"><label for="advertiser">Advertiser <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="advertiser" id="advertiser" size="50" maxlength="150" value="<?php echo htmlentities($advertiser)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $advertiser?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="event_title">Event Title <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="event_title" id="event_title" size="50" maxlength="150" value="<?php echo htmlentities($event_title)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $event_title?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="event_description">Event Description <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="event_description" id="event_description" style="width:267px;height:auto;min-height:80px;"><?php echo htmlentities($event_description)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $event_description?></td>
                    <?php } ?>                                                                                                    
                </tr>
		<tr>
       			 <td class="key"><label for="category_id">Category ID <?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "category_id";
				$value_display['display'] = "category_name";
				$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."categories where category_activated=1 ORDER BY category_name asc");		
				echo $scaffold->dropdown_rs($rs,$value_display,"category_id",$category_id,"All Categories","");
				?>
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             if ($category_id != ""){
				$sql1 = mysql_query("select * from tbl_categories where category_id='".$category_id."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['category_name'];
			}else{
				echo "All Categories";
}
				?></td>
        		<?php } ?>
      		</tr>
<tr>
        <td class="key"><label for="design_photo">Photo
          <?php if ($mode=='add') echo $req_fld; ?>
          </label></td>
        <?php if ( $is_editable_field ) { ?>
        <td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
          <input name="logo" id="logo" type="file" size="35" />
          <span class="validation-status"></span>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>
		<tr>
                    <td class="key"><label for="start_date">Start Date <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="start_date" readonly="readonly" id="start_date" size="50" maxlength="150" value="<?php echo htmlentities($start_date)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $start_date?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="end_date">End Date <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="end_date" readonly="readonly" id="end_date" size="50" maxlength="150" value="<?php echo htmlentities($end_date)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $end_date?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                
            </table>        	
      </fieldset>    
        
        <?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php echo $button?>">
            <?php if ( $is_editable_field ) { ?>
            &nbsp;&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="Cancel">
            <?php } ?>
        </div>
        <?php } ?>

    </form>
</div>
