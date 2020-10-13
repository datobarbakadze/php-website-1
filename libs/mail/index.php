<?php

require('includes/class.phpmailer.php');

SendMail();

function SendMail() {
	$mail	= new PHPMailer();

	$mail->CharSet = 'utf-8';
	$mail->IsSMTP();                                      // Set mailer to use SMTP
// 	$mail->Host = 'node1.mywebstudio.ge'; 
	$mail->Host = 'mail.fufala.ge';  					  // Specify main and backup server
	//$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
// 	$mail->Username = 'myjobs@node1.mywebstudio.ge'; 
	$mail->Username = 'noreply@fufala.ge';                 // SMTP username
// 	$mail->Password = 'myjobs123'; t%Rj}mbTARGY      
	$mail->Password = 't%Rj}mbTARGY';              			  // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

	$mail->From = 'myjobs@node1.mywebstudio.ge';
	$mail->FromName = 'Test';
	$mail->AddAddress('lorlev@bk.ru');             		  // Name is optional	
	//$mail->Port = 587;

	$mail->WordWrap = 50;                                 // Set word wrap to 50 characters
	$mail->IsHTML(true);                                  // Set email format to HTML
	$mail->SMTPDebug = 1;

	$mail->Subject = 'From Office1:';

	$message = 'message';
	
	$mail->Body    = $message;

	if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
	}
}
?>