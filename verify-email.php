<?php
include ("database-connection/dbconnection.php");
session_start();

if(isset($_GET['token'])){
    $token = $_GET['token'] ;

    $verify_token = "select verify_token, verify_status from admins where verify_token = '$token' limit 1";
    $verify_token_run = mysqli_query($con,$verify_token);

    if(mysqli_num_rows($verify_token_run) > 0){

        $row = mysqli_fetch_array($verify_token_run);

        if($row['verify_status'] == 0){
            $click_token = $row['verify_token'];
            $update_token = "update admins set verify_status = '1' where verify_token='$click_token' limit 1";
            $update_token_run = mysqli_query($con,$update_token);
            
            if($update_token_run){
                $_SESSION['status'] = "Your account have been verified.";
                header("Location: login.php");
                exit(0);
            }else{
                $_SESSION['status'] = "Verification failed.!";
                header("Location: login.php");
                exit(0);
            }

        }else{
            $_SESSION['status'] = "Email already verify, Please login.";
            header("Location: login.php");
            exit(0);
        }

    }else{
        $_SESSION['status'] = "This token does not exist";
        header("Location: login.php");
        exit(0);
    }

    
}else{
        $_SESSION['status']="Not Allowed";
        header("Location: login.php");
        exit(0);
    }
?>