<?php
error_reporting(0);
session_start();
$mode = "view";
if ($_SESSION['provider'] == ""){
 $_SESSION['provider'] = 1;
	$_SESSION[WEBSITE_ALIAS]['user_level']    	= 1;
	$_SESSION[WEBSITE_ALIAS]['language']    	= 1;
}


// Retrieve record
//if(!empty($id) || $id != '') :
if ($_REQUEST['datetocheck']!= ""){
	$datetocheck= $_REQUEST['datetocheck'];
}else{
	$datetocheck= date('Y-m-d');
}	
require_once ( 'includes/config.php' );
require_once ( PATH_LIBRARIES.'libraries.php' );

//////////////////////////////////for the filter sorting
	if ($_GET['loc_loc']!="" or $_GET['loc_zip'] !=""){
         $currentaddress = $_GET['loc_loc'] . " " . $_GET['loc_zip'];
         $currentlonglat = getLatLong($currentaddress);
         $currentlong = $currentlonglat['long'];
         $currentlat = $currentlat['lat'];
         
         
         $ctr = 0;
		$rows = "";
         $sql = mysql_query("select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}')");
         while ($row = mysql_fetch_array($sql)){
         $ctr++;
         $address = $row['loc_adress1'] . " " . $row['loc_adress2'] . " " . $row['loc_loc'] . " " . $row['loc_zip'] . " " . $row['long'];
	
		
         $longlat = getLatLong($address);
         $eventlat = $longlat['lat'];
         $eventlong = $longlat['long'];
         $distance = number_format(distance($eventlat, $eventlong,$currentlat, $currentlong, 'm'),2);
         //echo $row['eid']."|".$distance ."~~";
	 $myarray[$row[eid]][distance];
         if (mysql_num_rows($sql) == $ctr){
            $rows .= $row['eid'] . ":" .$distance."";
         }else{
            $rows .= $row['eid'] . ":" .$distance .":";
         }
         }
	   $data = explode(":", $rows);
           $num = count($data);

           if ($num % 2 || ! $num) {
               return false;
           }

           for ($i = 0; $i < $num / 2; $i++) {
               $ret[$data[$i * 2]] = $data[$i * 2 + 1];
           }
           //print_r($ret);

	  $reverse = array_reverse($ret, true);
          //print_r($reverse);
	
	$counter = 0;
	$keys = "";
	  foreach ($reverse as $key => $val) {
		$counter++;
		if (mysql_num_rows($sql) == $counter){
    		$keys .= $key;
		}else{
		$keys .= $key .",";
		}
	  }
	}
