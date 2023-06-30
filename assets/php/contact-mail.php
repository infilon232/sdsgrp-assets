<?php
//require 'PHPMailer/PHPMailerAutoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Only process POST reqeusts.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Get the form fields and remove whitespace.
	$name = strip_tags(trim($_POST["name"]));
	$name = str_replace(array("\r", "\n"), array(" ", " "), $name);
	$email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
	$subject = strip_tags(trim($_POST["subject"]));
	$message = trim($_POST["message"]);

	// Check that data was sent to the mailer.
	if (empty($name) OR empty($subject) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
		// Set a 400 (bad request) response code and exit.
		http_response_code(400);
		echo "Please complete the form and try again.";
		exit;
	}

	// Set the recipient email address.
	// FIXME: Update this to your desired email address.
	// 	$recipient = "info@yourmail.com";

	// Set the email subject.
	$subject = "New contact from $name";

	// Build the email content.
	$email_content = "Name: $name<br>";
	$email_content .= "Email: $email<br>";
	$email_content .= "Message:$message<br>";

	// 	// Build the email headers.
	// 	$email_headers = "From: $name <$email>";
	// //echo 'vhfkfd';

	$mail = new PHPMailer;
	// Settings
	$mail->IsSMTP();
	//$mail->CharSet = 'UTF-8';
	$mail->Host = "mail.sandesh.com";
	$mail->Port = 465; // or 587   // SMTP server example
	$mail->SMTPDebug = 0; // enables SMTP debug information (for testing)
	$mail->SMTPAuth = true; // enable SMTP authentication
	$mail->SMTPSecure = 'ssl';
	// set the SMTP port for the GMAIL server
	$mail->Username = "info@sandeshgroup.com"; // SMTP account username example
	$mail->Password = "in*682%FO"; // SMTP account password example

	// Content
	$mail->setFrom('info@sandeshgroup.com');
	$mail->addAddress('info@sandeshgroup.com');
	$mail->addAddress($emai);

	$mail->isHTML(true); // Set email format to HTML
	$mail->Subject = $subject;
	$mail->Body = $email_content;


	// Send the email.
	// if (mail($recipient, $subject, $email_content, $email_headers)) {
	if ($mail->send()) {
		// Set a 200 (okay) response code.
		http_response_code(200);
		echo "Thank You! Your message has been sent.";
	} else {
		// Set a 500 (internal server error) response code.
		http_response_code(500);
		echo "Oops! Something went wrong and we couldn't send your message.";
	}

} else {
	// Not a POST request, set a 403 (forbidden) response code.
	http_response_code(403);
	echo "There was a problem with your submission, please try again.";
}

?>