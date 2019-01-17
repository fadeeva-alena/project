<?php
$mode = "";
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

$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "User");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'provider';

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
	
	if ($post_data['pw']=="") {
		unset($post_data['pw']);
	}
	//$helper->pre_print_r($post_data); exit();
	
	$post_data['birthday'] = date('Y-m-d',strtotime($post_data['birthday']));
	$post_data['user_level'] = 2;
	
	//$post_data['timestamp'] = date('Y-m-d H:i:s');
	
}

$result = '';

switch ($form_action)
{
	case 'ADD':		
		$post_data['timestamp'] = "now";
		$id = $sql_helper->insert_all($tablename,$post_data);
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE."users&a=add&mode=view&success=".$result."&id=".$id);
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
		header("Location: ".INDEX_PAGE."users&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES') && ($id != 1) ) {
			$count_deleted = $sql_helper->delete($tablename ,"id" ,$id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE."users&a=delete&success=".$result);
		} elseif ( strtoupper($_POST["Delete"]) == 'NO' ) {
			header("Location: ".INDEX_PAGE."provider");
		} else { 
			header("Location: ".INDEX_PAGE."provider-m&id=".$id);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE."login");
		break;

}

// Retrieve record
$record = $sql_helper->cget_row(DB_TABLE_PREFIX."provider", "id = '$id'") ;

$lastname = $record->lastname;
$firstname = $record->firstname;
$nick = $record->nick;
$pw = $record->pw;
$email = $record->email;
$company = $record->company;
$adress1 = $record->adress1;
$adress2 = $record->adress2;
$country = $record->country;
$zip = $record->zip;
$location = $record->location;
$fon = $record->fon;
$fax = $record->fax;
$mobile = $record->mobile;
$birthday = $record->birthday;
$language = $record->language;


?>

<script type="text/javascript">
$(document).ready(function() {

	var validator = $("#frm_<?php echo $page_name; ?>").validate({
		rules: {
			//firstname: "required",
			//lastname: "required",
			birthday: "required",
			nick: {
				required: true,
				remote: "<?php echo PATH_COMPONENTS; ?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt('provider'))?>&fn=<?php echo urlencode($crypt->encrypt('nick'))?>&current=<?php echo urlencode($nick)?>&m=<?php echo $mode; ?>"
			},
			<?php if ($mode!='edit') { ?>
			pw: {
				required: true,
				minlength: <?php echo PWD_MIN_LEN?>
			},
			<?php } ?>
			pw2: {
				required: true,
				equalTo: '#pw'
			},
			email: {
				required: true,
				email: true,
				remote: "<?php echo PATH_COMPONENTS; ?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt('provider'))?>&fn=<?php echo urlencode($crypt->encrypt('email'))?>&current=<?php echo urlencode($email)?>&m=<?php echo $mode; ?>"
			},
			language: "required"
		},
		messages: {
			firstname: "<?php echo $messages['validate']['required']; ?>",
			lastname: "<?php echo $messages['validate']['required']; ?>",
			birthday: "<?php echo $messages['validate']['required']; ?>",
			nick: {
				required: "<?php echo $messages['validate']['required']; ?>",
				remote: $.format("<strong>{0}</strong> <?php echo $messages['validate']['unavailable']?>")				
			},
			email: {
				required: "<?php echo $messages['validate']['required']; ?>",
				remote: $.format("<strong>{0}</strong> <?php echo $messages['validate']['unavailable']?>")				
			},
			pw: {
				required: "<?php echo $messages['validate']['required']; ?>",
				minlength: "<?php echo $messages['validate']['min_len'] . PWD_MIN_LEN ?>"
			},
			pw2: {
				required: "<?php echo $messages['validate']['required']; ?>",
				equalTo: "<?php echo $messages['validate']['pwd_mismatch']?>"
			},
			language: "<?php echo $messages['validate']['required']; ?>"
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
		location.href = '<?php echo INDEX_PAGE."login"?>';
	});
	
	
		
});



</script>

<h1>User Account <small>[ <?php echo $sub_heading; ?> ]</small></h1>
<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
<div id="system-message">
    <div class="info">
        <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Event")?></div>
    </div>
</div>
<?php } ?>
<?php if ( $mode == 'delete' ) { ?>
	<div id="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option; ?>" method="post" name="frm_<?php echo $page_name; ?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode); ?>">
        <input type="hidden" name="mode" value="<?php echo $mode; ?>">
		<input type="hidden" name="id" value="<?php echo $id; ?>">						
        <?php if ( $id != 1 ) { ?>
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
            	<a href="<?php echo INDEX_PAGE."provider"; ?>">Cancel</a>
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
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">     
				<tr>
                    <td class="key"><label for="nick">Nick/Username <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="nick" id="nick" size="35" maxlength="50" value="<?php echo htmlentities($nick)?>" />
                    	<span class="validation-status"></span>
                        <input type="hidden" name="c_nick" id="c_nick" value="<?php echo htmlentities(current_nick)?>" />
                    </td>
                    <?php } else { ?>
                    <td><?php echo $nick?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="pw">Password <?php echo $req_fld_tmp = ($mode!='edit') ? $req_fld : ""  ?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="password" name="pw" id="pw" size="35" maxlength="50" value="<?php echo $pw?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td>Not Shown</td>
                    <?php } ?>                                                                                                    
                </tr>                
                <?php if ( $mode == 'add' ) { ?>                                
                <tr>
                    <td class="key"><label for="pw2">Verify Password <?php echo $req_fld?></label></td>
                    <td>
                    	<input type="password" name="pw2" id="pw2" size="35" maxlength="50" />
                        <span class="validation-status"></span>
                    </td>
                </tr>
                <?php } ?>
				
				<tr>
                    <td class="key"><label for="email">Email <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="email" id="email" size="35" maxlength="50" value="<?php echo htmlentities($email)?>" />
                    	<span class="validation-status"></span>
                        <input type="hidden" name="c_email" id="c_email" value="<?php echo htmlentities(current_email)?>" />
                    </td>
                    <?php } else { ?>
                    <td><?php echo $email?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="company">Company </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="company" id="company" size="35" maxlength="50" value="<?php echo htmlentities($company)?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $company?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="gender">Gender <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<?php
						$gender = $mode=='add' ? 1 : $gender;
						echo $scaffold->radio_arr($options=array('Male','Female'), $values=array(1, 0), "gender", $gender, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
						?>
                        <span class="validation-status"></span>                    </td>
                    <?php } else { ?>
                    <td><?php echo $gender==1 ? 'Yes' : 'No';?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="firstname">First Name </label></td>
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
                    <td class="key"><label for="lastname">Last Name </label></td>
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
                    <td class="key"><label for="adress1">Address 1 </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="adress1" id="adress1" size="35" maxlength="50" value="<?php echo htmlentities($adress1)?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $adress1?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="adress2">Address 2 </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="adress2" id="adress2" size="35" maxlength="50" value="<?php echo htmlentities($adress2)?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $adress2?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
				<tr>
       			 <td class="key"><label for="loc_country"> Country</label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "long";
				
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."country");		
				
				echo $scaffold->dropdown_rs($rs,$value_display,"country",$country);
				?>
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             
				$sql1 = mysql_query("select * from t_country where id='".$country."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['long'];
			
				?></td>
        		<?php } ?>
      		</tr>
                
				
			<tr>
                    <td class="key" valign="top"><label for="location">Zip</label></td>
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
	$("#zip").autocomplete("search.php", {
		width: 267,
		selectFirst: false
	});
	$("#zip").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			var fetch = new String(data[1]);
						var fetchlist = fetch.split('~');
						
						if (fetchlist[0] == "undefined"){
							$('#zip').val('');
						}else{
							$('#zip').val(fetchlist[0]);
						}
						
						if (fetchlist[1] == "undefined"){
							$('#location').val('');
						}else{
							$('#location').val(fetchlist[1]);
						}
	});
	$("#location").autocomplete("search1.php", {
		width: 267,
		selectFirst: false
	});
	$("#location").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			var fetch = new String(data[1]);
						var fetchlist = fetch.split('~');
						
						if (fetchlist[0] == "undefined"){
							$('#zip').val('');
						}else{
							$('#zip').val(fetchlist[0]);
						}
						
						if (fetchlist[1] == "undefined"){
							$('#location').val('');
						}else{
							$('#location').val(fetchlist[1]);
						}
			
			
	});
	
	$("#location").blur(function() 
    { 
        var location = $("#location").val(); 
        
        if (location == ""){
            $("#zip").val('');
		}
    }); 
    
    $("#zip").blur(function() 
    { 
        var zip = $("#zip").val(); 
        
        if (zip == ""){
            $("#location").val('');
		}
    }); 

	
	
	
});

