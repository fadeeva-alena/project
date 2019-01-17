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
	
	$sqlfield = mysql_query("select * from t_field_names where id=291");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$sending = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$sending = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$sending = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$sending = $rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=292");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$invalid = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$invalid = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$invalid = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$invalid = $rowfield['fieldname_it'];
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
	$("#frmForgotPassword").submit(function()
	{
		//Remove all the class add the messagebox classes and start fading
		$("#login-indicator-msg").removeClass().addClass('login-msg-process').text('<?php echo $validating;?>').fadeIn(1000);
		//Check the "username" if exists or not from ajax
		$.post("components/forgotpassword-process.php",{ email:$('#email').val(),rand:Math.random() } ,function(data)
        {
		  if(data=='yes') //if correct login detail
		  {
		  	$("#login-indicator-msg").fadeTo(200,0.1,function()  { //start fading the messagebox
			  	//Add message and change the class of the box and start fading
			  	$(this).html('<?php echo $sending;?>').addClass('login-msg-valid').fadeTo(900,1,
              	function() { 
			  		//Redirect to secure page
					$("#login-indicator-msg").removeClass()
					//$(this).html('Please check your email for password!').addClass('login-msg-valid').fadeTo(900,1);
				 	document.location='index.php?option=passwordsent';
			  	});			  
			});
		  } else {
			$("#login-indicator-msg").fadeTo(200,0.1,function() { //start fading the messagebox
				$("#login-indicator-msg").removeClass()
			  	//Add message and change the class of the box and start fading
			  	$(this).html('<?php echo $invalid;?>').addClass('login-msg-error').fadeTo(900,1);
			});		
          }
	
        });		
 		return false; //Not to post the form physically
	});

});
</script>