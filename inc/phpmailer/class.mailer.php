<?php
require 'phpmailer/vendor/autoload.php';
public class MailGunMailer
{
  private $mail;
  private $host;
  private $username;
  private $password;

  public function __construct($host, $user, $pass)
  {
    $this->host = $host;
    $this->user = $user;
    $this->pass = $pass;
  }

  public function prepareMail()
  {
    $mail = new PHPMailer;
    $mail->Host = $this->host;
    
  }

}
?>
