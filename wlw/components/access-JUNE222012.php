<?php
	$sql_access = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	if (mysql_num_rows($sql_access) < 1){
		$provider_id_admin = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		mysql_query("insert into t_provider_access values('0','$provider_id_admin','0','','0','','0','','0','')");
	}else{
		$row_access = mysql_fetch_array($sql_access);
		$seminar_with_reservation = $row_access['seminar_with_reservation'];
		$swr_expiration_date = $row_access['swr_expiration_date'];
		$seminar_extended = $row_access['seminar_extended'];
		$s_expiration_date = $row_access['s_expiration_date'];
		$session_based = $row_access['session_based'];
		$session_expiration_date = $row_access['session_expiration_date'];
		$session_enhanced = $row_access['session_enhanced'];
		$session_enhanced_expiration_date = $row_access['session_enhanced_expiration_date'];
	}


?>

<h1><?php
		$sqlfield = mysql_query("select * from t_field_names where id=782");
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
	?>
</h1>
<?php if ($_GET['task'] == "cancelled"){
	$dateexpiration = date("Y-m-t") . " 23:59:59";
	$get_access_id = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$row_access_id = mysql_fetch_array($get_access_id);
	$rowaccessid = $row_access_id['provider_access_id'];
	
  if ($_GET['num_plan'] == 1){
	mysql_query("update t_provider_access set seminar_with_reservation=0,swr_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','1','$datetoday','$dateexpiration','$datetoday')");
	$bodycontentnum = 786;
  }elseif($_GET['num_plan'] == 2){
	mysql_query("update t_provider_access set seminar_extended=0,s_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','2','$datetoday','$dateexpiration','$datetoday')");
	$bodycontentnum = 787;
  }elseif($_GET['num_plan'] == 3){
	mysql_query("update t_provider_access set session_based=0,session_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','3','$datetoday','$dateexpiration','$datetoday')");
	$bodycontentnum = 788;
  }elseif($_GET['num_plan'] == 4){
	mysql_query("update t_provider_access set session_enhanced=0,session_enhanced_expiration_date='$dateexpiration' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Cancellation','4','$datetoday','$dateexpiration','$datetoday')");
	$bodycontentnum = 789;
  }
 
	//// sending email
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
	$to = $row->email;
	$username = $row->firstname;
	$language = $row->language;
	$gender = $row->gender;
	
	$subject = fixEncodingx(translatefields(797));
	$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
	$bodyemail = fixEncodingx(translatefields($bodycontentnum));
	$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
	//$bodyemail = str_replace("<our_footer>","",$bodyemail);
	$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
	$bodyemail = str_replace(",,","",$bodyemail);
	$body = $body . "" . $bodyemail . "</div>";
	$from = "info@spiritwings.ch";
	//echo $body;
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: $from\r\n";
	mail($to,$subject,$body,$headers);
?>
    <div id="system-message">
    <div class="info">
     <div class="message"><?php echo translatefields(784);?></div>
     </div>
     </div>
     <?php } ?>
	 
	 
	 
