<?php
require_once ( '../includes/config.php' );
require_once ( '../'.PATH_LIBRARIES.'libraries.php' );
$is_editable_field = $helper->is_editable("edit");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background-color:white;background:url('none');">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<!--<meta http-equiv="content-type" content="text/html; charset=UTF-8">-->
<title><?php echo WEBSITE_NAME; ?></title>
<link href="../<?php echo CSS; ?>core.css" rel="stylesheet" type="text/css" />
<script src="../<?php echo PLUGINS; ?>jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<script src="../<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="../<?php echo PLUGINS; ?>jquery/jquery.validate.js" type="text/javascript" language="Javascript"></script>
<script src="../<?php echo PLUGINS; ?>jquery/jquery.form.js" type="text/javascript" language="Javascript"></script>
<?php include("../plugins/jquery/flexigrid/flexigrid.php");?>
<!--<script src="<?php //echo PLUGINS; ?>jquery/ui-lightness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>-->
<script src="../<?php echo PLUGINS; ?>jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="../<?php echo PLUGINS; ?>jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="../<?php echo PLUGINS; ?>jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="../<?php echo PLUGINS; ?>jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>
<!--<script src="../<?php echo PLUGINS; ?>tiny_mce/tiny_mce.js" type="text/javascript" language="Javascript"></script>-->
<script type="text/javascript">
function nospaces(t){
if(t.value.match(/\s/g)){
t.value=t.value.replace(/\s/g,'');
}
}
</script>
<script src="../<?php echo JS?>popup.js" type="text/javascript" language="Javascript"></script>

<script type="text/javascript"> 
	$(document).ready(function(){ 
		$(function(){
			$('ul.sf-menu').superfish();
		});
		
	}); 
</script>
<fieldset class="standard-form">
<table class="form-table">            	
<tr>
                    <td class="key" valign="top"><label for="location"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=45");
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
		?><?php
		$sqlfield = mysql_query("select * from t_field_names where id=7");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$helptext = $rowfield['helptext_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$helptext = $rowfield['helptext_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$helptext = $rowfield['helptext_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$helptext = $rowfield['helptext_it'];
		}
		if ($helptext == "0" or $helptext ==""){
			$helptext = "";
		}else{
			$helptext = $helptext;
		}
		?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	
		<script type='text/javascript' src='../js/autocomplete.js'></script>

<script type="text/javascript">
$().ready(function() {

	function log(event, data, formatted) {
		$("<li>").html( !data ? "No match!" : "Selected: " + formatted).appendTo("#result");
	}
	
	function formatItem(row) {
		return row[0] + " (<strong>id: " + row[1] + "</strong>)";
	}
	function formatResult(row) {
		return row[0].replace(/(<.+?>)/gi, '');
	}
	/*$("#zip").autocomplete("search.php", {
		width: 267,
		selectFirst: false
	});*/
	
	var locsuggest = [
		<?php
		$countlocation = 0;
		$query = mysql_query("SELECT id,loc_name,loc_detail,loc_adress1,loc_adress2,loc_zip,loc_loc from t_location
				  order by loc_name asc");
		$numlocation = mysql_num_rows($query);
			while ($result = mysql_fetch_assoc($query)) {
			$countlocation++;
				$locid = fixEncoding($result[id]);
				$locsuggest = fixEncoding($result[loc_name] . " " . $result[loc_detail] . " " .$result[loc_adress1]. " " . $result[loc_adress2] . " " .$result[loc_zip]. " " . $result[loc_loc]);
			if ($numlocation == $countlocation){	
		?>
		{ locid: "<?php echo utf8_encode($locid);?>", location: "<div style=float:left;width:35;margin:right:10px;><img width=30px src=../uploads/132103348325000400_thumb.png> </div><div style=float:left;> <?php echo utf8_encode($locsuggest);?></div>", locationvalue: "<?php echo utf8_encode($locsuggest);?>" }
		<?php
			}else{
		?>
		{ locid: "<?php echo utf8_encode($locid);?>", location: "<div style=float:left;width:35;margin:right:10px;><img width=30px src=../uploads/132103348325000400_thumb.png> </div><div style=float:left;> <?php echo utf8_encode($locsuggest);?></div>" , locationvalue: "<?php echo utf8_encode($locsuggest);?>"},
		<?php
			}
		}
		?>
	];	
	
	$("#location").autocomplete(locsuggest, {
		minChars: 0,
		autoFill: false,
		formatItem: function(row, i, max) {
			return row.location;
		},
		formatMatch: function(row, i, max) {
			return row.locationvalue;
		},
		formatResult: function(row) {
			return row.locationvalue;
		}
	});
	//$("#location").autocomplete(locsuggest);
	$("#location").result(function(event, row, formatted) {
		
		$('#clone_zip').html(row.locationvalue);
		var r = $('#clone_zip');
		
		r.text(r.html());
		r.html(r.text());
		$('#zip').val($('#clone_zip').html());	
		
	});
});

</script>
					
					
					
<style>
	.ac_results {
	padding: 0px;
	border: 1px solid black;
	background-color: white;
	overflow: hidden;
	z-index: 99999;
	width: 430px !important;
	margin-top:-20px;
	margin-left:192px;
}

.ac_results ul {
	
	width: 430px !important;
	list-style-position: outside;
	list-style: none;
	padding: 0;
	margin: 0;
	
	
}

.ac_results li {
	margin: 0px;
	padding: 2px 5px;
	cursor: default;
	display: block;
	/* 
	if width will be 100% horizontal scrollbar will apear 
	when scroll mode will be used
	*/
	/*width: 100%;*/
	font: menu;
	font-size: 12px;
	/* 
	it is very important, if line-height not setted or setted 
	in relative units scroll will be broken in firefox
	*/
	line-height: 16px;
	overflow: hidden;
	width: 400px !important;
}

.ac_results img {
	padding-right:5px;
}

.ac_loading {
	background: white url('../images/loader.gif') right center no-repeat;
}

.ac_odd {
	background-color: #eee;
}

.ac_over {
	background-color: #0A246A;
	color: white;
}

</style>
				<input type="text" id="location" name="location" style="width:190px;" maxlength="150" value="<?php echo fixEncoding($location)?>"/>
		
		
		
                       
						</td>
                    <?php } else { ?>
                    <td><?php echo $location?></td>
                    <?php } ?>                                                                                                    
                </tr>
				</table>
			</fieldset>