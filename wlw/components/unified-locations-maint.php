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

$tablename = DB_TABLE_PREFIX.'location';

if ( $form_action != '' ) {
	$countx = 0;
    $masterid = $_REQUEST['masterid'];
    $ids = $_REQUEST['ids'];
    $sqlsave = mysql_query("select * from t_location where id in ($ids)");
    $concatshort = "";
	$sqlsave1 = mysql_query("select * from t_location where id in ($ids)");
	while ($rowsave1 = mysql_fetch_array($sqlsave1)){
    $countx++;
        if ($rowsave1['id'] != $masterid){
			if ($_POST['loc_shortdesc'.$countx]){ 
				$concatshort .= $_POST['loc_shortdesc'.$countx]."<br />";
			}
		}
	}
	
    $countx = 0;
    
	$set = "";
          if ($_POST['loc_name'] != ""){ $set .="loc_name='".$_POST['loc_name'] . "',"; }
            if ($_POST['loc_detail'] != ""){ $set .="loc_detail='".$_POST['loc_detail'] . "',"; }
            if ($_POST['loc_adress1'] != ""){ $set .="loc_adress1='".$_POST['loc_adress1'] . "',"; }
            if ($_POST['loc_adress2'] != ""){ $set .="loc_adress2='".$_POST['loc_adress2'] . "',"; }
            if ($_POST['loc_country'] != ""){ $set .="loc_country='".$_POST['loc_country'] . "',"; }
            if ($_POST['loc_zip'] != ""){ $set .="loc_zip='".$_POST['loc_zip'] . "',"; }
            if ($_POST['loc_loc'] != ""){ $set .="loc_loc='".$_POST['loc_loc'] . "',"; }

                

            if ($_POST['loc_contact_name'] != ""){ $set .="loc_contact_name='".$_POST['loc_contact_name'] . "',"; }
            if ($_POST['loc_contact_gender'] != ""){ $set .="loc_contact_gender='".$_POST['loc_contact_gender'] . "',"; }
            if ($_POST['loc_contact_phone'] != ""){ $set .="loc_contact_phone='".$_POST['loc_contact_phone'] . "',"; }
            if ($_POST['loc_contact_email'] != ""){ $set .="loc_contact_email='".$_POST['loc_contact_email'] . "',"; }
			if ($_POST['loc_contact_url'] != ""){ $set .="loc_contact_url='".$_POST['loc_contact_url'] . "',"; }
		if ($_POST['loc_image_path'] != ""){ $set .="loc_image_path ='".$_POST['loc_image_path'] . "',"; }
		
    while ($rowsave = mysql_fetch_array($sqlsave)){
    $countx++;

	
		//loc_image_path


        if ($rowsave['id'] != $masterid){
            //get location events and use the master location
            $geteve = mysql_query("select * from t_event where location='".$rowsave['id']."'");
            while ($roweve = mysql_fetch_array($geteve)){
                //echo "update t_event set location='".$masterid."' where id='".$roweve['id']."'";
                
                $sqlupdateeve = mysql_query("update t_event set location='".$masterid."' where id='".$roweve['id']."'");
            }
			
			
            
            //delete other locations
            mysql_query("delete from t_location where id='".$rowsave['id']."'");
            
        }else{
            //update the master record
            
  
            if ($_POST['loc_shortdesc'.$countx]){ $masterconcatshort =$_POST['loc_shortdesc'.$countx] . "<br />";}
			//echo $contactshort;
		if ($concatshort !=""){
			//echo $contactshort;
			$masterconcatshort .= $concatshort;
		}
	    if ($masterconcatshort != ""){ $set .="loc_shortdesc ='". $masterconcatshort . "',"; }      

           
            $set .='id='.$masterid;
            
            
            mysql_query("update t_location set $set where id='$masterid'");
            echo "update t_location set $set where id='$masterid'";
            
        }
    }
    
    header("Location: ".INDEX_PAGE."unified-locations&providername=".$_POST['providername']."&search_keyword=".$_POST['search_keyword']."&a=edit&success=true");
    break;
}    

