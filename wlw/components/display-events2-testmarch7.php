<?php
error_reporting(0);
session_start();
$mode = "view";
if ($_SESSION['provider'] == ""){
 $_SESSION['provider'] = 1;
	$_SESSION[WEBSITE_ALIAS]['user_level']    	= 1;
	$_SESSION[WEBSITE_ALIAS]['language']    	= 1;
}
//setlocale(LC_ALL, 'en_US.UTF8');

$sqlcookies = mysql_query("select * from t_cookies where ip_address='".$_SERVER['REMOTE_ADDR']."'");
$rowcookies = mysql_fetch_array($sqlcookies);
$sqlfield = mysql_query("select * from t_field_names where id=412");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$waitinghover = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$waitinghover = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$waitinghover = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$waitinghover = $rowfield['fieldname_it'];
						}
$sqlfield = mysql_query("select * from t_field_names where id=410");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							$reservationbutton = $rowfield['fieldname_de'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							$reservationbutton = $rowfield['fieldname_eng'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							$reservationbutton = $rowfield['fieldname_fr'];
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							$reservationbutton = $rowfield['fieldname_it'];
						}
// Retrieve record
//if(!empty($id) || $id != '') :
if ($_REQUEST['datetocheck']!= ""){
	$datetocheck= $_REQUEST['datetocheck'];
}else{
	$datetocheck= date('Y-m-d');
}	
require_once ( 'includes/config.php' );
require_once ( PATH_LIBRARIES.'libraries.php' );

//////////////////////////////////for the filter sorting
	if ($_GET['location']!="" or $_GET['loc_zip'] !=""){
         $currentaddress = $_GET['location'] . " " . $_GET['loc_zip'];
         $currentlonglat = getLatLong($currentaddress);
         $currentlong = $currentlonglat['long'];
         $currentlat = $currentlat['lat'];
         
         
         $ctr123 = 0;
		$rows = "";
         $sql = mysql_query("select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}')");
         while ($row = mysql_fetch_array($sql)){
         $ctr123++;
         $address = $row['loc_adress1'] . " " . $row['loc_adress2'] . " " . $row['loc_loc'] . " " . $row['loc_zip'] . " " . $row['long'];
	
		
         $longlat = getLatLong($address);
         $eventlat = $longlat['lat'];
         $eventlong = $longlat['long'];
         $distance = number_format(distance($eventlat, $eventlong,$currentlat, $currentlong, 'm'),2);
         //echo $row['eid']."|".$distance ."~~";
	 $myarray[$row[eid]][distance];
         if (mysql_num_rows($sql) == $ctr123){
            $rows .= $row['eid'] . ":" .$distance."";
         }else{
            $rows .= $row['eid'] . ":" .$distance .":";
         }
         }
	   $data = explode(":", $rows);
           $num = count($data);

           if ($num % 2 || ! $num) {
               return false;
           }

           for ($i = 0; $i < $num / 2; $i++) {
               $ret[$data[$i * 2]] = $data[$i * 2 + 1];
           }
           //print_r($ret);

	  $reverse = array_reverse($ret, true);
          //print_r($reverse);
	
	$counter = 0;
	$keys = "";
	  foreach ($reverse as $key => $val) {
		$counter++;
		if (mysql_num_rows($sql) == $counter){
    		$keys .= $key;
		}else{
		$keys .= $key .",";
		}
	  }
	}
if ($_GET['loc_loc']!="" or $_GET['loc_zip'] !=""){
	$where = " id IN ($keys) and";
	$order = " ORDER BY FIND_IN_SET(id, '$keys')";
}	  
$qry2 = mysql_query("select * from t_event e inner join t_dates d
								on e.id=d.events_id where id IN ($keys) ORDER BY FIND_IN_SET(id, '$keys')");
/*while ($rowqry = mysql_fetch_array($qry2)){
	echo $rowqry['id'] . "<br />";
}*/




if (isset($_GET['quality']) and $_GET['quality'] != ""){$getquality = " and quality='".$_GET['quality']."'";}
if (isset($_GET['quality']) and ($_GET['quality'] == "0")){$getquality = "";}
$quality = "";
if ($rowcookies['quality1'] ==1){$quality .= "1,";}
if ($rowcookies['quality2'] ==1){$quality .= "2,";}
if ($rowcookies['quality3'] ==1){$quality .= "3,";}
if ($rowcookies['quality4'] ==1){$quality .= "4,";}
if ($rowcookies['quality5'] ==1){$quality .= "5,";}

if ($quality != ""){
	$val = substr($quality, 0, -1);
	$getquality = " and e.quality in ($val)";
}
else{
	$getquality = " and e.quality in (1111111111111111111)";
}

$gettype = "";
if ($rowcookies['type'] != "" and $rowcookies['type'] != "0"){
	$gettype = " and type='".$rowcookies['type']."' ";
}

if ($rowcookies['location'] != "locname"){
		$locationx = $rowcookies['location'];
		 if ($rowcookies['searchitem'] == ""){
			$sqlqry = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') and ((l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%')) $getquality  $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $rowcookies['searchitem'];
			} else {
				$keyword = utf8_decode($rowcookies['searchitem']);
			}
			$locationx = $rowcookies['location'];
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
		if ($rowcookies['searchitem'] == ""){
			$sqlqry = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') $getquality  $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $rowcookies['searchitem'];
			} else {
				$keyword = utf8_decode($rowcookies['searchitem']);
			}
			$locationx = $rowcookies['location'];
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
//echo "select * from t_event where $where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') $getquality $order";
//echo "select * from t_event where $where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') $getquality $order";
//echo "select * from t_event where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') $getquality";

?>
<div style="float:left;border:0px solid red;width:400px;">
<!--<script src="<?php echo PLUGINS; ?>jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.validate.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.form.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo JS?>popup.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
<link href="plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> -->
<style>



div.toggle a{padding:0px;text-decoration:none;font-weight:bold;clear:both;}

</style>


<script type="text/javascript">
	$(document).ready(function() {
        function toggleDiv(divid){

            var div = document.getElementById(divid);
			$('.panel').hide();
            div.style.display = div.style.display == 'block' ? 'none' : 'block';

//display-feedback
	    $('#display-feedback').show();


            }
		/*	
		$("a.#modalpopup1,a.#modalpopup2").fancybox({
		'titlePosition'	: 'inside',
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'
		});*/
	})
    </script>
	<!--<script>
	$(document).ready(function() {
	$(".togx").click(function () {
		
		
	})
	})
</script>-->

<h1><?php 

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

<table style="margin-bottom:10px;">
	<?php
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_eng'];	
	}
	?>
	<tr>
		<td colspan="6" style="padding-bottom:5px;">
			

				<?php
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
				
		/*		
		$sqlfield = mysql_query("select * from t_field_names where id=63");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}*/
		?> 
		
		<!--<input type="text" id="zip" name="zip" style="width:50px;" maxlength="150" value="<?php echo $_GET['loc_loc'];?>"/>&nbsp;-->
		
		
		</td>
		
		
	</tr>
	
	
