<?php
//;extension=php_openssl.dll need to be install
//error_reporting(0);
/* get the web server’s self URL */
$SERVER_NAME = 'manimano.ch/';
$SCRIPT_NAME = 'wlw/saferpay/test.php';
$self_url = "http://" . $SERVER_NAME . $SCRIPT_NAME;
//print_r($self_url);
$self_url = substr($self_url, 0, strrpos($self_url, '/')) . "/";
//print_r($self_url);
/* the hosting gateway URL to create pay init URL */
$gateway = "https://www.saferpay.com/hosting/CreatePayInit.asp";
/* set the payment attributes */
$accountid = "99867-94913159"; /* saferpay account id */
$orderid = "4711"; /* use your own order or basket identifier */
$amount = "1295"; /* 12.95 */
$currency = "EUR";
$description = urlencode("\"Test Purchase - saferpay PHP sample\"");
$successlink = $self_url."success.php"; /* return URL if payment successful */
//print_r($successlink);
$faillink = $self_url."failed.php";     /* return URL if payment failed */
$backlink = $self_url."checkout.php";   /* return URL if user cancelled */
/* put all attributes together and create hosting URL */
$attributes = "ACCOUNTID=$accountid&AMOUNT=$amount&CURRENCY=$currency&DESCRIPTION=$description&SUCCESSLINK=$successlink&FAILLINK=$faillink&BACKLINK=$backlink";
$url = "$gateway?$attributes";
/* get the PayInit URL from the hosting server */
$payinit_url = join(file($url),"");
//$payinit_url = $url;
//print_r($payinit_url);
?>
<html><head>
<title>Checkout</title>
<script src="http://www.saferpay.com/OpenSaferpayScript.js"></script>
</head><body>
<h5>Order ID: <?php echo $orderid; ?><br></h5>
<h5>Click <a href="<?php echo $payinit_url; ?>"
onclick="OpenSaferpayTerminal('<?php echo $payinit_url; ?>', this, 'LINK');">
here</a>
to purchase for <? printf("%s %d.%02d", $currency, $amount / 100, $amount %
100); ?>!
</h5>
</body>
</html>
