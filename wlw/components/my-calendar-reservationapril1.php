<?php
error_reporting(0);
session_start();
$mode = "add";
if (isset($_REQUEST['mode'])){
	$mode = $_REQUEST['mode'];
	if (isset($_POST['mode']) and $_POST['mode'] == "add"){
		$provider_event_title = $_POST['provider_event_title'];
		$provider_event_description = $_POST['provider_event_description'];
		$provider_event_duration = $_POST['provider_event_duration'];
		$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		mysql_query("insert into t_provider_events values ('0','$provider_id','$provider_event_title','$provider_event_description','$provider_event_duration',NOW())");
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
			mysql_query("update t_provider_events set provider_event_title='$provider_event_title',provider_event_description='$provider_event_description',provider_event_duration='$provider_event_duration' where provider_event_id='$provider_event_id'");			
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
				title: $.trim($(this).text()) // use the element's text as the event title
				//duration:5
			};
			
			// store the Event Object in the DOM element so we can get to it later
			$(this).data('eventObject', eventObject);
			
			// make the event draggable using jQuery UI
			$(this).draggable({
				zIndex: 999,
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
			drop: function(date, allDay) { // this function is called when something is dropped
			
			var myDate = new Date();
                    
                    //How many days to add from today?
                    //var daysToAdd = 20;
                    
                    myDate.setDate(myDate.getDate());
                	//alert(date +" - "+ myDate);
                    if (date < myDate) {
                        //TRUE Clicked date smaller than today + daysToadd
                    	alert("<?php echo translatefields(715);?>");    
                    }
                    else
                    {
                        //alert(id);
						// retrieve the dropped element's stored Event Object
						var originalEventObject = $(this).data('eventObject');
				
						// we need to copy it, so that multiple events don't have a reference to the same object
						var copiedEventObject = $.extend({}, originalEventObject);
				
						// assign it the date that was reported
						copiedEventObject.start = date;
						//copiedEventObject.end = date;
						copiedEventObject.allDay = allDay;
				
						// render the event on the calendar
						// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
						$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);
                     }   
				
				
				// is the "remove after drop" checkbox checked?
				if ($('#drop-remove').is(':checked')) {
					// if so, remove the element from the "Draggable Events" list
					$(this).remove();
				}
				
			},
			events: [
				{
					title: 'Event 1',
					start: '2012-03-30 08:00:00',
					description: 'lorem ipsum in the lorem pisum controller.',
					id:'1',
					end: '2012-03-30 10:00:00',
					allDay: false,
					color: '#aaaaaa',   // an option!
    				textColor: 'black',
					editable: true
				},{
					title: 'Event 2',
					id: '2',
					description: 'lorem ipsum in the lorem pisum controller.',
					start: '2012-03-30 10:00:00',
					end: '2012-03-30 12:00:00',
					allDay: false,
					editable: true
				}
			],
    	eventDrop: function(event,dayDelta,minuteDelta,allDay,revertFunc) {

        
					
        

        				if (!confirm("<?php echo translatefields(716);?>")) {
            				revertFunc();
        				}else{
        				/*alert(
            			event.title + " was moved " +
            			dayDelta + " days and " +
            			minuteDelta + " minutes."
        				);*/
        				alert("<?php echo translatefields(717);?>");
        				}
        			

    	},
    		eventRender: function(event, element) {
       		element.qtip({
            	content: event.description,
            	style:'cream'
       		 });
    		},
			 eventClick: function( calEvent, jsEvent, view ) {
  				var txt = calEvent.title + '<br>' +
            	calEvent.start + ' - ' +
            	calEvent.end + '<br>' +
            	calEvent.description;
  				// for an image use: jQuery.facebox({ image: 'dude.jpg' })
  				// for ajax page use: jQuery.facebox({ ajax: 'remote.html' })
  				jQuery.facebox(txt);
 			}
			
			/*eventClick: function(event) {
        		if (event.id) {
            		alert(id);
            		return false;
        		}
   			 }*/
		});
		
		
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
		margin: 10px 0;
		padding: 2px 4px;
		background: #3366CC;
		color: #fff;
		font-size: .85em;
		cursor: pointer;
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
	$sqlproviderevents = mysql_query("select * from t_provider_events where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	while ($rowproviderevents = mysql_fetch_array($sqlproviderevents)){
?>
	<div class='external-event' title="<?php echo $rowproviderevents['provider_event_description'];?>"><a href="index.php?option=my-calendar-reservation&mode=edit&provider_event_id=<?php echo $rowproviderevents['provider_event_id'];?>#eventform"><image src="images/icon-edit.png" border="0" /></a> <a onclick="if(!confirm('<?php $str = translatefields(273);echo str_replace("%date_from% - %date_to%","",$str);?>')){return false;}" href="index.php?option=my-calendar-reservation&mode=delete&provider_event_id=<?php echo $rowproviderevents['provider_event_id'];?>)"><image src="images/icon-delete.png" border="0" /></a> <?php echo $rowproviderevents['provider_event_title'];?></div>
<?php
	}
?>
<a  href="index.php?option=my-calendar-reservation&mode=add#eventform"><image src="images/add.png" border="0"/> <?php echo translatefields(105);?></a>
<script type="text/javascript">
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
   $('#btnCancel').click(function () {
		//location.href = '<?php echo INDEX_PAGE."events"?>';
		location.href = '<?php echo INDEX_PAGE."my-calendar-reservation"?>';
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
}
?>
	<div style="clear:both;<?php if ($_REQUEST['a'] !="" or $_REQUEST['mode'] == ""){echo "display:none;";}?>" id="eventform">
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
            <textarea name="provider_event_description" id="provider_event_description" style="width:150px;height:auto;min-height:30px;"><?php echo fixEncoding($roweventedit['provider_event_description']);?></textarea>
            <span class="validation-status"></span>
			<br />
			<b><?php echo translatefields(718);?></b> <?php echo $req_fld; ?><br />
            <input type="text" name="provider_event_duration" id="provider_event_duration" style="width:150px;" maxlength="2" value="<?php echo fixEncoding($roweventedit['provider_event_duration']);?>"/>
            <span class="validation-status"></span>
			<br />
			<?php
				if ($mode == "add"){
					$buttonid = "262";
				}else{
					$buttonid = "272";
				}
			?>
			<center><input class="button" name="Submit" id="Submit" type="submit" value="<?php echo translatefields($buttonid);?>" style="margin-bottom:10px;"/><!--&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="<?php echo translatefields(271);?>" />--></center>
		</form>
		<script type="text/javascript">
		$(document).ready(function() {
	var validator = $("#frmeventmgmt").validate({
		rules: {
			provider_event_title: "required",
			provider_event_description: "required",
			provider_event_duration:{required:true,number:true}
		},
		messages: {
			provider_event_title: "",
			provider_event_description: "",
			provider_event_duration:{required:"",number:""}
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

</div>

<div id='calendar' style="margin-right:15px;"></div>

<div style='clear:both'></div>
     