<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );


$sqlqry = "SELECT *,e.id as eid FROM t_event e 
								INNER JOIN t_dates d
								ON e.id=d.events_id
								INNER JOIN t_leader le
								ON e.leader=le.id
								where e.id='".$_REQUEST['events_id']."' group by e.id";
$sqlevent = mysql_query($sqlqry);
$rowevent = mysql_fetch_array($sqlevent);

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
	$leader2 = $rowevent['leader2'];
	
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
			
	
        	$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0" width=150>';
        }else{
        	$design_photo_img = '';
        }
		$ctr++;
		
		

?>

<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <fieldset class="standard-form" style="width:370px;">
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
			<div style="float:left;">
				<?php
		$sqlfield = mysql_query("select * from t_field_names where id=675");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$commentshover = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$commentshover = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$commentshover = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$commentshover = $rowfield['fieldname_it'];
		}
		$sqlfield = mysql_query("select * from t_field_names where id=690");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$hideformlabel = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$hideformlabel = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$hideformlabel = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$hideformlabel = $rowfield['fieldname_it'];
		}
		?>			
				
				<?php $sqlfield = mysql_query("select * from t_field_names where id=681");
							$rowfield = mysql_fetch_array($sqlfield);
							if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
								$successsendfeedback = $rowfield['fieldname_de'];
							}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
								$successsendfeedback = $rowfield['fieldname_eng'];
							}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
								$successsendfeedback = $rowfield['fieldname_fr'];
							}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
								$successsendfeedback = $rowfield['fieldname_it'];
							}
							?>
				<script type="text/javascript">
				$(document).ready(function() {
					$('#commenticon<?php echo $rowevent['id'];?>').click(function () {
						$('#commentsform<?php echo $rowevent['id'];?>').show();
						$('#commenticon<?php echo $rowevent['id'];?>').hide();
					});
					$('#hideicon<?php echo $rowevent['id'];?>').click(function () {
						$('#commentsform<?php echo $rowevent['id'];?>').hide();
						$('#commenticon<?php echo $rowevent['id'];?>').show();
					});
					$('#submitfeedback<?php echo $rowevent['id'];?>').click(function () {
						var events_feedback = $('#events_feedback<?php echo $rowevent['id'];?>').val();
						var leader_feedback = $('#leader_feedback<?php echo $rowevent['id'];?>').val();
						var location_feedback = $('#location_feedback<?php echo $rowevent['id'];?>').val();
						var spiritwings_feedback = $('#spiritwings_feedback<?php echo $rowevent['id'];?>').val();
						
						$('#events_feedback<?php echo $rowevent['id'];?>').val('');
						$('#leader_feedback<?php echo $rowevent['id'];?>').val('');
						$('#location_feedback<?php echo $rowevent['id'];?>').val('');
						$('#spiritwings_feedback<?php echo $rowevent['id'];?>').val('');
						
						var events_id = $('#events_id<?php echo $rowevent['id'];?>').val();
						var location_id = $('#location_id<?php echo $rowevent['id'];?>').val();
						var leader_id = $('#leader_id<?php echo $rowevent['id'];?>').val();
						var feedback_by = '<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>';
						
						$.ajax({
						  url: "components/process-feedback.php?events_id="+events_id+"&location_id="+location_id+"&leader_id="+leader_id+"&feedback_by="+feedback_by+"&events_feedback="+events_feedback+"&leader_feedback="+leader_feedback+"&location_feedback="+location_feedback+"&spiritwings_feedback="+spiritwings_feedback,
						  cache: false,
						  success: function(html){
						  $('#commentsform<?php echo $rowevent['id'];?>').hide();
							$('#commenticon<?php echo $rowevent['id'];?>').show();
							alert("<?php echo $successsendfeedback;?>");
							
						  }
						})
						
					});
				})
				</script>
				<div style="float:left;margin-left:0px;display:none;" id="commentsform<?php echo $rowevent['id'];?>">
					
					<fieldset>
					<legend><?php $sqlfield = mysql_query("select * from t_field_names where id=691");
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
					<table class="form-table" style="width:350px;">
						<tr>
							<td align="right" colspan="2"><div style="float:right;margin:0px;padding:0px;"><a href="#commenticon<?php echo $rowevent['id'];?>" id="hideicon<?php echo $rowevent['id'];?>"><b><?php echo $hideformlabel;?></b></a></div></td>
						</tr>
						<tr>
							<td align="left" colspan="2">
							<?php $sqlfield = mysql_query("select * from t_field_names where id=676");
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
							</td>
						</tr>
						<tr>
							<td class="key"><b><?php $sqlfield = mysql_query("select * from t_field_names where id=677");
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
							?></b></td>
							<td>
								<textarea id="events_feedback<?php echo $rowevent['id'];?>" style="width:189px;"></textarea>
							</td>
						</tr>
						<tr>
							<td class="key"><b><?php $sqlfield = mysql_query("select * from t_field_names where id=678");
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
							?></b></td>
							<td>
								<textarea id="location_feedback<?php echo $rowevent['id'];?>" style="width:189px;"></textarea>
							</td>
						</tr>
						<tr>
							<td class="key"><b><?php $sqlfield = mysql_query("select * from t_field_names where id=679");
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
							?></b></td>
							<td>
								<textarea id="leader_feedback<?php echo $rowevent['id'];?>" style="width:189px;"></textarea>
							</td>
						</tr>
						<tr>
							<td class="key"><b><?php $sqlfield = mysql_query("select * from t_field_names where id=680");
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
							?></b></td>
							<td>
								<textarea id="spiritwings_feedback<?php echo $rowevent['id'];?>" style="width:189px;"></textarea>
							</td>
						</tr>
						
						<tr>
							<td></td>
							<td>
							<input type="hidden" id="events_id<?php echo $rowevent['id'];?>" value="<?php echo $rowevent['eid'];?>"/>
							<input type="hidden" id="location_id<?php echo $rowevent['id'];?>" value="<?php echo $location;?>" />
							<input type="hidden" id="leader_id<?php echo $rowevent['id'];?>" value="<?php echo $leader;?>"/>
							<input type="hidden" id="feedback_by<?php echo $rowevent['id'];?>" value="<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>"/>
							<input type="button" class="button" id="submitfeedback<?php echo $rowevent['id'];?>"
								value="<?php $sqlfield = mysql_query("select * from t_field_names where id=682");
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
							</td>
						</tr>
					</table>
					</fieldset>
				</div>
				
			</div>
            <table class="form-table" style="width:370px;">   
				
				<?php if ($kind != ""){?>
				<tr>
					 <td class="key"><label for="kind">
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
					<td><div style="float:left;"><?php 
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
					?></div>
					<div style="float:right;">
				<img src="images/comments.png" width="25px" style="cursor:pointer;" id="commenticon<?php echo $rowevent['id'];?>" alt="<?php echo $commentshover;?>" title="<?php echo $commentshover;?>"/>
				</div>
					<?php
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
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
				<?php
				}
				if ($quality != ""){
				?>
				<tr>
					 <td class="key"><label for="type"><?php
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
		
							
		
if ($quality ==1){
			echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality1.'"  title="'.$quality1.'">';
		}elseif ($quality ==2){
			echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality2.'"  title="'.$quality2.'">';
		}elseif ($quality ==3){
			echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality3.'"  title="'.$quality3.'">';
		}elseif ($quality ==4){
			echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality4.'"  title="'.$quality4.'">';
		}elseif ($quality ==5){
			echo '<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality5.'"  title="'.$quality5.'">';
		}
								//echo '<img src=images/'.$quality.'.png width=30px height=30px>';
							
						
							
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
						echo fixEncoding($row1['quality_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo fixEncoding($row1['quality_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo fixEncoding($row1['quality_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo fixEncoding($row1['quality_it']);
					}
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
							
								if ($quality == 1){
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality1.'"  title="'.$quality1.'"></div>';
							}elseif ($quality == 2){
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality2.'"  title="'.$quality2.'"></div>';
							}elseif ($quality == 3){
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality3.'"  title="'.$quality3.'"></div>';
							}elseif ($quality == 4){
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality4.'"  title="'.$quality4.'"></div>';
							}elseif ($quality == 5){
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px alt="'.$quality5.'"  title="'.$quality5.'"></div>';
							}
							
					
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?>
					</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="short_desc" id="short_desc" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($short_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($short_desc);?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?>
					</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="long_desc" id="long_desc" style="width:267px;height:auto;min-height:80px;"><?php echo htmlentities($long_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($long_desc);?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
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
					?> Not in the list? Click <a href="index2.php?option=locations3-m&mode=add" class="modalpopup1" rel="facebox">
					<a href='index2.php?option=leaders2-m&mode=view&view=view&id=<?php echo $leader;?>' class="modalpopup2">
					here</a>.
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($location != ""){
					$sql1 = mysql_query("select * from t_location where id='".$location."'");
					$row1 = mysql_fetch_array($sql1);
					?>
					<a href="components/locations-maint3.php?mode=view&view=view&id=<?php echo $location;?>" class="modalpopup1" rel="facebox">
					
				<?php
				//echo fixEncoding($row1['loc_name'] . " " .$row1['loc_detail']);
				echo fixEncoding($row1['loc_name'] . " " .$row1['loc_detail'] ." " .$row1['loc_adress1'] . ' ' . $row1['loc_adress2'] ." ". $row1['loc_zip'] . " " .$row1['loc_loc']);
				echo '</a>';
					
					//echo fixEncoding($row1['loc_name'] . " " .$row1['loc_detail']);
					
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_price" id="remark_price" size="50" maxlength="150" value="<?php echo htmlentities($remark_price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($remark_price)?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="remark_prerequisite" id="remark_prerequisite" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($remark_prerequisite)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($remark_prerequisite)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				
				?>
				<tr>
                    <td class="key"></td>
                    
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
					
	//$sql = mysql_query("select * from t_dates where events_id='".$rowevent['eid']."'");
	$datestr  = date('Y-m-d');			
	$sql = mysql_query("select * from t_dates where events_id='".$rowevent['eid']."' and events_start_date >='$datestr'");
	
	
	$ctr111 = 0;
	$num_rows = mysql_num_rows($sql);
	$number = mysql_num_rows($sql);
	
	$num_rows++;
	echo "<span class='validation-status'></span>&nbsp;&nbsp;";
	echo "<div style='float:left;margin-left:14px;width:65px;border:0px solid red;'><b>".$startdatelabel."</b></div>";
	if ($number > 1){
	//echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'><b>".$enddatelabel."</b></div><div style='float:left;width:40px;'><a href='components/download-ical.php?id=".$rowevent['eid']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a onclick=emailevent(1,$rowevent[eid],'')><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><br style=clear:both;>";
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
	
	
	
 if (date('Y-m-d') >= $size_row['events_start_date'] and date('Y-m-d') <= $size_row['events_end_date']){
 echo 'xxxx';
	echo "<div style='float:left;margin-left:14px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_start_date']))."</div>";
	  if ($_SESSION[WEBSITE_ALIAS]['admin_id'] ==""){
		if ($size_row['events_start_date'] != $size_row['events_end_date']){
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div></div><div style='float:left;width:40px;'><a alt='".$downloadevent."' title='".$downloadevent."' href='components/download-ical.php?id=".$rowevent['eid']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a style=cursor:pointer; alt='".$emailevent."' title='".$emailevent."' onclick=emailevent(1,$rowevent[eid],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}else{
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>&nbsp;</div></div><div style='float:left;width:40px;'><a style=cursor:pointer; alt='".$downloadevent."' title='".$downloadevent."' href='components/download-ical.php?id=".$rowevent['eid']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a style=cursor:pointer; alt='".$emailevent."' title='".$emailevent."' onclick=emailevent(1,$rowevent[eid],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}	
	  }else{
		if ($size_row['events_start_date'] != $size_row['events_end_date']){
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div></div><div style='float:left;width:60px;'><a alt='".$downloadevent."' title='".$downloadevent."' href='components/download-ical.php?id=".$rowevent['eid']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a alt='".$emailevent."' title='".$emailevent."' style=cursor:pointer; onclick=emailevent(1,$rowevent[eid],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a>";
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
						echo "<a style=cursor:pointer; onclick='datereserveagain($rowevent[eid],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a> ";
						}
					}else{
						echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
						if ($size_row['events_start_date'] >=  date('Y-m-d')){
						echo "<a style=cursor:pointer; onclick='datereserveagain($rowevent[eid],$size_row[id],$provider_id)'><img src='images/letter-r.jpg' width='16px' height='16px' border='0' alt='".$waitinghover."' title='".$waitinghover."'/></a> ";
						}
					}
					
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
					echo "<a style=cursor:pointer; onclick='datecancel($rowevent[eid],$size_row[id],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
				}
				echo "</div>";
			}else{
				$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
				echo "<div id=reservation_div_".$size_row['id'].">";
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
				echo "<a style=cursor:pointer; onclick='datereserve($rowevent[eid],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a>";
				}
				echo "</div>";
			}
		}
			echo "</div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}else{
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>&nbsp;</div></div><div style='float:left;width:60px;'><a alt='".$downloadevent."' title='".$downloadevent."' style=cursor:pointer; href='components/download-ical.php?id=".$rowevent['eid']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a alt='".$emailevent."' title='".$emailevent."' style=cursor:pointer; onclick=emailevent(1,$rowevent[eid],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a>";
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
						echo "<a style=cursor:pointer; onclick='datereserveagain($rowevent[eid],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a> ";
						}
					}else{
						echo "<img alt='".$reservationbutton."' title='".$reservationbutton."' src='images/hands-down.png' width='16px' height='16px' border='0' /> ";
						if ($size_row['events_start_date'] >=  date('Y-m-d')){
						echo "<a style=cursor:pointer; onclick='datereserveagain($rowevent[eid],$size_row[id],$provider_id)'><img src='images/letter-r.jpg' width='16px' height='16px' border='0' alt='".$waitinghover."' title='".$waitinghover."'/></a> ";
						}
					}
					
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
					echo "<a style=cursor:pointer; onclick='datecancel($rowevent[eid],$size_row[id],$provider_id)'><img src='images/cancel.png' width='16px' height='16px' border='0' /></a>";
				}
				echo "</div>";
			}else{
				$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
				echo "<div id=reservation_div_".$size_row['id'].">";
				if ($size_row['events_start_date'] >=  date('Y-m-d')){
				echo "<a style=cursor:pointer; onclick='datereserve($rowevent[eid],$size_row[id],$provider_id)'><img src='images/reservation.png' width='16px' height='16px' border='0' alt='".$makereservation."' title='".$makereservation."'/></a>";
				}
				echo "</div>";
			}
		}
			echo "</div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}	
	  }
	  }
	}	
	?>					
	
					</td>
                    
                </tr>
				<?php
				if ($date_remark != ""){
				?>
				<tr>
                    <td class="key"><label for="date_remark"><?php
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
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_remark" id="date_remark" size="50" maxlength="150" value="<?php echo htmlentities($date_remark)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($date_remark)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($time_start != "00:00:00"){
				?>
				<tr>
                    <td class="key"><label for="time_start"><?php
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
					?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="time_start" id="time_start"  size="50" maxlength="150" value="<?php echo htmlentities($time_start)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php 
					echo $time_start?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($time_end != "00:00:00"){
				?>
				<tr>
                    <td class="key"><label for="time_end"><?php
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_time" id="remark_time" size="50" maxlength="150" value="<?php echo htmlentities($remark_time)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($remark_time)?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "companyname";
				$rs = $db->get_results("SELECT *,concat(company ,' ',firstname, ' ',lastname) as companyname FROM ".DB_TABLE_PREFIX."leader   order by lastname asc");		
				echo $scaffold->dropdown_rs($rs,$value_display,"leader",$leader,"","");
				?>Not in the list? Click <a href="index2.php?option=leaders3-m&mode=add" class="modalpopup2" rel="facebox">here</a>.
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             if ($leader != ""){
				$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
				$row1 = mysql_fetch_array($sql1);
				?>
				<a href="components/leaders-maint3.php?mode=view&view=view&id=<?php echo $leader;?>" class="modalpopup2" rel="facebox">
				<?php
				echo fixEncoding($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
				echo '</a>';
				
				if ($leader2 != ""){
				?>
				<br /><br />
				<a href="components/leaders-maint3.php?mode=view&view=view&id=<?php echo $leader2;?>" class="modalpopup2" rel="facebox">
				<?php
					$sqlleaders2 = mysql_query("select * from t_leader where id='".$leader2."'");
					$rowleaders = mysql_fetch_array($sqlleaders2);
					echo  fixEncoding($rowleaders['company'] . " " . $rowleaders['firstname'] . " " .$rowleaders['lastname']);
					echo '</a>';
				}
		
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_name" id="eve_contact_name" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_name)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($eve_contact_name)?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_phone" id="eve_contact_phone" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_phone)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo fixEncoding($eve_contact_phone)?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_email" id="eve_contact_email" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_email)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo "<a href=mailto:".fixEncoding($eve_contact_email).">" .fixEncoding($eve_contact_email). "</a>";?></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_url" id="eve_contact_url" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_url)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo "<a target=_blank href=".fixEncoding($eve_contact_url).">" .fixEncoding($eve_contact_url)?></a></td>
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
							echo fixEncoding($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo fixEncoding($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo fixEncoding($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo fixEncoding($rowfield['fieldname_it']);
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
				
				$counterx++;
			?>
	  
				
                
				
            </table>        	
      </fieldset>   
<br />	  