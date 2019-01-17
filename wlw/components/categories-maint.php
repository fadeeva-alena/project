<?php
$mode = "";
if ( isset($_GET['mode']) ) {
	$mode = strtolower(trim($_GET['mode']));	
} elseif ( isset($_POST['mode']) ) {
	$mode = strtolower(trim($_POST['mode']));
}
//echo "mode goes here : ".$mode;
$category_id = 0;
if (@$_GET['id'] > 0 ) {
	$category_id = $_GET['id'];
} elseif ( isset($_POST['category_id']) ) {
	$category_id = $_POST['category_id'];
}

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "Category");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'categories';

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value )
	{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	
	unset($post_data['form_action']);
	unset($post_data['mode']);	
	unset($post_data['category_id']);
	unset($post_data['Submit']);
	//$helper->pre_print_r($post_data); exit();
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."categories&a=add&success=".$result);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"category_id" ,$category_id ,$post_data);
		if ( $is_updated == 1 ) {
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."categories&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') && ($category_id != 1) ) {
			$count_deleted = $sql_helper->delete($tablename ,"category_id" ,$category_id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."categories&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."categories");
		} else { 
			header("Location: ".INDEX_PAGE."categories-m&id=".$category_id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."categories");
		break;

}

// Retrieve record
if(!empty($category_id) || $category_id != '') :
	$record = $sql_helper->cget_row(DB_TABLE_PREFIX."categories", "category_id = '$category_id'");
	$category_name = $record->category_name;
	
	$category_activated = $record->category_activated;
endif;
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").validate({
		rules: {
			category_name: {
				required: true//,
				//remote: "<?php echo PATH_COMPONENTS?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt('categories'))?>&fn=<?php echo urlencode($crypt->encrypt('category_name'))?>&current=<?php echo urlencode($category_name)?>&m=<?php echo $mode?>"
			}
		},
		messages: {
			category_name: {
				required: "<?php echo $messages['validate']['required']?>",
				remote: $.format("<strong>{0}</strong> <?php echo $messages['validate']['unavailable']?>")
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
		location.href = '<?php echo INDEX_PAGE."categories"?>';
	});
		
});

</script>

<h1><?php echo $page_heading?> <small>[ <?php echo $sub_heading?> ]</small></h1>

<?php if ( $mode == 'delete' ) { ?>
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" name="frm_<?php echo $page_name?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
		<input type="hidden" name="category_id" value="<?php echo $category_id?>">						
		<div class="alert">
			<div class="message">
			<?php echo CONFIRM_DELETE . "Category" ?>?&nbsp;&nbsp;
			<input class="button button-short" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
            <input class="button button-short" name="Delete" type="submit" value="No" />
            </div>
		</div>
		</form>
	</div>
<?php } ?>

<div class="content-main default-height wide65">
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div>
    <?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="category_id" value="<?php echo $category_id?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">            	
                <tr>
                    <td class="key"><label for="category_name">Category Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="category_name" id="category_name" size="50" maxlength="150" value="<?php echo htmlentities($category_name)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $category_name?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                <tr>
                    <td class="key"><label for="category_activated">Active <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<?php
						$category_activated = $mode=='add' ? 1 : $category_activated;
						echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "category_activated", $category_activated, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
						?>
                        <span class="validation-status"></span>                    </td>
                    <?php } else { ?>
                    <td><?php echo $category_activated==1 ? 'Yes' : 'No';?></td>
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
