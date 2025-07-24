<?php
session_start();

include ("database-connection/dbconnection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

function resend_email_verify($fullname,$email,$verify_token){
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
    $mail->Subject = 'Resend - Email verification from ReliefHigh Academy';
    $email_template = "
        <h2>You have requested resend code with ReliefHigh Academy</h2>
        <h5>Verify your email address to login with the link below.</h5>
        <br/><br/>
        <p><a href='http://localhost/emailverification/verify-email.php?token=$verify_token'>Click Me</a></p>
    ";
    $mail->Body = $email_template;
    $mail->send();
    echo 'Message has been sent';
}
if(isset($_POST['resend_email_btn'])){

    if(!empty(trim($_POST['email']))){

        $email = mysqli_real_escape_string($con,$_POST['email']);

        $checkemail_query = "select * from admins where email = '$email' limit 1";
        $checkemail_query_run = mysqli_query($con,$checkemail_query);

        if(mysqli_num_rows($checkemail_query_run) > 0){

            $row = mysqli_fetch_array($checkemail_query_run);

            if($row['verify_status'] == '0'){

                $fullname = $row['name'];
                $email = $row['email'] ;
                $verify_token = $row['verify_token'];

                resend_email_verify($fullname,$email,$verify_token);
                $_SESSION['status'] = "Verification email link has been sent to your email address.";
                header("Location: login.php") ;
                exit(0);

            }else{
                $_SESSION['status'] = "Email already verified , please login.";
                header("Location: resend-verification-email.php") ;
                exit(0); 
            }

        }else{
            $_SESSION['status'] = "Email is not registered, Please register now!" ;
            header("Location: register.php") ;
            exit(0);   
        }

    }else{
        $_SESSION['status'] = "Please enter email" ;
        header("Location: resend-verification-email.php") ;
        exit(0);
    }
    
    

}

?>