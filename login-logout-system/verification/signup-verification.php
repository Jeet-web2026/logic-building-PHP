<?php
require('../db/config.php');

$signupName = htmlspecialchars(trim($_POST['signname']));
$signEmail = htmlspecialchars(trim($_POST['signemail']));
$signPassword = htmlspecialchars(trim($_POST['signpassword']));

$signupName = mysqli_real_escape_string($conn, $signupName);
$signEmail = mysqli_real_escape_string($conn, $signEmail);
$signPassword = mysqli_real_escape_string($conn, $signPassword);

$checkEmailQuery = "SELECT * FROM `credentials` WHERE emailid = '$signEmail'";
$checkEmailResult = mysqli_query($conn, $checkEmailQuery);

if (mysqli_num_rows($checkEmailResult) > 0) {
    echo "Email already exists!";
} else {
    $query = "INSERT INTO `credentials`(`fullname`, `emailid`, `password`) VALUES ('$signupName', '$signEmail', '$signPassword')";
    $runQuery = mysqli_query($conn, $query);

    if ($runQuery) {
        echo "You are successfully signed up, let's login!";
    } else {
        echo 'Signup failed';
    }
}
