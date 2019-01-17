<?php
error_reporting(0);
session_start();

//&delete_reservation_id=115
if (isset($_GET['delete_reservation_id'])){
	mysql_query("delete from t_provider_reservation where reservation_id='".$_GET['delete_reservation_id']."'");
	header("Location: ".INDEX_PAGE."my-calendar-reservation&a=delete&success=true");
		exit();
}
//delete_reservation_id_plus_all
if (isset($_GET['delete_reservation_id_plus_all'])){
	$selecttodelete = mysql_query("select * from t_provider_reservation where reservation_id='".$_GET['delete_reservation_id_plus_all']."'");
	$rowtodelete = mysql_fetch_array($selecttodelete);
	
	$rowtimestodelete = $rowtodelete['reservation_datetime'];
	mysql_query("delete from t_provider_reservation where reservation_datetime='".$rowtimestodelete."'");
	
	header("Location: ".INDEX_PAGE."my-calendar-reservation&a=delete&success=true");
	exit();
}
if (isset($_GET['reservation_id'])){
	mysql_query("update t_provider_reservation set reservation_status='2',reservation_cancelled_datetime=NOW() where reservation_id='".$_GET['reservation_id']."'");
	$cancellation = 1;
	
	
$provider_event_title = $_REQUEST['provider_event_title'];
$sqlevent = mysql_query("select * from t_provider_reservation pr inner join t_provider_events e on e.provider_event_id=pr.provider_event_id inner join t_currency c on c.id=e.provider_event_price_currency where reservation_id='".$_GET['reservation_id']."'");
$rowevent = mysql_fetch_array($sqlevent);

$provider_id = $rowevent['reservation_provider_id'];

$provider_event_id = $rowevent['provider_event_id'];
$start_date = trim($rowevent['reservation_start_date']);
$end_date = trim($rowevent['reservation_end_date']);

	/*
	
<firstname> <lastname><p>
<providerfname> <providerlname> hat folgende Buchung storniert:<br/>
<eventtitle><br>
am <date> von <starttime> bis <endtime>.<br>
bei <provider_company> <provider_firstname> <provider_lastname><br>
<provider_adressblock></p>

<if reason for storno: ><p>Nachfolgend die Begründung für die Stornierung:
<reason_for_storno></p>
<endif>
<p>Es enstehen für Sie keine Kosten.</p>

Wir wünschen viel Spass und eine gelungene Session.<br>
Ihr Spiritwings-Team<br>

<our_footer><br/>
P.S. Bitte beachten Sie, dass Spiritwings.ch die Verwaltung des Terminkalenders im Auftrag des Anbieters anbietet; Ihr Vertragspartner ist der Anbieter.*/

//sending an email here
			$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
			$row1 = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '".$rowevent['provider_id']."'") ;	
			$to = $row->email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			
			$subject = fixEncodingx(translatefields(725));
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
			

			$bodyemail = fixEncodingx(translatefields1(724));
			$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
			
			if ($row->company != ""){
				$bodyemail = str_replace("<providercompany>",$row->company,$bodyemail);
			}
			if ($row->firstname != ""){
				$bodyemail = str_replace("<providerfname>",$row->firstname,$bodyemail);
			}
			if ($row->lastname != ""){
				$bodyemail = str_replace("<providerlname>",$row->lastname,$bodyemail);
			}
			$bodyemail = str_replace("<eventtitle>","<b>".$rowevent['provider_event_title']."</b>",$bodyemail);
			
			$bodyemail = str_replace("<date>",date('d.M.Y',strtotime($start_date)),$bodyemail);
			
			$bodyemail = str_replace("<starttime>",date('h:i',strtotime($start_date)),$bodyemail);
			$bodyemail = str_replace("<endtime>",date('h:i',strtotime($end_date)),$bodyemail);
			
			$bodyemail = str_replace("storniert","<b>storniert</b>",$bodyemail);
			//storniert
			$bodyemail = str_replace("Ihr Spiritwings-Team<br>","<b>Ihr Spiritwings-Team<br></b>",$bodyemail);
			if ($row1->company != ""){
				$bodyemail = str_replace("<provider_company>",$row1->company,$bodyemail);
			}
			if ($row1->firstname != ""){
				$bodyemail = str_replace("<provider_firstname>",$row1->firstname,$bodyemail);
			}
			if ($row1->lastname != ""){
				$bodyemail = str_replace("<provider_lastname>",$row1->lastname,$bodyemail);
			}
			if ($row1->fon != ""){
				$bodyemail = str_replace("<provider tel>",$fon,$bodyemail);
			}else{
				$bodyemail = str_replace("<provider tel>","",$bodyemail);
			}
			$bodyemailaddress = "";
			if ($row1->adress1 !=""){
				$bodyemailaddress .= $row1->adress1 . " ";
			}if ($row1->adress2 !=""){
				$bodyemailaddress .= $row1->adress2 . " ";
			}if ($row1->location !=""){
				$bodyemailaddress .= $row1->location . " ";
			}if ($row1->zip !=""){
				$bodyemailaddress .= $row1->zip . " ";
			}
			$bodyemail = str_replace('<provider_adressblock>',$bodyemailaddress,$bodyemail);
			//$bodyemail = $bodyemail . "". $bodyemailaddress;
			if ($_REQUEST['reason'] !=""){
			$bodyemail = 	str_replace("<reason_for_storno>","<br/>".$_REQUEST['reason'],$bodyemail);
			$bodyemail = 	str_replace("<if reason for storno: >","",$bodyemail);
			$bodyemail = 	str_replace("<endif>","",$bodyemail);
			//echo 'meronxxxxxxxxxxx';
			}else{
			$bodyemail = 	str_replace("<if reason for storno: ><p>Nachfolgend die Begründung für die Stornierung: <reason_for_storno></p> <endif> ","",$bodyemail);
			$bodyemail = 	str_replace("<p>Nachfolgend die Begr&#252;ndung f&#252;r die Stornierung: <reason_for_storno></p>","",$bodyemail);
			$bodyemail = 	str_replace("<if reason for storno: >","",$bodyemail);
			$bodyemail = 	str_replace("<endif>","",$bodyemail);
			}
			$bodyemail = str_replace("<currency>",$rowevent['currency'],$bodyemail);
			
			//$bodyemail = str_replace("<our_footer>","<br>".fixEncodingx(translatefields(688))."<br/>",$bodyemail);
			$bodyemail = str_replace("<our_footer>","",$bodyemail);
			
			$body = $body . "" . $bodyemail . "</div>";
			$from = "info@spiritwings.ch";
			//echo $body;
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
}

