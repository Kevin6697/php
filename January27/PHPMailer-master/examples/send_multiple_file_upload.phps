<?php
/**
 * PHPMailer multiple files upload and send example
 */
$msg = '';
if (array_key_exists('userfile', $_FILES)) {

    // Create a message
    // This should be somewhere in your include_path
    require '../PHPMailerAutoload.php';
    $mail = new PHPMailer;
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
					  $mail->Username = "hackershah391@gmail.com";
					  $mail->Password = "kevinkevinshah";
					  //If SMTP requires TLS encryption then set it
					  $mail->SMTPSecure = "false";
					  $mail->Port = 587;
					  //Set TCP port to connect to
					  
					  $mail->From = "hackershah391@gmail.com";
					  $mail->FromName = "Admin";
					  
					  $mail->addAddress('hackershah391@gmail.com');
					  
					  $mail->isHTML(true);
					 
					  $mail->Subject = "Cancel Booking";
					  $mail->Body ="Hello";
					  
    //Attach multiple files one by one
    for ($ct = 0; $ct < count($_FILES['userfile']['tmp_name']); $ct++) {
        $uploadfile = tempnam(sys_get_temp_dir(), sha1($_FILES['userfile']['name'][$ct]));
        $filename = $_FILES['userfile']['name'][$ct];
        if (move_uploaded_file($_FILES['userfile']['tmp_name'][$ct], $uploadfile)) {
            $mail->addAttachment($uploadfile, $filename);
        } else {
            $msg .= 'Failed to move file to ' . $uploadfile;
        }
    }
    if (!$mail->send()) {
        $msg .= "Mailer Error: " . $mail->ErrorInfo;
    } else {
        $msg .= "Message sent!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>PHPMailer Upload</title>
</head>
<body>
<?php if (empty($msg)) { ?>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="MAX_FILE_SIZE" value="100000">
        Select one or more files:
        <input name="userfile[]" type="file" multiple="multiple">
        <input type="submit" value="Send Files">
    </form>
<?php } else {
    echo $msg;
} ?>
</body>
</html>
