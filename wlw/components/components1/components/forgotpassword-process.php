<?php
	session_start();
	require ( '../includes/config.php' );
	require ( '../'.PATH_LIBRARIES.'libraries.php' );
	$is_valid = 'no';	
	if(isset($_POST['email'])) 
	{		
		$email = $string->sql_safe($_POST['email']);
	
	
		$row = $db->get_row("SELECT * FROM ".DB_TABLE_PREFIX."provider WHERE email = '$email'") ;	
		
		if( $row->id > 0 ) 
		{
			//sending an email here
			$to = $email;
			$username = $row->firstname;
			$language = $row->language;
			$gender = $row->gender;
			if ($language == 1){
				/////-> for de.
				if ($gender == 1){ // male
					$gendername = "Lieber";
				}else { // female
					$gendername = "Liebe";
				}
				
				$subject = "Deine Passwortanforderung von SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				Hier ist Dein Benutzername und Dein Passwort.<br /><br />
				<b>Benutzername:</b> ".$row->nick."<br />
				<b>Passwort:</b> ".$row->pw."<br /><br />
				Bei Fragen und für Anregungen stehen wir Dir gerne zur Verfügung!<br /><br />
				Viel Freude mit SpiritWings,<br />
				<br />
				Dein Admin-Team von SpiritWings<br /><br />
				</div>";
			}elseif ($language == 2){
				/////-> for en.
				if ($gender == 1){ // male
					$gendername = "Dear";
				}else { // female
					$gendername = "Dear";
				}
				$subject = "Your passwordrequest from SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				Here is your username and password.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				If you have any questions or inspirations, please feel free to contact us!<br /><br />
				Best regards,<br />
				SpiritWings, Adminteam<br /><br />
				</div>";
			}elseif ($language == 3){
				/////-> for fr.
				if ($gender == 1){ // male
					$gendername = "Chèr";
				}else { // female
					$gendername = "Chère";
				}
				$subject = "«Votre demande de mot de passe de SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				Voici votre nom d'utilisateur et mot de passe.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				Pour toutes questions et suggestions, nous sommes heureux de vous aider!<br /><br />
				Beaucoup de joie avec des ailes de SpiritWings.<br />
				Votre administrateur de SpiritWings<br /><br />
				</div>";
			}elseif ($language == 4){
				/////-> for it.
				if ($gender == 1){ // male
					$gendername = "Caro";
				}else { // female
					$gendername = "Cara";
				}
				$subject = "La tua richiesta la password di SpiritWings..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				".$gendername." ".$username.",<br /><br />
				Ecco il vostro username e password.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				Tanta gioia con le ali dello SpiritWings,<br /><br />
				Best regards,<br />
				Il vostro admin dello SpiritWings<br /><br />
				</div>";
			}
			$from = "info@buddhasways.ch";
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			mail($to,$subject,$body,$headers);
			
			$is_valid = 'yes';
		}

	}	
	echo $is_valid;	
?>