$mode = "add";

if (isset($_REQUEST['min_time'])){
	$min_time = $_REQUEST['min_time'];
	$max_time = $_REQUEST['max_time'];
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	$sqlcheckcalendar = mysql_query("select * from t_calendar_time_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	if (mysql_num_rows($sqlcheckcalendar) < 1){
		//add
		mysql_query("insert into t_calendar_time_settings values ('0','$provider_id','$min_time','$max_time')");
	}else{
		//update
		mysql_query("update t_calendar_time_settings set min_time='$min_time',max_time='$max_time' where provider_id='$provider_id'");
	}
	header("Location: ".INDEX_PAGE."my-calendar-reservation&a=edit&success=true");
		exit();
}
if (isset($_REQUEST['start_time'])){
	$start_time = $_REQUEST['start_time'];
	$end_time = $_REQUEST['end_time'];
	$start_day = $_REQUEST['start_day'];
	$end_day = $_REQUEST['end_day'];
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	$sqlcheckcalendar = mysql_query("select * from t_lunch_break_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	if (mysql_num_rows($sqlcheckcalendar) < 1){
		//add
		mysql_query("insert into t_lunch_break_settings values ('0','$provider_id','$start_time','$end_time')");
	}else{
		//update
		mysql_query("update t_lunch_break_settings set start_time='$start_time',end_time='$end_time' where provider_id='$provider_id'");
	}
	

	
	
	$check_date = date("Y-m-d");
	for ($a = 0;$a<=356;$a++){
        $check_date1 = date ("Y-m-d", strtotime ("+$a day", strtotime($check_date))); 
        $start_date = $check_date1 . " ".substr($start_time,0,-2).":".substr($start_time,-2).":00";
        $end_date = $check_date1 . " ".substr($end_time,0,-2).":".substr($end_time,-2).":00";
		$reservation_status = 5;
		
		$n = date("N",strtotime($check_date1));
		
		if ($n >=$start_day and $n <=$end_day){
			echo $sqladd = "insert into t_provider_reservation values ('0','$provider_id','$provider_event_id','$provider_id','$start_date','$end_date',NOW(),'$reservation_status','','$block_type','','','60')";
			mysql_query($sqladd);
		}
    }
	
	header("Location: ".INDEX_PAGE."my-calendar-reservation&a=edit&success=true");
	exit();
}

if (isset($_REQUEST['mode'])){
	$mode = $_REQUEST['mode'];
	if (isset($_POST['mode']) and $_POST['mode'] == "add"){
		$provider_event_title = $_POST['provider_event_title'];
		$provider_event_description = $_POST['provider_event_description'];
		$provider_event_duration = $_POST['provider_event_duration'];
		$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		$provider_event_price = $_POST['provider_event_price'];
		$provider_event_price_currency = $_POST['provider_event_price_currency'];
		$provider_event_vat = $_POST['provider_event_vat'];
		$provider_event_vat_amount = $_POST['provider_event_vat_amount'];
		$provider_event_color = $_POST['provider_event_color'];
		
		mysql_query("insert into t_provider_events values ('0','$provider_id','$provider_event_title','$provider_event_description','$provider_event_duration',NOW(),'$provider_event_price','$provider_event_price_currency','$provider_event_vat','$provider_event_vat_amount','$provider_event_color')");
		header("Location: ".INDEX_PAGE."my-calendar-reservation&a=add&success=true");
		exit();
	}
	if (isset($_POST['mode']) and $_POST['mode'] == "edit"){
		if (isset($_POST['provider_event_title'])){
			$provider_event_id = $_POST['provider_event_id'];
			$provider_event_title = $_POST['provider_event_title'];
			$provider_event_description = $_POST['provider_event_description'];
			$provider_event_duration = $_POST['provider_event_duration'];
			$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
			$provider_event_price = $_POST['provider_event_price'];
			$provider_event_price_currency = $_POST['provider_event_price_currency'];
			$provider_event_vat = $_POST['provider_event_vat'];
			$provider_event_vat_amount = $_POST['provider_event_vat_amount'];
			$provider_event_color = $_POST['provider_event_color'];
			mysql_query("update t_provider_events set provider_event_title='$provider_event_title',provider_event_description='$provider_event_description',provider_event_duration='$provider_event_duration',provider_event_price='$provider_event_price',provider_event_price_currency='$provider_event_price_currency',provider_event_vat='$provider_event_vat',provider_event_vat_amount='$provider_event_vat_amount',provider_event_color='$provider_event_color' where provider_event_id='$provider_event_id'");			
			header("Location: ".INDEX_PAGE."my-calendar-reservation&a=edit&success=true");
			exit();
		}
	}
	if (isset($_REQUEST['mode']) and $_REQUEST['mode'] == "delete"){
		mysql_query("delete from t_provider_events where provider_event_id='".$_REQUEST['provider_event_id']."'");
		header("Location: ".INDEX_PAGE."my-calendar-reservation&a=delete&success=true");
		exit();
	}
	
}
?>

