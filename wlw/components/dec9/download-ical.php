<?php
error_reporting(0);
session_start();
require ( '../includes/config.php' );
require ( '../'.PATH_LIBRARIES.'libraries.php' );
header("Content-Type: text/Calendar");
header("Content-Disposition: inline; filename=calendar.ics");
$sqlquery = mysql_query("SELECT *,c.currency as currencyal,loc.loc_name as locationval,e.id as eid,e.last_change as elast_change,e.timestamp as etimestamp FROM t_event 
		e inner join t_leader l on e.leader=l.id  
		inner join t_currency c on e.currency=c.id  
		inner join t_location loc on e.location=loc.id  
		inner join t_dates d on e.id=d.events_id
		inner join t_country country on country.id=loc.loc_country
		where e.id='".$_GET['id']."' and d.id='".$_GET['date_id']."' group by e.id");
$rowquery = mysql_fetch_array($sqlquery);
function fixEncoding123($str){
	return $str;
}
$title = $rowquery['title'];
 $kind = $rowquery['kind'];
 $type = $rowquery['type'];
 $short_desc = $rowquery['short_desc'];
 $long_desc = $rowquery['long_desc'];
 $location = $rowquery['location'];
 $price = $rowquery['price'];
 $currency = $rowquery['currency'];
 $remark_price = $rowquery['remark_price'];
 $remark_prerequisite = $rowquery['remark_prerequisite'];
 $eve_contact_name = $rowquery['eve_contact_name'];
 $eve_contact_phone = $rowquery['eve_contact_phone'];
 $eve_contact_email = $rowquery['eve_contact_email'];
 $eve_contact_url = $rowquery['eve_contact_url'];
 $eve_loc = $rowquery['eve_loc'];
 $eve_image_path = $rowquery['eve_image_path'];
 $provider = $rowquery['provider'];
 $timestamp = $rowquery['timestamp'];
 $last_change = $rowquery['last_change'];
 $date_start = $rowquery['date_start'];
 $date_end = $rowquery['date_end'];
 $date_start = date('d.m.Y',strtotime($rowquery['date_start']));
 $date_end = date('d.m.Y',strtotime($rowquery['date_end']));
 $date_remark = $rowquery['date_remark'];
 $time_start = $rowquery['time_start'];
 $time_end = $rowquery['time_end'];
 $remark_time = $rowquery['remark_time'];
 $leader = $rowquery['leader'];
 $leader2 = $rowquery['leader2'];
 $quality = $rowquery['quality'];
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
 $design_photo_img = '<img src="http://manimano.ch/wlw/uploads/'.$eve_image_path.'" border="0" width=150>';
 }else{
 $design_photo_img = '';
 } 
 $description = "";
 $description .='<table class="form-table" style="width:370px;">';  
 if ($kind != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="kind">';
 $sqlfield = mysql_query("select * from t_field_names where id=3");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
$description .='</td><td>';
 $sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
 $row1 = mysql_fetch_array($sql1);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($row1['kind_de']);	
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($row1['kind_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($row1['kind_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($row1['kind_it']);
 }
 $description .='</td></tr>';
 if ($type != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="type">';
 $sqlfield = mysql_query("select * from t_field_names where id=4");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
$description .='</td>
 <td>';
 if ($type != ""){
 $sql1 = mysql_query("select * from t_event_type where id='".$type."'");
 $row1 = mysql_fetch_array($sql1);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($row1['eventtype_de']);	
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($row1['eventtype_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($row1['eventtype_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($row1['eventtype_it']);
 }
 }else{
 echo "";
 }
$description .='</td></tr>';
 if ($quality != ""){
$description .='
 <tr>
 <td style="font-weight:bold;">';
 $sqlfield = mysql_query("select * from t_field_names where id=75");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .= '</td>
  <td>
 <div style="float:left;margin-top:6px;">';
 if ($quality != ""){
 $sql1 = mysql_query("select * from t_quality where id='".$quality."'");
 $row1 = mysql_fetch_array($sql1);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($row1['quality_de']);	
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($row1['quality_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($row1['quality_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($row1['quality_it']);
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
 $description .='</div><div style=float:left;margin-left:4px;>&nbsp;<img src=http://manimano.ch/wlw/images/'.$quality.'.png width=30px height=30px alt="'.$quality1.'"  title="'.$quality1.'"></div>';
 }elseif ($quality == 2){
 $description .='</div><div style=float:left;margin-left:4px;>&nbsp;<img src=http://manimano.ch/wlw/images/'.$quality.'.png width=30px height=30px alt="'.$quality2.'"  title="'.$quality2.'"></div>';
 }elseif ($quality == 3){
 $description .='</div><div style=float:left;margin-left:4px;>&nbsp;<img src=http://manimano.ch/wlw/images/'.$quality.'.png width=30px height=30px alt="'.$quality3.'"  title="'.$quality3.'"></div>';
 }elseif ($quality == 4){
 $description .='</div><div style=float:left;margin-left:4px;>&nbsp;<img src=http://manimano.ch/wlw/images/'.$quality.'.png width=30px height=30px alt="'.$quality4.'"  title="'.$quality4.'"></div>';
 }elseif ($quality == 5){
 $description .='</div><div style=float:left;margin-left:4px;>&nbsp;<img src=http://manimano.ch/wlw/images/'.$quality.'.png width=30px height=30px alt="'.$quality5.'"  title="'.$quality5.'"></div>';
 }
 }else{
 $description .= "";
 }
 $description .='</td>';
 }
 $description .='</tr>';
 }
 if ($short_desc != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="short_desc">';
 $sqlfield = mysql_query("select * from t_field_names where id=5");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</td>';
 $description .='<td>'.fixEncoding123($short_desc).'</td>';                                                                                                    
 $description .='</tr>';
 }
 if ($long_desc != ""){
 $description .='<tr>
 <td style="font-weight:bold;">';
 $sqlfield = mysql_query("select * from t_field_names where id=6");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>';
 $description .='<td>'.fixEncoding123($long_desc).'</td>';                                                                                                   
 $description .='</tr>';
 }
 if ($location != ""){	
 $description .='<tr>
 <td style="font-weight:bold;"><label for="location">';
 $sqlfield = mysql_query("select * from t_field_names where id=7");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>';
 $description .='<td>';
 if ($location != ""){
 $sql1 = mysql_query("select * from t_location where id='".$location."'");
 $row1 = mysql_fetch_array($sql1);
 $description .= fixEncoding123($row1['loc_name'] . " " .$row1['loc_detail'] ." " .$row1['loc_adress1'] . ' ' . $row1['loc_adress2'] ." ". $row1['loc_zip'] . " " .$row1['loc_loc']);
 }else{
 $description .= "";
 }
 $description .='</td>';
 }
 $description .='</tr>';
 }
 if ($price != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="price">';
 $sqlfield = mysql_query("select * from t_field_names where id=8");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>';
 $description .='<td>'.$price;
 $sql1 = mysql_query("select * from t_currency where id='".$currency."'");
 $row1 = mysql_fetch_array($sql1);
 $description .= " " . $row1['currency'];
$description .='
 </td>                                                                                         
 </tr>';
 }
 if ($remark_price != ""){ 
 $description .='<tr>
 <td style="font-weight:bold;"><label for="remark_price">';
 $sqlfield = mysql_query("select * from t_field_names where id=10");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
$description .='</label></td>
 <td>'.fixEncoding123($remark_price).'</td>';                                                                                  
 $description .='</tr>';
 }
 if ($remark_prerequisite != ""){
$description .='
 <tr>
 <td style="font-weight:bold;"><label for="remark_prerequisite">';
 $sqlfield = mysql_query("select * from t_field_names where id=11");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
$description .=' </label></td>
 <td>'.fixEncoding123($remark_prerequisite).'</td>                                                                                             
 </tr>';
 }
 if ($date_remark != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="date_remark">';
 $sqlfield = mysql_query("select * from t_field_names where id=16");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>
 <td>'.fixEncoding123($date_remark).'</td>';                                                                                                 
 $description .='</tr>';
 }
 if ($time_start != "00:00:00"){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="time_start">';
 $sqlfield = mysql_query("select * from t_field_names where id=19");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>';
 $description .='<td>'.$time_start.'</td>                                                                                                    
 </tr>';
 }
 if ($time_end != "00:00:00"){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="time_end">';
 $sqlfield = mysql_query("select * from t_field_names where id=20");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>
 <td>'.$time_end.'</td>                                                                                                
 </tr>';
 }
 if ($remark_time != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="remark_time">';
 $sqlfield = mysql_query("select * from t_field_names where id=21");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .=' </label></td>
 <td>'.fixEncoding123($remark_time).'</td>                                                                                                
 </tr>';
 }
 if ($leader != ""){
$description .='
 <tr>
 <td style="font-weight:bold;"><label for="leader">';
 $sqlfield = mysql_query("select * from t_field_names where id=23");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>
 <td>';
 if ($leader != ""){
 $sql1 = mysql_query("select * from t_leader where id='".$leader."'");
 $row1 = mysql_fetch_array($sql1);
 $description .= fixEncoding123($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
 }
 if ($leader2 != ""){
 $description .='<br/>';
 $sqlleaders2 = mysql_query("select * from t_leader where id='".$leader2."'");
 $rowleaders = mysql_fetch_array($sqlleaders2);
 $description .=  fixEncoding123($rowleaders['company'] . " " . $rowleaders['firstname'] . " " .$rowleaders['lastname']);
 }
 $description .='</td>
 </tr>';
 }
 if ($eve_contact_name != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="eve_contact_name">';
 $sqlfield = mysql_query("select * from t_field_names where id=24");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td>
 <td>'.fixEncoding123($eve_contact_name).'</td>                                                                                                 
 </tr>';
 }
 if ($eve_contact_phone != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="eve_contact_phone">';
 $sqlfield = mysql_query("select * from t_field_names where id=25");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .='</label></td><td>'.fixEncoding123($eve_contact_phone);                                                                                                   
 $description .='</td></tr>';
 }
 if ($eve_contact_email != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="eve_contact_email">';
 $sqlfield = mysql_query("select * from t_field_names where id=26");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .=' </label></td>
 <td>'.fixEncoding123($eve_contact_email).'</td>';                                                                                                
 $description .='</tr>';
 }
 if ($eve_contact_url != ""){	
 $description .='<tr>
 <td style="font-weight:bold;"><label for="eve_contact_url">';
 $sqlfield = mysql_query("select * from t_field_names where id=27");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
 $description .=' </label></td>
 <td>'.fixEncoding123($eve_contact_url).'</td>                                                                                                   
 </tr>';
 }
 if ($eve_image_path != ""){
 $description .='<tr>
 <td style="font-weight:bold;"><label for="design_photo">';
 $sqlfield = mysql_query("select * from t_field_names where id=28");
 $rowfield = mysql_fetch_array($sqlfield);
 if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
 $description .= fixEncoding123($rowfield['fieldname_de']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
 $description .= fixEncoding123($rowfield['fieldname_eng']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
 $description .= fixEncoding123($rowfield['fieldname_fr']);
 }elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
 $description .= fixEncoding123($rowfield['fieldname_it']);
 }
$description .='
 </label></td>
 <td>'.$design_photo_img.'</td>
 </tr>';
 } 
 $description .='</table>';
$icaldetails = "";
$icaldetails .="BEGIN:VCALENDAR\n";
$icaldetails .="PRODID:-//Microsoft Corporation//Outlook 14.0 MIMEDIR//EN\n";
$icaldetails .="VERSION:2.0\n";
$icaldetails .="METHOD:REQUEST\n";
$icaldetails .="X-MS-OLK-FORCEINSPECTOROPEN:TRUE\n";
$icaldetails .="BEGIN:VEVENT\n";
$icaldetails .="CLASS:PUBLIC\n";
$icaldetails .="CREATED:".date('Ymd')."T".date('his')."Z\n";
$sqlfield = mysql_query("select * from t_field_names where id=390");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$header_ical = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$header_ical =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$delete =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$header_ical =$rowfield['fieldname_it'];
	}	
$sqlfield = mysql_query("select * from t_field_names where id=391");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$footer_ical = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$footer_ical =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$footer_ical =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$footer_ical =$rowfield['fieldname_it'];
	}
//$description = "";
$icaldetails .="DESCRIPTION:".$header_ical."\n\n".$description." \n\n".$footer_ical."\n";
if ($rowquery['time_end'] != "00:00:00"){
$icaldetails .="DTEND:".date('Ymd',strtotime($rowquery['events_end_date']))."T".date('Ymd',strtotime($rowquery['time_end']))."Z\n";
}else{
$icaldetails .="DTEND:".date('Ymd',strtotime($rowquery['events_end_date']))."T180000Z\n";
}
if ($rowquery['time_start'] != "00:00:00"){
$icaldetails .="DTSTART:".date('Ymd',strtotime($rowquery['events_start_date']))."T".date('Ymd',strtotime($rowquery['time_start']))."Z\n";
}else{
$icaldetails .="DTSTART:".date('Ymd',strtotime($rowquery['events_start_date']))."T180000Z\n";
}
$icaldetails .="DTSTAMP:".date('Ymd',strtotime($rowquery['etimestamp']))."T".date('his',strtotime($rowquery['etimestamp']))."Z\n";
$icaldetails .="LAST-MODIFIED:".date('Ymd',strtotime($rowquery['elast_change']))."T".date('his',strtotime($rowquery['elast_change']))."Z\n";
$location = fixEncoding123($rowquery['loc_name'] . " " .$rowquery['loc_detail'] ." " .$rowquery['loc_adress1'] . ' ' . $rowquery['loc_adress2'] ." ". $rowquery['loc_zip'] . " " .$rowquery['loc_loc']);
//$icaldetails .="LOCATION:".$location."\n";				
$sqlfield = mysql_query("select * from t_languages where id='".$_SESSION[WEBSITE_ALIAS]['language']."'");
$rowfield = mysql_fetch_array($sqlfield);
$rowlang = $rowfield['language'];						
$icaldetails .='ORGANIZER;CN="David Schlpfer":mailto:dsc@d-s-c.ch';
$icaldetails .="SEQUENCE:0\N";
$icaldetails .="SUMMARY;LANGUAGE=".$rowlang.":".$rowquery['title']."\n";
$icaldetails .="TRANSP:OPAQUE\n";
$icaldetails .="UID:".date('Ymd')."T".date('his')."uid1@example.com\n";
//$icaldetails .='X-ALT-DESC;FMTTYPE=text/html:<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 3.2//EN">\n<HTML>\n<HEAD>\n<META NAME="Generator" CONTENT="MS Exchange Server version 14.02.5004.000">\n<TITLE></TITLE>\n</HEAD>\n<BODY>\n'.$header_ical.'\n\n'.$description.'\n\n'.$footer_ical.'\n\n</BODY>\n</HTML>\n';
$icaldetails .='X-MICROSOFT-CDO-BUSYSTATUS:BUSY\n';
$icaldetails .='X-MS-OLK-AUTOFILLLOCATION:FALSE\n';
$icaldetails .='END:VEVENT\n';
$icaldetails .='END:VCALENDAR\n';
echo $icaldetails;
?>