</script>
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
				<input type="text" id="zip" name="zip" size="35" maxlength="150" value="<?php echo htmlentities($zip)?>"/>
		
		
		
                        <span class="validation-status"></span>
						
						</td>
                    <?php } else { ?>
                    <td><?php echo $zip?></td>
                    <?php } ?>                                                                                                    
                </tr>	
		
			
		
			<tr>
                    <td class="key"  valign="top"><label for="location">Location</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text"  autocomplete="off" name="location" id="location" size="35" maxlength="150" value="<?php echo htmlentities($location)?>" />
						
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $location?></td>
                    <?php } ?>                                                                                                    
                </tr>	
				
				
				<tr>
                    <td class="key"><label for="fon">Phone </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="fon" id="fon" size="35" maxlength="50" value="<?php echo htmlentities($fon)?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $fon?></td>
                    <?php } ?>                                                                                                    
                </tr>
                <tr>
                    <td class="key"><label for="fax">Fax </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="fax" id="fax" size="35" maxlength="50" value="<?php echo htmlentities($fax)?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $fax?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
                    <td class="key"><label for="mobile">Mobile </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="mobile" id="mobile" size="35" maxlength="50" value="<?php echo htmlentities($mobile)?>" />
                        <span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $mobile?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<script>
					$(document).ready(function() {
	 	$("#birthday").datepicker({
			changeMonth: true,
			maxDate: '-18Y',
			minDate: '-56Y',
			dateFormat: 'dd.mm.yy',
			changeYear: true,
			onSelect:function(theDate) {
				$("#date_end").datepicker('option','minDate',new Date(theDate))
	  		}
	 	})
	 	
	})
				</script>
                <tr>
                    <td class="key"><label for="birthday">Birthday <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="birthday" id="birthday" readonly="readonly" size="35" maxlength="50" value="<?php echo htmlentities($birthday)?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $birthday?></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<tr>
       			 <td class="key"><label for="language"> Language</label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "language";
				
					$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."languages");		
				
				echo $scaffold->dropdown_rs2($rs,$value_display,"language",$language);
				?>
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             
				$sql1 = mysql_query("select * from t_languages where id='".$language."'");
				$row1 = mysql_fetch_array($sql1);
				echo $row1['language'];
			
				?></td>
        		<?php } ?>
      		</tr>
				
            </table>        	
        </fieldset>    
        
        <?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php echo $button; ?>">
            <?php if ( $is_editable_field ) { ?>
            &nbsp;&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="Back to Login">
            <?php } ?>
        </div>
        <?php } ?>
    </form>
</div>
