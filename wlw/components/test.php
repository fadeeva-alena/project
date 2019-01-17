<?php
	include ("iCal.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>iCal Test</title>
</head>

<body>
<?php

	//$firstname is the first name of target
	//$lastname is the last name of target
	//$email is the targets email address
	//$meeting_date is straight from a DATETIME mysql field and assumes UTC.
	//$meeting_name is the name of your meeting
	//$meeting_duretion is the duration of your meeting in seconds (3600 = 1 hour)
	$firstname = "John";
	$lastname = "Smith";
	$email = "kendeguzman@gmail.com";
	$meeting_date = "2010-07-06 13:40:00"; //mysql format
	$meeting_name = "Hello";
	$meeting_duration = 3600;

	//returns true or false
	$result = sendIcalEmail($firstname,$lastname,$email,$meeting_date,$meeting_name,$meeting_duration);
	
	//display result
	if($result) {
		echo "Email sent successfully.";
	} else {
		echo "A problem occured sending email";
	}   
		
?>
</body>
</html>
