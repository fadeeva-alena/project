<?php
	error_reporting(0);
	session_start();
	require_once ( 'includes/config.php' );
	require_once ( 'libraries/libraries.php' );
//$_SESSION[WEBSITE_ALIAS]['language']
		$locationlist = "";
		$queryloc = mysql_query("SELECT distinct(Location),ZIP from t_zipch
				 group by Location order by Location asc");
			
		$countloc = 0;
		$numrows = mysql_num_rows($queryloc);
		if($queryloc) {
		
		while ($resultloc = mysql_fetch_assoc($queryloc)) {
		$countloc++;	
				
				$key = fixEncoding($resultloc[Location]);
				if ($countloc != $numrows){
					$locationlist .= '"'.utf8_decode($key).'",';
				}else{
					$locationlist .= '"'.utf8_decode($key).'"';
				}
			}
		}
		
	?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background:none;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME; ?></title>
<link rel="icon" href="images/favicon.ico" />
<link href="<?php echo CSS; ?>core.css" rel="stylesheet" type="text/css" />
	
<!--<script src="<?php echo JS; ?>login.js" type="text/javascript" language="Javascript"></script>-->
<?php
	$sqlfield = mysql_query("select * from t_field_names where id=288");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$validating = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$validating = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$validating = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$validating = $rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=289");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$loggingin = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$loggingin = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$loggingin = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$loggingin = $rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=290");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$failed = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$failed = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$failed = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$failed = $rowfield['fieldname_it'];
	}
?>
<script>
$(document).ready(function()
{
  settings = {
	  tl: { radius: 10 },
	  tr: { radius: 10 },
	  bl: { radius: 10 },
	  br: { radius: 10 },
	  antiAlias: true,
	  autoPad: true,
	  validTags: ["div"]
  }
  var myBoxObject = new curvyCorners(settings, "login-content");
  myBoxObject.applyCornersToAll();
});

$(document).ready(function()
{
	$("#frmLogin").submit(function()
	{
		//Remove all the class add the messagebox classes and start fading
		$("#login-indicator-msg").removeClass().addClass('login-msg-process').text('<?php echo $validating;?>').fadeIn(1000);
		//Check the "username" if exists or not from ajax
		$.post("components/login-process.php",{ username:$('#username').val(),password:$('#password').val(),rand:Math.random() } ,function(data)
        {		  
		  if(data=='yes') //if correct login detail
		  {
		  	$("#login-indicator-msg").fadeTo(200,0.1,function()  { //start fading the messagebox
			  	//Add message and change the class of the box and start fading
			  	$(this).html("<?php echo $loggingin;?>").addClass('login-msg-valid').fadeTo(900,1,
              	function() { 
			  		//Redirect to secure page	
					//http://localhost/json/display-event.php?events_id=3275&titlecolor=000000&bgcolor=FFFFFF&titlebgcolor=CCCCCC&tablegrid=CCCCCC
					
					
	
					
				 	document.location='display-event.php?events_id=<?php echo $_GET['events_id'];?>&titlecolor=<?php echo $_GET['titlecolor'];?>&bgcolor=<?php echo $_GET['bgcolor'];?>&titlebgcolor=<?php echo $_GET['titlebgcolor'];?>&tablegrid=<?php echo $_GET['tablegrid'];?>';
					
			  	});			  
			});
		  }else if(data=='blocked'){
			$("#login-indicator-msg").fadeTo(200,0.1,function() { //start fading the messagebox
				$("#login-indicator-msg").removeClass()
			  	//Add message and change the class of the box and start fading
			  	$(this).html('Unable to login, your account was BLOCKED!').addClass('login-msg-error').fadeTo(900,1);
			});		
          }else if(data=='inactive'){
			$("#login-indicator-msg").fadeTo(200,0.1,function() { //start fading the messagebox
				$("#login-indicator-msg").removeClass()
			  	//Add message and change the class of the box and start fading
			  	$(this).html('Unable to login, your account was IN-ACTIVE!').addClass('login-msg-error').fadeTo(900,1);
			});		
          }
		  else {
			$("#login-indicator-msg").fadeTo(200,0.1,function() { //start fading the messagebox
				$("#login-indicator-msg").removeClass()
			  	//Add message and change the class of the box and start fading
			  	$(this).html("<?php echo $failed;?>").addClass('login-msg-error').fadeTo(900,1);
			});		
          }
	
        });		
 		return false; //Not to post the form physically
	});

});
</script>
</head>
<body style="background:none;">
<table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;">


<tr>
<style>
	html,body{background:none;}
	a.yellowcolor{color:#FFFD5F;}
	a:hover.yellowcolor{color:#FFFD5F;text-decoration:underline;}
</style>
<td style="background:url('images/headerbg.png');border:0px solid red;height:163px;padding:0px;">
	<center><img src="images/login-for-logo.png" style="height:60px;margin-top:10px;"/></center>
	<form method="post" id="frmLogin" action="" style="padding:0px;margin:0px;">
		<div align="center" style="margin-top:0px;color:white;margin-top:10px;">
				
             <label><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=198");
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
		?></b></label>
                <input class="text-field" id="username" name="username" type="text" maxlength="30" style="width:80px;"/>
				&nbsp;&nbsp;
                <label><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=55");
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
		?></b></label>
                <input class="text-field" id="password" name="password" type="password" maxlength="30" style="width:80px;" /> <br /><input class="button" name="Login" type="submit" value="<?php
		$sqlfield = mysql_query("select * from t_field_names where id=197");
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
		?>" style="margin-top:10px;"/>&nbsp;
				
				
		</div>
			<table cellpadding="0" cellspacing="0" width="100%" style="margin:0 auto;">
				<tr>
				
					<td align="center">
						<div style="text-align:center;width:100%;margin-top:5px;"><center>
						<span id="login-indicator-msg" style="padding-top:10px;float:none;display:none;text-align:center;color:white;margin:0px;"></span></center>
						</div>
					</td>
				</tr>
			</table>
		
		
		
	</form>


</td>	
</tr>
</table>
</body>
</html>