if ($_GET['loc_loc']!="" or $_GET['loc_zip'] !=""){
	$where = " id IN ($keys) and";
	$order = " ORDER BY FIND_IN_SET(id, '$keys')";
}	  
$qry2 = mysql_query("select * from t_event e inner join t_dates d
								on e.id=d.events_id where id IN ($keys) ORDER BY FIND_IN_SET(id, '$keys')");
/*while ($rowqry = mysql_fetch_array($qry2)){
	echo $rowqry['id'] . "<br />";
}*/




if (isset($_GET['quality']) and $_GET['quality'] != ""){$getquality = " and quality='".$_GET['quality']."'";}
if (isset($_GET['quality']) and ($_GET['quality'] == "0")){$getquality = "";}
$sqlevent = mysql_query("select *,e.id as eid from t_event e inner join t_dates d
								on e.id=d.events_id where $where (events_start_date <= '{$datetocheck}' and events_end_date >= '{$datetocheck}') $getquality GROUP BY e.id $order");
//echo "select * from t_event where $where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') $getquality $order";
//echo "select * from t_event where $where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') $getquality $order";
//echo "select * from t_event where (date_start >= '{$datetocheck}' and date_end <= '{$datetocheck}') $getquality";

?>
<div style="float:left;">
<!--<script src="<?php echo PLUGINS; ?>jquery/jquery-1.3.2.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.validate.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.form.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/smoothness/jquery-ui-1.7.2.custom.min.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/lightbox/jquery.lightbox.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/superfish.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/superfish/hoverIntent.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo JS?>popup.js" type="text/javascript" language="Javascript"></script>
<script src="plugins/jquery/fancybox/jquery.fancybox-1.3.1.js" type="text/javascript" language="Javascript"></script>
<link href="plugins/jquery/fancybox/jquery.fancybox-1.3.1.css" rel="stylesheet" type="text/css" /> -->
<style>



div.toggle a{padding:0px;text-decoration:none;font-weight:bold;clear:both;}

</style>
<script type="text/javascript">
	$(document).ready(function() {
        function toggleDiv(divid){

            var div = document.getElementById(divid);
			$('.panel').hide();
            div.style.display = div.style.display == 'block' ? 'none' : 'block';

            }
		/*	
		$("a.#modalpopup1,a.#modalpopup2").fancybox({
		'titlePosition'	: 'inside',
		'transitionIn'	: 'none',
		'transitionOut'	: 'none'
		});*/
	})
    </script>
	<!--<script>
	$(document).ready(function() {
	$(".togx").click(function () {
		
		
	})
	})
</script>-->

<h1><?php 

$currentmonthtext = date('F',strtotime($datetocheck));



if ($currentmonthtext == "January"){
								$sqlfield = mysql_query("select * from t_field_names where id=176");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "February"){
								$sqlfield = mysql_query("select * from t_field_names where id=177");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "March"){
								$sqlfield = mysql_query("select * from t_field_names where id=178");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "April"){
								$sqlfield = mysql_query("select * from t_field_names where id=179");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "May"){
								$sqlfield = mysql_query("select * from t_field_names where id=180");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "June"){
								$sqlfield = mysql_query("select * from t_field_names where id=181");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "July"){
								$sqlfield = mysql_query("select * from t_field_names where id=182");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "August"){
								$sqlfield = mysql_query("select * from t_field_names where id=183");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "September"){
								$sqlfield = mysql_query("select * from t_field_names where id=184");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "October"){
								$sqlfield = mysql_query("select * from t_field_names where id=185");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "November"){
								$sqlfield = mysql_query("select * from t_field_names where id=186");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}elseif ($currentmonthtext == "December"){
								$sqlfield = mysql_query("select * from t_field_names where id=187");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo utf8_encode($rowfield['fieldname_de']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  utf8_encode($rowfield['fieldname_eng']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   utf8_encode($rowfield['fieldname_fr']);
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   utf8_encode($rowfield['fieldname_it']);}
							}
							echo date(' d, Y',strtotime($datetocheck));
?>

</h1>

<table style="margin-bottom:10px;">
	<?php
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=1");		
		$qty1 = mysql_fetch_array($rs);
		$quality1 = $qty1['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=2");		
		$qty2 = mysql_fetch_array($rs);
		$quality2 = $qty2['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=3");		
		$qty3 = mysql_fetch_array($rs);
		$quality3 = $qty3['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=4");		
		$qty4 = mysql_fetch_array($rs);
		$quality4 = $qty4['quality_eng'];	
	}
	
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_eng'];	
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
		$rs = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."quality where id=5");		
		$qty5 = mysql_fetch_array($rs);
		$quality5 = $qty5['quality_eng'];	
	}
	?>
	<tr>
		<td colspan="6" style="padding-bottom:5px;">
			<script type='text/javascript' src='js/autocomplete.js'></script>
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
	$("#zip").autocomplete("search.php", {
		width: 267,
		selectFirst: false
	});
	$("#zip").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			var fetch = new String(data[1]);
						var fetchlist = fetch.split('~');
						
						if (fetchlist[0] == "undefined"){
							$('#zip').val('');
						}else{
							$('#zip').val(fetchlist[0]);
						}
						
						if (fetchlist[1] == "undefined"){
							$('#location').val('');
						}else{
							$('#location').val(fetchlist[1]);
						}
			$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;>...</div>');
			$.ajax({
			  url: "components/display-events.php?datetocheck=<?php echo $datetocheck?>&loc_zip="+fetchlist[1]+"&loc_loc="+fetchlist[0]+"&quality=<?php echo $_GET['quality'];?>",
			  cache: false,
			  success: function(html){
				$('#loadingprocessing').html('');
				$('#load-desc').show();
				$("#load-desc").html(html);
			  }
			})
	});
	$("#location").autocomplete("search2.php", {
		width: 267,
		selectFirst: false
	});
	$("#location").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			var fetch = new String(data[1]);
						var fetchlist = fetch.split('~');
						
						if (fetchlist[0] == "undefined"){
							$('#zip').val('');
						}else{
							$('#zip').val(fetchlist[0]);
						}
						
						if (fetchlist[1] == "undefined"){
							$('#location').val('');
						}else{
							$('#location').val(fetchlist[1]);
						}
			$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;>...</div>');
			$.ajax({
			  url: "components/display-events.php?datetocheck=<?php echo $datetocheck?>&loc_zip="+fetchlist[1]+"&loc_loc="+fetchlist[0]+"&quality=<?php echo $_GET['quality'];?>",
			  cache: false,
			  success: function(html){
				$('#loadingprocessing').html('');
				$('#load-desc').show();
				$("#load-desc").html(html);
			  }
			})
	});
	
	$("#location").blur(function() 
    { 
        var location = $("#location").val(); 
        
        if (location == ""){
            $("#zip").val('');
		}
    }); 
    
    $("#zip").blur(function() 
    { 
        var zip = $("#zip").val(); 
        
        if (zip == ""){
            $("#location").val('');
		}
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
}

.ac_results ul {
	
	width: 100%;
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
}

.ac_loading {
	background: white url('images/loader.gif') right center no-repeat;
}

.ac_odd {
	background-color: #eee;
}

.ac_over {
	background-color: #0A246A;
	color: white;
}

</style>
				<?php
		function getLatLong($address){
         if (!is_string($address))die("All Addresses must be passed as a string");
         $_url = sprintf('http://maps.google.com/maps?output=js&q=%s',rawurlencode($address));
         $_result = false;
         if($_result = file_get_contents($_url)) {
         if(strpos($_result,'errortips') > 1 || strpos($_result,'Did you mean:') !== false) return false;
         preg_match('!center:\s*{lat:\s*(-?\d+\.\d+),lng:\s*(-?\d+\.\d+)}!U', $_result, $_match);
         $_coords['lat'] = $_match[1];
         $_coords['long'] = $_match[2];
         }
         return $_coords;
         }
         
         function distance($lat1, $lon1, $lat2, $lon2, $unit) {
         $theta = $lon1 - $lon2;
         $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
         $dist = acos($dist);
         $dist = rad2deg($dist);
         $miles = $dist * 60 * 1.1515;
         $unit = strtoupper($unit);
         
         if ($unit == "K") {
         return ($miles * 1.609344);
         } else if ($unit == "N") {
         return ($miles * 0.8684);
         } else {
         return $miles;
         }
         }		
				
		/*		
		$sqlfield = mysql_query("select * from t_field_names where id=63");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			echo $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			echo $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			echo $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			echo $rowfield['fieldname_it'];
		}*/
		?> 
		
		<!--<input type="text" id="zip" name="zip" style="width:50px;" maxlength="150" value="<?php echo $_GET['loc_loc'];?>"/>&nbsp;-->
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=7");
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
		?>&nbsp;<input type="text"  autocomplete="off" name="location" id="location" size="10" maxlength="150" value="<?php echo htmlentities($_GET['loc_zip'])?>" />
		<span style="color:#eeeeee;font-size:18px;size:18px;"></span>
		</td>
		
		
	</tr>
	<script>
function PopupCenter(pageURL, title,w,h) {
var left = (screen.width/2)-(w/2);
var top = (screen.height/2)-(h/2);
var targetWin = window.open (pageURL, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
} 

function openCenteredWindow(url) {
    var width = 400;
    var height = 300;
    var left = parseInt((screen.availWidth/2) - (width/2));
    var top = parseInt((screen.availHeight/2) - (height/2));
    var windowFeatures = "width=" + width + ",height=" + height + ",status,resizable,left=" + left + ",top=" + top + "screenX=" + left + ",screenY=" + top;
    myWindow = window.open(url, "subWind", windowFeatures);
}


</script>
	<tr>
		<td>
		<!--
		<a style="cursor:pointer;" onclick="getquality(0)"><span <?php if ($_GET['quality']==0 or $_GET['quality']==""){echo 'style="opacity:0.5;font-weight:bold;"';}?>><span style="font-size:15px;text-decoration:underline;"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=295");
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
		?></span></span></a>
		-->
		</td>
		<td><a style="cursor:pointer;" onclick="getquality(1)" alt="<?php echo $quality1?>" title="<?php echo $quality1?>"><img src="images/1.png"<?php if ($_GET['quality']==1){echo 'style="opacity:0.1;border:2px solid darkblue;"';}?>></a></td>
		<td><a style="cursor:pointer;" onclick="getquality(2)" alt="<?php echo $quality2?>" title="<?php echo $quality2?>"><img src="images/2.png"<?php if ($_GET['quality']==2){echo 'style="opacity:0.1;border:2px solid darkblue;"';}?>></a></td>
		<td><a style="cursor:pointer;" onclick="getquality(3)" alt="<?php echo $quality3?>" title="<?php echo $quality3?>"><img src="images/3.png"<?php if ($_GET['quality']==3){echo 'style="opacity:0.1;border:2px solid darkblue;"';}?>></a></td>
		<td><a style="cursor:pointer;" onclick="getquality(4)" alt="<?php echo $quality4?>" title="<?php echo $quality4?>"><img src="images/4.png"<?php if ($_GET['quality']==4){echo 'style="opacity:0.1;border:2px solid darkblue;"';}?>></a></td>
		<td><a style="cursor:pointer;" onclick="getquality(5)" alt="<?php echo $quality5?>" title="<?php echo $quality5?>"><img src="images/5.png"<?php if ($_GET['quality']==5){echo 'style="opacity:0.1;border:2px solid darkblue;"';}?>></a></td>
	</tr>
</table>
<div id="loadingprocessing" style="background-color:white;float:left;margin-bottom:5px;" align="center"></div> 
<script>
	<?php if ($_GET['loc_zip'] != ""){$loczipparam = "&loc_zip=".$_GET['loc_zip'];}?>
	<?php if ($_GET['loc_loc'] != ""){$loclocparam = "&loc_loc=".$_GET['loc_loc'];}?>
	function getquality(quality) {
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;>...</div>');
		//$('#load-desc').hide();
		$.ajax({
		  url: "components/display-events.php?datetocheck=<?php echo $datetocheck?><?php echo $loczipparam?><?php echo $loclocparam?>&quality="+quality,
		  cache: false,
		  success: function(html){
			$('#loadingprocessing').html('');
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})
	}
</script>
<?php
while ($rowevent = mysql_fetch_array($sqlevent)){

	$title = $rowevent['title'];
	$kind = $rowevent['kind'];
	$type = $rowevent['type'];
	$short_desc = $rowevent['short_desc'];
	$long_desc = $rowevent['long_desc'];
	$location = $rowevent['location'];
	$price = $rowevent['price'];
	$currency = $rowevent['currency'];
	$remark_price = $rowevent['remark_price'];
	$remark_prerequisite = $rowevent['remark_prerequisite'];
	$eve_contact_name = $rowevent['eve_contact_name'];
	$eve_contact_phone = $rowevent['eve_contact_phone'];
	$eve_contact_email = $rowevent['eve_contact_email'];
	$eve_contact_url = $rowevent['eve_contact_url'];
	$eve_loc = $rowevent['eve_loc'];
	$eve_image_path = $rowevent['eve_image_path'];
	$provider = $rowevent['provider'];
	$timestamp = $rowevent['timestamp'];
	$last_change = $rowevent['last_change'];
	
	$date_start = $rowevent['date_start'];
	$date_end = $rowevent['date_end'];
	
	$date_start = date('d.m.Y',strtotime($rowevent['date_start']));
	$date_end = date('d.m.Y',strtotime($rowevent['date_end']));
	
	$date_remark = $rowevent['date_remark'];
	$time_start = $rowevent['time_start'];
	$time_end = $rowevent['time_end'];
	$remark_time = $rowevent['remark_time'];
	$leader = $rowevent['leader'];
	
	$quality = $rowevent['quality'];

	$sql_sys = mysql_query("select * from t_sys");
	$row_sys = mysql_fetch_array($sql_sys);
	
	$grid_max_x = $row_sys['pics_in_grid_max_x'];
	$grid_max_y = $row_sys['pics_in_grid_max_y'];
	$detail_max_x = $row_sys['pics_in_detail_max_x'];
	$detail_max_y = $row_sys['pics_in_detail_max_y'];
	
	if ($eve_image_path != ""){
        	$path = "../uploads/".$eve_image_path;
			list($widthimage, $heightimage, $types, $attr) = getimagesize($path);
			
			
			if ($widthimage >= $detail_max_x){
				$widthimage = $detail_max_x;
				$heightimage = "";
			}else{
				$widthimage = $widthimage;
			}
			
	
        	$design_photo_img = '<img src="uploads/'.$eve_image_path.'" border="0" width='.$widthimage.'>';
        }else{
        	$design_photo_img = '';
        }
		$ctr++;
?>

<div class="toggle" style="clear:both;">- <a style="font-weight:bold;font-size;13px;" class="togx" href="javascript:toggleDiv('panel<?php echo $ctr;?>');" ><?php echo utf8_encode($title);?></a></div>



<div style="width:400px;<?php if (mysql_num_rows($sqlevent) > 1){?>display:none;<?php } ?>margin-top:5px;" id="panel<?php echo $ctr;?>" class="panel">
	
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <fieldset class="standard-form" style="width:370px;">
            <legend><?php
		$sqlfield = mysql_query("select * from t_field_names where id=230");
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
		?></legend>
            <table class="form-table" style="width:370px;">   
				
				<?php if ($kind != ""){?>
				<tr>
					 <td class="key"><label for="kind">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=3");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					 <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$value_display['display'] = "kind_de";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_de asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$value_display['display'] = "kind_eng";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_eng asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$value_display['display'] = "kind_fr";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_fr asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$value_display['display'] = "kind_it";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_kind order by kind_it asc");		
					}
					
					
					echo $scaffold->dropdown_rs($rs,$value_display,"kind",$kind,"","");
					?>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($kind != ""){
					$sql1 = mysql_query("select * from t_event_kind where id='".$kind."'");
					$row1 = mysql_fetch_array($sql1);
					//echo $row1['kind_eng'];
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						echo utf8_encode($row1['kind_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo utf8_encode($row1['kind_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo utf8_encode($row1['kind_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo utf8_encode($row1['kind_it']);
					}
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				<?php
				}
				if ($type != ""){
				?>
				<tr>
					 <td class="key"><label for="type">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=4");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					 <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$value_display['display'] = "eventtype_de";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_de asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$value_display['display'] = "eventtype_eng";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_eng asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$value_display['display'] = "eventtype_fr";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_fr asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$value_display['display'] = "eventtype_it";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."event_type  order by eventtype_it asc");		
					}
					
					
					echo $scaffold->dropdown_rs($rs,$value_display,"type",$type,"","");
					?>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($type != ""){
								 
					$sql1 = mysql_query("select * from t_event_type where id='".$type."'");
					$row1 = mysql_fetch_array($sql1);
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						echo utf8_encode($row1['eventtype_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo utf8_encode($row1['eventtype_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo utf8_encode($row1['eventtype_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo utf8_encode($row1['eventtype_it']);
					}
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				<?php
				}
				if ($quality != ""){
				?>
				<tr>
					 <td class="key"><label for="type"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=75");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td valign="middle"><?php
					$value_display['value'] = "id";
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$value_display['display'] = "quality_de";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_de asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$value_display['display'] = "quality_eng";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_eng asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$value_display['display'] = "quality_fr";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_fr asc");		
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$value_display['display'] = "quality_it";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."quality  order by quality_it asc");		
					}
					
					
					echo $scaffold->dropdown_rs($rs,$value_display,"quality",$quality,"","style=width:100px;float:left;margin-top:6px;");
					?><div id="image-icon" style="float:left;margin-left:5px;">
						<?php
							
								echo '<img src=images/'.$quality.'.png width=30px height=30px>';
							
						?>
					</div>
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td>
					<div style="float:left;margin-top:6px;">
					<?php 
								 if ($quality != ""){
					$sql1 = mysql_query("select * from t_quality where id='".$quality."'");
					$row1 = mysql_fetch_array($sql1);
					
					
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						echo utf8_encode($row1['quality_de']);	
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						echo utf8_encode($row1['quality_eng']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						echo utf8_encode($row1['quality_fr']);
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						echo utf8_encode($row1['quality_it']);
					}
					
							
								echo '</div><div style=float:left;margin-left:4px;>&nbsp;<img src=images/'.$quality.'.png width=30px height=30px></div>';
							
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
			<?php
				}
				if ($short_desc != ""){
				?>	
				<tr>
                    <td class="key"><label for="short_desc">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=5");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="short_desc" id="short_desc" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($short_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($short_desc);?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($long_desc != ""){
				?>
				<tr>
                    <td class="key"><label for="long_desc">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=6");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="long_desc" id="long_desc" style="width:267px;height:auto;min-height:80px;"><?php echo htmlentities($long_desc)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($long_desc);?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($location != ""){
				?>	
				<tr>
					 <td class="key"><label for="location">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=7");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					 <?php echo $req_fld?></label></td>
					 <?php if ( $is_editable_field ) { ?>
					<td><?php
					$value_display['value'] = "id";
					$value_display['display'] = "locname";
					
					if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 1 or $_SESSION[WEBSITE_ALIAS]['user_level'] == 3)
					{	
						$userlevelgain ="";
					}else{
						$userlevelgain =" where provider='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'";
					}
					$rs = $db->get_results("SELECT id,concat(loc_name ,', ',loc_detail) as locname  FROM ".DB_TABLE_PREFIX."location order by loc_name asc");		
					
					echo $scaffold->dropdown_rs($rs,$value_display,"location",$location,"","");
					?> Not in the list? Click <a href="index2.php?option=locations2-m&mode=add" id="modalpopup1">
					<a href="javascript:void(0);" onclick="PopupCenter('index2.php?option=leaders2-m&mode=view&view=view&id=<?php echo $leader;?>', 'myPop1',1000,500);" id="modalpopup2">
					here</a>.
					<span class="validation-status"></span> </td>
					<?php } else { ?>
					<td><?php 
								 if ($location != ""){
					$sql1 = mysql_query("select * from t_location where id='".$location."'");
					$row1 = mysql_fetch_array($sql1);
					?>
					<a href="javascript:void(0);" onclick="PopupCenter('index2.php?option=locations2-m&mode=view&view=view&id=<?php echo $location;?>', 'myPop1',1000,500);" id="modalpopup1">
					
				<?php
				echo utf8_encode($row1['loc_name'] . " " .$row1['loc_detail']);
				echo '</a>';
					
					//echo utf8_encode($row1['loc_name'] . " " .$row1['loc_detail']);
					
				}else{
					echo "";
				}
					?></td>
					<?php } ?>
				</tr>
				<?php
				}
				if ($price != ""){
				?>
				
				<tr>
                    <td class="key"><label for="price">
					<?php
						$sqlfield = mysql_query("select * from t_field_names where id=8");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
					<?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="price" id="price" size="50" maxlength="150" value="<?php echo htmlentities($price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $price?>
					<?php
					$sql1 = mysql_query("select * from t_currency where id='".$currency."'");
					$row1 = mysql_fetch_array($sql1);
					echo " " . $row1['currency'];
					?>
					</td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($remark_price != ""){
				?>
				
				<tr>
                    <td class="key"><label for="remark_price"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=10");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_price" id="remark_price" size="50" maxlength="150" value="<?php echo htmlentities($remark_price)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($remark_price)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($remark_prerequisite != ""){
				?>
				<tr>
                    <td class="key"><label for="remark_prerequisite"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=11");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<textarea name="remark_prerequisite" id="remark_prerequisite" style="width:267px;height:auto;min-height:50px;"><?php echo htmlentities($remark_prerequisite)?></textarea>
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($remark_prerequisite)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				
				?>
				<tr>
                    <td class="key"></td>
                    
                    <td>
                    <?php 
					
					$sqlfield = mysql_query("select * from t_field_names where id=12");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$startdatelabel = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$startdatelabel =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$startdatelabel =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$startdatelabel =$rowfield['fieldname_it'];
	}
	
	$sqlfield = mysql_query("select * from t_field_names where id=13");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$enddatelabel = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$enddatelabel = $rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$enddatelabel = $rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$enddatelabel = $rowfield['fieldname_it'];
	}
					
	$sql = mysql_query("select * from t_dates where events_id='".$rowevent['eid']."'");
	
	
	$ctr = 0;
	$num_rows = mysql_num_rows($sql);
	
	$num_rows++;
	echo "<span class='validation-status'></span>&nbsp;&nbsp;";
	echo "<div style='float:left;margin-left:14px;width:85px;border:0px solid red;'><b>".$startdatelabel."</b></div>";
	echo "<div style='float:left;margin-left:4px;width:85px;border:0px solid red;'><b>".$enddatelabel."</b></div><br style=clear:both;>";
	while ($size_row = mysql_fetch_array($sql)){
	$ctr++;
	
	
	echo '<div style="padding:0px;">';
	
	$eventsid = $size_row['id'];
	$size_id = $size_row['size_id'];
	
	$sqlfield = mysql_query("select * from t_field_names where id=273");
	$rowfield = mysql_fetch_array($sqlfield);
	if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
	$delete = $rowfield['fieldname_de'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
	$delete =$rowfield['fieldname_eng'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
	$delete =$rowfield['fieldname_fr'];
	}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
	$delete =$rowfield['fieldname_it'];
	}
	
	
	
	
	echo "<div style='float:left;margin-left:14px;width:85px;border:0px solid red;'>".date('m.d.Y',strtotime($size_row['events_start_date']))."</div>";
	echo "<div style='float:left;margin-left:4px;width:85px;border:0px solid red;'>".date('m.d.Y',strtotime($size_row['events_end_date']))."</div><br style=clear:both;>";
	}	
	?>					
					</td>
                    
                </tr>
				<?php
				if ($date_remark != ""){
				?>
				<tr>
                    <td class="key"><label for="date_remark"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=16");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="date_remark" id="date_remark" size="50" maxlength="150" value="<?php echo htmlentities($date_remark)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($date_remark)?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($time_start != "00:00:00"){
				?>
				<tr>
                    <td class="key"><label for="time_start"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=19");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="time_start" id="time_start"  size="50" maxlength="150" value="<?php echo htmlentities($time_start)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php 
					echo $time_start?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($time_end != "00:00:00"){
				?>
				<tr>
                    <td class="key"><label for="time_end"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=20");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="time_end" id="time_end" size="50" maxlength="150" value="<?php echo htmlentities($time_end)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo $time_end?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<?php
				}
				if ($remark_time != ""){
				?>
				<tr>
                    <td class="key"><label for="remark_time"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=21");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="remark_time" id="remark_time" size="50" maxlength="150" value="<?php echo htmlentities($remark_time)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($remark_time)?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($leader != ""){
				?>	
				
				<tr>
       			 <td class="key"><label for="leader"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=23");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> <?php echo $req_fld?></label></td>
       			 <?php if ( $is_editable_field ) { ?>
        		<td><?php
				$value_display['value'] = "id";
				$value_display['display'] = "companyname";
				$rs = $db->get_results("SELECT *,concat(company ,' ',firstname, ' ',lastname) as companyname FROM ".DB_TABLE_PREFIX."leader   order by lastname asc");		
				echo $scaffold->dropdown_rs($rs,$value_display,"leader",$leader,"","");
				?>Not in the list? Click <a href="index2.php?option=leaders2-m&mode=add" id="modalpopup2">here</a>.
          		<span class="validation-status"></span> </td>
        		<?php } else { ?>
        		<td><?php 
                             if ($leader != ""){
				$sql1 = mysql_query("select * from t_leader where id='".$leader."'");
				$row1 = mysql_fetch_array($sql1);
				?>
				<a href="javascript:void(0);" onclick="PopupCenter('index2.php?option=leaders2-m&mode=view&view=view&id=<?php echo $leader;?>', 'myPop1',1000,400);" id="modalpopup2">
				<?php
				echo utf8_encode($row1['company'] . " ".$row1['firstname'] . " ".$row1['lastname']);
				echo '</a>';
			}else{
				echo "";
}
				?></td>
        		<?php } ?>
      		</tr>
			
		<?php
				}
				if ($eve_contact_name != ""){
				?>
			
				
	  
		<tr>
                    <td class="key"><label for="eve_contact_name"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=24");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_name" id="eve_contact_name" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_name)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($eve_contact_name)?></td>
                    <?php } ?>                                                                                                    
                </tr>
	  
			<?php
				}
				if ($eve_contact_phone != ""){
				?>
		        <tr>
                    <td class="key"><label for="eve_contact_phone"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=25");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_phone" id="eve_contact_phone" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_phone)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo utf8_encode($eve_contact_phone)?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($eve_contact_email != ""){
				?>
				<tr>
                    <td class="key"><label for="eve_contact_email"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=26");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_email" id="eve_contact_email" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_email)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo "<a href=mailto:".utf8_encode($eve_contact_email).">" .utf8_encode($eve_contact_email). "</a>";?></td>
                    <?php } ?>                                                                                                    
                </tr>
			<?php
				}
				if ($eve_contact_url != ""){
				?>	
				<tr>
                    <td class="key"><label for="eve_contact_url"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=27");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?> </label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="eve_contact_url" id="eve_contact_url" size="50" maxlength="150" value="<?php echo htmlentities($eve_contact_url)?>" />
                        <span class="validation-status"></span></td>
                    <?php } else { ?>
                    <td><?php echo "<a target=_blank href=".utf8_encode($eve_contact_url).">" .utf8_encode($eve_contact_url)?></a></td>
                    <?php } ?>                                                                                                    
                </tr>
				
				<?php
				}
				if ($eve_image_path != ""){
				?>
				<tr>
        <td class="key"><label for="design_photo"><?php
						$sqlfield = mysql_query("select * from t_field_names where id=28");
						$rowfield = mysql_fetch_array($sqlfield);
						if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
							echo utf8_encode($rowfield['fieldname_de']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
							echo utf8_encode($rowfield['fieldname_eng']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
							echo utf8_encode($rowfield['fieldname_fr']);
						}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
							echo utf8_encode($rowfield['fieldname_it']);
						}
					?>
          
          </label></td>
        <?php if ( $is_editable_field ) { ?>
        <td><?php if ($mode=='edit') echo $design_photo_img."<p>" ?>
          <input name="eve_image_path" id="eve_image_path" type="file" size="35" />
          <span class="validation-status"></span>
          <?php if ($mode=='edit') echo "</p>" ?>
        </td>
        <?php } else { ?>
        <td><?php echo $design_photo_img?></td>
        <?php } ?>
      </tr>
			<?php
				}
			?>
	  
				
                
				
            </table>        	
      </fieldset>   
<br />	  
</div>
<?php
}
?>        
      

</div>

<?php
require('includes/EasyGoogleMap.class.php');
$gm = & new EasyGoogleMap("ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ");
$gm->SetMarkerIconStyle('FLAG');
$gm->SetMarkerIconColor('GRANITE_PINE');
/*
$gm->SetMarkerIconStyle('FLAG');
$gm->SetMarkerIconStyle('GT_FLAT'); # default
$gm->SetMarkerIconStyle('GT_PILLOW');
$gm->SetMarkerIconStyle('HOUSE');
$gm->SetMarkerIconStyle('PIN');
$gm->SetMarkerIconStyle('PUSH_PIN');
$gm->SetMarkerIconStyle('STAR');

$gm->SetMarkerIconColor('PACIFICA'); # default
$gm->SetMarkerIconColor('YOSEMITE');
$gm->SetMarkerIconColor('MOAB');
$gm->SetMarkerIconColor('GRANITE_PINE');
$gm->SetMarkerIconColor('DESERT_SPICE');
$gm->SetMarkerIconColor('CABO_SUNSET');
$gm->SetMarkerIconColor('TAHITI_SEA');
$gm->SetMarkerIconColor('POPPY');
$gm->SetMarkerIconColor('NAUTICA');
$gm->SetMarkerIconColor('DEEP_JUNGLE');
$gm->SetMarkerIconColor('SLATE');
*/
$gm->SetMapZoom(10);
$sql = mysql_query("select *,e.id as eid from t_event e inner join t_location l on l.id=e.location
inner join t_dates d on e.id=d.events_id
  where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}') GROUP BY e.id");
 
 $address = "";
 while ($row = mysql_fetch_array($sql)){
 $ctr++;
 $address1 = $row['loc_adress1'] . ' ' . $row['loc_adress2'] . ' ' . $row['loc_loc'] . ' ' . $row['loc_zip'] . ' ' . $row['long'];
 $address .= "<b>".$row['title'] ."</b><br />";
 $address .= $row['loc_adress1'] . '<br />' . $row['loc_adress2'] . '<br />' . $row['loc_loc'] . ' ' . $row['loc_zip'] . ' ' . $row['long'];

$gm->SetAddress(utf8_encode($address1));
$gm->SetInfoWindowText(utf8_encode($address));
//$gm->SetSideClick(utf8_encode($row[title] . "----"));
}

for ($i=0;$i<=10;$i++){
if ($i == 1){
$addressx = "Quezon City Philippines";
}elseif ($i == 2){
$addressx = "Metro Manila Philippines";
}
//$gm->SetAddress($addressx);
//$gm->SetInfoWindowText($addressx);
}
/*
$gm->SetAddress("Manila, Philippines");
$gm->SetInfoWindowText("This is Philippine Country.");
$gm->SetSideClick('Philippines');*/
?>
<div style="float:right;border:1px solid #eeeeee;width:300px;margin-left:5px;height:auto;margin-top:5px;">
<?php echo $gm->GmapsKey(); ?>
<?php echo $gm->MapHolder(); ?>
<?php echo $gm->InitJs(); ?>
<?php //echo $gm->GetSideClick(); ?>
<?php echo $gm->UnloadMap(); ?>	
</div>
</div>

<br style="clear:both;">

