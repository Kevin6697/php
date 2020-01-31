<?php

require 'PHPMailer-master/PHPMailerAutoload.php';
			   $mail = new PHPMailer();
		  	   //Enable SMTP debugging.
			  $mail->SMTPDebug = 0;
			  //Set PHPMailer to use SMTP.
			  $mail->isSMTP();
			  //Set SMTP host name
			  $mail->Host = "smtp.gmail.com";
			  $mail->SMTPOptions = array(
			                    'ssl' => array(
			                        'verify_peer' => false,
			                        'verify_peer_name' => false,
			                        'allow_self_signed' => true
			                    )
			                );
			  //Set this to true if SMTP host requires authentication to send email
			  $mail->SMTPAuth = TRUE;
			  //Provide username and password
			  $mail->Username = "shahkevin0697@gmail.com";
			  $mail->Password = "KevinShah@10";
			  //If SMTP requires TLS encryption then set it
			  $mail->SMTPSecure = "false";
			  $mail->Port = 587;
			  //Set TCP port to connect to
			  
			  $mail->From = "shahkevin0697@gmail.com";
			  $mail->FromName = "Admin";
			  
			  $mail->addAddress("karanbhoglenow@gmail.com");
			  
			  $mail->isHTML(true);
			 
			  $mail->Subject = "Change Password";
			  $mail->Body = "This is your Temporary password:<b>'Owner@123'</b> . Please change your password immediately after login for security purposes ";
			  $mail->AltBody = "This is txhe plain text version of the email content";
			  if(!$mail->send())
			  {
			   return  "Mailer Error: " . $mail->ErrorInfo;
			  }
			  else
			  {
                  echo "sent";
              }




?>