<?php
require_once "../../sing/controllerUserData.php";

$email = $_SESSION['email'];
$password = $_SESSION['password'];

if ($email != false && $password != false) {
    $sql = "SELECT * FROM usertable WHERE email LIKE '$email'";
    $run_Sql = mysqli_query($con, $sql);

    if ($run_Sql) {
        $fetch_info = mysqli_fetch_assoc($run_Sql);
        $status = $fetch_info['status'];
        $code = $fetch_info['code'];

        if ($status == "verified") {
            if ($code != 0) {
                header('Location: ../../sing/reset-code.php');
            }
        } else {
            header('Location: ../../sing/user-otp.php');
        }
    }
} else {
    header('Location: ../../user_no/home.php');
}

$outgoing_id = $fetch_info['unique_id'];
$searchTerm = mysqli_real_escape_string($con, $_POST['searchTerm']);
$searchTerm = '%' . $searchTerm . '%';

$sql = "SELECT * FROM usertable WHERE NOT unique_id = {$outgoing_id} AND (name LIKE '$searchTerm') ";
$output = "";
$query = mysqli_query($con, $sql);

if (mysqli_num_rows($query) > 0) {
    include_once "data.php";
} else {
    $output .= 'No user found related to your search term';
}

echo $output;
?>