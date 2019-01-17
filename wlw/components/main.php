<?php	

//mysql_query("TRUNCATE TABLE `t_provider_reservation`");


	/*
	
	
	DROP TABLE IF EXISTS `t_vat`;
CREATE TABLE `t_vat` (
  `vat` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records 
-- ----------------------------
INSERT INTO `t_vat` VALUES ('8');
	
	
	-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2012 at 06:08 AM
-- Server version: 5.1.53
-- PHP Version: 5.3.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `wu_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_userlevel`
--

CREATE TABLE IF NOT EXISTS `t_userlevel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_level` varchar(10) DEFAULT NULL,
  `events` tinyint(1) DEFAULT NULL,
  `locations` tinyint(1) DEFAULT NULL,
  `leaders` tinyint(1) DEFAULT NULL,
  `provider_main_menu` tinyint(1) DEFAULT NULL,
  `provider_r` tinyint(1) DEFAULT NULL,
  `provider_w` tinyint(1) DEFAULT NULL,
  `unified_records` tinyint(1) DEFAULT NULL,
  `unified_event` tinyint(1) DEFAULT NULL,
  `unified_leader` tinyint(1) NOT NULL,
  `unified_locations` tinyint(1) NOT NULL,
  `handover_main_menu` tinyint(1) NOT NULL,
  `request_hand_over_event` tinyint(1) NOT NULL,
  `request_hand_over_leader` tinyint(1) NOT NULL,
  `request_hand_over_locations` tinyint(1) NOT NULL,
  `request_hand_over_event_management` tinyint(1) NOT NULL,
  `request_hand_over_leader_management` tinyint(1) NOT NULL,
  `request_hand_over_locations_management` tinyint(1) NOT NULL,
  `types_categories_main_menu` tinyint(1) NOT NULL,
  `event_type` tinyint(1) NOT NULL,
  `event_category` tinyint(1) NOT NULL,
  `feedback_approval` tinyint(1) NOT NULL,
  `translations` tinyint(1) NOT NULL,
  `activity_log_management` tinyint(1) NOT NULL,
  `event_calendar` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `t_userlevel`
--

INSERT INTO `t_userlevel` (`id`, `user_level`, `events`, `locations`, `leaders`, `provider_main_menu`, `provider_r`, `provider_w`, `unified_records`, `unified_event`, `unified_leader`, `unified_locations`, `handover_main_menu`, `request_hand_over_event`, `request_hand_over_leader`, `request_hand_over_locations`, `request_hand_over_event_management`, `request_hand_over_leader_management`, `request_hand_over_locations_management`, `types_categories_main_menu`, `event_type`, `event_category`, `feedback_approval`, `translations`, `activity_log_management`, `event_calendar`) VALUES
(1, 'admin', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 'user rw', 1, 1, 1, 1, 1, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0),
(3, 'user r', 1, 1, 1, 1, 1, 1, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 1),
(4, 'translator', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0);

	
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

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('738', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', 'Edit Calendar Time Setting', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('739', 'Min Time', 'Min Time', 'Min Time', 'Min Time', 'Min Time', 'Min Time', 'Min Time', 'Min Time', 'Min Time', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('740', 'Max Time', 'Max Time', 'Max Time', 'Max Time', 'Max Time', 'Max Time', 'Max Time', 'Max Time', 'Max Time', '11');

CREATE TABLE IF NOT EXISTS `t_calendar_time_settings` (
  `calendar_time_settings_id` int(10) NOT NULL AUTO_INCREMENT,
  `provider_id` int(10) NOT NULL,
  `min_time` int(10) NOT NULL,
  `max_time` int(10) NOT NULL,
  PRIMARY KEY (`calendar_time_settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('741', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', 'Are you sure you want to resize the duration?', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('742', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', 'Reservation dureation was successfully RESIZED!', '11');


INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('743', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'though we have more than 10,000 entries, we dont have a match, please make your search less specific.', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', 'Obwohl wir �ber 10,000 Eintr�ge haben, gibt es f�r diese Suche kein Ergebnis. Suchen sie allgemeiner / entfernen Sie einen der Suchbegriffe', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('744', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', 'Jede Veranstaltung hat eine Qualit�t - um erfolgreich zu suchen ben�tigen Sie mindestens eine Qualit�t - aktivieren Sie zuerst eine andere, dann k�nnen Sie die gew�hlte abschalten.', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('745', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', 'Applied in all blocked dates?', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('746', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', 'Enter number of weeks(if no # inputted the block is no end date)', '11');


INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('750', 'Start Time', 'Start Time', 'Start Time', 'Start Time', 'Start Time', 'Start Time', 'Start Time', 'Start Time', 'Start Time', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('751', 'End Time', 'End Time', 'End Time', 'End Time', 'End Time', 'End Time', 'End Time', 'End Time', 'End Time', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('752', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', 'Lunch Break Settings', '11');

CREATE TABLE IF NOT EXISTS `t_lunch_break_settings` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `provider_id` int(10) NOT NULL,
  `lunch_start` int(10) NOT NULL,
  `lunch_end` int(10) NOT NULL,
  `lunch_day_start` int(10) NOT NULL,
  `lunch_day_end` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('753', 'Uhr', 'Uhr', 'Uhr', 'Uhr', 'Uhr', 'Uhr', 'Uhr', 'Uhr', 'Uhr', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('754', 'Day Start', 'Day Start', 'Day Start', 'Day Start', 'Day Start', 'Day Start', 'Day Start', 'Day Start', 'Day Start', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('755', 'Day End', 'Day End', 'Day End', 'Day End', 'Day End', 'Day End', 'Day End', 'Day End', 'Day End', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('756', 'My Sessions', 'My Sessions', 'My Sessions', 'My Sessions', 'My Sessions', 'My Sessions', 'My Sessions', 'My Sessions', 'My Sessions', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('757', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', 'Sessions from Other Provider', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('761', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', 'Welcome Provider Subject!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('762', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', 'Hello <firstname> <lastname>, <p>Here is your <username> and <password>.</p> <p> <our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('763', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', 'Please enter at least: ', '11');
INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('765', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', 'Confirm password must be equal to password', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('766', 'User successfully added!', 'User successfully added!', 'User successfully added!', 'User successfully added!', 'User successfully added!', 'User successfully added!', 'User successfully added!', 'User successfully added!', 'User successfully added!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('767', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', 'Invalid email address!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('768', 'Already exist!', 'Already exist!', 'Already exist!', 'Already exist!', 'Already exist!', 'Already exist!', 'Already exist!', 'Already exist!', 'Already exist!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('769', 'Required!', 'Required!', 'Required!', 'Required!', 'Required!', 'Required!', 'Required!', 'Required!', 'Required!', '11');

/////////////////
ALTER TABLE `t_provider`  ADD `translator` TINYINT(1) NOT NULL AFTER `penalty`,  ADD `user_r` TINYINT(1) NOT NULL AFTER `translator`,  ADD `user_w` TINYINT(1) NOT NULL AFTER `user_r`,  ADD `admin` TINYINT(1) NOT NULL AFTER `user_w`,  ADD `events_reservations` TINYINT(1) NOT NULL AFTER `admin`,  ADD `events_bookholding` TINYINT(1) NOT NULL AFTER `events_reservations`,  ADD `session_reservation` TINYINT(1) NOT NULL AFTER `events_bookholding`,  ADD `session_bookholding` TINYINT(1) NOT NULL AFTER `session_reservation`;

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('770', 'User Role', 'User Role', 'User Role', 'User Role', 'User Role', 'User Role', 'User Role', 'User Role', 'User Role', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('771', 'Translator', 'Translator', 'Translator', 'Translator', 'Translator', 'Translator', 'Translator', 'Translator', 'Translator', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('772', 'User R', 'User R', 'User R', 'User R', 'User R', 'User R', 'User R', 'User R', 'User R', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('773', 'User W', 'User W', 'User W', 'User W', 'User W', 'User W', 'User W', 'User W', 'User W', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('774', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', 'Admin', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('775', 'Events Reservation', 'Events Reservation', 'Events Reservation', 'Events Reservation', 'Events Reservation', 'Events Reservation', 'Events Reservation', 'Events Reservation', 'Events Reservation', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('776', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', 'Events Bookholding', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('777', 'Required!', 'Session Reservation', 'Session Reservation', 'Session Reservation', 'Session Reservation', 'Session Reservation', 'Session Reservation', 'Session Reservation', 'Session Reservation', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('778', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', 'Session Bookholding', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('779', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', 'if you want to use reservations, you need to upgrade your plan.', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('782', 'Access', 'Access', 'Access', 'Access', 'Access', 'Access', 'Access', 'Access', 'Access', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('783', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', 'Do you want to cancell this plan?', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('784', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', 'Plan was successfully CANCELLED!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('785', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', 'Cancellation Access Email Subject', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('786', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar with reservation).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('787', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Extended).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('788', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Based).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('789', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the cancellation of the option (Seminar Enhanced).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('790', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar with reservation).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('791', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Extended).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('792', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Based).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('793', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '<firstname> <lastname>,<p>Herewith we confirm the booking of the option (Seminar Enhanced).</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('794', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', 'Booking Access Email Subject', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('795', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', 'Plan successfully BOOKED!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('796', 'Booked plan?', 'Booked plan?', 'Booked plan?', 'Booked plan?', 'Booked plan?', 'Booked plan?', 'Booked plan?', 'Booked plan?', 'Booked plan?', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('798', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'Seminare erweitert ist eine Ergänzung von Seminare - mit Reservation. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Seminare - mit Reservation automatisch dazugebucht.', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', 'in order to book seminare -erwetitert, which is an extension of seminare - mit reservation, you will automatically also book semianre -mit reservation', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('799', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Seminare - mit Reservation kann nicht abgeschaltet werden ohne dass auch die Funktion Seminare- erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('800', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', 'Sitzungen erweitert ist eine Ergänzung von Sitzungen - Basis. Wenn Sie diese Buchung bestätigen, wird die Grundfunktion Sitzungen - Basis automatisch dazugebucht.', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('801', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', 'Sitzungen - Basis kann nicht abgeschaltet werden ohne dass auch die Funktion Sitzungen-Erweitert abgeschaltet wird. Wenn Sie OK drücken, werden beide abgeschaltet.', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('802', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', 'Payment not successful!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('803', 'Plan', 'Plan', 'Plan', 'Plan', 'Plan', 'Plan', 'Plan', 'Plan', 'Plan', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('818', 'Bill #', 'Bill #', 'Bill #', 'Bill #', 'Bill #', 'Bill #', 'Bill #', 'Bill #', 'Bill #', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('819', 'Edit my Plans', 'Optionen ändern', 'Edit my Plans', 'Edit my Plans', 'Edit my Plans', 'Edit my Plans', 'Edit my Plans', 'Edit my Plans', 'Edit my Plans', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('804', 'Months Plan?', 'Months Plan?', 'Months Plan?', 'Months Plan?', 'Months Plan?', 'Months Plan?', 'Months Plan?', 'Months Plan?', 'Months Plan?', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('805', 'Card Type', 'Card Type', 'Card Type', 'Card Type', 'Card Type', 'Card Type', 'Card Type', 'Card Type', 'Card Type', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('806', 'Card Number', 'Card Number', 'Card Number', 'Card Number', 'Card Number', 'Card Number', 'Card Number', 'Card Number', 'Card Number', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('807', 'Expiration', 'Expiration', 'Expiration', 'Expiration', 'Expiration', 'Expiration', 'Expiration', 'Expiration', 'Expiration', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('808', 'CCV Number', 'CCV Number', 'CCV Number', 'CCV Number', 'CCV Number', 'CCV Number', 'CCV Number', 'CCV Number', 'CCV Number', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('809', 'Pay Now!', 'Pay Now!', 'Pay Now!', 'Pay Now!', 'Pay Now!', 'Pay Now!', 'Pay Now!', 'Pay Now!', 'Pay Now!', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('810', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', 'Plan: Seminare – mit Reservation Expiration Email Subject', '11');

ALTER TABLE `t_provider_access_history` ADD `price` VARCHAR( 10 ) NOT NULL AFTER `access_date_created` ,
ADD `vat` VARCHAR( 10 ) NOT NULL AFTER `price` ,
ADD `month` VARCHAR( 10 ) NOT NULL AFTER `vat` ,
ADD `bill_number` INT( 10 ) NOT NULL AFTER `month` ;

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('811', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', 'Plan: Seminare – erweitert Expiration Email Subject', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('812', 'Plan: Sitzungen – Basis Plan: Sitzungen – Basis Expiration Email Subject Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', 'Plan: Sitzungen – Basis Expiration Email Subject', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('813', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', 'Plan: Sitzungen – erweitert Expiration Email Subject', '11');


INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('814', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – mit Reservation will expire on <expiration_date>.</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('815', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Seminare – erweitert Expiration will expire on <expiration_date>.</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('816', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – Basis Plan will expire on <expiration_date>.</p><our_footer>', '11');

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('817', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '<firstname> <lastname>,<p>Your plan Sitzungen – erweitert will expire on <expiration_date>.</p><our_footer>', '11');

CREATE TABLE `wu_db`.`t_plan_reminders_config` (
`id` INT( 2 ) NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`first_reminder_before` INT( 2 ) NOT NULL ,
`second_reminder_before` INT( 2 ) NOT NULL
) ENGINE = MYISAM ;

INSERT INTO `wu_db`.`t_plan_reminders_config` (`id`, `first_reminder_before`, `second_reminder_before`) VALUES ('1', '7', '14');

CREATE TABLE IF NOT EXISTS `t_provider_access` (
  `provider_access_id` int(10) NOT NULL AUTO_INCREMENT,
  `provider_id` int(10) NOT NULL,
  `seminar_with_reservation` tinyint(1) NOT NULL,
  `swr_expiration_date` datetime NOT NULL,
  `seminar_extended` tinyint(1) NOT NULL,
  `s_expiration_date` datetime NOT NULL,
  `session_based` tinyint(1) NOT NULL,
  `session_expiration_date` datetime NOT NULL,
  `session_enhanced` tinyint(1) NOT NULL,
  `session_enhanced_expiration_date` datetime NOT NULL,
  PRIMARY KEY (`provider_access_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

INSERT INTO `t_provider_access` (`provider_access_id`, `provider_id`, `seminar_with_reservation`, `swr_expiration_date`, `seminar_extended`, `s_expiration_date`, `session_based`, `session_expiration_date`, `session_enhanced`, `session_enhanced_expiration_date`) VALUES
(1, 1, 1, '2012-06-30 23:59:59', 1, '2012-06-30 23:59:59', 1, '2012-06-30 23:59:00', 1, '2012-06-30 23:59:59');

CREATE TABLE IF NOT EXISTS `t_provider_access_history` (
  `provider_access_history_id` int(10) NOT NULL AUTO_INCREMENT,
  `provider_access_id` int(10) NOT NULL,
  `action_type` varchar(100) NOT NULL,
  `action_option_type` varchar(100) NOT NULL,
  `access_date_start` datetime NOT NULL,
  `access_date_end` datetime NOT NULL,
  `access_date_created` datetime NOT NULL,
  PRIMARY KEY (`provider_access_history_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

INSERT INTO `wu_db`.`t_field_names` (`id`, `fieldname`, `fieldname_de`, `fieldname_eng`, `fieldname_fr`, `fieldname_it`, `helptext_de`, `helptext_eng`, `helptext_fr`, `helptext_it`, `table`) VALUES ('830', 'Weitere Veranstaltungen in der nächsten Zeit', 'Weitere Veranstaltungen in der nächsten Zeit', 'More Events coming up', 'More Events coming up', 'More Events coming up', 'Weitere Veranstaltungen in der nächsten Zeit', 'More Events coming up', 'More Events coming up', 'More Events coming up', '11');

Gmail account for sandbox

u: sandboxdeveloper123@gmail.com
p: sandboxdeveloper123

Paypal Sandbox account

u: sandboxdeveloper123@gmail.com
p: sandboxdeveloper123

sandbox login inside
https://www.sandbox.paypal.com/cgi-bin/webscr?cmd=_login-run&mmgr=yes
u: sando@gmail.com /sandbo_1341194035_biz@gmail.com
p: sandbox123

API Username	sandbo_1341194035_biz_api1.gmail.com
API Password	TZGLZFZSJSJUBGCS
Signature	A5IvelPioMAqW10F9mtpoT3AQxfuAdxM6qq7PqCJ0Es7NWumD3kWO9h6

Credit Card: Visa   4436701199871582
Exp Date:  7/2017 

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
			
		case 'access':
			$sqlfield = mysql_query("select * from t_field_names where id=780");
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
			$page_name = "access";
			require('access.php');
			break;
			
		case 'access-test':
			$sqlfield = mysql_query("select * from t_field_names where id=780");
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
			$page_name = "access-test";
			require('access-test.php');
			break;
		
		case 'access-test-aim':
			$sqlfield = mysql_query("select * from t_field_names where id=780");
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
			$page_name = "access-test-aim";
			require('access-test-aim.php');
			break;

		default:
			if ($_SESSION[WEBSITE_ALIAS]['user_level'] == 4) {
				require('translations.php');
			}else{
				require('events.php');
			}
	}
	
?>