</table>

<script>
	<?php if ($_GET['loc_zip'] != ""){$loczipparam = "&loc_zip=".$_GET['loc_zip'];}?>
	<?php if ($_GET['loc_loc'] != ""){$loclocparam = "&loc_loc=".$_GET['loc_loc'];}?>
	function getquality(quality) {
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;>...</div>');
		//$('#load-desc').hide();
		$.ajax({
		  url: "components/display-events.php?datetocheck=<?php echo $datetocheck?><?php echo $loczipparam?><?php echo $loclocparam?>&quality="+quality,
		  cache: false,
		  success: function(html){
			$('#loadingprocessing').html('');
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})
	}
</script>
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

<div class="toggle" style="clear:both;">- <a style="font-weight:bold;font-size;13px;" onclick="javascript:sideClick(<?php echo $counterx;?>);" class="togx" href="javascript:toggleDiv('panel<?php echo $ctr;?>',<?php echo $rowevent['eid'];?>);" ><?php echo fixEncoding($title);?></a></div>


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
</div>
<?php
}
?>        
      

</div>

<?php
require('includes/EasyGoogleMap.class.php');
$gm = & new EasyGoogleMap("ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ");
$gm->SetMarkerIconStyle('FLAG');
$gm->SetMarkerIconColor('GRANITE_PINE');
/*
$gm->SetMarkerIconStyle('FLAG');
$gm->SetMarkerIconStyle('GT_FLAT'); # default
$gm->SetMarkerIconStyle('GT_PILLOW');
$gm->SetMarkerIconStyle('HOUSE');
$gm->SetMarkerIconStyle('PIN');
$gm->SetMarkerIconStyle('PUSH_PIN');
$gm->SetMarkerIconStyle('STAR');

$gm->SetMarkerIconColor('PACIFICA'); # default
$gm->SetMarkerIconColor('YOSEMITE');
$gm->SetMarkerIconColor('MOAB');
$gm->SetMarkerIconColor('GRANITE_PINE');
$gm->SetMarkerIconColor('DESERT_SPICE');
$gm->SetMarkerIconColor('CABO_SUNSET');
$gm->SetMarkerIconColor('TAHITI_SEA');
$gm->SetMarkerIconColor('POPPY');
$gm->SetMarkerIconColor('NAUTICA');
$gm->SetMarkerIconColor('DEEP_JUNGLE');
$gm->SetMarkerIconColor('SLATE');
*/
$gm->SetMapZoom(10);


