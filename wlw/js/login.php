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
		$('#useradded').html('');
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
					<?php if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 4) {?>
				 	document.location='index.php?option=translations';
					<?php } else{
						if ($_REQUEST['option'] == "login" or $_REQUEST['option'] == "logout" or $_REQUEST['option'] == ""){
					?>
						document.location='index.php?option=events';
					<?php
						}else{
					?>
						document.location='index.php?option=<?php echo $_REQUEST['option'];?>';
					<?php
						}
					}?>
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