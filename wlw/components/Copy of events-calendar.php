<?php
	error_reporting(0);
	session_start();
     $grid_id = $page_name;
     $target_url = INDEX_PAGE.$page_option.'-m&mode=';
     ?>
     <h1><?php echo $page_heading?></h1>
     
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
	<table width="990px" style="margin: 0 auto;clear:both;">
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
			$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality1 = $('#quality1').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+fetchlist[1]+"&zip="+fetchlist[0],
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
			$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality1 = $('#quality1').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+fetchlist[1]+"&zip="+fetchlist[0],
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
<script>
	<?php if ($_GET['loc_zip'] != ""){$loczipparam = "&loc_zip=".$_GET['loc_zip'];}?>
	<?php if ($_GET['loc_loc'] != ""){$loclocparam = "&loc_loc=".$_GET['loc_loc'];}?>
	function getquality(quality) {
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
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
	
	
	<tr>
		<td>
			<table>
				<tr>
		<td><?php
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
		?>&nbsp;
		<input type="text"  autocomplete="off" name="location" id="location" size="10" maxlength="150" value="<?php echo htmlentities($_GET['loc_zip'])?>" />
		<span style="color:#eeeeee;font-size:18px;size:18px;"></span>
		</td>
	</tr>
	<tr>
		<td>
			<table><tr>
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
				<script type="text/javascript">
				$(document).ready(function() {
					//quality 1
					$('.qualityicons_1').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality1 = $('#quality1').val();
						if (quality1 == '0'){
							$('#quality1').val('1');
							var quality1 = $('#quality1').val();
							$('#imgquality1').attr('style','opacity:0.1;border:2px solid darkblue;');
						}else{
							$('#quality1').val('0');
							var quality1 = $('#quality1').val();
							$('#imgquality1').attr('style','');
						}
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location,
						  cache: false,
						  success: function(html){
							$('#loadingprocessing').html('');
							$('#load-desc').show();
							$("#load-desc").html(html);
						  }
						})
					});
					/// quality 2
					$('.qualityicons_2').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality2 = $('#quality2').val();
						if (quality2 == '0'){
							$('#quality2').val('1');
							var quality2 = $('#quality2').val();
							$('#imgquality2').attr('style','opacity:0.1;border:2px solid darkblue;');
						}else{
							$('#quality2').val('0');
							var quality2 = $('#quality2').val();
							$('#imgquality2').attr('style','');
						}
						var quality1 = $('#quality1').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location,
						  cache: false,
						  success: function(html){
							$('#loadingprocessing').html('');
							$('#load-desc').show();
							$("#load-desc").html(html);
						  }
						})
					});
					/// quality 3
					$('.qualityicons_3').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality3 = $('#quality3').val();
						if (quality3 == '0'){
							$('#quality3').val('1');
							var quality3 = $('#quality3').val();
							$('#imgquality3').attr('style','opacity:0.1;border:2px solid darkblue;');
						}else{
							$('#quality3').val('0');
							var quality3 = $('#quality3').val();
							$('#imgquality3').attr('style','');
						}
						var quality2 = $('#quality2').val();
						var quality1 = $('#quality1').val();
						var quality4 = $('#quality4').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location,
						  cache: false,
						  success: function(html){
							$('#loadingprocessing').html('');
							$('#load-desc').show();
							$("#load-desc").html(html);
						  }
						})
					});
					/// quality 4
					$('.qualityicons_4').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality4 = $('#quality4').val();
						if (quality4 == '0'){
							$('#quality4').val('1');
							var quality4 = $('#quality4').val();
							$('#imgquality4').attr('style','opacity:0.1;border:2px solid darkblue;');
						}else{
							$('#quality4').val('0');
							var quality4 = $('#quality4').val();
							$('#imgquality4').attr('style','');
						}
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality1 = $('#quality1').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location,
						  cache: false,
						  success: function(html){
							$('#loadingprocessing').html('');
							$('#load-desc').show();
							$("#load-desc").html(html);
						  }
						})
					});
					/// quality 5
					$('.qualityicons_5').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality5 = $('#quality5').val();
						if (quality5 == '0'){
							$('#quality5').val('1');
							var quality5 = $('#quality5').val();
							$('#imgquality5').attr('style','opacity:0.1;border:2px solid darkblue;');
						}else{
							$('#quality5').val('0');
							var quality5 = $('#quality5').val();
							$('#imgquality5').attr('style','');
						}
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality1 = $('#quality1').val();
						var location = $('#location').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location,
						  cache: false,
						  success: function(html){
							$('#loadingprocessing').html('');
							$('#load-desc').show();
							$("#load-desc").html(html);
						  }
						})
					});
				})
				</script>
				<td>
					<a style="cursor:pointer;" class="qualityicons_1" alt="<?php echo $quality1?>" title="<?php echo $quality1?>"><img src="images/1.png" id="imgquality1" style="opacity:0.1;border:2px solid darkblue;"></a>
					<input type="hidden" name="quality1" id="quality1" value="1" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_2" alt="<?php echo $quality2?>" title="<?php echo $quality2?>"><img src="images/2.png" id="imgquality2" style="opacity:0.1;border:2px solid darkblue;"></a>
					<input type="hidden" name="quality2" id="quality2" value="1" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_3" alt="<?php echo $quality3?>" title="<?php echo $quality3?>"><img src="images/3.png" id="imgquality3" style="opacity:0.1;border:2px solid darkblue;"></a>
					<input type="hidden" name="quality3" id="quality3" value="1" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_4" alt="<?php echo $quality4?>" title="<?php echo $quality4?>"><img src="images/4.png" id="imgquality4" style="opacity:0.1;border:2px solid darkblue;"></a>
					<input type="hidden" name="quality4" id="quality4" value="1" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_5" alt="<?php echo $quality5?>" title="<?php echo $quality5?>"><img src="images/5.png" id="imgquality5" style="opacity:0.1;border:2px solid darkblue;"></a>
					<input type="hidden" name="quality5" id="quality5" value="1" />
				</td>
				
				<td><div id="loadingprocessing" style="background-color:white;float:left;margin-bottom:5px;" align="center"></div> </td>
			</tr></table>
		</td>
	</tr>
			</table>
			
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
		$('#currentdate').val(datetocheck);
		var quality2 = $('#quality2').val();
			var quality3 = $('#quality3').val();
			var quality4 = $('#quality4').val();
			var quality1 = $('#quality1').val();
			var quality5 = $('#quality5').val();
			var location = $('#location').val();
			if (location == ""){
				var location = "locname";
			}
			var currentdate = $('#currentdate').val();
			$.ajax({
			  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location,
			  cache: false,
			  success: function(html){
				$('#loadingprocessing').html('');
				$('#load-desc').show();
				$("#load-desc").html(html);
			  }
			})
	}
	</script>
	<input type="hidden" name="currentdate" id="currentdate" value="<?php echo date('Y-m-d');?>">
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
								<td><a style="color:white;text-decoration:none;font-size:13px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $previous_year?>" title="<?php echo $previous_year_text?>">&laquo;&laquo;</a></td>
					<td><a style="color:white;text-decoration:none;font-size:13px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $previous_month?>" title="<?php echo $previous_month_text?>">&laquo;</a></td>
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
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $next_month?>" title="<?php echo $next_month_text?>">&raquo;</a></td>
					<td align="right"><a style="color:white;text-decoration:none;font-size:16px;" href="<?php echo $_SERVER['PHP_SELF']?>?option=events-calendar&time=<?php echo $next_year?>" title="<?php echo $next_year_text?>">&raquo;&raquo;</a></td>
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
	
	
	
	<div style="float:left;border:0px solid red;margin-top:0px;width:720px;margin-left:10px;margin-top:-75px;" id="load-desc">
	<?php include "components/display-events2.php";?>
	</div>
	</div>
	</div>
	
	