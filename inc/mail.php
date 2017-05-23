<?php
require 'phpmailer/vendor/autoload.php';
function sendMail($name, $email, $sender, $subject, $body)
{
  $mail = new PHPMailer;
  //$mail->SMTPDebug = 3;

  $mail->isSMTP();  // Set mailer to use SMTP
  $mail->Host = 'smtp.mailgun.org';  // Specify mailgun SMTP servers
  $mail->SMTPAuth = true; // Enable SMTP authentication
  $mail->Username = 'postmaster@iluminame.co'; // SMTP username from https://mailgun.com/cp/domains
  $mail->Password = 'c1e887e928e55823cde248d8d55048fb'; // SMTP password from https://mailgun.com/cp/domains
  $mail->SMTPSecure = 'tls';   // Enable encryption, 'ssl'
  $mail->CharSet = "UTF-8";

  $mail->From = 'noreply@iluminame.co'; // The FROM field, the address sending the email
  $mail->FromName = $sender; // The NAME field which will be displayed on arrival by the email client
  $mail->addAddress($email, $name);     // Recipient's email address and optionally a name to identify him
  $mail->isHTML(true);   // Set email to be sent as HTML, if you are planning on sending plain text email just set it to false

  // The following is self explanatory
  $mail->Subject = $subject;
  $mail->Body    = $body;
  $mail->AltBody = "Your email doesn't support HTML.";

  if(!$mail->send()) {
      return $mail->ErrorInfo;
  } else {
      return true;
  }
}
?>
