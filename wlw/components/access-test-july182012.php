<?php
$environment = 'sandbox';
function PPHttpPost($methodName_, $nvpStr_) {
	global $environment;

	// Set up your API credentials, PayPal end point, and API version.
	if ($environment == ""){
	$API_UserName = urlencode('ds_api1.d-s-c.ch');
	$API_Password = urlencode('97TRYGWJUXZ8JBGC');
	$API_Signature = urlencode('ANCPmV0wSULEKbwXlmCeJo6nyY-0Aq-e-TnOP3RcJpMiuodOCoy62wUi');
	}else{
	$API_UserName = urlencode('sandbo_1341194035_biz_api1.gmail.com');
	$API_Password = urlencode('TZGLZFZSJSJUBGCS');
	$API_Signature = urlencode('A5IvelPioMAqW10F9mtpoT3AQxfuAdxM6qq7PqCJ0Es7NWumD3kWO9h6');
	}
	$API_Endpoint = "https://api-3t.paypal.com/nvp";
	if("sandbox" === $environment || "beta-sandbox" === $environment) {
		$API_Endpoint = "https://api-3t.$environment.paypal.com/nvp";
	}
	$version = urlencode('51.0');

	// Set the API operation, version, and API signature in the request.
	$nvpreq = "METHOD=$methodName_&VERSION=$version&PWD=$API_Password&USER=$API_UserName&SIGNATURE=$API_Signature$nvpStr_";

	// Set the curl parameters.
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $API_Endpoint);
	curl_setopt($ch, CURLOPT_VERBOSE, 1);
	// Turn off the server and peer verification (TrustManager Concept).
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_POST, 1);
	// Set the request as a POST FIELD for curl.
	curl_setopt($ch, CURLOPT_POSTFIELDS, $nvpreq);
	// Get response from the server.
	$httpResponse = curl_exec($ch);

	if(!$httpResponse) {
		exit("$methodName_ failed: ".curl_error($ch).'('.curl_errno($ch).')');
	}

	// Extract the response details.
	$httpResponseAr = explode("&", $httpResponse);

	$httpParsedResponseAr = array();
	foreach ($httpResponseAr as $i => $value) {
		$tmpAr = explode("=", $value);
		if(sizeof($tmpAr) > 1) {
			$httpParsedResponseAr[$tmpAr[0]] = $tmpAr[1];
		}
	}

	if((0 == sizeof($httpParsedResponseAr)) || !array_key_exists('ACK', $httpParsedResponseAr)) {
		exit("Invalid HTTP Response for POST request($nvpreq) to $API_Endpoint.");
	}

	return $httpParsedResponseAr;
}

	$sql_access = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	if (mysql_num_rows($sql_access) < 1){
		$provider_id_admin = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		mysql_query("insert into t_provider_access values('0','$provider_id_admin','0','','0','','0','','0','')");
	}else{
		$row_access = mysql_fetch_array($sql_access);
		$seminar_with_reservation = $row_access['seminar_with_reservation'];
		$swr_expiration_date = $row_access['swr_expiration_date'];
		$seminar_extended = $row_access['seminar_extended'];
		$s_expiration_date = $row_access['s_expiration_date'];
		$session_based = $row_access['session_based'];
		$session_expiration_date = $row_access['session_expiration_date'];
		$session_enhanced = $row_access['session_enhanced'];
		$session_enhanced_expiration_date = $row_access['session_enhanced_expiration_date'];
	}


?>

