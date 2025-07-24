<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'adamyakubu1200@gmail.com';
    $mail->Password   = 'zkkz ifjp qcvk iyob'; 
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    $mail->setFrom('adamyakubu1200@gmail.com', 'Adam Yakubu');
    $mail->addAddress('chanasewelaz@gmail.com', 'Chanasewe Lazerous'); 

    $mail->isHTML(true);
    $mail->Subject = 'Test Email from Relief High school';
    $mail->Body    = '<h1>Success!</h1><p>This is a test email sent from ReliefHigh .</p>';

    $mail->send();
    echo 'Email has been sent!';
} catch (Exception $e) {
    echo "Email could not be sent. Error: {$mail->ErrorInfo}";
}
?>
