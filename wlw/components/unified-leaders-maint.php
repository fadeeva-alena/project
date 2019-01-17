<style>
	table.form-table td{border:1px solid #eeeeee;width:150px;}
</style>

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
                echo $masterid = $_REQUEST['masterid'];
                echo $ids = $_REQUEST['ids'];
                $sqlsave = mysql_query("select * from t_leader where id in ($ids)");
                echo "select * from t_leader where id in ($ids)";
				
				
				$concatshort = "";
				$countx=0;
	$sqlsave1 = mysql_query("select * from t_leader where id in ($ids)");
	while ($rowsave1 = mysql_fetch_array($sqlsave1)){
    $countx++;
		//echo $rowsave1['id']. "xxxx";
        if ($rowsave1['id'] != $masterid){
			if ($_POST['about'.$countx]){ 
				$concatshort .= $_POST['about'.$countx]."<br />";
			}
		}
	}
				$countx=0;
	//echo $concatshort;			
	$set = "";
						if ($_POST['company'] != ""){ $set .="company='".$_POST['company'] . "',"; }
						if ($_POST['firstname'] != ""){ $set .="firstname='".$_POST['firstname'] . "',"; }
						if ($_POST['lastname'] != ""){ $set .="lastname='".$_POST['lastname'] . "',"; }
						if ($_POST['gender'] != ""){ $set .="gender='".$_POST['gender'] . "',"; }
						//if ($_POST['about'] != ""){ $set .="about='".$_POST['about'] . "',"; }
						if ($_POST['contact_tel'] != ""){ $set .="contact_tel='".$_POST['contact_tel'] . "',"; }
						if ($_POST['contact_email'] != ""){ $set .="contact_email='".$_POST['contact_email'] . "',"; }
						if ($_POST['contact_url'] != ""){ $set .="contact_url='".$_POST['contact_url'] . "',"; }
					if ($_POST['image_path'] != ""){ $set .="image_path ='".$_POST['image_path'] . "',"; }
                while ($rowsave = mysql_fetch_array($sqlsave)){
				$countx++;
                    if ($rowsave['id'] != $masterid){
                        //get leaders events and use the master leader
                        $geteve = mysql_query("select * from t_event where (leader='".$rowsave['id']."' or leader2='".$rowsave['id']."')");
                        while ($roweve = mysql_fetch_array($geteve)){
                            //echo "update t_event set location='".$masterid."' where id='".$roweve['id']."'";
                            if ($roweve['leader'] == $rowsave['id']){
                            $sqlupdateeve = mysql_query("update t_event set leader='".$masterid."' where id='".$roweve['id']."'");
                            echo "update t_event set leader='".$masterid."' where id='".$roweve['id']."'";
                            }else{
                            $sqlupdateeve = mysql_query("update t_event set leader2='".$masterid."' where id='".$roweve['id']."'");
                            echo "update t_event set leader2='".$masterid."' where id='".$roweve['id']."'";
                            }
                        }

			//if ($_POST['about'.$countx]){ $concatshort .=$_POST['about'.$countx]."<br />";}
                        
                        //delete other leaders
                        mysql_query("delete from t_leader where id='".$rowsave['id']."'");
                        echo "delete from t_leader where id='".$rowsave['id']."'";
                        
                    }else{
					

				//update the master record
					if ($_POST['about'.$countx]){ $masterconcatshort =$_POST['about'.$countx] . "<br />";}
		if ($concatshort !=""){
			$masterconcatshort .=$concatshort;
		}
	    if ($masterconcatshort != ""){ $set .="about ='".$masterconcatshort . "',"; }   
						$set .='id='.$masterid;
				
						mysql_query("update t_leader set $set where id='$masterid'");
						echo "update t_leader set $set where id='$masterid'";

					}
                }
                
                header("Location: ".INDEX_PAGE."unified-leaders&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&a=edit&success=true");
                break;
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
	
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE."unified-leaders&providername=".$_REQUEST['providername']."&search_keyword=".$_REQUEST['search_keyword']?>';
		
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
	<td>
	</td>
                <?php
                $ids = $_REQUEST['ids'];
                $sqlall = mysql_query("select * from t_leader where id in ($ids)");
                //echo "select * from t_location where id in ($ids)";
                $countx = 0;
                while ($rowall = mysql_fetch_array($sqlall)){
					$countx++;
					if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                    ?>
                    <td align="center">
                    	<input type="radio" <?php echo $checkeddefault;?> id="column<?php echo $countx;?>" name="masterid" value="<?php echo $rowall['id'];?>" <?php echo $checkeddefault;?>/>
	<script>
	$(document).ready(function() {
		$('#column<?php echo $countx;?>').click(function () {
			$('.column<?php echo $countx;?>').attr('checked',true);
			<?php
				$count123 = 0;
				$sqlall123 = mysql_query("select * from t_leader where id in ($ids)");
				while ($rowall23 = mysql_fetch_array($sqlall123)){
					$count123++;
					if ($count123 != $countx){
					?>
						$('.column<?php echo $count123;?>').attr('checked',false);
					<?php
					}
				}
			?>
		});
	})
	</script>
                    </td>
                    <?php 
                //}
            } ?>  
</tr>
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
                    <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_leader where id in ($ids)";
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['company'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="company" value="<?php echo $rowall['company'];?>" />&nbsp;<?php } echo $rowall['company'];?></td>
        <?php 
        }
    } ?>                                                                                                    
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
       		<?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_leader where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php 
                $gender = $rowall['gender'];
                if ($gender > 0){
                    $sql1 = mysql_query("select * from t_gender where id='".$gender."'");
                    $row1 = mysql_fetch_array($sql1);
                    //echo $row1['gender_eng'];
                    ?><?php 
					
					if ($rowall['gender'] > 0){?>
                        <input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="gender" value="<?php echo $rowall['gender'];?>" />&nbsp;
                        <?php
                    }
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
                <?php 
           // }
        } ?> 				
				
				
        		
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
                    <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['firstname'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="firstname" value="<?php echo $rowall['firstname'];?>" />&nbsp;<?php }  echo $rowall['firstname'];?></td>
        <?php 
        }
    } ?>                                                                                                     
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
                    <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['lastname'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="lastname" value="<?php echo $rowall['lastname'];?>" />&nbsp;<?php }  echo $rowall['lastname'];?></td>
        <?php 
        }
    } ?>                                                                                                      
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
                    <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['about'] != ""){?><input type="checkbox" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="about<?php echo $countx;?>" value="<?php echo $rowall['about'];?>" />&nbsp;<?php }  echo $rowall['about'];?></td>
        <?php 
        }
    } ?>                                                                                                     
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
                    <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['contact_tel'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="contact_tel" value="<?php echo $rowall['contact_tel'];?>" />&nbsp;<?php }  echo $rowall['contact_tel'];?></td>
        <?php 
        }
    } ?>                                                                                                      
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
                   <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['contact_email'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="contact_email" value="<?php echo $rowall['contact_email'];?>" />&nbsp;<?php }  echo $rowall['contact_email'];?></td>
        <?php 
        }
    } ?>                                                                                                    
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
                    <?php } else { 
    ?>
    <?php
        $ids = $_REQUEST['ids'];
        $sqlall = mysql_query("select * from t_leader where id in ($ids)");
        //echo "select * from t_location where id in ($ids)";
        $countx = 0;
    while ($rowall = mysql_fetch_array($sqlall)){
        $countx++;
        if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
        ?>
            <td><?php if ($rowall['contact_url'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="contact_url" value="<?php echo $rowall['contact_url'];?>" />&nbsp;<?php }  echo $rowall['contact_url'];?></td>
        <?php 
        }
    } ?>                                                                                                    
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
    
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_leader where id in ($ids)");
//echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                    <td><?php if ($rowall['image_path'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="image_path" value="<?php echo $rowall['image_path'];?>" />&nbsp;<?php }  
			$image_path = $rowall['image_path'];
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
        }else{
        	$design_photo_img = '';
        }
		echo $design_photo_img;
?></td>
                    <?php
} ?>
    </tr>		
                
            </table>        	
      </fieldset>    
        
           
    <div class="standard-form-buttons">
    <input class="button" name="Submit" id="Submit" type="submit" value="<?php
    if ($mode == "add"){
    $sqlfield = mysql_query("select * from t_field_names where id=606");
    }elseif ($mode == "edit"){
    $sqlfield = mysql_query("select * from t_field_names where id=606");
    }else{
    $sqlfield = mysql_query("select * from t_field_names where id=606");
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
       
    </div>
    
	<input type="hidden" name="ids" value="<?php echo $_REQUEST['ids'];?>">
</form>
</div>
