<?php
error_reporting(0);
session_start();
require_once ( 'includes/config.php' );
require_once ( 'libraries/libraries.php' );
$mode = "view";
function get_user_browser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $ub = '';
    if(preg_match('/MSIE/i',$u_agent))
    {
        $ub = "ie";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $ub = "firefox";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $ub = "safari";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $ub = "chrome";
    }
    elseif(preg_match('/Flock/i',$u_agent))
    {
        $ub = "flock";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $ub = "opera";
    }

    return $ub;
}
$sqllang = mysql_query("select * from t_event e inner join t_provider p on p.id=e.provider where e.id='".$_GET['events_id']."'");
$rowlang = mysql_fetch_array($sqllang);
$_SESSION[WEBSITE_ALIAS]['language'] = $rowlang['language'];

$sqlfield = mysql_query("select * from t_field_names where id=80");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$page_heading = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$page_heading = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$page_heading = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$page_heading = fixEncoding($rowfield['fieldname_it']);
		}
		
$sqlfield = mysql_query("select * from t_field_names where id=447");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$eventlogin = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$eventlogin = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$eventlogin = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$eventlogin = fixEncoding($rowfield['fieldname_it']);
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=448");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$eventregistration = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$eventregistration = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$eventregistration = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$eventregistration = fixEncoding($rowfield['fieldname_it']);
		}
//echo "mode goes here : ".$mode;
$id = 0;
if (@$_GET['events_id'] > 0 ) {
	$id = $_GET['events_id'];
} elseif ( isset($_POST['id']) ) {
	$id = $_POST['id'];
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color:white;background:url('none');">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<meta http-equiv="content-type" content="text/html; charset=UTF-8">-->
<title>Admin Panel</title>
<link rel="icon" href="images/favicon.ico" />

<script src="plugins/jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/jquery.validate.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/jquery.form.js" type="text/javascript" language="Javascript"></script>

<!--<script src="jquery/ui-lightness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>-->
<script src="plugins/jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>
<!--<script src="plugins/tiny_mce/tiny_mce.js" type="text/javascript" language="Javascript"></script>-->
<?php include ("js/login.php");?>
<script src="js/popup.js" type="text/javascript" language="Javascript"></script>
		
		<link href="plugins/jquery/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="plugins/jquery/facebox/facebox.js" type="text/javascript"></script> 
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'plugins/jquery/facebox/loading.gif',
        closeImage   : 'plugins/jquery/facebox/closelabel.png'
      })
    })
  </script>
</head>
<body>
<style>
html,body{
	background-color:white;
}
body,table,td {
    color:<?php if ($_GET['titlecolor'] == "") { echo "#000000"; } else { echo "#". $_GET['titlecolor'];} ?>;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 11px;
	margin:0px;
	padding:0px;
}

table.form-table td.key {
	background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;
	color:<?php if ($_GET['titlecolor'] == "") { echo "#000000"; } else { echo "#". $_GET['titlecolor'];} ?>;
    border-bottom: 1px solid #E9E9E9;
    border-right: 1px solid #E9E9E9;
    color: #333333;
    font-weight: bold;
    text-align: right;
    width: 140px;
}
table.form-table td {
    padding: 3px;
	background-color:<?php if ($_GET['bgcolor'] == "") { echo "white"; } else { echo "#" . $_GET['bgcolor'];} ?>;
}


</style>



<?php
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
	$sub_heading = fixEncoding($rowfield['fieldname_de']);
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$sub_heading = fixEncoding($rowfield['fieldname_eng']);
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$sub_heading = fixEncoding($rowfield['fieldname_fr']);
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$sub_heading = fixEncoding($rowfield['fieldname_it']);
}

$button = $helper->button_val($mode, "");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = DB_TABLE_PREFIX.'location';



