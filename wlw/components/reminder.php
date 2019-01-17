<?php
	session_start();
	require ( '../includes/config.php' );
	require ( '../'.PATH_LIBRARIES.'libraries.php' );
	
		$datereminder = date('Y-m-d');
		$sql = mysql_query("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE reminder = '$datereminder'") ;	
		
		while ($row = mysql_fetch_array($sql))
		{
			//sending an email here
			$to = $row['email'];
			$username = $row['firstname'];
			$language = $row['language'];
			$gender = $row['gender'];
			if ($language == 1){
				/////-> for de.
				if ($gender == 1){ // male
					$gendername = "";
				}else { // female
					$gendername = "";
				}
				$subject = "Deine Passwortanforderung von SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				
				<b>Date Reminder:</b> ".$row['reminder']."<br /><br />
				Viel Freude mit SpiritWings,<br />
				<br />
				Dein Admin-Team von SpiritWings<br /><br />
				</div>";
			}elseif ($language == 2){
				/////-> for en.
				if ($gender == 1){ // male
					$gendername = "";
				}else { // female
					$gendername = "";
				}
				$subject = "Your passwordrequest from SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				<b>Date Reminder:</b> ".$row['reminder']."<br /><br />
				Best regards,<br />
				SpiritWings, Adminteam<br /><br />
				</div>";
			}elseif ($language == 3){
				/////-> for fr.
				if ($gender == 1){ // male
					$gendername = "";
				}else { // female
					$gendername = "";
				}
				$subject = "«Votre demande de mot de passe de SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				<b>Date Reminder:</b> ".$row['reminder']."<br /><br />
				Beaucoup de joie avec des ailes de SpiritWings.<br />
				Votre administrateur de SpiritWings<br /><br />
				</div>";
			}elseif ($language == 4){
				/////-> for it.
				if ($gender == 1){ // male
					$gendername = "";
				}else { // female
					$gendername = "";
				}
				$subject = "La tua richiesta la password di SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				<b>Date Reminder:</b> ".$row['reminder']."<br /><br />
				Best regards,<br />
				Il vostro admin dello SpiritWings<br /><br />
				</div>";
			}
			$from = "info@buddhasways.ch";
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
			echo $body;
			
		}
?>