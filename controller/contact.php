<?php 
/**
* 
*/
class contact
{
	
	function send()
	{
		if(isset($_POST['send_contact'])):
			$email_body = "";
			$fname = mysql_real_escape_string($_POST['name_contact']);
			$lname = mysql_real_escape_string($_POST['lastname_contact']);
			$email = mysql_real_escape_string($_POST['email_contact']);
			$phone = mysql_real_escape_string($_POST['phone_contact']);
			$text = mysql_real_escape_string($_POST['message_contact']);
			$email_body .= "realgeorgiatours.com contact<br>";
			$email_body .= "<br>first name: $fname<br>";
			$email_body .= "Last name: $lname<br>";
			$email_body .= "email: $email<br>";
			$email_body .= "Phone: $phone<br><br>";
			$email_body .= "$text";
			$email_body .= "<hr><hr>";
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: info@realgeorgiatours.com'."\r\n";
			$headers .= 'Reply-To: '.$email . "\r\n";
			$headers .= 'X-Mailer: PHP/' . phpversion();
			mail("real.georgia.tours@gmail.com","Contact: ".rand(1,20000),$email_body,$headers);
		endif;
	}
}
 ?>

