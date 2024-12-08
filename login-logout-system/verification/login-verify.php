<?php
require('../db/config.php');
session_start();
$loginemail = mysqli_real_escape_string($conn, $_POST['login-email']);
$password = mysqli_real_escape_string($conn, $_POST['login-password']);

$query = "SELECT * FROM `credentials` WHERE emailid = '$loginemail' AND password = '$password'";
$runQuery = mysqli_query($conn, $query);

if ($runQuery && mysqli_num_rows($runQuery) > 0) {
    echo 'You are logged in successfully!';
    $fetchData = mysqli_fetch_assoc($runQuery);
    $_SESSION['login'] = true;
    $_SESSION['id'] = $fetchData['id'];
    exit();
} else {
    echo 'Login failed';
}
