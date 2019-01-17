<?php
error_reporting(0);
session_start();
/*
Hi Sir, 

Here are the following updates:

Link to check: http://manimano.ch/wlw/index.php?option=my-calendar-reservation, this link is for the owner provider sir.

- translation for the month name, days, today, week, month, day, alert message are all in the database sir. you can check it in the t_fieldnames(id: 708-717)

- dragging the event from the right to the calendar with validating if it is valid or not. if the date and time was also in past, the event will not be drag and drop to that specific dates.

- hover effect description in the events in the calendar. once you click the event in the calendar there will be a popup box that will display all the information in the event. it is not yet finish but in that part i will put remove button.

- note sir, all the functions in the reservation are not yet in the database, it is next in line. only the translations are in the database. 

Please let me know your feedback sir. I have to update you sir on what I have now because it is a long way to finish this. We need to take it at a time.

Thanks,
Ken


*/
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
<div class='external-event'>Event 1</div>
<div class='external-event'>Event 2</div>
<div class='external-event'>Event 3</div>
<div class='external-event'>Event 4</div>
<div class='external-event'>Event 5</div>
<p>
<!--<input type='checkbox' id='drop-remove' /> <label for='drop-remove'>remove after drop</label>-->
</p>
</div>

<div id='calendar' style="margin-right:15px;"></div>

<div style='clear:both'></div>
     