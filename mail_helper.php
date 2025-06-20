<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
require 'PHPMailer-master/src/Exception.php';

function sendCustomMail($toEmail, $subject, $bodyHtml) {
    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = 0;
      $mail->isSMTP();
      $mail->Host       = 'localhost';
      $mail->SMTPAuth   = true;
      $mail->Username   = 'noreply@getwetfit.com';
      $mail->Password   = '15@(+??ntM(8';
      $mail->SMTPSecure = 'tls';
      $mail->Port       = 587;
      // $mail->SMTPSecure = false;  

      

      $mail->setFrom('noreply@getwetfit.com', 'GetWetFit&Co.');
      $mail->addAddress($toEmail);
      $mail->addBCC('aupadhydy007@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';
        $mail->Body    = $bodyHtml;

        $mail->send();
        return true;
    } catch (Exception $e) {
        return false;
    }
}
