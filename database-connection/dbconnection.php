
<?php

$con = mysqli_connect("localhost","root","","student_db");

if(!$con){
    die("Faile".mysqli_error($con)) ;
}

?>