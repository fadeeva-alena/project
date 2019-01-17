<?php	
	/*
	
	
	ALTER TABLE `t_provider_reservation` ADD `block_type` VARCHAR( 10 ) NULL AFTER `reservation_cancelled_datetime` ,
ADD `block_type_day` VARCHAR( 100 ) NULL AFTER `block_type` 
	
	INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('728', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', 'Booked in current date only? If YES click YES. If NO click CANCEL, it will automatically added to the same day name in other weeks.', '11');
	
	
	
	
	
	
	
	
	for block option, here is the link to check, http://manimano.ch/wlw/index.php?option=my-calendar-reservation-test, i seperate it so that the current http://manimano.ch/wlw/index.php?option=my-calendar-reservation will not affect on this changes. Please let me know if the block times is OK with you sir.
	
	
	
	
ALTER TABLE  `t_provider` ADD  `handle_feedback_mails` TINYINT( 1 ) NOT NULL AFTER  `note`;

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('708', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', 'My Calendar Reservation', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('709', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', 'Calendar Reservation', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('710', 'My Events', 'My Events', 'My Events', 'My Events', 'My Events', 'My Events', 'My Events', 'My Events', 'My Events', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('711', 'today', 'today', 'today', 'today', 'today', 'today', 'today', 'today', 'today', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('712', 'month', 'month', 'month', 'month', 'month', 'month', 'month', 'month', 'month', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('713', 'week', 'week', 'week', 'week', 'week', 'week', 'week', 'week', 'week', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('714', 'day', 'day', 'day', 'day', 'day', 'day', 'day', 'day', 'day', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('715', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', 'You cannot book on this date and time!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('716', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', 'Are you sure about this move the reservation?', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('717', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', 'Successfully moved the reservation!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('731', 'Lunch Break', 'Lunch Break', 'Lunch Break', 'Lunch Break', 'Lunch Break', 'Lunch Break', 'Lunch Break', 'Lunch Break', 'Lunch Break', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('732', 'Permanent Block', 'Permanente Sperrzeit', 'Permanente Sperrzeit', 'Permanente Sperrzeit', 'Permanente Sperrzeit', 'Permanente Sperrzeit', 'Permanente Sperrzeit', 'Permanente Sperrzeit', 'Permanente Sperrzeit', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('733', 'One-shot Block', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', 'Einmalige Sperrzeit', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('734', 'Permanent', 'Permanent', 'Permanent', 'Permanent', 'Permanent', 'Permanent', 'Permanent', 'Permanent', 'Permanent', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('735', 'Einmalig', 'Einmalig', 'Einmalig', 'Einmalig', 'Einmalig', 'Einmalig', 'Einmalig', 'Einmalig', 'Einmalig', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('736', 'Blocked', 'Blocked', 'Blocked', 'Blocked', 'Blocked', 'Blocked', 'Blocked', 'Blocked', 'Blocked', '11');

	*/
	if ($page_option == ""){
		$page_option = "events";
	}

	switch ($page_option)
	{
		case 'my-calendar-reservation':
		$sqlfield = mysql_query("select * from t_field_names where id=708");
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
			//$page_heading = "Events Calendar";
			$page_name = "my-calendar-reservation";
			require('my-calendar-reservation.php');
			break;
			
		case 'my-calendar-reservation-test':
		$sqlfield = mysql_query("select * from t_field_names where id=708");
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
			//$page_heading = "Events Calendar";
			$page_name = "my-calendar-reservation";
			require('my-calendar-reservation-test.php');
			break;
		
		case 'calendar-reservation':
		$sqlfield = mysql_query("select * from t_field_names where id=709");
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
			//$page_heading = "Events Calendar";
			$page_name = "calendar-reservation";
			require('calendar-reservation.php');
			break;  
			
		case 'home':
			$page_heading = "Home";
			$page_name = "Home";
			require('home.php');
			break;  
	
		case 'home':
			$page_heading = "Home";
			$page_name = "Home";
			require('home.php');
			break;  
		case 'pages-m':
			$page_heading = "Page";
			$page_name = "pages";
			require('pages-maint.php');
			break; 
		case 'my-account':
			$page_heading = "My Account";
			$page_name = "my-account";
			require('my-account.php');
			break; 
		case 'home':
			$page_heading = "home";
			$page_name = "home";
			require('home.php');
			break; 

		case 'administrators':
			$page_heading = "Administrators";
			$page_name = "administrators";
			require('administrators.php');
			break;  
		case 'administrators-m':
			$page_heading = "Administrators";
			$page_name = "administrators";
			$transparent_bg = 1;
			require('administrators-maint.php');
			break; 
			
		
			
		case 'categories':
			$page_heading = "Categories";
			$page_name = "categories";
			require('categories.php');
			break;  
		case 'categories-m':
			$page_heading = "Categories";
			$page_name = "categories";
			require('categories-maint.php');
			break;  
		
case 'events-calendar':
	$sqlfield = mysql_query("select * from t_field_names where id=266");
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
			//$page_heading = "Events Calendar";
			$page_name = "events";
			require('events-calendar.php');
			break;  
		
case 'events-calendar-test':
	$sqlfield = mysql_query("select * from t_field_names where id=266");
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
			//$page_heading = "Events Calendar";
			$page_name = "events";
			require('events-calendar-test.php');
			break;  
			
		case 'translations':
			$sqlfield = mysql_query("select * from t_field_names where id=348");
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
			$page_name = "translations";
			require('translations.php');
			break;  
		case 'translations-m':
			$sqlfield = mysql_query("select * from t_field_names where id=348");
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
			$transparent_bg = 1;
			$page_name = "translations";
			require('translations-maint.php');
			break;  	
			
		case 'unified-events':
			$sqlfield = mysql_query("select * from t_field_names where id=605");
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
			$page_name = "unified-events";
			
			
				require('unified-events.php');
			
			
			break;	
            
        case 'unified-locations':
			$sqlfield = mysql_query("select * from t_field_names where id=619");
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
			$page_name = "unified-locations";
			
			
            require('unified-locations.php');
			
			
			break;
            
        case 'unified-locations-m':
			$sqlfield = mysql_query("select * from t_field_names where id=619");
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
			$page_name = "unified-locations-maint";
			
			
            require('unified-locations-maint.php');
			
			
			break;
            
        case 'unified-leaders':
			$sqlfield = mysql_query("select * from t_field_names where id=610");
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
			$page_name = "unified-leaders";
			
			
            require('unified-leaders.php');
			
			
			break;
            
        case 'unified-leaders-m':
			$sqlfield = mysql_query("select * from t_field_names where id=610");
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
			$page_name = "unified-leaders-m";
			
			
            require('unified-leaders-maint.php');
			
			
			break;





case 'handover-events':
			$sqlfield = mysql_query("select * from t_field_names where id=621");
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
			$page_name = "handover-events";
			
			
				require('handover-events.php');
			
			
			break;	
case 'handover-events-request':
			$sqlfield = mysql_query("select * from t_field_names where id=624");
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
			$page_name = "handover-events-request";
			
			
				require('handover-events-request.php');
			
			
			break;	
            
        case 'handover-locations':
			$sqlfield = mysql_query("select * from t_field_names where id=623");
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
			$page_name = "handover-locations";
			
			
            require('handover-locations.php');
			
			
			break;
            
        case 'handover-locations-request-m':
			$sqlfield = mysql_query("select * from t_field_names where id=626");
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
			$page_name = "handover-locations-request-maint";
			
			
            require('handover-locations-request-maint.php');
			
			
			break;
case 'handover-locations-request':
			$sqlfield = mysql_query("select * from t_field_names where id=626");
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
			$page_name = "handover-locations-request";
			
			
            require('handover-locations-request.php');
			
			
			break;

            
        case 'handover-leaders':
	$sqlfield = mysql_query("select * from t_field_names where id=622");
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
			$page_name = "handover-leaders";
			
			
            require('handover-leaders.php');
			
			
			break;
	case 'handover-leaders-request':
			$sqlfield = mysql_query("select * from t_field_names where id=625");
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
			$page_name = "handover-leaders-request";
			
			
            require('handover-leaders-request.php');
			
			
			break;
            

        case 'handover-leaders-request-m':
			$sqlfield = mysql_query("select * from t_field_names where id=625");
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
			$page_name = "handover-leaders-request-m";
			
			
            require('handover-leaders-request-maint.php');
			
			
			break;



case 'feedback-approval':
			$sqlfield = mysql_query("select * from t_field_names where id=689");
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
			$page_name = "feedback-approval";
			
			
            require('feedback-approval.php');
			
			
			break;
            

        case 'feedbackapproval':
			$sqlfield = mysql_query("select * from t_field_names where id=689");
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
			$page_name = "feedbackapproval";
			
			
            require('feedbackapproval.php');
			
			
			break;



	
		case 'events':
			$sqlfield = mysql_query("select * from t_field_names where id=80");
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
			$page_name = "events";
			
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 4) {
				$sqlfield = mysql_query("select * from t_field_names where id=348");
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
				require('translations.php');
			}else{
				require('events.php');
			}
			
			break;  
		case 'events-m':
			$sqlfield = mysql_query("select * from t_field_names where id=80");
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
		$transparent_bg = 1;
			$page_name = "events";
			require('events-maint.php');
			break;  
		
		case 'help':
     $sqlfield = mysql_query("select * from t_field_names where id=363");
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
     $page_name = "help";
     require('help-download.php');
     break;
		
		case 'about':
     $sqlfield = mysql_query("select * from t_field_names where id=297");
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
     $page_name = "about";
     require('about.php');
     break;
	 
	 case 'about-team':
     $sqlfield = mysql_query("select * from t_field_names where id=297");
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
     $page_name = "about";
     require('about-team.php');
     break;
	 
	 case 'users':
     $sqlfield = mysql_query("select * from t_field_names where id=298");
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
		$transparent_bg = 1;
     $page_name = "administrators";
     require('administrators-maint.php');
     break;
	 
	 case 'providers':
     $sqlfield = mysql_query("select * from t_field_names where id=29");
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
     $page_name = "providers";
     require('providers.php');
     break;  
     case 'providers-m':
     $sqlfield = mysql_query("select * from t_field_names where id=29");
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
		$transparent_bg = 1;
     $page_name = "providers-m";
     require('providers-maint.php');
     break;
	 
		
			 case 'leaders':
     $sqlfield = mysql_query("select * from t_field_names where id=82");
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
     $page_name = "leaders";
     require('leaders.php');
     break;  
     case 'leaders-m':
     $sqlfield = mysql_query("select * from t_field_names where id=82");
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
		$transparent_bg = 1;
     $page_name = "leaders";
     require('leaders-maint.php');
     break;
	 
	 case 'leaders2-m':
     $sqlfield = mysql_query("select * from t_field_names where id=82");
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
     $page_name = "leaders";
	 $transparent_bg = 1;
     require('leaders-maint2.php');
     break;
	 
	 case 'leaders4-m':
     $sqlfield = mysql_query("select * from t_field_names where id=82");
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
		$transparent_bg = 1;
     $page_name = "leaders";
     require('leaders-maint4.php');
     break;
	 
	 case 'leaders3-m':
     $sqlfield = mysql_query("select * from t_field_names where id=82");
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
		$transparent_bg = 1;
     $page_name = "leaders";
     require('leaders-maint3.php');
     break;
     
     case 'locations':
     $sqlfield = mysql_query("select * from t_field_names where id=81");
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
     $page_name = "locations";
     require('locations.php');
     break;  
     case 'locations-m':
     $sqlfield = mysql_query("select * from t_field_names where id=81");
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
     $page_name = "locations";
	 $transparent_bg = 1;
     require('locations-maint.php');
	 break;
	 case 'locations2-m':
     $sqlfield = mysql_query("select * from t_field_names where id=81");
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
     $page_name = "locations";
	 $transparent_bg = 1;
     require('locations-maint2.php');
     break;
	 
	  case 'locations3-m':
     $sqlfield = mysql_query("select * from t_field_names where id=81");
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
     $page_name = "locations";
	 $transparent_bg = 1;
     require('locations-maint3.php');
     break;
		case 'pages-m':
			$page_heading = "Section";
			$page_name = "pages";
			require('pages-maint.php');
			break;	
			
		case 'banners':
			$page_heading = "Banners";
			$page_name = "banners";
			require('banners.php');
			break;  
		case 'banners-m':
			$page_heading = "Banners";
			$page_name = "banners";
			require('banners-maint.php');
			break;
			
		case 'members':
			$page_heading = "Member Management";
			$page_name = "members";
			require('members.php');
			break;  
		case 'members-m':
			$page_heading = "Member Management";
			$page_name = "members";
			require('members-maint.php');
			break;
		case 'logout':
			require('logout.php');
			break;  
		//-> end of commong cases
		
		case 'activity-logs':
			$sqlfield = mysql_query("select * from t_field_names where id=303");
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
			$page_name = "activity-logs";
			require('activity-logs.php');
			break;  
		case 'activity-logs-m':
			$sqlfield = mysql_query("select * from t_field_names where id=303");
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
			$page_name = "activity-logs";
			require('activity-logs-maint.php');
			break;  
			
		
		case 'events-kind':
			$sqlfield = mysql_query("select * from t_field_names where id=358");
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
			$page_name = "events-kind";
			require('events-kind.php');
			break;  
		case 'events-kind-m':
			$sqlfield = mysql_query("select * from t_field_names where id=358");
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
		$transparent_bg = 1;
			$page_name = "events-kind";
			require('events-kind-maint.php');
			break; 

		case 'events-type':
			$sqlfield = mysql_query("select * from t_field_names where id=359");
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
			$page_name = "events-type";
			require('events-type.php');
			break;  
		case 'events-type-m':
			$sqlfield = mysql_query("select * from t_field_names where id=359");
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
		$transparent_bg = 1;
			$page_name = "events-type";
			require('events-type-maint.php');
			break; 
		
case 'events2':
			$sqlfield = mysql_query("select * from t_field_names where id=80");
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
			$page_name = "events2";
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 4) {
				$sqlfield = mysql_query("select * from t_field_names where id=348");
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
				require('translations.php');
			}else{
				require('events2.php');
			}
			break;  
		case 'events2-m':
			$sqlfield = mysql_query("select * from t_field_names where id=80");
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
			$page_name = "events";
			require('events-maint2.php');
			break;
			
		case 'events3':
			$sqlfield = mysql_query("select * from t_field_names where id=80");
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
			$page_name = "events3";
			require('events3.php');
			break;
			
		case 'reservations':
			$sqlfield = mysql_query("select * from t_field_names where id=394");
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
			$page_name = "reservation";
			require('reservations.php');
			break;

		case 'events3-m':
			$sqlfield = mysql_query("select * from t_field_names where id=80");
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
		$transparent_bg = 1;
			$page_name = "events";
			require('events-maint3.php');
			break;

		default:
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 4) {
				require('translations.php');
			}else{
				require('events.php');
			}
	}
	
?>