<h1><?php
		$sqlfield = mysql_query("select * from t_field_names where id=782");
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
</h1>
<?php if ($_GET['task'] == "cancelled"){
	$dateexpiration = date("Y-m-t") . " 23:59:59";
	$get_access_id = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$row_access_id = mysql_fetch_array($get_access_id);
	$rowaccessid = $row_access_id['provider_access_id'];
	
  if ($_GET['num_plan'] == 1){
	
	$sqlcheckfirst = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and seminar_extended=1");
	$rowcheckfirst = mysql_fetch_array($sqlcheckfirst);
	if (mysql_num_rows($sqlcheckfirst) > 0){
		mysql_query("update t_provider_access set seminar_extended=0,swr_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
		$datetoday = date('Y-m-d H:i:s');
		mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','2','$datetoday','$dateexpiration','$datetoday','','','','')");
		$bodycontentnum = 787;
		//// sending email
		$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
		$to = $row->email;
		$username = $row->firstname;
		$language = $row->language;
		$gender = $row->gender;
		
		$subject = fixEncodingx(translatefields(797));
		$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
		$bodyemail = fixEncodingx(translatefields($bodycontentnum));
		$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
		$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
		$bodyemail = str_replace(",,","",$bodyemail);
		$body = $body . "" . $bodyemail . "</div>";
		
		$from = "info@spiritwings.ch";
		////echo $body;
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from\r\n";
		mail($to,$subject,$body,$headers);
		
		$headers = "";
		$bodyemail = "";
		$body = "";
		
	}

	mysql_query("update t_provider_access set seminar_with_reservation=0,swr_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','1','$datetoday','$dateexpiration','$datetoday','','','','')");
	$bodycontentnum = 786;
  }elseif($_GET['num_plan'] == 2){
  
	
	mysql_query("update t_provider_access set seminar_extended=0,s_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','2','$datetoday','$dateexpiration','$datetoday','','','','')");
	$bodycontentnum = 787;
  }elseif($_GET['num_plan'] == 3){
  
  
	$sqlcheckfirst = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and session_enhanced=1");
	$rowcheckfirst = mysql_fetch_array($sqlcheckfirst);
	if (mysql_num_rows($sqlcheckfirst) > 0){
		mysql_query("update t_provider_access set session_enhanced=0,session_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
		$datetoday = date('Y-m-d H:i:s');
		mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','3','$datetoday','$dateexpiration','$datetoday')");
		$bodycontentnum = 789;
		//// sending email
		$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
		$to = $row->email;
		$username = $row->firstname;
		$language = $row->language;
		$gender = $row->gender;
		
		$subject = fixEncodingx(translatefields(797));
		$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
		$bodyemail = fixEncodingx(translatefields($bodycontentnum));
		$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
		$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
		$bodyemail = str_replace(",,","",$bodyemail);
		$body = $body . "" . $bodyemail . "</div>";
		
		$from = "info@spiritwings.ch";
		////echo $body;
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from\r\n";
		mail($to,$subject,$body,$headers);
		
		$headers = "";
		$bodyemail = "";
		$body = "";
		
	}
  
  
	mysql_query("update t_provider_access set session_based=0,session_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','3','$datetoday','$dateexpiration','$datetoday','','','','')");
	$bodycontentnum = 788;
  }elseif($_GET['num_plan'] == 4){
 
  
	mysql_query("update t_provider_access set session_enhanced=0,session_enhanced_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','4','$datetoday','$dateexpiration','$datetoday','','','','')");
	$bodycontentnum = 789;
  }
 
	//// sending email
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
	$to = $row->email;
	$username = $row->firstname;
	$language = $row->language;
	$gender = $row->gender;
	
	$subject = fixEncodingx(translatefields(797));
	$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
	$bodyemail = fixEncodingx(translatefields($bodycontentnum));
	$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
	//$bodyemail = str_replace("<our_footer>","",$bodyemail);
	$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
	$bodyemail = str_replace(",,","",$bodyemail);
	$body = $body . "" . $bodyemail . "</div>";
	$from = "info@spiritwings.ch";
	////echo $body;
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: $from\r\n";
	mail($to,$subject,$body,$headers);
?>
    <div id="system-message">
    <div class="info">
     <div class="message"><?php echo translatefields(784);?></div>
     </div>
     </div>
     <?php } ?>
	 
	 
	 
<?php if ($_GET['task'] == "booked"){

$todayDate = date("Y-m-d");
$addmonth = $_REQUEST['months_plan'];
//Add one day to today
$dateOneMonthAdded = strtotime(date("Y-m-d", strtotime($todayDate)) . "+".$addmonth." month");

	$dateactivation = date('Y-m-t 23:59:59', $dateOneMonthAdded);
	$get_access_id = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$row_access_id = mysql_fetch_array($get_access_id);
	$rowaccessid = $row_access_id['provider_access_id'];
	
$paymentType =	'Sale';

$rowemail = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'") ;	
$firstName =urlencode($rowemail->firstname);
$lastName = urlencode($rowemail->lastname);
$creditCardType = urlencode($_POST['cardtype']);
$creditCardNumber = urlencode($_POST['cardnumber']);
$expDateMonth = $_POST['cardmonth'];
// Month must be padded with leading zero
$padDateMonth = urlencode(str_pad($expDateMonth, 2, '0', STR_PAD_LEFT));

$expDateYear = urlencode($_POST['cardyear']);
$cvv2Number = urlencode($_POST['cardcvv']);
$address1 = urlencode($rowemail->adress1);
$address2 = urlencode($rowemail->adress2);
$city = urlencode($rowemail->location);
$state = '';
$zip = urlencode($rowemail->zip);
$country = 'CH';	// US or other valid country code
if ($_REQUEST['access_num'] == 1){
	$amount = '10.00';	//actual amount should be substituted here
	$price = "10";
}elseif ($_REQUEST['access_num'] == 2){
	$amount = '10.00';	//actual amount should be substituted here
	$price = "10";
}elseif ($_REQUEST['access_num'] == 3){
	$amount = '10.00';	//actual amount should be substituted here
	$price = "10";
}elseif ($_REQUEST['access_num'] == 4){
	$amount = '20.00';	//actual amount should be substituted here
	$price = "20";
}
$amount = $amount * $addmonth;
$subamount = $price * $addmonth;

$dateforvat = date('Y-m-d');
$sqlvat = mysql_query("select * from t_vat where date_from <='$dateforvat' and date_to >='$dateforvat'");
$rowvat = mysql_fetch_array($sqlvat);
if (mysql_num_rows($sqlvat) > 0){
	$vat = $amount * ($rowvat['vat']/100);
	$vatx = (10*$addmonth) * ($rowvat['vat']/100);
}else{
	$vat = $amount * (8/100);
	$vatx = (10*$addmonth) * (8/100);
}

$amount = $amount + $vat;
//$amountx = $subamount + $vatx;

$amount = number_format($amount,2);
//$amountx = number_format($amountx,2);
/*$address1 = "1+Main+St";
$address2 = "";
$city = "San+Jose";
$state = "CA";
$zip = "95131";
$country = 'US';*/
$sqlbill = mysql_query("select * from t_provider_access_history order by bill_number desc");
$rowbill = mysql_fetch_array($sqlbill);
if ($rowbill['bill_number'] < 1 or $rowbill['bill_number'] == ""){
$bill_number = 1;
}else{
$bill_number = $rowbill['bill_number'] + 1;
}

$currencyID = 'USD';// or other currency ('GBP', 'EUR', 'JPY', 'CAD', 'AUD')

// Add request-specific fields to the request string.
$nvpStr =	"&PAYMENTACTION=$paymentType&AMT=$amount&CREDITCARDTYPE=$creditCardType&ACCT=$creditCardNumber".
			"&EXPDATE=$padDateMonth$expDateYear&CVV2=$cvv2Number&FIRSTNAME=$firstName&LASTNAME=$lastName".
			"&STREET=$address1&CITY=$city&STATE=$state&ZIP=$zip&COUNTRYCODE=$country&CURRENCYCODE=$currencyID";
//echo $nvpStr;
// Execute the API operation; see the PPHttpPost function above.
$httpParsedResponseAr = PPHttpPost('DoDirectPayment', $nvpStr);	
if("SUCCESS" == strtoupper($httpParsedResponseAr["ACK"]) || "SUCCESSWITHWARNING" == strtoupper($httpParsedResponseAr["ACK"])) {
	//exit('Direct Payment Completed Successfully: '.print_r($httpParsedResponseAr, true));
if ($_REQUEST['access_num'] == 1){
	$optionname = "Seminare – mit Reservation";
  }elseif ($_REQUEST['access_num'] == 2){
	$optionname = "Seminare – erweitert";
  }elseif ($_REQUEST['access_num'] == 3){
	$optionname = "Sitzungen – Basis";
  }elseif ($_REQUEST['access_num'] == 4){
	$optionname = "Sitzungen – erweitert";
  }
	
	
  if ($_REQUEST['access_num'] == 1){
  
	mysql_query("update t_provider_access set seminar_with_reservation=1,swr_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','1','$datetoday','$dateactivation','$datetoday','$price','$vat','$addmonth','$bill_number')");
	$bodycontentnum = 790;
  }elseif($_REQUEST['access_num'] == 2){
  
	$sqlcheckfirst = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and seminar_with_reservation=0");
	$rowcheckfirst = mysql_fetch_array($sqlcheckfirst);
	if (mysql_num_rows($sqlcheckfirst) > 0){
		mysql_query("update t_provider_access set seminar_with_reservation=1,swr_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
		$datetoday = date('Y-m-d H:i:s');
		
		
		mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','1','$datetoday','$dateactivation','$datetoday','$price','$vat','$addmonth','$bill_number')");
		
		$bodycontentnum = 790;
		//// sending email
		$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
		$to = $row->email;
		$username = $row->firstname;
		$language = $row->language;
		$gender = $row->gender;
		
		$subject = fixEncodingx(translatefields(794));
		$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
		
		$billingtop = "<div style=float:left;><img src='http://manimano.ch/wlw/images/header-logo.png'><br/>".translatefields(820).": CHE-".$rowvat['vat']."<br />DSC GmbH, Postfach 107, 8132 Egg</div>";

		$useraddress = "";
		if ($row->company !=""){
			$useraddress .= fixEncodingx($row->company) . "<br />";
		}	
		$useraddress .= genderfieldonly($row->gender) . "<br />";
		$useraddress .= $row->firstname ." " . $row->lastname . "<br />";
		if ($row->adress1 !=""){
			$useraddress .= fixEncodingx($row->adress1) . "<br />";
		}
		if ($row->adress2 !=""){
			$useraddress .= fixEncodingx($row->adress2) . "<br />";
		}
		
		$sqlcountry = mysql_query("select * from t_country where id='".$row->country."'");
		$rowcountry = mysql_fetch_array($sqlcountry);
		
		if ($row->country != ""){
			$useraddress .= fixEncodingx($rowcountry['long']) . " - ";
		}
		
		if ($row->location !=""){
			$useraddress .= fixEncodingx($row->location) . " ";
		}
		if ($row->zip !=""){
			$useraddress .= fixEncodingx($row->zip) . " ";
		}
		
	$optionnamex= "Seminare – mit Reservation";
  
		$bodyemail = $billingtop . fixEncodingx(translatefields($bodycontentnum));
		$bodyemail = str_replace("<firstname> <lastname>,","<div style='float:right;margin-top:10px;text-align:right;'>".$useraddress."</div><br style='clear:both;'><hr><div style=font-weight:bold;font-size:15px;size:15px;>".translatefields(821)."</div>",$bodyemail);
		//in between: title amount option priceeach pricetotal
		$priceinfo = "";
		$priceinfo .="<table style='border:1px solid #eeeeee;border-collapse:collapse;' cellpadding=2 cellspacing=2>";
		$priceinfo .="<tr>";
		$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(822)."</b></td>";
		$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(823)."</b></td>";
		$priceinfo .="<td width=170 align=left style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(824)."</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(825)."</b></td>";
		$priceinfo .="</tr>";
		$subamount = $price * $addmonth;
		if ($_REQUEST['access_num'] == 4){
			$priceinfo .="<tr>";
			$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$addmonth."</td>";
			$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>20.00</td>";
			$priceinfo .="<td width=130 align=left style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$optionnamex."</b></td>";
			$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($subamount,2)."</td>";
			$priceinfo .="</tr>";
		}else{
			$priceinfo .="<tr>";
			$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$addmonth."</td>";
			$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>10.00</td>";
			$priceinfo .="<td width=130 align=left style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$optionnamex."</b></td>";
			$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($subamount,2)."</td>";
			$priceinfo .="</tr>";
		}
		if ($rowvat['vat']  != "" or $rowvat['vat'] !=0){
		$priceinfo .="<tr>";
		$priceinfo .="<td align=right colspan=3 style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;color:#666666;'><b>".translatefields(820)."(".$rowvat['vat']."%)</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($vat,2)."</td>";
		$priceinfo .="</tr>";
		}
		$priceinfo .="<tr>";
		$priceinfo .="<td align=right colspan=3 style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;color:#666666;'><b>".translatefields(826)."</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$amount."</td>";
		$priceinfo .="</tr>";
		$priceinfo .="</table>";
		
		$thankyou = "<p>".translatefields(827) . "</p>";
		
		$bodyemail = str_replace("<our_footer>",$priceinfo. "" . $thankyou . " ". translatefields(649),$bodyemail);
		$bodyemail = str_replace(",,","",$bodyemail);
		$body = $body . "" . $bodyemail . "</div>";
		
		$from = "info@spiritwings.ch";
		////echo $body;
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from\r\n";
		mail($to,$subject,$body,$headers);
		//echo $body;
		$headers = "";
		$bodyemail = "";
		$body = "";
		$billingtop = "";
		$useraddress = "";
		$priceinfo= "";
		$subamount = "";
		$rowcountry = "";
		$thankyou = "";
		$bill_number = $bill_number + 1;
	}
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("update t_provider_access set seminar_extended=1,s_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	//mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','2','$datetoday','$dateactivation','$datetoday')");
	
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','2','$datetoday','$dateactivation','$datetoday','$price','$vat','$addmonth','$bill_number')");
	$bill_number = "";
	$bodycontentnum = 791;
  }elseif($_REQUEST['access_num'] == 3){
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("update t_provider_access set session_based=1,session_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	//mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','3','$datetoday','$dateactivation','$datetoday')");
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','3','$datetoday','$dateactivation','$datetoday','$price','$vat','$addmonth','$bill_number')");
	$bodycontentnum = 792;
  }elseif($_REQUEST['access_num'] == 4){
  
	$sqlcheckfirst = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."' and session_based=0");
	$rowcheckfirst = mysql_fetch_array($sqlcheckfirst);
	if (mysql_num_rows($sqlcheckfirst) > 0){
		mysql_query("update t_provider_access set session_based=1,session_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
		//mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','3','$datetoday','$dateactivation','$datetoday')");
		$datetoday = date('Y-m-d H:i:s');
		mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','3','$datetoday','$dateactivation','$datetoday','10','$vatx','$addmonth','$bill_number')");
		
		$bodycontentnum = 792;
		//// sending email
		$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
		$to = $row->email;
		$username = $row->firstname;
		$language = $row->language;
		$gender = $row->gender;
		
		$subject = fixEncodingx(translatefields(794));
		$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
		
		$billingtop = "<div style=float:left;><img src='http://manimano.ch/wlw/images/header-logo.png'><br/>".translatefields(820).": CHE-".$rowvat['vat']."<br />DSC GmbH, Postfach 107, 8132 Egg</div>";

		$useraddress = "";
		if ($row->company !=""){
			$useraddress .= fixEncodingx($row->company) . "<br />";
		}	
		$useraddress .= genderfieldonly($row->gender) . "<br />";
		$useraddress .= $row->firstname ." " . $row->lastname . "<br />";
		if ($row->adress1 !=""){
			$useraddress .= fixEncodingx($row->adress1) . "<br />";
		}
		if ($row->adress2 !=""){
			$useraddress .= fixEncodingx($row->adress2) . "<br />";
		}
		
		$sqlcountry = mysql_query("select * from t_country where id='".$row->country."'");
		$rowcountry = mysql_fetch_array($sqlcountry);
		
		if ($row->country != ""){
			$useraddress .= fixEncodingx($rowcountry['long']) . " - ";
		}
		
		if ($row->location !=""){
			$useraddress .= fixEncodingx($row->location) . " ";
		}
		if ($row->zip !=""){
			$useraddress .= fixEncodingx($row->zip) . " ";
		}
		
  
		
	$optionnamex = "Sitzungen – Basis";
  
  
		$bodyemail = $billingtop . fixEncodingx(translatefields($bodycontentnum));
		$bodyemail = str_replace("<firstname> <lastname>,","<div style='float:right;margin-top:10px;text-align:right;'>".$useraddress."</div><br style='clear:both;'><hr><div style=font-weight:bold;font-size:15px;size:15px;>".translatefields(821)."</div>",$bodyemail);
		//in between: title amount option priceeach pricetotal
		$priceinfo = "";
		$priceinfo .="<table style='border:1px solid #eeeeee;border-collapse:collapse;' cellpadding=2 cellspacing=2>";
		$priceinfo .="<tr>";
		$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(822)."</b></td>";
		$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(823)."</b></td>";
		$priceinfo .="<td width=170 align=left style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(824)."</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(825)."</b></td>";
		$priceinfo .="</tr>";
		$subamount = 10 * $addmonth;
		if ($_REQUEST['access_num'] == 4){
			$priceinfo .="<tr>";
			$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$addmonth."</td>";
			$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>10.00</td>";
			$priceinfo .="<td width=130 align=left style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$optionnamex."</b></td>";
			$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($subamount,2)."</td>";
			$priceinfo .="</tr>";
		}else{
			$priceinfo .="<tr>";
			$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$addmonth."</td>";
			$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>10.00</td>";
			$priceinfo .="<td width=130 align=left style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$optionnamex."</b></td>";
			$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($subamount,2)."</td>";
			$priceinfo .="</tr>";
		}
		if ($rowvat['vat']  != "" or $rowvat['vat'] !=0){
		$priceinfo .="<tr>";
		$priceinfo .="<td align=right colspan=3 style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;color:#666666;'><b>".translatefields(820)."(".$rowvat['vat']."%)</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($vatx,2)."</td>";
		$priceinfo .="</tr>";
		}
		$amountx = $subamount + $vatx;
		$amountx = number_format($amountx,2);
		$priceinfo .="<tr>";
		$priceinfo .="<td align=right colspan=3 style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;color:#666666;'><b>".translatefields(826)."</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$amountx."</td>";
		$priceinfo .="</tr>";
		$priceinfo .="</table>";
		
		$thankyou = "<p>".translatefields(827) . "</p>";
		
		$bodyemail = str_replace("<our_footer>",$priceinfo. "" . $thankyou . " ". translatefields(649),$bodyemail);
		$bodyemail = str_replace(",,","",$bodyemail);
		$body = $body . "" . $bodyemail . "</div>";
		
		$from = "info@spiritwings.ch";
		////echo $body;
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from\r\n";
		mail($to,$subject,$body,$headers);
		//echo $body;
		$headers = "";
		$bodyemail = "";
		$body = "";
		$billingtop = "";
		$useraddress = "";
		$priceinfo= "";
		$subamount = "";
		$rowcountry = "";
		$thankyou = "";
	$bill_number = $bill_number + 1;	
	}
	$datetoday = date('Y-m-d H:i:s');
	
	mysql_query("update t_provider_access set session_enhanced=1,session_enhanced_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','4','$datetoday','$dateactivation','$datetoday','$price','$vat','$addmonth','$bill_number')");
	$bill_number = "";
	$bodycontentnum = 793;
  }
 
	//// sending email
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
	$to = $row->email;
	$username = $row->firstname;
	$language = $row->language;
	$gender = $row->gender;
	
	$subject = fixEncodingx(translatefields(794));
	
	$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
		
		$billingtop = "<div style=float:left;><img src='http://manimano.ch/wlw/images/header-logo.png'><br/>".translatefields(820).": CHE-".$rowvat['vat']."<br />DSC GmbH, Postfach 107, 8132 Egg</div>";

		$useraddress = "";
		if ($row->company !=""){
			$useraddress .= fixEncodingx($row->company) . "<br />";
		}	
		$useraddress .= genderfieldonly($row->gender) . "<br />";
		$useraddress .= $row->firstname ." " . $row->lastname . "<br />";
		if ($row->adress1 !=""){
			$useraddress .= fixEncodingx($row->adress1) . "<br />";
		}
		if ($row->adress2 !=""){
			$useraddress .= fixEncodingx($row->adress2) . "<br />";
		}
		
		$sqlcountry = mysql_query("select * from t_country where id='".$row->country."'");
		$rowcountry = mysql_fetch_array($sqlcountry);
		
		if ($row->country != ""){
			$useraddress .= fixEncodingx($rowcountry['long']) . " - ";
		}
		
		if ($row->location !=""){
			$useraddress .= fixEncodingx($row->location) . " ";
		}
		if ($row->zip !=""){
			$useraddress .= fixEncodingx($row->zip) . " ";
		}
		
		$bodyemail = $billingtop . fixEncodingx(translatefields($bodycontentnum));
		$bodyemail = str_replace("<firstname> <lastname>,","<div style='float:right;margin-top:10px;text-align:right;'>".$useraddress."</div><br style='clear:both;'><hr><div style=font-weight:bold;font-size:15px;size:15px;>".translatefields(821)."</div>",$bodyemail);
		//in between: title amount option priceeach pricetotal
		$priceinfo = "";
		$priceinfo .="<table style='border:1px solid #eeeeee;border-collapse:collapse;' cellpadding=2 cellspacing=2>";
		$priceinfo .="<tr>";
		$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(822)."</b></td>";
		$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(823)."</b></td>";
		$priceinfo .="<td width=170 align=left style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(824)."</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #F0F0F0;border: 1px solid #666666;color: #666666;'><b>".translatefields(825)."</b></td>";
		$priceinfo .="</tr>";
		$subamount = $price * $addmonth;
		if ($_REQUEST['access_num'] == 4){
			$priceinfo .="<tr>";
			$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$addmonth."</td>";
			$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>20.00</td>";
			$priceinfo .="<td width=130 align=left style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$optionname."</b></td>";
			$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($subamount,2)."</td>";
			$priceinfo .="</tr>";
		}else{
			$priceinfo .="<tr>";
			$priceinfo .="<td width=50 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$addmonth."</td>";
			$priceinfo .="<td width=75 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>10.00</td>";
			$priceinfo .="<td width=130 align=left style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$optionname."</b></td>";
			$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($subamount,2)."</td>";
			$priceinfo .="</tr>";
		}
		if ($rowvat['vat']  != "" or $rowvat['vat'] !=0){
		$priceinfo .="<tr>";
		$priceinfo .="<td align=right colspan=3 style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;color:#666666;'><b>".translatefields(820)."(".$rowvat['vat']."%)</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".number_format($vat,2)."</td>";
		$priceinfo .="</tr>";
		}
		$priceinfo .="<tr>";
		$priceinfo .="<td align=right colspan=3 style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;color:#666666;'><b>".translatefields(826)."</b></td>";
		$priceinfo .="<td width=70 align=right style='background: none repeat scroll 0 0 #FFFFFF;border: 1px solid #666666;padding: 3px;'>".$amount."</td>";
		$priceinfo .="</tr>";
		$priceinfo .="</table>";
		
		$thankyou = "<p>".translatefields(827) . "</p>";
		
		$bodyemail = str_replace("<our_footer>",$priceinfo. "" . $thankyou . " ". translatefields(649),$bodyemail);
		$bodyemail = str_replace(",,","",$bodyemail);
		$body = $body . "" . $bodyemail . "</div>";
		
		$from = "info@spiritwings.ch";
		////echo $body;
		$headers  = "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
		$headers .= "From: $from\r\n";
		mail($to,$subject,$body,$headers);
		//echo $body;
		$headers = "";
		$bodyemail = "";
		$body = "";
		$billingtop = "";
		$useraddress = "";
		$priceinfo= "";
		$subamount = "";
		$rowcountry = "";
		$thankyou = "";
} else  {
	//echo '<pre>';
	//exit('DoDirectPayment failed: ' . print_r($httpParsedResponseAr, true));
	//header("location: index.php?option=access-test&tobook=".$_REQUEST['access_num']."&error=true");
	//exit('error: '.print_r($httpParsedResponseAr, true));
	$error_message = utf8_encode($httpParsedResponseAr['L_LONGMESSAGE1']);
	$error_message = str_replace('%20',' ',$error_message);
	$error_message = str_replace('%2e','.',$error_message);
	$error_booking =1;
}
if ($error_booking == 1){
	$message_code = 802;
}else{
	$message_code = 795;
}
?>
    <div id="system-message">
    <div class="info">
     <div class="message"><?php echo translatefields($message_code);?> <?php echo $error_message;?></div>
     </div>
     </div>
     <?php } ?>	 
<?php
	$sql_access = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	if (mysql_num_rows($sql_access) < 1){
		$provider_id_admin = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		mysql_query("insert into t_provider_access values('0','$provider_id_admin','0','','0','','0','','0','')");
	}else{
		$row_access = mysql_fetch_array($sql_access);
		$seminar_with_reservation = $row_access['seminar_with_reservation'];
		$swr_expiration_date = $row_access['swr_expiration_date'];
		$seminar_extended = $row_access['seminar_extended'];
		$s_expiration_date = $row_access['s_expiration_date'];
		$session_based = $row_access['session_based'];
		$session_expiration_date = $row_access['session_expiration_date'];
		$session_enhanced = $row_access['session_enhanced'];
		$session_enhanced_expiration_date = $row_access['session_enhanced_expiration_date'];
	}
?>
<script type='text/javascript' src='plugins/jquery/jquery-ui-1.8.17.custom.min.js'></script>
<script type='text/javascript' src='plugins/jquery/jquery.qtip-1.0.0-rc3.min.js'></script>
<script type="text/javascript">
/*function cancelplan(num){
	if (!confirm("<?php echo translatefields(783);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access-test&num_plan='+num+'&task=cancelled';
	}
}*/

function cancelplan(num){
 if (num == 1 || num == 3){
  if (num == 1){
  <?php if ($seminar_extended == 1){ ?>
	if (!confirm("<?php echo translatefields2(799);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access-test&num_plan='+num+'&task=cancelled';
	}
  <?php }else{
  ?>
	if (!confirm("<?php echo translatefields(783);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access-test&num_plan='+num+'&task=cancelled';
	}
  <?php
  } ?>
  }
  if (num == 3){
  <?php if ($session_enhanced == 1){ ?> 
	if (!confirm("<?php echo translatefields2(801);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access-test&num_plan='+num+'&task=cancelled';
	}
  <?php }else{
  ?>
	if (!confirm("<?php echo translatefields(783);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access-test&num_plan='+num+'&task=cancelled';
	}
  <?php
  } ?>
  }
 }else{
	if (!confirm("<?php echo translatefields(783);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access-test&num_plan='+num+'&task=cancelled';
	}
 }
}

function bookplan(num){
  
	$('#months_plan').focus();
	 if (num == 2 || num == 4){
	  if (num == 2){
	  <?php if ($seminar_with_reservation == 0){ ?>
		if (!confirm("<?php echo translatefields2(798);?>")) {
			return false;
		}else{
			//document.location.href ='index.php?option=access-test&num_plan='+num+'&task=booked';
			$('#payform').show();
		  $('#access_num').val(num);
		  
		  if (num == 1){
			$('#plan').val('Seminare – mit Reservation');
			$('#plan').html('Seminare – mit Reservation');
		  }else if (num == 2){
			$('#plan').val('Seminare – erweitert');
			$('#plan').html('Seminare – erweitert');
		  }else if (num == 3){
			$('#plan').val('Sitzungen – Basis');
			$('#plan').html('Sitzungen – Basis');
		  }else if (num == 4){
			$('#plan').val('Sitzungen – erweitert');
			$('#plan').html('Sitzungen – erweitert');
		  }
		}
	  <?php }else{
	  ?>
		//document.location.href ='index.php?option=access-test&num_plan='+num+'&task=booked';
		$('#payform').show();
		  $('#access_num').val(num);
		  if (num == 1){
			$('#plan').val('Seminare – mit Reservation');
			$('#plan').html('Seminare – mit Reservation');
		  }else if (num == 2){
			$('#plan').val('Seminare – erweitert');
			$('#plan').html('Seminare – erweitert');
		  }else if (num == 3){
			$('#plan').val('Sitzungen – Basis');
			$('#plan').html('Sitzungen – Basis');
		  }else if (num == 4){
			$('#plan').val('Sitzungen – erweitert');
			$('#plan').html('Sitzungen – erweitert');
		  }
	  <?php
	  } ?>
	  }
	  if (num == 4){
	  <?php if ($session_based == 0){ ?> 
		if (!confirm("<?php echo translatefields2(800);?>")) {
			return false;
		}else{
			//document.location.href ='index.php?option=access-test&num_plan='+num+'&task=booked';
			$('#payform').show();
		  $('#access_num').val(num);
		  if (num == 1){
			$('#plan').val('Seminare – mit Reservation');
			$('#plan').html('Seminare – mit Reservation');
		  }else if (num == 2){
			$('#plan').val('Seminare – erweitert');
			$('#plan').html('Seminare – erweitert');
		  }else if (num == 3){
			$('#plan').val('Sitzungen – Basis');
			$('#plan').html('Sitzungen – Basis');
		  }else if (num == 4){
			$('#plan').val('Sitzungen – erweitert');
			$('#plan').html('Sitzungen – erweitert');
		  }
		}
	  <?php }else{
	  ?>
		//document.location.href ='index.php?option=access-test&num_plan='+num+'&task=booked';
		$('#payform').show();
		  $('#access_num').val(num);
		  if (num == 1){
			$('#plan').val('Seminare – mit Reservation');
			$('#plan').html('Seminare – mit Reservation');
		  }else if (num == 2){
			$('#plan').val('Seminare – erweitert');
			$('#plan').html('Seminare – erweitert');
		  }else if (num == 3){
			$('#plan').val('Sitzungen – Basis');
			$('#plan').html('Sitzungen – Basis');
		  }else if (num == 4){
			$('#plan').val('Sitzungen – erweitert');
			$('#plan').html('Sitzungen – erweitert');
		  }
	  <?php
	  } ?>
	  }
	 }else{
		//document.location.href ='index.php?option=access-test&num_plan='+num+'&task=booked';
	      $('#payform').show();
		  $('#access_num').val(num);
		  if (num == 1){
			$('#plan').val('Seminare – mit Reservation');
			$('#plan').html('Seminare – mit Reservation');
		  }else if (num == 2){
			$('#plan').val('Seminare – erweitert');
			$('#plan').html('Seminare – erweitert');
		  }else if (num == 3){
			$('#plan').val('Sitzungen – Basis');
			$('#plan').html('Sitzungen – Basis');
		  }else if (num == 4){
			$('#plan').val('Sitzungen – erweitert');
			$('#plan').html('Sitzungen – erweitert');
		  }
	 }

}

// Create the tooltips only on document load
$(document).ready(function() 
{
   // By suppling no content attribute, the library uses each elements title attribute by default
   $('.external-event').qtip({
      content: {
         text: true // Use each elements title attribute
      },
	  position: {corner: {target: 'leftMiddle',tooltip: 'rightMiddle'}},
      style: 'blue'
   });
   
   $.fn.qtip.styles.tipstyle = {
		width: 250,
		padding: 5,
		background: '#eeeeee',
		color: 'black',
		textAlign: 'left',
		border: {
			width: 3,
			radius: 4
		},
		tip: 'leftMiddle',
		name: 'dark'
} 
});
</script>

<?php
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){ // for DE language
?>
	<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat angewendet.
	Die Verrechnung ändern auch auf Ende Monat. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>
	<!--start payment form-->
	<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#payform").validate({
		rules: {
			months_plan: "required",
			cardnumber: "required",
			cardmonth: "required",
			cardmonth: "required"
		},
		messages: {
			months_plan: "",
			cardnumber: "",
			cardmonth: "",
			cardmonth: ""
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else if ( element.is("textarea") )
				error.appendTo ( element.next() );				
				//label.insertAfter(element.next());
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form) {
			$('#loadimage').show();
			form.submit(form);
		}
	});
});

</script>
	<<form name="payform" action="index.php?option=access-test&task=booked" method="post" id="payform" style="display:none;">
		<table class="record-list" width="330">
		<tbody>
			<tr>
				<td><b><?php echo translatefields(803);?></b></td><td><span id="plan" style="font-weight:bold;"></span><input name="access_num" type="hidden" value="" id="access_num" /></td>	
			</tr>
			<tr class="row1">
				<td><b><?php echo translatefields(804);?></b></td><td><input name="months_plan" type="text" value="12" id="months_plan" tabindex="1"/></td>	
			</tr>
			<tr>
				<td><b><?php echo translatefields(805);?></b></td><td>
				<select name="cardtype" tabindex="2">
						<option value="visa" selected="selected">Visa</option>
						<option value="MasterCard">Master Card</option>
						<option value="AmericanExpress">American Express</option>
						</select>
				</td>	
			</tr>
			<tr class="row1">
				<td><b><?php echo translatefields(806);?></b></td><td><input name="cardnumber" type="text" value="4436701199871582" tabindex="3"></td>	
			</tr>
			<tr>
				<td><b><?php echo translatefields(807);?></b> <span style=" font:7pt arial; color:gray;">[ mm / yyyy ]</span></td><td>
				<select name="cardmonth" style="width:45px;" tabindex="4">
						<option value="01">01</option>
						<option value="02">02</option>
						<option value="03">03</option>
						<option value="04">04</option>
						<option value="05">05</option>
						<option value="06">06</option>
						<option value="07" selected="selected">07</option>
						<option value="08">08</option>
						<option value="09">09</option>
						<option value="10">10</option>
						<option value="11">11</option>
						<option value="12">12</option>
						</select>
				&nbsp;
				<input type="text" name="cardyear" class="sel" style=" width:50px;" value="2017" tabindex="5"></td>	
			</tr>
			<tr class="row1">
				<td><div style="float:left;width:130px;"><b><?php echo translatefields(8028);?>Sicherheitsnummer (CCV, hinten)</b></div><div style="float:right;"><a href="images/cvv.jpeg" id="cvv"><img border=0 src="images/cvv.jpeg"  width="30"></div></td><td><input name="cardcvv" type="text" value="" tabindex="6"></a>
				<script>
					$('#cvv').lightBox({
						imageLoading: '<?php echo PLUGINS; ?>jquery/lightbox/images/lightbox-ico-loading.gif',
						imageBtnClose: '<?php echo PLUGINS; ?>jquery/lightbox/images/lightbox-btn-close.gif',
						imageBlank:	'<?php echo PLUGINS; ?>jquery/lightbox/images/lightbox-blank.gif'	
					});
				</script>
				</td>	
			</tr>
			<tr>
				<td></td><td><input type="submit" id="submitpayment" value="<?php echo translatefields(809);?>" class="button" style="float:left;" tabindex="6"> <img id="loadimage" src="images/indicator-lite.gif" style="display:none;float:left;margin-left:5px;"> </td>
			</tr>
		</tbody>
		</table>
	</form>
	<!--end payment form-->
	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
			<th width="100px">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			<tr style="background-color:yellow;">
				<td style="background-color:yellow;">
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td style="background-color:yellow;">Kostenlos</td>
				<td style="background-color:yellow;"></td>
			</tr>
			<tr class="row1">
				<td <?php if ($seminar_with_reservation == 1 and $swr_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(1);"<?php } ?>>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td <?php if ($seminar_with_reservation == 1 and $swr_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(1);" <?php } ?>>10.- / Seminar</td>
				<?php if ($seminar_with_reservation == 1 and $swr_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(1);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="bookplan(1)" class="button" id="book1" /></td>
				<?php
				}?>
			</tr>
			<tr>
				<td <?php if ($seminar_extended == 1 and $s_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(2);" <?php } ?>>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td <?php if ($seminar_extended == 1 and $s_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(2);" <?php } ?>>10.- / Seminar</td>
				
				<?php if ($seminar_extended == 1 and $s_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(2);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="bookplan(2)" class="button" id="book2"/></td>
				<?php
				}?>
			</tr>
			<tr class="row1">
				<td <?php if ($session_based == 1 and $session_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(3);" <?php } ?>>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td <?php if ($session_based == 1 and $session_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(3);" <?php } ?>>10.-/Monat</td>
				
				<?php if ($session_based == 1 and $session_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(3);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="bookplan(3)" class="button" id="book3"/></td>
				<?php
				}?>
			</tr>
			<tr>
				<td <?php if ($session_enhanced == 1 and $session_enhanced_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(4);" <?php } ?>>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td <?php if ($session_enhanced == 1 and $session_enhanced_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(4);" <?php } ?>>20.-/Monat</td>
				<?php if ($session_enhanced == 1 and $session_enhanced_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(4);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="bookplan(4)" class="button" id="book4"/></td>
				<?php
				}?>
			</tr>
		</tbody>
	</table>
<?php
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){  // for ENG language
?>
	<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat in 3 Monaten angewendet.
	Die Verrechnung ändern auch auf Ende Monat in 3 Monaten. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td>Kostenlos</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr>
				<td>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td>10.-/Monat</td>
			</tr>
			<tr>
				<td>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td>20.-/Monat</td>
			</tr>
		</tbody>
	</table>
<?php
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){  // for FR language
?>
<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat in 3 Monaten angewendet.
	Die Verrechnung ändern auch auf Ende Monat in 3 Monaten. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td>Kostenlos</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr>
				<td>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td>10.-/Monat</td>
			</tr>
			<tr>
				<td>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td>20.-/Monat</td>
			</tr>
		</tbody>
	</table>
<?php
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){  // for IT language
?>
<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat in 3 Monaten angewendet.
	Die Verrechnung ändern auch auf Ende Monat in 3 Monaten. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td>Kostenlos</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr>
				<td>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td>10.-/Monat</td>
			</tr>
			<tr>
				<td>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td>20.-/Monat</td>
			</tr>
		</tbody>
	</table>
<?php
}
?>

	
	
</div>   	
   <style>
table.record-list {
	margin-top: 0.5em;
	/*border-spacing: 1px;*/
	background-color: #999;
	color: #666;
	border: #666 solid 1px;
	border-collapse: collapse;	
}

table.record-list td{ padding: 4px;}

table.record-list th { padding: 4px; font-size:14px;size:14px;}

table.record-list thead th {
	text-align: left;
	background: #f0f0f0;
	color: #666;
	border: 1px solid #666;
}

table.record-list thead a:hover { text-decoration: none; }

table.record-list thead th img { vertical-align: middle; }
table.record-list tbody th { font-weight: bold; }

table.record-list tbody tr { background-color: #fff;  text-align: left; }
table.record-list tbody tr.row1 { background: #f9f9f9; border-top: 1px solid #fff; }

table.record-list tbody tr.row0:hover td,
table.record-list tbody tr.row1:hover td { background-color: #ffd ; }

table.record-list tbody tr td  { height: 20px; background: #fff; border: 1px solid #666; padding: 3px; }
table.record-list tbody tr.row1 td { background: #f9f9f9; border-top: 1px solid #fff; }

table.record-list tfoot tr { text-align: left;  color: #333; }
table.record-list tfoot td,
table.record-list tfoot th { background-color: #f3f3f3; border-top: 1px solid #666; text-align: left; }

table.record-list td.order { text-align: center; white-space: nowrap; }
table.record-list td.order span { float: left; display: block; width: 20px; text-align: center; }

table.record-list .paginationB { display:table; padding:0;  margin:0 auto; }

table.record-list td.sub-total { text-align: right; font-weight: bold; font-size: 1em; }
table.record-list td.grand-total { text-align: right; font-weight: bold; font-size: 1.2em; background-color: #CCCCCC; color: #333333; }
</style>
