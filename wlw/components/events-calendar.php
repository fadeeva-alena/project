<?php
	error_reporting(0);
	session_start();
     $grid_id = $page_name;
     $target_url = INDEX_PAGE.$page_option.'-m&mode=';
     ?>
	 
	 <?php
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
					$locationlist .= '"'.$key.'",';
				}else{
					$locationlist .= '"'.$key.'"';
				}
			}
		}
		
	?>
	 <style>
		#content {
			background-color: #FFFFFF;
			clear: both;
			color: #000000;
			padding: 10px 20px 0;
			height:auto;
		}
	 </style>
     <h1><?php echo $page_heading?></h1>
	 <div style="background-color:white;height:auto;">
     <table width="990px" style="margin-top:50px;border:0px solid red;">
	<tr>
	<td>
		<div style="float:left;width:215px;border:0px solid red;margin-top:-40px;">
			
				<span style="font-size:20px;font-weight:bold;"><?php $sqlfield = mysql_query("select * from t_field_names where id=328");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}?></span><br />
				<?php $sqlfield = mysql_query("select * from t_field_names where id=328");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['helptext_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['helptext_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['helptext_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['helptext_it'];}?>
			
		</div>
		<div style="float:left;width:400px;border:0px solid red;margin-left:20px;margin-top:-40px;">
			
				<span style="font-size:20px;font-weight:bold;"><?php $sqlfield = mysql_query("select * from t_field_names where id=330");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}?></span><br />
				<?php $sqlfield = mysql_query("select * from t_field_names where id=330");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['helptext_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['helptext_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['helptext_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['helptext_it'];}?>
			
		</div>
		<div style="float:left;width:300px;border:0px solid red;margin-left:17px;margin-top:-40px;">
			
				<span style="font-size:20px;font-weight:bold;"><?php $sqlfield = mysql_query("select * from t_field_names where id=332");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}?></span><br /><br />
				<?php $sqlfield = mysql_query("select * from t_field_names where id=332");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['helptext_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['helptext_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['helptext_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['helptext_it'];}?>
			
		</div>
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
		//$first_w_of_month =1;

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
	
	<?php
	$currentmonth = date('Y-m');
	if ($_GET['time'] !=""){
		$comparemonth = date('Y-m',$_GET['time']);
	}else{
		$comparemonth = $currentmonth;
	}
	if (($currentmonth == $comparemonth)){
?>	

	
<?php
	}
?>
	<table width="990px" style="margin: 0 auto;">
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
						
						var type = $('#type').val();
						var kind = $('#kind').val();
						
						if (location == ""){
							var location = "locname";
						}
						$('#load-desc').hide();
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
	/// preload location
	
	var locationsuggest = [
	//"Aberdeen", "Zoar"
		<?php echo $locationlist;?>
	];
	/// end preload location
	$("#location").autocomplete(locationsuggest);
	/*$("#location").autocomplete("search2.php", {
		width: 267,
		selectFirst: false
	});*/
	$("#location").result(function(event, data, formatted) {
		if (data)
			//$(this).parent().next().find("input").val(data[0]);
			/*var fetch = new String(data[1]);
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
						}*/
						$('#load-desc').hide();
			$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality1 = $('#quality1').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						var type = $('#type').val();
						var kind = $('#kind').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						$.ajax({
						  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location,
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
	$("#frm_customsearch input").keypress(function (e) {  
		if ((e.which && e.which == 13) || (e.keyCode && e.keyCode == 13)) { 
			var quality2 = $('#quality2').val();
		var quality3 = $('#quality3').val();
		var quality4 = $('#quality4').val();
		var quality1 = $('#quality1').val();
		var quality5 = $('#quality5').val();
		var location = $('#location').val();
		var keyword = $('#keyword').val();
		var type = $('#type').val();
						var kind = $('#kind').val();
		if (location == ""){
			var location = "locname";
		}
		var currentdate = $('#currentdate').val();
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
		$('#calendar').hide();
		$.ajax({
		  url: "components/calendar-new.php?time=<?php echo $time;?>&datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location+"&keyword="+keyword,
		  cache: false,
		  success: function(html){
			$('#calendar').show();
			$("#calendar").html(html);
		  }
		})
		
		
		$.ajax({
		  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location="+location+"&keyword="+keyword,
		  cache: false,
		  success: function(html){
			$('#loadingprocessing').html('');
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})						
		return false;  
		} else {  
			
			return true;  
		}  
	});	
	//customsearch
	$("#customsearch").click(function() 
    { 
        var quality2 = $('#quality2').val();
		var quality3 = $('#quality3').val();
		var quality4 = $('#quality4').val();
		var quality1 = $('#quality1').val();
		var quality5 = $('#quality5').val();
		var location = $('#location').val();
		var keyword = $('#keyword').val();
		var type = $('#type').val();
						var kind = $('#kind').val();
		if (location == ""){
			var location = "locname";
		}
		var currentdate = $('#currentdate').val();
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
		$('#calendar').hide();
		$.ajax({
		  url: "components/calendar-new.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
		  cache: false,
		  success: function(html){
			$('#calendar').show();
			$("#calendar").html(html);
		  }
		})
		
		$.ajax({
		  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
		  cache: false,
		  success: function(html){
			$('#loadingprocessing').html('');
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})
    }); 
	
	
	//type
	$("#type").change(function() 
    { 
        var quality2 = 1;
		var quality3 = 1;
		var quality4 = 1;
		var quality1 = 1;
		var quality5 = 1;
		
		$('#imgquality1').attr('style','');
		$('#imgquality2').attr('style','');
		$('#imgquality3').attr('style','');
		$('#imgquality4').attr('style','');
		$('#imgquality5').attr('style','');
		
		$('#quality1').val('1');
		$('#quality2').val('1');
		$('#quality3').val('1');
		$('#quality4').val('1');
		$('#quality5').val('1');
		
		var location = $('#location').val();
		var keyword = $('#keyword').val();
		var type = $('#type').val();
		var kind = $('#kind').val();
		if (location == ""){
			var location = "locname";
		}
		var currentdate = $('#currentdate').val();
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
		$('#calendar').hide();
		$.ajax({
		  url: "components/calendar-new.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
		  cache: false,
		  success: function(html){
			$('#calendar').show();
			$("#calendar").html(html);
		  }
		})
		
		$.ajax({
		  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
		  cache: false,
		  success: function(html){
			$('#loadingprocessing').html('');
			$('#load-desc').show();
			$("#load-desc").html(html);
		  }
		})
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
	
	
	<tr>
		<td>
			<table style="border:1px solid #cccccc;" id="frm_customsearch">
			
			<!--
			<tr>
		 <td class="key"><label for="kind"><b>
		<?php
		$sqlfield = mysql_query("select * from t_field_names where id=3");
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
		$sqlfield = mysql_query("select * from t_field_names where id=3");
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
		?><?php echo $req_fld?></label></b>:</td>
		 
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
		
		
		echo $scaffold->dropdown_rs($rs,$value_display,"kind",$kind,"","style=width:100px;");
		?>
		</td>
		<?php
			$sqlfield = mysql_query("select * from t_field_names where id=103");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$search = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$search =$rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$search =$rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$search =$rowfield['fieldname_it'];
		}
		?> 
		
		</tr>-->
		
		<tr>
		 <td class="key"><label for="type">
		<b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=4");
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
		$sqlfield = mysql_query("select * from t_field_names where id=4");
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
		?><?php echo $req_fld?></label></b>:</td>
		 
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
		
		
		$sqlcookies = mysql_query("select * from t_cookies where ip_address='".$_SERVER['REMOTE_ADDR']."'");
     $rowcookies = mysql_fetch_array($sqlcookies);
		
		echo $scaffold->dropdown_rs($rs,$value_display,"type",$rowcookies['type'],"","style=width:100px");
		?>
		</td>
		<td  rowspan="3">
									<input class="button-search" type="button" value="<?php echo $search;?>" id="customsearch" style="padding-left:2px;padding-right:2px;height:70px;"/>
								</td>
		</tr>
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
			
				<tr>
		<td><b><?php
		$sqlfield = mysql_query("select * from t_field_names where id=327");
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
		?></b>:&nbsp;</td>
		<td>
		<input type="text"  autocomplete="off" name="keyword" id="keyword" style="width:100px;" maxlength="150" value="<?php echo $rowcookies['searchitem'];?>"/>
		<span style="color:#eeeeee;font-size:18px;size:18px;"></span>
		
		</td>
		
	</tr>
			
				<tr>
		<td><b><?php
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
		?></b>:&nbsp;</td>
		<td>
		<input type="text" value="<?php echo $rowcookies['location'];?>" autocomplete="off" name="location" id="location" style="width:100px;" maxlength="150" value="<?php echo htmlentities($_GET['loc_zip'])?>" />
		<span style="color:#eeeeee;font-size:18px;size:18px;"></span>
		</td>
	</tr>
	<tr>
		<td colspan="3">
			<table><tr>
				
				<script type="text/javascript">
				$(document).ready(function() {
					//quality 1
					$('.qualityicons_1').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality1 = $('#quality1').val();
						if (quality1 == '0'){
							$('#quality1').val('1');
							var quality1 = $('#quality1').val();
							$('#imgquality1').attr('style','');
						}else{
							$('#quality1').val('0');
							var quality1 = $('#quality1').val();
							
							$('#imgquality1').attr('style','-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;');
						}
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						var keyword = $('#keyword').val();
						$('#type').val('');
						var type = $('#type').val();
						var kind = $('#kind').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						
						var nocountqualityactive = 0;
						if (quality2 == 0){nocountqualityactive++;}
						if (quality3 == 0){nocountqualityactive++;}
						if (quality4 == 0){nocountqualityactive++;}
						if (quality5 == 0){nocountqualityactive++;}
						
						
						if (nocountqualityactive != 4){
							$.ajax({
							  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
							  cache: false,
							  success: function(html){
								$('#loadingprocessing').html('');
								$('#load-desc').show();
								$("#load-desc").html(html);
							  }
							})
						}else{
							$('#loadingprocessing').html('');
							$('#quality1').val('1');
							var quality1 = $('#quality1').val();
							$('#imgquality1').attr('style','');
							alert("<?php echo translatefields2(744);?>");
						}
					});
					/// quality 2
					$('.qualityicons_2').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality2 = $('#quality2').val();
						if (quality2 == '0'){
							$('#quality2').val('1');
							var quality2 = $('#quality2').val();
							$('#imgquality2').attr('style','');
							
						}else{
							$('#quality2').val('0');
							var quality2 = $('#quality2').val();
							$('#imgquality2').attr('style','-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;');
						}
						var quality1 = $('#quality1').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						var keyword = $('#keyword').val();
						$('#type').val('');
						var type = $('#type').val();
						var kind = $('#kind').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						var nocountqualityactive = 0;
						if (quality1 == 0){nocountqualityactive++;}
						if (quality3 == 0){nocountqualityactive++;}
						if (quality4 == 0){nocountqualityactive++;}
						if (quality5 == 0){nocountqualityactive++;}
						if (nocountqualityactive != 4){
								$.ajax({
								  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
								  cache: false,
								  success: function(html){
									$('#loadingprocessing').html('');
									$('#load-desc').show();
									$("#load-desc").html(html);
								  }
								})
						}else{
							$('#loadingprocessing').html('');
							$('#quality2').val('1');
							var quality2 = $('#quality2').val();
							$('#imgquality2').attr('style','');
							alert("<?php echo translatefields2(744);?>");
						}
					});
					/// quality 3
					$('.qualityicons_3').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality3 = $('#quality3').val();
						if (quality3 == '0'){
							$('#quality3').val('1');
							var quality3 = $('#quality3').val();
							$('#imgquality3').attr('style','');
						}else{
							$('#quality3').val('0');
							var quality3 = $('#quality3').val();
							
							$('#imgquality3').attr('style','-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;');
						}
						var quality2 = $('#quality2').val();
						var quality1 = $('#quality1').val();
						var quality4 = $('#quality4').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						var keyword = $('#keyword').val();
						$('#type').val('');
						var type = $('#type').val();
						var kind = $('#kind').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						var nocountqualityactive = 0;
						if (quality1 == 0){nocountqualityactive++;}
						if (quality2 == 0){nocountqualityactive++;}
						if (quality4 == 0){nocountqualityactive++;}
						if (quality5 == 0){nocountqualityactive++;}
						if (nocountqualityactive != 4){
								$.ajax({
								  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
								  cache: false,
								  success: function(html){
									$('#loadingprocessing').html('');
									$('#load-desc').show();
									$("#load-desc").html(html);
								  }
								})
						}else{
							$('#loadingprocessing').html('');
							$('#quality3').val('1');
							var quality3 = $('#quality3').val();
							$('#imgquality3').attr('style','');
							alert("<?php echo translatefields2(744);?>");
						}
					});
					/// quality 4
					$('.qualityicons_4').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality4 = $('#quality4').val();
						if (quality4 == '0'){
							$('#quality4').val('1');
							var quality4 = $('#quality4').val();
							$('#imgquality4').attr('style','');
						}else{
							$('#quality4').val('0');
							var quality4 = $('#quality4').val();
							
							$('#imgquality4').attr('style','-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;');
						}
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality1 = $('#quality1').val();
						var quality5 = $('#quality5').val();
						var location = $('#location').val();
						var keyword = $('#keyword').val();
						$('#type').val('');
						var type = $('#type').val();
						var kind = $('#kind').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						var nocountqualityactive = 0;
						if (quality1 == 0){nocountqualityactive++;}
						if (quality2 == 0){nocountqualityactive++;}
						if (quality3 == 0){nocountqualityactive++;}
						if (quality5 == 0){nocountqualityactive++;}
						if (nocountqualityactive != 4){
							$.ajax({
							  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
							  cache: false,
							  success: function(html){
								$('#loadingprocessing').html('');
								$('#load-desc').show();
								$("#load-desc").html(html);
							  }
							})
						}else{
							$('#loadingprocessing').html('');
							$('#quality4').val('1');
							var quality4 = $('#quality4').val();
							$('#imgquality4').attr('style','');
							alert("<?php echo translatefields2(744);?>");
						}
					});
					/// quality 5
					$('.qualityicons_5').click(function () {
						$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
						var quality5 = $('#quality5').val();
						if (quality5 == '0'){
							$('#quality5').val('1');
							var quality5 = $('#quality5').val();
							$('#imgquality5').attr('style','');
						}else{
							$('#quality5').val('0');
							var quality5 = $('#quality5').val();
							
							$('#imgquality5').attr('style','-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;');
						}
						var quality2 = $('#quality2').val();
						var quality3 = $('#quality3').val();
						var quality4 = $('#quality4').val();
						var quality1 = $('#quality1').val();
						var location = $('#location').val();
						var keyword = $('#keyword').val();
						$('#type').val('');
						var type = $('#type').val();
						var kind = $('#kind').val();
						if (location == ""){
							var location = "locname";
						}
						var currentdate = $('#currentdate').val();
						var nocountqualityactive = 0;
						if (quality1 == 0){nocountqualityactive++;}
						if (quality2 == 0){nocountqualityactive++;}
						if (quality3 == 0){nocountqualityactive++;}
						if (quality4 == 0){nocountqualityactive++;}
						if (nocountqualityactive != 4){
							$.ajax({
							  url: "components/display-events.php?datetocheck="+currentdate+"&type="+type+"&kind="+kind+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
							  cache: false,
							  success: function(html){
								$('#loadingprocessing').html('');
								$('#load-desc').show();
								$("#load-desc").html(html);
							  }
							})
						}else{
							$('#loadingprocessing').html('');
							$('#quality5').val('1');
							var quality5 = $('#quality5').val();
							$('#imgquality5').attr('style','');
							alert("<?php echo translatefields2(744);?>");
						}
					});
				})
				</script>
				<?php
					// quality 1
					$sqlfield = mysql_query("select * from t_field_names where id=320");
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$quality1 = $rowfield['helptext_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$quality1 = $rowfield['helptext_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$quality1 = $rowfield['helptext_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$quality1 = $rowfield['helptext_it'];
					}
					// quality 2
					$sqlfield = mysql_query("select * from t_field_names where id=321");
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$quality2 = $rowfield['helptext_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$quality2 = $rowfield['helptext_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$quality2 = $rowfield['helptext_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$quality2 = $rowfield['helptext_it'];
					}
					// quality 3
					$sqlfield = mysql_query("select * from t_field_names where id=322");
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$quality3 = $rowfield['helptext_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$quality3 = $rowfield['helptext_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$quality3 = $rowfield['helptext_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$quality3 = $rowfield['helptext_it'];
					}
					// quality 4
					$sqlfield = mysql_query("select * from t_field_names where id=323");
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$quality4 = $rowfield['helptext_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$quality4 = $rowfield['helptext_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$quality4 = $rowfield['helptext_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$quality4 = $rowfield['helptext_it'];
					}
					// quality 5
					$sqlfield = mysql_query("select * from t_field_names where id=324");
					$rowfield = mysql_fetch_array($sqlfield);
					if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
						$quality5 = $rowfield['helptext_de'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
						$quality5 = $rowfield['helptext_eng'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
						$quality5 = $rowfield['helptext_fr'];
					}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
						$quality5 = $rowfield['helptext_it'];
					}
				?>
				<td>
					<a style="cursor:pointer;" class="qualityicons_1" alt="<?php echo $quality1?>" title="<?php echo $quality1?>"><img src="images/1.png" id="imgquality1" <?php if ($rowcookies['quality1'] == 0){?>style='-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;'<?php } ?>></a>
					<input type="hidden" name="quality1" id="quality1" value="<?php if (mysql_num_rows($sqlcookies) > 0){ echo $rowcookies['quality1'];}else{echo '1';}?>" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_2" alt="<?php echo $quality2?>" title="<?php echo $quality2?>"><img src="images/2.png" id="imgquality2" <?php if ($rowcookies['quality2'] == 0){?>style='-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;'<?php } ?>></a>
					<input type="hidden" name="quality2" id="quality2" value="<?php if (mysql_num_rows($sqlcookies) > 0){ echo $rowcookies['quality2'];}else{echo '1';}?>" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_3" alt="<?php echo $quality3?>" title="<?php echo $quality3?>"><img src="images/3.png" id="imgquality3" <?php if ($rowcookies['quality3'] == 0){?>style='-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;'<?php } ?>></a>
					<input type="hidden" name="quality3" id="quality3" value="<?php if (mysql_num_rows($sqlcookies) > 0){ echo $rowcookies['quality3'];}else{echo '1';}?>" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_4" alt="<?php echo $quality4?>" title="<?php echo $quality4?>"><img src="images/4.png" id="imgquality4" <?php if ($rowcookies['quality4'] == 0){?>style='-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;'<?php } ?>></a>
					<input type="hidden" name="quality4" id="quality4" value="<?php if (mysql_num_rows($sqlcookies) > 0){ echo $rowcookies['quality4'];}else{echo '1';}?>" />
				</td>
				<td>
					<a style="cursor:pointer;" class="qualityicons_5" alt="<?php echo $quality5?>" title="<?php echo $quality5?>"><img src="images/5.png" id="imgquality5" <?php if ($rowcookies['quality5'] == 0){?>style='-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";filter: alpha(opacity = 10);opacity:0.1;border:0px solid darkblue;'<?php } ?>></a>
					<input type="hidden" name="quality5" id="quality5" value="<?php if (mysql_num_rows($sqlcookies) > 0){ echo $rowcookies['quality5'];}else{echo '1';}?>" />
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
	
	
	<div style="float:left;backround-color:white;">
	<script type="text/javascript">

        function toggleDiv(divid,eventsid){

            var div = document.getElementById(divid);
			
            div.style.display = div.style.display == 'block' ? 'none' : 'block';
		$('#display-feedback').show();
			$.ajax({
			  url: "components/display-feedback.php?events_id="+eventsid,
			  cache: false,
			  success: function(html){
				$('#display-feedback').html(html);
			  }
			})
			
			
			//alert(div);
			$(div).show();
			$(div).html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
			$.ajax({
			  url: "components/ajax-events-description2.php?events_id="+eventsid,
			  cache: false,
			  success: function(html){
			    $(div).html('');
				$(div).html(html);
			  }
			})
			
            }

	function displaydesc(datetocheck) {
		$('#loadingprocessing').html('<img src=images/indicator-big-white.gif style=float:left;><div style=float:left;margin-top:10px;font-wieght:bold;size:14px;font-size:14px;margin-left:4px;></div>');
		$('#load-desc').hide();
		$('#currentdate').val(datetocheck);
		var quality2 = $('#quality2').val();
			var quality3 = $('#quality3').val();
			var quality4 = $('#quality4').val();
			var quality1 = $('#quality1').val();
			var quality5 = $('#quality5').val();
			var location = $('#location').val();
			var keyword = $('#keyword').val();
			var type = $('#type').val();
						var kind = $('#kind').val();
			if (location == ""){
				var location = "locname";
			}
			var currentdate = $('#currentdate').val();
			$.ajax({
			  url: "components/display-events.php?datetocheck="+currentdate+"&quality1="+quality1+"&quality2="+quality2+"&quality3="+quality3+"&quality4="+quality4+"&quality5="+quality5+"&location=" +location+"&keyword="+keyword,
			  cache: false,
			  success: function(html){
				$('#loadingprocessing').html('');
				$('#load-desc').show();
				$("#load-desc").html(html);
			  }
			})
	}
	</script>
	<div id="clone_loc_zip" style="font-size:0px;"></div>
		<div id="clone_loc_loc" style="font-size:0px;"></div>
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
	<table width="180" height="100px" style="font-size:11px;size:11px;margin-top:-3px;margin-left:0px;" id="calendar">
	<tr>
		<td height="5px;"></td>
	</tr>
	<tr>
		<td>
			
			
			<?php
			if ($_GET['time'] == ""){
	$year = date('Y');
	$month = date('m');
}else{
	$gettime = $_GET['time'];
	$year = date('Y',$gettime);
	$month = date('m',$gettime);
}

$first_day = 1;

$month_name = date("F", mktime(0, 0, 0, $month, 1, $year));
$weekday = date("w", mktime(0, 0, 0, $month, 1, $year));

$weekday = ($weekday + 7 - $first_day) % 7;

$time = strtotime("01-".$month . "-" . $year);

$current_month = date("n", $time);

$current_year = date("Y", $time);

$currentmonthtext = date('F',$time);
$current_month_text = date("F Y", $time);

$next_month = mktime(0,0,0,$current_month+1,1,$current_year);
$next_month_text = date("F \'y", $next_month);

$previous_month = mktime(0,0,0,$current_month-1,1,$current_year);
$previous_month_text = date("F \'y", $previous_month);

$next_year = mktime(0,0,0,$current_month,1,$current_year+1);
$next_year_text = date("F \'y", $next_year);

$previous_year = mktime(0,0,0,$current_month,1,$current_year-1);
$previous_year_text = date("F \'y", $previous_year);

echo '<table cellspacing="0" width="180" height="100px" class="calendar" cellspacing="3" cellpadding="3px" style="background-color:white;font-size:11px;border-collapse:collapse;border:1px solid #010102;" border="1">';

?>
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
					<th width="15%"><?php 
								$sqlfield = mysql_query("select * from t_field_names where id=194");
								$rowfield = mysql_fetch_array($sqlfield);
								if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){echo $rowfield['fieldname_de'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){echo  $rowfield['fieldname_eng'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){echo   $rowfield['fieldname_fr'];
								}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){echo   $rowfield['fieldname_it'];}
					?></th>
				</tr><tr>
<?php


if($weekday > 0)
{
echo '<td colspan="'.$weekday.'">&nbsp;</td>';
}
for($day=1,$days_in_month=gmdate('t',$weekday); $day<=$days_in_month; $day++,$weekday++)
{
if($weekday == 7)
{
$weekday   = 0;
echo "</tr>\n<tr>";
}
//echo '<td align="right" style="font-weight:bold;font-size:14px;padding-right:10px;">';
if ($day == date('d') and $currentmonthtext == date('F')){
	echo '<td align="right" style="font-weight:bold;font-size:14px;padding-right:10px;background-color:#0074FF;">';
}else{
	echo '<td align="right" style="font-weight:bold;font-size:14px;padding-right:10px;">';
}
if ($day <= 10){
	$day1 = "0".$day;
	$datetocheck = "$current_year-$current_month-$day1";
}else{
	$datetocheck = "$current_year-$current_month-$day";
}
$quality = "";
if ($rowcookies['quality1'] ==1){$quality .= "1,";}
if ($rowcookies['quality2'] ==1){$quality .= "2,";}
if ($rowcookies['quality3'] ==1){$quality .= "3,";}
if ($rowcookies['quality4'] ==1){$quality .= "4,";}
if ($rowcookies['quality5'] ==1){$quality .= "5,";}

if ($quality != ""){
	$val = substr($quality, 0, -1);
	$getquality = " and e.quality in ($val)";
}
else{
	$getquality = " and e.quality in (111111111111111111111)";
}

$gettype = "";
if ($rowcookies['type'] != "" and $rowcookies['type'] != "0"){
	$gettype = " and type='".$rowcookies['type']."' ";
}

if ($rowcookies['location'] != "locname"){
		$locationx = $rowcookies['location'];
		 if ($rowcookies['searchitem'] == ""){
			$sqlqry = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') and ((l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%')) $getquality  $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $rowcookies['searchitem'];
			} else {
				$keyword = utf8_decode($rowcookies['searchitem']);
			}
			$locationx = $rowcookies['location'];
			$sqlqry = "SELECT e.*,e.id as eid,l.*,le.company,le.firstname,le.lastname FROM t_event e 
INNER JOIN t_dates d ON e.id=d.events_id 
inner JOIN t_location l on l.id=e.location 
inner join t_leader le ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND (e.title LIKE '%$keyword%'
								 OR e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%'
								
								OR le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%')
								and (l.loc_name LIKE '%$locationx%' OR l.loc_detail LIKE '%$locationx%' OR l.loc_adress1 LIKE '%$locationx%' OR l.loc_adress2 LIKE '%$locationx%' OR l.loc_zip LIKE '%$locationx%' OR l.loc_loc LIKE '%$locationx%') $getquality  $getkind $gettype group by e.id";
								
								
					
		 }
	}else{
		if ($rowcookies['searchitem'] == ""){
			$sqlqry = "select *,e.id as eid from t_event e inner join t_location l
         on l.id=e.location inner join t_dates x on x.events_id=e.id
		 inner join t_dates d on e.id=d.events_id
		 where (x.events_start_date <= '{$datetocheck}' and x.events_end_date >= '{$datetocheck}') $getquality  $getkind $gettype group by e.id";
		 }else{
			 $br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use.
				
			if(!ereg("opera", $br)) {
				$keyword = $rowcookies['searchitem'];
			} else {
				$keyword = utf8_decode($rowcookies['searchitem']);
			}
			$locationx = $rowcookies['location'];
			$sqlqry = "SELECT *,e.id as eid FROM t_event e 
								INNER JOIN t_dates d
								ON e.id=d.events_id
								INNER JOIN t_leader le
								ON e.leader=le.id
								where (d.events_start_date <= '{$datetocheck}' and d.events_end_date >= '{$datetocheck}')
								AND (e.title LIKE '%$keyword%'
								OR (e.short_desc LIKE '%$keyword%' OR e.long_desc LIKE '%$keyword%' OR e.price LIKE '%$keyword%' OR e.remark_price LIKE '%$keyword%' OR e.remark_prerequisite LIKE '%$keyword%' OR e.date_remark LIKE '%$keyword%' OR e.time_start LIKE '%$keyword%' OR e.time_end LIKE '%$keyword%' OR e.remark_time LIKE '%$keyword%')
								OR (le.company LIKE '%$keyword%' OR le.firstname LIKE '%$keyword%' OR le.lastname LIKE '%$keyword%')) 
								$getquality  $getkind $gettype group by e.id";
					
		 }
	}							
	//echo $sqlqry;						
	$sqlevent = mysql_query($sqlqry);

if (mysql_num_rows($sqlevent) > 0){
	if ($day == date('d') and $currentmonthtext == date('F')){
		echo "<a style=cursor:pointer;color:white; onclick=displaydesc('".$datetocheck."')>" .$day."</a>";
	}else{
		echo "<a style=cursor:pointer; onclick=displaydesc('".$datetocheck."')>" .$day."</a>";
	}
}else{
	echo $day;
}


echo "</td>";
}
if($weekday != 7)
{
$calendar .= '<td colspan="'.(7-$weekday).'">&nbsp;</td>';
}

echo $calendar."</tr>\n</table>\n";

?>

		</td>
	</tr>
	
	</table>
	<br style="clear:both;" />
	<div style="width:215px;border:0px solid red;"></div>
	</div>
	
	
	
	<div style="float:left;border:0px solid red;width:720px;border:0px solid red;margin-left:20px;margin-top:-140px;" id="load-desc">
	<?php include "components/display-events2-test.php";?>
	
	</div>
	</td>
	</tr>
	</table>
	</div>
	</div>
	
	<!--  ========= thickbox ========= -->
	<script type="text/javascript" src="js/thickbox.js"></script>
	<link rel="stylesheet" href="js/thickbox.css" type="text/css" media="screen" />
	<!--  ========= end thickbox ========= -->
	
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

/*function datereserve(events_id,date_id,provider_id){
	alert(events_id + " "+ date_id + " " +provider_id);
	tb_show('','components/process-reservation.php?height=50&amp;width=300&amp;headertitle=Process Reservation');
}*/

</script>
	