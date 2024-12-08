<?php

$servername = "localhost";
$username = "root";
$password = "";
$databasename = "login-logout";

$conn = mysqli_connect($servername, $username, $password, $databasename);

if (!$conn) {
    die("Database connecrtion failed: " . mysqli_connect_error());
}
