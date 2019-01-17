<?php
$mode = "";
if ( isset($_GET['mode']) ) {
	$mode = strtolower(trim($_GET['mode']));	
} elseif ( isset($_POST['mode']) ) {
	$mode = strtolower(trim($_POST['mode']));
}

$administrator_id = 0;
if ($_GET['id'] > 0 ) {
	$administrator_id = $_GET['id'];
} elseif ( isset($_POST['administrator_id']) ) {
	$administrator_id = $_POST['administrator_id'];
}

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "User");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'administrators';

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value )
	{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	
	unset($post_data['form_action']);
	unset($post_data['mode']);	
	unset($post_data['administrator_id']);
	unset($post_data['c_username']);
	unset($post_data['password2']);
	unset($post_data['Submit']);
	
	if ($post_data['password']=="") {
		unset($post_data['password']);
	}
	//$helper->pre_print_r($post_data); exit();
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$post_data['datetime_created'] = "now";
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."administrators&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"administrator_id" ,$administrator_id ,$post_data);
		if ( $is_updated == 1 ) {
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."administrators&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') && ($administrator_id != 1) ) {
			$count_deleted = $sql_helper->delete($tablename ,"administrator_id" ,$administrator_id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."administrators&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."administrators");
		} else { 
			header("Location: ".INDEX_PAGE."administrators-m&id=".$administrator_id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."administrators");
		break;

}

// Retrieve record
$record = $sql_helper->cget_row(DB_TABLE_PREFIX."administrators", "administrator_id = '$administrator_id'") ;
$lastname = $record->lastname;
$firstname = $record->firstname;
$username = $record->username;
$is_active = $record->is_active;


?>

<script type="text/javascript">
$(document).ready(function() {

	var validator = $("#frm_<?php echo $page_name; ?>").validate({
		rules: {
			firstname: "required",
			lastname: "required",
			user_level: "required",
			username: {
				required: true,
				remote: "<?php echo PATH_COMPONENTS; ?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt('administrators'))?>&fn=<?php echo urlencode($crypt->encrypt('username'))?>&current=<?php echo urlencode($username)?>&m=<?php echo $mode; ?>"
			},
			<?php if ($mode!='edit') { ?>
			password: {
				required: true,
				minlength: <?php echo PWD_MIN_LEN?>
			},
			<?php } ?>
			password2: {
				required: true,
				equalTo: '#password'
			},
			is_active: "required"
		},
		messages: {
			firstname: "<?php echo $messages['validate']['required']; ?>",
			lastname: "<?php echo $messages['validate']['required']; ?>",
			user_level: "<?php echo $messages['validate']['required']; ?>",
			username: {
				required: "<?php echo $messages['validate']['required']; ?>",
				remote: $.format("<strong>{0}</strong> <?php echo $messages['validate']['unavailable']?>")				
			},
			password: {
				required: "<?php echo $messages['validate']['required']; ?>",
				minlength: "<?php echo $messages['validate']['min_len'] . PWD_MIN_LEN ?>"
			},
			password2: {
				required: "<?php echo $messages['validate']['required']; ?>",
				equalTo: "<?php echo $messages['validate']['pwd_mismatch']?>"
			},
			is_active: "<?php echo $messages['validate']['required']; ?>"
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
		location.href = '<?php echo INDEX_PAGE."administrators"?>';
	});
		
});

</script>

<h1>User <small>[ <?php echo $sub_heading; ?> ]</small></h1>

<?php if ( $mode == 'delete' ) { ?>
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" name="frm_<?php echo $page_name; ?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
		<input type="hidden" name="administrator_id" value="<?php echo $administrator_id; ?>">						
        <?php if ( $administrator_id != 1 ) { ?>
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
            	<a href="<?php echo INDEX_PAGE."administrators"; ?>">Cancel</a>
            </div>
		</div>        
        <?php } ?>
		</form>
	</div>
<?php } ?>

<div class="content-main default-height wide65">
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div>
    <?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" id="frm_<?php echo $page_name; ?>">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <input type="hidden" name="administrator_id" value="<?php echo $administrator_id; ?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">            	
                <tr>
                    <td class="key"><label for="firstname">First Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="firstname" id="firstname" size="35" maxlength="50" value="<?php echo htmlentities($firstname)?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $firstname?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="lastname">Last Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="lastname" id="lastname" size="35" maxlength="50" value="<?php echo htmlentities($lastname)?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $lastname?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="Username">Username <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="username" id="username" size="35" maxlength="50" value="<?php echo htmlentities($username)?>" />
                    	<span class="validation-status"></span>
                        <input type="hidden" name="c_username" id="c_username" value="<?php echo htmlentities(current_username)?>" />
                    </td>
                    <?php } else { ?>
                    <td><?php echo $username?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="Password">Password <? echo $req_fld_tmp = ($mode!='edit') ? $req_fld : ""  ?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="password" name="password" id="password" size="35" maxlength="50" value="<?php echo $password?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td>Not Shown</td>
                    <?php } ?>                                                                                                    
                </tr>                
                <?php if ( $mode == 'add' ) { ?>                                
                <tr>
                    <td class="key"><label for="Password2">Verify Password <?php echo $req_fld?></label></td>
                    <td>
                    	<input type="password" name="password2" id="password2" size="35" maxlength="50" />
                        <span class="validation-status"></span>
                    </td>
                </tr>
                <?php } ?>
				
                <tr>
                    <td class="key"><label for="is_active">Active <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<?php
						$is_active = $mode=='add' ? 1 : $is_active;
						echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "is_active", $is_active, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
						?>
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $is_active==1 ? 'Yes' : 'No';?></td>
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
