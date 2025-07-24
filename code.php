<?php
session_start();
include("database-connection/dbconnection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function sendEmail_verify($fullName, $email, $verify_token) {
    $mail = new PHPMailer(true); 

    $mail->isSMTP();
    $mail->SMTPAuth = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username = 'adamyakubu1200@gmail.com';
    $mail->Password = 'zkkz ifjp qcvk iyob'; 

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port = 465;

    // Recipients
    $mail->setFrom('adamyakubu1200@gmail.com', $fullName);
    $mail->addAddress($email);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Email verification from ReliefHigh Academy';
    $email_template = "
        <h2>You have registered with ReliefHigh Academy</h2>
        <h5>Verify your email address to login with the link below.</h5>
        <br/><br/>
        <p><a href='http://localhost/emailverification/verify-email.php?token=$verify_token'>Click Me</a></p>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}

if (isset($_POST['register'])) {
    $fullName = $_POST['fullname'];
    $phoneNumber = $_POST['phone'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];
    $verify_token = md5(rand());

    $check_email = "SELECT email FROM admins WHERE email='$email' LIMIT 1";
    $check_email_run = mysqli_query($con, $check_email);

    if (mysqli_num_rows($check_email_run) > 0) {
        $_SESSION['status'] = "Email id already exist";
        header("Location: register.php");
        exit(0);
    } else {
        $query = "INSERT INTO admins(
                    name,
                    phone,
                    email,
                    password,
                    verify_token
                    
                )
                VALUES(
                    '$fullName',
                    '$phoneNumber',
                    '$email',
                    '$password',
                    '$verify_token'
                    
                )";
        $query_run = mysqli_query($con, $query);
        if ($query_run) {
            sendEmail_verify("$fullName", "$email", "$verify_token");
            $_SESSION['status'] = "Registration successfully, please verify your email address";
            header("Location: register.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Registration Failed, Please try again!";
            header("Location: register.php");
            exit(0);
        }
    }
}
?>