<?php if ($_GET['task'] == "booked"){
	$dateactivation = date("5000-m-t") . " 23:59:59";
	$get_access_id = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$row_access_id = mysql_fetch_array($get_access_id);
	$rowaccessid = $row_access_id['provider_access_id'];
  if ($_GET['num_plan'] == 1){
	mysql_query("update t_provider_access set seminar_with_reservation=1,swr_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	$datetoday = date('Y-m-d H:i:s');
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','1','$datetoday','$dateactivation','$datetoday')");
	$bodycontentnum = 790;
  }elseif($_GET['num_plan'] == 2){
	mysql_query("update t_provider_access set seminar_extended=1,s_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','2','$datetoday','$dateactivation','$datetoday')");
	$bodycontentnum = 791;
  }elseif($_GET['num_plan'] == 3){
	mysql_query("update t_provider_access set session_based=1,session_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','3','$datetoday','$dateactivation','$datetoday')");
	$bodycontentnum = 792;
  }elseif($_GET['num_plan'] == 4){
	mysql_query("update t_provider_access set session_enhanced=1,session_enhanced_expiration_date='$dateactivation' where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	mysql_query("insert into t_provider_access_history values ('0','$rowaccessid','Booking','4','$datetoday','$dateactivation','$datetoday')");
	$bodycontentnum = 793;
  }
 
	//// sending email
	$provider_id = $_SESSION[WEBSITE_ALIAS]['admin_id'];
	$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE id = '$provider_id'") ;	
	$to = $row->email;
	$username = $row->firstname;
	$language = $row->language;
	$gender = $row->gender;
	
	$subject = fixEncodingx(translatefields(794));
	$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>";
	$bodyemail = fixEncodingx(translatefields($bodycontentnum));
	$bodyemail = str_replace("<firstname> <lastname>","<b>".genderfields($gender) . " " . $row->firstname ." " . $row->lastname."</b>,",$bodyemail);
	$bodyemail = str_replace("<our_footer>",translatefields(649),$bodyemail);
	$bodyemail = str_replace(",,","",$bodyemail);
	$body = $body . "" . $bodyemail . "</div>";
	
	$from = "info@spiritwings.ch";
	//echo $body;
	$headers  = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	$headers .= "From: $from\r\n";
	mail($to,$subject,$body,$headers);
?>
    <div id="system-message">
    <div class="info">
     <div class="message"><?php echo translatefields(795);?></div>
     </div>
     </div>
     <?php } ?>	 
<?php
	$sql_access = mysql_query("select * from t_provider_access where provider_id='".$_SESSION[WEBSITE_ALIAS]['admin_id']."'");
	if (mysql_num_rows($sql_access) < 1){
		$provider_id_admin = $_SESSION[WEBSITE_ALIAS]['admin_id'];
		mysql_query("insert into t_provider_access values('0','$provider_id_admin','0','','0','','0','','0','')");
	}else{
		$row_access = mysql_fetch_array($sql_access);
		$seminar_with_reservation = $row_access['seminar_with_reservation'];
		$swr_expiration_date = $row_access['swr_expiration_date'];
		$seminar_extended = $row_access['seminar_extended'];
		$s_expiration_date = $row_access['s_expiration_date'];
		$session_based = $row_access['session_based'];
		$session_expiration_date = $row_access['session_expiration_date'];
		$session_enhanced = $row_access['session_enhanced'];
		$session_enhanced_expiration_date = $row_access['session_enhanced_expiration_date'];
	}
?>
<script type='text/javascript' src='plugins/jquery/jquery-ui-1.8.17.custom.min.js'></script>
<script type='text/javascript' src='plugins/jquery/jquery.qtip-1.0.0-rc3.min.js'></script>
<script type="text/javascript">
function cancelplan(num){
	if (!confirm("<?php echo translatefields(783);?>")) {
		return false;
	}else{
		document.location.href ='index.php?option=access&num_plan='+num+'&task=cancelled';
	}
}
// Create the tooltips only on document load
$(document).ready(function() 
{
   // By suppling no content attribute, the library uses each elements title attribute by default
   $('.external-event').qtip({
      content: {
         text: true // Use each elements title attribute
      },
	  position: {corner: {target: 'leftMiddle',tooltip: 'rightMiddle'}},
      style: 'blue'
   });
   
   $.fn.qtip.styles.tipstyle = {
		width: 250,
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

<?php
if ($_SESSION[WEBSITE_ALIAS]['language'] ==1){ // for DE language
?>
	<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat angewendet.
	Die Verrechnung ändern auch auf Ende Monat. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
			<th width="100px">&nbsp;</th>
		</tr>
		</thead>
		<tbody>
			<tr style="background-color:yellow;">
				<td style="background-color:yellow;">
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td style="background-color:yellow;">Kostenlos</td>
				<td style="background-color:yellow;"></td>
			</tr>
			<tr class="row1">
				<td <?php if ($seminar_with_reservation == 1 and $swr_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(1);"<?php } ?>>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td <?php if ($seminar_with_reservation == 1 and $swr_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(1);" <?php } ?>>10.- / Seminar</td>
				<?php if ($seminar_with_reservation == 1 and $swr_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(1);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="document.location.href='index.php?option=access&num_plan=1&task=booked'" class="button" /></td>
				<?php
				}?>
			</tr>
			<tr>
				<td <?php if ($seminar_extended == 1 and $s_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(2);" <?php } ?>>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td <?php if ($seminar_extended == 1 and $s_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(2);" <?php } ?>>10.- / Seminar</td>
				
				<?php if ($seminar_extended == 1 and $s_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(2);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="document.location.href='index.php?option=access&num_plan=2&task=booked'" class="button" /></td>
				<?php
				}?>
			</tr>
			<tr class="row1">
				<td <?php if ($session_based == 1 and $session_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(3);" <?php } ?>>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td <?php if ($session_based == 1 and $session_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(3);" <?php } ?>>10.-/Monat</td>
				
				<?php if ($session_based == 1 and $session_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(3);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="document.location.href='index.php?option=access&num_plan=3&task=booked'" class="button" /></td>
				<?php
				}?>
			</tr>
			<tr>
				<td <?php if ($session_enhanced == 1 and $session_enhanced_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(4);" <?php } ?>>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td <?php if ($session_enhanced == 1 and $session_enhanced_expiration_date > date('Y-m-d H:i:s')){ ?> style="background-color:yellow;cursor:pointer;" onclick="cancelplan(4);" <?php } ?>>20.-/Monat</td>
				<?php if ($session_enhanced == 1 and $session_enhanced_expiration_date > date('Y-m-d H:i:s')){ ?>
				<td style="background-color:yellow;cursor:pointer;"onclick="cancelplan(4);"></td>
				<?php }else{
				?>
				<td><input type="button" value="<?php echo translatefields(796);?>" onclick="document.location.href='index.php?option=access&num_plan=4&task=booked'" class="button" /></td>
				<?php
				}?>
			</tr>
		</tbody>
	</table>
<?php
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==2){  // for ENG language
?>
	<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat in 3 Monaten angewendet.
	Die Verrechnung ändern auch auf Ende Monat in 3 Monaten. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td>Kostenlos</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr>
				<td>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td>10.-/Monat</td>
			</tr>
			<tr>
				<td>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td>20.-/Monat</td>
			</tr>
		</tbody>
	</table>
<?php
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==3){  // for FR language
?>
<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat in 3 Monaten angewendet.
	Die Verrechnung ändern auch auf Ende Monat in 3 Monaten. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td>Kostenlos</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr>
				<td>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td>10.-/Monat</td>
			</tr>
			<tr>
				<td>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td>20.-/Monat</td>
			</tr>
		</tbody>
	</table>
<?php
}elseif ($_SESSION[WEBSITE_ALIAS]['language'] ==4){  // for IT language
?>
<b>Abos</b>
	<p>
	Sie können SpiritWings.ch nach Ihren Wünschen konfigurieren.
	Ihr aktuelle Einstellung finden Sie unten.</p>

	<p>Ein <b>Upgrade</b> / die Auswahl von mehr Optionen ist jederzeit möglich und wird
	sofort angewendet.
	Die Verrechnung eines Upgrades beginnt ab Beginn des laufenden Monats. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 eingeschaltet. Die Option beginnt sofort und die Verrechnung beginnt auf 1.Mai 2012 (wir verrechnen nur ganze Monate)."><b>(Beispiel)</b></span></p>


	<p>Ein <b>Downgrade</b> / abwählen von Optionen wird jeweils auf Ende Monat in 3 Monaten angewendet.
	Die Verrechnung ändern auch auf Ende Monat in 3 Monaten. <span class="external-event" title="Beispiel: Die Reservationsmöglichkeiten werden am 13.Mai 2012 ausgeschaltet, dann wird das effektiv am 31.Mai. Und ab diesem Datum tritt auch die geringere Verrechnung in Kraft."><b>(Beispiel)</b></span></p>

	<table class="record-list" width="100%">
		<thead>
		<tr>
			<th>Abo</th>
			<th width="100px;">Preis</th>
		</tr>
		</thead>
		<tbody>
			<tr>
				<td>
					<b>Seminare – Basis</b><br /><br />

					Seminare ausschreiben
					Seminardaten pflegen
					Seminarorte erfassen und pflegen
					Seminarleiter erfassen und pflegen 
					Erinnerungen für neue Termine erhalten
					Feedbacks erhalten. 
					Download der Seminar-Daten in den Kalender direkt über den Browser oder per Email.
				</td>
				<td>Kostenlos</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Seminare – mit Reservation</b><br /><br />

					Seminare – Basis + 
					Teilnehmer können über Spiritwings Plätze reservieren
					Verwalten der Warteliste 
					Verwalten von Abmeldungen
					Download der Teilnehmerliste und der Warteliste.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr>
				<td>
					<b>Seminare – erweitert</b><br /><br />

					Seminare – mit Reservation +
					Verwalten von Abmeldegebühren bei späten Abmeldungen
					Verwalten der Liste, wer bar bezahlt hat, wer eine Rechnung erhalten hat, und wann der Zahlungseingang war.
					Übersichten nach Seminar, Monat, Jahr, Teilnehmer.
				</td>
				<td>10.- / Seminar</td>
			</tr>
			<tr class="row1">
				<td>
					<b>Sitzungen – Basis</b><br /><br />
					verschiedene Sitzungen anbieten, Länge, Dauer, Beschreibung, Kosten.
					Definieren von Mittagspause, Sperrzeiten, Arbeitszeiten und Arbeitstagen.
					Kunden können freie Zeiten buchen.
					Automatische Bestätigungsemails für die Kunden.
					Handhaben von Storno für den Anbieter und den Kunden.
					Kostenfolge bei später Stornierung oder Verschiebung.
					Tages/Wochen/Monatsübersicht.
					Für jede Sitzung kann der MwSt-Satz hinterlegt werden.
				</td>
				<td>10.-/Monat</td>
			</tr>
			<tr>
				<td>
					<b>Sitzungen – erweitert</b><br /><br />

					Buchhaltungsoption: 
					Detaillierte Übersicht über einzelne Kunden
					Nachführen bezahlt  oder nicht
					Detaillierte Monatsübersicht.
					Ausdruck von Rechnungen, mit Einbezug der MwSt., Krankenkassenkonform.
					Mahnungslauf.
				</td>
				<td>20.-/Monat</td>
			</tr>
		</tbody>
	</table>
<?php
}
?>


	
	
</div>   	
   <style>
table.record-list {
	margin-top: 0.5em;
	/*border-spacing: 1px;*/
	background-color: #999;
	color: #666;
	border: #666 solid 1px;
	border-collapse: collapse;	
}

table.record-list td{ padding: 4px;}

table.record-list th { padding: 4px; font-size:14px;size:14px;}

table.record-list thead th {
	text-align: left;
	background: #f0f0f0;
	color: #666;
	border: 1px solid #666;
}

table.record-list thead a:hover { text-decoration: none; }

table.record-list thead th img { vertical-align: middle; }
table.record-list tbody th { font-weight: bold; }

table.record-list tbody tr { background-color: #fff;  text-align: left; }
table.record-list tbody tr.row1 { background: #f9f9f9; border-top: 1px solid #fff; }

table.record-list tbody tr.row0:hover td,
table.record-list tbody tr.row1:hover td { background-color: #ffd ; }

table.record-list tbody tr td  { height: 20px; background: #fff; border: 1px solid #666; padding: 3px; }
table.record-list tbody tr.row1 td { background: #f9f9f9; border-top: 1px solid #fff; }

table.record-list tfoot tr { text-align: left;  color: #333; }
table.record-list tfoot td,
table.record-list tfoot th { background-color: #f3f3f3; border-top: 1px solid #666; text-align: left; }

table.record-list td.order { text-align: center; white-space: nowrap; }
table.record-list td.order span { float: left; display: block; width: 20px; text-align: center; }

table.record-list .paginationB { display:table; padding:0;  margin:0 auto; }

table.record-list td.sub-total { text-align: right; font-weight: bold; font-size: 1em; }
table.record-list td.grand-total { text-align: right; font-weight: bold; font-size: 1.2em; background-color: #CCCCCC; color: #333333; }
</style>
