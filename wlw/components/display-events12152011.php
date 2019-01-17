<?php
ob_start();
header("Expires: Thu, 17 May 2001 10:17:17 GMT");    			// Date in the past
header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // always modified
header ("Cache-Control: no-cache, must-revalidate");  			// HTTP/1.1
header ("Pragma: no-cache");                          			// HTTP/1.0
//header("Content-Type: application/json; charset=UTF-8");
error_reporting(0);
session_start();
$counterx = 0;
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
$mode = "view";
if ($_SESSION['provider'] == ""){
 $_SESSION['provider'] = 1;
	$_SESSION[WEBSITE_ALIAS]['user_level']    	= 1;
	$_SESSION[WEBSITE_ALIAS]['language']    	= 1;
}

$getkind = "";
if ($_GET['kind'] != ""){
	//$getkind = " and kind='".$_GET['kind']."' ";
}
$gettype = "";
if ($_GET['type'] != ""){
	$gettype = " and type='".$_GET['type']."' ";
}

$quality = "";

/* update cookies here */
/*CREATE TABLE  `wu`.`t_cookies` (
     `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
     `ip_address` VARCHAR( 255 ) NOT NULL ,
     `quality1` INT NOT NULL ,
     `quality2` INT NOT NULL ,
     `quality3` INT NOT NULL ,
     `quality4` INT NOT NULL ,
     `quality5` INT NOT NULL ,
     `type` INT NOT NULL ,
     `searchitem` VARCHAR( 255 ) NOT NULL ,
     `location` VARCHAR( 255 ) NOT NULL*/
     
     $sqlcookiescheck = mysql_query("select * from t_cookies where ip_address='".$_SERVER['REMOTE_ADDR']."'");
     
     $savequality1 = $_GET['quality1'];
     $savequality2 = $_GET['quality2'];
     $savequality3 = $_GET['quality3'];
     $savequality4 = $_GET['quality4'];
     $savequality5 = $_GET['quality5'];
     $savekeyword = fixEncoding($_GET['keyword']);
     $savetype = $_GET['type'];
     $ip = $_SERVER['REMOTE_ADDR'];
     
     $savelocation = fixEncoding($_GET['location']);
     
     
     if (mysql_num_rows($sqlcookiescheck) > 0){
        //updating only
		if ($savelocation == "locname"){
			$savelocation = "";
		}
        mysql_query("update t_cookies set quality1='$savequality1',quality2='$savequality2',quality3='$savequality3',quality4='$savequality4',quality5='$savequality5',type='$savetype',searchitem='$savekeyword',location='$savelocation' where ip_address='".$_SERVER['REMOTE_ADDR']."'");
		
     }else{
		if ($savelocation == "locname"){
			$savelocation = "";
		}
        //add records here
        mysql_query("insert into t_cookies values ('0','$ip','$savequality1','$savequality2','$savequality3','$savequality4','$savequality5','$savetype','$savekeyword','$savelocation')");
        
     }

	 

if ($_GET['quality1'] ==1){$quality .= "1,";}
if ($_GET['quality2'] ==1){$quality .= "2,";}
if ($_GET['quality3'] ==1){$quality .= "3,";}
if ($_GET['quality4'] ==1){$quality .= "4,";}
if ($_GET['quality5'] ==1){$quality .= "5,";}

if ($quality != ""){
	$val = substr($quality, 0, -1);
	$getquality = " and e.quality in ($val)";
}
else{
	$getquality = " and e.quality in (1111111111111111111)";
}
// Retrieve record
//if(!empty($id) || $id != '') :
if ($_REQUEST['datetocheck']!= ""){
	$datetocheck= $_REQUEST['datetocheck'];
}else{
	$datetocheck= date('Y-m-d');
}	


function getLatLong($address){
         if (!is_string($address))die("All Addresses must be passed as a string");
         $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
         $_result = false;
         if($_result = file_get_contents($_url)) {
         if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
         preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
         $_coords['lat'] = $_match[1];
         $_coords['long'] = $_match[2];
         }
         return $_coords;
         }
         
         function distance($lat1, $lon1, $lat2, $lon2, $unit) {
         $theta = $lon1 - $lon2;
         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
         $dist = acos($dist);
         $dist = rad2deg($dist);
         $miles = $dist * 60 * 1.1515;
         $unit = strtoupper($unit);
         
         if ($unit == "K") {
         return ($miles * 1.609344);
         } else if ($unit == "N") {
         return ($miles * 0.8684);
         } else {
         return $miles;
         }
         }		