$result = '';



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
	
    
	
	$('#btnCancel').click(function () {
		//location.href = '<?php echo INDEX_PAGE."locations"?>';
		location.href = '<?php echo INDEX_PAGE."unified-locations&providername=".$_REQUEST['providername']."&search_keyword=".$_REQUEST['search_keyword']?>';
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
    $sqlall = mysql_query("select * from t_location where id in ($ids)");
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
				$sqlall123 = mysql_query("select * from t_location where id in ($ids)");
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
        <input type="text" name="loc_name" id="loc_name" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_name)?>" />
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
        <?php } else { 
            ?>
            <?php
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td>
                <?php if ($rowall['loc_name'] != ""){?>
                    <input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_name" value="<?php echo $rowall['loc_name'];?>" />&nbsp;
                    <?php } ?>
                <?php echo $rowall['loc_name'];?></td>
                <?php 
            }
        } ?>                                                                                                    
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
        <input type="text" name="loc_detail" id="loc_detail" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_detail)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                
                <td><?php if ($rowall['loc_detail'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_detail" value="<?php echo $rowall['loc_detail'];?>" />&nbsp;<?php } echo $rowall['loc_detail'];?></td>
                <?php 
            }
        } ?>                                                                                                
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
        <input type="text" name="loc_adress1" id="loc_adress1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_adress1)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_adress1'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_adress1" value="<?php echo $rowall['loc_adress1'];?>" />&nbsp;<?php } echo $rowall['loc_adress1'];?></td>
                <?php 
            }
        } ?>                                                                                                
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
        <input type="text" name="loc_adress2" id="loc_adress2" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_adress2)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_adress2'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_adress2" value="<?php echo $rowall['loc_adress2'];?>" />&nbsp;<?php } echo $rowall['loc_adress2'];?></td>
                <?php 
            }
        } ?>                                                                                                
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
        
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                $loc_country = $rowall['loc_country'];
                ?>
                <td><?php if ($loc_country != ""){
                    
                    ?>
                    <?php if ($rowall['loc_name'] != ""){?>
                        <input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_country" value="<?php echo $rowall['loc_country'];?>" />&nbsp;
                        <?php
                    }
                    $sql1 = mysql_query("select * from t_country where id='".$loc_country."'");
                    $row1 = mysql_fetch_array($sql1);
                    echo $row1['long'];
                }else{
                    echo "";
                }?></td>
                <?php 
            }
        } ?> 
    
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
        <input type="text" id="loc_zip" name="loc_zip" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_zip)?>"/>
        
        
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_zip'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_zip" value="<?php echo $rowall['loc_zip'];?>" />&nbsp;<?php } echo $rowall['loc_zip'];?></td>
                <?php 
            }
        } ?>                                                                                                   
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
        <input type="text"  autocomplete="off" name="loc_loc" id="loc_loc" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_loc)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_loc'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_loc" value="<?php echo $rowall['loc_loc'];?>" />&nbsp;<?php } echo $rowall['loc_loc'];?></td>
                <?php 
            }
        } ?>                                                                                                
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
        <textarea name="loc_shortdesc" id="loc_shortdesc" style="width:190px;height:auto;min-height:80px;"><?php echo fixEncoding($loc_shortdesc)?></textarea>
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_shortdesc'] != ""){?><input type="checkbox" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_shortdesc<?php echo $countx?>" value="<?php echo $rowall['loc_shortdesc'];?>" />&nbsp;<?php } echo $rowall['loc_shortdesc'];?></td>
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
        
        
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php 
                $loc_contact_gender = $rowall['loc_contact_gender'];
                if ($loc_contact_gender > 0){
                    $sql1 = mysql_query("select * from t_gender where id='".$loc_contact_gender."'");
                    $row1 = mysql_fetch_array($sql1);
                    //echo $row1['gender_eng'];
                    ?><?php if ($rowall['loc_contact_gender'] > 0){?>
                        <input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_contact_gender" value="<?php echo $rowall['loc_contact_gender'];?>" />&nbsp;
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
            }
        } ?> 
    
    
    
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
        <input type="text" name="loc_contact_name" id="loc_contact_name" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_contact_name)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <?php if ($rowall['loc_contact_name'] != ""){?>
                    <td><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_contact_name" value="<?php echo $rowall['loc_contact_name'];?>" />&nbsp;<?php } echo $rowall['loc_contact_name'];?></td>
                <?php 
            }
        } ?>                                                                                                  
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
        <input type="text" name="loc_contact_phone" id="loc_contact_phone" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_contact_phone)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?><?php if ($rowall['loc_contact_phone'] > 0){?>
                    <td><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_contact_phone" value="<?php echo $rowall['loc_contact_phone'];?>" />&nbsp;<?php } echo $rowall['loc_contact_phone'];?></td>
                <?php 
            }
        } ?>                                                                                                         
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
        <input type="text" name="loc_contact_email" id="loc_contact_email" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_contact_email)?>" />
        <span class="validation-status"></span>
        <script>
        $(document).ready(function() {
            $('#loc_contact_email').focus(function () {
                $('#textloc_contact_email').show();
                $('#textloc_contact_email').html('<?php echo $helptext;?>');
                $('.validation-status').attr('style','float:right;margin-left:210px;');
            });
            $('#loc_contact_email').blur(function () {
                $('#textloc_contact_email').hide();
                $('#textloc_contact_email').html('');
                $('.validation-status').attr('style','');
            });
        })
        </script>
        <div style="display:none;float:right;width:210px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textloc_contact_email"></div>
        </td>
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_contact_email'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_contact_email" value="<?php echo $rowall['loc_contact_email'];?>" />&nbsp;<?php } echo $rowall['loc_contact_email'];?></td>
                <?php 
            }
        } ?>                                                                                                     
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
        <input type="text" name="loc_contact_url" onkeyup="nospaces(this)" id="loc_contact_url" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($loc_contact_url)?>" />
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
        <?php } else { 
            ?>
            <?php
            $rowall = "";
            $sqlall = "";
            $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                <td><?php if ($rowall['loc_contact_url'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_contact_url" value="<?php echo $rowall['loc_contact_url'];?>" />&nbsp;<?php } echo $rowall['loc_contact_url'];?></td>
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
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
//echo "select * from t_location where id in ($ids)";
            $countx = 0;
            while ($rowall = mysql_fetch_array($sqlall)){
                $countx++;
                if ($countx == 1){$checkeddefault = " checked=checked";}else{$checkeddefault='';}
                ?>
                    <td><?php if ($rowall['loc_image_path'] != ""){?><input type="radio" <?php echo $checkeddefault;?> class="column<?php echo $countx;?>" name="loc_image_path" value="<?php echo $rowall['loc_image_path'];?>" />&nbsp;<?php }  
			$loc_image_path = $rowall['loc_image_path'];
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
		echo $design_photo_img;
?></td>
                    <?php
} ?>
    </tr>
    <!--
    <tr>
    <td class="key"><label for="latitude">Latitude </label></td>
    <?php if ( $is_editable_field ) { ?>
        <td>
        <input type="text" name="latitude" id="latitude" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($latitude)?>" />
        <span class="validation-status"></span></td>
        <?php } else { ?>
            <td><?php echo $latitude?></td>
            <?php } ?>                                                                                                    
    </tr>
    <tr>
    <td class="key"><label for="longitude">Longitude </label></td>
    <?php if ( $is_editable_field ) { ?>
        <td>
        <input type="text" name="longitude" id="longitude" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($longitude)?>" />
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
                
                <?php
                ?>
                <?php
                $ids = $_REQUEST['ids'];
            $sqlall = mysql_query("select * from t_location where id in ($ids)");
            //echo "select * from t_location where id in ($ids)";
            while ($rowall = mysql_fetch_array($sqlall)){
                ?>
                <td><?php echo $rowall['last_change'];?></td>
                <?php 
                //}
            } ?>                  
            </tr>
            <?php 
        }
    } ?>
    
    
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
    
    </table>        	
    </fieldset>    
    
    <?php if ( $mode != 'delete' ) { ?>       
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
        <?php } ?>
	<input type="hidden" name="ids" value="<?php echo $_REQUEST['ids'];?>">
    </form>
    </div>