<link rel='stylesheet' type='text/css' href='plugins/fullcalendar/fullcalendar.css' />
<link rel='stylesheet' type='text/css' href='plugins/fullcalendar/fullcalendar.print.css' media='print' />
<style>
.weekend { background-color: red; }
/*.fc-sat { color:blue; }
.fc-sun { color:red;  }*/
.fc-view-month .fc-sat, .fc-view-month .fc-sun,
.fc-view-agendaWeek .fc-sat, .fc-view-agendaWeek .fc-sun {
  background-color: #eeeeee;
}
.fc-event-vert .ui-resizable-s {
    bottom: 0 !important;
    cursor: s-resize;
    font-family: monospace;
    font-size: 11px !important;
    height: 10px !important;
    line-height: 8px !important;
    overflow: hidden !important;
    text-align: center;
    width: 100% !important;
}
</style>
<script type='text/javascript' src='plugins/jquery/jquery-ui-1.8.17.custom.min.js'></script>
<script type='text/javascript' src='plugins/jquery/jquery.qtip-1.0.0-rc3.min.js'></script>
<script type='text/javascript' src='plugins/fullcalendar/fullcalendar.min.js'></script>
<script type='text/javascript'>


	$(document).ready(function() {
	
	
		/* initialize the external events
		-----------------------------------------------------------------*/
	
		$('#external-events div.external-event').each(function() {
		
			// create an Event Object (http://arshaw.com/fullcalendar/docs/event_data/Event_Object/)
			// it doesn't need to have a start or end
			var eventObject = {
				title: $.trim($(this).text()), // use the element's text as the event title 
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
				delay:0,
				revert: true,      // will cause the event to go back to its
				revertDuration: 0  //  original position after the drag
			});
			
			
			
		});
	
		$('table.calendar > tbody > tr > td:nth-child(-n+2)').addClass('weekend');
	
		/* initialize the calendar
		-----------------------------------------------------------------*/
		var date = new Date();
		var d = date.getDate();
		var m = date.getMonth();
		var y = date.getFullYear();
		
		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'agendaWeek,month,agendaDay'
			},      
			editable: true,
			slotMinutes:15,
			firstHour: 8,
			<?php $sqlcalendar = mysql_query("select * from t_calendar_time_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
			if (mysql_num_rows($sqlcalendar) < 1){?>
			minTime:'08:00',
			maxTime:'18:00',
			<?php } else {
			$rowcal = mysql_fetch_array($sqlcalendar);
			?>
			minTime:'<?php echo substr($rowcal['min_time'],0,-2).":".substr($rowcal['min_time'],-2);?>',
			maxTime:'<?php echo substr($rowcal['max_time'],0,-2).":".substr($rowcal['max_time'],-2);?>',
			<?php
			}?>
			monthNamesShort: ['<?php echo translatefields(176);?>','<?php echo translatefields(177);?>','<?php echo translatefields(178);?>','<?php echo translatefields(179);?>','<?php echo translatefields(180);?>','<?php echo translatefields(181);?>','<?php echo translatefields(182);?>','<?php echo translatefields(183);?>','<?php echo translatefields(184);?>','<?php echo translatefields(185);?>','<?php echo translatefields(186);?>','<?php echo translatefields(187);?>'],
			monthNames: ['<?php echo translatefields(176);?>','<?php echo translatefields(177);?>','<?php echo translatefields(178);?>','<?php echo translatefields(179);?>','<?php echo translatefields(180);?>','<?php echo translatefields(181);?>','<?php echo translatefields(182);?>','<?php echo translatefields(183);?>','<?php echo translatefields(184);?>','<?php echo translatefields(185);?>','<?php echo translatefields(186);?>','<?php echo translatefields(187);?>'],
			dayNamesShort: ['<?php echo translatefields(194);?>','<?php echo translatefields(188);?>','<?php echo translatefields(189);?>','<?php echo translatefields(190);?>','<?php echo translatefields(191);?>','<?php echo translatefields(192);?>','<?php echo translatefields(193);?>'],
			dayNames: ['<?php echo translatefields(194);?>','<?php echo translatefields(188);?>','<?php echo translatefields(189);?>','<?php echo translatefields(190);?>','<?php echo translatefields(191);?>','<?php echo translatefields(192);?>','<?php echo translatefields(193);?>'],
			buttonText: {
				prev: '&nbsp;&#9668;&nbsp;',
				next: '&nbsp;&#9658;&nbsp;',
				prevYear: '&nbsp;&lt;&lt;&nbsp;',
				nextYear: '&nbsp;&gt;&gt;&nbsp;',
				today: '<?php echo translatefields(711);?>',
				month: '<?php echo translatefields(712);?>',
				week: '<?php echo translatefields(713);?>',
				day: '<?php echo translatefields(714);?>'
			},
			droppable: true,
			// this allows things to be dropped onto the calendar !!!
			drop: function(date,allDay) { // this function is called when something is dropped
			
			var myDate = new Date();
                    
                    //How many days to add from today?
                    //var daysToAdd = 20;
                    //alert(date.getDay());
                    myDate.setDate(myDate.getDate());
                	//alert(date +" - "+ myDate);
            if ((date.getDay() == 60)){
                
            }else if ((date.getDay() == 100)){
               
            }else{
                    if (date < myDate) {
                        //TRUE Clicked date smaller than today + daysToadd
                    	alert("<?php echo translatefields(715);?>");    
                    }
                    //getDay()
                    else
                    {
                        //alert(id);
						// retrieve the dropped element's stored Event Object
						var originalEventObject = $(this).data('eventObject');
				
						// we need to copy it, so that multiple events don't have a reference to the same object
						var copiedEventObject = $.extend({}, originalEventObject);
						// assign it the date that was reported
						var curr_date = date.getDate();
						var curr_month = date.getMonth() + 1;
						var curr_year = date.getFullYear();
						var curr_hour = date.getHours();
						var curr_min = date.getMinutes();

						var resdate = curr_year + "-" + curr_month + "-" + curr_date + " " + curr_hour + ":" + curr_min;

						copiedEventObject.start =resdate;
						//alert(resdate);
						
						//copiedEventObject.end = date;
						copiedEventObject.allDay = allDay;
						
						//saving the booking
					
				
					
					// assign it the date that was reported
					var curr_date1 = date.getDate();
					var curr_month1 = date.getMonth() + 1;
					var curr_year1 = date.getFullYear();
					var curr_hour1 = date.getHours();
					var curr_min1 = date.getMinutes();

					var resdate1 = curr_year1 + "-" + curr_month1 + "-" + curr_date1 + " " + curr_hour1 + ":" + curr_min1;
							$.ajax({
			  				url: "components/check-overlap-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&provider_event_title="+copiedEventObject.title+"&start_date="+resdate1,
			  				cache: false,
			  				success: function(html){
								
								if (html == "overlap"){
									revertFunc();
								}else{
								
									var str = copiedEventObject.title;
									var found1 = str.search("Permanente Sperrzeit");
									var found2 = str.search("Einmalige Sperrzeit");
									if (found1 == 0 || found2 == 0){
										if (found1 == 0){
											var permanent = 3;
										}else{
											var permanent = 4;
										}
									
										var durationtime=prompt("<?php echo translatefields(737);?>","");
										if (durationtime!=null && durationtime!=""){
											if (permanent == 3){
												var durationtimex=prompt("<?php echo translatefields(746);?>","52");
												if (durationtimex!=null && durationtimex!=""){
													$.ajax({
														url: "components/provider-reservation.php?email=no&provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&provider_event_title="+copiedEventObject.title+"&start_date="+resdate+"&duration="+durationtime+"&permanent="+permanent+"&durationnumber="+durationtimex,
														cache: false,
														success: function(html){
															//alert(resdate);
															//$('#calendar').fullCalendar('refetchEvents');
															//alert("<?php echo translatefields(428);?>!");
															$('#calendar').fullCalendar('refetchEvents');
															//document.location.href='index.php?option=my-calendar-reservation';
														}
													})
												}else{
													$.ajax({
														url: "components/provider-reservation.php?email=no&provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&provider_event_title="+copiedEventObject.title+"&start_date="+resdate+"&duration="+durationtime+"&permanent="+permanent,
														cache: false,
														success: function(html){
															//alert(resdate);
															//$('#calendar').fullCalendar('refetchEvents');
															//alert("<?php echo translatefields(428);?>!");
															$('#calendar').fullCalendar('refetchEvents');
															//document.location.href='index.php?option=my-calendar-reservation';
														}
													})
												}
											}else{
												$.ajax({
													url: "components/provider-reservation.php?email=no&provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&provider_event_title="+copiedEventObject.title+"&start_date="+resdate+"&duration="+durationtime+"&permanent="+permanent,
													cache: false,
													success: function(html){
														//alert(resdate);
														//$('#calendar').fullCalendar('refetchEvents');
														//alert("<?php echo translatefields(428);?>!");
														$('#calendar').fullCalendar('refetchEvents');
														//document.location.href='index.php?option=my-calendar-reservation';
													}
												})
											}
										}
									//}
									}else{
										$.ajax({
											url: "components/provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&provider_event_title="+copiedEventObject.title+"&start_date="+resdate,
											cache: false,
											success: function(html){
												//alert(resdate);
												//$('#calendar').fullCalendar('refetchEvents');
												alert("<?php echo translatefields(428);?>!");
												$('#calendar').fullCalendar('refetchEvents');
												//document.location.href='index.php?option=my-calendar-reservation';
											}
										})
									}
					}
					}
					})
						// render the event on the calendar
						// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
						$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
						
						
						
                     } 
                }
				
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			},
			events: 'components/my-json-events.php',
    		eventResize: function(event,dayDelta,minuteDelta,revertFunc) {
			if (event.reservation_status == 1){
					revertFunc();
					$('.qtip .qtip-cream .qtip-active').hide();
					$('.qtip').hide();
			}else{
            	if (event.id != "lunchbreak"){
					var date1 = event.start;
									// assign it the date that was reported
									var curr_date1 = date1.getDate();
									var curr_month1 = date1.getMonth() + 1;
									var curr_year1 = date1.getFullYear();
									var curr_hour1 = date1.getHours();
									var curr_min1 = date1.getMinutes();

									var resdate1 = curr_year1 + "-" + curr_month1 + "-" + curr_date1 + " " + curr_hour1 + ":" + curr_min1;
							$.ajax({
			  				url: "components/check-overlap-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate1,
			  				cache: false,
			  				success: function(html){
								
								if (html == "overlap"){
									revertFunc();
									//qtip-content qtip-content
									$('.qtip .qtip-cream .qtip-active').hide();
									$('.qtip').hide();
								}else{
									if (!confirm("<?php echo translatefields(741);?>")) {
										revertFunc();
										$('.qtip .qtip-cream .qtip-active').hide();
										$('.qtip').hide();
									}else{
									$('.qtip .qtip-cream .qtip-active').hide();
									$('.qtip').hide();
									var date = event.start;
									// assign it the date that was reported
									var curr_date = date.getDate();
									var curr_month = date.getMonth() + 1;
									var curr_year = date.getFullYear();
									var curr_hour = date.getHours();
									var curr_min = date.getMinutes();
									var resdate = curr_year + "-" + curr_month + "-" + curr_date + " " + curr_hour + ":" + curr_min;
									var date1 = event.end;
									// assign it the date that was reported
									var curr_date1 = date1.getDate();
									var curr_month1 = date1.getMonth() + 1;
									var curr_year1 = date1.getFullYear();
									var curr_hour1 = date1.getHours();
									var curr_min1 = date1.getMinutes();
									var resdate1 = curr_year1 + "-" + curr_month1 + "-" + curr_date1 + " " + curr_hour1 + ":" + curr_min1;
									//saving the booking
										if (event.reservation_status == 1 || event.reservation_status == 4 || event.reservation_status ==5){
											$.ajax({
												url: "components/resize-provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate+"&end_date="+resdate1,
												cache: false,
												success: function(html){
													//alert(html);
													//qtip-content qtip-content
													$('.qtip .qtip-cream .qtip-active').hide();
													$('.qtip').hide();
												}
											})
											if (event.reservation_status == 1 || event.reservation_status == 4){
												alert("<?php echo translatefields(742);?>");
											}
										}else{
											if (!confirm("<?php echo translatefields(745);?>")) {
												$.ajax({
													url: "components/resize-provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate+"&end_date="+resdate1,
													cache: false,
													success: function(html){
														//alert(html);
														//qtip-content qtip-content
														$('.qtip .qtip-cream .qtip-active').hide();
														$('.qtip').hide();
													}
												})
													alert("<?php echo translatefields(742);?>");
											}else{
												//updateallpermanent=1
												$.ajax({
													url: "components/resize-provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate+"&updateallpermanent=1&end_date="+resdate1,
													cache: false,
													success: function(html){
														//alert(html);
														//qtip-content qtip-content
														$('.qtip .qtip-cream .qtip-active').hide();
														$('.qtip').hide();
													}
												})
													alert("<?php echo translatefields(742);?>");
											}
										}
									}
								}
			  				}
						})
					
					}else{
						revertFunc();
						$('.qtip .qtip-cream .qtip-active').hide();
						$('.qtip').hide();
					}
				}
       		},
			
    	eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {
					/*isOverlapping(event));
					
					if (overlap == true){
						alert("overlap");
					}else{*/
				if (event.id != "lunchbreak"){
					var date1 = event.start;
									// assign it the date that was reported
									var curr_date1 = date1.getDate();
									var curr_month1 = date1.getMonth() + 1;
									var curr_year1 = date1.getFullYear();
									var curr_hour1 = date1.getHours();
									var curr_min1 = date1.getMinutes();

									var resdate1 = curr_year1 + "-" + curr_month1 + "-" + curr_date1 + " " + curr_hour1 + ":" + curr_min1;
							$.ajax({
			  				url: "components/check-overlap-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate1,
			  				cache: false,
			  				success: function(html){
								
								if (html == "overlap"){
									revertFunc();
									//qtip-content qtip-content
									$('.qtip .qtip-cream .qtip-active').hide();
									$('.qtip').hide();
								}else{
									if (!confirm("<?php echo translatefields(716);?>")) {
										revertFunc();
										$('.qtip .qtip-cream .qtip-active').hide();
										$('.qtip').hide();
									}else{
									$('.qtip .qtip-cream .qtip-active').hide();
									$('.qtip').hide();
									var date = event.start;
									// assign it the date that was reported
									var curr_date = date.getDate();
									var curr_month = date.getMonth() + 1;
									var curr_year = date.getFullYear();
									var curr_hour = date.getHours();
									var curr_min = date.getMinutes();
									var resdate = curr_year + "-" + curr_month + "-" + curr_date + " " + curr_hour + ":" + curr_min;
									//saving the booking
								if (event.reservation_status == 1 || event.reservation_status == 4 || event.reservation_status ==5){
									$.ajax({
										url: "components/update-provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate,
										cache: false,
										success: function(html){
											//alert(html);
											//qtip-content qtip-content
											$('.qtip .qtip-cream .qtip-active').hide();
											$('.qtip').hide();
										}
									})
									if (event.reservation_status == 1 || event.reservation_status == 4){
										alert("<?php echo translatefields(717);?>");
									}
								}else{
									if (!confirm("<?php echo translatefields(745);?>")) {
										$.ajax({
											url: "components/update-provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&start_date="+resdate,
											cache: false,
											success: function(html){
												//alert(html);
												//qtip-content qtip-content
												$('.qtip .qtip-cream .qtip-active').hide();
												$('.qtip').hide();
											}
										})
											alert("<?php echo translatefields(717);?>");
									}else{
										$.ajax({
											url: "components/update-provider-reservation.php?provider_id=<?php echo $_SESSION[WEBSITE_ALIAS]['admin_id'];?>&reservation_id="+event.id+"&provider_event_title="+event.title+"&updateallpermanent=1&start_date="+resdate,
											cache: false,
											success: function(html){
												//alert(html);
												//qtip-content qtip-content
												$('.qtip .qtip-cream .qtip-active').hide();
												$('.qtip').hide();
											}
										})
											alert("<?php echo translatefields(717);?>");
									}
								}
								
								
								
								
									}
								}
			  				}
						})
					
					}else{
						revertFunc();
						$('.qtip .qtip-cream .qtip-active').hide();
						$('.qtip').hide();
					}
        				
					//}
    	},
    		eventRender: function(event, element) {
       		element.qtip({
            	content: event.description,
            	style:'cream'
       		 });
    		},
			 eventClick: function( calEvent, jsEvent, view ) {
  				//var txt = calEvent.alldescriptions;
  				// for an image use: jQuery.facebox({ image: 'dude.jpg' })
  				// for ajax page use: jQuery.facebox({ ajax: 'remote.html' })
  				//jQuery.facebox(txt);
  				
  				$(this).qtip({
					//title:{text:calEvent.title,button:'Close'},
					content: {prerender: true,text: calEvent.alldescriptions},
					button: 'Close',
					position: {corner: {tooltip: 'leftMiddle', target: 'rightMiddle'}},
					style: {name : 'tipstyle'},
					show: {when: { event: 'click' },ready: true },
					hide: {fixed: true},
					scroll:true,
					adjust:{scroll:true}
                });
 			}
			
					
			/*eventClick: function(event) {
        		if (event.id) {
            		alert(id);
            		return false;
        		}
   			 }*/
		});
		$.fn.qtip.styles.tipstyle = {
		width: 350,
		padding: 5,
		background: '#eeeeee',
		color: 'black',
		textAlign: 'left',
		border: {
			width: 3,
			radius: 4
		},
		tip: 'leftMiddle',
		name: 'dark'
}
	
		
	});

