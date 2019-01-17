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

$button = $helper->button_val($mode, "Event");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'event';

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
			$img_width = 400;
			$img_height = 300;
			$img_thumb_width = 400;
			$img_thumb_height = 300;
			
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
		$post_data['eve_image_path'] = $new_filename;
	} else {
		unset($post_data['eve_image_path']);
	}
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$post_data['timestamp'] = date('Y-m-d');
		$post_data['provider'] = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."events&a=add&success=".$result);
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
		header("Location: ".INDEX_PAGE."events&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') ) {
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."events&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
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
	$date_remark = $record->date_remark;
	$time_start = $record->time_start;
	$time_end = $record->time_end;
	$remark_time = $record->remark_time;
	$leader = $record->leader;

	
	$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0">';
endif;
?>
<script src="../../wu/components/plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
<link href="../../wu/components/plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> 
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
			},short_desc: {
				required: true
			},
			long_desc: {
				required: true
			},
			location: {
				required: true
			},
			price: {
				required: true
			},
			currency: {
				required: true
			},
			remark_price: {
				required: true
			},
			remark_prerequisite: {
				required: true
			},eve_image_path: {
				<?php if ($mode == "add") { ?>
				required: true,
				<?php } ?>
				accept: "(jpg|gif|png)"
			}
			
			

			,date_start: {
				required: true
			},date_end: {
				required: true
			},date_remark: {
				required: true
			},time_start: {
				required: true
			},time_end: {
				required: true
			},remark_time: {
				required: true
			},leader: {
				required: true
			},provider: {
				required: true
			}
			,eve_contact_name: {
				required: true
			},eve_contact_gender: {
				required: true
			},eve_contact_email: {
				required: true,
				email:true
			},eve_contact_url: {
				required: true,
				url: true
			},eve_contact_phone: {
				required: true
			}
		},
		messages: {
			title: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			title: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			kind: {
				required: "<?php echo $messages['validate']['required']?>"
			},type: {
				required: "<?php echo $messages['validate']['required']?>"
			},short_desc: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			long_desc: {
				required: "<?php echo $messages['validate']['required']?>"
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
				required: "<?php echo $messages['validate']['required']?>"
			},
			remark_prerequisite: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			
			eve_image_path: {
				required: "<?php echo $messages['validate']['required']?>",
				accept: "Invalid file type! Must be an image."
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
				required: "<?php echo $messages['validate']['required']?>"
			},leader: {
				required: "<?php echo $messages['validate']['required']?>"
			},provider: {
				required: "<?php echo $messages['validate']['required']?>"
			},eve_contact_name: {
				required: "<?php echo $messages['validate']['required']?>"
			},eve_contact_gender: {
				required: "<?php echo $messages['validate']['required']?>"
			},eve_contact_email: {
				required: "<?php echo $messages['validate']['required']?>"
			},eve_contact_url: {
				required: "<?php echo $messages['validate']['required']?>"
			},eve_contact_phone: {
				required: "<?php echo $messages['validate']['required']?>"
			},longitude: {
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
		}
	});
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE."events"?>';
	});
		
});

