<?php
ob_start();
header("Expires: Thu, 17 May 2001 10:17:17 GMT");    			// Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  			// HTTP/1.1
header ("Pragma: no-cache");                          			// HTTP/1.0
//header("Content-Type: application/json; charset=UTF-8");
//error_reporting('E_ALL');
session_start();
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
$mode = "view";
if ($_SESSION['provider'] == ""){
 $_SESSION['provider'] = 1;
	$_SESSION[WEBSITE_ALIAS]['user_level']    	= 1;
	$_SESSION[WEBSITE_ALIAS]['language']    	= 1;
}

// Retrieve record
//if(!empty($id) || $id != '') :
$datetocheck= $_REQUEST['datetocheck'];
$sqlevent = mysql_query("select * from t_event where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') ");
?>

<style>


div.toggle a{padding:0px;text-decoration:none;font-weight:bold;clear:both;}

</style>
<script type="text/javascript">
	$(document).ready(function() {
        function toggleDiv(divid){

            var div = document.getElementById(divid);
			$('.panel').hide();
            div.style.display = div.style.display == 'block' ? 'none' : 'block';

            }
	}
    </script>
	<!--<script>
	$(document).ready(function() {
	$(".togx").click(function () {
		
		
	})
	})
</script>-->

<h1><?php echo date('F d, Y',strtotime($datetocheck));?></h1>
<?php
while ($rowevent = mysql_fetch_array($sqlevent)){

	$title = $rowevent['title'];
	$kind = $rowevent['kind'];
	$type = $rowevent['type'];
	$short_desc = $rowevent['short_desc'];
	$long_desc = $rowevent['long_desc'];
	$location = $rowevent['location'];
	$price = $rowevent['price'];
	$currency = $rowevent['currency'];
	$remark_price = $rowevent['remark_price'];
	$remark_prerequisite = $rowevent['remark_prerequisite'];
	$eve_contact_name = $rowevent['eve_contact_name'];
	$eve_contact_phone = $rowevent['eve_contact_phone'];
	$eve_contact_email = $rowevent['eve_contact_email'];
	$eve_contact_url = $rowevent['eve_contact_url'];
	$eve_loc = $rowevent['eve_loc'];
	$eve_image_path = $rowevent['eve_image_path'];
	$provider = $rowevent['provider'];
	$timestamp = $rowevent['timestamp'];
	$last_change = $rowevent['last_change'];
	
	$date_start = $rowevent['date_start'];
	$date_end = $rowevent['date_end'];
	
	$date_start = date('d.m.Y',strtotime($rowevent['date_start']));
	$date_end = date('d.m.Y',strtotime($rowevent['date_end']));
	
	$date_remark = $rowevent['date_remark'];
	$time_start = $rowevent['time_start'];
	$time_end = $rowevent['time_end'];
	$remark_time = $rowevent['remark_time'];
	$leader = $rowevent['leader'];
	
	$quality = $rowevent['quality'];

	$sql_sys = mysql_query("select * from t_sys");
	$row_sys = mysql_fetch_array($sql_sys);
	
	$grid_max_x = $row_sys['pics_in_grid_max_x'];
	$grid_max_y = $row_sys['pics_in_grid_max_y'];
	$detail_max_x = $row_sys['pics_in_detail_max_x'];
	$detail_max_y = $row_sys['pics_in_detail_max_y'];
	
	if ($eve_image_path != ""){
        	$path = "../uploads/".$eve_image_path;
			list($widthimage, $heightimage, $types, $attr) = getimagesize($path);
			
			
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
		$ctr++;
?>

<div class="toggle">- <a style="font-weight:bold;font-size;13px;" class="togx" href="javascript:toggleDiv('panel<?php echo $ctr;?>');" ><?php echo utf8_encode($title);?></a></div>



<div style="width:530px;display:none;margin-top:5px;" id="panel<?php echo $ctr;?>" class="panel">
	
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <fieldset class="standard-form">
            <legend>Details</legend>
            <table class="form-table">   
				
				<?php if ($kind != ""){?>
				<tr>
					 <td class="key"><label for="kind">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=3");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
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
					
					
					echo $scaffold->dropdown_rs($rs,$value_display,"kind",$kind,"","");
					?>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($kind != ""){
					$sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
					$row1 = mysql_fetch_array($sql1);
					//echo $row1['kind_eng'];
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						echo utf8_encode($row1['kind_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo utf8_encode($row1['kind_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo utf8_encode($row1['kind_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo utf8_encode($row1['kind_it']);
					}
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				<?php
				}
				if ($type != ""){
				?>
				<tr>
					 <td class="key"><label for="type">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=4");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
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
					
					
					echo $scaffold->dropdown_rs($rs,$value_display,"type",$type,"","");
					?>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($type != ""){
								 
					$sql1 = mysql_query("select * from t_event_type where id='".$type."'");
					$row1 = mysql_fetch_array($sql1);
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						echo utf8_encode($row1['eventtype_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo utf8_encode($row1['eventtype_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo utf8_encode($row1['eventtype_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo utf8_encode($row1['eventtype_it']);
					}
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				<?php
				}
				if ($quality != ""){
				?>
				<tr>
					 <td class="key"><label for="type"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=75");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
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
					
					
					echo $scaffold->dropdown_rs($rs,$value_display,"quality",$quality,"","style=width:100px;float:left;margin-top:6px;");
					?><div id="image-icon" style="float:left;margin-left:5px;">
						<?php
							
								echo '<img src=images/'.$quality.'.png width=30px height=30px>';
							
						?>
					</div>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td>
					<div style="float:left;margin-top:6px;">
					<?php 
								 if ($quality != ""){
					$sql1 = mysql_query("select * from t_quality where id='".$quality."'");
					$row1 = mysql_fetch_array($sql1);
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						echo utf8_encode($row1['quality_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo utf8_encode($row1['quality_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo utf8_encode($row1['quality_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo utf8_encode($row1['quality_it']);
					}
					
							
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px></div>';
							
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
			<?php
				}
				if ($short_desc != ""){
				?>	
				<tr>
                    <td class="key"><label for="short_desc">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=5");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="short_desc" id="short_desc" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($short_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($short_desc);?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($long_desc != ""){
				?>
				<tr>
                    <td class="key"><label for="long_desc">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=6");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="long_desc" id="long_desc" style="width:267px;height:auto;min-height:80px;"><?php echo htmlentities($long_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($long_desc);?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($location != ""){
				?>	
				<tr>
					 <td class="key"><label for="location">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=7");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					 <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					$value_display['display'] = "locname";
					
					if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1 or $_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
					{	
						$userlevelgain ="";
					}else{
						$userlevelgain =" where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
					}
					$rs = $db->get_results("SELECT id,concat(loc_name ,', ',loc_detail) as locname  FROM ".DB_TABLE_PREFIX."location order by loc_name asc");		
					
					echo $scaffold->dropdown_rs($rs,$value_display,"location",$location,"","");
					?> Not in the list? Click <a href="index2.php?option=locations2-m&mode=add" id="modalpopup1">here</a>.
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($location != ""){
					$sql1 = mysql_query("select * from t_location where id='".$location."'");
					$row1 = mysql_fetch_array($sql1);
					echo utf8_encode($row1['loc_name'] . " " .$row1['loc_detail']);
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				<?php
				}
				if ($price != ""){
				?>
				
				<tr>
                    <td class="key"><label for="price">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=8");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					<?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="price" id="price" size="50" maxlength="150" value="<?php echo htmlentities($price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $price?>
					<?php
					$sql1 = mysql_query("select * from t_currency where id='".$currency."'");
					$row1 = mysql_fetch_array($sql1);
					echo " " . $row1['currency'];
					?>
					</td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($remark_price != ""){
				?>
				
				<tr>
                    <td class="key"><label for="remark_price"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=10");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_price" id="remark_price" size="50" maxlength="150" value="<?php echo htmlentities($remark_price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($remark_price)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($remark_prerequisite != ""){
				?>
				<tr>
                    <td class="key"><label for="remark_prerequisite"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=11");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="remark_prerequisite" id="remark_prerequisite" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($remark_prerequisite)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($remark_prerequisite)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($date_start != ""){
				?>
				<tr>
                    <td class="key"><label for="date_start"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=12");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_start" id="date_start" readonly="readonly" size="50" maxlength="150" value="<?php echo htmlentities($date_start)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $date_start?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($date_end != ""){
				?>
				<tr>
                    <td class="key"><label for="date_end"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=13");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_end" id="date_end" readonly="readonly" size="50" maxlength="150" value="<?php echo htmlentities($date_end)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $date_end?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($date_remark != ""){
				?>
				<tr>
                    <td class="key"><label for="date_remark"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=16");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_remark" id="date_remark" size="50" maxlength="150" value="<?php echo htmlentities($date_remark)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($date_remark)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($time_start != ""){
				?>
				<tr>
                    <td class="key"><label for="time_start"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=19");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="time_start" id="time_start"  size="50" maxlength="150" value="<?php echo htmlentities($time_start)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $time_start?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($time_end != ""){
				?>
				<tr>
                    <td class="key"><label for="time_end"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=20");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="time_end" id="time_end" size="50" maxlength="150" value="<?php echo htmlentities($time_end)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $time_end?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($remark_time != ""){
				?>
				<tr>
                    <td class="key"><label for="remark_time"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=21");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_time" id="remark_time" size="50" maxlength="150" value="<?php echo htmlentities($remark_time)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($remark_time)?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($leader != ""){
				?>	
				
				<tr>
       			 <td class="key"><label for="leader"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=23");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "companyname";
				$rs = $db->get_results("SELECT *,concat(company ,' ',firstname, ' ',lastname) as companyname FROM ".DB_TABLE_PREFIX."leader   order by lastname asc");		
				echo $scaffold->dropdown_rs($rs,$value_display,"leader",$leader,"","");
				?>Not in the list? Click <a href="index2.php?option=leaders2-m&mode=add" id="modalpopup2">here</a>.
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             if ($leader != ""){
				$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
				$row1 = mysql_fetch_array($sql1);
				echo utf8_encode($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
			}else{
				echo "";
}
				?></td>
        		<?php } ?>
      		</tr>
			
		<?php
				}
				if ($eve_contact_name != ""){
				?>
			
				
	  
		<tr>
                    <td class="key"><label for="eve_contact_name"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=24");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_name" id="eve_contact_name" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_name)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($eve_contact_name)?></td>
                    <?php } ?>                                                                                                    
                </tr>
	  
			<?php
				}
				if ($eve_contact_phone != ""){
				?>
		        <tr>
                    <td class="key"><label for="eve_contact_phone"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=25");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_phone" id="eve_contact_phone" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_phone)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($eve_contact_phone)?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($eve_contact_email != ""){
				?>
				<tr>
                    <td class="key"><label for="eve_contact_email"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=26");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_email" id="eve_contact_email" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_email)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo "<a href=mailto:".utf8_encode($eve_contact_email).">" .utf8_encode($eve_contact_email). "</a>";?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($eve_contact_url != ""){
				?>	
				<tr>
                    <td class="key"><label for="eve_contact_url"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=27");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_url" id="eve_contact_url" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_url)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo "<a target=_blank href=".utf8_encode($eve_contact_url).">" .utf8_encode($eve_contact_url)?></a></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<?php
				}
				if ($eve_image_path != ""){
				?>
				<tr>
        <td class="key"><label for="design_photo"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=28");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
          
          </label></td>
        <?php if ( $is_editable_field ) { ?>
        <td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
          <input name="eve_image_path" id="eve_image_path" type="file" size="35" />
          <span class="validation-status"></span>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>
			<?php
				}
			?>
	  
				
                
				
            </table>        	
      </fieldset>   
<br />	  
</div>
<?php
}
?>        
      

</div>