// Retrieve record
$sqleventx = mysql_query("select * from t_event where id='".$id."'");
$rowevent = mysql_fetch_array($sqleventx);

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
		

		$min_number = $record->min_number;
		$max_number = $record->max_number;
		$active_for_reservation = $record->active_for_reservation;
		$cancellation_day1 = $record->cancellation_day1;
		$cancellation_day2 = $record->cancellation_day2;
		$cancellation_fee1 = $record->cancellation_fee1;
		$cancellation_fee2 = $record->cancellation_fee2;
		
		
		if ($min_number == 0){ $min_number = "";}
		if ($max_number == 0){ $max_number = "";}
		if ($cancellation_day1 == 0){ $cancellation_day1 = "";}
		if ($cancellation_fee1 == 0){ $cancellation_fee1 = "";}
		if ($cancellation_day2 == 0){ $cancellation_day2 = "";}
		if ($cancellation_fee2 == 0){ $cancellation_fee2 = "";}
		
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
		
		$date_start = date('d.m.Y',strtotime($record->date_start));
		$date_end = date('d.m.Y',strtotime($record->date_end));
		
		$date_remark = $record->date_remark;
		
		$time_start = $record->time_start;
		if ($time_start == "00:00:00"){
			$time_start = "";
		}
		$time_end = $record->time_end;
		if ($time_end == "00:00:00"){
			$time_end = "";
		}
		
		/*$time_start = $record->time_start;
		$time_end = $record->time_end;*/
		
		$remark_time = $record->remark_time;
		$leader = $record->leader;
		$leader2 = $record->leader2;
		
		$quality = $record->quality;

		
		if ($eve_image_path != ""){
				$path = "uploads/".$eve_image_path;
		list($widthimage, $heightimage, $types, $attr) = getimagesize($path);
		
		//$image_path = "images/your_image.png";

		//list($width, $height, $type, $attr)= getimagesize($image_path); 
		
		
		
		if ($widthimage >= $detail_max_x){
		$widthimage = $detail_max_x;
		$heightimage = "";
		}else{
		$widthimage = $widthimage;
		}
		
		
				$design_photo_img = '<img src="../uploads/'.$eve_image_path.'" border="0" width='.$widthimage.'>';
			}else{
				$design_photo_img = '';
			}
		
		
		//$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0">';
	endif;
	
	$sqllastentry = mysql_query("select * from t_event where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'
					order by id desc");
	$rowlastentry = mysql_fetch_array($sqllastentry);
	?>
	
	

	
		
		<?php 
			// quality 1
						$sqlfield = mysql_query("select * from t_field_names where id=320");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality1 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality1 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality1 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality1 = $rowfield['helptext_it'];
						}
						// quality 2
						$sqlfield = mysql_query("select * from t_field_names where id=321");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality2 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality2 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality2 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality2 = $rowfield['helptext_it'];
						}
						// quality 3
						$sqlfield = mysql_query("select * from t_field_names where id=322");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality3 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality3 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality3 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality3 = $rowfield['helptext_it'];
						}
						// quality 4
						$sqlfield = mysql_query("select * from t_field_names where id=323");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality4 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality4 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality4 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality4 = $rowfield['helptext_it'];
						}
						// quality 5
						$sqlfield = mysql_query("select * from t_field_names where id=324");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$quality5 = $rowfield['helptext_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$quality5 = $rowfield['helptext_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$quality5 = $rowfield['helptext_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$quality5 = $rowfield['helptext_it'];
						}
		
		$sqlfield = mysql_query("select * from t_field_names where id=100");
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
		$sqlfield = mysql_query("select * from t_field_names where id=13");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$helptext1 = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$helptext1 = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$helptext1 = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$helptext1 = $rowfield['helptext_it'];
		}
		if ($helptext1 == "0" or $helptext1 ==""){
		$helptext1 = "";
		}else{
		$helptext1 = $helptext1;
		}
		?>
		
		
		
	

	

	<div class="content-main" style="width:500px;">
		
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
			<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
			<input type="hidden" name="mode" value="<?php echo $mode?>">
			<input type="hidden" name="id" value="<?php echo $id?>">
			<input type="hidden" name="providername" id="providername" value="<?php echo $_GET['providername'];?>" />
			<input type="hidden" name="search_keyword" id="search_keyword" value="<?php echo $_GET['search_keyword'];?>" />
			
				<?php
					$rightwidth = $_GET['width'] - 150;
				?>
				<table class="form-table" style="border:1px solid #<?php echo $_GET['tablegrid'];?>">            	
					<tr>
						<td align=left class="key" width=150px style="width:150px;border:0px;text-align:left;background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"></td>
						<td align=left class="key" style="width:<?php echo $rightwidth;?>px;text-align:left;background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="title">
		
						<b><span style="border:0px;font-weight:bold;font-size:14px;size:4px;"><?php echo fixEncoding($title)?></span></b></td>
						                                                                                                   
					</tr>
		<tr>
		 <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="kind">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=3");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=3");
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
		<td><?php
		$value_display['value'] = "id";
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$value_display['display'] = "kind_de";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_de asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$value_display['display'] = "kind_eng";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_eng asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$value_display['display'] = "kind_fr";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_fr asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$value_display['display'] = "kind_it";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_it asc");	
		}
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"kind",$kind,"","style=width:190px;");
		?>
		<span class="validation-status"></span> 
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textkind"></div>
		</td>
		<?php } else { ?>
		<td><?php 
		 if ($kind != ""){
		$sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
		$row1 = mysql_fetch_array($sql1);
		//echo $row1['kind_eng'];
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($row1['kind_de']);	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($row1['kind_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($row1['kind_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($row1['kind_it']);
		}
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		
		<tr>
		 <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="type">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=4");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=4");
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
		<td><?php
		$value_display['value'] = "id";
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$value_display['display'] = "eventtype_de";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_de asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$value_display['display'] = "eventtype_eng";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_eng asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$value_display['display'] = "eventtype_fr";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_fr asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$value_display['display'] = "eventtype_it";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_it asc");	
		}
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"type",$type,"","style=width:190px");
		?>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texttype"></div></td>
		<?php } else { ?>
		<td><?php 
		 if ($type != ""){
		$sql1 = mysql_query("select * from t_event_type where id='".$type."'");
		$row1 = mysql_fetch_array($sql1);
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($row1['eventtype_de']);	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($row1['eventtype_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($row1['eventtype_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($row1['eventtype_it']);
		}
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		
		<tr>
		 <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="type"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=75");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=75");
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
		?> <?php echo $req_fld?></label></td>
		 <?php if ( $is_editable_field ) { ?>
		<td valign="middle"><?php
		$value_display['value'] = "id";
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$value_display['display'] = "quality_de";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_de asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$value_display['display'] = "quality_eng";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_eng asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$value_display['display'] = "quality_fr";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_fr asc");	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$value_display['display'] = "quality_it";
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_it asc");	
		}
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"quality",$quality,"","style=width:190px;float:left;margin-top:6px;");
		?><div id="image-icon" style="float:left;margin-left:5px;">
		<?php
		if ($mode != "add"){
			if ($quality ==1){
				echo '<img src=../images/'.$quality.'.png width=30px height=30px alt="'.$quality1.'"  title="'.$quality1.'">';
			}elseif ($quality ==2){
				echo '<img src=../images/'.$quality.'.png width=30px height=30px alt="'.$quality2.'"  title="'.$quality2.'">';
			}elseif ($quality ==3){
				echo '<img src=../images/'.$quality.'.png width=30px height=30px alt="'.$quality3.'"  title="'.$quality3.'">';
			}elseif ($quality ==4){
				echo '<img src=../images/'.$quality.'.png width=30px height=30px alt="'.$quality4.'"  title="'.$quality4.'">';
			}elseif ($quality ==5){
				echo '<img src=../images/'.$quality.'.png width=30px height=30px alt="'.$quality5.'"  title="'.$quality5.'">';
			}
		}
		?>
		</div>
		<span class="validation-status"></span> 
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:230px;margin-top:-18px;border:0px solid red;" id="textquality"></div>
		</td>
		<?php } else { ?>
		<td><?php 
		 if ($quality != ""){
		$sql1 = mysql_query("select * from t_quality where id='".$quality."'");
		$row1 = mysql_fetch_array($sql1);
		
		
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo $row1['quality_de'];	
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo $row1['quality_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo $row1['quality_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo $row1['quality_it'];
		}
		
		}else{
		echo "";
		}
		?></td>
		<?php } ?>
		</tr>
		<?php if ($short_desc !="") {?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="short_desc">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=5");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=5");
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
							<textarea name="short_desc" id="short_desc" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($short_desc)?></textarea>
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="textshort_desc"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($short_desc);?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($long_desc !="") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="long_desc">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=6");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=6");
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
							<textarea name="long_desc" id="long_desc" style="width:190px;height:auto;min-height:80px;"><?php echo fixEncoding($long_desc)?></textarea>
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-78px;border:0px solid red;" id="textlong_desc"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($long_desc)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} 		?>
		
		<!--start location auto complete/suggestion--->
	<tr>
        <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;" valign="top"><label for="location"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=45");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo fixEncoding($rowfield['fieldname_it']);
		}
		?>
		 / <?php
		$sqlfield = mysql_query("select * from t_field_names where id=7");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo fixEncoding($rowfield['fieldname_it']);
		}
		?>
		<?php
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
		?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	
		
				<?php
				
				if ($mode == "add"){
					$location = $rowlastentry['location'];
				}
				
				$rs = mysql_query("SELECT id,concat(loc_name ,', ',loc_detail,' ',loc_adress1, ' ',loc_adress2,' ',loc_zip,' ', loc_loc) as locname  FROM ".DB_TABLE_PREFIX."location where id='$location'");	
					
						$rowlocation = mysql_fetch_array($rs);
						$location = $rowlocation['locname'];
					
				?>
				<input type="text" id="location" name="location" style="width:190px;" maxlength="150" value="<?php echo trim(fixEncoding($location))?>"/>
				
				
				
				<input type="hidden" id="locid" name="locationid" value="<?php if ($mode == "add") { echo $rowlastentry['location'];} else {echo $record->location;}?>" /><br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <a href="index2.php?option=locations2-m&mode=add" id="modalpopup1"><?php $sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}?></a>.
				<div id="clone_location" style="display:none;"/></div>
		
                       
						</td>
                    <?php } else { ?>
                    <td><?php
                    $rs = mysql_query("SELECT id,concat(loc_name ,', ',loc_detail,' ',loc_adress1, ' ',loc_adress2,' ',loc_zip,' ', loc_loc) as locname  FROM ".DB_TABLE_PREFIX."location where id='$location'");
                    
                    $rowlocation = mysql_fetch_array($rs);
						$location = $rowlocation['locname'];
						echo fixEncoding($location);
                    ?></td>
                    <?php } ?>                                                                                                    
                </tr>
                
                <!--end location auto complete/suggestion--->
		
		
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="price">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=8");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=8");
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
						<?php if ( $is_editable_field ) { 
						
							if ($mode == "add"){
								$price = $rowlastentry['price'];
							}
						?>
						<td>
							<input type="text" name="price" id="price" style="width:40px;" maxlength="150" value="<?php echo fixEncoding($price)?>" />
											
		
		<b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=9");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=9");
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
		?></b> <?php echo $req_fld?>
		
		<div style="display:none;float:right;width:340px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textprice"></div>
		<?php
		$value_display['value'] = "id";
		$value_display['display'] = "currency";
		if ($mode == "add"){$currency= 1;}
		$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."currency  order by currency asc");	
		echo $scaffold->dropdown_rs2($rs,$value_display,"currency",$currency,"Select Currency","style=width:90px");
		?> 
		<span class="validation-status"></span> 
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcurrency"></div>
		</td>
						<?php } else { ?>
						<td><?php echo $price;
						$sql1 = mysql_query("select * from t_currency where id='".$currency."'");
		$row1 = mysql_fetch_array($sql1);
		echo " ". $row1['currency'];
		$currencyvalue = $row1['currency'];
						?>
						
						</td>
						<?php } ?>                                                                                                    
					</tr>
		
		<?php
		if ($remark_price !="") {
		?>
		
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="remark_price"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=10");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=10");
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
		?> </label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="remark_price" id="remark_price" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($remark_price)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textremark_price"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($remark_price)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($remark_prerequisite !="") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="remark_prerequisite"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=11");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=11");
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
							<textarea name="remark_prerequisite" id="remark_prerequisite" style="width:190px;height:auto;min-height:50px;"><?php echo fixEncoding($remark_prerequisite)?></textarea>
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-48px;border:0px solid red;" id="textremark_prerequisite"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($remark_prerequisite);?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		}
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="active_for_reservation">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=404");
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
		$sqlfield = mysql_query("select * from t_field_names where id=404");
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
							<input type="checkbox" name="active_for_reservation" id="active_for_reservation" value="1" <?php if ($active_for_reservation == 1){ echo ' checked="checked"';}?> />
							
							
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:30px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textactive_for_reservation"></div>
		</td>
						<?php } else { ?>
						<td><?php 
						if ($active_for_reservation == 1){
							$sqlfield = mysql_query("select * from t_field_names where id=281");
						}else{
							$sqlfield = mysql_query("select * from t_field_names where id=280");
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
						?></td>
						<?php } ?>                                                                                                    
					</tr>
	<?php
		if ($active_for_reservation == 1){
	?>	
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="time_start"> <?php
						$sqlfield = mysql_query("select * from t_field_names where id=401");
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
						
		$sqlfield = mysql_query("select * from t_field_names where id=395");
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
		?></label>
		
		<div style="display:none;float:left;width:220px;margin-left:350px;z-index:10000;position:absolute;margin-top:-10px;border:0px solid red;font-weight:normal;" id="textmin_number"></div>
		</td>
						<?php if ( $is_editable_field ) { ?>
						<td>
						<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=395");
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
		?>: </b>
							<input type="text" name="min_number" id="min_number" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($min_number)?>" />&nbsp;&nbsp;
							<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=396");
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
		?>:</b> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=396");
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
		<input type="text" name="max_number" id="max_number" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($max_number)?>" />
						  
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:270px;margin-top:-18px;border:0px solid red;" id="textmax_number"></div>
							
							<span class="validation-status"></span>
		
		</td>
						<?php } else { ?>
						<td><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=395");
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
		?>:</b> <?php echo $min_number?> -
		<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=396");
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
		?>:</b>
		<?php echo $max_number?>
		</td>
						<?php } ?>                                                                                                    
					</tr>			
					
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="cancellation_day1">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=405");
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
		$sqlfield = mysql_query("select * from t_field_names where id=405");
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
							<input type="text" name="cancellation_day1" id="cancellation_day1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_day1)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_day1"></div>
		</td>
						<?php } else { ?>
						<td><div style="float:left;margin-top:4px;"><?php echo $cancellation_day1?></div>
						<?php if ($cancellation_fee1 > 0){?>
						<table style="padding:0px;margin:0px;float:left;margin-left:10px;">
							<tr>
						<td><label for="cancellation_fee1"><b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=407");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=407");
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
							<input type="text" name="cancellation_fee1" id="cancellation_fee1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_fee1) . " " . $currencyvalue;?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_fee1"></div>
		</td>
						<?php } else { ?>
						<td>: <?php echo $cancellation_fee1 . " " . $currencyvalue;?></td>
						<?php } ?>                                                                                                    
					</tr>
						</table>
						<?php } ?>
						</td>
						<?php } ?>                                                                                                    
					</tr>
		<?php if ($cancellation_day2 > 0 or $cancellation_day2 != ""){?>			
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="cancellation_day2">
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=406");
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
		$sqlfield = mysql_query("select * from t_field_names where id=406");
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
							<input type="text" name="cancellation_day2" id="cancellation_day2" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_day2)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_day2"></div>
		</td>
						<?php } else { ?>
						<td><div style="float:left;margin-top:4px;"><?php echo $cancellation_day2?></div>
						<?php if ($cancellation_fee2 > 0){?>
						<table style="padding:0px;margin:0px;float:left;margin-left:10px;">
							<tr>
						<td><label for="cancellation_fee2"><b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=408");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=408");
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
							<input type="text" name="cancellation_fee1" id="cancellation_fee1" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($cancellation_fee1) . " " . $currencyvalue;?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textcancellation_fee1"></div>
		</td>
						<?php } else { ?>
						<td>: <?php echo $cancellation_fee2 . " " . $currencyvalue;?></td>
						<?php } ?>                                                                                                    
					</tr>
						</table>
						<?php } ?>
						</td>
						<?php } ?>                                                                                                    
					</tr>			
					
					
		<?php } ?>

		
					
		
		<?php } ?>
					
		
		
	
		<tr>
                    <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"></td>
                    
                    <td>
                    <?php 
					
					$sqlfield = mysql_query("select * from t_field_names where id=12");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$startdatelabel = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$startdatelabel =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$startdatelabel =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$startdatelabel =$rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=13");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$enddatelabel = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$enddatelabel = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$enddatelabel = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$enddatelabel = $rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=433");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$downloadevent = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$downloadevent = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$downloadevent = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$downloadevent = $rowfield['fieldname_it'];
	}
	
	
	$sqlfield = mysql_query("select * from t_field_names where id=434");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$emailevent = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$emailevent = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$emailevent = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$emailevent = $rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=436");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$makereservation = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$makereservation =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$makereservation =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$makereservation =$rowfield['fieldname_it'];
	}
					
	//$sql = mysql_query("select * from t_dates where events_id='".$_GET['events_id']."'");
	
	$datestr  = date('Y-m-d');			
	//$sql = mysql_query("select * from t_dates where events_id='".$_GET['events_id']."'");
	$sql = mysql_query("select * from t_dates where events_id='".$_GET['events_id']."' and events_start_date >='$datestr'");
	
	
	$ctr111 = 0;
	$num_rows = mysql_num_rows($sql);
	$number = mysql_num_rows($sql);
	
	$num_rows++;
	echo "<span class='validation-status'></span>&nbsp;&nbsp;";
	echo "<div style='float:left;margin-left:14px;width:65px;border:0px solid red;'><b>".$startdatelabel."</b></div>";
	if ($number > 1){
	//echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'><b>".$enddatelabel."</b></div><div style='float:left;width:40px;'><a href='components/download-ical.php?id=".$_GET['events_id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a onclick=emailevent(1,$_GET[events_id],'')><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><br style=clear:both;>";
	echo "<div style='float:left;margin-left:4px;width:85px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
	}else{
	echo "<div style='float:left;margin-left:4px;width:85px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
	}
	while ($size_row = mysql_fetch_array($sql)){
	$ctr111++;
	
	
	echo '<div style="padding:0px;">';
	
	$eventsid = $size_row['id'];
	$size_id = $size_row['size_id'];
	
	$sqlfield = mysql_query("select * from t_field_names where id=273");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$delete = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$delete =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$delete =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$delete =$rowfield['fieldname_it'];
	}
	
	
	
	
	echo "<div style='float:left;margin-left:14px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_start_date']))."</div>";
	
