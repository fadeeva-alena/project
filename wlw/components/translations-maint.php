<?php
include ("transparent_bg.php");
//$upload_dir = "uploads/";

	if ( isset($_GET['mode']) ) {
		$mode = strtolower(trim($_GET['mode']));	
	} elseif ( isset($_POST['mode']) ) {
		$mode = strtolower(trim($_POST['mode']));
	}


$id = 0;
if ($_GET['id'] > 0 ) {
	$id = $_GET['id'];
} elseif ( isset($_POST['id']) ) {
	$id = $_POST['id'];
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

$tablename = DB_TABLE_PREFIX.'field_names';

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
	unset($post_data['c_nick']);
	unset($post_data['c_email']);
	unset($post_data['pw2']);
	unset($post_data['Submit']);
	
	unset($post_data['trigger_prev']);
	unset($post_data['prev_url']);
	unset($post_data['trigger_next']);
	unset($post_data['next_url']);
	unset($post_data['nextSubmit']);
	unset($post_data['Submit']);
	
	//var_dump($post_data);
	//exit();
	
}

$result = '';

switch ($form_action)
{
	case 'ADD':	
		//$post_data['user_level'] = 3;
		//$post_data['timestamp'] = "now";
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."translations&a=add&mode=view&success=".$result."&id=".$id);
		break;
	
	case 'EDIT':		
		$is_updated = $sql_helper->update_all($tablename ,"id" ,$id ,$post_data);
		if ( $is_updated == 1 ) {
		
			//$post_data['timestamp'] = "now";
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
			$sqlfield = mysql_query("select * from t_field_names where id=29");
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
		//echo $page_heading;
			$post_data_activity_log['activity_log_content_id'] = "0";
			$post_data_activity_log['session_id'] = $_SESSION[WEBSITE_ALIAS]['session_id'];
			$post_data_activity_log['module_name'] = $page_heading;
			$post_data_activity_log['command'] = $add;
			$post_data_activity_log['command_time'] = "now";
			//$sql_helper->insert_all("t_activity_log_content",$post_data_activity_log);
			//exit();
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		
		unset($post_data['trigger_prev']);
	unset($post_data['prev_url']);
	unset($post_data['trigger_next']);
	unset($post_data['next_url']);
	
		if ($_REQUEST['trigger_prev'] == 0 and $_REQUEST['trigger_next'] == 0){
			header("Location: ".INDEX_PAGE."translations&a=edit&mode=edit&success=".$result);
		}elseif($_REQUEST['trigger_prev'] == 1 and $_REQUEST['trigger_next'] == 0){
			$prevurl = $_REQUEST['prev_url'];
			header("Location: ".$prevurl."&a=edit&mode=edit&success=".$result);
		}elseif($_REQUEST['trigger_prev'] == 0 and $_REQUEST['trigger_next'] == 1){
			$nexturl = $_REQUEST['next_url'];
			header("Location: ".$nexturl."&a=edit&mode=edit&success=".$result);
		}
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') && ($id != 1) ) {
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."translations&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."provider");
		} else { 
			header("Location: ".INDEX_PAGE."provider-m&id=".$id);
		}				
		break;
	
	case 'VIEW':
		//header("Location: ".INDEX_PAGE."translations");
		header("Location: ".INDEX_PAGE."translations&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']);
		break;

}

// Retrieve record
//$id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
$record = $sql_helper->cget_row(DB_TABLE_PREFIX."field_names", "id = '$id'") ;

$fieldname = $record->fieldname;
$fieldname_de = $record->fieldname_de;
$fieldname_eng = $record->fieldname_eng;
$fieldname_fr = $record->fieldname_fr;
$fieldname_it = $record->fieldname_it;

$helptext_de = $record->helptext_de;
$helptext_eng = $record->helptext_eng;
$helptext_fr = $record->helptext_fr;
$helptext_it = $record->helptext_it;

?>
<script src="plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
<link href="plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> 
<script type="text/javascript">
$(document).ready(function() {
	$("a.#modalevents,a.#modalevents1").fancybox({
	'titlePosition'	: 'inside',
	'transitionIn'	: 'none',
	'transitionOut'	: 'none'
	});
	var validator = $("#frm_<?php echo $page_name; ?>").validate({
		rules: {
			fieldname_de: "required",
			fieldname_eng: "required",
			fieldname_fr:"required",
			fieldname_it:"required"/*,
			helptext_de: "required",
			helptext_eng: "required",
			helptext_fr:"required",
			helptext_it:"required"*/
		},
		messages: {
			fieldname_de: "",
			fieldname_eng: "",
			fieldname_fr:"",
			fieldname_it:""/*,
			helptext_de: "",
			helptext_eng: "",
			helptext_fr:"",
			helptext_it:""*/
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
			//$('#Submit').attr('disabled','disabled');
			form.submit(form);
		}
	});
	
	$('#btnCancel').click(function () {
		//location.href = '<?php echo INDEX_PAGE."translations"?>';
		location.href = '<?php echo INDEX_PAGE."translations&providername=".$_REQUEST['providername']."&search_keyword=".$_REQUEST['search_keyword']?>';
	});
	
					$('#prev_id').click(function () {
						$('#trigger_prev').val('1');
					});
					$('#next_id').click(function () {
					
						$('#trigger_next').val('1');
					});
	
	$("#reminder").datepicker({dateFormat: 'dd.mm.yy',minDate: -0,
		changeMonth: true,
        changeYear: true});
	
		
});



