<?php
include ("transparent_bg.php");
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
	
	unset($post_data['providername']);
	unset($post_data['search_keyword']);
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
	$post_data['provider'] = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	
	if (strpos($post_data['contact_url'],"http") === false){
		//$post_data['contact_url'] = "http://" . $post_data['contact_url'];
	}
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$post_data['created'] = "now";
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
		header("Location: ".INDEX_PAGE."leaders&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1 ) {
		$post_data['timestamp'] = "now";
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
		header("Location: ".INDEX_PAGE."leaders&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&a=edit&success=".$result);
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
		
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."leaders&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&a=delete&success=".$result);
		} elseif ( $_POST["Delete"] == $no ) {
			header("Location: ".INDEX_PAGE."leaders&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']);
		} else { 
			header("Location: ".INDEX_PAGE."leaders-m&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&id=".$id);
		}				
		break;
	
	case 'VIEW':
		//header("Location: ".INDEX_PAGE."leaders");
		header("Location: ".INDEX_PAGE."leaders&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']);
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
	
	$created = $record->created;
	$timestamp = $record->timestamp;
	
	
	
	

	
	
	//$design_photo_img = '<img src="uploads/'.$image_path.'" border="0">';
	
	
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
endif;
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").validate({
		rules: {
			company: {
				//required: true
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
				//required: true
			},image_path: {
				<?php if ($mode == "add") { ?>
				//required: true,
				<?php } ?>
				accept: "(jpg|gif|png|jpeg)"
			},contact_tel: {
				//required: true
			},contact_email: {
				//required: true,
				email:true
			},
			contact_url: {
				//required: true,
				url: true
				
			},
			contact_div: {
				//required: true
			},url: "contact_url"
		},
		messages: {
			company: {
				//required: "<?php echo $messages['validate']['required']?>"
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
				//required: "<?php echo $messages['validate']['required']?>"
			},
			contact_tel: {
				//required: "<?php echo $messages['validate']['required']?>"
			},
			image_path: {
				//required: "<?php echo $messages['validate']['required']?>",
				accept: "<?php echo $error_file;?>"
			},
			contact_email: {
				//required: "<?php echo $messages['validate']['required']?>"
				email: "<?php echo $error_email;?>"
			},
			contact_url: {
				url: "<?php echo $error_url;?>"
			},
			contact_div: {
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
		},
		success: "valid",
		submitHandler: function(form) {
			$('#Submit').attr('disabled','disabled');
			form.submit(form);
		}
	});
	
	jQuery.validator.addMethod("contact_url", function(val, elem) {
    // if no url, don't do anything
    if (val.length == 0) { return true; }
 
    // if user has not entered http:// https:// or ftp:// assume they mean http://
    if(!/^(https?|ftp):\/\//i.test(val)) {
        val = 'http://'+val; // set both the value
        $(elem).val(val); // also update the form element
    }
	});
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE."leaders&providername=".$_REQUEST['providername']."&search_keyword=".$_REQUEST['search_keyword']?>';
		
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
		<input type="hidden" name="providername" id="providername" value="<?php echo $_GET['providername'];?>" />
		<input type="hidden" name="search_keyword" id="search_keyword" value="<?php echo $_GET['search_keyword'];?>" />
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
                    	<input type="text" name="company" id="company" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($company)?>" />
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
    echo $scaffold->dropdown_rs($rs,$value_display,"gender",$gender,"","");
    ?>
          		<span class="validation-status"></span> 
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
						<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textgender"></div>
				</td>
        		<?php } else { ?>
        		<td><?php 
                             if ($gender != ""){
				$sql1 = mysql_query("select * from t_gender where id='".$gender."'");
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
		?><?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="firstname" id="firstname" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($firstname)?>" />
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
		?><?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="lastname" id="lastname" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($lastname)?>" />
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
          <input name="image_path" id="image_path" type="file" style="width:190px;" />
          <span class="validation-status"></span>
		  <script>
						$(document).ready(function() {
							$('#image_path').focus(function () {
								$('#textimage_path').show();
								$('#textimage_path').html('<?php echo $helptext;?>');
								$('.validation-status').attr('style','float:right;margin-left:210px;');
							});
							$('#image_path').blur(function () {
								$('#textimage_path').hide();
								$('#textimage_path').html('');
								$('.validation-status').attr('style','');
							});
						})
						</script>
						<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:210px;margin-top:-18px;border:0px solid red;" id="textimage_path"></div>
		  
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>
	  
				
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
                    	<textarea name="about" id="about" style="width:190px;height:auto;min-height:80px;"><?php echo fixEncoding($about)?></textarea>
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
                    <td><?php echo $about?></td>
                    <?php } ?>                                                                                                    
                </tr>
		

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
                    	<input type="text" name="contact_tel" id="contact_tel" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($contact_tel)?>" />
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
                    	<input type="text" name="contact_email" id="contact_email" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($contact_email)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#contact_email').focus(function () {
								$('#textcontact_email').show();
								$('#textcontact_email').html('<?php echo $helptext;?>');
								$('.validation-status').attr('style','float:right;margin-left:210px;');
							});
							$('#contact_email').blur(function () {
								$('#textcontact_email').hide();
								$('#textcontact_email').html('');
								$('.validation-status').attr('style','');
							});
						})
						</script>
						<div style="display:none;float:right;width:210px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcontact_email"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo $contact_email?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
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
                    	<input type="text" name="contact_url" onkeyup="nospaces(this)" id="contact_url" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($contact_url)?>" />
                        <span class="validation-status"></span>
						<script>
						$(document).ready(function() {
							$('#contact_url').focus(function () {
								$('#textcontact_url').show();
								$('#textcontact_url').html('<?php echo $helptext;?>');
								$('.validation-status').attr('style','float:right;margin-left:210px;');
							});
							$('#contact_url').blur(function () {
								$('#textcontact_url').hide();
								$('#textcontact_url').html('');
								$('.validation-status').attr('style','');
							});
						})
						</script>
						<div style="display:none;float:right;width:210px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcontact_url"></div>
						</td>
                    <?php } else { ?>
                    <td><?php echo $contact_url?></td>
                    <?php } ?>                                                                                                    
                </tr>
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
				<?php if ($mode != "add"){ ?>
				<tr>
                    <td class="key"><label for="created">Record Created </label></td>

                    <td><?php echo $created;?></td>
                </tr>
				<?php if ($last_change != "0000-00-00 00:00:00"){?>
				<tr>
                    <td class="key"><label for="last_change">Record Last Updated </label></td>

                    <td><?php echo $timestamp;?></td>                   
                </tr>
				<?php 
					}
				} ?>
                
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
