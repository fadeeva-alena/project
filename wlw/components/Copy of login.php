<?php
	error_reporting(0);
	session_start();
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" style="background:none;">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title><?php echo WEBSITE_NAME; ?></title>
<link href="<?php echo CSS; ?>core.css" rel="stylesheet" type="text/css" />
<script src="<?php echo PLUGINS; ?>jquery/jquery.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo PLUGINS; ?>jquery/jquery.curvycorners.js" type="text/javascript" language="Javascript"></script>
<!--<script src="<?php echo JS; ?>login.js" type="text/javascript" language="Javascript"></script>-->
<?php include ("js/login.php");?>

		<script type="text/javascript" src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAAeBDLZGUuiGrIgPKp6YuwtRT5MoiPrgpfFZhovXyJmCX8voTzBhSN7DHdnMesYK8pqOoeMGIn_PsfRQ">/*** EasyGoogleMap Class by: Mitchelle Pascual ***/</script>

</head>
<body style="background:none;">
<div id="login-container" style="width:740px;height:200px;">	
  	<div class="login-content"  style="width:740px;height:200px;"> 
        <form method="post" id="frmLogin" action="">
            <div class="login-content-main">
				<div align="center">
            	<div class="login-logo" style="font-size:27px;font-weight:bold;color:#3861B5;margin-bottom:5px;"><img src="images/login-for-logo.png" /></div>
</div>	
<br style="clear:both;">			
<div align="float:left;padding-top:30px;">
				<a href="index.php?option=login&language=1"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo ' style="font-weight:bold;"';}?>>De.</a> |
				<a href="index.php?option=login&language=2"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo ' style="font-weight:bold;"';}?>>En.</a> |
				<a href="index.php?option=login&language=3"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo ' style="font-weight:bold;"';}?>>Fr.</a> |
				<a href="index.php?option=login&language=4"<?php if ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo ' style="font-weight:bold;"';}?>>It.</a>
			
				&nbsp;&nbsp;
					<!--<h2 style="font-size:20px;padding:0px;margin:0px;"><?php
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
		?></h2>
				</div>
                <div style="float:left;margin-left:40px;margin-top:18px;border:0px solid red;width:220px;">
				<?php
		$sqlfield = mysql_query("select * from t_field_names where id=200");
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
		?>-->
				
                
             <label><?php
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
		?></label>
                <input class="text-field" id="username" name="username" type="text" maxlength="30" style="width:90px;"/>
				&nbsp;&nbsp;
                <label><?php
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
		?></label>
                <input class="text-field" id="password" name="password" type="password" maxlength="30" style="width:90px;" /> &nbsp;<input class="button" name="Login" type="submit" value="<?php
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
		?>" />&nbsp;
				
				
                <a href="index.php?option=forgotpassword"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=201");
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
		?></a> | <a href="index.php?option=users&mode=add"><?php
		$sqlfield = mysql_query("select * from t_field_names where id=202");
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
		?></a>
		
		</div>
		
		<div id="login-indicator" style="width:100%;height:100px;padding-bottom:10px;margin-bottom:20px;">
                    <span id="login-indicator-msg" style="display:none;width:700px;"></span>
                </div>	
		
		</div>
		
		
            
        </form>
        
    </div>