</script>
<style type='text/css'>
		
	#external-events {
		float: left;
		width: 150px;
		padding: 0 10px;
		border: 1px solid #ccc;
		background: #eee;
		text-align: left;
		}
		
	#external-events h4 {
		font-size: 16px;
		margin-top: 0;
		padding-top: 1em;
		}
		
	.external-event { /* try to mimick the look of a real event */
		float:left;
		width:90px;
		margin-left:10px;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
		margin-bottom:5px;
		}
		
	#external-events p {
		margin: 1.5em 0;
		font-size: 11px;
		color: #666;
		}
		
	#external-events p input {
		margin: 0;
		vertical-align: middle;
		}

	#calendar {
		float: right;
		width: 765px;
		}

</style>
     <h1><?php echo $page_heading?></h1>
     <?php if ($cancellation == 1){?>
      <div id="system-message">
     <div class="info">
     <div class="message"><?php echo translatefields(400);?></div>
     </div>
     </div>
     <?php } ?>
	 <?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?>
     <div id="system-message">
     <div class="info">
     <div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "")?></div>
     </div>
     </div>
     <?php } ?>
     <br style="clear:both;" />
     <div id='external-events' style="float:right;">
<h4><?php
$sqlfield = mysql_query("select * from t_field_names where id=710");
		$rowfield = mysql_fetch_array($sqlfield);
		if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){
			$page_heading = $rowfield['fieldname_de'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){
			$page_heading = $rowfield['fieldname_eng'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){
			$page_heading = $rowfield['fieldname_fr'];
		}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){
			$page_heading = $rowfield['fieldname_it'];
		}
		echo fixEncoding($page_heading);
?></h4>
<?php
	$sqlproviderevents = mysql_query("select * from t_provider_events pe inner join t_currency c on c.id=pe.provider_event_price_currency where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	while ($rowproviderevents = mysql_fetch_array($sqlproviderevents)){
	if ($rowproviderevents['provider_event_color'] == "FFFFFF"){
		$textcolor= "color:black;font-color:black;";
	}else{
		$textcolor= "color:white;font-color:white;";
	}
?>
	<div style="float:left;">
	<a href="index.php?option=my-calendar-reservation&mode=edit&provider_event_id=<?php echo $rowproviderevents['provider_event_id'];?>#eventform"><image src="images/icon-edit.png" border="0" /></a> <a onclick="if(!confirm('<?php $str = translatefields(273);echo str_replace("%date_from% - %date_to%","",$str);?>')){return false;}" href="index.php?option=my-calendar-reservation&mode=delete&provider_event_id=<?php echo $rowproviderevents['provider_event_id'];?>)"><image src="images/icon-delete.png" border="0" /></a>
	</div>
	<div class='external-event' title="<?php echo $rowproviderevents['provider_event_description'];?><br/><b><?php echo translatefields(8);?></b>: <?php echo $rowproviderevents['provider_event_price'] . " " . $rowproviderevents['currency'];?>" <?php if ($rowproviderevents['provider_event_color'] != ""){echo 'style="'.$textcolor.'background-color:#'.$rowproviderevents['provider_event_color'].';"';}?>> <?php echo $rowproviderevents['provider_event_title'];?></div><br style="clear:both;">
<?php
	 if ($_REQUEST['provider_event_id'] != "" and $_REQUEST['mode'] != ""){
	 	if ($_REQUEST['provider_event_id'] == $rowproviderevents['provider_event_id']){

		$req_fld = REQ_FIELD;
		if ($_REQUEST['mode'] =="edit" and $_REQUEST['provider_event_id'] != ""){
		$sqleventedit = mysql_query("select * from t_provider_events where provider_event_id='".$_REQUEST['provider_event_id']."'");
		$roweventedit = mysql_fetch_array($sqleventedit);
		}

	 	?>
	 	<div style="clear:both;" id="eventform">
		<form method="post" action="index.php?option=my-calendar-reservation" id="frmeventmgmt">
			<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>">
			<?php if ($_REQUEST['mode'] == "edit"){?>
			<input type="hidden" name="provider_event_id" id="provider_event_id" value="<?php echo $_REQUEST['provider_event_id'];?>">
			<?php } ?>
			<div style="border-top:1px solid #cccccc;padding-top:5px;padding-bottom:5px;"><center><b></b></center></div>
			<b><?php echo translatefields(1);?></b> <?php echo $req_fld; ?><br />
            <input type="text" name="provider_event_title" id="provider_event_title" style="width:150px;" value="<?php echo fixEncoding($roweventedit['provider_event_title']);?>"/>
            <span class="validation-status"></span>
			<br />
			<b><?php echo translatefields(5);?></b> <?php echo $req_fld; ?><br />
            <textarea name="provider_event_description" id="provider_event_description" style="width:150px;height:auto;min-height:90px;"><?php echo fixEncoding($roweventedit['provider_event_description']);?></textarea>
            <span class="validation-status"></span>
			<br />
			<b><?php echo translatefields(718);?></b> <?php echo $req_fld; ?> 
            <input type="text" name="provider_event_duration" id="provider_event_duration" style="width:25px;" value="<?php echo fixEncoding($roweventedit['provider_event_duration']);?>"/>
            <span class="validation-status"></span>
			<br style="clear:both;"/>
			<div style="margin-top:7px;">
			<b><?php echo translatefields(8);?></b> <?php echo $req_fld; ?>&nbsp;
            <input type="text" name="provider_event_price" id="provider_event_price" value="<?php echo fixEncoding($roweventedit['provider_event_price']);?>" style="width:30px;" maxlength="4"/> <?php
			$value_display['value'] = "id";
			$value_display['display'] = "currency";
			if ($mode == "add"){$roweventedit['provider_event_price_currency']= 1;}
			$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."currency  order by currency asc");	
			echo $scaffold->dropdown_rs2($rs,$value_display,"provider_event_price_currency",$roweventedit['provider_event_price_currency'],"Select Currency","style=width:50px");
			?> 
            <span class="validation-status"></span>
			</div>
			<br />
			<b><?php echo translatefields(719);?></b> <?php echo $req_fld; ?><br />
            <?php
				$provider_event_vat = $mode=='add' ? 1 : $roweventedit['provider_event_vat'];
				echo $scaffold->radio_arr($options=array(translatefields(280),translatefields(281)), $values=array(1, 0), "provider_event_vat", $provider_event_vat, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
			?>
            <span class="validation-status"></span>
			<br /><br />
			<div style="<?php if ($roweventedit['provider_event_vat']==1){echo 'display:block;';}else{echo 'display:none;';}?>" id="displayvatamount">
			<b><?php echo translatefields(720);?></b> <?php echo $req_fld; ?>&nbsp;
            <input type="text" name="provider_event_vat_amount" id="provider_event_vat_amount" style="width:25px;" maxlength="3" value="<?php echo fixEncoding($roweventedit['provider_event_vat_amount']);?>"/>
            <span class="validation-status"></span>
			<br />
			</div>
			<script type="text/javascript" src="jscolor.js"></script>
			<div style="padding-top:7px;">
			<b><?php echo translatefields(721);?></b> <?php echo $req_fld; ?>&nbsp;
            <input type="text" name="provider_event_color" id="provider_event_color" class="color" style="width:15px;font-size:0px;height:11px;cursor:pointer;" value="<?php echo fixEncoding($roweventedit['provider_event_color']);?>" readonly="readonly"/>
            </div>
			<br />
			<br />
			<?php
				if ($mode == "add"){
					$buttonid = "262";
				}else{
					$buttonid = "272";
				}
			?>
			<center><input class="button" name="Submit" id="Submit" type="submit" value="<?php echo translatefields($buttonid);?>" style="margin-bottom:10px;"/><br /><input class="button" name="btnCancel" id="btnCancel" onclick="document.location.href='index.php?option=my-calendar-reservation'" type="button" value="<?php echo translatefields(271);?>" /></center>
		</form><br />
		<script type="text/javascript">
		$(document).ready(function() {
	var validator = $("#frmeventmgmt").validate({
		rules: {
			provider_event_title: "required",
			provider_event_description: "required",
			provider_event_duration:{required:true,number:true},
			provider_event_price: "required",
			provider_event_price_currency: "required",
			provider_event_vat_amount: "required",
			provider_event_color: "required"
		},
		messages: {
			provider_event_title: "",
			provider_event_description: "",
			provider_event_duration:{required:"",number:""},
			provider_event_price: "",
			provider_event_price_currency: "",
			provider_event_vat_amount: "",
			provider_event_color: ""
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form) {
			//$('#Submit').attr('disabled','disabled');
			form.submit(form);
		}
	});	
});
</script>
		
	</div>
	 	<?php
	 	}
	 }
	}
?>

<div class='external-event' title="<?php echo translatefields(732);?>" style="background-color:#eeeeee;border:1px solid #cccccc;color:black;font-color:black;font-size:12px;size:12px;float:right !important;margin-right:7px !important;"><?php echo translatefields(732);?>
		</div>
		<div class='external-event' title="<?php echo translatefields(733);?>" style="background-color:#eeeeee;border:1px solid #cccccc;color:black;font-color:black;font-size:12px;size:12px;float:right !important;margin-right:7px !important;"><?php echo translatefields(733);?>
		</div><div style="clear:both;height:10px;"></div>
<a  href="index.php?option=my-calendar-reservation&mode=add#eventform"><image src="images/add.png" border="0"/> <?php echo translatefields(105);?></a><br />


<script type="text/javascript">
function isOverlapping(event){
    var array = calendar.fullCalendar('clientEvents');
    for(i in array){
        if(array[i].id != event.id){
            if(!(array[i].start >= event.end || array[i].end <= event.start)){
                return true;
            }
        }
    }
    return false;
}

// Create the tooltips only on document load
$(document).ready(function() 
{
   // By suppling no content attribute, the library uses each elements title attribute by default
   $('.external-event').qtip({
      content: {
         text: true // Use each elements title attribute
      },
      style: 'cream' // Give it some style
   });
   
   // NOTE: You can even omit all options and simply replace the regular title tooltips like so:
   // $('#content a[href]').qtip();
   
   //displayvatamount
   $('#provider_event_vat_1').click(function () {
		$('#displayvatamount').hide();
	});
	$('#provider_event_vat_0').click(function () {
		$('#displayvatamount').show();
	});
});
</script>
<p>
<!--<input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>-->
</p>
<?php 
$req_fld = REQ_FIELD;
if ($_REQUEST['mode'] =="edit" and $_REQUEST['provider_event_id'] != ""){
	$sqleventedit = mysql_query("select * from t_provider_events where provider_event_id='".$_REQUEST['provider_event_id']."'");
	$roweventedit = mysql_fetch_array($sqleventedit);
}else{
	$roweventedit['provider_event_vat_amount'] = 8;
}
?>



	<div style="clear:both;<?php if ($_REQUEST['a'] !="" or $_REQUEST['mode'] != "add" ){echo "display:none;";}?>" id="eventform">
		<form method="post" action="index.php?option=my-calendar-reservation" id="frmeventmgmt">
			<input type="hidden" name="mode" id="mode" value="<?php echo $mode;?>">
			<?php if ($_REQUEST['mode'] == "edit"){?>
			<input type="hidden" name="provider_event_id" id="provider_event_id" value="<?php echo $_REQUEST['provider_event_id'];?>">
			<?php } ?>
			<div style="border-top:1px solid #cccccc;padding-top:5px;padding-bottom:5px;"><center><b></b></center></div>
			<b><?php echo translatefields(1);?></b> <?php echo $req_fld; ?><br />
            <input type="text" name="provider_event_title" id="provider_event_title" style="width:150px;" value="<?php echo fixEncoding($roweventedit['provider_event_title']);?>"/>
            <span class="validation-status"></span>
			<br />
			<b><?php echo translatefields(5);?></b> <?php echo $req_fld; ?><br />
            <textarea name="provider_event_description" id="provider_event_description" style="width:150px;height:auto;min-height:90px;"><?php echo fixEncoding($roweventedit['provider_event_description']);?></textarea>
            <span class="validation-status"></span>
			<br />
			<b><?php echo translatefields(718);?></b> <?php echo $req_fld; ?> 
            <input type="text" name="provider_event_duration" id="provider_event_duration" style="width:25px;" value="<?php echo fixEncoding($roweventedit['provider_event_duration']);?>"/>
            <span class="validation-status"></span>
			<br style="clear:both;"/>
			<div style="margin-top:7px;">
			<b><?php echo translatefields(8);?></b> <?php echo $req_fld; ?>&nbsp;
            <input type="text" name="provider_event_price" id="provider_event_price" value="<?php echo fixEncoding($roweventedit['provider_event_price']);?>" style="width:30px;" maxlength="4"/> <?php
			$value_display['value'] = "id";
			$value_display['display'] = "currency";
			if ($mode == "add"){$roweventedit['provider_event_price_currency']= 1;}
			$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."currency  order by currency asc");	
			echo $scaffold->dropdown_rs2($rs,$value_display,"provider_event_price_currency",$roweventedit['provider_event_price_currency'],"Select Currency","style=width:50px");
			?> 
            <span class="validation-status"></span>
			</div>
			<br />
			<b><?php echo translatefields(719);?></b> <?php echo $req_fld; ?><br />
            <?php
				$provider_event_vat = $mode=='add' ? 1 : $roweventedit['provider_event_vat'];
				echo $scaffold->radio_arr($options=array(translatefields(280),translatefields(281)), $values=array(1, 0), "provider_event_vat", $provider_event_vat, "&nbsp;&nbsp;&nbsp;", $other_attributes="");
			?>
            <span class="validation-status"></span>
			<br /><br />
			<div id="displayvatamount">
			<b><?php echo translatefields(720);?></b> <?php echo $req_fld; ?>&nbsp;
            <input type="text" name="provider_event_vat_amount" id="provider_event_vat_amount" style="width:25px;" maxlength="3" value="<?php echo fixEncoding($roweventedit['provider_event_vat_amount']);?>"/>
            <span class="validation-status"></span>
			<br />
			</div>
			<script type="text/javascript" src="jscolor.js"></script>
			<div style="padding-top:7px;">
			<b><?php echo translatefields(721);?></b> <?php echo $req_fld; ?>&nbsp;
            <input type="text" name="provider_event_color" id="provider_event_color" class="color" style="width:15px;font-size:0px;height:11px;cursor:pointer;" value="26A8FF" readonly="readonly"/>
            </div>
			<br />
			<br />
			<?php
				if ($mode == "add"){
					$buttonid = "262";
				}else{
					$buttonid = "272";
				}
			?>
			<center><input class="button" name="Submit" id="Submit" type="submit" value="<?php echo translatefields($buttonid);?>" style="margin-bottom:10px;"/><br><input class="button" name="btnCancel" id="btnCancel" onclick="document.location.href='index.php?option=my-calendar-reservation'" type="button" value="<?php echo translatefields(271);?>" /></center>
		</form><br /><div style="border-top:1px solid #cccccc;padding-top:5px;padding-bottom:5px;"><center><b></b></center></div>
		<script type="text/javascript">
		$(document).ready(function() {
	var validator = $("#frmeventmgmt").validate({
		rules: {
			provider_event_title: "required",
			provider_event_description: "required",
			provider_event_duration:{required:true,number:true},
			provider_event_price: "required",
			provider_event_price_currency: "required",
			provider_event_vat_amount: "required",
			provider_event_color: "required"
		},
		messages: {
			provider_event_title: "",
			provider_event_description: "",
			provider_event_duration:{required:"",number:""},
			provider_event_price: "",
			provider_event_price_currency: "",
			provider_event_vat_amount: "",
			provider_event_color: ""
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form) {
			//$('#Submit').attr('disabled','disabled');
			form.submit(form);
		}
	});	
});
</script>
<br />
	</div>