$browser = get_user_browser();

	//http://localhost/json/display-event.php?events_id=3275&titlecolor=000000&bgcolor=FFFFFF&titlebgcolor=CCCCCC&tablegrid=CCCCCC
		if($browser != "ie"){
			$facebox = "rel='facebox'";
		}else{
			$facebox = "";
		}
	
	  if ($_SESSION[WEBSITE_ALIAS]['admin_id'] ==""){
		if ($size_row['events_start_date'] != $size_row['events_end_date']){
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div></div><div style='float:left;width:40px;'><a alt='".$downloadevent."' title='".$downloadevent."' href='components/download-ical.php?id=".$_GET['events_id']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a style=cursor:pointer; alt='".$emailevent."' title='".$emailevent."' onclick=emailevent(1,$_GET[events_id],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div>";
			if ($rowevent['active_for_reservation'] == 1){	
			echo "<div style=float:left;><a href='events-login.php?events_id=".$_GET['events_id']."&titlecolor=".$_GET['titlecolor']."&bgcolor=".$_GET['bgcolor']."&titlebgcolor=".$_GET['titlebgcolor']."&tablegrid=".$_GET['tablegrid']."' ".$facebox." alt='".$eventlogin."' title='".$eventlogin."'><img src='images/login-icon.jpg' width='16px' height='16px' style='border:1px solid #eeeeee;'></a></div>
			<div style=float:left;><a href='events-registration.php??events_id=".$_GET['events_id']."&titlecolor=".$_GET['titlecolor']."&bgcolor=".$_GET['bgcolor']."&titlebgcolor=".$_GET['titlebgcolor']."&tablegrid=".$_GET['tablegrid']."' alt='".$eventregistration."' title='".$eventregistration."'><img src='images/registration-icon.png' width='16px' height='16px' style='border:1px solid #eeeeee;margin-left:3px;'></a></div>";
			}
			echo "<div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}else{
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>&nbsp;</div></div><div style='float:left;width:40px;'><a style=cursor:pointer; alt='".$downloadevent."' title='".$downloadevent."' href='components/download-ical.php?id=".$_GET['events_id']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a style=cursor:pointer; alt='".$emailevent."' title='".$emailevent."' onclick=emailevent(1,$_GET[events_id],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div>";
			if ($rowevent['active_for_reservation'] == 1){	
			echo "<div style=float:left;><a href='events-login.php?events_id=".$_GET['events_id']."&titlecolor=".$_GET['titlecolor']."&bgcolor=".$_GET['bgcolor']."&titlebgcolor=".$_GET['titlebgcolor']."&tablegrid=".$_GET['tablegrid']."' alt='".$eventlogin."' title='".$eventlogin."' ".$facebox."><img src='images/login-icon.jpg' width='16px' height='16px' style='border:1px solid #eeeeee;'></a></div>
			<div style=float:left;><a href='events-registration.php?events_id=".$_GET['events_id']."&titlecolor=".$_GET['titlecolor']."&bgcolor=".$_GET['bgcolor']."&titlebgcolor=".$_GET['titlebgcolor']."&tablegrid=".$_GET['tablegrid']."'  alt='".$eventregistration."' title='".$eventregistration."'><img src='images/registration-icon.png' width='16px' height='16px' style='border:1px solid #eeeeee;margin-left:3px;'></a></div>";
			}
			echo "<div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}	
	  }else{
		if ($size_row['events_start_date'] != $size_row['events_end_date']){
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div></div><div style='float:left;width:60px;'><a alt='".$downloadevent."' title='".$downloadevent."' href='components/download-ical.php?id=".$_GET['events_id']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a alt='".$emailevent."' title='".$emailevent."' style=cursor:pointer; onclick=emailevent(1,$_GET[events_id],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a>";
		if ($rowevent['active_for_reservation'] == 1){	
			//$checkreservation = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and (reservation_status=1 or reservation_status=0)");
			$checkreservation = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and (reservation_status=1 or reservation_status=0)");
			if (mysql_num_rows($checkreservation) > 0){
				$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
				echo "<div id=reservation_div_".$size_row['id'].">";
				
				$count = 0;
				$up = 0;
				$checkupordown = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and (reservation_status=1)");
				$num_rows_check = mysql_num_rows($checkupordown);
				$result= mysql_fetch_array($checkupordown);
					$count++;
					
				//if (($num_rows_check <= $rowevent['max_number']) and ($result['date_id'] == $size_row['id']) and ($result['provider_id'] == $provider_id))
					if ($num_rows_check < $rowevent['max_number'])
					{
						$up++;
					}
				//}
					//echo $up;
					if ($up > 0){
						echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-up.png' width='16px' height='16px' border='0' /> ";
						if ($size_row['events_start_date'] >=  date('Y-m-d')){
						echo "<a style=cursor:pointer; onclick='datereserveagain($_GET[events_id],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a> ";
						}
					}else{
						echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
						if ($size_row['events_start_date'] >=  date('Y-m-d')){
						echo "<a style=cursor:pointer; onclick='datereserveagain($_GET[events_id],$size_row[id],$provider_id)'><img src='images/letter-r.jpg' width='16px' height='16px' border='0' alt='".$waitinghover."' title='".$waitinghover."'/></a> ";
						}
					}
					
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
					echo "<a style=cursor:pointer; onclick='datecancel($_GET[events_id],$size_row[id],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
				}
				echo "</div>";
			}else{
				$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
				echo "<div id=reservation_div_".$size_row['id'].">";
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
				echo "<a style=cursor:pointer; onclick='datereserve($_GET[events_id],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a>";
				}
				echo "</div>";
			}
		}
			echo "</div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}else{
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>&nbsp;</div></div><div style='float:left;width:60px;'><a alt='".$downloadevent."' title='".$downloadevent."' style=cursor:pointer; href='components/download-ical.php?id=".$_GET['events_id']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a alt='".$emailevent."' title='".$emailevent."' style=cursor:pointer; onclick=emailevent(1,$_GET[events_id],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a>";
		if ($rowevent['active_for_reservation'] == 1){$checkreservation = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and (reservation_status=1 or reservation_status=0)");
			if (mysql_num_rows($checkreservation) > 0){
				$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
				echo "<div id=reservation_div_".$size_row['id'].">";
				
				$count = 0;
				$up = 0;
				
				$checkupordown = mysql_query("select * from t_reservations where date_id='".$size_row['id']."' and (reservation_status=1)");
				$num_rows_check = mysql_num_rows($checkupordown);
				$result= mysql_fetch_array($checkupordown);
					$count++;
					
					//if (($num_rows_check <= $rowevent['max_number']) and ($result['date_id'] == $size_row['id']) and ($result['provider_id'] == $provider_id)){
					if ($num_rows_check < $rowevent['max_number']){
						$up++;
					}
				//}
					
					if ($up > 0){
						echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-up.png' width='16px' height='16px' border='0' /> ";
						if ($size_row['events_start_date'] >=  date('Y-m-d')){
						echo "<a style=cursor:pointer; onclick='datereserveagain($_GET[events_id],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a> ";
						}
					}else{
						echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
						if ($size_row['events_start_date'] >=  date('Y-m-d')){
						echo "<a style=cursor:pointer; onclick='datereserveagain($_GET[events_id],$size_row[id],$provider_id)'><img src='images/letter-r.jpg' width='16px' height='16px' border='0' alt='".$waitinghover."' title='".$waitinghover."'/></a> ";
						}
					}
					
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
					echo "<a style=cursor:pointer; onclick='datecancel($_GET[events_id],$size_row[id],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
				}
				echo "</div>";
			}else{
				$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
				echo "<div id=reservation_div_".$size_row['id'].">";
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
				echo "<a style=cursor:pointer; onclick='datereserve($_GET[events_id],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a>";
				}
				echo "</div>";
			}
		}
			echo "</div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}	
	  }
	}	
	?>					
	
					</td>
                    
                </tr>
		
		<?php
		 if ($date_remark !="") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="date_remark"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=16");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=16");
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
							<input type="text" name="date_remark" id="date_remark" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($date_remark)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textdate_remark"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($date_remark)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($time_start !="" or $time_end != "") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="time_start"> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
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
		?></label>
		
		<div style="display:none;float:left;width:220px;margin-left:350px;z-index:10000;position:absolute;margin-top:-10px;border:0px solid red;font-weight:normal;" id="texttime_start"></div>
		</td>
						<?php if ( $is_editable_field ) { ?>
						<td>
						<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>: </b>
							<input type="text" name="time_start" id="time_start" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($time_start)?>" />&nbsp;&nbsp;
							<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>:</b> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
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
		<input type="text" name="time_end" id="time_end" style="width:50px;" maxlength="150" value="<?php echo fixEncoding($time_end)?>" />
						  
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:270px;margin-top:-18px;border:0px solid red;" id="texttime_end"></div>
							
							<span class="validation-status"></span>
		
		</td>
						<?php } else { ?>
						<td><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=19");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>:</b> <?php echo fixEncoding($time_start);?>&nbsp;&nbsp;
		<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=20");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>:</b>
		<?php echo fixEncoding($time_end)?>
		</td>
						<?php } ?>                                                                                                    
					</tr>
		
		<?php
		} if ($remark_time !="") {
		?>
		
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="remark_time"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=21");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=21");
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
							<input type="text" name="remark_time" id="remark_time" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($remark_time)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textremark_time"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($remark_time);?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($leader !="") {
		?>
		
		<tr>
			 <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;" valign="top"><label for="leader"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=23");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=23");
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
				<?php
				
				if ($mode == "add"){
								$leader = $rowlastentry['leader'];
							}
				$rs = mysql_query("SELECT *,concat(lastname ,', ',firstname, '  ',company) as companyname FROM ".DB_TABLE_PREFIX."leader where id='$leader'");	
					
								$rowleader = mysql_fetch_array($rs);
								$leader = $rowleader['companyname'];
					
				?>
				<input type="text" id="leader" name="leader" style="width:190px;" maxlength="150" value="<?php echo trim(fixEncoding($leader))?>"/>
				<input type="hidden" id="leader1id" name="leader1id" value="<?php if ($mode == "add") { echo $rowlastentry['leader'];} else {echo $record->leader;}?>" />
				
				
				<div id="clone_leader" style="display:none;"/></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <a href="index2.php?option=leaders2-m&mode=add" id="modalpopup2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></a>.
				<span class="validation-status"></span> </td>
				<?php } else { ?>
				<td><?php 
								 if ($leader != ""){
		$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
		$row1 = mysql_fetch_array($sql1);
		echo fixEncoding($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
		}else{
		echo "";
	}
		?></td>
				<?php } ?>
			</tr>
		<?php
		} if ($leader2 !="") {
		?>	
		<tr>
			 <td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;" valign="top"><label for="leader2"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=326");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=326");
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
				<?php
				if ($mode == "add"){
					$leader2 = $rowlastentry['leader2'];
				}
				
				
				$rs = mysql_query("SELECT *,concat(lastname ,', ',firstname, '  ',company) as companyname FROM ".DB_TABLE_PREFIX."leader where id='$leader2'");	
					
								$rowleader = mysql_fetch_array($rs);
								$leader2 = $rowleader['companyname'];
					
				?>
				<input type="text" id="leader2" name="leader2" style="width:190px;" maxlength="150" value="<?php echo trim(fixEncoding($leader2))?>"/>
				<input type="hidden" id="leader2id" name="leader2id" value="<?php if ($mode == "add") { echo $rowlastentry['leader2'];} else {echo $record->leader2;}?>" />
				<div id="clone_leader2" style="display:none;"/></div>
		<br /><?php
		$sqlfield = mysql_query("select * from t_field_names where id=293");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <a href="index2.php?option=leaders4-m&mode=add" id="modalpopup3"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=294");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?></a>.
				<span class="validation-status"></span> </td>
				<?php } else { ?>
				<td><?php 
								 if ($leader2 != ""){
		$sql1 = mysql_query("select * from t_leader where id='".$leader2."'");
		$row1 = mysql_fetch_array($sql1);
		echo ($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
		}else{
		echo "";
	}
		?></td>
				<?php } ?>
			</tr>
		
		  <?php
		} if ($event_contact_name !="") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="eve_contact_name"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=24");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=24");
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
						<?php if ( $is_editable_field ) {
						if ($mode == "add"){
							$eve_contact_name = $rowlastentry['eve_contact_name'];
							$eve_contact_phone = $rowlastentry['eve_contact_phone'];
							$eve_contact_email = $rowlastentry['eve_contact_email'];
							$eve_contact_url = $rowlastentry['eve_contact_url'];
						}
						?>
						<td>
							<input type="text" name="eve_contact_name" id="eve_contact_name" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_name)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_name"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_name)?></td>
						<?php } ?>                                                                                                    
					</tr>
		  <?php
		} if ($event_contact_phone !="") {
		?>
		 
				<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="eve_contact_phone"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=25");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=25");
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
							<input type="text" name="eve_contact_phone" id="eve_contact_phone" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_phone)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:220px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_phone"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_phone)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($event_contact_email !="") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="eve_contact_email"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=37");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
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
							<input type="text" name="eve_contact_email" id="eve_contact_email" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_email)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_email"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_email)?></td>
						<?php } ?>                                                                                                    
					</tr>
		<?php
		} if ($event_contact_url !="") {
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=38");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
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
							<input type="text" name="eve_contact_url" onkeyup="nospaces(this)" id="eve_contact_url" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($eve_contact_url)?>" />
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="texteve_contact_url"></div>
		</td>
						<?php } else { ?>
						<td><?php echo fixEncoding($eve_contact_url)?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		<!--<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="quality">Quality </label></td>
						<?php if ( $is_editable_field ) { ?>
						<td>
							<input type="text" name="quality" id="quality" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($quality)?>" />
							<span class="validation-status"></span></td>
						<?php } else { ?>
						<td><?php echo $quality?></td>
						<?php } ?>                                                                                                    
					</tr>-->
		<?php
		} if ($eve_image_path !="") {
		?>
		<tr>
			<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="design_photo"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=33");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
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
			  <input name="eve_image_path" id="eve_image_path" type="file" size="22" />
			  <span class="validation-status"></span>
		  
		  
		<div style="display:none;float:right;width:210px;margin-right:5px;z-index:10000;position:absolute;margin-left:210px;margin-top:-18px;border:0px solid red;" id="eve_image_path"></div>
			  <?php if ($mode=='edit') echo "</p>" ?>
			</td>
			<?php } else { ?>
			<td><?php echo $design_photo_img?></td>
			<?php } ?>
		  </tr>