</div>	
<table width="990px" style="margin:0 auto;margin-top:0px;margin-top:-40px;border:0px solid red;">
	<tr>
	<td>
		<div style="float:left;width:215px;border:0px solid red;margin-top:-40px;">
			<?php
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){// de
			?>
				<span style="font-size:17px;font-weight:bold;">Auswahl</span><br />
				<ul>
					<li>W�hle das <b>Datum</b>.</li>
					<li>Und filtere nach den gew�nschten <b>Qualit�ten</b>.</li>
					<li>Stell die Stadt ein, die Ergebnisse werden nach Distanz aufgef�hrt.</li>
				</ul>
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){ // eng
			?>
				<span style="font-size:17px;font-weight:bold;">Calendar</span><br />
				<ul>
					<li>Choose the <b>Date</b> here.</li>
					<li>And filter for the qualities, if you like.</li>
					<li>Choose the town, the results are sorted by distance � the closest first.</li>
				</ul>
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){ // fr
			?>
				<span style="font-size:17px;font-weight:bold;">Calendar</span><br />
				<ul>
					<li>Choose the <b>Date</b> here.</li>
					<li>And filter for the qualities, if you like.</li>
					<li>Choose the town, the results are sorted by distance � the closest first.</li>
				</ul>
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){ // it
			?>
				<span style="font-size:17px;font-weight:bold;">Calendar</span><br />
				<ul>
					<li>Choose the <b>Date</b> here.</li>
					<li>And filter for the qualities, if you like.</li>
					<li>Choose the town, the results are sorted by distance � the closest first.</li>
				</ul>
			<?php
			}
			?>
		</div>
		<div style="float:left;width:400px;border:0px solid red;margin-left:10px;margin-top:-40px;">
			<?php
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){// de
			?>
				<span style="font-size:17px;font-weight:bold;">Detail</span><br />
				<ul>
					<li>Hier siehst Du Details der Veranstaltung.</li>
					<li>Klicke auf Ort f�r Details zum Ort.</li>
					<li>Klicke auf Leitung f�r Details zur Leitung.</li>
				</ul>
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){ // eng
			?>
				<span style="font-size:17px;font-weight:bold;">Detail</span><br />
				<ul>
					<li>Here you see the details of the event.</li>
					<li>Click on location to see details.</li>
					<li>Click on leader to see details.</li>
				</ul>
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){ // fr
			?>
				<span style="font-size:17px;font-weight:bold;">Detail</span><br />
				<ul>
					<li>Choose the <b>Date</b> here.</li>
					<li>And filter for the qualities, if you like.</li>
					<li>Choose the town, the results are sorted by distance � the closest first.</li>
				</ul>
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){ // it
			?>
				<span style="font-size:17px;font-weight:bold;">Detail</span><br />
				<ul>
					<li>Choose the <b>Date</b> here.</li>
					<li>And filter for the qualities, if you like.</li>
					<li>Choose the town, the results are sorted by distance � the closest first.</li>
				</ul>
			<?php
			}
			?>
		</div>
		<div style="float:left;width:300px;border:0px solid red;margin-left:17px;margin-top:-40px;">
			<?php
			if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){// de
			?>
				<span style="font-size:17px;font-weight:bold;">Lage</span><br /><br />
				Hier siehst Du die geographische Lage. Du kannst die Karte ziehen, vergr�ssern und verkleinern. 
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){ // eng
			?>
				<span style="font-size:17px;font-weight:bold;">Map</span><br /><br />
				Here you see the location on the map. You can drag the map and adjust  the size.
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){ // fr
			?>
				<span style="font-size:17px;font-weight:bold;">Lage</span><br /><br />
				Hier siehst Du die geographische Lage. Du kannst die Karte ziehen, vergr�ssern und verkleinern. 
			<?php
			}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){ // it
			?>
				<span style="font-size:17px;font-weight:bold;">Lage</span><br /><br />
				Hier siehst Du die geographische Lage. Du kannst die Karte ziehen, vergr�ssern und verkleinern. 
			<?php
			}
			?>
		</div>
	</td>
	</tr>
	</table>
