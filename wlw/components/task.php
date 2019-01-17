<?php
         error_reporting(0);
         session_start();
         require_once ( '../includes/config.php' );
         require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
         $q = strtolower($_GET["q"]);
         $query = mysql_query("select *,l.id as lid from t_location l inner join t_country c on
         l.loc_country=c.id");
         echo mysql_num_rows($query);
         while ($row = mysql_fetch_array($query)){
         $address = $row['loc_adress1'] . " " . $row['loc_adress2'] . " " . $row['loc_loc'] . " " . $row['loc_zip'] . " " . $row['long'];
         $address2 = $row['loc_loc'] . " " . $row['loc_zip'];
         $longlat = getLatLong($address);
         echo $lat = $longlat['lat'];
         echo $long = $longlat['long'];
         mysql_query("update t_location set latitude='$lat', longitude='$long' where id='".$row['lid']."'");
         
         
         
         
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

	//////////////////////////////////for the filter sorting
         
         $currentaddress = "Quezon City 1118";
         $currentlonglat = getLatLong($currentaddress);
         $currentlong = $currentlonglat['long'];
         $currentlat = $currentlat['lat'];
         
         
         $ctr = 0;
	$rows = "";
         $sql = mysql_query("select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location");
         while ($row = mysql_fetch_array($sql)){
         $ctr++;
         $address = $row['loc_adress1'] . " " . $row['loc_adress2'] . " " . $row['loc_loc'] . " " . $row['loc_zip'] . " " . $row['long'];
         $longlat = getLatLong($address);
         $eventlat = $longlat['lat'];
         $eventlong = $longlat['long'];
         $distance = number_format(distance($eventlat, $eventlong,$currentlat, $currentlong, 'm'),2);
         echo $row['eid']."|".$distance ."~~";
	 $myarray[$row[eid]][distance];
         if (mysql_num_rows($sql) == $ctr){
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
           print_r($ret);

	  $reverse = array_reverse($ret, true);
          print_r($reverse);
	
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
	  
$qry2 = mysql_query("SELECT * FROM t_event WHERE id IN ($keys) ORDER BY FIND_IN_SET(id, '$keys')");
while ($rowqry = mysql_fetch_array($qry2)){
	echo $rowqry['id'] . "<br />";
}

        
         ?>