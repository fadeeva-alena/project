
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color:white;background:url('none');">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<meta http-equiv="content-type" content="text/html; charset=UTF-8">-->
<title><?php echo WEBSITE_NAME; ?></title>
<link rel="icon" href="images/favicon.ico" />
<link href="<?php echo CSS; ?>core.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGINS; ?>jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.validate.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.form.js" type="text/javascript" language="Javascript"></script>
<?php include("plugins/jquery/flexigrid/flexigrid.php");?>
<!--<script src="<?php //echo PLUGINS; ?>jquery/ui-lightness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>-->
<script src="<?php echo PLUGINS; ?>jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>
<!--<script src="<?php echo PLUGINS; ?>tiny_mce/tiny_mce.js" type="text/javascript" language="Javascript"></script>-->
<script type="text/javascript">
function nospaces(t){
if(t.value.match(/\s/g)){
t.value=t.value.replace(/\s/g,'');
}
}
</script>
<script src="<?php echo JS?>popup.js" type="text/javascript" language="Javascript"></script>

<script type="text/javascript"> 
	$(document).ready(function(){ 
		$(function(){
			$('ul.sf-menu').superfish();
		});
		
	}); 
</script>
<?php
	if ($_GET['option'] == "" or $_GET['option'] == "login" or $_GET['option'] == "events-calendar"){
		?>
		<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ">/*** EasyGoogleMap Class by: Mitchelle Pascual ***/</script>
		<?php
		
	}
?>
<link href="plugins/jquery/facebox/facebox.css" media="screen" rel="stylesheet" type="text/css"/>
<script src="plugins/jquery/facebox/facebox.js" type="text/javascript"></script> 
<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox({
        loadingImage : 'plugins/jquery/facebox/loading.gif',
        closeImage   : 'plugins/jquery/facebox/closelabel.png'
      })
    })
  </script>
</head>
<body>
<!--
<?php if ($_GET['wide'] != "small"){?>
<div id="container">
<?php } else {?>
<div id="container" style="width:700px;" class="containerclass">
<?php } ?>
-->
<table cellpadding="0" cellspacing="0" style="margin:0 auto;width:100%;">