<table width="990px" style="margin: 0 auto;clear:both;">
	

	<tr>
		<td>
				<?php
		//check if time is set in the URL
		if(isset($_GET['time'])){
			$time = $_GET['time'];
		}
		else{
			$time = time();
		}

		$today = date("Y/n/j", time());

		$current_month = date("n", $time);

		$current_year = date("Y", $time);

		$currentmonthtext = date('F',$time);
		$current_month_text = date("F Y", $time);

		$total_days_of_current_month = date("t", $time);

		

		//query the database for events between the first date of the month and the last of date of month
		
		
		

		$first_day_of_month = mktime(0,0,0,$current_month,1,$current_year);

		//geting Numeric representation of the day of the week for first day of the month. 0 (for Sunday) through 6 (for Saturday).
		$first_w_of_month = date("w", $first_day_of_month);

		//how many rows will be in the calendar to show the dates
		$total_rows = ceil(($total_days_of_current_month + $first_w_of_month)/7);

		//trick to show empty cell in the first row if the month doesn't start from Sunday
		$day = -$first_w_of_month;


		$next_month = mktime(0,0,0,$current_month+1,1,$current_year);
		$next_month_text = date("F \'y", $next_month);

		$previous_month = mktime(0,0,0,$current_month-1,1,$current_year);
		$previous_month_text = date("F \'y", $previous_month);

		$next_year = mktime(0,0,0,$current_month,1,$current_year+1);
		$next_year_text = date("F \'y", $next_year);

		$previous_year = mktime(0,0,0,$current_month,1,$current_year-1);
		$previous_year_text = date("F \'y", $previous_year);
	?>
	
	
	<div style="float:left;">
	<script type="text/javascript">

        function toggleDiv(divid){

            var div = document.getElementById(divid);
			
            div.style.display = div.style.display == 'block' ? 'none' : 'block';

            }

	function displaydesc(datetocheck) {
		
		$('#load-desc').hide();
		$.ajax({
		  url: "components/display-events.php?datetocheck="+datetocheck,
		  cache: false,
		  success: function(html){
			
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})
	}
	</script>
	<?php
	$currentmonth = date('Y-m');
	if ($_GET['time'] !=""){
		$comparemonth = date('Y-m',$_GET['time']);
	}else{
		$comparemonth = $currentmonth;
	}
	if (($currentmonth == $comparemonth)){
?>	

	<script>
	$(document).ready(function(){
		//$('#load-desc').load("components/display-events.php?datetocheck=<?php echo date('Y-m-d');?>");
	});
	</script>
<?php
	}
?>
	<table width="180" height="100px" style="font-size:11px;size:11px;margin-top:-3px;margin-left:0px;">
	<tr>
		<td height="5px;"></td>
	</tr>
	<tr>
		<td>
			
			
			<table cellspacing="0" width="180" height="100px" class="calendar" cellspacing="3" cellpadding="3px" style="background-color:white;font-size:11px;border-collapse:collapse;border:1px solid #010102;" border="1">
				<tr style="background-color:#595A5A;color:white;height:20px;border:0px;">
					
					<td colspan="7">
						<table width="100%">
							<tr>
								<td><a style="color:white;text-decoration:none;font-size:13px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $previous_year?>" title="<?php echo $previous_year_text?>">&laquo;&laquo;</a></td>
					<td><a style="color:white;text-decoration:none;font-size:13px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $previous_month?>" title="<?php echo $previous_month_text?>">&laquo;</a></td>
					<td colspan="3" align="center"><div style="font-size:13px;font-weight:bold;">
						<?php 
							if ($currentmonthtext == "January"){
								$sqlfield = mysql_query("select * from t_field_names where id=176");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "February"){
								$sqlfield = mysql_query("select * from t_field_names where id=177");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "March"){
								$sqlfield = mysql_query("select * from t_field_names where id=178");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "April"){
								$sqlfield = mysql_query("select * from t_field_names where id=179");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "May"){
								$sqlfield = mysql_query("select * from t_field_names where id=180");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "June"){
								$sqlfield = mysql_query("select * from t_field_names where id=181");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "July"){
								$sqlfield = mysql_query("select * from t_field_names where id=182");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "August"){
								$sqlfield = mysql_query("select * from t_field_names where id=183");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "September"){
								$sqlfield = mysql_query("select * from t_field_names where id=184");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "October"){
								$sqlfield = mysql_query("select * from t_field_names where id=185");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "November"){
								$sqlfield = mysql_query("select * from t_field_names where id=186");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}elseif ($currentmonthtext == "December"){
								$sqlfield = mysql_query("select * from t_field_names where id=187");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
							}
							
							echo " " . $current_year;
						?>
					</div></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $next_month?>" title="<?php echo $next_month_text?>">&raquo;</a></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=login&time=<?php echo $next_year?>" title="<?php echo $next_year_text?>">&raquo;&raquo;</a></td>
							</tr>
						</table>
					</td>
					
					
												
				</tr>
				
				<tr style="font-weight:bold;font-size:11px;">
					<th width="15%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=194");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=188");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=189");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=190");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=191");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="14%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=192");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
					<th width="15%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=193");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
				</tr>
				
				<tr>
					<?php
					for($i=0; $i< $total_rows; $i++)
					{
						for($j=0; $j<7;$j++)
						{
							$day++;					
							
							if($day>0 && $day<=$total_days_of_current_month)
							{
								$datetocheck = "";
								echo '<td align="right" style="font-weight:bold;font-size:14px;padding-right:10px;">';
								
								$datetocheck = "$current_year-$current_month-$day";
								$sqlevent = mysql_query("select * from t_event e inner join t_dates d
								on e.id=d.events_id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}') 
								
								");
								
								
								if (mysql_num_rows($sqlevent) > 0){
									echo "<a style=cursor:pointer; onclick=displaydesc('".$datetocheck."')>" .$day."</a>";
								}else{
									echo $day;
								}
								
								echo "</td>";
							}
							else 
							{
								//showing empty cells in the first and last row
								echo '<td class="padding">&nbsp;</td>';
							}
						}
						echo "</tr><tr>";
					}
					
					?>
				</tr>
				
			</table>

		</td>
	</tr>
	
	</table>
	</div>
	
	<div style="float:left;border:0px solid red;margin-top:0px;width:720px;margin-left:10px;" id="load-desc">
		<?php include "components/display-events2.php";?>
	</div>
		</td>
	</tr>
</table>
<br style="clear:both;" />
</body>
</html>
