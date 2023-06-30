<?php
include('../../conn/conn.php');
require 'PHPMailerAutoload.php';

set_time_limit(0);

class SendMail 
{



	



	//public $att_path='';



	public function SendMail_Auto($to_mail,$mail_subject,$email_body,$att_path)



	{



		/*get email & password to send mail*/



		$query=mysql_query("SELECT * FROM `bajaj_company_master`") or die(mysql_error());



		$r=mysql_fetch_array($query);



		$email_id=$r['email_id'];



		$epass=$r['email_password'];



		$remail_id=$r['reply_email'];



		$FromName=$r['company_title'];



		



		$mail = new PHPMailer;



		



		$mail->isSMTP();                                      // Set mailer to use SMTP



		$mail->Host = 'mail.worldauto.in';   // Specify main and backup SMTP servers



		$mail->SMTPAuth = true;                               // Enable SMTP authentication



		$mail->Username = $email_id;                 // SMTP username



		$mail->Password = $epass;                           // SMTP password



		$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted

		$mail->Port = 587;

		



		$mail->From = $email_id;



		$mail->FromName = $FromName;



		$mail->addAddress($to_mail);     // Add a recipient



		//$mail->addAddress('ellen@example.com');               // Name is optional



		$mail->addReplyTo($remail_id);



		//$mail->addCC('next_software@rediffmail.com');



		//$mail->addBCC('srsurani@yahoo.com');



		



		$mail->WordWrap = 50;                                 // Set word wrap to 50 characters



	

		 $mail->addAttachment($att_path); 

	

		 //$mail->addAttachment('invoice/JOB19_invoice.pdf');         // Add attachments



		//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name



		$mail->isHTML(true);                                  // Set email format to HTML



		



		$mail->Subject = ''.$mail_subject;



		$mail->Body    = ''.$email_body;



		$mail->AltBody = ''.$email_body;



		



		if(!$mail->send()) {



			echo 'Message could not be sent.';



			echo 'Mailer Error: ' . $mail->ErrorInfo;



		} else {



			echo 'Message has been sent';



			?>



			



			



			<?php



			



		}



	}



}







?>