//->calendar function
	$(document).ready(function() {
	 	$("#date_start").datepicker({
			changeMonth: true,
			dateFormat: 'yy-mm-dd',
			changeYear: true,
			onSelect:function(theDate) {
				$("#date_end").datepicker('option','minDate',new Date(theDate))
	  		}
	 	})
	 	$("#date_end").datepicker({
			changeMonth: true,
			changeYear: true,
			dateFormat: 'yy-mm-dd',
			onSelect:function(theDate) {
				$("#date_start").datepicker('option','maxDate',new Date(theDate))
		  	}
		})
		
		$("a.#modalpopup1,a.#modalpopup2").fancybox({
			'titlePosition'		: 'inside',
			'transitionIn'		: 'none',
			'transitionOut'		: 'none'
		});
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
                    <td class="key"><label for="title">Event Title <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="title" id="title" size="50" maxlength="150" value="<?php echo htmlentities($title)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $title?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
					 <td class="key"><label for="kind">Kind <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					$value_display['display'] = "kind_eng";
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_eng asc");		
					echo $scaffold->dropdown_rs($rs,$value_display,"kind",$kind,"Select Kind","");
					?>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($kind != ""){
					$sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
					$row1 = mysql_fetch_array($sql1);
					echo $row1['kind_eng'];
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				
				<tr>
					 <td class="key"><label for="type">Type <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					$value_display['display'] = "eventtype_eng";
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_eng asc");		
					echo $scaffold->dropdown_rs($rs,$value_display,"type",$type,"Select Type","");
					?>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($type != ""){
					$sql1 = mysql_query("select * from t_event_type where id='".$type."'");
					$row1 = mysql_fetch_array($sql1);
					echo $row1['eventtype_eng'];
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				
				<tr>
                    <td class="key"><label for="short_desc">Short Description <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="short_desc" id="short_desc" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($short_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $short_desc?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="long_desc">Long Description <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="long_desc" id="long_desc" style="width:267px;height:auto;min-height:80px;"><?php echo htmlentities($long_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $long_desc?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
					 <td class="key"><label for="location">Location <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					$value_display['display'] = "loc_name";
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."location  order by loc_name asc");		
					echo $scaffold->dropdown_rs($rs,$value_display,"location",$location,"Select Location","");
					?> Not in the list? Click <a href="../../wu/components/index2.php?option=locations2-m&amp;mode=add" id="modalpopup1">here</a>.
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($location != ""){
					$sql1 = mysql_query("select * from t_location where id='".$location."'");
					$row1 = mysql_fetch_array($sql1);
					echo $row1['loc_name'];
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				
				
				<tr>
                    <td class="key"><label for="price">Price <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="price" id="price" size="50" maxlength="150" value="<?php echo htmlentities($price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $price?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
					 <td class="key"><label for="currency">Currency <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					$value_display['display'] = "currency";
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."currency  order by currency asc");		
					echo $scaffold->dropdown_rs($rs,$value_display,"currency",$currency,"Select Currency","");
					?> 
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($location != ""){
					$sql1 = mysql_query("select * from t_currency where id='".$currency."'");
					$row1 = mysql_fetch_array($sql1);
					echo $row1['currency'];
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				
				<tr>
                    <td class="key"><label for="remark_price">Remark Price <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_price" id="remark_price" size="50" maxlength="150" value="<?php echo htmlentities($remark_price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $remark_price?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="remark_prerequisite">Remark Prerequisite <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="remark_prerequisite" id="remark_prerequisite" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($remark_prerequisite)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $remark_prerequisite?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="date_start">Start Date <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_start" id="date_start" readonly="readonly" size="50" maxlength="150" value="<?php echo htmlentities($date_start)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $date_start?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="date_end">End Date <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_end" id="date_end" readonly="readonly" size="50" maxlength="150" value="<?php echo htmlentities($date_end)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $date_end?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="date_remark">Date Remark <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_remark" id="date_remark" size="50" maxlength="150" value="<?php echo htmlentities($date_remark)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $date_remark?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				
				<tr>
       			 <td class="key"><label for="leader">Leader <?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "company";
				$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."leader  order by company asc");		
				echo $scaffold->dropdown_rs($rs,$value_display,"leader",$leader,"Select Leader","");
				?>Not in the list? Click <a href="../../wu/components/index2.php?option=leaders2-m&amp;mode=add" id="modalpopup2">here</a>.
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             if ($leader != ""){
				$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['company'];
			}else{
				echo "";
}
				?></td>
        		<?php } ?>
      		</tr>
			
		
			
				
	  
		<tr>
                    <td class="key"><label for="eve_contact_name">Contact Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_name" id="eve_contact_name" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_name)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $eve_contact_name?></td>
                    <?php } ?>                                                                                                    
                </tr>
	  
	 
		        <tr>
                    <td class="key"><label for="eve_contact_phone">Contact Phone <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_phone" id="eve_contact_phone" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_phone)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $eve_contact_phone?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="eve_contact_email">Contact Email <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_email" id="eve_contact_email" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_email)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $eve_contact_email?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="eve_contact_url">Contact URL <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_url" id="eve_contact_url" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_url)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $eve_contact_url?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
        <td class="key"><label for="design_photo">Photo
          <?php if ($mode=='add') echo $req_fld; ?>
          </label></td>
        <?php if ( $is_editable_field ) { ?>
        <td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
          <input name="eve_image_path" id="eve_image_path" type="file" size="35" />
          <span class="validation-status"></span>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>
			
			
				<?php if ($mode != "add"){ ?>
				
				<tr>
                    <td class="key"><label for="timestamp">Provider </label></td>

                    <td><?php 
						$sqlp = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE `id` = '{$provider}'") ;
						$rowp = mysql_fetch_array($sqlp);
						echo $rowp['firstname'] . " " . $rowp['lastname'];
					?></td>
                </tr>
				
				<tr>
                    <td class="key"><label for="timestamp">Record Created </label></td>

                    <td><?php echo date('F d, Y',strtotime($timestamp));?></td>
                </tr>
				<?php if ($last_change != "0000-00-00 00:00:00"){?>
				<tr>
                    <td class="key"><label for="last_change">Record Last Updated </label></td>

                    <td><?php echo date('F d, Y',strtotime($last_change));?></td>                   
                </tr>
				<?php 
					}
				} ?>
	  
				
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
            <?php if ( $is_editable_field ) { ?>
            &nbsp;&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="Cancel">
            <?php } ?>
        </div>
        <?php } ?>

    </form>
</div>
