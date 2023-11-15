<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function sendEmail($sendTo, $subject, $content)
{
    $mail = new PHPMailer;

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'phpmailer720@gmail.com';
    $mail->Password = 'gqqwrfsekxkkkuwl';
    $mail->SMTPSecure = 'tls';
    $mail->isHTML(true);
    $mail->setFrom('phpmailer720@gmail.com', 'MSG-IT Administrator');
    $mail->addAddress($sendTo);
    $mail->Subject = $subject;
    $mail->Body = $content;

    if ($mail->send()) {
        return 'Email sent successfully';
    } else {
        return 'Email could not be sent. Error: ' . $mail->ErrorInfo;
    }
}

// $recipientEmail = 'dace.phage@gmail.com';
// $emailSubject = 'Subject of the Email';
// $emailContent = 'This is the email message.';

// $result = sendEmail($recipientEmail, $emailSubject, $emailContent);
// echo $result;