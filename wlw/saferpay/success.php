<?php
/* parse the query string and get DATA and SIGNATURE */
//print_r()
$a = ($_SERVER['QUERY_STRING']);
$array=array();
parse_str($a,$array);
$DATA = $array['DATA'];
$SIGNATURE = $array['SIGNATURE'];
/*
foreach($array as &$value){
    print_r($value);
}
*/
//urldecode($DATA);
//urldecode($SIGNATURE);

/* the hosting gateway URL to verify pay confirm */
$gateway = "https://www.saferpay.com/hosting/VerifyPayConfirm.asp";
$accountid = "99867-94913159"; /* saferpay account id */
/* put it all together */
$url = "$gateway?DATA=".urlencode($DATA)."&SIGNATURE=".urlencode($SIGNATURE);
/* verify pay confirm message at hosting server */
//$result = join("", file($url));
echo $result = file($url);
/* check if result is OK... */
if (substr($result, 0, 3) == "OK:")
{
      print("Your Order has been successfully processed.");
      parse_str(substr($result, 3));
       echo '<br/>';
      print_r($result);

      /* $ID    = saferpay transaction identifier, store in DBMS */
      /* $TOKEN = token of transaction, store in DBMS */
      /***** Optional: Finalize payment by capture of transaction *****/
      /* the hosting gateway URL to complete payment */
      $gateway = "https://www.saferpay.com/hosting/PayComplete.asp";
      /* put it all together */
      $url = "$gateway?ACCOUNTID=$accountid&ID=".urlencode($ID).
             "&TOKEN=".urlencode($TOKEN);
      /* complete payment by hosting server */
       echo '<br/>';
        print_r($url);
        echo '<br/>';
      $result = join("", file($url));
      print_r($result);
      if (substr($result, 0, 2) == "OK")
            print("Capture has been done successfully");
      else
            print("Error: retry capture later...");
}
else /* ...or if an error happened */
{
      print $result;
}

?>
