<?php
session_start();
unset($_SESSION['authenticated']);
unset($_SESSION['auth_user']);
session_destroy();

$_SESSION['status'] = "You are logged out.";
header("Location: login.php");
exit(0);
?>
