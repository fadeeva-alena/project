<?php
$address = str_replace( " ", "+","http://maps.googleapis.com/maps/api/geocode/xml?address=8133+Esslingen&sensor=false");
//echo"$address";
   // Retrieve the URL contents
   $page = file_get_contents($address);
//echo "$page";
   // Parse the returned XML file
   //$xml = new SimpleXMLElement($page);
$xml = simplexml_load_file($address) or die("url not loading");
$status = $xml->status; // v3
    if (strcmp($status, "OK") == 0) {
    
    
    echo "success";
  // Parse the coordinate string
//list($hlong, $hlat, $altitude) = explode(",", $xml->GeocodeResponse->result->geometry->location);
$hlat = $xml->result->geometry->location->lat; // v3
 

     $hlong = $xml->result->geometry->location->lng; // v3
$hlat=floatval($hlat);
$hlong=floatval($hlong);
      
 if (is_float($hlat)) {
    echo "is float\n";
} else {
    echo "is not float\n";
}     


if (is_string($hlat)) {
    echo "is string\n";
} else {
    echo "is not string\n";
}     
 

echo $hlat ;
echo $hlong;
}

?>

