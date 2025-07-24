<?php
session_start();
include("./database-connection/dbconnection.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';
 

function send_password_reset($get_name, $get_email, $token) {
    $mail = new PHPMailer(true); 

    $mail->isSMTP();
    $mail->SMTPAuth   = true;

    $mail->Host = 'smtp.gmail.com';
    $mail->Username   = 'adamyakubu1200@gmail.com';
    $mail->Password   = 'zkkz ifjp qcvk iyob'; 

    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom('adamyakubu1200@gmail.com', $get_name);
    $mail->addAddress($get_email);

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'Reset Password Notification';
    $email_template = "
        <h2>Hello, $get_name</h2>
        <p>You requested a password reset.</p>
        <p>it is just a test by Adam Yakubu.</p>
        <p><a href='http://localhost/emailverification/password-change.php?token=$token&email=$get_email'>Click here to reset your password</a></p>
    ";
    $mail->Body = $email_template;

    $mail->send();
}

if (isset($_POST['password_reset_link'])) {
    $email = mysqli_real_escape_string($con, trim($_POST['email']));
    $token = md5(rand());

    $check = "SELECT * FROM admins WHERE email = '$email' LIMIT 1";
    $check_query_run = mysqli_query($con, $check);

    if (mysqli_num_rows($check_query_run) > 0) {
        $row = mysqli_fetch_assoc($check_query_run);
        $get_name = $row['name'];
        $get_email = $row['email'];

        $update_token = "UPDATE admins SET verify_token = '$token' WHERE email = '$get_email' LIMIT 1";
        $update_token_run = mysqli_query($con, $update_token);

        if ($update_token_run) {
            send_password_reset($get_name, $get_email, $token);
            $_SESSION['status'] = "We emailed you a password reset link.";
            header("Location: password-reset.php");
            exit(0);
        } else {
            $_SESSION['status'] = "Something went wrong during token update.";
            header("Location: password-reset.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "No account found with that email. Please go to register page";
        header("Location: password-reset.php");
        exit(0);
    }
}



// change password
if(isset($_POST['update_password'])){

    $email = mysqli_real_escape_string($con,$_POST['email']);
    $new_password = mysqli_real_escape_string($con,$_POST['new_password']);
    $confirm_password = mysqli_real_escape_string($con,$_POST['confirm_password']);
    $token = mysqli_real_escape_string($con,$_POST['password_token']) ;

    if(!empty($token)){
        if(!empty($email) && !empty($new_password) && !empty($confirm_password)){

            $check_token = "select verify_token from admins where verify_token='$token' limit 1";
            $check_token_run = mysqli_query($con,$check_token) ;

            if(mysqli_num_rows($check_token_run) > 0){
                if($new_password == $confirm_password){
                    $update_password = "update admins set password='$new_password' where verify_token='$token' limit 1";
                    $update_password_run = mysqli_query($con,$update_password);

                    if($update_password_run){
                        $new_token = md5(rand())."reliefhignAcadamy";
                        $update_to_new_token = "update admins set verify_token='$new_token' where verify_token='$token' limit 1";
                        $update_to_new_token_run = mysqli_query($con,$update_to_new_token);

                        $_SESSION['status'] = "New password updated successfuly.";
                        header("Location: login.php");
                        exit(0);
                    }else{
                        $_SESSION['status'] = "Did not update password something went wrong.";
                        header("Location: password-change.php?token=$token&email=$email");
                        exit(0);
                    }

                }else{
                    $_SESSION['status'] = "Password and conirm password does not match.";
                    header("Location: password-change.php?token=$token&email=$email");
                    exit(0);
                }

            }else{
                $_SESSION['status'] = "Invalid token.";
                header("Location: password-change.php?token=$token&email=$email");
                exit(0);
            }

        }else{
            $_SESSION['status'] = "All Fills requries.";
            header("Location: password-change.php?token=$token&email=$email");
            exit(0);
        }
    }else{
        $_SESSION['status'] = "No token found.";
        header("Location: password-change.php");
        exit(0);
    }
}
?>
