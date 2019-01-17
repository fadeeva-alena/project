<?php
        require_once 'lib/swift_required.php';
$transport = Swift_SmtpTransport::newInstance('mail.drflow.ch',25,"")
        ->setUsername('anmeldebestaetigung@drflow.ch')
        ->setPassword('jeke829579=idiW_uti');





        $mailer = Swift_Mailer::newInstance($transport);


		//to david
        $message = Swift_Message::newInstance($subject)
            ->setFrom(array("anmeldung@manimano.ch" => "anmeldung@manimano.ch"))
            ->setTo(array("Amgad.Makar@gmail.com"))
            ->setContentType("text/html; charset=utf-8")
            ->setBody('<b>Here is the message itself<b>');

        $result = $mailer->send($message);

	


		echo "sent";
		
?>
