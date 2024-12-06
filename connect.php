<?php

// $host = "localhost";
// $user = "root";
// $password = "";
// $db_name = "registration";

// $con = mysqli_connect($host, $user, $password, $db_name);

// if (isset($con)) {

//     echo "";
// } else {
//     echo   "Connection failed: ". mysqli_connect_error();
// } 
?>

<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


$host = "sql102.infinityfree.com";  // MySQL Hostname
$user = "if0_37863918";            // MySQL Username
$password = "Co0nRv1Pco1FT8C";     // MySQL Password
$db_name = "if0_37863918_registration";     // MySQL Database Name
$con = mysqli_connect($host, $user, $password, $db_name);

if ($con) {
    echo " ";
} else {
    echo "Connection failed: " . mysqli_connect_error();
}
?>