$qry2 = mysql_query("select * from t_event e inner join t_dates d
								on e.id=d.events_id where id IN ($keys) ORDER BY FIND_IN_SET(id, '$keys')");
/*while ($rowqry = mysql_fetch_array($qry2)){
	echo $rowqry['id'] . "<br />";
}*/

/*echo $sql2 = "select *,e.id as eid from t_event e inner join t_dates d
								on e.id=d.events_id where $where (events_start_date <= '{$datetocheck}' and events_end_date >= '{$datetocheck}') $getquality GROUP BY e.id $order";*/
	if ($_GET['location'] != "locname"){
		$locationx = $_GET['location'];
		 if ($_GET['keyword'] == ""){
			$sqlqry = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') and ((l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%')) $getquality  $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $_GET['keyword'];
			} else {
				$keyword = utf8_decode($_GET['keyword']);
			}
			$locationx = $_GET['location'];
			$sqlqry = "SELECT e.*,e.id as eid,l.*,le.company,le.firstname,le.lastname FROM t_event e 
INNER JOIN t_dates d ON e.id=d.events_id 
inner JOIN t_location l on l.id=e.location 
inner join t_leader le ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND (e.title LIKE '%$keyword%'
								 OR e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%'
								
								OR le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%')
								and (l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%') $getquality  $getkind $gettype group by e.id";
								
								
					
		 }
	}else{
		if ($_GET['keyword'] == ""){
			$sqlqry = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') $getquality  $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $_GET['keyword'];
			} else {
				$keyword = utf8_decode($_GET['keyword']);
			}
			$locationx = $_GET['location'];
			$sqlqry = "SELECT *,e.id as eid FROM t_event e 
								INNER JOIN t_dates d
								ON e.id=d.events_id
								INNER JOIN t_leader le
								ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND (e.title LIKE '%$keyword%'
								OR (e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%')
								OR (le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%')) 
								$getquality  $getkind $gettype group by e.id";
					
		 }
	}							
	//echo $sqlqry;						
	$sqlevent = mysql_query($sqlqry);

?>
<div>
<table style="border:0px solid red;width:720px;" cellpadding="0" cellspacing="0">
<tr>
	<td valign="top">
	<h1 class="calendardetails">
<?php 
$currentmonthtext = date('F',strtotime($datetocheck));
						if ($_SESSION[WEBSITE_ALIAS]['language'] !=1){
							if ($currentmonthtext == "January"){
								$sqlfield = mysql_query("select * from t_field_names where id=176");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "February"){
								$sqlfield = mysql_query("select * from t_field_names where id=177");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "March"){
								$sqlfield = mysql_query("select * from t_field_names where id=178");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "April"){
								$sqlfield = mysql_query("select * from t_field_names where id=179");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "May"){
								$sqlfield = mysql_query("select * from t_field_names where id=180");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "June"){
								$sqlfield = mysql_query("select * from t_field_names where id=181");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "July"){
								$sqlfield = mysql_query("select * from t_field_names where id=182");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "August"){
								$sqlfield = mysql_query("select * from t_field_names where id=183");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "September"){
								$sqlfield = mysql_query("select * from t_field_names where id=184");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "October"){
								$sqlfield = mysql_query("select * from t_field_names where id=185");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "November"){
								$sqlfield = mysql_query("select * from t_field_names where id=186");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "December"){
								$sqlfield = mysql_query("select * from t_field_names where id=187");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}
							echo date(' d, Y',strtotime($datetocheck));
				}else{
					echo date('d',strtotime($datetocheck)) . ".";
					if ($currentmonthtext == "January"){
								$sqlfield = mysql_query("select * from t_field_names where id=176");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "February"){
								$sqlfield = mysql_query("select * from t_field_names where id=177");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "March"){
								$sqlfield = mysql_query("select * from t_field_names where id=178");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "April"){
								$sqlfield = mysql_query("select * from t_field_names where id=179");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "May"){
								$sqlfield = mysql_query("select * from t_field_names where id=180");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "June"){
								$sqlfield = mysql_query("select * from t_field_names where id=181");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "July"){
								$sqlfield = mysql_query("select * from t_field_names where id=182");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "August"){
								$sqlfield = mysql_query("select * from t_field_names where id=183");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "September"){
								$sqlfield = mysql_query("select * from t_field_names where id=184");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "October"){
								$sqlfield = mysql_query("select * from t_field_names where id=185");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "November"){
								$sqlfield = mysql_query("select * from t_field_names where id=186");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "December"){
								$sqlfield = mysql_query("select * from t_field_names where id=187");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo fixEncoding($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  fixEncoding($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   fixEncoding($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   fixEncoding($rowfield['fieldname_it']);}
							}
							echo " " .date('Y',strtotime($datetocheck));
				}
							$counterx = 0;
?>

</h1>

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

<div class="toggle" style="padding:0px;margin:0px;clear:both;">- <a style="font-weight:bold;font-size;13px;" onclick="javascript:sideClick(<?php echo $counterx;?>);" class="togx" href="javascript:toggleDiv('panel<?php echo $ctr;?>');" ><?php echo fixEncoding($title);?></a></div>

<div style="width:400px;<?php if (mysql_num_rows($sqlevent) > 1){?>display:none;<?php } ?>margin-top:5px;" id="panel<?php echo $ctr;?>" class="panel">
	
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
					$rs = $db->get_results("SELECT id,concat(loc_name ,', ',loc_detail,' ', loc_loc, ' ', loc_zip) as locname  FROM ".DB_TABLE_PREFIX."location order by loc_name asc");		
					
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
					
	$sql = mysql_query("select * from t_dates where events_id='".$rowevent['eid']."'");
	
	
	$ctr111 = 0;
	$num_rows = mysql_num_rows($sql);
	$number = mysql_num_rows($sql);
	
	$num_rows++;
	echo "<span class='validation-status'></span>&nbsp;&nbsp;";
	echo "<div style='float:left;margin-left:14px;width:65px;border:0px solid red;'><b>".$startdatelabel."</b></div>";
	
	if ($number > 1){
	echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'><b>".$enddatelabel."</b></div><div style='float:left;width:40px;'><a href='components/download-ical.php?id=".$rowevent['eid']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a onclick=emailevent(1,$rowevent[eid],'')><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><br style=clear:both;>";
	}else{
	echo "<div style='float:left;margin-left:4px;width:85px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
	}
	while ($size_row = mysql_fetch_array($sql)){
	$ctr111++;
	
	
	
	
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
	
	
	
	echo '<div style="padding:0px;">';
	echo "<div style='float:left;margin-left:14px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_start_date']))."</div>";
		if ($size_row['events_start_date'] != $size_row['events_end_date']){
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>".date('d.m.Y',strtotime($size_row['events_end_date']))."</div></div><div style='float:left;width:40px;'><a href='components/download-ical.php?id=".$rowevent['eid']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a style=cursor:pointer; onclick=emailevent(1,$rowevent[eid],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
		}else{
			echo "<div style='float:left;margin-left:4px;width:65px;border:0px solid red;'>&nbsp;</div></div><div style='float:left;width:40px;'><a style=cursor:pointer; href='components/download-ical.php?id=".$rowevent['eid']."&date_id=".$size_row['id']."'><img src='images/icon-downloads.png' width='16px' height='16px' border='0'/></a> <a style=cursor:pointer; onclick=emailevent(1,$rowevent[eid],$size_row[id])><img src='images/icon-send-email.png' width='16px' height='16px' border='0'/></a></div><div id=mailprocessing".$size_row[id]." class=mailprocessing style=float:left;></div><br style=clear:both;>";
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
	</form>
</div>
<?php
}
?>

	</td>
	<td width="300px" valign="top">
	<?php
require('../includes/EasyGoogleMap.class.php');
$gm = & new EasyGoogleMap("ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ");
$gm->SetMarkerIconStyle('FLAG');
$gm->SetMarkerIconColor('GRANITE_PINE');

$gm->SetMapZoom(10);



//$sql = mysql_query("select *,e.id as eid from t_event e inner join t_location l on l.id=e.location
//inner join t_dates d on e.id=d.events_id
  //where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}') GROUP BY e.id");
  
if ($_GET['location'] != "locname"){
		$locationx = $_GET['location'];
		 if ($_GET['keyword'] == ""){
			$sql = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') and ((l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%')) $getquality $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $_GET['keyword'];
			} else {
				$keyword = utf8_decode($_GET['keyword']);
			}
			$locationx = $_GET['location'];
			$sql = "SELECT e.*,e.id as eid,l.*,le.company,le.firstname,le.lastname FROM t_event e 
INNER JOIN t_dates d ON e.id=d.events_id 
inner JOIN t_location l on l.id=e.location 
inner join t_leader le ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND (e.title LIKE '%$keyword%'
								 OR e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%'
								
								OR le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%')
								and (l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%') $getquality  $getkind $gettype group by e.id";
					
		 }
	}else{
		if ($_GET['keyword'] == ""){
			$sql = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') $getquality  $getkind $gettype group by e.id";
		 }else{
			$br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $_GET['keyword'];
			} else {
				$keyword = utf8_decode($_GET['keyword']);
			}
		 
			//$keyword = utf8_decode($_GET['keyword']);
			$locationx = $_GET['location'];
			$sql = "SELECT *,e.id as eid FROM t_event e 
								INNER JOIN t_dates d
								ON e.id=d.events_id
								inner JOIN t_leader le
								ON e.leader=le.id
								inner join t_location l
								on l.id=e.location
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND ((e.title like '%$keyword%'
								OR e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%')
								OR (le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%')) 
								 $getquality  $getkind $gettype group by e.id";
					
		 }
	}
//echo $sql;
 $mysql = mysql_query($sql);
 $address = "";
 while ($row = mysql_fetch_array($mysql)){
 $ctr12++;
 $address1 = $row['loc_adress1'] . ' ' . $row['loc_adress2'] . ' ' . $row['loc_loc'] . ' ' . $row['loc_zip'] . ' ' . $row['long'];
 $address .= "<b>".$row['title'] ."</b><br />";
 $address .= $row['loc_adress1'] . ' ' . $row['loc_adress2'] . '<br />' . $row['loc_zip'] . ' ' . $row['loc_loc'] . ' ' . $row['long'].'<br/>';

$gm->SetAddress(fixEncoding($address1));
$gm->SetInfoWindowText(fixEncoding($address));
$gm->SetSideClick(fixEncoding($row[title]));
$address = "";
}

?>

<div style="float:left;border:1px solid #eeeeee;width:300px;margin-left:5px;height:auto;margin-top:5px;">
<?php echo $gm->GmapsKey(); ?>
<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php //echo $gm->GetSideClick(); ?>
<?php echo $gm->UnloadMap(); ?>	
</div>
	</td>
</tr>
</table>
</div>


<script type="text/javascript">
	$(document).ready(function() {
        function toggleDiv(divid){

            var div = document.getElementById(divid);
			$('.panel').hide();
            div.style.display = div.style.display == 'block' ? 'none' : 'block';

            }
		
	})
    </script>
<link href="plugins/jquery/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="plugins/jquery/facebox/facebox.js" type="text/javascript"></script> 
<script type="text/javascript">
    jQuery(document).ready(function($) {
		$('a[rel*=facebox]').click(function () {
		
		$('#content').attr('style','width:700px;');
		
	  })
	
      $('a[rel*=facebox]').facebox({
        loadingImage : 'plugins/jquery/facebox/loading.gif',
        closeImage   : 'plugins/jquery/facebox/closelabel.png'
      })
	  
    })
  </script>

<br style="clear:both;">

<script>
	<?php
		$sqlfield = mysql_query("select * from t_field_names where id=378");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$emailsent = fixEncoding($rowfield['fieldname_de']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$emailsent = fixEncoding($rowfield['fieldname_eng']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$emailsent = fixEncoding($rowfield['fieldname_fr']);
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$emailsent = fixEncoding($rowfield['fieldname_it']);
		}
	?>
	function emailevent(email,eventid,dateid) {
		
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
			alert("<?php echo fixEncoding($emailsent);?>");
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
	
		?>
		var emailaddress = prompt("<?php echo fixEncoding($emaillabel);?> : ", "");
		
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
			  if (dateid != ""){
				$('#mailprocessing'+dateid).html('');
			  }else{
				$('.mailprocessing').html('');
			  }
				alert("<?php echo fixEncoding($emailsent);?>");
			  }
			})
		}else{
			
			alert("<?php echo $erroremail;?>");
			var emailaddress = prompt("<?php echo fixEncoding($emaillabel);?> : ", "");
			
			
		}
		<?php
			}
		?>
	}
</script>