<?php
error_reporting(0);
session_start();
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
$mode = "view";
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
		
		
				$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0" width='.$widthimage.'>';
			}else{
				$design_photo_img = '';
			}
		
		
		//$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0">';
	endif;
	
	$sqllastentry = mysql_query("select * from t_event where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'
					order by id desc");
	$rowlastentry = mysql_fetch_array($sqllastentry);
	?>
	

					
<style>
	.ac_results {
	padding: 0px;
	border: 1px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
	width: 475px !important;
	margin-top:-20px;
	margin-left:194px;
}

.ac_results ul {
	
	width: 475px !important;
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
	width: 447px !important;
}

.ac_results img {
	padding-right:5px;
}

.ac_loading {
	background: white url('../images/loader.gif') right center no-repeat;
}

.ac_odd {
	background-color: #eee;
}

.ac_over {
	background-color: #0A246A;
	color: white;
}

</style>
	
	<style>
	div.time-picker {
	  position: absolute;
	  height: 191px;
	  overflow: auto;
	  background: #fff;
	  border: 1px solid #aaa;
	  z-index: 99;
	  margin: 0;
	  width:5em;
	}
	div.time-picker-12hours {
	  width:5em; /* needed for IE */
	}

	div.time-picker ul {
	  list-style-type: none;
	  margin: 0;
	  padding: 0;
	}
	div.time-picker li {
	  cursor: pointer;
	  height: 10px;
	  font: 12px/1 Helvetica, Arial, sans-serif;
	  padding: 4px 3px;
	}
	div.time-picker li.selected {
	  background: #0063CE;
	  color: #fff;
	}
	</style>
	
	<h1><?php echo $page_heading?> <small>[ <?php echo $sub_heading?> ]</small></h1>

	
	<div class="content-main wide90">
		<?php if ( $is_editable_field ) { ?>
		<div class="standard-form-instruction"><strong></strong> <?php echo $req_fld?> <?php
		$sqlfield = mysql_query("select * from t_field_names where id=229");
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
		?></div>
		<?php } ?>
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">

			<fieldset class="standard-form">
				<legend><?php
		$sqlfield = mysql_query("select * from t_field_names where id=230");
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
		?></legend>
				<table class="form-table">            	
					<tr>
						<td class="key"><label for="title">
						<td><?php echo $title?></td>
						                                                                           
					</tr>
		
		
		
	
				</table>        	
		  </fieldset>    
			
		</form>
	</div>
</div>