<a  href="index.php?option=my-calendar-reservation&taskmode=edit#calendarform"><image src="images/calendar.gif" border="0"/> <?php echo translatefields(738);?></a>
<?php if ($_REQUEST['taskmode'] !=""){
$sqlcalendar1 = mysql_query("select * from t_calendar_time_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");

$rowcalendar1 = mysql_fetch_array($sqlcalendar1);
if (mysql_num_rows($sqlcalendar) > 0){
	$mintime = $rowcalendar1['min_time'];
	$maxtime = $rowcalendar1['max_time'];
}else{
	$mintime = "0800";
	$maxtime = "1800";
}

?>
	<form method="post" action="index.php?option=my-calendar-reservation" id="calendarform">
			
			
			<br />
			<div style="border-top:1px solid #cccccc;padding-top:5px;padding-bottom:5px;"><center><b></b></center></div>
			
		
			<table cellpadding=2 cellspacing=2>
				<tr>
					<td><b><?php echo translatefields(739);?></b><?php echo $req_fld; ?></td>
					<td> <input type="text" name="min_time" id="min_time" style="width:30px;" minlength="4" maxlength="4" value="<?php echo $mintime;?>"/> <?php echo translatefields(753);?>
					<span class="validation-status"></span></td>
				</tr>
				<tr>
					<td><b><?php echo translatefields(740);?></b><?php echo $req_fld; ?></td>
					<td> <input type="text" name="max_time" id="max_time" style="width:30px;" minlength="4" maxlength="4" value="<?php echo $maxtime;?>"/> <?php echo translatefields(753);?>
					<span class="validation-status"></span></td>
				</tr>
			</tr>
			</table>
			<br />
			<?php
					$buttonid = "272";

			?>
			<center><input class="button" name="Submit" id="Submit" type="submit" value="<?php echo translatefields($buttonid);?>" style="margin-bottom:10px;"/><br><input class="button" name="btnCancel" id="btnCancel" onclick="document.location.href='index.php?option=my-calendar-reservation'" type="button" value="<?php echo translatefields(271);?>" /></center>
		</form>
		<script type="text/javascript">
		$(document).ready(function() {
	var validator = $("#calendarform").validate({
		rules: {
			min_time:{required:true,number:true},
			max_time:{required:true,number:true}
		},
		messages: {
			min_time:{required:"",number:"",minlength:"",maxlength=""},
			max_time:{required:"",number:"",minlength:"",maxlength=""}
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form) {
			//$('#Submit').attr('disabled','disabled');
			form.submit(form);
		}
	});	
});
</script>
<?php
}?>
<br /><br />
<?php 
$sqlcalendarx = mysql_query("select * from t_lunch_break_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
if (mysql_num_rows($sqlcalendarx) < 1){?>
<a  href="index.php?option=my-calendar-reservation&taskmode1=edit#lunchform"><image src="images/calendar.gif" border="0"/> <?php echo translatefields(752);?></a>
<?php if ($_REQUEST['taskmode1'] !=""){
$sqlcalendar1 = mysql_query("select * from t_lunch_break_settings where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");

$rowcalendar1 = mysql_fetch_array($sqlcalendar1);
if (mysql_num_rows($sqlcalendar) > 0){
	$starttime = $rowcalendar1['start_time'];
	$endtime = $rowcalendar1['end_time'];
}else{
	$starttime = "1200";
	$endtime = "1300";
}

?>
	<form method="post" action="index.php?option=my-calendar-reservation" id="lunchform">
			
			<div>
			<br />
			<div style="border-top:1px solid #cccccc;padding-top:5px;padding-bottom:5px;"><center><b></b></center></div>
			
			<table cellpadding=2 cellspacing=2>
				<tr>
					<td><b><?php echo translatefields(750);?></b><?php echo $req_fld; ?></td>
					<td> <input type="text" name="start_time" id="start_time" style="width:30px;" minlength="4" maxlength="4" value="<?php echo $starttime;?>"/> <?php echo translatefields(753);?>
					<span class="validation-status"></span></td>
				</tr>
				<tr>
					<td><b><?php echo translatefields(751);?></b><?php echo $req_fld; ?></td>
					<td> <input type="text" name="end_time" id="end_time" style="width:30px;" minlength="4" maxlength="4" value="<?php echo $endtime;?>"/> <?php echo translatefields(753);?>
					<span class="validation-status"></span></td>
				</tr>
				<tr>
					<td><b><?php echo translatefields(754);?></b><?php echo $req_fld; ?></td>
					<td> 
					<select name="start_day" id="start_day">
						<option value="1"><?php echo translatefields(188);?></option>
						<option value="2"><?php echo translatefields(189);?></option>
						<option value="3"><?php echo translatefields(190);?></option>
						<option value="4"><?php echo translatefields(191);?></option>
						<option value="5"><?php echo translatefields(192);?></option>
						<option value="6"><?php echo translatefields(193);?></option>
						<option value="7"><?php echo translatefields(194);?></option>
					</select>
					<span class="validation-status"></span></td>
				</tr>
				<tr>
					<td><b><?php echo translatefields(755);?></b><?php echo $req_fld; ?></td>
					<td> 
					<select name="end_day" id="end_day">
						<option value="1"><?php echo translatefields(188);?></option>
						<option value="2"><?php echo translatefields(189);?></option>
						<option value="3"><?php echo translatefields(190);?></option>
						<option value="4"><?php echo translatefields(191);?></option>
						<option value="5"><?php echo translatefields(192);?></option>
						<option value="6"><?php echo translatefields(193);?></option>
						<option value="7"><?php echo translatefields(194);?></option>
					</select>
					<span class="validation-status"></span></td>
				</tr>
			</table>
			</div>
			

			<br />
			<?php
					$buttonid = "272";

			?>
			<center><input class="button" name="Submit" id="Submit" type="submit" value="<?php echo translatefields($buttonid);?>" style="margin-bottom:10px;"/><br><input class="button" name="btnCancel" id="btnCancel" onclick="document.location.href='index.php?option=my-calendar-reservation'" type="button" value="<?php echo translatefields(271);?>" /></center>
		</form>
		<script type="text/javascript">
		$(document).ready(function() {
	var validator = $("#lunchform").validate({
		rules: {
			start_time:{required:true,number:true},
			end_time:{required:true,number:true}
		},
		messages: {
			start_time:{required:"",number:"",minlength:"",maxlength=""},
			end_time:{required:"",number:"",minlength:"",maxlength=""}
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form) {
			//$('#Submit').attr('disabled','disabled');
			form.submit(form);
		}
	});	
});
</script>
<?php
}?>
<br />
<?php } ?>


<br />
</div>

<div id='calendar' style="margin-right:15px;"></div>

<div style='clear:both'></div>
     