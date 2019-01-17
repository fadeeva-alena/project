<?php
$mode = "";
if ( isset($_GET['mode']) ) {
	$mode = strtolower(trim($_GET['mode']));	
} elseif ( isset($_POST['mode']) ) {
	$mode = strtolower(trim($_POST['mode']));
}

$news_id = 0;
if ($_GET['id'] > 0 ) {
	$page_id = $_GET['id'];
} elseif ( isset($_POST['page_id']) ) {
	$page_id = $_POST['page_id'];
}

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "Section");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'pages';

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value )
	{
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	
	unset($post_data['form_action']);
	unset($post_data['mode']);	
	unset($post_data['page_id']);
	unset($post_data['Submit']);
	//$helper->pre_print_r($post_data); exit();
}

$result = '';

switch ($form_action)
{
	
	
	case 'EDIT':		
	$post_data['page_description'] = str_replace("../uploads/tinymce/",WEBSITE_TINYMCE_URL,$post_data['page_description']);
	$post_data['page_description'] = str_replace("plugins/tiny_mce/plugins/emotions/img/",WEBSITE_ADMIN_URL ."plugins/tiny_mce/plugins/emotions/img/",$post_data['page_description']);
	
		$is_updated = $sql_helper->update_all($tablename ,"page_id" ,$page_id ,$post_data);
		if ( $is_updated == 1 ) {
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE."pages-m&a=edit&mode=edit&id=".$page_id."&success=".$result);
		break;
	
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."pages");
		break;

}

// Retrieve record
$record = $sql_helper->cget_row(DB_TABLE_PREFIX."pages", "page_id = '$page_id'") ;
$page = $record->page_name;
$page_description = $record->page_description;
$is_approved = $record->is_approved;
?>

<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").submit(function() {
		// update underlying textarea before submit validation
		tinyMCE.triggerSave();
	}).validate({
		rules: {
			page_description: "required",
			is_approved: "required"
		},
		messages: {
			page_description: "required",
			is_approved: "<?php echo $messages['validate']['required']?>"
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
		location.href = '<?php echo INDEX_PAGE."pages"?>';
	});
		
});

tinyMCE.init({
	mode : "textareas",
	theme : "simple",
	editor_selector : "news_overview",
	onchange_callback: function(editor) {
		tinyMCE.triggerSave();
		$("#" + editor.id).valid();
	}
});

tinyMCE.init({
	mode : "textareas",
	theme : "advanced",
	skin : "o2k7",
	skin_variant : "silver",
	editor_selector : "page_description",
	plugins : "safari,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,inlinepopups,spellchecker,ibrowser",

	// Theme options
	theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
	theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor,|,spellchecker,",

	theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,media,advhr,|,print,|,ltr,rtl,|,fullscreen,|,ibrowser",
	theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : false,

	//Example content CSS (should be your site CSS)
	content_css : "../../scripts/css/style.css",

	// Drop lists for link/image/media/template dialogs
	template_external_list_url : "lists/template_list.js",
	external_lintbl_list_url : "lists/lintbl_list.js",
	external_image_list_url : "lists/image_list.js",
	media_external_list_url : "lists/media_list.js",


	// update validation status on change
	onchange_callback: function(editor) {
		tinyMCE.triggerSave();
		$("#" + editor.id).valid();
	}
});

</script>

<h1> <?php echo $page;?> Section <small>[ <?php echo $sub_heading?> ]</small></h1>

<?php  if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
<div id="system-message">
    <div class="info">
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Section Content")?></div>
    </div>
</div>
<?php  } ?>

<?php  if ( $mode == 'delete' ) { ?>
	
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" name="frm_<?php echo $page_name?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
		<input type="hidden" name="page_id" value="<?php echo $page_id?>">						
		<div class="alert">
			<div class="message">
			<?php echo CONFIRM_DELETE . "News" ?>?&nbsp;&nbsp;
			<input class="button" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
            <input class="button" name="Delete" type="submit" value="No" />
            </div>
		</div>
		</form>
	</div>
	
<?php  } ?>

<div class="content-main">
	<?php  if ( $is_editable_field == 1 ) { ?>
	<div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div>
    <?php  } ?>
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="page_id" value="<?php echo $page_id?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">            	
               <!-- <tr>
                    <td class="key"><label for="page_name">Page name </label></td>
                    <?php  if ( $is_editable_field == 1 ) { ?>
                    <td>
                    	<?php echo htmlentities($page)?>
                    	<span class="validation-status"></span>
                    </td>
                    <?php  } else { ?>
                    <td><?php echo $page?></td>
                    <?php  } ?>                                                                                                    
                </tr>-->
                
                <tr>
                    <td class="key key-vtop"><label for="page_description">Content <?php echo $req_fld?></label></td>
                    <?php  if ( $is_editable_field == 1 ) { ?>
                    <td>
                    	<textarea name="page_description" class="page_description" id="page_description" cols="130" rows="25"><?php echo htmlentities($page_description)?></textarea>
                    	<span class="validation-status"></span>
                    </td>
                    <?php  } else { ?>
                    <td><?php echo $page_description?></td>
                    <?php  } ?>                                                                                                    
                </tr>
               <!--<tr>
                    <td class="key"><label for="is_approved">Publish <?php echo $req_fld?></label></td>
                    <?php  if ( $is_editable_field == 1 ) { ?>
                    <td>
                    	<?
						$is_approved = $mode=='add' ? 1 : $is_approved;
						echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "is_approved", $is_approved, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
						?>
                        <span class="validation-status"></span>
                    </td>
                    <?php  } else { ?>
                    <td><?php echo $is_approved==1 ? 'Yes' : 'No';?></td>
                    <?php  } ?>                                                                                                    
                </tr>-->
            </table>        	
			
        </fieldset>    
        
        <?php  if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php echo $button?>">
            
        </div>
        <?php  } ?>

    </form>
</div>
