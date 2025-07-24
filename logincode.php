<?php
session_start();
include("database-connection/dbconnection.php");

if (isset($_POST['loginBtn'])) {
    if (!empty(trim($_POST['email'])) && !empty(trim($_POST['password']))) {
        $email = mysqli_real_escape_string($con, $_POST['email']);
        $password = mysqli_real_escape_string($con, $_POST['password']); 

        $loging_query = "SELECT * FROM admins WHERE email = '$email' AND password = '$password' LIMIT 1";
        $loging_query_run = mysqli_query($con, $loging_query);

        if (mysqli_num_rows($loging_query_run) > 0) {
            $row = mysqli_fetch_array($loging_query_run);
            // echo $row['verify_status'];

            if($row['verify_status'] == '1'){
                $_SESSION['authenticated'] = TRUE;
                $_SESSION['auth_user']=[
                    'username' => $row['name'],
                    'phones' => $row['phone'],
                    'emails' => $row['email'],
                ];
                $_SESSION['status'] = "You have successfully login.";
                header("Location: dashboard.php");
                exit(0);

            }else{
                $_SESSION['status']="Please verify your email to login.";
                header("Location: login.php");
                exit(0);
            }
        } else {
            $_SESSION['status'] = "Invalid email or Password.";
            header("Location: login.php");
            exit(0);
        }
    } else {
        $_SESSION['status'] = "All fields required";
        header("Location: login.php");
        exit(0);
    }
}
?>
