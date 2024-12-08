<?php
require ('./db/config.php');
session_start();
if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
    session_unset();
    session_destroy();
    header("Location: index.php");
    exit();
}

$id = $_SESSION['id'];

$query = "SELECT * FROM `products` WHERE id = $id";
$runQuery = mysqli_query($conn, $query);

$runData = mysqli_fetch_assoc($runQuery);

if ($runData) { 
    echo $runData['pname'];
}
?>
