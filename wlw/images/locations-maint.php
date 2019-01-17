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
		$post_data['loc_image_path'] = $new_filename;
	} else {
		unset($post_data['loc_image_path']);
	}
	
	$post_data['provider'] = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	
	if ($post_data['loc_contact_url'] != ""){
		if (strpos($post_data['loc_contact_url'],"http") === false){
			$post_data['loc_contact_url'] = "http://" . $post_data['loc_contact_url'];
		}
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
       
	$sqlcountry = mysql_query("select * from t_country where id='".$post_data['loc_country']."'");
	$rowcountry = mysql_fetch_array($sqlcountry);
	
	
	$currentaddress = $post_data['loc_loc'] . " " .$post_data['loc_zip'];
	//$currentaddress = $post_data['loc_adress1'] . " " . $post_data['loc_adress2'] . " " . $post_data['loc_loc'] . " " . $post_data['loc_zip'] . " " . $rowcountry['long'];
    $currentlonglat = getLatLong($currentaddress);
	//var_dump($currentlonglat);
    $post_data['longitude'] = $currentlonglat['long'];
    $post_data['latitude'] = $currentlonglat['lat'];
	//exit();
	
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$post_data['created'] = date('Y-m-d');
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
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
		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."locations&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1 ) {
			$post_data['last_change'] = date('Y-m-d');
			$sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
			
			
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
			
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."locations&a=edit&success=".$result);
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
		
		if ( $_POST["Delete"] == $yes ) {
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
			header("Location: ".INDEX_PAGE."locations&a=delete&success=".$result);
		} elseif ( $_POST["Delete"] == $no ) {
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
	
	//$design_photo_img = '<img src="uploads/'.$loc_image_path.'" border="0">';
	
	if ($loc_image_path != ""){
			$path = "uploads/".$loc_image_path;
			list($widthimage, $heightimage, $type, $attr) = getimagesize($path);
			
			//$image_path = "images/your_image.png";

			//list($width, $height, $type, $attr)= getimagesize($image_path); 
			
			if ($widthimage >= $detail_max_x){
				$widthimage = $detail_max_x;
				$heightimage = "";
			}else{
				$widthimage = $widthimage;
			}
			
	
        	$design_photo_img = '<img src="uploads/'.$loc_image_path.'" border="0" width='.$widthimage.'>';
        }else{
        	$design_photo_img = '';
        }
endif;
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").validate({
	
		rules: {
			loc_name: {
				required: true
			},
			loc_detail: {
				//required: true
			},loc_adress1: {
				required: true
			},loc_adress2: {
				//required: true
			},
			loc_country: {
				required: true
			},
			loc_zip: {
				required: true
			},
			loc_loc: {
				required: true
			},loc_image_path: {
				<?php if ($mode == "add") { ?>
				//required: true,
				<?php } ?>
				accept: "(jpg|gif|png)"
			},loc_shortdesc: {
				//required: true
			},loc_contact_name: {
				//required: true
			},loc_contact_gender: {
				//required: true
			},loc_contact_email: {
				//required: true,
				email:true
			},loc_contact_url: {
				//required: true,
				url: true
			},loc_loc: {
				required: true
			},latitude: {
				//required: true
			},longitude: {
				//required: true
			}
			
			
	
		},
		messages: {
			loc_name: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			loc_detail: {
				//required: "<?php echo $messages['validate']['required']?>"
			},loc_adress1: {
				required: "<?php echo $messages['validate']['required']?>"
			},loc_adress2: {
				//required: "<?php echo $messages['validate']['required']?>"
			},
			loc_country: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			loc_zip: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			loc_loc: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			loc_image_path: {
				//required: "<?php echo $messages['validate']['required']?>",
				accept: "Invalid file type! Must be an image."
			},
			loc_shortdesc: {
				//required: "<?php echo $messages['validate']['required']?>"
			},loc_contact_name: {
				//required: "<?php echo $messages['validate']['required']?>"
			},loc_contact_gender: {
				//required: "<?php echo $messages['validate']['required']?>"
			},loc_contact_email: {
				//required: "<?php echo $messages['validate']['required']?>"
			},loc_contact_url: {
				//required: "<?php echo $messages['validate']['required']?>"
			},latitude: {
				//required: "<?php echo $messages['validate']['required']?>"
			},longitude: {
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
		location.href = '<?php echo INDEX_PAGE."locations"?>';
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

<div class="content-main wide80">
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
                    	<input type="text" name="loc_name" id="loc_name" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_name)?>" />
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
                    <td><?php echo $loc_name?></td>
                    <?php } ?>                                                                                                    
                </tr>
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
                    	<input type="text" name="loc_detail" id="loc_detail" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_detail)?>" />
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
                    <td><?php echo $loc_detail?></td>
                    <?php } ?>                                                                                                    
                </tr>
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
                    	<input type="text" name="loc_adress1" id="loc_adress1" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_adress1)?>" />
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
                    <td><?php echo $loc_adress1?></td>
                    <?php } ?>                                                                                                    
                </tr>
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
                    	<input type="text" name="loc_adress2" id="loc_adress2" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_adress2)?>" />
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
                    <td><?php echo $loc_adress2?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
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
				echo $row1['long'];
			}else{
				echo "";
}
				?></td>
        		<?php } ?>
      		</tr>
			
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
	/*$("#loc_zip").autocomplete("search.php", {
		width: 267,
		selectFirst: false
	});*/
	
	var loc_zipsuggest = [
		<?php
		$countloc_loc = 0;
		$query = mysql_query("SELECT ZIP,Location from t_zipch
				 order by ZIP asc");
		$numloc_loc = mysql_num_rows($query);
			while ($result = mysql_fetch_assoc($query)) {
			$countloc_loc++;
				$loc_zipsuggest = fixEncoding($result[ZIP]);
				$locsuggest = fixEncoding($result[Location]);
			if ($numloc_loc == $countloc_loc){	
		?>
		{ loc_zip: "<?php echo utf8_encode($loc_zipsuggest);?>", loc_loc: "<?php echo utf8_encode($locsuggest);?>" }
		<?php
			}else{
		?>
		{ loc_zip: "<?php echo utf8_encode($loc_zipsuggest);?>", loc_loc: "<?php echo utf8_encode($locsuggest);?>" },
		<?php
			}
		}
		?>
	];	
	
	$("#loc_zip").autocomplete(loc_zipsuggest, {
		minChars: 0,
		autoFill: false,
		formatItem: function(row, i, max) {
			return row.loc_zip + " " + row.loc_loc;
		},
		formatMatch: function(row, i, max) {
			
			return row.loc_zip + " " + row.loc_loc;
			
		},
		formatResult: function(row) {
			return row.loc_zip;
		}
	});
	$("#loc_zip").autocomplete(loc_zipsuggest);
	$("#loc_zip").result(function(event, row, formatted) {
		 $('#clone_loc_loc').html(row.loc_loc);
		var r = $('#clone_loc_loc');
		
		r.text(r.html());
		r.html(r.text());
		$('#loc_loc').val($('#clone_loc_loc').html());	
		
		
		
		//$('#loc_loc').val(row.loc_loc);
		
		
		
	});
	
	
	var locsuggest = [
		<?php
		$countloc_loc = 0;
		$query = mysql_query("SELECT Location,ZIP from t_zipch
				  order by Location asc");
		$numloc_loc = mysql_num_rows($query);
			while ($result = mysql_fetch_assoc($query)) {
			$countloc_loc++;
				$loc_zipsuggest = fixEncoding($result[ZIP]);
				$locsuggest = fixEncoding($result[Location]);
			if ($numloc_loc == $countloc_loc){	
		?>
		{ loc_zip: "<?php echo utf8_encode($loc_zipsuggest);?>", loc_loc: "<?php echo utf8_encode($locsuggest);?>" }
		<?php
			}else{
		?>
		{ loc_zip: "<?php echo utf8_encode($loc_zipsuggest);?>", loc_loc: "<?php echo utf8_encode($locsuggest);?>" },
		<?php
			}
		}
		?>
	];	
	
	$("#loc_loc").autocomplete(locsuggest, {
		minChars: 0,
		autoFill: false,
		formatItem: function(row, i, max) {
			return row.loc_loc + " " + row.loc_zip;
		},
		formatMatch: function(row, i, max) {
			return row.loc_loc + " " + row.loc_zip;
		},
		formatResult: function(row) {
			return row.loc_loc;
		}
	});
	$("#loc_loc").autocomplete(locsuggest);
	$("#loc_loc").result(function(event, row, formatted) {
		
		$('#clone_loc_zip').html(row.loc_zip);
		var r = $('#clone_loc_zip');
		
		r.text(r.html());
		r.html(r.text());
		$('#loc_zip').val($('#clone_loc_zip').html());	
		
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
		<div id="clone_loc_zip" style="font-size:0px;"></div>
		<div id="clone_loc_loc" style="font-size:0px;"></div>
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
				<input type="text" id="loc_zip" name="loc_zip" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_zip)?>"/>
		
		
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
                    <td><?php echo $loc_zip?></td>
                    <?php } ?>                                                                                                    
                </tr>	
		
			
		
			<tr>
                    <td class="key"  valign="top"><label for="loc_loc"><?php
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
					?> <?php
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
		?><?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text"  autocomplete="off" name="loc_loc" id="loc_loc" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_loc)?>" />
						<script>
						$(document).ready(function() {
							$('#loc_loc').focus(function () {
								$('#textloc_loc').show();
								$('#textloc_loc').html('<?php echo $helptext;?>');
							});
							$('#loc_loc').blur(function () {
								$('#textloc_loc').hide();
								$('#textloc_loc').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_loc"></div>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $loc_loc?></td>
                    <?php } ?>                                                                                                    
                </tr>	
				
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
                    <td><?php echo $loc_shortdesc?></td>
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
                    echo $row1['gender_de'];	
                }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
                    echo $row1['gender_eng'];
                }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
                    echo $row1['gender_fr'];
                }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
                    echo $row1['gender_it'];
                }
				
			}else{
				echo "";
            }
            ?></td>
            <?php } ?>
    </tr>
	  
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
                    	<input type="text" name="loc_contact_name" id="loc_contact_name" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_contact_name)?>" />
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
                    <td><?php echo $loc_contact_name?></td>
                    <?php } ?>                                                                                                    
                </tr>
	  
			
	  

		

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
                    	<input type="text" name="loc_contact_phone" id="loc_contact_phone" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_contact_phone)?>" />
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
                    <td><?php echo $loc_contact_phone?></td>
                    <?php } ?>                                                                                                    
                </tr>
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
                    	<input type="text" name="loc_contact_email" id="loc_contact_email" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_contact_email)?>" />
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
                    <td><?php echo $loc_contact_email?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
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
                    	<input type="text" name="loc_contact_url" id="loc_contact_url" style="width:190px;" maxlength="150" value="<?php echo htmlentities($loc_contact_url)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#loc_contact_url').focus(function () {
								$('#textloc_contact_url').show();
								$('#textloc_contact_url').html('<?php echo $helptext;?>');
								$('.validation-status').attr('style','float:right;margin-left:210px;');
							});
							$('#loc_contact_url').blur(function () {
								$('#textloc_contact_url').hide();
								$('#textloc_contact_url').html('');
								$('.validation-status').attr('style','');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_url"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo $loc_contact_url?></td>
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
          <input name="loc_image_path" id="loc_image_path" type="file" size="22" />
          <span class="validation-status"></span>
		  <script>
						$(document).ready(function() {
							$('#loc_image_path').focus(function () {
								$('#textloc_image_path').show();
								$('#textloc_image_path').html('<?php echo $helptext;?>');
							});
							$('#loc_image_path').blur(function () {
								$('#textloc_image_path').hide();
								$('#textloc_image_path').html('');
							});
						})
						</script>
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_image_path"></div>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>
			<!--
			<tr>
                    <td class="key"><label for="latitude">Latitude </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="latitude" id="latitude" style="width:190px;" maxlength="150" value="<?php echo htmlentities($latitude)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $latitude?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="longitude">Longitude </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="longitude" id="longitude" style="width:190px;" maxlength="150" value="<?php echo htmlentities($longitude)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $longitude?></td>
                    <?php } ?>                                                                                                    
                </tr>-->
				<?php if ($mode != "add"){ ?>
				<tr>
                    <td class="key"><label for="created">Record Created </label></td>

                    <td><?php echo $created;?></td>
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
                    	<input type="text" name="contact_div" id="contact_div" style="width:190px;" maxlength="150" value="<?php echo htmlentities($contact_div)?>" />
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