<?php
		}
		?>
		<tr>
						<td class="key" style="background-color:<?php if ($_GET['titlebgcolor'] == "") { echo "#EFEFEF"; } else { echo "#" . $_GET['titlebgcolor'];} ?>;"><label for="eve_contact_url"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=296");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=296");
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
							<input type="text" name="reminder" id="reminder" readonly="readonly" style="width:70px;background-color:pink;" maxlength="150"  />
							<?php
								$sqlpro = mysql_query("select * from t_provider where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
								$rowpro = mysql_fetch_array($sqlpro);
								//echo $rowpro['reminder'];
								echo date('d.m.Y',strtotime($rowpro['reminder']));
							?>
							
							<span class="validation-status"></span>
		
		<div style="display:none;float:right;width:400px;z-index:10000;position:absolute;margin-left:200px;margin-top:-18px;border:0px solid red;" id="textreminder"></div>
		</td>
						<?php } else { ?>
						<td><?php
								$sqlpro = mysql_query("select * from t_provider where id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
								$rowpro = mysql_fetch_array($sqlpro);
								echo date('d.m.Y',strtotime($rowpro['reminder']));
							?></td>
						<?php } ?>                                                                                                    
					</tr>
		
		
	
				</table>  

<?php
		$sqlfield = mysql_query("select * from t_field_names where id=446");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		echo fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		echo fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		echo fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		echo fixEncoding($rowfield['fieldname_it']);
		}
		?>				
		  
	</div>

