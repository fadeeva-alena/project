<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME?></title>
<link rel="icon" href="images/favicon.ico" type="image/x-icon" />
<link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
<link href="<?php echo CSS?>core.css" rel="stylesheet" type="text/css" />
<link href="<?php echo CSS?>general.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGINS?>jquery/jquery.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo JS?>/forgotpassword.js" type="text/javascript" language="Javascript"></script>
</head>
<body>
<div id="login-container">	
  	<div class="login-content"> 
        <form method="post" id="frmForgotPassword" action="">
            <div class="login-content-main">	
                <div class="login-logo"><img src="images/login-logo.png" /></div>
                <h2>Password Sent</h2>
               
                <label>Please check your email for your password.</label>
               
                
				
				 <div class="send-button">
				 <br />
				 <div style="float:left;margin-top:4px;">
					<a href="index.php?option=login">Back to login?</a>&nbsp;
				</div>
				 </div>
				 
                <div id="login-indicator">
                    <span id="login-indicator-msg" style="display:none"></span>
                </div>
				
                <div class="clr"></div>
                
            </div>
        </form>
        <div id="login-credit"><?php echo $conf['website']['copyright']?></div>
       
        <div class="clr"></div>
    </div>
</div>
</body>
</html>