if ($rowcookies['location'] != "locname"){
		$locationx = $rowcookies['location'];
		//echo $rowcookies['searchitem']
		 if ($rowcookies['searchitem'] == ""){
			$sql = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') and ((l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%')) $getquality $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $rowcookies['searchitem'];
			} else {
				$keyword = utf8_decode($rowcookies['searchitem']);
			}
			//echo $keyword;
			$locationx = $rowcookies['location'];
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
		 //echo $sql;
	}else{
		if ($rowcookies['searchitem'] == ""){
			$sql = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') $getquality  $getkind $gettype group by e.id";
		 }else{
			$br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $rowcookies['searchitem'];
			} else {
				$keyword = utf8_decode($rowcookies['searchitem']);
			}
		 
			//$keyword = utf8_decode($rowcookies['searchitem']);
			$locationx = $rowcookies['location'];
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

for ($i=0;$i<=10;$i++){
if ($i == 1){
$addressx = "Quezon City Philippines";
}elseif ($i == 2){
$addressx = "Metro Manila Philippines";
}
//$gm->SetAddress($addressx);
//$gm->SetInfoWindowText($addressx);
}
/*
$gm->SetAddress("Manila, Philippines");
$gm->SetInfoWindowText("This is Philippine Country.");
$gm->SetSideClick('Philippines');*/
?>

<div style="float:right;border:0px solid #eeeeee;width:300px;margin-left:5px;height:auto;margin-top:5px;">
<?php echo $gm->GmapsKey(); ?>
<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php //echo $gm->GetSideClick(); ?>
<?php echo $gm->UnloadMap(); ?>	

<div id="display-feedback" style="margin-top:20px;float:left;width:300px;border:0px solid #eeeeee;display:none;">
	TEST ONLY.	
	</div>

</div>


</div>

<br style="clear:both;">

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
					var g=confirm("Die Pl�tze sind schon alle vergeben, Sie werden auf die Warteliste gebucht.");
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
									alert("Sie stehen jetzt auf der Warteliste. Sie erhalten die Best�tigung per Email. Sobald ein Platz frei wird, werden Sie informiert.");
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