<?php
error_reporting(0);
session_start();
$mode = "view";
if ($_SESSION['provider'] == ""){
 $_SESSION['provider'] = 1;
	$_SESSION[WEBSITE_ALIAS]['user_level']    	= 1;
	$_SESSION[WEBSITE_ALIAS]['language']    	= 1;
}

$sqlsessionrights = mysql_query("select * from t_provider p where p.id='".$_SESSION[WEBSITE_ALIAS]['admin_id']
."'");
$rowsessionrights = mysql_fetch_array($sqlsessionrights);

//setlocale(LC_ALL, 'en_US.UTF8');

$sqlcookies = mysql_query("select * from t_cookies where ip_address='".$_SERVER['REMOTE_ADDR']."' order by id desc");
$rowcookies = mysql_fetch_array($sqlcookies);

if (mysql_num_rows($sqlcookies) < 1){
//quality1	quality2	quality3	quality4	quality5	type	searchitem	location
		$rowcookies['quality1'] = 1;
		$rowcookies['quality2'] = 1;
		$rowcookies['quality3'] = 1;
		$rowcookies['quality4'] = 1;
		$rowcookies['quality5'] = 1;
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
$allquality = $quality;
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
<div style="float:left;width:400px;">
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
$sqlfield = mysql_query("select * from t_field_names where id=699");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$loginfirst = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$loginfirst = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$loginfirst = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$loginfirst = $rowfield['fieldname_it'];
		}
?>
<script type="text/javascript">
				$(document).ready(function() {
					$('.commenticon').click(function () {
						alert('<?php echo fixEncodingx($loginfirst);?>');
						$('#username').focus();
					});
					
				})
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

<!--<div class="toggle" style="clear:both;">- <a style="font-weight:bold;font-size;13px;" onclick="javascript:sideClick(<?php echo $counterx;?>);" class="togx" href="javascript:toggleDiv('panel<?php echo $ctr;?>');" ><?php echo fixEncoding($title);?></a></div>-->

<div class="toggle" style="clear:both;">- <a style="font-weight:bold;font-size;13px;" onclick="javascript:sideClick(<?php echo $counterx;?>);" class="togx" href="javascript:toggleDiv('panel<?php echo $ctr;?>',<?php echo $rowevent['eid'];?>);" ><?php echo fixEncoding($title);?></a></div>


<div style="width:400px;<?php if (mysql_num_rows($sqlevent) > 1){?>display:none;<?php } ?>margin-top:5px;" id="panel<?php echo $ctr;?>" class="panel">
	<!--call ajax-events-description.php to display the details-->
</div>
<?php
}
?>        
      <?php 
	if ($allquality !=""){
		if (mysql_num_rows($sqlevent) < 1){
			echo translatefields(743);
		}
	}else{
		echo translatefields(744);
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
		<?php
			if ($rowsessionrights['events_reservations'] == 1){
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
		<?php
		}else{
		?>
		alert("<?php echo translatefields(779);?>");
		<?php
		}?>
		
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