<script charset="utf-8">
	<?php
		$sqlfield = mysql_query("select * from t_field_names where id=378");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$emailsent = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$emailsent = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$emailsent = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$emailsent = $rowfield['fieldname_it'];
		}
	?>
	function emailevent(email,eventid,dateid) {
		//alert(dateid);
		<?php
			if ($_SESSION[WEBSITE_ALIAS]['admin_id']){
		?>
		if (dateid != ""){
				$('#mailprocessing'+dateid).html('<img src=images/indicator-big-white.gif style=float:left;width:16px;height:16px;>');
			}else{
				$('.mailprocessing').html('<img src=images/indicator-big-white.gif style=float:left;width:16px;height:16px;>');
			}
		$.ajax({
		  url: "components/download-ical.php?id="+eventid+"&date_id="+dateid+"&email=1&email_address=<?php echo $_SESSION[WEBSITE_ALIAS]['email'];?>",
		  cache: false,
		  success: function(html){
			if (dateid != ""){
				$('#mailprocessing'+dateid).html('');
			  }else{
				$('.mailprocessing').html('');
			  }
			alert("<?php echo $emailsent;?>");
		  }
		})
		<?php
			}else{
			
			
		$sqlfield = mysql_query("select * from t_field_names where id=51");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$emaillabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$emaillabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$emaillabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$emaillabel = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=292");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$erroremail = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$erroremail = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$erroremail = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$erroremail = $rowfield['fieldname_it'];
		}
	
		$emailsuggest = mysql_query("select * from t_email_suggestion where ip_address='".$_SERVER['REMOTE_ADDR']."'");
		$rowemailsuggest = mysql_fetch_array($emailsuggest);
	
		?>
		$.ajax({
			  url: "components/emailautosuggest.php?ip_address=<?php echo $_SERVER['REMOTE_ADDR'];?>",
			  cache: false,
			  success: function(result){
			   var emailauto = result;
				var emailaddress = prompt("<?php echo $emaillabel;?> : ", result);
				if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(emailaddress)){
			if (dateid != ""){
				$('#mailprocessing'+dateid).html('<img src=images/indicator-big-white.gif style=float:left;width:16px;height:16px;>');
			}else{
				$('.mailprocessing').html('<img src=images/indicator-big-white.gif style=float:left;width:16px;height:16px;>');
			}
			$.ajax({
			  url: "components/download-ical.php?id="+eventid+"&date_id="+dateid+"&email=1&email_address="+emailaddress,
			  cache: false,
			  success: function(html){
				$('#mailprocessing'+dateid).html('');
				$('.mailprocessing').html('');
				alert("<?php echo $emailsent;?>");
			  }
			})
		}else{
			
			alert("<?php echo $erroremail;?>");
			var emailaddress = prompt("<?php echo $emaillabel;?> : ", emailauto);
			
			
		}
			  }
			})
		
		
		
		
		<?php
			}
		?>
	}
	
	
	
	function datereserve(eventid,dateid,provider_id) {
		
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=403");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$notelabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$notelabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$notelabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$notelabel = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=398");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$bookmessage = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$bookmessage = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$bookmessage = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$bookmessage = $rowfield['fieldname_it'];
		}
		
	
		$emailsuggest = mysql_query("select * from t_email_suggestion where ip_address='".$_SERVER['REMOTE_ADDR']."'");
		$rowemailsuggest = mysql_fetch_array($emailsuggest);
	
		?>
		
			var note = prompt("<?php echo $notelabel;?> : ", "");
				
			$.ajax({
			  url: "components/process-reservation.php?date_id="+dateid+"&provider_id="+provider_id+"&note="+note,
			  cache: false,
			  success: function(html){
				$('#mailprocessing'+dateid).html('');
				$('.mailprocessing').html('');
				$('#reservation_div_'+dateid).html(html);
				alert("<?php echo $bookmessage;?>");
			  }
			})
		
		
	}
	
	
	function datereserveagain(eventid,dateid,provider_id) {
		
		<?php
		
		$sqlfield = mysql_query("select * from t_field_names where id=419");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$question = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$question = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$question = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$question = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=403");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$notelabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$notelabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$notelabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$notelabel = $rowfield['fieldname_it'];
		}
		
		$sqlfield = mysql_query("select * from t_field_names where id=398");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$bookmessage = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$bookmessage = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$bookmessage = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$bookmessage = $rowfield['fieldname_it'];
		}
		
	
		$emailsuggest = mysql_query("select * from t_email_suggestion where ip_address='".$_SERVER['REMOTE_ADDR']."'");
		$rowemailsuggest = mysql_fetch_array($emailsuggest);
	
		?>
		$.ajax({
		  url: "components/check-waiting.php?date_id="+dateid,
		  cache: false,
		  success: function(html1){
				if (html1 == 1){
					var g=confirm("Die Plätze sind schon alle vergeben, Sie werden auf die Warteliste gebucht.");
						if (g==true){
							var r=confirm("<?php echo $question;?>");
							if (r==true)
							{
								var note = prompt("<?php echo $notelabel;?> : ", "");
								$.ajax({
								  url: "components/process-reservation.php?date_id="+dateid+"&provider_id="+provider_id+"&note="+note,
								  cache: false,
								  success: function(html){
									$('#mailprocessing'+dateid).html('');
									$('.mailprocessing').html('');
									$('#reservation_div_'+dateid).html(html);
									alert("Sie stehen jetzt auf der Warteliste. Sie erhalten die Bestätigung per Email. Sobald ein Platz frei wird, werden Sie informiert.");
								  }
								})
							}	
						}
				}else{
					var r=confirm("<?php echo $question;?>");
					if (r==true)
					{
						var note = prompt("<?php echo $notelabel;?> : ", "");
						$.ajax({
						  url: "components/process-reservation.php?date_id="+dateid+"&provider_id="+provider_id+"&note="+note,
						  cache: false,
						  success: function(html){
							$('#mailprocessing'+dateid).html('');
							$('.mailprocessing').html('');
							$('#reservation_div_'+dateid).html(html);
							alert("<?php echo $bookmessage;?>");
						  }
						})
					}
				}
					
			}
		})
	}
	
	function datecancel(eventid,dateid,provider_id) {
		
		<?php
		
		$sqlfield = mysql_query("select * from t_field_names where id=400");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$cancelmessage = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$cancelmessage = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$cancelmessage = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$cancelmessage = $rowfield['fieldname_it'];
		}
	
	
		?>
			$.ajax({
			  url: "components/process-reservation.php?cancel=1&date_id="+dateid+"&provider_id="+provider_id,
			  cache: false,
			  success: function(html){
				$('#mailprocessing'+dateid).html('');
				$('.mailprocessing').html('');
				$('#reservation_div_'+dateid).html(html);
				
				alert("<?php echo $cancelmessage;?>");
			  }
			})
		
		
	}
	
	
</script>
</body>
</html>