</script>
	
	
<h1><?php
		$sqlfield = mysql_query("select * from t_field_names where id=348");
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
		?> <small>[ <?php echo $sub_heading; ?> ]</small></h1>

<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
     <div id="system-message">
     <div class="info">
     <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "")?></div>
     </div>
     </div>
     <?php } ?>


<div class="content-main wide70">
	<?php if ( $is_editable_field ) { ?>
	<div class="standard-form-instruction"><strong></strong>  <?php
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
    <form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" id="frm_<?php echo $page_name; ?>" enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
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
                    <td class="key"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=609");
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
		?><label for="nick">
                    </td>
                    <td>
                    	<?php echo $id;?>
                    </td>
                </tr>
				
				<tr>
                    <td class="key"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=349");
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
		?><label for="nick">
                    </td>
                    <td>
                    	<?php echo $fieldname;?>
                    </td>
                </tr>
				
			
                
                <tr>
                    <td class="key"><label for="nick"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=350");
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
		$sqlfield = mysql_query("select * from t_field_names where id=350");
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
		<?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="fieldname_de" id="fieldname_de" style="width:190px;" maxlength="200" value="<?php echo fixEncoding($fieldname_de)?>" />
					</td>
                    <?php } else { ?>
                    <td><?php echo $fieldname_de?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                <tr>
                    <td class="key"><label for="nick"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=351");
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
		$sqlfield = mysql_query("select * from t_field_names where id=351");
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
		?><?php echo $req_fld?> 
		</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="fieldname_eng" id="fieldname_eng" style="width:190px;" maxlength="200" value="<?php echo fixEncoding($fieldname_eng)?>" />
					</td>
                    <?php } else { ?>
                    <td><?php echo $fieldname_eng?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                <tr>
                    <td class="key"><label for="nick"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=352");
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
		$sqlfield = mysql_query("select * from t_field_names where id=352");
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
		?><?php echo $req_fld?> 
		</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="fieldname_fr" id="fieldname_fr" style="width:190px;" maxlength="200" value="<?php echo fixEncoding($fieldname_fr)?>" />
					</td>
                    <?php } else { ?>
                    <td><?php echo $fieldname_fr?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                <tr>
                    <td class="key"><label for="nick"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=353");
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
		$sqlfield = mysql_query("select * from t_field_names where id=353");
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
		?><?php echo $req_fld?> 
		</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="fieldname_it" id="fieldname_it" style="width:190px;" maxlength="200" value="<?php echo fixEncoding($fieldname_it)?>" />
					</td>
                    <?php } else { ?>
                    <td><?php echo $fieldname_it?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                
                
                <tr>
						<td class="key"><label for="helptext_de">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=354");
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
		$sqlfield = mysql_query("select * from t_field_names where id=354");
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
						<td>
							<textarea name="helptext_de" id="helptext_de" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($helptext_de)?></textarea>
							<span class="validation-status"></span>
		<script>
		$(document).ready(function() {
		$('#helptext_de').focus(function () {
		$('#texthelptext_de').show();
		$('#texthelptext_de').html('<?php echo $helptext;?>');
		});
		$('#helptext_de').blur(function () {
		$('#texthelptext_de').hide();
		$('#texthelptext_de').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="texthelptext_de"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $helptext_de?></td>
						<?php } ?>                                                                                                    
					</tr>
                
				<tr>
						<td class="key"><label for="helptext_eng">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=355");
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
		$sqlfield = mysql_query("select * from t_field_names where id=355");
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
						<td>
							<textarea name="helptext_eng" id="helptext_eng" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($helptext_eng)?></textarea>
							<span class="validation-status"></span>
		<script>
		$(document).ready(function() {
		$('#helptext_eng').focus(function () {
		$('#texthelptext_eng').show();
		$('#texthelptext_eng').html('<?php echo $helptext;?>');
		});
		$('#helptext_eng').blur(function () {
		$('#texthelptext_eng').hide();
		$('#texthelptext_eng').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="texthelptext_eng"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $helptext_eng?></td>
						<?php } ?>                                                                                                    
					</tr>
					
					<tr>
						<td class="key"><label for="helptext_fr">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=356");
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
		$sqlfield = mysql_query("select * from t_field_names where id=356");
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
						<td>
							<textarea name="helptext_fr" id="helptext_fr" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($helptext_fr)?></textarea>
							<span class="validation-status"></span>
		<script>
		$(document).ready(function() {
		$('#helptext_fr').focus(function () {
		$('#texthelptext_fr').show();
		$('#texthelptext_fr').html('<?php echo $helptext;?>');
		});
		$('#helptext_fr').blur(function () {
		$('#texthelptext_fr').hide();
		$('#texthelptext_fr').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="texthelptext_fr"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $helptext_fr?></td>
						<?php } ?>                                                                                                    
					</tr>
					
				<tr>
						<td class="key"><label for="helptext_it">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=357");
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
		$sqlfield = mysql_query("select * from t_field_names where id=357");
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
						<td>
							<textarea name="helptext_it" id="helptext_it" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($helptext_it)?></textarea>
							<span class="validation-status"></span>
		<script>
		$(document).ready(function() {
		$('#helptext_it').focus(function () {
		$('#texthelptext_it').show();
		$('#texthelptext_it').html('<?php echo $helptext;?>');
		});
		$('#helptext_it').blur(function () {
		$('#texthelptext_it').hide();
		$('#texthelptext_it').html('');
		});
		})
		</script>
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="texthelptext_it"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $helptext_it?></td>
						<?php } ?>                                                                                                    
					</tr>
				
				
            </table>        	
        </fieldset>    
        
        <?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=262");
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
		
		&nbsp;&nbsp;
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=317");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$prevlabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$prevlabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$prevlabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$prevlabel = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=318");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$nextlabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$nextlabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$nextlabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$nextlabel = $rowfield['fieldname_it'];
		}
	
				$sql_records = mysql_query("select * from t_field_names order by id asc");
				$row_records = mysql_fetch_array($sql_records);
				$first_resumeid = $row_records['id'];
				
				$sql_records = mysql_query("select * from t_field_names order by id desc");
				$row_records = mysql_fetch_array($sql_records);
				$last_resumeid = $row_records['id'];
				
				
				//$currentid = $_REQUEST['resume_manager_id'];
				if ($_REQUEST['id'] == ""){
					$currentid = $first_resumeid;
				}else{
					$currentid = $_REQUEST['id'];
				}
				$prev_sql = mysql_query("SELECT id
							FROM t_field_names
							WHERE id < '$currentid'
							ORDER BY id desc
							LIMIT 1");
				
				
				$prev_row = mysql_fetch_array($prev_sql);
				$prev_id = $prev_row['id'];

						
				
				if ($_REQUEST['id'] == ""){
					$currentid = $last_resumeid;
				}else{
					$currentid = $_REQUEST['id'];
				}
				$next_sql = mysql_query("SELECT id
							FROM t_field_names
							WHERE id > '$currentid'
							ORDER BY id asc
							LIMIT 1");
				$next_row = mysql_fetch_array($next_sql);
				$next_id = $next_row['id'];
				if ($_REQUEST['id']!=""){
					if ($first_resumeid !=$_REQUEST['id']){
						if ($prev_id!=""){
				?>
				<input type="hidden" name="trigger_prev" id="trigger_prev" value="0" />
				<input type="hidden" name="prev_url" value="index.php?option=translations-m&mode=<?php echo $mode;?>&id=<?php echo $prev_id;?>&prev=1" />
					<input class="button" name="Submit" id="prev_id" type="submit" value="<?php echo $prevlabel;?>">&nbsp;
				<?php
					//
						}
					}
				}
					else{
				?>
				<input type="hidden" name="trigger_prev" id="trigger_prev" value="0" />
				<input type="hidden" name="prev_url" value="index.php?option=translations-m&mode=<?php echo $mode;?>&id=<?php echo $last_resumeid;?>&prev=1" />
					<input class="button" name="prevSubmit" id="prev_id" type="submit" value="<?php echo $prevlabel;?>" >&nbsp;
				<?php
				}
			?>
				
				<?php
				if ($next_id != ""){
					if ($last_resumeid != $_REQUEST['id']){
				?>
				
				<input type="hidden" name="trigger_next" id="trigger_next" value="0" />
					<input type="hidden" name="next_url" value="index.php?option=translations-m&mode=<?php echo $mode;?>&id=<?php echo $next_id;?>&next=1" />
					&nbsp;<input class="button" name="nextSubmit" id="next_id" type="submit" value="<?php echo $nextlabel;?>" >&nbsp;
				<?php
					}
				}
				?>
		
		
				
		
		
		
		
		
		
		
		
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
	<center>
	
	</center>
</div>
