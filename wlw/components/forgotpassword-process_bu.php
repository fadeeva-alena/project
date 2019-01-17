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
			if ($language == 1){
				/////-> for de.
				$subject = "Retrieve your password..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				Dear ".$username.",<br /><br />
				Here is your username and password.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				If you have any questions or concerns, please feel free to contact us!<br /><br />
				Best regards,<br />
				Staff<br /><br />
				</div>";
			}elseif ($language == 2){
				/////-> for en.
				$subject = "Retrieve your password..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				Dear ".$username.",<br /><br />
				Here is your username and password.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				If you have any questions or concerns, please feel free to contact us!<br /><br />
				Best regards,<br />
				Staff<br /><br />
				</div>";
			}elseif ($language == 3){
				/////-> for fr.
				$subject = "Retrieve your password..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				Dear ".$username.",<br /><br />
				Here is your username and password.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				If you have any questions or concerns, please feel free to contact us!<br /><br />
				Best regards,<br />
				Staff<br /><br />
				</div>";
			}elseif ($language == 4){
				/////-> for it.
				$subject = "Retrieve your password..";
				$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
				Dear ".$username.",<br /><br />
				Here is your username and password.<br /><br />
				<b>Username:</b> ".$row->nick."<br />
				<b>Password:</b> ".$row->pw."<br /><br />
				If you have any questions or concerns, please feel free to contact us!<br /><br />
				Best regards,<br />
				Staff<br /><br />
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