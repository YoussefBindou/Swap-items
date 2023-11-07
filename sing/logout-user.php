<?php
require_once "../sing/connection.php";
session_start();
$status = "Offline now";
$email = $_SESSION['email'];

// Prepare the SQL statement with a parameter
$sql = $con->prepare("UPDATE usertable SET status_o_f = ? WHERE email LIKE ?");
$sql->bind_param("ss", $status, $email);
$sql->execute();

session_unset();
session_destroy();
header('location: ../user_no/home.php');
?>
