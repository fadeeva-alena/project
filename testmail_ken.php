<?php
if($_POST["SendMail"] == "Abschicken")
{
$to = trim($_POST['visitormail']); 
$subject = 'testemail';

$headers = "From: " . "ManiMano@manimano.ch" . "\n";
$headers .= "Reply-To: ". "ManiMano@manimano.ch" . "\n";

$headers .= "MIME-Version: 1.0\n";
$headers .= "Content-type: text/html; charset=iso-8859-1\n";
$message = '<!DOCTYPE html>
						<html xmlns="http://www.w3.org/1999/xhtml">
						<head>
						<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
						</head><body>';
$message .= '<h1>Test HTML email!</h1><br><u>Underline</u><br><b>Bold</b><br><font color=red>color: red</font>';
$message .= '</body></html>';

mb_internal_encoding("UTF-8");
mb_send_mail($to, $subject, $message, $headers);
//mail($to, $subject, $message, $headers);
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>test e-mail</title>
<link href="style.css" rel="stylesheet" type="text/css" />
</head>

<body class="all">
  <div class="mainContent">
	<div class="content">
		          
<form id="form1" name="form1" method="post" action="testmail_ken.php" onsubmit="return verifyformachka();">

		              <table>
		  		                <tr>
		                  <td>Email:</td>
		                  <td><input type="text" name="visitormail"   Value="<?php echo"$visitormail";?>" /></td>
	                    </tr>
	                <tr>
		                  <td colspan="2">
                                                      <p><input type="submit" name="SendMail" id="abschickenbtn" value="Abschicken" /></p>
                          </td>

</tr>
		               	                  </table>
		            </form>
                  </li>
	            </ol>
                        </div>
  </div>
</div>
<script type="text/javascript">

var formachka = document.getElementById('form1');

function verifyformachka() {

	
	
	reg = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
	if (!formachka["visitormail"].value.match(reg)) {

		alert("Bitte überprüfen Sie Ihre Email-Adresse - diese scheint uns fehlerhaft zu sein.");
		formachka["visitormail"].focus();
		return false;
	}
	
	


}	
	
</script>
</body>
</html>
